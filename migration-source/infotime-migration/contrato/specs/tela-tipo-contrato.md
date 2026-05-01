
# Tela: Tipo de Contrato

## 1. Nome da Tela
**Lista:** "Consulta Tipos de Contrato" | **Formulário:** "Inclusão Tipo de Contrato"
Módulo: **Cadastros** → Contratos

---

## 2. Objetivo da Tela
Cadastro dos tipos de contrato disponíveis. Define o template/modelo do documento de proposta/contrato usado para geração de PDF.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Nome Arquivo | text (template) |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Formulário simples — campos inferidos do DDL)_
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Nome Arquivo | text | — |
| Id. | readonly | — |

---

## 5. Botões e Ações Disponíveis
- + Incluir | ← Voltar

---

## 6. Filtros e Busca
- Busca por Descrição

---

## 7. Abas e Seções
Formulário simples sem abas.

---

## 8. Campos Obrigatórios
- Descrição

---

## 9. Máscaras
Nenhuma.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `proposta` → `tipo_contrato` | N:1 |
| `contrato` → `tipo_contrato` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Nome Arquivo: path do template Word/HTML para geração de PDF?
- [ ] Tipos diferentes geram documentos com layouts diferentes?

---

## 12. Dúvidas Abertas
- O arquivo template está no sistema de arquivos do servidor ou no banco?
- Existe editor de template embutido?
