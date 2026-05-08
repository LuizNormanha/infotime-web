/**
 * Servidor MCP Infotime — expõe a tool `infolab.crud_briefing` para briefing de CRUD
 * alinhado ao repositório (Nest, Next, `ai/domains/padroes-ui` e domínio informado).
 */
import { existsSync } from 'node:fs';
import { readFile } from 'node:fs/promises';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

import { McpServer } from '@modelcontextprotocol/sdk/server/mcp.js';
import { StdioServerTransport } from '@modelcontextprotocol/sdk/server/stdio.js';
import * as z from 'zod';

const __dirname = dirname(fileURLToPath(import.meta.url));

/** Sobe até encontrar a pasta raiz do monorepo (`ai/domains` presente). */
function encontrarRaizRepo(): string {
  const env =
    process.env.INFOTIME_REPO_ROOT?.trim() || process.env.INFOLAB_REPO_ROOT?.trim();
  if (env && existsSync(join(env, 'ai', 'domains'))) {
    return env;
  }
  let dir = dirname(__dirname);
  while (dir !== dirname(dir)) {
    if (existsSync(join(dir, 'ai', 'domains'))) {
      return dir;
    }
    dir = dirname(dir);
  }
  return process.cwd();
}

const inputCrudBriefing = z.object({
  entidade: z.string().optional(),
  dominio: z.string().optional(),
  comListagem: z.boolean().default(true),
  comFormulario: z.boolean().default(true),
  formularioSomenteLeitura: z.boolean().default(false),
  formularioEmEtapas: z.boolean().default(false),
  camposObrigatorios: z.array(z.string()).optional().default([]),
  observacoes: z.string().optional(),
});

type InputCrudBriefing = z.infer<typeof inputCrudBriefing>;

async function lerTrechoMarkdown(
  raiz: string,
  dominioPastas: string[],
  arquivo: string,
  maxLinhas: number,
): Promise<string | null> {
  for (const pasta of dominioPastas) {
    const caminho = join(raiz, 'ai', 'domains', pasta, arquivo);
    if (!existsSync(caminho)) continue;
    const texto = await readFile(caminho, 'utf-8');
    const linhas = texto.split('\n').slice(0, maxLinhas);
    return linhas.join('\n');
  }
  return null;
}

function montarMarkdownBriefing(raiz: string, args: InputCrudBriefing): string {
  const nome =
    (args.dominio?.trim() || args.entidade?.trim() || 'dominio').toLowerCase();
  const dominioAi = args.dominio?.trim() || nome;

  const linhas: string[] = [];
  linhas.push(`# Briefing CRUD — ${nome}`);
  linhas.push('');
  linhas.push('## Parâmetros confirmados');
  linhas.push(`- **Domínio / pasta em \`ai/domains\`:** \`${dominioAi}\``);
  linhas.push(`- **Listagem:** ${args.comListagem ? 'sim' : 'não'}`);
  linhas.push(`- **Formulário:** ${args.comFormulario ? 'sim' : 'não'}`);
  linhas.push(
    `- **Formulário somente leitura:** ${args.formularioSomenteLeitura ? 'sim' : 'não'}`,
  );
  linhas.push(
    `- **Formulário em etapas:** ${args.formularioEmEtapas ? 'sim' : 'não'}`,
  );
  linhas.push(
    `- **Campos obrigatórios (primeira versão):** ${args.camposObrigatorios?.length ? args.camposObrigatorios.join(', ') : '(nenhum informado)'}`,
  );
  if (args.observacoes?.trim()) {
    linhas.push(`- **Observações:** ${args.observacoes.trim()}`);
  }
  linhas.push('');
  linhas.push('## Checklist técnico (Infotime)');
  linhas.push(
    '- **Backend:** controller → service → Prisma; DTOs com `class-validator`; tenant via JWT/decorators; **RLS** nas consultas autenticadas.',
  );
  linhas.push(
    '- **Frontend:** `LigaListagemBase` / `LigaFormularioCadastroBase` (ou equivalente já usado no módulo); i18n em `mensagens` quando for o padrão da tela.',
  );
  linhas.push(
    '- **Schema:** não criar colunas/tabelas sem confirmação humana explícita (regra global do repo).',
  );
  linhas.push(
    '- **UX:** confirmação antes de excluir; não exibir PK/FK como identidade principal ao usuário (ver `.cursor/rules/patterns`).',
  );
  linhas.push('');
  linhas.push('## Caminhos de referência no repositório');
  linhas.push(`- \`${join('ai', 'domains', 'padroes-ui', 'Context.md').replace(/\\/g, '/')}\``);
  linhas.push(`- \`${join('ai', 'domains', 'padroes-ui', 'Rules.md').replace(/\\/g, '/')}\``);
  linhas.push(`- \`${join('ai', 'domains', dominioAi, 'Rules.md').replace(/\\/g, '/')}\` (se existir)`);
  linhas.push(
    `- \`${join('.cursor', 'rules', 'crud-telas', 'crud-telas.mdc').replace(/\\/g, '/')}\``,
  );
  linhas.push(
    `- Exemplo de rotas web: \`${join('web', 'src', 'app', '<modulo>', 'listagem', 'page.tsx').replace(/\\/g, '/')}\`, \`${join('web', 'src', 'app', '<modulo>', 'formulario-cadastro', 'page.tsx').replace(/\\/g, '/')}\``,
  );
  linhas.push('');
  linhas.push(`Raiz do repo resolvida para: \`${raiz}\``);
  return linhas.join('\n');
}

async function montarBriefingCompleto(
  raiz: string,
  args: InputCrudBriefing,
): Promise<string> {
  let md = montarMarkdownBriefing(raiz, args);
  const dominioPastas = [
    args.dominio?.trim() || '',
    args.entidade?.trim() || '',
  ].filter(Boolean);

  const trechoRulesPadroes = await lerTrechoMarkdown(
    raiz,
    ['padroes-ui'],
    'Rules.md',
    120,
  );
  if (trechoRulesPadroes) {
    md += '\n\n---\n\n## Trecho de referência — `ai/domains/padroes-ui/Rules.md` (início)\n\n```markdown\n';
    md += trechoRulesPadroes;
    md += '\n```\n';
  }

  if (dominioPastas.length > 0) {
    const trechoDominio = await lerTrechoMarkdown(
      raiz,
      [...new Set(dominioPastas)],
      'Rules.md',
      80,
    );
    if (trechoDominio) {
      md += '\n\n---\n\n## Trecho — Rules.md do domínio (início)\n\n```markdown\n';
      md += trechoDominio;
      md += '\n```\n';
    }
  }

  return md;
}

const instrucoesServidor = [
  'Servidor MCP do monorepo Infotime.',
  'Use a tool infolab.crud_briefing depois de esclarecer listagem, formulário, somente leitura, etapas e campos obrigatórios no chat.',
  'O retorno é texto/markdown com checklist e trechos de documentação do próprio repositório.',
].join(' ');

async function main(): Promise<void> {
  const raiz = encontrarRaizRepo();

  const server = new McpServer(
    { name: 'infotime-mcp', version: '1.0.0' },
    {
      instructions: instrucoesServidor,
    },
  );

  server.registerTool(
    'infolab.crud_briefing',
    {
      title: 'Briefing CRUD Infotime',
      description:
        'Gera briefing com checklist (tenacidade, RLS, layout, componentes base) e trechos de ai/domains com base nos parâmetros do CRUD.',
      inputSchema: inputCrudBriefing,
    },
    async (args: z.infer<typeof inputCrudBriefing>) => {
      const parsed = inputCrudBriefing.safeParse(args);
      if (!parsed.success) {
        return {
          content: [
            {
              type: 'text',
              text: `Entrada inválida: ${parsed.error.message}`,
            },
          ],
          isError: true,
        };
      }
      const p = parsed.data;
      if (!p.entidade?.trim() && !p.dominio?.trim()) {
        return {
          content: [
            {
              type: 'text',
              text: 'Informe ao menos `entidade` ou `dominio` para nomear o briefing.',
            },
          ],
          isError: true,
        };
      }
      const texto = await montarBriefingCompleto(raiz, p);
      return {
        content: [{ type: 'text', text: texto }],
      };
    },
  );

  const transport = new StdioServerTransport();
  await server.connect(transport);
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});
