
# Tela: Fornecedor

## 1. Nome da Tela
**Lista:** "Consulta Fornecedores" | **Formulário:** "Inclusão Fornecedor"
Módulo: **Fornecedores** (menu principal — ícone de pessoas + carrinho)

---

## 2. Objetivo da Tela
Cadastro de fornecedores de produtos e serviços. Diferencia fornecedores comuns de fabricantes. Armazena contatos, documentos, planos de conta padrão e situação de cada fornecedor.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Razão Social | text |
| 2 | Nome Fantasia | text |
| 3 | CNPJ | text mascarado |
| 4 | Situação | text |
| 5 | Fabricante | badge (Sim/Não) |
| 6 | Cidade / Estado | text |
| 7 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Pessoa | radio: FÍSICA / JURÍDICA | Sim | |
| Razão social | text | Sim | |
| Fabricante | toggle (on/off) | — | Destaque visual no cabeçalho |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| CNPJ | text mascarado | Sim | Para PJ |
| Nome Fantasia | text | — | |
| Telefone | text | — | Máscara tel. |
| Celular | text | — | Máscara cel. |
| E-mail | email | — | |
| Contatos | text | — | |
| Site | url | — | + botão "Navegar" |
| Situação | select | Sim | "Informe a situação" |

### Aba: Endereço
_(CEP + busca automática, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Observações
_(Texto livre)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| Navegar | Abrir site em nova aba |
| [Gestão] | Menu de gestão (contatos, documentos, plano de conta) |

---

## 6. Filtros e Busca
- Busca rápida por razão social/CNPJ
- Filtros: Situação, Fabricante

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | CNPJ, nome fantasia, contatos, situação |
| 2 | **Endereço** | Endereço completo + busca CEP |
| 3 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes
- Pessoa (radio)
- Razão social
- CNPJ (para PJ)
- Situação

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| CNPJ | `XX.XXX.XXX/XXXX-XX` |
| CPF | `XXX.XXX.XXX-XX` |
| Telefone | `(XX) XXXX-XXXX` |
| Celular | `(XX) X XXXX-XXXX` |
| CEP | `XXXXX-XXX` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `fornecedor` → `situacao_fornecedor` | N:1 |
| `fornecedor` → `fornecedor_contato` | 1:N |
| `fornecedor` → `fornecedor_comunicacao` | 1:N |
| `fornecedor` → `fornecedor_documento` | 1:N |
| `fornecedor` → `fornecedor_plano_conta` | 1:N |
| `lancamento_despesa` → `fornecedor` | N:1 |
| `almoxarifado_entrada` → `fornecedor` | N:1 |
| `almoxarifado_produto` → `fornecedor` (fabricante) | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Toggle "Fabricante": como afeta seleção em `almoxarifado_produto`?
- [ ] Situação "Bloqueado": impede criação de novas despesas?
- [ ] Busca de CEP: ViaCEP ou outra API?
- [ ] Sub-módulos (Contatos, Documentos, Plano de Conta): acessados via menu de Gestão?

---

## 12. Dúvidas Abertas
- O campo CPF aparece ao selecionar "FÍSICA"?
- O vínculo "Fabricante" é usado na listagem de fabricantes em Almoxarifado?
- Existe campo de "Inscrição Estadual" para fornecedores?
- A situação "Bloqueado" bloqueia automaticamente pagamentos pendentes?
