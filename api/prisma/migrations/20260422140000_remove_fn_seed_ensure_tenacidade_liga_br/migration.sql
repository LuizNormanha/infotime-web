-- Remove a função auxiliar de bootstrap da tenacidade `liga.br`.
-- Ela existia para contornar a RLS obrigatória em `infolab_tenacidade`
-- (migration `20260408190000_fn_seed_infotime_tenacidade_liga_br`, depois atualizada em
-- `20260421143000_tenacidade_campos_para_configuracao`).
-- Como a RLS foi removida dessas tabelas (`20260409160000_remove_rls_infotime_tenacidade` e
-- `20260422120000_remove_rls_infotime_tenacidade_configuracao`), o `prisma db seed` passa a
-- gravar diretamente via Prisma Client, sem precisar de `SECURITY DEFINER`.

DROP FUNCTION IF EXISTS public.infolab_seed_ensure_tenacidade_liga_br(text, text, text);
