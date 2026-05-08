-- RLS na tabela física de tenacidade: InfoTIME ERP usa `tenacidade`; Liga legado usa `infolab_tenacidade`.
--
-- Sem app.current_tenant_id na sessão: todas as linhas visíveis (login resolve tenant por domínio).
-- Com app.current_tenant_id = N: só a linha id_tenacidade = N.
--
-- Superusuários e roles com BYPASSRLS ignoram RLS.

DO $$
DECLARE
  t regclass;
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    t := 'public.tenacidade'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    t := 'public.infolab_tenacidade'::regclass;
  ELSE
    RAISE NOTICE 'RLS tenacidade: nenhuma tabela public.tenacidade / public.infolab_tenacidade — ignorando.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', t);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', t);
  EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_tenant_rls ON %s', t);
  EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_tenant_rls ON %s', t);
  EXECUTE format($f$
    CREATE POLICY infotime_tenacidade_tenant_rls ON %s
    FOR ALL
    USING (
      current_setting('app.current_tenant_id', true) IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )
    WITH CHECK (
      current_setting('app.current_tenant_id', true) IS NULL
      OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
    )$f$, t);
END $$;
