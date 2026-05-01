
# Tela: Agência Bancária

## 1. Nome da Tela
**Lista:** "Consulta Agências" | **Formulário:** "Inclusão Agência"
Módulo: **Cadastros** → Financeiro

---

## 2. Objetivo da Tela
Cadastro de agências bancárias vinculadas a bancos. Usadas na configuração de contas caixa bancárias.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo | Exemplo |
|---|---|---|---|
| 1 | Número | text | 3494-0, 3295-6, 010, 2979 |
| 2 | Nome | text | ANCHIETA-MG, CAIXA INTERNO |
| 3 | Banco | text | Banco do Brasil (BB), Caixa Interno, Banco Itaú |
| 4 | Id. | integer | 1, 2, 3, 10.060 |

**Total:** 1 a 4 de 4 registros

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Banco | select | Sim |
| Número | text | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Gerente | text | — |
| Contatos | text | — |
| E-mail | email | — |

### Aba: Endereço
_(CEP, logradouro, cidade, estado)_

### Aba: Observações
_(Texto livre)_

---

## 5. Botões
- + Incluir | ← Voltar

---

## 6. Filtros
- Busca por Número ou Nome

---

## 7. Abas
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Nome, gerente, contatos, email |
| 2 | **Endereço** | Localização da agência |
| 3 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios
- Banco (*)
- Número (*)
- Nome (aba Características)

---

## 9. Máscaras
| Campo | Formato |
|---|---|
| Número | texto (ex: "3494-0") |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `agencia` → `banco` | N:1 |
| `conta_caixa` → `agencia` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Existe agência "virtual" para contas internas (sem banco real)?
- [ ] O número da agência inclui dígito verificador?

---

## 12. Dúvidas Abertas
- "CAIXA INTERNO" é uma agência fictícia para conta caixa física?
- Existe validação do número de agência por banco?
