# DDL em `docs/ddl`

Artefatos para alinhar nomenclatura física `infotime_*` no PostgreSQL:

| Artefato | Descrição |
|----------|-----------|
| [`table-rename-map.json`](table-rename-map.json) | Mapa `from` → `to` e onda (A/B); gerado por `node scripts/ddl/build-table-rename-map.mjs`. |
| [`sql-table-references-inventory.md`](sql-table-references-inventory.md) | Achados heurísticos de nomes antigos em migrations e TS; gerado por `node scripts/ddl/report-sql-inventory.mjs`. |

O SQL aplicável pelo Prisma está em [`api/prisma/migrations/20260514120000_rename_physical_tables_infotime/migration.sql`](../../api/prisma/migrations/20260514120000_rename_physical_tables_infotime/migration.sql).

Depois de alterar [`docs/liga_infotime_postgres.sql`](../liga_infotime_postgres.sql) com [`scripts/ddl-prefix-infotime-tables.mjs`](../../scripts/ddl-prefix-infotime-tables.mjs), regenere o mapa e a migration com `build-table-rename-map.mjs`.
