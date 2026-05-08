import { SetMetadata } from '@nestjs/common';

export const IS_PUBLIC_KEY = 'isPublic';

/** Marca rota ou controller como pública (sem JWT). Usado com `GuardAutenticacaoJwtMultiTenant` global. */
export const Public = () => SetMetadata(IS_PUBLIC_KEY, true);
