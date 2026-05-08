/**
 * Gera docs/ddl/table-rename-map.json a partir de docs/liga_infotime_postgres.sql
 * e materializa api/prisma/migrations/<ts>_rename_physical_tables_infotime/migration.sql
 *
 * Regra de nome físico de origem (inversa ao ddl-prefix-infotime-tables.mjs):
 * - destino `infotime_temperatura_opcao` ← origem `infolab_temperatura_opcao`
 * - demais `infotime_x` ← origem `x`
 *
 * Uso: node scripts/ddl/build-table-rename-map.mjs
 */
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..', '..');
const ddlPath = path.join(root, 'docs', 'liga_infotime_postgres.sql');
const outJson = path.join(root, 'docs', 'ddl', 'table-rename-map.json');
const MIGRATION_DIR = path.join(
  root,
  'api',
  'prisma',
  'migrations',
  '20260514120000_rename_physical_tables_infotime',
);

/** Tabelas que ficam na “wave B” (núcleo operacional / login). Demais na wave A. */
const CORE_SOURCES = new Set([
  'tenacidade',
  'usuario',
  'tenacidade_configuracao',
  'sessao_usuario',
  'sessao_suporte',
  'formulario',
  'usuario_permissoes',
  'layout_formulario',
  'grupo_usuario',
  'aplicacao',
  'aplicacao_campo',
]);

function physicalSourceFromTarget(targetName) {
  if (targetName === 'infotime_temperatura_opcao') return 'infolab_temperatura_opcao';
  if (!targetName.startsWith('infotime_')) {
    throw new Error(`Nome destino inválido (esperado infotime_*): ${targetName}`);
  }
  return targetName.slice('infotime_'.length);
}

function extractTargetTableNames(ddl) {
  const re = /^CREATE TABLE (infotime_[a-zA-Z0-9_]+) \(/gm;
  const names = [];
  let m;
  while ((m = re.exec(ddl)) !== null) {
    names.push(m[1]);
  }
  return names;
}

function main() {
  const ddl = fs.readFileSync(ddlPath, 'utf8');
  const targets = extractTargetTableNames(ddl);
  if (targets.length === 0) {
    throw new Error(`Nenhuma tabela infotime_* em ${ddlPath}`);
  }

  const pairs = targets.map((to) => {
    const from = physicalSourceFromTarget(to);
    const wave = CORE_SOURCES.has(from) ? 'B' : 'A';
    return { from, to, wave };
  });

  pairs.sort((a, b) => a.from.localeCompare(b.from));

  const meta = {
    generatedAt: new Date().toISOString(),
    sourceDdl: 'docs/liga_infotime_postgres.sql',
    note:
      'Renomeação física alinhada ao export DDL com prefixo infotime_. Tabelas criadas só por migrations posteriores (ex.: soroteca infolab_*) não aparecem aqui.',
  };

  fs.mkdirSync(path.dirname(outJson), { recursive: true });
  fs.writeFileSync(
    outJson,
    JSON.stringify({ meta, pairs, counts: { total: pairs.length } }, null, 2),
    'utf8',
  );

  const waveA = pairs.filter((p) => p.wave === 'A');
  const waveB = pairs.filter((p) => p.wave === 'B');

  const alterLines = (list) =>
    list.map(
      (p) =>
        `ALTER TABLE IF EXISTS public.${quoteIdent(p.from)} RENAME TO ${quoteIdent(p.to)};`,
    );

  function quoteIdent(name) {
    if (!/^[a-z_][a-z0-9_]*$/i.test(name)) {
      throw new Error(`Identificador inválido: ${name}`);
    }
    return name;
  }

  const migrationSql = `-- Renomeia tabelas físicas do InfoTIME ERP para o prefixo infotime_* (alinhado a docs/liga_infotime_postgres.sql).
-- Mapa: docs/ddl/table-rename-map.json (gerado por scripts/ddl/build-table-rename-map.mjs).
-- Aplicação coordenada com atualização dos @@map no schema Prisma e SQL raw na API.
--
-- Ondas A/B são apenas organização dentro da mesma transação (evita estado intermediário quebrado).

BEGIN;

-- ========== Wave A: demais tabelas (${waveA.length}) ==========
${alterLines(waveA).join('\n')}

-- ========== Wave B: núcleo (${waveB.length}) ==========
${alterLines(waveB).join('\n')}

-- ========== Rotinas SQL: login por domínio (ERP com tabelas prefixadas) ==========
CREATE OR REPLACE FUNCTION public.infotime_tenant_ativo_por_dominio(p_dominio text)
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
  IF to_regclass('public.infotime_tenacidade') IS NOT NULL THEN
    RETURN QUERY
    SELECT
      t.id_tenacidade,
      t.chave_acesso::text AS chave_jwt,
      480::int AS timeout_sessao_minutos,
      NULL::int AS quantidade_licenca,
      t.data_expiracao
    FROM infotime_tenacidade t
    WHERE t.ativo = 'S'
      AND (
        EXISTS (
          SELECT 1
          FROM infotime_usuario u
          WHERE u.id_tenacidade = t.id_tenacidade
            AND COALESCE(u.ativo, 'S') = 'S'
            AND u.email IS NOT NULL
            AND length(trim(u.email)) > 0
            AND lower(trim(split_part(trim(u.email), '@', 2))) = lower(trim(p_dominio))
        )
        OR (
          (SELECT count(*) FROM infotime_tenacidade t2 WHERE t2.ativo = 'S') = 1
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

REVOKE ALL ON FUNCTION public.infotime_tenant_ativo_por_dominio(text) FROM PUBLIC;

DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    EXECUTE 'GRANT EXECUTE ON FUNCTION public.infotime_tenant_ativo_por_dominio(text) TO "LigaDev"';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
    EXECUTE 'GRANT EXECUTE ON FUNCTION public.infotime_tenant_ativo_por_dominio(text) TO liga_infolab_rw';
  END IF;
END
$$;

-- ========== View compat: clientes ← infotime_cliente (mesma lógica de 20260507200000) ==========
DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_class c
      JOIN pg_namespace n ON n.oid = c.relnamespace
      WHERE n.nspname = 'public'
        AND c.relname = 'infotime_cliente'
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
    EXECUTE 'DROP VIEW IF EXISTS public.clientes';
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
FROM public.infotime_cliente c
$view$;

    EXECUTE 'COMMENT ON VIEW public.clientes IS ''Compat InfoTIME: projeção de public.infotime_cliente para leitura tipo Liga.''';

    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.clientes TO "LigaDev"';
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'liga_infolab_rw') THEN
      EXECUTE 'GRANT SELECT ON TABLE public.clientes TO liga_infolab_rw';
    END IF;
  END IF;
END
$$;

COMMIT;
`;

  fs.mkdirSync(MIGRATION_DIR, { recursive: true });
  fs.writeFileSync(path.join(MIGRATION_DIR, 'migration.sql'), migrationSql, 'utf8');

  console.log(`Escrito ${outJson}`);
  console.log(`Escrito ${path.join(MIGRATION_DIR, 'migration.sql')}`);
  console.log(`Pares: ${pairs.length} (wave A: ${waveA.length}, wave B: ${waveB.length})`);
}

main();
