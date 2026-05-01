import { z } from "zod";

export const aplicacaoListQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.string().optional(),
  sortOrder: z.enum(["asc", "desc"]).optional(),
  filters: z.record(z.unknown()).optional(),
});

export const aplicacaoIdParamsSchema = z.object({
  id: z.string().regex(/^\d+$/),
});

export const aplicacaoCreateBodySchema = z.object({
  nome: z.string().min(1).max(255),
  tipo: z.string().max(20).optional().nullable(),
  descricao: z.string().max(255).optional().nullable(),
});

export const aplicacaoUpdateBodySchema = aplicacaoCreateBodySchema.partial();
