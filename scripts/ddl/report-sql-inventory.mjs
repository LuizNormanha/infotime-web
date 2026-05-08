/**
 * Gera docs/ddl/sql-table-references-inventory.md com achados heurísticos
 * (nomes físicos citados em migrations e código TS).
 *
 * Uso: node scripts/ddl/report-sql-inventory.mjs
 */
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..', '..');
const outMd = path.join(root, 'docs', 'ddl', 'sql-table-references-inventory.md');

function walkFiles(dir, ext, acc = []) {
  if (!fs.existsSync(dir)) return acc;
  for (const ent of fs.readdirSync(dir, { withFileTypes: true })) {
    const p = path.join(dir, ent.name);
    if (ent.isDirectory()) walkFiles(p, ext, acc);
    else if (p.endsWith(ext)) acc.push(p);
  }
  return acc;
}

function loadJsonPairs() {
  const j = JSON.parse(
    fs.readFileSync(path.join(root, 'docs', 'ddl', 'table-rename-map.json'), 'utf8'),
  );
  return j.pairs;
}

function main() {
  const pairs = loadJsonPairs();
  const oldNames = new Set(pairs.map((p) => p.from));

  const migrationSqlFiles = walkFiles(
    path.join(root, 'api', 'prisma', 'migrations'),
    '.sql',
  );
  const hitsMigrations = [];
  for (const file of migrationSqlFiles.sort()) {
    const base = path.relative(root, file);
    const txt = fs.readFileSync(file, 'utf8');
    const found = [];
    for (const name of oldNames) {
      const patterns = [
        new RegExp(`\\b${name}\\b`, 'i'),
        new RegExp(`public\\.${name}\\b`, 'i'),
        new RegExp(`"${name}"`, 'i'),
      ];
      if (patterns.some((re) => re.test(txt))) {
        found.push(name);
      }
    }
    if (found.length) {
      hitsMigrations.push({ file: base, tables: [...new Set(found)].sort() });
    }
  }

  const tsFiles = [
    ...walkFiles(path.join(root, 'api', 'src'), '.ts'),
    path.join(root, 'api', 'prisma', 'seed.ts'),
  ].filter((f) => fs.existsSync(f));

  const hitsTs = [];
  for (const file of tsFiles.sort()) {
    const base = path.relative(root, file);
    const txt = fs.readFileSync(file, 'utf8');
    const found = [];
    for (const name of oldNames) {
      if (!txt.includes(name)) continue;
      const reWord = new RegExp(`\\b${name}\\b`);
      if (reWord.test(txt)) found.push(name);
    }
    if (found.length) {
      hitsTs.push({ file: base, tables: [...new Set(found)].sort() });
    }
  }

  const lines = [
    '# Inventário heurístico: referências a nomes físicos de tabela (antes do prefixo `infotime_`)',
    '',
    `Gerado em: ${new Date().toISOString()} por \`scripts/ddl/report-sql-inventory.mjs\`.`,
    '',
    'Este relatório lista **arquivos que ainda menciam** identificadores iguais aos nomes de origem',
    'em [`docs/ddl/table-rename-map.json`](table-rename-map.json). **Migrations já aplicadas no histórico**',
    'continuam citando nomes antigos por design; o que importa para runtime é a **nova migration**',
    '[`20260514120000_rename_physical_tables_infotime`](../../api/prisma/migrations/20260514120000_rename_physical_tables_infotime/migration.sql)',
    'e o **código/Prisma atualizado** após o rename.',
    '',
    '## Objetos PostgreSQL a revisar manualmente (catálogo)',
    '',
    '- Funções e triggers com SQL dinâmico ou corpo com nomes fixos (`pg_proc`, `pg_views`).',
    '- Views/materialized views dependentes de tabelas renomeadas.',
    '- Políticas RLS referenciadas por nome em scripts externos (no PG as políticas seguem a relação ao renomear).',
    '',
    `## Migrations SQL (${hitsMigrations.length} arquivos com ao menos um match)`,
    '',
  ];

  for (const h of hitsMigrations) {
    lines.push(`- \`${h.file}\`: ${h.tables.join(', ')}`);
  }

  lines.push('', `## Código TypeScript / seed (${hitsTs.length} arquivos)`, '');

  for (const h of hitsTs) {
    lines.push(`- \`${h.file}\`: ${h.tables.join(', ')}`);
  }

  lines.push(
    '',
    '## Próximos passos',
    '',
    '- Após `prisma migrate deploy`, rodar smoke tests (login, RLS, CRUD).',
    '- Se novas funções/views forem adicionadas ao banco fora do Prisma, repetir esta varredura.',
    '',
  );

  fs.mkdirSync(path.dirname(outMd), { recursive: true });
  fs.writeFileSync(outMd, lines.join('\n'), 'utf8');
  console.log(`Escrito ${outMd}`);
}

main();
