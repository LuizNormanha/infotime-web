export type LigaLookupMultiOpcao = { value: string; label: string; meta: string };

/**
 * Tipos de catálogo aceitos pelo componente; no template só `usuario` é resolvido.
 * Demais valores retornam lista vazia (domínios removidos na exportação ZIP).
 */
export type LigaLookupCatalogoTipo =
  | "usuario"
  | "setor"
  | "exameMaterial"
  | "unidade"
  | "labApoio"
  | "procedencia";

export function mapCatalogoParaOpcoes(
  tipo: LigaLookupCatalogoTipo,
  dados: unknown[],
): LigaLookupMultiOpcao[] {
  switch (tipo) {
    case "usuario":
      return mapUsuarios(dados);
    default:
      return [];
  }
}

function mapUsuarios(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{
    id: string;
    nome: string | null;
    login: string | null;
    email: string | null;
  }>;
  return rows.map((r) => {
    const label =
      r.nome?.trim() || r.login?.trim() || `Usuário ${r.id}`;
    const partes = [`id ${r.id}`];
    if (r.login?.trim()) partes.push(`login ${r.login.trim()}`);
    if (r.email?.trim()) partes.push(r.email.trim());
    return { value: r.id, label, meta: partes.join(" · ") };
  });
}
