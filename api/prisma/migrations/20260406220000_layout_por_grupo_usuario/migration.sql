-- Layout por perfil (infolab_grupo_usuario), não mais por infolab_usuario.

DROP INDEX IF EXISTS "infolab_layout_formulario_id_usuario_id_formulario_key";

ALTER TABLE "infolab_layout_formulario" ADD COLUMN "id_grupo_usuario" BIGINT;

UPDATE "infolab_layout_formulario" AS l
SET "id_grupo_usuario" = u."id_grupo_usuario"
FROM "infolab_usuario" AS u
WHERE u."id_usuario" = l."id_usuario";

DELETE FROM "infolab_layout_formulario" WHERE "id_grupo_usuario" IS NULL;

ALTER TABLE "infolab_layout_formulario" DROP CONSTRAINT "infolab_layout_formulario_id_usuario_fkey";

ALTER TABLE "infolab_layout_formulario" DROP COLUMN "id_usuario";

ALTER TABLE "infolab_layout_formulario" ALTER COLUMN "id_grupo_usuario" SET NOT NULL;

CREATE UNIQUE INDEX "infolab_layout_formulario_id_grupo_usuario_id_formulario_key" ON "infolab_layout_formulario"("id_grupo_usuario", "id_formulario");

ALTER TABLE "infolab_layout_formulario" ADD CONSTRAINT "infolab_layout_formulario_id_grupo_usuario_fkey" FOREIGN KEY ("id_grupo_usuario") REFERENCES "infolab_grupo_usuario"("id_grupo_usuario") ON DELETE CASCADE ON UPDATE CASCADE;
