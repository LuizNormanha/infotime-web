# Padrão Prisma (PostgreSQL / liga_infotime)

## Configuração

- **Provider:** `postgresql`.
- **Schema SQL:** `liga_infotime` — usar `@@schema("liga_infotime")` nos models (Prisma 5+ com suporte a multi-schema conforme configuração do datasource).

## TLL / DDL → Prisma

- Cada tabela vira um **model**; colunas com nomes legados preservados com `@map("coluna_legada")`.
- Tabela com nome legado: `@@map("tabela_legada")` no model.
- Revisar tipos: `integer`, `varchar`, `numeric`, `timestamp`, `bytea`, `char(1)`.

## Multi-tenant

- Campo `id_tenacidade` em (quase) todos os models de negócio; relação opcional com `Tenacidade` se modelado.
- **Índices** compostos frequentes: `(id_tenacidade, id)` ou `(id_tenacidade, campo_buscavel)`.

## Domínio

- Campos **S/N** ou sim/não: preferir `enum` Prisma ou `String` com validação Zod em cima (decisão por tabela; ser consistente no módulo).
- **Monetário:** `Decimal` no Prisma + tipo adequado no TS (string/Decimal.js).
- **Timestamps:** mapear `created_at` / `updated` se existirem; timezone — ver riscos em [`fontes/04_RISCOS_DA_MIGRACAO.md`](fontes/04_RISCOS_DA_MIGRACAO.md).

## bytea (legado)

- Não modelar armazenamento de **novos** BLOBs no banco; para legado, campos `Bytes?` podem existir **temporariamente** para migração, com plano de mover para S3/MinIO (ver [`PADRAO_UPLOAD_ARQUIVOS.md`](PADRAO_UPLOAD_ARQUIVOS.md)).

## Migrations

- Uma alteração lógica por migration quando possível; revisar relações e FKs antes de `prisma migrate`.

## Seeds

- `seed.ts` idempotente; dados de domínio (aplicações, perfis) sem informação sensível.
