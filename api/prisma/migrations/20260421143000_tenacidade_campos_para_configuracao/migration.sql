-- Move campos de licença/identidade do tenant de `infolab_tenacidade` para `infolab_tenacidade_configuracao`
-- (razão social, fantasia, chaves, expiração, domínio, JWT). Login e funções SQL passam a resolver pelo domínio na configuração.

ALTER TABLE "infolab_tenacidade_configuracao"
  ADD COLUMN "razao_social" VARCHAR(255),
  ADD COLUMN "nome_fantasia" VARCHAR(255),
  ADD COLUMN "chave_acesso" VARCHAR(255),
  ADD COLUMN "data_expiracao" TIMESTAMP(6),
  ADD COLUMN "ultimo_ano" BIGINT,
  ADD COLUMN "ultimo_atendimento" BIGINT DEFAULT 0,
  ADD COLUMN "dominio_tenacidade" VARCHAR(255),
  ADD COLUMN "chave_jwt" VARCHAR(255);

-- Copia para a linha de configuração “canônica” (menor id por laboratório), alinhado ao LATERAL ORDER BY id ASC LIMIT 1.
UPDATE "infolab_tenacidade_configuracao" AS c
SET
  "razao_social" = t."razao_social",
  "nome_fantasia" = t."nome_fantasia",
  "chave_acesso" = t."chave_acesso",
  "data_expiracao" = t."data_expiracao",
  "ultimo_ano" = t."ultimo_ano",
  "ultimo_atendimento" = COALESCE(t."ultimo_atendimento", 0),
  "dominio_tenacidade" = t."dominio_tenacidade",
  "chave_jwt" = t."chave_jwt"
FROM "infolab_tenacidade" AS t
WHERE c."id_tenacidade" = t."id_tenacidade"
  AND c."id_tenacidade_configuracao" = (
    SELECT MIN(c2."id_tenacidade_configuracao")
    FROM "infolab_tenacidade_configuracao" AS c2
    WHERE c2."id_tenacidade" = t."id_tenacidade"
  );

-- Laboratório sem configuração: cria uma linha mínima com os dados vindos da tenacidade.
INSERT INTO "infolab_tenacidade_configuracao" (
  "id_tenacidade",
  "razao_social",
  "nome_fantasia",
  "chave_acesso",
  "data_expiracao",
  "ultimo_ano",
  "ultimo_atendimento",
  "dominio_tenacidade",
  "chave_jwt",
  "timeout_sessao_minutos",
  "quantidade_licenca"
)
SELECT
  t."id_tenacidade",
  t."razao_social",
  t."nome_fantasia",
  t."chave_acesso",
  t."data_expiracao",
  t."ultimo_ano",
  COALESCE(t."ultimo_atendimento", 0),
  t."dominio_tenacidade",
  t."chave_jwt",
  15,
  NULL
FROM "infolab_tenacidade" AS t
WHERE NOT EXISTS (
  SELECT 1
  FROM "infolab_tenacidade_configuracao" AS c
  WHERE c."id_tenacidade" = t."id_tenacidade"
);

DROP INDEX IF EXISTS "infolab_tenacidade_dominio_tenacidade_key";

ALTER TABLE "infolab_tenacidade"
  DROP COLUMN IF EXISTS "razao_social",
  DROP COLUMN IF EXISTS "nome_fantasia",
  DROP COLUMN IF EXISTS "chave_acesso",
  DROP COLUMN IF EXISTS "data_expiracao",
  DROP COLUMN IF EXISTS "ultimo_ano",
  DROP COLUMN IF EXISTS "ultimo_atendimento",
  DROP COLUMN IF EXISTS "dominio_tenacidade",
  DROP COLUMN IF EXISTS "chave_jwt";

CREATE UNIQUE INDEX "infolab_tenacidade_configuracao_dominio_tenacidade_key"
  ON "infolab_tenacidade_configuracao" ("dominio_tenacidade");

-- O retorno (RETURNS TABLE) mudou: em PG é obrigatório dropar antes de recriar (42P13).
DROP FUNCTION IF EXISTS public.infolab_tenant_ativo_por_dominio(text);

-- Login por domínio + chave JWT e licença na configuração canônica (primeira linha por id).
CREATE OR REPLACE FUNCTION public.infolab_tenant_ativo_por_dominio(p_dominio text)
RETURNS TABLE (
  id_tenacidade bigint,
  chave_jwt text,
  timeout_sessao_minutos int,
  quantidade_licenca int,
  data_expiracao timestamp
)
LANGUAGE sql
STABLE
SECURITY DEFINER
SET search_path = public
AS $$
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
$$;

REVOKE ALL ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) FROM PUBLIC;
GRANT EXECUTE ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) TO "LigaDev";
GRANT EXECUTE ON FUNCTION public.infolab_tenant_ativo_por_dominio(text) TO liga_infolab_rw;

-- Seed Liga: domínio e nomes ficam na configuração ligada ao mesmo id_tenacidade.
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
  INNER JOIN infolab_tenacidade_configuracao c
    ON c.id_tenacidade = t.id_tenacidade
      AND lower(trim(c.dominio_tenacidade)) = 'liga.br'
  LIMIT 1;

  IF v_id IS NOT NULL THEN
    UPDATE infolab_tenacidade
    SET ativo = 'S'
    WHERE id_tenacidade = v_id;

    UPDATE infolab_tenacidade_configuracao
    SET
      razao_social = p_razao_social,
      nome_fantasia = p_nome_fantasia,
      chave_jwt = p_chave_jwt
    WHERE id_tenacidade = v_id
      AND lower(trim(dominio_tenacidade)) = 'liga.br';

    RETURN v_id;
  END IF;

  v_id := nextval(pg_get_serial_sequence('infolab_tenacidade', 'id_tenacidade')::regclass);
  INSERT INTO infolab_tenacidade (
    id_tenacidade,
    ativo
  )
  VALUES (
    v_id,
    'S'
  );

  INSERT INTO infolab_tenacidade_configuracao (
    id_tenacidade,
    razao_social,
    nome_fantasia,
    dominio_tenacidade,
    chave_jwt,
    timeout_sessao_minutos,
    quantidade_licenca
  )
  VALUES (
    v_id,
    p_razao_social,
    p_nome_fantasia,
    'liga.br',
    p_chave_jwt,
    15,
    NULL
  );

  RETURN v_id;
END;
$$;

REVOKE ALL ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) FROM PUBLIC;
GRANT EXECUTE ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) TO "LigaDev";
GRANT EXECUTE ON FUNCTION public.infolab_seed_ensure_tenacidade_liga_br(text, text, text) TO liga_infolab_rw;
