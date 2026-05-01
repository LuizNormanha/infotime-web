
# Tela: Lançamento de Receita (Contas a Receber)

## 1. Nome da Tela
**Lista:** "Consulta Contas a Receber" | **Formulário:** "Inclusão Conta a Receber (Receita)"
Módulo: **Financeiro**

---

## 2. Objetivo da Tela
Gerenciamento de contas a receber: controla previsão e realização de receitas, parcelas, recorrência, rateio, envio de cobranças e integração com boleto/PIX/NF-e. Aba da lista: "Contas a Receber..." (visível no breadcrumb).

---

## 3. Campos Visíveis na Lista
_(Múltiplas abas de listas especializadas visíveis no breadcrumb)_

**Lista principal:**
| # | Coluna | Tipo |
|---|---|---|
| 1 | Cliente/Agente | text |
| 2 | Empresa | text |
| 3 | Plano de Conta | text |
| 4 | Conta Caixa | text |
| 5 | Situação | badge |
| 6 | Espécie | text |
| 7 | Previsto para | date |
| 8 | Valor Previsto | decimal R$ |
| 9 | Realizado em | date |
| 10 | Valor Realizado | decimal R$ |
| 11 | Parcela | integer |
| 12 | Id. | integer |

**Listas derivadas:**
- `LancamentoReceita_Atraso_Lst.png`: "Contas a Receber em Atraso" — mesmas colunas filtradas
- `LancamentoReceita_Boleto_Lst.png`: "Contas a Receber com Boleto" — coluna adicional de status do boleto

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Agente | radio: Cliente / Colaborador / Fornecedor | Sim | Altera label do campo seguinte |
| Cliente (Nome Fantasia - CNPJ / CPF) | autocomplete | Sim | |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa | select | Sim | |
| Plano de Contas | select | — | |
| Valor bruto | decimal + calculadora | — | |
| Valor previsto | decimal + calculadora | Sim | |
| Previsto para | date + calendário | Sim | |
| Competência | month/year | — | Auto: mês corrente |
| Situação | select | Sim | Default: "Pendente" |
| Histórico | text | — | |

### Aba: Recebimento
_(Data realização, valor realização, acréscimo, desconto, multa, juros, espécie, conta caixa, nosso número)_

### Aba: Observações
_(Texto livre)_

### Aba: Arquivos
_(Upload: comprovante, boleto, nota fiscal)_

### Aba: Auditoria
_(Log de alterações: quem, quando, o quê)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| Ações ▾ | Parcelar, recorrência, rateio, gerar boleto, enviar email, baixa, etc. |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida por cliente/valor
- Filtros: Situação, Empresa, Plano de Conta, Período, Espécie

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Empresa, plano, valores, datas, situação |
| 2 | **Recebimento** | Baixa: data, valor real, acréscimos, conta |
| 3 | **Observações** | Texto livre |
| 4 | **Arquivos** | Upload de documentos |
| 5 | **Auditoria** | Log de alterações |

---

## 8. Campos Obrigatórios Aparentes
- Agente (radio)
- Cliente/Colaborador/Fornecedor (autocomplete)
- Empresa
- Valor previsto
- Previsto para
- Situação

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Valor previsto | R$ decimal (calculadora embutida) |
| Previsto para | `DD/MM/YYYY` + calendário |
| Competência | `MM/YYYY` |
| CNPJ/CPF | mascarado no autocomplete |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `lancamento_receita` → `cliente` | N:1 |
| `lancamento_receita` → `empresa` | N:1 |
| `lancamento_receita` → `plano_conta` | N:1 |
| `lancamento_receita` → `conta_caixa` | N:1 |
| `lancamento_receita` → `situacao_documento` | N:1 |
| `lancamento_receita` → `tipo_especie` | N:1 |
| `lancamento_receita` → `nota_fiscal` | N:1 |
| `lancamento_receita` → `boleto` | 1:1 |
| `lancamento_receita` → `lancamento_receita` (pai) | N:1 (parcelas) |
| `lancamento_receita_rateio` → `lancamento_receita` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Agente radio: altera label e validação do campo de busca?
- [ ] Ícone calculadora: abre calculadora embutida ou é apenas visual?
- [ ] Situação "Pendente → Baixado": quais campos são liberados na aba Recebimento?
- [ ] Parcelamento: cria N registros filhos com `id_lancamento_receita_pai`?
- [ ] Recorrência: job automático ou manual?
- [ ] Rateio: distribuição por empresa/plano de conta?
- [ ] Envio de email de cobrança: template configurável?
- [ ] Baixa automática via CNAB: atualiza `data_realizacao` e `valor_realizacao`?

---

## 12. Dúvidas Abertas
- O campo "Competência" impacta na DRE ou apenas para agrupamento?
- "Valor bruto" vs "Valor previsto": qual é a diferença na prática?
- O ícone de calculadora no campo Valor faz qual cálculo?
- Existe diferença entre "Ações ▾" no formulário vs na lista?
- A aba Auditoria é gerada automaticamente ou é manual?
