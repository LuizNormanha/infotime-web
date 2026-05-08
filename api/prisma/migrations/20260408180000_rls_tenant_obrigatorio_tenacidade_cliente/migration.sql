-- tenacidade / cliente: sem app.current_tenant_id válido na sessão,
-- nenhuma linha é visível para papéis sujeitos à RLS (ex.: LigaDev, liga_infolab_rw).
-- InfoTIME ERP: tabelas físicas tenacidade e cliente.

DO $$
DECLARE
  t regclass;
  c regclass;
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    t := 'public.tenacidade'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    t := 'public.infolab_tenacidade'::regclass;
  END IF;

  IF to_regclass('public.cliente') IS NOT NULL THEN
    c := 'public.cliente'::regclass;
  ELSIF to_regclass('public.infolab_cliente') IS NOT NULL THEN
    c := 'public.infolab_cliente'::regclass;
  END IF;

  IF t IS NOT NULL THEN
    EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_tenant_rls ON %s', t);
    EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_tenant_rls ON %s', t);
    EXECUTE format(
      $exec$
      CREATE POLICY infotime_tenacidade_tenant_rls ON %s
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
      t
    );
  END IF;

  IF c IS NOT NULL THEN
    EXECUTE format('DROP POLICY IF EXISTS infotime_cliente_tenant_rls ON %s', c);
    EXECUTE format('DROP POLICY IF EXISTS infolab_cliente_tenant_rls ON %s', c);
    EXECUTE format(
      $exec$
      CREATE POLICY infotime_cliente_tenant_rls ON %s
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
      c
    );
  END IF;
END $$;
