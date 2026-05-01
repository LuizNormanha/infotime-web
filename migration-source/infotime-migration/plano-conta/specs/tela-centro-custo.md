
# Tela: Centro de Custo

## 1. Nome da Tela
**Lista:** "Consulta Centro de Custo" | **Formulário:** "Novo registro de Centro de custo"
Módulo: **Financeiro**

---

## 2. Objetivo da Tela
Cadastro de centros de custo com vigência temporal. Habilita controle orçamentário quando `configuracao.utiliza_centro_custo = 'S'`.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Empresa | text |
| 2 | Descrição | text |
| 3 | Vigência atual | text |
| 4 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa | select (autocomplete) | Sim |
| Descrição | text | Sim |
| Id. | readonly | — |

### Seção: Vigência
_(Grid de vigências: período inicial, período final, valor teto)_

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Empresa (*), Descrição (*)

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `centro_custo` → `empresa` | N:1 |
| `centro_custo` → `centro_custo_vigencia` | 1:N |
| `lancamento_despesa` → `centro_custo` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] A "Vigência" define um orçamento (valor máximo) por período?
- [ ] Ao exceder o valor da vigência: alerta ou bloqueio de lançamento?
- [ ] Habilitar centros de custo: qual campo em `configuracao`?

---

## 12. Dúvidas Abertas
- Centro de custo tem hierarquia (filho/pai)?
- O grid de vigência permite múltiplos registros simultaneamente?
- Existe relatório de realizado vs orçado por centro de custo?
