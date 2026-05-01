import type { FastifyPluginAsync } from "fastify";
import { requireAuth } from "../../shared/auth/authMiddleware.js";
import { requireAdminOrThrow } from "../../shared/rbac/permissionMiddleware.js";
import { grupoUsuarioController } from "./grupo-usuario.controller.js";

export const grupoUsuarioRoutes: FastifyPluginAsync = async (app) => {
  app.addHook("preHandler", requireAuth);
  app.addHook("preHandler", async (request) => {
    requireAdminOrThrow(request);
  });

  app.get("/", grupoUsuarioController.list);
  app.get("/:id", grupoUsuarioController.get);
  app.post("/", grupoUsuarioController.post);
  app.put("/:id", grupoUsuarioController.put);
  app.delete("/:id", grupoUsuarioController.destroy);
};
