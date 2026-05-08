/** Helpers para @Transform em DTOs (evita retorno `any` nos callbacks). */

export function trimStringObrigatorio(value: unknown): string {
  if (typeof value === 'string') return value.trim();
  if (
    typeof value === 'number' ||
    typeof value === 'boolean' ||
    typeof value === 'bigint'
  ) {
    return String(value).trim();
  }
  return '';
}

export function trimStringOpcional(value: unknown): string | undefined {
  if (value === '' || value === null || value === undefined) return undefined;
  if (typeof value === 'string') return value.trim();
  if (
    typeof value === 'number' ||
    typeof value === 'boolean' ||
    typeof value === 'bigint'
  ) {
    return String(value).trim();
  }
  return undefined;
}

/** id numérico opcional a partir de query/body (string vazia → undefined). */
export function intOpcional(value: unknown): number | undefined {
  if (value === '' || value === null || value === undefined) return undefined;
  const n = Number(value);
  return Number.isFinite(n) ? Math.trunc(n) : undefined;
}

/** Inteiro obrigatório a partir do body (ausente/vazio → NaN para falhar validação). */
export function intObrigatorio(value: unknown): number {
  const n = intOpcional(value);
  if (n === undefined) return NaN;
  return n;
}

/** Número decimal opcional (latitude/longitude etc.). */
export function floatOpcional(value: unknown): number | undefined {
  if (value === '' || value === null || value === undefined) return undefined;
  const n = Number(value);
  return Number.isFinite(n) ? n : undefined;
}

/** String opcional para colunas migracao (BigInt como string no JSON). */
export function migracaoStringNullable(
  value: unknown,
): string | null | undefined {
  if (value === null) return null;
  if (value === undefined) return undefined;
  if (typeof value === 'string') {
    const s = value.trim();
    return s === '' ? null : s;
  }
  if (
    typeof value === 'number' ||
    typeof value === 'boolean' ||
    typeof value === 'bigint'
  ) {
    return String(value);
  }
  return null;
}

/** Um caractere em maiúsculas ou null (flags S/N). */
export function char1NullableUpper(value: unknown): string | null | undefined {
  if (value === null) return null;
  if (value === undefined) return undefined;
  let s: string;
  if (typeof value === 'string') {
    s = value.trim();
  } else if (
    typeof value === 'number' ||
    typeof value === 'boolean' ||
    typeof value === 'bigint'
  ) {
    s = String(value);
  } else {
    return null;
  }
  if (s === '') return null;
  return s.slice(0, 1).toUpperCase();
}
