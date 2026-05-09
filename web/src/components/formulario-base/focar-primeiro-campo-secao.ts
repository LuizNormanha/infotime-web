/**
 * Foca o primeiro controle editável visível no conteúdo da seção (`.liga-formulario-secao-conteudo`).
 * Cobre inputs nativos, PrimeReact (evita inputs só de acessibilidade em `.p-hidden-accessible`)
 * e, se necessário, elementos com `tabindex` (ex.: gatilho de Dropdown sem `<input>` visível).
 *
 * Opcional: um ancestral marca **`[data-liga-foco-inicial]`** no conteúdo da seção —
 * o foco é buscado primeiro dentro desse escopo (ex.: Dropdown do Prime antes do Calendar).
 */
export function focarPrimeiroCampoHabilitado(container: HTMLElement | null): void {
  if (!container) return;

  const preferido = container.querySelector<HTMLElement>("[data-liga-foco-inicial]");
  if (preferido && focarPrimeiroDentroDoEscopo(preferido)) return;
  focarPrimeiroDentroDoEscopo(container);
}

function focarPrimeiroDentroDoEscopo(scope: HTMLElement): boolean {
  const seletorCampos =
    "input:not([disabled]):not([type='hidden']):not([type='submit']):not([type='button']):not([type='reset']), " +
    "select:not([disabled]), textarea:not([disabled])";

  const candidatos = scope.querySelectorAll<HTMLElement>(seletorCampos);
  for (const el of candidatos) {
    if (el.closest(".p-hidden-accessible")) continue;
    if (!elementoEditavelVisivel(el)) continue;
    el.focus({ preventScroll: true });
    return true;
  }

  const comTabIndex = scope.querySelectorAll<HTMLElement>(
    '[tabindex]:not([tabindex="-1"])',
  );
  for (const el of comTabIndex) {
    if (el.hasAttribute("disabled")) continue;
    if (el.closest(".p-hidden-accessible")) continue;
    if (el.getAttribute("aria-hidden") === "true") continue;
    if (el.closest("[aria-disabled='true']")) continue;
    if (el.closest(".p-disabled")) continue;
    if (!elementoEditavelVisivel(el)) continue;
    el.focus({ preventScroll: true });
    return true;
  }

  return false;
}

function elementoEditavelVisivel(el: HTMLElement): boolean {
  const r = el.getBoundingClientRect();
  if (r.width === 0 && r.height === 0) return false;
  return true;
}
