-- Após `cliente` → `infotime_cliente`, alguns ambientes ficaram apenas com GRANT na view `public.clientes`
-- (ver rename_physical_tables_infotime), sem CRUD na tabela física — Prisma usa `infotime_cliente`
-- → erro 42501 "permissão negada para tabela infotime_cliente".

DO $$
DECLARE
  seqnome text;
BEGIN
  IF to_regclass('public.infotime_cliente') IS NULL THEN
    RAISE NOTICE 'grants infotime_cliente: tabela ausente — pulando.';
    RETURN;
  END IF;

  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE public.infotime_cliente TO "LigaDev"';
  END IF;

  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE public.infotime_cliente TO liga_infolab_rw';
  END IF;

  SELECT pg_get_serial_sequence('public.infotime_cliente', 'id_cliente') INTO seqnome;

  IF seqnome IS NOT NULL THEN
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
      EXECUTE format(
        'GRANT USAGE, SELECT ON SEQUENCE %s TO "LigaDev"',
        (seqnome)::regclass::text
      );
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
      EXECUTE format(
        'GRANT USAGE, SELECT ON SEQUENCE %s TO liga_infolab_rw',
        (seqnome)::regclass::text
      );
    END IF;
  END IF;
END
$$;
