
# Tela: Lançamento de Despesa (Contas a Pagar)

## 1. Nome da Tela
**Lista:** "Consulta Contas a Pagar" | **Formulário:** "Inclusão Conta a Pagar (Despesa)"
Módulo: **Financeiro**

---

## 2. Objetivo da Tela
Gerenciamento de contas a pagar com workflow de 5 estágios: previsão → agendamento → realização → baixa. Suporta parcelamento, recorrência, rateio entre empresas e vínculo com compras do almoxarifado.

---

## 3. Campos Visíveis na Lista
_(Breadcrumb: "Contas a Pagar (...)")_
| # | Coluna | Tipo |
|---|---|---|
| 1 | Fornecedor/Agente | text |
| 2 | Empresa | text |
| 3 | Plano de Conta | text |
| 4 | Situação | badge |
| 5 | Previsto para | date |
| 6 | Valor Previsto Bruto | decimal R$ |
| 7 | Valor Previsto Líquido | decimal R$ |
| 8 | Realizado em | date |
| 9 | Valor Realizado | decimal R$ |
| 10 | Parcela / Qtd | text |
| 11 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Agente | radio: Cliente / Colaborador / Fornecedor | Sim | Default: Fornecedor |
| Fornecedor (Nome Fantasia - CNPJ / CPF) | autocomplete | Sim | Muda conforme Agente |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa | select | Sim | "Escolha a empresa" |
| Plano de Contas | select | Sim | "Escolha o Plano de Contas" |
| Valor previsto bruto | decimal + calculadora | Sim | |
| Valor previsto líquido | decimal + calculadora | Sim | |
| Previsto para | date + calendário | Sim | |
| Previsto por | text readonly | Sim | Auto: usuário logado (ex: "LUIZ ANTÔNIO NORMANHA NOVAES") |
| Situação | select | Sim | Default: "Pendente" |
| Competência | month/year | — | Auto: mês corrente (ex: "04/2026") |
| Conta Contábil | text | — | |
| Histórico | text | — | |

### Aba: Pagamento
_(Data realização, valor realizado, conta caixa, espécie, número documento, rateio)_

### Aba: Auditoria
_(Log de alterações)_

### Aba: Arquivos
_(Upload: boleto, nota fiscal, comprovante, anexo)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| Ações ▾ | Parcelar, recorrência, planejamento, relatório, etc. |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Filtros: Situação, Empresa, Fornecedor, Plano de Conta, Período, Competência

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Empresa, plano, valores, datas, situação, histórico |
| 2 | **Pagamento** | Baixa: data, valor real, conta, espécie |
| 3 | **Auditoria** | Log de alterações |
| 4 | **Arquivos** | Upload de documentos |

---

## 8. Campos Obrigatórios Aparentes
- Agente (radio)
- Fornecedor/Agente (autocomplete)
- Empresa
- Plano de Contas
- Valor previsto bruto
- Valor previsto líquido
- Previsto para
- Previsto por
- Situação

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Valor previsto bruto/líquido | R$ decimal + calculadora |
| Previsto para | `DD/MM/YYYY` + calendário |
| Competência | `MM/YYYY` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `lancamento_despesa` → `fornecedor` / `colaborador` / `cliente` | N:1 |
| `lancamento_despesa` → `empresa` | N:1 |
| `lancamento_despesa` → `plano_conta` | N:1 |
| `lancamento_despesa` → `conta_caixa` | N:1 |
| `lancamento_despesa` → `situacao_documento` | N:1 |
| `lancamento_despesa` → `lancamento_despesa` (pai) | N:1 (parcelas) |
| `lancamento_despesa` → `lancamento_despesa_rateio` | 1:N |
| `lancamento_despesa` → `almoxarifado_entrada` | N:1 |
| `lancamento_despesa.id_usuario_*` | Workflow 5 usuários |

---

## 11. Comportamentos a Confirmar
- [ ] Workflow: os 5 campos de usuário (inclusão, previsão, agendamento, realização, baixa) são preenchidos automaticamente?
- [ ] "Valor previsto bruto" vs "líquido": qual é a diferença (imposto? desconto?)?
- [ ] "Previsto por": auto-preenche com usuário logado — pode ser alterado?
- [ ] Rateio: disponível na aba Pagamento ou como ação separada?
- [ ] Parcelamento: acionado via "Ações ▾"?
- [ ] Vínculo almoxarifado: ao criar via almoxarifado, campos são pré-preenchidos?

---

## 12. Dúvidas Abertas
- Qual é a diferença prática entre "Valor bruto" e "Valor líquido" para despesas?
- O campo "Conta Contábil" é diferente de "Plano de Contas"?
- "Previsto por" pode ser diferente do usuário que fez a inclusão?
- Existe fechamento mensal que bloqueia edição de despesas?
