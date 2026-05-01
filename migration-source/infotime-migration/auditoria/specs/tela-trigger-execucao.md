
# Tela: Tabela Trigger Execução

## 1. Nome da Tela
**Lista:** "Consulta Tabela Trigger Execução" | **Formulário:** "Inclusão Trigger Execução"
Módulo: **Sistema** → Auditoria

---

## 2. Objetivo da Tela
Controle e monitoramento de triggers/jobs agendados no sistema. Registra execuções de processos automáticos (recorrências, cobranças, sincronizações).

---

## 3. Campos Visíveis na Lista
_(Inferido)_
| # | Coluna | Tipo |
|---|---|---|
| 1 | Nome do Job | text |
| 2 | Data Execução | datetime |
| 3 | Status | badge |
| 4 | Duração | text |
| 5 | Id. | integer |

---

## 4. Campos Visíveis no Formulário
_(Provavelmente readonly — só para registro histórico)_

---

## 10. Relacionamentos
- Jobs de recorrência de lançamentos
- Envio de e-mails automáticos
- Processamento de PIX/CNAB

---

## 12. Dúvidas Abertas
- Esta tela é de administração interna ou acessível por todos os usuários?
- Existe agendamento (cron) configurável nesta tela?
