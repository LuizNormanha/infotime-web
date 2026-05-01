import type { FastifyError, FastifyReply, FastifyRequest } from "fastify";
import { ZodError } from "zod";
import { AppError } from "./AppError.js";

export async function errorHandler(
  error: FastifyError,
  request: FastifyRequest,
  reply: FastifyReply,
): Promise<void> {
  if (error instanceof AppError) {
    await reply.status(error.statusCode).send(error.toJSON());
    return;
  }

  if (error instanceof ZodError) {
    const issues = error.issues ?? [];
    await reply.status(400).send({
      code: "VALIDATION_ERROR",
      message: "Parâmetros inválidos",
      fieldErrors: issues.map((e) => ({
        field: e.path.join("."),
        message: e.message,
      })),
    });
    return;
  }

  request.log.error(error);
  await reply.status(500).send({
    code: "INTERNAL_ERROR",
    message: "Erro interno",
  });
}
