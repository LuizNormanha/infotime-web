
# Tela: Almoxarifado

## 1. Nome da Tela
**Lista:** "Lista de Almoxarifado" | **Formulário:** "Novo registro de Almoxarifado"
Módulo: **Estoque**

---

## 2. Objetivo da Tela
Cadastro dos locais físicos de armazenamento (almoxarifados). Define quais usuários podem atender requisições de cada almoxarifado e se possui baixa automática de estoque.

---

## 3. Campos Visíveis na Lista
_(Lista com estado "Registros não encontrados" — sem dados de exemplo)_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Sigla | text |
| 2 | Descrição | text |
| 3 | Empresa | text |
| 4 | Permite entrada | badge |
| 5 | Ativo | badge |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Empresa | select (autocomplete) | Sim | "Selecione..." |
| Sigla | text | Sim | |
| Descrição | text | Sim | |
| Permite entrada | toggle | — | |
| Ativo | radio: Sim / Não | Sim | Default: Sim |
| Id. | readonly | — | |

### Aba: Característica
| Campo | Tipo | Observação |
|---|---|---|
| Usuários que podem atender requisição | list box duplo (seleção múltipla) | Lista de usuários disponíveis / selecionados |
| Baixa automática | toggle | |

### Aba: Contato
_(Campos de contato do almoxarifado — responsável, telefone, email)_

### Aba: Endereço
_(Localização física: CEP, logradouro, cidade, estado)_

### Aba: Observações
_(Texto livre)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |

---

## 6. Filtros e Busca
- Busca rápida
- Filtros esperados: Empresa, Ativo

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Característica** | Usuários autorizados, baixa automática |
| 2 | **Contato** | Responsável, telefone, email |
| 3 | **Endereço** | Localização física |
| 4 | **Observações** | Texto livre |

---

## 8. Campos Obrigatórios Aparentes
- Empresa
- Sigla
- Descrição
- Ativo

---

## 9. Máscaras e Formatos Especiais
- CEP: `XXXXX-XXX`

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `almoxarifado` → `empresa` | N:1 |
| `almoxarifado` → `almoxarifado_usuario_atender` | 1:N |
| `almoxarifado` → `almoxarifado_produto` | 1:N |
| `almoxarifado_entrada` → `almoxarifado` | N:1 |
| `almoxarifado_requisicao` → `almoxarifado` | N:1 (origem e destino) |

---

## 11. Comportamentos a Confirmar
- [ ] "Permite entrada = toggle" vs `ativo`: qual é a diferença semântica?
- [ ] List box de usuários: exibe todos os usuários da tenacidade?
- [ ] "Baixa automática": baixa o quê automaticamente (ao atender requisição)?
- [ ] Múltiplos almoxarifados por empresa: sem restrição?

---

## 12. Dúvidas Abertas
- A "Sigla" é usada como código de identificação em outros módulos?
- "Permite entrada" impede criação de `almoxarifado_entrada` se desligado?
- Os usuários na list box são os mesmos do sistema ou apenas colaboradores?
