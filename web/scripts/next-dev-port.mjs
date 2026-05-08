/**
 * Sobe `next dev` na primeira porta livre a partir de WEB_PORT (default 3004).
 * Evita falha imediata do nx/web:dev quando outro processo já usa a porta.
 *
 * Usa `--webpack` porque, neste monorepo Nx + workspaces hoisted, o Turbopack
 * pode entrar em panic (paths `web/src/...` vs filesystem virtual `web`) em
 * HMR de `error.tsx` / `global-error.tsx`, derrubando o dev server e parecendo
 * “loop” no browser.
 */
import { execSync, spawn } from "node:child_process";
import { existsSync, readFileSync, unlinkSync } from "node:fs";
import { createServer } from "node:net";
import path from "node:path";
import { fileURLToPath } from "node:url";
import dotenv from "dotenv";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const webRoot = path.resolve(__dirname, "..");

dotenv.config({ path: path.join(webRoot, ".env") });
dotenv.config({ path: path.join(webRoot, "..", ".env") });

/** Next 16 grava JSON com pid em `.next/dev/lock` (lockDistDir). */
function pidEstaRodando(pid) {
  if (!Number.isFinite(pid) || pid <= 0) return false;
  if (process.platform === "win32") {
    try {
      const out = execSync(`tasklist /FI "PID eq ${pid}" /NH`, {
        encoding: "utf8",
        windowsHide: true,
      });
      return out.includes(String(pid));
    } catch {
      return false;
    }
  }
  try {
    process.kill(pid, 0);
    return true;
  } catch {
    return false;
  }
}

function tratarLockfileDevNext() {
  const candidatos = [
    path.join(webRoot, ".next", "dev", "lock"),
    path.join(webRoot, ".next", "lock"),
  ];
  for (const lockPath of candidatos) {
    if (!existsSync(lockPath)) continue;
    let info;
    try {
      info = JSON.parse(readFileSync(lockPath, "utf8"));
    } catch {
      continue;
    }
    const pid = info?.pid;
    if (typeof pid !== "number") continue;

    if (pidEstaRodando(pid)) {
      const url = info.appUrl ?? `http://localhost:${info.port ?? "?"}`;
      console.error(
        `[web] Já existe um next dev neste projeto (PID ${pid}, ${url}).\n` +
          `[web] Encerre-o antes de subir outro, por exemplo:\n` +
          (process.platform === "win32"
            ? `        taskkill /PID ${pid} /F`
            : `        kill ${pid}`),
      );
      process.exit(1);
    }

    try {
      unlinkSync(lockPath);
      console.warn(
        `[web] Lock órfão removido (${path.relative(webRoot, lockPath)}; PID ${pid} inexistente).`,
      );
    } catch {
      /* lock ainda aberto por outro processo */
    }
  }
}

tratarLockfileDevNext();

function portaLivre(port) {
  return new Promise((resolve) => {
    const s = createServer();
    s.unref();
    s.once("error", () => resolve(false));
    // Sem host: mesmo padrão do Node/Next (IPv6 :: quando disponível) — evita falso “livre” no Windows.
    s.listen(port, () => {
      s.close(() => resolve(true));
    });
  });
}

function resolverNextBin() {
  const candidatos = [
    path.join(webRoot, "node_modules", "next", "dist", "bin", "next"),
    path.join(webRoot, "..", "node_modules", "next", "dist", "bin", "next"),
  ];
  for (const p of candidatos) {
    if (existsSync(p)) return p;
  }
  return null;
}

const base = Number.parseInt(process.env.WEB_PORT ?? "3004", 10) || 3004;
let port = base;
let livre = false;
for (let i = 0; i < 40; i++) {
  if (await portaLivre(port)) {
    livre = true;
    break;
  }
  if (i === 0) {
    console.warn(`[web] Porta ${port} ocupada (EADDRINUSE); procurando outra…`);
  }
  port += 1;
}

if (!livre) {
  console.error(`[web] Nenhuma porta livre entre ${base} e ${port - 1}.`);
  process.exit(1);
}

if (port !== base) {
  console.warn(`[web] Next dev em http://localhost:${port} (WEB_PORT=${base} estava ocupada).`);
}

const nextBin = resolverNextBin();
const env = {
  ...process.env,
  WEB_PORT: String(port),
  PORT: String(port),
};

const child =
  nextBin != null
    ? spawn(process.execPath, [nextBin, "dev", "--webpack", "--port", String(port)], {
        stdio: "inherit",
        cwd: webRoot,
        env,
      })
    : spawn("npx", ["next", "dev", "--webpack", "--port", String(port)], {
        stdio: "inherit",
        cwd: webRoot,
        env,
        shell: true,
      });

child.on("exit", (code, signal) => {
  if (signal) process.kill(process.pid, signal);
  process.exit(code ?? 0);
});
