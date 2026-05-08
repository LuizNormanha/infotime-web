/**
 * Prefixa nomes físicos de tabelas no DDL exportado (docs/liga_infotime_postgres.sql).
 * - `foo` → `infotime_foo`
 * - `infolab_*` legível como Infotime → `infotime_*` (evita `infotime_infolab_*`)
 * - já prefixadas com `infotime_` permanecem
 *
 * Uso: node scripts/ddl-prefix-infotime-tables.mjs
 */
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..');
const ddlPath = path.join(root, 'docs', 'liga_infotime_postgres.sql');

function escapeRe(s) {
  return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

let sql = fs.readFileSync(ddlPath, 'utf8');

const createRe = /^CREATE TABLE ([a-zA-Z_][a-zA-Z0-9_]*) \(/gm;
const names = new Set();
let m;
while ((m = createRe.exec(sql)) !== null) {
  names.add(m[1]);
}

/** @type {Record<string, string>} */
const mapping = {};
for (const name of names) {
  if (name.startsWith('infotime_')) {
    mapping[name] = name;
  } else if (name.startsWith('infolab_')) {
    mapping[name] = 'infotime_' + name.slice('infolab_'.length);
  } else {
    mapping[name] = 'infotime_' + name;
  }
}

const pairs = Object.entries(mapping).sort((a, b) => b[0].length - a[0].length);

for (const [oldName, newName] of pairs) {
  if (oldName === newName) continue;
  const o = escapeRe(oldName);
  sql = sql.replace(new RegExp(`public\\.${o}\\b`, 'g'), `public.${newName}`);
  sql = sql.replace(new RegExp(`^CREATE TABLE ${o} \\(`, 'gm'), `CREATE TABLE ${newName} (`);
  sql = sql.replace(new RegExp(`REFERENCES ${o}\\(`, 'g'), `REFERENCES ${newName}(`);
  sql = sql.replace(new RegExp(`^-- DROP TABLE ${o};`, 'gm'), `-- DROP TABLE ${newName};`);
  sql = sql.replace(new RegExp(`^-- public\\.${o} `, 'gm'), `-- public.${newName} `);
}

const header = `-- DDL exportado do banco Liga Infotime (PostgreSQL), com prefixo físico \`infotime_\` em todas as tabelas.
-- Objetivo: alinhar nomenclatura ao padrão de produto e permitir coexistência futura com tabelas \`infolab_*\` no mesmo cluster.
-- Gerado/atualizado por scripts/ddl-prefix-infotime-tables.mjs — não aplicar em produção sem migration planejada e ajuste do Prisma @@map.

`;

if (!sql.startsWith('-- DDL exportado do banco Liga Infotime')) {
  sql = header + sql;
}

fs.writeFileSync(ddlPath, sql, 'utf8');
console.log(`Atualizado: ${ddlPath} (${names.size} tabelas mapeadas)`);
