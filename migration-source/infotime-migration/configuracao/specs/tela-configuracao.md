
# Tela: Configuração

## 1. Nome da Tela
**Lista:** "Consulta Configuração" | **Formulário:** "Inclusão Configuração"
Módulo: **Cadastros** (acesso restrito — admin)

---

## 2. Objetivo da Tela
Configuração global do tenant (tenacidade). Define comportamentos do sistema: módulos habilitados, parâmetros financeiros padrão, SMTP, SMS, NF-e obrigatória, auditoria, integrações. Uma configuração por tenant.

---

## 3. Campos Visíveis na Lista
_(Lista esperada com 1 registro por tenant)_
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição/Tenant | text |
| 2 | Módulos | text |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Aba: Características
| Campo | Tipo | Default | Observação |
|---|---|---|---|
| Cliente ativo | radio: Sim/Não | — | |
| Gravar auditoria | toggle | off | Habilita log em `auditoria` |
| Integração InfoLAB | radio: Ativa/Inativa | Inativa | |
| Usa Taxa Adiantamento | radio: Sim/Não | — | |
| Recebe Parcelado (CC) | radio: Sim/Não | — | |
| URL de saída | text | — | |
| Cliente Concorrente | radio: Sim/Não | — | |
| Nota Fiscal Obrigatório | radio: Sim/Não | Sim | |
| Coleta Domiciliar | radio: Sim/Não | — | |
| Diretório para exportação | text | — | Caminho no servidor |
| Diretório Arquivo | text | — | |
| Qtd. Dias - Cartão de Crédito | integer | — | |
| Qtd. Dias - Cartão de Débito | integer | — | |
| Taxa de Serviço - Cartão de Crédito | decimal | — | % |
| Taxa de Serviço - Cartão de Débito | decimal | — | % |
| Relação de cadastros | text | — | Lista de módulos de cadastro |
| Relação de módulos | text | — | Lista de módulos funcionais |

### Aba: Contrato
_(Tipo de contrato padrão, índice de reajuste padrão, modelo de proposta)_

### Aba: SMTP
_(Servidor SMTP, porta, usuário, senha, remetente, TLS/SSL)_

### Aba: SMS
_(URL API SMS, usuário, senha)_

### Aba: Relatório
_(Configurações de layout e impressão)_

### Aba: Plano de Contas
_(IDs de planos de conta padrão por tipo de operação)_

### Aba: Conta Caixa
_(IDs de contas caixa padrão por tipo de operação)_

### Aba: Situação
_(Situações de documento padrão)_

### Aba: Tipo Espécie
_(Espécies de documento padrão)_

### Aba: Logomarca
_(Upload do logotipo para relatórios)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Sem filtros (única configuração por tenant)

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Flags do sistema, taxas, módulos |
| 2 | **Contrato** | Padrões de contrato |
| 3 | **SMTP** | Configuração de email |
| 4 | **SMS** | Configuração de SMS |
| 5 | **Relatório** | Layout de impressão |
| 6 | **Plano de Contas** | Contas padrão por operação |
| 7 | **Conta Caixa** | Contas caixa padrão |
| 8 | **Situação** | Situações padrão |
| 9 | **Tipo Espécie** | Espécies padrão |
| 10 | **Logomarca** | Upload de logotipo |

---

## 8. Campos Obrigatórios Aparentes
Nenhum campo marcado explicitamente com * — todos parecem opcionais, mas alguns são obrigatórios por lógica (ex: SMTP para envio de email).

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Taxa Cartão | decimal % |
| Qtd. Dias | integer |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `configuracao` → `tenacidade` | 1:1 |
| `configuracao` → `plano_conta` (múltiplos) | N:1 |
| `configuracao` → `conta_caixa` (múltiplos) | N:1 |
| `configuracao` → `tipo_especie` | N:1 |
| `configuracao` → `tipo_contrato` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] "Relação de módulos": formato livre ou lista com separadores?
- [ ] "Gravar auditoria toggle": impacto de performance — confirmado no código?
- [ ] "Nota Fiscal Obrigatório = Sim": bloqueia baixa de receita sem NF?
- [ ] "Diretório para exportação": path físico no servidor ou URL?
- [ ] Logomarca: armazenada em bytea (DB) ou apenas como referência de arquivo?
- [ ] SMTP: senha armazenada em plain text? Necessário criptografar.

---

## 12. Dúvidas Abertas
- "Relação de cadastros" vs "Relação de módulos": qual a diferença?
- "Cliente ativo" habilita o módulo de clientes ou é flag de status?
- "Cliente Concorrente" afeta qual comportamento?
- O campo "URL de saída" é uma URL de redirect pós-logout?
- Existe separação entre configs do sistema e configs da empresa?
