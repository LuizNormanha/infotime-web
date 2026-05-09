# Padrão — endereço com CEP automático, coordenadas e mapa (OpenStreetMap)

Este documento descreve o **comportamento e o layout de referência** para blocos de endereço que combinam máscara de CEP, preenchimento via ViaCEP, geocodificação (Nominatim) e mapa embutido com opção de ampliação em modal.

## Quando usar

- Formulários de cadastro/edição que precisem de **endereço brasileiro**, **latitude/longitude** e **visualização no mapa**.
- Preferir **reutilizar** os mesmos contratos (BFF, domínio e componentes) em novas telas em vez de duplicar chamadas ou máscaras.

## Layout da grade (referência visual)

1. **Linha 1:** CEP (máscara `99999-999`, **sem botão** de consulta) | Logradouro (flexível) | Número | Complemento.
2. **Linha 2:** Bairro | Cidade | Latitude | Longitude | UF (dropdown com rótulo tipo `UF — nome`).
3. **Linha auxiliar:** campos de negócio que não estão na captura “mínima” (ex.: região estadual, tipo de logradouro), conforme o modelo de dados.
4. **Linha de contatos no bloco** (quando o produto agrupar assim): telefone | celular | e-mail | informações adicionais.
5. **Mapa:** rótulo “Localização no mapa”, iframe OSM, botão circular para **modal** com o mesmo mapa ampliado.

Estilos de grade e nomes de classes CSS seguem o prefixo `liga-cliente-infotime-endereco-*` em `web/src/components/cliente/liga-cliente-infotime.css` (referência atual); ao extrair para outro módulo, copiar o padrão de grid ou extrair para classe compartilhada evitando divergência visual.

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

Ao criar outro cadastro com o mesmo padrão, preferir **extrair** hook (`useEnderecoCepGeocodeMapa`) ou subcomponente quando a segunda tela aparecer; até lá, copiar o comportamento destes arquivos mantendo o BFF e o domínio únicos.

## i18n

- Mensagens do bloco ficam sob o namespace já usado pela tela (ex.: `home.clienteInfotime.formulario`): chaves para latitude, longitude, mapa, UF, etc., em `web/src/app/(comum)/i18n/mensagens/pt-BR.json`.
