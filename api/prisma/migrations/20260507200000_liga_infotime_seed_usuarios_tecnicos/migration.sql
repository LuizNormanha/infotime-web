-- liga-prj-template / InfoTIME ERP: cria usuários técnicos globais (`suporte` e `implantacao`)
-- esperados pelo fluxo `loginSuporte` quando a parte local do e-mail é um login reservado.
-- Idempotente: só insere se não existir login global com o mesmo nome.

DO $$
DECLARE
  rls_estava_habilitada BOOLEAN := FALSE;
  proximo_id BIGINT;
BEGIN
  IF to_regclass('public.usuario') IS NULL THEN
    RETURN;
  END IF;

  -- Desabilita RLS apenas durante o seed (LigaMaster pode não ser BYPASSRLS).
  IF EXISTS (
    SELECT 1 FROM pg_tables WHERE schemaname='public' AND tablename='usuario' AND rowsecurity=true
  ) THEN
    rls_estava_habilitada := TRUE;
    EXECUTE 'ALTER TABLE public.usuario DISABLE ROW LEVEL SECURITY';
  END IF;

  -- O ERP InfoTIME mantém id_usuario sem default; seed calcula próximo id explicitamente.
  -- suporte (global, id_tenacidade NULL)
  IF NOT EXISTS (
    SELECT 1 FROM public.usuario
     WHERE LOWER(login) = 'suporte' AND id_tenacidade IS NULL
  ) THEN
    SELECT COALESCE(MAX(id_usuario), 0) + 1 INTO proximo_id FROM public.usuario;
    INSERT INTO public.usuario (
      id_usuario, id_tenacidade, login, nome, email, ativo,
      administrador, nome_aplicacao_auditoria
    ) VALUES (
      proximo_id, NULL, 'suporte', 'Suporte LIGA (técnico)', 'suporte@liga.inf.br', 'Y',
      'YES', 'liga-prj-template:seed'
    );
  END IF;

  -- implantacao (global, id_tenacidade NULL)
  IF NOT EXISTS (
    SELECT 1 FROM public.usuario
     WHERE LOWER(login) = 'implantacao' AND id_tenacidade IS NULL
  ) THEN
    SELECT COALESCE(MAX(id_usuario), 0) + 1 INTO proximo_id FROM public.usuario;
    INSERT INTO public.usuario (
      id_usuario, id_tenacidade, login, nome, email, ativo,
      administrador, nome_aplicacao_auditoria
    ) VALUES (
      proximo_id, NULL, 'implantacao', 'Implantação LIGA (técnico)', 'implantacao@liga.inf.br', 'Y',
      'YES', 'liga-prj-template:seed'
    );
  END IF;

  -- Garante ambos ativos (idempotente também caso já existissem inativos).
  UPDATE public.usuario
     SET ativo = 'Y'
   WHERE id_tenacidade IS NULL
     AND LOWER(login) IN ('suporte', 'implantacao')
     AND COALESCE(ativo, 'N') NOT IN ('S', 'Y');

  IF rls_estava_habilitada THEN
    EXECUTE 'ALTER TABLE public.usuario ENABLE ROW LEVEL SECURITY';
  END IF;
END $$;
