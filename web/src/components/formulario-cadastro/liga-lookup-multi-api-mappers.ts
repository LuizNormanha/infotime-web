export type LigaLookupMultiOpcao = { value: string; label: string; meta: string };

export type LigaLookupCatalogoTipo =
  | "setor"
  | "exameMaterial"
  | "unidade"
  | "labApoio"
  | "procedencia"
  | "usuario";

export function mapCatalogoParaOpcoes(
  tipo: LigaLookupCatalogoTipo,
  dados: unknown[],
): LigaLookupMultiOpcao[] {
  switch (tipo) {
    case "setor":
      return mapSetores(dados);
    case "exameMaterial":
      return mapExamesMaterial(dados);
    case "unidade":
      return mapUnidades(dados);
    case "labApoio":
      return mapLabsApoio(dados);
    case "procedencia":
      return mapProcedencias(dados);
    case "usuario":
      return mapUsuarios(dados);
    default:
      return [];
  }
}

function mapSetores(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{ id: string; descricao: string | null }>;
  return rows.map((s) => ({
    value: s.id,
    label: s.descricao?.trim() ? s.descricao.trim() : `Setor ${s.id}`,
    meta: `id ${s.id}`,
  }));
}

function mapExamesMaterial(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{
    id: string;
    codigo: string | null;
    nome: string | null;
  }>;
  return rows.map((r) => {
    const cod = r.codigo?.trim();
    const value = cod && cod.length > 0 ? cod : r.id;
    const label = r.nome?.trim() || `Exame/material ${value}`;
    const meta =
      cod && cod.length > 0
        ? `código ${cod} · id ${r.id}`
        : `id ${r.id} (sem código)`;
    return { value, label, meta };
  });
}

function mapUnidades(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{
    id: string;
    nomeFantasia: string | null;
    sigla: string | null;
    cidade: string | null;
  }>;
  return rows.map((r) => {
    const label =
      r.nomeFantasia?.trim() ||
      r.sigla?.trim() ||
      `Unidade ${r.id}`;
    const partes = [`id ${r.id}`];
    if (r.sigla?.trim()) partes.push(`sigla ${r.sigla.trim()}`);
    if (r.cidade?.trim()) partes.push(r.cidade.trim());
    return { value: r.id, label, meta: partes.join(" · ") };
  });
}

function mapLabsApoio(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{
    id: string;
    nome: string | null;
    sigla: string | null;
  }>;
  return rows.map((r) => {
    const label =
      r.nome?.trim() || r.sigla?.trim() || `Laboratório ${r.id}`;
    const partes = [`id ${r.id}`];
    if (r.sigla?.trim()) partes.push(`sigla ${r.sigla.trim()}`);
    return { value: r.id, label, meta: partes.join(" · ") };
  });
}

function mapProcedencias(dados: unknown[]): LigaLookupMultiOpcao[] {
  const rows = dados as Array<{
    id: string;
    descricao: string | null;
    sigla: string | null;
  }>;
  return rows.map((r) => {
    const label =
      r.descricao?.trim() || r.sigla?.trim() || `Procedência ${r.id}`;
    const partes = [`id ${r.id}`];
    if (r.sigla?.trim()) partes.push(`sigla ${r.sigla.trim()}`);
    return { value: r.id, label, meta: partes.join(" · ") };
  });
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
