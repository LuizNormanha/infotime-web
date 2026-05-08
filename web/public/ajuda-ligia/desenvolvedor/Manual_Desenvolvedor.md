# Manual do Desenvolvedor — Infotime Web

**Sistema:** Infotime Web
**Público:** Desenvolvedor backend, frontend, full-stack, arquiteto, DevOps
**Foco:** "Como construo, integro, mantenho e estendo este sistema?"
**Versão:** 1.0 — Maio/2026

> Este manual é o ponto de partida para quem vai **escrever código** no Infotime Web — adicionar módulos, criar telas, evoluir o schema, integrar com sistemas externos. Aqui você encontra arquitetura, convenções, padrões de código, fluxo de desenvolvimento, testes e deploy. Para usar o sistema (operação) consulte o Manual do Usuário; para diagnosticar incidentes em produção consulte o Manual Técnico.

---

## Sumário

### Parte 1 — Visão de arquitetura
1. [Filosofia do projeto](#1-filosofia-do-projeto)
2. [Arquitetura em alto nível](#2-arquitetura-em-alto-nível)
3. [Estrutura do monorepo](#3-estrutura-do-monorepo)
4. [Stack tecnológico completo](#4-stack-tecnológico-completo)

### Parte 2 — Setup e desenvolvimento local
5. [Pré-requisitos](#5-pré-requisitos)
6. [Configuração inicial](#6-configuração-inicial)
7. [Subindo o ambiente local](#7-subindo-o-ambiente-local)
8. [Comandos do dia a dia](#8-comandos-do-dia-a-dia)

### Parte 3 — Backend (NestJS + Prisma)
9. [Estrutura de um módulo NestJS](#9-estrutura-de-um-módulo-nestjs)
10. [Padrão controller → service → Prisma](#10-padrão-controller--service--prisma)
11. [DTOs e validação com class-validator](#11-dtos-e-validação-com-class-validator)
12. [Decorators de tenant e usuário](#12-decorators-de-tenant-e-usuário)
13. [Tratamento de exceções](#13-tratamento-de-exceções)
14. [Schema Prisma e migrations](#14-schema-prisma-e-migrations)
15. [Row-Level Security (RLS) em detalhe](#15-row-level-security-rls-em-detalhe)
16. [Auditoria estrutural](#16-auditoria-estrutural)

### Parte 4 — Frontend (Next.js + React)
17. [Estrutura do App Router](#17-estrutura-do-app-router)
18. [Componentes base Liga*](#18-componentes-base-liga)
19. [Padrão Listagem + Formulário](#19-padrão-listagem--formulário)
20. [Layouts dinâmicos por grupo de usuário](#20-layouts-dinâmicos-por-grupo-de-usuário)
21. [Sistema de abas (LigaSistemaAbas)](#21-sistema-de-abas-ligasistemaabas)
22. [BFF e allowlist](#22-bff-e-allowlist)
23. [Internacionalização (next-intl)](#23-internacionalização-next-intl)

### Parte 5 — Convenções e padrões
24. [Nomenclatura: pt-BR para domínio, inglês para framework](#24-nomenclatura-pt-br-para-domínio-inglês-para-framework)
25. [Documentação de domínio em ai/domains](#25-documentação-de-domínio-em-aidomains)
26. [Regras do Cursor (.cursor/rules)](#26-regras-do-cursor-cursorrules)
27. [Boas práticas gerais](#27-boas-práticas-gerais)

### Parte 6 — Construindo coisas novas
28. [Adicionando um novo módulo (passo a passo)](#28-adicionando-um-novo-módulo-passo-a-passo)
29. [Adicionando uma nova tela CRUD](#29-adicionando-uma-nova-tela-crud)
30. [Modificando o schema](#30-modificando-o-schema)
31. [Adicionando um novo recurso BFF](#31-adicionando-um-novo-recurso-bff)
32. [Implementando uma integração externa](#32-implementando-uma-integração-externa)

### Parte 7 — Qualidade e testes
33. [Estratégia de testes](#33-estratégia-de-testes)
34. [Testes unitários (Jest)](#34-testes-unitários-jest)
35. [Testes de componente (Vitest)](#35-testes-de-componente-vitest)
36. [Lint e formatação](#36-lint-e-formatação)

### Parte 8 — Deploy e operações
37. [Build e empacotamento](#37-build-e-empacotamento)
38. [Variáveis de ambiente](#38-variáveis-de-ambiente)
39. [Deploy em homologação e produção](#39-deploy-em-homologação-e-produção)
40. [Migrações em produção](#40-migrações-em-produção)
41. [Monitoramento e logs](#41-monitoramento-e-logs)

### Parte 9 — Git, code review e colaboração
42. [Workflow Git](#42-workflow-git)
43. [Commits e mensagens](#43-commits-e-mensagens)
44. [Pull requests e code review](#44-pull-requests-e-code-review)

### Parte 10 — Referências
45. [Glossário técnico](#45-glossário-técnico)
46. [Mapa de pastas e responsabilidades](#46-mapa-de-pastas-e-responsabilidades)
47. [Recursos externos](#47-recursos-externos)

---

# Parte 1 — Visão de arquitetura

## 1. Filosofia do projeto

O Infotime Web é construído com cinco princípios não negociáveis. Entendê-los antes de escrever código economiza retrabalho.

### 1.1 Multi-tenant nativo via banco

Isolamento entre laboratórios é responsabilidade do **PostgreSQL**, não do aplicativo. Toda tabela de negócio tem `id_tenacidade BigInt` e policy RLS. **Você nunca precisa lembrar de filtrar por tenant** — o banco recusa devolver dados de outro mesmo se você esquecer. Isso é defesa em profundidade.

### 1.2 Auditoria estrutural

Toda tabela de negócio tem três campos imutáveis preenchidos automaticamente:

- `id_usuario_auditoria` — quem fez a operação
- `endereco_ip_auditoria` — de onde veio
- `nome_aplicacao_auditoria` — qual aplicação (sempre `"infotime-web"`)

Ninguém pode "esquecer" de auditar — o filtro/extension Prisma preenche.

### 1.3 Nomenclatura híbrida pt-BR/inglês

Domínio em pt-BR (tabelas `infolab_*`, classes `Tenacidade`, variáveis `idCliente`); framework em inglês (`Controller`, `Service`, `Dto`, `useState`). Isso reflete que o **negócio é brasileiro** mas o **ferramental é internacional**.

### 1.4 Layouts dinâmicos sem mudar código

Cada formulário tem layout padrão em código + layout customizável por grupo de usuário em banco. Cliente que precisa esconder/reordenar campos **não exige novo deploy**. Configuração via tela.

### 1.5 Código simples e legível

Da `global.mdc`: *"Preferir código simples e legível. Não criar soluções desnecessariamente complexas. Reutilizar padrões existentes antes de criar novos."* Antes de criar abstração nova, **busque padrão existente** no monorepo.

---

## 2. Arquitetura em alto nível

```
┌──────────────────────────────────────────────────────────────┐
│                        Browser (cliente)                      │
│              Next.js App Router + React 19                    │
│           Componentes Liga* + PrimeReact + next-intl          │
└──────────────────┬───────────────────────────────────────────┘
                   │ HTTP/HTTPS com cookie JWT (HttpOnly)
                   ▼
┌──────────────────────────────────────────────────────────────┐
│                    Next.js BFF (servidor)                     │
│         Rotas /api/[...path] com allowlist controlada         │
│         Anexa cookie, faz forward para API NestJS             │
└──────────────────┬───────────────────────────────────────────┘
                   │ HTTP interno
                   ▼
┌──────────────────────────────────────────────────────────────┐
│                       API NestJS                              │
│   Guards (JWT) + Decorators (@TenantAtual, @UsuarioAtual)     │
│   Controllers → Services → Prisma                             │
│   ValidationPipe global + class-validator                     │
└──────────────────┬───────────────────────────────────────────┘
                   │ Prisma Client + extension RLS
                   ▼
┌──────────────────────────────────────────────────────────────┐
│                      PostgreSQL                               │
│         Tabelas infolab_* + Policies RLS                      │
│         app.current_tenant_id setado por transação            │
└──────────────────────────────────────────────────────────────┘
```

### 2.1 Características-chave

- **Sem estado em memória da aplicação** — sessão fica no JWT (cookie). API e Web escalam horizontalmente.
- **PostgreSQL é a única fonte de verdade** — sem cache distribuído com risco de divergência.
- **Multi-tenant é o banco que faz** — RLS, não middleware do app.
- **Frontend e backend deployam independentemente** — desde que mantenham contrato.

---

## 3. Estrutura do monorepo

```
infotime-web/
├── api/                           ← Backend NestJS
│   ├── src/
│   │   ├── ai/                    ← Módulo de IA (lê ai/domains)
│   │   ├── atendimento/           ← Módulo de atendimento
│   │   ├── autenticacao/          ← JWT, login, captcha
│   │   ├── catalogo/              ← Catálogos universais
│   │   ├── cliente/               ← Pacientes
│   │   ├── comum/                 ← Decorators, guards, filtros
│   │   ├── soroteca/              ← Módulo da Soroteca (3251 linhas)
│   │   ├── ...                    ← outros 50+ módulos
│   │   ├── app.module.ts          ← raiz do app
│   │   └── main.ts                ← bootstrap
│   ├── prisma/
│   │   ├── schema.prisma          ← schema único (1 arquivo)
│   │   └── migrations/            ← migrations versionadas
│   ├── test/                      ← testes E2E
│   └── package.json
│
├── web/                           ← Frontend Next.js
│   ├── src/
│   │   ├── app/                   ← App Router
│   │   │   ├── (autenticado)/     ← grupo de rotas protegidas
│   │   │   ├── (comum)/i18n/      ← mensagens pt-BR
│   │   │   ├── api/[...path]/     ← BFF com allowlist
│   │   │   ├── soroteca/          ← rotas do módulo
│   │   │   └── soroteca-cadastro/ ← cadastros genéricos
│   │   ├── components/            ← componentes Liga*
│   │   ├── contexts/              ← React Contexts
│   │   ├── hooks/                 ← hooks customizados
│   │   ├── lib/                   ← utilitários puros
│   │   ├── types/                 ← tipos compartilhados
│   │   └── data/                  ← dados estáticos (menu, etc.)
│   └── package.json
│
├── ai/                            ← Documentação de domínio
│   ├── README.md                  ← runbook
│   ├── checklists/                ← checklists de implantação
│   └── domains/<dominio>/         ← Context, Rules, Schema, Examples
│
├── tools/                         ← Ferramentas auxiliares
│   └── infolab-mcp/               ← servidor MCP para IDEs
│
├── .cursor/                       ← Regras do Cursor IDE
│   ├── rules/
│   │   ├── global/global.mdc
│   │   ├── backend/backend.mdc
│   │   ├── front-end/frontend.mdc
│   │   ├── ai-first/
│   │   ├── crud-telas/
│   │   └── patterns/
│   └── mcp.json
│
├── scripts/                       ← scripts auxiliares
├── nx.json                        ← config Nx
├── package.json                   ← workspaces api/ e web/
└── README.md
```

### 3.1 Workspaces

`package.json` raiz declara:

```json
{
  "workspaces": ["api", "web"]
}
```

Cada workspace tem seu próprio `package.json`, mas dependências comuns (TypeScript, ESLint) ficam no raiz.

### 3.2 Por que monorepo

- **Compartilhamento de tipos**: `web/` e `api/` podem alinhar contratos via TypeScript
- **Atomicidade**: PR muda backend e frontend juntos quando necessário
- **Tooling unificado**: Nx orquestra build/test de tudo

---

## 4. Stack tecnológico completo

| Camada | Tecnologia | Versão | Função |
|---|---|---|---|
| **Runtime** | Node.js | ≥ 22 | Execução |
| **Pacotes** | npm | ≥ 10 | Workspaces |
| **Monorepo** | Nx | 22.6.4 | Orquestração |
| **Backend framework** | NestJS | 11 | API REST modular |
| **ORM** | Prisma | 6 | Schema, migrations, queries |
| **Banco** | PostgreSQL | ≥ 14 | RLS necessário |
| **Frontend framework** | Next.js | 16 | App Router, SSR/SSG |
| **UI library** | React | 19 | Componentes |
| **UI components** | PrimeReact | atual | DataTable, Calendar, Dropdown |
| **i18n** | next-intl | atual | Tradução pt-BR |
| **Validação backend** | class-validator + class-transformer | atual | DTOs |
| **Autenticação** | Passport JWT | atual | Strategy JWT |
| **Lint** | ESLint | 9 | Backend e frontend |
| **Test backend** | Jest | 30 | Unit + E2E |
| **Test frontend** | Vitest | atual | Componentes |
| **Build** | Next build + tsc | — | Bundling |

### 4.1 Dependências cruciais a conhecer

- **Prisma Client estendido** (`api/src/prisma/`) — adiciona setLocal de RLS automaticamente
- **TenantContexto** (`api/src/comum/`) — propaga tenant pela request
- **LigaListagemBase** (`web/src/components/formulario-pesquisa/`) — 1.325 linhas, base de toda listagem
- **LigaFormularioCadastroBase** (`web/src/components/formulario-cadastro/`) — 1.309 linhas, base de todo formulário
- **LigaSistemaAbas** (`web/src/components/abas/`) — 2.242 linhas, sistema de abas com lazy loading

---

# Parte 2 — Setup e desenvolvimento local

## 5. Pré-requisitos

| Ferramenta | Versão | Como verificar |
|---|---|---|
| Node.js | ≥ 22 | `node -v` |
| npm | ≥ 10 | `npm -v` |
| PostgreSQL | ≥ 14 | `psql --version` |
| Git | qualquer | `git --version` |
| IDE | VS Code ou Cursor (recomendado) | — |

### 5.1 Por que essas versões

- **Node 22**: usa `fetch` nativo, melhores performance e tipagem
- **Prisma 6**: requer PostgreSQL 14+ para algumas features
- **Next.js 16**: App Router com React 19 (Server Components estáveis)

### 5.2 Recomendações de IDE

**VS Code ou Cursor com extensões:**

- ESLint
- Prisma
- TypeScript
- Tailwind CSS IntelliSense (se usar)
- GitLens

O **Cursor** lê automaticamente `.cursor/rules/` que orientam IA do projeto.

---

## 6. Configuração inicial

### 6.1 Clone e instalação

```bash
git clone https://github.com/infotime-web-repo/infotime-web.git
cd infotime-web
npm install
```

`npm install` roda no raiz e instala dependências de `api/` e `web/` automaticamente via workspaces.

### 6.2 Banco de dados local

```bash
# Crie banco
createdb liga_infolab_dev

# Crie usuário (se necessário)
psql -c "CREATE USER liga_dev WITH PASSWORD 'dev123';"
psql -c "GRANT ALL PRIVILEGES ON DATABASE liga_infolab_dev TO liga_dev;"
```

### 6.3 Variáveis de ambiente

`api/.env`:

```bash
DATABASE_URL="postgresql://liga_dev:dev123@localhost:5432/liga_infolab_dev?schema=public"
SUPORTE_SECRET_KEY="dev-secret-trocar-em-prod"
JWT_SECRET="outra-chave-secreta-trocar"
JWT_EXPIRES_IN="1h"
OPENAI_API_KEY="opcional-para-modulo-ia"
OPENAI_CHAT_MODEL="gpt-4o-mini"
```

`web/.env.local`:

```bash
API_BASE_URL="http://localhost:3001"
NEXT_PUBLIC_APP_NAME="Infotime Web (dev)"
```

### 6.4 Migrations

```bash
cd api
npx prisma migrate dev
npx prisma generate
```

`migrate dev` aplica migrations pendentes E roda seed (se configurado). É o comando para **dev**.

> ⚠️ **Nunca rode `migrate reset` em ambiente com dados**. Apaga tudo.

### 6.5 Seed de dados (se existir)

```bash
npx prisma db seed
```

Cria tenant padrão, usuário admin, catálogos básicos para você ter o que ver.

---

## 7. Subindo o ambiente local

### 7.1 Tudo de uma vez

```bash
# Na raiz
npm run dev
```

Esse comando:

1. Roda `prisma generate` (atualiza tipos)
2. Sobe API (porta 3001) e Web (porta 3000) em paralelo
3. Mostra logs coloridos: api em azul, web em magenta

### 7.2 Apenas backend

```bash
npm run dev:api
```

### 7.3 Apenas frontend

```bash
npm run dev:web
```

### 7.4 URLs típicas

- **Web**: http://localhost:3000
- **API**: http://localhost:3001
- **API Health**: http://localhost:3001/health
- **Prisma Studio**: `npx prisma studio` (interface gráfica para o banco)

---

## 8. Comandos do dia a dia

| Comando | O que faz |
|---|---|
| `npm run dev` | Sobe tudo |
| `npm run build` | Build de api e web |
| `npm run lint` | Lint em tudo |
| `npm run test` | Testes em tudo |
| `nx run api:test` | Apenas testes da API |
| `nx run web:test` | Apenas testes do Web |
| `npx prisma migrate dev --name nome_da_migration` | Cria nova migration |
| `npx prisma generate` | Regenera Prisma Client |
| `npx prisma studio` | Interface gráfica do banco |
| `npx prisma db seed` | Roda seed |

### 8.1 Atalhos do Nx

```bash
nx graph                     # mostra grafo de dependências
nx affected:test             # roda só testes afetados pelo último commit
nx affected:lint             # idem para lint
nx run-many -t build         # build de todos os workspaces
```

---

# Parte 3 — Backend (NestJS + Prisma)

## 9. Estrutura de um módulo NestJS

Todo módulo segue o padrão:

```
api/src/<dominio>/
├── <dominio>.module.ts          ← declara providers/imports
├── <dominio>.controller.ts      ← rotas HTTP
├── <dominio>.service.ts         ← lógica de negócio + Prisma
├── <dominio>.controller.spec.ts ← testes do controller
├── <dominio>.service.spec.ts    ← testes do service
├── dto/                         ← DTOs de entrada e saída
│   ├── criar-<dominio>.dto.ts
│   ├── atualizar-<dominio>.dto.ts
│   └── resposta-<dominio>.dto.ts
└── interfaces/ (quando necessário)
    └── <dominio>.types.ts
```

### 9.1 Exemplo: módulo Soroteca

Em `api/src/soroteca/`:

```
soroteca.module.ts                  // 15 linhas
soroteca.controller.ts              // 167 linhas — endpoints operacionais
soroteca.service.ts                 // 978 linhas — lógica
soroteca-cadastros.controller.ts    // 100 linhas — CRUD genérico
soroteca-cadastros.service.ts       // 1590 linhas — switch por slug
soroteca-cadastros-recursos.ts      // lista de slugs válidos
soroteca-mapa.util.ts               // 140 linhas — utilitários de endereço
dto/                                // 7 DTOs
```

### 9.2 Anatomia do `module.ts`

```typescript
import { Module } from '@nestjs/common';
import { SorotecaController } from './soroteca.controller';
import { SorotecaService } from './soroteca.service';
import { SorotecaCadastrosController } from './soroteca-cadastros.controller';
import { SorotecaCadastrosService } from './soroteca-cadastros.service';
import { PrismaModule } from '../prisma/prisma.module';

@Module({
  imports: [PrismaModule],
  controllers: [SorotecaController, SorotecaCadastrosController],
  providers: [SorotecaService, SorotecaCadastrosService],
})
export class SorotecaModule {}
```

### 9.3 Onde declarar

`api/src/app.module.ts` importa todos os módulos:

```typescript
@Module({
  imports: [
    SorotecaModule,
    AtendimentoModule,
    ClienteModule,
    // ...
  ],
})
export class AppModule {}
```

---

## 10. Padrão controller → service → Prisma

### 10.1 Regra de ouro

**Controller nunca acessa Prisma diretamente.** Sempre passa pelo Service.

```typescript
// ❌ ERRADO
@Controller('clientes')
export class ClienteController {
  constructor(private prisma: PrismaService) {}

  @Get()
  async listar() {
    return this.prisma.infolab_cliente.findMany(); // não!
  }
}

// ✅ CORRETO
@Controller('clientes')
export class ClienteController {
  constructor(private servico: ClienteService) {}

  @Get()
  async listar(@TenantAtual() ctx: TenantContexto) {
    return this.servico.listar(ctx);
  }
}
```

### 10.2 Por que essa separação

- **Testabilidade**: service mockável independente do controller
- **Reuso**: outros módulos podem injetar o service sem passar por HTTP
- **Single Responsibility**: controller só lida com HTTP, service com regra

### 10.3 Estrutura típica de service

```typescript
@Injectable()
export class ClienteService {
  constructor(private prisma: PrismaService) {}

  async listar(ctx: TenantContexto): Promise<RespostaListagemDto> {
    const clientes = await this.prisma.infolab_cliente.findMany({
      where: { id_tenacidade: ctx.idTenacidade, ativo: true },
      orderBy: { nome: 'asc' },
    });
    return { itens: clientes, total: clientes.length };
  }

  async obter(id: bigint, ctx: TenantContexto): Promise<RespostaDetalheDto> {
    const cliente = await this.prisma.infolab_cliente.findFirst({
      where: { id_cliente: id, id_tenacidade: ctx.idTenacidade },
    });
    if (!cliente) {
      throw new NotFoundException('Cliente não encontrado');
    }
    return cliente;
  }

  async criar(dto: CriarClienteDto, ctx: TenantContexto) {
    return this.prisma.infolab_cliente.create({
      data: {
        ...dto,
        id_tenacidade: ctx.idTenacidade,
        endereco_ip_auditoria: ctx.ip,
        nome_aplicacao_auditoria: 'infotime-web',
      },
    });
  }
}
```

---

## 11. DTOs e validação com class-validator

### 11.1 DTO de entrada

```typescript
// api/src/cliente/dto/criar-cliente.dto.ts
import { IsString, IsEmail, IsOptional, MaxLength, MinLength } from 'class-validator';

export class CriarClienteDto {
  @IsString()
  @MinLength(3)
  @MaxLength(120)
  nome!: string;

  @IsString()
  @MaxLength(11)
  cpf!: string;

  @IsOptional()
  @IsEmail()
  email?: string;
}
```

### 11.2 ValidationPipe global

`api/src/main.ts`:

```typescript
app.useGlobalPipes(
  new ValidationPipe({
    whitelist: true,           // remove campos não declarados
    forbidNonWhitelisted: true, // erro se vier campo extra
    transform: true,            // converte tipos automaticamente
    exceptionFactory: validacaoExceptionFactory,
  }),
);
```

### 11.3 Atenção com tenant

**Nunca aceite `id_tenacidade` no DTO.** Tenant vem da sessão/JWT, não do cliente.

```typescript
// ❌ ERRADO
export class CriarClienteDto {
  id_tenacidade: bigint; // não!
  nome: string;
}

// ✅ CORRETO — tenant vem do decorator @TenantAtual no controller
export class CriarClienteDto {
  nome: string;
}
```

### 11.4 DTO de saída

```typescript
export class RespostaClienteDto {
  id_cliente!: string; // BigInt vira string em JSON
  nome!: string;
  cpf!: string;
  email?: string;
}
```

---

## 12. Decorators de tenant e usuário

### 12.1 @TenantAtual

Em `api/src/comum/decorators/tenant-atual.decorator.ts`. Extrai contexto do tenant da request:

```typescript
@Get()
async listar(@TenantAtual() ctx: TenantContexto) {
  // ctx.idTenacidade
  // ctx.ip
  // ctx.aplicacao
  return this.servico.listar(ctx);
}
```

### 12.2 @UsuarioAtual

Extrai dados do usuário logado:

```typescript
@Post()
async criar(
  @Body() dto: CriarClienteDto,
  @UsuarioAtual() usuario: UsuarioAtualPayload,
) {
  // usuario.idUsuario
  // usuario.login
  return this.servico.criar(dto, usuario);
}
```

### 12.3 Como funciona internamente

Os decorators leem do `request.user` (populado pelo guard JWT). Padronizam o acesso e evitam código repetido.

---

## 13. Tratamento de exceções

### 13.1 Exceções HTTP do NestJS

```typescript
import {
  BadRequestException,
  NotFoundException,
  ConflictException,
  UnauthorizedException,
  ForbiddenException,
} from '@nestjs/common';

// Exemplos
throw new NotFoundException('Cliente não encontrado');
throw new ConflictException('CPF já cadastrado');
throw new BadRequestException('Data inválida');
```

### 13.2 Filtro de exceções do Prisma

`api/src/comum/prisma-exception.filter.ts` traduz erros do Prisma em HTTP:

| Erro Prisma | HTTP correspondente |
|---|---|
| P2002 (unique constraint) | 409 Conflict |
| P2003 (FK constraint) | 400 BadRequest |
| P2025 (record not found) | 404 NotFound |
| Outros | 500 Internal |

### 13.3 Boas práticas

- **Não retorne mensagem técnica** ao cliente em erros 500. Logue, mas retorne genérico.
- **Mensagens de erro de negócio devem ser em pt-BR** e claras para o usuário.
- **Exceções esperadas** (404, 409, 400) **não logue como erro** — são parte do fluxo.

---

## 14. Schema Prisma e migrations

### 14.1 Estrutura do schema

`api/prisma/schema.prisma` é **um único arquivo** com todos os modelos. Pode ficar grande (3.979 linhas atualmente). É proposital — facilita busca e refactoring.

### 14.2 Convenções de modelo

```prisma
model infolab_cliente {
  id_cliente               BigInt              @id @default(autoincrement())
  id_tenacidade            BigInt
  nome                     String              @db.VarChar(120)
  cpf                      String              @db.VarChar(11)
  ativo                    Boolean             @default(true)
  endereco_ip_auditoria    String?             @db.VarChar(20)
  nome_aplicacao_auditoria String?             @db.VarChar(255)

  infolab_tenacidade infolab_tenacidade @relation(
    fields: [id_tenacidade],
    references: [id_tenacidade],
    onUpdate: Restrict,
    map: "fk_cliente_tenacidade"
  )

  @@unique([id_tenacidade, cpf], map: "infolab_cliente_tenant_cpf_uq")
}
```

**Pontos a observar:**

- Nome da tabela em snake_case com prefixo `infolab_`
- PK como `id_<entidade> BigInt @id @default(autoincrement())`
- Tenant sempre presente (exceto catálogos universais)
- Auditoria estrutural sempre presente
- FKs com `onDelete: Restrict` por padrão (preservar histórico)
- Unicidade composta com `id_tenacidade` para evitar conflito entre tenants

### 14.3 Criando uma migration

```bash
cd api
npx prisma migrate dev --name adicionar_telefone_cliente
```

Isso:

1. Compara seu `schema.prisma` com o estado atual do banco
2. Gera SQL na pasta `migrations/<timestamp>_<nome>/migration.sql`
3. Aplica no banco local
4. Regenera Prisma Client

### 14.4 Política de migrations

Da `global.mdc`:

> Não criar migrations, alterar tabelas/colunas do PostgreSQL nem o schema.prisma com novos campos ou FKs **sem confirmação explícita de um humano** (requisito de produto/arquitetura aprovado).

Em prática:

- **Discuta antes de criar** migration que muda schema
- **Anote o "porquê"** na descrição do PR
- **Teste em homologação** antes de aplicar em produção
- **Migrations destrutivas** (drop column, drop table) exigem **aprovação dupla**

### 14.5 Migrations em produção

```bash
# Em CI/CD
npx prisma migrate deploy
```

`migrate deploy` aplica **apenas** migrations pendentes, sem prompts. Seguro para produção.

> ⚠️ **Nunca use `migrate reset` em produção.** Apaga o banco e recria.

---

## 15. Row-Level Security (RLS) em detalhe

### 15.1 Como funciona no PostgreSQL

```sql
-- Habilita RLS na tabela
ALTER TABLE infolab_cliente ENABLE ROW LEVEL SECURITY;

-- Cria policy
CREATE POLICY tenant_isolation ON infolab_cliente
  USING (id_tenacidade = current_setting('app.current_tenant_id')::bigint);
```

A policy é avaliada **automaticamente** em todo SELECT, UPDATE, DELETE.

### 15.2 Como o app seta o tenant

Antes de cada query (em transação), a API executa:

```sql
SET LOCAL app.current_tenant_id = '12';
```

Isso é feito por **extensão do Prisma Client** em `api/src/prisma/`. Você não precisa lembrar.

### 15.3 Quando RLS pode te confundir

**Em scripts manuais ou seeds**, RLS pode bloquear queries se você não setar o tenant:

```sql
-- ❌ Vazio mesmo se há dados
SELECT * FROM infolab_cliente;

-- ✅ Funciona
SET LOCAL app.current_tenant_id = '12';
SELECT * FROM infolab_cliente;
```

### 15.4 Tabelas sem RLS

Catálogos universais (CID, CBO, conselhos regionais, etc.) **não têm RLS** — são compartilhados entre tenants.

### 15.5 Bypass para superadmin

Algumas operações administrativas (criar tenant, listar todos os tenants) precisam ver tudo. O Prisma Client do projeto tem um modo de "bypass" usado em contextos restritos. **Use com extrema cautela.**

---

## 16. Auditoria estrutural

### 16.1 Padrão das tabelas

Toda tabela de negócio tem:

```prisma
endereco_ip_auditoria    String? @db.VarChar(20)
nome_aplicacao_auditoria String? @db.VarChar(255)
```

E tabelas com `id_usuario_auditoria` quando aplicável.

### 16.2 Preenchimento automático

Em `create`/`update`, o service preenche:

```typescript
return this.prisma.infolab_cliente.create({
  data: {
    ...dto,
    id_tenacidade: ctx.idTenacidade,
    endereco_ip_auditoria: ctx.ip,
    nome_aplicacao_auditoria: 'infotime-web',
  },
});
```

Constante `APP = "infotime-web"` é usada em todo o backend.

### 16.3 IP truncado em 20 caracteres

```typescript
const IP_MAX = 20;
const ip = req.ip.slice(0, IP_MAX);
```

20 caracteres comporta IPv6. Truncamento intencional.

### 16.4 Tabela de auditoria genérica

`infolab_soroteca_auditoria` (e similares por módulo) registra dados antes/depois em JSON:

```prisma
model infolab_soroteca_auditoria {
  id_soroteca_auditoria BigInt    @id @default(autoincrement())
  id_tenacidade         BigInt
  data_hora_evento      DateTime  @default(now())
  operacao              String    @db.Char(1)  // I, U, D
  tabela                String    @db.VarChar(80)
  registro_id           String    @db.VarChar(40)
  hash_anterior         String?   @db.VarChar(64)
  hash_atual            String?   @db.VarChar(64)
  dados_antes           Json?
  dados_depois          Json?
  login_usuario         String?
  session_id            String?
  endereco_ip_auditoria String?
  nome_aplicacao_auditoria String?
}
```

A cadeia hash_anterior → hash_atual permite verificar inviolabilidade.

---

# Parte 4 — Frontend (Next.js + React)

## 17. Estrutura do App Router

```
web/src/app/
├── (autenticado)/              ← grupo de rotas protegidas
│   ├── layout.tsx              ← layout com menu lateral
│   └── page.tsx                ← home
├── (comum)/i18n/mensagens/     ← traduções
├── api/[...path]/              ← BFF (rota dinâmica)
│   └── route.ts
├── soroteca/
│   └── mapa/[idGrade]/page.tsx
├── soroteca-cadastro/
│   └── [slug]/
│       ├── listagem/page.tsx
│       └── formulario-cadastro/page.tsx
├── login/
│   └── page.tsx                ← rota pública
└── layout.tsx                  ← layout raiz
```

### 17.1 Convenções do App Router

- **page.tsx** — define a página em uma rota
- **layout.tsx** — wrapper aplicado a todas as páginas dessa pasta e abaixo
- **(grupo)/** — agrupa rotas sem afetar URL
- **[param]/** — rota dinâmica
- **[...catch]/** — catch-all

### 17.2 Server Components vs Client Components

Por padrão no App Router, componentes são **Server Components** (renderizam no servidor). Para componentes interativos, use:

```tsx
"use client";
// componente que usa useState, useEffect, etc.
```

A maioria das páginas operacionais do Infotime Web são client components por causa da interatividade (filtros, abas, formulários).

### 17.3 Rotas com BFF

Toda rota `/api/*` no Next.js cai em `app/api/[...path]/route.ts` que faz proxy para a API NestJS após validar allowlist.

---

## 18. Componentes base Liga*

O Infotime Web tem ~6.668 linhas de componentes base reutilizáveis no padrão `Liga*`. Antes de criar tela nova, verifique se algum desses se aplica.

### 18.1 Os principais

| Componente | Linhas | Função |
|---|---|---|
| `LigaListagemBase` | 1.325 | Listagem padrão (tabela, busca, filtros, paginação, export) |
| `LigaFormularioCadastroBase` | 1.309 | Formulário padrão (seções, campos, validação) |
| `LigaSistemaAbas` | 2.242 | Sistema de abas com lazy loading |
| `LigaMenuLateral` | — | Menu hierárquico de 3 níveis |
| `LigaMenuPesquisa` | 133 | Busca dentro do menu |
| `LigaHomeNavegacao` | 1.164 | Tela inicial com cards |
| `LigaSorotecaMapaCaixa` | — | SVG do mapa visual da caixa |
| `LigaListagemFiltroRefinadoSidebar` | — | Sidebar de filtros |

### 18.2 Onde ficam

```
web/src/components/
├── abas/LigaSistemaAbas.tsx
├── formulario-base/LigaFormularioBase.tsx
├── formulario-cadastro/LigaFormularioCadastroBase.tsx
├── formulario-pesquisa/LigaListagemBase.tsx
├── navegacao/menu/Liga*.tsx
├── navegacao/home/LigaHomeNavegacao.tsx
└── soroteca/Liga*.tsx
```

### 18.3 Como usar

Componentes Liga* recebem props bem documentadas. Exemplo simplificado de uso:

```tsx
<LigaListagemBase
  nomeTabela="Clientes"
  registros={clientes}
  colunas={colunas}
  chavePrimaria="id_cliente"
  textoBotaoNovo="+ Novo Cliente"
  placeholderBusca="Buscar..."
  textoNenhumRegistro="Nenhum cliente encontrado"
  fonteListagem="servidor"
  paginacaoServidor={paginacao}
  aoNovo={() => router.push('/clientes/novo')}
  aoAcaoLinha={(reg) => router.push(`/clientes/${reg.id_cliente}`)}
  ariaLabelAcaoLinha="Editar cliente"
  aoPesquisarServidor={pesquisar}
  aoFiltrosRefinadoServidor={filtrar}
/>
```

---

## 19. Padrão Listagem + Formulário

### 19.1 Estrutura típica de um módulo CRUD

Para um módulo `cliente`:

```
web/src/app/cliente/
├── listagem/
│   └── page.tsx              ← usa LigaListagemBase
├── formulario-cadastro/
│   └── page.tsx              ← usa LigaFormularioCadastroBase
└── (sem mais nada — apenas duas telas)
```

### 19.2 Como construir uma listagem

```tsx
// web/src/app/cliente/listagem/page.tsx
"use client";

import { LigaListagemBase } from "@/components/formulario-pesquisa/LigaListagemBase";
import { useListagemCrudServidor } from "@/hooks/useListagemCrudServidor";
import { colunasClientes } from "./colunas";

export default function ClienteListagemPage() {
  const {
    registros,
    paginacao,
    pesquisar,
    filtrar,
    carregando,
  } = useListagemCrudServidor({ recurso: "clientes" });

  return (
    <LigaListagemBase
      nomeTabela="Clientes"
      registros={registros}
      colunas={colunasClientes}
      // ... outras props
    />
  );
}
```

### 19.3 Definindo colunas

```tsx
// web/src/app/cliente/listagem/colunas.ts
import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";

export const colunasClientes: LigaColunaListagem[] = [
  {
    campo: "id_cliente",
    cabecalho: "ID",
    larguraPx: 80,
    ordenavel: true,
  },
  {
    campo: "nome",
    cabecalho: "Nome",
    pesquisaServidor: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "cpf",
    cabecalho: "CPF",
    pesquisaServidor: true,
    mascaraBuscaServidor: "cpf",
  },
  {
    campo: "ativo",
    cabecalho: "Status",
    valorExibicao: "ativoInativo",
    filtroRefinado: {
      tipo: "enum",
      opcoes: [
        { valor: "S", rotulo: "Ativo" },
        { valor: "N", rotulo: "Inativo" },
      ],
    },
  },
];
```

### 19.4 Como construir um formulário

```tsx
// web/src/app/cliente/formulario-cadastro/page.tsx
"use client";

import { LigaFormularioCadastroBase } from "@/components/formulario-cadastro/LigaFormularioCadastroBase";
import { layoutClientePadrao } from "./layout-padrao";

export default function ClienteFormularioCadastro() {
  return (
    <LigaFormularioCadastroBase
      tela="cliente"
      layoutPadrao={layoutClientePadrao}
      // ... outras props
    />
  );
}
```

### 19.5 Definindo layout

```tsx
// web/src/app/cliente/formulario-cadastro/layout-padrao.ts
import type { LayoutFormularioCadastro } from "@/types/formulario-cadastro.types";

export function criarLayoutClientePadrao(
  t: (k: string) => string,
): LayoutFormularioCadastro {
  return {
    tituloNovo: t("formulario.tituloNovo"),
    tituloEditar: t("formulario.tituloEditar"),
    iconeTitulo: "pi-user",
    secoes: [
      {
        id: "principal",
        titulo: t("formulario.secPrincipal"),
        icone: "pi-bookmark",
        campos: [
          {
            chave: "nome",
            label: t("formulario.nome"),
            tipo: "texto",
            obrigatorio: true,
            maxLength: 120,
          },
          {
            chave: "cpf",
            label: t("formulario.cpf"),
            tipo: "texto",
            obrigatorio: true,
            maxLength: 11,
          },
          {
            chave: "ativo",
            label: t("formulario.ativo"),
            tipo: "ativo",
          },
        ],
      },
    ],
  };
}
```

---

## 20. Layouts dinâmicos por grupo de usuário

### 20.1 Conceito

Cada formulário tem **layout padrão** em código + **layout customizado** opcional em banco. O backend resolve qual usar.

### 20.2 Endpoint

```
GET /layout/:tela/formulario-cadastro
```

Resposta:

```json
{
  "v": 1,
  "layout": {
    "secoes": [...]
  }
}
```

Se vazio (`secoes: []`), o frontend cai no padrão.

### 20.3 Como armazenar customização

`infolab_layout_formulario` guarda JSONB do layout, indexado por `(id_tenacidade, id_grupo_usuario, codigo_tela)`.

### 20.4 Hook useLayoutFormulario

```tsx
const { layout, carregando } = useLayoutFormulario({
  tela: "cliente",
  layoutPadrao: layoutClientePadrao,
});
```

Internamente:

1. Faz GET no backend
2. Se vier customizado, usa
3. Se vier vazio, usa o padrão
4. Mostra loader enquanto carrega

---

## 21. Sistema de abas (LigaSistemaAbas)

### 21.1 Conceito

`LigaSistemaAbas` é o orquestrador que permite múltiplas telas abertas simultaneamente. Cada aba mantém estado separado, com lazy loading via `dynamic()` do Next.js.

### 21.2 Como funciona

```tsx
const ClienteListagemPage = dynamic(
  () => import("@/app/cliente/listagem/page"),
  { ssr: false }
);
```

Cada tela **só carrega seu chunk JS** quando aberta pela primeira vez. Reduz drasticamente o bundle inicial.

### 21.3 Adicionando uma tela ao sistema de abas

Em `LigaSistemaAbas.tsx`:

```tsx
const NovaTelaListagemPage = dynamic(
  () => import("@/app/nova-tela/listagem/page"),
  { ssr: false }
);

// No mapa de telas
const TELAS_REGISTRADAS = {
  // ...
  "nova-tela-listagem": NovaTelaListagemPage,
};
```

Tela registrada vira disponível para abrir via menu.

### 21.4 Estado de aba

Cada aba tem:

- ID único
- Componente registrado
- Props
- Estado interno (filtros, paginação, formulário em edição)

Estado **persiste enquanto a aba estiver aberta**, mesmo se outra aba estiver ativa.

---

## 22. BFF e allowlist

### 22.1 Estrutura do BFF

`web/src/app/api/[...path]/route.ts`:

```typescript
import { NextRequest, NextResponse } from "next/server";
import { RECURSOS_PERMITIDOS } from "./recursos-permitidos-bff";

export async function GET(req: NextRequest, { params }: { params: { path: string[] } }) {
  return forwardToApi(req, params, "GET");
}

export async function POST(req: NextRequest, { params }: { params: { path: string[] } }) {
  return forwardToApi(req, params, "POST");
}

// PUT, DELETE, etc.

async function forwardToApi(req: NextRequest, params: { path: string[] }, method: string) {
  const [primeiro, ...resto] = params.path;

  // Verifica allowlist
  if (!RECURSOS_PERMITIDOS.has(primeiro)) {
    return NextResponse.json({ erro: "Recurso não permitido" }, { status: 403 });
  }

  // Forward para API
  const url = `${process.env.API_BASE_URL}/${params.path.join("/")}`;
  const response = await fetch(url, {
    method,
    headers: req.headers,
    body: ["GET", "HEAD"].includes(method) ? undefined : await req.text(),
  });

  return new NextResponse(response.body, {
    status: response.status,
    headers: response.headers,
  });
}
```

### 22.2 Adicionando recurso à allowlist

```typescript
// web/src/app/api/[...path]/recursos-permitidos-bff.ts
export const RECURSOS_PERMITIDOS = new Set([
  "ai",
  "atendimentos",
  "auth",
  "clientes",
  "soroteca",
  "novo-modulo", // <- adicionar aqui
  // ...
]);
```

Sem isso, requisições para `/api/novo-modulo/*` retornam 403.

---

## 23. Internacionalização (next-intl)

### 23.1 Estrutura

Mensagens em `web/src/app/(comum)/i18n/mensagens/pt-BR.json`. Hierárquico:

```json
{
  "cliente": {
    "listagem": {
      "tituloPagina": "Clientes",
      "placeholderBusca": "Buscar cliente..."
    },
    "formulario": {
      "tituloNovo": "Novo cliente",
      "tituloEditar": "Editar cliente",
      "secPrincipal": "Dados pessoais"
    }
  }
}
```

### 23.2 Usando em componente

```tsx
"use client";
import { useTranslations } from "next-intl";

export default function ClienteListagemPage() {
  const t = useTranslations("cliente.listagem");

  return (
    <h1>{t("tituloPagina")}</h1>
  );
}
```

### 23.3 Boas práticas

- **Não escreva texto direto no JSX** — use `t(...)`
- **Chaves hierárquicas** seguindo a estrutura da tela
- **Adicione todas as mensagens** ao arquivo pt-BR antes de fazer commit
- **Não invente keys novas** — verifique se já existe um padrão

---

# Parte 5 — Convenções e padrões

## 24. Nomenclatura: pt-BR para domínio, inglês para framework

### 24.1 A regra

**Português** para regra de negócio e domínio:

```typescript
// ✅ CERTO
const idTenacidade = ctx.idTenacidade;
const cliente = await this.servico.obterCliente(id);
class TenantContexto { /* ... */ }
```

**Inglês** para framework e papéis técnicos:

```typescript
// ✅ CERTO
@Controller('clientes')
class ClienteController {
  constructor(private service: ClienteService) {}
}

// hooks React
useState, useEffect, useMemo
```

### 24.2 Casos mistos comuns

```typescript
// Service em inglês, métodos em pt-BR
class ClienteService {
  async listarClientes() { /* ... */ }
  async obterClientePorId() { /* ... */ }
}

// Controller em inglês, rotas em pt-BR
@Controller('clientes')
@Get('por-cpf/:cpf')
async obterPorCpf() { /* ... */ }
```

### 24.3 No banco

Sempre snake_case pt-BR:

```sql
infolab_cliente
infolab_atendimento_amostra
id_tenacidade
nome_aplicacao_auditoria
```

---

## 25. Documentação de domínio em ai/domains

### 25.1 Estrutura padrão

Para cada domínio relevante:

```
ai/domains/<dominio>/
├── Context.md      ← visão de negócio, fluxos narrativos
├── Rules.md        ← regras explícitas, validações, if/else
├── Schema.md       ← referência a modelos Prisma
├── Examples.md     ← casos de uso, I/O, edge cases
└── Menu-e-Telas.md ← (opcional) mapa de telas
```

### 25.2 Por que esse formato

- **`Rules.md` é consumido pelo endpoint `/ai/generate`** — IA usa para gerar código consistente
- **Context.md é o briefing humano** — onboarding rápido para devs novos
- **Schema.md referencia tabelas reais** — evita inventar colunas
- **Examples.md mostra casos reais** — replica padrões

### 25.3 Quando criar/atualizar

- **Novo módulo** → criar pasta com os 4 arquivos
- **Mudança em regra** → atualizar `Rules.md`
- **Nova tabela/coluna** → atualizar `Schema.md`
- **Caso de uso novo** → atualizar `Examples.md`

### 25.4 Princípio

Da `global.mdc`:

> Não inventar regra de negócio contradizendo o código (api/, web/), o schema Prisma e a documentação em ai/domains quando ela existir para o tema.

> Quando houver dúvida entre documentação e código executável, confirmar no schema/código; a documentação em ai/domains orienta humanos e fluxos de IA — o deploy continua governado pelo repositório de código e migrations.

---

## 26. Regras do Cursor (.cursor/rules)

### 26.1 Estrutura

```
.cursor/rules/
├── global/global.mdc              ← regras gerais
├── backend/backend.mdc            ← regras do backend
├── front-end/frontend.mdc         ← regras do frontend
├── ai-first/                      ← prioridade de fontes
├── crud-telas/                    ← padrões de tela CRUD
└── patterns/                      ← padrões de código
```

### 26.2 Quando aplicam

Cada `.mdc` tem cabeçalho YAML que define escopo:

```yaml
---
description: "Regras backend NestJS"
globs: ["api/**/*"]
alwaysApply: true
---
```

- `globs` — quais arquivos aplicam
- `alwaysApply: true` — sempre incluir em sugestões da IA

### 26.3 Lendo as regras

Antes de programar em uma área, leia:

- `global/global.mdc` (sempre)
- `backend/backend.mdc` (se mexer em `api/`)
- `front-end/frontend.mdc` (se mexer em `web/`)
- Específicos relevantes (`crud-telas`, `patterns`)

### 26.4 Atualizando regras

Mudanças nas regras passam por code review como qualquer código. Discuta antes de propor.

---

## 27. Boas práticas gerais

### 27.1 Reuso antes de criação

> Reutilizar padrões existentes antes de criar novos.

Antes de criar componente novo, busque em `web/src/components/`. Antes de criar service novo, veja se algum existente cobre. Antes de criar tipo novo, veja se já existe em `web/src/types/`.

### 27.2 Transações para operações compostas

> Feature que utilizam mestre-detalhe devem sempre enviar em transação. Se o pai falha não grava nada no banco, se o filho falha não grava nada no banco.

```typescript
return this.prisma.$transaction(async (tx) => {
  const lote = await tx.infolab_descarte_lote.create({ data: dadosLote });
  for (const item of itens) {
    await tx.infolab_descarte_item.create({
      data: { ...item, id_descarte_lote: lote.id_descarte_lote },
    });
  }
  return lote;
});
```

### 27.3 Tipagem explícita

TypeScript estrito. Não use `any` exceto em casos justificados.

```typescript
// ❌ EVITE
function processar(dados: any) { /* ... */ }

// ✅ MELHOR
function processar(dados: ClientePayload) { /* ... */ }
```

### 27.4 Comentários

- **Não comente óbvios** (`// incrementa i`)
- **Comente intenção** quando não está clara no código
- **Documente regras de negócio** complexas
- **Use JSDoc** em APIs públicas

```typescript
/**
 * Calcula data de validade da amostra com base na regra de retenção mais específica.
 * Prioridade: combinação de material+finalidade+norma > apenas material > apenas norma.
 */
function calcularValidade(amostra: Amostra): Date { /* ... */ }
```

### 27.5 Não confiar em valores do cliente para tenant

```typescript
// ❌ ERRADO
async criar(@Body() dto: CriarClienteDto) {
  return this.servico.criar(dto); // tenant pode vir do body
}

// ✅ CERTO
async criar(@Body() dto: CriarClienteDto, @TenantAtual() ctx: TenantContexto) {
  return this.servico.criar(dto, ctx); // tenant vem do JWT
}
```

---

# Parte 6 — Construindo coisas novas

## 28. Adicionando um novo módulo (passo a passo)

Vamos criar um módulo fictício `equipamento-laboratorio` para ilustrar.

### 28.1 Backend

**1. Defina o modelo no schema:**

```prisma
// api/prisma/schema.prisma
model infolab_equipamento_laboratorio {
  id_equipamento_laboratorio BigInt   @id @default(autoincrement())
  id_tenacidade              BigInt
  codigo                     String   @db.VarChar(40)
  descricao                  String   @db.VarChar(120)
  fabricante                 String?  @db.VarChar(80)
  ativo                      Boolean  @default(true)
  endereco_ip_auditoria      String?  @db.VarChar(20)
  nome_aplicacao_auditoria   String?  @db.VarChar(255)

  infolab_tenacidade infolab_tenacidade @relation(
    fields: [id_tenacidade],
    references: [id_tenacidade],
    onUpdate: Restrict,
    map: "fk_equip_lab_tenacidade"
  )

  @@unique([id_tenacidade, codigo], map: "infolab_equip_lab_tenant_codigo_uq")
}
```

**2. Crie a migration:**

```bash
cd api
npx prisma migrate dev --name adicionar_equipamento_laboratorio
```

**3. Adicione policy RLS:**

Em uma migration nova:

```sql
ALTER TABLE infolab_equipamento_laboratorio ENABLE ROW LEVEL SECURITY;

CREATE POLICY tenant_isolation ON infolab_equipamento_laboratorio
  USING (id_tenacidade = current_setting('app.current_tenant_id')::bigint);
```

**4. Crie a estrutura de pastas:**

```bash
mkdir -p api/src/equipamento-laboratorio/dto
```

**5. Crie os arquivos:**

`equipamento-laboratorio.module.ts`:

```typescript
import { Module } from "@nestjs/common";
import { EquipamentoLaboratorioController } from "./equipamento-laboratorio.controller";
import { EquipamentoLaboratorioService } from "./equipamento-laboratorio.service";

@Module({
  controllers: [EquipamentoLaboratorioController],
  providers: [EquipamentoLaboratorioService],
})
export class EquipamentoLaboratorioModule {}
```

`equipamento-laboratorio.controller.ts`:

```typescript
import { Body, Controller, Get, Param, Post, Put, Delete } from "@nestjs/common";
import { TenantAtual } from "../comum/decorators/tenant-atual.decorator";
import type { TenantContexto } from "../comum/interfaces/tenant-contexto";
import { EquipamentoLaboratorioService } from "./equipamento-laboratorio.service";
import { CriarEquipamentoDto } from "./dto/criar-equipamento.dto";
import { AtualizarEquipamentoDto } from "./dto/atualizar-equipamento.dto";

@Controller("equipamento-laboratorio")
export class EquipamentoLaboratorioController {
  constructor(private servico: EquipamentoLaboratorioService) {}

  @Get()
  async listar(@TenantAtual() ctx: TenantContexto) {
    return this.servico.listar(ctx);
  }

  @Get(":id")
  async obter(@Param("id") id: string, @TenantAtual() ctx: TenantContexto) {
    return this.servico.obter(BigInt(id), ctx);
  }

  @Post()
  async criar(@Body() dto: CriarEquipamentoDto, @TenantAtual() ctx: TenantContexto) {
    return this.servico.criar(dto, ctx);
  }

  @Put(":id")
  async atualizar(
    @Param("id") id: string,
    @Body() dto: AtualizarEquipamentoDto,
    @TenantAtual() ctx: TenantContexto,
  ) {
    return this.servico.atualizar(BigInt(id), dto, ctx);
  }

  @Delete(":id")
  async excluir(@Param("id") id: string, @TenantAtual() ctx: TenantContexto) {
    return this.servico.excluir(BigInt(id), ctx);
  }
}
```

`equipamento-laboratorio.service.ts`:

```typescript
import { Injectable, NotFoundException } from "@nestjs/common";
import { PrismaService } from "../prisma/prisma.service";
import type { TenantContexto } from "../comum/interfaces/tenant-contexto";
import type { CriarEquipamentoDto } from "./dto/criar-equipamento.dto";
import type { AtualizarEquipamentoDto } from "./dto/atualizar-equipamento.dto";

const APP = "infotime-web";

@Injectable()
export class EquipamentoLaboratorioService {
  constructor(private prisma: PrismaService) {}

  async listar(ctx: TenantContexto) {
    return this.prisma.infolab_equipamento_laboratorio.findMany({
      where: { id_tenacidade: ctx.idTenacidade },
      orderBy: { codigo: "asc" },
    });
  }

  async obter(id: bigint, ctx: TenantContexto) {
    const eq = await this.prisma.infolab_equipamento_laboratorio.findFirst({
      where: { id_equipamento_laboratorio: id, id_tenacidade: ctx.idTenacidade },
    });
    if (!eq) throw new NotFoundException("Equipamento não encontrado");
    return eq;
  }

  async criar(dto: CriarEquipamentoDto, ctx: TenantContexto) {
    return this.prisma.infolab_equipamento_laboratorio.create({
      data: {
        ...dto,
        id_tenacidade: ctx.idTenacidade,
        endereco_ip_auditoria: ctx.ip?.slice(0, 20),
        nome_aplicacao_auditoria: APP,
      },
    });
  }

  async atualizar(id: bigint, dto: AtualizarEquipamentoDto, ctx: TenantContexto) {
    await this.obter(id, ctx); // valida existência
    return this.prisma.infolab_equipamento_laboratorio.update({
      where: { id_equipamento_laboratorio: id },
      data: {
        ...dto,
        endereco_ip_auditoria: ctx.ip?.slice(0, 20),
        nome_aplicacao_auditoria: APP,
      },
    });
  }

  async excluir(id: bigint, ctx: TenantContexto) {
    await this.obter(id, ctx);
    return this.prisma.infolab_equipamento_laboratorio.delete({
      where: { id_equipamento_laboratorio: id },
    });
  }
}
```

`dto/criar-equipamento.dto.ts`:

```typescript
import { IsBoolean, IsOptional, IsString, MaxLength } from "class-validator";

export class CriarEquipamentoDto {
  @IsString()
  @MaxLength(40)
  codigo!: string;

  @IsString()
  @MaxLength(120)
  descricao!: string;

  @IsOptional()
  @IsString()
  @MaxLength(80)
  fabricante?: string;

  @IsOptional()
  @IsBoolean()
  ativo?: boolean;
}
```

**6. Registre no AppModule:**

```typescript
// api/src/app.module.ts
import { EquipamentoLaboratorioModule } from "./equipamento-laboratorio/equipamento-laboratorio.module";

@Module({
  imports: [
    // ...
    EquipamentoLaboratorioModule,
  ],
})
export class AppModule {}
```

### 28.2 Frontend

**1. Adicione recurso ao BFF:**

```typescript
// web/src/app/api/[...path]/recursos-permitidos-bff.ts
export const RECURSOS_PERMITIDOS = new Set([
  // ...
  "equipamento-laboratorio",
]);
```

**2. Crie estrutura:**

```bash
mkdir -p web/src/app/equipamento-laboratorio/{listagem,formulario-cadastro}
```

**3. Crie a listagem:**

(Use o template da seção 19)

**4. Crie o formulário:**

(Use o template da seção 19)

**5. Adicione ao menu:**

```typescript
// web/src/data/menu-estrutura-dst-gerado.ts
"cad-equipamento-laboratorio": "Equipamento de laboratório",

// E em filhos do nível 2
"cad-equipamento-laboratorio"
```

**6. Adicione traduções:**

```json
// web/src/app/(comum)/i18n/mensagens/pt-BR.json
"equipamentoLaboratorio": {
  "listagem": {
    "tituloPagina": "Equipamentos de laboratório",
    /* ... */
  },
  "formulario": {
    /* ... */
  }
}
```

### 28.3 Documentação de domínio

```bash
mkdir -p ai/domains/equipamento-laboratorio
```

Crie os 4 arquivos: `Context.md`, `Rules.md`, `Schema.md`, `Examples.md`.

### 28.4 Testes

```typescript
// api/src/equipamento-laboratorio/equipamento-laboratorio.service.spec.ts
describe("EquipamentoLaboratorioService", () => {
  let service: EquipamentoLaboratorioService;
  let prismaMock: any;

  beforeEach(async () => {
    prismaMock = {
      infolab_equipamento_laboratorio: {
        findMany: jest.fn(),
        findFirst: jest.fn(),
        create: jest.fn(),
        update: jest.fn(),
        delete: jest.fn(),
      },
    };

    const module = await Test.createTestingModule({
      providers: [
        EquipamentoLaboratorioService,
        { provide: PrismaService, useValue: prismaMock },
      ],
    }).compile();

    service = module.get(EquipamentoLaboratorioService);
  });

  it("lista equipamentos do tenant", async () => {
    prismaMock.infolab_equipamento_laboratorio.findMany.mockResolvedValue([
      { id_equipamento_laboratorio: BigInt(1), codigo: "EQ-001" },
    ]);

    const ctx = { idTenacidade: BigInt(12), ip: "127.0.0.1" };
    const result = await service.listar(ctx as any);

    expect(prismaMock.infolab_equipamento_laboratorio.findMany).toHaveBeenCalledWith({
      where: { id_tenacidade: BigInt(12) },
      orderBy: { codigo: "asc" },
    });
    expect(result).toHaveLength(1);
  });
});
```

---

## 29. Adicionando uma nova tela CRUD

Para um cadastro simples que segue o padrão genérico, considere usar o **CRUD genérico de slugs** já existente (como `soroteca-cadastros.controller.ts`). Adicione apenas:

1. Slug à constante `SLUGS_*`
2. Switch case no service genérico
3. Layout no frontend
4. Item no menu

Para CRUDs complexos, siga o passo a passo da seção 28.

---

## 30. Modificando o schema

### 30.1 Sempre antes de mexer

> Não criar migrations, alterar tabelas/colunas do PostgreSQL nem o schema.prisma com novos campos ou FKs sem confirmação explícita de um humano.

Antes de mudar schema:

1. **Discuta** com o time/arquitetura
2. **Documente** o porquê no PR
3. **Considere impacto** em queries existentes
4. **Pense em backward compatibility** (clientes podem estar em versões antigas)

### 30.2 Adicionando coluna

```prisma
model infolab_cliente {
  // ... campos existentes
  email_secundario String? @db.VarChar(200) // novo
}
```

```bash
npx prisma migrate dev --name adicionar_email_secundario_cliente
```

### 30.3 Removendo coluna

**Cuidado!** Migration destrutiva. Considere:

- Existe código que ainda usa essa coluna?
- Há dados que precisam ser preservados?
- Aplicação em produção pode quebrar?

Estratégia segura: deprecação em duas fases:

1. **Fase 1**: marcar como opcional (`?`), parar de gravar, manter código de leitura para legado
2. **Fase 2**: depois de algumas releases sem uso, remover

### 30.4 Renomeando coluna

Igual a "remover + adicionar". Prefira manter o nome antigo se possível.

### 30.5 Adicionando índice

```prisma
model infolab_atendimento_amostra {
  // ...
  @@index([id_tenacidade, data_coleta], map: "idx_amostra_tenant_data")
}
```

Análise antes:

- Que queries esse índice acelera?
- O custo de manutenção compensa?
- Tabela é grande o suficiente para precisar?

---

## 31. Adicionando um novo recurso BFF

```typescript
// web/src/app/api/[...path]/recursos-permitidos-bff.ts
export const RECURSOS_PERMITIDOS = new Set([
  // ...
  "novo-recurso", // <- aqui
]);
```

Pronto. Após deploy do frontend, requisições para `/api/novo-recurso/*` passam a ser proxiadas.

> ⚠️ **Verifique permissões no backend.** Adicionar à allowlist do BFF não dá permissão — só permite que a rota seja proxiada. As validações de auth ficam na API NestJS.

---

## 32. Implementando uma integração externa

### 32.1 Padrão recomendado

```
api/src/integracao-<sistema>/
├── integracao-<sistema>.module.ts
├── integracao-<sistema>.service.ts     ← lógica principal
├── integracao-<sistema>.controller.ts  ← se houver endpoint exposto
├── adapters/                           ← adaptadores específicos
└── dto/
```

### 32.2 Cuidados

- **Timeout em chamadas externas** (não bloqueie a thread)
- **Retry com backoff** para falhas transitórias
- **Circuit breaker** para falhas persistentes
- **Logs detalhados** (mas sem dados sensíveis)
- **Métricas** de sucesso/falha
- **Mock em testes** (não chame serviço real em CI)

### 32.3 Exemplo: integração com analisador via TCP

```typescript
@Injectable()
export class AnalisadorService {
  async enviarPedido(pedido: Pedido): Promise<RespostaAnalisador> {
    const socket = new net.Socket();

    return new Promise((resolve, reject) => {
      const timeout = setTimeout(() => {
        socket.destroy();
        reject(new Error("Timeout ao enviar pedido"));
      }, 30_000);

      socket.connect(this.porta, this.host, () => {
        socket.write(this.serializar(pedido));
      });

      socket.on("data", (dados) => {
        clearTimeout(timeout);
        socket.destroy();
        resolve(this.deserializar(dados));
      });

      socket.on("error", (err) => {
        clearTimeout(timeout);
        reject(err);
      });
    });
  }
}
```

---

# Parte 7 — Qualidade e testes

## 33. Estratégia de testes

### 33.1 Pirâmide

```
       /\
      /  \      E2E (poucos, lentos, caros)
     /----\
    /      \    Integração (médios)
   /--------\
  /          \  Unitários (muitos, rápidos, baratos)
 /____________\
```

### 33.2 O que testar onde

| Tipo | O que testa | Onde |
|---|---|---|
| **Unit** | Funções puras, lógica de service | Jest |
| **Integração** | Service + Prisma (com banco de teste) | Jest + Prisma |
| **Componente** | Componentes React isolados | Vitest |
| **E2E** | Fluxo completo (browser + servidor) | Playwright (futuro) |

### 33.3 Cobertura mínima

- **Service**: 80%+ de cobertura, especialmente regras de negócio
- **Controller**: smoke tests garantindo rotas + permissões
- **Componente Liga***: testes principais (renderização, props críticas)
- **Integrações externas**: mockar 100%, não chamar serviço real

---

## 34. Testes unitários (Jest)

### 34.1 Estrutura

```
api/src/cliente/
├── cliente.service.ts
├── cliente.service.spec.ts   ← testes
├── cliente.controller.ts
└── cliente.controller.spec.ts
```

### 34.2 Padrão básico

```typescript
import { Test } from "@nestjs/testing";
import { ClienteService } from "./cliente.service";
import { PrismaService } from "../prisma/prisma.service";

describe("ClienteService", () => {
  let service: ClienteService;
  let prismaMock: jest.Mocked<PrismaService>;

  beforeEach(async () => {
    prismaMock = {
      infolab_cliente: {
        findMany: jest.fn(),
        findFirst: jest.fn(),
        create: jest.fn(),
      },
    } as any;

    const module = await Test.createTestingModule({
      providers: [
        ClienteService,
        { provide: PrismaService, useValue: prismaMock },
      ],
    }).compile();

    service = module.get(ClienteService);
  });

  describe("listar", () => {
    it("retorna clientes do tenant", async () => {
      prismaMock.infolab_cliente.findMany.mockResolvedValue([
        { id_cliente: BigInt(1), nome: "João" } as any,
      ]);

      const ctx = { idTenacidade: BigInt(12), ip: "127.0.0.1" };
      const result = await service.listar(ctx as any);

      expect(result).toHaveLength(1);
      expect(prismaMock.infolab_cliente.findMany).toHaveBeenCalled();
    });

    it("retorna array vazio se não há registros", async () => {
      prismaMock.infolab_cliente.findMany.mockResolvedValue([]);

      const result = await service.listar({ idTenacidade: BigInt(12) } as any);

      expect(result).toHaveLength(0);
    });
  });
});
```

### 34.3 Rodando

```bash
nx run api:test                          # todos
nx run api:test --testFile=cliente       # apenas cliente
npm run test                             # tudo (api + web)
```

### 34.4 Cobertura

```bash
nx run api:test --coverage
```

Gera relatório em `api/coverage/index.html`.

---

## 35. Testes de componente (Vitest)

### 35.1 Padrão

```typescript
// web/src/components/MeuComponente.test.tsx
import { describe, it, expect } from "vitest";
import { render, screen } from "@testing-library/react";
import { MeuComponente } from "./MeuComponente";

describe("MeuComponente", () => {
  it("renderiza título", () => {
    render(<MeuComponente titulo="Olá" />);
    expect(screen.getByText("Olá")).toBeInTheDocument();
  });
});
```

### 35.2 Mock de hooks Next.js

```typescript
import { vi } from "vitest";

vi.mock("next/navigation", () => ({
  useRouter: () => ({
    push: vi.fn(),
    replace: vi.fn(),
  }),
  usePathname: () => "/teste",
}));
```

### 35.3 Mock de next-intl

```typescript
vi.mock("next-intl", () => ({
  useTranslations: () => (key: string) => key,
}));
```

---

## 36. Lint e formatação

### 36.1 ESLint

Configurado no monorepo. Roda automaticamente em CI.

```bash
npm run lint                  # tudo
nx run api:lint               # só API
nx run web:lint --fix         # só web, autocorrige
```

### 36.2 Regras críticas

- **No `any` sem justificativa**
- **No `console.log`** em código de produção (use logger)
- **Imports organizados**
- **Sem variáveis não utilizadas**
- **Sem dead code**

### 36.3 Editor

Configure VS Code/Cursor para:

- ESLint: ativo
- Format on save: usando ESLint
- Trim trailing whitespace: sim

`settings.json`:

```json
{
  "editor.formatOnSave": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true
  },
  "files.trimTrailingWhitespace": true
}
```

---

# Parte 8 — Deploy e operações

## 37. Build e empacotamento

### 37.1 Build local

```bash
npm run build         # api + web
npm run build:api     # apenas api
npm run build:web     # apenas web
```

### 37.2 Output

- **API**: `api/dist/` — bundle Node.js pronto para rodar
- **Web**: `web/.next/` — build Next.js otimizado

### 37.3 Tamanho típico

- **API bundle**: ~50-100 MB com node_modules
- **Web bundle**: ~5-10 MB JS comprimido (depois de tree shaking)

---

## 38. Variáveis de ambiente

### 38.1 Backend (api/.env)

| Variável | Obrigatória | Descrição |
|---|---|---|
| `DATABASE_URL` | Sim | Conexão PostgreSQL |
| `JWT_SECRET` | Sim | Chave de assinatura JWT |
| `JWT_EXPIRES_IN` | Sim | Tempo de vida (ex: `1h`) |
| `SUPORTE_SECRET_KEY` | Sim | Chave de bootstrap |
| `OPENAI_API_KEY` | Não | Para módulo IA |
| `OPENAI_CHAT_MODEL` | Não | Padrão `gpt-4o-mini` |
| `LOG_LEVEL` | Não | `error`, `warn`, `info`, `debug` |

### 38.2 Frontend (web/.env)

| Variável | Obrigatória | Descrição |
|---|---|---|
| `API_BASE_URL` | Sim | URL da API NestJS |
| `NEXT_PUBLIC_APP_NAME` | Não | Nome exibido na UI |

### 38.3 Diretrizes

- **Nunca commite** `.env` no Git
- **Use `.env.example`** com valores fictícios
- **Variáveis `NEXT_PUBLIC_*`** ficam visíveis no JS do cliente — não coloque segredos
- **Rotacione segredos** periodicamente em produção

---

## 39. Deploy em homologação e produção

### 39.1 Pipeline típico

```
Commit em main → CI roda → Build → Deploy automático para homologação
                                                ↓
                                  Aprovação manual → Deploy para produção
```

### 39.2 Containers

Tipicamente Docker. `Dockerfile` em cada workspace.

```dockerfile
# api/Dockerfile (exemplo)
FROM node:22-alpine AS builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build:api

FROM node:22-alpine AS runner
WORKDIR /app
COPY --from=builder /app/api/dist ./dist
COPY --from=builder /app/api/node_modules ./node_modules
EXPOSE 3001
CMD ["node", "dist/main.js"]
```

### 39.3 Orquestração

- **Kubernetes** com Helm charts (ambientes maiores)
- **Docker Compose** (laboratórios menores)
- **PM2** com Node direto (mais simples)

### 39.4 Health checks

```yaml
# k8s liveness
livenessProbe:
  httpGet:
    path: /health
    port: 3001
  initialDelaySeconds: 30
  periodSeconds: 10
```

---

## 40. Migrações em produção

### 40.1 Sempre `migrate deploy`

```bash
# Em CI/CD pipeline
npx prisma migrate deploy
```

Aplica **apenas** migrations pendentes. Sem prompts. Determinístico.

### 40.2 Estratégias para migrations longas

Migrations que demoram muito (ex.: backfill em tabelas com milhões de linhas) precisam de cuidado:

- **Fazer backup antes**
- **Janela de manutenção** se travar tabela
- **Considerar migration online** (sem lock pesado)
- **Testar em homologação com dataset realista**

### 40.3 Rollback

Migrations são **forward-only**. Para reverter:

1. Crie nova migration que desfaz a anterior
2. Aplique normalmente

Não tente editar migrations já aplicadas em produção.

---

## 41. Monitoramento e logs

### 41.1 Logs estruturados

Use logger do NestJS em vez de `console.log`:

```typescript
import { Logger } from "@nestjs/common";

@Injectable()
export class ClienteService {
  private logger = new Logger(ClienteService.name);

  async listar(ctx: TenantContexto) {
    this.logger.log(`Listando clientes para tenant ${ctx.idTenacidade}`);
    // ...
  }
}
```

### 41.2 Níveis

- `error` — erros que precisam ação
- `warn` — situações suspeitas
- `info` — eventos de negócio
- `debug` — diagnóstico

### 41.3 Métricas recomendadas

- **Latência por endpoint** (p50, p95, p99)
- **Taxa de erro** (4xx, 5xx)
- **QPS por tenant** (detectar abuso)
- **Conexões PostgreSQL** (pool saturação)
- **Memória e CPU** dos containers

### 41.4 Ferramentas comuns

- **Prometheus + Grafana** (métricas)
- **Loki** ou **ElasticSearch** (logs centralizados)
- **Sentry** (erros do frontend)
- **Datadog**, **New Relic** (APM all-in-one)

---

# Parte 9 — Git, code review e colaboração

## 42. Workflow Git

### 42.1 Branches

```
main                          ← branch principal, sempre deployável
├── feat/adicionar-modulo-X   ← feature
├── fix/corrigir-erro-Y       ← bug fix
├── refactor/limpar-Z         ← refactor sem mudar comportamento
└── docs/atualizar-W          ← apenas docs
```

### 42.2 Fluxo

```bash
# Atualizar main
git checkout main
git pull

# Criar feature branch
git checkout -b feat/minha-feature

# Trabalhar, commitar
git add .
git commit -m "feat(cliente): adiciona campo email_secundario"

# Sincronizar antes de PR
git fetch origin
git rebase origin/main

# Push
git push origin feat/minha-feature

# Abrir PR
```

### 42.3 Resolução de conflitos

Prefira `rebase` sobre `merge` para histórico linear:

```bash
git fetch origin
git rebase origin/main
# resolva conflitos
git add <arquivos>
git rebase --continue
```

---

## 43. Commits e mensagens

### 43.1 Conventional Commits

```
<tipo>(<escopo>): <descrição>

[corpo opcional]

[footer opcional]
```

### 43.2 Tipos comuns

- `feat`: nova funcionalidade
- `fix`: correção de bug
- `refactor`: refatoração sem mudar comportamento
- `docs`: apenas documentação
- `test`: apenas testes
- `chore`: tarefas auxiliares (deps, configs)
- `perf`: melhoria de performance

### 43.3 Exemplos

```
feat(soroteca): adiciona endpoint para descarte em lote

fix(cliente): corrige busca por CPF com máscara

refactor(comum): extrai validação de IP para função utilitária

docs(ai): atualiza Rules.md de soroteca com regra de retenção mínima
```

---

## 44. Pull requests e code review

### 44.1 Template de PR

```markdown
## O que muda
Breve descrição do que este PR faz.

## Por que
Contexto/motivação. Link para issue se houver.

## Como testar
1. Passo a passo para o reviewer
2. Cenários positivos e negativos

## Checklist
- [ ] Testes adicionados/atualizados
- [ ] Documentação atualizada (ai/domains se aplicável)
- [ ] Lint passa
- [ ] Build local passa
- [ ] Sem dados sensíveis no código
- [ ] Mudanças de schema discutidas e aprovadas
```

### 44.2 Tamanho ideal de PR

- **Pequeno** (< 400 linhas): revisão rápida, baixo risco
- **Médio** (400-800): aceitável
- **Grande** (> 800): considere quebrar

PRs gigantes recebem revisão superficial e introduzem bugs.

### 44.3 Tempo de revisão

- **< 1 dia útil** para PRs urgentes
- **2-3 dias** para PRs normais
- **Sempre dê feedback** mesmo que seja "LGTM"

### 44.4 Boas práticas para o autor

- **Self-review** antes de pedir revisão
- **Descreva intenção** no PR, não só o que mudou
- **Responda aos comentários**, não só dê commit
- **Ao discordar**, argumente — não apenas resista

### 44.5 Boas práticas para o reviewer

- **Foque em correção, design, manutenibilidade**
- **Seja específico** ("considere X" em vez de "isso está errado")
- **Diferencie crítica obrigatória de sugestão**
- **Use comentários ao código**, não só comentário geral
- **Aprove com confiança** ou peça mudança com clareza — não fique no meio termo

---

# Parte 10 — Referências

## 45. Glossário técnico

| Termo | Definição |
|---|---|
| **App Router** | Modelo de roteamento do Next.js 13+ (`app/` em vez de `pages/`) |
| **BFF** | Backend for Frontend — camada do Next.js que faz proxy controlado |
| **Class-validator** | Biblioteca de validação por decorators (`@IsString`, `@IsEmail`) |
| **Conventional Commits** | Padrão de mensagens de commit |
| **Decorator** | Anotação TypeScript que adiciona metadata ou comportamento |
| **DTO** | Data Transfer Object — estrutura validada de entrada/saída |
| **Dynamic import** | `dynamic()` do Next.js para carregamento sob demanda |
| **Guard** | Middleware do NestJS para autorização (ex.: validar JWT) |
| **Hook** | Função React que adiciona estado ou efeitos a componentes |
| **JWT** | JSON Web Token — token assinado para autenticação |
| **Lazy loading** | Carregamento sob demanda (não no bundle inicial) |
| **Migration** | Script SQL versionado de mudança de schema |
| **Module** | Unidade modular do NestJS com controllers, services, providers |
| **Monorepo** | Múltiplos projetos no mesmo repositório Git |
| **Nx** | Ferramenta de orquestração de monorepo |
| **Pipe** | Middleware do NestJS para transformação/validação |
| **Prisma Client** | Cliente gerado pelo Prisma com tipos a partir do schema |
| **RLS** | Row-Level Security do PostgreSQL |
| **Schema Prisma** | Arquivo `.prisma` que descreve modelo de dados |
| **Server Component** | Componente React renderizado no servidor (default no App Router) |
| **Service** | Camada do NestJS com lógica de negócio |
| **Tenant** | Cliente isolado em sistema multi-tenant |
| **Workspace** | Subprojeto dentro de monorepo (api/, web/) |

---

## 46. Mapa de pastas e responsabilidades

### 46.1 Backend (api/src/)

| Pasta | Responsabilidade |
|---|---|
| `ai/` | Endpoint `/ai/generate`, leitura de `Rules.md` |
| `aplicacao/` | Configuração da aplicação |
| `atendimento/` | Atendimentos (pedidos) |
| `autenticacao/` | Login, JWT, captcha, troca de senha |
| `catalogo/` | Catálogos universais (CID, CBO, etc.) |
| `cliente/` | Pacientes |
| `comum/` | Decorators, guards, filtros, utilitários transversais |
| `convenio/` | Convênios e tabelas de preço |
| `exame/` | Catálogo de exames |
| `fatura/` | Faturamento |
| `prisma/` | Cliente Prisma estendido com RLS |
| `soroteca/` | Soroteca (38 modelos, 3251 linhas) |
| `usuario/` | Usuários, perfis, permissões |

### 46.2 Frontend (web/src/)

| Pasta | Responsabilidade |
|---|---|
| `app/` | Rotas (App Router) |
| `app/api/[...path]/` | BFF com allowlist |
| `app/(comum)/i18n/` | Traduções pt-BR |
| `components/abas/` | Sistema de abas |
| `components/formulario-base/` | Formulário base genérico |
| `components/formulario-cadastro/` | Formulário de cadastro padrão |
| `components/formulario-pesquisa/` | Listagem padrão |
| `components/navegacao/` | Menu lateral, busca, breadcrumbs |
| `components/soroteca/` | Componentes específicos da Soroteca |
| `components/ui/` | Componentes UI gerais |
| `contexts/` | React Contexts |
| `hooks/` | Hooks customizados |
| `lib/` | Funções utilitárias puras |
| `types/` | Tipos compartilhados |
| `data/` | Dados estáticos (menu) |

### 46.3 Documentação (ai/)

| Pasta | Responsabilidade |
|---|---|
| `domains/<dominio>/` | Documentação de cada domínio |
| `checklists/` | Checklists de implantação |

### 46.4 Configuração (.cursor/)

| Pasta | Responsabilidade |
|---|---|
| `rules/global/` | Regras globais |
| `rules/backend/` | Regras backend |
| `rules/front-end/` | Regras frontend |
| `rules/ai-first/` | Prioridade entre fontes |
| `rules/crud-telas/` | Padrões de tela CRUD |
| `mcp.json` | Configuração de servidores MCP |

---

## 47. Recursos externos

### 47.1 Documentação oficial

- **NestJS**: https://docs.nestjs.com
- **Prisma**: https://www.prisma.io/docs
- **Next.js**: https://nextjs.org/docs
- **React**: https://react.dev
- **PrimeReact**: https://primereact.org
- **PostgreSQL RLS**: https://www.postgresql.org/docs/current/ddl-rowsecurity.html
- **Nx**: https://nx.dev

### 47.2 Padrões e convenções

- **Conventional Commits**: https://www.conventionalcommits.org
- **Semantic Versioning**: https://semver.org
- **TypeScript Handbook**: https://www.typescriptlang.org/docs/handbook

### 47.3 Internamente

- `ai/README.md` — runbook da pasta de IA
- `ai/domains/<dominio>/Rules.md` — regras específicas
- `.cursor/rules/global/global.mdc` — regras gerais
- `.cursor/rules/backend/backend.mdc` — regras backend
- `.cursor/rules/front-end/frontend.mdc` — regras frontend

---

## Histórico

| Versão | Data | Resumo |
|---|---|---|
| 1.0 | Maio/2026 | Versão inicial. Cobre arquitetura, setup, padrões, construção de módulos, deploy. |

---

> **Próxima revisão:** atualizar a cada mudança arquitetural significativa (nova versão major de Next.js, NestJS ou Prisma; novo padrão adotado; reestruturação de pastas). Manter sincronizado com `.cursor/rules/`.

*Em divergência entre este manual e o código, prevalece o código. Reporte ao time de arquitetura qualquer divergência percebida para alinhamento.*
