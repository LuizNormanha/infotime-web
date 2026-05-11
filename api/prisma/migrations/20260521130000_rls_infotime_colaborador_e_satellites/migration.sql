-- RLS por tenant em `infotime_colaborador`, catálogos RH correlatos e tabelas satélite com `id_tenacidade`.
-- Alinha a `20260518100000_infotime_regrant_public_e_rls_infotime_cliente` e `app.current_tenant_id`.
-- Tabelas sem coluna `id_tenacidade` (ex.: `infotime_colaborador_tarefa_historico`) não entram neste laço.

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
  t text;
  c regclass;
  policy_name text;
  tbls text[] := ARRAY[
    'infotime_colaborador',
    'infotime_tipo_colaborador',
    'infotime_situacao_colaborador',
    'infotime_colaborador_atestado',
    'infotime_colaborador_avaliacao',
    'infotime_colaborador_comunicacao',
    'infotime_colaborador_comp_rendimento',
    'infotime_colaborador_contra_cheque',
    'infotime_colaborador_documento',
    'infotime_colaborador_exame',
    'infotime_colaborador_ferias',
    'infotime_colaborador_ferias_gozadas',
    'infotime_colaborador_folha_ponto',
    'infotime_colaborador_medida_disciplinar',
    'infotime_colaborador_plano_conta',
    'infotime_colaborador_reajuste',
    'infotime_colaborador_salario_adiantamento',
    'infotime_colaborador_tarifa',
    'infotime_colaborador_tarefa',
    'infotime_colaborador_tarefa_motivo_prorrogacao',
    'infotime_colaborador_telefone',
    'infotime_colaborador_vale_alimentacao_transporte',
    'infotime_colaborador_viagem',
    'infotime_colaborador_viagem_adiantamento',
    'infotime_colaborador_viagem_despesa'
  ];
BEGIN
  FOREACH t IN ARRAY tbls
  LOOP
    IF to_regclass(format('public.%I', t)) IS NULL THEN
      RAISE NOTICE 'Tabela % ausente — pulando RLS.', t;
      CONTINUE;
    END IF;

    IF NOT EXISTS (
      SELECT 1
      FROM information_schema.columns
      WHERE table_schema = 'public'
        AND table_name = t
        AND column_name = 'id_tenacidade'
    ) THEN
      RAISE NOTICE 'Tabela % sem coluna id_tenacidade — pulando.', t;
      CONTINUE;
    END IF;

    c := format('public.%I', t)::regclass;
    policy_name := t || '_tenant_rls';

    EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', c);
    EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', c);
    EXECUTE format('DROP POLICY IF EXISTS %I ON %s', policy_name, c);

    EXECUTE format(
      $exec$
      CREATE POLICY %I ON %s
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
      policy_name,
      c
    );
  END LOOP;
END
$$;
