
# Tela: Tarefa do Colaborador

## 1. Nome da Tela
**Lista:** "Lista de Tarefas de Colaborador" — aba "Tarefas de Colab..."
**Formulário:** "Inclusão Tarefa"
Módulo: **R.H.**

---

## 2. Objetivo da Tela
Gestão de tarefas atribuídas a colaboradores vinculadas (ou não) a contratos de clientes. Controla prioridade, situação, prazos e histórico de prorrogações.

---

## 3. Campos Visíveis na Lista
_(Visível nos breadcrumbs com múltiplas instâncias de lista)_

Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Colaborador | text |
| 2 | Descrição | text |
| 3 | Projeto/Contrato | text |
| 4 | Data Início | datetime |
| 5 | Data Previsão | datetime |
| 6 | Prioridade | badge (A/M/B) |
| 7 | Situação | badge |
| 8 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Projeto (Contrato) | select | Sim | "Selecione..." — vínculo com contrato |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Descrição | text | Sim | Campo em destaque (borda azul/verde — em foco) |
| Responsável | select | Sim | "Escolha o responsável" — lista colaboradores |
| Data de Início | datetime + calendário | Sim | Default: data/hora atual (29/04/2026 17:29) |
| Data da Previsão | datetime + calendário | Sim | |
| Data da Conclusão | datetime + calendário | — | Preenchida ao concluir |
| Prioridade | select | Sim | "Selecione..." (A=Alta/M=Média/B=Baixa) |
| Situação | select | Sim | Default: "Pendente" |

### Aba: Observações
_(Texto livre)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| [Tarefas Hoje] | Lista filtrada por data = hoje |
| [Tarefas Atrasadas] | Lista com previsão < hoje e não concluídas |
| [Lembrete] | Enviar e-mail de lembrete |

---

## 6. Filtros e Busca
- Busca rápida
- Filtros: Responsável, Situação, Prioridade, Projeto/Contrato, Período

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Descrição, responsável, datas, prioridade, situação |
| 2 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes
- Projeto (Contrato)
- Descrição
- Responsável
- Data de Início
- Data da Previsão
- Prioridade
- Situação

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Data de Início | `DD/MM/YYYY HH:MM` |
| Data da Previsão | `DD/MM/YYYY HH:MM` |
| Data da Conclusão | `DD/MM/YYYY HH:MM` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `colaborador_tarefa` → `contrato` | N:1 (opcional) |
| `colaborador_tarefa` → `colaborador` (responsável) | N:1 |
| `colaborador_tarefa` → `colaborador_tarefa_historico` | 1:N |
| `colaborador_tarefa` → `colaborador_tarefa_motivo_prorrogacao` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Projeto": é o contrato (`id_contrato`) ou existe entidade "Projeto" separada?
- [ ] Data de Início auto-preenche com datetime atual?
- [ ] Ao prorrogar: obriga motivo de prorrogação?
- [ ] `qtd_alteracao_data`: incrementa automaticamente ao alterar Data Previsão?
- [ ] "Lembrete": envia e-mail para o responsável?

---

## 12. Dúvidas Abertas
- O campo "Projeto" é obrigatório? Pode haver tarefa sem vínculo com contrato?
- "Responsável" lista apenas colaboradores ou também usuários?
- Existe sub-tarefa ou hierarquia de tarefas?
- A "Situação" tem transições restritas (ex: Pendente → Em andamento → Concluída)?
