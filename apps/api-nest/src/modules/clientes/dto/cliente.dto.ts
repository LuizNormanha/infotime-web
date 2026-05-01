import { z } from 'zod';

export const ClienteCreateSchema = z.object({
  tipoPessoa: z.enum(['F', 'J']).optional().nullable(),
  razaoSocial: z.string().max(255).optional().nullable(),
  nomeFantasia: z.string().max(255).optional().nullable(),
  cnpj: z.string().max(14).optional().nullable(),
  email: z.string().max(100).optional().nullable(),
  telefone: z.string().max(50).optional().nullable(),
  celular: z.string().max(50).optional().nullable(),
  cep: z.string().max(8).optional().nullable(),
  cidade: z.string().max(100).optional().nullable(),
  estado: z.string().max(2).optional().nullable(),
});

export type ClienteCreateDto = z.infer<typeof ClienteCreateSchema>;

export const ClienteUpdateSchema = ClienteCreateSchema.partial();
export type ClienteUpdateDto = z.infer<typeof ClienteUpdateSchema>;
