-- Vínculo convênio → autorizador TISS no registro PAI (infolab_convenio).
-- Reverte tentativa anterior de colocar id_convenio no filho (só aplica se existir).

ALTER TABLE "infolab_convenio_autorizador" DROP CONSTRAINT IF EXISTS "fk_convenio_autorizador_id_convenio";
DROP INDEX IF EXISTS "infolab_convenio_autorizador_id_convenio_idx";
ALTER TABLE "infolab_convenio_autorizador" DROP COLUMN IF EXISTS "id_convenio";

ALTER TABLE "infolab_convenio" ADD COLUMN "id_convenio_autorizador" BIGINT;

CREATE UNIQUE INDEX "infolab_convenio_id_convenio_autorizador_key"
  ON "infolab_convenio" ("id_convenio_autorizador")
  WHERE "id_convenio_autorizador" IS NOT NULL;

ALTER TABLE "infolab_convenio"
  ADD CONSTRAINT "fk_convenio_id_convenio_autorizador"
  FOREIGN KEY ("id_convenio_autorizador") REFERENCES "infolab_convenio_autorizador"("id_convenio_autorizador")
  ON DELETE RESTRICT ON UPDATE RESTRICT;
