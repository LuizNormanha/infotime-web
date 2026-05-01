# Padrão de validações Zod

## Onde usar

- **API:** query params, body e path params por rota (`[entidade].schema.ts`).
- **Web:** schemas de formulário alinhados aos da API (pode compartilhar tipos via `@infotime/shared-types` ou duplicar com comentário de fonte).

## Boas práticas

- Separar **schema de criação** vs **atualização** (campos opcionais/partial).
- **Coerce** para números em query strings (`z.coerce.number()`).
- Mensagens em português quando expostas ao usuário final (via `errorMap` ou tradução centralizada).
- Campos de negócio que dependem do banco: validação superficial no Zod + validação forte no **service** (ex.: unicidade por tenant).

## Erros

- Falha de Zod → `400` + `code: 'VALIDATION_ERROR'` + `fieldErrors` quando aplicável.

## Alinhamento Prisma

- Não declarar campos no Zod que não existam no TLL/spec sem aprovação em `duvidas-abertas.md`.
