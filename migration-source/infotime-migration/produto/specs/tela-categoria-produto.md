
# Tela: Categoria de Produto (Catálogo)

## 1. Nome da Tela
**Lista:** "Consulta Categoria de Produto" | **Formulário:** "Inclusão Categoria de Produto"
Módulo: **Cadastros**

---

## 2. Objetivo da Tela
Classificação hierárquica dos produtos do catálogo comercial. Usado para organizar produtos em propostas e relatórios.

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

## 6. Filtros
- Busca por Descrição

---

## 7. Abas
Formulário simples sem abas.

---

## 8. Campos Obrigatórios
- Descrição

---

## 9. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `categoria_produto` → `produto` | 1:N |
| `produto` → `proposta_item` | 1:N |

---

## 11. Comportamentos a Confirmar
- [ ] Categoria hierárquica? (categoria pai/filho)?

---

## 12. Dúvidas Abertas
- Esta categoria é a mesma de `CategoriaProdutoTarefa` (implantação) ou são entidades distintas?
