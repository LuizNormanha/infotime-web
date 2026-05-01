import { z } from 'zod';

export const ListQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.string().optional(),
  sortOrder: z.enum(['asc', 'desc']).optional(),
  filters: z.record(z.unknown()).optional(),
});

export type ListQueryDto = z.infer<typeof ListQuerySchema>;

export const IdParamSchema = z.object({
  id: z.string().regex(/^\d+$/),
});

export type IdParamDto = z.infer<typeof IdParamSchema>;
