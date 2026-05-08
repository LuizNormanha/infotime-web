-- RLS estrita por tenant (mesma política que infolab_cliente em 20260408180000).
-- Exclui infolab_tenacidade (sem RLS; ver 20260409160000).
-- InfoTIME ERP: nomes físicos sem prefixo infolab_ (ex.: cliente, usuario); Liga: infolab_*.
-- infolab_usuario: substitui a política mais permissiva de 20260408140000 quando essa migration roda.

DO $$
DECLARE
  lis_name text;
  erp_name text;
  r regclass;
  pol text;
BEGIN
  FOREACH lis_name IN ARRAY ARRAY['infolab_analisador_exame_material','infolab_analisador_exame_material_campo','infolab_analisador_exame_material_campo_limite','infolab_aplicacao','infolab_aplicacao_campo','infolab_aplicacao_campo_tenacidade','infolab_atendimento','infolab_atendimento_amostra','infolab_atendimento_amostra_impressao','infolab_atendimento_amostra_motivo_prorrogacao','infolab_atendimento_amostra_motivo_rejeicao','infolab_atendimento_amostra_observacoes_coleta','infolab_atendimento_amostra_observacoes_devolucao','infolab_atendimento_convenio','infolab_atendimento_exame_material','infolab_atendimento_exame_material_autorizacao','infolab_atendimento_exame_material_medico','infolab_atendimento_exame_material_resultado_campo','infolab_atendimento_medico','infolab_atendimento_pagamento','infolab_cliente','infolab_cliente_indicacao','infolab_computador','infolab_convenio','infolab_convenio_autorizador','infolab_convenio_contato','infolab_convenio_email','infolab_convenio_equivalencia','infolab_convenio_plano','infolab_convenio_tiss','infolab_etiqueta_perfil_impressao','infolab_exame_analisador','infolab_exame_material','infolab_exame_material_campo','infolab_exame_material_campo_limite','infolab_exame_material_grupo','infolab_exame_material_grupo_exame','infolab_exame_material_lab_apoio','infolab_exame_material_preco','infolab_exame_material_questionario','infolab_exame_material_unidade','infolab_fatura','infolab_fatura_item','infolab_feriado','infolab_grupo','infolab_grupo_cliente','infolab_grupo_exame_material','infolab_grupo_usuario','infolab_indicacao','infolab_integracao','infolab_integracao_convenio','infolab_integracao_exame_material','infolab_integracao_procedencia','infolab_interface_pacote','infolab_lab_apoio_unidade','infolab_local_armazenamento','infolab_lote_b2b_apoio','infolab_mapa','infolab_mapa_atendimento_exame_material','infolab_mapa_definicao','infolab_material','infolab_medicamento','infolab_medico','infolab_medico_credencial_convenio','infolab_modelo_resultado','infolab_motivo_cancelamento','infolab_motivo_desconto','infolab_motivo_exame_retificacao','infolab_motivo_orcamento_rejeicao','infolab_motivo_quarentena','infolab_motivo_recoleta','infolab_motivo_retificacao','infolab_orcamento','infolab_orcamento_exame_material','infolab_parametro_valor','infolab_ponto_interface','infolab_ponto_programacao','infolab_preco_exame','infolab_preco_fator','infolab_preco_tabela','infolab_procedencia','infolab_questionario','infolab_questionario_campo','infolab_questionario_campo_resposta','infolab_questionario_campo_valor','infolab_recipiente','infolab_relatorio','infolab_resultado','infolab_resultado_tabela','infolab_resultado_tabela_valor','infolab_sessao_suporte','infolab_sessao_usuario','infolab_setor','infolab_soroteca_grade','infolab_soroteca_grade_poco_historico','infolab_tenacidade_configuracao','infolab_tipo_indicacao','infolab_tipo_pagamento','infolab_unidade','infolab_unidade_email','infolab_unidade_relatorio','infolab_usuario','infolab_versao_tiss']
  LOOP
    erp_name := substring(lis_name from length('infolab_') + 1);
    IF to_regclass('public.' || quote_ident(erp_name)) IS NOT NULL THEN
      r := ('public.' || erp_name)::regclass;
    ELSIF to_regclass('public.' || quote_ident(lis_name)) IS NOT NULL THEN
      r := ('public.' || lis_name)::regclass;
    ELSE
      CONTINUE;
    END IF;

    pol := lis_name || '_tenant_rls';
    EXECUTE format('ALTER TABLE %s ENABLE ROW LEVEL SECURITY', r);
    EXECUTE format('ALTER TABLE %s FORCE ROW LEVEL SECURITY', r);
    EXECUTE format('DROP POLICY IF EXISTS %I ON %s', pol, r);
    EXECUTE format('DROP POLICY IF EXISTS %I ON %s', 'infotime_' || erp_name || '_tenant_rls', r);

    EXECUTE format(
      $exec$
      CREATE POLICY %I ON %s
      FOR ALL
      USING (
        NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
        AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
      )
      WITH CHECK (
        NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
        AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
      )
      $exec$,
      pol,
      r
    );
  END LOOP;
END $$;
