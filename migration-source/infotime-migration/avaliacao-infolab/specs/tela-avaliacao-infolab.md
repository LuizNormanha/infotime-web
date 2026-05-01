
# Tela: Avaliação InfoLAB

## 1. Nome da Tela
**Lista:** "Lista de Avaliações InfoLAB"
Módulo: **InfoLAB**

---

## 2. Objetivo da Tela
Exibe as avaliações enviadas pelos clientes via sistema InfoLAB. Funciona como NPS/pesquisa de satisfação com 5 notas e 2 respostas abertas. Apenas leitura no Infotime — avaliações são geradas pelo cliente.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | CNPJ | text mascarado |
| 2 | Usuário | text |
| 3 | Nota 1 | integer (1-5) |
| 4 | Nota 2 | integer (1-5) |
| 5 | Nota 3 | integer (1-5) |
| 6 | Nota 4 | integer (1-5) |
| 7 | Nota 5 | integer (1-5) |
| 8 | Data/Hora | datetime |
| 9 | Resposta 1 | text |
| 10 | Resposta 2 | text |

---

## 4. Campos Visíveis no Formulário
_(Sem formulário de inclusão — dados vêm do InfoLAB)_

---

## 5. Botões
| Botão | Função |
|---|---|
| Exportar | CSV/Excel |
| Ações ▾ | Filtros avançados |

---

## 6. Filtros
- Filtros: CNPJ, Período, Nota mínima

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `avaliacao` → `cliente` (via CNPJ) | N:1 |
| `avaliacao.usuario` | usuário do InfoLAB |

---

## 11. Comportamentos a Confirmar
- [ ] Avaliações chegam via API webhook do InfoLAB ou sync periódico?
- [ ] Existe integração configurada em `configuracao.integracao_infolab`?

---

## 12. Dúvidas Abertas
- As perguntas das notas estão configuradas em alguma tela?
- Existe cálculo de NPS automático?
- Avaliações são anônimas ou vinculadas ao usuário do InfoLAB?
