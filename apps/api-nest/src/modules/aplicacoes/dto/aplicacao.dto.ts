import { z } from 'zod';

export const AplicacaoCreateSchema = z.object({
  nome: z.string().min(1).max(255),
  tipo: z.string().max(20).optional().nullable(),
  descricao: z.string().max(255).optional().nullable(),
});

export type AplicacaoCreateDto = z.infer<typeof AplicacaoCreateSchema>;

export const AplicacaoUpdateSchema = AplicacaoCreateSchema.partial();
export type AplicacaoUpdateDto = z.infer<typeof AplicacaoUpdateSchema>;
