/**
 * Mitigação Windows (EPERM ao renomear query_engine): limpa artefatos antes de `prisma generate`.
 * Cliente é emitido em `api/generated/prisma-client` (fora de node_modules) — ver `schema.prisma` generator output.
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { spawnSync } from "node:child_process";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const apiGeneratedClient = path.join(root, "api", "generated", "prisma-client");

export const prismaRoots = [
  path.join(root, "node_modules", ".prisma"),
  path.join(root, "api", "node_modules", ".prisma"),
  apiGeneratedClient,
];

function sleepMs(ms) {
  try {
    Atomics.wait(new Int32Array(new SharedArrayBuffer(4)), 0, 0, ms);
  } catch {
    const end = Date.now() + ms;
    while (Date.now() < end) {
      /* fallback */
    }
  }
}

/**
 * No Windows, `unlink` pode falhar com EBUSY/EPERM enquanto antivírus ou outro Node
 * mantém o .dll.node carregado; renomear para lixo costuma liberar o destino do `rename` do Prisma.
 */
function forceRemovePath(filePath) {
  try {
    fs.unlinkSync(filePath);
    return;
  } catch {
    /* try rename trick */
  }
  if (process.platform !== "win32") return;
  try {
    const junk = `${filePath}.${process.pid}.${Date.now()}.prisma-del`;
    fs.renameSync(filePath, junk);
    try {
      fs.unlinkSync(junk);
    } catch {
      /* pode ficar órfão até reboot; destino principal foi liberado */
    }
  } catch {
    /* ignore */
  }
}

/** Saída customizada do Prisma: binários na raiz da pasta. */
function tryUnlinkEnginesFlat(dir) {
  if (!fs.existsSync(dir)) return;
  for (const name of fs.readdirSync(dir)) {
    const lower = name.toLowerCase();
    const isEngine = lower.includes("query_engine");
    const isTmp = lower.endsWith(".tmp") || /\.tmp\d+$/i.test(name);
    if (!isEngine && !isTmp) continue;
    forceRemovePath(path.join(dir, name));
  }
}

function tryUnlinkQueryEngines(prismaDir) {
  const clientDir = path.join(prismaDir, "client");
  if (!fs.existsSync(clientDir)) return;
  for (const name of fs.readdirSync(clientDir)) {
    const lower = name.toLowerCase();
    const isEngine = lower.includes("query_engine");
    const isTmp = lower.endsWith(".tmp") || /\.tmp\d+$/i.test(name);
    if (!isEngine && !isTmp) continue;
    forceRemovePath(path.join(clientDir, name));
  }
}

function windowsClearReadOnlyDir(dir) {
  if (process.platform !== "win32" || !dir || !fs.existsSync(dir)) return;
  try {
    spawnSync(
      "cmd.exe",
      ["/c", `attrib -R "${dir.replace(/\\+$/u, "")}\\*.*" /S /D`],
      { stdio: "ignore", shell: false },
    );
  } catch {
    /* ignore */
  }
}

export function limparPrismaClientGerado() {
  tryUnlinkEnginesFlat(apiGeneratedClient);
  windowsClearReadOnlyDir(apiGeneratedClient);
  try {
    fs.rmSync(apiGeneratedClient, { recursive: true, force: true });
  } catch {
    /* ignore */
  }

  for (const prismaDir of prismaRoots) {
    if (prismaDir === apiGeneratedClient) continue;
    tryUnlinkQueryEngines(prismaDir);
    windowsClearReadOnlyDir(path.join(prismaDir, "client"));
  }

  const maxAttempts = process.platform === "win32" ? 8 : 3;
  for (let attempt = 0; attempt < maxAttempts; attempt++) {
    let allGone = true;
    for (const prismaDir of prismaRoots) {
      try {
        if (fs.existsSync(prismaDir)) {
          windowsClearReadOnlyDir(prismaDir);
          fs.rmSync(prismaDir, { recursive: true, force: true });
        }
      } catch {
        allGone = false;
      }
    }
    if (allGone) break;
    tryUnlinkEnginesFlat(apiGeneratedClient);
    for (const prismaDir of prismaRoots) {
      if (prismaDir === apiGeneratedClient) continue;
      tryUnlinkQueryEngines(prismaDir);
    }
    if (attempt + 1 < maxAttempts) sleepMs(process.platform === "win32" ? 500 : 200);
  }

  if (process.platform === "win32") {
    sleepMs(800);
  }
}

function runPrismaGenerateOnce() {
  const apiRoot = path.join(root, "api");
  const prismaCli = path.join(root, "node_modules", "prisma", "build", "index.js");
  if (fs.existsSync(prismaCli)) {
    return spawnSync(process.execPath, [prismaCli, "generate"], {
      cwd: apiRoot,
      stdio: "inherit",
    });
  }
  return spawnSync("npx", ["-y", "prisma@6.7.0", "generate"], {
    cwd: apiRoot,
    stdio: "inherit",
    shell: true,
  });
}

limparPrismaClientGerado();

const maxGen = process.platform === "win32" ? 4 : 1;
let lastStatus = 1;
for (let g = 0; g < maxGen; g++) {
  const r = runPrismaGenerateOnce();
  lastStatus = r.status === null ? 1 : r.status;
  if (lastStatus === 0) break;
  if (g + 1 < maxGen) {
    console.warn(
      `[prisma-generate-api] generate falhou (tentativa ${g + 1}/${maxGen}); limpando de novo e aguardando…`,
    );
    limparPrismaClientGerado();
    sleepMs(2000);
  }
}

if (lastStatus !== 0 && process.platform === "win32") {
  console.error(`
[prisma-generate-api] EPERM no Windows ao renomear query_engine-windows.dll.node.
  Com provider "prisma-client-js", o Prisma ainda atualiza node_modules/.prisma/client
  (mesmo com output em api/generated/prisma-client); outro processo costuma segurar o DLL.
  • Encerre todos os processos Node (Nest/Next/testes) e rode de novo: npm run prisma:generate --workspace api
  • Exclua temporariamente node_modules/.prisma do antivírus / Controlled Folder Access.
`);
}

process.exit(lastStatus);
