-- Ajusta infolab_situacao_coleta para o conjunto canônico VC, RC, NL, CC.
-- Ver mcp/registro-coletor/rules.md §5 e context.md §infolab_situacao_coleta.
-- Ações:
--  - Insere RC se não existir.
--  - Renomeia o `nome` de NL para "Colhido" (alinhado à linguagem do MCP).
--  - Remove siglas fora de {VC, RC, NL, CC} somente quando não estão em uso.
-- A migration é idempotente.

-- Insere RC (Recoleta) se ainda não existir.
INSERT INTO "infolab_situacao_coleta" ("sigla", "nome")
SELECT 'RC', 'Recoleta'
WHERE NOT EXISTS (
  SELECT 1 FROM "infolab_situacao_coleta" WHERE "sigla" = 'RC'
);

-- Renomeia NL para "Colhido" (independente do nome anterior).
UPDATE "infolab_situacao_coleta"
SET "nome" = 'Colhido'
WHERE "sigla" = 'NL' AND ("nome" IS DISTINCT FROM 'Colhido');

-- Remove siglas fora de {VC, RC, NL, CC} que não estejam em uso.
DELETE FROM "infolab_situacao_coleta" sc
WHERE sc."sigla" NOT IN ('VC', 'RC', 'NL', 'CC')
  AND NOT EXISTS (
    SELECT 1
    FROM "infolab_atendimento_exame_material" aem
    WHERE aem."id_situacao_coleta" = sc."id_situacao_coleta"
  );

-- Sincroniza a sequence após inserts.
SELECT setval(
  pg_get_serial_sequence('infolab_situacao_coleta', 'id_situacao_coleta'),
  (SELECT COALESCE(MAX("id_situacao_coleta"), 1) FROM "infolab_situacao_coleta")
);
