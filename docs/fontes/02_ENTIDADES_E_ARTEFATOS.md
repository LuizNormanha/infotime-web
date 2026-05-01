# 02 — Entidades e artefatos (corpus v3)

Fonte: [`migration-source/infotime-migration/`](../../migration-source/infotime-migration) extraído de `infotime-migration_v3.zip`. Contagens automáticas (revisar após limpeza de corpus).

**Legenda:** TLL = arquivos `.tll` em `database/`; SS = ficheiros em `screenshots/`; PHP = ficheiros `.php` em `scriptcase/`; MD = ficheiros `.md` em `specs/`.

| Entidade | Módulo | Prioridade | TLL | SS | PHP | MD | Lacunas de evidência (inicial) |
|----------|--------|------------|-----|----|----|----|--------------------------------|
| agenda | CRM | Média | 6 | 0 | 6 | 4 | Sem PNG na pasta; validar outras fontes ou `screenshots_v*`. |
| almoxarifado | ALM | Média | 9 | 18 | 31 | 8 | — |
| almoxarifado-baixa | ALM | Média | 3 | 3 | 6 | 5 | — |
| almoxarifado-entrada | ALM | Média | 4 | 3 | 20 | 5 | — |
| almoxarifado-requisicao | ALM | Média | 2 | 3 | 8 | 5 | Poucos TLL; conferir relações no PHP. |
| aplicacao | SYS | Alta | 2 | 4 | 6 | 5 | — |
| auditoria | SYS | Alta | 2 | 2 | 5 | 5 | — |
| auth | SYS | Crítica | 1 | 2 | 13 | 4 | TLL mínimo (`webcam`); auth principal em `usuario`/sessão — cruzar corpus SYS. |
| avaliacao-infolab | CRM | Baixa | 3 | 4 | 3 | 6 | — |
| banco | FIN | Alta | 6 | 11 | 8 | 7 | — |
| boleto | FIN | Crítica | 1 | 0 | 2 | 4 | Sem screenshots locais. |
| cargo | RH | Média | 6 | 5 | 14 | 4 | — |
| cliente | CRM | Crítica | 16 | 10 | 25 | 6 | — |
| cliente-licenca | CRM | Alta | 10 | 3 | 6 | 5 | — |
| colaborador | RH | Alta | 6 | 9 | 15 | 7 | — |
| colaborador-rh | RH | Média | 18 | 0 | 49 | 5 | Sem screenshots; muitos PHP. |
| colaborador-tarefa | OPS | Média | 4 | 3 | 7 | 6 | — |
| colaborador-viagem | RH | Baixa | 7 | 4 | 18 | 4 | — |
| concorrente | CRM | Baixa | 1 | 3 | 3 | 1 | Specs mínimas (1 MD). |
| configuracao | SYS | Crítica | 9 | 7 | 11 | 4 | `tenacidade` e parâmetros globais — alinhar com TLLs em outras entidades. |
| conta-caixa | FIN | Crítica | 13 | 9 | 37 | 8 | — |
| contrato | CRM | Crítica | 3 | 10 | 11 | 7 | — |
| empresa | SYS | Crítica | 4 | 3 | 10 | 5 | — |
| fornecedor | FIN | Alta | 6 | 3 | 21 | 5 | — |
| grupo-usuario | SYS | Crítica | 5 | 3 | 14 | 6 | — |
| implantacao | OPS | Alta | 6 | 3 | 5 | 5 | — |
| lancamento-despesa | FIN | Crítica | 2 | 3 | 26 | 5 | — |
| lancamento-receita | FIN | Crítica | 9 | 5 | 25 | 5 | — |
| negociacao | CRM | Alta | 7 | 14 | 32 | 9 | — |
| nota-fiscal | FIN | Crítica | 3 | 3 | 7 | 6 | — |
| patrimonio | OPS | Média | 9 | 0 | 11 | 3 | Sem screenshots. |
| pix | FIN | Crítica | 1 | 0 | 1 | 4 | Sem screenshots; integração crítica. |
| plano-conta | FIN | Crítica | 4 | 8 | 27 | 7 | — |
| pop-documento | OPS | Baixa | 3 | 5 | 5 | 5 | — |
| portal-cliente | CRM | Alta | 6 | 0 | 1 | 4 | Sem screenshots; contém `tenacidade.tll` (tenant). |
| produto | CRM | Alta | 3 | 7 | 6 | 2 | Poucos MD em specs. |
| proposta | CRM | Crítica | 7 | 11 | 26 | 7 | — |
| retorno-cnab | FIN | Crítica | 1 | 1 | 9 | 5 | — |
| treinamento | OPS | Baixa | 2 | 1 | 3 | 4 | — |
| usuario | SYS | Crítica | 1 | 3 | 5 | 5 | Poucos TLL na pasta; usuário/credenciais em tabelas cruzadas — validar em `grupo-usuario` / aplicacao. |

## Entidades transversais sem pasta dedicada

- **`tenacidade`:** aparece como TLL em módulos dependentes (ex.: portal-cliente). Modelagem no pacote `database` como núcleo de tenant junto a configuração/usuário.

## Observação

Prioridades alinhadas ao índice em `files_v3.zip` (`00-indice-entidades.md`). Ajustar após revisão de negócio.
