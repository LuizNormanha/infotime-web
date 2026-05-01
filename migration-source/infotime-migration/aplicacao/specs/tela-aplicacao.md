
# Tela: Aplicação

## 1. Nome da Tela
**Lista:** "Consulta Aplicações" | **Formulário:** "Inclusão Aplicação"
Módulo: **Cadastros** → IAM

---

## 2. Objetivo da Tela
Catálogo de todas as telas/aplicações do sistema Infotime. Base do RBAC: cada entrada representa uma aplicação Scriptcase (Lst, Frm, Gde, etc.) para a qual podem ser configuradas permissões por grupo de usuário.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo | Observação |
|---|---|---|---|
| 1 | Nome | text link | Ex: AcessoNegado_Ctr, Agencia_Frm, Agenda_Frm |
| 2 | Tipo | text | cons, form, calendar, etc. |
| 3 | Descrição | text | Geralmente vazia |
| 4 | Id. | integer | |

**Total:** 1 a 10 de 459 registros
**Exemplos de tipos:** cons (consulta/lista), form, calendar

---

## 4. Campos Visíveis no Formulário

### Seção: Identificação
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Id. | readonly | — |

### Seção: Características
| Campo | Tipo | Observação |
|---|---|---|
| Tipo | text | Ex: cons, form, calendar, grid, blank |
| Descrição | text | Descrição livre |

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Novo | Criar aplicação |
| + Incluir | Salvar |
| ← Voltar | Retornar |
| [Sincronizar] | Sincronizar lista de aplicações entre ambientes |

---

## 6. Filtros e Busca
- Busca por Nome (campo de texto simples, sem label visível)
- Sem filtros laterais

---

## 7. Abas e Seções do Formulário
Sem abas. Duas seções:
1. **Identificação** — Nome
2. **Características** — Tipo, Descrição

---

## 8. Campos Obrigatórios Aparentes
- Nome (único)

---

## 9. Máscaras e Formatos Especiais
Nenhuma.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `aplicacao` → `grupo_usuario_aplicacao` | 1:N |
| `aplicacao` → `grupo_usuario_aplicacao_bloco` | 1:N |
| `aplicacao` → `grupo_usuario_aplicacao_campo` | 1:N |

---

## 11. Comportamentos a Confirmar
- [ ] O campo "Tipo" tem valores pré-definidos ou é texto livre?
- [ ] A sincronização (`Aplicacao_Sincronizar_Lst`): de onde para onde sincroniza?
- [ ] Ao adicionar uma nova tela no sistema: é necessário registrar manualmente aqui?
- [ ] Nome deve ser único (UNIQUE INDEX na tabela)?

---

## 12. Dúvidas Abertas
- O "Tipo" segue algum padrão dos sufixos Scriptcase (_Lst, _Frm, _Gde)?
- 459 aplicações: todas as telas do sistema estão catalogadas aqui?
- Existe processo automático de descoberta de novas aplicações?
- O campo "Descrição" é exibido em alguma outra tela do sistema?
