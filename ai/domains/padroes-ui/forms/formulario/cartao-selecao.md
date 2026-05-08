# Padrão: lookup + cartão de resumo em groupbox (cartão de seleção)

**Contexto:** formulários de cadastro/edição em `web/` onde uma entidade é escolhida por **busca com sugestões** e o usuário precisa **confirmar visualmente** a escolha além do texto do combobox.

**Índice do domínio:** [`../../Rules-indice.md`](../../Rules-indice.md). Normas gerais de formulário: [`README.md`](README.md).

---

## Nome e intenção

**Padrão "seleção por lookup com confirmação visual em cartão"** (abreviado: **lookup + resumo em grupo**).

- **Objetivo:** após buscar e escolher uma entidade (cliente, usuário, contato, convênio, etc.), exibir um **cartão somente leitura** com os principais atributos da seleção.
- **Agrupamento:** o fluxo "buscar → ver resumo" fica em um **groupbox semântico** (`<fieldset>` + `<legend>`), para haver **um único título** de bloco e boa acessibilidade (evita `<label>` redundante só para o lookup quando a legenda já identifica o conjunto).

---

## Quando usar

- A tela exige **FK ou vínculo** escolhido por **lookup** (`LigaLookupCombobox` ou fluxo equivalente).
- O negócio pede **confiança na escolha** (documentos, contatos, códigos, etc.).
- O mesmo desenho se **replica** para outras entidades; mudam o **painel de resumo**, o **contrato de dados** e o **catálogo** da busca.

---

## Estrutura de UI (ordem recomendada)

1. **Groupbox:** `fieldset` com classe de feature (ex.: `*-cliente-fieldset`).
2. **Legenda (`legend`):** nome do domínio na tela ("Cliente", "Usuário", "Convênio"…), via i18n (`tForm("campos....")`).
3. **Lookup** abaixo da legenda. Se a legenda já nomeia o bloco, **não** é obrigatório `<label>` visível no lookup; manter **`aria-label`** (ou associação com a legenda) no controle de busca.
4. **Cartão de resumo** abaixo do lookup: leitura, grade de pares rótulo/valor; estado vazio explícito quando nada estiver selecionado.

---

## Comportamento e dados

- **Seleção no lookup:** atualiza o **id da FK** no estado do formulário e, quando existir, o **detalhe** exibido no cartão (DTO ou objeto dedicado ao painel).
- **Persistência:** campos que o backend espera (ex.: `id_cliente`, `nome_cliente`) permanecem no **estado** e no **payload** mesmo **sem** inputs editáveis na tela — o cartão é **exibição**; a gravação segue as regras da feature e do BFF.
- **Inclusão vs edição:** pode-se **ocultar** campos "de protocolo" ou derivados na **inclusão** se forem preenchidos **automaticamente** a partir da entidade selecionada; na **edição**, manter inputs quando o produto permitir ajuste manual.

---

## Acessibilidade e camadas

- Não retirar **identificação acessível** do lookup ao remover label visível: **`aria-label`** ou **`aria-labelledby`** coerente com a **legenda** do `fieldset`.
- Lista suspensa do lookup não deve ficar **atrás** do cartão: quando necessário, elevar **`z-index`** no wrapper do lookup em **`focus-within`**.

---

## Princípio de reutilização

Um **componente de resumo** por entidade (ou família); props típicas: **`detalhe`**, **`nomeFallback`**, flags como **`omitirTituloNome`**.

| Cenário (exemplo) | Lookup / fluxo | Cartão de resumo (referência) |
|-------------------|----------------|-------------------------------|
| Cliente | `LigaLookupCombobox` + modal | `ClienteResumoCadastroPainel` |
| Usuário | Catálogo da feature | Painel de detalhe da linha |

---

## Referências no código

| Papel | Caminho |
|--------|---------|
| Combobox de lookup | `web/src/components/formulario-cadastro/LigaLookupCombobox.tsx` |
| Cartão cliente (referência) | `web/src/components/cliente/ClienteResumoCadastroPainel.tsx` |

---

## Checklist ao introduzir novo "lookup + resumo"

1. Definir se o bloco fica **dentro ou fora** de `liga-formulario-grupo` (evitar caixas aninhadas sem necessidade).
2. **Legenda** = título único do bloco; lookup com **ARIA** adequado.
3. Estado: **id** + **detalhe** (ou campos espelhados) alinhados na seleção e ao limpar.
4. Payload: garantir que o BFF/API recebe **todos** os campos obrigatórios **sem** depender só de inputs visíveis na inclusão.
5. **i18n:** rótulos do cartão e da legenda nas mensagens da tela (`web/src/app/(comum)/i18n/mensagens/`), evitando string solta no JSX quando o padrão da tela for mensagens.
