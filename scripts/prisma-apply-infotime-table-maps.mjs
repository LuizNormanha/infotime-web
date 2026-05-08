/**
 * Ajusta api/prisma/schema.prisma: modelos `infolab_*` → @@map para tabela física
 * sem prefixo (banco `liga_infotime`). Reexecutável (substitui @@map existente).
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");
const schemaPath = path.join(root, "api", "prisma", "schema.prisma");

const text = fs.readFileSync(schemaPath, "utf8");
const lines = text.split(/\r?\n/);

function tableForModel(modelName) {
  if (modelName === "infolab_cliente") return "cliente";
  if (!modelName.startsWith("infolab_")) return null;
  return modelName.slice("infolab_".length);
}

const out = [];
let i = 0;

while (i < lines.length) {
  const line = lines[i];
  const modelMatch = /^model (infolab_\w+) \{/.exec(line);

  if (!modelMatch) {
    out.push(line);
    i += 1;
    continue;
  }

  const modelName = modelMatch[1];
  const table = tableForModel(modelName);
  if (!table) {
    out.push(line);
    i += 1;
    continue;
  }

  out.push(line);
  i += 1;
  let depth = 1;
  const bodyLines = [];

  while (i < lines.length && depth > 0) {
    const li = lines[i];
    const open = (li.match(/\{/g) || []).length;
    const close = (li.match(/\}/g) || []).length;
    depth += open - close;
    if (depth === 0) {
      let wm = bodyLines.filter((l) => !/^\s*@@map\(/.test(l));
      while (wm.length && wm[wm.length - 1].trim() === "") wm.pop();

      let k = wm.length - 1;
      while (k >= 0 && /^\s*@@/.test(wm[k])) k--;

      const mapLine = `  @@map("${table}")`;
      const merged = [...wm.slice(0, k + 1), ...wm.slice(k + 1)];
      if (!merged.includes(mapLine)) merged.push(mapLine);

      out.push(...merged);
      out.push(li);
      i += 1;
      break;
    }
    bodyLines.push(li);
    i += 1;
  }
}

const next = out.join("\n");
if (next !== text) {
  fs.writeFileSync(schemaPath, next, "utf8");
  console.log("schema.prisma atualizado: @@map para tabelas sem prefixo (liga_infotime).");
} else {
  console.log("schema.prisma já estava alinhado.");
}
