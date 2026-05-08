-- Colunas da linha-mãe de tenant como no DDL ERP (`public.tenacidade`). InfoTIME não usa
-- `public.infolab_tenacidade`; bancos LIS legados seguem em migrações anteriores.

DO $$
BEGIN
  IF to_regclass('public.tenacidade') IS NULL THEN
    RETURN;
  END IF;

  ALTER TABLE public.tenacidade ADD COLUMN IF NOT EXISTS "razao_social" VARCHAR(255);
  ALTER TABLE public.tenacidade ADD COLUMN IF NOT EXISTS "nome_fantasia" VARCHAR(255);
  ALTER TABLE public.tenacidade ADD COLUMN IF NOT EXISTS "chave_acesso" VARCHAR(255);
  ALTER TABLE public.tenacidade ADD COLUMN IF NOT EXISTS "data_expiracao" TIMESTAMP(6);
  ALTER TABLE public.tenacidade ADD COLUMN IF NOT EXISTS "estoque" CHAR(1);

  IF EXISTS (
    SELECT 1
    FROM information_schema.columns
    WHERE table_schema = 'public'
      AND table_name = 'tenacidade'
      AND column_name = 'endereco_ip_auditoria'
  ) THEN
    ALTER TABLE public.tenacidade ALTER COLUMN "endereco_ip_auditoria" TYPE VARCHAR(50);
  END IF;
END $$;
