import {
  BadRequestException,
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarSetorDto } from './dto/atualizar-setor.dto';
import { CriarSetorDto } from './dto/criar-setor.dto';
import { RespostaListagemSetorDto } from './dto/resposta-listagem-setor.dto';
import { RespostaSetorDto } from './dto/resposta-setor.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

function codigoExternoParaPrisma(
  v: string | undefined | null,
): bigint | null | undefined {
  if (v === undefined) return undefined;
  if (v === null || v === '') return null;
  const s = v.trim().replace(/\D/g, '');
  if (!s) return null;
  try {
    return BigInt(s);
  } catch {
    return null;
  }
}

@Injectable()
export class SetorService {
  /** Campos permitidos em `campoPesquisa` (índice/contrato com o front). */
  private static readonly CAMPOS_PESQUISA_SETOR = new Set([
    'descricao',
    'ativo',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private mapearLinhaListagem(r: {
    id_setor: bigint;
    descricao: string | null;
    ativo: string | null;
  }): RespostaListagemSetorDto {
    return {
      id: r.id_setor.toString(),
      descricao: r.descricao ?? null,
      ativo: r.ativo ?? null,
    };
  }

  private whereCampoPesquisaSetor(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_setorWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'ativo') {
      const u = qTexto.trim().toUpperCase();
      const letra =
        u === 'S' || u.startsWith('SIM') || u.startsWith('ATIV')
          ? 'S'
          : u === 'N' || u.startsWith('NÃO') || u.startsWith('NAO') || u.startsWith('INAT')
            ? 'N'
            : null;
      if (letra != null) {
        return { ativo: letra };
      }
    }
    return {};
  }

  private whereFiltroRefinadoSetor(
    jsonBruto: string | undefined,
  ): Prisma.infolab_setorWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'ativo']);
    const partes: Prisma.infolab_setorWhereInput[] = [];

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

      if (campo === 'descricao' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            descricao: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemSetorDto[]; total: number }> {
    const baseWhere: Prisma.infolab_setorWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    if (!modoListagemCrudNovo(query)) {
      const registros = await this.prisma.infolab_setor.findMany({
        where: baseWhere,
        orderBy: { descricao: 'asc' },
        select: {
          id_setor: true,
          descricao: true,
          ativo: true,
        },
        ...(todos === true ? {} : { take: 500 }),
      });
      const dados = registros.map((r) => this.mapearLinhaListagem(r));
      return { dados, total: dados.length };
    }

    const cargaInicial = query?.cargaInicial?.trim();
    const qTexto = (query?.q ?? '').trim();
    const campoPesquisa = (query?.campoPesquisa ?? '').trim();
    const { pagina, tamanhoPagina } = parsePaginaETamanhoPagina(query);

    if (cargaInicial === 'vazio' && qTexto === '') {
      return { dados: [], total: 0 };
    }

    let whereExtra: Prisma.infolab_setorWhereInput = {};
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!SetorService.CAMPOS_PESQUISA_SETOR.has(campoPesquisa)) {
        throw new BadRequestException(
          `campoPesquisa inválido: ${campoPesquisa}`,
        );
      }
      whereExtra = this.whereCampoPesquisaSetor(campoPesquisa, qTexto);
    }

    const whereFiltroRef = this.whereFiltroRefinadoSetor(query?.filtroRefinado);

    const condicoes: Prisma.infolab_setorWhereInput[] = [baseWhere];
    if (Object.keys(whereExtra).length > 0) {
      condicoes.push(whereExtra);
    }
    if (Object.keys(whereFiltroRef).length > 0) {
      condicoes.push(whereFiltroRef);
    }
    const where: Prisma.infolab_setorWhereInput =
      condicoes.length === 1 ? condicoes[0]! : { AND: condicoes };

    const total = await this.prisma.infolab_setor.count({ where });

    const skip = pagina * tamanhoPagina;
    const linhas = await this.prisma.infolab_setor.findMany({
      where,
      orderBy: { id_setor: 'desc' },
      skip,
      take: tamanhoPagina,
      select: {
        id_setor: true,
        descricao: true,
        ativo: true,
      },
    });

    return {
      dados: linhas.map((r) => this.mapearLinhaListagem(r)),
      total,
    };
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaSetorDto }> {
    const registro = await this.prisma.infolab_setor.findUnique({
      where: { id_setor: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Setor ${id} não encontrado.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarSetorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const ext = codigoExternoParaPrisma(dto.codigoExterno);
    const criado = await this.prisma.infolab_setor.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        descricao: dto.descricao,
        ativo: dto.ativo ?? 'S',
        codigo_migracao: dto.codigoMigracao ?? null,
        codigo_externo: ext === undefined ? null : ext,
      },
      select: { id_setor: true },
    });
    return { id: criado.id_setor.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarSetorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_setor.findUnique({
      where: { id_setor: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Setor ${id} não encontrado.`);
    }
    const ext =
      dto.codigoExterno !== undefined
        ? codigoExternoParaPrisma(dto.codigoExterno)
        : undefined;
    await this.prisma.infolab_setor.update({
      where: { id_setor: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
        ...(dto.codigoMigracao !== undefined && {
          codigo_migracao: dto.codigoMigracao,
        }),
        ...(ext !== undefined && { codigo_externo: ext }),
      },
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_setor.findUnique({
      where: { id_setor: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Setor ${id} não encontrado.`);
    }
    try {
      await this.prisma.infolab_setor.delete({
        where: { id_setor: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este setor.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_setor: bigint;
    descricao: string | null;
    ativo: string | null;
    codigo_migracao: number | null;
    codigo_externo: bigint | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaSetorDto {
    return {
      id: registro.id_setor.toString(),
      descricao: registro.descricao ?? null,
      ativo: registro.ativo ?? null,
      codigoMigracao: registro.codigo_migracao ?? null,
      codigoExterno:
        registro.codigo_externo !== null && registro.codigo_externo !== undefined
          ? registro.codigo_externo.toString()
          : null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
