
# Tela: Notícias InfoLAB

## 1. Nome da Tela
**Lista:** "Consulta Notícias InfoLAB" | **Formulário:** "Inclusão Notícia InfoLAB"
Módulo: **InfoLAB**

---

## 2. Objetivo da Tela
Publicação de comunicados e notícias para os clientes que utilizam o InfoLAB. Notícias com flag "urgente" aparecem em destaque no InfoLAB do cliente.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Título | text |
| 2 | Urgente | badge |
| 3 | Ativo | badge |
| 4 | Data Publicação | date |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Inferido do DDL `info_lab_noticias`)_
| Campo | Tipo | Obrigatório |
|---|---|---|
| Título | text | Sim |
| Conteúdo | textarea/rich text | Sim |
| Urgente | radio: Sim/Não | — |
| Ativo | radio: Sim/Não | Sim |
| Data Publicação | date | — |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Título, Conteúdo, Ativo

---

## 10. Relacionamentos
- `info_lab_noticias` → `tenacidade` (N:1) — publicada para todos os clientes do tenant

---

## 11. Comportamentos a Confirmar
- [ ] "Urgente = Sim": exibe popup ou banner no InfoLAB?
- [ ] "Ativo = Não": oculta do InfoLAB mas mantém no histórico?

---

## 12. Dúvidas Abertas
- Existe segmentação de notícia por cliente específico?
- Tem suporte a imagens no conteúdo?
