-- Remove RLS de tenacidade (ERP) / infolab_tenacidade (Liga).

DO $$
DECLARE
  t regclass;
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    t := 'public.tenacidade'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    t := 'public.infolab_tenacidade'::regclass;
  ELSE
    RETURN;
  END IF;

  EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_tenant_rls ON %s', t);
  EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_tenant_rls ON %s', t);
  EXECUTE format('ALTER TABLE %s NO FORCE ROW LEVEL SECURITY', t);
  EXECUTE format('ALTER TABLE %s DISABLE ROW LEVEL SECURITY', t);
END $$;
