import Fastify from "fastify";
import cors from "@fastify/cors";
import jwt from "@fastify/jwt";
import { errorHandler } from "./shared/errors/errorHandler.js";
import { healthRoutes } from "./modules/health/health.routes.js";
import { authRoutes } from "./modules/auth/auth.routes.js";
import { usuarioRoutes } from "./modules/usuario/usuario.routes.js";
import { grupoUsuarioRoutes } from "./modules/grupo-usuario/grupo-usuario.routes.js";
import { aplicacaoRoutes } from "./modules/aplicacao/aplicacao.routes.js";
import { clienteRoutes } from "./modules/cliente/cliente.routes.js";

export async function buildApp() {
  const app = Fastify({ logger: true });

  app.setErrorHandler(errorHandler);

  await app.register(cors, {
    origin: true,
    credentials: true,
  });

  const jwtSecret = process.env.JWT_SECRET;
  if (!jwtSecret) {
    throw new Error("JWT_SECRET não definido");
  }

  await app.register(jwt, {
    secret: jwtSecret,
    sign: { expiresIn: process.env.JWT_EXPIRES_IN ?? "15m" },
  });

  await app.register(healthRoutes, { prefix: "/api" });
  await app.register(authRoutes, { prefix: "/api/auth" });
  await app.register(usuarioRoutes, { prefix: "/api/usuarios" });
  await app.register(grupoUsuarioRoutes, { prefix: "/api/grupos-usuario" });
  await app.register(aplicacaoRoutes, { prefix: "/api/aplicacoes" });
  await app.register(clienteRoutes, { prefix: "/api/clientes" });

  return app;
}
