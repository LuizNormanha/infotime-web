
# Tela: Empresa

## 1. Nome da Tela
**Lista:** "Consulta Empresas" | **Formulário:** "Inclusão Empresa"
Módulo: **Cadastros**

---

## 2. Objetivo da Tela
Cadastro das empresas da Liga Sistemas (matriz e filiais). Define parâmetros fiscais (alíquota ISS), identidade visual (logomarca) e integrações. Base para multi-empresa: lançamentos, contratos e usuários são vinculados à empresa.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Razão Social | text |
| 2 | Nome Fantasia | text |
| 3 | CNPJ | text mascarado |
| 4 | Tipo | text (Matriz/Filial) |
| 5 | Ativa | badge |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Razão social | text | Sim | Campo em azul (foco) |
| CNPJ | text mascarado | Sim | |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Tipo | radio: Matriz / Filial | Sim | |
| Nome fantasia | text | Sim | |
| Inscrição Estadual | text | — | |
| Alíquota ISS | decimal | — | % para cálculo da NF-e |
| E-mail | email | — | |
| Contatos | text | — | |
| Site | url | — | + botão "Navegar" |
| Ativa | radio: Sim / Não | Sim | Default: Sim |

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Integração
_(Configurações de integração: InfoLAB, Qualimax, outros sistemas)_

### Aba: Observações
_(Texto livre)_

### Aba: Imagem
_(Upload do logotipo — usado em relatórios, NF-e, comunicações)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| Navegar | Abrir site em nova aba (campo Site) |
| [Gestão] | Menu de gestão da empresa |

---

## 6. Filtros e Busca
- Busca rápida por razão social/CNPJ
- Filtros: Tipo (Matriz/Filial), Ativa

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Tipo, nome fantasia, IE, ISS, email, ativa |
| 2 | **Endereço** | Endereço completo |
| 3 | **Integração** | Chaves e parâmetros de integração |
| 4 | **Observações** | Texto livre |
| 5 | **Imagem** | Logotipo |

---

## 8. Campos Obrigatórios Aparentes
- Razão social
- CNPJ
- Tipo (Matriz/Filial)
- Nome fantasia
- Ativa

---

## 9. Máscaras e Formatos Especiais
| Campo | Formato |
|---|---|
| CNPJ | `XX.XXX.XXX/XXXX-XX` |
| CEP | `XXXXX-XXX` |
| Alíquota ISS | decimal % |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `empresa` → `empresa_documento` | 1:N |
| `empresa` → `empresa_senha` | 1:N |
| `empresa` → `empresa_nota_fiscal` | 1:1 |
| `empresa` → `conta_caixa` | 1:N |
| `empresa` → `colaborador` | 1:N |
| `lancamento_receita` → `empresa` | N:1 |
| `contrato` → `empresa` | N:1 |
| `proposta` → `empresa` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] CNPJ: validação de dígito verificador antes de salvar?
- [ ] Tipo "Filial": vínculo com empresa Matriz?
- [ ] "Alíquota ISS": usada automaticamente na emissão de NF-e?
- [ ] Aba "Imagem": armazenada em `bytea` (legado) → migrar para object storage
- [ ] Aba "Integração": quais campos são exibidos? (chave InfoLAB, Qualimax?)

---

## 12. Dúvidas Abertas
- Existe campo "empresa_pai" para filiais?
- O campo "Unidade Origem" (DB: `unidade_origem`) está em qual aba?
- A aba "Integração" contém credenciais sensíveis? Como são armazenadas?
- Existe validação de CNPJ único?
