import type { FastifyPluginAsync } from "fastify";
import { requireAuth } from "../../shared/auth/authMiddleware.js";
import { requireAdminOrThrow } from "../../shared/rbac/permissionMiddleware.js";
import { usuarioController } from "./usuario.controller.js";

export const usuarioRoutes: FastifyPluginAsync = async (app) => {
  app.addHook("preHandler", requireAuth);
  app.addHook("preHandler", async (request) => {
    requireAdminOrThrow(request);
  });

  app.get("/", usuarioController.list);
  app.get("/:id", usuarioController.get);
  app.post("/", usuarioController.post);
  app.put("/:id", usuarioController.put);
  app.delete("/:id", usuarioController.destroy);
};
