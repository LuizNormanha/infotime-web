import { z } from 'zod';

export const CreateUserSchema = z.object({
  nome: z.string().min(3).max(150),
  email: z.string().email().toLowerCase(),
  login: z.string().min(3).max(50),
  senha: z.string().min(8),
  role: z.enum(['admin', 'gestor', 'colaborador', 'cliente', 'readonly']).default('colaborador'),
});
export type CreateUserDto = z.infer<typeof CreateUserSchema>;

export const UpdateUserSchema = CreateUserSchema.partial().omit({ senha: true });
export type UpdateUserDto = z.infer<typeof UpdateUserSchema>;

export const UserQuerySchema = z
  .object({
    page: z.coerce.number().int().min(1).default(1),
    pageSize: z.coerce.number().int().min(1).max(100).optional(),
    limit: z.coerce.number().int().min(1).max(100).optional(),
    search: z.string().optional(),
    ativo: z.enum(['sim', 'nao']).optional(),
  })
  .transform((v) => ({
    page: v.page,
    pageSize: v.pageSize ?? v.limit ?? 20,
    search: v.search,
    ativo: v.ativo,
  }));
export type UserQueryDto = z.infer<typeof UserQuerySchema>;
