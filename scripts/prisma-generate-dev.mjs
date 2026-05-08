/**
 * Antes de `npm run dev`: gera o Prisma client só quando necessário (evita EPERM no Windows
 * ao rodar generate repetidas vezes sem mudança no schema).
 *
 * Forçar sempre: PRISMA_FORCE_GENERATE=1 npm run dev
 * Pular sempre (avançado / risco de client velho): SKIP_PRISMA_GENERATE=1 npm run dev
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { spawnSync } from "node:child_process";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");

if (process.env.SKIP_PRISMA_GENERATE === "1") {
  console.warn("[prisma-generate-dev] SKIP_PRISMA_GENERATE=1 — não rodando prisma generate.");
  process.exit(0);
}

const schemaPath = path.join(root, "api", "prisma", "schema.prisma");
const clientIndex = path.join(
  root,
  "api",
  "generated",
  "prisma-client",
  "index.js",
);

function schemaMtimeMs() {
  try {
    return fs.statSync(schemaPath).mtimeMs;
  } catch {
    return 0;
  }
}

function clientMtimeMs() {
  try {
    return fs.statSync(clientIndex).mtimeMs;
  } catch {
    return 0;
  }
}

const force = process.env.PRISMA_FORCE_GENERATE === "1";
const clientFresh =
  clientMtimeMs() > 0 && !force && clientMtimeMs() >= schemaMtimeMs();

if (process.env.DEBUG_AGENT_TELEMETRY === "1") {
  const logLine = JSON.stringify({
    location: "scripts/prisma-generate-dev.mjs",
    message: "prisma generate skip check",
    data: {
      root,
      clientFresh,
      schemaMtimeMs: schemaMtimeMs(),
      clientMtimeMs: clientMtimeMs(),
    },
    timestamp: Date.now(),
  });
  try {
    fs.appendFileSync(path.join(root, "debug-agent-telemetry.log"), `${logLine}\n`);
  } catch {
    /* ignore */
  }
  const ingest = process.env.DEBUG_AGENT_INGEST_URL;
  if (ingest) {
    fetch(ingest, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        location: "scripts/prisma-generate-dev.mjs:ingest",
        message: "prisma skip check",
        data: { clientFresh },
        timestamp: Date.now(),
      }),
    }).catch(() => {});
  }
}

if (clientFresh) {
  console.log(
    "Prisma client já reflete o schema.prisma — pulando generate (use PRISMA_FORCE_GENERATE=1 para forçar).",
  );
  process.exit(0);
}

const script = path.join(root, "scripts", "prisma-generate-api.mjs");
const r = spawnSync(process.execPath, [script], {
  cwd: root,
  stdio: "inherit",
});
process.exit(r.status === null ? 1 : r.status);
