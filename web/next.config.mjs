import path from "node:path";
import { fileURLToPath } from "node:url";
import createNextIntlPlugin from "next-intl/plugin";

const withNextIntl = createNextIntlPlugin("./src/app/(comum)/i18n/request.ts");

/** Pasta do app Next (`web/`). */
const webRoot = path.dirname(fileURLToPath(import.meta.url));
/** Raiz do monorepo — `next` fica em `node_modules` hoisted aqui (workspaces), não em `web/node_modules`. */
const monorepoRoot = path.resolve(webRoot, "..");

/** Mesma base que o BFF (`API_URL`); usada só para derivar hostname em `allowedDevOrigins`. */
const rawApiUrl = process.env.API_URL ?? "";
const apiHost = rawApiUrl ? new URL(rawApiUrl).hostname : "";

const allowedDevOrigins = process.env.ALLOWED_DEV_ORIGINS
  ? process.env.ALLOWED_DEV_ORIGINS.split(",").map((h) => h.trim()).filter(Boolean)
  : apiHost
    ? [apiHost]
    : [];

// Se alguém rodar `next dev --turbo`: em monorepo Nx (workspaces hoisted) o Turbopack pode
// inferir root errado (paths `web/...` vs filesystem virtual `web`) e panicar em HMR de
// error boundaries. O script `scripts/next-dev-port.mjs` usa `--webpack` no dev para evitar
// isso; manter `root` no monorepo ajuda quem insistir em Turbopack.
const turbopackConfig = {
  root: monorepoRoot,
};

/** @type {import('next').NextConfig} */
const nextConfig = {
  reactCompiler: true,
  transpilePackages: ["primereact"],
  allowedDevOrigins,
  turbopack: turbopackConfig,
};

export default withNextIntl(nextConfig);
