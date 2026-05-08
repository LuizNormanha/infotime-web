-- Série de NFS-e por unidade (tabela física `serie_nota_fiscal_servico`, @@map no Prisma).

DO $$
DECLARE
  ref_ten text;
  ref_uni text;
  ref_usr text;
BEGIN
  IF to_regclass('public.serie_nota_fiscal_servico') IS NOT NULL THEN
    RETURN;
  END IF;

  IF to_regclass('public.tenacidade') IS NOT NULL THEN
    ref_ten := 'tenacidade';
  ELSIF to_regclass('public.infolab_tenacidade') IS NOT NULL THEN
    ref_ten := 'infolab_tenacidade';
  ELSE
    RAISE NOTICE 'serie_nota_fiscal_servico: sem tenacidade — pulando.';
    RETURN;
  END IF;

  IF to_regclass('public.unidade') IS NOT NULL THEN
    ref_uni := 'unidade';
  ELSIF to_regclass('public.infolab_unidade') IS NOT NULL THEN
    ref_uni := 'infolab_unidade';
  ELSE
    RAISE NOTICE 'serie_nota_fiscal_servico: sem unidade — pulando.';
    RETURN;
  END IF;

  IF to_regclass('public.usuario') IS NOT NULL THEN
    ref_usr := 'usuario';
  ELSIF to_regclass('public.infolab_usuario') IS NOT NULL THEN
    ref_usr := 'infolab_usuario';
  ELSE
    RAISE NOTICE 'serie_nota_fiscal_servico: sem usuario — pulando.';
    RETURN;
  END IF;

  CREATE TABLE public.serie_nota_fiscal_servico (
    id_serie_nota_fiscal_servico BIGSERIAL NOT NULL,
    id_tenacidade BIGINT NOT NULL,
    id_unidade BIGINT NOT NULL,
    sigla VARCHAR(10) NOT NULL,
    numeracao BIGINT NOT NULL,
    tipo_nota_fiscal SMALLINT,
    ativo CHAR(1),
    ambiente SMALLINT,
    lote VARCHAR(20),
    frase_secreta VARCHAR(80),
    senha_web VARCHAR(20),
    usuario_web VARCHAR(20),
    cer_arq BYTEA,
    cer_senha VARCHAR(20),
    id_usuario_auditoria BIGINT,
    endereco_ip_auditoria VARCHAR(20),
    nome_aplicacao_auditoria VARCHAR(255),
    CONSTRAINT serie_nota_fiscal_servico_pkey PRIMARY KEY (id_serie_nota_fiscal_servico)
  );

  CREATE INDEX idx_serie_nota_fiscal_servico_id_tenacidade
    ON public.serie_nota_fiscal_servico (id_tenacidade);
  CREATE INDEX idx_serie_nota_fiscal_servico_id_unidade
    ON public.serie_nota_fiscal_servico (id_unidade);

  EXECUTE format(
    $f$
    ALTER TABLE public.serie_nota_fiscal_servico ADD CONSTRAINT fk_serie_nota_fiscal_servico_id_tenacidade
      FOREIGN KEY (id_tenacidade) REFERENCES public.%I (id_tenacidade)
      ON DELETE NO ACTION ON UPDATE RESTRICT
    $f$,
    ref_ten
  );
  EXECUTE format(
    $f$
    ALTER TABLE public.serie_nota_fiscal_servico ADD CONSTRAINT fk_serie_nota_fiscal_servico_id_unidade
      FOREIGN KEY (id_unidade) REFERENCES public.%I (id_unidade)
      ON DELETE RESTRICT ON UPDATE RESTRICT
    $f$,
    ref_uni
  );
  EXECUTE format(
    $f$
    ALTER TABLE public.serie_nota_fiscal_servico ADD CONSTRAINT fk_serie_nota_fiscal_servico_id_usuario_auditoria
      FOREIGN KEY (id_usuario_auditoria) REFERENCES public.%I (id_usuario)
      ON DELETE RESTRICT ON UPDATE RESTRICT
    $f$,
    ref_usr
  );
END $$;
