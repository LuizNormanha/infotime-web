import { describe, expect, it } from "vitest";

import {
  decodificarPayload,
  LOGINS_COM_ABA_AUDITORIA,
  podeVerAuditoria,
} from "./sessao-claims";

function criarJwtFake(payload: Record<string, unknown>): string {
  const enc = (obj: unknown) =>
    Buffer.from(JSON.stringify(obj)).toString("base64url");
  return `${enc({ alg: "HS256" })}.${enc(payload)}.assinatura`;
}

describe("decodificarPayload", () => {
  it("decodifica payload válido", () => {
    const token = criarJwtFake({ sub: "user-1", tenantId: "tenant-A" });
    const p = decodificarPayload(token);
    expect(p).toMatchObject({ sub: "user-1", tenantId: "tenant-A" });
  });

  it("retorna null para token com formato inválido", () => {
    expect(decodificarPayload("nao-é-jwt")).toBeNull();
    expect(decodificarPayload("a.b")).toBeNull();
  });

  it("retorna null se payload não for JSON válido", () => {
    const token = `header.${Buffer.from("não-json").toString("base64url")}.sig`;
    expect(decodificarPayload(token)).toBeNull();
  });
});

describe("podeVerAuditoria", () => {
  it("retorna true para suporte=true e email suporte@…", () => {
    expect(
      podeVerAuditoria({ suporte: true, email: "suporte@empresa.com" }),
    ).toBe(true);
  });

  it("retorna true para suporte=true e email implantacao@…", () => {
    expect(
      podeVerAuditoria({ suporte: true, email: "implantacao@empresa.com" }),
    ).toBe(true);
  });

  it("retorna false se suporte=false", () => {
    expect(
      podeVerAuditoria({ suporte: false, email: "suporte@empresa.com" }),
    ).toBe(false);
  });

  it("retorna false para usuário comum com suporte=true mas email diferente", () => {
    expect(
      podeVerAuditoria({ suporte: true, email: "joao@empresa.com" }),
    ).toBe(false);
  });

  it("retorna false sem campo email", () => {
    expect(podeVerAuditoria({ suporte: true })).toBe(false);
  });
});

describe("LOGINS_COM_ABA_AUDITORIA", () => {
  it("contém suporte e implantacao", () => {
    expect(LOGINS_COM_ABA_AUDITORIA.has("suporte")).toBe(true);
    expect(LOGINS_COM_ABA_AUDITORIA.has("implantacao")).toBe(true);
  });

  it("não contém logins comuns", () => {
    expect(LOGINS_COM_ABA_AUDITORIA.has("admin")).toBe(false);
    expect(LOGINS_COM_ABA_AUDITORIA.has("usuario")).toBe(false);
  });
});
