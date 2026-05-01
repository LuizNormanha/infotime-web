import type { FastifyRequest } from "fastify";
import type { z } from "zod";

export function validateQuery<T extends z.ZodTypeAny>(
  schema: T,
  request: FastifyRequest,
): z.infer<T> {
  return schema.parse(request.query);
}

export function validateBody<T extends z.ZodTypeAny>(
  schema: T,
  request: FastifyRequest,
): z.infer<T> {
  return schema.parse(request.body);
}

export function validateParams<T extends z.ZodTypeAny>(
  schema: T,
  request: FastifyRequest,
): z.infer<T> {
  return schema.parse(request.params);
}
