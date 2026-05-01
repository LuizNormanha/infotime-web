
# Tela: Baixa de Produto (Almoxarifado)

## 1. Nome da Tela
**Lista:** "Lista de Baixas de produto" | **Formulário:** "Novo registro de Baixa de produtos em lote"
Módulo: **Estoque**

---

## 2. Objetivo da Tela
Registro de baixas de produtos do estoque por motivo: validade expirada, descarte, quebra/dano. Opera em modo lote — múltiplos produtos em um único registro.

---

## 3. Campos Visíveis na Lista
_(Lista com estado "Registros não encontrados")_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Almoxarifado | text |
| 2 | Motivo da Baixa | text |
| 3 | Data/Hora | datetime |
| 4 | Responsável | text |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

**Formato:** Grid de inclusão em lote (não é formulário com abas)

| Coluna | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa/Almoxarifado | select | Sim | |
| Motivo da baixa | select | Sim | |
| Produto | select | Sim | |
| Lote | text | — | Opcional: para controle de rastreabilidade |
| Quantidade | decimal | Sim | |

**Botões do grid:**
- **+ Novo**: adicionar nova linha
- **Incluir**: salvar todas as linhas
- **← Voltar**: retornar sem salvar

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Novo | Adicionar linha ao grid |
| Incluir | Salvar todas as linhas |
| ← Voltar | Cancelar e retornar |

---

## 6. Filtros e Busca
- Busca rápida por almoxarifado/motivo

---

## 7. Abas e Seções do Formulário
Não há abas. Interface de grid inline com N linhas.

---

## 8. Campos Obrigatórios Aparentes
- Empresa/Almoxarifado (*)
- Motivo da baixa (*)
- Produto (*)
- Quantidade (*)

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Quantidade | decimal |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `almoxarifado_baixa` → `almoxarifado` | N:1 |
| `almoxarifado_baixa` → `almoxarifado_motivo_baixa` | N:1 |
| `almoxarifado_baixa` → `almoxarifado_baixa_produto` | 1:N |
| `almoxarifado_baixa_produto` → `almoxarifado_produto` | N:1 |
| `almoxarifado_produto_estoque` ← baixa produto | -movimentação (tipo='S') |

---

## 11. Comportamentos a Confirmar
- [ ] Ao salvar: cria movimentações de saída em `almoxarifado_produto_estoque`?
- [ ] Valida se quantidade baixada ≤ estoque disponível?
- [ ] Lote: se informado, baixa especificamente aquele lote?
- [ ] Grid: permite editar linhas após adicioná-las (antes de salvar)?

---

## 12. Dúvidas Abertas
- O campo "Motivo da baixa" lista os registros de `almoxarifado_motivo_baixa`?
- Existe campo de "Data/Hora da baixa" no formulário ou é automático?
- Após salvar, o grid exibe um relatório do que foi baixado?
- Existe tela de confirmação antes de finalizar?
