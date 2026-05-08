import { afterEach, describe, expect, it } from "vitest";

import { isAuthStrict, resolveBackendApiUrl } from "./resolve-backend-api-url";

describe("resolveBackendApiUrl", () => {
  afterEach(() => {
    delete process.env.API_URL;
    delete process.env.AUTH_STRICT;
  });

  it("usa API_URL quando definida", () => {
    process.env.API_URL = "http://api:3003";
    expect(resolveBackendApiUrl()).toBe("http://api:3003");
  });

  it("fallback localhost:3003 quando API_URL ausente", () => {
    expect(resolveBackendApiUrl()).toBe("http://localhost:3003");
  });
});

describe("isAuthStrict", () => {
  afterEach(() => {
    delete process.env.AUTH_STRICT;
  });

  it("é true para 1, true, yes (case insensitive)", () => {
    process.env.AUTH_STRICT = "1";
    expect(isAuthStrict()).toBe(true);
    process.env.AUTH_STRICT = "TRUE";
    expect(isAuthStrict()).toBe(true);
    process.env.AUTH_STRICT = "Yes";
    expect(isAuthStrict()).toBe(true);
  });

  it("é false quando ausente ou outro valor", () => {
    expect(isAuthStrict()).toBe(false);
    process.env.AUTH_STRICT = "0";
    expect(isAuthStrict()).toBe(false);
  });
});
