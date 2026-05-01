
# Tela: Retorno CNAB

## 1. Nome da Tela
**Lista:** "Consulta Retornos CNAB"
Módulo: **Financeiro** → Retornos

---

## 2. Objetivo da Tela
Processamento de arquivos de retorno bancário (CNAB 240/400). Realiza a baixa automática de títulos pagos a partir do arquivo enviado pelo banco, atualizando os lançamentos de receita correspondentes.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Nome Arquivo | text |
| 2 | Data Retorno | date |
| 3 | Qtd. Registros | integer |
| 4 | Qtd. Pagos | integer |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Sem formulário de inclusão — apenas upload de arquivo)_
Tela especial: `Retorno_CNAB_Ctr` — wizard de importação

---

## 5. Botões e Ações Disponíveis
| Botão | Função |
|---|---|
| [Receber Retorno] | Importar arquivo CNAB |
| [Ver Detalhe] | Abrir `Retorno_Detalhe_Lst` |
| [Exportar CSV] | Exportar competência em CSV |

---

## 6. Filtros
- Filtro por Data, Banco

---

## 7. Abas
Sem formulário convencional — é uma tela de importação.

---

## 10. Relacionamentos Sugeridos
| Relacionamento | Cardinalidade |
|---|---|
| `retorno` → `lancamento_receita` (via nosso_numero) | 1:N |
| `retorno` → `banco` | N:1 |

---

## 11. Comportamentos a Confirmar
- [ ] Ao importar: cruzamento por `nosso_numero` ↔ `lancamento_receita.nosso_numero`?
- [ ] Divergência de valor: alerta manual ou baixa automática com diferença?
- [ ] Tipo de arquivo: CNAB 400 posições ou CNAB 240?
- [ ] Retorno duplicado: detecção de arquivo já processado?

---

## 12. Dúvidas Abertas
- O `historico_pagamento` armazena o log de cada linha processada?
- Existe tela de pré-visualização antes de confirmar a baixa?
- O arquivo é armazenado no banco após importação?
