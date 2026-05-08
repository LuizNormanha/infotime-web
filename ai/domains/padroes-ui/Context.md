# Contexto — Padrões de UI (template Liga Sistemas)

## Objetivo

Este domínio **não** descreve regras de negócio de um produto (ex.: folha, estoque, laboratório). Ele descreve **como telas devem se comportar e se integrar** ao stack padrão do template:

- **Web:** Next.js, componentes `Liga*`, PrimeReact, **next-intl**.
- **API:** NestJS, DTOs, validação, multi-tenant quando aplicável.
- **Contratos:** listagens com paginação no servidor, formulários com layout configurável.

Qualquer aplicação nova (InfoTIME Web, outro ERP, portal, etc.) **reutiliza estes padrões** ao montar listagens e formulários; o que muda por projeto são entidades, rotas, `ai/domains/<seu-dominio>` e o schema do banco.

## Relação com o repositório

- Implementação de referência dos padrões de **listagem:** `web/src/components/formulario-pesquisa/LigaListagemBase.tsx` e `liga-listagem.types.ts`.
- **Formulários:** `web/src/components/formulario-cadastro/` e `LigaFormularioCadastroBase`.
- Regras explícitas e numeradas: **`Rules.md`** (usadas em code review, agentes e MCP `infolab.crud_briefing`).

## O que não entra aqui

- Nomes de tabelas ou fluxos de um produto legado.
- Regras fiscais, clínicas ou de domínio específico — isso fica em `ai/domains/<tema>` por projeto.
