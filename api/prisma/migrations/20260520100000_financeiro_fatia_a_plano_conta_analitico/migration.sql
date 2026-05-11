-- Fatia A — colunas analíticas em infotime_plano_conta (DRE / DFC / balanço). Idempotente.

ALTER TABLE public.infotime_plano_conta
  ADD COLUMN IF NOT EXISTS natureza_dre varchar(30) NULL;
ALTER TABLE public.infotime_plano_conta
  ADD COLUMN IF NOT EXISTS natureza_dfc varchar(30) NULL;
ALTER TABLE public.infotime_plano_conta
  ADD COLUMN IF NOT EXISTS grupo_contabil varchar(30) NULL;

CREATE INDEX IF NOT EXISTS idx_infotime_plano_conta_natureza_dre
  ON public.infotime_plano_conta (natureza_dre)
  WHERE natureza_dre IS NOT NULL;
CREATE INDEX IF NOT EXISTS idx_infotime_plano_conta_natureza_dfc
  ON public.infotime_plano_conta (natureza_dfc)
  WHERE natureza_dfc IS NOT NULL;
CREATE INDEX IF NOT EXISTS idx_infotime_plano_conta_grupo_contabil
  ON public.infotime_plano_conta (grupo_contabil)
  WHERE grupo_contabil IS NOT NULL;
