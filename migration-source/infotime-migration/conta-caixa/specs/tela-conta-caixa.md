
# Tela: Conta Caixa

## 1. Nome da Tela
**Lista:** "Consulta Conta Caixa" | **Formulário:** "Inclusão Conta Caixa"
Módulo: **Financeiro** → Gerenciador Financeiro

---

## 2. Objetivo da Tela
Cadastro das contas bancárias e caixas internos da empresa. Controla saldo inicial, abertura automática/manual, fechamento de caixa, e quais usuários podem operar cada conta.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Banco | text |
| 3 | Agência | text |
| 4 | Número Conta | text |
| 5 | Tipo | text |
| 6 | Empresa | text |
| 7 | Entra Extrato | badge |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Descrição | text | Sim | |
| Empresa | select | Sim | "Escolha a Empresa" |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Default/Observação |
|---|---|---|---|
| Banco | select | — | "Escolha o banco" |
| Agência | select | — | Dependente do banco selecionado |
| Número da Conta | text | — | |
| Data da Abertura | date + calendário | Sim | |
| Data Início Caixa | date + calendário | Sim | Data de início do controle de saldo |
| Saldo Início Caixa | decimal + calculadora | Sim | Saldo inicial do período |
| Tipo da Conta | radio: Banco / Interna | Sim | Banco=conta bancária, Interna=caixa físico |
| Tipo da Abertura | radio: Automática / Manual | Sim | |
| Tipo do Fechamento | radio: Automático / Manual | Sim | |
| Entra no extrato | radio: Sim / Não | Sim | Se aparece no extrato consolidado |

### Aba: Usuários que acessam
_(List box de usuários autorizados a operar esta conta)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| [Gestão] | Menu de gestão da conta (registros, extrato, fechamento) |

---

## 6. Filtros e Busca
- Busca rápida por descrição
- Filtros: Empresa, Tipo da Conta

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Banco, agência, conta, datas, saldo, tipo |
| 2 | **Usuários que acessam** | Controle de acesso por usuário |

---

## 8. Campos Obrigatórios Aparentes
- Descrição
- Empresa
- Data da Abertura
- Data Início Caixa
- Saldo Início Caixa
- Tipo da Conta
- Tipo da Abertura
- Tipo do Fechamento
- Entra no extrato

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Data da Abertura | `DD/MM/YYYY` + calendário |
| Data Início Caixa | `DD/MM/YYYY` + calendário |
| Saldo Início Caixa | R$ decimal + ícone calculadora |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `conta_caixa` → `banco` | N:1 |
| `conta_caixa` → `agencia` | N:1 |
| `conta_caixa` → `empresa` | N:1 |
| `conta_caixa` → `conta_caixa_usuario` | 1:N |
| `conta_caixa` → `conta_caixa_registro` | 1:N |
| `conta_caixa` → `lancamento_receita` | 1:N |
| `conta_caixa` → `lancamento_despesa` | 1:N |
| `conta_caixa_transferencia` → `conta_caixa` × 2 | N:1 origem + N:1 destino |

---

## 11. Comportamentos a Confirmar
- [ ] "Tipo da Conta: Interna" — não usa banco/agência?
- [ ] Agência: dropdown dependente do banco (carregado via Ajax)?
- [ ] Saldo Início Caixa: impacta no cálculo do saldo atual?
- [ ] "Tipo da Abertura: Automática" — abre automaticamente na data início?
- [ ] Aba "Usuários que acessam": restrição real (esconde da lista) ou apenas registro?
- [ ] "Entra no extrato = Não" — exclui da tela ExtratoMensal_Lst?

---

## 12. Dúvidas Abertas
- "Data Abertura" vs "Data Início Caixa": qual é a diferença?
- Agência pode ser "CAIXA INTERNO" (sem banco real)?
- O tipo "Interna" permite transferências entre contas?
- Fechamento automático: acontece à meia-noite ou por ação do usuário?
