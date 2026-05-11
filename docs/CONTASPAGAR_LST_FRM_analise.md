# Análise: LancamentoDespesa_Lst e LancamentoDespesa_Frm — Contas a Pagar
## Migração Scriptcase → Infotime Web

> Fonte: `LIGA_InfoTIME_apps.zip` — pastas `LancamentoDespesa_Lst/` e `LancamentoDespesa_Frm/`  
> Analisado em: 08/05/2026  
> Stack alvo: React · PrimeReact · Node.js · Prisma · PostgreSQL  
> Atenção: estes são os maiores arquivos do sistema (~1.3 MB cada). O módulo é o mais complexo do InfoTime.

---

## 1. Visão Geral

| App Scriptcase | Equivalente novo | Tabela principal |
|---|---|---|
| `LancamentoDespesa_Lst` | `ContasPagarList` | `lancamentodespesa` |
| `LancamentoDespesa_Frm` | `ContasPagarForm` | `lancamentodespesa` |

**Multi-tenant:** filtro `WHERE IdTenacidade = :varIdTenacidade` em todas as queries, injetado pelo middleware de tenant.

**Nomenclatura no banco:** a tabela se chama `lancamentodespesa`. No infotime-web adotar o nome de domínio `ContasPagar` para componentes e rotas, mas manter os nomes de campo do banco como estão.

---

## 2. LancamentoDespesa_Lst — Listagem

### 2.1 SQL Principal

```sql
SELECT
  DataPrevisao,
  ValorPrevisao,
  ValorPrevisaoLiquido,
  DataRealizacao,
  ValorRealizacao,
  IdTipoEspecie,
  NomeAgente,
  CnpjCpf,
  Historico,
  DataCompetencia,
  IdContaCaixa,
  IdSituacaoDocumento,
  IdEmpresa,
  IdPlanoConta,
  DataBaixa,
  IdTipoAgente,
  IdLancamentoDespesa,
  DataInclusao,
  QtdParcela,
  Cnpj,
  DataAgendamento,
  NumeroDocumento,
  IdFornecedor,
  IdAgente,
  IdLancamentoDespesaPai,
  IdLancamentoDespesaRecorrente,
  Parcela
FROM lancamentodespesa
WHERE IdTenacidade = :varIdTenacidade
```

### 2.2 Colunas da Grid

| # | Campo DB | Label | Ordenável |
|---|---|---|---|
| 1 | `DataPrevisao` | Previsto para | ✅ |
| 2 | `ValorPrevisao` | Valor Previsto | ✅ |
| 3 | `ValorPrevisaoLiquido` | Valor Previsto Líquido | ✅ |
| 4 | `DataRealizacao` | Pago em | ✅ |
| 5 | `ValorRealizacao` | Valor Pago | ✅ |
| 6 | `IdTipoEspecie` | Espécie | ✅ (lookup) |
| 7 | `NomeAgente` | Nome / Razão social | ✅ |
| 8 | `CnpjCpf` | CPF/CNPJ | ✅ |
| 9 | `Historico` | Histórico | ✅ |
| 10 | `DataCompetencia` | Competência | ✅ |
| 11 | `IdContaCaixa` | Conta Caixa | ✅ (lookup) |
| 12 | `IdSituacaoDocumento` | Situação | ✅ (lookup) |
| 13 | `IdEmpresa` | Empresa | ✅ (lookup) |
| 14 | `IdPlanoConta` | Plano de Contas | ✅ (lookup) |
| 15 | `DataBaixa` | Baixado | ✅ |
| 16 | `IdTipoAgente` | Tipo agente | ✅ (lookup) |
| 17 | `IdLancamentoDespesa` | Código | ✅ |
| 18 | `DataInclusao` | Incluído em | ✅ |
| 19 | `QtdParcela` | Qtd Parcelas | — |
| 20 | `Cnpj` | CNPJ Fornecedor | — |
| 21 | `DataAgendamento` | Agendado para | ✅ |
| 22 | `NumeroDocumento` | Documento | ✅ |
| 23 | `Parcela` | Parcela | — |

**Ordenação padrão:** `DataPrevisao ASC`

### 2.3 Botões de Ação Extra

| Botão | Label | Condição |
|---|---|---|
| `Relatorio` | **Contas a pagar por período** | Sempre visível |
| `BaixaAuto` | **Baixa automática em lote** | Visível apenas quando `varBaixaAuto = 'S'` |
| `SC_btn_0` | **Autorizações** | Visível apenas quando `varAcessoAutorizacoes = 'S'` |

### 2.4 Campos de Filtro (Pesquisa)

| Campo | Label | Tipo | Operação |
|---|---|---|---|
| `idempresa` | Empresa | select lookup | `IdEmpresa = :valor` |
| `idtipoagente` | Tipo agente | select lookup | `IdTipoAgente = :valor` |
| `nomeagente` | Nome / Razão social | texto | LIKE em `NomeAgente` |
| `cnpjcpf` | CPF/CNPJ | texto | LIKE em `CnpjCpf` |
| `idplanoconta` | Plano de contas | select lookup | `IdPlanoConta = :valor` |
| `idcontacaixa` | Conta caixa | select lookup | `IdContaCaixa = :valor` |
| `datacompetencia` | Competência | date range | BETWEEN em `DataCompetencia` |
| `datainclusao` | Incluído em | datetime range | BETWEEN em `DataInclusao` |
| `dataprevisao` | Previsto para | datetime range | BETWEEN em `DataPrevisao` |
| `datarealizacao` | Pago em | datetime range | BETWEEN em `DataRealizacao` |
| `databaixa` | Baixado | datetime range | BETWEEN em `DataBaixa` |
| `idsituacaodocumento` | Situação | select lookup (multi) | `IdSituacaoDocumento IN (...)` |
| `numerodocumento` | Documento | texto | LIKE em `NumeroDocumento` |
| `idtipoespecie` | Espécie | select lookup | `IdTipoEspecie = :valor` |
| `historico` | Histórico | texto | LIKE em `Historico` |

> **15 filtros** — bem mais rico que Cliente (9) e Fornecedor (7). Os filtros de data suportam operadores: igual, maior, menor, entre (range). Os campos de lookup têm autocomplete.

---

## 3. LancamentoDespesa_Frm — Formulário

### 3.1 Estrutura Geral

O formulário tem **1 cabeçalho** (Bloco 0) + **7 abas** numeradas de 1 a 7.

```
┌─────────────────────────────────────────────────────────────────┐
│  CABEÇALHO (sempre visível)                                     │
│  Tipo Agente*  [Cliente|Fornecedor|Colaborador]                 │
│  Cliente* / Fornecedor* / Colaborador*   Código (id)           │
└─────────────────────────────────────────────────────────────────┘
┌──────────────┬──────────┬──────────┬─────────┬──────────┬───────────┬────────┐
│Características│Pagamento │Auditoria │Arquivos │Recorrência│Parcelamento│Rateio │
└──────────────┴──────────┴──────────┴─────────┴──────────┴───────────┴────────┘
```

> **Nota arquitetural importante:** abas 5 (Recorrência), 6 (Parcelamento) e 7 (Rateio) são exibidas/ocultadas dinamicamente por regras de negócio. A aba 7 (Rateio) só aparece em registros existentes (não no novo).

### 3.2 Bloco 0 — Cabeçalho (sempre visível)

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `idtipoagente` | Tipo Agente | select | ✅ | Lookup: `tipoagente` ORDER BY Descricao. Valores: 1=Cliente, 2=Fornecedor, 3=Colaborador. Controla qual dos 3 campos abaixo aparece |
| `idcliente` | Cliente | autocomplete | ✅ se tipoagente=1 | Visível somente quando `idtipoagente = 1`. Lookup: `clienteempresa_view` (view!) filtrada por tenant |
| `idfornecedor` | Fornecedor | autocomplete | ✅ se tipoagente=2 | Visível somente quando `idtipoagente = 2`. Lookup: tabela `fornecedor` |
| `idcolaborador` | Colaborador | autocomplete | ✅ se tipoagente=3 | Visível somente quando `idtipoagente = 3` |
| `idlancamentodespesa` | Código | number | — | Readonly. PK autoincrement |

### 3.3 Aba 1 — Características

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `idempresa` | Empresa | select | — | Lookup: `empresa` WHERE Ativo='S' AND IdTenacidade — exibe `NomeFantasia - TipoEmpresa` |
| `valorprevisao` | Valor Previsto | decimal | ✅ | Valor a pagar |
| `valorprevisaoliquido` | Valor Líquido | decimal | — | Valor líquido previsto |
| `dataprevisao` | Previsto para | date | ✅ | Data de vencimento |
| `idusuarioprevisao` | Usuário Prev. | readonly | — | Preenchido automaticamente — usuário logado |
| `idsituacaodocumento` | Situação | select | ✅ | Lookup: `situacaodocumento` WHERE IdTenacidade ORDER BY Descricao DESC. Preenchido automaticamente com `varIdSituacaoDocumentoPendenteInt` no novo registro |
| `datacompetencia` | Competência | date | — | Mês/ano de competência contábil |
| `contacontabil` | Conta Contábil | text | — | |
| `historico` | Histórico | text | — | Descrição livre |
| `idplanoconta` | Plano de Contas | select | ✅ | **Campo crítico** — filtrado dinamicamente por agente (ver RN-03) |
| `idplanocontacliente` | Plano de Contas (Cliente) | select | — | Lookup específico para tipoagente=1: `clienteplanoconta JOIN planoconta` |
| `idplanocontacolaborador` | Plano de Contas (Colab.) | select | — | Lookup específico para tipoagente=3: `colaboradorplanoconta JOIN planoconta` |

### 3.4 Aba 2 — Pagamento

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `idcontacaixa` | Conta Caixa | select | — | Lookup: `contacaixa` WHERE IdTenacidade. Pré-preenchido com `varIdContaCaixaPadrao` no novo registro |
| `valorrealizacao` | **Valor Pago\*** | decimal | ✅ quando situação=4 (Pago) | Label muda para `Valor Pago*` quando situação=4 |
| `datarealizacao` | **Pago em\*** | date | ✅ quando situação=4 | Label muda para `Pago em*` quando situação=4 |
| `idusuariorealizacao` | Usuário Real. | readonly | — | |
| `idtipoespecie` | **Espécie\*** | select | ✅ quando valorrealizacao>0 | Lookup: `tipoespecie` WHERE IdTenacidade. Label muda para `Especie*` quando situação=4 |
| `idcheque` | Cheque | select | ✅ se tipoespecie=1 | Visível **somente** quando `idtipoespecie = 1`. Lookup: cheques com Situacao IN ('E','C') |
| `numerodocumento` | Nº Documento | text | — | Visível quando `idtipoespecie ≠ 1`. Oculto para cheque |
| `dataagendamento` | Agendado para | date | — | |
| `idusuarioagendamento` | Usuário Ag. | readonly | — | |
| `valoracrescimo` | Acréscimo | decimal | — | |
| `valordesconto` | Desconto | decimal | — | |
| `valormulta` | Multa | decimal | — | |
| `valorjuros` | Juros | decimal | — | |
| `parcelamento` | Parcelamento | text readonly | — | Exibição `"X / Y"` (ex: "2 / 5") — calculado |
| `databaixa` | Baixado em | date | ✅ quando situação=4 | |

### 3.5 Aba 3 — Auditoria

> Todos os campos desta aba são **readonly** — gerenciados pelo sistema.

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `datainclusao` | Data Inclusão | datetime readonly | Preenchido automaticamente |
| `idusuarioinclusao` | Usuário Inclusão | readonly | ID do usuário que criou |
| `idusuariobaixa` | Usuário Baixa | readonly | ID do usuário que deu baixa |
| `idcontacaixaregistro` | Registro Caixa | readonly | FK para `contacaixaregistro` |
| `idcontacaixatransferencia` | Conta Transferência | readonly | FK para `contacaixa` |
| `idlancamentodespesapai` | Lançamento Pai | readonly | Referência para parcelamento |
| `idlancamentodespesarecorrente` | Recorrência | readonly | FK para lançamento recorrente pai |
| `idtenacidade` | Tenant | readonly | |
| `idusuarioauditoria` | Usuário Auditoria | readonly | |
| `enderecoipauditoria` | IP Auditoria | readonly | |
| `nomeaplicacaoauditoria` | App Auditoria | readonly | |
| `idalmoxarifadoentrada` | Almoxarifado | readonly | FK para almoxarifado |

### 3.6 Aba 4 — Arquivos

Quatro uploads opcionais, cada um com dois campos: `nomearquivo*` (nome no storage) e `nomereferenciaXxx` (nome amigável exibido ao usuário).

| Par de campos | Label | Tipo |
|---|---|---|
| `nomereferenciaboleto` / `nomearquivoboleto` | Boleto | upload PDF/imagem |
| `nomereferencianotafiscal` / `nomearquivonotafiscal` | Nota Fiscal | upload PDF |
| `nomereferenciacomprovante` / `nomearquivocomprovante` | Comprovante | upload PDF/imagem |
| `nomereferenciaanexo` / `nomearquivoanexo` | Anexo | upload qualquer |

### 3.7 Aba 5 — Recorrência

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `recorrente` | Recorrência | subgrid/embed | Sub-aplicação `LancamentoDespesaRecorrente_Ctr`. Visível somente quando `idlancamentodespesarecorrente` está vazio. Oculta quando o lançamento já está vinculado a uma recorrência |

> **Botão `Recorrer`:** aparece na toolbar quando não há recorrência vinculada. Navega para `LancamentoDespesa_Recorrente_Frm`.

### 3.8 Aba 6 — Parcelamento

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `parcelax` | Parcelamento | subgrid/embed | Sub-aplicação `LancamentoDespesa_Parcelamento_Ctr`. Visível somente quando `idlancamentodespesapai` está vazio (lançamento não é parcela). Se for parcela, a aba fica oculta e `parcelamento` no cabeçalho exibe `"X / Y"` |

> **Botão `Parcelar`:** aparece quando não há pai vinculado. Navega para `LancamentoDespesa_Parcelamento_Ctr`.

### 3.9 Aba 7 — Rateio

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `lancamentodespesarateio` | Rateio | subgrid/embed | Sub-aplicação `LancamentoDespesaRateio_Gde`. **Visível somente em registros existentes** (oculta na criação — bloco 7 fica oculto em `sc_evento = "novo"`) |

---

## 4. Regras de Negócio

### RN-01 — Bloqueio por Fechamento Financeiro (onValidate)
**Disparo:** em todo save (insert e update), apenas para `varIdTenacidade = 1`  
**Lógica em duas etapas:**

1. Se o registro já tem `fechamentofinanceiro = 'S'` → **bloqueia** a alteração com: *"Despesa não pode ser alterada. Já houve fechamento financeiro para esse período."*
2. Se não tem, verifica na tabela `fechamentofinanceiro` se existe um registro cujo `DataInicial ≤ dataprevisao ≤ DataFinal` para o tenant → **bloqueia** a inclusão: *"Despesa não pode ser incluída. Já houve fechamento financeiro para esse período."*

```typescript
// NestJS — antes de qualquer save (tenant=1 somente)
if (tenancyId === 1) {
  if (dto.fechamentofinanceiro === 'S') {
    throw new BusinessException('Despesa não pode ser alterada. Já houve fechamento financeiro para esse período.');
  }
  const fechamento = await prisma.fechamentofinanceiro.findFirst({
    where: {
      IdTenacidade: tenancyId,
      DataInicial: { lte: dto.dataprevisao },
      DataFinal: { gte: dto.dataprevisao },
    },
  });
  if (fechamento) {
    throw new BusinessException('Despesa não pode ser incluída. Já houve fechamento financeiro para esse período.');
  }
}
```

### RN-02 — Plano de Contas dinâmico por tipo de agente (AcertarPlanoConta)
**Disparo:** onValidate, onBeforeInsert, onBeforeUpdate

O campo `idplanoconta` é resolvido de forma diferente por tipo de agente:

| `idtipoagente` | Campo de origem do plano | Lookup |
|---|---|---|
| 1 — Cliente | `idplanocontacliente` → `idplanoconta` | `clienteplanoconta JOIN planoconta WHERE IdCliente = :idcliente` |
| 2 — Fornecedor | `idplanoconta` (direto) | `fornecedorplanoconta JOIN planoconta WHERE IdFornecedor = :idfornecedor` |
| 3 — Colaborador | `idplanocontacolaborador` → `idplanoconta` | `colaboradorplanoconta JOIN planoconta WHERE IdColaborador = :idcolaborador` |

Os campos `idplanocontacliente` e `idplanocontacolaborador` são campos temporários do form — ao salvar, sempre se grava no `idplanoconta` definitivo.

### RN-03 — Agente obrigatório por tipo (onValidate)

| `idtipoagente` | Campo obrigatório | Mensagem |
|---|---|---|
| 1 | `idcliente` | *"Cliente: Campo obrigatório"* |
| 2 | `idfornecedor` | *"Fornecedor: Campo obrigatório"* |
| 3 | `idcolaborador` | *"Colaborador: Campo obrigatório"* |

Se `idtipoagente` não for 1, 2 ou 3, os três campos de agente ficam ocultos.

### RN-04 — Plano de Contas obrigatório
**Mensagem:** *"Plano de Contas: Campo obrigatório"*

### RN-05 — Validações condicionais quando há valor realizado (`valorrealizacao > 0`)
1. **Espécie obrigatória:** *"Espécie: Campo obrigatório"*
2. **Situação não pode ser Pendente:** *"Situação: deve ser diferente de Pendente."* — o ID de situação Pendente fica em `varIdSituacaoDocumentoPendenteInt`

### RN-06 — Validações quando situação = 4 (Pago — onValidateSuccess)
Campos obrigatórios quando `idsituacaodocumento = 4`:
- `valorrealizacao`: *"Valor pago: Campo obrigatório"*
- `datarealizacao`: *"Pago em: Campo obrigatório"*
- `idtipoespecie`: *"Espécie: Campo obrigatório"*
- `databaixa`: *"Baixado em: Campo obrigatório"*

### RN-07 — Cheque obrigatório quando espécie = cheque
Se `idtipoespecie = 1` e `idcheque` está vazio: *"Campo obrigatório: Cheque"*

### RN-08 — Labels dinâmicos por situação (AcertarLabels)
Quando `idsituacaodocumento = 4` (Pago), os labels mudam para indicar obrigatoriedade:
- `valorrealizacao` → **"Valor Pago\*"**
- `datarealizacao` → **"Pago em\*"**
- `idtipoespecie` → **"Especie\*"**

Nas demais situações: "Valor Pago", "Pago em", "Especie" (sem asterisco).

### RN-09 — Visibilidade de campos por tipo de espécie (onLoad + onChange)
- `idtipoespecie = 1` (Cheque): mostra `idcheque`, oculta `numerodocumento`
- `idtipoespecie ≠ 1`: oculta `idcheque`, mostra `numerodocumento`
- Ao salvar com espécie ≠ 1: `idcheque = NULL`

### RN-10 — Visibilidade de campos por tipo de agente (onLoad + onChange)
| `idtipoagente` | `idcliente` | `idfornecedor` | `idcolaborador` | `idplanoconta` | `idplanocontacliente` | `idplanocontacolaborador` |
|---|---|---|---|---|---|---|
| 1 (Cliente) | ✅ visível | ❌ oculto | ❌ oculto | ❌ oculto | ✅ visível | ❌ oculto |
| 2 (Fornecedor) | ❌ oculto | ✅ visível | ❌ oculto | ✅ visível | ❌ oculto | ❌ oculto |
| 3 (Colaborador) | ❌ oculto | ❌ oculto | ✅ visível | ❌ oculto | ❌ oculto | ✅ visível |
| Nenhum | ❌ oculto | ❌ oculto | ❌ oculto | — | — | — |

### RN-11 — Visibilidade das abas Recorrência e Parcelamento (onLoad)
- Aba 5 (Recorrência) + botão `Recorrer`: visível **somente** quando `idlancamentodespesarecorrente` está vazio
- Aba 6 (Parcelamento) + botão `Parcelar`: visível **somente** quando `idlancamentodespesapai` está vazio
- Aba 7 (Rateio): visível **somente** em registros existentes (oculta no novo)

### RN-12 — Defaults de novo registro (onLoad quando sc_evento = "novo")
- `idsituacaodocumento` ← `varIdSituacaoDocumentoPendenteInt` (situação "Pendente" do tenant)
- `idcontacaixa` ← `varIdContaCaixaPadrao` (conta caixa padrão do tenant)

### RN-13 — Comportamento do Clone (nmgp_clone = "S")
Quando clona um registro, os seguintes campos são zerados:
`valorprevisao`, `dataprevisao`, `idsituacaodocumento` (→1), `valorrealizacao`, `idtipoespecie`, `dataagendamento`, `datarealizacao`, `numerodocumento`, `idcheque`, `valoracrescimo`, `valordesconto`, `valormulta`, `valorjuros`, `databaixa`, `idcontacaixaregistro`, `datainclusao` (→ now), `idusuarioinclusao` (→ usuário logado) e todos os campos de arquivo.

### RN-14 — Upload de arquivos com hash de nome (onBeforeInsert + onBeforeUpdate)
Ao fazer upload de qualquer arquivo (boleto, NF, comprovante, anexo), o nome real do arquivo é hasheado com MD5 para armazenamento seguro:
```
nomearquivo = nomeOriginal (nome amigável para exibição)
nomereferenciaXxx = md5(datetime + nomeOriginal + idTenacidade) + ".extensão" (nome real no storage)
```
No update, o arquivo anterior é renomeado fisicamente no storage.

**Caso especial:** se o boleto é carregado e a situação é 73 (situação de boleto disponível), ela é automaticamente alterada para 1 (Pendente).

### RN-15 — Atualização de cheque após pagamento (onAfterInsert + onAfterUpdate)
Se `idtipoespecie = 1 (ou 102)` AND `idcheque` preenchido AND `idsituacaodocumento = 4 (Pago)`: executa o método `AtualizarCheque()` que marca o cheque como utilizado na tabela `cheque`.

---

## 5. Lookups Completos

| Campo | Tabela/View | Filtro | Exibição |
|---|---|---|---|
| `idtipoagente` | `tipoagente` | — | `Descricao` ORDER BY Descricao |
| `idcliente` | `clienteempresa_view` | `IdTenacidade = :t` | `Descricao` (view agrega cliente + empresa) |
| `idfornecedor` | `fornecedor` | `IdTenacidade = :t` | `NomeFantasia` |
| `idcolaborador` | `colaborador` | `IdTenacidade = :t` | — |
| `idempresa` | `empresa` | `IdTenacidade = :t AND Ativo = 'S'` | `NomeFantasia - TipoEmpresa` |
| `idsituacaodocumento` | `situacaodocumento` | `IdTenacidade = :t` | `Descricao` ORDER BY Descricao DESC |
| `idplanoconta` | `planoconta` | via `fornecedorplanoconta` + idFornecedor | `Classificador - Descricao` |
| `idplanocontacliente` | `planoconta` | via `clienteplanoconta` + idCliente | `Classificador - Descricao` |
| `idplanocontacolaborador` | `planoconta` | via `colaboradorplanoconta` + idColaborador | `Classificador - Descricao` |
| `idcontacaixa` | `contacaixa` | `IdTenacidade = :t` | `Descricao` |
| `idtipoespecie` | `tipoespecie` | `IdTenacidade = :t` | `Descricao` |
| `idcheque` | `cheque` | `Situacao IN ('E','C') AND IdTenacidade = :t` | `Numero Valor IdCheque Situacao` |
| `idcontacaixaregistro` | `contacaixaregistro` | `IdTenacidade = :t` | `DataReferencia - IdContaCaixaRegistro` |

---

## 6. Campos de Auditoria / Sistema (nunca editáveis)

| Campo | Injetado por |
|---|---|
| `idtenacidade` | Middleware de tenant |
| `idusuarioauditoria` | JWT |
| `enderecoipauditoria` | Request IP |
| `nomeaplicacaoauditoria` | Constante no service |
| `datainclusao` | Automático (`new Date()`) |
| `idusuarioinclusao` | JWT (usuário logado) |
| `idusuarioprevisao` | JWT ao criar a previsão |
| `idusuarioagendamento` | JWT ao agendar |
| `idusuariorealizacao` | JWT ao registrar realização |
| `idusuariobaixa` | JWT ao dar baixa |
| `fechamentofinanceiro` | Sistema de fechamento (readonly no form) |

---

## 7. Checklist de Implementação

### ContasPagarList
- [ ] Query na tabela `lancamentodespesa` com filtro `IdTenacidade`
- [ ] Resolver lookups via JOIN ou include Prisma: `tipoagente`, `situacaodocumento`, `contacaixa`, `empresa`, `planoconta`, `tipoespecie`
- [ ] Coluna `NomeAgente` (texto desnormalizado — já está no registro)
- [ ] 15 filtros de pesquisa com suporte a date range para os 5 campos de data
- [ ] Filtro de situação com multi-select
- [ ] Botão "Contas a pagar por período" → relatório (rota separada)
- [ ] Botão "Baixa automática em lote" → permissão `BAIXA_AUTO`
- [ ] Botão "Autorizações" → permissão `AUTORIZACOES`
- [ ] Paginação server-side com ordenação por `DataPrevisao ASC`
- [ ] Destaque visual por situação (Pendente, Pago, Vencido, Agendado, etc.)

### ContasPagarForm
- [ ] Cabeçalho: `idtipoagente` (select) + campo de agente dinâmico + `idlancamentodespesa`
- [ ] 7 abas: Características · Pagamento · Auditoria · Arquivos · Recorrência · Parcelamento · Rateio
- [ ] RN-01: Verificar fechamento financeiro antes de salvar (tenant=1)
- [ ] RN-02: `AcertarPlanoConta` — resolver `idplanoconta` correto por tipo de agente
- [ ] RN-03: Validação de agente obrigatório por tipo
- [ ] RN-04: Plano de Contas obrigatório
- [ ] RN-05: Espécie obrigatória e situação ≠ Pendente quando há valor realizado
- [ ] RN-06: Campos obrigatórios quando situação = 4 (Pago)
- [ ] RN-07: Cheque obrigatório quando espécie = cheque
- [ ] RN-08: Labels dinâmicos por situação (`AcertarLabels`)
- [ ] RN-09: Show/hide cheque ↔ número de documento por espécie
- [ ] RN-10: Show/hide campos de agente e plano de conta por tipo de agente
- [ ] RN-11: Show/hide abas Recorrência, Parcelamento e Rateio conforme estado do registro
- [ ] RN-12: Pré-preencher situação e conta caixa padrão no novo registro
- [ ] RN-13: Comportamento do clone (limpar campos de realização/pagamento)
- [ ] RN-14: Upload de arquivos com hash + lógica de renomeação no storage
- [ ] RN-15: Atualizar cheque após pagamento
- [ ] Lookup de plano de contas filtrado pelo agente selecionado (API separada: `/planos-conta/por-agente`)
- [ ] Todos os campos de auditoria injetados no service (nunca no DTO)
- [ ] Sub-feature "Parcelar": criar N lançamentos com `idlancamentodespesapai` apontando para o pai
- [ ] Sub-feature "Recorrer": criar lançamento recorrente via `LancamentoDespesa_Recorrente_Frm`
