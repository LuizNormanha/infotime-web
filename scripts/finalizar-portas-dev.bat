@echo off
setlocal EnableExtensions
chcp 65001 >nul 2>&1

echo.
echo Encerrando processos que escutam nas portas 3003, 3004 e 3005...
echo.

powershell -NoProfile -ExecutionPolicy Bypass -Command ^
  "$ports = @(3003, 3004, 3005); " ^
  "$killed = @{}; " ^
  "foreach ($port in $ports) { " ^
  "  $conns = Get-NetTCPConnection -LocalPort $port -State Listen -ErrorAction SilentlyContinue; " ^
  "  if (-not $conns) { Write-Host ('  Porta ' + $port + ': nenhum processo em LISTEN.'); continue } " ^
  "  foreach ($c in $conns) { " ^
  "    $id = [int]$c.OwningProcess; " ^
  "    if ($id -le 0) { continue } " ^
  "    if ($killed.ContainsKey($id)) { continue } " ^
  "    try { " ^
  "      $p = Get-Process -Id $id -ErrorAction Stop; " ^
  "      Stop-Process -Id $id -Force -ErrorAction Stop; " ^
  "      $killed[$id] = $true; " ^
  "      Write-Host ('  Porta ' + $port + ': encerrado PID ' + $id + ' (' + $p.ProcessName + ').'); " ^
  "    } catch { " ^
  "      Write-Host ('  Porta ' + $port + ': nao foi possivel encerrar PID ' + $id + ' - ' + $_.Exception.Message); " ^
  "    } " ^
  "  } " ^
  "}"

echo.
echo Concluido.
echo.
pause
