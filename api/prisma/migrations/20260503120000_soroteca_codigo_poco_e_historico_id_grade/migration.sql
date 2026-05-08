-- Soroteca: ampliar código de poço para grades grandes; alinhar id_grade do histórico ao BIGINT da grade.
ALTER TABLE "infolab_atendimento_amostra" ALTER COLUMN "codigo_poco" TYPE VARCHAR(12);

ALTER TABLE "infolab_soroteca_grade_poco_historico" ALTER COLUMN "id_grade" TYPE BIGINT USING ("id_grade"::bigint);
