
# Tela: Categoria de Tarefa de Implantação

## 1. Nome da Tela
**Lista:** "Consulta Categoria Produto Tarefa" — com filtro "Implantação"
**Formulário:** "Inclusão Categoria Produto Tarefa"
Módulo: **Contratos** → Implantação

---

## 2. Objetivo da Tela
Template de tarefas padrão por categoria de produto. Ao criar um contrato, estas tarefas são copiadas automaticamente para `contrato_tarefa`, formando o checklist de implantação.

---

## 3. Campos Visíveis na Lista
_(Tela disponível mas sem dados de exemplo)_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Código | text |
| 2 | Descrição | text |
| 3 | Módulo | integer (1/2/3) |
| 4 | Tipo | text (S/A) |
| 5 | Nível | integer (1/2/3) |
| 6 | Prazo (horas) | integer |
| 7 | Exige Arquivo | badge |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Formulário inferido do DDL `contrato_tarefa`)_
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Módulo | select: 1=Iniciais / 2=Implantação / 3=Finais | Sim |
| Tipo | select: S=Sintética / A=Analítica | Sim |
| Nível (prioridade) | select: 1=Baixa / 2=Média / 3=Alta | Sim |
| Prazo (horas) | integer | — |
| Exige Arquivo | checkbox | — |

---

## 5. Botões e Ações Disponíveis
- + Incluir | ← Voltar

---

## 6. Filtros e Busca
- Filtro: Módulo, Tipo

---

## 7. Abas e Seções
Formulário simples sem abas.

---

## 8. Campos Obrigatórios
- Descrição, Módulo, Tipo, Nível

---

## 9. Máscaras
Nenhuma.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `categoria_produto_tarefa` → `contrato_tarefa` | 1:N (template → instâncias) |
| `categoria_produto_tarefa` → `produto` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] A cópia para `contrato_tarefa` é automática na criação do contrato?
- [ ] "Módulo" define a ordem de execução no wizard de implantação?
- [ ] Tipo "Sintética" agrupa outras tarefas ou apenas marca como agrupador?

---

## 12. Dúvidas Abertas
- A categoria é por produto específico ou por família/tipo de produto?
- Existe sequência ordenada entre as tarefas (campo de ordem)?
- Tarefas dependentes são suportadas (tarefa B só inicia após tarefa A)?
