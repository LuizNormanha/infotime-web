import { z } from 'zod';

// ── Create ────────────────────────────────────────────────────────────────
export const CreateUserSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter pelo menos 3 caracteres').max(150),
  email: z.string().email('Email inválido').toLowerCase(),
  login: z.string().min(3).max(50).regex(/^[a-z0-9._-]+$/, 'Login inválido'),
  senha: z
    .string()
    .min(8, 'Senha deve ter pelo menos 8 caracteres')
    .regex(/[A-Z]/, 'Senha deve ter pelo menos uma letra maiúscula')
    .regex(/[0-9]/, 'Senha deve ter pelo menos um número'),
  role: z.enum(['admin', 'gestor', 'colaborador', 'cliente', 'readonly']).default('colaborador'),
});
export type CreateUserDto = z.infer<typeof CreateUserSchema>;

// ── Update ────────────────────────────────────────────────────────────────
export const UpdateUserSchema = CreateUserSchema.partial().omit({ senha: true });
export type UpdateUserDto = z.infer<typeof UpdateUserSchema>;

// ── Change password ───────────────────────────────────────────────────────
export const ChangePasswordSchema = z
  .object({
    senhaAtual: z.string().min(1),
    novaSenha: z.string().min(8),
    confirmarSenha: z.string().min(8),
  })
  .refine((data) => data.novaSenha === data.confirmarSenha, {
    message: 'Senhas não conferem',
    path: ['confirmarSenha'],
  });
export type ChangePasswordDto = z.infer<typeof ChangePasswordSchema>;

// ── Query params (paginação + filtros) ────────────────────────────────────
export const UserQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  limit: z.coerce.number().int().min(1).max(100).default(20),
  search: z.string().optional(),
  role: z.enum(['admin', 'gestor', 'colaborador', 'cliente', 'readonly']).optional(),
  ativo: z.coerce.boolean().optional(),
});
export type UserQueryDto = z.infer<typeof UserQuerySchema>;
