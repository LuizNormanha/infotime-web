
# Tela: Entrada de Almoxarifado (Nota Fiscal de Compra)

## 1. Nome da Tela
**Lista:** "Lista de Almoxarifado entrada" | **Formulário:** "Novo registro de Entrada Almoxarifado"
Módulo: **Estoque**

---

## 2. Objetivo da Tela
Registro de entradas de produtos no estoque via nota fiscal de compra. Suporta importação de XML de NF-e para preenchimento automático. Gera movimentações de entrada no estoque e parcelas financeiras a pagar.

---

## 3. Campos Visíveis na Lista
_(Lista com estado "Registros não encontrados" — banco de demonstração vazio)_

**Botão especial destacado:** "Importar XML" (verde, na toolbar)

Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Código | text |
| 2 | Fornecedor | text |
| 3 | Almoxarifado | text |
| 4 | Número NF | text |
| 5 | Data Emissão | date |
| 6 | Valor Total | decimal R$ |
| 7 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Fornecedor | select (autocomplete) | Sim | "Selecione..." |
| CNPJ | text readonly | — | Preenche automaticamente ao selecionar fornecedor |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa/Almoxarifado | select (autocomplete) | Sim | |

### Aba: Nota fiscal
_(Número NF, série, chave NF-e, natureza da operação, data emissão)_

### Aba: Valores
_(Valor total, valor desconto, valor frete, valor líquido, rateio entre parcelas)_

### Aba: Observações
_(Texto livre)_

### Aba: Suporte
_(Dados técnicos)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| + Novo | Nova entrada |
| ← Voltar | Retornar |
| **Importar XML** | Upload de XML de NF-e — preenche campos automaticamente |
| Ações ▾ | Opções adicionais |

---

## 6. Filtros e Busca
- Busca rápida por número NF/fornecedor
- Filtros: Almoxarifado, Fornecedor, Período, Situação

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Empresa/Almoxarifado de destino |
| 2 | **Nota fiscal** | Número, série, chave NF-e, data |
| 3 | **Valores** | Totais, descontos, parcelas |
| 4 | **Observações** | Texto livre |
| 5 | **Suporte** | Dados técnicos |

---

## 8. Campos Obrigatórios Aparentes
- Fornecedor
- Empresa/Almoxarifado

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| CNPJ | `XX.XXX.XXX/XXXX-XX` (readonly) |
| Chave NF-e | 44 dígitos |
| Valor Total | R$ decimal |
| Data Emissão | `DD/MM/YYYY HH:MM` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `almoxarifado_entrada` → `fornecedor` | N:1 |
| `almoxarifado_entrada` → `almoxarifado` | N:1 |
| `almoxarifado_entrada` → `almoxarifado_entrada_produto` | 1:N |
| `almoxarifado_entrada` → `almoxarifado_entrada_parcela` | 1:N |
| `almoxarifado_entrada_parcela` → `lancamento_despesa` | 1:1 |
| `almoxarifado_produto_estoque` ← `almoxarifado_entrada_produto` | +movimentação |

---

## 11. Comportamentos a Confirmar
- [ ] "Importar XML": abre modal de upload ou vai direto para parser?
- [ ] Ao salvar entrada: cria movimentações `almoxarifado_produto_estoque` (tipo='E') automaticamente?
- [ ] Parcelas: geram `lancamento_despesa` automaticamente?
- [ ] CNPJ auto-preenche do fornecedor: é readonly ou editável?
- [ ] Aba "Nota fiscal": campos de validação da chave NF-e?
- [ ] Validação de temperatura na entrada: em qual aba ou tela?

---

## 12. Dúvidas Abertas
- Existe um grid de produtos dentro do formulário de entrada ou é uma tela separada?
- A entrada "manual" (sem XML) tem fluxo diferente?
- Qual app Scriptcase gerencia os produtos da entrada: `AlmoxarifadoEntradaProduto_Frm`?
- A validação `AlmoxarifadoEntradaProduto_Validacao_Frm` é obrigatória para todas as entradas?
