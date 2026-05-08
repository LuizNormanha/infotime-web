-- Referência determinística: ids fixos por sigla.
-- O padrão INSERT...SELECT a partir de VALUES pode não preservar ordem de atribuição do BIGSERIAL;
-- aqui usamos TRUNCATE (base nova: sem filhos em migrations anteriores) + INSERT com id explícito.

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

SELECT setval(
  pg_get_serial_sequence('infolab_pendencia_resultado', 'id_pendencia_resultado'),
  (SELECT COALESCE(MAX("id_pendencia_resultado"), 1) FROM "infolab_pendencia_resultado")
);

SELECT setval(
  pg_get_serial_sequence('infolab_situacao_coleta', 'id_situacao_coleta'),
  (SELECT COALESCE(MAX("id_situacao_coleta"), 1) FROM "infolab_situacao_coleta")
);
