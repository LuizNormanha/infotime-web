import type { FastifyPluginAsync } from "fastify";
import { authController } from "./auth.controller.js";

export const authRoutes: FastifyPluginAsync = async (app) => {
  app.post("/login", authController.login);
};
