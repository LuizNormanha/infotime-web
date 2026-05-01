
# Tela: POP - Documento

## 1. Nome da Tela
**Lista:** "Consulta POP - Documentos" | **Formulário:** "Inclusão POP - Documentos"
Módulo: **R.H.** → POP - Documentos

---

## 2. Objetivo da Tela
Gestão de Procedimentos Operacionais Padrão (POP) e documentos normativos. Vincula documentos a tipos classificatórios e controla data de referência. Colaboradores acessam os POPs pelo app mobile.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Tipo do Documento | text |
| 3 | Data de Referência | date |
| 4 | Arquivo | link download |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Descrição | text | Sim | Campo com borda azul (em foco) |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Tipo do documento | select | Sim | "Escolha o Tipo do documento" |
| Data de referência | date + calendário | Sim | Default: hoje (29/04/2026) |

### Aba: Arquivo
_(Upload do arquivo PDF/DOC/XLSX do POP)_

### Aba: Observações
_(Texto livre com observações e instruções)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida por Descrição
- Filtros: Tipo do documento

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Tipo do documento, Data de referência |
| 2 | **Arquivo** | Upload do arquivo |
| 3 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes
- Descrição
- Tipo do documento (*)
- Data de referência (*)

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Data de referência | `DD/MM/YYYY` + calendário |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `pop_documento` → `tipo_documento` | N:1 |
| `colaborador.lista_pop_documento` → `pop_documento` | N:N |
| `pop_documento` ← app mobile | leitura pelo colaborador |

---

## 11. Comportamentos a Confirmar
- [ ] Arquivo: armazenado em bytea (DB) ou no sistema de arquivos?
- [ ] `lista_pop_documento` no colaborador: lista de IDs dos POPs permitidos?
- [ ] App mobile: exibe apenas POPs da lista do colaborador ou todos?
- [ ] Tipos de documento: cadastro em `TipoDocumento_Gde.png`?

---

## 12. Dúvidas Abertas
- Existe versionamento de POPs (mesmo POP com datas diferentes)?
- O campo "Arquivo" permite múltiplos arquivos?
- Existe obrigatoriedade de leitura confirmada pelo colaborador?
- O POP tem vigência (data início e fim)?
