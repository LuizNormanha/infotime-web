-- liga-prj-template / InfoTIME ERP: reaplica GRANTs essenciais ao role de aplicação `LigaDev`
-- nas tabelas usadas pelos fluxos de autenticação/sessão. Idempotente. Só roda se o role e
-- as tabelas existirem.

DO $$
DECLARE
  t TEXT;
  tabelas_select TEXT[] := ARRAY[
    'tenacidade',
    'usuario',
    'grupo_usuario',
    'usuario_grupo_usuario'
  ];
  tabelas_rw TEXT[] := ARRAY[
    'tenacidade_configuracao',
    'sessao_usuario',
    'sessao_suporte',
    'formulario',
    'usuario_permissoes',
    'layout_formulario'
  ];
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    RAISE NOTICE 'role LigaDev nao existe; pulando GRANTs';
    RETURN;
  END IF;

  -- Tabelas que o login só precisa LER (resolução de tenant/usuário/grupos).
  FOREACH t IN ARRAY tabelas_select LOOP
    IF to_regclass('public.' || t) IS NOT NULL THEN
      EXECUTE format('GRANT SELECT ON TABLE public.%I TO "LigaDev"', t);
    END IF;
  END LOOP;

  -- Tabelas auxiliares de auth/menu que precisam CRUD pleno.
  FOREACH t IN ARRAY tabelas_rw LOOP
    IF to_regclass('public.' || t) IS NOT NULL THEN
      EXECUTE format('GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE public.%I TO "LigaDev"', t);
    END IF;
  END LOOP;

  -- Sequences (BIGSERIAL) precisam de USAGE/SELECT para INSERT funcionar.
  EXECUTE 'GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO "LigaDev"';

  -- Default privileges para novas tabelas/sequences criadas por LigaMaster (migrations).
  EXECUTE 'ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO "LigaDev"';
  EXECUTE 'ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO "LigaDev"';
END $$;
