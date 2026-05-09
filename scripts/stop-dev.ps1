$ErrorActionPreference = 'SilentlyContinue'
$ports = @(3003, 3004)
foreach ($port in $ports) {
  $conns = Get-NetTCPConnection -LocalPort $port -State Listen -ErrorAction SilentlyContinue
  if (-not $conns) { continue }
  foreach ($c in @($conns)) {
    $procId = [int]$c.OwningProcess
    if ($procId -le 0) { continue }
    Write-Host "[dev] Porta ${port}: encerrando PID $procId"
    Stop-Process -Id $procId -Force -ErrorAction SilentlyContinue
  }
}
