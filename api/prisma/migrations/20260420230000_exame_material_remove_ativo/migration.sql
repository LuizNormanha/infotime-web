-- Remove coluna redundante: situação de "versão corrente" fica só em `versao_ativa`.
ALTER TABLE "infolab_exame_material" DROP COLUMN IF EXISTS "ativo";
