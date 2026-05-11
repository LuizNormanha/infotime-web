# Auditoria de qualidade — maio/2026

Relatório gerado pela execução do plano de auditoria (duplicação, erros, performance, refatoração segura). Comandos executados na máquina de CI/dev local; resultados podem variar após `npm install` ou mudanças de branch.

## 1. Baseline de ferramentas

| Pacote | Comando | Resultado |
|--------|---------|-----------|
| `api` | `npm run lint` | **Falha** — após `npm run lint:fix` na API restam erros de regras sem auto-fix (`@typescript-eslint/no-base-to-string`, `no-unsafe-*`, `require-await` em alguns testes, etc.); Prettier já normalizado onde aplicável. |
| `api` | `npm run typecheck` | **OK** (`tsc --noEmit`). |
| `api` | `npm test` (Jest) | **OK** — 7 suites, 36 testes. |
| `web` | `npm run lint` | **OK** (0 erros). Ajustes: sincronização de refs com `useLayoutEffect`, `useCallback` em `aplicarQuickSearch`, ref estável em `LigaListagemBarraFiltrosAtivos`, ordem de estado em `LigaHomeNavegacao`, deps do React Compiler em `confirmarSubstituirSessaoReautenticacao`. |
| `web` | `npm test` (Vitest) | **OK** após correção do teste da allowlist (59 testes). |
| `web` | `next build` / `nx run web:build` | **Falha no ambiente auditado** — `Cannot find module '.../web/node_modules/next/dist/bin/next'` (dependências do workspace não resolvidas em `web/node_modules`). Rodar `npm install` na raiz do monorepo e repetir o build. |

## 2. Varredura estática (erros silenciosos e padrões)

### `.catch(() => {})` (promessa engolida)

| Arquivo | Contexto |
|---------|-----------|
| [`web/src/components/fornecedor/LigaFornecedorInfotimeFormulario.tsx`](../web/src/components/fornecedor/LigaFornecedorInfotimeFormulario.tsx) | Fluxo ViaCEP — em **desenvolvimento**, `console.warn` se a promessa rejeitar; produção mantém o mesmo comportamento silencioso de antes. |
| [`web/src/components/cliente/LigaClienteInfotimeFormulario.tsx`](../web/src/components/cliente/LigaClienteInfotimeFormulario.tsx) | Idem. |

**Nota:** o fallback de UX (endereço manual) não mudou; só há diagnóstico explícito em dev.

### `eslint-disable` para `react-hooks/exhaustive-deps`

- [`web/src/hooks/usePermissaoPerfilTelaAtiva.ts`](../web/src/hooks/usePermissaoPerfilTelaAtiva.ts)
- [`web/src/components/formulario-pesquisa/LigaListagemBase.tsx`](../web/src/components/formulario-pesquisa/LigaListagemBase.tsx)
- [`web/src/components/formulario-base/LigaFormularioBase.tsx`](../web/src/components/formulario-base/LigaFormularioBase.tsx)

Revisar se o comentário ainda reflete o motivo (refs instáveis / evitar loop); risco de re-fetch duplo ou closure velha.

### BullMQ — contrato `process`

**Correção aplicada:** [`api/src/filas/processors/financeiro-fila.processor.ts`](../api/src/filas/processors/financeiro-fila.processor.ts) passou a usar `async process` + `await this.executar(...)`, com `executar` assíncrono, para que jobs futuros com I/O não sejam marcados como concluídos antes do tempo.

## 3. Duplicação e DRY (mapa)

| Item | Observação | Risco de extrair helper |
|------|--------------|-------------------------|
| Política de senha | Espelho intencional [`api/src/comum/senha-usuario-politica.ts`](../api/src/comum/senha-usuario-politica.ts) ↔ [`web/src/lib/senha-usuario-politica.ts`](../web/src/lib/senha-usuario-politica.ts). | Manter sincronizado manualmente ou gerar a partir de uma fonte única no futuro. |
| Salvar contas pagar / receber | Blocos `fetch` + tratamento HTTP muito parecidos nos dois formulários. | Médio — exigir testes manuais/automáticos dos dois fluxos antes de `executarSalvarCrudBff`. |
| BFF `res.json().catch(...)` | Várias ocorrências em `web/src/app/api/**` (catch-all, layout, auth). | Baixo — utilitário compartilhado `lerJsonRespostaSegura` se assinaturas forem unificadas. |

## 4. Erros visíveis / UX

**Correção aplicada:** em [`LigaContasPagarInfotimeFormulario.tsx`](../web/src/components/contas-pagar/LigaContasPagarInfotimeFormulario.tsx) e [`LigaContasReceberInfotimeFormulario.tsx`](../web/src/components/contas-receber/LigaContasReceberInfotimeFormulario.tsx), erros de validação traduzidos (`traduzirErrosValidacaoParaFormulario`) deixam de ser descartados com `void errosApi`. Agora:

- o toast usa `erroDetalhado` com o texto agregado dos campos;
- `mensagemErroGlobal` do `LigaFormularioBase` exibe o mesmo resumo no topo do formulário.

**Melhoria futura (opcional):** mapear chaves da API para cada campo PrimeReact e marcar `invalid` por campo (exige estender `liga-contas-*-formulario-secoes`).

## 5. Performance (revisão orientada a código)

- **[`api/src/financeiro/financeiro.service.ts`](../api/src/financeiro/financeiro.service.ts):** KPIs usam `Promise.all` entre `aggregate` e `count` por filtro — padrão saudável. Métodos que montam listas com `include` devem ser revisados caso a lista cresça (paginação, `select` mínimo). Qualquer otimização de índice exige aprovação explícita de schema/migration.
- **Web:** `reactCompiler: true` em [`web/next.config.mjs`](../web/next.config.mjs); listagens pesadas (`LigaListagemBase`) são candidatas a medição Lighthouse após build estável.
- **Filas:** idempotência e testes em [`api/src/filas/job-idempotencia.ts`](../api/src/filas/job-idempotencia.ts) e spec associada.

## 6. Ordem sugerida de PRs (refatoração segura)

1. **Infra / baseline:** `npm run lint:fix` só em `api` (Prettier) em PR dedicado, após revisão visual do diff.
2. **Web ESLint React Compiler / refs:** corrigir atualização de ref durante render (`useLayoutEffect` ou padrão recomendado pela equipe) — um arquivo ou família de arquivos por PR.
3. **BFF:** extrair helper de leitura JSON defensiva + testes unitários.
4. **CRUD contas:** extrair helper de salvar após checklist manual e, se possível, teste de integração leve.
5. **Geocode CEP:** substituir `.catch(() => {})` por tratamento explícito (UX + log opcional).

## 7. Alterações de código feitas nesta auditoria

- Tratamento de erro de API nos formulários de contas a pagar e a receber (toast + alerta global).
- Contrato assíncrono do `FinanceiroFilaProcessor` (BullMQ): `process` continua `async` e aguarda `executar`; `executar` permanece **síncrono** até existir I/O real (evita `require-await` vazio).
- Ajuste do teste [`web/src/app/api/[...path]/catchall.test.ts`](../web/src/app/api/[...path]/catchall.test.ts) para refletir os 9 recursos atuais de `RECURSOS_PERMITIDOS`.
- **Web — lint `react-hooks/*`:** refs atualizadas em `useLayoutEffect` (`LigaPainelAjudaLigia`, `LigaFormularioBase`, `LigaListagemBase`, `LigaHomeNavegacao`, `useCadastroFormulario`, `useListagemCrudServidor`); `recalcular` com ref em `LigaListagemBarraFiltrosAtivos`; `aplicarQuickSearch` com `useCallback`.
- **ViaCEP:** `console.warn` apenas em `NODE_ENV === "development"` (fornecedor/cliente).
- **API:** `npm run lint:fix` (formatação); remoção de import `Prisma` não usado em `prisma.service.ts`.
