# Entrada de corpus e migração — convenções de pastas

## Convenção adotada

| Caminho | Função |
|---------|--------|
| [`migration-input/zips-originais/`](../migration-input/zips-originais) | Armazenamento dos arquivos `.zip` originais (fonte imutável). |
| [`migration-source/infotime-migration/`](../migration-source/infotime-migration) | Corpus **ativo** extraído de `infotime-migration_v3.zip` (pastas por entidade: `screenshots`, `database`, `scriptcase`, `specs`). |

## Equivalência com `_input/`

Documentação e prompts externos podem referir-se a `_input/`. Neste repositório o papel de `_input/` é cumprido por:

- **`migration-input/`** para os zips;
- **`migration-source/infotime-migration/`** para a árvore descompactada usada em análise e em [`specs/`](./) do projeto.

Se a equipe desejar o caminho literal `C:\prj\lann\infotime-web\_input`, pode criar **atalho** ou **junction** no Windows apontando para `migration-input`, ou manter apenas esta documentação.

## Atualizar o corpus local

1. Colocar ou atualizar `infotime-migration_v3.zip` em `migration-input/zips-originais/`.
2. Extrair na raiz de `migration-source/` (deve resultar em `migration-source/infotime-migration/...`).

```bash
unzip -o migration-input/zips-originais/infotime-migration_v3.zip -d migration-source/
```

## Controle de versão

O diretório `migration-source/` pode ser grande. A equipe pode versioná-lo no Git para reprodutibilidade **ou** listá-lo em `.gitignore` e exigir extração local; o [`README.md`](../README.md) descreve o fluxo escolhido.
