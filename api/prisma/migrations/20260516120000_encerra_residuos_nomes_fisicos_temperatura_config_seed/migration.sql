-- Ambientes parcialmente alinhados: renomeia o que ainda ficou com prefixo físico legado
-- na tabela de temperatura, sequência, PK e na PK de tenacidade_configuração; remove
-- rotina de seed substituída pelo Prisma seed (`20260422140000_remove_fn_seed_ensure_tenacidade_liga_br`).
-- Idempotente.

DROP FUNCTION IF EXISTS public.infolab_seed_ensure_tenacidade_liga_br(text, text, text);

DO $$
BEGIN
  IF to_regclass('public.infolab_temperatura_opcao') IS NOT NULL
     AND to_regclass('public.infotime_temperatura_opcao') IS NULL THEN
    ALTER TABLE public.infolab_temperatura_opcao RENAME TO infotime_temperatura_opcao;
  END IF;
END
$$;

DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_catalog.pg_class c
      JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
      WHERE n.nspname = 'public'
        AND c.relkind = 'S'
        AND c.relname = 'infolab_temperatura_opcao_id_temperatura_opcao_seq'
    )
    AND NOT EXISTS (
      SELECT 1
      FROM pg_catalog.pg_class c
      JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
      WHERE n.nspname = 'public'
        AND c.relkind = 'S'
        AND c.relname = 'infotime_temperatura_opcao_id_temperatura_opcao_seq'
    ) THEN
    ALTER SEQUENCE public.infolab_temperatura_opcao_id_temperatura_opcao_seq
      RENAME TO infotime_temperatura_opcao_id_temperatura_opcao_seq;
  END IF;
END
$$;

DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_catalog.pg_constraint c
      JOIN pg_catalog.pg_class r ON r.oid = c.conrelid
      JOIN pg_catalog.pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public'
        AND r.relname = 'infotime_temperatura_opcao'
        AND c.conname = 'infolab_temperatura_opcao_pkey'
    ) THEN
    ALTER TABLE public.infotime_temperatura_opcao RENAME CONSTRAINT infolab_temperatura_opcao_pkey TO infotime_temperatura_opcao_pkey;
  END IF;
END
$$;

DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_catalog.pg_constraint c
      JOIN pg_catalog.pg_class r ON r.oid = c.conrelid
      JOIN pg_catalog.pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public'
        AND r.relname = 'infotime_tenacidade_configuracao'
        AND c.conname = 'infolab_configuracao_tenacidade_pkey'
    ) THEN
    ALTER TABLE public.infotime_tenacidade_configuracao RENAME CONSTRAINT infolab_configuracao_tenacidade_pkey TO infotime_configuracao_tenacidade_pkey;
  END IF;
END
$$;
