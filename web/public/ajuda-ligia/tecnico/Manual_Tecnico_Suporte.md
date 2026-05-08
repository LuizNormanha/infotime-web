# Manual Técnico — Infotime Web

**Sistema:** Infotime Web
**Público:** Técnico de suporte (N1/N2), implantador, administrador de tenant, mesa de ajuda
**Foco:** "Por que isso está acontecendo? Como diagnostico e resolvo?"
**Versão:** 1.0 — Maio/2026

> Este manual é para quem **resolve problemas** dos usuários finais: técnicos de suporte, equipe de help desk, implantadores e administradores. Aqui você encontra padrões de diagnóstico, configuração de tenant, troubleshooting de incidentes comuns, ferramentas de investigação e procedimentos de escalonamento.

---

## Sumário

### Parte 1 — Visão técnica do sistema
1. [Arquitetura em alto nível](#1-arquitetura-em-alto-nível)
2. [Stack tecnológico](#2-stack-tecnológico)
3. [Camadas e fluxo de uma requisição](#3-camadas-e-fluxo-de-uma-requisição)
4. [Topologia: como os componentes conversam](#4-topologia-como-os-componentes-conversam)

### Parte 2 — Multi-tenant e segurança
5. [Modelo multi-tenant com RLS](#5-modelo-multi-tenant-com-rls)
6. [Autenticação JWT e sessão](#6-autenticação-jwt-e-sessão)
7. [Permissões, perfis e grupos de usuário](#7-permissões-perfis-e-grupos-de-usuário)
8. [Allowlist BFF — RECURSOS_PERMITIDOS](#8-allowlist-bff--recursos_permitidos)

### Parte 3 — Configuração de tenant e usuários
9. [Cadastrando um novo tenant (laboratório)](#9-cadastrando-um-novo-tenant-laboratório)
10. [Criando usuários e atribuindo perfis](#10-criando-usuários-e-atribuindo-perfis)
11. [Reset de senha e desbloqueio](#11-reset-de-senha-e-desbloqueio)
12. [Customização de layouts por grupo](#12-customização-de-layouts-por-grupo)

### Parte 4 — Diagnóstico e troubleshooting
13. [Como o usuário descreve um problema vs. o que está acontecendo](#13-como-o-usuário-descreve-um-problema-vs-o-que-está-acontecendo)
14. [Os logs do sistema — onde e como ler](#14-os-logs-do-sistema--onde-e-como-ler)
15. [Códigos HTTP e o que eles significam](#15-códigos-http-e-o-que-eles-significam)
16. [Erros comuns: causas e soluções](#16-erros-comuns-causas-e-soluções)
17. [Investigação no banco de dados](#17-investigação-no-banco-de-dados)
18. [Investigação no front-end (DevTools)](#18-investigação-no-front-end-devtools)

### Parte 5 — Procedimentos operacionais
19. [Health check do sistema](#19-health-check-do-sistema)
20. [Verificando se o backend está respondendo](#20-verificando-se-o-backend-está-respondendo)
21. [Verificando o banco PostgreSQL](#21-verificando-o-banco-postgresql)
22. [Limpeza de cache e sessões](#22-limpeza-de-cache-e-sessões)

### Parte 6 — Módulos e suas peculiaridades
23. [Cadastros — onde mexer cada coisa](#23-cadastros--onde-mexer-cada-coisa)
24. [Soroteca — diagnóstico específico](#24-soroteca--diagnóstico-específico)
25. [Auditoria — como consultar trilhas](#25-auditoria--como-consultar-trilhas)
26. [Integrações com analisadores](#26-integrações-com-analisadores)

### Parte 7 — Escalonamento
27. [Quando resolver no nível 1 vs. escalar](#27-quando-resolver-no-nível-1-vs-escalar)
28. [Como escalar para o nível 2 ou desenvolvimento](#28-como-escalar-para-o-nível-2-ou-desenvolvimento)
29. [Canais e contatos](#29-canais-e-contatos)

### Parte 8 — Referências
30. [Glossário técnico](#30-glossário-técnico)
31. [Comandos úteis de PostgreSQL](#31-comandos-úteis-de-postgresql)
32. [Referência rápida de API REST](#32-referência-rápida-de-api-rest)
33. [Checklist de diagnóstico](#33-checklist-de-diagnóstico)

---

# Parte 1 — Visão técnica do sistema

## 1. Arquitetura em alto nível

O Infotime Web é um **monorepo Nx** com dois workspaces principais:

```
infotime-web/
├── api/              ← Backend NestJS 11 + Prisma 6 + PostgreSQL
├── web/              ← Frontend Next.js 16 + React 19 + PrimeReact
├── ai/               ← Documentação de domínio (markdown versionado)
├── tools/            ← Ferramentas auxiliares (MCP, scripts)
├── .cursor/rules/    ← Regras de desenvolvimento
└── prisma/           ← Migrations e schema
```

### 1.1 Modelo arquitetural

- **Backend NestJS**: API REST organizada por módulos de domínio
- **ORM Prisma**: mapeamento objeto-relacional, migrations versionadas
- **Banco PostgreSQL**: dados com Row-Level Security (RLS) para isolamento multi-tenant
- **Frontend Next.js (App Router)**: páginas como rotas, componentes em React 19
- **BFF (Backend for Frontend)**: rotas `/api/*` no Next.js fazem proxy controlado para a API NestJS
- **Sistema de abas no cliente**: `LigaSistemaAbas` permite múltiplas telas simultâneas

### 1.2 Princípios arquiteturais

- **Multi-tenant nativo via RLS**: isolamento no nível do banco, não da aplicação
- **Auditoria estrutural**: cada tabela tem `id_usuario_auditoria`, `endereco_ip_auditoria`, `nome_aplicacao_auditoria`
- **Convenção pt-BR para domínio, inglês para framework**: `infolab_*` em tabelas, `Controller`/`Service` em classes
- **Layout dinâmico**: cada tela pode ser customizada por grupo de usuário sem mudar código
- **Catálogos de domínio em `ai/domains/`**: documentação versionada como fonte de verdade

---

## 2. Stack tecnológico

| Camada | Tecnologia | Versão |
|---|---|---|
| Runtime | Node.js | ≥ 22 |
| Pacotes | npm | ≥ 10 |
| Monorepo | Nx | 22.6.4 |
| Backend | NestJS | 11.x |
| ORM | Prisma | 6.x |
| Banco | PostgreSQL | ≥ 14 (RLS necessário) |
| Frontend framework | Next.js | 16.x (App Router) |
| UI library | React | 19.x |
| UI components | PrimeReact | atual |
| i18n | next-intl | atual |
| Lint | ESLint | 9.x |
| Test | Jest, Vitest | atuais |
| Dev orchestration | concurrently + Nx | — |

### 2.1 Comandos básicos do monorepo

| Comando | O que faz |
|---|---|
| `npm run dev` | Sobe API e Web em modo desenvolvimento |
| `npm run dev:api` | Apenas API |
| `npm run dev:web` | Apenas Web |
| `npm run build` | Build de api e web |
| `npm run lint` | Lint de todos os workspaces |
| `npm run test` | Testes de todos os workspaces |

### 2.2 Variáveis de ambiente típicas

| Variável | Onde | Função |
|---|---|---|
| `DATABASE_URL` | `api/.env` | Conexão PostgreSQL |
| `JWT_SECRET` | `api/.env` | Chave de assinatura do JWT |
| `JWT_EXPIRES_IN` | `api/.env` | Tempo de vida do token |
| `API_BASE_URL` | `web/.env` | URL da API NestJS |
| `NEXT_PUBLIC_*` | `web/.env` | Variáveis públicas do front |

> ⚠️ **Nunca compartilhe** `.env` em chamados, screenshots ou logs. Contém credenciais.

---

## 3. Camadas e fluxo de uma requisição

Toda requisição do navegador para o banco passa por 5 camadas:

```
Navegador (componente Liga*)
   |
   |  fetch("/api/soroteca/caixas/123/mapa")
   v
Next.js BFF (rota dinâmica /api/[...path])
   |  - Valida allowlist RECURSOS_PERMITIDOS
   |  - Anexa cookie JWT à chamada
   |  - Faz forward para a API NestJS
   v
NestJS API
   |  - autenticacao.guard valida JWT
   |  - decorators @TenantAtual e @UsuarioAtual extraem contexto
   |  - Controller chama Service
   v
Service NestJS
   |  - Validação de regras de negócio
   |  - Prisma para query
   v
PostgreSQL
   |  - Policy RLS aplica id_tenacidade automaticamente
   |  - Retorna apenas registros do tenant
   v
Resposta sobe a cadeia até o navegador
```

### 3.1 Pontos onde a requisição pode falhar

| Camada | Problema típico | Sintoma para o usuário |
|---|---|---|
| Navegador | Erro de JS, cookie corrompido | Tela em branco, console com erro |
| BFF | Path não está na allowlist | 403 Forbidden |
| NestJS Auth Guard | JWT inválido/expirado | 401 Unauthorized |
| NestJS Service | Validação de negócio | 400 BadRequest com mensagem |
| Prisma | Query inválida | 500 Internal Error |
| PostgreSQL RLS | Tenant não setado | Lista vazia (não é erro!) |
| Banco | Constraint violation | 409 Conflict ou 500 |

---

## 4. Topologia: como os componentes conversam

Em produção típica:

```
                    ┌─────────────────┐
                    │  Load Balancer  │
                    └────────┬────────┘
                             │
                ┌────────────┼────────────┐
                │            │            │
        ┌───────▼────┐ ┌─────▼─────┐ ┌───▼─────────┐
        │  Web 1     │ │  Web 2    │ │  Web N      │
        │  (Next.js) │ │           │ │             │
        └─────┬──────┘ └─────┬─────┘ └──────┬──────┘
              │              │              │
              └──────────────┼──────────────┘
                             │
                ┌────────────┼────────────┐
                │            │            │
        ┌───────▼────┐ ┌─────▼─────┐ ┌───▼─────────┐
        │  API 1     │ │  API 2    │ │  API N      │
        │  (NestJS)  │ │           │ │             │
        └─────┬──────┘ └─────┬─────┘ └──────┬──────┘
              │              │              │
              └──────────────┼──────────────┘
                             │
                    ┌────────▼─────────┐
                    │  PostgreSQL      │
                    │  (Master/Replica)│
                    └──────────────────┘
```

### 4.1 Aspectos a saber

- **Web e API podem escalar horizontalmente** — sem estado de sessão na memória
- **Sessão fica no JWT** (cookie HTTP-only)
- **PostgreSQL é o gargalo** — atenção a queries lentas e índices
- **Cache de leitura** pode ser configurado em alguns endpoints

---

# Parte 2 — Multi-tenant e segurança

## 5. Modelo multi-tenant com RLS

### 5.1 Conceito

Todo dado de negócio tem coluna `id_tenacidade BigInt`. O PostgreSQL aplica policy RLS que filtra automaticamente por essa coluna baseado em `app.current_tenant_id`.

### 5.2 Como o tenant é definido

Em cada requisição autenticada:

1. JWT do cookie é decodificado
2. Backend extrai `id_tenacidade` do payload
3. Antes de qualquer query, `SET LOCAL app.current_tenant_id = X` é executado
4. Policy RLS automaticamente filtra todas as queries

### 5.3 Diagnóstico — "usuário não vê nada"

Sintoma: usuário acessa listagem e ela aparece vazia, mesmo havendo dados.

Possíveis causas:

| Causa | Como verificar |
|---|---|
| Usuário não tem `id_tenacidade` no perfil | Consultar `SELECT id_tenacidade FROM infolab_usuario WHERE login = 'X'` |
| Cookie JWT não está sendo enviado | DevTools → Application → Cookies |
| Backend não está setando `current_tenant_id` | Logs do NestJS — buscar erros de RLS |
| Tenant existe mas está inativo | `SELECT ativo FROM infolab_tenacidade WHERE id_tenacidade = X` |

### 5.4 Catálogos sem RLS

Algumas tabelas são **globais** (sem `id_tenacidade`):

- `infolab_temperatura_opcao`
- `infolab_cid`
- `infolab_cbo`
- `infolab_conselho_regional`
- `infolab_especialidade_medica`

São catálogos universais. **Não** aplicar RLS neles é proposital.

---

## 6. Autenticação JWT e sessão

### 6.1 Fluxo de login

```
1. Usuario submete form de login (POST /api/auth/login)
2. Backend valida credenciais (login + senha)
3. Backend valida CAPTCHA quando aplicável
4. Backend gera JWT contendo:
   - id_usuario
   - id_tenacidade
   - data de expiração
5. JWT é setado em cookie HTTP-only seguro
6. Próximas requisições enviam cookie automaticamente
7. Backend valida JWT em cada requisição via guard
```

### 6.2 Estrutura do JWT

Payload típico (decodificado):

```json
{
  "sub": "usuario-123",
  "id_usuario": "456",
  "id_tenacidade": "12",
  "iat": 1714838400,
  "exp": 1714842000
}
```

### 6.3 Configuração de expiração

| Variável | Padrão típico |
|---|---|
| `JWT_EXPIRES_IN` | 1h ou 30min (configurável) |
| Cookie `Max-Age` | mesmo do JWT |
| Cookie `HttpOnly` | true (sempre) |
| Cookie `Secure` | true em produção |
| Cookie `SameSite` | Lax ou Strict |

### 6.4 Reautenticação inline

Quando o token expira **durante o uso**, o frontend chama `solicitarReautenticacaoGlobal()` que abre diálogo pedindo senha sem fechar o formulário em edição. Isso preserva o estado.

---

## 7. Permissões, perfis e grupos de usuário

### 7.1 Modelo de permissões

```
infolab_usuario
   |
   +-- N --+ infolab_grupo_usuario
                   |
                   +-- N --+ infolab_grupo_perfil_permissao
                                  |
                                  +-- 1 --+ infolab_grupo_perfil
                                                |
                                                +-- N --+ infolab_grupo_permissao_tela
```

### 7.2 Conceitos

- **Usuário**: pessoa que faz login
- **Grupo de usuário**: conjunto de pessoas com mesma função
- **Grupo de perfil**: define um conjunto de permissões
- **Permissão de tela**: define o que cada perfil pode fazer em cada tela

### 7.3 Tipos de permissão por tela

| Permissão | O que permite |
|---|---|
| `LEITURA` | Ver listagem e abrir registros |
| `INCLUSAO` | Criar novos registros |
| `EDICAO` | Modificar registros existentes |
| `EXCLUSAO` | Excluir registros |
| `APROVACAO` | Aprovar (em fluxos com workflow) |

### 7.4 Diagnóstico — "botão Novo está desabilitado"

| Causa | Verificação |
|---|---|
| Perfil sem `INCLUSAO` na tela | `SELECT * FROM infolab_grupo_permissao_tela WHERE codigo_tela = 'X' AND tipo_permissao = 'INCLUSAO'` |
| Tela é somente leitura por design | Conferir tela em código (ex.: `SLUGS_SOROTECA_CADASTRO_SOMENTE_LEITURA`) |
| Pré-condição não atendida | Mensagem de tooltip do botão |

---

## 8. Allowlist BFF — RECURSOS_PERMITIDOS

### 8.1 O que é

Arquivo `web/src/app/api/[...path]/recursos-permitidos-bff.ts` contém um `Set<string>` de todos os primeiros segmentos de path liberados.

Exemplo:

```typescript
export const RECURSOS_PERMITIDOS = new Set([
  "ai", "atendimentos", "auth", "clientes",
  "convenios", "exames", "soroteca", "usuarios",
  // ...
]);
```

### 8.2 Como funciona

Quando o frontend chama `/api/soroteca/caixas/123`, o BFF:

1. Extrai o primeiro segmento: `"soroteca"`
2. Verifica se está em `RECURSOS_PERMITIDOS`
3. Se sim → faz forward para a API NestJS
4. Se não → retorna 403 Forbidden

### 8.3 Diagnóstico — "403 ao acessar nova rota"

Sintoma: módulo novo está implementado no backend mas o frontend recebe 403.

**Causa típica:** primeiro segmento da rota não está na allowlist.

**Solução:** adicionar o segmento ao `RECURSOS_PERMITIDOS` e fazer deploy do frontend.

### 8.4 Por que existe a allowlist

Defesa em profundidade. Mesmo se houvesse rota não autenticada acidentalmente exposta no NestJS, o BFF não a expõe ao mundo externo se não estiver na allowlist.

---

# Parte 3 — Configuração de tenant e usuários

## 9. Cadastrando um novo tenant (laboratório)

### 9.1 Passo a passo

```
1. Login com usuario "suporte" ou "implantador" no Infotime Web central

2. Acessar:
   Menu → Cadastros → Implantação → Implantação de Tenacidades

3. Clicar em "Novo"

4. Preencher:
   - Codigo (ex: "LAB-CENTRAL-SP")
   - Nome (ex: "Laboratorio Central SP")
   - Dominio (ex: "lab-central-sp")
   - Status (ATIVO)
   - CNPJ
   - Razao social
   - Endereco
   - Configuracoes adicionais

5. Salvar

6. Configurar o primeiro usuario admin:
   - Login + senha provisoria
   - Vincular ao grupo "Administrador"

7. Validar com login do admin novo
```

### 9.2 Pós-cadastro

- Configurar **catálogos básicos** do tenant (tipos de equipamento, motivos de descarte, etc.)
- Para Soroteca: rodar `POST /soroteca/garantir-estrutura-padrao` que cria sala, equipamento, rack, caixa padrão
- Configurar **layout customizado** se necessário

---

## 10. Criando usuários e atribuindo perfis

### 10.1 Cadastrando um usuário

```
Menu → Cadastros → Acesso → Usuário

Campos importantes:
- Login (sem espaços, único por tenant)
- Nome completo
- E-mail
- Senha provisoria (será trocada no primeiro login)
- Tenacidade (deve ser do tenant atual)
- Status (ATIVO)
```

### 10.2 Vinculando ao grupo de usuário

```
Menu → Cadastros → Acesso → Usuário-Perfil

Campos:
- Usuario
- Grupo de perfil
- Validade (opcional)
```

### 10.3 Logins reservados

O sistema tem uma lista de **logins reservados** (em `api/src/comum/logins-usuario-reservados.ts`) que não podem ser usados como login regular:

- `admin`, `root`, `system`, `api` (variações)
- `null`, `undefined`, etc.

Tentativa de criar usuário com esses logins retorna erro.

---

## 11. Reset de senha e desbloqueio

### 11.1 Reset de senha pelo administrador

```
Menu → Cadastros → Acesso → Usuário
1. Buscar o usuario
2. Editar
3. Marcar "resetar senha"
4. Sistema gera senha temporaria
5. Comunicar ao usuario
6. Usuario troca no proximo login
```

### 11.2 Desbloqueio após muitas tentativas erradas

```
Cenario: usuario tentou senha errada N vezes e foi bloqueado

Solucao:
Menu → Cadastros → Acesso → Usuario
1. Buscar
2. Editar  
3. Limpar campo de "tentativas falhas"
4. Marcar status como ATIVO
5. Salvar
```

### 11.3 Política de senha

Está definida em `api/src/comum/senha-usuario-politica.ts`:

- Mínimo 8 caracteres
- Deve ter letras e números
- Não pode ser igual aos últimos N (configurável)
- Expira em X dias (configurável)

---

## 12. Customização de layouts por grupo

### 12.1 Conceito

Cada formulário do Infotime Web tem **dois layouts possíveis**:

1. **Layout padrão** — definido em código (ex.: `criarSorotecaCaixaLayoutPadrao`)
2. **Layout customizado** — definido em banco, por grupo de usuário

Quando o usuário abre uma tela:

```
1. Frontend chama GET /api/layout/:tela/formulario-cadastro
2. Backend consulta infolab_layout_formulario filtrando por:
   - id_tenacidade
   - id_grupo_usuario (do usuario logado)
   - codigo_tela
3. Se existe layout customizado → retorna
4. Se não → retorna { v: 1, layout: { secoes: [] } }
5. Frontend usa o layout customizado ou cai no padrão
```

### 12.2 Como customizar

```
Menu → Cadastros → Acesso → Preferências de Layout de Formulário

Campos:
- Tela (codigo)
- Grupo de usuario
- Layout JSON
```

O JSON segue a interface `LayoutFormularioCadastro` (definida em `web/src/types/formulario-cadastro.types.ts`).

### 12.3 O que pode e o que não pode ser customizado

**Pode:**

- Esconder campos opcionais
- Reordenar seções
- Mudar rótulos (dentro do limite)
- Adicionar avisos/instruções

**Não pode:**

- Esconder campos `obrigatorio_sistema` (NOT NULL no banco)
- Burlar validações de negócio
- Esconder auditoria

---

# Parte 4 — Diagnóstico e troubleshooting

## 13. Como o usuário descreve um problema vs. o que está acontecendo

A primeira habilidade do suporte é **traduzir** descrições leigas em hipóteses técnicas.

### 13.1 Tabela de tradução

| Usuário diz | Pode ser |
|---|---|
| "O sistema travou" | Frontend perdeu conexão com backend; ou query lenta no banco |
| "Não consigo entrar" | Senha errada, sessão de outro lugar, usuário inativo, captcha |
| "A tela está em branco" | Erro 500 no backend; erro de JS no frontend; cookie corrompido |
| "Não aparece nada na lista" | Tenant errado, sem permissão, RLS sem dados, filtros muito restritivos |
| "Está lento" | Query sem índice, network ruim, muitas abas, máquina sobrecarregada |
| "O botão não funciona" | Permissão negada, validação local falhou, JS quebrado |
| "Sumiu o que eu tinha digitado" | Sessão expirou e perdeu estado; aba fechada acidentalmente |
| "Salvou errado" | Problema de validação não aparente; integridade referencial |

### 13.2 Perguntas que ajudam

Antes de tocar no sistema, pergunte:

1. **Quando começou?** (agora, hoje, sempre)
2. **Já funcionou antes?** (regressão ou problema novo)
3. **Aconteceu com outros usuários?** (problema individual ou geral)
4. **Qual tela exatamente?** (caminho completo no menu)
5. **Qual mensagem de erro?** (texto exato; foto de tela)
6. **O que estava fazendo quando aconteceu?** (passo a passo)
7. **Qual navegador?** (Chrome, Firefox, Edge — versão)
8. **Reiniciou o navegador? Tentou Ctrl+F5?**

---

## 14. Os logs do sistema — onde e como ler

### 14.1 Logs do backend NestJS

Tipicamente disponíveis via:

- **Docker**: `docker logs <container-id>`
- **PM2**: `pm2 logs api`
- **Systemd**: `journalctl -u infolab-api -f`
- **Arquivos**: `/var/log/infotime-web/api-*.log`

### 14.2 Estrutura típica de log

```
[Nest] 12345 - 04/05/2026 10:32:15  LOG [SorotecaService] listarCaixas tenant=12 retornou 47 caixas
[Nest] 12345 - 04/05/2026 10:32:18 ERROR [SorotecaService] listarCaixas falhou (P2002): Unique constraint failed
[Nest] 12345 - 04/05/2026 10:32:18 ERROR [SorotecaService] at Object.armazenar (...)
```

### 14.3 Logs do frontend Next.js

- **Server-side**: igual ao backend
- **Client-side**: aparece no DevTools do navegador (F12 → Console)

### 14.4 Logs do PostgreSQL

- **Logs de erro**: `/var/log/postgresql/postgresql-*.log`
- **Slow queries** (se habilitado): logs de queries que demoram > N ms

### 14.5 O que procurar

| Termo | O que indica |
|---|---|
| `ERROR` | Erro de execução |
| `P2002` (Prisma) | Constraint unique violada |
| `P2003` (Prisma) | Constraint FK violada |
| `P2025` (Prisma) | Registro não encontrado |
| `RLS` ou `permission denied` | Problema de Row-Level Security |
| `JWT` ou `Unauthorized` | Problema de autenticação |
| `timeout` | Query lenta ou rede ruim |
| `ECONNREFUSED` | Serviço não está respondendo |

---

## 15. Códigos HTTP e o que eles significam

### 15.1 Sucesso (2xx)

| Código | Significa |
|---|---|
| `200 OK` | Tudo certo, dados retornados |
| `201 Created` | Registro criado com sucesso |
| `204 No Content` | Sucesso sem dados (típico de DELETE) |

### 15.2 Erro do cliente (4xx)

| Código | Significa | Causa típica |
|---|---|---|
| `400 BadRequest` | Requisição malformada | Validação de DTO falhou |
| `401 Unauthorized` | Não autenticado | JWT ausente, expirado ou inválido |
| `403 Forbidden` | Sem permissão | Allowlist BFF, perfil sem direito |
| `404 NotFound` | Recurso não existe | ID inválido ou de outro tenant |
| `405 MethodNotAllowed` | Operação não permitida | Tentou POST em tela só leitura |
| `409 Conflict` | Conflito de estado | Código duplicado, posição ocupada |
| `422 UnprocessableEntity` | Dado inválido semanticamente | Regras de negócio falharam |
| `429 TooManyRequests` | Excesso de requisições | Rate limit ativado |

### 15.3 Erro do servidor (5xx)

| Código | Significa | Causa típica |
|---|---|---|
| `500 InternalServerError` | Erro inesperado do servidor | Bug, exceção não tratada |
| `502 BadGateway` | Backend não responde | API caiu, BFF não conectou |
| `503 ServiceUnavailable` | Sistema sobrecarregado ou em manutenção | Deploy, picos de tráfego |
| `504 GatewayTimeout` | Backend demorou demais | Query lenta, timeout |

---

## 16. Erros comuns: causas e soluções

### 16.1 "Acesso negado" (403)

| Causa | Diagnóstico | Solução |
|---|---|---|
| Allowlist BFF não tem o recurso | Verificar `RECURSOS_PERMITIDOS` | Adicionar e fazer deploy |
| Usuário sem permissão | Conferir perfil em `infolab_grupo_perfil_permissao` | Atribuir permissão |
| Tela bloqueada por design | Conferir código (ex.: SOMENTE_LEITURA) | Comportamento correto |

### 16.2 "Sessão expirada" (401)

| Causa | Solução |
|---|---|
| Tempo de inatividade excedido | Faça login de novo (esperado) |
| `JWT_SECRET` mudou no servidor | Redeploy ou reiniciar workers |
| Cookie corrompido | Limpar cookies do navegador |
| Relógio do servidor desincronizado | Sincronizar NTP |

### 16.3 "Código já existe" (409)

| Causa | Solução |
|---|---|
| Constraint `@@unique([id_tenacidade, codigo])` | Usar outro código |
| Constraint global única | Sistema avisa qual constraint |
| Pode estar em registro inativo | Sim — `ativo=false` ainda ocupa o código. Reativar ou usar outro |

### 16.4 "Listagem vazia" (não é erro)

| Causa | Diagnóstico |
|---|---|
| Filtros muito restritivos | Limpar filtros |
| RLS sem dados para o tenant | Verificar `id_tenacidade` no JWT |
| Tenant inativo | `SELECT ativo FROM infolab_tenacidade WHERE...` |
| Tabela realmente vazia | Confirmar via SQL direto |

### 16.5 "Erro 500 ao salvar"

| Causa | Diagnóstico |
|---|---|
| Constraint FK violada (P2003) | Conferir se IDs referenciados existem |
| Coluna NOT NULL não preenchida | Conferir DTOs e validações |
| RLS bloqueando insert | Verificar se `current_tenant_id` foi setado |
| Trigger de banco falhou | Logs do PostgreSQL |
| Bug no service | Logs do NestJS |

### 16.6 "Tela em branco"

| Causa | Diagnóstico |
|---|---|
| Erro de JS | DevTools → Console |
| Erro 500 ao carregar dados | DevTools → Network |
| Bundle do Next.js corrompido | Hard reload (Ctrl+Shift+R) |
| Versão do Web inconsistente com API | Confirmar que ambas foram deployadas juntas |

---

## 17. Investigação no banco de dados

### 17.1 Conectando

```bash
psql -h <host> -U <user> -d liga_infolab
```

### 17.2 Configurando o tenant na sessão

```sql
SET LOCAL app.current_tenant_id = '12';
```

Sem isso, queries com RLS retornam vazio.

### 17.3 Queries de diagnóstico úteis

**Quem é o usuário X?**

```sql
SELECT id_usuario, login, nome, ativo, id_tenacidade
FROM infolab_usuario
WHERE login = 'joao.silva';
```

**Que perfis o usuário X tem?**

```sql
SELECT u.login, gp.codigo, gp.descricao
FROM infolab_usuario u
JOIN infolab_grupo_usuario gu ON gu.id_usuario = u.id_usuario
JOIN infolab_grupo_perfil gp ON gp.id_grupo_perfil = gu.id_grupo_perfil
WHERE u.login = 'joao.silva';
```

**Quantos registros existem em uma tabela?**

```sql
SELECT count(*) FROM infolab_atendimento_amostra
WHERE id_tenacidade = 12;
```

**Quem foi o último a editar X?**

```sql
SELECT login_usuario, data_hora_evento, operacao, dados_depois
FROM infolab_soroteca_auditoria
WHERE tabela = 'infolab_soroteca_caixa'
  AND registro_id = '4827'
ORDER BY data_hora_evento DESC
LIMIT 10;
```

### 17.4 Cuidados

- **Sempre use `SET LOCAL`** (não `SET`) para que a config seja apenas da transação
- **Nunca faça UPDATE/DELETE direto** sem WHERE estrita
- **Nunca apague registros de auditoria**
- **Sempre teste em ambiente de homologação** antes de aplicar em produção

---

## 18. Investigação no front-end (DevTools)

### 18.1 Abrir DevTools

- **Chrome/Edge:** F12 ou Ctrl+Shift+I
- **Firefox:** F12 ou Ctrl+Shift+K
- **Safari:** Cmd+Option+I (após habilitar menu Desenvolvedor)

### 18.2 Aba Console

Para ver erros de JavaScript:

```
ERROR Uncaught TypeError: Cannot read property 'foo' of undefined
ERROR Failed to fetch /api/soroteca/caixas: 500 Internal Server Error
WARNING [next-intl] missing key 'home.cadastros.titulo'
```

### 18.3 Aba Network

Para investigar requisições HTTP:

1. Filtre por **XHR** ou **Fetch**
2. Reproduza a ação que falha
3. Clique na requisição que deu erro
4. Veja:
   - **Headers**: cookie está sendo enviado?
   - **Payload**: o que foi enviado
   - **Response**: o que o servidor respondeu (mensagem de erro)
   - **Timing**: quanto tempo demorou

### 18.4 Aba Application

Para inspecionar:

- **Cookies**: o JWT está lá? Está expirado?
- **Local Storage**: há dados que podem estar corrompidos?
- **Session Storage**: idem

### 18.5 Limpando dados do navegador

Se suspeita de cookie ou cache corrompido:

```
Aba Application → Storage → Clear site data
```

Ou:

```
Configurações → Privacidade → Limpar dados de navegação → Cookies + Cache
```

---

# Parte 5 — Procedimentos operacionais

## 19. Health check do sistema

### 19.1 Endpoint padrão

A API NestJS expõe (tipicamente):

```
GET /health
```

Resposta esperada:

```json
{
  "status": "ok",
  "info": {
    "database": { "status": "up" },
    "memory_heap": { "status": "up" }
  }
}
```

### 19.2 Verificação rápida via curl

```bash
curl -i https://api.infolabweb.com.br/health
```

- **200**: tudo certo
- **503**: algum serviço fora
- **timeout / ECONNREFUSED**: API caiu

---

## 20. Verificando se o backend está respondendo

### 20.1 Sequência de testes

```bash
# 1. Ping de rede
ping api.infolabweb.com.br

# 2. Health check
curl -i https://api.infolabweb.com.br/health

# 3. Auth endpoint (sem credenciais — espera 401)
curl -i https://api.infolabweb.com.br/api/auth/me

# 4. Listagem qualquer (espera 401 se não logado)
curl -i https://api.infolabweb.com.br/api/clientes
```

### 20.2 Interpretação

| Resultado | O que indica |
|---|---|
| ping não responde | Problema de rede ou DNS |
| ping responde, curl não | Firewall ou proxy bloqueando |
| curl retorna 502/503 | API caiu |
| curl retorna 401 | API funciona, só pede autenticação |
| curl retorna 200 health | Tudo certo |

---

## 21. Verificando o banco PostgreSQL

### 21.1 Conexão básica

```bash
psql -h <host> -U <user> -d liga_infolab -c "SELECT version();"
```

### 21.2 Status de conexões

```sql
SELECT count(*) FROM pg_stat_activity;
SELECT * FROM pg_stat_activity WHERE state != 'idle';
```

### 21.3 Tamanho do banco

```sql
SELECT pg_size_pretty(pg_database_size('liga_infolab'));
```

### 21.4 Tabelas maiores

```sql
SELECT
    schemaname,
    tablename,
    pg_size_pretty(pg_total_relation_size(schemaname||'.'||tablename)) AS size
FROM pg_tables
WHERE schemaname = 'public'
ORDER BY pg_total_relation_size(schemaname||'.'||tablename) DESC
LIMIT 20;
```

### 21.5 Queries lentas (se pg_stat_statements habilitado)

```sql
SELECT
    query,
    calls,
    mean_exec_time,
    total_exec_time
FROM pg_stat_statements
ORDER BY mean_exec_time DESC
LIMIT 20;
```

---

## 22. Limpeza de cache e sessões

### 22.1 Cache do Next.js

```bash
rm -rf web/.next/cache
npm run build:web
```

### 22.2 Cache do Nx (monorepo)

```bash
rm -rf .nx/cache
```

### 22.3 Sessões ativas no banco

Sessões são representadas pelos cookies JWT — não há tabela de sessão. Para "deslogar todos":

- Trocar `JWT_SECRET` no `.env` da API
- Reiniciar o backend
- Todos os JWTs antigos viram inválidos

> ⚠️ Use com cautela — derruba todos os usuários no momento.

### 22.4 Cache do navegador (do lado do usuário)

Oriente o usuário a:

- **Hard reload**: Ctrl+Shift+R (Windows/Linux) ou Cmd+Shift+R (Mac)
- **Limpar cookies** apenas do site
- Em último caso, **DevTools → Application → Clear site data**

---

# Parte 6 — Módulos e suas peculiaridades

## 23. Cadastros — onde mexer cada coisa

### 23.1 Mapa rápido

| Cadastro | Tabela principal | Localização menu |
|---|---|---|
| Pacientes | `infolab_cliente` | Cadastros → Pacientes |
| Médicos | `infolab_medico` | Cadastros → Médicos |
| Convênios | `infolab_convenio` | Cadastros → Convênios |
| Exames | `infolab_exame` | Cadastros → Exames |
| Materiais | `infolab_material` | Cadastros → Materiais |
| Setores | `infolab_setor` | Cadastros → Setores |
| Usuários | `infolab_usuario` | Cadastros → Acesso → Usuário |
| Perfis | `infolab_grupo_perfil` | Cadastros → Acesso → Perfil |
| Locais armazenamento | `infolab_local_armazenamento` | Cadastros → Locais |

### 23.2 Cadastros estruturais que precisam estar prontos antes da operação

- Tipos (de equipamento, recipiente, material, etc.)
- Motivos (de descarte, rejeição, prorrogação, etc.)
- Catálogos universais (CID, CBO) — geralmente já vêm seedados
- Setores
- Usuários e perfis básicos

---

## 24. Soroteca — diagnóstico específico

### 24.1 Estrutura padrão não criada

Sintoma: usuário tenta criar caixa e recebe "Catálogo incompleto: tipo de equipamento GELADEIRA não encontrado".

Solução:

```bash
# Verificar se as migrations rodaram
psql -d liga_infolab -c "SELECT codigo FROM infolab_equipamento_tipo WHERE id_tenacidade = 12;"
```

Se vazio:

- Rodar seed específica de soroteca: `npx prisma migrate deploy` se faltam migrations
- Ou inserir manualmente os tipos básicos via SQL

### 24.2 Caixa com aviso "células sem registro de posição"

Sintoma: usuário abre mapa e vê aviso amarelo no topo.

Diagnóstico:

```sql
-- Quantas posições deveriam existir?
SELECT num_linhas * num_colunas FROM infolab_soroteca_caixa WHERE id_soroteca_caixa = 4827;

-- Quantas existem realmente?
SELECT count(*) FROM infolab_soroteca_posicao WHERE id_soroteca_caixa = 4827;
```

Se diferentes, há posições faltando. Causas possíveis:

- Caixa criada antes da migration de posições
- Falha em transação (parcial)

Solução: regenerar posições:

```sql
INSERT INTO infolab_soroteca_posicao (
    id_tenacidade, id_soroteca_caixa, ativo, linha, coluna, rotulo,
    endereco_ip_auditoria, nome_aplicacao_auditoria
)
SELECT
    c.id_tenacidade, c.id_soroteca_caixa, true,
    l.linha, col.coluna,
    chr(65 + l.linha) || (col.coluna + 1)::text,
    'reposicao', 'manual-suporte'
FROM infolab_soroteca_caixa c
CROSS JOIN generate_series(0, c.num_linhas - 1) AS l(linha)
CROSS JOIN generate_series(0, c.num_colunas - 1) AS col(coluna)
WHERE c.id_soroteca_caixa = 4827
ON CONFLICT (id_soroteca_caixa, linha, coluna) DO NOTHING;
```

### 24.3 Conflito de "amostra ativa em outra posição"

Sintoma: usuário tenta armazenar amostra que já está em outra caixa.

Diagnóstico:

```sql
SELECT a.id_soroteca_armazenamento, a.id_soroteca_posicao, p.rotulo, c.codigo
FROM infolab_soroteca_armazenamento a
JOIN infolab_soroteca_posicao p ON p.id_soroteca_posicao = a.id_soroteca_posicao
JOIN infolab_soroteca_caixa c ON c.id_soroteca_caixa = p.id_soroteca_caixa
WHERE a.id_atendimento_amostra = 12345
  AND a.ativo = true;
```

Solução: remover da caixa antiga primeiro, depois armazenar na nova.

---

## 25. Auditoria — como consultar trilhas

### 25.1 Quem fez X em data Y

```sql
SELECT
    data_hora_evento,
    operacao,
    tabela,
    registro_id,
    login_usuario,
    endereco_ip_auditoria
FROM infolab_soroteca_auditoria
WHERE login_usuario = 'joao.silva'
  AND data_hora_evento BETWEEN '2026-05-01' AND '2026-05-04'
ORDER BY data_hora_evento DESC;
```

### 25.2 Histórico completo de um registro

```sql
SELECT
    data_hora_evento,
    operacao,
    login_usuario,
    dados_antes,
    dados_depois
FROM infolab_soroteca_auditoria
WHERE tabela = 'infolab_soroteca_caixa'
  AND registro_id = '4827'
ORDER BY data_hora_evento ASC;
```

### 25.3 Movimentações de uma amostra

```sql
SELECT
    m.data_hora_movimento,
    mt.codigo AS tipo,
    po.rotulo AS origem,
    pd.rotulo AS destino,
    m.motivo,
    m.hash_custodia
FROM infolab_soroteca_movimento m
JOIN infolab_movimento_tipo mt ON mt.id_movimento_tipo = m.id_movimento_tipo
LEFT JOIN infolab_soroteca_posicao po ON po.id_soroteca_posicao = m.id_posicao_origem
LEFT JOIN infolab_soroteca_posicao pd ON pd.id_soroteca_posicao = m.id_posicao_destino
WHERE m.id_atendimento_amostra = 12345
ORDER BY m.data_hora_movimento ASC;
```

---

## 26. Integrações com analisadores

### 26.1 Tipos de integração suportados

- **Serial** (RS-232) — equipamentos legados
- **TCP/IP** — analisadores modernos
- **HL7** — padrão hospitalar
- **ASTM** — padrão laboratorial

### 26.2 Configuração

```
Menu → Cadastros → Integrações
- Tipo de interface (Serial, TCP, HL7, ASTM)
- Tipo de integração
- Porta (serial: COM3; TCP: 192.168.1.50:5000)
- Configurações específicas
```

### 26.3 Diagnóstico

| Sintoma | Solução |
|---|---|
| Equipamento não recebe pedido | Verificar porta serial / cabo / driver |
| Resultado não chega | Logs do serviço de integração |
| Resultado chega errado | Verificar mapeamento exame×teste no equipamento |
| Conexão TCP recusada | Firewall, IP do equipamento, porta |

---

# Parte 7 — Escalonamento

## 27. Quando resolver no nível 1 vs. escalar

### 27.1 Resolva no N1

- Reset de senha
- Desbloqueio de usuário
- Limpeza de cache do navegador
- Treinamento "como faço X na tela"
- Permissão errada (atribuir ao perfil correto)
- Cadastro de tipo/motivo novo
- Diagnóstico básico (consultar logs, verificar status)

### 27.2 Escale para N2

- Erros 500 recorrentes
- Lentidão sistêmica
- Bug na lógica de negócio (regra está aplicando errado)
- Necessidade de query/script SQL personalizado
- Problema de integração com analisador
- Necessidade de criar tela nova

### 27.3 Escale para desenvolvimento

- Mudança no schema (nova tabela, nova coluna)
- Nova feature (não cadastro)
- Bug que exige correção de código
- Problema de performance que exige índice ou refator
- Mudança de comportamento sistêmico

---

## 28. Como escalar para o nível 2 ou desenvolvimento

### 28.1 Informações essenciais no chamado

```
TENANT: Lab Central SP (id_tenacidade = 12)
USUARIO: joao.silva
TELA: Cadastros > Soroteca > Caixa
URL: /soroteca-cadastro/soroteca-caixa/listagem
NAVEGADOR: Chrome 124

QUANDO COMEÇOU: 04/05/2026 14:30
SE DAÍ FUNCIONAVA ANTES: sim, ontem funcionava
ATINGE OUTROS USUÁRIOS: sim, mais 3 reportaram

PASSOS PARA REPRODUZIR:
1. Abrir tela
2. Clicar Novo
3. Preencher código "TESTE-001"
4. Salvar
5. Erro aparece

MENSAGEM DE ERRO:
"500 Internal Server Error - Catálogo incompleto..."

LOGS RELEVANTES:
[anexar trecho do log]

TENTATIVAS NO N1:
- Verificado catálogo: 5 tipos cadastrados
- Reset cache do usuário: sem efeito
- Login outro usuário: mesmo erro

URGÊNCIA: alta — bloqueia operação
```

### 28.2 Anexos úteis

- Captura de tela do erro
- Trecho do log do backend
- Output de queries SQL diagnósticas
- HAR (export do Network do DevTools)

---

## 29. Canais e contatos

Configurar conforme estrutura do laboratório:

```
Suporte interno (N1):
  Tel: ...
  E-mail: suporte@labcentral.com.br
  Horário: 8h-18h

Suporte do fornecedor (N2):
  Tel: ...
  E-mail: ...
  Plantão 24h: ...

Desenvolvimento (escalonamento crítico):
  GitHub Issues: github.com/infotime-web/issues
  E-mail: dev@infolab.com.br
```

---

# Parte 8 — Referências

## 30. Glossário técnico

| Termo | Definição |
|---|---|
| **BFF** | Backend for Frontend — camada do Next.js que faz proxy para API |
| **DTO** | Data Transfer Object — classe de validação de payload |
| **JWT** | JSON Web Token — formato de token de autenticação |
| **Migration** | Script versionado de alteração de schema |
| **Monorepo** | Repositório único com vários workspaces |
| **NestJS** | Framework Node.js modular para backend |
| **Next.js** | Framework React para frontend |
| **Nx** | Ferramenta de orquestração de monorepo |
| **ORM** | Object-Relational Mapper |
| **Prisma** | ORM TypeScript |
| **RLS** | Row-Level Security — isolamento por linha no PostgreSQL |
| **Slug** | Identificador kebab-case usado em URL |
| **Tenant** | Cliente isolado em sistema multi-tenant |
| **Tenacidade** | Termo do domínio Infotime para tenant |

---

## 31. Comandos úteis de PostgreSQL

```sql
-- Versão
SELECT version();

-- Setar tenant na sessão
SET LOCAL app.current_tenant_id = '12';

-- Listar policies RLS de uma tabela
SELECT * FROM pg_policies WHERE tablename = 'infolab_atendimento_amostra';

-- Ver índices de uma tabela
SELECT indexname, indexdef FROM pg_indexes WHERE tablename = 'infolab_soroteca_caixa';

-- Tamanho de tabela
SELECT pg_size_pretty(pg_total_relation_size('infolab_atendimento_amostra'));

-- Locks ativos
SELECT * FROM pg_locks l JOIN pg_stat_activity a ON l.pid = a.pid;

-- Vacuum manual
VACUUM ANALYZE infolab_atendimento_amostra;

-- Estatísticas de tabela
SELECT * FROM pg_stat_user_tables WHERE relname = 'infolab_atendimento_amostra';
```

---

## 32. Referência rápida de API REST

| Endpoint | Método | Função |
|---|---|---|
| `/api/auth/login` | POST | Login |
| `/api/auth/logout` | POST | Logout |
| `/api/auth/me` | GET | Dados do usuário logado |
| `/api/{recurso}` | GET | Listagem |
| `/api/{recurso}/:id` | GET | Detalhe |
| `/api/{recurso}` | POST | Criar |
| `/api/{recurso}/:id` | PUT | Atualizar |
| `/api/{recurso}/:id` | DELETE | Excluir |
| `/api/layout/:tela/formulario-cadastro` | GET | Layout customizado |
| `/api/soroteca/caixas/:id/mapa` | GET | Mapa visual |
| `/api/soroteca/caixas/:id/armazenar-amostra` | POST | Armazenar |
| `/api/soroteca/caixas/:id/remover-amostra` | POST | Retirar |

Padrão de query strings para listagens:

```
?cargaInicial=true
&q=termo&campoPesquisa=nome
&pagina=0&tamanhoPagina=20
&filtroRefinado=<json>
```

---

## 33. Checklist de diagnóstico

Imprima e use ao receber um chamado:

```
[ ] Identificou o tenant
[ ] Identificou o usuário
[ ] Identificou a tela exata (caminho + URL)
[ ] Capturou mensagem de erro completa
[ ] Identificou navegador e versão
[ ] Verificou se afeta um ou múltiplos usuários
[ ] Verificou se aconteceu antes (regressão?)
[ ] Tentou Ctrl+F5 / hard reload
[ ] Tentou login em janela anônima
[ ] Conferiu DevTools → Console
[ ] Conferiu DevTools → Network
[ ] Conferiu logs do backend
[ ] Conferiu logs do PostgreSQL
[ ] Validou status do health check
[ ] Documentou tudo no chamado
[ ] Resolveu OU escalou com informações completas
```

---

## Histórico

| Versão | Data | Resumo |
|---|---|---|
| 1.0 | Maio/2026 | Versão inicial. Cobre arquitetura, multi-tenant, troubleshooting, escalonamento. |

---

> **Próxima revisão:** atualizar a cada mudança arquitetural significativa, ou trimestralmente para incorporar lições aprendidas dos chamados.

*Em divergência entre este manual e o sistema, prevalece o sistema. Reporte ao time de desenvolvimento qualquer divergência percebida.*
