
# Tela: Transferência entre Contas

## 1. Nome da Tela
**Lista:** "Consulta Transferências entre Contas" | **Formulário:** "Inclusão Transferência entre Contas"
Módulo: **Financeiro** → Conta Caixa

---

## 2. Objetivo da Tela
Registro de transferências financeiras entre contas caixa (da mesma empresa ou entre empresas). Gera dois registros automáticos: saída na origem e entrada no destino.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Empresa Origem | text |
| 2 | Conta Origem | text |
| 3 | Empresa Destino | text |
| 4 | Conta Destino | text |
| 5 | Data | date |
| 6 | Valor | decimal R$ |
| 7 | Histórico | text |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa origem | select | Sim |
| Origem (Conta Caixa) | select | Sim |
| Empresa destino | select | — |
| Destino (Conta Caixa) | select | Sim |

### Seção: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Data | date | Sim | Default: hoje (29/04/2026) |
| Valor | decimal | Sim | |
| Histórico | text | Sim | |
| Incluído em | datetime readonly | — | Auto: data/hora atual |
| Incluído por | text readonly | — | Auto: usuário logado (ex: "LUIZ ANTÔNIO NORMANHA NOVAES") |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 6. Filtros
- Filtros: Empresa origem/destino, Período, Conta

---

## 8. Campos Obrigatórios
- Empresa origem
- Conta Origem
- Conta Destino
- Data
- Valor
- Histórico

---

## 9. Máscaras
| Campo | Formato |
|---|---|
| Data | `DD/MM/YYYY` |
| Valor | R$ decimal |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `conta_caixa_transferencia` → `conta_caixa` (origem) | N:1 |
| `conta_caixa_transferencia` → `conta_caixa` (destino) | N:1 |
| `conta_caixa_transferencia` → `empresa` (origem e destino) | N:1 |
| `conta_caixa_registro_lancamento` ← transferência | gera 2 registros |

---

## 11. Comportamentos a Confirmar
- [ ] "Empresa destino" é obrigatório ou pode ser a mesma empresa?
- [ ] Ao salvar: cria lançamento de saída na origem E entrada no destino atomicamente?
- [ ] Histórico auto-preenchido com algum texto padrão?
- [ ] "Incluído por": auto-preenche com usuário logado — readonly?

---

## 12. Dúvidas Abertas
- Transferência entre empresas diferentes é permitida?
- Existe confirmação/aprovação para transferências acima de certo valor?
- É possível cancelar uma transferência após criada?
