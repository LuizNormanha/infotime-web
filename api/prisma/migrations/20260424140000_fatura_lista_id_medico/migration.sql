-- Adiciona filtro de médicos solicitantes à fatura (ERP ou Liga).

DO $$
DECLARE
  f regclass;
BEGIN
  IF to_regclass('public.fatura') IS NOT NULL THEN
    f := 'public.fatura'::regclass;
  ELSIF to_regclass('public.infolab_fatura') IS NOT NULL THEN
    f := 'public.infolab_fatura'::regclass;
  ELSE
    RAISE NOTICE 'fatura: tabela ausente — pulando lista_id_medico.';
    RETURN;
  END IF;

  EXECUTE format('ALTER TABLE %s ADD COLUMN IF NOT EXISTS "lista_id_medico" VARCHAR(4000)', f);
END $$;
