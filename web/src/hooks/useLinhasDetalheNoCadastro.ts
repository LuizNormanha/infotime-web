"use client";

/**
 * Helpers para **detalhe** no mesmo estado do mestre (`useCadastroFormulario`).
 * Alterações ficam só em memória até o **Salvar** do formulário (POST/PUT único no backend em transação).
 */
export function useLinhasDetalheNoCadastro<
  T extends Record<string, unknown>,
  D extends Record<string, unknown>,
>(
  valores: T,
  aoAlterarCampo: (chave: string, valor: unknown) => void,
  chaveDetalhe: keyof T,
): {
  linhas: D[];
  substituirLinhas: (novas: D[]) => void;
  atualizarLinha: (indice: number, parcial: Partial<D>) => void;
  adicionarLinha: (linha: D) => void;
  removerLinha: (indice: number) => void;
} {
  const raw = valores[chaveDetalhe];
  const linhas = (Array.isArray(raw) ? raw : []) as D[];

  function substituirLinhas(novas: D[]): void {
    aoAlterarCampo(String(chaveDetalhe), novas);
  }

  function atualizarLinha(indice: number, parcial: Partial<D>): void {
    const novas = linhas.map((linha, i) =>
      i === indice ? ({ ...linha, ...parcial } as D) : linha,
    );
    substituirLinhas(novas);
  }

  function adicionarLinha(linha: D): void {
    substituirLinhas([...linhas, linha]);
  }

  function removerLinha(indice: number): void {
    substituirLinhas(linhas.filter((_, i) => i !== indice));
  }

  return {
    linhas,
    substituirLinhas,
    atualizarLinha,
    adicionarLinha,
    removerLinha,
  };
}
