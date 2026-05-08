-- Remove colunas legadas "coletando" (nunca referenciadas no infotime-web; duplicam o par id_usuario_coleta / data_hora_coleta).
-- `data_hora_coletando` era o timestamp associado a `id_usuario_coletando`.

ALTER TABLE "infolab_atendimento_exame_material" DROP CONSTRAINT IF EXISTS "fk_atendimento_exame_material_id_usuario_coletando";

ALTER TABLE "infolab_atendimento_exame_material" DROP COLUMN IF EXISTS "id_usuario_coletando";
ALTER TABLE "infolab_atendimento_exame_material" DROP COLUMN IF EXISTS "data_hora_coletando";
