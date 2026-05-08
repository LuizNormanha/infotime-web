-- `infolab_tenant_ativo_por_dominio`: InfoTIME ERP usa só `tenacidade` (+ `usuario.email` para casar o domínio)
-- e `chave_acesso` no lugar de chave_jwt; Liga legado usa `infolab_tenacidade` + `infolab_tenacidade_configuracao`.
-- O ramo `tenacidade` vem primeiro para ambientes InfoTIME.

CREATE OR REPLACE FUNCTION public.infolab_tenant_ativo_por_dominio(p_dominio text)
RETURNS TABLE (
  id_tenacidade bigint,
  chave_jwt text,
  timeout_sessao_minutos int,
  quantidade_licenca int,
  data_expiracao timestamp
)
LANGUAGE plpgsql
STABLE
SECURITY DEFINER
SET search_path = public
AS $$
BEGIN
  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    RETURN QUERY
    SELECT
      t.id_tenacidade,
      t.chave_acesso::text AS chave_jwt,
      480::int AS timeout_sessao_minutos,
      NULL::int AS quantidade_licenca,
      t.data_expiracao
    FROM tenacidade t
    WHERE t.ativo = 'S'
      AND (
        EXISTS (
          SELECT 1
          FROM usuario u
          WHERE u.id_tenacidade = t.id_tenacidade
            AND COALESCE(u.ativo, 'S') = 'S'
            AND u.email IS NOT NULL
            AND length(trim(u.email)) > 0
            AND lower(trim(split_part(trim(u.email), '@', 2))) = lower(trim(p_dominio))
        )
        OR (
          (SELECT count(*) FROM tenacidade t2 WHERE t2.ativo = 'S') = 1
        )
      )
    ORDER BY t.id_tenacidade
    LIMIT 1;
    RETURN;
  END IF;

  IF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    RETURN QUERY
    SELECT
      t.id_tenacidade,
      c.chave_jwt,
      c.timeout_sessao_minutos,
      c.quantidade_licenca,
      c.data_expiracao
    FROM infolab_tenacidade t
    INNER JOIN infolab_tenacidade_configuracao c
      ON c.id_tenacidade = t.id_tenacidade
      AND lower(trim(c.dominio_tenacidade)) = lower(trim(p_dominio))
    WHERE t.ativo = 'S'
    ORDER BY c.id_tenacidade_configuracao
    LIMIT 1;
    RETURN;
  END IF;

  RETURN;
END;
$$;

REVOKE ALL ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) FROM PUBLIC;

DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    EXECUTE 'GRANT EXECUTE ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) TO "LigaDev"';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
    EXECUTE 'GRANT EXECUTE ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) TO liga_infolab_rw';
  END IF;
END
$$;
