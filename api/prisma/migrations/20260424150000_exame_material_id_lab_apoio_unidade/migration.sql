-- id_lab_apoio_unidade em atendimento_exame_material e exame_material (nomes físicos ERP ou Liga).

DO $$
DECLARE
  aem regclass;
  em regclass;
  lau_t text;
  aem_t text;
  em_t text;
BEGIN
  IF to_regclass('public.atendimento_exame_material') IS NOT NULL THEN
    aem := 'public.atendimento_exame_material'::regclass;
    aem_t := 'atendimento_exame_material';
  ELSIF to_regclass('public.infolab_atendimento_exame_material') IS NOT NULL THEN
    aem := 'public.infolab_atendimento_exame_material'::regclass;
    aem_t := 'infolab_atendimento_exame_material';
  ELSE
    aem := NULL;
  END IF;

  IF to_regclass('public.exame_material') IS NOT NULL THEN
    em := 'public.exame_material'::regclass;
    em_t := 'exame_material';
  ELSIF to_regclass('public.infolab_exame_material') IS NOT NULL THEN
    em := 'public.infolab_exame_material'::regclass;
    em_t := 'infolab_exame_material';
  ELSE
    em := NULL;
  END IF;

  IF to_regclass('public.lab_apoio_unidade') IS NOT NULL THEN
    lau_t := 'lab_apoio_unidade';
  ELSIF to_regclass('public.infolab_lab_apoio_unidade') IS NOT NULL THEN
    lau_t := 'infolab_lab_apoio_unidade';
  ELSE
    lau_t := NULL;
  END IF;

  IF lau_t IS NULL THEN
    RAISE NOTICE 'id_lab_apoio_unidade: lab_apoio_unidade ausente — pulando.';
    RETURN;
  END IF;

  IF aem IS NOT NULL THEN
    EXECUTE format('ALTER TABLE %s DROP COLUMN IF EXISTS "id_laboratorio"', aem);
    EXECUTE format('ALTER TABLE %s ADD COLUMN IF NOT EXISTS "id_lab_apoio_unidade" BIGINT', aem);
    EXECUTE format(
      'ALTER TABLE %s DROP CONSTRAINT IF EXISTS fk_atendimento_exame_material_id_lab_apoio_unidade',
      aem
    );
    EXECUTE format(
      $f$
      ALTER TABLE %s ADD CONSTRAINT fk_atendimento_exame_material_id_lab_apoio_unidade
        FOREIGN KEY ("id_lab_apoio_unidade") REFERENCES public.%I ("id_lab_apoio_unidade")
        ON DELETE RESTRICT ON UPDATE RESTRICT
      $f$,
      aem,
      lau_t
    );
    EXECUTE format(
      $f$
      CREATE INDEX IF NOT EXISTS ix_atendimento_exame_material_id_lab_apoio_unidade
        ON public.%I ("id_lab_apoio_unidade")
      $f$,
      aem_t
    );
  END IF;

  IF em IS NOT NULL THEN
    EXECUTE format('ALTER TABLE %s ADD COLUMN IF NOT EXISTS "id_lab_apoio_unidade" BIGINT', em);
    EXECUTE format(
      'ALTER TABLE %s DROP CONSTRAINT IF EXISTS fk_exame_material_id_lab_apoio_unidade',
      em
    );
    EXECUTE format(
      $f$
      ALTER TABLE %s ADD CONSTRAINT fk_exame_material_id_lab_apoio_unidade
        FOREIGN KEY ("id_lab_apoio_unidade") REFERENCES public.%I ("id_lab_apoio_unidade")
        ON DELETE RESTRICT ON UPDATE RESTRICT
      $f$,
      em,
      lau_t
    );
    EXECUTE format(
      $f$
      CREATE INDEX IF NOT EXISTS ix_exame_material_id_lab_apoio_unidade ON public.%I ("id_lab_apoio_unidade")
      $f$,
      em_t
    );
  END IF;
END $$;
