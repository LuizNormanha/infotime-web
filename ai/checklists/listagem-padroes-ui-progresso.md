# Checklist — listagens vs `padroes-ui` §11

Fonte: [`ai/domains/padroes-ui/Rules.md`](../domains/padroes-ui/Rules.md) §11.5–11.7. Referências de tela: `web/src/app/cliente/listagem/page.tsx`, `web/src/app/atendimento/listagem/page.tsx`.

## Critérios (§11.5–11.7)

- **Shell:** `LigaListagemBase` com textos via i18n (`nomeTabela`, `placeholderBusca`, `textoNenhumRegistro`, `ariaLabelAcaoLinha`); **omitir** `subtitulo` salvo exceção documentada (§3.5 / §11.6).
- **Servidor:** `useListagemCrudServidor` + spread **`{...servidor}`** após guarda `servidor == null` no modo listagem normal (fora de `modoSelecao`, onde `servidor` é `undefined` por desenho).
- **Colunas × API:** coluna no dropdown “Pesquisar por” com **`pesquisaServidor: true`** + **`campoConsulta`** na whitelist do Nest; **`filtroRefinado`** coerente com SQL quando há `aoFiltrosRefinadoServidor`.
- **SN / ativo:** flags SN genéricas `valorExibicao: "simNao"`; situação ativo/inativo com rótulos i18n (§11.7).
- **Datas:** `formatoDataListagem` explícito quando não for `auto` (§11.4).
- **Id:** `chavePrimaria` definida; coluna técnica alinhada à API (§11.7 — ordem no motor).
- **API pareada:** `GET` listar com `cargaInicial`, `pagina`, `tamanhoPagina`, `q`, `campoPesquisa`, `filtroRefinado` e `{ dados, total }` com filtros no SQL para catálogos grandes.

## Inventário (64 telas)

| Rota (app) | Arquivo | Status | Observações | Data |
|------------|---------|--------|-------------|------|
| `(mapa)/mapa-definicao` | `web/src/app/(mapa)/mapa-definicao/listagem/page.tsx` | OK | Padrão §11 | 2026-04-29 |
| `(mapa)/mapa-producao` | `web/src/app/(mapa)/mapa-producao/listagem/page.tsx` | OK | Padrão §11 | 2026-04-29 |
| `analisador` | `web/src/app/analisador/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `aplicacao` | `web/src/app/aplicacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `atendimento` | `web/src/app/atendimento/listagem/page.tsx` | OK | Referência processo §11 | 2026-04-29 |
| `cbo` | `web/src/app/cbo/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `cid` | `web/src/app/cid/listagem/page.tsx` | OK | Spread `{...servidor}` | 2026-04-29 |
| `cliente` | `web/src/app/cliente/listagem/page.tsx` | OK | Referência layout §11.6; `ariaLabel` modo seleção i18n | 2026-04-29 |
| `computador` | `web/src/app/computador/listagem/page.tsx` | OK | Cadastros > Acesso · Lote 1 (§11.8 padroes-ui) | 2026-04-29 |
| `conselho-regional` | `web/src/app/conselho-regional/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `convenio` | `web/src/app/convenio/listagem/page.tsx` | OK | `ariaLabel` seleção i18n | 2026-04-29 |
| `especialidade-medica` | `web/src/app/especialidade-medica/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `etnia` | `web/src/app/etnia/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `exame` | `web/src/app/exame/listagem/page.tsx` | OK | Lote E | 2026-04-29 |
| `exame-material` | `web/src/app/exame-material/listagem/page.tsx` | OK | Lote E | 2026-04-29 |
| `exame-material-lab-apoio` | `web/src/app/exame-material-lab-apoio/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `fatura` | `web/src/app/fatura/listagem/page.tsx` | OK | Lote E | 2026-04-29 |
| `feriado` | `web/src/app/feriado/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `grupo` | `web/src/app/grupo/listagem/page.tsx` | OK | Whitelist alinhada | 2026-04-29 |
| `grupo-perfil` | `web/src/app/grupo-perfil/listagem/page.tsx` | OK | Cadastros > Acesso · Lote 2 (§11.8) | 2026-04-29 |
| `implantacao-tenacidade` | `web/src/app/implantacao-tenacidade/listagem/page.tsx` | OK | `subtitulo` removido (§3.5); backend in-memory documentado em tenacidade Rules | 2026-04-29 |
| `indicacao` | `web/src/app/indicacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `integracao` | `web/src/app/integracao/listagem/page.tsx` | OK | Pesquisa `ativo` + whitelist API | 2026-04-29 |
| `lab-apoio` | `web/src/app/lab-apoio/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `lab-apoio-unidade` | `web/src/app/lab-apoio-unidade/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `local-armazenamento` | `web/src/app/local-armazenamento/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `material` | `web/src/app/material/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `medicamento` | `web/src/app/medicamento/listagem/page.tsx` | OK | Revisado | 2026-04-29 |
| `medico` | `web/src/app/medico/listagem/page.tsx` | OK | Lote E | 2026-04-29 |
| `modelo-resultado` | `web/src/app/modelo-resultado/listagem/page.tsx` | OK | Lote D | 2026-04-29 |
| `motivo-cancelamento` | `web/src/app/motivo-cancelamento/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-desconto` | `web/src/app/motivo-desconto/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-exame-retificacao` | `web/src/app/motivo-exame-retificacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-orcamento-rejeicao` | `web/src/app/motivo-orcamento-rejeicao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-quarentena` | `web/src/app/motivo-quarentena/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-recoleta` | `web/src/app/motivo-recoleta/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `motivo-retificacao` | `web/src/app/motivo-retificacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `pendencia-resultado` | `web/src/app/pendencia-resultado/listagem/page.tsx` | OK | Lote D | 2026-04-29 |
| `porta-serial` | `web/src/app/porta-serial/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `preco-fator` | `web/src/app/preco-fator/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `preco-tabela` | `web/src/app/preco-tabela/listagem/page.tsx` | OK | Spread `{...servidor}` | 2026-04-29 |
| `procedencia` | `web/src/app/procedencia/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `questionario` | `web/src/app/questionario/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `raca` | `web/src/app/raca/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `recipiente` | `web/src/app/recipiente/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `serie-nota-fiscal-servico` | `web/src/app/serie-nota-fiscal-servico/listagem/page.tsx` | OK | Lote D | 2026-04-29 |
| `setor` | `web/src/app/setor/listagem/page.tsx` | OK | `ativo` em whitelist + `pesquisaServidor`; aria i18n | 2026-04-29 |
| `situacao-coleta` | `web/src/app/situacao-coleta/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tenacidade-configuracao` | `web/src/app/tenacidade-configuracao/listagem/page.tsx` | OK | Colunas técnicas na whitelist pesquisa | 2026-04-29 |
| `tipo-aplicacao` | `web/src/app/tipo-aplicacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-destino-resultado` | `web/src/app/tipo-destino-resultado/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-estado-civil` | `web/src/app/tipo-estado-civil/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-evento` | `web/src/app/tipo-evento/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-indicacao` | `web/src/app/tipo-indicacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-integracao` | `web/src/app/tipo-integracao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-interface` | `web/src/app/tipo-interface/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `tipo-pagamento` | `web/src/app/tipo-pagamento/listagem/page.tsx` | OK | Spread servidor; `documento_obrigatorio` pesquisável | 2026-04-29 |
| `tipo-relatorio` | `web/src/app/tipo-relatorio/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `unidade-atendimento` | `web/src/app/unidade-atendimento/listagem/page.tsx` | OK | Lote C | 2026-04-29 |
| `unidade-federacao` | `web/src/app/unidade-federacao/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `usuario` | `web/src/app/usuario/listagem/page.tsx` | OK | Cadastros > Acesso · Lote 3: ordem colunas §11.7; busca ativo (API) | 2026-04-29 |
| `usuario-permissoes` | `web/src/app/usuario-permissoes/listagem/page.tsx` | OK | Cadastros > Acesso · Lote 2: colunas §11.7, flags i18n, ícone menu DST | 2026-04-29 |
| `vet-especie` | `web/src/app/vet-especie/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |
| `vet-raca` | `web/src/app/vet-raca/listagem/page.tsx` | OK | Catálogo | 2026-04-29 |

**Status:** `OK` | `Parcial` | `Pendente` | `Em progresso`

---

Última revisão em lote: padronização §11 (spreads servidor, aria i18n, subtítulo implantação, whitelist pesquisa setor/integração/tenacidade-config/tipo-pagamento).
