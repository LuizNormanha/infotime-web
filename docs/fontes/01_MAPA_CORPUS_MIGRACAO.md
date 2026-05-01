# 01 — Mapa do corpus de migração

## Estrutura esperada (fonte: `infotime-migration_v3.zip`)

```text
infotime-migration/
  [entidade]/
    screenshots/
    database/
    scriptcase/
    specs/
```

## Pastas e o que extrair de cada uma

### `screenshots/`

- **Propósito:** evidência visual do legado (listagens, formulários, filtros, grids).
- **Uso na migração:** definir **aparência**, **campos visíveis**, **rótulos**, **botões** e **fluxo** de navegação na nova UI (PrimeReact).
- **Regra:** screenshot não substitui DDL; campos não visíveis podem existir no TLL.

### `database/`

- Arquivos **`.tll`**: definição tabular legada (campos, tipos, relações implícitas).
- **Uso:** fonte para modelo **Prisma** e constraints; nomes físicos preservados com `@@map` / `@map` quando necessário.
- Schema PostgreSQL alvo: `liga_infotime` (configurado no Prisma).

### `scriptcase/`

- Fontes **PHP** geradas pelo Scriptcase e, quando existir, **`events.md`** (eventos consolidados).
- **Uso:** extrair **intenção** de validações, SQL customizado, efeitos colaterais e integrações — **não** tradução linha a linha.
- Priorizar `events.md` antes de varrer PHP completo.

### `specs/`

- Markdown já extraído no corpus (`mapa-campos`, `regras-negocio`, telas, etc.).
- **Uso:** consolidação funcional; cruzar obrigatoriamente com TLL + screenshots + eventos.

## Fluxo de leitura recomendado

1. `specs/` do corpus (visão rápida).
2. `screenshots/` (o que o usuário vê).
3. `database/*.tll` (verdade estrutural).
4. `scriptcase/events.md` e trechos PHP pertinentes (comportamento).

## Corpus complementar

- Pacotes `screenshots_v1`–`v3`: podem conter capturas adicionais por módulo; mapear para a entidade correspondente ao analisar telas.
