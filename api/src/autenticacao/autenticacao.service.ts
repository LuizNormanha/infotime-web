import {
  BadRequestException,
  HttpException,
  HttpStatus,
  Injectable,
  InternalServerErrorException,
  UnauthorizedException,
} from '@nestjs/common';
import { loginReservadoParaUsuarioPorTenant } from '../comum/logins-usuario-reservados';
import { ConfigService } from '@nestjs/config';
import { JwtService } from '@nestjs/jwt';
import * as bcrypt from 'bcrypt';
import { v4 as uuidv4 } from 'uuid';
import { Request } from 'express';

import { Prisma } from '@prisma/client';

import { gerarChaveJwtTenant } from '../comum/gerar-chave-jwt-tenant';
import { PrismaService } from '../prisma/prisma.service';
import { setCurrentTenantLocal } from '../prisma/set-current-tenant-local';
import {
  resolverTenantAtivoPorDominio,
  type TenantLoginAtivo,
} from './internal/resolver-tenant-login';
import { GeradorSenhaDoDia } from './gerador-senha-dia.service';
import { ServicoCaptchaLogin } from './captcha-login.service';
import { DtoLoginUsuario } from './dto/login-usuario.dto';
import { DtoRegistrarAcesso } from './dto/registrar-acesso.dto';
import {
  RespostaLogin,
  RespostaLoginSuporte,
  RespostaSessaoAtiva,
} from './interfaces/resposta-login.interface';

// Timeout padrão fixo em código para suporte/implantação sem configuração
const TIMEOUT_SUPORTE_PADRAO_MINUTOS = 15;
const SELECT_USUARIO_LOGIN = {
  id_usuario: true,
  id_tenacidade: true,
  ativo: true,
  senha: true,
  email: true,
} as const;

@Injectable()
export class ServicoAutenticacao {
  constructor(
    private readonly prisma: PrismaService,
    private readonly jwt: JwtService,
    private readonly geradorSenha: GeradorSenhaDoDia,
    private readonly config: ConfigService,
    private readonly captchaLogin: ServicoCaptchaLogin,
  ) {}

  // ─── Utilitários de senha ────────────────────────────────────────────────────

  async hashPassword(senha: string): Promise<string> {
    return bcrypt.hash(senha, 10);
  }

  async comparePassword(senha: string, hash: string): Promise<boolean> {
    return bcrypt.compare(senha, hash);
  }

  // ─── Ponto de entrada do login ───────────────────────────────────────────────

  async login(
    dto: DtoLoginUsuario,
    req: Request,
  ): Promise<RespostaLogin | RespostaLoginSuporte> {
    const ip = this.extrairIp(req);
    this.validarCaptchaSeNecessario(ip, dto);

    const parteLocal = dto.email.split('@')[0].trim().toLowerCase();
    /** Logins técnicos (parte local do e-mail): senha do dia; demais: bcrypt no tenant. */
    const ehSuporteOuImplantacao =
      loginReservadoParaUsuarioPorTenant(parteLocal);

    const dominio = dto.email.split('@')[1]?.trim().toLowerCase();
    const tenant = await resolverTenantAtivoPorDominio(this.prisma, dominio);
    const avisoLicenca = this.avaliarLicencaTenant(tenant.data_expiracao);

    try {
      const resultado = ehSuporteOuImplantacao
        ? await this.loginSuporte(dto, tenant, req)
        : await this.loginNormal(dto, tenant, req, avisoLicenca);
      this.captchaLogin.registrarSucesso(ip);
      return resultado;
    } catch (erro) {
      this.registrarFalhaCaptchaQuandoAplicavel(ip, erro);
      throw erro;
    }
  }

  // ─── Login normal ────────────────────────────────────────────────────────────

  async loginNormal(
    dto: DtoLoginUsuario,
    tenant: TenantLoginAtivo,
    req: Request,
    avisoLicenca: string | null = null,
  ): Promise<RespostaLogin> {
    const loginLocal = dto.email.split('@')[0].trim().toLowerCase();
    const senhaInformada = dto.senha.trim();

    const resultado = await this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenant.id_tenacidade);
      const usuario = await tx.infotime_usuario.findFirst({
        where: {
          login: { equals: loginLocal, mode: 'insensitive' },
          id_tenacidade: tenant.id_tenacidade,
          ativo: { in: ['S', 'Y'] },
        },
        select: SELECT_USUARIO_LOGIN,
      });
      if (!usuario) throw new UnauthorizedException('Credenciais inválidas');

      const senhaValida = await this.comparePassword(
        senhaInformada,
        usuario.senha ?? '',
      );
      if (!senhaValida)
        throw new UnauthorizedException('Credenciais inválidas');

      const sessaoAtiva = await tx.infotime_sessao_usuario.findFirst({
        where: {
          id_usuario: usuario.id_usuario,
          id_tenacidade: tenant.id_tenacidade,
          ativo: 'S',
          data_expiracao: { gt: new Date() },
        },
      });

      if (sessaoAtiva) {
        const resposta: RespostaSessaoAtiva = {
          mensagem:
            'Você já está logado em outro dispositivo. Deseja encerrar essa sessão e usar esta?',
          id_usuario: usuario.id_usuario.toString(),
          id_tenacidade: tenant.id_tenacidade.toString(),
        };
        throw new HttpException(resposta, HttpStatus.CONFLICT);
      }

      return { usuario, tenant };
    });

    return this.criarSessaoNormal(
      resultado.usuario,
      resultado.tenant,
      req,
      avisoLicenca,
    );
  }

  // ─── Login confirm (força encerramento de sessão anterior) ───────────────────

  async loginConfirm(
    dto: DtoLoginUsuario,
    req: Request,
  ): Promise<RespostaLogin> {
    const ip = this.extrairIp(req);
    this.validarCaptchaSeNecessario(ip, dto);
    try {
      const dominio = dto.email.split('@')[1]?.trim().toLowerCase();
      const loginLocal = dto.email.split('@')[0].trim().toLowerCase();
      const senhaInformada = dto.senha.trim();
      const tenant = await resolverTenantAtivoPorDominio(this.prisma, dominio);
      const avisoLicenca = this.avaliarLicencaTenant(tenant.data_expiracao);

      const resultado = await this.prisma.$transaction(async (tx) => {
        await setCurrentTenantLocal(tx, tenant.id_tenacidade);
        const usuario = await tx.infotime_usuario.findFirst({
          where: {
            login: { equals: loginLocal, mode: 'insensitive' },
            id_tenacidade: tenant.id_tenacidade,
            ativo: { in: ['S', 'Y'] },
          },
          select: SELECT_USUARIO_LOGIN,
        });
        if (!usuario) throw new UnauthorizedException('Credenciais inválidas');

        const senhaValida = await this.comparePassword(
          senhaInformada,
          usuario.senha ?? '',
        );
        if (!senhaValida)
          throw new UnauthorizedException('Credenciais inválidas');

        return { usuario, tenant };
      });

      const resposta = await this.criarSessaoNormal(
        resultado.usuario,
        resultado.tenant,
        req,
        avisoLicenca,
      );
      this.captchaLogin.registrarSucesso(ip);
      return resposta;
    } catch (erro) {
      this.registrarFalhaCaptchaQuandoAplicavel(ip, erro);
      throw erro;
    }
  }

  // ─── Login suporte ───────────────────────────────────────────────────────────

  async loginSuporte(
    dto: DtoLoginUsuario,
    tenant: TenantLoginAtivo,
    req: Request,
  ): Promise<RespostaLoginSuporte> {
    // Ordem: tenant já validado em login() → senha do dia → usuário global (id_tenacidade NULL) → sessão no tenant do domínio
    if (!this.geradorSenha.validarSenhaDoDia(dto.senha?.trim() ?? '')) {
      throw new UnauthorizedException('Senha do dia inválida');
    }

    const parteLocal = dto.email.split('@')[0].trim().toLowerCase();

    const { usuario, tokenId } = await this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenant.id_tenacidade);
      // Preferência: usuário global (id_tenacidade NULL), como no seed.
      // Fallback: mesmo login cadastrado na tenacidade do domínio (RLS já permite ambos).
      const usuario =
        (await tx.infotime_usuario.findFirst({
          where: {
            login: { equals: parteLocal, mode: 'insensitive' },
            id_tenacidade: null,
            ativo: { in: ['S', 'Y'] },
          },
          select: SELECT_USUARIO_LOGIN,
        })) ??
        (await tx.infotime_usuario.findFirst({
          where: {
            login: { equals: parteLocal, mode: 'insensitive' },
            id_tenacidade: tenant.id_tenacidade,
            ativo: { in: ['S', 'Y'] },
          },
          select: SELECT_USUARIO_LOGIN,
        }));
      if (!usuario) {
        throw new HttpException(
          {
            mensagem:
              'Usuário técnico não encontrado. Cadastre o login (suporte/implantação) sem tenacidade ou na tenacidade deste domínio, com ativo S.',
          },
          HttpStatus.SERVICE_UNAVAILABLE,
        );
      }

      const timeoutMinutos = TIMEOUT_SUPORTE_PADRAO_MINUTOS;

      const tokenId = uuidv4();
      const agora = new Date();
      const expiracao = new Date(agora.getTime() + timeoutMinutos * 60 * 1000);

      await tx.infotime_sessao_suporte.create({
        data: {
          id_usuario: usuario.id_usuario,
          id_tenacidade: tenant.id_tenacidade,
          token_id: tokenId,
          data_criacao: agora,
          data_expiracao: expiracao,
          ativo: 'S',
          ip: this.extrairIp(req),
          dispositivo: req.headers['user-agent']?.slice(0, 255) ?? null,
          user_agent: req.headers['user-agent'] ?? null,
        },
      });

      return { usuario, tokenId };
    });

    const secretKey = this.config.get<string>('SUPORTE_SECRET_KEY')!;
    const emailLogin = dto.email.trim().toLowerCase();

    const access_token = this.jwt.sign(
      {
        sub: usuario.id_usuario.toString(),
        tenantId: tenant.id_tenacidade.toString(),
        suporte: true,
        jti: tokenId,
        email: emailLogin,
      },
      { secret: secretKey, expiresIn: '24h' },
    );

    return { access_token, redirect: '/suporte/acesso' };
  }

  // ─── Logout ──────────────────────────────────────────────────────────────────

  async logout(jti: string, isSuporte: boolean): Promise<void> {
    if (isSuporte) {
      await this.prisma.infotime_sessao_suporte.updateMany({
        where: { token_id: jti },
        data: { ativo: 'N' },
      });
    } else {
      await this.prisma.infotime_sessao_usuario.updateMany({
        where: { token_id: jti },
        data: { ativo: 'N' },
      });
    }
  }

  // ─── Registrar acesso suporte ────────────────────────────────────────────────

  async registrarAcessoSuporte(
    jti: string,
    dto: DtoRegistrarAcesso,
  ): Promise<void> {
    await this.prisma.infotime_sessao_suporte.updateMany({
      where: { token_id: jti },
      data: {
        numero_chamado: dto.numero_chamado ?? null,
        motivo_acesso: dto.motivo_acesso ?? null,
      },
    });
  }

  async obterPermissoesTela(idUsuario: bigint, tela: string, ehSuporte = false) {
    const codigoTela = tela.trim().toLowerCase();
    if (!codigoTela) {
      throw new BadRequestException('Informe a tela para consultar permissões.');
    }

    if (ehSuporte) {
      return {
        tela: codigoTela,
        possuiRegra: false,
        incluir: true,
        editar: true,
        excluir: true,
      };
    }

    let usuario: { id_grupo_usuario: bigint | null } | null = null;
    try {
      usuario = await this.prisma.infotime_usuario.findFirst({
        where: { id_usuario: idUsuario },
        select: { id_grupo_usuario: true },
      });
    } catch (e: unknown) {
      const colunaAusentePerfil =
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2022' &&
        String(e.meta?.['column'] ?? '').includes('id_grupo_usuario');
      if (colunaAusentePerfil) {
        return {
          tela: codigoTela,
          possuiRegra: false,
          incluir: true,
          editar: true,
          excluir: true,
        };
      }
      throw e;
    }

    if (!usuario) {
      throw new UnauthorizedException('Usuário não encontrado na sessão atual.');
    }

    // Compatibilidade: sem perfil atribuído mantém acesso livre (comportamento legado).
    if (!usuario.id_grupo_usuario) {
      return {
        tela: codigoTela,
        possuiRegra: false,
        incluir: true,
        editar: true,
        excluir: true,
      };
    }

    // `tela` = slug (`codigo`) ou id numérico (`id_formulario`), alinhado ao catálogo em seed.
    const formulario = /^\d+$/.test(codigoTela)
      ? await this.prisma.infotime_formulario.findFirst({
          where: { id_formulario: BigInt(codigoTela), ativo: true },
          select: { id_formulario: true },
        })
      : await this.prisma.infotime_formulario.findFirst({
          where: {
            codigo: { equals: codigoTela, mode: 'insensitive' },
            ativo: true,
          },
          select: { id_formulario: true },
        });

    // Sem registro no catálogo: não bloqueia — só `infotime_usuario_permissoes` restringe quando existe linha.
    if (!formulario) {
      return {
        tela: codigoTela,
        possuiRegra: false,
        incluir: true,
        editar: true,
        excluir: true,
      };
    }

    const regra = await this.prisma.infotime_usuario_permissoes.findFirst({
      where: {
        id_grupo_usuario: usuario.id_grupo_usuario,
        id_formulario: formulario.id_formulario,
      },
      select: {
        incluir: true,
        editar: true,
        excluir: true,
      },
    });

    // Sem linha em infotime_usuario_permissoes para (grupo, form) → não “faz parte” da matriz → tudo permitido.
    if (!regra) {
      return {
        tela: codigoTela,
        possuiRegra: false,
        incluir: true,
        editar: true,
        excluir: true,
      };
    }

    return {
      tela: codigoTela,
      possuiRegra: true,
      incluir: regra.incluir === 'S',
      editar: regra.editar === 'S',
      excluir: regra.excluir === 'S',
    };
  }

  /**
   * Mapa de permissões por `codigo` de `infotime_formulario` para o perfil do utilizador.
   * Mesma regra que `obterPermissoesTela`: sem linha na tabela para (grupo, form) → tudo permitido;
   * com linha → cada ação só se `S`.
   */
  async listarPermissoesPerfilUsuario(idUsuario: bigint, ehSuporte = false): Promise<{
    porCodigo: Record<
      string,
      { incluir: boolean; editar: boolean; excluir: boolean }
    >;
  }> {
    const permissivo = {
      incluir: true,
      editar: true,
      excluir: true,
    } as const;

    if (ehSuporte) {
      const formularios = await this.prisma.infotime_formulario.findMany({
        where: { ativo: true },
        select: { codigo: true },
      });
      const porCodigo: Record<string, { incluir: boolean; editar: boolean; excluir: boolean }> = {};
      for (const f of formularios) {
        porCodigo[f.codigo.toLowerCase()] = { ...permissivo };
      }
      return { porCodigo };
    }

    let usuario: { id_grupo_usuario: bigint | null } | null = null;
    try {
      usuario = await this.prisma.infotime_usuario.findFirst({
        where: { id_usuario: idUsuario },
        select: { id_grupo_usuario: true },
      });
    } catch (e: unknown) {
      const colunaAusentePerfil =
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2022' &&
        String(e.meta?.['column'] ?? '').includes('id_grupo_usuario');
      if (colunaAusentePerfil) {
        const formularios = await this.prisma.infotime_formulario.findMany({
          where: { ativo: true },
          select: { codigo: true },
        });
        const porCodigo: Record<
          string,
          { incluir: boolean; editar: boolean; excluir: boolean }
        > = {};
        for (const f of formularios) {
          porCodigo[f.codigo.toLowerCase()] = { ...permissivo };
        }
        return { porCodigo };
      }
      throw e;
    }

    if (!usuario) {
      throw new UnauthorizedException('Usuário não encontrado na sessão atual.');
    }

    const formularios = await this.prisma.infotime_formulario.findMany({
      where: { ativo: true },
      select: { id_formulario: true, codigo: true },
    });

    const porCodigo: Record<
      string,
      { incluir: boolean; editar: boolean; excluir: boolean }
    > = {};

    if (!usuario.id_grupo_usuario) {
      for (const f of formularios) {
        porCodigo[f.codigo.toLowerCase()] = { ...permissivo };
      }
      return { porCodigo };
    }

    const regras = await this.prisma.infotime_usuario_permissoes.findMany({
      where: { id_grupo_usuario: usuario.id_grupo_usuario },
      select: {
        id_formulario: true,
        incluir: true,
        editar: true,
        excluir: true,
      },
    });
    const regraPorId = new Map(
      regras.map((r) => [r.id_formulario.toString(), r]),
    );

    for (const f of formularios) {
      const codigo = f.codigo.toLowerCase();
      const r = regraPorId.get(f.id_formulario.toString());
      if (!r) {
        porCodigo[codigo] = { ...permissivo };
      } else {
        porCodigo[codigo] = {
          incluir: r.incluir === 'S',
          editar: r.editar === 'S',
          excluir: r.excluir === 'S',
        };
      }
    }

    return { porCodigo };
  }

  /**
   * Domínio da tenacidade da sessão (JWT) e se o usuário técnico pode mutar
   * `implantacao-tenacidades` (só com sessão no tenant `liga.br`).
   */
  async obterContextoSessaoParaStatus(user: {
    tenantId: string;
    suporte: boolean;
    email?: string;
  }): Promise<{
    dominioTenacidadeSessao: string | null;
    mutacaoTenacidadeImplantacaoPermitida: boolean;
  }> {
    let dominioTenacidadeSessao: string | null = null;
    try {
      const cfgs = await this.prisma.infotime_tenacidade_configuracao.findMany({
        where: { id_tenacidade: BigInt(user.tenantId) },
        orderBy: { id_tenacidade_configuracao: 'asc' },
        select: { dominio_tenacidade: true },
      });
      const cfg =
        cfgs.find((c) => (c.dominio_tenacidade ?? '').trim()) ?? cfgs[0];
      dominioTenacidadeSessao = cfg?.dominio_tenacidade?.trim() ?? null;
    } catch {
      dominioTenacidadeSessao = null;
    }
    const ehImpl = this.ehUsuarioTecnicoImplantacaoOuSuporte(user);
    const dom = (dominioTenacidadeSessao ?? '').toLowerCase();
    const mutacaoTenacidadeImplantacaoPermitida = !ehImpl || dom === 'liga.br';
    return { dominioTenacidadeSessao, mutacaoTenacidadeImplantacaoPermitida };
  }

  ehUsuarioTecnicoImplantacaoOuSuporte(user: {
    suporte: boolean;
    email?: string;
  }): boolean {
    if (!user.suporte) return false;
    const email = user.email?.trim().toLowerCase() ?? '';
    const local = email.split('@')[0]?.trim() ?? '';
    return local === 'implantacao' || local === 'suporte';
  }

  // ─── Helpers privados ────────────────────────────────────────────────────────

  /**
   * Licença SaaS (`infotime_tenacidade_configuracao.data_expiracao`): bloqueia login se vencida;
   * retorna aviso se faltar ≤10 dias (MCP login).
   */
  private avaliarLicencaTenant(
    dataExpiracao: Date | null | undefined,
  ): string | null {
    if (dataExpiracao == null) return null;
    const fim = new Date(dataExpiracao);
    const agora = new Date();
    const zerarHora = (dt: Date) =>
      new Date(dt.getFullYear(), dt.getMonth(), dt.getDate()).getTime();
    const tFim = zerarHora(fim);
    const tHoje = zerarHora(agora);
    if (tFim < tHoje) {
      throw new HttpException(
        {
          mensagem:
            'Licença do tenant expirada. Entre em contato com o financeiro para regularizar o acesso.',
        },
        HttpStatus.FORBIDDEN,
      );
    }
    const dias = Math.ceil((tFim - tHoje) / 86400000);
    if (dias <= 10) {
      return `Atenção: a licença deste tenant vence em ${dias} dia(s). Procure o financeiro antes do vencimento.`;
    }
    return null;
  }

  private async verificarLicenca(
    tx: Prisma.TransactionClient,
    idTenacidade: bigint,
    quantidadeLicenca: number | null | undefined,
  ): Promise<void> {
    if (!quantidadeLicenca) return; // sem limite configurado

    const sessoesAtivas = await tx.infotime_sessao_usuario.count({
      where: {
        id_tenacidade: idTenacidade,
        ativo: 'S',
        data_expiracao: { gt: new Date() },
      },
    });

    if (sessoesAtivas >= quantidadeLicenca) {
      throw new HttpException(
        { mensagem: 'Quantidade de licença indisponível' },
        HttpStatus.FORBIDDEN,
      );
    }
  }

  private resolverTimeout(
    configuracao: { timeout_sessao_minutos: number | null } | undefined,
  ): number {
    return configuracao?.timeout_sessao_minutos ?? 15;
  }

  private async criarSessaoNormal(
    usuario: {
      id_usuario: bigint;
      id_tenacidade: bigint | null;
      email?: string | null;
    },
    tenant: {
      id_tenacidade: bigint;
      chave_jwt: string | null;
      infotime_tenacidade_configuracao: {
        timeout_sessao_minutos: number | null;
        quantidade_licenca: number | null;
      }[];
    },
    req: Request,
    avisoLicenca: string | null = null,
  ): Promise<RespostaLogin> {
    const configuracao = tenant.infotime_tenacidade_configuracao[0];

    const timeoutMinutos = this.resolverTimeout(configuracao);

    const tokenId = uuidv4();
    const agora = new Date();
    const expiracao = new Date(agora.getTime() + timeoutMinutos * 60 * 1000);

    // RLS em infotime_sessao_usuario exige app.current_tenant_id na mesma transação (a transação do login já terminou).
    await this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenant.id_tenacidade);
      // Uma linha por (tenant, usuário) — @@unique. Novo login atualiza essa linha (upsert), não insere outra.
      await this.verificarLicenca(
        tx,
        tenant.id_tenacidade,
        configuracao?.quantidade_licenca,
      );
      await tx.infotime_sessao_usuario.upsert({
        where: {
          id_tenacidade_id_usuario: {
            id_tenacidade: tenant.id_tenacidade,
            id_usuario: usuario.id_usuario,
          },
        },
        create: {
          id_usuario: usuario.id_usuario,
          id_tenacidade: tenant.id_tenacidade,
          token_id: tokenId,
          data_criacao: agora,
          data_expiracao: expiracao,
          ativo: 'S',
          ip: this.extrairIp(req),
          dispositivo: req.headers['user-agent']?.slice(0, 255) ?? null,
          user_agent: req.headers['user-agent'] ?? null,
        },
        update: {
          token_id: tokenId,
          data_criacao: agora,
          data_expiracao: expiracao,
          ativo: 'S',
          ip: this.extrairIp(req),
          dispositivo: req.headers['user-agent']?.slice(0, 255) ?? null,
          user_agent: req.headers['user-agent'] ?? null,
        },
      });
    });

    const chaveJwt = await this.garantirChaveJwtTenant(tenant.id_tenacidade);

    const access_token = this.jwt.sign(
      {
        sub: usuario.id_usuario.toString(),
        tenantId: tenant.id_tenacidade.toString(),
        jti: tokenId,
        email: usuario.email ?? '',
      },
      { secret: chaveJwt, expiresIn: '24h' },
    );

    const refresh_token = this.jwt.sign(
      {
        sub: usuario.id_usuario.toString(),
        tenantId: tenant.id_tenacidade.toString(),
        jti: uuidv4(),
        tipo: 'refresh',
      },
      { secret: chaveJwt, expiresIn: '7d' },
    );

    return {
      access_token,
      refresh_token,
      ...(avisoLicenca ? { aviso_licenca_proxima_expiracao: avisoLicenca } : {}),
    };
  }

  /**
   * Garante `chave_jwt` na configuração canônica do tenant (gera uma vez se estiver NULL).
   * `COALESCE` evita sobrescrever em requisições concorrentes ao primeiro login.
   */
  private async garantirChaveJwtTenant(idTenacidade: bigint): Promise<string> {
    const candidata = gerarChaveJwtTenant();
    const linhas = await this.prisma.infotime_tenacidade_configuracao.findMany({
      where: { id_tenacidade: idTenacidade },
      orderBy: { id_tenacidade_configuracao: 'asc' },
      select: {
        id_tenacidade_configuracao: true,
        dominio_tenacidade: true,
      },
    });
    const alvo =
      linhas.find((c) => (c.dominio_tenacidade ?? '').trim()) ?? linhas[0];
    if (!alvo) {
      throw new InternalServerErrorException(
        'Não há configuração de tenacidade para gerar a chave JWT.',
      );
    }
    const rows = await this.prisma.$queryRaw<[{ chave_jwt: string | null }]>(
      Prisma.sql`
        UPDATE tenacidade_configuracao
        SET chave_jwt = COALESCE(chave_jwt, ${candidata})
        WHERE id_tenacidade_configuracao = ${alvo.id_tenacidade_configuracao}
        RETURNING chave_jwt
      `,
    );
    const chave = rows[0]?.chave_jwt ?? null;
    if (!chave) {
      throw new InternalServerErrorException(
        'Não foi possível obter a chave JWT do tenant.',
      );
    }
    return chave;
  }

  private extrairIp(req: Request): string {
    const forwarded = req.headers['x-forwarded-for'];
    if (typeof forwarded === 'string') return forwarded.split(',')[0].trim();
    return req.ip ?? '';
  }

  private validarCaptchaSeNecessario(ip: string, dto: DtoLoginUsuario): void {
    if (!this.captchaLogin.deveExigirCaptcha(ip)) return;
    const id = dto.captcha_id?.trim() ?? '';
    const resposta = dto.captcha_resposta?.trim() ?? '';
    if (
      !id ||
      !resposta ||
      !this.captchaLogin.validarDesafio(ip, id, resposta)
    ) {
      const captcha = this.captchaLogin.obterOuCriarDesafio(ip);
      throw new HttpException(
        {
          mensagem:
            'CAPTCHA obrigatorio apos multiplas tentativas de login sem sucesso.',
          captcha_obrigatorio: true,
          captcha,
        },
        HttpStatus.BAD_REQUEST,
      );
    }
  }

  private registrarFalhaCaptchaQuandoAplicavel(
    ip: string,
    erro: unknown,
  ): void {
    if (!(erro instanceof HttpException)) return;
    const status = erro.getStatus();
    // Contabiliza tentativas malsucedidas comuns de autenticação para ativar CAPTCHA.
    if (status === 401 || status === 404) {
      this.captchaLogin.registrarFalha(ip);
      if (this.captchaLogin.deveExigirCaptcha(ip)) {
        const captcha = this.captchaLogin.obterOuCriarDesafio(ip);
        throw new HttpException(
          {
            mensagem:
              'Muitas tentativas de login sem sucesso. Resolva o CAPTCHA para continuar.',
            captcha_obrigatorio: true,
            captcha,
          },
          status,
        );
      }
    }
  }
}
