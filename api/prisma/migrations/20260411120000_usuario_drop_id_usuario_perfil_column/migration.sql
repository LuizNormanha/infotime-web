-- Unifica perfil em id_grupo_usuario e remove coluna redundante id_usuario_perfil em infolab_usuario.
-- (Não confundir com a tabela infolab_usuario_perfil nem com PK id_usuario_perfil dessa tabela.)

-- Perfil de acesso passa a ser o valor de id_usuario_perfil quando existir.
UPDATE public.infolab_usuario
SET id_grupo_usuario = id_usuario_perfil
WHERE id_usuario_perfil IS NOT NULL;

ALTER TABLE public.infolab_usuario
  DROP CONSTRAINT IF EXISTS fk_usuario_id_usuario_perfil;

ALTER TABLE public.infolab_usuario
  DROP COLUMN IF EXISTS id_usuario_perfil;
