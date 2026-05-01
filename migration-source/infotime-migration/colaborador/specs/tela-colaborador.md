
# Tela: Colaborador

## 1. Nome da Tela
**Lista:** "Lista de Colaboradores" | **Formulário:** "Inclusão Colaborador"
Módulo: **R.H.** (menu principal)

---

## 2. Objetivo da Tela
Cadastro completo de colaboradores (funcionários) da Liga Sistemas. Gerencia dados pessoais, dados CLT, banco, vínculo com empresa, permissões de acesso ao app mobile e flags de atuação em implantação de sistemas.

---

## 3. Campos Visíveis na Lista
_(Lista visível nos screenshots com múltiplas abas abertas, cabeçalhos parcialmente visíveis)_

Esperado baseado na DDL e contexto:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Nome | text |
| 2 | Apelido | text |
| 3 | Tipo | text |
| 4 | Situação | text |
| 5 | Empresa | text |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo — sempre visível)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Nome | text | Sim | Campo com borda azul (em foco) |
| Apelido | text | Sim | |
| Login | text + ícone ℹ️ | Sim | Tooltip explicativo disponível |
| Tipo | select | Sim | |
| Situação | select | Sim | Default: "Ativo" |
| Id. | integer readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Sexo | select | Sim | "Não Informado", Masculino, Feminino |
| Empresa | select | Sim | "Escolha a empresa" |
| E-mail | email | — | |
| Contatos | text | — | |
| Implanta sistemas | select | — | Sim / Não |
| Líder da implantação | select | — | Sim / Não |
| Consultor de implantação | select | — | Sim / Não |
| Senha | password | — | Toggle de visibilidade (ícone olho) |

### Aba: Documentos
_(CPF, RG, CTPS, série, UF, PIS, habilitação)_

### Aba: Recursos Humanos
_(Data admissão, CBO, cargo/classificação/nível, regime de trabalho, horários, férias)_

### Aba: Valores
_(Salário, comissão %, insalubridade %, VR valor/dia, VT valor/dia)_

### Aba: Dados bancários
_(Banco, agência, número conta, tipo conta, PIX)_

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Permissões Documentos
_(Lista de POPs e documentos que o colaborador pode visualizar no app mobile)_

### Aba: Observações
_(Texto livre)_

### Aba: Suporte
_(Dados técnicos de suporte, versão, ambiente)_

---

## 5. Botões e Ações Disponíveis
### Na lista:
| Botão | Função |
|---|---|
| + Novo | Abrir formulário |
| Ações ▾ | Exportar, ações em lote |
| Exportar | CSV/Excel |
| Enviar E-mail | Disparar e-mail para colaboradores selecionados |

### No formulário:
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar à lista |

---

## 6. Filtros e Busca
- Busca Rápida: campo texto
- Filtros esperados: Situação, Tipo, Empresa

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Sexo, empresa, email, flags implantação, senha |
| 2 | **Documentos** | CPF, RG, CTPS, PIS |
| 3 | **Recursos Humanos** | Cargo, regime, horários |
| 4 | **Valores** | Salário, VR, VT, comissão |
| 5 | **Dados bancários** | Banco, agência, conta, PIX |
| 6 | **Endereço** | Dados de endereço |
| 7 | **Permissões Documentos** | POPs visíveis no mobile |
| 8 | **Observações** | Texto livre |
| 9 | **Suporte** | Dados técnicos |

---

## 8. Campos Obrigatórios Aparentes (marcados com *)
- Nome
- Apelido
- Login
- Tipo
- Situação
- Sexo (aba Características)
- Empresa

---

## 9. Máscaras e Formatos Especiais
| Campo | Máscara |
|---|---|
| CPF | `XXX.XXX.XXX-XX` |
| Telefone/Celular | `(XX) X XXXX-XXXX` |
| CEP | `XXXXX-XXX` |
| PIS | `XXX.XXXXX.XX-X` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `colaborador` → `tipo_colaborador` | N:1 |
| `colaborador` → `situacao_colaborador` | N:1 |
| `colaborador` → `empresa` | N:1 |
| `colaborador` → `cargo_classificacao_nivel` | N:1 |
| `colaborador` → `banco` | N:1 |
| `colaborador` → `agencia` | N:1 |
| `colaborador` → `colaborador_ferias` | 1:N |
| `colaborador` → `colaborador_tarefa` | 1:N |
| `colaborador` → `colaborador_viagem` | 1:N |

---

## 11. Comportamentos a Confirmar no Código Scriptcase
- [ ] Senha mobile: é separada do login do sistema ou mesma senha?
- [ ] Flags de implantação (Implanta sistemas, Líder, Consultor): afetam seleção em contratos?
- [ ] Campo Login: qual é a política de unicidade? (por empresa ou global?)
- [ ] Toggle de visibilidade da senha: é componente SC padrão ou customizado?
- [ ] Aba "Permissões Documentos": list box com POPs ativos?
- [ ] Qual campo controla acesso ao app mobile?

---

## 12. Dúvidas Abertas
- O campo "Tipo" lista quais opções além do que está em `tipo_colaborador`?
- Existe campo de foto do colaborador? (bytea no DB, mas não visível no form)
- A aba "Recursos Humanos" mostra histórico de cargo ou apenas o atual?
- O campo "Senha" é para o sistema ou para o app mobile?
- Existe validação de CPF antes de salvar?
