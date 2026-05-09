# Padrão — endereço com CEP automático, coordenadas e mapa (OpenStreetMap)

Este documento descreve o **comportamento e o layout de referência** para blocos de endereço que combinam máscara de CEP, preenchimento via ViaCEP, geocodificação (Nominatim) e mapa embutido com opção de ampliação em modal.

**Norma de produto:** qualquer **nova sessão «Endereço»** (ou bloco equivalente) em formulários de cadastro/edição que inclua **endereço brasileiro + mapa/coordenadas** deve **replicar a mesma disposição de campos em linhas e colunas** descrita abaixo e os **tokens de espaçamento** alinhados ao formulário cliente, até existir **componente ou hook partilhado** no repositório. Não inventar layouts alternativos (ordem diferente de CEP/logradouro/número, UF isolada sem a mesma linha de coordenadas, etc.) sem alinhamento explícito de produto.

Normas gerais de UI (botões, foco, shell) — [`normas-transversais-ui-cadastro.md`](normas-transversais-ui-cadastro.md).

## Quando usar

- Formulários de cadastro/edição que precisem de **endereço brasileiro**, **latitude/longitude** e **visualização no mapa**.
- Preferir **reutilizar** os mesmos contratos (BFF, domínio e componentes) em novas telas em vez de duplicar chamadas ou máscaras.

## Layout da grade (referência visual) — obrigatório para novas sessões Endereço

1. **Linha 1:** CEP (máscara `99999-999`, **sem botão** de consulta) | **Tipo de logradouro** (se existir no modelo) | **Logradouro** (faixa flexível, maior peso na grelha) | **Número** | **Complemento**.
2. **Linha 2:** **Bairro** | **Cidade** | **Latitude** | **Longitude** | **UF** (dropdown com rótulo tipo `UF — nome`).
3. **Linha auxiliar:** campos de negócio que não estão na captura “mínima” (ex.: região estadual), conforme o modelo de dados.
4. **Linha de contatos no bloco** (quando o produto agrupar assim): telefone | celular | e-mail | informações adicionais.
5. **Mapa:** rótulo “Localização no mapa”, iframe OSM, botão **Expandir mapa** com a mesma altura/cápsula dos botões de toolbar (`--liga-botao-contorno-*`), **modal** com o mesmo mapa ampliado.

**Implementação de referência (disposição + CSS):**

| Peça | Caminho |
|------|---------|
| JSX das linhas e campos | `web/src/components/cliente/liga-cliente-infotime-formulario-secoes.tsx` (secção endereço) |
| Grelha 7×2, linhas auxiliares, mapa | `web/src/components/cliente/liga-cliente-infotime.css` — prefixo `liga-cliente-infotime-endereco-*` (`--liga-inf-end-*`, `liga-cliente-infotime-endereco-bloco`, `liga-cliente-infotime-endereco-grid-duas-linhas`, …) |

Ao extrair para outro módulo: **copiar o mapa de colunas e nomes de classes** ou extrair para **ficheiro CSS partilhado** + subcomponente (`EnderecoBrLayout` / hook) para não divergir visualmente. Espaçamento entre células: **mesmos tokens** que o resto do formulário com grade Liga — ver [`alinhamento-espacamento-formulario.md`](alinhamento-espacamento-formulario.md) (`--liga-cli-form-gap-col`, `--liga-cli-form-gap-row`, `--liga-cli-form-entre-linhas` no painel cliente).

## Contentor do bloco (foco e rolagem)

- O contentor principal do bloco (ex.: `.liga-cliente-infotime-endereco-bloco`) **não** deve usar `overflow-x: hidden` de forma a recortar o halo de foco nas colunas da esquerda/direita; usar **folga horizontal** (`padding-inline`) e, se necessário, halo de foco **inset** nos inputs conforme [`normas-transversais-ui-cadastro.md`](normas-transversais-ui-cadastro.md).

## Comportamento — CEP e ViaCEP

- Ao completar **8 dígitos**, disparar consulta ao ViaCEP com debounce curto (~450 ms).
- Ao **reduzir** o CEP para menos de 8 dígitos, limpar o estado interno que evita reconsulta, para permitir nova busca ao reinformar o mesmo CEP.
- Não depender de botão “Buscar CEP”: o fluxo é **só digitação**.
- Normalizar texto retornado (ex.: logradouro/bairro/cidade em maiúsculas) alinhado ao restante do formulário.

## Comportamento — geocodificação e coordenadas

- Consultas ao Nominatim devem passar pelo **BFF** autenticado: `GET /api/geo/nominatim?q=...` com `credentials: "include"` (não chamar Nominatim direto do browser em produção).
- Lista de strings de busca e chave de estabilidade do endereço: `web/src/domain/cliente-infotime/nominatim-consulta.ts` (`consultasNominatimInfotime`, `chaveEnderecoInfotimeParaGeocode`).
- Com CEP válido e **ainda sem** cidade/UF (atraso do ViaCEP), ainda assim tentar consulta genérica por CEP + Brasil para não bloquear lat/long.
- Evitar **zerar** o vínculo “geocode já resolvido para este endereço” apenas porque a lista de consultas ficou vazia por um instante (protege coordenadas carregadas do backend).
- Após ViaCEP bem-sucedido, **invalidar** o vínculo de geocode anterior para forçar novo ponto no mapa quando o endereço mudar.

## Persistência

- Se o modelo Prisma/API expuser `latitude` e `longitude`, enviar no JSON de criar/atualizar como `number | null`; campos vazios na UI viram `null`.
- Coordenadas são independentes do texto do endereço até nova geocodificação ou edição manual pelo usuário.

## Componentes e arquivos de referência (implementação atual)

| Papel | Caminho |
|-------|---------|
| Mapa OSM (iframe + estado vazio) | `web/src/components/cliente/ClienteInfotimeEnderecoMapaOsm.tsx` |
| Domínio Nominatim / chave | `web/src/domain/cliente-infotime/nominatim-consulta.ts` |
| UF para dropdown | `web/src/domain/cliente-infotime/ufs-brasil.ts` |
| Rota BFF Nominatim | `web/src/app/api/geo/nominatim/route.ts` |
| Formulário que compõe ViaCEP + efeitos + modal | `web/src/components/cliente/LigaClienteInfotimeFormulario.tsx` |
| Seções e JSX do bloco endereço | `web/src/components/cliente/liga-cliente-infotime-formulario-secoes.tsx` |
| Grelha, mapa, tokens `--liga-inf-end-*` / `--liga-cli-form-*` | `web/src/components/cliente/liga-cliente-infotime.css` |

Ao criar outro cadastro com o mesmo padrão, preferir **extrair** hook (`useEnderecoCepGeocodeMapa`) ou subcomponente quando a segunda tela aparecer; até lá, **copiar o layout (linhas/colunas) e o comportamento** destes ficheiros mantendo o BFF e o domínio únicos.

## i18n

- Mensagens do bloco ficam sob o namespace já usado pela tela (ex.: `home.clienteInfotime.formulario`): chaves para latitude, longitude, mapa, UF, etc., em `web/src/app/(comum)/i18n/mensagens/pt-BR.json`.
