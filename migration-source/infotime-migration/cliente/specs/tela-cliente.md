
# Tela: Cliente

## 1. Nome da Tela
**Lista:** "Lista de Clientes" | **Formulário:** "Inclusão Cliente"
Módulo: **Clientes** (menu principal — ícone de pessoas)

---

## 2. Objetivo da Tela
Cadastro e gestão completa de clientes do sistema Infotime. Serve como entidade central para contratos, propostas, faturamento e licenciamento de software. Suporta PJ e PF, com hierarquia de matriz/filial e controle de acesso ao portal do cliente.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo Aparente | Observação |
|---|---|---|---|
| 1 | Cliente | text link | Razão social ou Nome fantasia, clicável para editar |
| 2 | CNPJ / CPF | text mascarado | Formato `XX.XXX.XXX/XXXX-XX` (PJ) |
| 3 | Cidade | text | |
| 4 | Estado | text (sigla) | Ex: MG, SP, PE |
| 5 | Celular | text mascarado | Formato `(XX) X XXXX-XXXX` |
| 6 | Telefone | text mascarado | Formato `(XX) X XXXX-XXXX` |
| 7 | Situação | text | Ativo / Inativo / Prospect / Lead |
| 8 | Origem | text | Ex: "FORÇA TAREFA - 2024", "COOPERLAB", "Site" |
| 9 | Id. | integer | ID interno, ordenável |

**Painel lateral esquerdo (filtros visuais — drill-down):**
- **Situação**: Ativo (176), Inativo (222), Prospect (908), Lead (637)
- **Origem**: Vazio (162), 43° CBAC (153), Revista NewsLAB (2), Outro (161), Indicação (71), VIII Congresso Sul Mineiro (11), 14° Con. Farm/Bio MG (786), 45° CBAC (48), 44° CBAC (3), IX Congresso Sul Mineiro (19), 46° CBAC (70), 53° CBPC/ML (58), Site (19), Redes Sociais (2), 47° CBAC|Fortaleza-CE (64), 54° CBPC (3), 18° CONGRELAB (29), Licitação (10), 2° COMAC - SÃO LUIS MARANHÃO (36), CONGIPLAB - Campinas (37), 48° CBAC (30), COOPERLAB (12), 55° CBPC (26), FORÇA TAREFA - 2024 (71), 49° CBPC (60)

**Total:** 1 a 10 de 1943 registros

---

## 4. Campos Visíveis no Formulário
### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Pessoa | radio: FÍSICA / JURÍDICA | Sim | Altera campos exibidos dinamicamente |
| Razão social | text | Sim | Label mudança: "Nome" para PF |
| Id. | integer (readonly) | — | Auto-gerado |

### Aba: Características
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Nome fantasia | text | Sim | |
| Telefone | text | — | Máscara de telefone |
| Celular | text | — | Máscara de celular |
| Situação | select | Sim | Ativo, Inativo, Prospect, Lead |
| Conta Caixa | select | Sim | Ex: "Banco do Brasil - Liga Sistemas" |
| Município Nota Fiscal | select com autocomplete | — | Dropdown de municípios para emissão NF-e |
| Contatos | text | — | Campo de texto livre |
| E-mail | email | — | Validação de formato |

### Aba: Dados adicionais
_(campos complementares — conteúdo não visível no screenshot)_
Esperado: canal de origem, concorrente, tipo cliente, região estadual, plano de conta padrão, cliente pai (hierarquia)

### Aba: Documentos
_(upload e gestão de documentos — conteúdo não visível)_

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado — busca automática por CEP)_

### Aba: Observações
_(campo textarea livre)_

---

## 5. Botões e Ações Disponíveis
### Na lista:
| Botão/Ação | Posição | Função |
|---|---|---|
| ✏️ (ícone lápis) | Por linha | Editar registro |
| ☰ (ícone menu) | Por linha | Menu de ações do registro |
| + Novo | Toolbar | Abrir formulário em branco |
| Ações ▾ | Toolbar | Exportar, ações em lote |
| Exportar ▾ | Toolbar | Exportar lista (CSV/Excel) |
| Autorizações | Toolbar | Gerenciar permissões |
| ◀ ▶ (paginação) | Toolbar | Navegar entre páginas |
| Visualizar | Toolbar | Selecionar qtd. por página (10, 15, 25…) |

### No formulário:
| Botão | Função |
|---|---|
| + Incluir | Salvar novo registro |
| ← Voltar | Retornar à lista |

---

## 6. Filtros e Busca
- **Busca Rápida**: campo de texto livre — busca por nome/CNPJ
- **Filtro visual lateral**: clique em Situação ou Origem para filtrar drill-down
- **Botão "Selecionar"** no painel lateral: confirmar seleção de filtro
- Filtros acumulativos (pode combinar Situação + Origem)

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo Principal |
|---|---|---|
| 1 | **Características** | Nome fantasia, tel, cel, situação, conta caixa, município NF, email |
| 2 | **Dados adicionais** | Canal, tipo, concorrente, plano de conta, cliente pai |
| 3 | **Documentos** | Upload e listagem de documentos |
| 4 | **Endereço** | CEP, logradouro, cidade, estado |
| 5 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes (marcados com *)
- Pessoa (radio)
- Razão social
- Nome fantasia (aba Características)
- Situação
- Conta Caixa

---

## 9. Máscaras e Formatos Especiais
| Campo | Máscara | Exemplo |
|---|---|---|
| CNPJ | `XX.XXX.XXX/XXXX-XX` | 03.553.522/0001-09 |
| CPF | `XXX.XXX.XXX-XX` | — |
| Celular | `(XX) X XXXX-XXXX` | (32) 9 8406-1453 |
| Telefone | `(XX) XXXX-XXXX` ou `(XX) X XXXX-XXXX` | (32) 3 2516 |
| CEP | `XXXXX-XXX` | — |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade | Observação |
|---|---|---|
| `cliente` → `situacao_cliente` | N:1 | Situação do cadastro |
| `cliente` → `tipo_cliente` | N:1 | Tipo/segmento |
| `cliente` → `cliente_canal` | N:1 | Canal de origem |
| `cliente` → `concorrente` | N:1 | Concorrente associado |
| `cliente` → `conta_caixa` | N:1 | Conta padrão de cobrança |
| `cliente` → `municipio` | N:1 | Município para NF-e |
| `cliente` → `regiao_estadual` | N:1 | Região de atendimento |
| `cliente` → `cliente` (pai) | N:1 | Hierarquia matriz/filial |
| `cliente` → `cliente_contato` | 1:N | Contatos do cliente |
| `cliente` → `cliente_documento` | 1:N | Documentos anexados |
| `lancamento_receita` → `cliente` | N:1 | Cobranças |
| `contrato` → `cliente` | N:1 | Contratos |
| `negociacao` → `cliente` | N:1 | Pipeline CRM |

---

## 11. Comportamentos a Confirmar no Código Scriptcase
- [ ] Lógica de alternância FÍSICA/JURÍDICA: quais campos mostrar/ocultar/validar
- [ ] Busca automática de endereço por CEP (ViaCEP ou similar)
- [ ] Regra de formatação do CNPJ vs CPF no campo mascarado
- [ ] Geração de `chave_acesso` para portal do cliente
- [ ] Envio de e-mail ao criar cliente (ou apenas no portal?)
- [ ] Filtro lateral: é um painel fixo do Scriptcase Grid ou componente customizado?
- [ ] Ação de "Seleção" no painel lateral: aplica filtro na lista ou navega?
- [ ] Paginação: tamanho padrão por usuário ou configuração global?
- [ ] Permissão de exclusão: soft delete (inativar) ou hard delete?

---

## 12. Dúvidas Abertas
- Quais campos aparecem apenas para PF (Física) vs PJ (Jurídica)?
- O campo "Origem" (ex: "FORÇA TAREFA - 2024") é o mesmo que `cliente_canal`?
- "Conta Caixa" no formulário é a conta padrão de cobrança ou de recebimento?
- Existe validação de CNPJ (dígito verificador) antes de salvar?
- O campo "Município Nota Fiscal" é obrigatório para emissão de NF-e?
- A aba "Dados adicionais" tem sub-abas ou apenas campos?
- Existe integração com Receita Federal para validar/buscar dados pelo CNPJ?
