# Remover itens do menu lateral / home com segurança

Prompt padronizado para **ocultar** entradas do menu (navegação lateral e cartões da home) **sem** remoção funcional completa de telas, rotas ou API — salvo pedido explícito em outro fluxo.

---

## Contexto técnico no repositório (confirmado)

| Área | Caminho típico |
|------|----------------|
| Estrutura e rótulos do menu (arquivo **gerado**) | `web/src/data/menu-estrutura-dst-gerado.ts` |
| Comentário no topo do gerado | Indica origem `scripts/gerar-menu-desde-dst.mjs` (**verifique** se o script existe no clone; se não existir, documente edição mínima manual e o risco de sobrescrita). |
| Menu enxuto do template | `web/src/data/menu-home-template-infotime.ts` (apoiado pelos rótulos em `web/src/data/rotulos-menu-infotime-web.ts`) |
| Home / abas por `menuId` | `web/src/components/navegacao/home/LigaHomeNavegacao.tsx` (`MAPA_ABAS_POR_ID_MENU`, etc.) |
| Mensagens de UI | `web/src/app/(comum)/i18n/mensagens/` (ex.: `pt-BR.json`) |
| Regras de domínio por tema | `ai/domains/<dominio>/` (runbook `ai/README.md`) — não usar pasta legada `mcp/` |

---

## Regras do projeto (resumo)

- Textos de interface: preferir **i18n**; não hardcodar strings novas em componentes quando o padrão da tela for mensagens centralizadas.
- **Diff mínimo:** alterar só o necessário para o item sumir do menu e não quebrar **build** / **typecheck**.
- Domínio: seguir documentação em **`ai/domains`** quando houver regra aplicável ao menu ou à solução.

---

## Prompt para colar

Substitua **`[IDS_MENU_SEPARADOS]`** pelos ids exatos (ex.: um só: `cad-acesso-usuario-perfil`; vários: liste na mensagem com vírgulas ou bullets).

Copie **somente** o texto entre os delimitadores abaixo (sem as linhas de crases).

````text
Remover os itens de menu com id exato: [IDS_MENU_SEPARADOS]

Escopo estrito:
- Alterar apenas o mínimo necessário para o item sumir do menu lateral/home e não quebrar build/typecheck.
- Não refatorar outros itens, não renomear ids existentes, não alterar api/, schema Prisma nem rotas BFF, salvo se for inevitável para compilar — nesse caso pare e descreva em 1 frase o motivo.
- Não apagar pastas de telas/componentes nem rotas Next.js a menos que eu peça remoção funcional completa; o objetivo agora é só ocultar do menu.

Onde provavelmente mexer (confirmar no código antes de editar):
- Estrutura do menu: `web/src/data/menu-estrutura-dst-gerado.ts` e/ou fonte que gera esse arquivo (`scripts/gerar-menu-desde-dst.mjs` conforme cabeçalho do gerado, relativo ao pacote web quando existir).
- Menu enxuto do template: `web/src/data/menu-home-template-infotime.ts` (apenas se o id estiver mapeado lá).
- `LigaHomeNavegacao` / `MAPA_ABAS_POR_ID_MENU` em `web/src/components/navegacao/home/LigaHomeNavegacao.tsx` se o id estiver mapeado para aba na home.
- Chaves i18n em `web/src/app/(comum)/i18n/mensagens/` só se sobrarem órfãs e for seguro remover sem afetar outros usos.

Regras do repositório: seguir `ai/domains` quando houver regra de domínio; mensagens de UI via i18n; diff mínimo.

Ao terminar: listar arquivos alterados (lista curta) e dizer se ficou alguma referência ao id removida ou só comentada.

Se o item for gerado por script, preferir ajustar a fonte do gerador + regenerar, em vez de editar só o arquivo gerado à mão, para não perder na próxima geração — indique qual caminho você seguiu.
````

---

## Exemplos de id reais (do template, para teste do fluxo)

Os domínios padrão do template são **`tenacidade`** e **`usuario`**; ids reais existentes em [`web/src/data/menu-estrutura-dst-gerado.ts`](../../../web/src/data/menu-estrutura-dst-gerado.ts) que servem para experimentar o prompt sem comprometer telas críticas:

| Id | Rótulo na UI | Domínio |
|----|--------------|---------|
| `cad-acesso-usuario-perfil` | Permissões | `usuario` |
| `cad-acesso-usuário` | Usuário | `usuario` |
| `impl-tenacidade` | Tenacidade | `tenacidade` |
| `impl-tenacidade-configuracao` | Configuração tenacidade | `tenacidade` |

Confira sempre no arquivo antes de remover — ids podem mudar entre regenerações do menu.

---

## Checklist (quem dispara o prompt)

- [ ] Os **ids** são os strings exatos usados na estrutura do menu (conferir em `menu-estrutura-dst-gerado.ts` ou DST de origem).
- [ ] Objetivo é **só ocultar** no menu, não deletar feature inteira.
- [ ] Se existir script de geração no repositório, combinar com o time antes de editar só o `.ts` gerado.

---

## Manutenção

Ao mudar nomes de arquivos ou local do gerador de menu, atualize a tabela **Contexto técnico** e o bloco **Prompt para colar** neste documento.
