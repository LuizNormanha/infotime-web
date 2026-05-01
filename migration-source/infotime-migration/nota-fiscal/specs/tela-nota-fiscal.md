
# Tela: Nota Fiscal

## 1. Nome da Tela
**Lista:** "Consulta Notas Fiscais" | **Formulário:** "Inclusão Nota Fiscal"
Módulo: **Financeiro**

---

## 2. Objetivo da Tela
Emissão e gerenciamento de Notas Fiscais de Serviço eletrônicas (NFS-e). Integra com plataforma nacional de NFS-e via certificado digital e controla sequencial por empresa.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Número NF | integer |
| 2 | Cliente | text |
| 3 | Empresa | text |
| 4 | Situação | badge |
| 5 | Data Emissão | date |
| 6 | Data Vencimento | date |
| 7 | Valor NF | decimal R$ |
| 8 | Valor ISS | decimal R$ |
| 9 | Valor Líquido | decimal R$ |
| 10 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Serviços prestados em | date + calendário | Sim | Data da competência |
| Empresa | select | Sim | Default: "Liga Sistemas - M" |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Nome Fantasia - CNPJ | text autocomplete | Sim | Cliente |
| Plano de Contas | select | Sim | |
| Data do Vencimento | date + calendário | Sim | |
| Valor dos Serviços | decimal | Sim | |
| Valor do ISS (%) | decimal | — | Percentual do ISS |
| Valor Líquido | decimal | Sim | Auto: Serviços - ISS |
| Emitido por | select (usuario) | — | Auto: usuário logado |
| Situação | select | Sim | Default: "Pendente" |
| Boleto liberado | radio: Não / Sim | — | Default: Não |

### Aba: Financeiro
_(Conta caixa, lançamento de receita vinculado)_

### Aba: Dados da nota
_(Número NF gerado, série, código verificação, número lote, protocolo retorno)_

### Aba: Discriminação
_(Texto livre com discriminação dos serviços — enviado na NF-e)_

### Aba: Arquivos
_(PDF gerado, XML da NF-e, RPS)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar rascunho |
| [Gerar NF] | Emitir NF via API da prefeitura |
| [Cancelar NF] | Comunicar cancelamento à prefeitura |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Filtros: Empresa, Situação, Período, Cliente

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Cliente, valores, ISS, situação, boleto |
| 2 | **Financeiro** | Conta caixa, lançamento receita |
| 3 | **Dados da nota** | Número, série, protocolo |
| 4 | **Discriminação** | Texto da NF-e |
| 5 | **Arquivos** | PDF, XML |

---

## 8. Campos Obrigatórios Aparentes
- Serviços prestados em (data)
- Empresa
- Nome Fantasia/CNPJ
- Plano de Contas
- Data do Vencimento
- Valor dos Serviços
- Valor Líquido
- Situação

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Serviços prestados em | `DD/MM/YYYY` |
| Data do Vencimento | `DD/MM/YYYY` |
| Valor ISS (%) | decimal % |
| Valor dos Serviços | R$ decimal |
| CNPJ | `XX.XXX.XXX/XXXX-XX` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `nota_fiscal` → `cliente` | N:1 |
| `nota_fiscal` → `empresa` | N:1 |
| `nota_fiscal` → `plano_conta` | N:1 |
| `nota_fiscal` → `lancamento_receita` | 1:1 |
| `nota_fiscal` → `boleto` | 1:N (via `boleto_nota_fiscal`) |
| `empresa_nota_fiscal` → `empresa` | N:1 |
| `empresa_nota_fiscal` → `certificado` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Boleto liberado = Sim": libera geração de boleto vinculado à NF?
- [ ] Valor Líquido: calculado automaticamente (Serviços - ISS)?
- [ ] Sequencial: incrementado automaticamente por empresa ao emitir?
- [ ] Situações: Pendente → Emitida → Cancelada (transições válidas)?
- [ ] Certificado digital: carregado de `empresa_nota_fiscal.arquivo_certificado` (bytea)?
- [ ] Competência: "Serviços prestados em" ou campo separado?

---

## 12. Dúvidas Abertas
- O campo "Valor do ISS (%)" é o percentual ou o valor absoluto?
- "Boleto liberado" afeta algum cálculo ou é apenas flag informativo?
- Existe geração automática de NF ao baixar um lançamento de receita?
- A prefeitura comunica retorno em tempo real ou é assíncrono (webhook)?
- Existe campo de "Código do Serviço" (LC 116) para a NFS-e?
