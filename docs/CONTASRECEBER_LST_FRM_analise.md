# Análise: LancamentoReceita_Lst e LancamentoReceita_Frm — Contas a Receber
## Migração Scriptcase → Infotime Web

> Fonte: `LIGA_InfoTIME_apps.zip` — pastas `LancamentoReceita_Lst/` e `LancamentoReceita_Frm/`  
> Analisado em: 08/05/2026  
> Stack alvo: React · PrimeReact · Node.js · Prisma · PostgreSQL  
> Padrões aplicados: `PADRAO_LISTAS.md` · `PADRAO_FORMULARIOS.md` · `PADRAO_MIGRACAO_INFOTIME.md`

---

## 1. Visão Geral

| App Scriptcase | Equivalente novo | Tabela principal |
|---|---|---|
| `LancamentoReceita_Lst` | `ContasReceberList` | `lancamentoreceita` |
| `LancamentoReceita_Frm` | `ContasReceberForm` | `lancamentoreceita` |

**Multi-tenant:** filtro `WHERE IdTenacidade = :tenantId` em todas as queries, injetado pelo middleware de tenant — nunca exposto ao frontend.

**Nomenclatura:** a tabela se chama `lancamentoreceita`. No infotime-web, adotar `ContasReceber` como nome de domínio para componentes e rotas, mantendo os nomes de campo do banco.

---

## 2. Menu Lateral — Posicionamento no Sidebar

O módulo financeiro ocupa uma seção dedicada no sidebar esquerdo. Dentro dela, Contas a Receber é item de primeiro nível:

```
Sidebar
└── Financeiro                          ← seção colapsável
    ├── Contas a Pagar                  ← LancamentoDespesa
    ├── Contas a Receber                ← LancamentoReceita  ← este módulo
    ├── Lançamentos Recorrentes (Desp.) ← LancamentoDespesa_Recorrente
    ├── Lançamentos Recorrentes (Rec.)  ← LancamentoReceita_Recorrente
    └── Fluxo de Caixa / Dashboard      ← DespesaMes / ReceitaDespesaMes
```

**Rota sugerida:** `/financeiro/contas-receber`  
**Rota de detalhe:** `/financeiro/contas-receber/:id`  
**Rota nova:** `/financeiro/contas-receber/novo`

---

## 3. LancamentoReceita_Lst — Listagem

### 3.1 SQL Principal

```sql
SELECT
  DataPrevisao,
  ValorPrevisao,
  DataRealizacao,
  ValorRealizacao,
  IdTipoEspecie,
  NomeAgente,
  Cnpj,
  Historico,
  ValorOriginal,
  IdSituacaoDocumento,
  DataCompetencia,
  DataBaixa,
  IdTipoAgente,
  IdContaCaixa,
  IdPlanoConta,
  IdEmpresa,
  IdNotaFiscal,
  NotaFiscal,
  NumeroDocumento,
  UnidadeOrigem,
  UsuarioExterno,
  IdLancamentoReceita,
  IdCliente,
  DataInclusao,
  IdLancamentoReceitaPai,
  Parcela,
  IdLancamentoReceitaRecorrente
FROM lancamentoreceita
WHERE IdTenacidade = :tenantId
```

> **Diferença em relação a Contas a Pagar:** a listagem de receitas inclui campos exclusivos como `ValorOriginal`, `IdNotaFiscal`, `NotaFiscal`, `UnidadeOrigem` e `UsuarioExterno` — campos ligados à integração com Nota Fiscal e ao sistema de cobranças automáticas.

### 3.2 Colunas da Grid

| # | Campo DB | Label | Ordenável |
|---|---|---|---|
| 1 | `DataPrevisao` | Previsto para | ✅ (padrão ASC) |
| 2 | `ValorPrevisao` | Valor Previsto | ✅ |
| 3 | `DataRealizacao` | Recebido em | ✅ |
| 4 | `ValorRealizacao` | Valor Recebido | ✅ |
| 5 | `ValorOriginal` | Valor Original | ✅ |
| 6 | `IdTipoEspecie` | Espécie | ✅ (lookup) |
| 7 | `NomeAgente` | Nome / Razão social | ✅ |
| 8 | `Cnpj` | CPF/CNPJ | ✅ |
| 9 | `Historico` | Histórico | ✅ |
| 10 | `IdSituacaoDocumento` | Situação | ✅ (lookup) |
| 11 | `DataCompetencia` | Competência | ✅ |
| 12 | `DataBaixa` | Baixado | ✅ |
| 13 | `IdTipoAgente` | Tipo | ✅ (lookup) |
| 14 | `IdContaCaixa` | Conta | ✅ (lookup) |
| 15 | `IdPlanoConta` | Plano contas | ✅ (lookup) |
| 16 | `IdEmpresa` | Empresa | ✅ (lookup) |
| 17 | `IdNotaFiscal` | Nota Fiscal (id) | ✅ |
| 18 | `NotaFiscal` | Nota Fiscal | ✅ |
| 19 | `NumeroDocumento` | Documento | ✅ |
| 20 | `UnidadeOrigem` | Unidade origem | ✅ |
| 21 | `IdLancamentoReceita` | Código | — |
| 22 | `DataInclusao` | Inclusão | — |
| 23 | `Parcela` | Parcela | — |

**Ordenação padrão:** `DataPrevisao ASC`

### 3.3 Botões de Ação Extra (Toolbar)

| Botão | Label | Condição de visibilidade | Ação |
|---|---|---|---|
| `Relatorio` | **Relatório** | Sempre visível | Navega para relatório de contas a receber por período |
| `BaixaAuto` | **Baixa automática em lote** | Somente quando `varBaixaAuto = 'S'` | Baixa em lote dos selecionados |
| `SC_btn_1` | **Autorizações** | Somente quando `varAcessoAutorizacoes = 'S'` | Navega para módulo de autorizações |

> **Diferença de Contas a Pagar:** Contas a Receber tem o botão `Relatorio` com label simples "Relatório", enquanto Contas a Pagar usa "Contas a pagar por período". Também há `SC_btn_1` (e não `SC_btn_0`) para Autorizações. Não há o botão `BaixaAutomatica` separado.

### 3.4 Campos de Filtro (Pesquisa Avançada)

| Campo | Label | Tipo | Operação no banco |
|---|---|---|---|
| `idempresa` | Empresa | select lookup | `IdEmpresa = :v` |
| `idtipoagente` | Tipo | select lookup | `IdTipoAgente = :v` |
| `nomeagente` | Nome / Razão social | texto | LIKE `%v%` em `NomeAgente` |
| `cnpj` | CPF/CNPJ | texto | LIKE `%v%` em `Cnpj` |
| `idplanoconta` | Plano contas | select lookup | `IdPlanoConta = :v` |
| `idcontacaixa` | Conta | select lookup | `IdContaCaixa = :v` |
| `datacompetencia` | Competência | date range | BETWEEN em `DataCompetencia` |
| `dataprevisao` | Previsto para | date range | BETWEEN em `DataPrevisao` |
| `datarealizacao` | Recebido em | date range | BETWEEN em `DataRealizacao` |
| `databaixa` | Baixado | date range | BETWEEN em `DataBaixa` |
| `idsituacaodocumento` | Situação | multi-select lookup | `IdSituacaoDocumento IN (...)` |
| `numerodocumento` | Documento | texto | LIKE em `NumeroDocumento` |
| `idnotafiscal` | Nota fiscal | número | `IdNotaFiscal = :v` |
| `idtipoespecie` | Espécie | select lookup | `IdTipoEspecie = :v` |
| `datainclusao` | Inclusão | date range | BETWEEN em `DataInclusao` |
| `historico` | Histórico | texto | LIKE em `Historico` |

> **16 filtros** — um a mais que Contas a Pagar (15), com a adição de `idnotafiscal`. Os filtros de data suportam range (BETWEEN). O filtro de situação suporta múltipla seleção.

### 3.5 Implementação — ContasReceberList

```typescript
// GET /contas-receber
// query params: page, pageSize, search, sortField, sortOrder, filters{}
// Middleware injeta tenantId do JWT

// Contrato de retorno (PADRAO_LISTAS.md)
{
  data: LancamentoReceita[],
  total: number,
  page: number,
  pageSize: number
}
```

**Componentes PrimeReact:**

```tsx
// ContasReceberList.tsx
<DataTablePage
  title="Contas a Receber"
  query={useContasReceberQuery}
  columns={contasReceberColumns}
  toolbar={
    <ListToolbar
      onNew={() => navigate('/financeiro/contas-receber/novo')}
      extraActions={[
        { label: 'Relatório', icon: 'pi pi-file', onClick: onRelatorio },
        { label: 'Baixa automática em lote', icon: 'pi pi-check-circle',
          visible: can('BAIXA_AUTO'), onClick: onBaixaLote },
        { label: 'Autorizações', icon: 'pi pi-lock',
          visible: can('AUTORIZACOES'), onClick: onAutorizacoes },
      ]}
    />
  }
  advancedFilters={<ContasReceberFilters />}
/>
```

---

## 4. LancamentoReceita_Frm — Formulário

### 4.1 Estrutura Geral (Abas)

O formulário segue o padrão `FormShell` com **cabeçalho fixo** + **5 abas** + seção de campos ocultos de sistema.

```
FormShell title="Contas a Receber" subtitle="Lançamento de receita"
┌──────────────────────────────────────────────────────────────────┐
│  CABEÇALHO (sempre visível)                                      │
│  Tipo* [Cliente | Fornecedor | Colaborador]   Código (readonly)  │
│  Cliente* / Fornecedor* / Colaborador*    (dinâmico por tipo)    │
└──────────────────────────────────────────────────────────────────┘
TabView
┌────────────────┬─────────────┬──────────────┬─────────┬──────────┐
│Características │Recebimento  │Observações   │Arquivos │Recorrência│
└────────────────┴─────────────┴──────────────┴─────────┴──────────┘
Footer
  FormFooter
    start: metadados (criado por, data inclusão)
    end: ActionsBar [Parcelar] [Recorrer] [Salvar] [Cancelar] [Excluir]
```

> **Comparação com Contas a Pagar (7 abas):** Contas a Receber é mais simples — **5 abas** (sem Auditoria separada, sem Parcelamento como aba, sem Rateio). A aba de Pagamento vira "Recebimento".

### 4.2 Bloco 0 — Cabeçalho (sempre visível)

| Campo | Label | Tipo | Obrig. | Componente |
|---|---|---|---|---|
| `idtipoagente` | Tipo | `SelectField` | ✅ | Lookup: `tipoagente` ORDER BY Descricao. Valores: 1=Cliente, 2=Fornecedor, 3=Colaborador |
| `idcliente` | Cliente | `AsyncSelectField` | ✅ se tipo=1 | Visível somente quando `idtipoagente = 1`. Lookup: `clienteempresa_view` filtrada por tenant |
| `idfornecedor` | Fornecedor | `AsyncSelectField` | ✅ se tipo=2 | Visível somente quando `idtipoagente = 2` |
| `idcolaborador` | Colaborador | `AsyncSelectField` | ✅ se tipo=3 | Visível somente quando `idtipoagente = 3` |
| `idlancamentoreceita` | Código | `TextField` readonly | — | PK autoincrement — readonly |

### 4.3 Aba 1 — Características

| Campo | Label | Tipo | Obrig. | Componente | Observação |
|---|---|---|---|---|---|
| `idempresa` | Empresa | `SelectField` | — | Lookup: `empresa` WHERE Ativo='S' — exibe `NomeFantasia - TipoEmpresa` | |
| `valororiginal` | Valor Original | `CurrencyField` | — | Valor bruto original (antes de acréscimos/descontos) | Campo exclusivo da receita |
| `valorprevisao` | Valor Previsto | `CurrencyField` | ✅ | Label dinâmico — quando integração Infolab ativa + cartão, exibe "Valor Previsto - Original: R$ X" | |
| `dataprevisao` | Previsto para | `DateField` | ✅ | Data de vencimento | |
| `idsituacaodocumento` | Situação | `SelectField` | ✅ | Lookup: `situacaodocumento` WHERE IdTenacidade ORDER BY Descricao. Default: `varIdSituacaoDocumentoPendenteInt` | |
| `datacompetencia` | Competência | `DateField` | — | Mês/ano de competência contábil | |
| `historico` | Histórico | `TextField` | — | Descrição livre | |
| `idplanoconta` | Plano de Contas | `SelectField` | ✅ | Filtrado por tipo de agente — plano de contas do tipo Receita (`Tipo='A' AND Origem='R'`) | Campo crítico |
| `idplanocontafornecedor` | Plano de Contas (Forn.) | `SelectField` | — | Via `fornecedorplanoconta JOIN planoconta` — visível somente quando tipo=2 | |
| `idplanocontacolaborador` | Plano de Contas (Colab.) | `SelectField` | — | Via `colaboradorplanoconta JOIN planoconta` — visível somente quando tipo=3 | |

### 4.4 Aba 2 — Recebimento

| Campo | Label | Tipo | Obrig. | Componente | Observação |
|---|---|---|---|---|---|
| `idcontacaixa` | Conta | `SelectField` | — | Lookup: `contacaixa` WHERE IdTenacidade | |
| `valorrealizacao` | **Valor Pago\*** | `CurrencyField` | ✅ quando situação=4 ou 24 | Label muda para "Valor Pago*" quando situação=4 ou 24 | |
| `datarealizacao` | **Pago em\*** | `DateField` | ✅ quando situação=4 ou 24 | Label muda para "Pago em*" quando situação=4 ou 24 | |
| `idusuariorealizacao` | Usuário Real. | `TextField` readonly | — | Preenchido automaticamente | |
| `idtipoespecie` | **Espécie\*** | `SelectField` | ✅ quando situação=4 ou 24 | Lookup: `tipoespecie` WHERE IdTenacidade. Label muda para "Especie*" quando situação=4/24 | |
| `numerodocumento` | Nº Documento | `TextField` | — | Visível quando `idtipoespecie ≠ 1` | |
| `valoracrescimo` | Acréscimo | `CurrencyField` | — | | |
| `valordesconto` | Desconto | `CurrencyField` | — | | |
| `valormulta` | Multa | `CurrencyField` | — | | |
| `valorjuros` | Juros | `CurrencyField` | — | | |
| `idnotafiscal` | Nota Fiscal | `AsyncSelectField` | — | Lookup: `notafiscal` por número. Campo exclusivo da receita — ligado à `BaixarNotaFiscal()` | Campo exclusivo da receita |
| `notafiscal` | Nº NF | `TextField` | — | Número da NF (texto exibição) | |
| `databaixa` | Baixado em | `DateField` | ✅ quando situação=4 ou 24 | | |
| `parcelamento` | Parcelamento | `TextField` readonly | — | Exibição `"X / Y"` — calculado automaticamente | |

### 4.5 Aba 3 — Observações

| Campo | Label | Tipo | Componente |
|---|---|---|---|
| `observacoes` | Observações | `TextareaField` | Campo livre de anotações |

> **Diferença de Contas a Pagar:** Contas a Receber tem uma aba dedicada de Observações. Contas a Pagar inseria `observacoes` no bloco de campos ocultos/sistema.

### 4.6 Aba 4 — Arquivos

Dois uploads genéricos (simplificado em relação à despesa que tem 4):

| Par de campos | Label | Componente |
|---|---|---|
| `nomereferencia1` / `nomearquivo1` | Arquivo 1 | `FileField` |
| `nomereferencia2` / `nomearquivo2` | Arquivo 2 | `FileField` |

> **Diferença de Contas a Pagar:** Receita tem apenas **2 uploads genéricos** (arquivo 1 e arquivo 2), sem os nomes específicos de "boleto", "NF", "comprovante" e "anexo" da despesa.

### 4.7 Aba 5 — Recorrência

| Campo | Componente | Condição de exibição |
|---|---|---|
| `recorrente` | Subgrid embed `LancamentoReceita_Recorrente_Ctr` | Visível somente quando `idlancamentoreceitarecorrente` está vazio |

**Botão `Recorrer`** na toolbar: aparece quando não há recorrência vinculada.

### 4.8 Campos Ocultos / Sistema (Bloco 6)

Estes campos existem no banco mas ficam ocultos no formulário, gerenciados pelo sistema:

| Campo | Gerenciado por |
|---|---|
| `contacontabil` | Sistema contábil |
| `idlancamentoreceitarecorrente` | FK para o registro pai da recorrência |
| `idusuarioprevisao` | JWT — usuário que criou a previsão |

---

## 5. Regras de Negócio

### RN-01 — Bloqueio por Fechamento Financeiro (onValidate)

**Disparo:** em todo save (insert e update), aplicado a **todos os tenants** (diferente de Contas a Pagar que era apenas tenant=1).

**Lógica em duas etapas:**

1. Se o registro já tem `fechamentofinanceiro = 'S'` → **bloqueia** a alteração:
   *"Receita não pode ser alterada. Já houve fechamento financeiro para esse período."*
2. Se não tem, verifica na tabela `fechamentofinanceiro` se `DataInicial ≤ dataprevisao ≤ DataFinal` para o tenant → **bloqueia** a inclusão:
   *"Receita não pode ser incluída. Já houve fechamento financeiro para esse período."*

```typescript
// NestJS service — todos os tenants
if (record?.fechamentofinanceiro === 'S') {
  throw new BusinessException('Receita não pode ser alterada. Já houve fechamento financeiro para esse período.');
}
const fechamento = await prisma.fechamentofinanceiro.findFirst({
  where: {
    IdTenacidade: tenantId,
    DataInicial: { lte: dto.dataprevisao },
    DataFinal:   { gte: dto.dataprevisao },
  },
});
if (fechamento) {
  throw new BusinessException('Receita não pode ser incluída. Já houve fechamento financeiro para esse período.');
}
```

### RN-02 — Plano de Contas dinâmico por tipo de agente (AcertarPlanoContas)

**Disparo:** onBeforeInsert e onBeforeUpdate.

| `idtipoagente` | Plano de Contas usado | Campos zerados |
|---|---|---|
| 1 — Cliente | `idplanoconta` (direto) | `idcolaborador`, `idfornecedor`, `idplanocontafornecedor`, `idplanocontacolaborador` = NULL |
| 2 — Fornecedor | `idplanocontafornecedor` (lookup via `fornecedorplanoconta`) | `idcolaborador`, `idcliente`, `idplanoconta`, `idplanocontacolaborador` = NULL |
| 3 — Colaborador | `idplanocontacolaborador` (lookup via `colaboradorplanoconta`) | `idfornecedor`, `idcliente`, `idplanocontafornecedor` = NULL |

> **Atenção:** os planos de conta de receita têm filtro adicional: `Tipo = 'A' AND Origem = 'R'` — somente planos do tipo Analítico e de origem Receita. Esta restrição não existe em Contas a Pagar.

### RN-03 — Validações quando situação = 4 (Pago) ou 24 (onValidateSuccess)

Quando `idsituacaodocumento = 4` **ou** `= 24`, os seguintes campos tornam-se obrigatórios:
- `valorrealizacao` — *"Valor pago: Campo obrigatório"*
- `datarealizacao` — *"Pago em: Campo obrigatório"*
- `idtipoespecie` — *"Espécie: Campo obrigatório"*
- `databaixa` — *"Baixado em: Campo obrigatório"*

> **Diferença de Contas a Pagar:** receita dispara as validações em **duas situações** (4 e 24), não apenas na 4. Situação 24 é "Pago parcialmente" ou similar no contexto Infolab.

```typescript
// Zod refinement
.superRefine((data, ctx) => {
  if (data.idsituacaodocumento === 4 || data.idsituacaodocumento === 24) {
    if (!data.valorrealizacao) ctx.addIssue({ path: ['valorrealizacao'], message: 'Valor pago: Campo obrigatório' });
    if (!data.datarealizacao)  ctx.addIssue({ path: ['datarealizacao'],  message: 'Pago em: Campo obrigatório' });
    if (!data.idtipoespecie)   ctx.addIssue({ path: ['idtipoespecie'],   message: 'Espécie: Campo obrigatório' });
    if (!data.databaixa)       ctx.addIssue({ path: ['databaixa'],       message: 'Baixado em: Campo obrigatório' });
  }
})
```

### RN-04 — Labels dinâmicos por situação (AcertarLabels)

Quando `idsituacaodocumento = 4` **ou** `= 24`, os labels mudam:
- `valorrealizacao` → **"Valor Pago\*"**
- `datarealizacao` → **"Pago em\*"**
- `idtipoespecie` → **"Especie\*"**

Nas demais situações: sem asterisco.

**Caso especial — integração Infolab:** quando `IntegracaoInfolabAtiva = 'S'` e a espécie for cartão de crédito ou débito, o label de `valorprevisao` muda para `"Valor Previsto - Original: R$ {valororiginal}"` para mostrar o valor original antes de taxas.

### RN-05 — Visibilidade de campos por tipo de agente (onChange + onLoad)

| `idtipoagente` | `idcliente` | `idfornecedor` | `idcolaborador` | `idplanoconta` | `idplanocontafornecedor` | `idplanocontacolaborador` |
|---|---|---|---|---|---|---|
| 1 (Cliente) | ✅ | ❌ | ❌ | ✅ | ❌ | ❌ |
| 2 (Fornecedor) | ❌ | ✅ | ❌ | ❌ | ✅ | ❌ |
| 3 (Colaborador) | ❌ | ❌ | ✅ | ✅ | ❌ | ✅ |
| Nenhum | ❌ | ❌ | ❌ | ✅ | ✅ | ✅ |

### RN-06 — Visibilidade de campo por espécie (onChange + onLoad)
- `idtipoespecie = 1` (Cheque): mostra `idcheque`, oculta `numerodocumento`
- `idtipoespecie ≠ 1`: oculta `idcheque`, mostra `numerodocumento`

> Nota: na receita, `idcheque` existe nos dados mas não foi encontrado no form0 — pode estar em campo oculto. Confirmar na implementação se é relevante para a receita ou somente para despesa.

### RN-07 — Recorrência condicional (onLoad)
- Botão `Recorrer` + Aba 5 (Recorrência): visível somente quando `idlancamentoreceitarecorrente` está **vazio**
- Quando vinculado à recorrência: botão some e aba some

### RN-08 — Parcelamento condicional (onLoad)
- Botão `Parcelar`: visível somente quando `idlancamentoreceitapai` está **vazio**
- Quando o registro é uma parcela (`idlancamentoreceitapai` preenchido): botão some e `parcelamento` exibe `"X / Y"`

### RN-09 — BaixarNotaFiscal (onAfterInsert + onAfterUpdate) — exclusivo da receita

Após salvar (insert ou update), o sistema atualiza a `notafiscal` vinculada conforme a situação:

| `idsituacaodocumento` | Ação na `notafiscal` |
|---|---|
| 4 (Pago) | `UPDATE notafiscal SET DataBaixa, IdUsuarioBaixa, ValorBaixa, DataRecebimento, IdSituacaoDocumento = 4` |
| 24 (Pago Parcial) | `UPDATE notafiscal SET DataBaixa, IdUsuarioBaixa, ValorBaixa, DataRecebimento, IdSituacaoDocumento = 24` |
| 25, 3, 238 | `UPDATE notafiscal SET IdSituacaoDocumento = :situacao` |

```typescript
// NestJS service — executar após salvar
async baixarNotaFiscal(dto: LancamentoReceita): Promise<void> {
  if (!dto.idnotafiscal) return;
  
  if (dto.idsituacaodocumento === 4 || dto.idsituacaodocumento === 24) {
    await prisma.notafiscal.update({
      where: { IdNotaFiscal: dto.idnotafiscal },
      data: {
        DataBaixa: dto.databaixa,
        IdUsuarioBaixa: dto.idusuariobaixa,
        ValorBaixa: dto.valorrealizacao,
        DataRecebimento: dto.datarealizacao,
        IdSituacaoDocumento: dto.idsituacaodocumento,
      },
    });
  } else if ([25, 3, 238].includes(dto.idsituacaodocumento)) {
    await prisma.notafiscal.update({
      where: { IdNotaFiscal: dto.idnotafiscal },
      data: { IdSituacaoDocumento: dto.idsituacaodocumento },
    });
  }
}
```

### RN-10 — onBeforeDelete — Cascata de recorrência

Quando o registro deletado é ele mesmo o **pai da recorrência** (`idlancamentoreceita = idlancamentoreceitarecorrente`):

1. **Deleta** todos os filhos da recorrência: `DELETE FROM lancamentoreceita WHERE IdLancamentoReceitaRecorrente = :id AND IdLancamentoReceita <> :id`
2. **Limpa** o vínculo do próprio registro: `UPDATE lancamentoreceita SET IdLancamentoReceitaRecorrente = NULL WHERE IdLancamentoReceita = :id`

```typescript
// NestJS service — executar antes de deletar
async onBeforeDelete(id: number): Promise<void> {
  const record = await prisma.lancamentoreceita.findUnique({ where: { IdLancamentoReceita: id } });
  if (record?.IdLancamentoReceitaRecorrente === id) {
    await prisma.lancamentoreceita.deleteMany({
      where: { IdLancamentoReceitaRecorrente: id, IdLancamentoReceita: { not: id } },
    });
    await prisma.lancamentoreceita.update({
      where: { IdLancamentoReceita: id },
      data: { IdLancamentoReceitaRecorrente: null },
    });
  }
}
```

> ⚠️ Esta regra **não existe** em Contas a Pagar — é exclusiva da receita.

### RN-11 — Nota Fiscal Obrigatória (configuração por tenant)

A variável de sessão `varNotaFiscalObrigatorio` é carregada da tabela `configuracao` por tenant:
```sql
SELECT NotaFiscalObrigatorio FROM configuracao
WHERE IdConfiguracao = (
  SELECT MIN(IdConfiguracao) FROM configuracao WHERE IdTenacidade = :t
)
AND IdTenacidade = :t
```

No `onValidateSuccess`, se `varNotaFiscalObrigatorio = 'S'` e `idsituacaodocumento = 4`, o campo `idnotafiscal` deveria ser obrigatório — porém o bloco de validação no código está **incompleto** (o `if` está vazio). Na implementação, decidir junto com o negócio se deve validar ou não.

### RN-12 — Defaults no novo registro (sc_evento = "novo")
- `idsituacaodocumento` ← `varIdSituacaoDocumentoPendenteInt` (situação Pendente do tenant)
- **Sem** pré-preenchimento de `idcontacaixa` (diferente de Contas a Pagar que preenchia com `varIdContaCaixaPadrao`)

### RN-13 — Clone de registro

Ao clonar, os seguintes campos são zerados:
`valorprevisao`, `dataprevisao`, `idsituacaodocumento` (→1), `valorrealizacao`, `idtipoespecie`, `dataagendamento`, `datarealizacao`, `numerodocumento`, `valoracrescimo`, `valordesconto`, `valormulta`, `valorjuros`, `databaixa`, `idusuariobaixa`, `datainclusao` (→ now), `idcontacaixaregistro`, `idusuarioinclusao` (→ usuário logado), todos os arquivos.

### RN-14 — Upload de arquivos com hash

Mesma lógica de Contas a Pagar, mas com apenas 2 arquivos:
```
nomearquivo1 = nome amigável (exibição)
nomereferencia1 = md5(datetime + nome + idTenacidade) + ".ext" (nome real no storage)
```

---

## 6. Lookups Completos

| Campo | Tabela/View | Filtro | Exibição |
|---|---|---|---|
| `idtipoagente` | `tipoagente` | — | `Descricao` ORDER BY Descricao |
| `idcliente` | `clienteempresa_view` | `IdTenacidade = :t` | `Descricao` |
| `idfornecedor` | `fornecedor` | `IdTenacidade = :t` | `NomeFantasia` |
| `idcolaborador` | `colaborador` | `IdTenacidade = :t` | — |
| `idempresa` | `empresa` | `IdTenacidade = :t AND Ativo = 'S'` | `NomeFantasia - TipoEmpresa` |
| `idsituacaodocumento` | `situacaodocumento` | `IdTenacidade = :t` | `Descricao` ORDER BY Descricao |
| `idplanoconta` | `planoconta` | `Tipo='A' AND Origem='R' AND IdTenacidade=:t` | `Classificador - Descricao` ORDER BY Classificador |
| `idplanocontafornecedor` | `planoconta` via `fornecedorplanoconta` | `Tipo='A' AND Origem='R' + IdFornecedor` | `Classificador - Descricao` |
| `idplanocontacolaborador` | `planoconta` via `colaboradorplanoconta` | `Tipo='A' AND Origem='R' + IdColaborador` | `Classificador - Descricao` |
| `idcontacaixa` | `contacaixa` | `IdTenacidade = :t` | `Descricao` |
| `idtipoespecie` | `tipoespecie` | `IdTenacidade = :t` | `Descricao` |
| `idnotafiscal` | `notafiscal` | — | `NumeroNotaFiscal` |
| `idcontacaixaregistro` | `contacaixaregistro` | `IdTenacidade = :t` | `DataReferencia - IdContaCaixaRegistro` |

---

## 7. Campos de Auditoria / Sistema (nunca editáveis)

| Campo | Injetado por |
|---|---|
| `idtenacidade` | Middleware de tenant |
| `idusuarioauditoria` | JWT |
| `enderecoipauditoria` | Request IP |
| `nomeaplicacaoauditoria` | Constante no service |
| `datainclusao` | `new Date()` no insert |
| `idusuarioinclusao` | JWT no insert |
| `idusuarioprevisao` | JWT ao criar a previsão |
| `idusuariorealizacao` | JWT ao registrar recebimento |
| `idusuariobaixa` | JWT ao dar baixa |
| `fechamentofinanceiro` | Sistema de fechamento |
| `idcontacaixaregistro` | Integração caixa |
| `idcontacaixatransferencia` | Integração transferência |
| `nossonumero` | Integração bancária/boleto |
| `enviouemailcobranca` | Sistema de cobrança automática |
| `lidoemailcobranca` | Rastreamento de e-mail |
| `enviouemail` | Sistema de e-mail |
| `unidadeorigem` | Importação/integração |
| `usuarioexterno` | Portal externo / integração |
| `idcontrato` | FK para contrato vinculado |

---

## 8. Diferenças Críticas em Relação a Contas a Pagar

| Aspecto | Contas a Pagar | Contas a Receber |
|---|---|---|
| Tabela | `lancamentodespesa` | `lancamentoreceita` |
| Nº de abas | **7** | **5** |
| Aba Auditoria | Sim (aba 3) | Não — campos de auditoria são ocultos |
| Aba Rateio | Sim (aba 7, condicional) | **Não existe** |
| Aba Observações | Não separada | **Sim — aba 3 dedicada** |
| Nº de uploads | 4 (boleto, NF, comprovante, anexo) | **2 genéricos** (arquivo 1 e 2) |
| Situação que obriga campos | apenas 4 | **4 e 24** |
| Bloqueio fechamento | apenas tenant=1 | **todos os tenants** |
| Campo Nota Fiscal | Não tem | **`idnotafiscal` + `notafiscal` + `BaixarNotaFiscal()`** |
| Campo Valor Original | Não tem | **`valororiginal`** |
| onBeforeDelete cascata | Não tem | **Sim — limpa recorrências filhas** |
| Plano de Contas filtro | sem filtro de Origem | **Tipo='A' AND Origem='R'** |
| Defaults novo registro | situação + conta caixa padrão | **apenas situação** |
| Label `datarealizacao` | "Pago em" | **"Pago em"** (mesmo label) |
| Botão extra Autorizações | `SC_btn_0` | **`SC_btn_1`** |
| Campos especiais | `fechamentofinanceiro`, `idcheque` | `idcontrato`, `nossonumero`, `enviouemailcobranca`, `usuarioexterno` |

---

## 9. Checklist de Implementação

### ContasReceberList
- [ ] Query em `lancamentoreceita` com filtro `IdTenacidade = :tenantId`
- [ ] Resolver lookups via JOIN/include: `tipoagente`, `situacaodocumento`, `contacaixa`, `empresa`, `planoconta`, `tipoespecie`
- [ ] 16 filtros de pesquisa com suporte a date range e multi-select para situação
- [ ] Filtro extra `idnotafiscal` (campo numérico)
- [ ] Botão "Relatório" → rota de relatório
- [ ] Botão "Baixa automática em lote" → permissão `BAIXA_AUTO`
- [ ] Botão "Autorizações" (`SC_btn_1`) → permissão `AUTORIZACOES`
- [ ] Ordenação padrão: `DataPrevisao ASC`
- [ ] Paginação server-side — contrato `ListQuery` / `ListResponse<T>`
- [ ] Destaque visual por situação (badge de cores)
- [ ] Componentes compartilhados: `DataTablePage`, `ListToolbar`, `ListShell`

### ContasReceberForm
- [ ] Usar `FormShell` + `TabView` + `FormFooter` + `ActionsBar`
- [ ] Cabeçalho fixo: `idtipoagente` (SelectField) + agente dinâmico + `idlancamentoreceita` (readonly)
- [ ] **5 abas:** Características · Recebimento · Observações · Arquivos · Recorrência
- [ ] RN-01: Verificar fechamento financeiro antes de salvar (todos os tenants)
- [ ] RN-02: `AcertarPlanoContas` — plano filtrado por tipo de agente com `Origem='R'`
- [ ] RN-03: Validações condicionais quando situação = 4 **ou** 24
- [ ] RN-04: Labels dinâmicos com asterisco quando situação = 4 ou 24
- [ ] RN-04b: Label `valorprevisao` especial quando integração Infolab + cartão
- [ ] RN-05: Show/hide campos de agente e plano de contas por tipo de agente
- [ ] RN-06: Show/hide `numerodocumento` vs `idcheque` por espécie
- [ ] RN-07: Aba Recorrência + botão `Recorrer` condicionais
- [ ] RN-08: Botão `Parcelar` condicional + `parcelamento` calculado
- [ ] RN-09: `BaixarNotaFiscal()` após insert/update
- [ ] RN-10: `onBeforeDelete` — cascata de recorrência
- [ ] RN-12: Default de situação no novo registro (sem conta caixa padrão)
- [ ] RN-13: Comportamento do clone
- [ ] RN-14: Upload com hash MD5 (2 arquivos genéricos)
- [ ] Lookup de plano de contas filtrado por agente **E** `Origem='R'` — endpoint dedicado
- [ ] Lookup de nota fiscal com busca por `NumeroNotaFiscal`
- [ ] Todos os campos de auditoria/sistema injetados no service (nunca no DTO)
- [ ] Campo `idcontrato` — campo oculto, não expor no formulário
- [ ] Campos `nossonumero`, `enviouemailcobranca`, `usuarioexterno` — readonly/ocultos
