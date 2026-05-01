import type { FastifyRequest } from "fastify";
import { validateBody, validateParams, validateQuery } from "../../shared/validation/validateRequest.js";
import {
  usuarioCreateBodySchema,
  usuarioIdParamsSchema,
  usuarioListQuerySchema,
  usuarioUpdateBodySchema,
} from "./usuario.schema.js";
import { usuarioService } from "./usuario.service.js";

export const usuarioController = {
  async list(request: FastifyRequest) {
    const q = validateQuery(usuarioListQuerySchema, request);
    const auth = request.authUser!;
    return usuarioService.list(auth, q);
  },

  async get(request: FastifyRequest) {
    const params = validateParams(usuarioIdParamsSchema, request);
    const auth = request.authUser!;
    return usuarioService.getById(auth, BigInt(params.id));
  },

  async post(request: FastifyRequest) {
    const body = validateBody(usuarioCreateBodySchema, request);
    const auth = request.authUser!;
    return usuarioService.create(request, auth, body);
  },

  async put(request: FastifyRequest) {
    const params = validateParams(usuarioIdParamsSchema, request);
    const body = validateBody(usuarioUpdateBodySchema, request);
    const auth = request.authUser!;
    return usuarioService.update(request, auth, BigInt(params.id), body);
  },

  async destroy(request: FastifyRequest) {
    const params = validateParams(usuarioIdParamsSchema, request);
    const auth = request.authUser!;
    await usuarioService.remove(auth, BigInt(params.id));
    return { ok: true };
  },
};
