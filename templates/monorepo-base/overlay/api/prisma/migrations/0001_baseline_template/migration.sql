-- Baseline idempotente: banco novo (template) com tabelas mínimas para login, tenant,
-- usuário, grupo, permissões, layout/aplicação e sessões. Ajuste GRANTs ao seu role de app.

-- Role de aplicação (ex.: liga_infotime / liga_template_rw)
DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN
    CREATE ROLE "LigaDev";
  END IF;
END $$;

-- 1) Tenacidade
CREATE TABLE IF NOT EXISTS "tenacidade" (
  "id_tenacidade" BIGSERIAL NOT NULL,
  "id_usuario_auditoria" BIGINT,
  "razao_social" VARCHAR(255),
  "nome_fantasia" VARCHAR(255),
  "chave_acesso" VARCHAR(255),
  "data_expiracao" TIMESTAMP(6),
  "estoque" CHAR(1),
  "ativo" CHAR(1),
  "endereco_ip_auditoria" VARCHAR(50),
  "nome_aplicacao_auditoria" VARCHAR(255),
  CONSTRAINT "tenacidade_pkey" PRIMARY KEY ("id_tenacidade")
);

-- 2) Grupo de usuário (perfil)
CREATE TABLE IF NOT EXISTS "grupo_usuario" (
  "id_grupo_usuario" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT NOT NULL,
  "id_usuario_auditoria" BIGINT,
  "descricao" VARCHAR(200),
  "desconto_maximo" BIGINT,
  "acessa_auditoria" CHAR(1),
  "codigo_migracao" INTEGER,
  "codigo_externo" BIGINT,
  "endereco_ip_auditoria" VARCHAR(20),
  "nome_aplicacao_auditoria" VARCHAR(255),
  CONSTRAINT "grupo_usuario_pkey" PRIMARY KEY ("id_grupo_usuario")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_grupo_usuario_id_tenacidade') THEN
    ALTER TABLE "grupo_usuario"
      ADD CONSTRAINT "fk_grupo_usuario_id_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON UPDATE RESTRICT;
  END IF;
END $$;

-- 3) Usuário
CREATE TABLE IF NOT EXISTS "usuario" (
  "id_usuario" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT,
  "id_unidade" BIGINT,
  "id_grupo_usuario" BIGINT,
  "id_usuario_auditoria" BIGINT,
  "nome" VARCHAR(100),
  "sexo" CHAR(1),
  "data_nascimento" DATE,
  "login" VARCHAR(50),
  "senha" VARCHAR(100),
  "email" VARCHAR(255),
  "telefone" VARCHAR(30),
  "celular" VARCHAR(30),
  "nome_arquivo_fotografia" VARCHAR(255),
  "nome_referencia_fotografia" VARCHAR(255),
  "nome_arquivo_assinatura" VARCHAR(255),
  "nome_referencia_assinatura" VARCHAR(255),
  "cracha" VARCHAR(20),
  "cpf" CHAR(11),
  "identidade" VARCHAR(12),
  "cartao_nacional_saude" VARCHAR(15),
  "orgao_emissor" VARCHAR(8),
  "cep" CHAR(10),
  "tipo_logradouro" VARCHAR(50),
  "logradouro" VARCHAR(100),
  "numero" VARCHAR(25),
  "complemento" VARCHAR(25) DEFAULT '',
  "bairro" VARCHAR(100),
  "cidade" VARCHAR(100),
  "estado" CHAR(2),
  "codigo_ativacao" VARCHAR(50),
  "liberar_resultado" VARCHAR(2),
  "retirar_quarentena" CHAR(1),
  "motivo_bloqueio_impressao_resultado" CHAR(1),
  "lista_convenio_permitido" VARCHAR(255) DEFAULT '',
  "lista_unidade_permitido" VARCHAR(255),
  "alertar_laudo_parcial" CHAR(1),
  "bloquear_impressao_laudo_parcial" CHAR(1),
  "alterar_resultado_liberado" CHAR(1),
  "visualizar_laudo_antes_liberacao" CHAR(1),
  "codigo_externo" VARCHAR(30),
  "codigo_migracao" VARCHAR(10),
  "ativo" CHAR(1),
  "nome_aplicacao_auditoria" VARCHAR(255),
  "endereco_ip_auditoria" VARCHAR(20),
  CONSTRAINT "usuario_pkey" PRIMARY KEY ("id_usuario")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_id_tenacidade') THEN
    ALTER TABLE "usuario"
      ADD CONSTRAINT "fk_usuario_id_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_id_grupo_usuario') THEN
    ALTER TABLE "usuario"
      ADD CONSTRAINT "fk_usuario_id_grupo_usuario"
      FOREIGN KEY ("id_grupo_usuario") REFERENCES "grupo_usuario"("id_grupo_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_id_usuario_auditoria') THEN
    ALTER TABLE "usuario"
      ADD CONSTRAINT "fk_usuario_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_grupo_usuario_id_usuario_auditoria') THEN
    ALTER TABLE "grupo_usuario"
      ADD CONSTRAINT "fk_grupo_usuario_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

-- FK tenacidade.id_usuario_auditoria → usuario (após existir pelo menos um usuário)
-- 4) Aplicação + campos (metadados de telas)
CREATE TABLE IF NOT EXISTS "aplicacao" (
  "id_aplicacao" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT NOT NULL DEFAULT 0,
  "id_usuario_auditoria" BIGINT,
  "codigo_aplicacao" VARCHAR(120) NOT NULL,
  "nome_aplicacao" VARCHAR(180) NOT NULL,
  "descricao_aplicacao" TEXT,
  "nome_tabela_principal" VARCHAR(120) NOT NULL,
  "nome_rota_frontend" VARCHAR(200),
  "nome_endpoint_backend" VARCHAR(200),
  "usa_listagem" BOOLEAN NOT NULL DEFAULT true,
  "usa_formulario" BOOLEAN NOT NULL DEFAULT true,
  "ativo" BOOLEAN NOT NULL DEFAULT true,
  "dica_aplicacao" TEXT,
  "observacao" TEXT,
  "nome_aplicacao_auditoria" VARCHAR(120),
  "endereco_ip_auditoria" VARCHAR(45),
  CONSTRAINT "aplicacao_pkey" PRIMARY KEY ("id_aplicacao")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_infolab_aplicacao_id_usuario_auditoria') THEN
    ALTER TABLE "aplicacao"
      ADD CONSTRAINT "fk_infolab_aplicacao_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

CREATE UNIQUE INDEX IF NOT EXISTS "uq_infolab_aplicacao_01" ON "aplicacao"("id_tenacidade", "codigo_aplicacao");

CREATE TABLE IF NOT EXISTS "aplicacao_campo" (
  "id_aplicacao_campo" BIGSERIAL NOT NULL,
  "id_tenacidade" BIGINT NOT NULL DEFAULT 0,
  "id_aplicacao" BIGINT NOT NULL,
  "id_usuario_auditoria" BIGINT,
  "codigo_campo" VARCHAR(120) NOT NULL,
  "nome_campo" VARCHAR(180) NOT NULL,
  "descricao_campo" TEXT,
  "origem_campo" VARCHAR(180),
  "tipo_componente" VARCHAR(60) NOT NULL,
  "tipo_dado" VARCHAR(60) NOT NULL,
  "secao_formulario" VARCHAR(100),
  "aba_formulario" VARCHAR(100),
  "placeholder" VARCHAR(200),
  "mascara" VARCHAR(80),
  "dica_campo" TEXT,
  "obrigatorio_padrao" BOOLEAN NOT NULL DEFAULT false,
  "visivel_formulario_padrao" BOOLEAN NOT NULL DEFAULT true,
  "editavel_formulario_padrao" BOOLEAN NOT NULL DEFAULT true,
  "exibir_listagem_padrao" BOOLEAN NOT NULL DEFAULT false,
  "permite_filtro_padrao" BOOLEAN NOT NULL DEFAULT false,
  "permite_ordenacao_padrao" BOOLEAN NOT NULL DEFAULT false,
  "fixo_listagem_padrao" BOOLEAN NOT NULL DEFAULT false,
  "ordem_formulario_padrao" INTEGER NOT NULL DEFAULT 0,
  "ordem_listagem_padrao" INTEGER NOT NULL DEFAULT 0,
  "participa_subtitulo_formulario_padrao" BOOLEAN NOT NULL DEFAULT false,
  "ordem_subtitulo_formulario_padrao" INTEGER NOT NULL DEFAULT 0,
  "largura_listagem_padrao" INTEGER,
  "alinhamento_listagem_padrao" VARCHAR(10) NOT NULL DEFAULT 'left',
  "valor_padrao" TEXT,
  "validacao_json" JSONB NOT NULL DEFAULT '{}',
  "opcoes_json" JSONB NOT NULL DEFAULT '{}',
  "ativo" BOOLEAN NOT NULL DEFAULT true,
  "nome_aplicacao_auditoria" VARCHAR(120),
  "endereco_ip_auditoria" VARCHAR(45),
  CONSTRAINT "aplicacao_campo_pkey" PRIMARY KEY ("id_aplicacao_campo")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_infolab_aplicacao_campo_01') THEN
    ALTER TABLE "aplicacao_campo"
      ADD CONSTRAINT "fk_infolab_aplicacao_campo_01"
      FOREIGN KEY ("id_aplicacao") REFERENCES "aplicacao"("id_aplicacao") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

CREATE UNIQUE INDEX IF NOT EXISTS "uq_infolab_aplicacao_campo_01" ON "aplicacao_campo"("id_tenacidade", "id_aplicacao", "codigo_campo");

-- 5) Configuração por tenant (JWT, timeout, domínio)
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
    SELECT 1 FROM pg_indexes WHERE schemaname='public' AND indexname='tenacidade_configuracao_dominio_tenacidade_key'
  ) THEN
    CREATE UNIQUE INDEX "tenacidade_configuracao_dominio_tenacidade_key"
      ON "tenacidade_configuracao"("dominio_tenacidade");
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_infolab_tenacidade_configuracao_infolab_tenacidade') THEN
    ALTER TABLE "tenacidade_configuracao"
      ADD CONSTRAINT "fk_infolab_tenacidade_configuracao_infolab_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

-- 6) Sessões
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
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_sessao_tenacidade') THEN
    ALTER TABLE "sessao_usuario" ADD CONSTRAINT "fk_sessao_tenacidade"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_sessao_usuario') THEN
    ALTER TABLE "sessao_usuario" ADD CONSTRAINT "fk_sessao_usuario"
      FOREIGN KEY ("id_usuario") REFERENCES "usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

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
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'sessao_suporte_id_tenacidade_fkey') THEN
    ALTER TABLE "sessao_suporte" ADD CONSTRAINT "sessao_suporte_id_tenacidade_fkey"
      FOREIGN KEY ("id_tenacidade") REFERENCES "tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'sessao_suporte_id_usuario_fkey') THEN
    ALTER TABLE "sessao_suporte" ADD CONSTRAINT "sessao_suporte_id_usuario_fkey"
      FOREIGN KEY ("id_usuario") REFERENCES "usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
  END IF;
END $$;

-- 7) Formulário / permissões / layout
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
END $$;

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
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_permissoes_id_formulario') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_formulario"
      FOREIGN KEY ("id_formulario") REFERENCES "formulario"("id_formulario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_permissoes_id_grupo_usuario') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_grupo_usuario"
      FOREIGN KEY ("id_grupo_usuario") REFERENCES "grupo_usuario"("id_grupo_usuario") ON DELETE CASCADE ON UPDATE RESTRICT;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_usuario_permissoes_id_usuario_auditoria') THEN
    ALTER TABLE "usuario_permissoes" ADD CONSTRAINT "fk_usuario_permissoes_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

CREATE UNIQUE INDEX IF NOT EXISTS "uq_usuario_permissoes_grupo_formulario" ON "usuario_permissoes"("id_grupo_usuario", "id_formulario");

CREATE TABLE IF NOT EXISTS "layout_formulario" (
  "id_layout_formulario" BIGSERIAL NOT NULL,
  "id_formulario" BIGINT NOT NULL,
  "id_grupo_usuario" BIGINT NOT NULL,
  "configuracao_json" TEXT NOT NULL,
  CONSTRAINT "layout_formulario_pkey" PRIMARY KEY ("id_layout_formulario")
);

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'layout_formulario_id_formulario_fkey') THEN
    ALTER TABLE "layout_formulario" ADD CONSTRAINT "layout_formulario_id_formulario_fkey"
      FOREIGN KEY ("id_formulario") REFERENCES "formulario"("id_formulario") ON DELETE RESTRICT ON UPDATE CASCADE;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'layout_formulario_id_grupo_usuario_fkey') THEN
    ALTER TABLE "layout_formulario" ADD CONSTRAINT "layout_formulario_id_grupo_usuario_fkey"
      FOREIGN KEY ("id_grupo_usuario") REFERENCES "grupo_usuario"("id_grupo_usuario") ON DELETE CASCADE ON UPDATE CASCADE;
  END IF;
END $$;

CREATE UNIQUE INDEX IF NOT EXISTS "layout_formulario_id_grupo_usuario_id_formulario_key"
  ON "layout_formulario"("id_grupo_usuario", "id_formulario");

-- 8) RLS em usuario (multi-tenant)
ALTER TABLE "usuario" ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS infotime_usuario_tenant_rls ON public.usuario;
CREATE POLICY infotime_usuario_tenant_rls ON public.usuario
  FOR ALL
  USING (
    id_tenacidade IS NULL
    OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
  )
  WITH CHECK (
    id_tenacidade IS NULL
    OR id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
  );

-- 9) GRANTs ao LigaDev
DO $$
DECLARE
  t TEXT;
  tabelas_rw TEXT[] := ARRAY[
    'tenacidade',
    'usuario',
    'grupo_usuario',
    'aplicacao',
    'aplicacao_campo',
    'tenacidade_configuracao',
    'sessao_usuario',
    'sessao_suporte',
    'formulario',
    'usuario_permissoes',
    'layout_formulario'
  ];
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'LigaDev') THEN RETURN; END IF;
  FOREACH t IN ARRAY tabelas_rw LOOP
    IF to_regclass('public.' || t) IS NOT NULL THEN
      EXECUTE format('GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE public.%I TO "LigaDev"', t);
    END IF;
  END LOOP;
  EXECUTE 'GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO "LigaDev"';
END $$;

-- 10) Seed mínimo: tenant 1, grupo, usuários técnicos, config JWT
INSERT INTO "tenacidade" ("id_tenacidade", "razao_social", "nome_fantasia", "ativo")
SELECT 1, 'Tenant demonstração', 'Liga Template', 'S'
WHERE NOT EXISTS (SELECT 1 FROM "tenacidade" WHERE "id_tenacidade" = 1);

INSERT INTO "grupo_usuario" ("id_grupo_usuario", "id_tenacidade", "descricao")
SELECT 1, 1, 'Administradores'
WHERE NOT EXISTS (SELECT 1 FROM "grupo_usuario" WHERE "id_grupo_usuario" = 1);

INSERT INTO "tenacidade_configuracao" (
  "id_tenacidade", "razao_social", "nome_fantasia",
  "dominio_tenacidade", "chave_jwt", "timeout_sessao_minutos", "data_expiracao"
)
SELECT
  1,
  'Tenant demonstração',
  'Liga Template',
  'liga.local',
  MD5('jwt|' || clock_timestamp()::text || '|' || random()::text)
    || MD5(random()::text || clock_timestamp()::text),
  480,
  NOW() + INTERVAL '10 years'
WHERE NOT EXISTS (SELECT 1 FROM "tenacidade_configuracao" WHERE "id_tenacidade" = 1);

INSERT INTO "usuario" (
  "id_usuario", "id_tenacidade", "id_grupo_usuario", "login", "nome", "email", "ativo",
  "nome_aplicacao_auditoria"
)
SELECT
  1, 1, 1, 'admin', 'Administrador', 'admin@liga.local', 'Y', 'liga-prj-template:seed'
WHERE NOT EXISTS (SELECT 1 FROM "usuario" WHERE "id_usuario" = 1);

UPDATE "tenacidade" SET "id_usuario_auditoria" = 1 WHERE "id_tenacidade" = 1 AND "id_usuario_auditoria" IS NULL;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'fk_tenacidade_id_usuario_auditoria') THEN
    ALTER TABLE "tenacidade"
      ADD CONSTRAINT "fk_tenacidade_id_usuario_auditoria"
      FOREIGN KEY ("id_usuario_auditoria") REFERENCES "usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;
  END IF;
END $$;

SELECT setval(
  pg_get_serial_sequence('tenacidade', 'id_tenacidade'),
  COALESCE((SELECT MAX("id_tenacidade") FROM "tenacidade"), 1)
);
SELECT setval(
  pg_get_serial_sequence('usuario', 'id_usuario'),
  COALESCE((SELECT MAX("id_usuario") FROM "usuario"), 1)
);

DO $$
DECLARE
  proximo_id BIGINT;
BEGIN
  IF NOT EXISTS (SELECT 1 FROM "usuario" WHERE LOWER(login) = 'suporte' AND "id_tenacidade" IS NULL) THEN
    SELECT COALESCE(MAX("id_usuario"), 0) + 1 INTO proximo_id FROM "usuario";
    INSERT INTO "usuario" (
      "id_usuario", "id_tenacidade", "login", "nome", "email", "ativo", "nome_aplicacao_auditoria"
    ) VALUES (
      proximo_id, NULL, 'suporte', 'Suporte LIGA (técnico)', 'suporte@liga.inf.br', 'Y', 'liga-prj-template:seed'
    );
  END IF;
  IF NOT EXISTS (SELECT 1 FROM "usuario" WHERE LOWER(login) = 'implantacao' AND "id_tenacidade" IS NULL) THEN
    SELECT COALESCE(MAX("id_usuario"), 0) + 1 INTO proximo_id FROM "usuario";
    INSERT INTO "usuario" (
      "id_usuario", "id_tenacidade", "login", "nome", "email", "ativo", "nome_aplicacao_auditoria"
    ) VALUES (
      proximo_id, NULL, 'implantacao', 'Implantação LIGA (técnico)', 'implantacao@liga.inf.br', 'Y', 'liga-prj-template:seed'
    );
  END IF;
END $$;
