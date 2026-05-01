import { z } from 'zod';

// ── Login ────────────────────────────────────────────────────────────────
export const LoginSchema = z.object({
  login: z.string().min(3, 'Login deve ter pelo menos 3 caracteres'),
  senha: z.string().min(6, 'Senha deve ter pelo menos 6 caracteres'),
  tenantId: z.number().int().positive('tenantId inválido'),
});
export type LoginDto = z.infer<typeof LoginSchema>;

// ── Refresh token ─────────────────────────────────────────────────────────
export const RefreshTokenSchema = z.object({
  refreshToken: z.string().min(1, 'refreshToken é obrigatório'),
});
export type RefreshTokenDto = z.infer<typeof RefreshTokenSchema>;

// ── Resposta de login ─────────────────────────────────────────────────────
export interface AuthResponseDto {
  accessToken: string;
  refreshToken: string;
  expiresIn: number;
  user: {
    id: number;
    nome: string;
    email: string;
    role: string;
    tenantId: number;
  };
}
