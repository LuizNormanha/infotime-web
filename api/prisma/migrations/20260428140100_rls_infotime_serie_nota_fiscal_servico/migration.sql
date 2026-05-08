-- RLS por tenant em serie_nota_fiscal_servico (ERP) ou infolab_serie_nota_fiscal_servico.

DO $$
DECLARE
  r regclass;
BEGIN
  IF to_regclass('public.serie_nota_fiscal_servico') IS NOT NULL THEN
    r := 'public.serie_nota_fiscal_servico'::regclass;
  ELSIF to_regclass('public.infolab_serie_nota_fiscal_servico') IS NOT NULL THEN
    r := 'public.infolab_serie_nota_fiscal_servico'::regclass;
  ELSE
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', r);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', r);
  EXECUTE format('DROP POLICY IF EXISTS infolab_serie_nota_fiscal_servico_tenant_rls ON %s', r);
  EXECUTE format('DROP POLICY IF EXISTS infotime_serie_nota_fiscal_servico_tenant_rls ON %s', r);
  EXECUTE format(
    $exec$
    CREATE POLICY infotime_serie_nota_fiscal_servico_tenant_rls ON %s
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
