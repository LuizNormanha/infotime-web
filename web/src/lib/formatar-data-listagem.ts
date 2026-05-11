/**
 * Formatação de datas/horas em células de listagem (`LigaListagemBase`).
 * Padrão visual: `dd/MM/yyyy HH:mm` em fuso local, sem sufixos `Z`/`+00:00` na string.
 * Data civil sem hora (`YYYY-MM-DD`): apenas `dd/MM/yyyy`.
 *
 * @see mcp/padroes/ui — §11 (DataTable / listagem)
 */

function extrairDateListagem(val: unknown): { d: Date; apenasDiaCivil: boolean } | null {
  if (val instanceof Date) {
    return Number.isNaN(val.getTime()) ? null : { d: val, apenasDiaCivil: false };
  }
  if (typeof val !== "string") return null;
  const s = val.trim();
  if (!s) return null;
  if (/^\d{4}-\d{2}-\d{2}$/.test(s)) {
    const [y, m, dia] = s.split("-").map((p) => Number(p));
    if (!y || !m || !dia) return null;
    return { d: new Date(y, m - 1, dia), apenasDiaCivil: true };
  }
  if (/^\d{4}-\d{2}-\d{2}[T ]\d/.test(s)) {
    const dt = new Date(s);
    return Number.isNaN(dt.getTime()) ? null : { d: dt, apenasDiaCivil: false };
  }
  return null;
}

/** Indica se o valor costuma ser data/hora vinda da API (para formatação automática na listagem). */
export function ehValorTipoDataListagem(val: unknown): boolean {
  return extrairDateListagem(val) != null;
}

/**
 * Converte ISO / `YYYY-MM-DD` / `Date` em texto legível para grade de listagem.
 * Não exibe timezone; usa componentes locais de `Date`.
 */
export function formatarDataHoraListagemPtBr(val: unknown): string {
  if (val == null || val === "") return "";
  if (typeof val === "string" && !val.trim()) return "";
  const parsed = extrairDateListagem(val);
  if (!parsed) return String(val);
  const { d, apenasDiaCivil } = parsed;
  const pad = (n: number) => String(n).padStart(2, "0");
  const dia = pad(d.getDate());
  const mes = pad(d.getMonth() + 1);
  const ano = d.getFullYear();
  if (apenasDiaCivil) return `${dia}/${mes}/${ano}`;
  return `${dia}/${mes}/${ano} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
}

/** Sempre `dd/MM/yyyy`, mesmo quando o valor original inclui hora (ex.: período “só dia” na listagem). */
export function formatarApenasDiaListagemPtBr(val: unknown): string {
  if (val == null || val === "") return "";
  const parsed = extrairDateListagem(val);
  if (!parsed) return String(val);
  const { d } = parsed;
  const pad = (n: number) => String(n).padStart(2, "0");
  return `${pad(d.getDate())}/${pad(d.getMonth() + 1)}/${d.getFullYear()}`;
}

/**
 * Idade em anos, meses e dias completos (calendário civil no fuso local),
 * no formato compacto `67a 5m 3d` (`a` = anos, `m` = meses, `d` = dias).
 */
export function formatarIdadeAnosMesesDiasCurtaPtBr(
  val: unknown,
  referencia: Date = new Date(),
): string {
  const parsed = extrairDateListagem(val);
  if (!parsed) return "";
  const nasc = new Date(
    parsed.d.getFullYear(),
    parsed.d.getMonth(),
    parsed.d.getDate(),
  );
  const ref = new Date(
    referencia.getFullYear(),
    referencia.getMonth(),
    referencia.getDate(),
  );
  if (ref < nasc) return "";
  let anos = ref.getFullYear() - nasc.getFullYear();
  let meses = ref.getMonth() - nasc.getMonth();
  let dias = ref.getDate() - nasc.getDate();
  if (dias < 0) {
    meses -= 1;
    dias += new Date(ref.getFullYear(), ref.getMonth(), 0).getDate();
  }
  if (meses < 0) {
    anos -= 1;
    meses += 12;
  }
  return `${anos}a ${meses}m ${dias}d`;
}
