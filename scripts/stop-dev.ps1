$ErrorActionPreference = 'SilentlyContinue'
$ports = 3003, 3004
$ids = Get-NetTCPConnection -State Listen -LocalPort $ports | Select-Object -ExpandProperty OwningProcess -Unique
foreach ($pid in $ids) {
    Write-Host "Stopping PID $pid"
    Stop-Process -Id $pid -Force
}
Start-Sleep -Seconds 2
Get-NetTCPConnection -State Listen -LocalPort $ports | Select-Object LocalPort, OwningProcess | Format-Table -AutoSize
