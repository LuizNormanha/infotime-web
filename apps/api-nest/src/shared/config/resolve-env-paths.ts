import { existsSync } from 'node:fs';
import path from 'node:path';

/**
 * Caminhos para `.env` no monorepo (cwd pode ser a raiz ou `apps/api-nest`).
 * O primeiro ficheiro existente tem prioridade no ConfigModule.
 */
export function resolveMonorepoEnvPaths(): string[] {
  const cwd = process.cwd();
  const candidates = [
    path.join(cwd, '.env'),
    path.join(cwd, '..', '.env'),
    path.join(cwd, '..', '..', '.env'),
    path.join(cwd, 'apps', 'api-nest', '.env'),
  ];
  const seen = new Set<string>();
  const out: string[] = [];
  for (const p of candidates) {
    const n = path.normalize(p);
    if (seen.has(n)) continue;
    seen.add(n);
    if (existsSync(n)) out.push(n);
  }
  return out.length ? out : ['.env'];
}
