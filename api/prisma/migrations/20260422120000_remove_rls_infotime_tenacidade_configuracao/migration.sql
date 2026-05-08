-- Alinha com tenacidade (20260409160000): sem RLS nesta tabela; isolamento na API.

DO $$
DECLARE
  cfg regclass;
BEGIN
  IF to_regclass('public.tenacidade_configuracao') IS NOT NULL THEN
    cfg := 'public.tenacidade_configuracao'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade_configuracao') IS NOT NULL THEN
    cfg := 'public.infolab_tenacidade_configuracao'::regclass;
  ELSE
    RETURN;
  END IF;

  EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_configuracao_tenant_rls ON %s', cfg);
  EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_configuracao_tenant_rls ON %s', cfg);
  EXECUTE format('ALTER TABLE %s NO FORCE ROW LEVEL SECURITY', cfg);
  EXECUTE format('ALTER TABLE %s DISABLE ROW LEVEL SECURITY', cfg);
END $$;
