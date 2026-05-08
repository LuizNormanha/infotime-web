# Servidor MCP Infotime (`@infolab/mcp-server`)

Expõe a tool **`infolab.crud_briefing`**: gera um briefing em Markdown com checklist (Nest, Next, RLS, componentes base) e trechos de `ai/domains/padroes-ui` e do domínio informado, para o agente usar ao implementar CRUDs.

## Pré-requisito

- **Node.js ≥ 22**
- Build do TypeScript: `npm run build` nesta pasta (gera `dist/index.js`).

## Uso no Cursor (time)

1. **Abra a raiz do monorepo** como workspace no Cursor (`infotime-web`, não só `api` ou `web`), para `ai/domains` e `tools/infolab-mcp` estarem no caminho esperado.
2. O repositório inclui **`.cursor/mcp.json`** com o servidor `infotime`. O Cursor deve carregar automaticamente; se não carregar, em **Settings → MCP** confira se servidores do workspace estão habilitados.
3. Após `git pull`, rode **uma vez** o build (ou use o script na raiz do monorepo):
   ```bash
   cd tools/infolab-mcp && npm ci && npm run build
   ```
4. Reinicie o Cursor se o servidor não aparecer na lista.

### Se `${workspaceFolder}` não for expandido

Substitua nos `args` / `env` pelo caminho absoluto da pasta do clone, por exemplo:

```json
"args": ["C:/prj/trunk-nx/infotime-web/tools/infolab-mcp/dist/index.js"],
"env": {
  "INFOTIME_REPO_ROOT": "C:/prj/trunk-nx/infotime-web",
  "INFOLAB_REPO_ROOT": "C:/prj/trunk-nx/infotime-web"
}
```

### Variável opcional

| Variável | Função |
|----------|--------|
| `INFOTIME_REPO_ROOT` | (Preferida) Raiz do monorepo (onde existe `ai/domains`). |
| `INFOLAB_REPO_ROOT` | Alias da mesma raiz (compatibilidade). Se ambas omitidas, o servidor sobe diretórios a partir de `dist/` até encontrar `ai/domains`. |

## Tool `infolab.crud_briefing`

Parâmetros (JSON), após esclarecer no chat com o usuário:

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `entidade` ou `dominio` | string | Pelo menos um obrigatório (nome lógico / pasta em `ai/domains`). |
| `comListagem` | boolean | default `true` |
| `comFormulario` | boolean | default `true` |
| `formularioSomenteLeitura` | boolean | default `false` |
| `formularioEmEtapas` | boolean | default `false` |
| `camposObrigatorios` | string[] | opcional |
| `observacoes` | string | opcional |

Retorno: texto Markdown para colar no contexto do agente.

## Desenvolvimento

```bash
npm install
npm run build
node dist/index.js
```

(O processo fica aguardando mensagens MCP via **stdio**; para testar manualmente use um cliente MCP ou o Cursor.)
