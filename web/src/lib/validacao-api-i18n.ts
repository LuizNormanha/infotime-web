/**
 * Normaliza corpo de erro da API (Nest + class-validator) e traduz mensagens
 * para chaves `home.validation.constraints.*`.
 */

export type ErroCampoApi = {
  code: string;
  message: string;
};

/** Padrão típico de mensagem padrão em inglês do class-validator. */
function pareceMensagemPadraoIngles(message: string): boolean {
  const m = message.trim();
  return /^\w[\w.]*\s+must\s+/i.test(m) || /^\w[\w.]*\s+should\s+/i.test(m);
}

function extrairParametrosConstraint(
  code: string,
  message: string,
): Record<string, string | number> {
  const m = message;
  if (code === "minLength") {
    const x = /must be longer than or equal to (\d+) characters/i.exec(m);
    if (x) return { min: Number(x[1]) };
  }
  if (code === "maxLength") {
    const x = /must be shorter than or equal to (\d+) characters/i.exec(m);
    if (x) return { max: Number(x[1]) };
  }
  if (code === "min") {
    const x = /must not be less than (\d+)/i.exec(m);
    if (x) return { min: Number(x[1]) };
  }
  if (code === "max") {
    const x = /must not be greater than (\d+)/i.exec(m);
    if (x) return { max: Number(x[1]) };
  }
  return {};
}

const CODIGOS_CONHECIDOS = new Set([
  "minLength",
  "maxLength",
  "isString",
  "isNotEmpty",
  "matches",
  "isEmail",
  "isNumber",
  "isInt",
  "min",
  "max",
  "isBoolean",
  "isDate",
  "isUUID",
  "isOptional",
  "isDefined",
  "isArray",
]);

type Tradutor = (key: string, values?: Record<string, string | number>) => string;

function traduzirUmErro(code: string, message: string, t: Tradutor): string {
  if (!pareceMensagemPadraoIngles(message)) {
    return message;
  }
  if (!CODIGOS_CONHECIDOS.has(code)) {
    return t("fallback");
  }
  const params = extrairParametrosConstraint(code, message);
  if (code === "minLength" && params.min === undefined) {
    return t("fallback");
  }
  if (code === "maxLength" && params.max === undefined) {
    return t("fallback");
  }
  return t(`constraints.${code}`, params);
}

function normalizarMapaErros(
  corpo: Record<string, unknown>,
): Record<string, ErroCampoApi> {
  const raw = corpo.errors;
  if (!raw || typeof raw !== "object" || Array.isArray(raw)) {
    return {};
  }
  const out: Record<string, ErroCampoApi> = {};
  for (const [path, val] of Object.entries(raw)) {
    if (typeof val === "string") {
      out[path] = { code: "unknown", message: val };
    } else if (
      val &&
      typeof val === "object" &&
      "code" in val &&
      "message" in val
    ) {
      const v = val as { code: string; message: string };
      out[path] = { code: v.code, message: v.message };
    }
  }
  return out;
}

/** Mensagens legadas: `message` é array de strings em inglês. */
function inferirCodigoDeMensagemLegada(msg: string): string {
  if (/must be longer than or equal to \d+ characters/i.test(msg)) {
    return "minLength";
  }
  if (/must be shorter than or equal to \d+ characters/i.test(msg)) {
    return "maxLength";
  }
  if (/must be an email/i.test(msg)) return "isEmail";
  if (/must be a string/i.test(msg)) return "isString";
  if (/should not be empty/i.test(msg)) return "isNotEmpty";
  return "unknown";
}

function extrairCampoLegado(msg: string): string | null {
  const m = /^([\w.]+)\s+/i.exec(msg.trim());
  return m ? m[1] : null;
}

export function interpretarCorpoErroApi(corpo: unknown): {
  errosPorCampo: Record<string, ErroCampoApi>;
  mensagemGlobal: string | null;
} {
  if (!corpo || typeof corpo !== "object") {
    return { errosPorCampo: {}, mensagemGlobal: null };
  }
  const c = corpo as Record<string, unknown>;

  const porMapa = normalizarMapaErros(c);
  if (Object.keys(porMapa).length > 0) {
    return { errosPorCampo: porMapa, mensagemGlobal: null };
  }

  const msg = c.message;
  if (Array.isArray(msg)) {
    const errosPorCampo: Record<string, ErroCampoApi> = {};
    for (const item of msg) {
      if (typeof item !== "string") continue;
      const campo = extrairCampoLegado(item);
      if (!campo) continue;
      errosPorCampo[campo] = {
        code: inferirCodigoDeMensagemLegada(item),
        message: item,
      };
    }
    if (Object.keys(errosPorCampo).length > 0) {
      return { errosPorCampo, mensagemGlobal: null };
    }
  }

  if (typeof msg === "string" && msg !== "Validation failed") {
    return { errosPorCampo: {}, mensagemGlobal: msg };
  }

  return { errosPorCampo: {}, mensagemGlobal: null };
}

export function traduzirErrosValidacaoParaFormulario(
  corpo: unknown,
  t: Tradutor,
): { campos: Record<string, string>; global: string | null } {
  const { errosPorCampo, mensagemGlobal } = interpretarCorpoErroApi(corpo);
  const campos: Record<string, string> = {};
  for (const [path, { code, message }] of Object.entries(errosPorCampo)) {
    campos[path] = traduzirUmErro(code, message, t);
  }
  return {
    campos,
    global: mensagemGlobal,
  };
}

/** Texto único para toast ou alerta a partir do corpo JSON de erro HTTP (validação ou mensagem genérica). */
export function textoErroRespostaHttp(
  corpo: unknown,
  tValidacao: Tradutor,
): string {
  const { campos, global } = traduzirErrosValidacaoParaFormulario(
    corpo,
    tValidacao,
  );
  const partes = Object.values(campos);
  if (partes.length > 0) {
    return partes.join("\n");
  }
  if (global) {
    return global;
  }
  if (!corpo || typeof corpo !== "object") {
    return "";
  }
  const c = corpo as { message?: unknown };
  if (typeof c.message === "string") {
    return c.message;
  }
  if (Array.isArray(c.message) && c.message.length) {
    return c.message.map(String).join("\n");
  }
  return "";
}
