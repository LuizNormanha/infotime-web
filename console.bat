@echo off
setlocal enabledelayedexpansion

cd /d "%~dp0"

echo [console] Liberando portas 3003 e 3004 (API + web)...
node scripts\liberar-portas-dev.mjs

echo [console] Iniciando npm run dev
call npm run dev

endlocal
