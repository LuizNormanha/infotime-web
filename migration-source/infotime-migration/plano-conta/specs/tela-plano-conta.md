
# Tela: Plano de Contas

## 1. Nome da Tela
**Lista:** "Consulta Plano de Contas" | **Formulário:** "Inclusão Plano de conta"
Módulo: **Financeiro**

---

## 2. Objetivo da Tela
Estrutura hierárquica de plano de contas contábil. Define categorias de receitas e despesas para DRE, fluxo de caixa e relatórios financeiros. Controla tipo (Sintético/Analítico), origem (Receita/Despesa) e fórmula do DRE.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Classificador | integer |
| 2 | Código DRE | text |
| 3 | Descrição | text |
| 4 | Tipo | text (S/A) |
| 5 | Origem | text (R/D) |
| 6 | Custo | badge |
| 7 | Inclui Resumo | badge |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Classificador | integer | Sim | Campo em foco (borda azul) |
| Descrição | text | Sim | |
| Id. | readonly | — | |

### Seção: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Origem | radio: Receita / Despesa | Sim | |
| Tipo | radio: Sintético / Analítico | Sim | |
| Histórico sugerido | text | — | |
| Código DRE | text | — | Código na estrutura do DRE |
| Cálculo DRE | text | — | Fórmula de cálculo (ex: `+1001 -2001`) |
| Tipo reflexão | select | Sim | |

> ⚠️ **Modal de validação visível:** "Conta Caixa: Campo Obrigatório" — indica validação de campo em outra aba/seção que não está visível no screenshot.

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| [Ok] | Fechar modal de erro |

---

## 6. Filtros e Busca
- Busca rápida por Descrição
- Filtros: Tipo, Origem, Custo

---

## 7. Abas e Seções do Formulário
Formulário sem abas. Uma única seção:
1. **Identificação** — Classificador + Descrição
2. **Características** — Todos os demais campos

---

## 8. Campos Obrigatórios Aparentes
- Classificador
- Descrição
- Origem
- Tipo
- Tipo reflexão
- Conta Caixa (oculto/em outra tela — modal indica obrigatoriedade)

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Classificador | integer positivo |
| Cálculo DRE | fórmula texto (ex: `+1001 -2001`) |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `plano_conta` → `plano_conta` (pai) | N:1 (Sintético) |
| `lancamento_receita` → `plano_conta` | N:1 |
| `lancamento_despesa` → `plano_conta` | N:1 |
| `fluxo_caixa` → `plano_conta` | N:1 |
| `cliente_plano_conta` → `plano_conta` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Tipo Sintético": não aceita lançamentos diretamente?
- [ ] Classificador: pode ser qualquer número ou precisa seguir hierarquia?
- [ ] "Cálculo DRE": validação da fórmula antes de salvar?
- [ ] "Tipo reflexão": quais opções disponíveis?
- [ ] Modal "Conta Caixa: Campo Obrigatório": em qual contexto aparece?
- [ ] Campo "Custo" (DB): o que significa?
- [ ] Campo "Incluir Resumo" (DB): impacta qual relatório?

---

## 12. Dúvidas Abertas
- O "Código DRE" é o número da linha no DRE ou um código livre?
- "Cálculo DRE" aceita operadores além de + e -?
- "Tipo reflexão": reflete em qual outra conta automaticamente?
- Por que o modal "Conta Caixa" aparece nessa tela? É um bug ou validação real?
- O campo "Histórico sugerido" é pré-preenchido ao criar um lançamento?
