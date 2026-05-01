import path from "node:path";
import { fileURLToPath } from "node:url";
import react from "@vitejs/plugin-react";
import { defineConfig } from "vite";

const monorepoRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "../..");

export default defineConfig({
  /** Lê `VITE_*` do `.env` na raiz do monorepo (não só de `apps/web`). */
  envDir: monorepoRoot,
  plugins: [react()],
  server: {
    port: 5173,
    // Rotas como /api/v1/* são enviadas à API Nest na porta 3333 (prefixo global /api/v1).
    proxy: {
      "/api": {
        // 127.0.0.1 evita falhas de proxy no Windows quando `localhost` resolve só para IPv6.
        target: process.env.VITE_PROXY_API ?? "http://127.0.0.1:3333",
        changeOrigin: true,
      },
    },
  },
});
