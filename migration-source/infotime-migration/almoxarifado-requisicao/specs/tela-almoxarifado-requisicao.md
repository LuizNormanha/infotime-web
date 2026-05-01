
# Tela: Requisição de Almoxarifado

## 1. Nome da Tela
**Lista:** "Lista de Requisições" | **Formulário:** "Novo registro de Requisição"
Módulo: **Estoque**

---

## 2. Objetivo da Tela
Registro de requisições de materiais entre almoxarifados ou solicitação de compra. Controla fluxo de atendimento por produto (parcial, total, negado).

---

## 3. Campos Visíveis na Lista
_(Lista com estado "Registros não encontrados")_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Almoxarifado Origem | text |
| 2 | Almoxarifado Destino | text |
| 3 | Tipo | text (E/C) |
| 4 | Situação | badge |
| 5 | Data Abertura | datetime |
| 6 | Data Prazo | datetime |
| 7 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa/Almoxarifado origem | select (autocomplete) | Sim | "Selecione..." |
| Empresa/Almoxarifado destino | select (autocomplete) | Sim | "Selecione..." |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Tipo requisição | select | Sim | "Selecione..." (E=Estoque/C=Compra) |
| Prazo | date + calendário | — | |

### Aba: Observações
_(Texto livre)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| + Novo | Nova requisição |
| Ações ▾ | Opções adicionais |

---

## 6. Filtros e Busca
- Busca rápida
- Filtros: Tipo, Situação, Almoxarifado, Período

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Tipo requisição, Prazo |
| 2 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes
- Empresa/Almoxarifado origem
- Empresa/Almoxarifado destino
- Tipo requisição

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Prazo | `DD/MM/YYYY HH:MM` + calendário |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `almoxarifado_requisicao` → `almoxarifado` (origem) | N:1 |
| `almoxarifado_requisicao` → `almoxarifado` (destino) | N:1 |
| `almoxarifado_requisicao` → `usuario` (requisitante) | N:1 |
| `almoxarifado_requisicao` → `almoxarifado_requisicao_produto` | 1:N |
| `almoxarifado_requisicao_produto` → `almoxarifado_produto` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Produtos da requisição: adicionados em grid após criar a requisição?
- [ ] Tipo C (Compra): não verifica saldo de estoque?
- [ ] Tipo E (Estoque): verifica saldo disponível ao atender?
- [ ] Quem pode atender: verifica `almoxarifado_usuario_atender`?
- [ ] Situação automática: calculada a partir dos itens (P/A/R/N)?

---

## 12. Dúvidas Abertas
- O prazo é obrigatório ou opcional?
- Após criar a requisição, quem recebe notificação para atender?
- O destino pode ser diferente empresa?
- Existe aprovação antes do atendimento?
