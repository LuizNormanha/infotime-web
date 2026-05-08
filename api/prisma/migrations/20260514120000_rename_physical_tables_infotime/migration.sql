-- Renomeia tabelas físicas do InfoTIME ERP para o prefixo infotime_* (alinhado a docs/liga_infotime_postgres.sql).
-- Mapa: docs/ddl/table-rename-map.json (gerado por scripts/ddl/build-table-rename-map.mjs).
-- Aplicação coordenada com atualização dos @@map no schema Prisma e SQL raw na API.
--
-- Ondas A/B são apenas organização dentro da mesma transação (evita estado intermediário quebrado).

BEGIN;

-- ========== Wave A: demais tabelas (211) ==========
ALTER TABLE IF EXISTS public.agencia RENAME TO infotime_agencia;
ALTER TABLE IF EXISTS public.agenda RENAME TO infotime_agenda;
ALTER TABLE IF EXISTS public.agenda_evento RENAME TO infotime_agenda_evento;
ALTER TABLE IF EXISTS public.agenda_usuario RENAME TO infotime_agenda_usuario;
ALTER TABLE IF EXISTS public.almoxarifado RENAME TO infotime_almoxarifado;
ALTER TABLE IF EXISTS public.almoxarifado_baixa RENAME TO infotime_almoxarifado_baixa;
ALTER TABLE IF EXISTS public.almoxarifado_baixa_produto RENAME TO infotime_almoxarifado_baixa_produto;
ALTER TABLE IF EXISTS public.almoxarifado_entrada RENAME TO infotime_almoxarifado_entrada;
ALTER TABLE IF EXISTS public.almoxarifado_entrada_parcela RENAME TO infotime_almoxarifado_entrada_parcela;
ALTER TABLE IF EXISTS public.almoxarifado_entrada_parcela_rateio RENAME TO infotime_almoxarifado_entrada_parcela_rateio;
ALTER TABLE IF EXISTS public.almoxarifado_entrada_produto RENAME TO infotime_almoxarifado_entrada_produto;
ALTER TABLE IF EXISTS public.almoxarifado_importacao_xml RENAME TO infotime_almoxarifado_importacao_xml;
ALTER TABLE IF EXISTS public.almoxarifado_motivo_baixa RENAME TO infotime_almoxarifado_motivo_baixa;
ALTER TABLE IF EXISTS public.almoxarifado_produto RENAME TO infotime_almoxarifado_produto;
ALTER TABLE IF EXISTS public.almoxarifado_produto_classificacao RENAME TO infotime_almoxarifado_produto_classificacao;
ALTER TABLE IF EXISTS public.almoxarifado_produto_estoque RENAME TO infotime_almoxarifado_produto_estoque;
ALTER TABLE IF EXISTS public.almoxarifado_produto_grupo RENAME TO infotime_almoxarifado_produto_grupo;
ALTER TABLE IF EXISTS public.almoxarifado_produto_local_armazenamento RENAME TO infotime_almoxarifado_produto_local_armazenamento;
ALTER TABLE IF EXISTS public.almoxarifado_produto_volume RENAME TO infotime_almoxarifado_produto_volume;
ALTER TABLE IF EXISTS public.almoxarifado_requisicao RENAME TO infotime_almoxarifado_requisicao;
ALTER TABLE IF EXISTS public.almoxarifado_requisicao_produto RENAME TO infotime_almoxarifado_requisicao_produto;
ALTER TABLE IF EXISTS public.almoxarifado_usuario_atender RENAME TO infotime_almoxarifado_usuario_atender;
ALTER TABLE IF EXISTS public.aplicacao_sync RENAME TO infotime_aplicacao_sync;
ALTER TABLE IF EXISTS public.auditoria RENAME TO infotime_auditoria;
ALTER TABLE IF EXISTS public.auditoria_campo RENAME TO infotime_auditoria_campo;
ALTER TABLE IF EXISTS public.avaliacao RENAME TO infotime_avaliacao;
ALTER TABLE IF EXISTS public.banco RENAME TO infotime_banco;
ALTER TABLE IF EXISTS public.bandeira_cartao RENAME TO infotime_bandeira_cartao;
ALTER TABLE IF EXISTS public.boleto RENAME TO infotime_boleto;
ALTER TABLE IF EXISTS public.boleto_nota_fiscal RENAME TO infotime_boleto_nota_fiscal;
ALTER TABLE IF EXISTS public.calendario RENAME TO infotime_calendario;
ALTER TABLE IF EXISTS public.cargo RENAME TO infotime_cargo;
ALTER TABLE IF EXISTS public.cargo_classificacao RENAME TO infotime_cargo_classificacao;
ALTER TABLE IF EXISTS public.cargo_classificacao_nivel RENAME TO infotime_cargo_classificacao_nivel;
ALTER TABLE IF EXISTS public.cargo_classificacao_nivel_salario RENAME TO infotime_cargo_classificacao_nivel_salario;
ALTER TABLE IF EXISTS public.categoria_produto RENAME TO infotime_categoria_produto;
ALTER TABLE IF EXISTS public.categoria_produto_tarefa RENAME TO infotime_categoria_produto_tarefa;
ALTER TABLE IF EXISTS public.cbo RENAME TO infotime_cbo;
ALTER TABLE IF EXISTS public.centro_custo RENAME TO infotime_centro_custo;
ALTER TABLE IF EXISTS public.centro_custo_vigencia RENAME TO infotime_centro_custo_vigencia;
ALTER TABLE IF EXISTS public.cheque RENAME TO infotime_cheque;
ALTER TABLE IF EXISTS public.cid10 RENAME TO infotime_cid10;
ALTER TABLE IF EXISTS public.cliente RENAME TO infotime_cliente;
ALTER TABLE IF EXISTS public.cliente_aluno RENAME TO infotime_cliente_aluno;
ALTER TABLE IF EXISTS public.cliente_canal RENAME TO infotime_cliente_canal;
ALTER TABLE IF EXISTS public.cliente_comunicacao RENAME TO infotime_cliente_comunicacao;
ALTER TABLE IF EXISTS public.cliente_contato RENAME TO infotime_cliente_contato;
ALTER TABLE IF EXISTS public.cliente_documento RENAME TO infotime_cliente_documento;
ALTER TABLE IF EXISTS public.cliente_equipamento RENAME TO infotime_cliente_equipamento;
ALTER TABLE IF EXISTS public.cliente_equipamento_acessorio RENAME TO infotime_cliente_equipamento_acessorio;
ALTER TABLE IF EXISTS public.cliente_equipamento_chamado RENAME TO infotime_cliente_equipamento_chamado;
ALTER TABLE IF EXISTS public.cliente_equipamento_peca_troca RENAME TO infotime_cliente_equipamento_peca_troca;
ALTER TABLE IF EXISTS public.cliente_equipamento_servico RENAME TO infotime_cliente_equipamento_servico;
ALTER TABLE IF EXISTS public.cliente_plano_conta RENAME TO infotime_cliente_plano_conta;
ALTER TABLE IF EXISTS public.cliente_plano_conta_legacy RENAME TO infotime_cliente_plano_conta_legacy;
ALTER TABLE IF EXISTS public.cliente_senha RENAME TO infotime_cliente_senha;
ALTER TABLE IF EXISTS public.cliente_telefone RENAME TO infotime_cliente_telefone;
ALTER TABLE IF EXISTS public.colaborador RENAME TO infotime_colaborador;
ALTER TABLE IF EXISTS public.colaborador_atestado RENAME TO infotime_colaborador_atestado;
ALTER TABLE IF EXISTS public.colaborador_avaliacao RENAME TO infotime_colaborador_avaliacao;
ALTER TABLE IF EXISTS public.colaborador_comp_rendimento RENAME TO infotime_colaborador_comp_rendimento;
ALTER TABLE IF EXISTS public.colaborador_comunicacao RENAME TO infotime_colaborador_comunicacao;
ALTER TABLE IF EXISTS public.colaborador_contra_cheque RENAME TO infotime_colaborador_contra_cheque;
ALTER TABLE IF EXISTS public.colaborador_documento RENAME TO infotime_colaborador_documento;
ALTER TABLE IF EXISTS public.colaborador_exame RENAME TO infotime_colaborador_exame;
ALTER TABLE IF EXISTS public.colaborador_ferias RENAME TO infotime_colaborador_ferias;
ALTER TABLE IF EXISTS public.colaborador_ferias_gozadas RENAME TO infotime_colaborador_ferias_gozadas;
ALTER TABLE IF EXISTS public.colaborador_folha_ponto RENAME TO infotime_colaborador_folha_ponto;
ALTER TABLE IF EXISTS public.colaborador_medida_disciplinar RENAME TO infotime_colaborador_medida_disciplinar;
ALTER TABLE IF EXISTS public.colaborador_plano_conta RENAME TO infotime_colaborador_plano_conta;
ALTER TABLE IF EXISTS public.colaborador_reajuste RENAME TO infotime_colaborador_reajuste;
ALTER TABLE IF EXISTS public.colaborador_salario_adiantamento RENAME TO infotime_colaborador_salario_adiantamento;
ALTER TABLE IF EXISTS public.colaborador_tarefa RENAME TO infotime_colaborador_tarefa;
ALTER TABLE IF EXISTS public.colaborador_tarefa_historico RENAME TO infotime_colaborador_tarefa_historico;
ALTER TABLE IF EXISTS public.colaborador_tarefa_legacy RENAME TO infotime_colaborador_tarefa_legacy;
ALTER TABLE IF EXISTS public.colaborador_tarefa_motivo_prorrogacao RENAME TO infotime_colaborador_tarefa_motivo_prorrogacao;
ALTER TABLE IF EXISTS public.colaborador_tarifa RENAME TO infotime_colaborador_tarifa;
ALTER TABLE IF EXISTS public.colaborador_telefone RENAME TO infotime_colaborador_telefone;
ALTER TABLE IF EXISTS public.colaborador_vale_alimentacao_transporte RENAME TO infotime_colaborador_vale_alimentacao_transporte;
ALTER TABLE IF EXISTS public.colaborador_viagem RENAME TO infotime_colaborador_viagem;
ALTER TABLE IF EXISTS public.colaborador_viagem_adiantamento RENAME TO infotime_colaborador_viagem_adiantamento;
ALTER TABLE IF EXISTS public.colaborador_viagem_despesa RENAME TO infotime_colaborador_viagem_despesa;
ALTER TABLE IF EXISTS public.coleta_domiciliar RENAME TO infotime_coleta_domiciliar;
ALTER TABLE IF EXISTS public.comunicacao RENAME TO infotime_comunicacao;
ALTER TABLE IF EXISTS public.concorrente RENAME TO infotime_concorrente;
ALTER TABLE IF EXISTS public.configuracao RENAME TO infotime_configuracao;
ALTER TABLE IF EXISTS public.configuracao_cobranca RENAME TO infotime_configuracao_cobranca;
ALTER TABLE IF EXISTS public.consumo RENAME TO infotime_consumo;
ALTER TABLE IF EXISTS public.consumo_item RENAME TO infotime_consumo_item;
ALTER TABLE IF EXISTS public.conta_caixa RENAME TO infotime_conta_caixa;
ALTER TABLE IF EXISTS public.conta_caixa_documento RENAME TO infotime_conta_caixa_documento;
ALTER TABLE IF EXISTS public.conta_caixa_registro RENAME TO infotime_conta_caixa_registro;
ALTER TABLE IF EXISTS public.conta_caixa_registro_lancamento RENAME TO infotime_conta_caixa_registro_lancamento;
ALTER TABLE IF EXISTS public.conta_caixa_senha RENAME TO infotime_conta_caixa_senha;
ALTER TABLE IF EXISTS public.conta_caixa_transferencia RENAME TO infotime_conta_caixa_transferencia;
ALTER TABLE IF EXISTS public.conta_caixa_usuario RENAME TO infotime_conta_caixa_usuario;
ALTER TABLE IF EXISTS public.conta_telefone RENAME TO infotime_conta_telefone;
ALTER TABLE IF EXISTS public.contrato RENAME TO infotime_contrato;
ALTER TABLE IF EXISTS public.contrato_item RENAME TO infotime_contrato_item;
ALTER TABLE IF EXISTS public.contrato_tarefa RENAME TO infotime_contrato_tarefa;
ALTER TABLE IF EXISTS public.contrato_tarefa_atividade RENAME TO infotime_contrato_tarefa_atividade;
ALTER TABLE IF EXISTS public.email_enviado RENAME TO infotime_email_enviado;
ALTER TABLE IF EXISTS public.email_modelo RENAME TO infotime_email_modelo;
ALTER TABLE IF EXISTS public.empresa RENAME TO infotime_empresa;
ALTER TABLE IF EXISTS public.empresa_documento RENAME TO infotime_empresa_documento;
ALTER TABLE IF EXISTS public.empresa_nota_fiscal RENAME TO infotime_empresa_nota_fiscal;
ALTER TABLE IF EXISTS public.empresa_operadora RENAME TO infotime_empresa_operadora;
ALTER TABLE IF EXISTS public.empresa_senha RENAME TO infotime_empresa_senha;
ALTER TABLE IF EXISTS public.extrato_conta RENAME TO infotime_extrato_conta;
ALTER TABLE IF EXISTS public.fatura RENAME TO infotime_fatura;
ALTER TABLE IF EXISTS public.fatura_item RENAME TO infotime_fatura_item;
ALTER TABLE IF EXISTS public.fechamento_financeiro RENAME TO infotime_fechamento_financeiro;
ALTER TABLE IF EXISTS public.feriado RENAME TO infotime_feriado;
ALTER TABLE IF EXISTS public.fluxo_caixa RENAME TO infotime_fluxo_caixa;
ALTER TABLE IF EXISTS public.fornecedor RENAME TO infotime_fornecedor;
ALTER TABLE IF EXISTS public.fornecedor_comunicacao RENAME TO infotime_fornecedor_comunicacao;
ALTER TABLE IF EXISTS public.fornecedor_contato RENAME TO infotime_fornecedor_contato;
ALTER TABLE IF EXISTS public.fornecedor_documento RENAME TO infotime_fornecedor_documento;
ALTER TABLE IF EXISTS public.fornecedor_plano_conta RENAME TO infotime_fornecedor_plano_conta;
ALTER TABLE IF EXISTS public.grupo_documento RENAME TO infotime_grupo_documento;
ALTER TABLE IF EXISTS public.grupo_usuario_aplicacao RENAME TO infotime_grupo_usuario_aplicacao;
ALTER TABLE IF EXISTS public.grupo_usuario_aplicacao_bloco RENAME TO infotime_grupo_usuario_aplicacao_bloco;
ALTER TABLE IF EXISTS public.grupo_usuario_aplicacao_campo RENAME TO infotime_grupo_usuario_aplicacao_campo;
ALTER TABLE IF EXISTS public.indice_reajuste RENAME TO infotime_indice_reajuste;
ALTER TABLE IF EXISTS public.indice_reajuste_data RENAME TO infotime_indice_reajuste_data;
ALTER TABLE IF EXISTS public.info_lab_acesso RENAME TO infotime_info_lab_acesso;
ALTER TABLE IF EXISTS public.info_lab_noticias RENAME TO infotime_info_lab_noticias;
ALTER TABLE IF EXISTS public.infolab_temperatura_opcao RENAME TO infotime_temperatura_opcao;
ALTER TABLE IF EXISTS public.lancamento_despesa RENAME TO infotime_lancamento_despesa;
ALTER TABLE IF EXISTS public.lancamento_despesa_rateio RENAME TO infotime_lancamento_despesa_rateio;
ALTER TABLE IF EXISTS public.lancamento_receita RENAME TO infotime_lancamento_receita;
ALTER TABLE IF EXISTS public.lancamento_receita_rateio RENAME TO infotime_lancamento_receita_rateio;
ALTER TABLE IF EXISTS public.mensagem_padrao RENAME TO infotime_mensagem_padrao;
ALTER TABLE IF EXISTS public.municipio RENAME TO infotime_municipio;
ALTER TABLE IF EXISTS public.negociacao RENAME TO infotime_negociacao;
ALTER TABLE IF EXISTS public.negociacao_motivo_perda RENAME TO infotime_negociacao_motivo_perda;
ALTER TABLE IF EXISTS public.negociacao_proposta_fase RENAME TO infotime_negociacao_proposta_fase;
ALTER TABLE IF EXISTS public.negociacao_tarefa RENAME TO infotime_negociacao_tarefa;
ALTER TABLE IF EXISTS public.nota_fiscal RENAME TO infotime_nota_fiscal;
ALTER TABLE IF EXISTS public.operadora RENAME TO infotime_operadora;
ALTER TABLE IF EXISTS public.patrimonio_bem RENAME TO infotime_patrimonio_bem;
ALTER TABLE IF EXISTS public.patrimonio_bem_atualizacao RENAME TO infotime_patrimonio_bem_atualizacao;
ALTER TABLE IF EXISTS public.patrimonio_bem_evento RENAME TO infotime_patrimonio_bem_evento;
ALTER TABLE IF EXISTS public.patrimonio_bem_foto RENAME TO infotime_patrimonio_bem_foto;
ALTER TABLE IF EXISTS public.patrimonio_categoria RENAME TO infotime_patrimonio_categoria;
ALTER TABLE IF EXISTS public.patrimonio_estado RENAME TO infotime_patrimonio_estado;
ALTER TABLE IF EXISTS public.patrimonio_localizacao RENAME TO infotime_patrimonio_localizacao;
ALTER TABLE IF EXISTS public.pessoa RENAME TO infotime_pessoa;
ALTER TABLE IF EXISTS public.plano_conta RENAME TO infotime_plano_conta;
ALTER TABLE IF EXISTS public.pop_documento RENAME TO infotime_pop_documento;
ALTER TABLE IF EXISTS public.processamento RENAME TO infotime_processamento;
ALTER TABLE IF EXISTS public.produto RENAME TO infotime_produto;
ALTER TABLE IF EXISTS public.proposta RENAME TO infotime_proposta;
ALTER TABLE IF EXISTS public.proposta_andamento RENAME TO infotime_proposta_andamento;
ALTER TABLE IF EXISTS public.proposta_dimensao RENAME TO infotime_proposta_dimensao;
ALTER TABLE IF EXISTS public.proposta_fase RENAME TO infotime_proposta_fase;
ALTER TABLE IF EXISTS public.proposta_item RENAME TO infotime_proposta_item;
ALTER TABLE IF EXISTS public.regiao_estadual RENAME TO infotime_regiao_estadual;
ALTER TABLE IF EXISTS public.retorno RENAME TO infotime_retorno;
ALTER TABLE IF EXISTS public.retorno_api_pix RENAME TO infotime_retorno_api_pix;
ALTER TABLE IF EXISTS public.site_acesso RENAME TO infotime_site_acesso;
ALTER TABLE IF EXISTS public.site_contato RENAME TO infotime_site_contato;
ALTER TABLE IF EXISTS public.site_setor_laboratorio RENAME TO infotime_site_setor_laboratorio;
ALTER TABLE IF EXISTS public.site_tipo_assunto RENAME TO infotime_site_tipo_assunto;
ALTER TABLE IF EXISTS public.site_trabalhe_conosco RENAME TO infotime_site_trabalhe_conosco;
ALTER TABLE IF EXISTS public.situacao_atividade RENAME TO infotime_situacao_atividade;
ALTER TABLE IF EXISTS public.situacao_cliente RENAME TO infotime_situacao_cliente;
ALTER TABLE IF EXISTS public.situacao_colaborador RENAME TO infotime_situacao_colaborador;
ALTER TABLE IF EXISTS public.situacao_documento RENAME TO infotime_situacao_documento;
ALTER TABLE IF EXISTS public.situacao_fase RENAME TO infotime_situacao_fase;
ALTER TABLE IF EXISTS public.situacao_fornecedor RENAME TO infotime_situacao_fornecedor;
ALTER TABLE IF EXISTS public.situacao_tarefa RENAME TO infotime_situacao_tarefa;
ALTER TABLE IF EXISTS public.situacao_tarefa_implantacao RENAME TO infotime_situacao_tarefa_implantacao;
ALTER TABLE IF EXISTS public.talao_cheque RENAME TO infotime_talao_cheque;
ALTER TABLE IF EXISTS public.taxa_cartao RENAME TO infotime_taxa_cartao;
ALTER TABLE IF EXISTS public.tipo_agenda_categoria RENAME TO infotime_tipo_agenda_categoria;
ALTER TABLE IF EXISTS public.tipo_agente RENAME TO infotime_tipo_agente;
ALTER TABLE IF EXISTS public.tipo_cliente RENAME TO infotime_tipo_cliente;
ALTER TABLE IF EXISTS public.tipo_cobranca RENAME TO infotime_tipo_cobranca;
ALTER TABLE IF EXISTS public.tipo_colaborador RENAME TO infotime_tipo_colaborador;
ALTER TABLE IF EXISTS public.tipo_contrato RENAME TO infotime_tipo_contrato;
ALTER TABLE IF EXISTS public.tipo_despesa_viagem RENAME TO infotime_tipo_despesa_viagem;
ALTER TABLE IF EXISTS public.tipo_documento RENAME TO infotime_tipo_documento;
ALTER TABLE IF EXISTS public.tipo_equipamento RENAME TO infotime_tipo_equipamento;
ALTER TABLE IF EXISTS public.tipo_equipamento_acessorio RENAME TO infotime_tipo_equipamento_acessorio;
ALTER TABLE IF EXISTS public.tipo_equipamento_calibracao RENAME TO infotime_tipo_equipamento_calibracao;
ALTER TABLE IF EXISTS public.tipo_equipamento_peca RENAME TO infotime_tipo_equipamento_peca;
ALTER TABLE IF EXISTS public.tipo_especie RENAME TO infotime_tipo_especie;
ALTER TABLE IF EXISTS public.tipo_estado_civil RENAME TO infotime_tipo_estado_civil;
ALTER TABLE IF EXISTS public.tipo_evento RENAME TO infotime_tipo_evento;
ALTER TABLE IF EXISTS public.tipo_finalidade_viagem RENAME TO infotime_tipo_finalidade_viagem;
ALTER TABLE IF EXISTS public.tipo_meio_transporte RENAME TO infotime_tipo_meio_transporte;
ALTER TABLE IF EXISTS public.tipo_mensagem RENAME TO infotime_tipo_mensagem;
ALTER TABLE IF EXISTS public.tipo_motivo_reajuste RENAME TO infotime_tipo_motivo_reajuste;
ALTER TABLE IF EXISTS public.tipo_negocio RENAME TO infotime_tipo_negocio;
ALTER TABLE IF EXISTS public.tipo_patrimonio_bem RENAME TO infotime_tipo_patrimonio_bem;
ALTER TABLE IF EXISTS public.tipo_patrimonio_bem_evento RENAME TO infotime_tipo_patrimonio_bem_evento;
ALTER TABLE IF EXISTS public.tipo_pessoa RENAME TO infotime_tipo_pessoa;
ALTER TABLE IF EXISTS public.tipo_servico RENAME TO infotime_tipo_servico;
ALTER TABLE IF EXISTS public.tipo_situacao_colaborador_ferias RENAME TO infotime_tipo_situacao_colaborador_ferias;
ALTER TABLE IF EXISTS public.tipo_situacao_colaborador_ferias_gozadas RENAME TO infotime_tipo_situacao_colaborador_ferias_gozadas;
ALTER TABLE IF EXISTS public.tipo_tarefa RENAME TO infotime_tipo_tarefa;
ALTER TABLE IF EXISTS public.tipo_tarefa_implantacao RENAME TO infotime_tipo_tarefa_implantacao;
ALTER TABLE IF EXISTS public.tipo_tarifa RENAME TO infotime_tipo_tarifa;
ALTER TABLE IF EXISTS public.treinamento RENAME TO infotime_treinamento;
ALTER TABLE IF EXISTS public.treinamento_usuario RENAME TO infotime_treinamento_usuario;
ALTER TABLE IF EXISTS public.usuario_grupo_usuario RENAME TO infotime_usuario_grupo_usuario;
ALTER TABLE IF EXISTS public.vale_alimentacao_transporte RENAME TO infotime_vale_alimentacao_transporte;
ALTER TABLE IF EXISTS public.venda_direta RENAME TO infotime_venda_direta;
ALTER TABLE IF EXISTS public.venda_direta_item RENAME TO infotime_venda_direta_item;
ALTER TABLE IF EXISTS public.webcam RENAME TO infotime_webcam;

-- ========== Wave B: núcleo (10) ==========
ALTER TABLE IF EXISTS public.aplicacao RENAME TO infotime_aplicacao;
ALTER TABLE IF EXISTS public.formulario RENAME TO infotime_formulario;
ALTER TABLE IF EXISTS public.grupo_usuario RENAME TO infotime_grupo_usuario;
ALTER TABLE IF EXISTS public.layout_formulario RENAME TO infotime_layout_formulario;
ALTER TABLE IF EXISTS public.sessao_suporte RENAME TO infotime_sessao_suporte;
ALTER TABLE IF EXISTS public.sessao_usuario RENAME TO infotime_sessao_usuario;
ALTER TABLE IF EXISTS public.tenacidade RENAME TO infotime_tenacidade;
ALTER TABLE IF EXISTS public.tenacidade_configuracao RENAME TO infotime_tenacidade_configuracao;
ALTER TABLE IF EXISTS public.usuario RENAME TO infotime_usuario;
ALTER TABLE IF EXISTS public.usuario_permissoes RENAME TO infotime_usuario_permissoes;

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
