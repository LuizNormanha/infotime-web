# Regras — Padrões de UI (template Liga Sistemas)

Documento **normativo** para implementação de telas no front Next.js e para contratos com a API Nest. Regras de **negócio do produto** ficam no `ai/domains/<domínio-do-produto>/`.

---

## 1. Internacionalização (i18n)

1.1. Textos visíveis ao usuário final devem vir de **next-intl** (arquivos de mensagens), não de literais soltas na página, exceto protótipos descartáveis.

1.2. Listagens: usar chaves para título da tabela, placeholder de busca, mensagem de vazio, rótulos de ações e `aria-label` quando o componente exigir.

---

## 2. Permissões e sessão

2.1. Ações de incluir/editar/excluir devem respeitar o perfil do usuário (BFF + claims), alinhado ao hook/padrão vigente do template (`usePermissaoPerfilTelaAtiva` ou sucessor).

2.2. Chamadas que falham por sessão expirada devem seguir o fluxo global de **reautenticação** documentado em `ai/domains/login`.

---

## 3. Cabeçalho de módulo e títulos

3.1. Título principal da tela: uma linha clara, coerente com o menu.

3.2. Evitar redundância entre menu, breadcrumb e título.

3.3. **Ícone** do título: usar a convenção do shell (PrimeIcons / mapa de ícones do menu).

3.4. Toolbars (Novo, Exportar, filtros): agrupar visualmente de forma consistente com outras listagens do template.

3.5. **Subtítulo** sob o título principal: **omitir** por padrão. Só incluir quando houver necessidade documentada (ex.: explicar vínculo técnico que não cabe nas colunas). Subtítulo genérico que apenas repete o menu deve ser evitado.

---

## 4. Feedback e erros

4.1. Erros de API: mensagem compreensível; evitar vazar stack ou SQL.

4.2. Confirmação antes de **excluir** ou ações irreversíveis.

4.3. Estados de carregamento: não bloquear o shell inteiro sem necessidade; preferir indicador na própria grade ou splash do componente de listagem.

---

## 5. Acessibilidade mínima

5.1. Botões e links com propósito claro; ícones isolados com `aria-label` quando não houver texto visível.

5.2. Tabelas densas: manter contraste e foco visível; não depender só da cor para estado.

---

## 6. Formulários — estrutura geral

6.1. Formulários de cadastro/edição devem usar o **componente base** do template (`LigaFormularioCadastroBase` ou evolução documentada).

6.2. Campos obrigatórios marcados de forma consistente; validação no cliente espelhando regras da API quando possível.

6.3. **Lookups** e combos customizados: respeitar o contrato de teclado e foco esperado pelo componente.

---

## 8. Formulário — foco, rolagem e ordem do layout

8.1. Ao validar o formulário no cliente, o foco deve ir ao **primeiro campo inválido** na ordem de exibição (topo → base, considerando seções).

8.2. Se o campo inválido estiver em outra **seção** (sidebar ou abas), a UI deve **trocar de seção** para exibir o erro antes de focar.

8.3. Em lookups customizados, o elemento focável deve usar **`data-campo-chave`** (ou atributo documentado no componente) para o motor de foco localizar o controle.

8.4. A ordem das seções e campos no layout deve seguir o mesmo fluxo mental do usuário (identificação → dados principais → detalhes → auditoria somente leitura, quando houver).

_Nota: a seção **7** fica reservada para futura regra corporativa (ex.: anexos, assinatura) se o template evoluir._

---

## 9. Listagem — modos de operação

9.1. **Modo CRUD normal:** dados vêm do servidor com paginação; busca rápida e filtros refinados conforme contrato da API.

9.2. **Modo seleção** (modal / lookup): pode omitir o hook de servidor completo por desenho; ainda assim manter colunas, acessibilidade e textos i18n coerentes.

---

## 10. Listagem — filtros refinados e exportação

10.1. Filtros refinados: quando persistidos na URL ou enviados ao servidor, usar serialização acordada (`filtroRefinado` JSON) e debounce se o template definir (evitar tempestade de requisições).

10.2. Exportação CSV (se habilitada): nome de arquivo seguro (sem caracteres proibidos no SO); dados coerentes com colunas visíveis ou conjunto explicitamente documentado.

---

## 11. Listagem — grid servidor (`LigaListagemBase`)

### 11.1. Componente e textos

11.1.1. Usar **`LigaListagemBase`** como padrão para listagens de entidades.

11.1.2. Props de texto (nome da tabela, placeholder, vazio, `ariaLabelAcaoLinha`) devem usar **i18n**.

### 11.2. Chave primária e colunas

11.2.1. Definir explicitamente **`chavePrimaria`** alinhada ao campo retornado pela API (ex.: `id`).

11.2.2. Declarar colunas via **`LigaColunaListagem`** (`liga-listagem.types.ts`).

### 11.3. Ordenação inicial

11.3.1. Quando houver ordenação inicial, usar **`LigaListagemOrdenacaoInicial`** coerente com índices do banco e com o que a API permite.

### 11.4. Datas na grade

11.4.1. Usar **`formatoDataListagem`** explícito (`auto`, `dataHora`, `data`, `texto`) quando o default não for óbvio.

11.4.2. Fuso e formato de exibição: seguir utilitários do template (`formatarDataHoraListagemPtBr`, etc.) para consistência.

### 11.5. Busca no servidor e whitelist

11.5.1. Integração com hook de listagem servidor (ex.: `useListagemCrudServidor`): após guarda `servidor == null`, espalhar **`{...servidor}`** na listagem em modo CRUD normal.

11.5.2. Coluna elegível no dropdown **“Pesquisar por”**: `pesquisaServidor: true` e **`campoConsulta`** igual a um campo permitido na **whitelist** do backend (índice real; sem colunas arbitrárias).

11.5.3. Máscara de busca (`mascaraBuscaServidor`): CPF, CNPJ, data, CEP, telefone — quando aplicável ao domínio.

### 11.6. Contrato de query e resposta

11.6.1. Parâmetros padrão de query incluem: `cargaInicial` (ex.: `primeiraPagina`), `pagina`, `tamanhoPagina`, e quando houver busca: `q` + `campoPesquisa`; quando houver filtros refinados no servidor: `filtroRefinado` (JSON). Ver `web/src/lib/listagem-servidor-query.ts`.

11.6.2. Resposta:** `{ dados: Record<string, unknown>[], total: number }` (nomes podem ser ajustados por projeto, mas o par **lista + total** é obrigatório para paginação).

11.6.3. Para catálogos grandes, filtros e busca devem ser aplicados **no SQL** (ou camada equivalente), não só no cliente.

### 11.7. Exibição de valores e ordem de colunas

11.7.1. **SN / boolean:** usar `valorExibicao: "simNao"` quando o domínio usar S/N.

11.7.2. **Ativo / inativo:** usar `valorExibicao: "ativoInativo"` ou deixar o motor assumir para `campo === "ativo"` quando for o padrão do template.

11.7.3. **Chave técnica:** colunas cuja `campo` coincide com `chavePrimaria` ou com `colunaChavePrimaria: true` são tratadas como técnicas e exibidas **por último à direita** (`ordenarColunasListagemCrud`).

11.7.4. **Células customizadas:** `corpoCelula` pode substituir a formatação padrão; deve permanecer acessível e performática.

### 11.8. Harmonização entre telas

11.8.1. Novas listagens devem **copiar o padrão** de uma tela de referência do mesmo template (ordenar colunas, busca `ativo`, flags SN, etc.), não inventar um layout divergente sem motivo.

11.8.2. Exceções devem ser registradas no `Rules.md` do **domínio do produto**, não neste arquivo.

---

## 12. Alinhamento com a API

12.1. Campos de ordenação e filtro enviados pelo front devem ter par **DTO + validação** no Nest; rejeitar campos não listados.

12.2. Não expor PK/FK como “nome” principal ao usuário quando existir descrição humana; PK pode aparecer como coluna técnica no fim da grade (§11.7).

---

## 13. Uso em novos projetos

13.1. Este arquivo permanece **estável** no template; personalização por cliente ocorre em **`ai/domains/<módulo>`** e no código da entidade.

13.2. Agentes e humanos: em dúvida entre “padrão de tela” e “regra de negócio”, aplicar primeiro este documento para a camada de UI e depois o domínio funcional.
