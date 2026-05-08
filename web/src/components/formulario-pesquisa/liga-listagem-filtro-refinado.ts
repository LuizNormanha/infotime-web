import type {
  LigaColunaListagem,
  LigaFiltroRefinadoValor,
} from "./liga-listagem.types";
import { resolverMascaraBuscaServidor } from "./liga-listagem-mascara-busca";

import { ehValorTipoDataListagem } from "@/lib/formatar-data-listagem";
import { somenteDigitos } from "@/lib/mascara-para-api";

function valorComoData(valor: unknown): Date | null {
  if (valor === null || valor === undefined) return null;
  if (valor instanceof Date && !Number.isNaN(valor.getTime())) return valor;
  if (typeof valor === "string" || typeof valor === "number") {
    const d = new Date(valor);
    return Number.isNaN(d.getTime()) ? null : d;
  }
  return null;
}

/** Mesmo dia civil que `ref` (hora ignorada). */
function linhaMesmoDiaQueRef(valorLinha: unknown, ref: Date): boolean {
  const d = valorComoData(valorLinha);
  if (!d) return false;
  const a = new Date(d.getFullYear(), d.getMonth(), d.getDate());
  const b = new Date(ref.getFullYear(), ref.getMonth(), ref.getDate());
  return a.getTime() === b.getTime();
}

/** Compara só dia civil (UTC date parts) para evitar bugs de fuso em DATE puro. */
function mesmoDiaOuIntervalo(
  valorLinha: unknown,
  de: Date | null,
  ate: Date | null,
): boolean {
  const d = valorComoData(valorLinha);
  if (!d || !de || !ate) return false;
  const t = d.getTime();
  const i = new Date(de);
  i.setHours(0, 0, 0, 0);
  const f = new Date(ate);
  f.setHours(23, 59, 59, 999);
  return t >= i.getTime() && t <= f.getTime();
}

/** Intervalo inclusivo no tempo (fronteira do dia local); aceita só `de`, só `ate` ou ambos. */
function linhaNoIntervaloLimites(
  valorLinha: unknown,
  de: Date | null,
  ate: Date | null,
): boolean {
  const d = valorComoData(valorLinha);
  if (!d) return false;
  const t = d.getTime();
  if (de) {
    const i = new Date(de);
    i.setHours(0, 0, 0, 0);
    if (t < i.getTime()) return false;
  }
  if (ate) {
    const f = new Date(ate);
    f.setHours(23, 59, 59, 999);
    if (t > f.getTime()) return false;
  }
  return true;
}

function modoIntervaloDatasFv(fv: {
  entreDatas?: boolean;
  de: Date | null;
  ate: Date | null;
}): boolean {
  if (fv.entreDatas === true) return true;
  /* Legado: dois valores sem flag (UI antiga em intervalo). */
  return fv.de != null && fv.ate != null && fv.entreDatas !== false;
}

/** Alinha comparação do filtro texto com máscaras (CPF, CNPJ, data na grade, etc.). */
function textoRefinadoContemNaCelula(
  col: LigaColunaListagem,
  fv: { tipo: "texto"; contem: string },
  raw: unknown,
): boolean {
  const t = fv.contem.trim();
  if (!t) return true;
  const tipoMascara = resolverMascaraBuscaServidor(col);
  if (
    tipoMascara === "cpf" ||
    tipoMascara === "cnpj" ||
    tipoMascara === "cep" ||
    tipoMascara === "telefone"
  ) {
    const fd = somenteDigitos(t);
    const rd = somenteDigitos(String(raw ?? ""));
    if (!fd) return true;
    return rd.includes(fd);
  }
  if (tipoMascara === "data") {
    const m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(t);
    if (m) {
      const isoDia = `${m[3]}-${m[2]}-${m[1]}`;
      const rawStr = raw === null || raw === undefined ? "" : String(raw);
      return rawStr.includes(isoDia) || rawStr.includes(t);
    }
    const s =
      raw === null || raw === undefined ? "" : String(raw).toLowerCase();
    return s.includes(t.toLowerCase());
  }
  const s =
    raw === null || raw === undefined ? "" : String(raw).toLowerCase();
  return s.includes(t.toLowerCase());
}

function linhaPassaFiltro(
  row: Record<string, unknown>,
  col: LigaColunaListagem,
  fv: LigaFiltroRefinadoValor,
): boolean {
  const raw = row[col.campo];
  switch (fv.tipo) {
    case "texto": {
      return textoRefinadoContemNaCelula(col, fv, raw);
    }
    case "inteiro": {
      const want = fv.igual.trim();
      if (!want) return true;
      const got =
        raw === null || raw === undefined ? "" : String(raw).trim();
      return got === want;
    }
    case "decimal": {
      const want = fv.igual.trim().replace(",", ".");
      if (!want) return true;
      const got =
        raw === null || raw === undefined ? "" : String(raw).trim().replace(",", ".");
      return got === want;
    }
    case "data": {
      if (!fv.de && !fv.ate) return true;
      if (!ehValorTipoDataListagem(raw)) return false;
      if (!modoIntervaloDatasFv(fv)) {
        if (!fv.de) return true;
        return linhaMesmoDiaQueRef(raw, fv.de);
      }
      return linhaNoIntervaloLimites(raw, fv.de, fv.ate);
    }
    case "dataIntervaloInclusao": {
      if (!fv.de && !fv.ate) return true;
      if (!modoIntervaloDatasFv(fv)) {
        if (!fv.de) return true;
        return linhaMesmoDiaQueRef(raw, fv.de);
      }
      if (fv.de && fv.ate) {
        return mesmoDiaOuIntervalo(raw, fv.de, fv.ate);
      }
      return linhaNoIntervaloLimites(raw, fv.de, fv.ate);
    }
    case "enum": {
      if (fv.valores.length === 0) return true;
      const got =
        raw === null || raw === undefined ? "" : String(raw).trim();
      return fv.valores.includes(got);
    }
    default:
      return true;
  }
}

export function aplicarFiltrosRefinados(
  linhas: Record<string, unknown>[],
  colunas: LigaColunaListagem[],
  filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
): Record<string, unknown>[] {
  let out = linhas;
  for (const col of colunas) {
    if (!col.filtroRefinado) continue;
    const fv = filtros[col.campo];
    if (!fv) continue;
    out = out.filter((row) => linhaPassaFiltro(row, col, fv));
  }
  return out;
}

export function rotuloChipFiltroRefinado(
  col: LigaColunaListagem,
  fv: LigaFiltroRefinadoValor,
): string {
  const cab = col.cabecalho;
  switch (fv.tipo) {
    case "texto":
      return `${cab}: ${fv.contem}`;
    case "inteiro":
    case "decimal":
      return `${cab}: ${fv.igual}`;
    case "data":
    case "dataIntervaloInclusao": {
      const intervaloUi = modoIntervaloDatasFv(fv);
      if (!intervaloUi && fv.de) {
        const s = fv.de.toLocaleDateString("pt-BR", {
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
        });
        return `${cab}: ${s}`;
      }
      const p = [fv.de, fv.ate]
        .filter(Boolean)
        .map((d) =>
          d
            ? d.toLocaleDateString("pt-BR", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
              })
            : "",
        )
        .join(" — ");
      return `${cab}: ${p}`;
    }
    case "enum": {
      const op = col.filtroRefinado?.opcoes ?? [];
      const labels = fv.valores.map((v) => {
        const o = op.find((x) => x.valor === v);
        return o?.rotulo ?? v;
      });
      return `${cab}: ${labels.join(", ")}`;
    }
    default:
      return cab;
  }
}
