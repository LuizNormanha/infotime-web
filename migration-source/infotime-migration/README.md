# infotime-migration/

Estrutura de artefatos de migração do sistema **Infotime** (Scriptcase/PHP/MySQL) para o novo stack **infotime-web**.

Gerado em: 2026-04-29  
Base: PHP (Scriptcase), DDL PostgreSQL (schema `liga_infotime`), Screenshots de UI

---

## Estrutura por Entidade

Cada pasta de entidade segue o padrão:

```
[entidade]/
  screenshots/    ← PNGs das telas originais (renomeados semanticamente)
  database/       ← Um .tll por tabela DDL (CREATE TABLE isolado)
  scriptcase/     ← Fontes PHP da aplicação Scriptcase + events.md
  specs/          ← Documentação: telas, regras de negócio, mapa de campos
```

---

## Entidades

| # | Entidade | Módulo | Screenshots | Tabelas | PHP | Specs |
|---|---|---|---|---|---|---|
| 01 | `auth/` | Autenticação | 2 | 1 | 8 | 3 |
| 02 | `usuario/` | IAM | 2 | 2 | 4 | 4 |
| 03 | `grupo-usuario/` | IAM | 2 | 5 | 10 | 4 |
| 04 | `aplicacao/` | IAM | 3 | 2 | 4 | 3 |
| 05 | `cliente/` | Comercial | 7 | 13 | 18 | 5 |
| 06 | `concorrente/` | Comercial | 2 | 1 | 2 | 3 |
| 07 | `negociacao/` | Comercial/CRM | 7 | 7 | 26 | 5 |
| 08 | `proposta/` | Comercial | 6 | 7 | 18 | 4 |
| 09 | `contrato/` | Contratos | 6 | 3 | 12 | 4 |
| 10 | `implantacao/` | Contratos | 2 | 6 | 6 | 3 |
| 11 | `produto/` | Catálogo | 4 | 3 | 4 | 3 |
| 12 | `colaborador/` | RH | 5 | 5 | 12 | 4 |
| 13 | `cargo/` | RH | 4 | 6 | 8 | 3 |
| 14 | `colaborador-rh/` | RH | 0 | 17 | 36 | 5 |
| 15 | `colaborador-viagem/` | RH | 0 | 6 | 12 | 3 |
| 16 | `colaborador-tarefa/` | RH | 2 | 3 | 8 | 5 |
| 17 | `fornecedor/` | Compras | 2 | 6 | 16 | 3 |
| 18 | `lancamento-receita/` | Financeiro | 4 | 6 | 18 | 5 |
| 19 | `lancamento-despesa/` | Financeiro | 2 | 2 | 18 | 5 |
| 20 | `nota-fiscal/` | Financeiro | 2 | 3 | 10 | 4 |
| 21 | `boleto/` | Financeiro | 0 | 2 | 3 | 4 |
| 22 | `pix/` | Financeiro | 0 | 2 | 10 | 3 |
| 23 | `plano-conta/` | Financeiro | 3 | 5 | 16 | 5 |
| 24 | `conta-caixa/` | Financeiro | 6 | 12 | 28 | 6 |
| 25 | `retorno-cnab/` | Financeiro | 1 | 1 | 6 | 3 |
| 26 | `banco/` | Financeiro | 5 | 5 | 8 | 3 |
| 27 | `almoxarifado/` | Estoque | 11 | 10 | 24 | 4 |
| 28 | `almoxarifado-entrada/` | Estoque | 2 | 4 | 14 | 3 |
| 29 | `almoxarifado-requisicao/` | Estoque | 2 | 2 | 6 | 3 |
| 30 | `almoxarifado-baixa/` | Estoque | 2 | 3 | 4 | 3 |
| 31 | `empresa/` | Cadastros | 2 | 5 | 8 | 3 |
| 32 | `patrimonio/` | Cadastros | 0 | 9 | 8 | 2 |
| 33 | `pop-documento/` | Documentos | 3 | 3 | 4 | 3 |
| 34 | `agenda/` | Agenda | 0 | 7 | 4 | 3 |
| 35 | `avaliacao-infolab/` | InfoLAB | 3 | 3 | 2 | 3 |
| 36 | `cliente-licenca/` | InfoLAB | 2 | 6 | 4 | 3 |
| 37 | `treinamento/` | Treinamento | 1 | 2 | 3 | 2 |
| 38 | `configuracao/` | Sistema | 6 | 4 | 8 | 2 |
| 39 | `auditoria/` | Sistema | 0 | 2 | 4 | 3 |
| 40 | `portal-cliente/` | Portal | 0 | 2 | 4 | 3 |

---

## Convenção dos Arquivos

### `.tll` (Table Layout)
Arquivo DDL isolado de uma tabela do PostgreSQL.  
Formato: `CREATE TABLE nome_tabela (...);` com cabeçalho de contexto.

### `events.md`
Documentação dos eventos Scriptcase detectados nos fontes PHP.  
Inclui mapeamento para equivalentes no novo stack.

### `specs/mapa-campos.md`
Mapeamento campo a campo: coluna DB → campo UI → campo novo.  
Inclui alertas para migrações críticas (bytea, MD5, flags char(1)).

---

## Avisos de Migração

| ⚠️ | Descrição | Entidades Afetadas |
|---|---|---|
| 🔴 **Senhas MD5** | `usuario.senha` em MD5 — migrar para bcrypt | auth, usuario |
| 🔴 **Binários em bytea** | Fotos, certificados, arquivos em bytea no banco | colaborador, empresa, nota-fiscal, patrimonio |
| 🟡 **Flags char(1)** | 'S'/'N', 'A'/'I' — avaliar conversão para boolean/enum | todos |
| 🟡 **Timestamps sem timezone** | `timestamp without time zone` — definir UTC | todos |
| 🟠 **Credenciais PIX** | Certificado mTLS e OAuth em arquivos/banco | pix |
| 🟠 **Certificado NFS-e** | Certificado digital A1 em bytea | nota-fiscal |
| 🟢 **Multi-tenant** | `id_tenacidade` em todas as tabelas — implementar RLS | todos |

---

## Stack Recomendado (infotime-web)

| Camada | Tecnologia |
|---|---|
| API | NestJS (TypeScript) ou FastAPI (Python) |
| Banco | PostgreSQL 15+ (schema `liga_infotime` preservado) |
| Auth | JWT + Refresh Token + bcrypt |
| Files | MinIO ou AWS S3 |
| Cache | Redis (permissões, sessões) |
| Queue | BullMQ ou Celery (e-mails, recorrência, PIX) |
| Frontend | Next.js (React) + Tailwind CSS |
| PDF | Puppeteer ou WeasyPrint |

---

_Gerado automaticamente a partir de análise dos fontes Scriptcase, DDL PostgreSQL e screenshots do Infotime._
