-- RLS + seed multi-tenant + views/funções auxiliares (soroteca física).

-- ========== RLS (padrão tenant infotime-web) ==========
DO $$
DECLARE
  tbl text;
BEGIN
  FOREACH tbl IN ARRAY ARRAY[
    'infolab_amostra_status',
    'infolab_material_tipo',
    'infolab_recipiente_tipo',
    'infolab_equipamento_tipo',
    'infolab_movimento_tipo',
    'infolab_bloqueio_tipo',
    'infolab_residuo_grupo',
    'infolab_descarte_metodo',
    'infolab_descarte_motivo',
    'infolab_norma',
    'infolab_finalidade',
    'infolab_derivado_tipo',
    'infolab_qualidade_evento_tipo',
    'infolab_soroteca_sala',
    'infolab_soroteca_equipamento',
    'infolab_soroteca_rack',
    'infolab_soroteca_caixa',
    'infolab_soroteca_posicao',
    'infolab_soroteca_retencao_regra',
    'infolab_soroteca_aliquota',
    'infolab_soroteca_derivado',
    'infolab_soroteca_armazenamento',
    'infolab_soroteca_bloqueio',
    'infolab_soroteca_movimento',
    'infolab_descarte_lote',
    'infolab_descarte_item',
    'infolab_qualidade_evento',
    'infolab_temperatura_log',
    'infolab_temperatura_quarentena',
    'infolab_soroteca_auditoria'
  ]
  LOOP
    EXECUTE format(
      'ALTER TABLE %I ENABLE ROW LEVEL SECURITY;
       ALTER TABLE %I FORCE ROW LEVEL SECURITY;
       DROP POLICY IF EXISTS %I ON %I;
       CREATE POLICY %I ON %I
       FOR ALL
       USING (
         NULLIF(current_setting(''app.current_tenant_id'', true), '''') IS NOT NULL
         AND id_tenacidade = (NULLIF(current_setting(''app.current_tenant_id'', true), ''''))::bigint
       )
       WITH CHECK (
         NULLIF(current_setting(''app.current_tenant_id'', true), '''') IS NOT NULL
         AND id_tenacidade = (NULLIF(current_setting(''app.current_tenant_id'', true), ''''))::bigint
       );',
      tbl, tbl,
      tbl || '_tenant_rls', tbl,
      tbl || '_tenant_rls', tbl
    );
  END LOOP;
END $$;

-- ========== Seed por tenant existente ==========
INSERT INTO infolab_amostra_status (id_tenacidade, fase, permite_uso, terminal, ativo, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.permite_uso, v.terminal, v.ativo, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, false, false, true, 'COLETADA', 'Coletada - aguardando recebimento'),
  (1, false, false, true, 'RECEBIDA', 'Recebida no laboratório'),
  (1, false, false, true, 'ACEITA', 'Aceita para processamento'),
  (1, false, true, true, 'REJEITADA', 'Rejeitada por critério técnico'),
  (1, false, false, true, 'ARMAZENADA', 'Armazenada com posição física definida'),
  (1, true, false, true, 'VENCIDA', 'Prazo de retenção expirado'),
  (1, false, true, true, 'DESCARTADA', 'Descarte realizado e auditado')
) AS v(fase, permite_uso, terminal, ativo, codigo, descricao);

INSERT INTO infolab_material_tipo (id_tenacidade, fase, requer_tcle, ativo, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.requer_tcle, v.ativo, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, false, true, 'SORO', 'Soro'),
  (1, false, true, 'PLASMA_EDTA', 'Plasma EDTA'),
  (1, false, true, 'URINA', 'Urina'),
  (2, false, true, 'DNA_EXTRAIDO', 'DNA extraído'),
  (2, false, true, 'BLOCO_PARAFINA', 'Bloco de parafina')
) AS v(fase, requer_tcle, ativo, codigo, descricao);

INSERT INTO infolab_recipiente_tipo (id_tenacidade, fase, ativo, volume_nominal_ml, codigo, descricao, aditivo, cor_tampa)
SELECT t.id_tenacidade, v.fase, v.ativo, v.vol, v.codigo, v.descricao, v.aditivo, v.cor_tampa
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, true, 5.0::decimal, 'TUBO_SECO', 'Tubo seco sem aditivo', NULL::varchar, 'Vermelha'::varchar),
  (1, true, 4.0, 'TUBO_EDTA_K2', 'Tubo EDTA K2', 'EDTA K2', 'Roxa'),
  (1, true, 1.8, 'CRIOTUBE_1_8ML', 'Criotubo 1,8 mL', NULL, 'Branca')
) AS v(fase, ativo, vol, codigo, descricao, aditivo, cor_tampa);

INSERT INTO infolab_equipamento_tipo (id_tenacidade, fase, ativo, temperatura_min_c, temperatura_max_c, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.ativo, v.tmin, v.tmax, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, true, 2.0::decimal, 8.0::decimal, 'GELADEIRA', 'Geladeira 2–8 °C'),
  (1, true, -90.0, -65.0, 'ULTRAFREEZER_80', 'Ultrafreezer -80 °C'),
  (1, true, -200.0, -140.0, 'CRIOTANQUE_LN2', 'Criotanque nitrogênio líquido')
) AS v(fase, ativo, tmin, tmax, codigo, descricao);

INSERT INTO infolab_movimento_tipo (id_tenacidade, fase, requer_auth, ativo, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.requer_auth, v.ativo, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, false, true, 'ENTRADA', 'Entrada na soroteca'),
  (1, false, true, 'SAIDA_REPETICAO', 'Saída para repetição de exame'),
  (1, false, true, 'TRANSFERENCIA', 'Transferência de posição interna'),
  (1, true, true, 'PERDA', 'Registro de perda ou extravio'),
  (1, false, true, 'DEVOLUCAO', 'Devolução ao armazenamento')
) AS v(fase, requer_auth, ativo, codigo, descricao);

INSERT INTO infolab_bloqueio_tipo (id_tenacidade, fase, impede_descarte, impede_uso, requer_auth_liberacao, ativo, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.idesc, v.iuso, v.req, v.ativo, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, true, true, true, true, 'JUDICIAL', 'Bloqueio judicial'),
  (1, false, false, false, true, 'TECNICO', 'Pendência técnica'),
  (1, true, true, true, true, 'CONSENTIMENTO', 'Restrição por TCLE')
) AS v(fase, idesc, iuso, req, ativo, codigo, descricao);

INSERT INTO infolab_residuo_grupo (id_tenacidade, ativo, codigo, descricao, norma)
SELECT t.id_tenacidade, true, v.codigo, v.descricao, 'RDC 222/2018'
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('A4', 'Sobras de amostras de laboratório com sangue ou líquidos corpóreos'),
  ('E', 'Materiais perfurocortantes'),
  ('D', 'Resíduos comuns')
) AS v(codigo, descricao);

INSERT INTO infolab_descarte_metodo (id_tenacidade, fase, ativo, codigo, descricao)
SELECT t.id_tenacidade, 1::smallint, true, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('AUTOCLAVE', 'Autoclavagem'),
  ('INCINERACAO', 'Incineração'),
  ('EMPRESA_COLETORA', 'Coleta por empresa especializada')
) AS v(codigo, descricao);

INSERT INTO infolab_descarte_motivo (id_tenacidade, fase, ativo, codigo, descricao)
SELECT t.id_tenacidade, 1::smallint, true, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('PRAZO_EXPIRADO', 'Prazo de retenção expirado'),
  ('INADEQUADA', 'Amostra perdeu qualidade'),
  ('ACIDENTE', 'Quebra ou acidente laboratorial')
) AS v(codigo, descricao);

INSERT INTO infolab_norma (id_tenacidade, fase, ativo, codigo, descricao, orgao)
SELECT t.id_tenacidade, 1::smallint, true, v.codigo, v.descricao, v.orgao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('RDC_786_2023', 'RDC 786/2023 - Laboratórios clínicos', 'ANVISA'),
  ('RDC_222_2018', 'RDC 222/2018 - RSS', 'ANVISA'),
  ('LGPD_13709', 'Lei 13.709/2018 - LGPD', 'Presidência')
) AS v(codigo, descricao, orgao);

INSERT INTO infolab_finalidade (id_tenacidade, fase, requer_tcle, ativo, codigo, descricao)
SELECT t.id_tenacidade, v.fase, v.req, true, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  (1::smallint, false, 'REPETICAO', 'Repetição de exame'),
  (1, false, 'EXAME_COMPLEMENTAR', 'Exame complementar'),
  (3, true, 'PESQUISA', 'Uso em protocolo de pesquisa')
) AS v(fase, req, codigo, descricao);

INSERT INTO infolab_derivado_tipo (id_tenacidade, fase, ativo, codigo, descricao)
SELECT t.id_tenacidade, 2::smallint, true, v.codigo, v.descricao
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('DNA_GENOMICO', 'DNA genômico extraído'),
  ('BLOCO_PARAFINA', 'Bloco de parafina'),
  ('LAMINA_CORADA', 'Lâmina corada')
) AS v(codigo, descricao);

INSERT INTO infolab_qualidade_evento_tipo (id_tenacidade, fase, ativo, codigo, descricao, gravidade)
SELECT t.id_tenacidade, 1::smallint, true, v.codigo, v.descricao, v.gravidade
FROM infolab_tenacidade t
CROSS JOIN (VALUES
  ('EXCURSAO_TEMPERATURA', 'Excursão de temperatura no equipamento', 'CRITICA'),
  ('VOLUME_INSUFICIENTE', 'Volume insuficiente', 'ALTA'),
  ('LABEL_INCORRETO', 'Identificação incorreta', 'CRITICA')
) AS v(codigo, descricao, gravidade);

-- ========== Views / funções ==========
CREATE OR REPLACE VIEW vw_soroteca_posicoes_livres AS
SELECT
    e.id_soroteca_equipamento,
    e.codigo AS equipamento,
    te.descricao AS tipo_equipamento,
    s.nome AS sala,
    r.codigo AS rack,
    c.codigo AS caixa,
    p.rotulo AS posicao,
    p.id_soroteca_posicao
FROM infolab_soroteca_posicao p
JOIN infolab_soroteca_caixa c ON c.id_soroteca_caixa = p.id_soroteca_caixa
JOIN infolab_soroteca_rack r ON r.id_soroteca_rack = c.id_soroteca_rack
JOIN infolab_soroteca_equipamento e ON e.id_soroteca_equipamento = r.id_soroteca_equipamento
JOIN infolab_equipamento_tipo te ON te.id_equipamento_tipo = e.id_equipamento_tipo
JOIN infolab_soroteca_sala s ON s.id_soroteca_sala = e.id_soroteca_sala
WHERE p.ativo = true
  AND NOT EXISTS (
      SELECT 1 FROM infolab_soroteca_armazenamento a
      WHERE a.id_soroteca_posicao = p.id_soroteca_posicao AND a.ativo = true
  );

CREATE OR REPLACE FUNCTION fn_soroteca_calcular_prazo_retencao(
    p_id_tenacidade bigint,
    p_id_material_tipo bigint,
    p_codigo_exame varchar,
    p_id_finalidade bigint
) RETURNS integer AS $$
DECLARE
    v_prazo integer;
BEGIN
    SELECT prazo_dias INTO v_prazo
    FROM infolab_soroteca_retencao_regra
    WHERE ativo = true
      AND id_tenacidade = p_id_tenacidade
      AND (id_material_tipo IS NULL OR id_material_tipo = p_id_material_tipo)
      AND (codigo_exame IS NULL OR codigo_exame = p_codigo_exame)
      AND (id_finalidade IS NULL OR id_finalidade = p_id_finalidade)
    ORDER BY prioridade DESC
    LIMIT 1;
    RETURN COALESCE(v_prazo, 7);
END;
$$ LANGUAGE plpgsql STABLE;

CREATE OR REPLACE FUNCTION fn_soroteca_tem_bloqueio_descarte(
    p_id_atendimento_amostra bigint DEFAULT NULL,
    p_id_soroteca_aliquota bigint DEFAULT NULL,
    p_id_soroteca_derivado bigint DEFAULT NULL
) RETURNS boolean AS $$
BEGIN
    RETURN EXISTS (
        SELECT 1
        FROM infolab_soroteca_bloqueio b
        JOIN infolab_bloqueio_tipo bt ON bt.id_bloqueio_tipo = b.id_bloqueio_tipo
        WHERE b.ativo = true
          AND bt.impede_descarte = true
          AND (
              (p_id_atendimento_amostra IS NOT NULL AND b.id_atendimento_amostra = p_id_atendimento_amostra)
              OR (p_id_soroteca_aliquota IS NOT NULL AND b.id_soroteca_aliquota = p_id_soroteca_aliquota)
              OR (p_id_soroteca_derivado IS NOT NULL AND b.id_soroteca_derivado = p_id_soroteca_derivado)
          )
    );
END;
$$ LANGUAGE plpgsql STABLE;

CREATE OR REPLACE FUNCTION fn_soroteca_proximo_numero_aliquota(
    p_id_atendimento_amostra bigint
) RETURNS smallint AS $$
BEGIN
    RETURN COALESCE(
        (SELECT MAX(numero_aliquota) + 1
         FROM infolab_soroteca_aliquota
         WHERE id_atendimento_amostra = p_id_atendimento_amostra),
        1
    );
END;
$$ LANGUAGE plpgsql STABLE;
