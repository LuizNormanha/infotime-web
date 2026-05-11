/**
 * Paleta fixa de 6 cores para badges de tipo e situação do colaborador
 * (título, dropdowns e listagem), atribuída de forma estável ao valor do id do cadastro.
 */
export type ColaboradorPaletaSeisSlug =
  | "vermelho"
  | "verde"
  | "azul"
  | "laranja"
  | "preto"
  | "cinza";

const ORDEM: readonly ColaboradorPaletaSeisSlug[] = [
  "vermelho",
  "verde",
  "azul",
  "laranja",
  "preto",
  "cinza",
] as const;

function hashStringParaIndice6(s: string): number {
  let hash = 0;
  for (let i = 0; i < s.length; i++) {
    hash = (Math.imul(31, hash) + s.charCodeAt(i)) | 0;
  }
  return Math.abs(hash) % 6;
}

/**
 * @param idLookup — `id_tipo_colaborador` ou `id_situacao_colaborador` em string; vazio → cinza.
 */
export function paletaSeisColaboradorPorIdLookup(
  idLookup: string | null | undefined,
): ColaboradorPaletaSeisSlug {
  const s = String(idLookup ?? "").trim();
  if (!s) return "cinza";
  if (/^\d+$/.test(s)) {
    try {
      const mod = Number(BigInt(s) % BigInt(6));
      return ORDEM[mod] ?? "cinza";
    } catch {
      /* continua com hash */
    }
  }
  return ORDEM[hashStringParaIndice6(s)] ?? "cinza";
}

function semDiacriticos(s: string): string {
  return s.normalize("NFD").replace(/\p{M}/gu, "");
}

/** Tipo «Estágio» / «Estagiário» etc. — sempre badge cinza (regra de produto). */
export function rotuloTipoColaboradorEhEstagio(
  rotulo: string | null | undefined,
): boolean {
  const t = semDiacriticos(String(rotulo ?? "").trim().toLowerCase());
  return t.includes("estagi");
}

/**
 * Paleta por id, com exceção: **tipo** cujo rótulo indica estágio → sempre `cinza`.
 * @param dominio — `tipo` aplica a regra estágio; `situacao` só usa id.
 */
export function colaboradorBadgePaletaTipoOuSituacao(
  idLookup: string | null | undefined,
  rotulo: string | null | undefined,
  dominio: "tipo" | "situacao",
): ColaboradorPaletaSeisSlug {
  if (dominio === "tipo" && rotuloTipoColaboradorEhEstagio(rotulo)) {
    return "cinza";
  }
  return paletaSeisColaboradorPorIdLookup(idLookup);
}
