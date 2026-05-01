/**
 * `predev`: compila @infotime/database antes do Nest.
 * Defina SKIP_DB_BUILD=1 para saltar (ex.: já correu `pnpm --filter @infotime/database build`).
 */
import { spawnSync } from "node:child_process";
import path from "node:path";
import { fileURLToPath } from "node:url";

if (process.env.SKIP_DB_BUILD === "1") {
  process.exit(0);
}

const root = path.join(path.dirname(fileURLToPath(import.meta.url)), "..", "..", "..");
const r = spawnSync(
  "pnpm",
  ["--filter", "@infotime/database", "run", "build"],
  { stdio: "inherit", shell: true, cwd: root },
);
process.exit(r.status ?? 1);
