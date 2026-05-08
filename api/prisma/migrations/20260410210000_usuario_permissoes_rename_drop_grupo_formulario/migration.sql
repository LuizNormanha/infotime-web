-- Catálogo de telas: slug alinhado ao front.
UPDATE public.infolab_formulario
SET codigo = 'usuario-permissoes',
    descricao = 'Permissões de acesso (infolab_usuario_permissoes)'
WHERE codigo = 'usuario-perfil';

-- Renomeia tabela de permissões por grupo + formulário e PK.
ALTER TABLE IF EXISTS public.infolab_usuario_perfil RENAME TO infolab_usuario_permissoes;

ALTER TABLE IF EXISTS public.infolab_usuario_permissoes
  RENAME COLUMN id_usuario_perfil TO id_usuario_permissao;

-- Índices
ALTER INDEX IF EXISTS idx_usuario_perfil_formulario RENAME TO idx_usuario_permissoes_formulario;
ALTER INDEX IF EXISTS idx_usuario_perfil_grupo RENAME TO idx_usuario_permissoes_grupo;

-- Constraints (nomes estáveis para o Prisma)
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT uq_usuario_perfil_grupo_formulario TO uq_usuario_permissoes_grupo_formulario;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT fk_usuario_perfil_id_grupo_usuario TO fk_usuario_permissoes_id_grupo_usuario;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT fk_usuario_perfil_id_formulario TO fk_usuario_permissoes_id_formulario;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT fk_usuario_perfil_id_usuario_auditoria TO fk_usuario_permissoes_id_usuario_auditoria;

ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT ck_usuario_perfil_administrador TO ck_usuario_permissoes_administrador;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT ck_usuario_perfil_incluir TO ck_usuario_permissoes_incluir;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT ck_usuario_perfil_editar TO ck_usuario_permissoes_editar;
ALTER TABLE public.infolab_usuario_permissoes RENAME CONSTRAINT ck_usuario_perfil_excluir TO ck_usuario_permissoes_excluir;

-- infolab_grupo: remove vínculo opcional com formulário (não confundir com infolab_grupo_usuario).
ALTER TABLE public.infolab_grupo DROP COLUMN IF EXISTS id_formulario;
