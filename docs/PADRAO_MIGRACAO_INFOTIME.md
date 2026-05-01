# Padrão de migração — Infotime (regra de ouro)

## Regra de ouro

```text
Screenshot define aparência e campos visíveis.
TLL/DDL define estrutura real de dados.
Scriptcase define comportamento e regras de negócio.
Specs consolidam evidências.
```

O Cursor (e qualquer implementador) deve **cruzar os quatro** antes de gerar código de produção.

## Nomenclatura

- **Cliente:** no legado, "pacientes" corresponde à entidade **cliente** — usar sempre `cliente` no código e na documentação.

## Ciclo obrigatório por entidade

1. Inventariar evidências (paths em `migration-source/infotime-migration/<entidade>/`).
2. Ler screenshots.
3. Ler TLLs em `database/`.
4. Ler specs existentes em `specs/` do corpus.
5. Ler fontes Scriptcase e `events.md`.
6. Extrair regras e SQLs relevantes (intenção, não cópia literal).
7. Criar ou atualizar documentação funcional em `specs/<entidade>/` (projeto).
8. Criar modelo Prisma alinhado ao TLL.
9. Criar contrato de API (Zod + OpenAPI interno em markdown).
10. Revisar dúvidas abertas.
11. Só então gerar backend.
12. Só então gerar frontend.
13. Rodar testes.
14. Comparar com screenshots.
15. Registrar ajustes neste padrão ou no checklist da entidade.

## O que evitar

- Não traduzir PHP linha por linha.
- Não inventar campos fora de TLL, specs, screenshots ou eventos documentados.
- Não implementar tela isolada sem componentes compartilhados quando já existirem.
