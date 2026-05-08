#!/usr/bin/env bash
# Mata processos nas portas 3003 e 3004 e sobe `npm run dev`.
# Uso (Git Bash / WSL): ./console.sh
set -u

cd "$(dirname "$0")"

echo "[console] Liberando portas 3003 e 3004..."

for porta in 3003 3004; do
    pids=$(powershell.exe -NoProfile -Command "Get-NetTCPConnection -State Listen -LocalPort $porta -ErrorAction SilentlyContinue | Select-Object -ExpandProperty OwningProcess -Unique" 2>/dev/null | tr -d '\r')
    for pid in $pids; do
        [ -z "$pid" ] && continue
        echo "[console] Encerrando PID $pid (porta $porta)"
        taskkill.exe //F //PID "$pid" //T >/dev/null 2>&1 || true
    done
done

echo "[console] Iniciando npm run dev"
exec npm run dev
