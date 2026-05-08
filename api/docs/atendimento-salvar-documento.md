# POST — Salvar documento de atendimento

**Integração externa (clínica parceira):** ver [integracao-clinica-parceira.md](./integracao-clinica-parceira.md).

## Resumo

- **Sim:** a requisição envia um **corpo JSON** (`application/json`).
- **Rota NestJS:** `POST /atendimentos`
- **Via app web (BFF):** `POST /api/atendimentos` (Next.js encaminha para o backend com o token da sessão).
- **Autenticação:** JWT (`Authorization: Bearer …`). O tenant (`id_tenacidade`) e o usuário vêm do token — **não** devem ser enviados no body para definir tenant.

Uma única chamada persiste, em **transação**, o registro mestre (`infolab_atendimento`) e os detalhes (médicos, convênios, exames-material, pagamentos), a geração de amostras, a gravação de `infolab_lote_b2b_apoio` (integração laboratório de apoio) quando aplicável, o mapa de produção e os pagamentos.

---

## Cabeçalhos

| Cabeçalho        | Valor                          |
|-----------------|---------------------------------|
| `Content-Type`  | `application/json`             |
| `Authorization` | `Bearer <access_token>` (obrigatório no consumo direto da API) |

---

## Corpo da requisição (JSON)

Estrutura de objeto raiz:

```ts
{
  infolab_atendimento: object;           // obrigatório — mestre
  infolab_atendimento_medico?: array;   // opcional — default []
  infolab_atendimento_convenio?: array;
  infolab_atendimento_exame_material?: array;
  infolab_atendimento_pagamento?: array;
  remocoes?: object;                     // opcional — ver secção abaixo
}
```

### 1. `infolab_atendimento` (obrigatório)

Objeto com campos da tabela `infolab_atendimento`. Os identificadores numéricos (`BigInt` no banco) são enviados como **string** no JSON.

| Campo (exemplos usados pelo front) | Descrição |
|-----------------------------------|-----------|
| `id_atendimento`                  | Se **ausente** ou **vazio** → **criação** de novo atendimento (número gerado no servidor). Se **preenchido** → **atualização** desse id. |
| `id_unidade`, `id_procedencia`, `id_cliente`, `id_cid`, `id_orcamento` | Strings numéricas ou vazias; vazio → desliga FK (update) ou não conecta (create conforme regra do service). |
| `identificacao_externa`           | String (até 50 caracteres no update/create). |
| `nome_cliente`, `nome_social`, `codigo_externo` | Strings opcionais. |
| `atendimento_sigiloso`, `atendimento_preferencial` | Normalmente um caractere (`S`/`N` etc.), truncado a 1 no service. |

Outros campos vindos do **GET** do mesmo documento podem ser reenviados (o front faz *merge* com `masterBackend`) para não perder colunas não expostas no formulário.

O servidor preenche auditoria, datas de inclusão, número de atendimento (na criação), etc.

### 2. Arrays de detalhe

Cada item é um objeto alinhado às tabelas `infolab_atendimento_*`. Chaves numéricas vão como **string**.

#### Sincronização (`_sinc`)

Em cada linha de detalhe pode existir o campo:

| `_sinc` | Significado |
|--------|-------------|
| `I`    | Inclusão (novo registro de detalhe). |
| `U`    | Atualização (quando há PK e alteração). |
| `D`    | Exclusão (deve informar a PK da linha). |

Se `_sinc` estiver ausente, o service interpreta assim (`parseSync`):

- há PK preenchida → trata como **`U`**;
- sem PK → trata como **`I`**;
- exceção: se `_sinc === 'I'` e houver PK, vira **`U`**.

#### `infolab_atendimento_medico[]`

Campos típicos: `id_atendimento_medico` (PK, opcional em linha nova), `id_medico` (obrigatório para insert/update). Para exclusão: `_sinc: "D"` e `id_atendimento_medico` preenchido.

#### `infolab_atendimento_convenio[]`

Ex.: `id_atendimento_convenio`, `id_convenio`, `matricula_cartao`, `data_pedido`, `codigo_autorizacao`, `guia_operadora`, `nome_titular` (conforme `atendimento.service.ts`).

#### `infolab_atendimento_exame_material[]`

Ex.: `id_atendimento_exame_material`, `id_exame_material` (obrigatório em insert/update), `id_convenio`, `id_lab_apoio_unidade` (opcional; default herdado do cadastro do exame/material — ver abaixo), `qtd_exame_material`, `valor_exame_material`, `codigo_faturamento`, `observacoes_gerais`.

- `id_lab_apoio_unidade`: FK para `infolab_lab_apoio_unidade` (unidade de apoio / `codigo_b2b`). Se a chave **não for enviada** no insert (`_sinc: 'I'`), o backend copia o valor do cadastro do exame (`infolab_exame_material.id_lab_apoio_unidade`). Para remover explicitamente, envie `id_lab_apoio_unidade: null` no update. A unidade de apoio escolhida deve pertencer à unidade do atendimento; caso contrário, o lote B2B correspondente não é gerado.

#### `infolab_atendimento_pagamento[]`

Ex.: `id_atendimento_pagamento`, `id_convenio`, `id_tipo_pagamento`, `valor_exame_material`, `valor_acrescimo`, `valor_desconto`, `valor_pago`, `data_pagamento`.

Valores decimais podem vir como **string** (ex.: `"10.50"` ou `"10,50"` — o service normaliza).

### 3. `remocoes` (opcional)

Objeto alternativo para apagar por PK **sem** usar linhas `_sinc: 'D'` nos arrays. Cada chave é o **nome do campo PK**; o valor é um **array de ids** (strings numéricas):

```json
{
  "remocoes": {
    "id_atendimento_medico": ["123", "456"],
    "id_atendimento_convenio": ["10"],
    "id_atendimento_exame_material": ["20"],
    "id_atendimento_pagamento": ["30"]
  }
}
```

Ver `aplicarRemocoes` em `atendimento.service.ts`.

---

## Exemplo mínimo (criação)

```json
{
  "infolab_atendimento": {
    "id_cliente": "123",
    "nome_cliente": "João da Silva",
    "id_unidade": "1"
  },
  "infolab_atendimento_medico": [
    { "_sinc": "I", "id_medico": "5" }
  ],
  "infolab_atendimento_convenio": [],
  "infolab_atendimento_exame_material": [],
  "infolab_atendimento_pagamento": []
}
```

## Exemplo (atualização + remoção de médico via `_sinc`)

```json
{
  "infolab_atendimento": {
    "id_atendimento": "999",
    "nome_cliente": "João da Silva"
  },
  "infolab_atendimento_medico": [
    { "_sinc": "D", "id_atendimento_medico": "10" }
  ]
}
```

---

## Resposta de sucesso

Formato (valores bigint serializados como string; datas em ISO):

```json
{
  "id_atendimento": "12345",
  "documento": {
    "infolab_atendimento": { },
    "infolab_atendimento_medico": [ ],
    "infolab_atendimento_convenio": [ ],
    "infolab_atendimento_exame_material": [ ],
    "infolab_atendimento_pagamento": [ ]
  },
  "mensagens_aviso": []
}
```

- **`mensagens_aviso`**: array de textos a exibir ao usuário (ex.: avisos de exame com laboratório de apoio **sem regra DE/PARA**; não indica falha de persistência se o `status` HTTP for 2xx). O app web exibe estes itens com toast após o salvamento.

---

## Erros

- **400** — ex.: `infolab_atendimento` ausente ou inválido; validação de FK obrigatória em detalhe (`biReq`).
- **404** — atualização com `id_atendimento` inexistente ou de outro tenant.

---

## Referência de código

| Peça | Ficheiro |
|------|----------|
| Controller `POST` | `api/src/atendimento/atendimento.controller.ts` |
| `salvarDocumento`, montagem create/update, sincronização | `api/src/atendimento/atendimento.service.ts` |
| Lote B2B apoio na mesma transação | `api/src/atendimento/atendimento-lote-b2b-apoio.ts` |
| `parseSync`, serialização JSON | `api/src/atendimento/atendimento-json.ts` |
| Front: `fetch` + `JSON.stringify` | `web/src/app/atendimento/formulario-cadastro/page.tsx` (`aoSalvar`) |
