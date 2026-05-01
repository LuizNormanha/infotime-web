
# Tela: Tipo de Colaborador

## 1. Nome da Tela
**Lista:** "Consulta Tipos de Colaborador" | **Formulário:** "Inclusão Tipo de Colaborador"
Módulo: **R.H.** → Cadastros

---

## 2. Objetivo da Tela
Classificação dos colaboradores por vínculo empregatício: CLT, PJ, Estágio, etc. O tipo controla obrigatoriedade de campos CLT.

---

## 3. Campos Visíveis na Lista
| # | Coluna | Tipo |
|---|---|---|
| 1 | Descrição | text |
| 2 | Exige Data Admissão | badge |
| 3 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
| Campo | Tipo | Obrigatório | Observação |
|---|---|---|---|
| Descrição | text | Sim | |
| Exige data admissão | select: Sim/Não | Sim | Controla obrigatoriedade de campos CLT |
| Id. | readonly | — | |

---

## 5. Botões
- + Incluir | ← Voltar

---

## 8. Campos Obrigatórios
- Descrição
- Exige data admissão

---

## 10. Relacionamentos
- `colaborador` → `tipo_colaborador` (N:1)

---

## 11. Comportamentos a Confirmar
- [ ] "Exige data admissão = Sim": quais outros campos CLT são obrigados?
- [ ] Tipo PJ: isenta de campos de carteira de trabalho?

---

## 12. Dúvidas Abertas
- Existe campo de alíquota de IR/INSS por tipo?
