
# Tela: Dimensão de Proposta

## 1. Nome da Tela
**Lista:** "Consulta Dimensões de Proposta" | **Formulário:** "Inclusão Dimensão de Proposta"
Módulo: **Comercial**

---

## 2. Objetivo da Tela
Cadastro de dimensões para classificar propostas em múltiplos eixos de análise. Permite filtros e relatórios segmentados por dimensão.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Id. | readonly | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Descrição

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `proposta_dimensao` → `proposta` | N:1 |

---

## 12. Dúvidas Abertas
- Como "Dimensão" é diferente de "Fase" na proposta?
- Dimensões são usadas em relatórios de pipeline?
