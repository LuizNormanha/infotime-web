
# Tela: Tipo de Negócio

## 1. Nome da Tela
**Lista:** "Consulta Tipos de Negócio" | **Formulário:** "Inclusão Tipo de Negócio"
Módulo: **Comercial**

---

## 2. Objetivo da Tela
Classificação das negociações por tipo de oportunidade comercial. Permite segmentar o pipeline e analisar indicadores por tipo.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Ativo | badge |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
| Campo | Tipo | Obrigatório |
|---|---|---|
| Descrição | text | Sim |
| Ativo | radio | Sim |
| Id. | readonly | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Descrição

---

## 10. Relacionamentos
- `negociacao` → `tipo_negocio` (N:1)

---

## 12. Dúvidas Abertas
- Tipos são segmentados por módulo do produto (ex: InfoLAB, InfoPATH)?
