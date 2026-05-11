-- RLS em `infotime_colaborador_tarefa_historico` (sem `id_tenacidade`): escopo por tenant
-- derivado de `infotime_colaborador_tarefa.id_tenacidade` via `id_colaborador_tarefa`.
-- Depende de RLS/política em `infotime_colaborador_tarefa` (migration `20260521130000_*`).

DO $$
DECLARE
  c_hist regclass;
  c_tarefa regclass;
BEGIN
  c_hist := to_regclass(format('public.%I', 'infotime_colaborador_tarefa_historico'));
  c_tarefa := to_regclass(format('public.%I', 'infotime_colaborador_tarefa'));

  IF c_hist IS NULL THEN
    RAISE NOTICE 'infotime_colaborador_tarefa_historico ausente — pulando RLS derivado.';
    RETURN;
  END IF;

  IF c_tarefa IS NULL THEN
    RAISE NOTICE 'infotime_colaborador_tarefa ausente — não é possível política derivada em historico.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', c_hist);
  EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', c_hist);
  EXECUTE format(
    'DROP POLICY IF EXISTS %I ON %s',
    'infotime_colaborador_tarefa_historico_tenant_rls',
    c_hist
  );

  EXECUTE format(
    $exec$
    CREATE POLICY infotime_colaborador_tarefa_historico_tenant_rls ON %s
    FOR ALL
    USING (
      NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
      AND EXISTS (
        SELECT 1
        FROM %s t
        WHERE t.id_colaborador_tarefa = id_colaborador_tarefa
          AND t.id_tenacidade IS NOT NULL
          AND t.id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
      )
    )
    WITH CHECK (
      NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
      AND EXISTS (
        SELECT 1
        FROM %s t
        WHERE t.id_colaborador_tarefa = id_colaborador_tarefa
          AND t.id_tenacidade IS NOT NULL
          AND t.id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
      )
    )
    $exec$,
    c_hist,
    c_tarefa,
    c_tarefa
  );
END
$$;
