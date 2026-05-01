import { z } from "zod";

export const loginBodySchema = z.object({
  login: z.string().min(1),
  senha: z.string().min(1),
  idTenacidade: z.string().regex(/^\d+$/),
});
