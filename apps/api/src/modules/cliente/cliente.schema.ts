import { z } from "zod";

export const clienteListQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(200).default(20),
  search: z.string().optional(),
  sortField: z.string().optional(),
  sortOrder: z.enum(["asc", "desc"]).optional(),
  filters: z.record(z.unknown()).optional(),
});

export const clienteIdParamsSchema = z.object({
  id: z.string().regex(/^\d+$/),
});

export const clienteCreateBodySchema = z.object({
  tipoPessoa: z.enum(["F", "J"]).optional().nullable(),
  razaoSocial: z.string().max(255).optional().nullable(),
  nomeFantasia: z.string().max(255).optional().nullable(),
  cnpj: z.string().max(14).optional().nullable(),
  email: z.string().email().max(100).optional().nullable(),
  telefone: z.string().max(50).optional().nullable(),
  celular: z.string().max(50).optional().nullable(),
  cep: z.string().max(8).optional().nullable(),
  cidade: z.string().max(100).optional().nullable(),
  estado: z.string().max(2).optional().nullable(),
});

export const clienteUpdateBodySchema = clienteCreateBodySchema.partial();
