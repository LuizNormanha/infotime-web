import {
  BadRequestException,
  ConflictException,
  ForbiddenException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import type {
  infolab_tenacidade,
  infolab_tenacidade_configuracao,
  infolab_usuario,
} from '@prisma/client';
import { Prisma } from '@prisma/client';

import { gerarChaveJwtTenant } from '../comum/gerar-chave-jwt-tenant';
import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { PrismaService } from '../prisma/prisma.service';
import { setCurrentTenantLocal } from '../prisma/set-current-tenant-local';
import {
  executarComRlsJaAplicadoNaTransacao,
  tenantRlsStorage,
} from '../prisma/tenant-rls.storage';

import { AtualizarTenacidadeImplantacaoDto } from './dto/atualizar-tenacidade-implantacao.dto';
import type { ConfiguracaoNoCorpoImplantacaoDto } from './dto/configuracao-no-corpo-implantacao.dto';
import { CriarTenacidadeImplantacaoDto } from './dto/criar-tenacidade-implantacao.dto';
import type {
  RespostaConfiguracaoTenacidadeImplantacaoDto,
  RespostaListagemTenacidadeImplantacaoDto,
  RespostaTenacidadeImplantacaoDto,
} from './dto/resposta-tenacidade-implantacao.dto';

const APP = 'infotime-web';

/** `ultimo_atendimento` inicial na criação da configuração (regra MCP tenacidade). */
const ULTIMO_ATENDIMENTO_INICIAL_CADASTRO = 1n;

type TenacidadeComUsuario = infolab_tenacidade & {
  infolab_usuario_infolab_tenacidade_id_usuario_auditoriaToinfolab_usuario: Pick<
    infolab_usuario,
    'nome' | 'login'
  > | null;
};

@Injectable()
export class ImplantacaoTenacidadeService {
  private static readonly CAMPOS_PESQUISA_LISTAGEM = new Set([
    'id',
    'razao_social',
    'nome_fantasia',
    'dominio_tenacidade',
    'ativo',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  /**
   * Linha de configuração com domínio (licença/login) ou, na falta, a de menor id.
   * Genérico para aceitar `select` parcial na listagem ou `include` completo no GET.
   */
  private configuracaoPrincipal<
    T extends Pick<
      infolab_tenacidade_configuracao,
      'id_tenacidade_configuracao' | 'dominio_tenacidade'
    >,
  >(linhas: T[]): T | null {
    if (!linhas.length) return null;
    const comDominio = linhas.find((c) => (c.dominio_tenacidade ?? '').trim());
    return comDominio ?? linhas[0] ?? null;
  }

  /**
   * Usuário implantacao/suporte com sessão no tenant cujo domínio canônico é `liga.br` pode listar
   * e abrir qualquer laboratório (regra de produto na API).
   */
  private async sessaoEhListagemGlobalLigaBr(
    tx: Prisma.TransactionClient,
    idTenacidadeSessao: bigint,
  ): Promise<boolean> {
    const linhas = await tx.infolab_tenacidade_configuracao.findMany({
      where: { id_tenacidade: idTenacidadeSessao },
      orderBy: { id_tenacidade_configuracao: 'asc' },
      select: {
        id_tenacidade_configuracao: true,
        dominio_tenacidade: true,
      },
    });
    const cfg = this.configuracaoPrincipal(linhas);
    return (cfg?.dominio_tenacidade ?? '').trim().toLowerCase() === 'liga.br';
  }

  private linhaPassaCampoPesquisaListagemImplantacao(
    row: RespostaListagemTenacidadeImplantacaoDto,
    campoPesquisa: string,
    qTexto: string,
  ): boolean {
    const q = qTexto.trim();
    if (!q) return true;
    if (campoPesquisa === 'id') {
      try {
        return row.id === BigInt(q).toString();
      } catch {
        return row.id.includes(q);
      }
    }
    const contem = (v: string | null | undefined) =>
      (v ?? '').toLowerCase().includes(q.toLowerCase());
    if (campoPesquisa === 'razao_social') return contem(row.razao_social);
    if (campoPesquisa === 'nome_fantasia') return contem(row.nome_fantasia);
    if (campoPesquisa === 'dominio_tenacidade')
      return contem(row.dominio_tenacidade);
    if (campoPesquisa === 'ativo') {
      const letra = q.slice(0, 1).toUpperCase();
      const a = (row.ativo ?? '').trim().toUpperCase();
      if (letra === 'S' || letra === 'N') return a === letra;
      return contem(row.ativo);
    }
    return true;
  }

  private aplicarFiltroRefinadoListagemImplantacao(
    linhas: RespostaListagemTenacidadeImplantacaoDto[],
    jsonBruto: string | undefined,
  ): RespostaListagemTenacidadeImplantacaoDto[] {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'razao_social',
      'nome_fantasia',
      'dominio_tenacidade',
      'ativo',
    ]);
    const partes: ((row: RespostaListagemTenacidadeImplantacaoDto) => boolean)[] =
      [];

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
        (campo === 'razao_social' ||
          campo === 'nome_fantasia' ||
          campo === 'dominio_tenacidade') &&
        tipo === 'texto'
      ) {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        const c = contem.toLowerCase();
        partes.push((row) => {
          const v =
            campo === 'razao_social'
              ? row.razao_social
              : campo === 'nome_fantasia'
                ? row.nome_fantasia
                : row.dominio_tenacidade;
          return (v ?? '').toLowerCase().includes(c);
        });
        continue;
      }

      if (campo === 'ativo' && tipo === 'enum') {
        const vals = val['valores'];
        if (!Array.isArray(vals) || vals.length === 0) continue;
        const letras = vals.filter(
          (x): x is string => typeof x === 'string' && (x === 'S' || x === 'N'),
        );
        if (letras.length > 0) {
          partes.push((row) => {
            const a = (row.ativo ?? '').trim().toUpperCase();
            return letras.includes(a);
          });
        }
      }
    }

    if (partes.length === 0) return linhas;
    return linhas.filter((row) => partes.every((p) => p(row)));
  }

  async listar(query?: QueryListagemCrudPadrao): Promise<{
    dados: RespostaListagemTenacidadeImplantacaoDto[];
    total: number;
  }> {
    const ctx = tenantRlsStorage.getStore();
    if (ctx?.tenantId == null) {
      throw new ForbiddenException(
        'Sessão sem tenant; não é possível listar laboratórios.',
      );
    }
    const idSessao = ctx.tenantId;

    const dadosCompletos = await this.prisma.$transaction(async (tx) => {
      return await executarComRlsJaAplicadoNaTransacao(async () => {
        await setCurrentTenantLocal(tx, idSessao);
        const podeGlobal = await this.sessaoEhListagemGlobalLigaBr(
          tx,
          idSessao,
        );

        const registrosTen = await tx.infolab_tenacidade.findMany({
          where: podeGlobal ? undefined : { id_tenacidade: idSessao },
          orderBy: { id_tenacidade: 'desc' },
          select: {
            id_tenacidade: true,
            ativo: true,
          },
        });

        const ids = registrosTen.map((r) => r.id_tenacidade);
        const todasCfg =
          ids.length === 0
            ? []
            : await tx.infolab_tenacidade_configuracao.findMany({
                where: { id_tenacidade: { in: ids } },
                orderBy: [
                  { id_tenacidade: 'asc' },
                  { id_tenacidade_configuracao: 'asc' },
                ],
                select: {
                  id_tenacidade: true,
                  id_tenacidade_configuracao: true,
                  razao_social: true,
                  nome_fantasia: true,
                  dominio_tenacidade: true,
                  data_expiracao: true,
                },
              });

        type LinhaCfgListagem = (typeof todasCfg)[number];
        const cfgPorTen = new Map<string, LinhaCfgListagem[]>();
        for (const c of todasCfg) {
          const k = c.id_tenacidade.toString();
          const arr = cfgPorTen.get(k) ?? [];
          arr.push(c);
          cfgPorTen.set(k, arr);
        }

        return registrosTen.map((r) => {
          const listaCfg = cfgPorTen.get(r.id_tenacidade.toString()) ?? [];
          const cfg = this.configuracaoPrincipal(listaCfg);
          return {
            id: r.id_tenacidade.toString(),
            razao_social: cfg?.razao_social ?? null,
            nome_fantasia: cfg?.nome_fantasia ?? null,
            dominio_tenacidade: cfg?.dominio_tenacidade ?? null,
            ativo: r.ativo ?? null,
            data_expiracao: cfg?.data_expiracao
              ? cfg.data_expiracao.toISOString().slice(0, 10)
              : null,
          };
        });
      });
    });

    if (!modoListagemCrudNovo(query)) {
      return { dados: dadosCompletos, total: dadosCompletos.length };
    }

    const cargaInicial = query?.cargaInicial?.trim();
    const qTexto = (query?.q ?? '').trim();
    if (cargaInicial === 'vazio' && qTexto === '') {
      return { dados: [], total: 0 };
    }

    let filtrados = dadosCompletos;
    const campoPesquisa = (query?.campoPesquisa ?? '').trim();
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!ImplantacaoTenacidadeService.CAMPOS_PESQUISA_LISTAGEM.has(campoPesquisa)) {
        throw new BadRequestException(
          `campoPesquisa inválido: ${campoPesquisa}`,
        );
      }
      filtrados = filtrados.filter((row) =>
        this.linhaPassaCampoPesquisaListagemImplantacao(
          row,
          campoPesquisa,
          qTexto,
        ),
      );
    }

    filtrados = this.aplicarFiltroRefinadoListagemImplantacao(
      filtrados,
      query?.filtroRefinado,
    );

    const total = filtrados.length;
    const { pagina, tamanhoPagina } = parsePaginaETamanhoPagina(query);
    return {
      dados: filtrados.slice(
        pagina * tamanhoPagina,
        pagina * tamanhoPagina + tamanhoPagina,
      ),
      total,
    };
  }

  async buscarPorId(
    id: string,
  ): Promise<{ dados: RespostaTenacidadeImplantacaoDto }> {
    const ctx = tenantRlsStorage.getStore();
    if (ctx?.tenantId == null) {
      throw new ForbiddenException(
        'Sessão sem tenant; não é possível consultar o laboratório.',
      );
    }
    const idSessao = ctx.tenantId;
    const idTen = BigInt(id);

    return await this.prisma.$transaction(async (tx) => {
      return await executarComRlsJaAplicadoNaTransacao(async () => {
        await setCurrentTenantLocal(tx, idSessao);
        const podeGlobal = await this.sessaoEhListagemGlobalLigaBr(
          tx,
          idSessao,
        );
        if (!podeGlobal && idTen !== idSessao) {
          throw new NotFoundException(`Tenacidade ${id} não encontrada.`);
        }

        const registro = await tx.infolab_tenacidade.findUnique({
          where: { id_tenacidade: idTen },
          include: {
            infolab_usuario_infolab_tenacidade_id_usuario_auditoriaToinfolab_usuario:
              {
                select: { nome: true, login: true },
              },
          },
        });

        if (!registro) {
          throw new NotFoundException(`Tenacidade ${id} não encontrada.`);
        }

        const linhasCfg = await tx.infolab_tenacidade_configuracao.findMany({
          where: { id_tenacidade: idTen },
          orderBy: { id_tenacidade_configuracao: 'asc' },
        });

        const row = registro as TenacidadeComUsuario;
        const cfg = this.configuracaoPrincipal(linhasCfg);

        return {
          dados: {
            id: row.id_tenacidade.toString(),
            ativo: row.ativo ?? null,
            id_usuario_auditoria: row.id_usuario_auditoria?.toString() ?? null,
            usuario_auditoria: this.formatarUsuarioAuditoria(
              row.infolab_usuario_infolab_tenacidade_id_usuario_auditoriaToinfolab_usuario,
              row.id_usuario_auditoria,
            ),
            endereco_ip_auditoria: row.endereco_ip_auditoria ?? null,
            nome_aplicacao_auditoria: row.nome_aplicacao_auditoria ?? null,
            configuracao: this.mapearConfiguracaoRespostaAninhada(
              cfg,
              row.id_tenacidade.toString(),
            ),
          },
        };
      });
    });
  }

  async criar(
    dto: CriarTenacidadeImplantacaoDto,
    idUsuario: bigint,
    ip: string,
    idTenacidadeSessao: bigint,
  ): Promise<{ id: string }> {
    await this.assertSessaoPermiteMutacaoTenacidadeImplantacao(
      idTenacidadeSessao,
    );
    this.validarCriacaoNegocio(dto);
    const ipAud = ip.slice(0, 20);

    try {
      const idNovo = await this.prisma.$transaction(async (tx) => {
        // Toda a mutação no mesmo `tx` e com `executarComRlsJaAplicadoNaTransacao` desde o primeiro
        // `create`: senão a extensão Prisma (tenant RLS) abre um `$transaction` interno só para
        // `infolab_tenacidade.create`, comita em outra conexão e deixa a tenacidade órfã se o
        // `infolab_tenacidade_configuracao.create` falhar ou não enxergar o mesmo contexto.
        return await executarComRlsJaAplicadoNaTransacao(async () => {
          await setCurrentTenantLocal(tx, idTenacidadeSessao);
          const criado = await tx.infolab_tenacidade.create({
            data: {
              infolab_usuario_infolab_tenacidade_id_usuario_auditoriaToinfolab_usuario:
                {
                  connect: { id_usuario: idUsuario },
                },
              endereco_ip_auditoria: ipAud,
              nome_aplicacao_auditoria: 'infotime-web',
              ativo: dto.ativo?.trim() ? dto.ativo : 'S',
            },
            select: { id_tenacidade: true },
          });

          const idTen = criado.id_tenacidade;
          await setCurrentTenantLocal(tx, idTen);
          // FK explícita (`id_tenacidade`) no create da config (UncheckedCreateInput).
          await tx.infolab_tenacidade_configuracao.create({
            data: {
              ...this.montarCreateConfiguracao(
                dto.configuracao,
                idTen,
                ipAud,
                'id_tenacidade',
              ),
              razao_social: dto.configuracao.razao_social?.trim() ?? null,
              nome_fantasia: dto.configuracao.nome_fantasia?.trim() ?? null,
              chave_acesso: dto.configuracao.chave_acesso?.trim() ?? null,
              data_expiracao: dto.configuracao.data_expiracao
                ? new Date(dto.configuracao.data_expiracao)
                : null,
              ultimo_ano: BigInt(new Date().getFullYear()),
              ultimo_atendimento: ULTIMO_ATENDIMENTO_INICIAL_CADASTRO,
              dominio_tenacidade:
                dto.configuracao.dominio_tenacidade?.trim() ?? null,
              chave_jwt: gerarChaveJwtTenant(),
            },
          });

          return idTen;
        });
      });

      return { id: idNovo.toString() };
    } catch (e) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Domínio ou outro campo único já cadastrado.',
        );
      }
      throw e;
    }
  }

  async atualizar(
    id: string,
    dto: AtualizarTenacidadeImplantacaoDto,
    idUsuario: bigint,
    ip: string,
    idTenacidadeSessao: bigint,
  ): Promise<{ id: string }> {
    await this.assertSessaoPermiteMutacaoTenacidadeImplantacao(
      idTenacidadeSessao,
    );
    const ipAud = ip.slice(0, 20);

    try {
      await this.prisma.$transaction(async (tx) => {
        const idTen = BigInt(id);
        await setCurrentTenantLocal(tx, idTen);
        await executarComRlsJaAplicadoNaTransacao(async () => {
          const existente = await tx.infolab_tenacidade.findUnique({
            where: { id_tenacidade: idTen },
            include: {
              infolab_tenacidade_configuracao: {
                orderBy: { id_tenacidade_configuracao: 'asc' },
              },
            },
          });

          if (!existente) {
            throw new NotFoundException(`Tenacidade ${id} não encontrada.`);
          }

          const cfgPrincipal = this.configuracaoPrincipal(
            existente.infolab_tenacidade_configuracao,
          );
          const dominioAtual = (cfgPrincipal?.dominio_tenacidade ?? '').trim();
          const corpoCfg = dto.configuracao;

          if (
            corpoCfg?.dominio_tenacidade !== undefined &&
            corpoCfg.dominio_tenacidade !== null &&
            dominioAtual !== String(corpoCfg.dominio_tenacidade).trim()
          ) {
            throw new BadRequestException(
              'O domínio da tenacidade não pode ser alterado após a criação.',
            );
          }

          const dataTen: Prisma.infolab_tenacidadeUpdateInput = {
            infolab_usuario_infolab_tenacidade_id_usuario_auditoriaToinfolab_usuario:
              {
                connect: { id_usuario: idUsuario },
              },
            endereco_ip_auditoria: ipAud,
            nome_aplicacao_auditoria: 'infotime-web',
          };

          if (dto.ativo !== undefined) dataTen.ativo = dto.ativo;

          await tx.infolab_tenacidade.update({
            where: { id_tenacidade: idTen },
            data: dataTen,
          });

          this.rejeitarAlteracaoContadoresTenacidade(corpoCfg);

          const precisaPatchLicenca =
            !!corpoCfg &&
            (corpoCfg.razao_social !== undefined ||
              corpoCfg.nome_fantasia !== undefined ||
              corpoCfg.chave_acesso !== undefined ||
              corpoCfg.data_expiracao !== undefined);

          if (corpoCfg !== undefined || precisaPatchLicenca) {
            const cfgExistente =
              await tx.infolab_tenacidade_configuracao.findFirst({
                where: { id_tenacidade: idTen },
                orderBy: { id_tenacidade_configuracao: 'asc' },
                select: { id_tenacidade_configuracao: true },
              });

            if (!cfgExistente) {
              if (!corpoCfg) {
                throw new BadRequestException(
                  'É necessário enviar a configuração do laboratório (domínio, licença e parâmetros) para criar o registro de configuração da tenacidade.',
                );
              }
              const baseCfg = this.montarCreateConfiguracao(
                corpoCfg,
                idTen,
                ipAud,
                'id_tenacidade',
              );
              await tx.infolab_tenacidade_configuracao.create({
                data: {
                  ...baseCfg,
                  razao_social: corpoCfg.razao_social?.trim() ?? null,
                  nome_fantasia: corpoCfg.nome_fantasia?.trim() ?? null,
                  chave_acesso: corpoCfg.chave_acesso?.trim() ?? null,
                  data_expiracao: corpoCfg.data_expiracao
                    ? new Date(corpoCfg.data_expiracao)
                    : null,
                  ultimo_ano: BigInt(new Date().getFullYear()),
                  ultimo_atendimento: ULTIMO_ATENDIMENTO_INICIAL_CADASTRO,
                  dominio_tenacidade:
                    corpoCfg.dominio_tenacidade?.trim() ?? null,
                  chave_jwt: gerarChaveJwtTenant(),
                },
              });
            } else {
              const patchCfg: Prisma.infolab_tenacidade_configuracaoUpdateInput =
                corpoCfg !== undefined
                  ? this.montarPatchConfiguracao(corpoCfg, ipAud)
                  : {
                      endereco_ip_auditoria: ipAud,
                      nome_aplicacao_auditoria: APP.slice(0, 20),
                    };

              if (corpoCfg) {
                if (corpoCfg.razao_social !== undefined)
                  patchCfg.razao_social = corpoCfg.razao_social;
                if (corpoCfg.nome_fantasia !== undefined)
                  patchCfg.nome_fantasia = corpoCfg.nome_fantasia;
                if (corpoCfg.chave_acesso !== undefined)
                  patchCfg.chave_acesso = corpoCfg.chave_acesso;
                if (corpoCfg.data_expiracao !== undefined) {
                  patchCfg.data_expiracao = corpoCfg.data_expiracao
                    ? new Date(corpoCfg.data_expiracao)
                    : null;
                }
              }

              if (Object.keys(patchCfg).length > 0) {
                await tx.infolab_tenacidade_configuracao.update({
                  where: {
                    id_tenacidade_configuracao:
                      cfgExistente.id_tenacidade_configuracao,
                  },
                  data: patchCfg,
                });
              }
            }
          }
        });
      });

      return { id };
    } catch (e) {
      if (e instanceof NotFoundException || e instanceof BadRequestException) {
        throw e;
      }
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Domínio ou outro campo único já cadastrado.',
        );
      }
      throw e;
    }
  }

  excluir(_id: string): Promise<{ ok: boolean }> {
    void _id;
    return Promise.reject(
      new ForbiddenException(
        'Exclusão de tenacidade não é permitida (regra de negócio).',
      ),
    );
  }

  /**
   * Regra operacional: mutações em `implantacao-tenacidades` só com sessão no tenant
   * cujo domínio é `liga.br` (evita gravação parcial e violação de RLS em outro tenant).
   */
  private async assertSessaoPermiteMutacaoTenacidadeImplantacao(
    idTenacidadeSessao: bigint,
  ): Promise<void> {
    const linhas = await this.prisma.infolab_tenacidade_configuracao.findMany({
      where: { id_tenacidade: idTenacidadeSessao },
      orderBy: { id_tenacidade_configuracao: 'asc' },
    });
    const cfg = this.configuracaoPrincipal(linhas);
    const dom = (cfg?.dominio_tenacidade ?? '').trim().toLowerCase();
    if (dom !== 'liga.br') {
      throw new ForbiddenException(
        'Criar ou alterar laboratórios (tenacidades) só é permitido com sessão no ambiente da Liga (domínio liga.br). Acesse pelo tenant da Liga ou faça login com um laboratório cujo domínio seja liga.br.',
      );
    }
  }

  /**
   * Contadores `ultimo_ano` / `ultimo_atendimento` são definidos só na criação (MCP tenacidade);
   * não aceitar no corpo de atualização.
   */
  private rejeitarAlteracaoContadoresTenacidade(
    corpo: object | undefined,
  ): void {
    if (!corpo) return;
    const c = corpo as Record<string, unknown>;
    if (c.ultimo_ano !== undefined) {
      throw new BadRequestException(
        'O campo último ano não pode ser alterado pelo cadastro da tenacidade.',
      );
    }
    if (c.ultimo_atendimento !== undefined) {
      throw new BadRequestException(
        'O campo último atendimento não pode ser alterado pelo cadastro da tenacidade.',
      );
    }
  }

  private validarCriacaoNegocio(dto: CriarTenacidadeImplantacaoDto): void {
    const c = dto.configuracao;
    if (!c.dominio_tenacidade?.trim()) {
      throw new BadRequestException('Domínio da tenacidade é obrigatório.');
    }
    if (!c.data_expiracao?.trim()) {
      throw new BadRequestException('Data de expiração inicial é obrigatória.');
    }
    const lic = c.quantidade_licenca;
    if (lic === undefined || lic === null || Number(lic) < 1) {
      throw new BadRequestException(
        'Informe o limite de licenças (usuários simultâneos) na configuração.',
      );
    }
  }

  private montarCreateConfiguracao(
    cfg: ConfiguracaoNoCorpoImplantacaoDto | undefined,
    idTenacidade: bigint,
    ipAud: string,
    vinculoTenacidade: 'connect' | 'id_tenacidade' = 'connect',
  ):
    | Prisma.infolab_tenacidade_configuracaoCreateInput
    | Prisma.infolab_tenacidade_configuracaoUncheckedCreateInput {
    const c = cfg ?? {};
    const comum = {
      endereco_ip_auditoria: ipAud,
      nome_aplicacao_auditoria: APP.slice(0, 20),
      infolab_vet: c.infolab_vet ?? null,
      somente_interfaceamento: c.somente_interfaceamento ?? null,
      utilizar_numeracao_origem_liberacao:
        c.utilizar_numeracao_origem_liberacao ?? null,
      utilizar_deltacheck_liberacao: c.utilizar_deltacheck_liberacao ?? null,
      liberar_resultado_interfaceado_baixado:
        c.liberar_resultado_interfaceado_baixado ?? null,
      capturar_versao_exame_apoio: c.capturar_versao_exame_apoio ?? null,
      diretorio_exportacao_resultado: c.diretorio_exportacao_resultado ?? null,
      diretorio_triagem_amostra: c.diretorio_triagem_amostra ?? null,
      mensagem_exame_repetido: c.mensagem_exame_repetido ?? null,
      liberar_resultado_informado: c.liberar_resultado_informado ?? null,
      lista_setor_libera_informado: c.lista_setor_libera_informado ?? null,
      endpoint_pedido: c.endpoint_pedido ?? null,
      endpoint_chatbot: c.endpoint_chatbot ?? null,
      timeout_sessao_minutos: c.timeout_sessao_minutos ?? 15,
      quantidade_licenca: c.quantidade_licenca ?? null,
    };
    if (vinculoTenacidade === 'id_tenacidade') {
      return {
        id_tenacidade: idTenacidade,
        ...comum,
      };
    }
    return {
      infolab_tenacidade: { connect: { id_tenacidade: idTenacidade } },
      ...comum,
    };
  }

  private montarPatchConfiguracao(
    cfg: ConfiguracaoNoCorpoImplantacaoDto,
    ipAud: string,
  ): Prisma.infolab_tenacidade_configuracaoUpdateInput {
    const data: Prisma.infolab_tenacidade_configuracaoUpdateInput = {
      endereco_ip_auditoria: ipAud,
      nome_aplicacao_auditoria: APP.slice(0, 20),
    };
    if (cfg.infolab_vet !== undefined) data.infolab_vet = cfg.infolab_vet;
    if (cfg.somente_interfaceamento !== undefined) {
      data.somente_interfaceamento = cfg.somente_interfaceamento;
    }
    if (cfg.utilizar_numeracao_origem_liberacao !== undefined) {
      data.utilizar_numeracao_origem_liberacao =
        cfg.utilizar_numeracao_origem_liberacao;
    }
    if (cfg.utilizar_deltacheck_liberacao !== undefined) {
      data.utilizar_deltacheck_liberacao = cfg.utilizar_deltacheck_liberacao;
    }
    if (cfg.liberar_resultado_interfaceado_baixado !== undefined) {
      data.liberar_resultado_interfaceado_baixado =
        cfg.liberar_resultado_interfaceado_baixado;
    }
    if (cfg.capturar_versao_exame_apoio !== undefined) {
      data.capturar_versao_exame_apoio = cfg.capturar_versao_exame_apoio;
    }
    if (cfg.diretorio_exportacao_resultado !== undefined) {
      data.diretorio_exportacao_resultado = cfg.diretorio_exportacao_resultado;
    }
    if (cfg.diretorio_triagem_amostra !== undefined) {
      data.diretorio_triagem_amostra = cfg.diretorio_triagem_amostra;
    }
    if (cfg.mensagem_exame_repetido !== undefined) {
      data.mensagem_exame_repetido = cfg.mensagem_exame_repetido;
    }
    if (cfg.liberar_resultado_informado !== undefined) {
      data.liberar_resultado_informado = cfg.liberar_resultado_informado;
    }
    if (cfg.lista_setor_libera_informado !== undefined) {
      data.lista_setor_libera_informado = cfg.lista_setor_libera_informado;
    }
    if (cfg.endpoint_pedido !== undefined) {
      data.endpoint_pedido = cfg.endpoint_pedido;
    }
    if (cfg.endpoint_chatbot !== undefined) {
      data.endpoint_chatbot = cfg.endpoint_chatbot;
    }
    if (cfg.timeout_sessao_minutos !== undefined) {
      data.timeout_sessao_minutos = cfg.timeout_sessao_minutos;
    }
    if (cfg.quantidade_licenca !== undefined) {
      data.quantidade_licenca = cfg.quantidade_licenca;
    }
    return data;
  }

  private mapearConfiguracaoPlana(
    row: infolab_tenacidade_configuracao | null,
    idTenacidadeStr: string,
  ): Record<string, string | number | boolean | null> {
    if (!row) {
      return {
        id_configuracao: '',
        id_tenacidade: idTenacidadeStr,
        infolab_vet: false,
        somente_interfaceamento: false,
        utilizar_numeracao_origem_liberacao: false,
        utilizar_deltacheck_liberacao: false,
        liberar_resultado_interfaceado_baixado: false,
        capturar_versao_exame_apoio: false,
        liberar_resultado_informado: false,
        diretorio_exportacao_resultado: null,
        diretorio_triagem_amostra: null,
        mensagem_exame_repetido: null,
        lista_setor_libera_informado: null,
        endpoint_pedido: null,
        endpoint_chatbot: null,
        timeout_sessao_minutos: 15,
        quantidade_licenca: null,
        config_endereco_ip_auditoria: null,
        config_nome_aplicacao_auditoria: null,
      };
    }
    const sn = (v: string | null | undefined) => v === 'S' || v === 's';
    return {
      id_configuracao: row.id_tenacidade_configuracao.toString(),
      id_tenacidade: idTenacidadeStr,
      infolab_vet: sn(row.infolab_vet),
      somente_interfaceamento: sn(row.somente_interfaceamento),
      utilizar_numeracao_origem_liberacao: sn(
        row.utilizar_numeracao_origem_liberacao,
      ),
      utilizar_deltacheck_liberacao: sn(row.utilizar_deltacheck_liberacao),
      liberar_resultado_interfaceado_baixado: sn(
        row.liberar_resultado_interfaceado_baixado,
      ),
      capturar_versao_exame_apoio: sn(row.capturar_versao_exame_apoio),
      liberar_resultado_informado: sn(row.liberar_resultado_informado),
      diretorio_exportacao_resultado:
        row.diretorio_exportacao_resultado ?? null,
      diretorio_triagem_amostra: row.diretorio_triagem_amostra ?? null,
      mensagem_exame_repetido: row.mensagem_exame_repetido ?? null,
      lista_setor_libera_informado: row.lista_setor_libera_informado ?? null,
      endpoint_pedido: row.endpoint_pedido ?? null,
      endpoint_chatbot: row.endpoint_chatbot ?? null,
      timeout_sessao_minutos: row.timeout_sessao_minutos ?? 15,
      quantidade_licenca: row.quantidade_licenca ?? null,
      config_endereco_ip_auditoria: row.endereco_ip_auditoria ?? null,
      config_nome_aplicacao_auditoria: row.nome_aplicacao_auditoria ?? null,
    };
  }

  private formatarUsuarioAuditoria(
    u: Pick<infolab_usuario, 'nome' | 'login'> | null | undefined,
    idUsuario: bigint | null,
  ): string | null {
    if (!u && idUsuario == null) return null;
    if (!u) return idUsuario?.toString() ?? null;
    const partes = [u.nome, u.login].filter((s): s is string =>
      Boolean(s?.trim()),
    );
    if (partes.length > 0) return partes.join(' · ');
    return idUsuario?.toString() ?? null;
  }

  private mapearConfiguracaoRespostaAninhada(
    cfg: infolab_tenacidade_configuracao | null,
    idTenacidadeStr: string,
  ): RespostaConfiguracaoTenacidadeImplantacaoDto {
    const base = this.mapearConfiguracaoPlana(cfg, idTenacidadeStr);
    return {
      ...base,
      razao_social: cfg?.razao_social ?? null,
      nome_fantasia: cfg?.nome_fantasia ?? null,
      chave_acesso: cfg?.chave_acesso ?? null,
      data_expiracao: cfg?.data_expiracao
        ? cfg.data_expiracao.toISOString().slice(0, 10)
        : null,
      ultimo_ano: cfg?.ultimo_ano?.toString() ?? null,
      ultimo_atendimento: cfg?.ultimo_atendimento?.toString() ?? null,
      dominio_tenacidade: cfg?.dominio_tenacidade ?? null,
      chave_jwt: cfg?.chave_jwt ?? null,
    } as RespostaConfiguracaoTenacidadeImplantacaoDto;
  }
}
