import type { FastifyRequest } from "fastify";
import { AppError } from "../errors/AppError.js";

/** Piloto: administrador ignora checagem granular. */
export function requireAdminOrThrow(request: FastifyRequest): void {
  if (request.authUser?.administrador) return;
  throw new AppError(403, "FORBIDDEN", "Permissão insuficiente");
}
