
# Tela: Proposta

## 1. Nome da Tela
**Lista:** "Consulta Propostas" | **Formulário:** "Inclusão Proposta"
Módulo: **Comercial** → Propostas

---

## 2. Objetivo da Tela
Geração de propostas comerciais para clientes, com itens de produtos/serviços, condições financeiras, descontos controlados por nível de usuário, e conversão em contrato.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Número | integer |
| 2 | Cliente | text |
| 3 | Tipo Contrato | text |
| 4 | Empresa | text |
| 5 | Situação | badge (Pendente/Fechada/Cancelada) |
| 6 | Data Inclusão | date |
| 7 | Valor Total | decimal |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa | select | Sim | Pré-selecionada: "LIGA SISTEMAS DE INFORMATICA LTDA." |
| Cliente (Nome Fantasia - CNPJ - Id.) | autocomplete | Sim | |
| Tipo do contrato | select | Sim | "Escolha o tipo do contrato" |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Solicitado por | text | Sim | Nome do solicitante |
| Incluído em | datetime readonly | — | Auto: data/hora atual |
| Incluído por | select | — | Auto: usuário logado |
| Situação | select | — | Default: "Pendente" |

### Aba: Condições
_(Prazos, forma de pagamento, validade, início implantação, qtd parcelas)_

### Aba: Financeiro
_(Desconto único R$, motivo, desconto mensal R$, motivo, índice reajuste)_

### Aba: Observações
_(Texto livre)_

### Aba: Produtos e Serviços
_(Grid de itens: produto, descrição, quantidade, valor unitário, total)_

### Aba: Arquivo
_(Upload do arquivo da proposta assinada)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar proposta |
| Ações ▾ | Relatório, gerar contrato, cancelar, etc. |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca por cliente, número, situação
- Filtros: Empresa, Situação, Período, Tipo Contrato

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Solicitante, incluído em/por, situação |
| 2 | **Condições** | Prazos, pagamento, validade |
| 3 | **Financeiro** | Descontos, índice reajuste |
| 4 | **Observações** | Texto livre |
| 5 | **Produtos e Serviços** | Grid de itens |
| 6 | **Arquivo** | Upload |

---

## 8. Campos Obrigatórios Aparentes
- Empresa
- Cliente
- Tipo do contrato
- Solicitado por

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Valor desconto | decimal R$ |
| Percentual reajuste | % |
| Data validade | `DD/MM/YYYY` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `proposta` → `cliente` | N:1 |
| `proposta` → `empresa` | N:1 |
| `proposta` → `tipo_contrato` | N:1 |
| `proposta` → `indice_reajuste` | N:1 |
| `proposta` → `usuario` (inclusão) | N:1 |
| `proposta` → `proposta_item` | 1:N |
| `proposta` → `contrato` | 1:1 (ao fechar) |
| `proposta` → `negociacao` | N:1 (origem) |

---

## 11. Comportamentos a Confirmar
- [ ] Desconto Único: validado contra `usuario.desconto_maximo_imp`?
- [ ] Desconto Mensal: validado contra `usuario.desconto_maximo_mes`?
- [ ] Situação "Fechada": gera contrato automaticamente?
- [ ] Grid de Produtos: qual tabela de produto (almoxarifado ou catálogo)?
- [ ] Empresa pré-selecionada: é a empresa padrão do usuário logado?
- [ ] Campo "Tipo do contrato": carrega template de arquivo de proposta?

---

## 12. Dúvidas Abertas
- O campo "Solicitado por" é texto livre ou select de contatos do cliente?
- Existe aprovação hierárquica para descontos acima do limite do usuário?
- A aba "Arquivo" permite upload ou gera PDF automaticamente?
- Qual é o fluxo exato de conversão Proposta → Contrato?
