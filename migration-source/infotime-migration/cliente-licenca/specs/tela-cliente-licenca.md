
# Tela: Licença do Cliente

## 1. Nome da Tela
**Lista:** "Lista de Licenças de Clientes" | **Formulário:** "Inclusão Licença de Cliente"
Módulo: **Clientes** → Licenças

---

## 2. Objetivo da Tela
Controle de licenças de software (InfoLAB e outros) instaladas nos clientes. Define chave de acesso ao portal e ao InfoLAB, validade e quantidade de usuários.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Cliente | text |
| 2 | Chave Acesso | text |
| 3 | Data Expiração | date |
| 4 | Qtd. Licenças | integer |
| 5 | Situação | badge (Ativo/Expirado) |
| 6 | Id. | integer |

---

## 4. Campos Visíveis no Formulário

### Identificação (cabeçalho fixo)
_(Inferido — screenshot mostra formulário genérico)_
| Campo | Tipo | Obrigatório |
|---|---|---|
| Cliente | select | Sim |
| Chave de Acesso | text | — |
| Data Expiração | date | — |
| Qtd. Licenças | integer | — |
| Emite Boleto | radio: Sim/Não | — |

---

## 5. Botões e Ações
| Botão | Função |
|---|---|
| + Incluir | Salvar |
| [Gerar Chave] | Gerar nova `chave_acesso` |
| [Enviar Email] | Enviar chave ao cliente |
| [Download Licença] | Gerar arquivo de licença para o InfoLAB |

---

## 6. Filtros
- Filtros: Situação (Ativo/Expirado), Cliente, Data Expiração

---

## 8. Campos Obrigatórios
- Cliente

---

## 9. Máscaras
| Campo | Formato |
|---|---|
| Data Expiração | `DD/MM/YYYY` |
| Chave Acesso | UUID ou hash alfanumérico |

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `cliente.chave_acesso` | 1:1 com cliente |
| `cliente.data_expiracao` | — |
| `cliente.qtd_licenca` | — |

---

## 11. Comportamentos a Confirmar
- [ ] Chave gerada: UUID, hash MD5 ou outro formato?
- [ ] Expiração: bloqueio automático do acesso ao portal?
- [ ] "Emite Boleto" na licença: diferente do campo em `cliente`?
- [ ] Download de licença: arquivo binário criptografado?

---

## 12. Dúvidas Abertas
- Existe processo de renovação automática?
- A licença é por produto específico ou global para o cliente?
- Qual é o processo quando a licença expira e o cliente ainda tem contrato ativo?
