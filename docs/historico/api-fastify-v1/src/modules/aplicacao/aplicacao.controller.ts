import type { FastifyRequest } from "fastify";
import { validateBody, validateParams, validateQuery } from "../../shared/validation/validateRequest.js";
import {
  aplicacaoCreateBodySchema,
  aplicacaoIdParamsSchema,
  aplicacaoListQuerySchema,
  aplicacaoUpdateBodySchema,
} from "./aplicacao.schema.js";
import { aplicacaoService } from "./aplicacao.service.js";

export const aplicacaoController = {
  async list(request: FastifyRequest) {
    const q = validateQuery(aplicacaoListQuerySchema, request);
    return aplicacaoService.list(request.authUser!, q);
  },

  async get(request: FastifyRequest) {
    const params = validateParams(aplicacaoIdParamsSchema, request);
    return aplicacaoService.getById(request.authUser!, BigInt(params.id));
  },

  async post(request: FastifyRequest) {
    const body = validateBody(aplicacaoCreateBodySchema, request);
    return aplicacaoService.create(request, request.authUser!, body);
  },

  async put(request: FastifyRequest) {
    const params = validateParams(aplicacaoIdParamsSchema, request);
    const body = validateBody(aplicacaoUpdateBodySchema, request);
    return aplicacaoService.update(request, request.authUser!, BigInt(params.id), body);
  },

  async destroy(request: FastifyRequest) {
    const params = validateParams(aplicacaoIdParamsSchema, request);
    await aplicacaoService.remove(request.authUser!, BigInt(params.id));
    return { ok: true };
  },
};
