import type { FastifyRequest } from "fastify";
import { validateBody, validateParams, validateQuery } from "../../shared/validation/validateRequest.js";
import {
  clienteCreateBodySchema,
  clienteIdParamsSchema,
  clienteListQuerySchema,
  clienteUpdateBodySchema,
} from "./cliente.schema.js";
import { clienteService } from "./cliente.service.js";

export const clienteController = {
  async list(request: FastifyRequest) {
    const q = validateQuery(clienteListQuerySchema, request);
    return clienteService.list(request.authUser!, q);
  },

  async get(request: FastifyRequest) {
    const params = validateParams(clienteIdParamsSchema, request);
    return clienteService.getById(request.authUser!, BigInt(params.id));
  },

  async post(request: FastifyRequest) {
    const body = validateBody(clienteCreateBodySchema, request);
    return clienteService.create(request, request.authUser!, body as unknown as Record<string, unknown>);
  },

  async put(request: FastifyRequest) {
    const params = validateParams(clienteIdParamsSchema, request);
    const body = validateBody(clienteUpdateBodySchema, request);
    return clienteService.update(request, request.authUser!, BigInt(params.id), body as unknown as Record<string, unknown>);
  },

  async destroy(request: FastifyRequest) {
    const params = validateParams(clienteIdParamsSchema, request);
    await clienteService.remove(request.authUser!, BigInt(params.id));
    return { ok: true };
  },
};
