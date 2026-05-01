import type { FastifyReply, FastifyRequest } from "fastify";
import { AppError } from "../errors/AppError.js";
import type { JwtPayload } from "@infotime/shared-types";

declare module "fastify" {
  interface FastifyRequest {
    authUser?: JwtPayload;
  }
}

export async function requireAuth(request: FastifyRequest, _reply: FastifyReply): Promise<void> {
  try {
    const decoded = await request.jwtVerify<JwtPayload>();
    request.authUser = decoded;
  } catch {
    throw new AppError(401, "UNAUTHORIZED", "Token inválido ou ausente");
  }
}
