-- RLS em cliente (ERP) ou infolab_cliente (Liga).
-- Sem app.current_tenant_id: todas as linhas (ferramentas / scripts sem tenant).
-- Com SET app.current_tenant_id = N: só clientes da tenacidade N.

DO $$
DECLARE
  c regclass;
BEGIN
  IF to_regclass('public.cliente') IS NOT NULL THEN
    c := 'public.cliente'::regclass;
  ELSIF to_regclass('public.infolab_cliente') IS NOT NULL THEN
    c := 'public.infolab_cliente'::regclass;
  ELSE
    RAISE NOTICE 'RLS cliente: public.cliente / public.infolab_cliente inexistente — ignorando.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', c);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', c);
  EXECUTE format('DROP POLICY IF EXISTS infotime_cliente_tenant_rls ON %s', c);
  EXECUTE format('DROP POLICY IF EXISTS infolab_cliente_tenant_rls ON %s', c);
  EXECUTE format(
    $exec$
    CREATE POLICY infotime_cliente_tenant_rls ON %s
    FOR ALL
    USING (
      current_setting('app.current_tenant_id', true) IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    WITH CHECK (
      current_setting('app.current_tenant_id', true) IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    $exec$,
    c
  );
END $$;
