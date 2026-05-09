/**
 * ViaCEP devolve um único `logradouro` (tipo + nome). O cadastro InfoTIME separa tipo e nome.
 * Identifica o tipo pelo primeiro token, quando for um caso conhecido dos Correios.
 */
const PRIMEIRO_TOKEN_TIPO = new Set([
  "RUA",
  "AVENIDA",
  "TRAV",
  "TRAVESSA",
  "ALAMEDA",
  "RODOVIA",
  "ESTRADA",
  "PRACA",
  "PRAÇA",
  "LARGO",
  "VIELA",
  "BECO",
  "QUADRA",
  "CONJUNTO",
  "CONDOMINIO",
  "CONDOMÍNIO",
  "SETOR",
  "LOT",
  "LOTEAMENTO",
  "CHACARA",
  "CHÁCARA",
  "FAZENDA",
  "SITIO",
  "SÍTIO",
  "CAMPO",
  "VILA",
  "BLOCO",
  "ACESSO",
  "ADRO",
  "AREA",
  "ÁREA",
  "ARTERIA",
  "ATALHO",
  "AVN",
  // "AV" omitido: risco de falso positivo (p.ex. início de nome próprio).
]);

function normalizarTokenTipo(s: string): string {
  return s.toUpperCase().normalize("NFD").replace(/\p{M}/gu, "");
}

/**
 * @returns `tipo` vazio se o primeiro token não for tipo conhecido (mantém texto inteiro em `nome`).
 */
export function separarTipoENomeLogradouroViacep(logradouro: string): {
  tipo: string;
  nome: string;
} {
  const raw = logradouro.trim().replace(/\s+/g, " ");
  if (!raw) return { tipo: "", nome: "" };

  const parts = raw.split(/\s+/).filter(Boolean);
  if (parts.length === 0) return { tipo: "", nome: "" };

  const firstNorm = normalizarTokenTipo(parts[0]);
  if (PRIMEIRO_TOKEN_TIPO.has(firstNorm)) {
    const tipoCanon = firstNorm === "PRACA" ? "PRAÇA" : firstNorm;
    return {
      tipo: tipoCanon,
      nome: parts.slice(1).join(" ").trim(),
    };
  }

  return { tipo: "", nome: raw };
}
