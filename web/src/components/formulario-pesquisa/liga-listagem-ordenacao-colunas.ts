import type { LigaColunaListagem } from "./liga-listagem.types";

function colunaEhChaveTecnica(
  c: LigaColunaListagem,
  chavePrimaria: string,
): boolean {
  return c.campo === chavePrimaria || c.colunaChavePrimaria === true;
}

/**
 * §11.7 padroes-ui: coluna(s) de chave técnica por último à direita.
 * Colunas com `campo === chavePrimaria` ou `colunaChavePrimaria: true` vão ao final, preservando a ordem relativa entre elas.
 */
export function ordenarColunasListagemCrud(
  colunas: LigaColunaListagem[],
  chavePrimaria: string,
): LigaColunaListagem[] {
  const tail = colunas.filter((c) => colunaEhChaveTecnica(c, chavePrimaria));
  if (tail.length === 0) return [...colunas];
  const head = colunas.filter((c) => !colunaEhChaveTecnica(c, chavePrimaria));
  return [...head, ...tail];
}
