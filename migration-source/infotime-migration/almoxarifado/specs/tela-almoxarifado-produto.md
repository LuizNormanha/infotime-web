
# Tela: Produto do Almoxarifado

## 1. Nome da Tela
**Lista:** "Lista de Produtos" | **Formulário:** "Novo registro de Produto"
Módulo: **Estoque**

---

## 2. Objetivo da Tela
Cadastro de produtos e insumos controlados pelo almoxarifado. Define SKU, estoque mínimo/máximo, ponto de pedido, classificação, volume e local de armazenamento padrão.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo | Observação |
|---|---|---|---|
| 1 | SKU (Sigla) | text link | Ex: HMG010606924EN, VYT010607198EN |
| 2 | Descrição | text | Ex: "HEMOTON HEMACOUNTER - 20L" |
| 3 | Volume | text | Ex: "UN", "KIT" |
| 4 | Classificação | text | Ex: "Reagentes" |
| 5 | Grupo | text | Ex: "Área técnica Hematologia" |
| 6 | Fabricante | text | — |
| 7 | Estoque global atual | decimal | Default: 0,00 |
| 8 | Código barras | text | — |
| 9 | Ativo | badge | "Sim" |
| 10 | Id. | integer | |

**Filtros no painel lateral:**
- SKU (Sigla), Descrição, Volume, Classificação, Grupo, Fabricante, Ativo

**Total:** 1 a 15 de 36 registros (com filtros)

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| SKU (Sigla) | text | Sim | |
| Descrição | text | Sim | |
| Ativo | select: Sim/Não | Sim | Default: Sim |
| Id. | readonly | — | |

### Seção: Estoque
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Grupo | select | Sim | "Selecione..." |
| Mínimo | decimal | Sim | Estoque mínimo |
| Máximo | decimal | Sim | Estoque máximo |
| Tipo ponto pedido | select | Sim | P=Percentagem / Q=Quantidade |
| Valor ponto pedido | decimal | Sim | |
| Estoque atual do produto | decimal readonly | — | Campo desabilitado (calculado) |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Classificação | select (autocomplete) | Sim | Ex: "Reagentes", "Alimentos" |
| Volume | select (autocomplete) | Sim | Ex: "UN", "KIT" |
| Local de armazenamento padrão | select (autocomplete) | — | |
| Fabricante | select (autocomplete) | — | |
| Código de barras | text | — | |
| Código externo | text | — | Código do produto no sistema do fornecedor |

### Aba: Observações
_(Texto livre)_

### Aba: Suporte
_(Dados técnicos)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Novo | Criar produto |
| + Incluir | Salvar |
| ← Voltar | Retornar |
| Exportar | CSV/Excel |
| Ações ▾ | Opções adicionais |

---

## 6. Filtros e Busca
- Busca Rápida: texto livre
- **Painel lateral de filtros:**
  - SKU (Sigla)
  - Descrição
  - Volume
  - Classificação
  - Grupo
  - Fabricante
  - Ativo

---

## 7. Abas e Seções do Formulário
| # | Seção/Aba | Conteúdo |
|---|---|---|
| — | **Identificação** (fixo) | SKU, Descrição, Ativo |
| — | **Estoque** (fixo) | Grupo, Mín/Máx, Ponto pedido, Estoque atual |
| 1 | **Características** | Classificação, Volume, Local, Fabricante, Código |
| 2 | **Observações** | Texto livre |
| 3 | **Suporte** | Dados técnicos |

---

## 8. Campos Obrigatórios Aparentes
- SKU (Sigla)
- Descrição
- Ativo
- Grupo (seção Estoque)
- Mínimo e Máximo (seção Estoque)
- Tipo ponto pedido
- Valor ponto pedido
- Classificação (aba Características)
- Volume (aba Características)

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Mínimo / Máximo | decimal |
| Valor ponto pedido | decimal |
| Código de barras | EAN-13 ou similar |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `almoxarifado_produto` → `almoxarifado_produto_grupo` | N:1 |
| `almoxarifado_produto` → `almoxarifado_produto_classificacao` | N:1 |
| `almoxarifado_produto` → `almoxarifado_produto_volume` | N:1 |
| `almoxarifado_produto` → `almoxarifado_produto_local_armazenamento` | N:1 |
| `almoxarifado_produto` → `fornecedor` (fabricante) | N:1 |
| `almoxarifado_produto` → `almoxarifado_produto_estoque` | 1:N |
| `almoxarifado_entrada_produto` → `almoxarifado_produto` | N:1 |
| `almoxarifado_requisicao_produto` → `almoxarifado_produto` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Estoque atual do produto" (readonly): calculado via trigger ou view?
- [ ] "Tipo ponto pedido P": ponto = (Máximo × Percentagem)?
- [ ] "Tipo ponto pedido Q": ponto = quantidade absoluta?
- [ ] Quando estoque ≤ ponto de pedido: sistema emite alerta? Onde?
- [ ] Painel lateral: filtros aplicados via Ajax ou recarrega a página?
- [ ] Fabricante select: lista apenas fornecedores com `fabricante = 'S'`?

---

## 12. Dúvidas Abertas
- O campo "SKU" (Sigla) é único por almoxarifado ou globalmente?
- "Código externo" é o código EAN/GTIN do fabricante?
- Existe campo de temperatura para controle de cadeia fria (visível no DB)?
- O campo "Estoque global atual" na lista soma todos os almoxarifados?
- Existe controle de lote visível nesta tela ou apenas nas movimentações?
