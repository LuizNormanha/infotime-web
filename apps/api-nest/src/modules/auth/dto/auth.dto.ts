import { z } from 'zod';

export const LoginSchema = z
  .object({
    login: z.string().min(1),
    senha: z.string().min(1),
    tenantId: z.coerce.number().int().positive().optional(),
    idTenacidade: z.union([z.string().regex(/^\d+$/), z.coerce.number().int().positive()]).optional(),
  })
  .transform(({ login, senha, tenantId, idTenacidade }) => {
    const raw = tenantId ?? idTenacidade;
    const n = typeof raw === 'string' ? Number(raw) : raw;
    if (n === undefined || !Number.isFinite(n) || n <= 0) {
      throw new z.ZodError([
        {
          code: 'custom',
          path: ['tenantId'],
          message: 'Informe tenantId ou idTenacidade numérico',
        },
      ]);
    }
    return { login, senha, tenantId: n };
  });
export type LoginDto = z.infer<typeof LoginSchema>;

export const RefreshTokenSchema = z.object({ refreshToken: z.string().min(1) });
export type RefreshTokenDto = z.infer<typeof RefreshTokenSchema>;

export interface AuthResponseDto {
  accessToken: string;
  refreshToken: string;
  expiresIn: number;
  user: {
    id: string;
    nome: string;
    email: string;
    role: string;
    tenantId: string;
  };
}
