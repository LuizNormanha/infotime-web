
# Tela: Produto (Catálogo Comercial)

## 1. Nome da Tela
**Lista:** "Consulta Produtos" | **Formulário:** "Novo registro de Produto"
Módulo: **Cadastros** → Produtos

---

## 2. Objetivo da Tela
Catálogo de produtos e serviços comercializados em propostas e contratos. Diferente dos produtos do almoxarifado: este é o catálogo de venda, aquele é controle de estoque.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Categoria | text |
| 3 | Ativo | badge |
| 4 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Formulário com campos inferidos — screenshot mostra tela em branco com borda erro)_

| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Categoria | select | Sim |
| Tipo de Cobrança | select | — |
| Valor | decimal | — |
| Ativo | radio | Sim |
| Id. | readonly | — |

---

## 5. Botões e Ações Disponíveis
- + Incluir | ← Voltar

---

## 6. Filtros e Busca
- Busca por Descrição
- Filtro: Categoria, Ativo

---

## 7. Abas e Seções
Formulário simples — possivelmente sem abas.

---

## 8. Campos Obrigatórios
- Descrição, Categoria

---

## 9. Máscaras
| Campo | Formato |
|---|---|
| Valor | R$ decimal |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `produto` → `categoria_produto` | N:1 |
| `produto` → `tipo_cobranca` | N:1 |
| `proposta_item` → `produto` | N:1 |
| `contrato_item` → `produto` | N:1 |
| `categoria_produto_tarefa` → `produto` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Este produto é diferente do produto do almoxarifado (`almoxarifado_produto`)?
- [ ] "Tipo de Cobrança": mensal, anual, único, por licença?
- [ ] Preço: fixo no produto ou por proposta?

---

## 12. Dúvidas Abertas
- Existe tabela de preço por produto com vigência?
- O produto do catálogo pode gerar tarefas de implantação automáticas?
