import { afterEach, beforeEach, describe, expect, it, vi } from "vitest";

import { BFF_TIMEOUT_MS, fetchComTimeout, PROXY_TIMEOUT_MS } from "./fetch-com-timeout";

describe("fetchComTimeout", () => {
  beforeEach(() => {
    vi.useFakeTimers();
  });

  afterEach(() => {
    vi.useRealTimers();
    vi.restoreAllMocks();
  });

  it("retorna resposta quando fetch resolve antes do timeout", async () => {
    const resposta = new Response(JSON.stringify({ ok: true }), { status: 200 });
    vi.stubGlobal("fetch", vi.fn().mockResolvedValue(resposta));

    const result = await fetchComTimeout("http://api/health");
    expect(result.status).toBe(200);
  });

  it("lança AbortError quando a requisição excede o timeout", async () => {
    vi.stubGlobal(
      "fetch",
      vi.fn().mockImplementation(
        (_url: string, options?: RequestInit) =>
          new Promise((resolve, reject) => {
            const t = setTimeout(() => resolve(new Response()), 10_000);
            options?.signal?.addEventListener("abort", () => {
              clearTimeout(t);
              reject(new DOMException("The operation was aborted", "AbortError"));
            });
          }),
      ),
    );

    const promessa = fetchComTimeout("http://api/lento", {}, 1_000);
    vi.advanceTimersByTime(1_001);

    await expect(promessa).rejects.toThrow();
  });

  it("BFF_TIMEOUT_MS é 8000 e PROXY_TIMEOUT_MS é 5000", () => {
    expect(BFF_TIMEOUT_MS).toBe(8_000);
    expect(PROXY_TIMEOUT_MS).toBe(5_000);
    expect(PROXY_TIMEOUT_MS).toBeLessThan(BFF_TIMEOUT_MS);
  });
});
