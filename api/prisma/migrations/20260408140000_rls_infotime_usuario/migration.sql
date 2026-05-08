-- RLS na tabela física de usuários: InfoTIME ERP usa `usuario`; Liga legado usa `infolab_usuario`.
-- Política: linhas com id_tenacidade do tenant OU usuários globais (id_tenacidade IS NULL).

DO $$
DECLARE
  u regclass;
BEGIN
  IF to_regclass('public.usuario') IS NOT NULL THEN
    u := 'public.usuario'::regclass;
  ELSIF to_regclass('public.infolab_usuario') IS NOT NULL THEN
    u := 'public.infolab_usuario'::regclass;
  ELSE
    RAISE NOTICE 'RLS usuario: nenhuma tabela public.usuario / public.infolab_usuario — ignorando.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', u);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', u);
  EXECUTE format('DROP POLICY IF EXISTS infotime_usuario_tenant_rls ON %s', u);
  EXECUTE format('DROP POLICY IF EXISTS infolab_usuario_tenant_rls ON %s', u);
  EXECUTE format($f$
    CREATE POLICY infotime_usuario_tenant_rls ON %s
    FOR ALL
    USING (
      id_tenacidade IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    WITH CHECK (
      id_tenacidade IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )$f$, u);
END $$;
