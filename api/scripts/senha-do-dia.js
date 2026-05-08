/**
 * Imprime a senha do dia (mesmo algoritmo que GeradorSenhaDoDia).
 * Rode na pasta api: npm run senha-do-dia
 * Usa SUPORTE_SECRET_KEY do .env (mesma da API).
 */
require('dotenv').config();
const { createHmac } = require('crypto');

const chave = process.env.SUPORTE_SECRET_KEY;
if (!chave) {
  console.error('Defina SUPORTE_SECRET_KEY no api/.env');
  process.exit(1);
}

const timeZone = process.env.SENHA_DO_DIA_TIMEZONE || 'America/Sao_Paulo';
const dataRef = new Intl.DateTimeFormat('en-CA', {
  timeZone,
  year: 'numeric',
  month: '2-digit',
  day: '2-digit',
}).format(new Date());
const senha = createHmac('sha256', chave)
  .update(dataRef)
  .digest('hex')
  .slice(0, 8);

console.log('Fuso (IANA):', timeZone);
console.log('Data usada (YYYY-MM-DD nesse fuso):', dataRef);
console.log('Senha do dia:', senha);
