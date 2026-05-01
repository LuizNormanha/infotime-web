
# Tela: Índice de Reajuste

## 1. Nome da Tela
**Lista:** "Consulta Índices de Reajuste" | **Formulário:** "Inclusão Índice de Reajuste"
Módulo: **Comercial** → Contratos

---

## 2. Objetivo da Tela
Cadastro de índices econômicos (IPCA, IGP-M, etc.) usados para reajuste de contratos. Cada índice tem histórico de percentuais por data.

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

**Sub-grid:** `IndiceReajusteData_Gde` — histórico de percentuais com data e valor

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida

---

## 7. Abas e Seções do Formulário
- Identificação: Descrição
- Grid inline de histórico de valores: data × percentual

---

## 8. Campos Obrigatórios Aparentes
- Descrição

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Percentual | decimal % |
| Data de referência | `DD/MM/YYYY` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `indice_reajuste` → `indice_reajuste_data` | 1:N |
| `proposta` → `indice_reajuste` | N:1 |
| `contrato` → `indice_reajuste` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Ao reajustar contrato: busca a data mais recente do índice?
- [ ] O percentual é anual, mensal ou cumulativo?

---

## 12. Dúvidas Abertas
- Existe importação automática de índices (ex: API do Banco Central)?
- O percentual é aplicado ao valor total ou apenas a itens específicos?
