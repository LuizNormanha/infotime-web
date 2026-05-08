import { BadRequestException } from '@nestjs/common';

import {
  modoListagemCrudNovo,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from './query-listagem-crud';

/** Une base + extras em `{ AND: [...] }` quando necessário (Prisma). */
export function mergeWhereAnd<T extends object>(base: T, ...extras: object[]): T {
  const partes: object[] = [base];
  for (const ex of extras) {
    if (ex != null && typeof ex === 'object' && Object.keys(ex).length > 0) {
      partes.push(ex);
    }
  }
  if (partes.length === 1) return partes[0] as T;
  return { AND: partes } as unknown as T;
}

/** Delegates Prisma (`model`) compatíveis com count/findMany. */
export type DelegateCountFindMany = {
  count: (args?: { where?: unknown }) => Promise<number>;
  findMany: (args?: unknown) => Promise<unknown[]>;
};

/**
 * Listagem CRUD padrão (Cliente / Setor): paginação servidor, q+campoPesquisa whitelist, total.
 * O caller monta `where` parcial de busca e de filtro refinado para o modelo Prisma.
 */
export async function executarListagemCrudCatalogo<TDto>(opts: {
  query?: QueryListagemCrudPadrao;
  todos?: boolean;
  /** Modo legado sem paginação (lookup): limite quando todos=false */
  takeLegadoSemTodos?: number;
  delegate: DelegateCountFindMany;
  baseWhere: unknown;
  camposPesquisaWhitelist: Set<string>;
  montarWhereCampoPesquisa: (
    campoPesquisa: string,
    qTexto: string,
  ) => Record<string, unknown>;
  montarWhereFiltroRefinado?: (
    filtroRefinadoJson: string | undefined,
  ) => Record<string, unknown>;
  orderBy: Record<string, 'asc' | 'desc'>;
  skipTakeSelect: { skip: number; take: number; select: unknown };
  mapRow: (row: unknown) => TDto;
  /** Listagem legada sem novo modo */
  findManyLegado: (args: {
    where: unknown;
    orderBy: Record<string, 'asc' | 'desc'>;
    select: unknown;
    take?: number;
  }) => Promise<unknown[]>;
}): Promise<{ dados: TDto[]; total: number }> {
  const takeLegado = opts.takeLegadoSemTodos ?? 500;

  if (!modoListagemCrudNovo(opts.query)) {
    const linhas = await opts.findManyLegado({
      where: opts.baseWhere,
      orderBy: opts.orderBy,
      select: opts.skipTakeSelect.select,
      ...(opts.todos === true ? {} : { take: takeLegado }),
    });
    const dados = linhas.map(opts.mapRow);
    return { dados, total: dados.length };
  }

  const cargaInicial = opts.query?.cargaInicial?.trim();
  const qTexto = (opts.query?.q ?? '').trim();
  const campoPesquisa = (opts.query?.campoPesquisa ?? '').trim();
  const { pagina, tamanhoPagina } = parsePaginaETamanhoPagina(opts.query);

  if (cargaInicial === 'vazio' && qTexto === '') {
    return { dados: [], total: 0 };
  }

  let whereExtra: Record<string, unknown> = {};
  if (qTexto !== '' && campoPesquisa !== '') {
    if (!opts.camposPesquisaWhitelist.has(campoPesquisa)) {
      throw new BadRequestException(`campoPesquisa inválido: ${campoPesquisa}`);
    }
    whereExtra = opts.montarWhereCampoPesquisa(campoPesquisa, qTexto);
  }

  const whereFiltro =
    opts.montarWhereFiltroRefinado?.(opts.query?.filtroRefinado) ?? {};

  const where = mergeWhereAnd(
    opts.baseWhere as object,
    whereExtra,
    whereFiltro,
  );

  const total = await opts.delegate.count({ where });

  const linhas = (await opts.delegate.findMany({
    where,
    orderBy: opts.orderBy,
    skip: pagina * tamanhoPagina,
    take: tamanhoPagina,
    select: opts.skipTakeSelect.select,
  })) as unknown[];

  return {
    dados: linhas.map(opts.mapRow),
    total,
  };
}
