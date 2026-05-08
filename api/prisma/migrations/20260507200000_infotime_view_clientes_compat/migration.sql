-- InfoTIME ERP: cadastro comercial em `public.cliente` (singular, colunas razao_social/cnpj…).
-- O modelo Prisma `infolab_cliente` espera tabela `clientes` no layout Liga (paciente/nome/cpf).
-- Quando NÃO existe tabela física `clientes`, mas existe `cliente`, publica view de leitura compatível.

DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_class c
      JOIN pg_namespace n ON n.oid = c.relnamespace
      WHERE n.nspname = 'public'
        AND c.relname = 'cliente'
        AND c.relkind = 'r'
    )
     AND NOT EXISTS (
      SELECT 1
      FROM pg_class c
      JOIN pg_namespace n ON n.oid = c.relnamespace
      WHERE n.nspname = 'public'
        AND c.relname = 'clientes'
        AND c.relkind = 'r'
    ) THEN
    EXECUTE $view$
CREATE OR REPLACE VIEW public.clientes AS
SELECT
  c.id_cliente,
  c.id_tenacidade,
  NULL::bigint AS id_cliente_mae,
  c.id_cliente_pai,
  NULL::bigint AS id_cliente_acompanhante,
  NULL::bigint AS id_cbo,
  NULL::bigint AS id_raca,
  NULL::bigint AS id_etnia,
  NULL::bigint AS id_vet_raca,
  NULL::bigint AS id_vet_especie,
  NULL::bigint AS id_necessidade_especial,
  c.id_usuario_auditoria,
  LEFT(
    TRIM(
      COALESCE(
        NULLIF(TRIM(c.nome_fantasia), ''),
        NULLIF(TRIM(c.razao_social), ''),
        ''
      )
    ),
    100
  )::character varying(100) AS nome,
  LEFT(NULLIF(TRIM(c.nome_fantasia), ''), 100)::character varying(100) AS nome_social,
  c.sexo::character(1) AS sexo,
  NULL::character varying(1) AS estado_civil,
  CASE
    WHEN c.data_nascimento IS NULL THEN NULL::date
    ELSE (c.data_nascimento AT TIME ZONE 'UTC')::date
  END AS data_nascimento,
  NULL::bigint AS peso,
  NULL::bigint AS altura,
  CASE
    WHEN length(regexp_replace(COALESCE(c.cnpj, ''), '[^0-9]', '', 'g')) <= 11
    THEN
      LEFT(
        regexp_replace(COALESCE(c.cnpj, ''), '[^0-9]', '', 'g'),
        11
      )::character varying(11)
    ELSE NULL::character varying(11)
  END AS cpf,
  LEFT(
    CASE
      WHEN length(regexp_replace(COALESCE(c.cnpj, ''), '[^0-9]', '', 'g')) > 11
      THEN regexp_replace(COALESCE(c.cnpj, ''), '[^0-9]', '', 'g')
      ELSE COALESCE(
        NULLIF(TRIM(c.inscricao_estadual), ''),
        NULLIF(TRIM(c.inscricao_municipal), ''),
        ''
      )
    END,
    30
  )::character varying(30) AS documento,
  NULL::character varying(8) AS codigo_passaporte,
  NULL::character(1) AS diabetico,
  'N'::character(1) AS bloqueado,
  NULL::character(1) AS receber_mensagem,
  NULL::character(1) AS falecido,
  LEFT(c.cep, 10)::character varying(10) AS cep,
  LEFT(c.logradouro, 100)::character varying(100) AS logradouro,
  LEFT(c.numero, 10)::character varying(10) AS numero,
  LEFT(c.complemento, 50)::character varying(50) AS complemento,
  LEFT(c.bairro, 100)::character varying(100) AS bairro,
  LEFT(c.cidade, 100)::character varying(100) AS cidade,
  c.estado::character(2) AS estado,
  NULL::character varying(100) AS endereco_referencia,
  LEFT(c.telefone, 30)::character varying(30) AS telefone,
  LEFT(c.celular, 30)::character varying(30) AS celular,
  LEFT(c.email, 255)::character varying(255) AS email,
  NULL::timestamp(6) without time zone AS data_inclusao,
  NULL::timestamp(6) without time zone AS data_admissao,
  NULL::character varying(100) AS senha_internet,
  c.observacoes AS observacao_resultado,
  NULL::character varying(50) AS prontuario,
  NULL::character varying(50) AS codigo_externo,
  NULL::bigint AS codigo_migracao,
  LEFT(c.endereco_ip_auditoria, 20)::character varying(20) AS endereco_ip_auditoria,
  c.nome_aplicacao_auditoria::character varying(255) AS nome_aplicacao_auditoria
FROM public.cliente c;
$view$;

    EXECUTE 'COMMENT ON VIEW public.clientes IS ''Compat InfoTIME: projeção de public.cliente para modelo Prisma infolab_cliente.''';

    -- View criada depois dos GRANT globais de baseline: repetir privilégios dos papéis da aplicação.
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.clientes TO "LigaDev"';
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.clientes TO liga_infolab_rw';
    END IF;
  END IF;
END
$$;
