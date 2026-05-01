import { z } from 'zod';

export const GrupoCreateSchema = z.object({
  descricao: z.string().min(1).max(255),
});

export type GrupoCreateDto = z.infer<typeof GrupoCreateSchema>;

export const GrupoUpdateSchema = GrupoCreateSchema.partial();
export type GrupoUpdateDto = z.infer<typeof GrupoUpdateSchema>;
