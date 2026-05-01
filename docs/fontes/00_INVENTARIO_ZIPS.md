# 00 — Inventário dos arquivos ZIP

## Zips analisados

| Arquivo | Tamanho aprox. | Papel |
|---------|------------------|--------|
| `files_v0.zip` | ~31 MB | Análise agregada, plano e índices (corpus `files` v0). |
| `files_v1.zip` | ~18 KB | Evolução do índice / padrões (pequeno delta). |
| `files_v2.zip` | ~19 KB | Regras detalhadas complementares a entidades críticas. |
| `files_v3.zip` | ~7 KB | **Índice consolidado** (`00-indice-entidades.md`) + **padrões de arquitetura** (`01-padroes-arquitetura.md`). |
| `infotime-migration_v0.zip` | ~31 MB | Corpus inicial por entidade (estrutura infotime-migration). |
| `infotime-migration_v1.zip` | ~35 MB | Evolução do corpus. |
| `infotime-migration_v2.zip` | ~35 MB | Evolução do corpus. |
| `infotime-migration_v3.zip` | ~35 MB | **Corpus principal** (40 entidades, TLL, Scriptcase, specs, screenshots). |
| `screenshots_v1.zip` | ~7.4 MB | Pacote adicional de capturas (versão 1). |
| `screenshots_v2.zip` | ~8.0 MB | Pacote adicional de capturas (versão 2). |
| `screenshots_v3.zip` | ~8.0 MB | Pacote adicional de capturas (versão 3). |

Localização no repositório: [`migration-input/zips-originais/`](../../migration-input/zips-originais).

## Versões autoritativas

- **Corpus estruturado por entidade:** `infotime-migration_v3.zip` é a **fonte principal** para screenshots, `database/*.tll`, `scriptcase/` e `specs/` por pasta de entidade.
- **Índice e convenções transversais:** `files_v3.zip` é o mais recente entre `files_v*`; prevalece sobre v0–v2 para índice e documentos curtos de arquitetura.

## Arquivos complementares

- `files_v0.zip` a `files_v2.zip`: recuperar detalhe de regras ou estrutura quando **ausentes** ou **menos explícitos** em v3.
- `infotime-migration_v0.zip` a `v2.zip`: mesma lógica — uso **histórico** para gaps; não duplicar documentação quando v3 já cobre.
- `screenshots_v1.zip` a `v3.zip`: tratar como **acervo complementar** de imagens; cruzar com as pastas `screenshots/` dentro de `infotime-migration_v3` (podem sobrepor ou adicionar ângulos). Em conflito de aparência, **priorizar** o pacote `screenshots` de **maior sufixo** alinhado ao release do corpus (v3), registrando divergência em [`03_DUPLICIDADES_E_VERSOES.md`](03_DUPLICIDADES_E_VERSOES.md).

## O que existe em cada tipo de zip

| Tipo | Conteúdo típico |
|------|-------------------|
| `files_v*.zip` | Markdown de índice, regras agregadas, padrões (não substitui o corpus por entidade). |
| `infotime-migration_v*.zip` | Árvore `infotime-migration/<entidade>/{screenshots,database,scriptcase,specs}`. |
| `screenshots_v*.zip` | Somente imagens (organização interna pode variar); usar para evidência visual extra. |

## Instrução “gere primeiro a documentação”

Se existir como arquivo solto fora do repositório, deve ser referenciado aqui pela equipe. **Regra de projeto fixada:** nenhuma implementação funcional de módulo antes dos documentos de padrão em [`docs/`](../) e das especificações em [`specs/`](../../specs/) por entidade.

## Decisão final de uso

1. **Base principal:** `infotime-migration_v3.zip` → extraído em [`migration-source/infotime-migration/`](../../migration-source/infotime-migration).
2. **Índice e padrões texto:** `files_v3.zip` cruzado com os documentos `PADRAO_*` do repositório.
3. **Versões anteriores:** apenas para preencher lacunas e registrar diferenças.
