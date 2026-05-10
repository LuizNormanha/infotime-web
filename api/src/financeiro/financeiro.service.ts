import { Injectable } from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { PrismaService } from '../prisma/prisma.service';
import type {
  CockpitDistribuicaoDto,
  CockpitFluxoDiaDto,
  CockpitKpiDto,
  CockpitMiniItemDto,
  CockpitResponseDto,
} from './dto/cockpit-response.dto';

const ID_SITUACAO_DOCUMENTO_PAGO = 4n;
const ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL = 24n;

@Injectable()
export class FinanceiroService {
  constructor(private readonly prisma: PrismaService) {}

  private inicioDiaCivilAtual(): Date {
    const d = new Date();
    d.setHours(0, 0, 0, 0);
    return d;
  }

  private fimDiaCivilAtual(): Date {
    const d = new Date();
    d.setHours(23, 59, 59, 999);
    return d;
  }

  private fimDiaCivilOffset(dias: number): Date {
    const d = new Date();
    d.setHours(23, 59, 59, 999);
    d.setDate(d.getDate() + dias);
    return d;
  }

  private inicioMesAtual(): Date {
    const d = new Date();
    d.setDate(1);
    d.setHours(0, 0, 0, 0);
    return d;
  }

  private fimMesAtual(): Date {
    const d = new Date();
    d.setMonth(d.getMonth() + 1, 0);
    d.setHours(23, 59, 59, 999);
    return d;
  }

  private whereReceitaNaoRecebida(): Prisma.infotime_lancamento_receitaWhereInput {
    return {
      OR: [
        { id_situacao_documento: null },
        {
          id_situacao_documento: {
            notIn: [ID_SITUACAO_DOCUMENTO_PAGO, ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL],
          },
        },
      ],
    };
  }

  private whereDespesaNaoPaga(): Prisma.infotime_lancamento_despesaWhereInput {
    return {
      OR: [
        { id_situacao_documento: null },
        { id_situacao_documento: { not: ID_SITUACAO_DOCUMENTO_PAGO } },
      ],
    };
  }

  private decParaNum(v: Prisma.Decimal | null | undefined): number {
    if (v == null) return 0;
    return Number(v.toString());
  }

  private async kpiReceita(
    idTenacidade: bigint,
    where: Prisma.infotime_lancamento_receitaWhereInput,
  ): Promise<CockpitKpiDto> {
    const [agg, cnt] = await Promise.all([
      this.prisma.infotime_lancamento_receita.aggregate({
        where: { id_tenacidade: idTenacidade, ...where },
        _sum: { valor_previsao: true },
      }),
      this.prisma.infotime_lancamento_receita.count({
        where: { id_tenacidade: idTenacidade, ...where },
      }),
    ]);
    return {
      total: this.decParaNum(agg._sum.valor_previsao),
      qtd: cnt,
    };
  }

  private async kpiDespesa(
    idTenacidade: bigint,
    where: Prisma.infotime_lancamento_despesaWhereInput,
  ): Promise<CockpitKpiDto> {
    const [agg, cnt] = await Promise.all([
      this.prisma.infotime_lancamento_despesa.aggregate({
        where: { id_tenacidade: idTenacidade, ...where },
        _sum: { valor_previsao: true },
      }),
      this.prisma.infotime_lancamento_despesa.count({
        where: { id_tenacidade: idTenacidade, ...where },
      }),
    ]);
    return {
      total: this.decParaNum(agg._sum.valor_previsao),
      qtd: cnt,
    };
  }

  private nomeAgenteReceita(r: {
    id_tipo_agente: bigint | null;
    id_colaborador: bigint | null;
    infotime_cliente: {
      nome_fantasia: string | null;
      razao_social: string | null;
    } | null;
    infotime_fornecedor: { nome_fantasia: string | null } | null;
  }, mapCol: Map<string, string>): string {
    const ta = r.id_tipo_agente;
    if (ta === 1n) {
      return (
        r.infotime_cliente?.nome_fantasia?.trim() ||
        r.infotime_cliente?.razao_social?.trim() ||
        '—'
      );
    }
    if (ta === 2n) {
      return r.infotime_fornecedor?.nome_fantasia?.trim() || '—';
    }
    if (ta === 3n && r.id_colaborador != null) {
      return mapCol.get(r.id_colaborador.toString()) ?? '—';
    }
    return '—';
  }

  private nomeAgenteDespesa(r: {
    id_tipo_agente: bigint | null;
    id_colaborador: bigint | null;
    infotime_cliente: {
      nome_fantasia: string | null;
      razao_social: string | null;
    } | null;
    infotime_fornecedor: { nome_fantasia: string | null } | null;
  }, mapCol: Map<string, string>): string {
    return this.nomeAgenteReceita(r, mapCol);
  }

  private async mapNomesColaboradores(
    idTenacidade: bigint,
    ids: (bigint | null)[],
  ): Promise<Map<string, string>> {
    const uniq = [...new Set(ids.filter((x): x is bigint => x != null))];
    if (uniq.length === 0) return new Map();
    const rows = await this.prisma.$queryRaw<{ id: bigint; nome: string | null }[]>`
      SELECT id_colaborador AS id, nome
      FROM infotime_colaborador
      WHERE id_tenacidade = ${idTenacidade}
        AND id_colaborador IN (${Prisma.join(uniq)})
    `;
    const m = new Map<string, string>();
    for (const r of rows) {
      m.set(r.id.toString(), (r.nome ?? '').trim() || r.id.toString());
    }
    return m;
  }

  private dataIso(d: Date | null): string {
    if (!d) return '';
    return d.toISOString().slice(0, 10);
  }

  private diasAtraso(dataPrevisao: Date | null): number {
    if (!dataPrevisao) return 0;
    const hoje = this.inicioDiaCivilAtual().getTime();
    const prev = new Date(dataPrevisao);
    prev.setHours(0, 0, 0, 0);
    const diff = Math.floor((hoje - prev.getTime()) / 86_400_000);
    return Math.max(0, diff);
  }

  private async fluxo14Dias(idTenacidade: bigint): Promise<CockpitFluxoDiaDto[]> {
    const rows = await this.prisma.$queryRaw<{ data: string; entradas: unknown; saidas: unknown }[]>`
      WITH dias AS (
        SELECT gs::date AS d
        FROM generate_series(
          CURRENT_DATE::timestamp,
          (CURRENT_DATE + 13)::timestamp,
          interval '1 day'
        ) gs
      )
      SELECT
        to_char(d.d, 'YYYY-MM-DD') AS data,
        COALESCE(e.soma, 0)::float8 AS entradas,
        COALESCE(s.soma, 0)::float8 AS saidas
      FROM dias d
      LEFT JOIN (
        SELECT (data_previsao AT TIME ZONE 'UTC')::date AS dia,
               SUM(valor_previsao) AS soma
        FROM infotime_lancamento_receita
        WHERE id_tenacidade = ${idTenacidade}
          AND data_previsao IS NOT NULL
          AND (id_situacao_documento IS DISTINCT FROM ${ID_SITUACAO_DOCUMENTO_PAGO}
            AND id_situacao_documento IS DISTINCT FROM ${ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL})
          AND (data_previsao AT TIME ZONE 'UTC')::date >= CURRENT_DATE
          AND (data_previsao AT TIME ZONE 'UTC')::date <= CURRENT_DATE + 13
        GROUP BY 1
      ) e ON e.dia = d.d
      LEFT JOIN (
        SELECT (data_previsao AT TIME ZONE 'UTC')::date AS dia,
               SUM(valor_previsao) AS soma
        FROM infotime_lancamento_despesa
        WHERE id_tenacidade = ${idTenacidade}
          AND data_previsao IS NOT NULL
          AND id_situacao_documento IS DISTINCT FROM ${ID_SITUACAO_DOCUMENTO_PAGO}
          AND (data_previsao AT TIME ZONE 'UTC')::date >= CURRENT_DATE
          AND (data_previsao AT TIME ZONE 'UTC')::date <= CURRENT_DATE + 13
        GROUP BY 1
      ) s ON s.dia = d.d
      ORDER BY d.d
    `;
    return rows.map((r) => ({
      data: r.data,
      entradas: Number(r.entradas),
      saidas: Number(r.saidas),
    }));
  }

  async getCockpitData(idTenacidade: bigint): Promise<CockpitResponseDto> {
    const ini = this.inicioDiaCivilAtual();
    const fim = this.fimDiaCivilAtual();
    const fim30 = this.fimDiaCivilOffset(30);
    const iniMes = this.inicioMesAtual();
    const fimMes = this.fimMesAtual();

    const whereNaoRec = this.whereReceitaNaoRecebida();
    const whereNaoPago = this.whereDespesaNaoPaga();

    const [
      receberHoje,
      receberAtraso,
      pagarHoje,
      pagarAtraso,
      somaRec30,
      somaDesp30,
      fluxo14dias,
      pendenteReceber,
      pendentePagar,
      pagosRecebidosMesReceita,
      pagosRecebidosMesDespesa,
      atrasoRecQtd,
      atrasoDespQtd,
      miniRecHojeRows,
      miniRecAtrasoRows,
      miniDespHojeRows,
      miniDespAtrasoRows,
    ] = await Promise.all([
      this.kpiReceita(idTenacidade, {
        AND: [{ data_previsao: { gte: ini, lte: fim } }, whereNaoRec],
      }),
      this.kpiReceita(idTenacidade, {
        AND: [{ data_previsao: { lt: ini } }, whereNaoRec],
      }),
      this.kpiDespesa(idTenacidade, {
        AND: [{ data_previsao: { gte: ini, lte: fim } }, whereNaoPago],
      }),
      this.kpiDespesa(idTenacidade, {
        AND: [{ data_previsao: { lt: ini } }, whereNaoPago],
      }),
      this.prisma.infotime_lancamento_receita.aggregate({
        where: {
          id_tenacidade: idTenacidade,
          AND: [
            { data_previsao: { gte: ini, lte: fim30 } },
            whereNaoRec,
          ],
        },
        _sum: { valor_previsao: true },
      }),
      this.prisma.infotime_lancamento_despesa.aggregate({
        where: {
          id_tenacidade: idTenacidade,
          AND: [
            { data_previsao: { gte: ini, lte: fim30 } },
            whereNaoPago,
          ],
        },
        _sum: { valor_previsao: true },
      }),
      this.fluxo14Dias(idTenacidade),
      this.prisma.infotime_lancamento_receita.count({
        where: { id_tenacidade: idTenacidade, ...whereNaoRec },
      }),
      this.prisma.infotime_lancamento_despesa.count({
        where: { id_tenacidade: idTenacidade, ...whereNaoPago },
      }),
      this.prisma.infotime_lancamento_receita.count({
        where: {
          id_tenacidade: idTenacidade,
          id_situacao_documento: {
            in: [ID_SITUACAO_DOCUMENTO_PAGO, ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL],
          },
          data_realizacao: { gte: iniMes, lte: fimMes },
        },
      }),
      this.prisma.infotime_lancamento_despesa.count({
        where: {
          id_tenacidade: idTenacidade,
          id_situacao_documento: ID_SITUACAO_DOCUMENTO_PAGO,
          data_realizacao: { gte: iniMes, lte: fimMes },
        },
      }),
      this.prisma.infotime_lancamento_receita.count({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { lt: ini } }, whereNaoRec],
        },
      }),
      this.prisma.infotime_lancamento_despesa.count({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { lt: ini } }, whereNaoPago],
        },
      }),
      this.prisma.infotime_lancamento_receita.findMany({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { gte: ini, lte: fim } }, whereNaoRec],
        },
        orderBy: { valor_previsao: 'desc' },
        take: 5,
        select: {
          id_lancamento_receita: true,
          id_tipo_agente: true,
          id_colaborador: true,
          data_previsao: true,
          valor_previsao: true,
          infotime_cliente: {
            select: { nome_fantasia: true, razao_social: true },
          },
          infotime_fornecedor: { select: { nome_fantasia: true } },
        },
      }),
      this.prisma.infotime_lancamento_receita.findMany({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { lt: ini } }, whereNaoRec],
        },
        orderBy: { data_previsao: 'asc' },
        take: 5,
        select: {
          id_lancamento_receita: true,
          id_tipo_agente: true,
          id_colaborador: true,
          data_previsao: true,
          valor_previsao: true,
          infotime_cliente: {
            select: { nome_fantasia: true, razao_social: true },
          },
          infotime_fornecedor: { select: { nome_fantasia: true } },
        },
      }),
      this.prisma.infotime_lancamento_despesa.findMany({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { gte: ini, lte: fim } }, whereNaoPago],
        },
        orderBy: { valor_previsao: 'desc' },
        take: 5,
        select: {
          id_lancamento_despesa: true,
          id_tipo_agente: true,
          id_colaborador: true,
          data_previsao: true,
          valor_previsao: true,
          infotime_cliente: {
            select: { nome_fantasia: true, razao_social: true },
          },
          infotime_fornecedor: { select: { nome_fantasia: true } },
        },
      }),
      this.prisma.infotime_lancamento_despesa.findMany({
        where: {
          id_tenacidade: idTenacidade,
          AND: [{ data_previsao: { lt: ini } }, whereNaoPago],
        },
        orderBy: { data_previsao: 'asc' },
        take: 5,
        select: {
          id_lancamento_despesa: true,
          id_tipo_agente: true,
          id_colaborador: true,
          data_previsao: true,
          valor_previsao: true,
          infotime_cliente: {
            select: { nome_fantasia: true, razao_social: true },
          },
          infotime_fornecedor: { select: { nome_fantasia: true } },
        },
      }),
    ]);

    const idsColMini = [
      ...miniRecHojeRows.map((r) => r.id_colaborador),
      ...miniRecAtrasoRows.map((r) => r.id_colaborador),
      ...miniDespHojeRows.map((r) => r.id_colaborador),
      ...miniDespAtrasoRows.map((r) => r.id_colaborador),
    ];
    const mapCol = await this.mapNomesColaboradores(idTenacidade, idsColMini);

    const miniReceberHoje: CockpitMiniItemDto[] = miniRecHojeRows.map((r) => ({
      id: r.id_lancamento_receita.toString(),
      nomeAgente: this.nomeAgenteReceita(r, mapCol),
      valorPrevisao: this.decParaNum(r.valor_previsao),
      dataPrevisao: this.dataIso(r.data_previsao),
    }));

    const miniReceberAtraso: CockpitMiniItemDto[] = miniRecAtrasoRows.map((r) => ({
      id: r.id_lancamento_receita.toString(),
      nomeAgente: this.nomeAgenteReceita(r, mapCol),
      valorPrevisao: this.decParaNum(r.valor_previsao),
      dataPrevisao: this.dataIso(r.data_previsao),
      diasAtraso: this.diasAtraso(r.data_previsao),
    }));

    const miniPagarHoje: CockpitMiniItemDto[] = miniDespHojeRows.map((r) => ({
      id: r.id_lancamento_despesa.toString(),
      nomeAgente: this.nomeAgenteDespesa(r, mapCol),
      valorPrevisao: this.decParaNum(r.valor_previsao),
      dataPrevisao: this.dataIso(r.data_previsao),
    }));

    const miniPagarAtraso: CockpitMiniItemDto[] = miniDespAtrasoRows.map((r) => ({
      id: r.id_lancamento_despesa.toString(),
      nomeAgente: this.nomeAgenteDespesa(r, mapCol),
      valorPrevisao: this.decParaNum(r.valor_previsao),
      dataPrevisao: this.dataIso(r.data_previsao),
      diasAtraso: this.diasAtraso(r.data_previsao),
    }));

    const saldoPrevisto30d =
      this.decParaNum(somaRec30._sum.valor_previsao) -
      this.decParaNum(somaDesp30._sum.valor_previsao);

    const distribuicao: CockpitDistribuicaoDto = {
      pendenteReceber,
      pendentePagar,
      pagosRecebidosMes: pagosRecebidosMesReceita + pagosRecebidosMesDespesa,
      totalEmAtraso: atrasoRecQtd + atrasoDespQtd,
    };

    return {
      receberHoje,
      receberAtraso,
      pagarHoje,
      pagarAtraso,
      saldoPrevisto30d,
      fluxo14dias,
      distribuicao,
      miniReceberHoje,
      miniReceberAtraso,
      miniPagarHoje,
      miniPagarAtraso,
    };
  }
}
