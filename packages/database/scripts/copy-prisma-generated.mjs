/**
 * Copia `src/generated/prisma` → `dist/generated/prisma` (engines .node/.wasm).
 * No Windows, outro processo Node (API a correr) ou antivírus pode bloquear ficheiros — usa retentativas.
 */
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.join(path.dirname(fileURLToPath(import.meta.url)), "..");
const srcGen = path.join(root, "src", "generated");
const dstGen = path.join(root, "dist", "generated");

function sleep(ms) {
  return new Promise((r) => setTimeout(r, ms));
}

async function main() {
  try {
    await fs.access(srcGen);
  } catch {
    console.warn("[copy-prisma-generated] %s não existe — execute prisma generate antes do build", srcGen);
    return;
  }

  const max = 8;
  let lastErr;
  for (let attempt = 0; attempt < max; attempt++) {
    try {
      await fs.rm(dstGen, { recursive: true, force: true });
    } catch {
      /* destino pode estar bloqueado na 1.ª tentativa */
    }
    try {
      await fs.mkdir(path.dirname(dstGen), { recursive: true });
      await fs.cp(srcGen, dstGen, { recursive: true, force: true });
      return;
    } catch (e) {
      lastErr = e;
      const code = e && typeof e === "object" && "code" in e ? e.code : "";
      const retryable =
        code === "EPIPE" ||
        code === "EBUSY" ||
        code === "EPERM" ||
        code === "ENOENT" ||
        (e && typeof e === "object" && "errno" in e && e.errno === 32);
      if (!retryable && attempt === 0) throw e;
      const wait = 120 * (attempt + 1) + Math.floor(Math.random() * 80);
      console.warn(
        "[copy-prisma-generated] tentativa %d/%d falhou (%s), a aguardar %d ms…",
        attempt + 1,
        max,
        code || e?.message || e,
        wait,
      );
      await sleep(wait);
    }
  }
  console.error(
    "[copy-prisma-generated] Não foi possível copiar engines para dist/. Feche outras instâncias da API (`node`/Nest) ou tente de novo.",
  );
  throw lastErr ?? new Error("copy failed");
}

await main();
