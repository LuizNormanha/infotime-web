import {
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarMedicamentoDto } from './dto/atualizar-medicamento.dto';
import { CriarMedicamentoDto } from './dto/criar-medicamento.dto';
import { RespostaMedicamentoDto } from './dto/resposta-medicamento.dto';
import { RespostaListagemMedicamentoDto } from './dto/resposta-listagem-medicamento.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

@Injectable()
export class MedicamentoService {
  private static readonly CAMPOS_PESQUISA = new Set(['nome']);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisaMedicamento(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_medicamentoWhereInput {
    if (campoPesquisa === 'nome') {
      return { nome: { contains: qTexto, mode: 'insensitive' } };
    }
    return {};
  }

  private whereFiltroRefinadoMedicamento(
    jsonBruto: string | undefined,
  ): Prisma.infolab_medicamentoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome', 'ativo']);
    const partes: Prisma.infolab_medicamentoWhereInput[] = [];

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

      if (campo === 'nome' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            nome: { contains: contem, mode: 'insensitive' },
          });
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
  ): Promise<{ dados: RespostaListagemMedicamentoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_medicamentoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_medicamento: true,
      nome: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 500,
      delegate: this.prisma.infolab_medicamento,
      baseWhere,
      camposPesquisaWhitelist: MedicamentoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaMedicamento(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoMedicamento(j),
      orderBy: { id_medicamento: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_medicamento: bigint;
          nome: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_medicamento.toString(),
          nome: r.nome ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_medicamento.findMany({
          where: where as Prisma.infolab_medicamentoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaMedicamentoDto }> {
    const registro = await this.prisma.infolab_medicamento.findUnique({
      where: { id_medicamento: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Medicamento ${id} não encontrado.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarMedicamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_medicamento.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        nome: dto.nome,
        ativo: dto.ativo ?? null,
      },
      select: { id_medicamento: true },
    });
    return { id: criado.id_medicamento.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarMedicamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_medicamento.findUnique({
      where: { id_medicamento: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Medicamento ${id} não encontrado.`);
    }
    await this.prisma.infolab_medicamento.update({
      where: { id_medicamento: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        ...(dto.nome !== undefined && { nome: dto.nome }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      },
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_medicamento.findUnique({
      where: { id_medicamento: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Medicamento ${id} não encontrado.`);
    }
    try {
      await this.prisma.infolab_medicamento.delete({
        where: { id_medicamento: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este medicamento.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_medicamento: bigint;
    nome: string | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaMedicamentoDto {
    return {
      id: registro.id_medicamento.toString(),
      nome: registro.nome ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
