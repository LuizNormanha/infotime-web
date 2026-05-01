
# Tela: Tarefa de Negociação

## 1. Nome da Tela
**Lista:** "Lista Geral de Tarefas de Negociação" | **Formulário:** "Inclusão Tarefa de Negociação"
Módulo: **Comercial** → Negociações → Tarefas

---

## 2. Objetivo da Tela
Gestão de tarefas comerciais vinculadas a negociações específicas. Cada tarefa tem responsável, datas e situação. Visão geral mostra todas as tarefas de todas as negociações.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Cliente | text |
| 2 | Negociação | text |
| 3 | Fase | text |
| 4 | Colaborador Responsável | text |
| 5 | Data Execução | datetime |
| 6 | Data Retorno | datetime |
| 7 | Situação | badge |
| 8 | Observação | text |
| 9 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Formulário inferido — screenshot mostra formulário genérico de tarefa)_

| Campo | Tipo | Obrigatório |
|---|---|---|
| Negociação | select | Sim |
| Colaborador | select | Sim |
| Data Execução | datetime | Sim |
| Data Retorno | datetime | — |
| Situação | select | Sim |
| Observação | textarea | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 6. Filtros
- Filtros: Colaborador, Situação, Fase, Período

---

## 8. Campos Obrigatórios
- Negociação, Colaborador, Data Execução, Situação

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `negociacao_tarefa` → `negociacao` | N:1 |
| `negociacao_tarefa` → `colaborador` | N:1 |
| `negociacao_tarefa` → `situacao_tarefa` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Data Retorno": data para fazer contato/follow-up?
- [ ] Situação tem transições automáticas?

---

## 12. Dúvidas Abertas
- Tarefa de negociação é diferente de tarefa de colaborador?
- Existe integração com agenda do Google Calendar?
