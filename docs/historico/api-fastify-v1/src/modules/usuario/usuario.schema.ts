import { z } from "zod";

export const usuarioListQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.enum(["nome", "login", "email"]).optional(),
  sortOrder: z.enum(["asc", "desc"]).optional(),
  filters: z.record(z.unknown()).optional(),
});

export const usuarioIdParamsSchema = z.object({
  id: z.string().regex(/^\d+$/),
});

export const usuarioCreateBodySchema = z.object({
  nome: z.string().min(1).max(100),
  login: z.string().min(1).max(32),
  senha: z.string().min(6).max(200),
  email: z.string().email().max(100).optional().nullable(),
  ativo: z.enum(["sim", "nao"]).default("sim"),
  administrador: z.enum(["sim", "nao"]).default("nao"),
});

export const usuarioUpdateBodySchema = usuarioCreateBodySchema.partial().extend({
  senha: z.string().min(6).max(200).optional(),
});
