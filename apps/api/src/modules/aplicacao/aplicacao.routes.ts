import type { FastifyPluginAsync } from "fastify";
import { requireAuth } from "../../shared/auth/authMiddleware.js";
import { requireAdminOrThrow } from "../../shared/rbac/permissionMiddleware.js";
import { aplicacaoController } from "./aplicacao.controller.js";

export const aplicacaoRoutes: FastifyPluginAsync = async (app) => {
  app.addHook("preHandler", requireAuth);
  app.addHook("preHandler", async (request) => {
    requireAdminOrThrow(request);
  });

  app.get("/", aplicacaoController.list);
  app.get("/:id", aplicacaoController.get);
  app.post("/", aplicacaoController.post);
  app.put("/:id", aplicacaoController.put);
  app.delete("/:id", aplicacaoController.destroy);
};
