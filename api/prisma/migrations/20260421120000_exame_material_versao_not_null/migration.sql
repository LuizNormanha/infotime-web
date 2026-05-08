-- `versao_exame_material` obrigatório em `infolab_exame_material` (mcp/exame-material/rules.md).
UPDATE "infolab_exame_material"
SET "versao_exame_material" = 1
WHERE "versao_exame_material" IS NULL;

ALTER TABLE "infolab_exame_material"
ALTER COLUMN "versao_exame_material" SET NOT NULL;
