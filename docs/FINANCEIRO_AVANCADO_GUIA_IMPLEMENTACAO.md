# Financeiro avançado no Infotime-web — o que mudou no banco e no código

Este texto resume, em linguagem simples, **o que foi preparado no PostgreSQL** (tabelas novas e alteradas) e **o que já aparece na aplicação** (API Nest em `api/`, frontend Next em `web/`). Serve para onboarding, revisão de deploy e alinhamento entre time de produto e engenharia.

As alterações de banco estão em **sete migrações ordenadas** em `api/prisma/migrations/`, com nomes que começam por `2026052010…` e prefixo `financeiro_fatia_*`. Cada fatia que cria tabela com `id_tenacidade` também aplica **RLS** (Row Level Security) e **GRANTs** para os papéis usados no projeto, para que só o tenant da sessão veja os dados.

> **Nota importante:** muitas tabelas novas **ainda não têm modelos correspondentes no `schema.prisma`**. O banco já pode receber dados via SQL ou evolução futura do Prisma; até lá, a API não usa o cliente Prisma para CRUD completo nessas tabelas.

---

## 1. Tabelas alteradas (sem criar tabela nova)

| Tabela física | O que foi acrescentado | Para que serve (ideia de negócio) |
|---------------|----------------------|-----------------------------------|
| `infotime_plano_conta` | Colunas `natureza_dre`, `natureza_dfc`, `grupo_contabil` (texto curto) + índices | Classificar contas para **DRE**, **DFC** e agrupamentos de **balanço** sem misturar conceitos. |
| `infotime_cliente` | Colunas `score_inadimplencia`, `classificacao_score` | Guardar um **resumo rápido** de risco no cadastro do cliente (pode ser alimentado por job ou rotina de score). |
| `infotime_conta_caixa` | Coluna `compoe_saldo_dfc` (padrão “sim”) | Marcar se a conta entra no **saldo usado na DFC** (fluxo de caixa). A fatia D **exige** que esta tabela já exista; caso contrário a migration falha de propósito com mensagem clara. |

---

## 2. Tabelas novas (por “fatia” de migration)

### Fatia A — só alteração em `infotime_plano_conta`

Nenhuma tabela nova; apenas a alteração da secção 1.

### Fatia B — régua de cobrança

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_regua_cobranca` | Cabeçalho da régua (descrição, ativo, tenant). |
| `infotime_regua_cobranca_etapa` | Passos no tempo (dias após vencimento, canal, mensagem, ordem). |
| `infotime_regua_cobranca_regra` | Quem entra na régua (ex.: cliente, tipo de agente, valor mínimo, prioridade). |
| `infotime_regua_cobranca_envio` | **Log de envios** ligados a lançamento de receita e etapa (status, tentativas, etc.). |

### Fatia C — custo de exame e score de cliente

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_exame_custo` | Custo por código de exame e competência (reagente, material, mão de obra; total calculado). |
| `infotime_cliente_score` | Histórico/agregado de **score** por cliente (atraso, percentuais, valores em aberto, data do cálculo). |

### Fatia D — extrato bancário e PIX

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_extrato_bancario_lote` | Um **arquivo/importação** de extrato por conta-caixa e período. |
| `infotime_extrato_bancario_linha` | **Linhas** do extrato (valor, tipo, histórico, conciliação com receita/despesa). |
| `infotime_pix_configuracao` | Credenciais e parâmetros PIX por conta (campos sensíveis previstos no modelo). |
| `infotime_pix_cobranca` | Cobrança PIX (`tx_id`, QR, status, vínculo opcional com receita). |

### Fatia E — portal (convênio / usuário externo)

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_portal_usuario` | Usuário externo (e-mail, hash de senha, vínculo opcional com cliente). |
| `infotime_portal_acesso_log` | **Auditoria** de acessos e ações no portal. |

### Fatia F — contabilidade auxiliar

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_conta_saldo` | Saldo por **plano de contas** e **competência** (abertura/fechamento). |
| `infotime_lancamento_contabil` | Lançamento em **partidas dobradas** (débito/crédito no plano de contas, valor, origem opcional). |

### Fatia G — comportamento, IA e alertas

| Tabela | Função resumida |
|--------|-----------------|
| `infotime_cliente_comportamento_pagamento` | Estatísticas de **como o cliente paga** (atraso, faixas de dias, ticket médio). |
| `infotime_previsao_caixa_ia` | Registro de uma **previsão de caixa** gerada (valores otimista/pessimista, narrativa, tokens, modelo). |
| `infotime_alerta_financeiro` | **Alertas** abertos/resolvidos, com tipo, severidade e vínculo opcional a receita/despesa. |

---

## 3. O que já está implementado na aplicação (Infotime-web)

### Backend (`api/`)

- **Cockpit financeiro** — `GET /financeiro/cockpit` agrega KPIs e listas a partir de lançamentos de receita/despesa (dados reais do tenant no JWT + RLS).
- **Rotas preparadas para evolução** (resposta JSON estável; hoje retornam estrutura vazia ou zeros, prontas para ligar consultas às novas tabelas/campos):
  - `GET /financeiro/aging` — aging de recebíveis.
  - `GET /financeiro/dre` — DRE sintética.
  - `GET /financeiro/regua/cobranca` — listagem de réguas.
- **Filas (BullMQ + Redis)** — módulo global de filas com fila `financeiro`, processador inicial e utilitários de **idempotência** de `jobId` e logs de job (`api/src/filas/`). Serve de base para jobs assíncronos (ex.: envio de cobrança, recálculo de score).
- **Smoke de staging** — script `api/scripts/smoke-financeiro.mjs` e comando `npm run smoke:financeiro` (ver `ai/README.md`, secção 4.1).

### Frontend (`web/`)

- **Gestão integrada / cockpit** — área em `web/src/features/financeiro-cockpit/` e página em `/financeiro` com gráficos, KPIs e atalhos.
- **Shell de navegação** do módulo financeiro (links entre gestão, pagar e receber).
- **Contas a pagar e a receber** sob o prefixo `/financeiro/pagar` e `/financeiro/receber` (integração com formulários Liga já existentes no projeto).

### O que ainda **não** está coberto só por estas migrations

- **CRUD completo** no Nest/Prisma para régua, extrato, PIX, portal, lançamentos contábeis, etc. — o modelo físico existe; falta expor serviços/controllers conforme prioridade do produto.
- **Telas** específicas para cada nova tabela (exceto o cockpit e fluxos já citados). A rota `web/src/app/financeiro/cobranca/regua/page.tsx` aponta para um componente em `@/features/financeiro-regua/` — **confira no repositório** se essa pasta já está presente no branch que você usa; se não estiver, trate como rota reservada até a feature ser entregue.

---

## 4. Ordem segura de deploy (resumo)

1. Aplicar migrações antigas do baseline até existir `infotime_conta_caixa` **antes** da fatia D.
2. Rodar `prisma migrate deploy` em **staging**.
3. Executar o smoke (`smoke:financeiro`) com JWT de tenant de teste.
4. Só então promover para produção, mantendo **PRs pequenos** (uma fatia ou um conjunto coerente por vez).

---

## 5. Onde aprofundar

- SQL fonte: `api/prisma/migrations/20260520100000_*` … `20260520100600_*`.
- Runbook e variáveis: `ai/README.md` (secção 4.1).
- Domínio e regras para IA/humanos: pasta `ai/domains/` quando houver documentação alinhada ao tema financeiro.

---

*Documento gerado a partir do estado do repositório; atualize esta página quando novos endpoints ou modelos Prisma forem adicionados.*
