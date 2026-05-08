import {
  BadRequestException,
  ConflictException,
  ForbiddenException,
  InternalServerErrorException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';
import * as bcrypt from 'bcrypt';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarUsuarioDto } from './dto/atualizar-usuario.dto';
import { CriarUsuarioDto } from './dto/criar-usuario.dto';
import { RespostaUsuarioDto } from './dto/resposta-usuario.dto';
import { RespostaListagemUsuarioDto } from './dto/resposta-listagem-usuario.dto';
import {
  MENSAGEM_SENHA_USUARIO_POLITICA_FORTE,
  senhaUsuarioAtendePoliticaForte,
} from '../comum/senha-usuario-politica';
import { TrocarSenhaUsuarioDto } from './dto/trocar-senha-usuario.dto';
import { GeradorSenhaDoDia } from '../autenticacao/gerador-senha-dia.service';

const IP_MAX = 20;
const APP = 'infotime-web';

const selectListagem = {
  id_usuario: true,
  nome: true,
  login: true,
  email: true,
  ativo: true,
} as const;

const selectResposta = {
  id_usuario: true,
  id_unidade: true,
  id_grupo_usuario: true,
  nome: true,
  login: true,
  email: true,
  telefone: true,
  celular: true,
  sexo: true,
  data_nascimento: true,
  ativo: true,
  cpf: true,
  cracha: true,
  identidade: true,
  cartao_nacional_saude: true,
  orgao_emissor: true,
  cep: true,
  tipo_logradouro: true,
  logradouro: true,
  numero: true,
  complemento: true,
  bairro: true,
  cidade: true,
  estado: true,
  codigo_ativacao: true,
  liberar_resultado: true,
  retirar_quarentena: true,
  motivo_bloqueio_impressao_resultado: true,
  lista_convenio_permitido: true,
  lista_unidade_permitido: true,
  codigo_externo: true,
  codigo_migracao: true,
  nome_arquivo_fotografia: true,
  nome_referencia_fotografia: true,
  nome_arquivo_assinatura: true,
  nome_referencia_assinatura: true,
  alertar_laudo_parcial: true,
  bloquear_impressao_laudo_parcial: true,
  alterar_resultado_liberado: true,
  visualizar_laudo_antes_liberacao: true,
  id_usuario_auditoria: true,
  endereco_ip_auditoria: true,
  nome_aplicacao_auditoria: true,
} as const;

@Injectable()
export class UsuarioService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'nome',
    'login',
    'email',
    'id',
    'ativo',
  ]);

  constructor(
    private readonly prisma: PrismaService,
    private readonly geradorSenha: GeradorSenhaDoDia,
  ) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_usuarioWhereInput {
    const q = qTexto.trim();
    if (campoPesquisa === 'nome') {
      return { nome: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'login') {
      return { login: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'email') {
      return { email: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_usuario: BigInt(q) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'ativo') {
      const u = q.trim().toUpperCase();
      const letra =
        u === 'S' || u.startsWith('SIM') || u.startsWith('ATIV')
          ? 'S'
          : u === 'N' || u.startsWith('NÃO') || u.startsWith('NAO') || u.startsWith('INAT')
            ? 'N'
            : null;
      if (letra != null) {
        return { ativo: letra };
      }
      return {};
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_usuarioWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome', 'login', 'email', 'ativo']);
    const partes: Prisma.infolab_usuarioWhereInput[] = [];

    for (const [campo, valBruto] of Object.entries(root)) {
      if (!permitidos.has(campo)) continue;
      if (
        valBruto === null ||
        typeof valBruto !== 'object' ||
        Array.isArray(valBruto)
      ) {
        continue;
      }
      const val = valBruto as Record<string, unknown>;
      const tipo = typeof val.tipo === 'string' ? val.tipo : '';

      if (
        (campo === 'nome' || campo === 'login' || campo === 'email') &&
        tipo === 'texto'
      ) {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        if (campo === 'nome') {
          partes.push({ nome: { contains: contem, mode: 'insensitive' } });
        }
        if (campo === 'login') {
          partes.push({ login: { contains: contem, mode: 'insensitive' } });
        }
        if (campo === 'email') {
          partes.push({ email: { contains: contem, mode: 'insensitive' } });
        }
        continue;
      }

      if (campo === 'ativo' && tipo === 'enum') {
        const vals = val['valores'];
        if (!Array.isArray(vals) || vals.length === 0) continue;
        const letras = vals.filter(
          (x): x is string => typeof x === 'string' && (x === 'S' || x === 'N'),
        );
        if (letras.length > 0) {
          partes.push({ ativo: { in: letras } });
        }
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemUsuarioDto[]; total: number }> {
    const baseWhere: Prisma.infolab_usuarioWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = { ...selectListagem };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 500,
      delegate: this.prisma.infolab_usuario,
      baseWhere,
      camposPesquisaWhitelist: UsuarioService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_usuario: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_usuario: bigint;
          nome: string | null;
          login: string | null;
          email: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_usuario.toString(),
          nome: r.nome ?? null,
          login: r.login ?? null,
          email: r.email ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_usuario.findMany({
          where: where as Prisma.infolab_usuarioWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaUsuarioDto }> {
    const registro = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: BigInt(id) },
      select: { ...selectResposta, id_tenacidade: true },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Usuário ${id} não encontrado.`);
    }
    const { id_tenacidade: _t, ...campos } = registro;
    void _t;
    return { dados: this.mapear(campos) };
  }

  async criar(
    dto: CriarUsuarioDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const loginNormalizado = dto.login?.trim().toLowerCase() || null;
    const senhaNormalizada = dto.senha?.trim() || null;
    if (
      senhaNormalizada &&
      !senhaUsuarioAtendePoliticaForte(senhaNormalizada)
    ) {
      throw new BadRequestException(MENSAGEM_SENHA_USUARIO_POLITICA_FORTE);
    }
    const senhaHash = senhaNormalizada
      ? await bcrypt.hash(senhaNormalizada, 10)
      : null;
    const idGrupo = await this.resolverIdGrupoUsuarioDoTenant(
      dto.idGrupoUsuario,
      tenantContexto.idTenacidade,
    );
    const idUnidade = this.parseIdNumericoOpcional(dto.idUnidade);
    try {
      const criado = await this.prisma.infolab_usuario.create({
        data: {
          id_tenacidade: tenantContexto.idTenacidade,
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          nome: dto.nome,
          login: loginNormalizado,
          email: dto.email ?? null,
          telefone: dto.telefone ?? null,
          celular: dto.celular ?? null,
          ...(idUnidade !== undefined && { id_unidade: idUnidade }),
          sexo: dto.sexo ?? null,
          data_nascimento: dto.data_nascimento ?? null,
          ativo: dto.ativo ?? null,
          cpf: dto.cpf ?? null,
          cracha: dto.cracha ?? null,
          identidade: dto.identidade ?? null,
          cartao_nacional_saude: dto.cartao_nacional_saude ?? null,
          orgao_emissor: dto.orgao_emissor ?? null,
          cep: dto.cep ?? null,
          tipo_logradouro: dto.tipo_logradouro ?? null,
          logradouro: dto.logradouro ?? null,
          numero: dto.numero ?? null,
          complemento: dto.complemento ?? null,
          bairro: dto.bairro ?? null,
          cidade: dto.cidade ?? null,
          estado: dto.estado ?? null,
          codigo_ativacao: dto.codigo_ativacao ?? null,
          liberar_resultado: dto.liberar_resultado ?? null,
          retirar_quarentena: dto.retirar_quarentena ?? null,
          motivo_bloqueio_impressao_resultado:
            dto.motivo_bloqueio_impressao_resultado ?? null,
          lista_convenio_permitido: dto.lista_convenio_permitido ?? null,
          lista_unidade_permitido: dto.lista_unidade_permitido ?? null,
          codigo_externo: dto.codigo_externo ?? null,
          codigo_migracao: dto.codigo_migracao ?? null,
          nome_arquivo_fotografia: dto.nome_arquivo_fotografia ?? null,
          nome_referencia_fotografia: dto.nome_referencia_fotografia ?? null,
          nome_arquivo_assinatura: dto.nome_arquivo_assinatura ?? null,
          nome_referencia_assinatura: dto.nome_referencia_assinatura ?? null,
          alertar_laudo_parcial: dto.alertar_laudo_parcial ?? null,
          bloquear_impressao_laudo_parcial:
            dto.bloquear_impressao_laudo_parcial ?? null,
          alterar_resultado_liberado: dto.alterar_resultado_liberado ?? null,
          visualizar_laudo_antes_liberacao:
            dto.visualizar_laudo_antes_liberacao ?? null,
          senha: senhaHash,
          ...(idGrupo !== undefined && { id_grupo_usuario: idGrupo }),
        },
        select: { id_usuario: true },
      });
      return { id: criado.id_usuario.toString() };
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Não foi possível criar: conflito de unicidade (login ou outro campo único).',
        );
      }
      throw e;
    }
  }

  async atualizar(
    id: string,
    dto: AtualizarUsuarioDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Usuário ${id} não encontrado.`);
    }
    const idGrupoAtualizado =
      dto.idGrupoUsuario !== undefined
        ? await this.resolverIdGrupoUsuarioDoTenant(
            dto.idGrupoUsuario,
            tenantContexto.idTenacidade,
          )
        : undefined;
    const idUnidadeAtualizada =
      dto.idUnidade !== undefined
        ? this.parseIdNumericoOpcional(dto.idUnidade)
        : undefined;
    try {
      await this.prisma.infolab_usuario.update({
        where: { id_usuario: BigInt(id) },
        data: {
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          ...(dto.nome !== undefined && { nome: dto.nome }),
          ...(dto.login !== undefined && {
            login: dto.login?.trim().toLowerCase() || null,
          }),
          ...(dto.email !== undefined && { email: dto.email }),
          ...(dto.telefone !== undefined && { telefone: dto.telefone }),
          ...(dto.celular !== undefined && { celular: dto.celular }),
          ...(idUnidadeAtualizada !== undefined && {
            id_unidade: idUnidadeAtualizada,
          }),
          ...(dto.sexo !== undefined && { sexo: dto.sexo }),
          ...(dto.data_nascimento !== undefined && {
            data_nascimento: dto.data_nascimento,
          }),
          ...(dto.ativo !== undefined && { ativo: dto.ativo }),
          ...(dto.cpf !== undefined && { cpf: dto.cpf }),
          ...(dto.cracha !== undefined && { cracha: dto.cracha }),
          ...(dto.identidade !== undefined && { identidade: dto.identidade }),
          ...(dto.cartao_nacional_saude !== undefined && {
            cartao_nacional_saude: dto.cartao_nacional_saude,
          }),
          ...(dto.orgao_emissor !== undefined && {
            orgao_emissor: dto.orgao_emissor,
          }),
          ...(dto.cep !== undefined && { cep: dto.cep }),
          ...(dto.tipo_logradouro !== undefined && {
            tipo_logradouro: dto.tipo_logradouro,
          }),
          ...(dto.logradouro !== undefined && { logradouro: dto.logradouro }),
          ...(dto.numero !== undefined && { numero: dto.numero }),
          ...(dto.complemento !== undefined && {
            complemento: dto.complemento,
          }),
          ...(dto.bairro !== undefined && { bairro: dto.bairro }),
          ...(dto.cidade !== undefined && { cidade: dto.cidade }),
          ...(dto.estado !== undefined && { estado: dto.estado }),
          ...(dto.codigo_ativacao !== undefined && {
            codigo_ativacao: dto.codigo_ativacao,
          }),
          ...(dto.liberar_resultado !== undefined && {
            liberar_resultado: dto.liberar_resultado,
          }),
          ...(dto.retirar_quarentena !== undefined && {
            retirar_quarentena: dto.retirar_quarentena,
          }),
          ...(dto.motivo_bloqueio_impressao_resultado !== undefined && {
            motivo_bloqueio_impressao_resultado:
              dto.motivo_bloqueio_impressao_resultado,
          }),
          ...(dto.lista_convenio_permitido !== undefined && {
            lista_convenio_permitido: dto.lista_convenio_permitido,
          }),
          ...(dto.lista_unidade_permitido !== undefined && {
            lista_unidade_permitido: dto.lista_unidade_permitido,
          }),
          ...(dto.codigo_externo !== undefined && {
            codigo_externo: dto.codigo_externo,
          }),
          ...(dto.codigo_migracao !== undefined && {
            codigo_migracao: dto.codigo_migracao,
          }),
          ...(dto.nome_arquivo_fotografia !== undefined && {
            nome_arquivo_fotografia: dto.nome_arquivo_fotografia,
          }),
          ...(dto.nome_referencia_fotografia !== undefined && {
            nome_referencia_fotografia: dto.nome_referencia_fotografia,
          }),
          ...(dto.nome_arquivo_assinatura !== undefined && {
            nome_arquivo_assinatura: dto.nome_arquivo_assinatura,
          }),
          ...(dto.nome_referencia_assinatura !== undefined && {
            nome_referencia_assinatura: dto.nome_referencia_assinatura,
          }),
          ...(dto.alertar_laudo_parcial !== undefined && {
            alertar_laudo_parcial: dto.alertar_laudo_parcial,
          }),
          ...(dto.bloquear_impressao_laudo_parcial !== undefined && {
            bloquear_impressao_laudo_parcial:
              dto.bloquear_impressao_laudo_parcial,
          }),
          ...(dto.alterar_resultado_liberado !== undefined && {
            alterar_resultado_liberado: dto.alterar_resultado_liberado,
          }),
          ...(dto.visualizar_laudo_antes_liberacao !== undefined && {
            visualizar_laudo_antes_liberacao:
              dto.visualizar_laudo_antes_liberacao,
          }),
          ...(idGrupoAtualizado !== undefined && {
            id_grupo_usuario: idGrupoAtualizado,
          }),
        },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Não foi possível atualizar: conflito de unicidade.',
        );
      }
      throw e;
    }
    return { id };
  }

  async trocarSenha(
    idAlvo: string,
    dto: TrocarSenhaUsuarioDto,
    tenantContexto: TenantContexto,
    ip: string,
    emailUsuarioLogado?: string,
  ): Promise<{ id: string }> {
    const senhaAtual = dto.senhaAtual?.trim();
    const senhaDia = dto.senhaDia?.trim();
    const novaSenha = dto.novaSenha.trim();
    if (!novaSenha) {
      throw new BadRequestException('Informe a nova senha.');
    }
    if (!senhaUsuarioAtendePoliticaForte(novaSenha)) {
      throw new BadRequestException(MENSAGEM_SENHA_USUARIO_POLITICA_FORTE);
    }
    const idAlvoBigInt = BigInt(idAlvo);
    const usuarioAlvo = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: idAlvoBigInt },
      select: { id_usuario: true, id_tenacidade: true },
    });
    if (
      !usuarioAlvo ||
      usuarioAlvo.id_tenacidade !== tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Usuário ${idAlvo} não encontrado.`);
    }

    const usuarioLogado = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: tenantContexto.idUsuario },
      select: {
        id_usuario: true,
        id_tenacidade: true,
        id_grupo_usuario: true,
        senha: true,
      },
    });
    const usuarioLogadoInvalido =
      !usuarioLogado ||
      (!tenantContexto.isSuporte &&
        usuarioLogado.id_tenacidade !== tenantContexto.idTenacidade);
    if (usuarioLogadoInvalido) {
      throw new NotFoundException('Usuário autenticado não encontrado.');
    }

    const alterandoOutroUsuario = usuarioLogado.id_usuario !== idAlvoBigInt;
    const ehAdmin =
      tenantContexto.isSuporte ||
      (await this.usuarioEhAdministrador(usuarioLogado.id_grupo_usuario));
    const loginLocal =
      (emailUsuarioLogado ?? '').split('@')[0]?.trim().toLowerCase() ?? '';
    const ehSuporteImplantacao =
      tenantContexto.isSuporte ||
      loginLocal === 'suporte' ||
      loginLocal === 'implantacao';

    if (alterandoOutroUsuario && !ehAdmin) {
      throw new ForbiddenException(
        'Apenas administrador pode alterar senha de outro usuário.',
      );
    }

    if (ehSuporteImplantacao) {
      if (!senhaDia) {
        throw new BadRequestException('Informe a senha do dia.');
      }
      if (!this.geradorSenha.validarSenhaDoDia(senhaDia)) {
        throw new BadRequestException('Senha do dia inválida.');
      }
    } else {
      if (!senhaAtual) {
        throw new BadRequestException('Informe a senha atual.');
      }
      const senhaValida = await bcrypt.compare(
        senhaAtual,
        usuarioLogado.senha ?? '',
      );
      if (!senhaValida) {
        throw new BadRequestException('Senha atual inválida.');
      }
    }

    const hashNovaSenha = await bcrypt.hash(novaSenha, 10);
    await this.prisma.infolab_usuario.update({
      where: { id_usuario: idAlvoBigInt },
      data: {
        senha: hashNovaSenha,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });

    const usuarioAtualizado = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: idAlvoBigInt },
      select: { senha: true },
    });
    const senhaPersistidaValida = await bcrypt.compare(
      novaSenha,
      usuarioAtualizado?.senha ?? '',
    );
    if (!senhaPersistidaValida) {
      throw new InternalServerErrorException(
        'Falha ao persistir senha corretamente. Tente novamente.',
      );
    }

    return { id: idAlvo };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_usuario.findUnique({
      where: { id_usuario: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Usuário ${id} não encontrado.`);
    }
    try {
      await this.prisma.infolab_usuario.delete({
        where: { id_usuario: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este usuário.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  /**
   * Resolve id de grupo de usuário no tenant; `undefined`/string vazia = sem alteração em create (omitido).
   * Para limpar perfil no update, o front pode enviar string vazia — tratar como null no update path.
   */
  private async resolverIdGrupoUsuarioDoTenant(
    idGrupoUsuario: string | undefined,
    idTenacidade: bigint,
  ): Promise<bigint | null | undefined> {
    if (idGrupoUsuario === undefined) return undefined;
    const s = idGrupoUsuario.trim();
    if (s === '') return null;
    const g = await this.prisma.infolab_grupo_usuario.findFirst({
      where: {
        id_grupo_usuario: BigInt(s),
        id_tenacidade: idTenacidade,
      },
      select: { id_grupo_usuario: true, descricao: true },
    });
    if (!g) {
      throw new BadRequestException(
        `Grupo de usuário ${s} não encontrado neste laboratório.`,
      );
    }
    return g.id_grupo_usuario;
  }

  private mapear(registro: {
    id_usuario: bigint;
    id_unidade: bigint | null;
    id_grupo_usuario: bigint | null;
    nome: string | null;
    login: string | null;
    email: string | null;
    telefone: string | null;
    celular: string | null;
    sexo: string | null;
    data_nascimento: Date | null;
    ativo: string | null;
    cpf: string | null;
    cracha: string | null;
    identidade: string | null;
    cartao_nacional_saude: string | null;
    orgao_emissor: string | null;
    cep: string | null;
    tipo_logradouro: string | null;
    logradouro: string | null;
    numero: string | null;
    complemento: string | null;
    bairro: string | null;
    cidade: string | null;
    estado: string | null;
    codigo_ativacao: string | null;
    liberar_resultado: string | null;
    retirar_quarentena: string | null;
    motivo_bloqueio_impressao_resultado: string | null;
    lista_convenio_permitido: string | null;
    lista_unidade_permitido: string | null;
    codigo_externo: string | null;
    codigo_migracao: string | null;
    nome_arquivo_fotografia: string | null;
    nome_referencia_fotografia: string | null;
    nome_arquivo_assinatura: string | null;
    nome_referencia_assinatura: string | null;
    alertar_laudo_parcial: string | null;
    bloquear_impressao_laudo_parcial: string | null;
    alterar_resultado_liberado: string | null;
    visualizar_laudo_antes_liberacao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaUsuarioDto {
    return {
      id: registro.id_usuario.toString(),
      idUnidade: registro.id_unidade?.toString() ?? null,
      idGrupoUsuario: registro.id_grupo_usuario?.toString() ?? null,
      nome: registro.nome ?? null,
      login: registro.login ?? null,
      email: registro.email ?? null,
      telefone: registro.telefone ?? null,
      celular: registro.celular ?? null,
      sexo: registro.sexo ?? null,
      data_nascimento: registro.data_nascimento
        ? registro.data_nascimento.toISOString().slice(0, 10)
        : null,
      ativo: registro.ativo ?? null,
      cpf: registro.cpf ?? null,
      cracha: registro.cracha ?? null,
      identidade: registro.identidade ?? null,
      cartao_nacional_saude: registro.cartao_nacional_saude ?? null,
      orgao_emissor: registro.orgao_emissor ?? null,
      cep: registro.cep ?? null,
      tipo_logradouro: registro.tipo_logradouro ?? null,
      logradouro: registro.logradouro ?? null,
      numero: registro.numero ?? null,
      complemento: registro.complemento ?? null,
      bairro: registro.bairro ?? null,
      cidade: registro.cidade ?? null,
      estado: registro.estado ?? null,
      codigo_ativacao: registro.codigo_ativacao ?? null,
      liberar_resultado: registro.liberar_resultado ?? null,
      retirar_quarentena: registro.retirar_quarentena ?? null,
      motivo_bloqueio_impressao_resultado:
        registro.motivo_bloqueio_impressao_resultado ?? null,
      lista_convenio_permitido: registro.lista_convenio_permitido ?? null,
      lista_unidade_permitido: registro.lista_unidade_permitido ?? null,
      codigo_externo: registro.codigo_externo ?? null,
      codigo_migracao: registro.codigo_migracao ?? null,
      nome_arquivo_fotografia: registro.nome_arquivo_fotografia ?? null,
      nome_referencia_fotografia: registro.nome_referencia_fotografia ?? null,
      nome_arquivo_assinatura: registro.nome_arquivo_assinatura ?? null,
      nome_referencia_assinatura: registro.nome_referencia_assinatura ?? null,
      alertar_laudo_parcial: registro.alertar_laudo_parcial ?? null,
      bloquear_impressao_laudo_parcial:
        registro.bloquear_impressao_laudo_parcial ?? null,
      alterar_resultado_liberado: registro.alterar_resultado_liberado ?? null,
      visualizar_laudo_antes_liberacao:
        registro.visualizar_laudo_antes_liberacao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }

  private parseIdNumericoOpcional(
    valor: string | undefined,
  ): bigint | null | undefined {
    if (valor === undefined) return undefined;
    const s = valor.trim();
    if (!s) return null;
    return BigInt(s);
  }

  private async usuarioEhAdministrador(
    idGrupoUsuario: bigint | null,
  ): Promise<boolean> {
    if (!idGrupoUsuario) return false;
    const regra = await this.prisma.infolab_usuario_permissoes.findFirst({
      where: {
        id_grupo_usuario: idGrupoUsuario,
        administrador: 'S',
      },
      select: { id_usuario_permissao: true },
    });
    return Boolean(regra);
  }
}
