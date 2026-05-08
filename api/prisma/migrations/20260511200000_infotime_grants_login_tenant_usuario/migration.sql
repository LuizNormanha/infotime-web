-- Banco InfoTIME (`liga_infotime`): login pode resolver tenant via `buscarTenantAtivoPorDominioInfoTIME`
-- (SELECT em `tenacidade` / `usuario`) quando a função `infotime_tenant_ativo_por_dominio` não existir,
-- ou complementar o que migrations anteriores não cobriram (tabelas com owner diferente).

DO $$
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.tenacidade TO "LigaDev"';
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.tenacidade TO liga_infolab_rw';
    END IF;
  END IF;

  IF to_regclass('public.usuario') IS NOT NULL THEN
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.usuario TO "LigaDev"';
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.usuario TO liga_infolab_rw';
    END IF;
  END IF;
END
$$;
