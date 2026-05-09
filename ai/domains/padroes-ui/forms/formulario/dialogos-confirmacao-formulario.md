# Diálogos de confirmação em formulário (Liga / PrimeReact)

**Objetivo:** padronizar avisos de **sair sem salvar**, **confirmar exclusão** e fluxos semelhantes em formulários que usam **`LigaFormularioBase`** / barra de ações própria (fora do pipeline `LigaFormularioCadastroBase` + `LigaMensagemPopUp` de dois botões).

## Regras

1. **Não usar** `window.confirm` / `window.alert` para confirmação de exclusão ou para decisões de navegação com impacto em dados — sempre **modal da aplicação**.
2. **Componente:** PrimeReact **`Dialog`** com **`className="liga-mensagem-pop-up"`** para herdar cabeçalho em negrito e tipografia alinhada aos outros modais do projeto.
3. **Estilos compartilhados:** importar **`web/src/components/ui/dialogo/liga-mensagem-pop-up.css`** no TSX do formulário (ou num pai que já carregue esses estilos para o escopo).
4. **Corpo:** um ou mais parágrafos com **`className="liga-mensagem-pop-up-texto"`**; textos **apenas via i18n** (`web/src/app/(comum)/i18n/mensagens/`), chaves agrupadas no namespace do formulário da feature (ex.: `home.clienteInfotime.formulario.*`).
5. **Rodapé:** `div` com **`liga-mensagem-pop-up-rodape`** mais, se precisar, uma classe de módulo para layout (quebra de linha, `justify-content`, largura total).
6. **Botões PrimeReact `Button`:**
   - **`rounded`** (cápsula), alinhado ao restante da UI de toolbar.
   - Ações **secundárias / cancelar / continuar editando:** `severity="secondary"` + **`outlined`**, opcionalmente **`className="liga-mensagem-pop-up-botao-secundario"`**.
   - Ação **arriscada secundária** (ex.: descartar alterações): **`severity="danger"`** + **`outlined`**.
   - Ação **primária positiva** (ex.: salvar e sair): **`className="liga-mensagem-pop-up-botao-primario"`** (salvar com ícone `pi-save` quando fizer sentido).
   - Ação **primária destrutiva** (ex.: confirmar exclusão): **`className="liga-mensagem-pop-up-botao-primario-destrutivo"`** + `severity="danger"` **sem** `outlined`, ícone `pi-trash` quando for exclusão.
7. **Durante operação assíncrona** (salvar, excluir): desativar fechamento pelo **X** e pela **máscara** (`closable={!loading}`, `dismissableMask={!loading}`) e **`onHide`** que ignora o pedido se `loading`; botões de cancelar também **`disabled`** quando aplicável.
8. **Sessão:** manter o padrão **`executarComPrecheckSessao`** + **`solicitarReautenticacaoGlobal`** na ação que chama a API (ex.: DELETE ou PUT), **depois** da confirmação no modal — não é obrigatório abrir o modal já dentro do precheck; o botão “Confirmar” no diálogo pode disparar o precheck + fetch.

## Alterações não salvas ao voltar à listagem

- **Comportamento:** se o utilizador alterou o formulário e escolhe **Voltar à lista**, abrir modal com: **Continuar editando** (fecha o modal), **Descartar alterações** (fecha e navega sem gravar), **Salvar e voltar à lista** (mesma lógica do **Salvar** da barra; em sucesso, fluxo habitual de toast + lista).
- **Deteção de “sujo”:** comparar snapshot estável dos campos (ex.: `JSON.stringify` com datas e coordenadas **normalizadas** para comparação) contra um **baseline** gravado **no mesmo fluxo** em que `carregar` aplica `setCampos` — usar o objeto **`carregado`** (ou `camposVazio()` no novo registo) para `setBaselineComparacao(serializar(…))` **junto** com `setCampos`, **não** um `useEffect` que leia `campos` sem depender dele (evita baseline com estado antigo e falso «sujo» ao voltar sem editar).
- **Efeitos assíncronos no mesmo formulário:** se ViaCEP / Nominatim (ou outro preenchimento automático) alterar `campos` **depois** do baseline inicial, **repor o baseline** com o mesmo snapshot aplicado (ex.: `queueMicrotask(() => setBaselineComparacao(serializar(next)))` no ramo que devolve `next` do `setCampos`), para não tratar coordenadas ou endereço automático como edição do utilizador.
- **Layout do rodapé (três botões):** classe de módulo exemplo **`liga-cliente-infotime-dialogo-pendencia-rodape`** (`flex-wrap`, alinhamento à direita) em `web/src/components/cliente/liga-cliente-infotime.css`.

## Confirmar exclusão

- **Comportamento:** o botão **Excluir** na toolbar só **abre** o modal; a API **DELETE** corre só após **Excluir** no modal, com precheck de sessão.
- **Layout do rodapé (dois botões):** **`liga-cliente-infotime-dialogo-exclusao-rodape`** — `justify-content: space-between`, `width: 100%` (cancelar à esquerda, excluir à direita).

## Implementação de referência

| Tema | Ficheiro |
|------|----------|
| Pendência ao voltar + exclusão + persistência | `web/src/components/cliente/LigaClienteInfotimeFormulario.tsx` |
| Estilos do modal e botão destrutivo | `web/src/components/ui/dialogo/liga-mensagem-pop-up.css` |
| Layouts de rodapé específicos do módulo cliente | `web/src/components/cliente/liga-cliente-infotime.css` |

## Relação com `LigaFormularioCadastroBase`

- O cadastro declarativo (`useCadastroFormulario`) continua a usar **`LigaMensagemPopUp`** para confirmação de exclusão (dois botões). Quando a feature precisar de **mais de duas ações** no mesmo modal ou de alinhar visualmente a estes diálogos, usar **`Dialog`** + classes deste documento em vez de `window.confirm`.
