import {
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import type { infolab_tenacidade_configuracao } from '@prisma/client';
import { Prisma } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarTenacidadeConfiguracaoDto } from './dto/atualizar-tenacidade-configuracao.dto';
import { CriarTenacidadeConfiguracaoDto } from './dto/criar-tenacidade-configuracao.dto';

export type RespostaTenacidadeConfiguracaoDto = {
  id: string;
  id_tenacidade: string;
  infolab_vet: string | null;
  somente_interfaceamento: string | null;
  utilizar_numeracao_origem_liberacao: string | null;
  utilizar_deltacheck_liberacao: string | null;
  liberar_resultado_interfaceado_baixado: string | null;
  capturar_versao_exame_apoio: string | null;
  diretorio_exportacao_resultado: string | null;
  diretorio_triagem_amostra: string | null;
  mensagem_exame_repetido: string | null;
  liberar_resultado_informado: string | null;
  lista_setor_libera_informado: string | null;
  endpoint_pedido: string | null;
  endpoint_chatbot: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
  timeout_sessao_minutos: number | null;
  quantidade_licenca: number | null;
};

const APP = 'infotime-web';

@Injectable()
export class TenacidadeConfiguracaoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'diretorio_exportacao_resultado',
    'id_tenacidade',
    'timeout_sessao_minutos',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tenacidade_configuracaoWhereInput {
    if (campoPesquisa === 'diretorio_exportacao_resultado') {
      return {
        diretorio_exportacao_resultado: {
          contains: qTexto,
          mode: 'insensitive',
        },
      };
    }
    if (campoPesquisa === 'id_tenacidade') {
      try {
        return { id_tenacidade: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'timeout_sessao_minutos') {
      const n = parseInt(qTexto.trim(), 10);
      if (!Number.isFinite(n)) return {};
      return { timeout_sessao_minutos: n };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tenacidade_configuracao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tenacidade_configuracaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['diretorio_exportacao_resultado']);
    const partes: Prisma.infolab_tenacidade_configuracaoWhereInput[] = [];

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
      if (campo === 'diretorio_exportacao_resultado' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            diretorio_exportacao_resultado: {
              contains: contem,
              mode: 'insensitive',
            },
          });
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
  ): Promise<{
    dados: {
      id: string;
      id_tenacidade: string;
      timeout_sessao_minutos: number | null;
      quantidade_licenca: number | null;
      diretorio_exportacao_resultado: string | null;
    }[];
    total: number;
  }> {
    const baseWhere: Prisma.infolab_tenacidade_configuracaoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_tenacidade_configuracao: true,
      id_tenacidade: true,
      timeout_sessao_minutos: true,
      quantidade_licenca: true,
      diretorio_exportacao_resultado: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 500,
      delegate: this.prisma.infolab_tenacidade_configuracao,
      baseWhere,
      camposPesquisaWhitelist: TenacidadeConfiguracaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_tenacidade_configuracao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tenacidade_configuracao: bigint;
          id_tenacidade: bigint;
          timeout_sessao_minutos: number | null;
          quantidade_licenca: number | null;
          diretorio_exportacao_resultado: string | null;
        };
        return {
          id: r.id_tenacidade_configuracao.toString(),
          id_tenacidade: r.id_tenacidade.toString(),
          timeout_sessao_minutos: r.timeout_sessao_minutos ?? null,
          quantidade_licenca: r.quantidade_licenca ?? null,
          diretorio_exportacao_resultado:
            r.diretorio_exportacao_resultado ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tenacidade_configuracao.findMany({
          where: where as Prisma.infolab_tenacidade_configuracaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTenacidadeConfiguracaoDto }> {
    const registro = await this.prisma.infolab_tenacidade_configuracao.findUnique(
      {
        where: { id_tenacidade_configuracao: BigInt(id) },
      },
    );

    if (
      !registro ||
      registro.id_tenacidade !== tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Configuração ${id} não encontrada.`);
    }

    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarTenacidadeConfiguracaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tenacidade_configuracao.findFirst(
      {
        where: { id_tenacidade: tenantContexto.idTenacidade },
        select: { id_tenacidade_configuracao: true },
      },
    );
    if (existente) {
      throw new ConflictException(
        'Já existe configuração para este laboratório. Edite o registro existente.',
      );
    }

    const ipAud = ip.slice(0, 20);

    const criado = await this.prisma.infolab_tenacidade_configuracao.create({
      data: this.montarCreate(dto, tenantContexto.idTenacidade, ipAud),
      select: { id_tenacidade_configuracao: true },
    });

    return { id: criado.id_tenacidade_configuracao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTenacidadeConfiguracaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const ipAud = ip.slice(0, 20);

    const existente = await this.prisma.infolab_tenacidade_configuracao.findUnique(
      {
        where: { id_tenacidade_configuracao: BigInt(id) },
        select: { id_tenacidade: true },
      },
    );

    if (
      !existente ||
      existente.id_tenacidade !== tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Configuração ${id} não encontrada.`);
    }

    const data: Prisma.infolab_tenacidade_configuracaoUpdateInput = {
      endereco_ip_auditoria: ipAud,
      nome_aplicacao_auditoria: APP.slice(0, 20),
    };

    if (dto.infolab_vet !== undefined) data.infolab_vet = dto.infolab_vet;
    if (dto.somente_interfaceamento !== undefined) {
      data.somente_interfaceamento = dto.somente_interfaceamento;
    }
    if (dto.utilizar_numeracao_origem_liberacao !== undefined) {
      data.utilizar_numeracao_origem_liberacao =
        dto.utilizar_numeracao_origem_liberacao;
    }
    if (dto.utilizar_deltacheck_liberacao !== undefined) {
      data.utilizar_deltacheck_liberacao = dto.utilizar_deltacheck_liberacao;
    }
    if (dto.liberar_resultado_interfaceado_baixado !== undefined) {
      data.liberar_resultado_interfaceado_baixado =
        dto.liberar_resultado_interfaceado_baixado;
    }
    if (dto.capturar_versao_exame_apoio !== undefined) {
      data.capturar_versao_exame_apoio = dto.capturar_versao_exame_apoio;
    }
    if (dto.diretorio_exportacao_resultado !== undefined) {
      data.diretorio_exportacao_resultado = dto.diretorio_exportacao_resultado;
    }
    if (dto.diretorio_triagem_amostra !== undefined) {
      data.diretorio_triagem_amostra = dto.diretorio_triagem_amostra;
    }
    if (dto.mensagem_exame_repetido !== undefined) {
      data.mensagem_exame_repetido = dto.mensagem_exame_repetido;
    }
    if (dto.liberar_resultado_informado !== undefined) {
      data.liberar_resultado_informado = dto.liberar_resultado_informado;
    }
    if (dto.lista_setor_libera_informado !== undefined) {
      data.lista_setor_libera_informado = dto.lista_setor_libera_informado;
    }
    if (dto.endpoint_pedido !== undefined) {
      data.endpoint_pedido = dto.endpoint_pedido;
    }
    if (dto.endpoint_chatbot !== undefined) {
      data.endpoint_chatbot = dto.endpoint_chatbot;
    }
    if (dto.timeout_sessao_minutos !== undefined) {
      data.timeout_sessao_minutos = dto.timeout_sessao_minutos;
    }
    if (dto.quantidade_licenca !== undefined) {
      data.quantidade_licenca = dto.quantidade_licenca;
    }

    await this.prisma.infolab_tenacidade_configuracao.update({
      where: { id_tenacidade_configuracao: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_tenacidade_configuracao.findUnique(
      {
        where: { id_tenacidade_configuracao: BigInt(id) },
        select: { id_tenacidade: true },
      },
    );

    if (
      !existente ||
      existente.id_tenacidade !== tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Configuração ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_tenacidade_configuracao.delete({
        where: { id_tenacidade_configuracao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta configuração.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private montarCreate(
    dto: CriarTenacidadeConfiguracaoDto,
    idTenacidade: bigint,
    ipAud: string,
  ): Prisma.infolab_tenacidade_configuracaoCreateInput {
    return {
      infolab_tenacidade: {
        connect: { id_tenacidade: idTenacidade },
      },
      endereco_ip_auditoria: ipAud,
      nome_aplicacao_auditoria: APP.slice(0, 20),
      infolab_vet: dto.infolab_vet ?? null,
      somente_interfaceamento: dto.somente_interfaceamento ?? null,
      utilizar_numeracao_origem_liberacao:
        dto.utilizar_numeracao_origem_liberacao ?? null,
      utilizar_deltacheck_liberacao: dto.utilizar_deltacheck_liberacao ?? null,
      liberar_resultado_interfaceado_baixado:
        dto.liberar_resultado_interfaceado_baixado ?? null,
      capturar_versao_exame_apoio: dto.capturar_versao_exame_apoio ?? null,
      diretorio_exportacao_resultado: dto.diretorio_exportacao_resultado ?? null,
      diretorio_triagem_amostra: dto.diretorio_triagem_amostra ?? null,
      mensagem_exame_repetido: dto.mensagem_exame_repetido ?? null,
      liberar_resultado_informado: dto.liberar_resultado_informado ?? null,
      lista_setor_libera_informado: dto.lista_setor_libera_informado ?? null,
      endpoint_pedido: dto.endpoint_pedido ?? null,
      endpoint_chatbot: dto.endpoint_chatbot ?? null,
      timeout_sessao_minutos: dto.timeout_sessao_minutos ?? undefined,
      quantidade_licenca: dto.quantidade_licenca ?? null,
    };
  }

  private mapear(row: infolab_tenacidade_configuracao): RespostaTenacidadeConfiguracaoDto {
    return {
      id: row.id_tenacidade_configuracao.toString(),
      id_tenacidade: row.id_tenacidade.toString(),
      infolab_vet: row.infolab_vet ?? null,
      somente_interfaceamento: row.somente_interfaceamento ?? null,
      utilizar_numeracao_origem_liberacao:
        row.utilizar_numeracao_origem_liberacao ?? null,
      utilizar_deltacheck_liberacao: row.utilizar_deltacheck_liberacao ?? null,
      liberar_resultado_interfaceado_baixado:
        row.liberar_resultado_interfaceado_baixado ?? null,
      capturar_versao_exame_apoio: row.capturar_versao_exame_apoio ?? null,
      diretorio_exportacao_resultado: row.diretorio_exportacao_resultado ?? null,
      diretorio_triagem_amostra: row.diretorio_triagem_amostra ?? null,
      mensagem_exame_repetido: row.mensagem_exame_repetido ?? null,
      liberar_resultado_informado: row.liberar_resultado_informado ?? null,
      lista_setor_libera_informado: row.lista_setor_libera_informado ?? null,
      endpoint_pedido: row.endpoint_pedido ?? null,
      endpoint_chatbot: row.endpoint_chatbot ?? null,
      endereco_ip_auditoria: row.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: row.nome_aplicacao_auditoria ?? null,
      timeout_sessao_minutos: row.timeout_sessao_minutos ?? null,
      quantidade_licenca: row.quantidade_licenca ?? null,
    };
  }
}
