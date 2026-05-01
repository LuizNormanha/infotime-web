
# Tela: Configuração de Cobrança

## 1. Nome da Tela
**Lista:** "Consulta Configuração de Cobrança" | **Formulário:** "Inclusão Configuração de Cobrança"
Módulo: **Financeiro** → Cadastros

---

## 2. Objetivo da Tela
Define parâmetros de cobrança por combinação de: conta caixa × espécie de pagamento × bandeira de cartão. Controla taxas, limites de parcelamento e comportamento de baixa automática.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Conta Caixa | text |
| 2 | Espécie | text |
| 3 | Bandeira Cartão | text |
| 4 | Taxa (%) | decimal |
| 5 | Parcela Mín./Máx. | text |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Inferido do DDL `configuracao_cobranca`)_
| Campo | Tipo | Obrigatório |
|---|---|---|
| Conta Caixa | select | Sim |
| Plano de Conta | select | — |
| Bandeira Cartão | select | — |
| Tipo Espécie | select | — |
| Taxa (%) | decimal | — |
| Taxa Adiantamento (%) | decimal | — |
| Parcela Mínima | integer | — |
| Parcela Máxima | integer | — |
| Qtd. Dias | integer | — |
| Baixa Automática | checkbox | — |
| Adiantamento | checkbox | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Conta Caixa

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `configuracao_cobranca` → `conta_caixa` | N:1 |
| `configuracao_cobranca` → `bandeira_cartao` | N:1 |
| `configuracao_cobranca` → `tipo_especie` | N:1 |
| `configuracao_cobranca` → `plano_conta` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Baixa Automática": baixa o lançamento após quantos dias?
- [ ] "Qtd. Dias": dias para repasse do cartão?
- [ ] "Adiantamento": permite receber antes do prazo com desconto de taxa?

---

## 12. Dúvidas Abertas
- Uma conta pode ter múltiplas configurações (uma por bandeira)?
- "Parcela Mínima/Máxima": limites de parcelamento no recebimento?
