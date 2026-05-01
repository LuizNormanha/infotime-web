
# Tela: Negociação (CRM)

## 1. Nome da Tela
**Lista:** "Consulta Negociações" | **Formulário:** sem título (formulário inline)
**Pipeline:** "Pipeline" (visão Kanban)
Módulo: **Comercial** → Negociações

---

## 2. Objetivo da Tela
Pipeline de vendas (CRM). Controla o funil comercial desde a prospecção até o fechamento ou perda de uma oportunidade. Cada negociação percorre fases configuráveis com tarefas, observações e indicadores.

---

## 3. Campos Visíveis na Lista
_(Lista com filtros laterais — aba "Em andamento" visível)_
| # | Coluna | Tipo |
|---|---|---|
| 1 | Cliente | text (link) |
| 2 | Tipo de Negócio | text |
| 3 | Fase atual | text |
| 4 | Situação | text (badge) |
| 5 | Data | date |
| 6 | Id. | integer |

**Aba "Pipeline" (Kanban):** visão alternativa com cards agrupados por fase.

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Default |
|---|---|---|---|
| Cliente | select (autocomplete) | Sim | — |
| Tipo de negócio | select | Sim | — |
| Situação | select | Sim | "Em andamento" |
| Id. | integer readonly | — | — |

### Aba: Evolução
| Campo | Tipo | Observação |
|---|---|---|
| (textarea livre) | textarea grande | Histórico da negociação, próximos passos |

### Aba: Suporte
_(Dados técnicos de suporte)_

---

## 5. Botões e Ações Disponíveis
### Na lista:
| Botão | Função |
|---|---|
| + Incluir | Criar negociação |
| Ações ▾ | Opções adicionais |
| [Pipeline] | Alternar para visão Kanban |

### No formulário:
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida na lista
- Filtros: Situação, Tipo de Negócio, Fase, Período
- **Visão Pipeline**: filtro por colaborador responsável, tipo de negócio

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Evolução** | Textarea livre para histórico |
| 2 | **Suporte** | Dados técnicos |

---

## 8. Campos Obrigatórios Aparentes
- Cliente
- Tipo de negócio
- Situação

---

## 9. Máscaras e Formatos Especiais
Nenhuma aparente.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `negociacao` → `cliente` | N:1 |
| `negociacao` → `tipo_negocio` | N:1 |
| `negociacao` → `negociacao_proposta_fase` | 1:N |
| `negociacao_proposta_fase` → `proposta_fase` | N:1 |
| `negociacao` → `negociacao_tarefa` | 1:N |
| `negociacao_tarefa` → `colaborador` | N:1 |
| `negociacao` → `negociacao_motivo_perda` | N:1 (se perdida) |
| `negociacao` → `proposta` | 1:N (ao ganhar) |

---

## 11. Comportamentos a Confirmar
- [ ] Avanço de fase: feito pelo Pipeline Kanban ou existe botão no formulário?
- [ ] Campo Evolução: é salvo por entrada ou ao clicar em "Incluir"?
- [ ] Situação "Perdida": obriga seleção de Motivo de Perda?
- [ ] Pipeline Kanban: drag & drop nativo do Scriptcase ou componente externo?
- [ ] Gráficos (NegociacaoEvento_Gra, MotivoPerda_Gra): são embedded na lista ou em tela separada?
- [ ] Criação de proposta: é automática ao ganhar ou manual?

---

## 12. Dúvidas Abertas
- A fase é criada automaticamente ao incluir a negociação?
- O campo Evolução é un único texto acumulativo ou cada entrada é um registro separado?
- Qual coluna do DB armazena a fase atual (denormalizado ou via join)?
- Existe notificação/alerta ao criar tarefa de negociação?
