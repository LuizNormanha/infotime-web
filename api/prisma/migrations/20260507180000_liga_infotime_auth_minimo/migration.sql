-- liga-prj-template / InfoTIME ERP: cria tabelas auxiliares de auth/sessão/menu
-- que NÃO existem em bancos derivados do ERP (ex.: liga_infotime). Idempotente.

-- 1) tenacidade_configuracao: 1:N por tenacidade; mantém JWT, timeout, domínio, licença.
CREATE TABLE IF NOT EXISTS "tenacidade_configuracao" (
  "id_tenacidade_configuracao" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT NOT NULL,
  "razao_social" VARCHAR(255),
  "nome_fantasia" VARCHAR(255),
  "chave_acesso" VARCHAR(255),
  "data_expiracao" TIMESTAMP(6),
  "ultimo_ano" BIGINT,
  "ultimo_atendimento" BIGINT DEFAULT 0,
  "dominio_tenacidade" VARCHAR(255),
  "chave_jwt" VARCHAR(255),
  "infolab_vet" CHAR(1),
  "somente_interfaceamento" CHAR(1),
  "utilizar_numeracao_origem_liberacao" CHAR(1),
  "utilizar_deltacheck_liberacao" CHAR(1),
  "liberar_resultado_interfaceado_baixado" CHAR(1),
  "capturar_versao_exame_apoio" CHAR(1),
  "diretorio_exportacao_resultado" VARCHAR(150),
  "diretorio_triagem_amostra" VARCHAR(150),
  "mensagem_exame_repetido" VARCHAR(200),
  "liberar_resultado_informado" CHAR(1),
  "lista_setor_libera_informado" VARCHAR(1000),
  "endpoint_pedido" VARCHAR(255),
  "endpoint_chatbot" VARCHAR(255),
  "endereco_ip_auditoria" VARCHAR(20),
  "nome_aplicacao_auditoria" VARCHAR(255),
  "timeout_sessao_minutos" INTEGER DEFAULT 15,
  "quantidade_licenca" INTEGER,
  CONSTRAINT "infolab_configuracao_tenacidade_pkey" PRIMARY KEY ("id_tenacidade_configuracao")
);

DO $$
BEGIN
  IF NOT EXISTS (
    SELECT 1 FROM pg_indexes
    WHERE schemaname='public' AND indexname='tenacidade_configuracao_dominio_tenacidade_key'
  ) THEN
    CREATE UNIQUE INDEX "tenacidade_configuracao_dominio_tenacidade_key"
      ON "tenacidade_configuracao"("dominio_tenacidade");
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (
    SELECT 1 FROM pg_constraint
    WHERE conname='fk_infolab_tenacidade_configuracao_infolab_tenacidade'
  ) THEN
    ALTER TABLE "tenacidade_configuracao"
      ADD CONSTRAINT "fk_infolab_tenacidade_configuracao_infolab_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade")
      ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

-- 2) sessao_usuario: sessões normais.
CREATE TABLE IF NOT EXISTS "sessao_usuario" (
  "id_sessao" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT NOT NULL,
  "id_usuario" BIGINT NOT NULL,
  "token_id" VARCHAR(255) NOT NULL,
  "data_criacao" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "data_expiracao" TIMESTAMP(6) NOT NULL,
  "ativo" CHAR(1) NOT NULL DEFAULT 'S',
  "dispositivo" VARCHAR(255),
  "ip" VARCHAR(45),
  "user_agent" VARCHAR(255),
  CONSTRAINT "sessao_usuario_pkey" PRIMARY KEY ("id_sessao")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='ix_sessao_token_id') THEN
    CREATE INDEX "ix_sessao_token_id" ON "sessao_usuario"("token_id");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='ux_sessao_usuario_ativa') THEN
    CREATE UNIQUE INDEX "ux_sessao_usuario_ativa" ON "sessao_usuario"("id_tenacidade", "id_usuario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='fk_sessao_tenacidade') THEN
    ALTER TABLE "sessao_usuario" ADD CONSTRAINT "fk_sessao_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='fk_sessao_usuario') THEN
    ALTER TABLE "sessao_usuario" ADD CONSTRAINT "fk_sessao_usuario"
      FOREIGN KEY ("id_usuario") REFERENCES "usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

-- 3) sessao_suporte: sessões temporárias do time de suporte/implantação.
CREATE TABLE IF NOT EXISTS "sessao_suporte" (
  "id_sessao_suporte" BIGSERIAL NOT NULL,
  "id_usuario" BIGINT NOT NULL,
  "id_tenacidade" BIGINT NOT NULL,
  "token_id" VARCHAR(255) NOT NULL,
  "numero_chamado" VARCHAR(100),
  "motivo_acesso" TEXT,
  "data_criacao" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "data_expiracao" TIMESTAMP(6) NOT NULL,
  "ativo" CHAR(1) NOT NULL DEFAULT 'S',
  "ip" VARCHAR(45),
  "dispositivo" VARCHAR(255),
  "user_agent" TEXT,
  CONSTRAINT "sessao_suporte_pkey" PRIMARY KEY ("id_sessao_suporte")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='sessao_suporte_token_id_key') THEN
    CREATE UNIQUE INDEX "sessao_suporte_token_id_key" ON "sessao_suporte"("token_id");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_sessao_suporte_tenacidade') THEN
    CREATE INDEX "idx_sessao_suporte_tenacidade" ON "sessao_suporte"("id_tenacidade");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_sessao_suporte_token_id') THEN
    CREATE INDEX "idx_sessao_suporte_token_id" ON "sessao_suporte"("token_id");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_sessao_suporte_usuario') THEN
    CREATE INDEX "idx_sessao_suporte_usuario" ON "sessao_suporte"("id_usuario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='sessao_suporte_id_tenacidade_fkey') THEN
    ALTER TABLE "sessao_suporte" ADD CONSTRAINT "sessao_suporte_id_tenacidade_fkey"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='sessao_suporte_id_usuario_fkey') THEN
    ALTER TABLE "sessao_suporte" ADD CONSTRAINT "sessao_suporte_id_usuario_fkey"
      FOREIGN KEY ("id_usuario") REFERENCES "usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

-- 4) formulario: catálogo de formulários para permissões/menu.
CREATE TABLE IF NOT EXISTS "formulario" (
  "id_formulario" BIGSERIAL NOT NULL,
  "codigo" VARCHAR(80) NOT NULL,
  "descricao" VARCHAR(255),
  "ordem" INTEGER NOT NULL DEFAULT 0,
  "ativo" BOOLEAN NOT NULL DEFAULT true,
  CONSTRAINT "formulario_pkey" PRIMARY KEY ("id_formulario")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='formulario_codigo_key') THEN
    CREATE UNIQUE INDEX "formulario_codigo_key" ON "formulario"("codigo");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='formulario_ativo_ordem_idx') THEN
    CREATE INDEX "formulario_ativo_ordem_idx" ON "formulario"("ativo", "ordem");
  END IF;
END $$;

-- 5) usuario_permissoes: vínculo grupo_usuario × formulario × ações.
CREATE TABLE IF NOT EXISTS "usuario_permissoes" (
  "id_usuario_permissao" BIGSERIAL NOT NULL,
  "id_grupo_usuario" BIGINT NOT NULL,
  "id_formulario" BIGINT NOT NULL,
  "id_tenacidade" BIGINT,
  "id_usuario_auditoria" BIGINT,
  "administrador" CHAR(1) NOT NULL DEFAULT 'N',
  "incluir" CHAR(1) NOT NULL DEFAULT 'N',
  "editar" CHAR(1) NOT NULL DEFAULT 'N',
  "excluir" CHAR(1) NOT NULL DEFAULT 'N',
  "endereco_ip_auditoria" VARCHAR(20),
  "nome_aplicacao_auditoria" VARCHAR(255),
  CONSTRAINT "usuario_permissoes_pkey" PRIMARY KEY ("id_usuario_permissao")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_usuario_permissoes_formulario') THEN
    CREATE INDEX "idx_usuario_permissoes_formulario" ON "usuario_permissoes"("id_formulario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_usuario_permissoes_grupo') THEN
    CREATE INDEX "idx_usuario_permissoes_grupo" ON "usuario_permissoes"("id_grupo_usuario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='idx_usuario_permissoes_tenacidade') THEN
    CREATE INDEX "idx_usuario_permissoes_tenacidade" ON "usuario_permissoes"("id_tenacidade");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='uq_usuario_permissoes_grupo_formulario') THEN
    CREATE UNIQUE INDEX "uq_usuario_permissoes_grupo_formulario" ON "usuario_permissoes"("id_grupo_usuario", "id_formulario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='fk_usuario_permissoes_id_formulario') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_formulario"
      FOREIGN KEY ("id_formulario") REFERENCES "formulario"("id_formulario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='fk_usuario_permissoes_id_grupo_usuario') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_grupo_usuario"
      FOREIGN KEY ("id_grupo_usuario") REFERENCES "grupo_usuario"("id_grupo_usuario") ON DELETE CASCADE ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='fk_usuario_permissoes_id_usuario_auditoria') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

-- 6) layout_formulario: JSON de layout por formulário×grupo.
CREATE TABLE IF NOT EXISTS "layout_formulario" (
  "id_layout_formulario" BIGSERIAL NOT NULL,
  "id_formulario" BIGINT NOT NULL,
  "id_grupo_usuario" BIGINT NOT NULL,
  "configuracao_json" TEXT NOT NULL,
  CONSTRAINT "layout_formulario_pkey" PRIMARY KEY ("id_layout_formulario")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='layout_formulario_id_formulario_idx') THEN
    CREATE INDEX "layout_formulario_id_formulario_idx" ON "layout_formulario"("id_formulario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='layout_formulario_id_grupo_usuario_id_formulario_key') THEN
    CREATE UNIQUE INDEX "layout_formulario_id_grupo_usuario_id_formulario_key"
      ON "layout_formulario"("id_grupo_usuario", "id_formulario");
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='layout_formulario_id_formulario_fkey') THEN
    ALTER TABLE "layout_formulario" ADD CONSTRAINT "layout_formulario_id_formulario_fkey"
      FOREIGN KEY ("id_formulario") REFERENCES "formulario"("id_formulario") ON DELETE RESTRICT ON UPDATE CASCADE;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname='layout_formulario_id_grupo_usuario_fkey') THEN
    ALTER TABLE "layout_formulario" ADD CONSTRAINT "layout_formulario_id_grupo_usuario_fkey"
      FOREIGN KEY ("id_grupo_usuario") REFERENCES "grupo_usuario"("id_grupo_usuario") ON DELETE CASCADE ON UPDATE CASCADE;
  END IF;
END $$;

-- 7) Privilégios para o role de aplicação (LigaDev). Idempotente.
DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname='LigaDev') THEN
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.tenacidade_configuracao TO "LigaDev"';
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.sessao_usuario TO "LigaDev"';
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.sessao_suporte TO "LigaDev"';
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.formulario TO "LigaDev"';
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.usuario_permissoes TO "LigaDev"';
    EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON public.layout_formulario TO "LigaDev"';
    EXECUTE 'GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO "LigaDev"';
  END IF;
END $$;

-- 8) Seed mínimo de tenacidade_configuracao para tenants ativos sem configuração ainda.
--    Domínio resolvido a partir do email do 1º usuário ativo do tenant (case-insensitive).
INSERT INTO "tenacidade_configuracao" (
  "id_tenacidade", "razao_social", "nome_fantasia",
  "dominio_tenacidade", "chave_jwt", "timeout_sessao_minutos", "data_expiracao"
)
SELECT
  t.id_tenacidade,
  t.razao_social,
  t.nome_fantasia,
  COALESCE(
    LOWER(TRIM(SPLIT_PART((
      SELECT u.email FROM usuario u
       WHERE u.id_tenacidade = t.id_tenacidade
         AND COALESCE(u.ativo, 'N') IN ('S','Y')
         AND u.email IS NOT NULL AND length(trim(u.email)) > 0
       ORDER BY u.id_usuario LIMIT 1
    ), '@', 2))),
    'liga.inf.br'
  ),
  MD5(t.id_tenacidade::text || '|' || COALESCE(t.razao_social, '') || '|' || clock_timestamp()::text || '|' || random()::text)
    || MD5(random()::text || clock_timestamp()::text || t.id_tenacidade::text),
  480,
  COALESCE(t.data_expiracao, NOW() + INTERVAL '10 years')
FROM tenacidade t
WHERE t.ativo = 'S'
  AND NOT EXISTS (
    SELECT 1 FROM "tenacidade_configuracao" c WHERE c.id_tenacidade = t.id_tenacidade
  );
