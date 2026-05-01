import type { FastifyReply, FastifyRequest } from "fastify";
import { validateBody } from "../../shared/validation/validateRequest.js";
import { loginBodySchema } from "./auth.schema.js";
import { authService } from "./auth.service.js";

export const authController = {
  async login(request: FastifyRequest, reply: FastifyReply) {
    const body = validateBody(loginBodySchema, request);
    const idTenacidade = BigInt(body.idTenacidade);
    const { tokenPayload } = await authService.login({
      login: body.login,
      senha: body.senha,
      idTenacidade,
    });

    const token = await reply.jwtSign(tokenPayload);
    return reply.send({
      accessToken: token,
      tokenType: "Bearer",
      expiresIn: process.env.JWT_EXPIRES_IN ?? "15m",
    });
  },
};
