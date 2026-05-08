-- CreateSchema
CREATE SCHEMA IF NOT EXISTS "public";

-- CreateTable
CREATE TABLE "infolab_tenacidade" (
    "id_tenacidade" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "razao_social" VARCHAR(255),
    "nome_fantasia" VARCHAR(255),
    "chave_acesso" VARCHAR(255),
    "data_expiracao" TIMESTAMP(6),
    "ultimo_ano" BIGINT,
    "ultimo_atendimento" BIGINT DEFAULT 0,
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "dominio_tenacidade" VARCHAR(255),
    "chave_jwt" VARCHAR(255),

    CONSTRAINT "infolab_tenacidade_pkey" PRIMARY KEY ("id_tenacidade")
);

-- CreateTable
CREATE TABLE "infolab_usuario" (
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
    "timeout_sessao_minutos" INTEGER,

    CONSTRAINT "infolab_usuario_pkey" PRIMARY KEY ("id_usuario")
);

-- CreateTable
CREATE TABLE "infolab_analisador" (
    "id_analisador" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(15),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_analisador_pkey" PRIMARY KEY ("id_analisador")
);

-- CreateTable
CREATE TABLE "infolab_analisador_exame_material" (
    "id_analisador_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_analisador" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_exame_analisador" VARCHAR(200),
    "resultado_associado" VARCHAR(2000),
    "verificar_metodo_validade" CHAR(1),
    "metodo_exame" VARCHAR(50),
    "data_validade" DATE,
    "nao_interfacear" CHAR(1),
    "lista_exame_equivalente" VARCHAR(2000),
    "diluicao" VARCHAR(10),
    "lista_item_amostra" VARCHAR(200),
    "exame_associado_atendimento_todo" CHAR(1),
    "amostra_separada" CHAR(1),
    "valido_importacao" CHAR(1),
    "quantidade_etiqueta" SMALLINT,
    "qtd_resultado_anterior_deltacheck" SMALLINT,
    "exportar_liberado" CHAR(1),
    "valida_amostra" CHAR(1),
    "validade_resultado_deltacheck" SMALLINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_analisador_exame_material_pkey" PRIMARY KEY ("id_analisador_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_analisador_exame_material_campo" (
    "id_analisador_exame_material_campo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_analisador" BIGINT,
    "id_analisador_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "variavel" VARCHAR(50),
    "parametro_analisador" VARCHAR(40),
    "nome" VARCHAR(100),
    "tipo" VARCHAR(1),
    "tamanho" SMALLINT,
    "qtd_casa_decimal" DECIMAL(15,2),
    "unidade" VARCHAR(25),
    "utiliza_formula" VARCHAR(1),
    "formula" VARCHAR(1500),
    "limite_superior" DECIMAL(15,2),
    "limite_inferior" DECIMAL(15,2),
    "valor_padrao" VARCHAR(170),
    "lista_substituicao" VARCHAR(400),
    "lista_valores_absurdos" VARCHAR(512),
    "valor_absurdo_superior" INTEGER,
    "valor_absurdo_inferior" INTEGER,
    "tem_parametro_associado" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_analisador_exame_material_campo_pkey" PRIMARY KEY ("id_analisador_exame_material_campo")
);

-- CreateTable
CREATE TABLE "infolab_analisador_exame_material_campo_limite" (
    "id_analisador_exame_material_campo_limite" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_analisador" BIGINT,
    "id_analisador_exame_material" BIGINT,
    "id_exame_material" BIGINT,
    "id_analisador_exame_material_campo" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "sexo" CHAR(1),
    "porcentagem_tolerancia" DOUBLE PRECISION,
    "ano_minimo" INTEGER,
    "ano_maximo" INTEGER,
    "mes_minimo" INTEGER,
    "mes_maximo" INTEGER,
    "dia_minimo" INTEGER,
    "dia_maximo" INTEGER,
    "valor_minimo" DECIMAL(15,4),
    "valor_maximo" DECIMAL(15,4),
    "versao_apoio" VARCHAR(20),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_analisador_exame_material_campo_limite_pkey" PRIMARY KEY ("id_analisador_exame_material_campo_limite")
);

-- CreateTable
CREATE TABLE "infolab_aplicacao" (
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

    CONSTRAINT "infolab_aplicacao_pkey" PRIMARY KEY ("id_aplicacao")
);

-- CreateTable
CREATE TABLE "infolab_aplicacao_campo" (
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

    CONSTRAINT "infolab_aplicacao_campo_pkey" PRIMARY KEY ("id_aplicacao_campo")
);

-- CreateTable
CREATE TABLE "infolab_aplicacao_campo_tenacidade" (
    "id_aplicacao_campo_tenacidade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_aplicacao" BIGINT NOT NULL,
    "id_aplicacao_campo" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "obrigatorio" BOOLEAN,
    "visivel_formulario" BOOLEAN,
    "editavel_formulario" BOOLEAN,
    "exibir_listagem" BOOLEAN,
    "permite_filtro" BOOLEAN,
    "permite_ordenacao" BOOLEAN,
    "fixo_listagem" BOOLEAN,
    "ordem_formulario" INTEGER,
    "ordem_listagem" INTEGER,
    "largura_listagem" INTEGER,
    "alinhamento_listagem" VARCHAR(10),
    "participa_subtitulo_formulario" BOOLEAN,
    "ordem_subtitulo_formulario" INTEGER,
    "valor_padrao" TEXT,
    "validacao_json" JSONB,
    "opcoes_json" JSONB,
    "ativo" BOOLEAN NOT NULL DEFAULT true,
    "nome_aplicacao_auditoria" VARCHAR(120),
    "endereco_ip_auditoria" VARCHAR(45),

    CONSTRAINT "infolab_aplicacao_campo_tenacidade_pkey" PRIMARY KEY ("id_aplicacao_campo_tenacidade")
);

-- CreateTable
CREATE TABLE "infolab_atendimento" (
    "id_atendimento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_unidade" BIGINT,
    "id_atendimento_replicado" BIGINT,
    "id_procedencia" BIGINT,
    "id_orcamento" BIGINT,
    "id_cliente" BIGINT,
    "id_cid" BIGINT,
    "id_usuario_inclusao" BIGINT,
    "id_integracao_sistema" BIGINT,
    "id_importacao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "numero_atendimento" BIGINT,
    "atendimento_sigiloso" CHAR(1),
    "atendimento_preferencial" CHAR(1),
    "gestante" CHAR(1),
    "pendencia_guia" CHAR(1),
    "data_hora_inclusao_inicio" TIMESTAMP(6),
    "data_hora_inclusao_fim" TIMESTAMP(6),
    "data_hora_replicacao" TIMESTAMP(6),
    "nome_cliente" VARCHAR(255),
    "nome_social" VARCHAR(255),
    "identificacao_externa" VARCHAR(50),
    "codigo_externo" VARCHAR(30),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_pkey" PRIMARY KEY ("id_atendimento")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra" (
    "id_atendimento_amostra" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_amostra_situacao" BIGINT,
    "id_usuario_conferencia" BIGINT,
    "id_usuario_expedicao" BIGINT,
    "id_usuario_recebimento" BIGINT,
    "id_usuario_armazenamento" BIGINT,
    "id_usuario_emprestimo" BIGINT,
    "id_usuario_rejeicao" BIGINT,
    "id_usuario_descarte" BIGINT,
    "id_local_armazenamento" BIGINT,
    "id_expedicao" BIGINT,
    "id_soroteca_grade" BIGINT,
    "id_amostra_motivo_rejeicao" BIGINT,
    "id_amostra_motivo_prorrogacao" BIGINT,
    "id_amostra_observacoes_coleta" BIGINT,
    "id_amostra_observacoes_devolucao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_amostra" BIGINT,
    "data_hora_conferencia" TIMESTAMP(6),
    "data_hora_expedicao" TIMESTAMP(6),
    "data_hora_recebimento" TIMESTAMP(6),
    "data_hora_armazenamento" TIMESTAMP(6),
    "data_hora_emprestimo" TIMESTAMP(6),
    "data_hora_coleta" TIMESTAMP(6),
    "data_hora_rejeicao" TIMESTAMP(6),
    "data_hora_descarte" TIMESTAMP(6),
    "data_hora_devolucao" TIMESTAMP(6),
    "data_validade" DATE,
    "codigo_poco" VARCHAR(5),
    "codigo_externo" VARCHAR(30),
    "etiqueta_apoio" VARCHAR(800) DEFAULT '',
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_amostra_pkey" PRIMARY KEY ("id_atendimento_amostra")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra_impressao" (
    "id_amostra_impressao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_amostra" BIGINT,
    "data_impressao" TIMESTAMP(6),
    "id_usuario_impressao" BIGINT,
    "observacao" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "endereco_ip_auditoria" VARCHAR(20),
    "id_usuario_auditoria" BIGINT,

    CONSTRAINT "infolab_amostra_impressao_pkey" PRIMARY KEY ("id_amostra_impressao")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra_motivo_prorrogacao" (
    "id_amostra_motivo_prorrogacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_amostra_motivo_prorrogacao_pkey" PRIMARY KEY ("id_amostra_motivo_prorrogacao")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra_motivo_rejeicao" (
    "id_amostra_motivo_rejeicao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_amostra_motivo_rejeicao_pkey" PRIMARY KEY ("id_amostra_motivo_rejeicao")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra_observacoes_coleta" (
    "id_amostra_observacoes_coleta" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_amostra_observacoes_coleta_pkey" PRIMARY KEY ("id_amostra_observacoes_coleta")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_amostra_observacoes_devolucao" (
    "id_amostra_observacoes_devolucao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_amostra_observacoes_devolucao_pkey" PRIMARY KEY ("id_amostra_observacoes_devolucao")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_convenio" (
    "id_atendimento_convenio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_convenio" BIGINT,
    "id_cliente_titular" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome_titular" VARCHAR(255),
    "matricula_cartao" VARCHAR(30),
    "data_pedido" TIMESTAMP(6),
    "data_validade_carteira" TIMESTAMP(6),
    "codigo_autorizacao" VARCHAR(30),
    "guia_operadora" VARCHAR(30),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_convenio_pkey" PRIMARY KEY ("id_atendimento_convenio")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_exame_material" (
    "id_atendimento_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_exame_material" BIGINT,
    "id_convenio" BIGINT,
    "id_laboratorio" BIGINT,
    "id_amostra" BIGINT,
    "id_usuario_coleta" BIGINT,
    "id_usuario_coletando" BIGINT,
    "id_usuario_digitacao" BIGINT,
    "id_usuario_quarentena" BIGINT,
    "id_motivo_quarentena" BIGINT,
    "id_usuario_liberacao" BIGINT,
    "id_usuario_impressao" BIGINT,
    "id_usuario_entrega" BIGINT,
    "id_usuario_retirada" BIGINT,
    "id_usuario_cancelamento" BIGINT,
    "id_motivo_cancelamento" BIGINT,
    "id_usuario_autorizacao" BIGINT,
    "id_usuario_retificacao" BIGINT,
    "id_motivo_retificacao" BIGINT,
    "id_motivo_anuencia" BIGINT,
    "id_situacao_coleta" BIGINT,
    "id_pendencia_resultado" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "data_hora_inclusao" TIMESTAMP(6),
    "data_hora_coleta" TIMESTAMP(6),
    "data_hora_coletando" TIMESTAMP(6),
    "data_hora_digitacao" TIMESTAMP(6),
    "data_hora_quarentena" TIMESTAMP(6),
    "data_hora_liberacao" TIMESTAMP(6),
    "data_hora_impressao" TIMESTAMP(6),
    "data_hora_entrega" TIMESTAMP(6),
    "data_hora_retirada" TIMESTAMP(6),
    "data_hora_cancelamento" TIMESTAMP(6),
    "data_hora_autorizacao" TIMESTAMP(6),
    "data_hora_retificacao" TIMESTAMP(6),
    "data_hora_faturamento" TIMESTAMP(6),
    "prioridade" CHAR(1),
    "lista_medicos" VARCHAR(255),
    "qtd_exame_material" SMALLINT,
    "valor_exame_material" DECIMAL(10,2),
    "codigo_faturamento" VARCHAR(20),
    "valor_exame_material_coeficiente" DECIMAL(10,2),
    "nome_receptor_resultado" VARCHAR(255),
    "observacoes_gerais" VARCHAR(255),
    "num_guia" VARCHAR(30),
    "possui_anuencia" CHAR(1),
    "liberacao_delta_check" CHAR(1),
    "retificado" CHAR(1),
    "valor_file" VARCHAR(255),
    "valor_image" VARCHAR(255),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_exame_material_pkey" PRIMARY KEY ("id_atendimento_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_exame_material_autorizacao" (
    "id_atendimento_exame_material_autorizacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(15),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "id_atendimento_exame_material" BIGINT,
    "id_exame_material_equivalente" BIGINT,
    "id_usuario_autorizacao" BIGINT,
    "id_unidade" BIGINT,
    "codigo_faturamento" VARCHAR(20),
    "numero_guia" BIGINT,
    "codigo_solicitacao" VARCHAR(30),
    "mensagem_autorizacao" VARCHAR(200),
    "senha" VARCHAR(64),
    "data_hora_autorizacao" TIMESTAMP(6),
    "data_hora_cancelamento" TIMESTAMP(6),
    "id_usuario_cancelamento" BIGINT,
    "mensagem_cancelamento" VARCHAR(200),

    CONSTRAINT "infolab_atendimento_exame_material_autorizacao_pkey" PRIMARY KEY ("id_atendimento_exame_material_autorizacao")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_exame_material_medico" (
    "id_atendimento_exame_material_medico" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_exame_material" BIGINT,
    "id_atendimento_medico" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_exame_material_medico_pkey" PRIMARY KEY ("id_atendimento_exame_material_medico")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_exame_material_resultado_campo" (
    "id_atendimento_exame_material_resultado_campo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_exame_material" BIGINT,
    "id_exame_material_campo" BIGINT,
    "id_analisador" BIGINT,
    "id_usuario_digitacao" BIGINT,
    "id_usuario_liberacao" BIGINT,
    "id_usuario_impressao" BIGINT,
    "id_usuario_entrega" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(50),
    "titulo" VARCHAR(50),
    "tipo" TEXT,
    "tamanho" SMALLINT,
    "decimais" SMALLINT,
    "unidade" VARCHAR(50),
    "obrigatorio" CHAR(1),
    "mascara" VARCHAR(50),
    "referencia" VARCHAR(50),
    "ordem_exibicao" SMALLINT,
    "valor_anormal_minimo" DECIMAL(10,2),
    "valor_anormal_maximo" DECIMAL(10,2),
    "valor_limite_minimo" DECIMAL(10,2),
    "valor_limite_maximo" DECIMAL(10,2),
    "valor_critico_minimo" DECIMAL(10,2),
    "valor_critico_maximo" DECIMAL(10,2),
    "js_consistencia" TEXT,
    "ajuda" VARCHAR(255),
    "valor_int" INTEGER,
    "valor_float" DECIMAL(12,4),
    "valor_string" VARCHAR(255),
    "valor_date_time" TIMESTAMP(6),
    "valor_boolean" CHAR(1),
    "valor_text" TEXT,
    "valor_calc" VARCHAR(50) DEFAULT '',
    "versao_atual" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_exame_material_resultado_campo_pkey" PRIMARY KEY ("id_atendimento_exame_material_resultado_campo")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_medico" (
    "id_atendimento_medico" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_medico" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_medico_pkey" PRIMARY KEY ("id_atendimento_medico")
);

-- CreateTable
CREATE TABLE "infolab_atendimento_pagamento" (
    "id_atendimento_pagamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_convenio" BIGINT,
    "id_motivo_desconto" BIGINT,
    "id_tipo_pagamento" BIGINT,
    "id_nota_servico" BIGINT,
    "id_usuario_pagamento" BIGINT,
    "id_usuario_desconto" BIGINT,
    "id_unidade_pagamento" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "data_pagamento" TIMESTAMP(6),
    "valor_exame_material" DECIMAL(10,2),
    "valor_acrescimo" DECIMAL(10,2),
    "valor_desconto" DECIMAL(10,2),
    "valor_pago" DECIMAL(10,2),
    "percentual_pagamento" VARCHAR(3),
    "total_parcelas" SMALLINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_atendimento_pagamento_pkey" PRIMARY KEY ("id_atendimento_pagamento")
);

-- CreateTable
CREATE TABLE "infolab_cbo" (
    "id_cbo" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(255),
    "codigo_externo" VARCHAR(30),
    "codigo_cbo" INTEGER,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_cbo_pkey" PRIMARY KEY ("id_cbo")
);

-- CreateTable
CREATE TABLE "infolab_cid" (
    "id_cid" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "codigo_cid" VARCHAR(8),
    "descricao" VARCHAR(200),
    "descricao_cap" VARCHAR(200),
    "descricao_categoria" VARCHAR(200),
    "observacao" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_cid_pkey" PRIMARY KEY ("id_cid")
);

-- CreateTable
CREATE TABLE "infolab_cliente" (
    "id_cliente" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_cliente_mae" BIGINT,
    "id_cliente_pai" BIGINT,
    "id_cliente_acompanhante" BIGINT,
    "id_cbo" BIGINT,
    "id_raca" BIGINT,
    "id_etnia" BIGINT,
    "id_vet_raca" BIGINT,
    "id_vet_especie" BIGINT,
    "id_necessidade_especial" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "nome_social" VARCHAR(100),
    "sexo" CHAR(1),
    "estado_civil" VARCHAR(1),
    "data_nascimento" DATE,
    "peso" BIGINT,
    "altura" BIGINT,
    "cpf" VARCHAR(11),
    "documento" VARCHAR(30),
    "codigo_passaporte" VARCHAR(8),
    "diabetico" CHAR(1),
    "bloqueado" CHAR(1),
    "receber_mensagem" CHAR(1),
    "falecido" CHAR(1),
    "cep" VARCHAR(10),
    "logradouro" VARCHAR(100),
    "numero" VARCHAR(10),
    "complemento" VARCHAR(50),
    "bairro" VARCHAR(100),
    "cidade" VARCHAR(100),
    "estado" CHAR(2),
    "endereco_referencia" VARCHAR(100),
    "telefone" VARCHAR(30),
    "celular" VARCHAR(30),
    "email" VARCHAR(255),
    "data_inclusao" TIMESTAMP(6),
    "data_admissao" TIMESTAMP(6),
    "senha_internet" VARCHAR(100),
    "observacao_resultado" TEXT,
    "prontuario" VARCHAR(50),
    "codigo_externo" VARCHAR(50),
    "codigo_migracao" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_cliente_pkey" PRIMARY KEY ("id_cliente")
);

-- CreateTable
CREATE TABLE "infolab_cliente_indicacao" (
    "id_cliente_indicacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_cliente_indicacao_pkey" PRIMARY KEY ("id_cliente_indicacao")
);

-- CreateTable
CREATE TABLE "infolab_computador" (
    "id_computador" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(50),
    "descricao" VARCHAR(100),
    "tipo_computador" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(20),

    CONSTRAINT "infolab_computador_pkey" PRIMARY KEY ("id_computador")
);

-- CreateTable
CREATE TABLE "infolab_conselho_regional" (
    "id_conselho_regional" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "sigla" VARCHAR(20),
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_conselho_regional_pkey" PRIMARY KEY ("id_conselho_regional")
);

-- CreateTable
CREATE TABLE "infolab_convenio" (
    "id_convenio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "id_preco_tabela" BIGINT,
    "id_preco_fator" BIGINT,
    "id_relatorio_guia" BIGINT,
    "razao_social" VARCHAR(200),
    "nome_fantasia" VARCHAR(100),
    "sigla" VARCHAR(10),
    "cep" VARCHAR(10),
    "tipo_logradouro" VARCHAR(50),
    "logradouro" VARCHAR(100),
    "bairro" VARCHAR(100),
    "cidade" VARCHAR(100),
    "estado" CHAR(2),
    "telefone" VARCHAR(50),
    "celular" VARCHAR(50),
    "cnpj" VARCHAR(50),
    "inscricao_municipal" VARCHAR(20),
    "inscricao_estadual" CHAR(17),
    "logotipo" BYTEA,
    "senha_internet" VARCHAR(64),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(30),
    "codigo_migracao" VARCHAR(10),
    "codigo_credenciamento" VARCHAR(30),
    "registro_ans" VARCHAR(10),
    "forma_cobranca" CHAR(1),
    "dia_conferencia" SMALLINT,
    "dia_envio_fatura" SMALLINT,
    "nome_arquivo_fatura" VARCHAR(50),
    "totalizar_valor_em" CHAR(1),
    "permitir_item_sem_valor" CHAR(1),
    "documento_imprimir_atendimento" CHAR(1),
    "numero_guia_obrigatorio" CHAR(1),
    "quantidade_exame_guia" SMALLINT,
    "numeracao_guia_automatica" CHAR(1),
    "mascara_numero_guia" VARCHAR(30),
    "numero_autorizacao_obrigatorio" CHAR(1),
    "mascara_numero_autorizacao" VARCHAR(30),
    "sexo_cliente_obrigatorio" CHAR(1),
    "data_nascimento_cliente_obrigatoria" CHAR(1),
    "numero_matricula_cliente_obrigatorio" CHAR(1),
    "raca_cliente_obrigatoria" CHAR(1),
    "nome_mae_cliente_obrigatorio" CHAR(1),
    "tipo_documento_cliente" CHAR(1),
    "medico_atendimento_obrigatorio" CHAR(1),
    "crm_medico_obrigatorio" CHAR(1),
    "data_pedido_medico_obrigatoria" CHAR(1),
    "cid_obrigatorio" CHAR(1),
    "cpf_medico_obrigatorio" CHAR(1),
    "conselho_medico_obrigatorio" CHAR(1),
    "uf_medico_obrigatoria" CHAR(1),
    "especialidade_medico_obrigatoria" CHAR(1),
    "registro_unimed_medico_obrigatorio" CHAR(1),
    "lista_exame_inativo" VARCHAR(300),
    "nome_documento_1" VARCHAR(30),
    "nome_documento_2" VARCHAR(30),
    "nome_documento_3" VARCHAR(30),
    "nome_documento_4" VARCHAR(30),
    "documento_obrigatorio_1" CHAR(1),
    "documento_obrigatorio_2" CHAR(1),
    "documento_obrigatorio_3" CHAR(1),
    "documento_obrigatorio_4" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_pkey" PRIMARY KEY ("id_convenio")
);

-- CreateTable
CREATE TABLE "infolab_convenio_autorizador" (
    "id_convenio_autorizador" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_autorizador_tabela_mensagem" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "sigla" VARCHAR(30),
    "codigo_credenciamento" VARCHAR(50),
    "situacao" CHAR(1),
    "diretorio_envio" VARCHAR(255),
    "diretorio_recebimento" VARCHAR(255),
    "qtd_maxima_item" INTEGER,
    "ultimo_numero" INTEGER,
    "numero_maximo" INTEGER,
    "cnpj" CHAR(17),
    "inscricao_estadual" VARCHAR(50),
    "cep" CHAR(10),
    "logradouro" VARCHAR(100),
    "tipo_logradouro" VARCHAR(50),
    "bairro" VARCHAR(100),
    "cidade" VARCHAR(100),
    "estado" CHAR(2),
    "telefone" VARCHAR(30),
    "contato" TEXT,
    "nummed" INTEGER,
    "servidor" VARCHAR(100),
    "url" VARCHAR(100),
    "login" VARCHAR(40),
    "senha" VARCHAR(64),
    "classe" INTEGER,
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_autorizador_pkey" PRIMARY KEY ("id_convenio_autorizador")
);

-- CreateTable
CREATE TABLE "infolab_convenio_contato" (
    "id_convenio_contato" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(255),
    "cargo" VARCHAR(255),
    "telefone" VARCHAR(50),
    "ramal" VARCHAR(50),
    "celular" VARCHAR(50),
    "whatsapp" VARCHAR(50),
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_contato_pkey" PRIMARY KEY ("id_convenio_contato")
);

-- CreateTable
CREATE TABLE "infolab_convenio_email" (
    "id_convenio_email" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "email" VARCHAR(255),
    "tipo" VARCHAR(255),
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_email_pkey" PRIMARY KEY ("id_convenio_email")
);

-- CreateTable
CREATE TABLE "infolab_convenio_equivalencia" (
    "id_convenio_equivalencia" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "id_convenio" BIGINT,
    "id_exame_material" BIGINT,
    "id_exame_material_equivalente" BIGINT,
    "qtd_exame_material" INTEGER,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_equivalencia_pkey" PRIMARY KEY ("id_convenio_equivalencia")
);

-- CreateTable
CREATE TABLE "infolab_convenio_plano" (
    "id_convenio_plano" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_convenio" BIGINT,
    "id_tabela_preco" BIGINT,
    "id_coeficiente_honorario" BIGINT,
    "id_modelo_impressao" BIGINT,
    "id_autorizador_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(255),
    "dia_inicio_conferencia" SMALLINT,
    "dia_envio_fatura" SMALLINT,
    "forma_cobranca" VARCHAR(1),
    "exibir_instrucao_atendimento" CHAR(1) DEFAULT '',
    "instrucao_atendimento" TEXT,
    "instrucao_faturamento" TEXT,
    "autorizacao_obrigatoria" CHAR(1),
    "matricula_obrigatorio" CHAR(1),
    "data_pedido_obrigatorio" CHAR(1),
    "sexo_cliente_obrigatorio" CHAR(1),
    "documento_cliente_obrigatorio" CHAR(1),
    "medico_obrigatorio" CHAR(1),
    "crm_obrigatorio" CHAR(1),
    "cid_obrigatorio" CHAR(1),
    "guia_obrigatorio" CHAR(1),
    "guia_mascara" VARCHAR(30),
    "guia_quantidade_exames" INTEGER,
    "guia_relatorio" VARCHAR(50),
    "mascara_matricula" VARCHAR(30),
    "mascara_autorizacao" VARCHAR(30),
    "documento1_nome" VARCHAR(30),
    "documento1_mascara" VARCHAR(30),
    "documento1_obrigatorio" CHAR(1),
    "documento2_nome" VARCHAR(30),
    "documento2_mascara" VARCHAR(30),
    "documento2_obrigatorio" CHAR(1),
    "documento3_nome" VARCHAR(30),
    "documento3_mascara" VARCHAR(30),
    "documento3_obrigatorio" CHAR(1),
    "documento4_nome" VARCHAR(30),
    "documento4_mascara" VARCHAR(30),
    "documento4_obrigatorio" CHAR(1),
    "lista_exames_inativos" TEXT,
    "codigo_credenciamento" VARCHAR(30),
    "planilha_nome_arquivo" VARCHAR(50),
    "planilha_campo_faltante" VARCHAR(2),
    "nome_arquivo_fatura" VARCHAR(50),
    "imprimir_atendimento" VARCHAR(1),
    "tipo_totalizar_valores" CHAR(1),
    "lista_relatorio_fatura" TEXT,
    "valor_teto_fatura" DECIMAL(15,2),
    "valor_piso_fatura" DECIMAL(15,2),
    "valor_saldo_fatura" DECIMAL(15,2),
    "qtd_copias_ficha_financeira" INTEGER,
    "qtd_copias_resultado" INTEGER,
    "permitir_item_sem_valor" CHAR(1),
    "numerar_guia_automatico" CHAR(1),
    "validar_matricula" CHAR(1),
    "tipo_validacao_matricula" INTEGER,
    "identificador_autorizador_convenio" VARCHAR(5),
    "registro_ans" VARCHAR(10),
    "incluir_somente_item_tabela_preco" CHAR(1),
    "exigir_data_nascimento_cliente" CHAR(1),
    "desconto_maximo_atendimento" DECIMAL(15,2),
    "regra_ao_exceder_teto" CHAR(1),
    "porcentagem_notificar_limite_teto" DECIMAL(15,2),
    "exigir_nome_conselho_medico" CHAR(1),
    "exigir_uf_conselho_medico" CHAR(1),
    "exigir_especialidade_medica" CHAR(1),
    "exigir_registro_unimed_medico" CHAR(1),
    "exibir_preco_item_atendimento" CHAR(1),
    "imprimir_declaracao_autorizacao" CHAR(1),
    "data_inicio_cota" DATE,
    "data_fim_cota" DATE,
    "enviar_mensagem" CHAR(1),
    "instrucao_impressao_resultado" VARCHAR(4096),
    "cobrar_equivalencia_duplicada" CHAR(1),
    "exigir_cpf_medico" CHAR(1),
    "cor_cliente_obrigatorio" CHAR(1),
    "alterar_data_fatura" CHAR(1),
    "nome_mae_obrigatorio" CHAR(1),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(30),
    "codigo_migracao" VARCHAR(10),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_convenio_plano_pkey" PRIMARY KEY ("id_convenio_plano")
);

-- CreateTable
CREATE TABLE "infolab_convenio_tiss" (
    "id_convenio_tiss" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_convenio" BIGINT,
    "id_cid" BIGINT,
    "id_medico" BIGINT,
    "id_cbo_padrao" BIGINT,
    "id_versao_tiss" INTEGER,
    "id_usuario_auditoria" BIGINT,
    "codigo_tabela" CHAR(2),
    "nome_plano_padrao" VARCHAR(40),
    "numero_lote" INTEGER,
    "sequencial_transacao" INTEGER,
    "compactar_arquivo" CHAR(1),
    "mascara_arquivo_fatura" VARCHAR(100),
    "incrementar_numero_lote" CHAR(1),
    "incrementar_sequencial_transacao" CHAR(1),
    "codigo_credenciamento_fatura" VARCHAR(30),
    "codigo_credenciamento_guia" VARCHAR(30),
    "mascara_observacao_fatura" VARCHAR(200),
    "tipo_envio_guia_operadora" SMALLINT,
    "tipo_envio_guia_prestador" SMALLINT,
    "item_sem_onus_guia_tiss" CHAR(1),
    "perfil_solicitante" CHAR(2),
    "tipo_saida_atendimento" SMALLINT,
    "enviar_senha_autorizacao" CHAR(1),
    "tipo_identificacao_solicitante" CHAR(1),
    "tipo_identificacao_executante" CHAR(1),
    "codigo_credenciamento_executante" VARCHAR(30),
    "executante_complementar" CHAR(1),
    "via_acesso" CHAR(2),
    "tecnica_utilizada" CHAR(2),
    "incluir_reducao_acrescimo" CHAR(1),
    "incluir_quantidade_realizada" CHAR(1),
    "tipo_atendimento" SMALLINT,
    "agrupar_codigo_faturamento" CHAR(1),
    "indicacao_acidente" SMALLINT,
    "outras_despesas" CHAR(2),
    "saude_ocupacional" CHAR(2),
    "utilizar_como_data_lancamento" CHAR(1),
    "utilizar_como_data_autorizacao" CHAR(1),
    "paginar_guia_medico_solicitante" CHAR(1),
    "grau_participacao" VARCHAR(6),
    "agrupar_codigo_faturamento_xml" CHAR(1),
    "exibir_valor_guia" CHAR(1),
    "exibir_data_solicitacao" CHAR(1),
    "dividir_arquivo_100_guias" CHAR(1),
    "cnes_executante" VARCHAR(7),
    "razao_social_executante" VARCHAR(100),
    "valor_reducao_acrescimo" VARCHAR(6),
    "validade_autorizacao" CHAR(1),
    "utilizar_como_data_solicitacao" CHAR(1),
    "utilizar_como_data_execucao" CHAR(1),
    "considerar_executante" CHAR(1),
    "equipe_sadt" CHAR(1),
    "ordenar_por" SMALLINT,
    "cabecalho_guia_principal" SMALLINT,
    "tipo_identificacao_cabecalho" SMALLINT,
    "utilizar_como_data_procedimento" SMALLINT,
    "tipo_consulta" CHAR(1),
    "enviar_dados_executante" CHAR(1),
    "codificacao_hash" SMALLINT,
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(20),

    CONSTRAINT "infolab_convenio_tiss_pkey" PRIMARY KEY ("id_convenio_tiss")
);

-- CreateTable
CREATE TABLE "infolab_especialidade_medica" (
    "id_especialidade_medica" BIGSERIAL NOT NULL,
    "id_cbo" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "codigo_ipsemg" VARCHAR(2),
    "codigo_externo" VARCHAR(30),
    "codigo_migracao" VARCHAR(6),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_especialidade_medica_pkey" PRIMARY KEY ("id_especialidade_medica")
);

-- CreateTable
CREATE TABLE "infolab_etiqueta_perfil_impressao" (
    "id_etiqueta_perfil_impressao" SERIAL NOT NULL,
    "nome_perfil" VARCHAR(255) NOT NULL,
    "tamanho_pagina" VARCHAR(30) NOT NULL,
    "num_linhas" BIGINT NOT NULL,
    "num_colunas" BIGINT NOT NULL,
    "espacamento_linha" DECIMAL(10,0) NOT NULL,
    "espacamento_coluna" DECIMAL(10,0) NOT NULL,
    "margem_esquerda" DECIMAL(10,0) NOT NULL,
    "margem_superior" DECIMAL(10,0) NOT NULL,
    "unidade_espacamento" VARCHAR(30) NOT NULL,
    "unidade_regua" VARCHAR(30) NOT NULL,
    "tamanho_custom" VARCHAR(40) NOT NULL,
    "id_usuario_auditoria" BIGINT NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20) NOT NULL,
    "nome_aplicacao_auditoria" VARCHAR(255) NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,

    CONSTRAINT "infolab_etiqueta_perfil_impressao_pkey" PRIMARY KEY ("id_etiqueta_perfil_impressao")
);

-- CreateTable
CREATE TABLE "infolab_etnia" (
    "id_etnia" BIGSERIAL NOT NULL,
    "id_raca" BIGINT,
    "nome" VARCHAR(100),

    CONSTRAINT "infolab_etnia_pkey" PRIMARY KEY ("id_etnia")
);

-- CreateTable
CREATE TABLE "infolab_exame" (
    "id_exame" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "sinonimos" VARCHAR(1024) DEFAULT '',
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_pkey" PRIMARY KEY ("id_exame")
);

-- CreateTable
CREATE TABLE "infolab_exame_analisador" (
    "id_exame_analisador" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_analisador" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_exame_analisador" VARCHAR(200),
    "resultado_associado" VARCHAR(2000),
    "verificar_metodo_validade" CHAR(1),
    "metodo_exame" VARCHAR(50),
    "data_validade" DATE,
    "nao_interfacear" CHAR(1),
    "lista_exame_equivalente" VARCHAR(2000),
    "diluicao" VARCHAR(10),
    "lista_item_amostra" VARCHAR(200),
    "exame_associado_atendimento_todo" CHAR(1),
    "amostra_separada" CHAR(1),
    "valido_importacao" CHAR(1),
    "quantidade_etiqueta" SMALLINT,
    "qtd_resultado_anterior_deltacheck" SMALLINT,
    "exportar_liberado" CHAR(1),
    "valida_amostra" CHAR(1),
    "validade_resultado_deltacheck" SMALLINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_analisador_pkey" PRIMARY KEY ("id_exame_analisador")
);

-- CreateTable
CREATE TABLE "infolab_exame_material" (
    "id_exame_material" BIGSERIAL NOT NULL,
    "id_exame" BIGINT,
    "id_tenacidade" BIGINT NOT NULL,
    "id_material" BIGINT,
    "id_recipiente" BIGINT,
    "id_setor" BIGINT,
    "id_pendencia_exame_de" BIGINT,
    "id_pendencia_exame_para" BIGINT,
    "id_resultado_observacao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo" VARCHAR(10),
    "publicar" CHAR(1),
    "sexo_realiza" CHAR(1),
    "local_realizacao" CHAR(1),
    "utiliza_componente" CHAR(1),
    "qtd_dias_soroteca" SMALLINT,
    "lista_resultados_associados" VARCHAR(255),
    "versao_ativa" CHAR(1),
    "versao_exame_material" SMALLINT,
    "nome_tecnico" VARCHAR(150),
    "nome_impressao" VARCHAR(150),
    "metodo" VARCHAR(150),
    "incremento_prazo_entrega" SMALLINT,
    "rotina_dias_normal" SMALLINT,
    "rotina_hora_normal" TIME(6),
    "rotina_hora_atipico" TIME(6),
    "urgente_dias_normal" SMALLINT,
    "urgente_hora_normal" TIME(6),
    "urgente_hora_atipico" TIME(6),
    "produzir_segunda" CHAR(1),
    "produzir_terca" CHAR(1),
    "produzir_quarta" CHAR(1),
    "produzir_quinta" CHAR(1),
    "produzir_sexta" CHAR(1),
    "produzir_sabado" CHAR(1),
    "produzir_domingo" CHAR(1),
    "produzir_feriado" CHAR(1),
    "qtd_etiqueta" SMALLINT,
    "exibir_condicoes_inicias" CHAR(1),
    "condicoes_inicias" TEXT,
    "imprimir_pagina_separada" CHAR(1),
    "exibir_alerta_observacao_material" CHAR(1),
    "qtd_dias_solicitar" SMALLINT,
    "verificar_equivalencia_apoio" CHAR(1),
    "controle_faixa_etaria" CHAR(1),
    "controle_dia_minimo" SMALLINT,
    "controle_mes_minimo" SMALLINT,
    "controle_ano_minimo" SMALLINT,
    "controle_dia_maximo" SMALLINT,
    "controle_mes_maximo" SMALLINT,
    "controle_ano_maximo" SMALLINT,
    "observacoes_gerais" TEXT,
    "lista_unidades" VARCHAR(300),
    "lista_usuarios_permissao_exame" VARCHAR(300),
    "pendencia_informar_resultado" CHAR(1),
    "qtd_exame_material_atendimento" SMALLINT,
    "qtd_maxima_exame_material_atendimento" SMALLINT,
    "volume_exame_material" DECIMAL(10,2),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_pkey" PRIMARY KEY ("id_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_campo" (
    "id_exame_material_campo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_unidade" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "loinc" VARCHAR(15),
    "titulo" VARCHAR(50),
    "variavel" VARCHAR(50),
    "caracteristica" CHAR(1),
    "formula" VARCHAR(200),
    "obrigatorio" CHAR(1),
    "ordem_exibicao" SMALLINT,
    "tipo" TEXT,
    "tamanho" SMALLINT,
    "decimais" SMALLINT,
    "unidade" VARCHAR(25),
    "mascara" VARCHAR(20),
    "valor_padrao" VARCHAR(100),
    "lista_valor_resultado" VARCHAR(1000),
    "consistencia" VARCHAR(70),
    "somar_total_celula" CHAR(1),
    "tecla_celula" CHAR(2),
    "valor_incremento_celula" SMALLINT,
    "multi_resultado_tabelado" CHAR(1),
    "exportar_integracao" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_campo_pkey" PRIMARY KEY ("id_exame_material_campo")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_campo_limite" (
    "id_exame_material_campo_limite" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_exame_material_campo" BIGINT,
    "id_lab_apoio_unidade" BIGINT,
    "id_ponto_interface" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "tipo_limite" SMALLINT,
    "sexo" CHAR(1),
    "ano_minimo" SMALLINT,
    "ano_maximo" SMALLINT,
    "mes_minimo" SMALLINT,
    "mes_maximo" SMALLINT,
    "dia_minimo" SMALLINT,
    "dia_maximo" SMALLINT,
    "valor_minimo" DECIMAL(10,2),
    "valor_maximo" DECIMAL(10,2),
    "valor_referencia" VARCHAR(255),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_campo_limite_pkey" PRIMARY KEY ("id_exame_material_campo_limite")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_grupo" (
    "id_exame_material_grupo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_grupo_pkey" PRIMARY KEY ("id_exame_material_grupo")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_grupo_exame" (
    "id_exame_material_grupo_exame" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "ordem_exame" SMALLINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_grupo_exame_pkey" PRIMARY KEY ("id_exame_material_grupo_exame")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_lab_apoio" (
    "id_exame_material_lab_apoio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_lab_apoio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_exame_lab_apoio" VARCHAR(50),
    "codigo_material_lab_apoio" VARCHAR(50),
    "codigo_material_real" VARCHAR(50),
    "regra_exame_secundario" VARCHAR(255),
    "enviar_tempo_diurese" CHAR(1),
    "enviar_tempo_amostra" CHAR(1),
    "enviar_volume_urinario" CHAR(1),
    "enviar_idade_gestacional" CHAR(1),
    "enviar_descricao_material" CHAR(1),
    "enviar_linfocitos_absoluto" CHAR(1),
    "conservante" VARCHAR(50),
    "observacoes" VARCHAR(255),
    "chave" VARCHAR(255),
    "pergunta" VARCHAR(255),
    "verificar_valor_referencia" CHAR(1),
    "valor_referencia" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_lab_apoio_pkey" PRIMARY KEY ("id_exame_material_lab_apoio")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_preco" (
    "id_exame_material_preco" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_preco_tabela" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_faturamento" VARCHAR(20),
    "valor" DECIMAL(12,4),
    "codigo_servico_bpa" INTEGER,
    "codigo_classificacao_bpa" INTEGER,
    "codigo_tabela_tiss" CHAR(4),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_preco_pkey" PRIMARY KEY ("id_exame_material_preco")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_questionario" (
    "id_exame_material_questionario" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codexa" VARCHAR(6),
    "codmae" VARCHAR(15),
    "codver" VARCHAR(1),
    "sitque" VARCHAR(2),
    "id_lacque" INTEGER,
    "id_lacexm" INTEGER,
    "versao_exame_material" INTEGER,
    "codigo_migracao" CHAR(4),
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_questionario_pkey" PRIMARY KEY ("id_exame_material_questionario")
);

-- CreateTable
CREATE TABLE "infolab_exame_material_unidade" (
    "id_exame_material_unidade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_unidade" BIGINT,
    "id_laboratorio_apoio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "incremento_prazo_entrega" CHAR(1),
    "rotina_dias_normal" SMALLINT,
    "rotina_hora_normal" TIME(6),
    "rotina_hora_atipico" TIME(6),
    "urgente_dias_normal" SMALLINT,
    "urgente_hora_normal" TIME(6),
    "urgente_hora_atipico" TIME(6),
    "produzir_segunda" CHAR(1),
    "produzir_terca" CHAR(1),
    "produzir_quarta" CHAR(1),
    "produzir_quinta" CHAR(1),
    "produzir_sexta" CHAR(1),
    "produzir_sabado" CHAR(1),
    "produzir_domingo" CHAR(1),
    "produzir_feriado" CHAR(1),
    "local_realizacao" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_exame_material_unidade_pkey" PRIMARY KEY ("id_exame_material_unidade")
);

-- CreateTable
CREATE TABLE "infolab_fatura" (
    "id_fatura" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_unidade" BIGINT,
    "id_receita" BIGINT,
    "id_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "data_inicio" DATE,
    "data_fim" DATE,
    "data_previsao_enviar" DATE,
    "data_enviar" DATE,
    "data_previsao_baixa_inicio" DATE,
    "data_previsao_baixa_fim" DATE,
    "data_baixar" DATE,
    "lista_id_convenio" VARCHAR(4000),
    "lista_id_unidade" VARCHAR(4000),
    "lista_pendencia_resultado" VARCHAR(100),
    "lista_id_procedencia" VARCHAR(100),
    "lista_situacao_coleta" VARCHAR(20),
    "lista_id_setor" VARCHAR(200),
    "qtd_total_atendimento" INTEGER,
    "qtd_total_exame_material" INTEGER,
    "valor_total_exame_material" DECIMAL(15,2),
    "valor_total_exame_material_coeficiente" DECIMAL(15,2),
    "valor_pago" DECIMAL(15,2),
    "valor_glosa" DECIMAL(15,2),
    "valor_desconto" DECIMAL(15,2),
    "incluir_exame_ja_faturado" CHAR(1),
    "observacao" VARCHAR(4000),
    "totalizar_valor_em" CHAR(1),
    "somente_resultado_completo" CHAR(1),
    "numero_lote" BIGINT,
    "sequencia_transacao" INTEGER,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_fatura_pkey" PRIMARY KEY ("id_fatura")
);

-- CreateTable
CREATE TABLE "infolab_fatura_item" (
    "id_fatura_item" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_fatura" BIGINT,
    "id_atendimento" BIGINT,
    "id_atendimento_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "id_exame_material" BIGINT,
    "id_exame_material_pai" BIGINT,
    "codigo_faturamento" VARCHAR(20),
    "valor_exame_material" DECIMAL(17,4),
    "valor_exame_material_coeficiente" DECIMAL(17,4),
    "qtd_exame_material" INTEGER,
    "numero_lote" BIGINT,
    "data_hora_faturamento" TIMESTAMP(6),
    "numero_guia" VARCHAR(30),
    "senha_autorizacao" VARCHAR(64),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_fatura_item_pkey" PRIMARY KEY ("id_fatura_item")
);

-- CreateTable
CREATE TABLE "infolab_feriado" (
    "id_feriado" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "data_feriado" DATE,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_feriado_pkey" PRIMARY KEY ("id_feriado")
);

-- CreateTable
CREATE TABLE "infolab_grupo" (
    "id_grupo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_formulario" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_grupo_pkey" PRIMARY KEY ("id_grupo")
);

-- CreateTable
CREATE TABLE "infolab_grupo_cliente" (
    "id_grupo_cliente" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_grupo_cliente_pkey" PRIMARY KEY ("id_grupo_cliente")
);

-- CreateTable
CREATE TABLE "infolab_grupo_exame_material" (
    "id_grupo_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_grupo" BIGINT,
    "id_exame" TEXT,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "id_exame_material" BIGINT,

    CONSTRAINT "infolab_grupo_exame_material_pkey" PRIMARY KEY ("id_grupo_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_grupo_usuario" (
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

    CONSTRAINT "infolab_grupo_usuario_pkey" PRIMARY KEY ("id_grupo_usuario")
);

-- CreateTable
CREATE TABLE "infolab_indicacao" (
    "id_indicacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(60),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_indicacao_pkey" PRIMARY KEY ("id_indicacao")
);

-- CreateTable
CREATE TABLE "infolab_integracao" (
    "id_integracao" BIGINT NOT NULL DEFAULT 0,
    "id_tenacidade" BIGINT NOT NULL,
    "id_tipo_integracao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "importacao_ativada" CHAR(1),
    "exportacao_ativada" CHAR(1),
    "status_exportar_resultado" CHAR(1),
    "exportar_resultado_excluido" CHAR(1),
    "servidor" VARCHAR(200),
    "porta" INTEGER,
    "banco_dados" VARCHAR(200),
    "usuario" VARCHAR(200),
    "senha" VARCHAR(64),
    "extensao_arquivo_enviar" VARCHAR(10),
    "diretorio_arquivo_enviar" VARCHAR(200),
    "diretorio_arquivo_enviado" VARCHAR(200),
    "extensao_arquivo_receber" VARCHAR(10),
    "diretorio_arquivo_receber" VARCHAR(200),
    "diretorio_arquivo_recebido" VARCHAR(200),
    "lista_unidade_importar" TEXT,
    "relatorio_pagina_resultado" INTEGER,
    "alterar_nome_paciente" CHAR(1),
    "url" VARCHAR(4000),
    "diretorio_laudo" VARCHAR(200),
    "importar_como_pre_atendimento" CHAR(1),
    "parametro" VARCHAR(1000),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_integracao_pkey" PRIMARY KEY ("id_integracao")
);

-- CreateTable
CREATE TABLE "infolab_integracao_convenio" (
    "id_integracao_convenio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_integracao" BIGINT,
    "id_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "convenio_integracao" VARCHAR(50),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_integracao_convenio_pkey" PRIMARY KEY ("id_integracao_convenio")
);

-- CreateTable
CREATE TABLE "infolab_integracao_exame_material" (
    "id_integracao_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_integracao" BIGINT,
    "id_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "exame_integracao" VARCHAR(50),
    "material_integracao" VARCHAR(50),
    "versao" VARCHAR(50),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_integracao_exame_material_pkey" PRIMARY KEY ("id_integracao_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_integracao_procedencia" (
    "id_integracao_procedencia" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_integracao" BIGINT,
    "id_procedencia" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "procedencia_integracao" VARCHAR(50),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_integracao_procedencia_pkey" PRIMARY KEY ("id_integracao_procedencia")
);

-- CreateTable
CREATE TABLE "infolab_interface_pacote" (
    "id_interface_pacote" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_ponto_interfaceamento" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "tipo_pacote" CHAR(1),
    "dados" TEXT,
    "status" CHAR(1),
    "data_hora_processamento" TIMESTAMP(6),
    "data_hora_captura" TIMESTAMP(6),
    "endereco_ip_auditoria" VARCHAR(15),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_interface_pacote_pkey" PRIMARY KEY ("id_interface_pacote")
);

-- CreateTable
CREATE TABLE "infolab_lab_apoio" (
    "id_lab_apoio" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "sigla" VARCHAR(15),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_lab_apoio_pkey" PRIMARY KEY ("id_lab_apoio")
);

-- CreateTable
CREATE TABLE "infolab_lab_apoio_unidade" (
    "id_lab_apoio_unidade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_lab_apoio" BIGINT,
    "id_unidade" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "utilizar_webservice" CHAR(1),
    "contrato_webservice" VARCHAR(50),
    "url_webservice" VARCHAR(255),
    "usuario_webservice" VARCHAR(100),
    "senha_webservice" VARCHAR(100),
    "utilizar_proxy" CHAR(1),
    "proxy_webservice" VARCHAR(150),
    "porta_proxy" INTEGER,
    "usuario_proxy" VARCHAR(100),
    "senha_proxy" VARCHAR(100),
    "impressora_etiqueta" VARCHAR(100),
    "enviar_exame_situacao_coleta" CHAR(1),
    "codigo_credenciamento" VARCHAR(20),
    "laudo_exame_material" CHAR(1),
    "enviar_medico" CHAR(1),
    "papel_timbrado" CHAR(1),
    "pendencia_expedicao" VARCHAR(2),
    "qtd_exame_amostra" SMALLINT,
    "tipo_conferencia_amostra" CHAR(1),
    "enviar_informacoes_cliente" CHAR(1),
    "agrupar_exame_amostra" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_lab_apoio_unidade_pkey" PRIMARY KEY ("id_lab_apoio_unidade")
);

-- CreateTable
CREATE TABLE "infolab_local_armazenamento" (
    "id_local_armazenamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "codigo_armazenamento" VARCHAR(15),
    "descricao" VARCHAR(200),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_local_armazenamento_pkey" PRIMARY KEY ("id_local_armazenamento")
);

-- CreateTable
CREATE TABLE "infolab_lote_b2b_apoio" (
    "id_lote_b2b_apoio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_lab_apoio" BIGINT,
    "id_atendimento" BIGINT,
    "id_amostra" BIGINT,
    "id_exame_material" BIGINT,
    "id_usuario_conferencia" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "data_hora_lote" TIMESTAMP(6),
    "numero_lote" VARCHAR(30),
    "numero_pedido_apoio" VARCHAR(20),
    "data_hora_recebimento_resultado" TIMESTAMP(6),
    "data_pedido" TIMESTAMP(6),
    "invalido" CHAR(1),
    "numero_amostra_apoio" VARCHAR(30),
    "data_conferencia" TIMESTAMP(6),
    "numero_ordem_apoio" INTEGER,
    "cancelado" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_lote_b2b_apoio_pkey" PRIMARY KEY ("id_lote_b2b_apoio")
);

-- CreateTable
CREATE TABLE "infolab_mapa" (
    "id_mapa" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_mapa_definicao" BIGINT,
    "id_usuario_emissao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "historico" TEXT,
    "mapa_impresso" CHAR(1),
    "qtd_impressao" INTEGER,
    "data_hora_emissao" TIMESTAMP(6),
    "data_hora_inclusao" TIMESTAMP(6),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_mapa_pkey" PRIMARY KEY ("id_mapa")
);

-- CreateTable
CREATE TABLE "infolab_mapa_atendimento_exame_material" (
    "id_mapa_atendimento_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_exame_material" BIGINT,
    "id_mapa" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_mapa_atendimento_exame_material_pkey" PRIMARY KEY ("id_mapa_atendimento_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_mapa_definicao" (
    "id_mapa_definicao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_unidade" BIGINT,
    "id_usuario" BIGINT,
    "id_tipo_exportacao_apoio" INTEGER,
    "id_relatorio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "ativo" CHAR(1),
    "nome" VARCHAR(200),
    "ordernar_por" CHAR(1),
    "lista_codigo_exame_material" TEXT,
    "lista_id_setor" TEXT,
    "lista_id_unidade" TEXT,
    "lista_id_convenio" TEXT,
    "lista_id_laboratorio_apoio" TEXT,
    "lista_id_usuario" TEXT,
    "lista_id_procedencia" TEXT,
    "somente_amotra" CHAR(1),
    "aceita_pedido_urgente" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_mapa_definicao_pkey" PRIMARY KEY ("id_mapa_definicao")
);

-- CreateTable
CREATE TABLE "infolab_material" (
    "id_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "endereco_ip_auditoria_copy" VARCHAR(20),
    "nome_aplicacao_auditoria_copy" VARCHAR(255),
    "id_usuario_auditoria" BIGINT,
    "codigo" VARCHAR(50),
    "nome" VARCHAR(100),
    "sinonimos" VARCHAR(1024) DEFAULT '',
    "genero_realiza" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_material_pkey" PRIMARY KEY ("id_material")
);

-- CreateTable
CREATE TABLE "infolab_medicamento" (
    "id_medicamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(80),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_medicamento_pkey" PRIMARY KEY ("id_medicamento")
);

-- CreateTable
CREATE TABLE "infolab_medico" (
    "id_medico" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_especialidade_medica" BIGINT,
    "id_conselho_regional" BIGINT,
    "id_medico_credencial_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "cpf" CHAR(11),
    "estado_conselho" CHAR(2),
    "numero_conselho" INTEGER,
    "numero_cns" VARCHAR(15),
    "registro_unimed" VARCHAR(13),
    "sexo" CHAR(1),
    "telefone" VARCHAR(30),
    "celular" VARCHAR(30),
    "email" VARCHAR(50),
    "senha_internet" VARCHAR(64),
    "lista_convenio_suspenso" VARCHAR(255),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(10),
    "codigo_migracao" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_medico_pkey" PRIMARY KEY ("id_medico")
);

-- CreateTable
CREATE TABLE "infolab_medico_credencial_convenio" (
    "id_medico_credencial_convenio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_medico" BIGINT,
    "id_convenio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_prestador" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_medico_credencial_convenio_pkey" PRIMARY KEY ("id_medico_credencial_convenio")
);

-- CreateTable
CREATE TABLE "infolab_modelo_resultado" (
    "id_modelo_resultado" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material_campo" BIGINT,
    "id_laboratorio_apoio_unidade" BIGINT,
    "id_vet_especie" BIGINT,
    "id_vet_raca" BIGINT,
    "id_unidade" BIGINT,
    "id_ponto_interface" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "condicao_impressao" VARCHAR(100),
    "ano_minimo" SMALLINT,
    "ano_maximo" SMALLINT,
    "mes_minimo" SMALLINT,
    "mes_maximo" SMALLINT,
    "dia_minimo" SMALLINT,
    "dia_maximo" SMALLINT,
    "sexo_modelo" CHAR(1),
    "modelo" TEXT,
    "ativo" CHAR(1),
    "modelo_generico" CHAR(1),
    "versao_apoio" VARCHAR(20),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_modelo_resultado_pkey" PRIMARY KEY ("id_modelo_resultado")
);

-- CreateTable
CREATE TABLE "infolab_motivo_cancelamento" (
    "id_motivo_cancelamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_cancelamento_pkey" PRIMARY KEY ("id_motivo_cancelamento")
);

-- CreateTable
CREATE TABLE "infolab_motivo_desconto" (
    "id_motivo_desconto" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_desconto_pkey" PRIMARY KEY ("id_motivo_desconto")
);

-- CreateTable
CREATE TABLE "infolab_motivo_exame_retificacao" (
    "id_motivo_exame_retificacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(250),
    "ativo" CHAR(1),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_exame_retificacao_pkey" PRIMARY KEY ("id_motivo_exame_retificacao")
);

-- CreateTable
CREATE TABLE "infolab_motivo_orcamento_rejeicao" (
    "id_motivo_orcamento_rejeicao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(250),
    "ativo" CHAR(1),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_orcamento_rejeicao_pkey" PRIMARY KEY ("id_motivo_orcamento_rejeicao")
);

-- CreateTable
CREATE TABLE "infolab_motivo_quarentena" (
    "id_motivo_quarentena" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_quarentena_pkey" PRIMARY KEY ("id_motivo_quarentena")
);

-- CreateTable
CREATE TABLE "infolab_motivo_recoleta" (
    "id_motivo_recoleta" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "ativo" CHAR(1),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_recoleta_pkey" PRIMARY KEY ("id_motivo_recoleta")
);

-- CreateTable
CREATE TABLE "infolab_motivo_retificacao" (
    "id_motivo_retificacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_motivo_retificacao_pkey" PRIMARY KEY ("id_motivo_retificacao")
);

-- CreateTable
CREATE TABLE "infolab_orcamento" (
    "id_orcamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento" BIGINT,
    "id_unidade" BIGINT,
    "id_cliente" BIGINT,
    "id_procedencia" BIGINT,
    "id_tipo_indicacao" BIGINT,
    "id_motivo_orcamento_rejeicao" BIGINT,
    "id_convenio_1" BIGINT,
    "id_convenio_2" BIGINT,
    "id_convenio_3" BIGINT,
    "id_convenio_4" BIGINT,
    "id_convenio_5" BIGINT,
    "id_medico" BIGINT,
    "id_usuario_inclusao" BIGINT,
    "id_usuario_rejeicao" BIGINT,
    "id_usuario_fechamento" BIGINT,
    "id_usuario_cancelamento" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "sexo" CHAR(1),
    "celular" VARCHAR(30),
    "data_hora_inclusao_inicio" TIMESTAMP(6),
    "data_hora_inclusao_fim" TIMESTAMP(6),
    "data_hora_conversao" TIMESTAMP(6),
    "data_hora_fechamento" TIMESTAMP(6),
    "data_hora_cancelamento" TIMESTAMP(6),
    "valor_desconto" DECIMAL(10,2),
    "data_hora_rejeicao" TIMESTAMP(6),
    "observacoes" TEXT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_orcamento_pkey" PRIMARY KEY ("id_orcamento")
);

-- CreateTable
CREATE TABLE "infolab_orcamento_exame_material" (
    "id_orcamento_exame_material" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_orcamento" BIGINT,
    "id_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "valor_convenio_1" DECIMAL(10,2),
    "codigo_faturamento_1" VARCHAR(20),
    "valor_convenio_2" DECIMAL(10,2),
    "codigo_faturamento_2" VARCHAR(20),
    "valor_convenio_3" DECIMAL(10,2),
    "codigo_faturamento_3" VARCHAR(20),
    "valor_convenio_4" DECIMAL(10,2),
    "codigo_faturamento_4" VARCHAR(20),
    "valor_convenio_5" DECIMAL(10,2),
    "codigo_faturamento_5" VARCHAR(20),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_orcamento_exame_material_pkey" PRIMARY KEY ("id_orcamento_exame_material")
);

-- CreateTable
CREATE TABLE "infolab_parametro_valor" (
    "id_parametro_valor" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "parametro" VARCHAR(255) NOT NULL DEFAULT '',
    "valor" VARCHAR(255),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_parametro_valor_pkey" PRIMARY KEY ("id_parametro_valor")
);

-- CreateTable
CREATE TABLE "infolab_pendencia_resultado" (
    "id_pendencia_resultado" BIGSERIAL NOT NULL,
    "sigla" VARCHAR(2),
    "nome" VARCHAR(50),

    CONSTRAINT "infolab_pendencia_resultado_pkey" PRIMARY KEY ("id_pendencia_resultado")
);

-- CreateTable
CREATE TABLE "infolab_ponto_interface" (
    "id_ponto_interface" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_analisador" BIGINT,
    "id_computador" BIGINT,
    "id_usuario_liberacao_automatica" BIGINT,
    "id_tipo_interface" BIGINT,
    "id_usuario_coleta" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "ativo" CHAR(1),
    "diretorio_envio_lista" VARCHAR(255),
    "nome_arquivo_lista_envio" VARCHAR(100),
    "data_inicio_captura" TIMESTAMP(6),
    "diretorio_lista_importada" VARCHAR(255),
    "diretorio_lista_importar" VARCHAR(255),
    "nome_arquivo_lista_importar" VARCHAR(20),
    "diretorio_resultado_receber" VARCHAR(255),
    "diretorio_resultado_recebido" VARCHAR(255),
    "nome_arquivo_resultado" VARCHAR(100),
    "tipo_id_resultado" CHAR(1),
    "porta_serial" VARCHAR(10),
    "baud_rate" INTEGER,
    "data_bits" SMALLINT,
    "paridade" SMALLINT,
    "stop_bits" SMALLINT,
    "flow_control" SMALLINT,
    "data_ultimo_mapeamento" TIMESTAMP(6),
    "data_ultima_captura" TIMESTAMP(6),
    "quantidade_capturado" INTEGER,
    "liberacao_automatica" CHAR(1),
    "tipo_modulo_interface" CHAR(1),
    "diretorio_log" VARCHAR(255),
    "quantidade_dia_log" SMALLINT,
    "parametro_comunicacao" TEXT,
    "mascara_amostra_lista" VARCHAR(200),
    "tipo_resultado_repeticao" CHAR(1),
    "tipo_comunicacao" CHAR(1),
    "ip_servidor_tcp" VARCHAR(15),
    "porta_servidor_tcp" INTEGER,
    "salvar_lista_em_arquivo" CHAR(1),
    "controle_dtr" SMALLINT,
    "controle_rts" SMALLINT,
    "validar_pendencia" CHAR(1),
    "enviar_lista" CHAR(1),
    "tamanho_identificacao_amostra" SMALLINT,
    "lista_amostra_controle" VARCHAR(4000),
    "enviar_exame_nao_interfacear" CHAR(1),
    "pausar_importacao_controle" CHAR(1),
    "data_ultima_execucao" TIMESTAMP(6),
    "tempo_espera_execucao" SMALLINT,
    "verificar_variavel_liberacao_auto" CHAR(1),
    "pagina_resultado_interface" VARCHAR(50),
    "recalcular_parametro" CHAR(1),
    "liberacao_limite_patologico" CHAR(1),
    "gerar_lista_automatica" CHAR(1),
    "gerar_lista_registra_coleta" CHAR(1),
    "gerar_lista_recebe_expedicao" CHAR(1),
    "registrar_coleta_automatica" SMALLINT,
    "liberacao_evolutiva" CHAR(1),
    "receber_expedicao_automatica" SMALLINT,
    "lista_usuario_acesso" VARCHAR(4000),
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(20),

    CONSTRAINT "infolab_ponto_interface_pkey" PRIMARY KEY ("id_ponto_interface")
);

-- CreateTable
CREATE TABLE "infolab_ponto_programacao" (
    "id_ponto_programacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_exame_material" BIGINT,
    "id_ponto_interface" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "segunda" CHAR(1),
    "terca" CHAR(1),
    "quarta" CHAR(1),
    "quinta" CHAR(1),
    "sexta" CHAR(1),
    "sabado" CHAR(1),
    "domingo" CHAR(1),
    "producao_diaria" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_ponto_programacao_pkey" PRIMARY KEY ("id_ponto_programacao")
);

-- CreateTable
CREATE TABLE "infolab_porta_serial" (
    "id_porta_serial" SMALLSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(6),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(20),

    CONSTRAINT "infolab_porta_serial_pkey" PRIMARY KEY ("id_porta_serial")
);

-- CreateTable
CREATE TABLE "infolab_preco_exame" (
    "id_preco_exame" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_preco_tabela" BIGINT,
    "id_exame_material" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "codigo_faturamento" VARCHAR(20),
    "coeficiente" DECIMAL(10,4),
    "codigo_servico_bpa" INTEGER,
    "codigo_classificacao_bpa" INTEGER,
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_preco_exame_pkey" PRIMARY KEY ("id_preco_exame")
);

-- CreateTable
CREATE TABLE "infolab_preco_fator" (
    "id_preco_fator" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(255),
    "valor" DECIMAL(17,4),
    "codigo_externo" VARCHAR(3),
    "codigo_migracao" INTEGER,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_preco_fator_pkey" PRIMARY KEY ("id_preco_fator")
);

-- CreateTable
CREATE TABLE "infolab_preco_tabela" (
    "id_preco_tabela" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(255),
    "codigo_externo" BIGINT,
    "codigo_migracao" INTEGER,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_preco_tabela_pkey" PRIMARY KEY ("id_preco_tabela")
);

-- CreateTable
CREATE TABLE "infolab_procedencia" (
    "id_procedencia" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "sigla" VARCHAR(10),
    "email" VARCHAR(320),
    "senha_internet" VARCHAR(64),
    "setor" VARCHAR(50),
    "ala" VARCHAR(50),
    "leito" VARCHAR(50),
    "quarto" VARCHAR(50),
    "publica" CHAR(1),
    "urgente" CHAR(1),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(30),
    "codigo_migracao" VARCHAR(10),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_procedencia_pkey" PRIMARY KEY ("id_procedencia")
);

-- CreateTable
CREATE TABLE "infolab_questionario" (
    "id_questionario" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "titulo" VARCHAR(255) NOT NULL,
    "descricao" TEXT,
    "data_inclusao" TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT "infolab_questionario_pkey" PRIMARY KEY ("id_questionario")
);

-- CreateTable
CREATE TABLE "infolab_questionario_campo" (
    "id_questionario_campo" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "id_questionario" BIGINT NOT NULL DEFAULT 0,
    "tipo_campo" TEXT NOT NULL,
    "titulo" VARCHAR(255) NOT NULL,
    "tamanho" INTEGER,
    "decimais" INTEGER,
    "hint" VARCHAR(255),
    "css_classes" VARCHAR(255),
    "validacao_js" TEXT,

    CONSTRAINT "infolab_questionario_campo_pkey" PRIMARY KEY ("id_questionario_campo")
);

-- CreateTable
CREATE TABLE "infolab_questionario_campo_resposta" (
    "id_questionario_campo_resposta" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "id_questionario_campo" BIGINT NOT NULL DEFAULT 0,
    "valor_resposta" TEXT NOT NULL,

    CONSTRAINT "infolab_questionario_campo_resposta_pkey" PRIMARY KEY ("id_questionario_campo_resposta")
);

-- CreateTable
CREATE TABLE "infolab_questionario_campo_valor" (
    "id_questionario_campo_valor" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "id_questionario_campo" BIGINT NOT NULL DEFAULT 0,
    "valor" VARCHAR(255) NOT NULL,
    "descricao" VARCHAR(255),

    CONSTRAINT "infolab_questionario_campo_valor_pkey" PRIMARY KEY ("id_questionario_campo_valor")
);

-- CreateTable
CREATE TABLE "infolab_raca" (
    "id_raca" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "nome" VARCHAR(80),

    CONSTRAINT "infolab_raca_pkey" PRIMARY KEY ("id_raca")
);

-- CreateTable
CREATE TABLE "infolab_recipiente" (
    "id_recipiente" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL DEFAULT 0,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "cor" VARCHAR(200),
    "volume_recipiente" DECIMAL(10,2),
    "ativo" CHAR(1),
    "codigo_migracao" VARCHAR(200),
    "codigo_externo" VARCHAR(10),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_recipiente_pkey" PRIMARY KEY ("id_recipiente")
);

-- CreateTable
CREATE TABLE "infolab_relatorio" (
    "id_relatorio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_tipo_relatorio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "descricao" VARCHAR(255) DEFAULT '',
    "arquivo" CHAR(1),
    "relatorio_arquivo" BYTEA,
    "relatorio_arquivo_nome" VARCHAR(255),
    "relatorio_html" TEXT,
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_relatorio_pkey" PRIMARY KEY ("id_relatorio")
);

-- CreateTable
CREATE TABLE "infolab_resultado" (
    "id_resultado" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_atendimento_exame_material" BIGINT,
    "id_exame_material_campo" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "data_hora_inclusao" TIMESTAMP(6),
    "data_hora_alteracao" TIMESTAMP(6),
    "tipo" TEXT DEFAULT 'int',
    "valor_int" INTEGER,
    "valor_float" DECIMAL(10,6),
    "valor_string" VARCHAR(255),
    "valor_date" TIMESTAMP(6),
    "valor_text" TEXT,
    "valor_file" VARCHAR(255) DEFAULT '',
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_resultado_pkey" PRIMARY KEY ("id_resultado")
);

-- CreateTable
CREATE TABLE "infolab_resultado_tabela" (
    "id_resultado_tabela" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(255),
    "tipo_valor_padrao" CHAR(1),
    "tamanho_valor" INTEGER,
    "valor_padrao" INTEGER,
    "tipo_pesquisa" CHAR(1),
    "utilizar_expressao" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "codtab" BIGINT,

    CONSTRAINT "infolab_resultado_tabela_pkey" PRIMARY KEY ("id_resultado_tabela")
);

-- CreateTable
CREATE TABLE "infolab_resultado_tabela_valor" (
    "id_resultado_tabela_valor" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_resultado_tabela" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "ordem_valor" INTEGER,
    "valor_padrao" VARCHAR(2048) DEFAULT '',
    "codigo_valor" VARCHAR(10),
    "codigo_externo" VARCHAR(20),
    "conferir_resultado" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_resultado_tabela_valor_pkey" PRIMARY KEY ("id_resultado_tabela_valor")
);

-- CreateTable
CREATE TABLE "infolab_setor" (
    "id_setor" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(200),
    "ativo" CHAR(1),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_setor_pkey" PRIMARY KEY ("id_setor")
);

-- CreateTable
CREATE TABLE "infolab_situacao_coleta" (
    "id_situacao_coleta" BIGSERIAL NOT NULL,
    "sigla" VARCHAR(2),
    "nome" VARCHAR(50),

    CONSTRAINT "infolab_situacao_coleta_pkey" PRIMARY KEY ("id_situacao_coleta")
);

-- CreateTable
CREATE TABLE "infolab_soroteca_grade" (
    "id_soroteca_grade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_setor" BIGINT,
    "id_local_armazenamento" BIGINT,
    "id_usuario_inclusao" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(200),
    "dias_amostra_validade" SMALLINT,
    "data_hora" TIMESTAMP(6),
    "tamanho_linha" SMALLINT,
    "tamanho_coluna" SMALLINT,
    "lista_pocos_inativos" VARCHAR(200),
    "tipo_cabecalho" CHAR(1),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_soroteca_grade_pkey" PRIMARY KEY ("id_soroteca_grade")
);

-- CreateTable
CREATE TABLE "infolab_soroteca_grade_poco_historico" (
    "id" SERIAL NOT NULL,
    "id_grade" INTEGER NOT NULL,
    "id_poco" INTEGER,
    "dtcadastro" TIMESTAMP(6),
    "usucadastro" INTEGER NOT NULL,
    "observacao" TEXT NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_soroteca_grade_poco_historico_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "infolab_tenacidade_configuracao" (
    "id_tenacidade_configuracao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
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

-- CreateTable
CREATE TABLE "infolab_tipo_aplicacao" (
    "id_tipo_aplicacao" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "descricao" VARCHAR(255),

    CONSTRAINT "infolab_tipo_aplicacao_pkey" PRIMARY KEY ("id_tipo_aplicacao")
);

-- CreateTable
CREATE TABLE "infolab_tipo_destino_resultado" (
    "id_tipo_destino_resultado" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "descricao" VARCHAR(100),

    CONSTRAINT "infolab_tipo_destino_resultado_pkey" PRIMARY KEY ("id_tipo_destino_resultado")
);

-- CreateTable
CREATE TABLE "infolab_tipo_estado_civil" (
    "id_tipo_estado_civil" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_tipo_estado_civil_pkey" PRIMARY KEY ("id_tipo_estado_civil")
);

-- CreateTable
CREATE TABLE "infolab_tipo_evento" (
    "id_tipo_evento" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "descricao" VARCHAR(100),

    CONSTRAINT "infolab_tipo_evento_pkey" PRIMARY KEY ("id_tipo_evento")
);

-- CreateTable
CREATE TABLE "infolab_tipo_indicacao" (
    "id_tipo_indicacao" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "codigo" VARCHAR(30),
    "descicao" VARCHAR(100),
    "ativo" CHAR(1),
    "nome_aplicacao_auditoria" VARCHAR(20),
    "endereco_ip_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_tipo_indicacao_pkey" PRIMARY KEY ("id_tipo_indicacao")
);

-- CreateTable
CREATE TABLE "infolab_tipo_integracao" (
    "id_tipo_integracao" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "descricao" VARCHAR(100),
    "codigo_migracao" BIGINT,
    "ativo" CHAR(1),

    CONSTRAINT "infolab_tipo_integracao_pkey" PRIMARY KEY ("id_tipo_integracao")
);

-- CreateTable
CREATE TABLE "infolab_tipo_interface" (
    "id_tipo_interface" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "descricao" VARCHAR(100),
    "ativo" CHAR(1),
    "nome_aplicacao_auditoria" VARCHAR(20),
    "endereco_ip_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_tipo_interface_pkey" PRIMARY KEY ("id_tipo_interface")
);

-- CreateTable
CREATE TABLE "infolab_tipo_pagamento" (
    "id_tipo_pagamento" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "codigo_tipo_pagamento" VARCHAR(2),
    "descricao" VARCHAR(100),
    "limite_parcelas" SMALLINT,
    "bandeira" VARCHAR(20),
    "documento_obrigatorio" CHAR(1),
    "codigo_migracao" INTEGER,
    "codigo_externo" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_tipo_pagamento_pkey" PRIMARY KEY ("id_tipo_pagamento")
);

-- CreateTable
CREATE TABLE "infolab_tipo_relatorio" (
    "id_tipo_relatorio" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "endereco_ip_auditoria" VARCHAR(255),
    "nome_aplicacao_auditoria" VARCHAR(255),
    "descricao" VARCHAR(100),
    "ativo" CHAR(1),

    CONSTRAINT "infolab_tipo_relatorio_pkey" PRIMARY KEY ("id_tipo_relatorio")
);

-- CreateTable
CREATE TABLE "infolab_unidade" (
    "id_unidade" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_almoxarifado_padrao" BIGINT,
    "id_municipio_nota_fiscal" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "razao_social" VARCHAR(100),
    "nome_fantasia" VARCHAR(100),
    "cnpj" CHAR(17),
    "inscricao_municipal" VARCHAR(15),
    "natureza_operacao" SMALLINT,
    "regime_tributacao" SMALLINT,
    "serie_nota_fiscal" BIGINT,
    "cnes" CHAR(7),
    "sigla" VARCHAR(10),
    "tipo_unidade" CHAR(1),
    "cep" CHAR(10),
    "tipo_logradouro" VARCHAR(50),
    "logradouro" VARCHAR(100),
    "bairro" VARCHAR(100),
    "numero" VARCHAR(50),
    "complemento" VARCHAR(50),
    "cidade" VARCHAR(100),
    "estado" CHAR(2),
    "latitude" DOUBLE PRECISION,
    "longitude" DOUBLE PRECISION,
    "telefone" VARCHAR(30),
    "celular" VARCHAR(30),
    "amostra_externa_inicio" BIGINT,
    "amostra_externa_fim" BIGINT,
    "amostra_externa_atual" BIGINT,
    "senha_internet" VARCHAR(64),
    "regra_agrupamento_amostra" SMALLINT,
    "nome_arquivo_logotipo" VARCHAR(255),
    "nome_referencia_logotipo" VARCHAR(255),
    "enviar_amostra" CHAR(1),
    "enviar_sms" CHAR(1),
    "procedencia_atendimento_obrigatorio" CHAR(1),
    "descricao_servico_nota_fiscal" TEXT,
    "pertencer_simples_nacional" CHAR(1),
    "qtd_dias_validade_orcamento" INTEGER,
    "alterar_laboratorio_apoio" CHAR(1),
    "lista_procedencia_permitida" VARCHAR(600) DEFAULT '',
    "lista_convenio_permitido" VARCHAR(600) DEFAULT '',
    "indicacao_orcamento" CHAR(1),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(30),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_unidade_pkey" PRIMARY KEY ("id_unidade")
);

-- CreateTable
CREATE TABLE "infolab_unidade_email" (
    "id_unidade_email" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_unidade" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "smtp" VARCHAR(320),
    "usuario" VARCHAR(320),
    "assinatura" VARCHAR(1024),
    "senha" VARCHAR(64),
    "porta" SMALLINT,
    "usar_ssl" CHAR(1),
    "remetente" VARCHAR(320),
    "ativo" CHAR(1),
    "codigo_externo" VARCHAR(30),
    "codigo_migracao" BIGINT,
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_unidade_email_pkey" PRIMARY KEY ("id_unidade_email")
);

-- CreateTable
CREATE TABLE "infolab_unidade_federacao" (
    "id_unidade_federacao" BIGSERIAL NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "codigo" INTEGER,
    "sigla" CHAR(2),
    "descricao" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_unidade_federacao_pkey" PRIMARY KEY ("id_unidade_federacao")
);

-- CreateTable
CREATE TABLE "infolab_unidade_relatorio" (
    "id_unidade_relatorio" BIGSERIAL NOT NULL,
    "id_tenacidade" BIGINT NOT NULL,
    "id_unidade" BIGINT,
    "id_relatorio" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_unidade_relatorio_pkey" PRIMARY KEY ("id_unidade_relatorio")
);

-- CreateTable
CREATE TABLE "infolab_versao_tiss" (
    "id_versao_tiss" SERIAL NOT NULL,
    "id_tenacidade" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(8),
    "ativo" CHAR(1),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_versao_tiss_pkey" PRIMARY KEY ("id_versao_tiss")
);

-- CreateTable
CREATE TABLE "infolab_vet_especie" (
    "id_vet_especie" BIGINT NOT NULL,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(80),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_vet_especie_pkey" PRIMARY KEY ("id_vet_especie")
);

-- CreateTable
CREATE TABLE "infolab_vet_raca" (
    "id_vet_raca" BIGINT NOT NULL,
    "id_vet_especie" BIGINT,
    "id_usuario_auditoria" BIGINT,
    "nome" VARCHAR(100),
    "endereco_ip_auditoria" VARCHAR(20),
    "nome_aplicacao_auditoria" VARCHAR(255),

    CONSTRAINT "infolab_vet_raca_pkey" PRIMARY KEY ("id_vet_raca")
);

-- CreateTable
CREATE TABLE "infolab_sessao_usuario" (
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

    CONSTRAINT "infolab_sessao_usuario_pkey" PRIMARY KEY ("id_sessao")
);

-- CreateTable
CREATE TABLE "infolab_sessao_suporte" (
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

    CONSTRAINT "infolab_sessao_suporte_pkey" PRIMARY KEY ("id_sessao_suporte")
);

-- CreateTable
CREATE TABLE "infolab_formulario" (
    "id_formulario" BIGSERIAL NOT NULL,
    "codigo" VARCHAR(80) NOT NULL,
    "descricao" VARCHAR(255),
    "ordem" INTEGER NOT NULL DEFAULT 0,
    "ativo" BOOLEAN NOT NULL DEFAULT true,

    CONSTRAINT "infolab_formulario_pkey" PRIMARY KEY ("id_formulario")
);

-- CreateTable
CREATE TABLE "infolab_layout_formulario" (
    "id_layout_formulario" BIGSERIAL NOT NULL,
    "id_formulario" BIGINT NOT NULL,
    "id_usuario" BIGINT NOT NULL,
    "configuracao_json" TEXT NOT NULL,

    CONSTRAINT "infolab_layout_formulario_pkey" PRIMARY KEY ("id_layout_formulario")
);

-- CreateIndex
CREATE UNIQUE INDEX "infolab_tenacidade_dominio_tenacidade_key" ON "infolab_tenacidade"("dominio_tenacidade");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_01" ON "infolab_aplicacao"("id_tenacidade", "codigo_aplicacao");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_02" ON "infolab_aplicacao"("ativo");

-- CreateIndex
CREATE UNIQUE INDEX "uq_infolab_aplicacao_01" ON "infolab_aplicacao"("id_tenacidade", "codigo_aplicacao");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_01" ON "infolab_aplicacao_campo"("id_aplicacao", "ativo");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_02" ON "infolab_aplicacao_campo"("id_aplicacao", "ordem_formulario_padrao");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_03" ON "infolab_aplicacao_campo"("id_aplicacao", "exibir_listagem_padrao", "ordem_listagem_padrao");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_04" ON "infolab_aplicacao_campo"("id_tenacidade", "id_aplicacao", "codigo_campo");

-- CreateIndex
CREATE UNIQUE INDEX "uq_infolab_aplicacao_campo_01" ON "infolab_aplicacao_campo"("id_tenacidade", "id_aplicacao", "codigo_campo");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_tenacidade_01" ON "infolab_aplicacao_campo_tenacidade"("id_tenacidade", "id_aplicacao");

-- CreateIndex
CREATE INDEX "idx_infolab_aplicacao_campo_tenacidade_02" ON "infolab_aplicacao_campo_tenacidade"("id_tenacidade", "id_aplicacao_campo");

-- CreateIndex
CREATE UNIQUE INDEX "uq_infolab_aplicacao_campo_tenacidade_01" ON "infolab_aplicacao_campo_tenacidade"("id_tenacidade", "id_aplicacao_campo");

-- CreateIndex
CREATE INDEX "ix_sessao_token_id" ON "infolab_sessao_usuario"("token_id");

-- CreateIndex
CREATE UNIQUE INDEX "ux_sessao_usuario_ativa" ON "infolab_sessao_usuario"("id_tenacidade", "id_usuario");

-- CreateIndex
CREATE UNIQUE INDEX "infolab_sessao_suporte_token_id_key" ON "infolab_sessao_suporte"("token_id");

-- CreateIndex
CREATE INDEX "idx_sessao_suporte_tenacidade" ON "infolab_sessao_suporte"("id_tenacidade");

-- CreateIndex
CREATE INDEX "idx_sessao_suporte_token_id" ON "infolab_sessao_suporte"("token_id");

-- CreateIndex
CREATE INDEX "idx_sessao_suporte_usuario" ON "infolab_sessao_suporte"("id_usuario");

-- CreateIndex
CREATE UNIQUE INDEX "infolab_formulario_codigo_key" ON "infolab_formulario"("codigo");

-- CreateIndex
CREATE INDEX "infolab_formulario_ativo_ordem_idx" ON "infolab_formulario"("ativo", "ordem");

-- CreateIndex
CREATE INDEX "infolab_layout_formulario_id_formulario_idx" ON "infolab_layout_formulario"("id_formulario");

-- CreateIndex
CREATE UNIQUE INDEX "infolab_layout_formulario_id_usuario_id_formulario_key" ON "infolab_layout_formulario"("id_usuario", "id_formulario");

-- AddForeignKey
ALTER TABLE "infolab_tenacidade" ADD CONSTRAINT "fk_tenacidade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_usuario" ADD CONSTRAINT "fk_usuario_id_grupo_usuario" FOREIGN KEY ("id_grupo_usuario") REFERENCES "infolab_grupo_usuario"("id_grupo_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_usuario" ADD CONSTRAINT "fk_usuario_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE SET NULL ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_usuario" ADD CONSTRAINT "fk_usuario_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_usuario" ADD CONSTRAINT "fk_usuario_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador" ADD CONSTRAINT "fk_analisador_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material" ADD CONSTRAINT "fk_analisador_exame_material_id_analisador" FOREIGN KEY ("id_analisador") REFERENCES "infolab_analisador"("id_analisador") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material" ADD CONSTRAINT "fk_analisador_exame_material_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material" ADD CONSTRAINT "fk_analisador_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material" ADD CONSTRAINT "fk_analisador_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo" ADD CONSTRAINT "fk_analisador_exame_material_campo_id_analisador_exame_material" FOREIGN KEY ("id_analisador_exame_material") REFERENCES "infolab_analisador_exame_material"("id_analisador_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo" ADD CONSTRAINT "fk_analisador_exame_material_campo_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo" ADD CONSTRAINT "fk_analisador_exame_material_campo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo" ADD CONSTRAINT "fk_analisador_exame_material_campo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_analisador_exame_material_campo_limite_id_analisador" FOREIGN KEY ("id_analisador") REFERENCES "infolab_analisador"("id_analisador") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_analisador_exame_material_campo_limite_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_analisador_exame_material_campo_limite_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_analisador_exame_material_campo_limite_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_anls_exm_mtrl_camp_lim_id_anls_exm_mtrl" FOREIGN KEY ("id_analisador_exame_material") REFERENCES "infolab_analisador_exame_material"("id_analisador_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_analisador_exame_material_campo_limite" ADD CONSTRAINT "fk_anls_exm_mtrl_camp_lim_id_anls_exm_mtrl_camp" FOREIGN KEY ("id_analisador_exame_material_campo") REFERENCES "infolab_analisador_exame_material_campo"("id_analisador_exame_material_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao" ADD CONSTRAINT "fk_infolab_aplicacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao_campo" ADD CONSTRAINT "fk_infolab_aplicacao_campo_01" FOREIGN KEY ("id_aplicacao") REFERENCES "infolab_aplicacao"("id_aplicacao") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao_campo_tenacidade" ADD CONSTRAINT "fk_infolab_aplicacao_campo_tenacidade_01" FOREIGN KEY ("id_aplicacao") REFERENCES "infolab_aplicacao"("id_aplicacao") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao_campo_tenacidade" ADD CONSTRAINT "fk_infolab_aplicacao_campo_tenacidade_02" FOREIGN KEY ("id_aplicacao_campo") REFERENCES "infolab_aplicacao_campo"("id_aplicacao_campo") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao_campo_tenacidade" ADD CONSTRAINT "fk_infolab_aplicacao_campo_tenacidade_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_aplicacao_campo_tenacidade" ADD CONSTRAINT "fk_infolab_aplicacao_campo_tenacidade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_cid" FOREIGN KEY ("id_cid") REFERENCES "infolab_cid"("id_cid") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_cliente" FOREIGN KEY ("id_cliente") REFERENCES "infolab_cliente"("id_cliente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_integracao_sistema" FOREIGN KEY ("id_integracao_sistema") REFERENCES "infolab_integracao"("id_integracao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_orcamento" FOREIGN KEY ("id_orcamento") REFERENCES "infolab_orcamento"("id_orcamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_procedencia" FOREIGN KEY ("id_procedencia") REFERENCES "infolab_procedencia"("id_procedencia") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento" ADD CONSTRAINT "fk_atendimento_id_usuario_inclusao" FOREIGN KEY ("id_usuario_inclusao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_amostra_motivo_prorrogacao" FOREIGN KEY ("id_amostra_motivo_prorrogacao") REFERENCES "infolab_atendimento_amostra_motivo_prorrogacao"("id_amostra_motivo_prorrogacao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_amostra_motivo_rejeicao" FOREIGN KEY ("id_amostra_motivo_rejeicao") REFERENCES "infolab_atendimento_amostra_motivo_rejeicao"("id_amostra_motivo_rejeicao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_amostra_observacoes_coleta" FOREIGN KEY ("id_amostra_observacoes_coleta") REFERENCES "infolab_atendimento_amostra_observacoes_coleta"("id_amostra_observacoes_coleta") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_amostra_observacoes_devolucao" FOREIGN KEY ("id_amostra_observacoes_devolucao") REFERENCES "infolab_atendimento_amostra_observacoes_devolucao"("id_amostra_observacoes_devolucao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_atendimento" FOREIGN KEY ("id_atendimento") REFERENCES "infolab_atendimento"("id_atendimento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_local_armazenamento" FOREIGN KEY ("id_local_armazenamento") REFERENCES "infolab_local_armazenamento"("id_local_armazenamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_soroteca_grade" FOREIGN KEY ("id_soroteca_grade") REFERENCES "infolab_soroteca_grade"("id_soroteca_grade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_armazenamento" FOREIGN KEY ("id_usuario_armazenamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_conferencia" FOREIGN KEY ("id_usuario_conferencia") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_descarte" FOREIGN KEY ("id_usuario_descarte") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_emprestimo" FOREIGN KEY ("id_usuario_emprestimo") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_expedicao" FOREIGN KEY ("id_usuario_expedicao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_recebimento" FOREIGN KEY ("id_usuario_recebimento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra" ADD CONSTRAINT "fk_amostra_id_usuario_rejeicao" FOREIGN KEY ("id_usuario_rejeicao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_impressao" ADD CONSTRAINT "fk_atendimento_amostra_impressao_id_atendimento_amostra" FOREIGN KEY ("id_atendimento_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_impressao" ADD CONSTRAINT "fk_atendimento_amostra_impressao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_impressao" ADD CONSTRAINT "fk_atendimento_amostra_impressao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_impressao" ADD CONSTRAINT "fk_atendimento_amostra_impressao_id_usuario_impressao" FOREIGN KEY ("id_usuario_impressao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_motivo_prorrogacao" ADD CONSTRAINT "fk_atendimento_amostra_motivo_prorrogacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_motivo_prorrogacao" ADD CONSTRAINT "fk_atendimento_amostra_motivo_prorrogacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_motivo_rejeicao" ADD CONSTRAINT "fk_atendimento_amostra_motivo_rejeicao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_motivo_rejeicao" ADD CONSTRAINT "fk_atendimento_amostra_motivo_rejeicao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_observacoes_coleta" ADD CONSTRAINT "fk_atendimento_amostra_observacoes_coleta_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_observacoes_coleta" ADD CONSTRAINT "fk_atendimento_amostra_observacoes_coleta_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_observacoes_devolucao" ADD CONSTRAINT "fk_atendimento_amostra_observacoes_devolucao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_amostra_observacoes_devolucao" ADD CONSTRAINT "fk_atendimento_amostra_observacoes_devolucao_id_usuario_auditor" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_convenio" ADD CONSTRAINT "fk_atendimento_convenio_id_cliente_titular" FOREIGN KEY ("id_cliente_titular") REFERENCES "infolab_cliente"("id_cliente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_convenio" ADD CONSTRAINT "fk_atendimento_convenio_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_convenio" ADD CONSTRAINT "fk_atendimento_convenio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_convenio" ADD CONSTRAINT "fk_atendimento_convenio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_motivo_cancelamento" FOREIGN KEY ("id_motivo_cancelamento") REFERENCES "infolab_motivo_cancelamento"("id_motivo_cancelamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_motivo_retificacao" FOREIGN KEY ("id_motivo_retificacao") REFERENCES "infolab_motivo_retificacao"("id_motivo_retificacao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_situacao_coleta" FOREIGN KEY ("id_situacao_coleta") REFERENCES "infolab_situacao_coleta"("id_situacao_coleta") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_cancelamento" FOREIGN KEY ("id_usuario_cancelamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_coleta" FOREIGN KEY ("id_usuario_coleta") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_coletando" FOREIGN KEY ("id_usuario_coletando") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_digitacao" FOREIGN KEY ("id_usuario_digitacao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_impressao" FOREIGN KEY ("id_usuario_impressao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_liberacao" FOREIGN KEY ("id_usuario_liberacao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_quarentena" FOREIGN KEY ("id_usuario_quarentena") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material" ADD CONSTRAINT "fk_atendimento_exame_material_id_usuario_retirada" FOREIGN KEY ("id_usuario_retirada") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atend_exm_mtrl_aut_id_atend_exm_mtrl" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atend_exm_mtrl_aut_id_exm_mtrl_equivalente" FOREIGN KEY ("id_exame_material_equivalente") REFERENCES "infolab_exame"("id_exame") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atend_exm_mtrl_aut_id_usr_cancelamento" FOREIGN KEY ("id_usuario_cancelamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atendimento_exame_material_autorizacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atendimento_exame_material_autorizacao_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atendimento_exame_material_autorizacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_autorizacao" ADD CONSTRAINT "fk_atendimento_exame_material_autorizacao_id_usuario_autorizaca" FOREIGN KEY ("id_usuario_autorizacao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_medico" ADD CONSTRAINT "fk_atend_exm_mtrl_med_id_atend_exm_mtrl" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_medico" ADD CONSTRAINT "fk_atendimento_exame_material_medico_id_atendimento_medico" FOREIGN KEY ("id_atendimento_medico") REFERENCES "infolab_atendimento_medico"("id_atendimento_medico") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_medico" ADD CONSTRAINT "fk_atendimento_exame_material_medico_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_medico" ADD CONSTRAINT "fk_atendimento_exame_material_medico_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_atend_exm_mtrl" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_exm_mtrl_camp" FOREIGN KEY ("id_exame_material_campo") REFERENCES "infolab_exame_material_campo"("id_exame_material_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_usr_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_usr_digitacao" FOREIGN KEY ("id_usuario_digitacao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_usr_imp" FOREIGN KEY ("id_usuario_impressao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atend_exm_mtrl_res_camp_id_usr_liberaco" FOREIGN KEY ("id_usuario_liberacao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atendimento_exame_material_resultado_campo_id_analisador" FOREIGN KEY ("id_analisador") REFERENCES "infolab_analisador"("id_analisador") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atendimento_exame_material_resultado_campo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_exame_material_resultado_campo" ADD CONSTRAINT "fk_atendimento_exame_material_resultado_campo_id_usuario_entreg" FOREIGN KEY ("id_usuario_entrega") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_medico" ADD CONSTRAINT "fk_atendimento_medico_id_medico" FOREIGN KEY ("id_medico") REFERENCES "infolab_medico"("id_medico") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_medico" ADD CONSTRAINT "fk_atendimento_medico_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_atendimento" FOREIGN KEY ("id_atendimento") REFERENCES "infolab_atendimento"("id_atendimento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_motivo_desconto" FOREIGN KEY ("id_motivo_desconto") REFERENCES "infolab_motivo_desconto"("id_motivo_desconto") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_tipo_pagamento" FOREIGN KEY ("id_tipo_pagamento") REFERENCES "infolab_tipo_pagamento"("id_tipo_pagamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_unidade_pagamento" FOREIGN KEY ("id_unidade_pagamento") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_usuario_desconto" FOREIGN KEY ("id_usuario_desconto") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_atendimento_pagamento" ADD CONSTRAINT "fk_atendimento_pagamento_id_usuario_pagamento" FOREIGN KEY ("id_usuario_pagamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cbo" ADD CONSTRAINT "fk_cbo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cid" ADD CONSTRAINT "fk_cid_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_cbo" FOREIGN KEY ("id_cbo") REFERENCES "infolab_cbo"("id_cbo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_cliente_acompanhante" FOREIGN KEY ("id_cliente_acompanhante") REFERENCES "infolab_cliente"("id_cliente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_cliente_mae" FOREIGN KEY ("id_cliente_mae") REFERENCES "infolab_cliente"("id_cliente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_cliente_pai" FOREIGN KEY ("id_cliente_pai") REFERENCES "infolab_cliente"("id_cliente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_etnia" FOREIGN KEY ("id_etnia") REFERENCES "infolab_etnia"("id_etnia") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_raca" FOREIGN KEY ("id_raca") REFERENCES "infolab_raca"("id_raca") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_vet_especie" FOREIGN KEY ("id_vet_especie") REFERENCES "infolab_vet_especie"("id_vet_especie") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente" ADD CONSTRAINT "fk_cliente_id_vet_raca" FOREIGN KEY ("id_vet_raca") REFERENCES "infolab_vet_raca"("id_vet_raca") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente_indicacao" ADD CONSTRAINT "fk_cliente_indicacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_cliente_indicacao" ADD CONSTRAINT "fk_cliente_indicacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_computador" ADD CONSTRAINT "fk_computador_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_computador" ADD CONSTRAINT "fk_computador_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_conselho_regional" ADD CONSTRAINT "fk_conselho_regional_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio" ADD CONSTRAINT "fk_convenio_id_preco_fator" FOREIGN KEY ("id_preco_fator") REFERENCES "infolab_preco_fator"("id_preco_fator") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio" ADD CONSTRAINT "fk_convenio_id_preco_tabela" FOREIGN KEY ("id_preco_tabela") REFERENCES "infolab_preco_tabela"("id_preco_tabela") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio" ADD CONSTRAINT "fk_convenio_id_relatorio_guia" FOREIGN KEY ("id_relatorio_guia") REFERENCES "infolab_relatorio"("id_relatorio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio" ADD CONSTRAINT "fk_convenio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio" ADD CONSTRAINT "fk_convenio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_autorizador" ADD CONSTRAINT "fk_convenio_autorizador_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_autorizador" ADD CONSTRAINT "fk_convenio_autorizador_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_contato" ADD CONSTRAINT "fk_convenio_contato_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_contato" ADD CONSTRAINT "fk_convenio_contato_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_contato" ADD CONSTRAINT "fk_convenio_contato_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_email" ADD CONSTRAINT "fk_convenio_email_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_email" ADD CONSTRAINT "fk_convenio_email_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_email" ADD CONSTRAINT "fk_convenio_email_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_equivalencia" ADD CONSTRAINT "fk_convenio_equivalencia_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_equivalencia" ADD CONSTRAINT "fk_convenio_equivalencia_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_equivalencia" ADD CONSTRAINT "fk_convenio_equivalencia_id_exame_material_equivalente" FOREIGN KEY ("id_exame_material_equivalente") REFERENCES "infolab_exame"("id_exame") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_equivalencia" ADD CONSTRAINT "fk_convenio_equivalencia_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_equivalencia" ADD CONSTRAINT "fk_convenio_equivalencia_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_plano" ADD CONSTRAINT "fk_convenio_plano_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_plano" ADD CONSTRAINT "fk_convenio_plano_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_plano" ADD CONSTRAINT "fk_convenio_plano_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_cbo_padrao" FOREIGN KEY ("id_cbo_padrao") REFERENCES "infolab_cbo"("id_cbo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_cid" FOREIGN KEY ("id_cid") REFERENCES "infolab_cid"("id_cid") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_medico" FOREIGN KEY ("id_medico") REFERENCES "infolab_medico"("id_medico") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_convenio_tiss" ADD CONSTRAINT "fk_convenio_tiss_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_especialidade_medica" ADD CONSTRAINT "fk_especialidade_medica_id_cbo" FOREIGN KEY ("id_cbo") REFERENCES "infolab_cbo"("id_cbo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_especialidade_medica" ADD CONSTRAINT "fk_especialidade_medica_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_etnia" ADD CONSTRAINT "fk_etnia_id_raca" FOREIGN KEY ("id_raca") REFERENCES "infolab_raca"("id_raca") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame" ADD CONSTRAINT "fk_exame_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_analisador" ADD CONSTRAINT "fk_exame_analisador_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_analisador" ADD CONSTRAINT "fk_exame_analisador_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_analisador" ADD CONSTRAINT "fk_exame_analisador_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_exame" FOREIGN KEY ("id_exame") REFERENCES "infolab_exame"("id_exame") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_material" FOREIGN KEY ("id_material") REFERENCES "infolab_material"("id_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_recipiente" FOREIGN KEY ("id_recipiente") REFERENCES "infolab_recipiente"("id_recipiente") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_setor" FOREIGN KEY ("id_setor") REFERENCES "infolab_setor"("id_setor") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material" ADD CONSTRAINT "fk_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo" ADD CONSTRAINT "fk_exame_material_campo_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo" ADD CONSTRAINT "fk_exame_material_campo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo" ADD CONSTRAINT "fk_exame_material_campo_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo" ADD CONSTRAINT "fk_exame_material_campo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_exame_material_campo" FOREIGN KEY ("id_exame_material_campo") REFERENCES "infolab_exame_material_campo"("id_exame_material_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_lab_apoio_unidade" FOREIGN KEY ("id_lab_apoio_unidade") REFERENCES "infolab_lab_apoio_unidade"("id_lab_apoio_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_ponto_interface" FOREIGN KEY ("id_ponto_interface") REFERENCES "infolab_ponto_interface"("id_ponto_interface") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_campo_limite" ADD CONSTRAINT "fk_exame_material_campo_limite_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_grupo" ADD CONSTRAINT "fk_exame_material_grupo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_grupo" ADD CONSTRAINT "fk_exame_material_grupo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_grupo_exame" ADD CONSTRAINT "fk_exame_material_grupo_exame_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_grupo_exame" ADD CONSTRAINT "fk_exame_material_grupo_exame_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_grupo_exame" ADD CONSTRAINT "fk_exame_material_grupo_exame_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_lab_apoio" ADD CONSTRAINT "fk_exame_material_lab_apoio_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_lab_apoio" ADD CONSTRAINT "fk_exame_material_lab_apoio_id_lab_apoio" FOREIGN KEY ("id_lab_apoio") REFERENCES "infolab_lab_apoio"("id_lab_apoio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_lab_apoio" ADD CONSTRAINT "fk_exame_material_lab_apoio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_lab_apoio" ADD CONSTRAINT "fk_exame_material_lab_apoio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_preco" ADD CONSTRAINT "fk_exame_material_preco_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_preco" ADD CONSTRAINT "fk_exame_material_preco_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_preco" ADD CONSTRAINT "fk_exame_material_preco_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_questionario" ADD CONSTRAINT "fk_exame_material_questionario_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_questionario" ADD CONSTRAINT "fk_exame_material_questionario_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_questionario" ADD CONSTRAINT "fk_exame_material_questionario_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_unidade" ADD CONSTRAINT "fk_exame_material_unidade_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_unidade" ADD CONSTRAINT "fk_exame_material_unidade_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_unidade" ADD CONSTRAINT "fk_exame_material_unidade_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_exame_material_unidade" ADD CONSTRAINT "fk_exame_material_unidade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura" ADD CONSTRAINT "fk_fatura_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura" ADD CONSTRAINT "fk_fatura_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura" ADD CONSTRAINT "fk_fatura_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura" ADD CONSTRAINT "fk_fatura_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_atendimento" FOREIGN KEY ("id_atendimento") REFERENCES "infolab_atendimento"("id_atendimento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_atendimento_exame_material" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_exame_material_pai" FOREIGN KEY ("id_exame_material_pai") REFERENCES "infolab_exame"("id_exame") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_fatura" FOREIGN KEY ("id_fatura") REFERENCES "infolab_fatura"("id_fatura") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_fatura_item" ADD CONSTRAINT "fk_fatura_item_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_feriado" ADD CONSTRAINT "fk_feriado_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_feriado" ADD CONSTRAINT "fk_feriado_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo" ADD CONSTRAINT "fk_grupo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo" ADD CONSTRAINT "fk_grupo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_cliente" ADD CONSTRAINT "fk_grupo_cliente_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_cliente" ADD CONSTRAINT "fk_grupo_cliente_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_exame_material" ADD CONSTRAINT "fk_grupo_exame_material_id_grupo" FOREIGN KEY ("id_grupo") REFERENCES "infolab_grupo"("id_grupo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_exame_material" ADD CONSTRAINT "fk_grupo_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_exame_material" ADD CONSTRAINT "fk_grupo_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_usuario" ADD CONSTRAINT "fk_grupo_usuario_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_grupo_usuario" ADD CONSTRAINT "fk_grupo_usuario_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_indicacao" ADD CONSTRAINT "fk_indicacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_indicacao" ADD CONSTRAINT "fk_indicacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao" ADD CONSTRAINT "fk_integracao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao" ADD CONSTRAINT "fk_integracao_id_tipo_integracao" FOREIGN KEY ("id_tipo_integracao") REFERENCES "infolab_tipo_integracao"("id_tipo_integracao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao" ADD CONSTRAINT "fk_integracao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_convenio" ADD CONSTRAINT "fk_integracao_convenio_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_convenio" ADD CONSTRAINT "fk_integracao_convenio_id_integracao" FOREIGN KEY ("id_integracao") REFERENCES "infolab_integracao"("id_integracao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_convenio" ADD CONSTRAINT "fk_integracao_convenio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_convenio" ADD CONSTRAINT "fk_integracao_convenio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_exame_material" ADD CONSTRAINT "fk_integracao_exame_material_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_exame_material" ADD CONSTRAINT "fk_integracao_exame_material_id_integracao" FOREIGN KEY ("id_integracao") REFERENCES "infolab_integracao"("id_integracao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_exame_material" ADD CONSTRAINT "fk_integracao_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_exame_material" ADD CONSTRAINT "fk_integracao_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_procedencia" ADD CONSTRAINT "fk_integracao_procedencia_id_integracao" FOREIGN KEY ("id_integracao") REFERENCES "infolab_integracao"("id_integracao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_procedencia" ADD CONSTRAINT "fk_integracao_procedencia_id_procedencia" FOREIGN KEY ("id_procedencia") REFERENCES "infolab_procedencia"("id_procedencia") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_procedencia" ADD CONSTRAINT "fk_integracao_procedencia_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_integracao_procedencia" ADD CONSTRAINT "fk_integracao_procedencia_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_interface_pacote" ADD CONSTRAINT "fk_interface_pacote_id_ponto_interfaceamento" FOREIGN KEY ("id_ponto_interfaceamento") REFERENCES "infolab_ponto_interface"("id_ponto_interface") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_interface_pacote" ADD CONSTRAINT "fk_interface_pacote_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_interface_pacote" ADD CONSTRAINT "fk_interface_pacote_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lab_apoio" ADD CONSTRAINT "fk_lab_apoio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lab_apoio_unidade" ADD CONSTRAINT "fk_lab_apoio_unidade_id_lab_apoio" FOREIGN KEY ("id_lab_apoio") REFERENCES "infolab_lab_apoio"("id_lab_apoio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lab_apoio_unidade" ADD CONSTRAINT "fk_lab_apoio_unidade_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lab_apoio_unidade" ADD CONSTRAINT "fk_lab_apoio_unidade_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lab_apoio_unidade" ADD CONSTRAINT "fk_lab_apoio_unidade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_local_armazenamento" ADD CONSTRAINT "fk_local_armazenamento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_local_armazenamento" ADD CONSTRAINT "fk_local_armazenamento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_amostra" FOREIGN KEY ("id_amostra") REFERENCES "infolab_atendimento_amostra"("id_atendimento_amostra") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_atendimento" FOREIGN KEY ("id_atendimento") REFERENCES "infolab_atendimento"("id_atendimento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_lab_apoio" FOREIGN KEY ("id_lab_apoio") REFERENCES "infolab_lab_apoio"("id_lab_apoio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_lote_b2b_apoio" ADD CONSTRAINT "fk_lote_b2b_apoio_id_usuario_conferencia" FOREIGN KEY ("id_usuario_conferencia") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa" ADD CONSTRAINT "fk_mapa_id_mapa_definicao" FOREIGN KEY ("id_mapa_definicao") REFERENCES "infolab_mapa_definicao"("id_mapa_definicao") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa" ADD CONSTRAINT "fk_mapa_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa" ADD CONSTRAINT "fk_mapa_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa" ADD CONSTRAINT "fk_mapa_id_usuario_emissao" FOREIGN KEY ("id_usuario_emissao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_atendimento_exame_material" ADD CONSTRAINT "fk_mapa_atendimento_exame_material_id_atendimento_exame_materia" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_atendimento_exame_material" ADD CONSTRAINT "fk_mapa_atendimento_exame_material_id_mapa" FOREIGN KEY ("id_mapa") REFERENCES "infolab_mapa"("id_mapa") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_atendimento_exame_material" ADD CONSTRAINT "fk_mapa_atendimento_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_atendimento_exame_material" ADD CONSTRAINT "fk_mapa_atendimento_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_definicao" ADD CONSTRAINT "fk_mapa_definicao_id_relatorio" FOREIGN KEY ("id_relatorio") REFERENCES "infolab_relatorio"("id_relatorio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_definicao" ADD CONSTRAINT "fk_mapa_definicao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_definicao" ADD CONSTRAINT "fk_mapa_definicao_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_definicao" ADD CONSTRAINT "fk_mapa_definicao_id_usuario" FOREIGN KEY ("id_usuario") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_mapa_definicao" ADD CONSTRAINT "fk_mapa_definicao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_material" ADD CONSTRAINT "fk_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_material" ADD CONSTRAINT "fk_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medicamento" ADD CONSTRAINT "fk_medicamento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medicamento" ADD CONSTRAINT "fk_medicamento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico" ADD CONSTRAINT "fk_medico_id_conselho_regional" FOREIGN KEY ("id_conselho_regional") REFERENCES "infolab_conselho_regional"("id_conselho_regional") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico" ADD CONSTRAINT "fk_medico_id_especialidade_medica" FOREIGN KEY ("id_especialidade_medica") REFERENCES "infolab_especialidade_medica"("id_especialidade_medica") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico" ADD CONSTRAINT "fk_medico_id_medico_credencial_convenio" FOREIGN KEY ("id_medico_credencial_convenio") REFERENCES "infolab_medico_credencial_convenio"("id_medico_credencial_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico" ADD CONSTRAINT "fk_medico_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico" ADD CONSTRAINT "fk_medico_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico_credencial_convenio" ADD CONSTRAINT "fk_medico_credencial_convenio_id_convenio" FOREIGN KEY ("id_convenio") REFERENCES "infolab_convenio"("id_convenio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico_credencial_convenio" ADD CONSTRAINT "fk_medico_credencial_convenio_id_medico" FOREIGN KEY ("id_medico") REFERENCES "infolab_medico"("id_medico") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico_credencial_convenio" ADD CONSTRAINT "fk_medico_credencial_convenio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_medico_credencial_convenio" ADD CONSTRAINT "fk_medico_credencial_convenio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_exame_material_campo" FOREIGN KEY ("id_exame_material_campo") REFERENCES "infolab_exame_material_campo"("id_exame_material_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_lab_apoio_unidade" FOREIGN KEY ("id_laboratorio_apoio_unidade") REFERENCES "infolab_lab_apoio_unidade"("id_lab_apoio_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_ponto_interface" FOREIGN KEY ("id_ponto_interface") REFERENCES "infolab_ponto_interface"("id_ponto_interface") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_vet_especie" FOREIGN KEY ("id_vet_especie") REFERENCES "infolab_vet_especie"("id_vet_especie") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_modelo_resultado" ADD CONSTRAINT "fk_modelo_resultado_id_vet_raca" FOREIGN KEY ("id_vet_raca") REFERENCES "infolab_vet_raca"("id_vet_raca") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_cancelamento" ADD CONSTRAINT "fk_motivo_cancelamento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_cancelamento" ADD CONSTRAINT "fk_motivo_cancelamento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_desconto" ADD CONSTRAINT "fk_motivo_desconto_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_desconto" ADD CONSTRAINT "fk_motivo_desconto_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_exame_retificacao" ADD CONSTRAINT "fk_motivo_exame_retificacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_exame_retificacao" ADD CONSTRAINT "fk_motivo_exame_retificacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_orcamento_rejeicao" ADD CONSTRAINT "fk_motivo_orcamento_rejeicao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_orcamento_rejeicao" ADD CONSTRAINT "fk_motivo_orcamento_rejeicao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_quarentena" ADD CONSTRAINT "fk_motivo_quarentena_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_quarentena" ADD CONSTRAINT "fk_motivo_quarentena_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_recoleta" ADD CONSTRAINT "fk_motivo_recoleta_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_recoleta" ADD CONSTRAINT "fk_motivo_recoleta_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_retificacao" ADD CONSTRAINT "fk_motivo_retificacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_motivo_retificacao" ADD CONSTRAINT "fk_motivo_retificacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_atendimento" FOREIGN KEY ("id_atendimento") REFERENCES "infolab_atendimento"("id_atendimento") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_cliente" FOREIGN KEY ("id_cliente") REFERENCES "infolab_cliente"("id_cliente") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_convenio_1" FOREIGN KEY ("id_convenio_1") REFERENCES "infolab_convenio"("id_convenio") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_convenio_2" FOREIGN KEY ("id_convenio_2") REFERENCES "infolab_convenio"("id_convenio") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_convenio_3" FOREIGN KEY ("id_convenio_3") REFERENCES "infolab_convenio"("id_convenio") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_convenio_4" FOREIGN KEY ("id_convenio_4") REFERENCES "infolab_convenio"("id_convenio") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_convenio_5" FOREIGN KEY ("id_convenio_5") REFERENCES "infolab_convenio"("id_convenio") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_medico" FOREIGN KEY ("id_medico") REFERENCES "infolab_medico"("id_medico") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_motivo_orcamento_rejeicao" FOREIGN KEY ("id_motivo_orcamento_rejeicao") REFERENCES "infolab_motivo_orcamento_rejeicao"("id_motivo_orcamento_rejeicao") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_procedencia" FOREIGN KEY ("id_procedencia") REFERENCES "infolab_procedencia"("id_procedencia") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_tipo_indicacao" FOREIGN KEY ("id_tipo_indicacao") REFERENCES "infolab_tipo_indicacao"("id_tipo_indicacao") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_usuario_cancelamento" FOREIGN KEY ("id_usuario_cancelamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_usuario_fechamento" FOREIGN KEY ("id_usuario_fechamento") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_usuario_inclusao" FOREIGN KEY ("id_usuario_inclusao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento" ADD CONSTRAINT "fk_infolab_orcamento_infolab_usuario_rejeicao" FOREIGN KEY ("id_usuario_rejeicao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_orcamento_exame_material" ADD CONSTRAINT "fk_orcamento_exame_material_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_orcamento_exame_material" ADD CONSTRAINT "fk_orcamento_exame_material_id_orcamento" FOREIGN KEY ("id_orcamento") REFERENCES "infolab_orcamento"("id_orcamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_orcamento_exame_material" ADD CONSTRAINT "fk_orcamento_exame_material_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_orcamento_exame_material" ADD CONSTRAINT "fk_orcamento_exame_material_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_parametro_valor" ADD CONSTRAINT "fk_parametro_valor_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_analisador" FOREIGN KEY ("id_analisador") REFERENCES "infolab_analisador"("id_analisador") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_computador" FOREIGN KEY ("id_computador") REFERENCES "infolab_computador"("id_computador") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_tipo_interface" FOREIGN KEY ("id_tipo_interface") REFERENCES "infolab_tipo_interface"("id_tipo_interface") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_usuario_coleta" FOREIGN KEY ("id_usuario_coleta") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_interface" ADD CONSTRAINT "fk_ponto_interface_id_usuario_liberacao_automatica" FOREIGN KEY ("id_usuario_liberacao_automatica") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_programacao" ADD CONSTRAINT "fk_ponto_programacao_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_programacao" ADD CONSTRAINT "fk_ponto_programacao_id_ponto_interface" FOREIGN KEY ("id_ponto_interface") REFERENCES "infolab_ponto_interface"("id_ponto_interface") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_programacao" ADD CONSTRAINT "fk_ponto_programacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_ponto_programacao" ADD CONSTRAINT "fk_ponto_programacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_porta_serial" ADD CONSTRAINT "fk_porta_serial_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_exame" ADD CONSTRAINT "fk_preco_exame_id_exame_material" FOREIGN KEY ("id_exame_material") REFERENCES "infolab_exame_material"("id_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_exame" ADD CONSTRAINT "fk_preco_exame_id_preco_tabela" FOREIGN KEY ("id_preco_tabela") REFERENCES "infolab_preco_tabela"("id_preco_tabela") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_exame" ADD CONSTRAINT "fk_preco_exame_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_exame" ADD CONSTRAINT "fk_preco_exame_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_fator" ADD CONSTRAINT "fk_preco_fator_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_fator" ADD CONSTRAINT "fk_preco_fator_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_tabela" ADD CONSTRAINT "fk_preco_tabela_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_preco_tabela" ADD CONSTRAINT "fk_preco_tabela_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_procedencia" ADD CONSTRAINT "fk_infolab_procedencia_infolab_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_procedencia" ADD CONSTRAINT "fk_procedencia_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario" ADD CONSTRAINT "fk_questionario_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario" ADD CONSTRAINT "fk_questionario_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo" ADD CONSTRAINT "fk_questionario_campo_id_questionario" FOREIGN KEY ("id_questionario") REFERENCES "infolab_questionario"("id_questionario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo" ADD CONSTRAINT "fk_questionario_campo_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo" ADD CONSTRAINT "fk_questionario_campo_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_resposta" ADD CONSTRAINT "fk_questionario_campo_resposta_id_questionario_campo" FOREIGN KEY ("id_questionario_campo") REFERENCES "infolab_questionario_campo"("id_questionario_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_resposta" ADD CONSTRAINT "fk_questionario_campo_resposta_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_resposta" ADD CONSTRAINT "fk_questionario_campo_resposta_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_valor" ADD CONSTRAINT "fk_questionario_campo_valor_id_questionario_campo" FOREIGN KEY ("id_questionario_campo") REFERENCES "infolab_questionario_campo"("id_questionario_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_valor" ADD CONSTRAINT "fk_questionario_campo_valor_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_questionario_campo_valor" ADD CONSTRAINT "fk_questionario_campo_valor_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_raca" ADD CONSTRAINT "fk_raca_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_recipiente" ADD CONSTRAINT "fk_recipiente_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_recipiente" ADD CONSTRAINT "fk_recipiente_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_relatorio" ADD CONSTRAINT "fk_relatorio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_relatorio" ADD CONSTRAINT "fk_relatorio_id_tipo_relatorio" FOREIGN KEY ("id_tipo_relatorio") REFERENCES "infolab_tipo_relatorio"("id_tipo_relatorio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_relatorio" ADD CONSTRAINT "fk_relatorio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado" ADD CONSTRAINT "fk_resultado_id_atendimento_exame_material" FOREIGN KEY ("id_atendimento_exame_material") REFERENCES "infolab_atendimento_exame_material"("id_atendimento_exame_material") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado" ADD CONSTRAINT "fk_resultado_id_exame_material_campo" FOREIGN KEY ("id_exame_material_campo") REFERENCES "infolab_exame_material_campo"("id_exame_material_campo") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado" ADD CONSTRAINT "fk_resultado_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado" ADD CONSTRAINT "fk_resultado_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado_tabela" ADD CONSTRAINT "fk_resultado_tabela_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado_tabela" ADD CONSTRAINT "fk_resultado_tabela_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado_tabela_valor" ADD CONSTRAINT "fk_resultado_tabela_valor_id_resultado_tabela" FOREIGN KEY ("id_resultado_tabela") REFERENCES "infolab_resultado_tabela"("id_resultado_tabela") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado_tabela_valor" ADD CONSTRAINT "fk_resultado_tabela_valor_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_resultado_tabela_valor" ADD CONSTRAINT "fk_resultado_tabela_valor_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_setor" ADD CONSTRAINT "fk_setor_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_setor" ADD CONSTRAINT "fk_setor_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade" ADD CONSTRAINT "fk_soroteca_grade_id_local_armazenamento" FOREIGN KEY ("id_local_armazenamento") REFERENCES "infolab_local_armazenamento"("id_local_armazenamento") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade" ADD CONSTRAINT "fk_soroteca_grade_id_setor" FOREIGN KEY ("id_setor") REFERENCES "infolab_setor"("id_setor") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade" ADD CONSTRAINT "fk_soroteca_grade_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade" ADD CONSTRAINT "fk_soroteca_grade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade" ADD CONSTRAINT "fk_soroteca_grade_id_usuario_inclusao" FOREIGN KEY ("id_usuario_inclusao") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_soroteca_grade_poco_historico" ADD CONSTRAINT "fk_soroteca_grade_poco_historico_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tenacidade_configuracao" ADD CONSTRAINT "fk_infolab_tenacidade_configuracao_infolab_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_tipo_aplicacao" ADD CONSTRAINT "fk_tipo_aplicacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_destino_resultado" ADD CONSTRAINT "fk_tipo_destino_resultado_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_estado_civil" ADD CONSTRAINT "fk_tipo_estado_civil_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_evento" ADD CONSTRAINT "fk_tipo_evento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_indicacao" ADD CONSTRAINT "fk_tipo_indicacao_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_indicacao" ADD CONSTRAINT "fk_tipo_indicacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_integracao" ADD CONSTRAINT "fk_tipo_integracao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_interface" ADD CONSTRAINT "fk_tipo_interface_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_pagamento" ADD CONSTRAINT "fk_tipo_pagamento_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_pagamento" ADD CONSTRAINT "fk_tipo_pagamento_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_tipo_relatorio" ADD CONSTRAINT "fk_tipo_relatorio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade" ADD CONSTRAINT "fk_unidade_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade" ADD CONSTRAINT "fk_unidade_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_email" ADD CONSTRAINT "fk_unidade_email_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_email" ADD CONSTRAINT "fk_unidade_email_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_email" ADD CONSTRAINT "fk_unidade_email_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_federacao" ADD CONSTRAINT "fk_unidade_federacao_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_relatorio" ADD CONSTRAINT "fk_unidade_relatorio_id_relatorio" FOREIGN KEY ("id_relatorio") REFERENCES "infolab_relatorio"("id_relatorio") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_relatorio" ADD CONSTRAINT "fk_unidade_relatorio_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_relatorio" ADD CONSTRAINT "fk_unidade_relatorio_id_unidade" FOREIGN KEY ("id_unidade") REFERENCES "infolab_unidade"("id_unidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_unidade_relatorio" ADD CONSTRAINT "fk_unidade_relatorio_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_versao_tiss" ADD CONSTRAINT "fk_versao_tiss_id_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_versao_tiss" ADD CONSTRAINT "fk_versao_tiss_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_vet_especie" ADD CONSTRAINT "fk_vet_especie_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_vet_raca" ADD CONSTRAINT "fk_vet_raca_id_usuario_auditoria" FOREIGN KEY ("id_usuario_auditoria") REFERENCES "infolab_usuario"("id_usuario") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_vet_raca" ADD CONSTRAINT "fk_vet_raca_id_vet_especie" FOREIGN KEY ("id_vet_especie") REFERENCES "infolab_vet_especie"("id_vet_especie") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- AddForeignKey
ALTER TABLE "infolab_sessao_usuario" ADD CONSTRAINT "fk_sessao_tenacidade" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_sessao_usuario" ADD CONSTRAINT "fk_sessao_usuario" FOREIGN KEY ("id_usuario") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_sessao_suporte" ADD CONSTRAINT "infolab_sessao_suporte_id_tenacidade_fkey" FOREIGN KEY ("id_tenacidade") REFERENCES "infolab_tenacidade"("id_tenacidade") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_sessao_suporte" ADD CONSTRAINT "infolab_sessao_suporte_id_usuario_fkey" FOREIGN KEY ("id_usuario") REFERENCES "infolab_usuario"("id_usuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- AddForeignKey
ALTER TABLE "infolab_layout_formulario" ADD CONSTRAINT "infolab_layout_formulario_id_formulario_fkey" FOREIGN KEY ("id_formulario") REFERENCES "infolab_formulario"("id_formulario") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "infolab_layout_formulario" ADD CONSTRAINT "infolab_layout_formulario_id_usuario_fkey" FOREIGN KEY ("id_usuario") REFERENCES "infolab_usuario"("id_usuario") ON DELETE CASCADE ON UPDATE CASCADE;
