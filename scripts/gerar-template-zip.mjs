/**
 * Gera ZIP do monorepo atual para uso como template de novo projeto.
 * Saída: templates/monorepo-base/output/<nomePacoteZip>-<timestamp>.zip
 * (pasta raiz dentro do ZIP: `pastaRaizNoZip` em templates/monorepo-base/manifest.json, padrão liga-prj-template).
 *
 * Uso: na raiz do repositório: npm run template:zip
 */
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import { spawnSync } from 'child_process';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const REPO_ROOT = path.resolve(__dirname, '..');

const STAGING_PARENT = path.join(REPO_ROOT, 'templates', 'monorepo-base', '.staging');
const OUTPUT_DIR = path.join(REPO_ROOT, 'templates', 'monorepo-base', 'output');
const DEFAULT_STAGING_FOLDER = 'liga-prj-template';
const DEFAULT_ZIP_BASENAME = 'liga-prj-template';

const EXCLUDE_DIR_NAMES = new Set([
  'node_modules',
  'dist',
  '.next',
  '.nx',
  'coverage',
  '.git',
  'out',
  'build',
]);

const EXCLUDE_PREFIXES = [
  'templates/monorepo-base/.staging',
  'templates/monorepo-base/output',
  '.claude',
];

function toPosix(rel) {
  return rel.split(path.sep).join('/');
}

function shouldSkipPath(absPath, repoRoot) {
  const rel = toPosix(path.relative(repoRoot, absPath));
  if (rel === '' || rel.startsWith('..')) return false;

  const segments = rel.split('/');
  if (segments.some((s) => EXCLUDE_DIR_NAMES.has(s))) return true;

  for (const p of EXCLUDE_PREFIXES) {
    if (rel === p || rel.startsWith(`${p}/`)) return true;
  }

  if (rel === '.cursor' || rel.startsWith('.cursor/')) return true;

  // Logs soltos na raiz (ex.: debug)
  if (segments.length === 1 && /^debug.*\.log$/i.test(segments[0])) return true;

  return false;
}

function copyRecursive(src, dest, repoRoot) {
  if (shouldSkipPath(src, repoRoot)) return;

  const st = fs.statSync(src);
  if (st.isDirectory()) {
    fs.mkdirSync(dest, { recursive: true });
    for (const name of fs.readdirSync(src)) {
      copyRecursive(path.join(src, name), path.join(dest, name), repoRoot);
    }
    return;
  }

  fs.mkdirSync(path.dirname(dest), { recursive: true });
  fs.copyFileSync(src, dest);
}

function copyPartial(src, dest, repoRoot) {
  if (!fs.existsSync(src)) return;
  copyRecursive(src, dest, repoRoot);
}

function rimraf(dir) {
  if (fs.existsSync(dir)) {
    fs.rmSync(dir, { recursive: true, force: true });
  }
}

function ensureDir(dir) {
  fs.mkdirSync(dir, { recursive: true });
}

function timestampSlug() {
  const d = new Date();
  const pad = (n) => String(n).padStart(2, '0');
  return `${d.getFullYear()}${pad(d.getMonth() + 1)}${pad(d.getDate())}-${pad(d.getHours())}${pad(d.getMinutes())}${pad(d.getSeconds())}`;
}

/** Remove paths relative to staging root (use posix `/` in manifest). */
function removerCaminhos(stagingRoot, posixPaths) {
  for (const p of posixPaths ?? []) {
    if (typeof p !== 'string' || !p.trim()) continue;
    const abs = path.join(stagingRoot, ...p.split('/'));
    rimraf(abs);
    console.log('Removido do staging:', p);
  }
}

/** Copia árvore do overlay sobre o staging (arquivos e pastas). */
function aplicarOverlay(overlayDirAbs, stagingRoot) {
  if (!overlayDirAbs || !fs.existsSync(overlayDirAbs)) {
    console.warn('Aviso: pasta overlay ausente, pulando:', overlayDirAbs);
    return;
  }
  function walk(srcDir, destDir) {
    for (const name of fs.readdirSync(srcDir)) {
      const src = path.join(srcDir, name);
      const dest = path.join(destDir, name);
      const st = fs.statSync(src);
      if (st.isDirectory()) {
        ensureDir(dest);
        walk(src, dest);
      } else {
        ensureDir(path.dirname(dest));
        fs.copyFileSync(src, dest);
      }
    }
  }
  walk(overlayDirAbs, stagingRoot);
  console.log('Overlay aplicado:', overlayDirAbs);
}

function createZip(zipOutPath, folderToZip) {
  const folderName = path.basename(folderToZip);
  const parentDir = path.dirname(folderToZip);

  if (process.platform === 'win32') {
    const psPath = folderToZip.replace(/'/g, "''");
    const psZip = zipOutPath.replace(/'/g, "''");
    const cmd = `Compress-Archive -LiteralPath '${psPath}' -DestinationPath '${psZip}' -Force`;
    const r = spawnSync(
      'powershell.exe',
      ['-NoProfile', '-NonInteractive', '-Command', cmd],
      { stdio: 'inherit', cwd: REPO_ROOT },
    );
    if (r.status !== 0) {
      throw new Error(`Compress-Archive falhou com código ${r.status}`);
    }
    return;
  }

  const r = spawnSync('zip', ['-r', '-q', zipOutPath, folderName], {
    cwd: parentDir,
    stdio: 'inherit',
  });
  if (r.status !== 0) {
    throw new Error(`zip falhou com código ${r.status}. Instale zip ou use Windows com PowerShell.`);
  }
}

function main() {
  console.log('Repo raiz:', REPO_ROOT);
  rimraf(STAGING_PARENT);

  const manifestPath = path.join(REPO_ROOT, 'templates', 'monorepo-base', 'manifest.json');
  let manifest = {};
  if (fs.existsSync(manifestPath)) {
    manifest = JSON.parse(fs.readFileSync(manifestPath, 'utf8'));
  }

  const stagingFolder =
    typeof manifest.pastaRaizNoZip === 'string' && manifest.pastaRaizNoZip.trim()
      ? manifest.pastaRaizNoZip.trim()
      : DEFAULT_STAGING_FOLDER;
  const stagingRoot = path.join(STAGING_PARENT, stagingFolder);
  ensureDir(stagingRoot);

  const rootFiles = manifest.rootFiles ?? [
    'package.json',
    'package-lock.json',
    'nx.json',
    '.editorconfig',
    '.gitignore',
    '.nvmrc',
    'SECURITY.md',
    'README.md',
  ];

  for (const f of rootFiles) {
    const src = path.join(REPO_ROOT, f);
    if (!fs.existsSync(src)) {
      console.warn('Aviso: arquivo raiz ausente, ignorando:', f);
      continue;
    }
    const dest = path.join(stagingRoot, f);
    ensureDir(path.dirname(dest));
    fs.copyFileSync(src, dest);
  }

  const topLevelDirs = manifest.topLevelDirs ?? [
    'api',
    'web',
    'scripts',
    'ai',
    'docs',
    'mcp',
    'tools',
    '.github',
    'templates',
  ];

  for (const dir of topLevelDirs) {
    const src = path.join(REPO_ROOT, dir);
    if (!fs.existsSync(src)) {
      console.warn('Aviso: pasta ausente, ignorando:', dir);
      continue;
    }
    copyRecursive(src, path.join(stagingRoot, dir), REPO_ROOT);
  }

  const cursorRules = path.join(REPO_ROOT, '.cursor', 'rules');
  const cursorMcp = path.join(REPO_ROOT, '.cursor', 'mcp.json');
  copyPartial(cursorRules, path.join(stagingRoot, '.cursor', 'rules'), REPO_ROOT);
  if (fs.existsSync(cursorMcp)) {
    ensureDir(path.join(stagingRoot, '.cursor'));
    fs.copyFileSync(cursorMcp, path.join(stagingRoot, '.cursor', 'mcp.json'));
  }

  const readmeOrig = path.join(stagingRoot, 'README.md');
  const readmeBackup = path.join(stagingRoot, 'README.infolab.orig.md');
  if (fs.existsSync(readmeOrig)) {
    fs.renameSync(readmeOrig, readmeBackup);
  }

  const readmeTemplate = path.join(
    stagingRoot,
    'templates',
    'monorepo-base',
    'README-template.md',
  );
  const readmeDest = path.join(stagingRoot, 'README.md');
  if (fs.existsSync(readmeTemplate)) {
    fs.copyFileSync(readmeTemplate, readmeDest);
    console.log('README.md raiz definido a partir de README-template.md');
  } else {
    console.warn('Aviso: README-template.md não encontrado no staging; README raiz não atualizado.');
  }

  const overlayDirPosix =
    typeof manifest.overlayDir === 'string' && manifest.overlayDir.trim()
      ? manifest.overlayDir.trim()
      : 'templates/monorepo-base/overlay';
  const overlayDirAbs = path.join(REPO_ROOT, ...overlayDirPosix.split('/'));

  const apiSrcRemover = (manifest.apiSrcRemover ?? []).map((d) => `api/src/${d}`);
  removerCaminhos(stagingRoot, apiSrcRemover);
  removerCaminhos(stagingRoot, manifest.webRemover ?? []);

  const migrationsModo = manifest.migrationsModo ?? 'keep';
  if (migrationsModo === 'overlay') {
    rimraf(path.join(stagingRoot, 'api', 'prisma', 'migrations'));
    console.log('Migrations do staging substituídas pelo overlay (pasta api/prisma/migrations removida antes do overlay).');
  }

  aplicarOverlay(overlayDirAbs, stagingRoot);

  ensureDir(OUTPUT_DIR);
  const baseName =
    typeof manifest.nomePacoteZip === 'string' && manifest.nomePacoteZip.trim()
      ? manifest.nomePacoteZip.trim()
      : DEFAULT_ZIP_BASENAME;
  const zipName = `${baseName}-${timestampSlug()}.zip`;
  const zipPath = path.join(OUTPUT_DIR, zipName);

  createZip(zipPath, stagingRoot);

  console.log('ZIP gerado:', zipPath);
  console.log('Staging mantido em:', stagingRoot, '(pode apagar com templates/monorepo-base/.staging)');
}

main();
