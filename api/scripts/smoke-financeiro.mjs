#!/usr/bin/env node
/**
 * Smoke rápido pós-deploy em staging (financeiro).
 * Uso (na máquina com API acessível):
 *   API_SMOKE_URL=http://127.0.0.1:3003 API_SMOKE_TOKEN="<JWT>" node scripts/smoke-financeiro.mjs
 * Ou: npm run smoke:financeiro -w api
 *
 * Por omissão exige HTTP 200 em GET /financeiro/cockpit.
 * GET opcionais (aging, dre, regua/cobranca): se 404, avisa; outro erro ≠200 falha.
 * SMOKE_STRICT=1 — rotas opcionais também têm de responder 200.
 */

const base = (process.env.API_SMOKE_URL || 'http://127.0.0.1:3003').replace(/\/$/, '');
const token = process.env.API_SMOKE_TOKEN;
const strict = process.env.SMOKE_STRICT === '1';

if (!token || !String(token).trim()) {
  console.error('Defina API_SMOKE_TOKEN (JWT com tenant válido).');
  process.exit(1);
}

const opcionais = [
  '/financeiro/aging',
  '/financeiro/dre',
  '/financeiro/regua/cobranca',
];
const obrigatorios = ['/financeiro/cockpit'];

async function get(path) {
  const url = `${base}${path}`;
  const res = await fetch(url, {
    headers: { Authorization: `Bearer ${token}` },
  });
  return res;
}

let code = 0;
for (const path of obrigatorios) {
  const res = await get(path);
  const ok = res.status === 200;
  console.log(`${path} → ${String(res.status)}${ok ? ' OK' : ' FALHA'}`);
  if (!ok) code = 1;
}

for (const path of opcionais) {
  const res = await get(path);
  const ok = res.status === 200;
  const skip = res.status === 404;
  if (ok) {
    console.log(`${path} → ${String(res.status)} OK`);
  } else if (skip && !strict) {
    console.log(`${path} → 404 (ignorado; defina SMOKE_STRICT=1 para exigir esta rota)`);
  } else {
    console.log(`${path} → ${String(res.status)} FALHA`);
    code = 1;
  }
}

process.exit(code);
