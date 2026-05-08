-- Função para o seed (`prisma db seed`): o papel da DATABASE_URL não pode ler/inserir
-- `infolab_tenacidade` sem `app.current_tenant_id` alinhado ao `id_tenacidade` (RLS obrigatória).
-- SECURITY DEFINER + dono superuser (quem aplica migrations) ignora RLS na rotina.

CREATE OR REPLACE FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(
  p_razao_social text,
  p_nome_fantasia text,
  p_chave_jwt text
)
RETURNS bigint
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = public
AS $$
DECLARE
  v_id bigint;
BEGIN
  SELECT t.id_tenacidade INTO v_id
  FROM infolab_tenacidade t
  WHERE t.dominio_tenacidade = 'liga.br'
  LIMIT 1;

  IF v_id IS NOT NULL THEN
    UPDATE infolab_tenacidade
    SET
      razao_social = p_razao_social,
      nome_fantasia = p_nome_fantasia,
      chave_jwt = p_chave_jwt,
      ativo = 'S'
    WHERE id_tenacidade = v_id;
    RETURN v_id;
  END IF;

  v_id := nextval(pg_get_serial_sequence('infolab_tenacidade', 'id_tenacidade')::regclass);
  INSERT INTO infolab_tenacidade (
    id_tenacidade,
    razao_social,
    nome_fantasia,
    dominio_tenacidade,
    ativo,
    chave_jwt
  )
  VALUES (
    v_id,
    p_razao_social,
    p_nome_fantasia,
    'liga.br',
    'S',
    p_chave_jwt
  );
  RETURN v_id;
END;
$$;

REVOKE ALL ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) FROM PUBLIC;
GRANT EXECUTE ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) TO "LigaDev";
GRANT EXECUTE ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) TO liga_infolab_rw;
