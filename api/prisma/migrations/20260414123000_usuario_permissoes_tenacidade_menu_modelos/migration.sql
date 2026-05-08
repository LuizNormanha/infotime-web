-- Permissões/menu por grupo:
-- 1) prepara infolab_usuario_permissoes para carregar id_tenacidade;
-- 2) cria grupos modelo LIGA (idempotente).

ALTER TABLE "infolab_usuario_permissoes"
  ADD COLUMN IF NOT EXISTS "id_tenacidade" BIGINT;

UPDATE "infolab_usuario_permissoes" up
SET "id_tenacidade" = gu."id_tenacidade"
FROM "infolab_grupo_usuario" gu
WHERE gu."id_grupo_usuario" = up."id_grupo_usuario"
  AND up."id_tenacidade" IS NULL;

ALTER TABLE "infolab_usuario_permissoes"
  ADD CONSTRAINT "fk_usuario_permissoes_id_tenacidade"
  FOREIGN KEY ("id_tenacidade")
  REFERENCES "infolab_tenacidade"("id_tenacidade")
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

CREATE INDEX IF NOT EXISTS "idx_usuario_permissoes_tenacidade"
  ON "infolab_usuario_permissoes" ("id_tenacidade");

INSERT INTO "infolab_grupo_usuario" (
  "id_tenacidade",
  "descricao",
  "acessa_auditoria",
  "nome_aplicacao_auditoria"
)
SELECT t."id_tenacidade", 'Modelo LIGA - Administrador', 'N', 'infotime-web'
FROM "infolab_tenacidade" t
WHERE NOT EXISTS (
  SELECT 1
  FROM "infolab_grupo_usuario" g
  WHERE g."id_tenacidade" = t."id_tenacidade"
    AND g."descricao" = 'Modelo LIGA - Administrador'
);

INSERT INTO "infolab_grupo_usuario" (
  "id_tenacidade",
  "descricao",
  "acessa_auditoria",
  "nome_aplicacao_auditoria"
)
SELECT t."id_tenacidade", 'Modelo LIGA - Atendente', 'N', 'infotime-web'
FROM "infolab_tenacidade" t
WHERE NOT EXISTS (
  SELECT 1
  FROM "infolab_grupo_usuario" g
  WHERE g."id_tenacidade" = t."id_tenacidade"
    AND g."descricao" = 'Modelo LIGA - Atendente'
);

INSERT INTO "infolab_grupo_usuario" (
  "id_tenacidade",
  "descricao",
  "acessa_auditoria",
  "nome_aplicacao_auditoria"
)
SELECT t."id_tenacidade", 'Modelo LIGA - Coletor', 'N', 'infotime-web'
FROM "infolab_tenacidade" t
WHERE NOT EXISTS (
  SELECT 1
  FROM "infolab_grupo_usuario" g
  WHERE g."id_tenacidade" = t."id_tenacidade"
    AND g."descricao" = 'Modelo LIGA - Coletor'
);

UPDATE "infolab_usuario"
SET "id_grupo_usuario" = NULL
WHERE "id_tenacidade" IS NULL
  AND "login" IN ('suporte', 'implantacao');
