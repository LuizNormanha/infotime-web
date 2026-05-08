-- tenacidade: mantém RLS com exceção controlada por GUC.
-- Quando app.infolab_implantacao_tenacidade_total = '1' (definido pela API para JWT
-- suporte + login implantacao + tenantId = LIGA_BR_TENACIDADE_ID), todas as linhas são visíveis e mutáveis.
-- Caso contrário: apenas id_tenacidade = app.current_tenant_id (com GUC obrigatório).

DO $$
DECLARE
  t regclass;
  cfg regclass;
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    t := 'public.tenacidade'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    t := 'public.infolab_tenacidade'::regclass;
  END IF;

  IF to_regclass('public.tenacidade_configuracao') IS NOT NULL THEN
    cfg := 'public.tenacidade_configuracao'::regclass;
  ELSIF to_regclass('public.infolab_tenacidade_configuracao') IS NOT NULL THEN
    cfg := 'public.infolab_tenacidade_configuracao'::regclass;
  END IF;

  IF t IS NOT NULL THEN
    EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_tenant_rls ON %s', t);
    EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_tenant_rls ON %s', t);
    EXECUTE format(
      $exec$
      CREATE POLICY infotime_tenacidade_tenant_rls ON %s
      FOR ALL
      USING (
        NULLIF(current_setting('app.infolab_implantacao_tenacidade_total', true), '') = '1'
        OR (
          NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
          AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
        )
      )
      WITH CHECK (
        NULLIF(current_setting('app.infolab_implantacao_tenacidade_total', true), '') = '1'
        OR (
          NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
          AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
        )
      )
      $exec$,
      t
    );
  END IF;

  IF cfg IS NOT NULL THEN
    EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', cfg);
    EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', cfg);
    EXECUTE format('DROP POLICY IF EXISTS infotime_tenacidade_configuracao_tenant_rls ON %s', cfg);
    EXECUTE format('DROP POLICY IF EXISTS infolab_tenacidade_configuracao_tenant_rls ON %s', cfg);
    EXECUTE format(
      $exec$
      CREATE POLICY infotime_tenacidade_configuracao_tenant_rls ON %s
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
      cfg
    );
  END IF;
END $$;
