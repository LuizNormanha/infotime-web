-- Registro de temperatura por amostra (tabela física `amostra_temperatura`, @@map no Prisma).
-- FKs apontam para nomes ERP (sem infolab_) ou Liga, conforme existam no banco.

DO $$
DECLARE
  ref_ama text;
  ref_top text;
  ref_ten text;
  ref_usr text;
BEGIN
  IF to_regclass('public.amostra_temperatura') IS NOT NULL THEN
    RETURN;
  END IF;

  IF to_regclass('public.atendimento_amostra') IS NOT NULL THEN
    ref_ama := 'atendimento_amostra';
  ELSIF to_regclass('public.infolab_atendimento_amostra') IS NOT NULL THEN
    ref_ama := 'infolab_atendimento_amostra';
  ELSE
    RAISE NOTICE 'amostra_temperatura: sem atendimento_amostra — pulando criação (ERP parcial ou módulo ausente).';
    RETURN;
  END IF;

  IF to_regclass('public.temperatura_opcao') IS NOT NULL THEN
    ref_top := 'temperatura_opcao';
  ELSIF to_regclass('public.infolab_temperatura_opcao') IS NOT NULL THEN
    ref_top := 'infolab_temperatura_opcao';
  ELSE
    RAISE NOTICE 'amostra_temperatura: sem temperatura_opcao — pulando criação.';
    RETURN;
  END IF;

  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    ref_ten := 'tenacidade';
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    ref_ten := 'infolab_tenacidade';
  ELSE
    RAISE NOTICE 'amostra_temperatura: sem tenacidade — pulando criação.';
    RETURN;
  END IF;

  IF to_regclass('public.usuario') IS NOT NULL THEN
    ref_usr := 'usuario';
  ELSIF to_regclass('public.infolab_usuario') IS NOT NULL THEN
    ref_usr := 'infolab_usuario';
  ELSE
    RAISE NOTICE 'amostra_temperatura: sem usuario — pulando criação.';
    RETURN;
  END IF;

  CREATE TABLE public.amostra_temperatura (
    id_amostra_temperatura   BIGSERIAL     NOT NULL,
    id_tenacidade             BIGINT        NOT NULL,
    id_atendimento_amostra    BIGINT        NOT NULL,
    id_temperatura_opcao      BIGINT,
    id_usuario_registro       BIGINT,
    data_hora_registro        TIMESTAMP(6)  NOT NULL,
    origem                    CHAR(1)       NOT NULL,
    valor_temperatura         DECIMAL(5, 2),
    unidade_temperatura       CHAR(1),
    motivo_nao_registro       VARCHAR(100),
    id_usuario_auditoria      BIGINT,
    endereco_ip_auditoria     VARCHAR(20),
    nome_aplicacao_auditoria  VARCHAR(255),
    CONSTRAINT amostra_temperatura_pkey PRIMARY KEY (id_amostra_temperatura)
  );

  CREATE INDEX idx_amostra_temperatura_id_atendimento_amostra
    ON public.amostra_temperatura (id_atendimento_amostra);
  CREATE INDEX idx_amostra_temperatura_id_tenacidade
    ON public.amostra_temperatura (id_tenacidade);
  CREATE INDEX idx_amostra_temperatura_id_temperatura_opcao
    ON public.amostra_temperatura (id_temperatura_opcao);

  EXECUTE format(
    'ALTER TABLE public.amostra_temperatura ADD CONSTRAINT fk_amostra_temperatura_id_atendimento_amostra
      FOREIGN KEY (id_atendimento_amostra) REFERENCES public.%I (id_atendimento_amostra)
      ON DELETE RESTRICT ON UPDATE RESTRICT',
    ref_ama
  );
  EXECUTE format(
    'ALTER TABLE public.amostra_temperatura ADD CONSTRAINT fk_amostra_temperatura_id_temperatura_opcao
      FOREIGN KEY (id_temperatura_opcao) REFERENCES public.%I (id_temperatura_opcao)
      ON DELETE RESTRICT ON UPDATE RESTRICT',
    ref_top
  );
  EXECUTE format(
    'ALTER TABLE public.amostra_temperatura ADD CONSTRAINT fk_amostra_temperatura_id_tenacidade
      FOREIGN KEY (id_tenacidade) REFERENCES public.%I (id_tenacidade)
      ON DELETE NO ACTION ON UPDATE RESTRICT',
    ref_ten
  );
  EXECUTE format(
    'ALTER TABLE public.amostra_temperatura ADD CONSTRAINT fk_amostra_temperatura_id_usuario_registro
      FOREIGN KEY (id_usuario_registro) REFERENCES public.%I (id_usuario)
      ON DELETE RESTRICT ON UPDATE RESTRICT',
    ref_usr
  );
  EXECUTE format(
    'ALTER TABLE public.amostra_temperatura ADD CONSTRAINT fk_amostra_temperatura_id_usuario_auditoria
      FOREIGN KEY (id_usuario_auditoria) REFERENCES public.%I (id_usuario)
      ON DELETE RESTRICT ON UPDATE RESTRICT',
    ref_usr
  );
END $$;
