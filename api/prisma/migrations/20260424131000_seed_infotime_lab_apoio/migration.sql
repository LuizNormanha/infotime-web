-- Catálogo global de laboratórios de apoio (lab_apoio ERP ou infolab_lab_apoio Liga).

DO $$
DECLARE
  tbl text;
BEGIN
  IF to_regclass('public.lab_apoio') IS NOT NULL THEN
    tbl := 'lab_apoio';
  ELSIF to_regclass('public.infolab_lab_apoio') IS NOT NULL THEN
    tbl := 'infolab_lab_apoio';
  ELSE
    RAISE NOTICE 'seed lab_apoio: tabela ausente — pulando.';
    RETURN;
  END IF;

  EXECUTE format(
    $f$
    INSERT INTO public.%I ("nome", "sigla", "ativo")
    SELECT v.nome, v.sigla, 'S'
    FROM (VALUES
      ('Hermes pardini', 'HP'),
      ('Alvaro', 'AV'),
      ('Liga', 'LG'),
      ('Db', 'DB'),
      ('Csv', 'CSV'),
      ('Sao marcos', 'SM'),
      ('Biomega', 'CH'),
      ('Sao paulo', 'SP'),
      ('Labrede', 'LR'),
      ('Brasil apoio', 'BA'),
      ('Mercolab', 'ML'),
      ('Softlab', 'SL'),
      ('Autolac', 'AL'),
      ('Matrix', 'MX'),
      ('Avantix', 'AX'),
      ('Sergio franco', 'SF'),
      ('Klingo', 'KG'),
      ('Labor clinica', 'LC')
    ) AS v(nome, sigla)
    WHERE NOT EXISTS (
      SELECT 1
      FROM public.%I a
      WHERE a.sigla IS NOT NULL
        AND UPPER(TRIM(a.sigla)) = UPPER(TRIM(v.sigla))
    )
    $f$,
    tbl,
    tbl
  );

  EXECUTE format(
    $f$
    SELECT setval(
      pg_get_serial_sequence(%L, 'id_lab_apoio'),
      (SELECT COALESCE(MAX("id_lab_apoio"), 1) FROM public.%I)
    )
    $f$,
    'public.' || tbl,
    tbl
  );
END $$;
