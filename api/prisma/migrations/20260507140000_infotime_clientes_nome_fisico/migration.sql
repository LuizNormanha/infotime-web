-- InfoTIME: tabela física `clientes` (Prisma @@map em `infolab_cliente`).
-- Bancos criados só com migrations Liga têm `infolab_cliente`; renomeia se ainda não existir `clientes`.

DO $$
BEGIN
  IF to_regclass('public.infolab_cliente') IS NOT NULL
     AND to_regclass('public.clientes') IS NULL THEN
    ALTER TABLE public.infolab_cliente RENAME TO clientes;
  END IF;
END
$$;
