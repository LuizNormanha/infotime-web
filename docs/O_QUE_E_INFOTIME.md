# O que é este template

Este documento descreve, de forma resumida, a base técnica do repositório `infotime-web`.

## Visão geral

- Monorepo com `api/` e `web/`.
- Backend em NestJS + Prisma + PostgreSQL.
- Frontend em Next.js (App Router) com rotas BFF.
- Build e tarefas orquestradas por Nx.

## Estrutura principal

- `api/`: serviços HTTP, autenticação, módulos e acesso a dados.
- `web/`: interface, rotas do app e proxy BFF para a API.
- `docs/`: documentação operacional e de arquitetura.
- `scripts/`: automações de suporte ao desenvolvimento.

## Diretrizes

- Usar contratos tipados e validação nas entradas.
- Preferir isolamento por tenant no backend.
- Tratar mudanças de schema e migrations como alterações sensíveis.
- Manter documentação e código alinhados.
