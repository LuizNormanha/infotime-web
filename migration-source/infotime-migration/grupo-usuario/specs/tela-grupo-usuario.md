
# Tela: Grupo de Usuário

## 1. Nome da Tela
**Lista:** "Consulta Grupos de Usuário" | **Formulário:** "Inclusão Grupo de usuário"
Módulo: **Cadastros**

---

## 2. Objetivo da Tela
Cadastro de grupos de acesso do RBAC (Role-Based Access Control). Cada grupo define permissões por aplicação (consulta, inclusão, exclusão, alteração, exportação, impressão), com controle de visibilidade por bloco e por campo.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Fornecedor | text (FK opcional) |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Seção: Identificação
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Id. | integer readonly | — |

### Seção: Fornecedor
| Campo | Tipo | Obrigatório |
|---|---|---|
| Fornecedor | text/select | Não |

> Formulário sem abas. Simples e direto.

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar grupo |
| ← Voltar | Retornar |
| [Autorizações] | Tela de matriz de permissões (acesso pós-criação) |

---

## 6. Filtros e Busca
- Busca rápida por Descrição

---

## 7. Abas e Seções do Formulário
Formulário sem abas. Duas seções colapsáveis:
1. **Identificação** — Descrição
2. **Fornecedor** — Vínculo opcional com fornecedor

---

## 8. Campos Obrigatórios Aparentes
- Descrição

---

## 9. Máscaras e Formatos Especiais
Nenhuma.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `grupo_usuario` → `grupo_usuario_aplicacao` | 1:N |
| `grupo_usuario_aplicacao` → `aplicacao` | N:1 |
| `grupo_usuario` → `grupo_usuario_aplicacao_bloco` | 1:N |
| `grupo_usuario` → `grupo_usuario_aplicacao_campo` | 1:N |
| `grupo_usuario` → `fornecedor` | N:1 (opcional) |
| `usuario_grupo_usuario` → `grupo_usuario` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Vínculo com Fornecedor: qual o efeito prático (acesso restrito ao fornecedor)?
- [ ] Ao deletar grupo: o que acontece com usuários vinculados?
- [ ] Permissões são aditivas quando usuário tem múltiplos grupos?
- [ ] Tela de Autorizações: é acessada via botão na lista ou no formulário?

---

## 12. Dúvidas Abertas
- O campo Fornecedor limita o grupo a ver apenas dados daquele fornecedor?
- Existe herança de permissões entre grupos?
- Como a tela de Autorizações (`GrupoUsuario_AutorizacaoAcesso_Frm`) está integrada?
