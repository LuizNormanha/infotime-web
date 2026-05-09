/** Itens do combobox de UF (cadastro legado / IBGE + código legado FN). */

export const UFS_BRASIL: string[] = [
  "AC",
  "AL",
  "AM",
  "AP",
  "BA",
  "CE",
  "DF",
  "ES",
  "FN",
  "GO",
  "MA",
  "MG",
  "MT",
  "MS",
  "PA",
  "PB",
  "PE",
  "PI",
  "PR",
  "RJ",
  "RN",
  "RO",
  "RR",
  "RS",
  "SC",
  "SE",
  "SP",
  "TO",
];

const NOME_UF_POR_SIGLA: Record<string, string> = {
  AC: "Acre",
  AL: "Alagoas",
  AM: "Amazonas",
  AP: "Amapá",
  BA: "Bahia",
  CE: "Ceará",
  DF: "Distrito Federal",
  ES: "Espírito Santo",
  FN: "Fernando de Noronha",
  GO: "Goiás",
  MA: "Maranhão",
  MG: "Minas Gerais",
  MT: "Mato Grosso",
  MS: "Mato Grosso do Sul",
  PA: "Pará",
  PB: "Paraíba",
  PE: "Pernambuco",
  PI: "Piauí",
  PR: "Paraná",
  RJ: "Rio de Janeiro",
  RN: "Rio Grande do Norte",
  RO: "Rondônia",
  RR: "Roraima",
  RS: "Rio Grande do Sul",
  SC: "Santa Catarina",
  SE: "Sergipe",
  SP: "São Paulo",
  TO: "Tocantins",
};

/** Rótulo do dropdown: `RS - Rio Grande do Sul` (valor gravado = sigla). */
export function rotuloUfBrasil(sigla: string): string {
  const s = sigla.trim().toUpperCase();
  const nome = NOME_UF_POR_SIGLA[s];
  return nome != null ? `${s} - ${nome}` : s;
}

export type OpcaoUfBrasil = { label: string; value: string };

export const OPCOES_UF_BRASIL_FORMULARIO: OpcaoUfBrasil[] = UFS_BRASIL.map((uf) => ({
  label: rotuloUfBrasil(uf),
  value: uf,
}));
