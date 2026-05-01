import { buildApp } from "./app.js";

// JSON com BigInt (ids Prisma)
// eslint-disable-next-line @typescript-eslint/no-explicit-any
(BigInt.prototype as any).toJSON = function () {
  return this.toString();
};

const host = process.env.API_HOST ?? "0.0.0.0";
const port = Number(process.env.API_PORT ?? 3333);

async function main() {
  const app = await buildApp();
  await app.listen({ host, port });
  console.log(`API Infotime em http://${host}:${port}`);
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});
