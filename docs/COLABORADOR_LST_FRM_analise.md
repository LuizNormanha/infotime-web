# Análise: Colaborador_Lst e Colaborador_Frm — Migração Scriptcase → Infotime Web

> Fonte: `LIGA_InfoTIME_apps.zip` — pastas `Colaborador_Lst/` e `Colaborador_Frm/`  
> Analisado em: 08/05/2026  
> Stack alvo: React · PrimeReact · Node.js · Prisma · PostgreSQL  
> Padrões: `PADRAO_LISTAS.md` · `PADRAO_FORMULARIOS.md` · `PADRAO_MIGRACAO_INFOTIME.md`

---

## 1. Visão Geral

| App Scriptcase | Equivalente novo | Tabela principal |
|---|---|---|
| `Colaborador_Lst` | `ColaboradorList` | `colaborador` |
| `Colaborador_Frm` | `ColaboradorForm` | `colaborador` |

**Multi-tenant:** filtro `WHERE IdTenacidade = :tenantId` obrigatório em todas as queries — injetado automaticamente pelo middleware de tenant.

**Ecossistema:** O módulo Colaborador é o mais vasto do sistema — foram identificadas **+50 sub-aplicações** (férias, folha de ponto, viagens, atestados, avaliações, contracheque, documentos etc.). Este documento cobre apenas `Colaborador_Lst` e `Colaborador_Frm` — o cadastro central. As sub-aplicações são tratadas separadamente.

---

## 2. Colaborador_Lst — Listagem

### 2.1 SQL Principal

```sql
SELECT
  Sexo,
  Cpf,
  DataNascimento,
  Email,
  DataAdmissao,
  IdCargoClassificacaoNivel,
  IdSituacaoColaborador,
  IdColaborador,
  Nome,
  Celular
FROM colaborador
WHERE IdTenacidade = :tenantId
```

**Ordenação padrão:** `Nome ASC` (não definida explicitamente no Scriptcase — cai na ordenação natural, que é `Nome`)

### 2.2 Colunas da Grid

| # | Campo DB | Label | Ordenável |
|---|---|---|---|
| 1 | `Nome` | Nome | ✅ |
| 2 | `Cpf` | CPF | ✅ |
| 3 | `DataNascimento` | Data de nascimento | ✅ |
| 4 | `Email` | E-mail | ✅ |
| 5 | `DataAdmissao` | Data de admissão | ✅ |
| 6 | `IdCargoClassificacaoNivel` | Cargo | ✅ (lookup via view) |
| 7 | `IdSituacaoColaborador` | Situação | ✅ (lookup) |
| 8 | `Celular` | Celular | ✅ |
| 9 | `Sexo` | Sexo | ✅ |
| 10 | `IdColaborador` | Código | ✅ |

> **Nota:** `IdCargoClassificacaoNivel` é resolvido via `cargoclassificacaonivel_view` — uma VIEW que já agrega a hierarquia de cargo + classificação + nível numa única linha de descrição.

### 2.3 Busca Rápida (Quick Search)

A listagem tem uma **busca rápida** inline (ícone de lupa na toolbar) que pesquisa em **todos os campos visíveis** simultaneamente (`SC_all_Cmp`). É um LIKE `%termo%` aplicado a todos os campos de texto da query.

No frontend, implementar como campo de texto simples `?search=` que faz LIKE em:
```sql
Nome ILIKE '%:q%' OR Cpf ILIKE '%:q%' OR Email ILIKE '%:q%' OR Celular ILIKE '%:q%'
```

### 2.4 Filtro Avançado (Pesquisa)

O filtro avançado tem apenas **1 campo** configurado:

| Campo | Label | Tipo | Operação |
|---|---|---|---|
| `idcolaborador` | Id. | número | `IdColaborador = :valor` |

> **Diferença crítica dos outros módulos:** Fornecedor tem 7 filtros, Cliente tem 9, Contas a Receber tem 16. Colaborador tem **apenas a busca rápida + filtro por ID**. Para o novo sistema, recomenda-se ampliar os filtros avançados (ver seção de Checklist).

### 2.5 Botões Extras da Toolbar

| Botão | Label | Ação |
|---|---|---|
| `Emails` | **Enviar e-mails** | Dispara e-mail em lote para os colaboradores selecionados — navega para `Colaborador_EnviarEmail_Lst` |
| Exportar | CSV · Excel · PDF · XML · Word | Exportação dos dados da grid |

> Não há botões de "Autorizações" nem "Baixa automática" neste módulo — são exclusivos dos módulos financeiros.

---

## 3. Colaborador_Frm — Formulário

### 3.1 Estrutura Geral (Abas)

O formulário tem **1 cabeçalho fixo** (Bloco 0) + **9 abas** numeradas de 1 a 9.

```
┌──────────────────────────────────────────────────────────────────┐
│  CABEÇALHO (sempre visível)                                      │
│  Tipo Colaborador*   Situação*   Login   Nome*   Apelido   Código│
└──────────────────────────────────────────────────────────────────┘
TabView
┌───────┬──────────┬────────────┬────────────┬──────────┬──────────┐
│ Foto  │ Dados    │ Documentos │ Trabalho   │ Salário  │ Banco    │
├───────┴──────────┴────────────┴────────────┴──────────┴──────────┤
│ Endereço │ Documentos Digitais │ Adm (tenant=1) │ Observações   │
└──────────┴────────────────────┴────────────────┴────────────────┘
```

### 3.2 Bloco 0 — Cabeçalho (sempre visível)

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `nome` | Nome | `TextField` | ✅ | Nome completo do colaborador |
| `apelido` | Apelido | `TextField` | — | Como é conhecido internamente |
| `idtipocolaborador` | Tipo | `SelectField` | ✅ | Lookup: `tipocolaborador` WHERE IdTenacidade ORDER BY Descricao. **Controla se data de admissão CLT é obrigatória** |
| `idsituacaocolaborador` | Situação | `SelectField` | ✅ | Lookup: `situacaocolaborador` WHERE IdTenacidade ORDER BY Descricao |
| `login` | Login | `TextField` | — | Login para acesso ao sistema (portal mobile) |
| `idcolaborador` | Código | `TextField` readonly | — | PK autoincrement |

### 3.3 Aba 1 — Foto

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `fotografia` | Foto | Readonly HTML | Campo calculado — exibe `<img>` renderizada em base64 a partir do campo `foto` (BLOB). **Aba oculta automaticamente quando colaborador não tem foto cadastrada** (ver RN-02) |

> **Nota de implementação:** o campo original `foto` é armazenado como BLOB no banco. No novo sistema, migrar para upload de arquivo com storage externo conforme `PADRAO_UPLOAD_ARQUIVOS.md`. O campo `fotografia` é apenas o HTML de exibição calculado no onLoad.

### 3.4 Aba 2 — Dados

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `sexo` | Sexo | `SelectField` | — | Valores: M / F |
| `email` | E-mail | `EmailField` | — | |
| `contatos` | Contatos | `TextareaField` | — | Campo livre para anotações de contatos |
| `senha` | Senha | `PasswordField` | — | Senha de acesso ao portal/sistema. Gravada como MD5 (ver RN-01). Exibir apenas no novo cadastro |
| `idempresa` | Empresa | `SelectField` | — | Lookup: tabela `empresa` WHERE IdTenacidade AND Ativo='S' |
| `implanta` | Implanta | `TextField` | — | **Visível somente quando `tenantId > 1`** (ver RN-03). Campo de controle de implantação do cliente |
| `liderimplantacao` | Líder implantação | `TextField` | — | **Visível somente quando `tenantId > 1`** |
| `consultorimplantacao` | Consultor implantação | `TextField` | — | **Visível somente quando `tenantId > 1`** |

### 3.5 Aba 3 — Documentos

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `cpf` | CPF | `TextField` | — | Máscara CPF. Usado para lookup em contas a receber/pagar |
| `carteiraidentidade` | Carteira de identidade | `TextField` | — | RG |
| `carteiratrabalho` | Carteira de trabalho | `TextField` | — | Número da CTPS |
| `numeropis` | PIS/PASEP | `TextField` | — | |

### 3.6 Aba 4 — Trabalho

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `idcargoclassificacaonivel` | Cargo | `AsyncSelectField` | — | Lookup: `cargoclassificacaonivel_view` WHERE IdTenacidade ORDER BY Descricao — view que agrega cargo + classificação + nível |
| `dataadmissao` | Data de admissão | `DateField` | ✅ condicional | **Obrigatório quando tipo colaborador tem `ExigeDataClt = 'S'`** (ver RN-04) |
| `datademissao` | Data de demissão | `DateField` | — | |
| `dataestagio` | Data início estágio | `DateField` | — | |
| `datanascimento` | Data de nascimento | `DateField` | — | |
| `regimetrabalho` | Regime de trabalho | `SelectField` | — | CLT / PJ / Estágio / Autônomo etc. |
| `horatrabalhoentrada` | Entrada | `TimeField` | — | Horário de entrada no trabalho |
| `horatrabalhosaida` | Saída | `TimeField` | — | Horário de saída |
| `horaalmocoinicio` | Almoço início | `TimeField` | — | |
| `horaalmocofim` | Almoço fim | `TimeField` | — | |
| `trabalhasabado` | Trabalha sábado | `CheckboxField` | — | S/N |
| `trabalhadomingo` | Trabalha domingo | `CheckboxField` | — | S/N |

### 3.7 Aba 5 — Salário

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `salario` | Salário | `CurrencyField` | — | Salário base mensal |
| `comissao` | Comissão | `CurrencyField` | — | Valor fixo ou percentual de comissão |
| `insalubridade` | Insalubridade | `CurrencyField` | — | Adicional de insalubridade |
| `valealimentacao` | Vale alimentação | `CurrencyField` | — | Valor mensal do VA |
| `valetransporte` | Vale transporte | `CurrencyField` | — | Valor mensal do VT |

> **Atenção:** a aba de Salário exibe valores sensíveis. Controlar visibilidade por permissão RBAC — nem todos os usuários devem ver salário.

### 3.8 Aba 6 — Banco

| Campo | Label | Tipo | Obrig. | Observação |
|---|---|---|---|---|
| `idbanco` | Banco | `SelectField` | — | Lookup: `banco` WHERE IdTenacidade ORDER BY Nome |
| `idagencia` | Agência | `SelectField` | — | Lookup: `agencia` WHERE IdTenacidade, exibe `Codigo / Nome` concatenados. **Pode ser dependente do banco selecionado** |
| `numeroconta` | Número da conta | `TextField` | — | Número da conta bancária para depósito do salário |

### 3.9 Aba 7 — Endereço

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `cep` | CEP | `TextField` | Máscara CEP — integração ViaCEP |
| `tipologradouro` | Tipo logradouro | `TextField` | Ex: Rua, Av, Travessa |
| `logradouro` | Logradouro | `TextField` | |
| `numero` | Número | `TextField` | |
| `complemento` | Complemento | `TextField` | |
| `bairro` | Bairro | `TextField` | |
| `cidade` | Cidade | `TextField` | |
| `estado` | Estado | `TextField` | Sigla UF |
| `endereco` | Endereço (legado) | `TextField` | Campo legado — exibido somente quando os campos estruturados (`numero`, `bairro`, `cidade`, `estado`) estão vazios. Serve para exibir endereços antigos migrados em formato livre. Oculto quando endereço estruturado existe (ver RN-05) |
| `telefone` | Telefone | `TextField` | Máscara telefone |
| `celular` | Celular | `TextField` | Máscara celular |
| `pix` | Chave PIX | `TextField` | Chave PIX pessoal do colaborador para reembolsos/adiantamentos |

### 3.10 Aba 8 — Documentos Digitais

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `listapopdocumento` | Documentos | Subgrid embed | Sub-aplicação `ColaboradorDocumento_Lst` — lista de documentos digitalizados do colaborador (CNH, CTPS digitalizada, diplomas etc.) |

> Esta aba funciona como um mini-gerenciador de arquivos vinculado ao colaborador.

### 3.11 Aba 9 — Administrativo (tenant = 1 somente)

> ⚠️ **Esta aba é oculta quando `tenantId > 1`** — só visível para o tenant principal (Infolab/administrador do sistema).

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `idtenacidade` | Tenant | readonly | FK para tenacidade |
| `idusuarioauditoria` | Usuário auditoria | readonly | Auditoria |

### 3.12 Aba de Observações (Bloco 9)

| Campo | Label | Tipo | Observação |
|---|---|---|---|
| `observacoes` | Observações | `TextareaField` | Campo livre de anotações sobre o colaborador |

---

## 4. Regras de Negócio

### RN-01 — Senha gravada como MD5 (onBeforeInsert e onBeforeUpdate)

**Evento:** `onBeforeInsert` e `onBeforeUpdate`  
**Condição:** `strlen(senha) > 1` (senha preenchida)  
**Ação:** Aplica MD5 antes de gravar

```typescript
// NestJS service — antes de inserir ou atualizar
if (dto.senha && dto.senha.length > 1) {
  data.senha = createHash('md5').update(dto.senha).digest('hex');
}
```

> ⚠️ **Alerta de segurança:** MD5 é considerado inseguro para senhas em 2026. Na migração, avaliar upgrade para bcrypt (custo 12) para novos cadastros, mantendo compatibilidade com registros legados MD5 existentes. Estratégia recomendada: ao fazer login com senha legada MD5, re-hash automático para bcrypt e atualizar no banco.

> **Quando exibir o campo senha:** só no formulário de criação (novo) e numa seção separada de "Alterar senha". Nunca exibir o hash gravado.

### RN-02 — Aba de foto oculta quando não há foto (onLoad)

**Evento:** `onLoad`  
**Condição:** campo `foto` vazio ou nulo  
**Ação:** oculta o bloco 1 (aba Foto)

```typescript
// Frontend — ao receber o colaborador
const temFoto = !!colaborador.foto;
// tabs[1].visible = temFoto
```

### RN-03 — Campos de implantação visíveis somente para tenants secundários (onLoad)

**Evento:** `onLoad`  
**Condição:** `tenantId > 1` → **ocultar** os campos `implanta`, `liderimplantacao`, `consultorimplantacao`  
**Lógica:** esses campos são para colaboradores do próprio cliente (laboratório) — não fazem sentido para o tenant principal (Infolab)

```typescript
// Frontend
const isClienteTenant = tenantId > 1;
// campos implanta/lider/consultor: visible = !isClienteTenant
```

> **Contraintuitivo:** ao contrário da aba "Dados Adicionais" do Cliente (que é visível SOMENTE para tenant=1), aqui é o inverso — campos visíveis para tenant > 1.

### RN-04 — Data de admissão CLT obrigatória por tipo de colaborador (onValidate)

**Evento:** `onValidate`  
**Lógica:**
1. Busca na tabela `tipocolaborador` o campo `ExigeDataClt` para o `IdTipoColaborador` selecionado
2. Se `ExigeDataClt = 'S'` e `dataadmissao` está vazio: **bloqueia** com mensagem: *"Atenção: data de admissão CLT obrigatória para esse tipo de funcionário!"*

```typescript
// NestJS service — na validação de entrada
if (dto.idtipocolaborador) {
  const tipo = await prisma.tipocolaborador.findFirst({
    where: { IdTipoColaborador: dto.idtipocolaborador, IdTenacidade: tenantId },
    select: { ExigeDataClt: true },
  });
  if (tipo?.ExigeDataClt === 'S' && !dto.dataadmissao) {
    throw new BusinessException(
      'Atenção: data de admissão CLT obrigatória para esse tipo de funcionário!'
    );
  }
}
```

**Frontend — Zod refinement:**
```typescript
.superRefine((data, ctx) => {
  // A validação de ExigeDataClt requer consulta ao backend
  // Implementar via validação assíncrona ou server-side somente
})
```

### RN-05 — Endereço legado vs. estruturado (onLoad)

**Evento:** `onLoad`  
**Lógica:** se `numero`, `bairro`, `cidade` e `estado` estão todos vazios, exibir o campo legado `endereco` (endereço livre antigo). Caso contrário, ocultar `endereco` e usar os campos estruturados.

```typescript
// Frontend — ao carregar o colaborador
const usaEnderecoLegado = !colaborador.numero && !colaborador.bairro
  && !colaborador.cidade && !colaborador.estado;
// campo endereco: visible = usaEnderecoLegado
// campos logradouro/numero/bairro/cidade/estado: visible = !usaEnderecoLegado
```

### RN-06 — Aba Administrativo oculta para tenants secundários (onLoad)

**Evento:** `onLoad`  
**Condição:** `tenantId != 1` → oculta o Bloco 8 (aba Administrativo)

```typescript
// Frontend
const showAdminTab = tenantId === 1;
```

### RN-07 — Bloqueio de exclusão quando há dependências (Dependency)

**Evento:** `Dependency` (ao tentar excluir)  
**Lógica:** verifica se existem registros vinculados nas tabelas filhas. Se houver qualquer registro em qualquer tabela filha, **bloqueia a exclusão** com a mensagem de erro do sistema (`lang_errm_dele_rhcr`).

Tabelas verificadas antes de permitir a exclusão:

| Tabela filha | Descrição |
|---|---|
| `colaboradortarifa` | Tarifas/tabelas de preços do colaborador |
| `colaboradortelefone` | Telefones adicionais cadastrados |

```typescript
// NestJS service — onBeforeDelete
async checkDependencies(id: number): Promise<void> {
  const [tarifa, telefone] = await Promise.all([
    prisma.colaboradortarifa.count({ where: { IdColaborador: id } }),
    prisma.colaboradortelefone.count({ where: { IdColaborador: id } }),
  ]);

  if (tarifa > 0 || telefone > 0) {
    throw new BusinessException(
      'Não é possível excluir o colaborador pois existem registros vinculados.'
    );
  }
}
```

> **Nota:** as sub-aplicações de férias, folha de ponto, atestados, viagens etc. também criam dependências — mas não foram verificadas no evento `Dependency` original (provavelmente tratadas via FK no banco com `ON DELETE RESTRICT`). Na implementação, revisar todas as FKs de `colaborador` no schema e aplicar a mesma lógica de verificação prévia ou confiar nas constraints do banco.

---

## 5. Lookups Completos

| Campo | Tabela / View | Filtro | Exibição |
|---|---|---|---|
| `idtipocolaborador` | `tipocolaborador` | `IdTenacidade = :t` | `Descricao` ORDER BY Descricao |
| `idsituacaocolaborador` | `situacaocolaborador` | `IdTenacidade = :t` | `Descricao` ORDER BY Descricao |
| `idcargoclassificacaonivel` | `cargoclassificacaonivel_view` | `IdTenacidade = :t` | `Descricao` ORDER BY Descricao |
| `idempresa` | `empresa` | `IdTenacidade = :t AND Ativo = 'S'` | `NomeFantasia` |
| `idbanco` | `banco` | `IdTenacidade = :t` | `Nome` ORDER BY Nome |
| `idagencia` | `agencia` | `IdTenacidade = :t` | `CONCAT(Codigo, '/', Nome)` ORDER BY Nome |

> **Sobre `cargoclassificacaonivel_view`:** é uma VIEW que consolida a hierarquia de Cargo → Classificação → Nível em uma única linha descritiva. O frontend não precisa conhecer a hierarquia interna — apenas lista o que a view retorna.

---

## 6. Campos de Auditoria / Sistema (nunca editáveis)

| Campo | Injetado por |
|---|---|
| `idtenacidade` | Middleware de tenant |
| `idusuarioauditoria` | JWT |
| `enderecoipauditoria` | Request IP |
| `nomeaplicacaoauditoria` | Constante no service |
| `foto` | BLOB — gerenciado via upload separado |

---

## 7. Sub-aplicações do Módulo Colaborador

O cadastro principal (`Colaborador_Frm`) é a porta de entrada. A partir dele, navegam-se para sub-módulos de gestão do colaborador. Estas serão analisadas separadamente, mas é importante registrar a existência:

| Sub-aplicação Scriptcase | Módulo | Prioridade |
|---|---|---|
| `ColaboradorFerias_Frm/Lst` | Controle de férias | Alta |
| `ColaboradorFolhaPonto_Frm/Lst` | Folha de ponto | Alta |
| `ColaboradorContraCheque_Frm/Lst` | Contracheque/Holerite | Alta |
| `ColaboradorAtestado_Frm/Lst` | Atestados médicos | Alta |
| `ColaboradorDocumento_Frm/Lst` | Documentos digitais | Média |
| `ColaboradorAvaliacao_Frm/Lst` | Avaliações de desempenho | Média |
| `ColaboradorReajuste_Frm/Lst` | Histórico de reajustes salariais | Média |
| `ColaboradorViagem_Frm/Lst` | Viagens e reembolsos | Média |
| `ColaboradorViagemDespesa_Frm/Lst` | Despesas de viagem | Média |
| `ColaboradorSalarioAdiantamento_Frm/Lst` | Adiantamento de salário | Média |
| `ColaboradorValeAlimentacaoTransporte_Frm` | Vale alimentação/transporte | Média |
| `ColaboradorTarefa_Frm/Lst` | Tarefas do colaborador | Baixa |
| `ColaboradorComunicacao_Frm/Lst` | Comunicações internas | Baixa |
| `ColaboradorMedidaDisciplinar_Frm/Lst` | Medidas disciplinares | Baixa |
| `ColaboradorExame_Frm/Lst` | Exames periódicos de saúde | Baixa |
| `ColaboradorComprovanteRendimento_Frm/Lst` | Comprovantes de rendimento | Baixa |
| `ColaboradorPlanoConta_Gde/Lst` | Planos de conta vinculados | Baixa |
| `Colaborador_Cockpit_Frm` | Dashboard individual do colaborador | Baixa |
| `ColaboradorFeriasDash_Lst` | Dashboard de férias | Baixa |
| `ColaboradorSituacaoDash_Lst` | Dashboard de situação | Baixa |

---

## 8. Diferenças Críticas em Relação a Cliente e Fornecedor

| Aspecto | Cliente | Fornecedor | Colaborador |
|---|---|---|---|
| Nº de abas | 5 | 3 | **9 abas** |
| Campo de senha | Não tem | Não tem | **Sim — MD5** |
| Foto | Não tem | Não tem | **Sim — BLOB** |
| Dados bancários | Não tem | Não tem | **Sim (banco/agência/conta)** |
| Dados trabalhistas | Não tem | Não tem | **Sim (salário, VA, VT, horário)** |
| Documentos pessoais | CPF/CNPJ | CNPJ | **CPF + CTPS + RG + PIS** |
| Campos de implantação | Não tem | Não tem | **Sim (tenant > 1)** |
| Sub-aplicações vinculadas | Poucos | Nenhum | **+18 sub-aplicações** |
| Validação por tipo | Não | Não | **Sim (`ExigeDataClt`)** |
| Bloqueio exclusão | Não | Não | **Sim (dependências)** |
| Chave PIX | Não | Não | **Sim (pessoal do colaborador)** |
| Campo login/senha | Não | Não | **Sim (acesso ao portal)** |
| Campo `endereco` legado | Não | Não | **Sim (compatibilidade migração)** |

---

## 9. Checklist de Implementação

### ColaboradorList
- [ ] Query em `colaborador` com filtro `IdTenacidade = :tenantId`
- [ ] Resolver lookup de `IdCargoClassificacaoNivel` via `cargoclassificacaonivel_view` (JOIN ou include)
- [ ] Resolver lookup de `IdSituacaoColaborador`
- [ ] Busca rápida (`?search=`) com LIKE em `Nome`, `Cpf`, `Email`, `Celular`
- [ ] Filtro avançado por `IdColaborador` (exato)
- [ ] **Ampliar filtros sugeridos para o novo sistema:** Nome, CPF, Tipo, Situação, Cargo, Data de admissão (range), E-mail
- [ ] Botão "Enviar e-mails" → ação em lote
- [ ] Exportação: CSV, Excel, PDF
- [ ] Ordenação multi-coluna com padrão `Nome ASC`
- [ ] Paginação server-side

### ColaboradorForm
- [ ] Usar `FormShell` + `TabView` (9 abas) + `FormFooter` + `ActionsBar`
- [ ] Cabeçalho: `idtipocolaborador`, `idsituacaocolaborador`, `login`, `nome`, `apelido`, `idcolaborador` (readonly)
- [ ] **Aba 1 (Foto):** exibição da foto via base64 ou URL do storage externo. Aba oculta quando sem foto (RN-02). Upload de foto separado
- [ ] **Aba 2 (Dados):** campos básicos + senha (apenas na criação ou alterar senha separado) + campos de implantação condicionais (RN-03)
- [ ] **Aba 3 (Documentos):** CPF, RG, CTPS, PIS
- [ ] **Aba 4 (Trabalho):** cargo, datas, horários, regime, dias de trabalho. RN-04: data admissão obrigatória por tipo
- [ ] **Aba 5 (Salário):** campos financeiros com controle RBAC de visibilidade (não exibir salário para todos)
- [ ] **Aba 6 (Banco):** banco → agência → conta. Considerar cascade no lookup de agência por banco
- [ ] **Aba 7 (Endereço):** CEP (ViaCEP), estruturado vs. legado (RN-05), PIX pessoal
- [ ] **Aba 8 (Documentos Digitais):** subgrid de `ColaboradorDocumento`
- [ ] **Aba 9 (Observações):** textarea livre
- [ ] Aba Administrativo (tenant=1): oculta para tenants secundários (RN-06)
- [ ] RN-01: hash da senha (avaliar bcrypt vs MD5 legado)
- [ ] RN-04: validação `ExigeDataClt` por tipo de colaborador (query ao backend)
- [ ] RN-05: campo `endereco` legado vs. campos estruturados
- [ ] RN-07: verificar dependências antes de excluir (`colaboradortarifa`, `colaboradortelefone` + revisar FKs)
- [ ] Lookups: `tipocolaborador`, `situacaocolaborador`, `cargoclassificacaonivel_view`, `empresa`, `banco`, `agencia`
- [ ] Campos de auditoria injetados no service (nunca no DTO)
- [ ] Migração da foto: BLOB → storage externo com URL
