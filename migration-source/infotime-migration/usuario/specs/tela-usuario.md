
# Tela: Usuário

## 1. Nome da Tela
**Lista:** "Consulta Usuários" | **Formulário:** "Inclusão Usuário"
Módulo: **Cadastros** (menu principal)

---

## 2. Objetivo da Tela
Cadastro de usuários do sistema com controle granular de permissões: acesso à auditoria, autorizações, indicadores financeiros, administrador, e limites de desconto por tipo de operação.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Nome | text |
| 2 | Login | text |
| 3 | E-mail | email |
| 4 | Ativo | badge (Sim/Não) |
| 5 | Administrador | badge |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Id. | integer readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório | Default |
|---|---|---|---|
| Login | text | Sim | — |
| E-mail | email | Sim | — |
| Senha | password | Sim | — |
| Confirme a senha | password | Sim | — |
| Ativo | radio: Sim / Não | Sim | Sim |
| Acesso à auditoria | radio: Sim / Não | Sim | Não |
| Acesso à autorizações | radio: Sim / Não | Sim | Não |
| Indicador financeiro | radio: Sim / Não | Sim | Não |
| Administrador | radio: Sim / Não | — | Não |
| Desconto Máximo Implantação (%) | decimal | Sim | — |
| Desconto Máximo Mês (%) | decimal | Sim | — |
| Data Ativacao | date readonly | — | Auto na ativação |

### Aba: Grupos do usuário
_(List box de grupos disponíveis para vincular ao usuário)_

### Aba: Empresa
_(List box ou multiselect de empresas que o usuário pode acessar)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Novo | Criar usuário |
| + Incluir | Salvar |
| ← Voltar | Retornar |
| Alterar Senha | Tela específica de troca de senha |

---

## 6. Filtros e Busca
- Busca rápida por Nome ou Login
- Filtros: Ativo, Administrador

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Login, email, senha, flags de acesso, descontos |
| 2 | **Grupos do usuário** | Vínculos com grupos de acesso |
| 3 | **Empresa** | Empresas acessíveis ao usuário |

---

## 8. Campos Obrigatórios Aparentes
- Nome
- Login (único)
- E-mail
- Senha e confirmação
- Ativo
- Acesso à auditoria
- Acesso à autorizações
- Indicador financeiro
- Desconto Máximo Implantação (%)
- Desconto Máximo Mês (%)

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| Desconto | decimal com 2 casas (%) |
| Data Ativacao | `DD/MM/YYYY` |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `usuario` → `usuario_grupo_usuario` | 1:N |
| `usuario_grupo_usuario` → `grupo_usuario` | N:1 |
| `usuario.lista_empresa` | array de IDs de empresa |
| `lancamento_despesa.id_usuario_*` | referências de workflow |

---

## 11. Comportamentos a Confirmar
- [ ] Confirmação de senha: validação client-side ou server-side?
- [ ] Login único: escopo por tenacidade ou global?
- [ ] `Desconto Máximo Implantação`: validado na geração de proposta?
- [ ] `Desconto Máximo Mês`: validado em qual operação?
- [ ] Aba "Empresa": se vazio, acessa todas as empresas?
- [ ] Data Ativacao: preenchida automaticamente na criação ou apenas após ativação?

---

## 12. Dúvidas Abertas
- Existe restrição de senha (comprimento mínimo, caracteres especiais)?
- Campo "Administrador" bypassa todas as permissões de grupo?
- Como funciona o envio do link de ativação por email?
- O campo `Desconto Máximo` aceita decimais (ex: 12,5%)?
