# Alinhamento e espaçamento em formulários (grid Liga)

**Referência de implementação:** formulário de cliente Infotime — `web/src/components/cliente/liga-cliente-infotime.css`, `liga-cliente-infotime-formulario-secoes.tsx`, tokens em `.liga-cliente-infotime-painel` (`liga-cliente-infotime.css`).

## Regra geral

- **Alinhar colunas** entre linhas do mesmo bloco usando **CSS Grid** com trilhas explícitas; quando uma linha inferior for 50% / 50% (ex.: Contatos | Informações), a **primeira coluna das linhas superiores** deve ter a **mesma participação em `fr`** que a metade esquerda dessa linha (ex.: coluna 1 com `1fr` e colunas 2–4 somando `1fr`), para coincidir bordas verticais.
- **Espaço entre campos:** usar **somente** os tokens do módulo — `--liga-cli-form-gap-col` e `--liga-cli-form-gap-row`. Evitar `margin` extra entre linhas que já usam `row-gap` ou um wrapper com `gap` idêntico.
- **Vários blocos empilhados** (ex.: grid 2 linhas + linha de textareas): preferir **flex column** no wrapper com `gap: var(--liga-cli-form-gap-row)` igual ao `row-gap` do grid interno (`liga-cliente-infotime-form-ident-secao`).
- **Controles em `.primeira-linha-controles` (flex):** `flex: 1 1 0%`, `min-width: 0` e `width: 100%` em inputs/dropdowns quando a célula deve preencher a trilha, evitando “vão” visual até o próximo campo.
- Formulários **`liga-*` novos** devem **reutilizar** esses tokens ou apontar para eles com `var(--liga-cli-form-gap-col)` / `var(--liga-cli-form-gap-row)` em variáveis locais.

Critério: **sem espaçamento aleatório** — só o **espaçamento já regulamentado** no padrão do cliente (ou equivalente documentado no mesmo arquivo CSS do módulo).
