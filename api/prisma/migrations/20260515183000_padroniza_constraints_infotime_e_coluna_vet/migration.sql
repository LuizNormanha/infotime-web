-- Padronização Infotime: constraints/índices com legado `infolab_*` → `infotime_*`;
-- coluna física `infolab_vet` → `vet` (campos sem prefixo de produto).
-- Pré-requisito: migration `20260514120000_rename_physical_tables_infotime` já aplicada.

-- Coluna em infotime_tenacidade_configuracao
DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM information_schema.columns
      WHERE table_schema = 'public'
        AND table_name = 'infotime_tenacidade_configuracao'
        AND column_name = 'infolab_vet'
    )
  THEN
    EXECUTE 'ALTER TABLE public.infotime_tenacidade_configuracao RENAME COLUMN infolab_vet TO vet';
  END IF;
END
$$;

-- PK infotime_temperatura_opcao (quando existir)
DO $$
BEGIN
  IF EXISTS (
      SELECT 1
      FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid
      JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public'
        AND r.relname = 'infotime_temperatura_opcao'
        AND c.conname = 'infolab_temperatura_opcao_pkey'
    )
  THEN
    EXECUTE 'ALTER TABLE public.infotime_temperatura_opcao RENAME CONSTRAINT infolab_temperatura_opcao_pkey TO infotime_temperatura_opcao_pkey';
  END IF;
END
$$;

-- infotime_aplicacao
DO $$
BEGIN
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_aplicacao' AND c.conname = 'fk_infolab_aplicacao_id_usuario_auditoria'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_aplicacao RENAME CONSTRAINT fk_infolab_aplicacao_id_usuario_auditoria TO fk_infotime_aplicacao_id_usuario_auditoria';
  END IF;
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_aplicacao' AND c.conname = 'uq_infolab_aplicacao_01'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_aplicacao RENAME CONSTRAINT uq_infolab_aplicacao_01 TO uq_infotime_aplicacao_01';
  END IF;
END
$$;

DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_01') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_01 RENAME TO idx_infotime_aplicacao_01';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_02') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_02 RENAME TO idx_infotime_aplicacao_02';
  END IF;
END
$$;

-- infotime_aplicacao_campo
DO $$
BEGIN
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_aplicacao_campo' AND c.conname = 'fk_infolab_aplicacao_campo_01'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_aplicacao_campo RENAME CONSTRAINT fk_infolab_aplicacao_campo_01 TO fk_infotime_aplicacao_campo_01';
  END IF;
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_aplicacao_campo' AND c.conname = 'uq_infolab_aplicacao_campo_01'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_aplicacao_campo RENAME CONSTRAINT uq_infolab_aplicacao_campo_01 TO uq_infotime_aplicacao_campo_01';
  END IF;
END
$$;

DO $$
BEGIN
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_campo_01') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_campo_01 RENAME TO idx_infotime_aplicacao_campo_01';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_campo_02') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_campo_02 RENAME TO idx_infotime_aplicacao_campo_02';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_campo_03') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_campo_03 RENAME TO idx_infotime_aplicacao_campo_03';
  END IF;
  IF EXISTS (SELECT 1 FROM pg_class i JOIN pg_namespace n ON n.oid = i.relnamespace WHERE n.nspname = 'public' AND i.relkind = 'i' AND i.relname = 'idx_infolab_aplicacao_campo_04') THEN
    EXECUTE 'ALTER INDEX public.idx_infolab_aplicacao_campo_04 RENAME TO idx_infotime_aplicacao_campo_04';
  END IF;
END
$$;

-- infotime_convenio (constraint UNIQUE legada)
DO $$
BEGIN
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_convenio' AND c.conname = 'infolab_convenio_id_convenio_autorizador_key'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_convenio RENAME CONSTRAINT infolab_convenio_id_convenio_autorizador_key TO infotime_convenio_id_convenio_autorizador_key';
  END IF;
END
$$;

-- infotime_procedencia
DO $$
BEGIN
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_procedencia' AND c.conname = 'fk_infolab_procedencia_infolab_usuario_auditoria'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_procedencia RENAME CONSTRAINT fk_infolab_procedencia_infolab_usuario_auditoria TO fk_infotime_procedencia_infotime_usuario_auditoria';
  END IF;
END
$$;

-- infotime_tenacidade_configuracao (PK + FK)
DO $$
BEGIN
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_tenacidade_configuracao' AND c.conname = 'infolab_configuracao_tenacidade_pkey'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_tenacidade_configuracao RENAME CONSTRAINT infolab_configuracao_tenacidade_pkey TO infotime_configuracao_tenacidade_pkey';
  END IF;
  IF EXISTS (
      SELECT 1 FROM pg_constraint c
      JOIN pg_class r ON r.oid = c.conrelid JOIN pg_namespace n ON n.oid = r.relnamespace
      WHERE n.nspname = 'public' AND r.relname = 'infotime_tenacidade_configuracao' AND c.conname = 'fk_infolab_tenacidade_configuracao_infolab_tenacidade'
    ) THEN
    EXECUTE 'ALTER TABLE public.infotime_tenacidade_configuracao RENAME CONSTRAINT fk_infolab_tenacidade_configuracao_infolab_tenacidade TO fk_infotime_tenacidade_configuracao_infotime_tenacidade';
  END IF;
END
$$;
