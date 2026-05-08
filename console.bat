@echo off
setlocal enabledelayedexpansion

cd /d "%~dp0"

echo [console] Liberando portas 3003 e 3004...

for %%P in (3003 3004) do (
    for /f "tokens=5" %%I in ('netstat -ano -p tcp ^| findstr /R /C:":%%P  *.*LISTENING"') do (
        echo [console] Encerrando PID %%I (porta %%P)
        taskkill /F /PID %%I /T >nul 2>&1
    )
)

echo [console] Iniciando npm run dev
call npm run dev

endlocal
