-- Adiciona codigo_b2b em lab_apoio_unidade (ERP) ou infolab_lab_apoio_unidade (Liga).

DO $$
DECLARE
  t regclass;
  tbl text;
BEGIN
  IF to_regclass('public.lab_apoio_unidade') IS NOT NULL THEN
    t := 'public.lab_apoio_unidade'::regclass;
    tbl := 'lab_apoio_unidade';
  ELSIF to_regclass('public.infolab_lab_apoio_unidade') IS NOT NULL THEN
    t := 'public.infolab_lab_apoio_unidade'::regclass;
    tbl := 'infolab_lab_apoio_unidade';
  ELSE
    RAISE NOTICE 'lab_apoio_unidade: tabela ausente — pulando codigo_b2b.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ADD COLUMN IF NOT EXISTS "codigo_b2b" VARCHAR(80)', t);
  EXECUTE format(
    'UPDATE %s SET "codigo_b2b" = ''MIG-'' || "id_lab_apoio_unidade"::text WHERE "codigo_b2b" IS NULL',
    t
  );
  EXECUTE format('ALTER TABLE %s ALTER COLUMN "codigo_b2b" SET NOT NULL', t);
  EXECUTE format(
    $f$
    CREATE UNIQUE INDEX IF NOT EXISTS uq_lab_apoio_unidade_codigo_b2b
      ON public.%I ("id_tenacidade", "id_unidade", "id_lab_apoio", "codigo_b2b")
    $f$,
    tbl
  );
END $$;
