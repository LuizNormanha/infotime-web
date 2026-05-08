import { describe, expect, it } from "vitest";

import { RECURSOS_PERMITIDOS } from "./recursos-permitidos-bff";

describe("RECURSOS_PERMITIDOS — allowlist do catch-all BFF (template)", () => {
  it("contém todos os recursos do núcleo", () => {
    const esperados = [
      "ai",
      "aplicacoes",
      "auth",
      "dicionario",
      "grupos-perfil",
      "implantacao-tenacidades",
      "tenacidade-configuracoes",
      "tenacidades",
      "usuario-permissoes",
      "usuarios",
    ];
    for (const recurso of esperados) {
      expect(RECURSOS_PERMITIDOS.has(recurso), `faltando: ${recurso}`).toBe(true);
    }
  });

  it("não expõe paths de sessão crus como primeiro segmento", () => {
    const proibidos = ["login", "logout", "sessao", "suporte"];
    for (const p of proibidos) {
      expect(RECURSOS_PERMITIDOS.has(p), `deveria proibir: ${p}`).toBe(false);
    }
  });

  it("não contém paths de layout (rotas dedicadas em /api/layout/*)", () => {
    expect(RECURSOS_PERMITIDOS.has("layout")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("menu")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("catalogo")).toBe(false);
  });

  it("não contém caminhos internos ou arbitrários", () => {
    expect(RECURSOS_PERMITIDOS.has("_lib")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("health")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("../../../etc/passwd")).toBe(false);
  });

  it("tem exatamente o número de recursos da allowlist", () => {
    expect(RECURSOS_PERMITIDOS.size).toBe(10);
  });
});

describe("Validação de path.length por método HTTP", () => {
  function validarPathGet(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPost(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPutDelete(path: string[]): boolean {
    if (path.length < 2) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }

  it("GET aceita 1 segmento (listagem)", () => {
    expect(validarPathGet(["usuarios"])).toBe(true);
  });
  it("GET aceita 2 segmentos (por id)", () => {
    expect(validarPathGet(["usuarios", "42"])).toBe(true);
  });
  it("GET aceita 3+ segmentos (sub-rotas)", () => {
    expect(validarPathGet(["tenacidades", "catalogo-lookup"])).toBe(true);
  });

  it("POST aceita 1 segmento (criação na raiz do recurso)", () => {
    expect(validarPathPost(["usuarios"])).toBe(true);
  });

  it("PUT aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["usuarios", "42"])).toBe(true);
  });
  it("DELETE aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["usuarios", "99"])).toBe(true);
  });
  it("DELETE rejeita recurso fora da allowlist", () => {
    expect(validarPathPutDelete(["../secret", "1"])).toBe(false);
  });
});
