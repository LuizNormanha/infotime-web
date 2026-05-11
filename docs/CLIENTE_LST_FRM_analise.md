# Análise: Cliente_Lst e Cliente_Frm — Migração Scriptcase → Infotime Web

> Fonte: `LIGA_InfoTIME_apps.zip` — arquivos `Cliente_Lst/` e `Cliente_Frm/`  
> Analisado em: 08/05/2026  
> Stack alvo: React · PrimeReact · Node.js · Prisma · PostgreSQL

---

## 1. Visão Geral

| App Scriptcase | Equivalente novo | Tabela principal |
|---|---|---|
| `Cliente_Lst` | `ClienteList` — DataTable com filtros | `cliente` |
| `Cliente_Frm` | `ClienteForm` — formulário com abas | `cliente` |

O sistema é **multi-tenant**: toda consulta filtra por `IdTenacidade` vindo da sessão (`varIdTenacidade`). Esse filtro deve ser aplicado automaticamente via middleware/contexto no NestJS, nunca exposto ao frontend.

---

## 2. Cliente_Lst — Listagem

### 2.1 SQL Principal

```sql
SELECT
  cl.IdCliente,
  cl.IdTipoCliente,
  cl.RazaoSocial,
  cl.TipoPessoa,
  cl.NomeFantasia,
  cl.Contatos,
  cl.IdSituacaoCliente,
  cl.Cnpj,
  cl.Cidade,
  cl.Estado,
  cl.Telefone,
  cl.Celular,
  cl.Email,
  cl.IdClienteCanal,
  cl.NumeroAntigo,
  (SELECT count(*) FROM cliente un WHERE un.IdClientePai = cl.IdCliente) AS Unidades
FROM cliente cl
WHERE cl.IdTenacidade = :varIdTenacidade
```

### 2.2 Colunas da Grid

| # | Campo DB | Label exibido | Ordenável |
|---|---|---|---|
| 1 | `NomeFantasia` | Cliente | ✅ (padrão ASC) |
| 2 | `RazaoSocial` | Razão Social / Nome | ✅ |
| 3 | `TipoPessoa` | Tipo Pessoa | ✅ |
| 4 | `Cnpj` | CNPJ / CPF | ✅ |
| 5 | `Cidade` | Cidade | ✅ |
| 6 | `Estado` | Estado | ✅ |
| 7 | `Telefone` | Telefone | ✅ |
| 8 | `Celular` | Celular | — |
| 9 | `IdSituacaoCliente` | Situação | ✅ (lookup) |
| 10 | `IdClienteCanal` | Canal | — (lookup) |
| 11 | `Contatos` | Contatos | — |
| 12 | `Unidades` | Unidades | — (calculado) |
| 13 | `IdCliente` | Código | ✅ |

**Ordenação padrão:** `NomeFantasia ASC`

**Botão de ação extra:** `Emails` (ação em lote — disparo de e-mail para clientes selecionados)

### 2.3 Campos de Filtro (Pesquisa)

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `nomefantasia` | Cliente | texto | LIKE `%valor%` em `NomeFantasia` |
| `idtipocliente` | Tipo | lookup | Tabela `tipocliente` — `Descricao / IdTipoCliente` |
| `idsituacaocliente` | Situação | lookup | Tabela `situacaocliente` — `Descricao / IdSituacaoCliente` |
| `cnpj` | CNPJ / CPF | texto | LIKE em `Cnpj` |
| `cidade` | Cidade | texto | LIKE em `Cidade` |
| `estado` | Estado | texto | exato em `Estado` |
| `telefone` | Telefone | texto | LIKE em `Telefone` |
| `celular` | Celular | texto | LIKE em `Celular` |
| `email` | E-mail | texto | LIKE em `Email` |

### 2.4 Sugestão de implementação (ClienteList)

```typescript
// GET /clientes?page=1&limit=20&search=&idtipocliente=&idsituacaocliente=&cnpj=&cidade=&estado=
// Middleware injeta idTenacidade do token JWT

// Retorno esperado
{
  data: Cliente[],
  total: number,
  page: number,
  limit: number
}
```

Colunas sugeridas para o `<DataTable>`:
```tsx
// Colunas visíveis por padrão (restantes em toggle)
['NomeFantasia', 'Cnpj', 'Cidade', 'Estado', 'Telefone', 'IdSituacaoCliente', 'Unidades']
```

---

## 3. Cliente_Frm — Formulário

### 3.1 Estrutura Geral (Abas)

O formulário tem **1 cabeçalho fixo** (Bloco 0) + **5 abas** numeradas de 1 a 5.

```
┌──────────────────────────────────────────────────────┐
│  CABEÇALHO (sempre visível)                          │
│  Tipo Pessoa* [FÍSICA | JURÍDICA]                    │
│  Razão Social / Nome*          Código (idcliente)    │
└──────────────────────────────────────────────────────┘
┌──────────┬──────────────┬────────────┬────────┬────────┐
│Caracterí.│Dados adicion.│Documentos  │Endereço│Observ. │
└──────────┴──────────────┴────────────┴────────┴────────┘
```

### 3.2 Bloco 0 — Cabeçalho (sempre visível)

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `tipopessoa` | Tipo Pessoa | radio | ✅ | `F` = Física · `J` = Jurídica. Default: J. Ao mudar, recarrega labels e visibilidade |
| `razaosocial` | **Razão Social** (J) / **Nome** (F) | text | ✅ | Label muda dinamicamente |
| `idcliente` | Código | number | — | Readonly. PK autoincrement |

### 3.3 Aba 1 — Características

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `nomefantasia` | **Nome Fantasia** (J) / **Nome Social** (F) | text | ✅ | Label dinâmico |
| `sexo` | Sexo | select/radio | — | **Visível somente para PF** (`tipopessoa = 'F'`) |
| `datanascimento` | Data Nascimento | date | — | **Visível somente para PF** |
| `telefone` | Telefone | text | — | Máscara telefone |
| `celular` | Celular | text | — | Máscara celular |
| `email` | E-mail | email | — | |
| `contatos` | Contatos | textarea | — | Campo livre para anotação de contatos |
| `idsituacaocliente` | Situação | select | ✅ | Lookup: `situacaocliente`. Controla obrigatoriedade do CNPJ/CPF |
| `idcontacaixa` | Conta Caixa | select | ✅ | Lookup FK |
| `idmunicipio` | Município | select | — | Lookup: tabela `municipio` |

### 3.4 Aba 2 — Dados Adicionais

> ⚠️ **Esta aba é oculta quando `varIdTenacidade > 1`** — ou seja, é visível apenas para o tenant principal (administrador do sistema).

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `chaveacesso` | Chave de Acesso | text | — | UUID gerado automaticamente no insert (ver regra #1) |
| `dataexpiracao` | Data Expiração | date | — | Protegida contra redução se cliente devedor (ver regra #2) |
| `qtdlicenca` | Qtd. Licenças | number | — | |
| `clientepublico` | Cliente Público | select S/N | — | Controla regra de proteção de data expiração |
| `idtipocliente` | Tipo | select | — | Lookup: `tipocliente` — nullable |
| `idclientecanal` | Canal | select | — | Lookup: `clientecanal` — nullable |
| `idconcorrente` | Concorrente | select | — | Lookup: nullable |
| `homepage` | Site / Homepage | text | — | |
| `emiteboleto` | Emite Boleto | select S/N | — | |

**Botões condicionais desta aba** (visíveis apenas quando `varIdTenacidade = 1`):

| Botão | Visível quando |
|---|---|
| `GerarChave` | `IdTenacidade = 1` AND `idsituacaocliente = 1` AND `chaveacesso` vazia ou < 5 chars |
| `DownloadLicenca` | `IdTenacidade = 1` AND `idsituacaocliente = 1` AND `chaveacesso` preenchida (> 5 chars) |

### 3.5 Aba 3 — Documentos

Labels mudam conforme `tipopessoa`:

| Campo | Label (J — Jurídica) | Label (F — Física) | Tipo | Obrig. |
|---|---|---|---|---|
| `cnpj` | **CNPJ \*** | **CPF \*** | text | ✅ quando `idsituacaocliente ≠ 3` |
| `inscricaoestadual` | Inscrição Estadual | Carteira de Identidade | text | — |
| `inscricaomunicipal` | Inscrição Municipal | Matrícula | text | — |

> Quando `idsituacaocliente = 3`, o campo CNPJ/CPF fica sem asterisco (não obrigatório).

### 3.6 Aba 4 — Endereço

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `cep` | CEP | text | Máscara CEP |
| `tipologradouro` | Tipo Logradouro | text | Ex: Rua, Av, etc. |
| `logradouro` | Logradouro | text | |
| `numero` | Número | text | |
| `complemento` | Complemento | text | |
| `bairro` | Bairro | text | |
| `cidade` | Cidade | text | |
| `estado` | Estado | select/text | Sigla UF |
| `idregiaoestadual` | Região Estadual | select | Lookup — nullable |

> A aplicação original possui um botão/integração de **busca por CEP** (`SC_cep_log.php`) — deve ser implementado via ViaCEP ou similar no novo sistema.

### 3.7 Aba 5 — Observações

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `observacoes` | Observações | textarea | 15 linhas × 95 colunas no original |

---

## 4. Regras de Negócio

### RN-01 — Geração automática de Chave de Acesso (Insert)
**Evento:** `onBeforeInsert`  
**Condição:** `varIdTenacidade = 1` AND `idsituacaocliente = 1`  
**Ação:** Gera UUID v4 e atribui ao campo `chaveacesso`

```typescript
// NestJS service
if (tenacidadeId === 1 && dto.idsituacaocliente === 1) {
  data.chaveacesso = crypto.randomUUID();
}
```

### RN-02 — Proteção de data de expiração para cliente devedor (Update)
**Evento:** `onBeforeUpdate`  
**Condição:** `varIdTenacidade = 1` AND `clientepublico ≠ 'S'`  
**Lógica:**
1. Verifica se o cliente possui lançamentos de receita **vencidos** (`DataPrevisao < NOW()`) com situação em `(238, 1, 73, 2)` na tabela `lancamentoreceita`
2. Se tiver lançamentos vencidos **E** a nova `dataexpiracao` for **anterior** à data atual de expiração salva na sessão:
   - Reverte `dataexpiracao` para o valor anterior
   - Exibe erro: **"Alteração da data de expiração não permitida. Cliente devedor."**

```typescript
// Pseudo-código NestJS
const devedorQuery = await prisma.lancamentoreceita.count({
  where: {
    IdCliente: id,
    IdTenacidade: 1,
    IdSituacaoDocumento: { in: [238, 1, 73, 2] },
    DataPrevisao: { lt: new Date() },
  },
});

if (devedorQuery > 0) {
  const diasDif = differenceInDays(novaDataExpiracao, dataAtualExpiracao);
  if (diasDif < 0) {
    throw new BusinessException('Alteração da data de expiração não permitida. Cliente devedor.');
  }
}
```

### RN-03 — Botões Novo e Excluir condicionais
**Condição:** Ao abrir registro, se `varCliente_TemExclusao ≠ 'S'`, os botões **Novo** e **Excluir** são ocultados.  
No novo sistema: verificar permissão de exclusão via flag no registro ou RBAC.

### RN-04 — Labels dinâmicos por tipo de pessoa
**Disparo:** a cada mudança no campo `tipopessoa` (onChange)

| Campo | Pessoa Jurídica (J) | Pessoa Física (F) |
|---|---|---|
| `razaosocial` | Razão Social | Nome |
| `nomefantasia` | Nome Fantasia | Nome Social |
| `cnpj` | CNPJ | CPF |
| `inscricaoestadual` | Inscrição Estadual | Carteira de Identidade |
| `inscricaomunicipal` | Inscrição Municipal | Matrícula |

### RN-05 — Visibilidade de campos por tipo de pessoa
- `sexo`: **visível somente para PF**
- `datanascimento`: **visível somente para PF**

### RN-06 — Aba "Dados Adicionais" somente para tenant principal
- A aba 2 completa (incluindo chave de acesso, licença, canal, concorrente) só é exibida quando `varIdTenacidade = 1`.
- Para outros tenants (`varIdTenacidade > 1`), esta aba não aparece no formulário.

### RN-07 — CNPJ/CPF obrigatório por situação
- Se `idsituacaocliente = 3`, o campo CNPJ/CPF é **opcional**.
- Para qualquer outra situação, o campo é **obrigatório**.

### RN-08 — Campos nullable (gravar NULL)
Os seguintes campos devem gravar `NULL` quando enviados vazios (não string vazia):
`idclientepai`, `idconcorrente`, `idtipocliente`, `idregiaoestadual`, `idclientecanal`

### RN-09 — Campos de auditoria (somente leitura)
Os seguintes campos são gerenciados pelo sistema e nunca editáveis pelo usuário:
- `idtenacidade` — vem da sessão/token
- `idusuarioauditoria` — ID do usuário logado
- `enderecoipauditoria` — IP do request
- `nomeaplicacaoauditoria` — nome da aplicação

---

## 5. Campos Internos / Legado (não exibir no frontend)

| Campo | Motivo |
|---|---|
| `idtenacidade` | Injetado automaticamente (multi-tenant) |
| `idusuarioauditoria` | Auditoria — vem do JWT |
| `enderecoipauditoria` | Auditoria — vem do request |
| `nomeaplicacaoauditoria` | Auditoria — nome fixo da app |
| `numeroantigo` | Código legado (migração) — exibir apenas se não nulo, readonly |
| `idclienteinfolab` | ID no sistema Infolab — legado — readonly |
| `certificadoregistro` | Campo de certificado — aba Documentos, exibir se necessário |
| `dataemissaocr` | Data emissão certificado de registro |
| `datavalidadecr` | Data validade certificado de registro |
| `idclientepai` | Cliente pai (para unidades/filiais) — gerenciado via sub-aplicação |

---

## 6. Lookups / Foreign Keys

| Campo | Tabela | Colunas exibidas | Label no form |
|---|---|---|---|
| `idsituacaocliente` | `situacaocliente` | `Descricao` | Situação |
| `idcontacaixa` | `contacaixa` | — | Conta Caixa |
| `idmunicipio` | `municipio` | — | Município |
| `idtipocliente` | `tipocliente` | `Descricao` | Tipo |
| `idclientecanal` | `clientecanal` | `Descricao` | Canal |
| `idconcorrente` | `concorrente` | — | Concorrente |
| `idregiaoestadual` | `regiaoestadual` | — | Região Estadual |

---

## 7. Checklist de Implementação

### Cliente_Lst (ClienteList)
- [ ] Query com join para resolver lookup de `IdSituacaoCliente` e `IdTipoCliente`
- [ ] Coluna calculada `Unidades` (subquery count de filhos)
- [ ] Filtro obrigatório por `idTenacidade` no middleware
- [ ] Filtros de pesquisa: nomefantasia, tipo, situação, cnpj, cidade, estado, telefone, celular, email
- [ ] Botão "Emails" (ação em lote — a definir escopo)
- [ ] Ordenação multi-coluna
- [ ] Paginação server-side

### Cliente_Frm (ClienteForm)
- [ ] Cabeçalho fixo: `tipopessoa` (radio) + `razaosocial` + `idcliente`
- [ ] 5 abas: Características · Dados Adicionais · Documentos · Endereço · Observações
- [ ] Lógica de labels dinâmicos ao mudar `tipopessoa` (RN-04)
- [ ] Show/hide de `sexo` e `datanascimento` por `tipopessoa` (RN-05)
- [ ] Aba "Dados Adicionais" condicional por `tenancyId` (RN-06)
- [ ] Botões `GerarChave` / `DownloadLicenca` condicionais (seção 3.4)
- [ ] RN-01: Gerar UUID no insert quando `tenancyId = 1` e `situacao = 1`
- [ ] RN-02: Validar data expiração contra inadimplência no update
- [ ] RN-07: Validação CNPJ/CPF obrigatório por situação (Zod condicional)
- [ ] RN-08: Enviar `null` para campos FK opcionais quando vazios
- [ ] Integração CEP (ViaCEP) ao preencher campo CEP
- [ ] Campos de auditoria injetados no service (nunca no DTO de entrada)
