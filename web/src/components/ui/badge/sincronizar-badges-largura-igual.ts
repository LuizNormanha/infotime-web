/**
 * Iguala `min-width` dos badges que casam com `seletorBadges` (descendentes de `root`).
 * Útil para vários controles na mesma secção (ex.: dois Dropdown com rótulo em badge).
 */
export function sincronizarBadgesLarguraIgualNoSeletor(
  root: HTMLElement | null,
  seletorBadges: string,
): void {
  if (!root || typeof document === "undefined") return;

  const badges = Array.from(root.querySelectorAll<HTMLElement>(seletorBadges));
  badges.forEach((b) => {
    b.style.minWidth = "";
  });
  let max = 0;
  badges.forEach((b) => {
    max = Math.max(max, b.getBoundingClientRect().width);
  });
  if (max <= 0) return;
  const px = `${Math.ceil(max)}px`;
  badges.forEach((b) => {
    b.style.minWidth = px;
  });
}

/**
 * Iguala `min-width` de todos os `.liga-padrao-badge` dentro de cada grupo `[data-liga-badge-coluna]`
 * ao maior `getBoundingClientRect().width` desse grupo (listagens com várias linhas).
 */
export function sincronizarBadgesLarguraIgualNoContainer(root: HTMLElement | null): void {
  if (!root || typeof document === "undefined") return;

  root.querySelectorAll<HTMLElement>(".liga-padrao-badge").forEach((b) => {
    b.style.minWidth = "";
  });

  const colunas = new Set<string>();
  root.querySelectorAll("[data-liga-badge-coluna]").forEach((el) => {
    const c = el.getAttribute("data-liga-badge-coluna");
    if (c) colunas.add(c);
  });

  colunas.forEach((col) => {
    const badges = root.querySelectorAll<HTMLElement>(
      `[data-liga-badge-coluna="${CSS.escape(col)}"] .liga-padrao-badge`,
    );
    if (badges.length === 0) return;
    let max = 0;
    badges.forEach((b) => {
      max = Math.max(max, b.getBoundingClientRect().width);
    });
    if (max <= 0) return;
    const px = `${Math.ceil(max)}px`;
    badges.forEach((b) => {
      b.style.minWidth = px;
    });
  });
}
