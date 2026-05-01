# ============================================================
#  install-api-nest.ps1
#  Instala o apps/api-nest no monorepo infotime-web
#  Executar na raiz: C:\prj\lann\infotime-web
# ============================================================

$ErrorActionPreference = "Stop"
$root = "C:\prj\lann\infotime-web"
$dest = "$root\apps\api-nest"

Write-Host "`n[1/4] Verificando diretorio raiz..." -ForegroundColor Cyan
if (-not (Test-Path $root)) {
    Write-Error "Diretorio $root nao encontrado. Verifique o caminho."
    exit 1
}

Write-Host "[2/4] Copiando arquivos do scaffold..." -ForegroundColor Cyan
# O script presume que o conteudo do zip foi extraido na mesma pasta
$src = Join-Path $PSScriptRoot "apps\api-nest"
if (-not (Test-Path $src)) {
    Write-Error "Pasta source $src nao encontrada. Certifique-se de extrair o zip na pasta correta."
    exit 1
}

Copy-Item -Path $src -Destination $root\apps -Recurse -Force
Write-Host "  Arquivos copiados para $dest" -ForegroundColor Green

Write-Host "[3/4] Instalando dependencias com pnpm..." -ForegroundColor Cyan
Set-Location $root
pnpm install
Write-Host "  Dependencias instaladas" -ForegroundColor Green

Write-Host "[4/4] Atualizando package.json raiz para incluir api-nest no dev..." -ForegroundColor Cyan
$pkgPath = "$root\package.json"
$pkg = Get-Content $pkgPath -Raw | ConvertFrom-Json
$pkg.scripts.dev = "pnpm --parallel --filter @infotime/api --filter @infotime/web dev"
$pkg | ConvertTo-Json -Depth 10 | Set-Content $pkgPath
Write-Host "  package.json atualizado" -ForegroundColor Green

Write-Host "`n[OK] api-nest instalado com sucesso!" -ForegroundColor Green
Write-Host "Proximos passos:"
Write-Host "  1. Copie .env.example para .env e preencha JWT_SECRET e DATABASE_URL"
Write-Host "  2. Execute: pnpm db:generate && pnpm db:push && pnpm db:seed"
Write-Host "  3. Execute: pnpm --filter @infotime/api dev"
Write-Host "  4. Acesse: http://localhost:3333/api/v1/auth/login`n"
