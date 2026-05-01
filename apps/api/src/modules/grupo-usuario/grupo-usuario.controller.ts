import type { FastifyRequest } from "fastify";
import { validateBody, validateParams, validateQuery } from "../../shared/validation/validateRequest.js";
import {
  grupoCreateBodySchema,
  grupoIdParamsSchema,
  grupoListQuerySchema,
  grupoUpdateBodySchema,
} from "./grupo-usuario.schema.js";
import { grupoUsuarioService } from "./grupo-usuario.service.js";

export const grupoUsuarioController = {
  async list(request: FastifyRequest) {
    const q = validateQuery(grupoListQuerySchema, request);
    return grupoUsuarioService.list(request.authUser!, q);
  },

  async get(request: FastifyRequest) {
    const params = validateParams(grupoIdParamsSchema, request);
    return grupoUsuarioService.getById(request.authUser!, BigInt(params.id));
  },

  async post(request: FastifyRequest) {
    const body = validateBody(grupoCreateBodySchema, request);
    return grupoUsuarioService.create(request, request.authUser!, body);
  },

  async put(request: FastifyRequest) {
    const params = validateParams(grupoIdParamsSchema, request);
    const body = validateBody(grupoUpdateBodySchema, request);
    return grupoUsuarioService.update(request, request.authUser!, BigInt(params.id), body);
  },

  async destroy(request: FastifyRequest) {
    const params = validateParams(grupoIdParamsSchema, request);
    await grupoUsuarioService.remove(request.authUser!, BigInt(params.id));
    return { ok: true };
  },
};
