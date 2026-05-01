#!/usr/bin/env python3
"""Gera specs/[entidade]/*.md a partir do corpus em migration-source/infotime-migration."""

from __future__ import annotations

import os
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
CORPUS = ROOT / "migration-source" / "infotime-migration"
SPECS_OUT = ROOT / "specs"

ENTITY_META: dict[str, tuple[str, str]] = {
    "agenda": ("CRM", "Média"),
    "almoxarifado": ("ALM", "Média"),
    "almoxarifado-baixa": ("ALM", "Média"),
    "almoxarifado-entrada": ("ALM", "Média"),
    "almoxarifado-requisicao": ("ALM", "Média"),
    "aplicacao": ("SYS", "Alta"),
    "auditoria": ("SYS", "Alta"),
    "auth": ("SYS", "Crítica"),
    "avaliacao-infolab": ("CRM", "Baixa"),
    "banco": ("FIN", "Alta"),
    "boleto": ("FIN", "Crítica"),
    "cargo": ("RH", "Média"),
    "cliente": ("CRM", "Crítica"),
    "cliente-licenca": ("CRM", "Alta"),
    "colaborador": ("RH", "Alta"),
    "colaborador-rh": ("RH", "Média"),
    "colaborador-tarefa": ("OPS", "Média"),
    "colaborador-viagem": ("RH", "Baixa"),
    "concorrente": ("CRM", "Baixa"),
    "configuracao": ("SYS", "Crítica"),
    "conta-caixa": ("FIN", "Crítica"),
    "contrato": ("CRM", "Crítica"),
    "empresa": ("SYS", "Crítica"),
    "fornecedor": ("FIN", "Alta"),
    "grupo-usuario": ("SYS", "Crítica"),
    "implantacao": ("OPS", "Alta"),
    "lancamento-despesa": ("FIN", "Crítica"),
    "lancamento-receita": ("FIN", "Crítica"),
    "negociacao": ("CRM", "Alta"),
    "nota-fiscal": ("FIN", "Crítica"),
    "patrimonio": ("OPS", "Média"),
    "pix": ("FIN", "Crítica"),
    "plano-conta": ("FIN", "Crítica"),
    "pop-documento": ("OPS", "Baixa"),
    "portal-cliente": ("CRM", "Alta"),
    "produto": ("CRM", "Alta"),
    "proposta": ("CRM", "Crítica"),
    "retorno-cnab": ("FIN", "Crítica"),
    "treinamento": ("OPS", "Baixa"),
    "usuario": ("SYS", "Crítica"),
}


def read_text(p: Path, limit: int | None = None) -> str:
    if not p.exists():
        return ""
    try:
        data = p.read_text(encoding="utf-8", errors="replace")
        if limit:
            return data[:limit]
        return data
    except OSError:
        return ""


def list_files(dir_path: Path, pattern: str) -> list[str]:
    if not dir_path.exists():
        return []
    return sorted(str(p.relative_to(dir_path)) for p in dir_path.rglob(pattern))


def main() -> None:
    if not CORPUS.exists():
        raise SystemExit(f"Corpus não encontrado: {CORPUS}")

    for ent in sorted(CORPUS.iterdir()):
        if not ent.is_dir():
            continue
        name = ent.name
        mod, pri = ENTITY_META.get(name, ("—", "—"))

        db_dir = ent / "database"
        sc_dir = ent / "scriptcase"
        sp_dir = ent / "specs"
        ss_dir = ent / "screenshots"

        tlls = list_files(db_dir, "*.tll")
        pngs = list_files(ss_dir, "*.png") + list_files(ss_dir, "*.jpg")
        php_files = [f for f in list_files(sc_dir, "*.php")][:25]
        corpus_specs = list_files(sp_dir, "*.md")

        events_md = read_text(sc_dir / "events.md")
        regras_corpus = read_text(sp_dir / "regras-negocio.md") or read_text(
            sp_dir / "mapa-campos.md", 4000
        )

        out_dir = SPECS_OUT / name
        out_dir.mkdir(parents=True, exist_ok=True)

        # README.md
        readme = f"""# Especificação — {name}

## Objetivo

Migrar o módulo **{name}** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** {mod}
- **Prioridade:** {pri}

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/{name}/database/`

| Arquivo TLL |
|-------------|
"""
        for t in tlls:
            readme += f"| `{t}` |\n"
        if not tlls:
            readme += "| *(nenhum .tll na pasta — validar outras entidades / DDL agregado)* |\n"

        readme += f"""
## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/{name}/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

"""
        for p in php_files:
            readme += f"- `{p}`\n"
        if not php_files:
            readme += "- *(nenhum PHP listado)*\n"

        readme += f"""
## Specs originais do corpus

"""
        for s in corpus_specs:
            readme += f"- `{s}`\n"
        if not corpus_specs:
            readme += "- *(nenhum markdown em specs/)*\n"

        readme += """
## Regras críticas

Resumo inicial em [`regras-scriptcase.md`](regras-scriptcase.md). Refinar durante implementação.

## Dependências

Registrar bloqueios em [`duvidas-abertas.md`](duvidas-abertas.md).

## Riscos

Ver [`docs/fontes/04_RISCOS_DA_MIGRACAO.md`](../../docs/fontes/04_RISCOS_DA_MIGRACAO.md) e completar por entidade aqui quando aplicável.

## Status de prontidão para implementação

| Item | Status |
|------|--------|
| Evidências lidas | Em revisão |
| modelo-dados | Rascunho |
| API | Rascunho |
| Frontend | Rascunho |
| Permissões | Rascunho |
"""
        (out_dir / "README.md").write_text(readme, encoding="utf-8")

        # telas.md
        telas = f"""# Telas — {name}

## Screenshots (corpus)

"""
        if pngs:
            for g in pngs[:40]:
                telas += f"- `{g}`\n"
        else:
            telas += "- *(sem imagens na pasta screenshots — ver zips `screenshots_v*` ou outras entidades)*\n"

        telas += f"""
## Documentação de telas no corpus

"""
        for md in corpus_specs:
            if "tela" in md.lower():
                telas += f"- `migration-source/infotime-migration/{name}/specs/{md}`\n"

        telas += """
## Lista (novo sistema)

- DataTable server-side, filtros e ordenação conforme [`docs/PADRAO_LISTAS.md`](../../docs/PADRAO_LISTAS.md).

## Formulário (novo sistema)

- FormShell + FormFooter + ActionsBar + campos compartilhados conforme [`docs/PADRAO_FORMULARIOS.md`](../../docs/PADRAO_FORMULARIOS.md).

## Notas

Refinar rótulos e passos com base nos PNG e nos markdown `tela-*.md` do corpus.
"""
        (out_dir / "telas.md").write_text(telas, encoding="utf-8")

        # modelo-dados.md
        modelo = f"""# Modelo de dados — {name}

## Origem

Arquivos `.tll` em `migration-source/infotime-migration/{name}/database/`.

## Tabelas

"""
        for t in tlls:
            tpath = db_dir / t
            head = read_text(tpath, 8000)
            modelo += f"\n### `{t}`\n\n```sql\n{head.strip()}\n```\n"

        if not tlls:
            modelo += "\n*(Sem TLLs nesta pasta; modelo pode estar em outra entidade ou DDL global.)*\n"

        modelo += """
## Prisma (próximos passos)

- Converter para models no pacote `packages/database` seguindo [`docs/PADRAO_PRISMA.md`](../../docs/PADRAO_PRISMA.md).
- Preservar nomes físicos com `@@map` / `@map`.
"""
        (out_dir / "modelo-dados.md").write_text(modelo, encoding="utf-8")

        # regras-scriptcase.md
        regras = f"""# Regras Scriptcase — {name}

## events.md (corpus)

```markdown
{events_md.strip() or "(arquivo ausente ou vazio)"}
```

## Trechos consolidados do corpus (specs)

```markdown
{regras_corpus.strip()[:12000] or "(sem regras-negocio / mapa-campos no corpus)"}
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
"""
        (out_dir / "regras-scriptcase.md").write_text(regras, encoding="utf-8")

        # mapa-campos.md
        mapa_path = sp_dir / "mapa-campos.md"
        mapa_body = read_text(mapa_path)
        mapa = f"""# Mapa de campos — {name}

## Corpus

"""
        if mapa_body.strip():
            mapa += f"\n```markdown\n{mapa_body.strip()[:20000]}\n```\n"
        else:
            mapa += "\n*(Gerar a partir dos TLLs e screenshots — `mapa-campos.md` ausente no corpus desta entidade.)*\n"

        mapa += f"""
## Tabelas TLL

"""
        for t in tlls:
            mapa += f"- `{t}`\n"

        mapa += """
## UI vs banco

- Todo campo de UI deve existir em TLL/spec/screenshot validado.
"""
        (out_dir / "mapa-campos.md").write_text(mapa, encoding="utf-8")

        # api.md
        api = f"""# API — {name}

## Endpoints alvo (REST)

Conforme [`docs/PADRAO_API_CRUD.md`](../../docs/PADRAO_API_CRUD.md):

```text
GET    /api/{name.replace('-', '/')}   # ajustar pluralização real na implementação
GET    /api/.../:id
POST   /api/...
PUT    /api/.../:id
DELETE /api/.../:id
```

## Query de lista

- `ListQuery` / `ListResponse` padrão.

## Schemas Zod

- Body e query em `apps/api/src/modules/{name}/` *(path kebab a definir na implementação)*.

## Tenancy e auditoria

- Todas as operações com `id_tenacidade` do contexto.
- Auditoria em mutações conforme [`docs/PADRAO_TENANCY_AUDITORIA.md`](../../docs/PADRAO_TENANCY_AUDITORIA.md).

## Erros

- `ApiErrorResponse` padronizado.
"""
        (out_dir / "api.md").write_text(api, encoding="utf-8")

        # frontend.md
        front = f"""# Frontend — {name}

## Páginas

- `apps/web/src/pages/{name}/` — listagem e formulário *(nomes PascalCase na implementação)*.

## Componentes

- Reutilizar `ListShell`, `DataTablePage`, `FormShell`, `FormFooter`, `ActionsBar`, fields em `shared/components/`.

## Dados

- TanStack Query + contratos alinhados a [`api.md`](api.md).

## Visual

- Referência: screenshots do corpus e [`telas.md`](telas.md).
- Padrões visuais globais: [`docs/PADRAO_LISTAS.md`](../../docs/PADRAO_LISTAS.md), [`docs/PADRAO_FORMULARIOS.md`](../../docs/PADRAO_FORMULARIOS.md).
"""
        (out_dir / "frontend.md").write_text(front, encoding="utf-8")

        # permissoes.md
        perm = f"""# Permissões — {name}

## Legado

- RBAC: usuário → grupo → aplicação → campo/bloco quando aplicável.
- Ver tabelas em `grupo_usuario_*` no corpus global.

## Novo sistema

- Middleware de autorização na API.
- `usePermission` no frontend para toolbar, linhas e campos.

## Matriz (preencher)

| Ação | Papéis | Observação |
|------|--------|------------|
| listar | | |
| visualizar | | |
| criar | | |
| editar | | |
| excluir | | |
"""
        (out_dir / "permissoes.md").write_text(perm, encoding="utf-8")

        # checklist.md
        checklist = f"""# Checklist — {name}

Aplicar [`docs/CHECKLIST_MIGRACAO_TELA.md`](../../docs/CHECKLIST_MIGRACAO_TELA.md).

## Identificação

- [ ] Entidade: `{name}`

## Evidências

- [ ] Screenshots
- [ ] TLLs
- [ ] Scriptcase / events.md
- [ ] Specs corpus consolidadas nesta pasta

## Implementação

- [ ] Prisma
- [ ] API
- [ ] Web
- [ ] Testes
- [ ] Revisão visual vs screenshot
"""
        (out_dir / "checklist.md").write_text(checklist, encoding="utf-8")

        # duvidas-abertas.md
        duvidas = f"""# Dúvidas abertas — {name}

| # | Dúvida | Impacto | Responsável | Status |
|---|--------|---------|-------------|--------|
| 1 | | | | aberta |

## Observações de corpus legado

- Registrar aqui detalhes recuperados apenas de v0–v2 quando divergirem de v3.
"""
        (out_dir / "duvidas-abertas.md").write_text(duvidas, encoding="utf-8")

    print(f"Specs geradas em {SPECS_OUT}")


if __name__ == "__main__":
    main()
