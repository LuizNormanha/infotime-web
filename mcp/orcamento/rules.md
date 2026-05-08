# Regras – Orçamento (migração CadOrc / `migracao_orcamento`)

Este documento define regras de negócio do orçamento para o cenário de migração (legado CadOrc → `migracao_orcamento`). No roadmap atual, **não haverá CRUD de orçamento no infolab-migracao**; portanto, as regras abaixo são referência conceitual de domínio e de eventual implementação futura. Operações de gravação devem ser transacionais quando houver serviço/aplicação que as execute.

---

## 1. Fluxo de status e transições

1.1. Valores de `status`: `pendente`, `convertido`, `rejeitado`, `vencido`, `cancelado`.

1.2. Transições **válidas** a partir de `pendente` apenas:

- `pendente` → `convertido`
- `pendente` → `rejeitado`
- `pendente` → `vencido`
- `pendente` → `cancelado` (exclusão lógica)

1.3. Qualquer outra transição (incluindo reabrir a partir de estado terminal) deve resultar em **`BadRequestException`**.

1.4. Estados terminais (`convertido`, `rejeitado`, `vencido`, `cancelado`) **não** voltam a `pendente` no escopo atual.

1.5. Em uma implementação de API dedicada, o comando de mudança de status deve receber corpo alinhado a `DtoAtualizarStatusOrcamento`: `status_novo` (`convertido` \| `rejeitado` \| `vencido` \| `cancelado`), `observacao` opcional, `ideate` / `idefic` / `motivo_rejeicao` conforme §3 e §4.

---

## 2. Criação (`POST /orcamentos`)

2.1. **Transação**: criar cabeçalho e todos os itens na mesma transação.

2.2. **`nom_cli`** é **obrigatório** (nome do cliente, 2..100 caracteres na validação de entrada). Orçamento sem nome de cliente não deve ser aceito.

2.3. **`num_cli`** e demais campos de cliente são opcionais (cliente pode não estar cadastrado no destino).

2.4. **Convênios**: no máximo **8** valores não nulos entre `numco1`..`numco8`; slots nulos são ignorados na contagem.

2.5. **Médicos**: no máximo **5** valores não nulos entre `nummed1`..`nummed5`.

2.6. **`valor_desconto`**: se informado, deve ser **≥ 0**.

2.7. **Itens**: `num_ord` deve ser gerado **sequencialmente** a partir de **1** para cada item (1, 2, 3, …). Não aceitar `num_ord` duplicado no mesmo orçamento.

2.8. Orçamento pode ser criado **sem itens** (`itens` vazio ou omitido).

2.9. Validação de item (DtoCriarItemOrcamento): tamanhos máximos `cod_exa` (6), `cod_mae` (15), `copaf1`..`copaf8` (20), `valmed1`..`valmed5` apenas `S` ou `N` quando informados.

---

## 3. Atualização de cabeçalho e substituição de itens (`PUT /orcamentos/:id`)

3.1. Permitido **somente** se `status === 'pendente'`. Caso contrário, lançar **`ForbiddenException`** com a mensagem: `Orçamento não pode ser editado no status atual.`

3.2. Ao substituir itens: **excluir todos** os registros de `migracao_orcamento_item` do orçamento e **recriar** a partir do payload, preservando sequência `num_ord` 1..N dentro da transação.

3.3. Sempre atualizar **`atualizado_em`** no cabeçalho em toda atualização bem-sucedida.

3.4. Dto de atualização: mesmos campos do criar com `@IsOptional` nos opcionais (DtoAtualizarOrcamento).

---

## 4. Conversão (`status_novo = convertido`)

4.1. **`data_conversao`**: deve ser persistida; se não vier no payload, usar **`new Date()`** no servidor.

4.2. **Pelo menos um** entre **`ideate`** e **`idefic`** deve ser informado (números coerentes com atendimento / ficha gerados na operação de conversão).

4.3. Demais campos de rejeição não são obrigatórios nesta transição.

---

## 5. Rejeição (`status_novo = rejeitado`)

5.1. **`motivo_rejeicao`** é **obrigatório** (texto livre).

5.2. **`data_rejeicao`** deve ser definida como **`new Date()`** no momento da operação.

5.3. **`usuario_rejeicao`** deve ser o **e-mail do usuário autenticado** (claims JWT), não um identificador numérico opcional.

---

## 6. Vencimento (`status_novo = vencido`)

6.1. Transição permitida apenas a partir de `pendente`.

6.2. Automação por job (expiração por data) é **opcional**; se inexistente na primeira entrega, apenas transição **manual** via PATCH.

---

## 7. Cancelamento / exclusão lógica (`DELETE /orcamentos/:id`)

7.1. Permitido **somente** se `status === 'pendente'`.

7.2. Efeito: alterar `status` para **`cancelado`** (não remover linha do cabeçalho).

7.3. Se não pendente, responder com erro de negócio apropriado (por exemplo `ForbiddenException` ou `BadRequestException` alinhado ao restante da API).

---

## 8. Itens avulsos (`POST` / `DELETE` em `/orcamentos/:id/itens`)

8.1. Adicionar ou remover item permitido **somente** se `status === 'pendente'`.

8.2. Ao adicionar, calcular o próximo **`num_ord`** disponível (máximo existente + 1, ou 1 se não houver itens).

---

## 9. Listagem (`GET /orcamentos`)

9.1. Query: `busca` opcional, `status` opcional, `pagina` (default 1), `limite` (default 20).

9.2. Se `busca` informada: filtrar por **`nom_cli` ILIKE** e **`codind` ILIKE** (padrão combinado conforme implementação: tipicamente OR entre os dois campos).

9.3. Ordenação: **`atualizado_em DESC`**.

9.4. Resposta inclui: `total`, `pagina`, `limite`, **`porStatus`** (contagens por valor de `status`), **`itens`** (linhas da página atual).

9.5. Cada linha de orçamento deve incluir **contagem de itens** (ex.: `_count.itens` ou campo equivalente).

---

## 10. Cálculos para resposta da listagem

10.1. **Por item** (quando itens são projetados na listagem): campo **`valor_total`** = **máximo** entre `valco1`..`valco8` que forem **não nulos** para aquele item.

10.2. **No cabeçalho da linha de listagem** (agregado): **`valor_orcamento`** = **soma dos `valco1`** de **todos** os itens do orçamento (convênio **1** como referência de apresentação).

10.3. Documentar na UI que esses totais são **convenção de tela**; negócio pode exigir outra base (ex.: convênio escolhido, média, etc.) em evoluções futuras.

---

## 11. Detalhe (`GET /orcamentos/:id`)

11.1. Retornar cabeçalho completo e **todos** os itens ordenados por `num_ord`.

11.2. Se não existir: **`NotFoundException`**.

---

## 12. Identificadores e tipos (API)

12.1. IDs são **BigInt** no Prisma; na rota, receber **`id` como string** e converter com **`BigInt(id)`** no controller, repassando ao service.

12.2. Não usar Swagger / `@ApiProperty` no módulo.

12.3. Imports internos na API com sufixo **`.js`** (padrão ESM do projeto).

---

## 13. UI – listagem (referencial)

13.1. Badges de status sugeridos: **pendente** (amarelo), **convertido** (verde), **rejeitado** (vermelho), **vencido** (cinza), **cancelado** (cinza escuro). Usar **variáveis de tema** Liga; evitar cores hardcoded soltas quando o design system fornecer tokens.

13.2. Coluna “Convênios”: exibir contagem dos slots `numco1`..`numco8` preenchidos (ex.: `3 convênios`).

13.3. Rodapé: resumo textual tipo `X pendentes · Y convertidos · Z rejeitados` usando `porStatus`.

---

## 14. UI – detalhe e dialogs (referencial)

14.1. **Rejeitar**: dialog com motivo obrigatório; validação client-side mínima (ex.: **10 caracteres**); confirmar chama `PATCH` com `status_novo: rejeitado` e `motivo_rejeicao`.

14.2. **Converter**: radio **Atendimento** vs **Pré-Atendimento**; se Atendimento, **ideate** obrigatório; se Pré-Atendimento, **idefic** obrigatório; data de conversão com default **hoje**; confirmar chama `PATCH` com `status_novo: convertido` e campos preenchidos (incl. ISO para data se a API esperar string).

14.3. Tabela de itens: exibir colunas de valor **Val.Conv.1** … **Val.Conv.8** apenas para slots cuja presença de convênio no **cabeçalho** indicar uso (conforme especificação do produto: colunas condicionais aos `numco*` preenchidos).

---

## 15. Formulário novo / editar (referencial)

15.1. **Criação**: seções **Identificação e Cliente**, **Convênios e médicos** (até cinco convênios; médico, procedência, tipo indicação), **Exame/Material** (tabela editável; colunas de valor por convênio conforme cabeçalho), **Financeiro** (desconto, motivo de rejeição quando aplicável), **Observações** (texto livre).

15.2. **Edição**: mesmas abas de cabeçalho; itens podem ser tratados na página de detalhe (evitar duplicar lógica conforme spec).

15.3. Validação client-side: nome do cliente obrigatório; desconto não negativo; mensagens e toasts via **PrimeReact** (Toast).

---

## 16. Consistência transacional

16.1. Criação e substituição total de itens: uma **única** transação; em falha, rollback completo.

16.2. Não persistir cabeçalho novo sem os itens do payload quando o payload incluir itens.

---

## 17. Relação com o SaaS (infotime-web)

17.1. O modelo **`infolab_orcamento`** usa **5** convênios, **1** médico, rejeição por **FK de motivo** e itens com **5** pares valor/código. **Não** aplicar automaticamente as regras deste arquivo ao código SaaS sem análise de paridade.

17.2. Agentes e desenvolvedores devem consultar **`mcp/orcamento/context.md`** para o quadro comparativo e evitar mistura de conceitos.
