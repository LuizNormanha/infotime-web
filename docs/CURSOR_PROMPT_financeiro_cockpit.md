# Prompt Cursor — Financeiro: menu lateral + Cockpit de Gestão Integrada

## Contexto do projeto

Stack: React + TypeScript + PrimeReact + React Hook Form + Zod + TanStack Query (frontend) / NestJS 11 + Fastify + Prisma + PostgreSQL (backend). Monorepo pnpm. Banco `liga_infotime`, schema `public`.

Todos os padrões obrigatórios estão em `/mnt/project/`:
- `PADRAO_ARQUITETURA_INFOTIME_WEB.md` — estrutura de pastas e stack
- `PADRAO_LISTAS.md` — DataTable server-side, contratos `ListQuery` / `ListResponse<T>`
- `PADRAO_FORMULARIOS.md` — `FormShell`, `FormFooter`, `ActionsBar`, campos compartilhados
- `PADRAO_TANSTACK_QUERY.md` — convenções de chave, `useQuery`, `useMutation`
- `PADRAO_API_CRUD.md` — routes → controller → service → repository, Zod nas rotas
- `PADRAO_TENANCY_AUDITORIA.md` — `id_tenacidade` sempre do JWT, nunca do body
- `PADRAO_AUTH_RBAC.md` — hook `usePermission(acao, recurso)`
- `PADRAO_VALIDACOES_ZOD.md` — schemas de entrada/saída

**Leia esses arquivos antes de escrever qualquer código.**

---

## Tarefa

Implementar dois entregáveis:

1. **Reorganização do menu lateral** do módulo Financeiro — incluir o novo item "Gestão integrada" como primeira opção, seguido de "Contas a pagar" e "Contas a receber".
2. **Cockpit de Gestão Integrada** — tela de entrada do módulo financeiro com KPIs, gráfico de fluxo de caixa e mini-listas de ações urgentes.

---

## 1. Menu lateral — estrutura alvo

No componente de sidebar/menu (localizar o arquivo onde os itens do menu financeiro são declarados — provavelmente em `apps/web/src/app/` ou `apps/web/src/features/layout/`), ajustar a seção "Financeiro" para ficar exatamente assim:

```
Financeiro                          ← seção colapsável, ícone: ti-coin
  ├─ Gestão integrada               ← NOVO — rota: /financeiro
  ├─ Contas a pagar                 ← rota: /financeiro/pagar
  └─ Contas a receber               ← rota: /financeiro/receber
```

Regras:
- "Gestão integrada" usa ícone `ti-layout-dashboard` e é o **item ativo padrão** ao expandir a seção.
- "Contas a pagar" usa ícone `ti-arrow-down-circle`.
- "Contas a receber" usa ícone `ti-arrow-up-circle`.
- A rota `/financeiro` redireciona para o cockpit — não para lista nem formulário.
- Manter o estilo visual exato dos outros itens do menu já existentes (padding, hover, active state, cor do ícone).

---

## 2. Rotas

Adicionar/confirmar as seguintes rotas no router principal:

```
/financeiro                          → <FinanceiroGestaoIntegrada />   (NOVA TELA)
/financeiro/pagar                    → <ContasPagarList />              (já existe ou será criada)
/financeiro/pagar/novo               → <ContasPagarForm />
/financeiro/pagar/:id                → <ContasPagarForm />
/financeiro/receber                  → <ContasReceberList />            (já existe ou será criada)
/financeiro/receber/novo             → <ContasReceberForm />
/financeiro/receber/:id              → <ContasReceberForm />
```

---

## 3. Backend — endpoint do cockpit

Criar em `apps/api-nest/src/modules/financeiro/`:

### 3.1 Arquivo: `financeiro.module.ts`
Módulo NestJS que declara controller, service e importa PrismaModule.

### 3.2 Arquivo: `financeiro.controller.ts`

```
GET /api/financeiro/cockpit
```

Autenticado (JWT guard). Retorna os dados agregados descritos na seção 3.3.

### 3.3 Arquivo: `financeiro.service.ts`

Método `getCockpitData(tenantId: number)` que executa as seguintes queries em paralelo com `Promise.all`:

```typescript
// Todas as queries filtram por IdTenacidade = tenantId

// (a) A receber hoje
lancamentoreceita WHERE DataPrevisao::date = CURRENT_DATE
  AND IdSituacaoDocumento != 4   -- excluir já recebidos
COUNT(*) as qtd, SUM(ValorPrevisao) as total

// (b) Receber em atraso
lancamentoreceita WHERE DataPrevisao < CURRENT_DATE
  AND IdSituacaoDocumento NOT IN (4)  -- não recebidos
COUNT(*) as qtd, SUM(ValorPrevisao) as total

// (c) A pagar hoje
lancamentodespesa WHERE DataPrevisao::date = CURRENT_DATE
  AND IdSituacaoDocumento != 4  -- excluir já pagos
COUNT(*) as qtd, SUM(ValorPrevisao) as total

// (d) Pagar em atraso
lancamentodespesa WHERE DataPrevisao < CURRENT_DATE
  AND IdSituacaoDocumento NOT IN (4)  -- não pagos
COUNT(*) as qtd, SUM(ValorPrevisao) as total

// (e) Fluxo previsto — próximos 14 dias (entradas e saídas por dia)
-- lancamentoreceita e lancamentodespesa agrupados por DataPrevisao::date
-- retornar array de { data: string, entradas: number, saidas: number }

// (f) Distribuição por situação (contagens globais do mês corrente)
-- pendentes receber, pendentes pagar, pagos/recebidos este mês, total em atraso

// (g) Mini-lista: receber hoje (top 5, ordenado por ValorPrevisao DESC)
-- IdLancamentoReceita, NomeAgente, ValorPrevisao, DataPrevisao, IdSituacaoDocumento

// (h) Mini-lista: receber em atraso (top 5, ordenado por DataPrevisao ASC — mais antigos primeiro)
-- IdLancamentoReceita, NomeAgente, ValorPrevisao, DataPrevisao, diasAtraso

// (i) Mini-lista: pagar hoje (top 5, ordenado por ValorPrevisao DESC)
-- IdLancamentoDespesa, NomeAgente, ValorPrevisao, DataPrevisao, IdSituacaoDocumento

// (j) Mini-lista: pagar em atraso (top 5, ordenado por DataPrevisao ASC)
-- IdLancamentoDespesa, NomeAgente, ValorPrevisao, DataPrevisao, diasAtraso
```

### 3.4 DTO de retorno: `cockpit-response.dto.ts`

```typescript
export interface CockpitKpi {
  total: number;   // valor monetário somado (em centavos ou float — manter consistente com o resto do projeto)
  qtd: number;     // quantidade de lançamentos
}

export interface CockpitFluxoDia {
  data: string;      // 'YYYY-MM-DD'
  entradas: number;
  saidas: number;
}

export interface CockpitMiniItem {
  id: number;
  nomeAgente: string;
  valorPrevisao: number;
  dataPrevisao: string;
  diasAtraso?: number;   // presente apenas nas listas de atraso
}

export interface CockpitDistribuicao {
  pendenteReceber: number;
  pendentePagar: number;
  pagosRecebidosMes: number;
  totalEmAtraso: number;
}

export interface CockpitResponse {
  receberHoje: CockpitKpi;
  receberAtraso: CockpitKpi;
  pagarHoje: CockpitKpi;
  pagarAtraso: CockpitKpi;
  saldoPrevisto30d: number;      // receberHoje.total + valor próx.30d receber - pagar próx.30d pagar
  fluxo14dias: CockpitFluxoDia[];
  distribuicao: CockpitDistribuicao;
  miniReceberHoje: CockpitMiniItem[];
  miniReceberAtraso: CockpitMiniItem[];
  miniPagarHoje: CockpitMiniItem[];
  miniPagarAtraso: CockpitMiniItem[];
}
```

Calcular `saldoPrevisto30d` como:
```
SUM(lancamentoreceita.ValorPrevisao WHERE DataPrevisao BETWEEN hoje e hoje+30 AND não recebido)
- SUM(lancamentodespesa.ValorPrevisao WHERE DataPrevisao BETWEEN hoje e hoje+30 AND não pago)
```

### 3.5 Arquivo: `financeiro.schema.ts`

Sem parâmetros de entrada (tenant vem do JWT). Apenas validar que o usuário está autenticado.

---

## 4. Frontend — feature `financeiro-cockpit`

### Estrutura de arquivos

```
apps/web/src/features/financeiro-cockpit/
  api/
    useCockpit.ts           ← TanStack Query hook
  components/
    CockpitKpiCard.tsx      ← card de KPI reutilizável
    CockpitFluxoChart.tsx   ← gráfico de barras 14 dias
    CockpitDistribuicao.tsx ← mini cards de distribuição por situação
    CockpitMiniLista.tsx    ← mini-lista reutilizável (receber/pagar hoje/atraso)
  pages/
    FinanceiroGestaoIntegrada.tsx   ← página principal (compõe tudo)
  types.ts                 ← CockpitResponse e derivados
```

### 4.1 `useCockpit.ts`

```typescript
import { useQuery } from '@tanstack/react-query'
import { httpClient } from '@/shared/api/httpClient'
import type { CockpitResponse } from '../types'

export function useCockpit() {
  return useQuery({
    queryKey: ['financeiro', 'cockpit'],
    queryFn: () => httpClient.get<CockpitResponse>('/financeiro/cockpit'),
    staleTime: 60_000,   // 1 minuto — dados financeiros mudam com frequência
  })
}
```

### 4.2 `CockpitKpiCard.tsx`

Props: `label: string`, `valor: number`, `qtd: number`, `variante: 'success' | 'danger' | 'warning' | 'info'`, `onClick?: () => void`

- Renderizar com card de superfície (fundo `--color-background-primary`, borda `0.5px solid --color-border-tertiary`, `border-radius: 12px`).
- Valor monetário formatado com `Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' })`.
- Cor do valor e ícone conforme `variante` (usar as CSS vars semânticas do projeto: `--color-text-success`, `--color-text-danger`, `--color-text-warning`, `--color-text-info`).
- Ícone à esquerda do label: `success` → `ti-arrow-up-circle`, `danger` → `ti-alert-circle`, `warning` → `ti-clock`, `info` → `ti-trending-up`.
- Subtexto: `{qtd} lançamento(s)`.
- Ao clicar, chamar `onClick` (que navegará para a lista filtrada).
- Estado de loading: skeleton de altura fixa (não usar Suspense aqui, tratar no pai).

### 4.3 `CockpitFluxoChart.tsx`

Props: `dados: CockpitFluxoDia[]`

Usar **Recharts** `<BarChart>` com duas séries empilhadas ou lado a lado:
- Série "Entradas" — cor `#22c55e` (success) ou o equivalente do design system.
- Série "Saídas" — cor `#ef4444` (danger).
- Eixo X: dia no formato `DD/MM`.
- Eixo Y: valores em R$ com notação abreviada (`10k`, `50k`).
- Tooltip formatado em pt-BR com `Intl.NumberFormat`.
- Sem legendas verbosas — apenas as duas barras com tooltip.
- Altura fixa: `180px`.
- Responsivo via `<ResponsiveContainer width="100%" height={180}>`.

### 4.4 `CockpitMiniLista.tsx`

Props:
```typescript
interface CockpitMiniListaProps {
  titulo: string
  itens: CockpitMiniItem[]
  variante: 'receber' | 'pagar'
  tipo: 'hoje' | 'atraso'
  totalQtd: number         // total real (não só os 5 exibidos)
  onVerTodos: () => void   // navega para lista filtrada
  onItemClick: (id: number) => void  // abre formulário
  loading?: boolean
}
```

Layout:
- Card com `border-radius: 12px`, borda `0.5px`.
- Header: título à esquerda (13px, `font-weight: 500`, `--color-text-secondary`) + botão "Ver todos →" à direita (pequeno, `btn-sm` do padrão do projeto).
- Lista de até 5 itens. Cada linha:
  - Nome do agente (`font-weight: 500`, truncado com `text-overflow: ellipsis`) + subtexto de data ou dias de atraso.
  - Valor à direita formatado em BRL + badge de status.
  - Hover: fundo `--color-background-secondary`, `border-radius: 6px`.
  - Cursor `pointer` — clicar chama `onItemClick(id)`.
- Rodapé (se `totalQtd > 5`): "+ {totalQtd - 5} lançamentos" em cinza, centralizado.
- Estado de loading: 3 skeleton rows de altura 44px.
- Estado vazio: ícone `ti-circle-check` com texto "Nenhum lançamento {tipo}" em cor success/info.

Badges de status:
- `hoje` + `receber` → badge verde "Hoje"
- `hoje` + `pagar` → badge amarelo "Hoje"
- `atraso` → badge vermelho "{n} dia(s)"

### 4.5 `CockpitDistribuicao.tsx`

Props: `dados: CockpitDistribuicao`

Grid 2×2 de mini cards:
- "Pendentes a receber" (warning)
- "Pendentes a pagar" (warning)
- "Pagos/Recebidos (mês)" (success)
- "Em atraso (total)" (danger)

Cada mini card: fundo `--color-background-secondary`, número em destaque (`font-size: 20px`, `font-weight: 500`), label em 12px abaixo.

### 4.6 `FinanceiroGestaoIntegrada.tsx` — página principal

```tsx
// Estrutura da página

<div> {/* container da página */}

  {/* Header */}
  <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 20 }}>
    <div>
      <h1>Gestão integrada</h1>
      <p>Visão geral financeira · {mesAnoAtual}</p>
    </div>
    <div style={{ display: 'flex', gap: 8 }}>
      {/* seletor de período: Este mês / Últimos 30 dias / Este trimestre */}
      <Select ... />
      {/* botões de ação rápida com controle de permissão */}
      {can('criar', 'contas-receber') && (
        <Button label="+ Nova receita" onClick={() => navigate('/financeiro/receber/novo')} />
      )}
      {can('criar', 'contas-pagar') && (
        <Button label="+ Nova despesa" onClick={() => navigate('/financeiro/pagar/novo')} />
      )}
    </div>
  </div>

  {/* KPI cards — 5 colunas responsivas */}
  <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(150px, 1fr))', gap: 10, marginBottom: 16 }}>
    <CockpitKpiCard
      label="A receber hoje"
      valor={data.receberHoje.total}
      qtd={data.receberHoje.qtd}
      variante="success"
      onClick={() => navigate('/financeiro/receber?venceHoje=true')}
    />
    <CockpitKpiCard
      label="Receber em atraso"
      valor={data.receberAtraso.total}
      qtd={data.receberAtraso.qtd}
      variante="danger"
      onClick={() => navigate('/financeiro/receber?atrasado=true')}
    />
    <CockpitKpiCard
      label="A pagar hoje"
      valor={data.pagarHoje.total}
      qtd={data.pagarHoje.qtd}
      variante="warning"
      onClick={() => navigate('/financeiro/pagar?venceHoje=true')}
    />
    <CockpitKpiCard
      label="Pagar em atraso"
      valor={data.pagarAtraso.total}
      qtd={data.pagarAtraso.qtd}
      variante="danger"
      onClick={() => navigate('/financeiro/pagar?atrasado=true')}
    />
    <CockpitKpiCard
      label="Saldo previsto 30d"
      valor={data.saldoPrevisto30d}
      qtd={0}
      variante="info"
    />
  </div>

  {/* Gráfico + Distribuição lado a lado */}
  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 12, marginBottom: 14 }}>
    <Card title="Fluxo previsto — próximos 14 dias">
      <CockpitFluxoChart dados={data.fluxo14dias} />
    </Card>
    <Card title="Distribuição por situação">
      <CockpitDistribuicao dados={data.distribuicao} />
    </Card>
  </div>

  {/* Mini-listas urgentes — grade 2×2 */}
  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 12 }}>
    <CockpitMiniLista
      titulo="Receber — vence hoje"
      itens={data.miniReceberHoje}
      variante="receber"
      tipo="hoje"
      totalQtd={data.receberHoje.qtd}
      onVerTodos={() => navigate('/financeiro/receber?venceHoje=true')}
      onItemClick={(id) => navigate(`/financeiro/receber/${id}`)}
    />
    <CockpitMiniLista
      titulo="Receber — em atraso"
      itens={data.miniReceberAtraso}
      variante="receber"
      tipo="atraso"
      totalQtd={data.receberAtraso.qtd}
      onVerTodos={() => navigate('/financeiro/receber?atrasado=true')}
      onItemClick={(id) => navigate(`/financeiro/receber/${id}`)}
    />
    <CockpitMiniLista
      titulo="Pagar — vence hoje"
      itens={data.miniPagarHoje}
      variante="pagar"
      tipo="hoje"
      totalQtd={data.pagarHoje.qtd}
      onVerTodos={() => navigate('/financeiro/pagar?venceHoje=true')}
      onItemClick={(id) => navigate(`/financeiro/pagar/${id}`)}
    />
    <CockpitMiniLista
      titulo="Pagar — em atraso"
      itens={data.miniPagarAtraso}
      variante="pagar"
      tipo="atraso"
      totalQtd={data.pagarAtraso.qtd}
      onVerTodos={() => navigate('/financeiro/pagar?atrasado=true')}
      onItemClick={(id) => navigate(`/financeiro/pagar/${id}`)}
    />
  </div>

</div>
```

**Tratamento de estados obrigatórios:**
- `isLoading` → exibir skeletons nos KPI cards e nas mini-listas (não bloquear a tela inteira).
- `isError` → exibir mensagem de erro com botão de retry (usar componente de erro compartilhado se existir).
- `data` vazio → cada mini-lista mostra estado vazio individualmente.

---

## 5. Drilldown — filtros pré-aplicados nas listas

Quando as listas de Contas a Receber e Contas a Pagar receberem os seguintes query params via URL, devem pré-aplicar os filtros correspondentes **automaticamente** na inicialização do componente:

| Query param URL | Filtro aplicado na DataTable |
|---|---|
| `?venceHoje=true` | `dataprevisao` = data atual (range de 00:00 a 23:59) |
| `?atrasado=true` | `dataprevisao` < hoje + `situacao` pendente (excluindo pagos/recebidos) |

Implementar via `useSearchParams()` no hook de filtros da lista — ler os params na inicialização e popular o estado de filtros antes da primeira query.

---

## 6. Checklist de implementação (em ordem)

### Backend
- [ ] Criar `apps/api-nest/src/modules/financeiro/financeiro.module.ts`
- [ ] Criar `apps/api-nest/src/modules/financeiro/financeiro.controller.ts` com `GET /api/financeiro/cockpit`
- [ ] Criar `apps/api-nest/src/modules/financeiro/financeiro.service.ts` com `getCockpitData(tenantId)`
- [ ] Criar `apps/api-nest/src/modules/financeiro/dto/cockpit-response.dto.ts`
- [ ] Registrar `FinanceiroModule` no `AppModule`
- [ ] Testar endpoint com Insomnia/curl — validar que tenant vem do JWT e não do body
- [ ] Confirmar que todas as queries têm `WHERE IdTenacidade = :tenantId`

### Frontend
- [ ] Ajustar menu lateral — adicionar "Gestão integrada" como primeiro item do grupo Financeiro
- [ ] Adicionar rota `/financeiro` → `<FinanceiroGestaoIntegrada />`
- [ ] Criar `apps/web/src/features/financeiro-cockpit/types.ts`
- [ ] Criar `useCockpit.ts`
- [ ] Criar `CockpitKpiCard.tsx` com estados loading e variantes
- [ ] Criar `CockpitFluxoChart.tsx` com Recharts
- [ ] Criar `CockpitDistribuicao.tsx`
- [ ] Criar `CockpitMiniLista.tsx` com estados loading, vazio e itens
- [ ] Criar `FinanceiroGestaoIntegrada.tsx` compondo tudo
- [ ] Implementar drilldown de filtros pré-aplicados nas listas (`?venceHoje=true`, `?atrasado=true`)
- [ ] Verificar responsividade: grid de KPIs colapsa para 2 colunas em tela menor

---

## 7. O que NÃO fazer

- Não inventar campos que não existam nas tabelas `lancamentoreceita` e `lancamentodespesa` — ver análises em `/mnt/user-data/outputs/CONTASRECEBER_LST_FRM_analise.md` e `CONTASPAGAR_LST_FRM_analise.md`.
- Não aceitar `tenantId` do body ou query params — apenas do JWT.
- Não criar componentes visuais fora dos já existentes em `shared/components/` sem verificar se já existe um equivalente.
- Não fixar botões de ação fora do padrão `ActionsBar` / `FormFooter` quando for formulário.
- Não fazer query de cockpit sem `staleTime` — é dado que pode ser cacheado por pelo menos 1 minuto.
- Não usar `position: fixed` em nenhum elemento do cockpit.
- Não duplicar o enum de situações de documento — consultar a tabela `situacaodocumento` para os IDs corretos de "Pago" e "Pendente" usados nas queries de filtro.
