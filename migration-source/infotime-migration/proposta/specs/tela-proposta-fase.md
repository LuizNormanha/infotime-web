
# Tela: Fase de Proposta

## 1. Nome da Tela
**Lista:** "Consulta Fases de Proposta" | **Formulário:** "Inclusão Fase de Proposta"
Módulo: **Comercial**

---

## 2. Objetivo da Tela
Define as fases do funil de vendas (pipeline CRM). Cada fase tem uma probabilidade de fechamento e pode ter tarefas associadas. Fases configuram as colunas do Kanban de negociações.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Percentual | decimal % |
| 3 | Ordem | integer |
| 4 | Ativo | badge |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Percentual (probabilidade) | decimal % | — |
| Ordem | integer | — |
| Ativo | radio: Sim/Não | Sim |
| Id. | readonly | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 6. Filtros
- Busca por Descrição

---

## 7. Abas
Formulário simples.

---

## 8. Campos Obrigatórios
- Descrição, Ativo

---

## 9. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `proposta_fase` → `negociacao_proposta_fase` | 1:N |
| Kanban: `proposta_fase` = colunas do board | — |

---

## 11. Comportamentos a Confirmar
- [ ] A ordem das fases determina a sequência do pipeline?
- [ ] "Percentual" é exibido no card do Kanban?

---

## 12. Dúvidas Abertas
- Existe fase de "Ganho" e "Perda" pré-definidas ou são criadas como fase normal?
- Ao mover card para fase "Perdida": exige motivo de perda?
