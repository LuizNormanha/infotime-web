/**
 * Encerra processos que escutam nas portas dev da API (3003) e do web (3004) no Windows.
 * Evita EADDRINUSE quando sobra node.exe/nest/next de uma sessão anterior.
 * Saída sempre 0 para não bloquear `npm run dev` se nada estiver escutando.
 */
import { spawnSync } from "node:child_process";
import { fileURLToPath } from "node:url";
import path from "node:path";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const script = path.join(root, "scripts", "stop-dev.ps1");

if (process.platform === "win32") {
  const r = spawnSync(
    "powershell",
    ["-NoProfile", "-ExecutionPolicy", "Bypass", "-File", script],
    { stdio: "inherit", cwd: root },
  );
  if (r.error) {
    console.warn("[dev] liberar-portas: PowerShell indisponível — use scripts/finalizar-portas-dev.bat se EADDRINUSE persistir.");
  }
}

process.exit(0);
