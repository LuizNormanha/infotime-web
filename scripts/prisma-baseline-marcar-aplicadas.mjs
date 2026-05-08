/**
 * Marca todas as pastas em api/prisma/migrations como já aplicadas no banco atual,
 * sem executar o SQL (baseline para banco existente, ex.: liga_infotime restaurado do ERP).
 *
 * Pré-requisitos:
 * - .env em api/ com DATABASE_URL / DATABASE_URL_MIGRATE apontando para o banco alvo.
 * - O usuário de migrate precisa de permissão de escrita em _prisma_migrations.
 *
 * Aviso: isso NÃO aplica DDL. Antes, rode manualmente (como superusuário) o SQL que o ERP
 * ainda não tem — ex. função `infotime_tenant_ativo_por_dominio` e GRANTs de login — ou só use
 * este script depois de alinhar o banco à mão.
 *
 * Uso (na raiz do monorepo):
 *   node scripts/prisma-baseline-marcar-aplicadas.mjs
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { spawnSync } from "node:child_process";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const apiDir = path.join(root, "api");
const migrationsDir = path.join(apiDir, "prisma", "migrations");

const dirs = fs
  .readdirSync(migrationsDir, { withFileTypes: true })
  .filter((e) => e.isDirectory())
  .map((e) => e.name)
  .filter((name) => fs.existsSync(path.join(migrationsDir, name, "migration.sql")))
  .sort();

if (dirs.length === 0) {
  console.error("Nenhuma migration encontrada em", migrationsDir);
  process.exit(1);
}

console.log(
  `Marcando ${dirs.length} migration(ões) como aplicadas (baseline). Banco: ver api/.env`,
);
for (const name of dirs) {
  const r = spawnSync(
    "npx",
    ["prisma", "migrate", "resolve", "--applied", name],
    {
      cwd: apiDir,
      stdio: "inherit",
      shell: true,
      env: process.env,
    },
  );
  if (r.status !== 0) {
    console.error(`Falhou em: ${name}`);
    process.exit(r.status ?? 1);
  }
}
console.log(
  "Baseline concluído. Próximos `npx prisma migrate deploy` em api/ só aplicam migrations novas.",
);
console.log(
  "Se `_prisma_migrations` ainda tiver nomes de pasta antigos, atualize com SQL ou `migrate resolve`.",
);
console.log(
  "Se a API usar `infotime_tenant_ativo_por_dominio` e o banco só tiver o nome legado no catálogo, rode o SQL de `20260512100000_infotime_rename_fn_tenant_ativo_por_dominio`.",
);
