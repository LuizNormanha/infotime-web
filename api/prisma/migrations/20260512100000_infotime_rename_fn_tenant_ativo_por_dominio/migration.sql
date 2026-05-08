-- InfoTIME: alinhar nome da função no catálogo (antes `infolab_tenant_ativo_por_dominio`).
-- Privilégios e OID permanecem após RENAME.
DO $$
BEGIN
  IF to_regprocedure('public.infolab_tenant_ativo_por_dominio(text)') IS NOT NULL THEN
    ALTER FUNCTION public.infolab_tenant_ativo_por_dominio(text) RENAME TO infotime_tenant_ativo_por_dominio;
  END IF;
END $$;
