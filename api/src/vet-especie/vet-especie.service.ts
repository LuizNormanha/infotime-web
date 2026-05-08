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
import { AtualizarVetEspecieDto } from './dto/atualizar-vet-especie.dto';
import { CriarVetEspecieDto } from './dto/criar-vet-especie.dto';
import { RespostaListagemVetEspecieDto } from './dto/resposta-listagem-vet-especie.dto';
import { RespostaVetEspecieDto } from './dto/resposta-vet-especie.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

@Injectable()
export class VetEspecieService {
  private static readonly CAMPOS_PESQUISA = new Set(['nome', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_vet_especieWhereInput {
    if (campoPesquisa === 'nome') {
      return {
        nome: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_vet_especie: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_vet_especieWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome']);
    const partes: Prisma.infolab_vet_especieWhereInput[] = [];

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
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemVetEspecieDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_vet_especieWhereInput = {};

    const select = {
      id_vet_especie: true,
      nome: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_vet_especie,
      baseWhere,
      camposPesquisaWhitelist: VetEspecieService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_vet_especie: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as { id_vet_especie: bigint; nome: string | null };
        return {
          id: r.id_vet_especie.toString(),
          nome: r.nome ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_vet_especie.findMany({
          where: where as Prisma.infolab_vet_especieWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaVetEspecieDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_vet_especie.findUnique({
      where: { id_vet_especie: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Espécie veterinária ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarVetEspecieDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idPk = BigInt(dto.id);
    const existente = await this.prisma.infolab_vet_especie.findUnique({
      where: { id_vet_especie: idPk },
      select: { id_vet_especie: true },
    });
    if (existente) {
      throw new ConflictException('Já existe espécie com este id.');
    }

    await this.prisma.infolab_vet_especie.create({
      data: {
        id_vet_especie: idPk,
        nome: dto.nome ?? null,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });

    return { id: dto.id };
  }

  async atualizar(
    id: string,
    dto: AtualizarVetEspecieDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_vet_especie.findUnique({
      where: { id_vet_especie: BigInt(id) },
      select: { id_vet_especie: true },
    });

    if (!existente) {
      throw new NotFoundException(`Espécie veterinária ${id} não encontrada.`);
    }

    const data: {
      nome?: string | null;
      id_usuario_auditoria: bigint;
      endereco_ip_auditoria: string;
      nome_aplicacao_auditoria: string;
    } = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
    };
    if (dto.nome !== undefined) data.nome = dto.nome;

    await this.prisma.infolab_vet_especie.update({
      where: { id_vet_especie: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_vet_especie.findUnique({
      where: { id_vet_especie: BigInt(id) },
      select: { id_vet_especie: true },
    });

    if (!existente) {
      throw new NotFoundException(`Espécie veterinária ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_vet_especie.delete({
        where: { id_vet_especie: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados (raças, clientes, etc.).',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_vet_especie: bigint;
    nome: string | null;
  }): RespostaVetEspecieDto {
    return {
      id: registro.id_vet_especie.toString(),
      nome: registro.nome ?? null,
    };
  }
}
