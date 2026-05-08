/**
 * Aba ativa do shell da home cujo conteúdo pertence ao módulo Soroteca
 * (operacional ou cadastros dedicados).
 */
export function abaAtivaEmContextoSoroteca(
  aba: { conteudoKey: string } | undefined,
): boolean {
  if (!aba) return false;
  return (
    aba.conteudoKey === "sorotecaMapa" ||
    aba.conteudoKey === "sorotecaCadastroCrud"
  );
}
