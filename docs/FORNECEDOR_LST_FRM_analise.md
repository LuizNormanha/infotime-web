# Análise: Fornecedor_Lst e Fornecedor_Frm — Migração Scriptcase → Infotime Web

> Fonte: `LIGA_InfoTIME_apps.zip` — pastas `Fornecedor_Lst/` e `Fornecedor_Frm/`  
> Analisado em: 08/05/2026  
> Stack alvo: React · PrimeReact · Node.js · Prisma · PostgreSQL

---

## 1. Visão Geral

| App Scriptcase | Equivalente novo | Tabela principal |
|---|---|---|
| `Fornecedor_Lst` | `FornecedorList` — DataTable com filtros | `fornecedor` |
| `Fornecedor_Frm` | `FornecedorForm` — formulário com abas | `fornecedor` |

**Multi-tenant:** toda consulta filtra por `IdTenacidade = varIdTenacidade` (injetado via sessão). No novo sistema, o filtro vem automaticamente do JWT/contexto de tenant, nunca exposto ao frontend.

---

## 2. Fornecedor_Lst — Listagem

### 2.1 SQL Principal

```sql
SELECT
  NomeFantasia,
  TipoPessoa,
  Cnpj,
  Cidade,
  Estado,
  Telefone,
  Email,
  IdSituacaoFornecedor,
  Fabricante,
  IdFornecedor,
  Contatos,
  Celular
FROM fornecedor
WHERE IdTenacidade = :varIdTenacidade
```

> Diferentemente do Cliente, **não há subquery** de unidades/filhos. A query é direta na tabela `fornecedor`.

### 2.2 Colunas da Grid

| # | Campo DB | Label | Ordenável |
|---|---|---|---|
| 1 | `NomeFantasia` | Nome | ✅ (padrão ASC) |
| 2 | `TipoPessoa` | Tipo Pessoa | ✅ |
| 3 | `Cnpj` | CNPJ / CPF | ✅ |
| 4 | `Cidade` | Cidade | ✅ |
| 5 | `Estado` | Estado | ✅ |
| 6 | `Telefone` | Telefone | ✅ |
| 7 | `Celular` | Celular | ✅ |
| 8 | `Email` | E-mail | ✅ |
| 9 | `IdSituacaoFornecedor` | Situação | ✅ (lookup) |
| 10 | `Fabricante` | Fabricante | — |
| 11 | `Contatos` | Contatos | ✅ |
| 12 | `IdFornecedor` | Código | ✅ |

**Ordenação padrão:** `NomeFantasia ASC`

### 2.3 Botão de Ação Extra

| Botão | Label | Condição de visibilidade |
|---|---|---|
| `SC_btn_0` | **Autorizações** | Visível apenas quando `varAcessoAutorizacoes = 'S'` na sessão. Usuários sem essa permissão não veem o botão. |

### 2.4 Campos de Filtro (Pesquisa)

| Campo | Label | Tipo | Operação |
|---|---|---|---|
| `nomefantasia` | Nome | texto | LIKE `%valor%` em `NomeFantasia` |
| `cnpj` | CNPJ / CPF | texto | LIKE em `Cnpj` |
| `cidade` | Cidade | texto | LIKE em `Cidade` |
| `estado` | Estado | texto | exato em `Estado` (CHAR) |
| `telefone` | Telefone | texto | LIKE em `Telefone` |
| `celular` | Celular | texto | LIKE em `Celular` |
| `email` | E-mail | texto | LIKE em `Email` |

> **Atenção:** Fornecedor **não tem** filtro de Tipo de Fornecedor nem de Situação na pesquisa, ao contrário do Cliente. Os 7 filtros são todos textuais.

### 2.5 Sugestão de implementação (FornecedorList)

```typescript
// GET /fornecedores?page=1&limit=20&search=&cnpj=&cidade=&estado=&...
// Middleware injeta idTenacidade do JWT

// Retorno
{
  data: Fornecedor[],
  total: number,
  page: number,
  limit: number
}
```

---

## 3. Fornecedor_Frm — Formulário

### 3.1 Estrutura Geral (Abas)

O formulário tem **1 cabeçalho fixo** (Bloco 0) + **3 abas**.

```
┌─────────────────────────────────────────────────────────┐
│  CABEÇALHO (sempre visível)                             │
│  Tipo Pessoa* [FÍSICA | JURÍDICA]    Fabricante [  ] ✓  │
│  Razão Social / Nome*                Id. (idfornecedor)  │
└─────────────────────────────────────────────────────────┘
┌────────────────┬────────────┬──────────────┐
│ Características│  Endereço  │  Observações │
└────────────────┴────────────┴──────────────┘
```

> **Comparação com Cliente:** Fornecedor é bem mais simples — tem 3 abas (vs 5 do Cliente), sem abas de Documentos, Dados Adicionais ou campos de licença/chave. Não há lógica de multi-tenant para ocultar abas.

### 3.2 Bloco 0 — Cabeçalho (sempre visível)

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `tipopessoa` | Tipo Pessoa | radio | ✅ | `F` = Física · `J` = Jurídica. Default: J. Ao mudar, recalcula labels |
| `fabricante` | Fabricante | **checkbox (toggle S/N)** | — | Indica se o fornecedor é também fabricante. Renderizado como switch/toggle |
| `razaosocial` | **Razão Social** (J) / **Nome** (F) | text | ✅ | Label dinâmico por tipopessoa |
| `idfornecedor` | Id. | number | — | Readonly. PK autoincrement |

### 3.3 Aba 1 — Características

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `nomefantasia` | **Nome Fantasia** (J) / **Apelido** (F) | text | ✅ | Label dinâmico |
| `cnpj` | **CNPJ** (J) / **CPF** (F) | text | ✅ | Label dinâmico. Sempre obrigatório (sem exceção por situação, ao contrário do Cliente) |
| `idsituacaofornecedor` | Situação | select | ✅ | Lookup: `situacaofornecedor` ORDER BY Descricao |
| `telefone` | Telefone | text | — | Máscara telefone |
| `celular` | Celular | text | — | Máscara celular |
| `email` | E-mail | email | — | |
| `contatos` | Contatos | textarea | — | Campo livre |
| `homepage` | Site | text | — | URL do site do fornecedor |

### 3.4 Aba 2 — Endereço

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `cep` | CEP | text | Máscara CEP. Há integração de busca por CEP (`Fornecedor_Frm_cep.php`) |
| `tipologradouro` | Tipo Logradouro | text | Ex: Rua, Av, etc. |
| `logradouro` | Logradouro | text | |
| `numero` | Número | text | |
| `complemento` | Complemento | text | |
| `bairro` | Bairro | text | |
| `cidade` | Cidade | text | |
| `estado` | Estado | text/select | Sigla UF |

> Sem `idmunicipio` (lookup de município) — ao contrário do Cliente, o endereço do fornecedor usa texto livre para cidade e estado.

### 3.5 Aba 3 — Observações

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `observacoes` | Observações | textarea | Campo livre de anotações |

---

## 4. Regras de Negócio

### RN-01 — CNPJ/CPF único por tenant (validação no Insert)
**Evento:** `onBeforeInsert`  
**Lógica:** Antes de inserir, verifica se já existe registro com o mesmo CNPJ/CPF no mesmo tenant.

```typescript
// NestJS service — onBeforeInsert
const existe = await prisma.fornecedor.findFirst({
  where: {
    Cnpj: dto.cnpj,
    IdTenacidade: tenacidadeId,
  },
});

if (existe) {
  throw new BusinessException(
    'Atenção: CNPJ já cadastrado. Operação de inclusão cancelada.'
  );
}
```

> ⚠️ Esta validação é crítica. O sistema original bloqueia o insert completamente se o CNPJ já existir no tenant. A mensagem deve ser exibida ao usuário de forma clara.

### RN-02 — Labels dinâmicos por tipo de pessoa
**Disparo:** onChange no campo `tipopessoa`

| Campo | Pessoa Jurídica (J) | Pessoa Física (F) |
|---|---|---|
| `razaosocial` | Razão Social | Nome |
| `nomefantasia` | Nome Fantasia | Apelido |
| `cnpj` | CNPJ | CPF |

> Diferença importante em relação ao Cliente: o label de Pessoa Física para `nomefantasia` é **"Apelido"** (no Cliente era "Nome Social").

### RN-03 — Botão "Novo" condicional
**Evento:** `onScriptinit`  
**Condição:** Se `varTemInclusao ≠ 'S'`, o botão **Novo** é ocultado.  
No novo sistema: controlar via permissão RBAC — só usuários com permissão de inserção veem o botão "Novo".

### RN-04 — Botão "Autorizações" condicional (na Listagem)
**Condição:** `varAcessoAutorizacoes = 'S'`  
No novo sistema: exibir apenas para usuários com role/permissão `AUTORIZACOES`.

### RN-05 — CNPJ sempre obrigatório
Diferente do Cliente (que tinha exceção para `situacao = 3`), no Fornecedor o campo CNPJ/CPF é **sempre obrigatório**, sem exceções por situação.

```typescript
// Zod — sem condicional
z.object({
  cnpj: z.string().min(1, 'CNPJ / CPF é obrigatório'),
  // ...
})
```

### RN-06 — Campo Fabricante como booleano
O campo `fabricante` é um **checkbox/toggle** (`S` = fabricante, `null/vazio` = não é fabricante).  
No banco: `VARCHAR` com valor `'S'` ou vazio. No novo sistema, pode ser mapeado como `boolean`.

```typescript
// Transformação no service
fabricante: dto.fabricante ? 'S' : null
```

---

## 5. Campos Internos / de Auditoria (nunca editáveis)

| Campo | Motivo |
|---|---|
| `idtenacidade` | Injetado automaticamente pelo middleware de tenant |
| `idusuarioauditoria` | ID do usuário logado — vem do JWT |
| `enderecoipauditoria` | IP do request — injetado pelo NestJS |
| `nomeaplicacaoauditoria` | Nome da aplicação — constante no service |
| `numeroantigo` | Código legado de migração — readonly, exibir se não nulo |
| `ultimo` | Campo de controle interno do Scriptcase — **não persistir nem exibir** |

---

## 6. Lookups / Foreign Keys

| Campo | Tabela | Query | Label no form |
|---|---|---|---|
| `idsituacaofornecedor` | `situacaofornecedor` | `SELECT IdSituacaoFornecedor, Descricao FROM situacaofornecedor ORDER BY Descricao` | Situação |

> O Fornecedor tem **apenas um lookup** (situação). Não há lookup de município, canal, tipo, região ou concorrente como no Cliente.

---

## 7. Diferenças críticas em relação ao Cliente

| Aspecto | Cliente | Fornecedor |
|---|---|---|
| Nº de abas | 5 abas | 3 abas |
| Label PF `nomefantasia` | "Nome Social" | **"Apelido"** |
| CNPJ obrigatório | Condicional (exceto situação 3) | **Sempre obrigatório** |
| Validação CNPJ duplicado | Não tem no insert | **Sim — bloqueia insert** |
| Aba "Dados Adicionais" | Sim (tenant principal) | **Não existe** |
| Chave de acesso / Licença | Sim | **Não existe** |
| Subquery de unidades | Sim (`count(filhos)`) | **Não existe** |
| Lookup município | Sim (`idmunicipio`) | **Não — texto livre** |
| Inscrição Estadual / Municipal | Sim (aba Documentos) | **Não existe** |
| Campo Fabricante | Não | **Sim (checkbox)** |
| Botão extra na listagem | "Emails" | **"Autorizações"** |
| Filtros de pesquisa | 9 (inclui tipo e situação) | **7 (sem tipo, sem situação)** |
| Nº de lookups no form | 7 lookups | **1 lookup** |
| Sexo / Data Nascimento | Sim (PF) | **Não existem** |

---

## 8. Checklist de Implementação

### FornecedorList
- [ ] Query direta em `fornecedor` com filtro `IdTenacidade = :tenantId`
- [ ] Resolver lookup de `IdSituacaoFornecedor` no JOIN ou via include Prisma
- [ ] Campo `Fabricante` exibido como badge/ícone booleano na coluna
- [ ] Filtros: nome, cnpj, cidade, estado, telefone, celular, email
- [ ] Botão "Autorizações" visível apenas para usuários com permissão `AUTORIZACOES`
- [ ] Botão "Novo" visível apenas para usuários com permissão de inserção
- [ ] Ordenação padrão: `NomeFantasia ASC`
- [ ] Paginação server-side

### FornecedorForm
- [ ] Cabeçalho: `tipopessoa` (radio F/J) + `fabricante` (toggle/checkbox) + `razaosocial` + `idfornecedor`
- [ ] 3 abas: Características · Endereço · Observações
- [ ] Labels dinâmicos ao mudar `tipopessoa` (RN-02): razaosocial, nomefantasia, cnpj
- [ ] RN-01: Verificar CNPJ duplicado no insert antes de salvar
- [ ] RN-05: CNPJ sempre obrigatório (sem exceção por situação)
- [ ] Lookup `idsituacaofornecedor` — endpoint `GET /situacoes-fornecedor`
- [ ] Integração CEP (ViaCEP) no campo CEP da aba Endereço
- [ ] Campo `fabricante`: toggle boolean → persistir como `'S'` ou `null`
- [ ] Campos de auditoria injetados no service (nunca no DTO de entrada)
- [ ] Botão "Novo" condicional por permissão (RN-03)
