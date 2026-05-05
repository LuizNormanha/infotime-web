export const APP_THEME_KEY = "infotime.theme";

export type AppTheme = "light" | "dark";

export function readStoredAppTheme(): AppTheme {
  try {
    const v =
      localStorage.getItem(APP_THEME_KEY) ?? localStorage.getItem("infotime.loginTheme");
    return v === "dark" ? "dark" : "light";
  } catch {
    return "light";
  }
}

export function persistAppTheme(theme: AppTheme) {
  try {
    localStorage.setItem(APP_THEME_KEY, theme);
  } catch {
    /* ignore */
  }
}

export function applyAppThemeToDocument(theme: AppTheme) {
  document.documentElement.setAttribute("data-theme", theme);
}
