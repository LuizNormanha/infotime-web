-- Papéis de aplicação e privilégios no schema `public`.
--
-- Objetivo: usuários não-superuser (ex.: LigaDev, liga_infolab_rw) conseguem usar o banco
-- com Prisma e clientes SQL (pgAdmin, DBeaver) vendo tabelas e executando DML.
--
-- Requisitos ao aplicar esta migration:
-- - O usuário da DATABASE_URL deve poder CREATE ROLE (superuser ou papel com CREATEROLE),
--   ou os papéis já devem existir (o bloco abaixo é idempotente).
-- - Senhas dos papéis NÃO ficam aqui; defina com ALTER ROLE ... PASSWORD '...' fora do Git.
--
-- RLS / app.current_tenant_id: políticas de linha não são definidas neste arquivo;
-- o isolamento por tenant continua na aplicação (JWT + filtros Prisma). O set_config
-- em transação permanece em set-current-tenant-local.ts quando RLS for ativada.

-- 1) Papéis de login (sem senha no repositório)
DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    CREATE ROLE "LigaDev" WITH LOGIN;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
    CREATE ROLE liga_infolab_rw WITH LOGIN;
  END IF;
END
$$;

-- 2) CONNECT no banco atual
DO $$
DECLARE
  db text := current_database();
BEGIN
  EXECUTE format('GRANT CONNECT ON DATABASE %I TO %I', db, 'LigaDev');
  EXECUTE format('GRANT CONNECT ON DATABASE %I TO %I', db, 'liga_infolab_rw');
END
$$;

-- 3) Schema public
GRANT USAGE ON SCHEMA public TO "LigaDev";
GRANT USAGE ON SCHEMA public TO liga_infolab_rw;

-- 4) Objetos já existentes (baseline + migrations anteriores)
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO "LigaDev";
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO liga_infolab_rw;

GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO "LigaDev";
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO liga_infolab_rw;

GRANT ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public TO "LigaDev";
GRANT ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public TO liga_infolab_rw;

-- 5) Objetos criados no futuro pelo mesmo papel que executa migrations (current_user)
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON TABLES TO "LigaDev";
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON TABLES TO liga_infolab_rw;

ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON SEQUENCES TO "LigaDev";
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON SEQUENCES TO liga_infolab_rw;

ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON FUNCTIONS TO "LigaDev";
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL PRIVILEGES ON FUNCTIONS TO liga_infolab_rw;

-- 6) search_path padrão para clientes
DO $$
DECLARE
  db text := current_database();
BEGIN
  EXECUTE format(
    'ALTER ROLE %I IN DATABASE %I SET search_path = public',
    'LigaDev',
    db
  );
  EXECUTE format(
    'ALTER ROLE %I IN DATABASE %I SET search_path = public',
    'liga_infolab_rw',
    db
  );
END
$$;
