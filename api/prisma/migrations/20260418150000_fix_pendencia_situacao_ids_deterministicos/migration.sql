-- Corrige bases que já rodaram a versão anterior de 20260417200000 (BIGSERIAL fora da ordem desejada).
-- Idempotente: só altera se a associação id/sigla do seed não bater com o contrato.

DO $$
DECLARE
  pendencia_ok boolean;
  situacao_ok boolean;
BEGIN
  SELECT
    EXISTS (SELECT 1 FROM "infolab_pendencia_resultado" WHERE "sigla" = 'PP' AND "id_pendencia_resultado" = 1)
    AND EXISTS (SELECT 1 FROM "infolab_pendencia_resultado" WHERE "sigla" = 'BA' AND "id_pendencia_resultado" = 5)
    AND (SELECT COUNT(*)::int FROM "infolab_pendencia_resultado") = 5
  INTO pendencia_ok;

  SELECT
    EXISTS (SELECT 1 FROM "infolab_situacao_coleta" WHERE "sigla" = 'VC' AND "id_situacao_coleta" = 1)
    AND EXISTS (SELECT 1 FROM "infolab_situacao_coleta" WHERE "sigla" = 'CC' AND "id_situacao_coleta" = 3)
    AND (SELECT COUNT(*)::int FROM "infolab_situacao_coleta") = 3
  INTO situacao_ok;

  IF pendencia_ok AND situacao_ok THEN
    NULL;
  ELSE
  TRUNCATE TABLE "infolab_pendencia_resultado" RESTART IDENTITY CASCADE;
  TRUNCATE TABLE "infolab_situacao_coleta" RESTART IDENTITY CASCADE;

  INSERT INTO "infolab_pendencia_resultado" ("id_pendencia_resultado", "sigla", "nome") VALUES
    (1, 'PP', 'Produção'),
    (2, 'RP', 'Resultado'),
    (3, 'LP', 'Liberação'),
    (4, 'EP', 'Entrega'),
    (5, 'BA', 'Baixado');

  INSERT INTO "infolab_situacao_coleta" ("id_situacao_coleta", "sigla", "nome") VALUES
    (1, 'VC', 'Vai colher'),
    (2, 'NL', 'Normal'),
    (3, 'CC', 'Cancelada');

  PERFORM setval(
    pg_get_serial_sequence('infolab_pendencia_resultado', 'id_pendencia_resultado'),
    (SELECT COALESCE(MAX("id_pendencia_resultado"), 1) FROM "infolab_pendencia_resultado")
  );
  PERFORM setval(
    pg_get_serial_sequence('infolab_situacao_coleta', 'id_situacao_coleta'),
    (SELECT COALESCE(MAX("id_situacao_coleta"), 1) FROM "infolab_situacao_coleta")
  );
  END IF;
END $$;
