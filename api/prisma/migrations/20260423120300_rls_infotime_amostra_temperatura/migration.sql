-- RLS estrita por tenant em `amostra_temperatura` (ERP) ou legado `infolab_amostra_temperatura`.

DO $$
DECLARE
  r regclass;
BEGIN
  IF to_regclass('public.amostra_temperatura') IS NOT NULL THEN
    r := 'public.amostra_temperatura'::regclass;
  ELSIF to_regclass('public.infolab_amostra_temperatura') IS NOT NULL THEN
    r := 'public.infolab_amostra_temperatura'::regclass;
  ELSE
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', r);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', r);
  EXECUTE format('DROP POLICY IF EXISTS infolab_amostra_temperatura_tenant_rls ON %s', r);
  EXECUTE format('DROP POLICY IF EXISTS infotime_amostra_temperatura_tenant_rls ON %s', r);
  EXECUTE format(
    $exec$
    CREATE POLICY infotime_amostra_temperatura_tenant_rls ON %s
    FOR ALL
    USING (
      NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
      AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    WITH CHECK (
      NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
      AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    $exec$,
    r
  );
END $$;
