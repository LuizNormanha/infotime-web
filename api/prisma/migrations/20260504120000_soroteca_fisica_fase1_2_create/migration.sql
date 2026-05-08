-- Soroteca física (fases 1+2): tabelas novas, FKs e índices.
-- Não recria infolab_tenacidade / infolab_atendimento / infolab_atendimento_amostra.
-- UK de domínio: (id_tenacidade, codigo). Barcode único por tenant quando preenchido.

-- ========== Lookups ==========
CREATE TABLE "infolab_amostra_status" (
    "id_amostra_status" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "permite_uso" BOOLEAN NOT NULL DEFAULT false,
    "terminal" BOOLEAN NOT NULL DEFAULT false,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_amostra_status_pkey" PRIMARY KEY ("id_amostra_status"),
    CONSTRAINT "infolab_amostra_status_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_material_tipo" (
    "id_material_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "requer_tcle" BOOLEAN NOT NULL DEFAULT false,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_material_tipo_pkey" PRIMARY KEY ("id_material_tipo"),
    CONSTRAINT "infolab_material_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_recipiente_tipo" (
    "id_recipiente_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "volume_nominal_ml" DECIMAL(8,3),
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "aditivo" VARCHAR(80),
    "cor_tampa" VARCHAR(40),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_recipiente_tipo_pkey" PRIMARY KEY ("id_recipiente_tipo"),
    CONSTRAINT "infolab_recipiente_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_equipamento_tipo" (
    "id_equipamento_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "temperatura_min_c" DECIMAL(6,2),
    "temperatura_max_c" DECIMAL(6,2),
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_equipamento_tipo_pkey" PRIMARY KEY ("id_equipamento_tipo"),
    CONSTRAINT "infolab_equipamento_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_movimento_tipo" (
    "id_movimento_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "requer_auth" BOOLEAN NOT NULL DEFAULT false,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_movimento_tipo_pkey" PRIMARY KEY ("id_movimento_tipo"),
    CONSTRAINT "infolab_movimento_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_bloqueio_tipo" (
    "id_bloqueio_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "impede_descarte" BOOLEAN NOT NULL DEFAULT true,
    "impede_uso" BOOLEAN NOT NULL DEFAULT true,
    "requer_auth_liberacao" BOOLEAN NOT NULL DEFAULT false,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_bloqueio_tipo_pkey" PRIMARY KEY ("id_bloqueio_tipo"),
    CONSTRAINT "infolab_bloqueio_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_residuo_grupo" (
    "id_residuo_grupo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(10) NOT NULL,
    "descricao" VARCHAR(200) NOT NULL,
    "norma" VARCHAR(60) NOT NULL DEFAULT 'RDC 222/2018',
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_residuo_grupo_pkey" PRIMARY KEY ("id_residuo_grupo"),
    CONSTRAINT "infolab_residuo_grupo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_descarte_metodo" (
    "id_descarte_metodo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_descarte_metodo_pkey" PRIMARY KEY ("id_descarte_metodo"),
    CONSTRAINT "infolab_descarte_metodo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_descarte_motivo" (
    "id_descarte_motivo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_descarte_motivo_pkey" PRIMARY KEY ("id_descarte_motivo"),
    CONSTRAINT "infolab_descarte_motivo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_norma" (
    "id_norma" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(200) NOT NULL,
    "orgao" VARCHAR(80),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_norma_pkey" PRIMARY KEY ("id_norma"),
    CONSTRAINT "infolab_norma_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_finalidade" (
    "id_finalidade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "requer_tcle" BOOLEAN NOT NULL DEFAULT false,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_finalidade_pkey" PRIMARY KEY ("id_finalidade"),
    CONSTRAINT "infolab_finalidade_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_derivado_tipo" (
    "id_derivado_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 2,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_derivado_tipo_pkey" PRIMARY KEY ("id_derivado_tipo"),
    CONSTRAINT "infolab_derivado_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_qualidade_evento_tipo" (
    "id_qualidade_evento_tipo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120) NOT NULL,
    "gravidade" VARCHAR(20) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_qualidade_evento_tipo_pkey" PRIMARY KEY ("id_qualidade_evento_tipo"),
    CONSTRAINT "infolab_qualidade_evento_tipo_gravidade_chk" CHECK ("gravidade" IN ('BAIXA','MEDIA','ALTA','CRITICA')),
    CONSTRAINT "infolab_qualidade_evento_tipo_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

-- ========== Estrutura física ==========
CREATE TABLE "infolab_soroteca_sala" (
    "id_soroteca_sala" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "nome" VARCHAR(120) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_sala_pkey" PRIMARY KEY ("id_soroteca_sala"),
    CONSTRAINT "infolab_soroteca_sala_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_soroteca_equipamento" (
    "id_soroteca_equipamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_sala" BIGINT NOT NULL,
    "id_equipamento_tipo" BIGINT NOT NULL,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "temperatura_alvo_c" DECIMAL(6,2),
    "temperatura_min_c" DECIMAL(6,2),
    "temperatura_max_c" DECIMAL(6,2),
    "capacidade_total" INTEGER,
    "codigo" VARCHAR(40) NOT NULL,
    "nome" VARCHAR(120) NOT NULL,
    "fabricante" VARCHAR(80),
    "modelo" VARCHAR(80),
    "numero_serie" VARCHAR(80),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_equipamento_pkey" PRIMARY KEY ("id_soroteca_equipamento"),
    CONSTRAINT "infolab_soroteca_equipamento_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_soroteca_rack" (
    "id_soroteca_rack" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_equipamento" BIGINT NOT NULL,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120),
    "posicao_no_equipamento" VARCHAR(40),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_rack_pkey" PRIMARY KEY ("id_soroteca_rack"),
    CONSTRAINT "infolab_soroteca_rack_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_soroteca_caixa" (
    "id_soroteca_caixa" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_rack" BIGINT NOT NULL,
    "id_local_armazenamento" BIGINT,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "num_linhas" SMALLINT NOT NULL DEFAULT 9,
    "num_colunas" SMALLINT NOT NULL DEFAULT 9,
    "codigo" VARCHAR(40) NOT NULL,
    "descricao" VARCHAR(120),
    "barcode" VARCHAR(80),
    "lista_posicoes_inativas" VARCHAR(600),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_caixa_pkey" PRIMARY KEY ("id_soroteca_caixa"),
    CONSTRAINT "infolab_soroteca_caixa_tenant_codigo_uq" UNIQUE ("id_tenacidade", "codigo")
);

CREATE TABLE "infolab_soroteca_posicao" (
    "id_soroteca_posicao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_caixa" BIGINT NOT NULL,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "linha" SMALLINT NOT NULL,
    "coluna" SMALLINT NOT NULL,
    "rotulo" VARCHAR(12) NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_posicao_pkey" PRIMARY KEY ("id_soroteca_posicao"),
    CONSTRAINT "infolab_soroteca_posicao_caixa_linha_col_uq" UNIQUE ("id_soroteca_caixa", "linha", "coluna")
);

CREATE TABLE "infolab_soroteca_retencao_regra" (
    "id_soroteca_retencao_regra" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_material_tipo" BIGINT,
    "id_finalidade" BIGINT,
    "id_norma" BIGINT,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "permite_prorrogacao" BOOLEAN NOT NULL DEFAULT false,
    "prazo_dias" INTEGER NOT NULL,
    "prazo_minimo_dias" INTEGER NOT NULL DEFAULT 0,
    "prioridade" SMALLINT NOT NULL DEFAULT 10,
    "fase" SMALLINT NOT NULL DEFAULT 1,
    "codigo_exame" VARCHAR(40),
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_retencao_regra_pkey" PRIMARY KEY ("id_soroteca_retencao_regra")
);

CREATE TABLE "infolab_soroteca_aliquota" (
    "id_soroteca_aliquota" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT NOT NULL,
    "id_amostra_status" BIGINT NOT NULL,
    "id_material_tipo" BIGINT NOT NULL,
    "id_recipiente_tipo" BIGINT,
    "id_finalidade" BIGINT,
    "id_soroteca_retencao_regra" BIGINT,
    "numero_aliquota" SMALLINT NOT NULL DEFAULT 1,
    "freeze_thaw_count" SMALLINT NOT NULL DEFAULT 0,
    "volume_ml" DECIMAL(8,3),
    "volume_residual_ml" DECIMAL(8,3),
    "data_aliquotagem" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_validade" DATE,
    "barcode" VARCHAR(80),
    "barcode_2d" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_aliquota_pkey" PRIMARY KEY ("id_soroteca_aliquota")
);

CREATE UNIQUE INDEX "infolab_soroteca_aliquota_barcode_tenant_uq"
    ON "infolab_soroteca_aliquota" ("id_tenacidade", "barcode")
    WHERE "barcode" IS NOT NULL AND trim("barcode") <> '';

CREATE TABLE "infolab_soroteca_derivado" (
    "id_soroteca_derivado" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_aliquota" BIGINT NOT NULL,
    "id_derivado_tipo" BIGINT NOT NULL,
    "id_amostra_status" BIGINT NOT NULL,
    "id_soroteca_retencao_regra" BIGINT,
    "freeze_thaw_count" SMALLINT NOT NULL DEFAULT 0,
    "concentracao_ng_ul" DECIMAL(10,4),
    "pureza_260_280" DECIMAL(6,4),
    "pureza_260_230" DECIMAL(6,4),
    "data_preparacao" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_validade" DATE,
    "barcode" VARCHAR(80),
    "barcode_2d" VARCHAR(200),
    "metodo_extracao" VARCHAR(120),
    "kit_extracao" VARCHAR(120),
    "lote_kit" VARCHAR(80),
    "numero_cassete" VARCHAR(40),
    "numero_bloco" VARCHAR(40),
    "numero_lamina" VARCHAR(40),
    "coracao" VARCHAR(80),
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_derivado_pkey" PRIMARY KEY ("id_soroteca_derivado")
);

CREATE UNIQUE INDEX "infolab_soroteca_derivado_barcode_tenant_uq"
    ON "infolab_soroteca_derivado" ("id_tenacidade", "barcode")
    WHERE "barcode" IS NOT NULL AND trim("barcode") <> '';

CREATE TABLE "infolab_soroteca_armazenamento" (
    "id_soroteca_armazenamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_posicao" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "id_soroteca_aliquota" BIGINT,
    "id_soroteca_derivado" BIGINT,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "data_hora_entrada" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_hora_saida" TIMESTAMP(6),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_armazenamento_pkey" PRIMARY KEY ("id_soroteca_armazenamento"),
    CONSTRAINT "infolab_soroteca_armazenamento_item_chk" CHECK (
        (CASE WHEN "id_atendimento_amostra" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_aliquota" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_derivado" IS NOT NULL THEN 1 ELSE 0 END) = 1
    )
);

CREATE UNIQUE INDEX "uq_armazenamento_posicao_ativo"
    ON "infolab_soroteca_armazenamento" ("id_soroteca_posicao") WHERE "ativo" = true;
CREATE UNIQUE INDEX "uq_armazenamento_amostra_ativo"
    ON "infolab_soroteca_armazenamento" ("id_atendimento_amostra")
    WHERE "ativo" = true AND "id_atendimento_amostra" IS NOT NULL;
CREATE UNIQUE INDEX "uq_armazenamento_aliquota_ativo"
    ON "infolab_soroteca_armazenamento" ("id_soroteca_aliquota")
    WHERE "ativo" = true AND "id_soroteca_aliquota" IS NOT NULL;
CREATE UNIQUE INDEX "uq_armazenamento_derivado_ativo"
    ON "infolab_soroteca_armazenamento" ("id_soroteca_derivado")
    WHERE "ativo" = true AND "id_soroteca_derivado" IS NOT NULL;

CREATE TABLE "infolab_soroteca_bloqueio" (
    "id_soroteca_bloqueio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_bloqueio_tipo" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "id_soroteca_aliquota" BIGINT,
    "id_soroteca_derivado" BIGINT,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "data_hora_inicio" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_hora_fim" TIMESTAMP(6),
    "numero_processo" VARCHAR(80),
    "motivo" TEXT NOT NULL,
    "observacoes_liberacao" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_bloqueio_pkey" PRIMARY KEY ("id_soroteca_bloqueio"),
    CONSTRAINT "infolab_soroteca_bloqueio_item_chk" CHECK (
        (CASE WHEN "id_atendimento_amostra" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_aliquota" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_derivado" IS NOT NULL THEN 1 ELSE 0 END) = 1
    )
);

CREATE TABLE "infolab_soroteca_movimento" (
    "id_soroteca_movimento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_movimento_tipo" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "id_soroteca_aliquota" BIGINT,
    "id_soroteca_derivado" BIGINT,
    "id_posicao_origem" BIGINT,
    "id_posicao_destino" BIGINT,
    "volume_usado_ml" DECIMAL(8,3),
    "data_hora_movimento" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "numero_manifesto" VARCHAR(80),
    "laboratorio_apoio" VARCHAR(200),
    "motivo" TEXT,
    "hash_custodia" VARCHAR(64),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_movimento_pkey" PRIMARY KEY ("id_soroteca_movimento"),
    CONSTRAINT "infolab_soroteca_movimento_item_chk" CHECK (
        (CASE WHEN "id_atendimento_amostra" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_aliquota" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_derivado" IS NOT NULL THEN 1 ELSE 0 END) = 1
    )
);

CREATE TABLE "infolab_descarte_lote" (
    "id_descarte_lote" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "data_hora_descarte" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "numero_lote" VARCHAR(40) NOT NULL,
    "empresa_coletora" VARCHAR(200),
    "cnpj_empresa" VARCHAR(20),
    "numero_manifesto" VARCHAR(80),
    "observacoes" TEXT,
    "assinatura_responsavel" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_descarte_lote_pkey" PRIMARY KEY ("id_descarte_lote"),
    CONSTRAINT "infolab_descarte_lote_tenant_numero_uq" UNIQUE ("id_tenacidade", "numero_lote")
);

CREATE TABLE "infolab_descarte_item" (
    "id_descarte_item" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_descarte_lote" BIGINT NOT NULL,
    "id_descarte_motivo" BIGINT NOT NULL,
    "id_descarte_metodo" BIGINT NOT NULL,
    "id_residuo_grupo" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "id_soroteca_aliquota" BIGINT,
    "id_soroteca_derivado" BIGINT,
    "volume_descartado_ml" DECIMAL(8,3),
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_descarte_item_pkey" PRIMARY KEY ("id_descarte_item"),
    CONSTRAINT "infolab_descarte_item_item_chk" CHECK (
        (CASE WHEN "id_atendimento_amostra" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_aliquota" IS NOT NULL THEN 1 ELSE 0 END +
         CASE WHEN "id_soroteca_derivado" IS NOT NULL THEN 1 ELSE 0 END) = 1
    )
);

CREATE TABLE "infolab_qualidade_evento" (
    "id_qualidade_evento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_qualidade_evento_tipo" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "id_soroteca_aliquota" BIGINT,
    "id_soroteca_derivado" BIGINT,
    "id_soroteca_equipamento" BIGINT,
    "data_hora_evento" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_hora_resolucao" TIMESTAMP(6),
    "status_resolucao" VARCHAR(20) NOT NULL DEFAULT 'ABERTO',
    "descricao" TEXT NOT NULL,
    "acao_tomada" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_qualidade_evento_pkey" PRIMARY KEY ("id_qualidade_evento"),
    CONSTRAINT "infolab_qualidade_evento_status_chk" CHECK ("status_resolucao" IN ('ABERTO','EM_ANALISE','RESOLVIDO','ENCERRADO'))
);

CREATE TABLE "infolab_temperatura_log" (
    "id_temperatura_log" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_equipamento" BIGINT NOT NULL,
    "leitura_automatica" BOOLEAN NOT NULL DEFAULT false,
    "em_excursao" BOOLEAN NOT NULL DEFAULT false,
    "temperatura_c" DECIMAL(6,2) NOT NULL,
    "data_hora_leitura" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_temperatura_log_pkey" PRIMARY KEY ("id_temperatura_log")
);

CREATE TABLE "infolab_temperatura_quarentena" (
    "id_temperatura_quarentena" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_soroteca_equipamento" BIGINT NOT NULL,
    "id_temperatura_log" BIGINT NOT NULL,
    "data_hora_inicio" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "data_hora_fim" TIMESTAMP(6),
    "temperatura_registrada_c" DECIMAL(6,2) NOT NULL,
    "status" VARCHAR(20) NOT NULL DEFAULT 'ABERTA',
    "decisao" VARCHAR(20),
    "justificativa" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_temperatura_quarentena_pkey" PRIMARY KEY ("id_temperatura_quarentena"),
    CONSTRAINT "infolab_temperatura_quarentena_status_chk" CHECK ("status" IN ('ABERTA','EM_AVALIACAO','ENCERRADA')),
    CONSTRAINT "infolab_temperatura_quarentena_decisao_chk" CHECK ("decisao" IS NULL OR "decisao" IN ('MANTER','INVALIDAR','DESCARTAR','TRANSFERIR'))
);

CREATE TABLE "infolab_soroteca_auditoria" (
    "id_soroteca_auditoria" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "data_hora_evento" TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "operacao" CHAR(1) NOT NULL,
    "tabela" VARCHAR(80) NOT NULL,
    "registro_id" VARCHAR(40) NOT NULL,
    "hash_anterior" VARCHAR(64),
    "hash_atual" VARCHAR(64),
    "dados_antes" JSONB,
    "dados_depois" JSONB,
    "login_usuario" VARCHAR(80),
    "aplicacao" VARCHAR(80),
    "session_id" VARCHAR(120),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    CONSTRAINT "infolab_soroteca_auditoria_pkey" PRIMARY KEY ("id_soroteca_auditoria"),
    CONSTRAINT "infolab_soroteca_auditoria_operacao_chk" CHECK ("operacao" IN ('I','U','D'))
);

-- ========== FKs para infolab_tenacidade (lookup + transacional) ==========
ALTER TABLE "infolab_amostra_status" ADD CONSTRAINT "fk_amostra_status_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_material_tipo" ADD CONSTRAINT "fk_material_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_recipiente_tipo" ADD CONSTRAINT "fk_recipiente_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_equipamento_tipo" ADD CONSTRAINT "fk_equipamento_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_movimento_tipo" ADD CONSTRAINT "fk_movimento_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_bloqueio_tipo" ADD CONSTRAINT "fk_bloqueio_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_residuo_grupo" ADD CONSTRAINT "fk_residuo_grupo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_metodo" ADD CONSTRAINT "fk_descarte_metodo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_motivo" ADD CONSTRAINT "fk_descarte_motivo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_norma" ADD CONSTRAINT "fk_norma_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_finalidade" ADD CONSTRAINT "fk_finalidade_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_derivado_tipo" ADD CONSTRAINT "fk_derivado_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento_tipo" ADD CONSTRAINT "fk_qual_ev_tipo_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_sala" ADD CONSTRAINT "fk_soroteca_sala_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_equipamento" ADD CONSTRAINT "fk_soroteca_equip_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_rack" ADD CONSTRAINT "fk_soroteca_rack_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_caixa" ADD CONSTRAINT "fk_soroteca_caixa_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_posicao" ADD CONSTRAINT "fk_soroteca_posicao_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_retencao_regra" ADD CONSTRAINT "fk_retencao_regra_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_derivado" ADD CONSTRAINT "fk_derivado_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_armazenamento" ADD CONSTRAINT "fk_armazenamento_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_bloqueio" ADD CONSTRAINT "fk_bloqueio_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_movimento_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_lote" ADD CONSTRAINT "fk_descarte_lote_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_temperatura_log" ADD CONSTRAINT "fk_temp_log_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_temperatura_quarentena" ADD CONSTRAINT "fk_temp_quar_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_auditoria" ADD CONSTRAINT "fk_soroteca_auditoria_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ========== Demais FKs ==========
ALTER TABLE "infolab_soroteca_equipamento" ADD CONSTRAINT "fk_soroteca_equip_sala" FOREIGN KEY ("id_soroteca_sala") REFERENCES "infolab_soroteca_sala"("id_soroteca_sala") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_equipamento" ADD CONSTRAINT "fk_soroteca_equip_tipo_eq" FOREIGN KEY ("id_equipamento_tipo") REFERENCES "infolab_equipamento_tipo"("id_equipamento_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_rack" ADD CONSTRAINT "fk_soroteca_rack_equip" FOREIGN KEY ("id_soroteca_equipamento") REFERENCES "infolab_soroteca_equipamento"("id_soroteca_equipamento") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_caixa" ADD CONSTRAINT "fk_soroteca_caixa_rack" FOREIGN KEY ("id_soroteca_rack") REFERENCES "infolab_soroteca_rack"("id_soroteca_rack") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_caixa" ADD CONSTRAINT "fk_soroteca_caixa_local_arm" FOREIGN KEY ("id_local_armazenamento") REFERENCES "infolab_local_armazenamento"("id_local_armazenamento") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_posicao" ADD CONSTRAINT "fk_soroteca_posicao_caixa" FOREIGN KEY ("id_soroteca_caixa") REFERENCES "infolab_soroteca_caixa"("id_soroteca_caixa") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_retencao_regra" ADD CONSTRAINT "fk_retencao_regra_material" FOREIGN KEY ("id_material_tipo") REFERENCES "infolab_material_tipo"("id_material_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_retencao_regra" ADD CONSTRAINT "fk_retencao_regra_finalidade" FOREIGN KEY ("id_finalidade") REFERENCES "infolab_finalidade"("id_finalidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_retencao_regra" ADD CONSTRAINT "fk_retencao_regra_norma" FOREIGN KEY ("id_norma") REFERENCES "infolab_norma"("id_norma") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_atend_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_status" FOREIGN KEY ("id_amostra_status") REFERENCES "infolab_amostra_status"("id_amostra_status") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_material" FOREIGN KEY ("id_material_tipo") REFERENCES "infolab_material_tipo"("id_material_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_recipiente" FOREIGN KEY ("id_recipiente_tipo") REFERENCES "infolab_recipiente_tipo"("id_recipiente_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_finalidade" FOREIGN KEY ("id_finalidade") REFERENCES "infolab_finalidade"("id_finalidade") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_aliquota" ADD CONSTRAINT "fk_aliquota_retencao" FOREIGN KEY ("id_soroteca_retencao_regra") REFERENCES "infolab_soroteca_retencao_regra"("id_soroteca_retencao_regra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_derivado" ADD CONSTRAINT "fk_derivado_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_derivado" ADD CONSTRAINT "fk_derivado_tipo_ref" FOREIGN KEY ("id_derivado_tipo") REFERENCES "infolab_derivado_tipo"("id_derivado_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_derivado" ADD CONSTRAINT "fk_derivado_status" FOREIGN KEY ("id_amostra_status") REFERENCES "infolab_amostra_status"("id_amostra_status") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_derivado" ADD CONSTRAINT "fk_derivado_retencao" FOREIGN KEY ("id_soroteca_retencao_regra") REFERENCES "infolab_soroteca_retencao_regra"("id_soroteca_retencao_regra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_armazenamento" ADD CONSTRAINT "fk_armazenamento_posicao" FOREIGN KEY ("id_soroteca_posicao") REFERENCES "infolab_soroteca_posicao"("id_soroteca_posicao") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_armazenamento" ADD CONSTRAINT "fk_armazenamento_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_armazenamento" ADD CONSTRAINT "fk_armazenamento_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_armazenamento" ADD CONSTRAINT "fk_armazenamento_derivado" FOREIGN KEY ("id_soroteca_derivado") REFERENCES "infolab_soroteca_derivado"("id_soroteca_derivado") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_bloqueio" ADD CONSTRAINT "fk_bloqueio_tipo_ref" FOREIGN KEY ("id_bloqueio_tipo") REFERENCES "infolab_bloqueio_tipo"("id_bloqueio_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_bloqueio" ADD CONSTRAINT "fk_bloqueio_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_bloqueio" ADD CONSTRAINT "fk_bloqueio_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_bloqueio" ADD CONSTRAINT "fk_bloqueio_derivado" FOREIGN KEY ("id_soroteca_derivado") REFERENCES "infolab_soroteca_derivado"("id_soroteca_derivado") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_tipo" FOREIGN KEY ("id_movimento_tipo") REFERENCES "infolab_movimento_tipo"("id_movimento_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_derivado" FOREIGN KEY ("id_soroteca_derivado") REFERENCES "infolab_soroteca_derivado"("id_soroteca_derivado") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_pos_origem" FOREIGN KEY ("id_posicao_origem") REFERENCES "infolab_soroteca_posicao"("id_soroteca_posicao") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_soroteca_movimento" ADD CONSTRAINT "fk_sor_mov_pos_destino" FOREIGN KEY ("id_posicao_destino") REFERENCES "infolab_soroteca_posicao"("id_soroteca_posicao") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_lote" FOREIGN KEY ("id_descarte_lote") REFERENCES "infolab_descarte_lote"("id_descarte_lote") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_motivo" FOREIGN KEY ("id_descarte_motivo") REFERENCES "infolab_descarte_motivo"("id_descarte_motivo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_metodo" FOREIGN KEY ("id_descarte_metodo") REFERENCES "infolab_descarte_metodo"("id_descarte_metodo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_residuo" FOREIGN KEY ("id_residuo_grupo") REFERENCES "infolab_residuo_grupo"("id_residuo_grupo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_descarte_item" ADD CONSTRAINT "fk_descarte_item_derivado" FOREIGN KEY ("id_soroteca_derivado") REFERENCES "infolab_soroteca_derivado"("id_soroteca_derivado") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_tipo_ref" FOREIGN KEY ("id_qualidade_evento_tipo") REFERENCES "infolab_qualidade_evento_tipo"("id_qualidade_evento_tipo") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_aliquota" FOREIGN KEY ("id_soroteca_aliquota") REFERENCES "infolab_soroteca_aliquota"("id_soroteca_aliquota") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_derivado" FOREIGN KEY ("id_soroteca_derivado") REFERENCES "infolab_soroteca_derivado"("id_soroteca_derivado") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_qualidade_evento" ADD CONSTRAINT "fk_qual_ev_equipamento" FOREIGN KEY ("id_soroteca_equipamento") REFERENCES "infolab_soroteca_equipamento"("id_soroteca_equipamento") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_temperatura_log" ADD CONSTRAINT "fk_temp_log_equipamento" FOREIGN KEY ("id_soroteca_equipamento") REFERENCES "infolab_soroteca_equipamento"("id_soroteca_equipamento") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_temperatura_quarentena" ADD CONSTRAINT "fk_temp_quar_equipamento" FOREIGN KEY ("id_soroteca_equipamento") REFERENCES "infolab_soroteca_equipamento"("id_soroteca_equipamento") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "infolab_temperatura_quarentena" ADD CONSTRAINT "fk_temp_quar_log" FOREIGN KEY ("id_temperatura_log") REFERENCES "infolab_temperatura_log"("id_temperatura_log") ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE INDEX "idx_aliquota_atend_amostra" ON "infolab_soroteca_aliquota" ("id_atendimento_amostra");
CREATE INDEX "idx_armazenamento_ativo" ON "infolab_soroteca_armazenamento" ("ativo", "id_soroteca_posicao");
CREATE INDEX "idx_armazenamento_amostra" ON "infolab_soroteca_armazenamento" ("id_atendimento_amostra", "ativo");
CREATE INDEX "idx_movimento_amostra_dt" ON "infolab_soroteca_movimento" ("id_atendimento_amostra", "data_hora_movimento" DESC);
CREATE INDEX "idx_posicao_caixa" ON "infolab_soroteca_posicao" ("id_soroteca_caixa");
CREATE INDEX "idx_temp_log_equip_dt" ON "infolab_temperatura_log" ("id_soroteca_equipamento", "data_hora_leitura" DESC);
