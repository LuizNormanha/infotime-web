import { z } from "zod";

export const listQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.string().optional(),
  sortOrder: z.enum(["asc", "desc"]).optional(),
});

export type ListQueryInput = z.infer<typeof listQuerySchema>;
