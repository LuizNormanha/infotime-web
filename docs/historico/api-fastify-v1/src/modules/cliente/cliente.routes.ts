import type { FastifyPluginAsync } from "fastify";
import { requireAuth } from "../../shared/auth/authMiddleware.js";
import { clienteController } from "./cliente.controller.js";

export const clienteRoutes: FastifyPluginAsync = async (app) => {
  app.addHook("preHandler", requireAuth);

  app.get("/", clienteController.list);
  app.get("/:id", clienteController.get);
  app.post("/", clienteController.post);
  app.put("/:id", clienteController.put);
  app.delete("/:id", clienteController.destroy);
};
