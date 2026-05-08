-- Carga inicial idempotente do catálogo global infolab_temperatura_opcao.
-- Ordem: primeiro opções não-temperatura, depois -22 °C até +22 °C.
-- Utiliza ON CONFLICT DO NOTHING na ordem_exibicao (unique) para ser idempotente.

INSERT INTO "infolab_temperatura_opcao"
  ("texto_exibicao", "eh_temperatura", "valor_temperatura", "unidade_temperatura", "ordem_exibicao", "ativo")
VALUES
  ('Não aplicável',              'N', NULL, NULL, 1, 'S'),
  ('Termômetro inoperante',      'N', NULL, NULL, 2, 'S'),
  ('Não possui termômetro',      'N', NULL, NULL, 3, 'S'),
  ('Termômetro em manutenção',   'N', NULL, NULL, 4, 'S'),
  ('Temperatura ambiente',       'N', NULL, NULL, 5, 'S'),
  ('-22 °C', 'S', -22, 'C',  6, 'S'),
  ('-21 °C', 'S', -21, 'C',  7, 'S'),
  ('-20 °C', 'S', -20, 'C',  8, 'S'),
  ('-19 °C', 'S', -19, 'C',  9, 'S'),
  ('-18 °C', 'S', -18, 'C', 10, 'S'),
  ('-17 °C', 'S', -17, 'C', 11, 'S'),
  ('-16 °C', 'S', -16, 'C', 12, 'S'),
  ('-15 °C', 'S', -15, 'C', 13, 'S'),
  ('-14 °C', 'S', -14, 'C', 14, 'S'),
  ('-13 °C', 'S', -13, 'C', 15, 'S'),
  ('-12 °C', 'S', -12, 'C', 16, 'S'),
  ('-11 °C', 'S', -11, 'C', 17, 'S'),
  ('-10 °C', 'S', -10, 'C', 18, 'S'),
  ('-9 °C',  'S',  -9, 'C', 19, 'S'),
  ('-8 °C',  'S',  -8, 'C', 20, 'S'),
  ('-7 °C',  'S',  -7, 'C', 21, 'S'),
  ('-6 °C',  'S',  -6, 'C', 22, 'S'),
  ('-5 °C',  'S',  -5, 'C', 23, 'S'),
  ('-4 °C',  'S',  -4, 'C', 24, 'S'),
  ('-3 °C',  'S',  -3, 'C', 25, 'S'),
  ('-2 °C',  'S',  -2, 'C', 26, 'S'),
  ('-1 °C',  'S',  -1, 'C', 27, 'S'),
  ('0 °C',   'S',   0, 'C', 28, 'S'),
  ('1 °C',   'S',   1, 'C', 29, 'S'),
  ('2 °C',   'S',   2, 'C', 30, 'S'),
  ('3 °C',   'S',   3, 'C', 31, 'S'),
  ('4 °C',   'S',   4, 'C', 32, 'S'),
  ('5 °C',   'S',   5, 'C', 33, 'S'),
  ('6 °C',   'S',   6, 'C', 34, 'S'),
  ('7 °C',   'S',   7, 'C', 35, 'S'),
  ('8 °C',   'S',   8, 'C', 36, 'S'),
  ('9 °C',   'S',   9, 'C', 37, 'S'),
  ('10 °C',  'S',  10, 'C', 38, 'S'),
  ('11 °C',  'S',  11, 'C', 39, 'S'),
  ('12 °C',  'S',  12, 'C', 40, 'S'),
  ('13 °C',  'S',  13, 'C', 41, 'S'),
  ('14 °C',  'S',  14, 'C', 42, 'S'),
  ('15 °C',  'S',  15, 'C', 43, 'S'),
  ('16 °C',  'S',  16, 'C', 44, 'S'),
  ('17 °C',  'S',  17, 'C', 45, 'S'),
  ('18 °C',  'S',  18, 'C', 46, 'S'),
  ('19 °C',  'S',  19, 'C', 47, 'S'),
  ('20 °C',  'S',  20, 'C', 48, 'S'),
  ('21 °C',  'S',  21, 'C', 49, 'S'),
  ('22 °C',  'S',  22, 'C', 50, 'S')
ON CONFLICT ("ordem_exibicao") DO NOTHING;

SELECT setval(
  pg_get_serial_sequence('infolab_temperatura_opcao', 'id_temperatura_opcao'),
  (SELECT COALESCE(MAX("id_temperatura_opcao"), 1) FROM "infolab_temperatura_opcao")
);
