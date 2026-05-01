# Histórico — Stack v1: Fastify Puro (apps/api)

## Contexto

Este documento registra a primeira versão do backend do infotime-web,
implementada com Fastify puro (sem NestJS), removida e substituída
pela stack v2 (NestJS + FastifyAdapter) em Maio de 2026.

A pasta apps/api foi removida do projeto ativo em Maio/2026.
O código-fonte desta versão está arquivado nesta pasta apenas para referência histórica.
Não utilize estes arquivos para desenvolvimento.

---

## Por que foi substituído

| Limitação do Fastify puro          | Solução na stack NestJS v2                  |
|------------------------------------|---------------------------------------------|
| Sem DI container — acoplamento manual | @Injectable() — DI nativo               |
| Sem modularização forçada          | @Module() — estrutura obrigatória           |
| Guards manuais via hooks Fastify   | JwtAuthGuard, TenantGuard, RolesGuard       |
| Sem Pipes de validação             | ZodValidationPipe global                    |
| Sem Interceptors                   | AuditInterceptor, TenantInterceptor         |
| Multi-tenancy não implementado     | PrismaService + ClsService automático       |
| Baixa testabilidade                | DI container permite mocks nativos          |
| Onboarding lento — sem padrão      | Padrão NestJS documentado e replicável      |

---

## Stack v1 — removida

- **Localização original:** apps/api/
- **Framework:** Fastify 5 standalone (sem NestJS)
- **Entrypoints:** src/app.ts + src/server.ts
- **Validação:** nenhuma (sem Pipes)
- **Autenticação:** não implementada
- **Multi-tenancy:** não implementado
- **Módulos:** src/modules/ (convenção manual, sem @Module)
- **ORM:** @infotime/database (Prisma 6) — compartilhado com v2
- **Score geral:** 84/100

---

## Stack v2 — ativa em apps/api-nest

- **Localização:** apps/api-nest/
- **Framework:** NestJS 11 + FastifyAdapter
- **Performance HTTP:** mantida — mesmo engine Fastify
- **DI Container:** @Injectable() nativo
- **Guards:** JwtAuthGuard + TenantGuard + RolesGuard
- **Pipes:** ZodValidationPipe global
- **Interceptors:** AuditInterceptor + TenantInterceptor
- **Multi-tenancy:** PrismaService.$use() + nestjs-cls (AsyncLocalStorage)
- **Autenticação:** JWT access (15min) + refresh (7d) + argon2id
- **ORM:** @infotime/database (Prisma 6) — mesmo package da v1
- **Score geral:** 91/100

---

## Score comparativo

| Dimensão              | v1 Fastify puro | v2 NestJS + FastifyAdapter |
|-----------------------|-----------------|----------------------------|
| Score geral           | 84/100          | 91/100                     |
| Arquitetura           | 70              | 95                         |
| Segurança             | 40              | 92                         |
| Multi-tenancy         | 0               | 87                         |
| Testabilidade         | 50              | 88                         |
| Configuração (.env)   | 60              | 95                         |

---

## Arquivos preservados nesta pasta

Os arquivos abaixo são cópias do código legado para referência histórica:

- `package.json` — configuração do package legado
- `tsconfig.json` — configuração TypeScript legada
- `src/` — código-fonte completo da v1

**Atenção:** estes arquivos são somente leitura histórico.
O backend ativo é `apps/api-nest/`.
