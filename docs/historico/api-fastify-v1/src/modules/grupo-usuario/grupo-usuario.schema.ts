import { z } from "zod";

export const grupoListQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.string().optional(),
  sortOrder: z.enum(["asc", "desc"]).optional(),
  filters: z.record(z.unknown()).optional(),
});

export const grupoIdParamsSchema = z.object({
  id: z.string().regex(/^\d+$/),
});

export const grupoCreateBodySchema = z.object({
  descricao: z.string().min(1).max(255),
});

export const grupoUpdateBodySchema = grupoCreateBodySchema.partial();
