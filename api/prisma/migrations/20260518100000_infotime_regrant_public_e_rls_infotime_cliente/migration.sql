-- Após renomes físicos (* → infotime_*), objetos novos podem ficar sem os mesmos GRANTs que
-- `20260408120000_postgres_roles_e_privilegios` aplicou no baseline (espelha infolab-web,
-- §4 — ALL TABLES / SEQUENCES / FUNCTIONS nos papéis de aplicação).
--
-- Corrige em especial erro 42501 em `infotime_cliente` e tabelas correlatas da listagem.
--
-- RLS: `20260413120000_rls_tenant_id_tenacidade_all_tables` resolve apenas `cliente` ou
-- `infolab_cliente`, não `infotime_cliente`. Garante política estrita por tenant alinhada a
-- `20260408180000_rls_tenant_obrigatorio_tenacidade_cliente`.

DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO "LigaDev"';
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO "LigaDev"';
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public TO "LigaDev"';
  END IF;

  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO liga_infolab_rw';
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO liga_infolab_rw';
    EXECUTE 'GRANT ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public TO liga_infolab_rw';
  END IF;
END
$$;

DO $$
DECLARE
  c regclass;
BEGIN
  IF to_regclass('public.infotime_cliente') IS NULL THEN
    RAISE NOTICE 'infotime_cliente ausente — pulando RLS.';
    RETURN;
  END IF;

  c := 'public.infotime_cliente'::regclass;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', c);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', c);
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
END
$$;
