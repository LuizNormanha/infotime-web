# Menu do template: padrão enxuto vs catálogo DST

## Menu padrão (recomendado para novos produtos)

- **Arquivo:** [`web/src/data/menu-home-template-infotime.ts`](../web/src/data/menu-home-template-infotime.ts)
- **Papel:** estrutura mínima de navegação (ex.: agrupador “Cadastros” com filhos como login, usuários, tenacidade), sem dezenas de módulos legados.
- **Rótulos e ícones:** [`web/src/data/rotulos-menu-infotime-web.ts`](../web/src/data/rotulos-menu-infotime-web.ts), [`web/src/components/navegacao/menu/liga-menu-icones.ts`](../web/src/components/navegacao/menu/liga-menu-icones.ts), resolução em [`liga-menu-rotulo.ts`](../web/src/components/navegacao/menu/liga-menu-rotulo.ts).
- **Home:** [`LigaHomeNavegacao`](../web/src/components/navegacao/home/LigaHomeNavegacao.tsx) usa esse menu quando não há personalização de layout vinda do banco ou para usuário técnico, conforme a lógica atual do componente.

Ao derivar um produto (Wiki, Med, Prontuário, etc.), **edite ou substitua** essa estrutura e os rótulos: mantenha os **mesmos tipos** (`LigaMenuEstruturaIds` em [`liga-menu-tipos.ts`](../web/src/components/navegacao/menu/liga-menu-tipos.ts)) e os mesmos componentes de UI; só mudam ids, hierarquia e rotas.

## Catálogo DST gerado (legado / opcional)

- **Arquivo:** [`web/src/data/menu-estrutura-dst-gerado.ts`](../web/src/data/menu-estrutura-dst-gerado.ts)
- **Origem:** gerado por script (ex.: `scripts/gerar-menu-desde-dst.mjs`); **não editar à mão** se o fluxo for regenerar o arquivo.
- **Quando usar:** apenas em derivados que precisem **paridade** com telas e módulos do ecossistema DST/Infotime completo. Para um template “só Liga”, você pode remover referências a esse arquivo na navegação ou não incluir telas que dependem dele.

## Renomear o arquivo do menu enxuto (opcional)

O nome `menu-home-template-infotime.ts` deixa explícito que o menu mínimo foi calibrado para InfoTIME Web. Para um repositório totalmente neutro no futuro, pode-se renomear para `menu-home-template.ts` e atualizar imports (buscar por `menu-home-template-infotime`). Isso é cosmético e pode ser feito em um passo separado para não misturar com mudanças de domínio.
