/**
 * Gera docs/ROADMAP_MVP_FASES_INFOLAB.doc (RTF) a partir de docs/ROADMAP_MVP_FASES_INFOLAB.md
 * para abertura no Microsoft Word. Uso: node scripts/generate-roadmap-rtf.mjs
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const root = join(__dirname, '..');
const mdPath = join(root, 'docs', 'ROADMAP_MVP_FASES_INFOLAB.md');
const outPath = join(root, 'docs', 'ROADMAP_MVP_FASES_INFOLAB.doc');

const md = readFileSync(mdPath, 'utf8');

function escapeRtfUnicode(str) {
  let out = '';
  for (let i = 0; i < str.length; i++) {
    const c = str[i];
    const code = c.charCodeAt(0);
    if (c === '\r') continue;
    if (c === '\n') {
      out += '\\par\n';
      continue;
    }
    if (c === '\\') {
      out += '\\\\';
      continue;
    }
    if (c === '{') {
      out += '\\{';
      continue;
    }
    if (c === '}') {
      out += '\\}';
      continue;
    }
    if (code < 128) {
      out += c;
    } else {
      const signed = code > 32767 ? code - 65536 : code;
      out += `\\u${signed}?`;
    }
  }
  return out;
}

/** Remove marcação Markdown leve para RTF (negrito, links, crases inline). */
function stripMdInline(s) {
  return s
    .replace(/\*\*([^*]+)\*\*/g, '$1')
    .replace(/`([^`]+)`/g, '$1')
    .replace(/\[([^\]]+)]\([^)]+\)/g, '$1');
}

function processMarkdownToRtfBody(text) {
  const lines = text.split(/\n/);
  const state = { inCode: false };
  const parts = [];

  for (const line of lines) {
    const t = line.trimEnd();

    if (state.inCode) {
      if (t.trim().startsWith('```')) {
        state.inCode = false;
        parts.push('\\par ');
      } else {
        parts.push(`{\\f1\\fs20 ${escapeRtfUnicode(t)}\\par}`);
      }
      continue;
    }

    if (t.trim().startsWith('```')) {
      state.inCode = true;
      continue;
    }

    if (t.trim() === '---') {
      parts.push('\\brdrb\\brdrs\\brdrw10\\brsp20 \\line\\par ');
      continue;
    }

    if (t.startsWith('# ')) {
      parts.push(
        `{\\fs36\\b ${escapeRtfUnicode(stripMdInline(t.slice(2)))}\\b0\\par\\par}`,
      );
      continue;
    }
    if (t.startsWith('## ')) {
      parts.push(
        `{\\fs28\\b ${escapeRtfUnicode(stripMdInline(t.slice(3)))}\\b0\\par\\par}`,
      );
      continue;
    }
    if (t.startsWith('### ')) {
      parts.push(
        `{\\fs26\\b ${escapeRtfUnicode(stripMdInline(t.slice(4)))}\\b0\\par}`,
      );
      continue;
    }

    if (t.startsWith('|')) {
      const cells = t
        .split('|')
        .map((s) => s.trim())
        .filter(Boolean);
      if (cells.length && cells.every((c) => /^[-:]+$/.test(c))) {
        continue;
      }
      parts.push(
        `{\\f0 ${escapeRtfUnicode(stripMdInline(cells.join(' | ')))}\\par}`,
      );
      continue;
    }

    if (t.trim() === '') {
      parts.push('\\par ');
      continue;
    }

    parts.push(
      `{\\f0 ${escapeRtfUnicode(stripMdInline(t))}\\par}`,
    );
  }

  return parts.join('');
}

const body = processMarkdownToRtfBody(md);

const rtf = `{\\rtf1\\ansi\\ansicpg1252\\deff0\\nouicompat\\deflang1046
{\\fonttbl{\\f0\\fnil\\fcharset0 Calibri;}{\\f1\\fnil\\fcharset0 Consolas;}}
{\\*\\generator generate-roadmap-rtf.mjs}
\\viewkind4\\uc1
\\pard\\sa200\\sl276\\slmult1\\f0\\fs22\\lang1046
${body}
}`;

writeFileSync(outPath, rtf, 'utf8');

console.log('Gerado:', outPath);
