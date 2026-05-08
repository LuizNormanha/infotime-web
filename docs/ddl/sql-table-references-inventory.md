# Inventário heurístico: referências a nomes físicos de tabela (antes do prefixo `infotime_`)

Gerado em: 2026-05-08T18:43:43.301Z por `scripts/ddl/report-sql-inventory.mjs`.

Este relatório lista **arquivos que ainda menciam** identificadores iguais aos nomes de origem
em [`docs/ddl/table-rename-map.json`](table-rename-map.json). **Migrations já aplicadas no histórico**
continuam citando nomes antigos por design; o que importa para runtime é a **nova migration**
[`20260514120000_rename_physical_tables_infotime`](../../api/prisma/migrations/20260514120000_rename_physical_tables_infotime/migration.sql)
e o **código/Prisma atualizado** após o rename.

## Objetos PostgreSQL a revisar manualmente (catálogo)

- Funções e triggers com SQL dinâmico ou corpo com nomes fixos (`pg_proc`, `pg_views`).
- Views/materialized views dependentes de tabelas renomeadas.
- Políticas RLS referenciadas por nome em scripts externos (no PG as políticas seguem a relação ao renomear).

## Migrations SQL (35 arquivos com ao menos um match)

- `api\prisma\migrations\20260406120000_baseline\migration.sql`: cargo, usuario
- `api\prisma\migrations\20260408120000_postgres_roles_e_privilegios\migration.sql`: banco
- `api\prisma\migrations\20260408140000_rls_infotime_usuario\migration.sql`: usuario
- `api\prisma\migrations\20260408150000_rls_infotime_tenacidade\migration.sql`: tenacidade
- `api\prisma\migrations\20260408160000_rls_infotime_cliente\migration.sql`: cliente, tenacidade
- `api\prisma\migrations\20260408170000_rls_fix_empty_current_tenant_guc\migration.sql`: cliente, tenacidade
- `api\prisma\migrations\20260408180000_rls_tenant_obrigatorio_tenacidade_cliente\migration.sql`: cliente, tenacidade
- `api\prisma\migrations\20260408200000_fn_infotime_tenant_ativo_por_dominio\migration.sql`: tenacidade, usuario
- `api\prisma\migrations\20260409140000_rls_tenacidade_implantacao_liga_br\migration.sql`: tenacidade, tenacidade_configuracao
- `api\prisma\migrations\20260409160000_remove_rls_infotime_tenacidade\migration.sql`: tenacidade
- `api\prisma\migrations\20260410210000_usuario_permissoes_rename_drop_grupo_formulario\migration.sql`: usuario
- `api\prisma\migrations\20260413120000_rls_tenant_id_tenacidade_all_tables\migration.sql`: cliente, usuario
- `api\prisma\migrations\20260413140000_rls_infotime_usuario_usuarios_globais\migration.sql`: usuario
- `api\prisma\migrations\20260418150000_fix_pendencia_situacao_ids_deterministicos\migration.sql`: contrato
- `api\prisma\migrations\20260421143000_tenacidade_campos_para_configuracao\migration.sql`: retorno, tenacidade
- `api\prisma\migrations\20260422120000_remove_rls_infotime_tenacidade_configuracao\migration.sql`: tenacidade, tenacidade_configuracao
- `api\prisma\migrations\20260422130000_remove_infotime_aplicacao_campo_tenacidade\migration.sql`: tenacidade
- `api\prisma\migrations\20260422140000_remove_fn_seed_ensure_tenacidade_liga_br\migration.sql`: tenacidade
- `api\prisma\migrations\20260423120000_infotime_temperatura_opcao\migration.sql`: infolab_temperatura_opcao
- `api\prisma\migrations\20260423120100_seed_infotime_temperatura_opcao\migration.sql`: infolab_temperatura_opcao
- `api\prisma\migrations\20260423120200_infotime_amostra_temperatura\migration.sql`: banco, infolab_temperatura_opcao, tenacidade, usuario
- `api\prisma\migrations\20260424140000_fatura_lista_id_medico\migration.sql`: fatura
- `api\prisma\migrations\20260428140000_infotime_serie_nota_fiscal_servico\migration.sql`: tenacidade, usuario
- `api\prisma\migrations\20260504120000_soroteca_fisica_fase1_2_create\migration.sql`: aplicacao
- `api\prisma\migrations\20260504120100_soroteca_fisica_rls_seed_views\migration.sql`: empresa, processamento, tipo_equipamento
- `api\prisma\migrations\20260507130000_ensure_fn_infotime_tenant_ativo_por_dominio\migration.sql`: tenacidade, usuario
- `api\prisma\migrations\20260507180000_liga_infotime_auth_minimo\migration.sql`: formulario, grupo_usuario, layout_formulario, sessao_suporte, sessao_usuario, tenacidade, tenacidade_configuracao, usuario, usuario_permissoes
- `api\prisma\migrations\20260507190000_liga_infotime_auth_grants\migration.sql`: formulario, grupo_usuario, layout_formulario, sessao_suporte, sessao_usuario, tenacidade, tenacidade_configuracao, usuario, usuario_grupo_usuario, usuario_permissoes
- `api\prisma\migrations\20260507200000_infotime_view_clientes_compat\migration.sql`: cliente
- `api\prisma\migrations\20260507200000_liga_infotime_seed_usuarios_tecnicos\migration.sql`: usuario
- `api\prisma\migrations\20260508120000_fn_tenant_dominio_liga_ou_infotime\migration.sql`: tenacidade, usuario
- `api\prisma\migrations\20260508123000_prisma_models_infotime_client_only\migration.sql`: cliente
- `api\prisma\migrations\20260511200000_infotime_grants_login_tenant_usuario\migration.sql`: banco, tenacidade, usuario
- `api\prisma\migrations\20260513120000_tenacidade_colunas_erp_liga_infotime\migration.sql`: tenacidade
- `api\prisma\migrations\20260514120000_rename_physical_tables_infotime\migration.sql`: agencia, agenda, agenda_evento, agenda_usuario, almoxarifado, almoxarifado_baixa, almoxarifado_baixa_produto, almoxarifado_entrada, almoxarifado_entrada_parcela, almoxarifado_entrada_parcela_rateio, almoxarifado_entrada_produto, almoxarifado_importacao_xml, almoxarifado_motivo_baixa, almoxarifado_produto, almoxarifado_produto_classificacao, almoxarifado_produto_estoque, almoxarifado_produto_grupo, almoxarifado_produto_local_armazenamento, almoxarifado_produto_volume, almoxarifado_requisicao, almoxarifado_requisicao_produto, almoxarifado_usuario_atender, aplicacao, aplicacao_sync, auditoria, auditoria_campo, avaliacao, banco, bandeira_cartao, boleto, boleto_nota_fiscal, calendario, cargo, cargo_classificacao, cargo_classificacao_nivel, cargo_classificacao_nivel_salario, categoria_produto, categoria_produto_tarefa, cbo, centro_custo, centro_custo_vigencia, cheque, cid10, cliente, cliente_aluno, cliente_canal, cliente_comunicacao, cliente_contato, cliente_documento, cliente_equipamento, cliente_equipamento_acessorio, cliente_equipamento_chamado, cliente_equipamento_peca_troca, cliente_equipamento_servico, cliente_plano_conta, cliente_plano_conta_legacy, cliente_senha, cliente_telefone, colaborador, colaborador_atestado, colaborador_avaliacao, colaborador_comp_rendimento, colaborador_comunicacao, colaborador_contra_cheque, colaborador_documento, colaborador_exame, colaborador_ferias, colaborador_ferias_gozadas, colaborador_folha_ponto, colaborador_medida_disciplinar, colaborador_plano_conta, colaborador_reajuste, colaborador_salario_adiantamento, colaborador_tarefa, colaborador_tarefa_historico, colaborador_tarefa_legacy, colaborador_tarefa_motivo_prorrogacao, colaborador_tarifa, colaborador_telefone, colaborador_vale_alimentacao_transporte, colaborador_viagem, colaborador_viagem_adiantamento, colaborador_viagem_despesa, coleta_domiciliar, comunicacao, concorrente, configuracao, configuracao_cobranca, consumo, consumo_item, conta_caixa, conta_caixa_documento, conta_caixa_registro, conta_caixa_registro_lancamento, conta_caixa_senha, conta_caixa_transferencia, conta_caixa_usuario, conta_telefone, contrato, contrato_item, contrato_tarefa, contrato_tarefa_atividade, email_enviado, email_modelo, empresa, empresa_documento, empresa_nota_fiscal, empresa_operadora, empresa_senha, extrato_conta, fatura, fatura_item, fechamento_financeiro, feriado, fluxo_caixa, formulario, fornecedor, fornecedor_comunicacao, fornecedor_contato, fornecedor_documento, fornecedor_plano_conta, grupo_documento, grupo_usuario, grupo_usuario_aplicacao, grupo_usuario_aplicacao_bloco, grupo_usuario_aplicacao_campo, indice_reajuste, indice_reajuste_data, info_lab_acesso, info_lab_noticias, infolab_temperatura_opcao, lancamento_despesa, lancamento_despesa_rateio, lancamento_receita, lancamento_receita_rateio, layout_formulario, mensagem_padrao, municipio, negociacao, negociacao_motivo_perda, negociacao_proposta_fase, negociacao_tarefa, nota_fiscal, operadora, patrimonio_bem, patrimonio_bem_atualizacao, patrimonio_bem_evento, patrimonio_bem_foto, patrimonio_categoria, patrimonio_estado, patrimonio_localizacao, pessoa, plano_conta, pop_documento, processamento, produto, proposta, proposta_andamento, proposta_dimensao, proposta_fase, proposta_item, regiao_estadual, retorno, retorno_api_pix, sessao_suporte, sessao_usuario, site_acesso, site_contato, site_setor_laboratorio, site_tipo_assunto, site_trabalhe_conosco, situacao_atividade, situacao_cliente, situacao_colaborador, situacao_documento, situacao_fase, situacao_fornecedor, situacao_tarefa, situacao_tarefa_implantacao, talao_cheque, taxa_cartao, tenacidade, tenacidade_configuracao, tipo_agenda_categoria, tipo_agente, tipo_cliente, tipo_cobranca, tipo_colaborador, tipo_contrato, tipo_despesa_viagem, tipo_documento, tipo_equipamento, tipo_equipamento_acessorio, tipo_equipamento_calibracao, tipo_equipamento_peca, tipo_especie, tipo_estado_civil, tipo_evento, tipo_finalidade_viagem, tipo_meio_transporte, tipo_mensagem, tipo_motivo_reajuste, tipo_negocio, tipo_patrimonio_bem, tipo_patrimonio_bem_evento, tipo_pessoa, tipo_servico, tipo_situacao_colaborador_ferias, tipo_situacao_colaborador_ferias_gozadas, tipo_tarefa, tipo_tarefa_implantacao, tipo_tarifa, treinamento, treinamento_usuario, usuario, usuario_grupo_usuario, usuario_permissoes, vale_alimentacao_transporte, venda_direta, venda_direta_item, webcam

## Código TypeScript / seed (31 arquivos)

- `api\prisma\seed.ts`: formulario, tenacidade
- `api\src\app.module.ts`: usuario
- `api\src\autenticacao\autenticacao.controller.ts`: cliente, usuario
- `api\src\autenticacao\autenticacao.service.spec.ts`: sessao_suporte, sessao_usuario, usuario
- `api\src\autenticacao\autenticacao.service.ts`: configuracao, formulario, tenacidade, usuario
- `api\src\autenticacao\internal\resolver-tenant-login.ts`: empresa, tenacidade, usuario
- `api\src\comum\dto-transform.ts`: retorno
- `api\src\comum\listagem\query-listagem-crud.ts`: cliente
- `api\src\comum\senha-usuario-politica.ts`: usuario
- `api\src\grupo-perfil\dto\resposta-grupo-perfil.dto.ts`: tenacidade, usuario
- `api\src\grupo-perfil\grupo-perfil.controller.ts`: usuario
- `api\src\grupo-perfil\grupo-perfil.service.ts`: usuario
- `api\src\layout\dto\layout-formulario-cadastro.dto.ts`: banco
- `api\src\layout\dto\salvar-layout.dto.ts`: formulario
- `api\src\layout\layout-config-json.ts`: formulario
- `api\src\layout\layout-overlay-validacao.ts`: auditoria
- `api\src\layout\layout.controller.ts`: formulario, usuario
- `api\src\layout\layout.service.ts`: formulario
- `api\src\main.ts`: auditoria
- `api\src\prisma\prisma.module.ts`: banco, cliente
- `api\src\prisma\prisma.service.ts`: cliente
- `api\src\prisma\tenant-rls.middleware.spec.ts`: usuario
- `api\src\usuario-permissoes\dto\atualizar-usuario-permissao.dto.ts`: usuario
- `api\src\usuario-permissoes\usuario-permissoes.controller.ts`: usuario
- `api\src\usuario-permissoes\usuario-permissoes.module.ts`: usuario
- `api\src\usuario-permissoes\usuario-permissoes.service.ts`: formulario, usuario
- `api\src\usuario\dto\atualizar-usuario.dto.ts`: usuario
- `api\src\usuario\dto\trocar-senha-usuario.dto.ts`: usuario
- `api\src\usuario\usuario.controller.ts`: usuario
- `api\src\usuario\usuario.module.ts`: usuario
- `api\src\usuario\usuario.service.ts`: usuario

## Próximos passos

- Após `prisma migrate deploy`, rodar smoke tests (login, RLS, CRUD).
- Se novas funções/views forem adicionadas ao banco fora do Prisma, repetir esta varredura.
