/**
 * Conversões e constante compartilhada para `Calendar` (PrimeReact) em formulários Liga.
 * Estilos do painel compacto: `liga-formulario-cadastro-base.css` (classe abaixo).
 */

/** Classe no overlay do `Calendar` — painel mais compacto (padrao Liga). */
export const LIGA_CALENDARIO_PANEL_CLASS = "liga-datepicker-panel--compact";

/**
 * API / estado: `YYYY-MM-DD` ou string ISO com hora → `Date` em **meia-noite local**
 * daquele **dia civil** (UI sem seletor de hora).
 */
export function parseValorCalendarioSomenteDia(val: unknown): Date | null {
  if (val == null || val === "") return null;
  if (typeof val !== "string") return null;
  const s = val.trim();
  if (!s) return null;
  if (/^\d{4}-\d{2}-\d{2}$/.test(s)) {
    const [y, m, d] = s.split("-").map((p) => Number(p));
    if (!y || !m || !d) return null;
    return new Date(y, m - 1, d);
  }
  const dt = new Date(s);
  if (Number.isNaN(dt.getTime())) return null;
  return new Date(dt.getFullYear(), dt.getMonth(), dt.getDate());
}

/** `Date` (componente dia) → `YYYY-MM-DD` para estado/API quando só a data importa. */
export function formatarDateCalendarioSomenteDia(d: Date | null): string | null {
  if (!d) return null;
  const ano = d.getFullYear();
  const mes = String(d.getMonth() + 1).padStart(2, "0");
  const dia = String(d.getDate()).padStart(2, "0");
  return `${ano}-${mes}-${dia}`;
}

/** Layout `dataComHorario`: leitura de ISO completo preservando instante. */
export function parseIsoParaDateComHora(val: unknown): Date | null {
  if (val == null || val === "") return null;
  if (typeof val !== "string") return null;
  const s = val.trim();
  if (!s) return null;
  const dt = new Date(s);
  return Number.isNaN(dt.getTime()) ? null : dt;
}
