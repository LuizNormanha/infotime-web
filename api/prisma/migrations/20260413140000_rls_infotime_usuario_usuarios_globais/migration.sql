-- usuario / infolab_usuario: política com usuários globais (id_tenacidade IS NULL) para suporte/implantação.

DO $$
DECLARE
  u regclass;
BEGIN
  IF to_regclass('public.usuario') IS NOT NULL THEN
    u := 'public.usuario'::regclass;
  ELSIF to_regclass('public.infolab_usuario') IS NOT NULL THEN
    u := 'public.infolab_usuario'::regclass;
  ELSE
    RETURN;
  END IF;

  EXECUTE format('DROP POLICY IF EXISTS infotime_usuario_tenant_rls ON %s', u);
  EXECUTE format('DROP POLICY IF EXISTS infolab_usuario_tenant_rls ON %s', u);
  EXECUTE format(
    $exec$
    CREATE POLICY infotime_usuario_tenant_rls ON %s
    FOR ALL
    USING (
      id_tenacidade IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    WITH CHECK (
      id_tenacidade IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    $exec$,
    u
  );
END $$;
