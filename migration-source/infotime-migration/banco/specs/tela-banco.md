
# Tela: Banco

## 1. Nome da Tela
**Lista:** "Consulta Bancos" | **Formulário:** "Inclusão Banco"
Módulo: **Cadastros**

---

## 2. Objetivo da Tela
Cadastro de bancos disponíveis para vinculação com agências e contas caixa. Inclui configurações de boleto bancário e CNAB.

---

## 3. Campos Visíveis na Lista
_(Não disponível nos screenshots — tela vazia esperada)_
Esperado:
| # | Coluna | Tipo |
|---|---|---|
| 1 | Código | text |
| 2 | Nome | text |
| 3 | Emite Boleto | badge |
| 4 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Número | text | Sim |
| Nome | text | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo |
|---|---|
| Home Page | url + botão "Navegar" |

### Aba: Observações
_(Texto livre)_

### Aba: Boletos e CNAB 400
_(Carteira, convênio, agência de cobrança, conta de cobrança, layouts CNAB 240/400)_

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| ← Voltar | Retornar |
| Navegar | Abrir Home Page |

---

## 6. Filtros e Busca
- Busca rápida por nome/código

---

## 7. Abas e Seções do Formulário
| # | Aba | Conteúdo |
|---|---|---|
| 1 | **Características** | Home Page |
| 2 | **Observações** | Texto livre |
| 3 | **Boletos e CNAB 400** | Configurações de boleto/CNAB |

---

## 8. Campos Obrigatórios Aparentes
- Número
- Nome

---

## 9. Máscaras e Formatos Especiais
- Número: texto (código do banco, ex: "001" = Banco do Brasil)

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `banco` → `agencia` | 1:N |
| `agencia` → `conta_caixa` | 1:N |
| `boleto` → `banco` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Aba "Boletos e CNAB 400": quais campos específicos (convênio, carteira, nosso número)?
- [ ] "Emite Boleto" (DB): controlado por campo na tabela banco ou na conta?
- [ ] Número do banco: validado contra tabela FEBRABAN?

---

## 12. Dúvidas Abertas
- O código do banco é livre ou segue padrão FEBRABAN?
- Existe suporte a CNAB 240 além do CNAB 400?
- Quais campos de boleto são por banco vs por conta caixa?
