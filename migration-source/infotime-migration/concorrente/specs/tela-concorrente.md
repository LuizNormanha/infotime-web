
# Tela: Concorrente

## 1. Nome da Tela
**Lista:** "Consulta Concorrentes" | **Formulário:** "Inclusão Concorrente"
Módulo: **Comercial**

---

## 2. Objetivo da Tela
Cadastro de empresas concorrentes para análise competitiva no CRM. Vinculado ao cliente para rastrear quais concorrentes disputam cada conta.

---

## 3. Campos Visíveis na Lista
_(Telas com dados parcialmente visíveis)_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Nome | text |
| 2 | Site | url |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Formulário simples — campos completos não visíveis no screenshot)_

Esperado baseado no DDL:
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Site | url | — |
| Observações | textarea | — |

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida por Nome

---

## 7. Abas e Seções do Formulário
Formulário simples sem abas aparentes.

---

## 8. Campos Obrigatórios Aparentes
- Nome

---

## 9. Máscaras e Formatos Especiais
Nenhuma aparente.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `cliente` → `concorrente` | N:1 |
| `negociacao` → `concorrente` | N:1 (se perdida para concorrente) |

---

## 11. Comportamentos a Confirmar
- [ ] Vínculo com cliente: campo `id_concorrente` em `cliente`?
- [ ] Concorrente vinculado à negociação perdida: registra qual concorrente ganhou?

---

## 12. Dúvidas Abertas
- O cadastro de concorrente tem campos além de Nome e Site?
- É possível vincular um concorrente ao motivo de perda de negociação?
- Existe relatório de análise competitiva usando este cadastro?
