/**
 * Catálogo de telas persistido no formulário de catálogo (modelo legado mapeado no PostgreSQL).
 *
 * InfoTIME: vazio até que cada tela do DDL tenha registro estável aqui e no seed (`upsert` por `codigo`).
 */
export type FormularioEntrada = {
  readonly id: bigint;
  readonly codigo: string;
  readonly descricao: string;
  readonly ordem: number;
};

/** Entradas alinhadas ao seed (`upsert` por `codigo`). */
export const FORMULARIOS: readonly FormularioEntrada[] = [];

const mapaCodigoParaId = new Map<string, bigint>(
  FORMULARIOS.map((f) => [f.codigo, f.id]),
);

export function idFormularioEsperadoPorCodigo(
  codigo: string,
): bigint | undefined {
  return mapaCodigoParaId.get(codigo.trim().toLowerCase());
}
