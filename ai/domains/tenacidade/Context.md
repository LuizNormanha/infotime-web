# Contexto de Tenacidade

## Objetivo

Este documento descreve o conceito de **Tenacidade** no Infotime SaaS, seus atributos principais e o contexto de negócio em que é usada.

Tenacidade representa uma **empresa/cliente** do sistema, com suas configurações de acesso (domínio, limites de uso, expiração, chave JWT etc.) e status de contrato.

## Definição de Tenacidade

Uma Tenacidade é a unidade de isolamento lógico dos dados e configurações de cada cliente no modelo multi-tenant.

No banco, a tabela física **`tenacidade`** (Prisma: `infotime_tenacidade`) guarda sobretudo o identificador e o status (`ativo`, auditoria). Os dados de **identidade comercial, domínio, licença (expiração), chave JWT e numeração de atendimento** (`razao_social`, `nome_fantasia`, `chave_acesso`, `data_expiracao`, `ultimo_ano`, `ultimo_atendimento`, `dominio_tenacidade`, `chave_jwt`) ficam na linha canônica de **`tenacidade_configuracao`** (Prisma: `infotime_tenacidade_configuracao`) ligada ao mesmo `id_tenacidade` (tipicamente a configuração com `dominio_tenacidade` preenchido ou a de menor `id_tenacidade_configuracao`).

Cada Tenacidade possui:

- Identificador único interno (`id_tenacidade`).
- Domínio associado (ex.: `laboratorioxyz.br`) **na configuração**, campo único no banco, não é permitido dois domínios iguais.
- Limites de usuários logados simultaneamente.
- Data de expiração do contrato.
- Status (ativa/inativa).
- Chave JWT própria para autenticação/assinatura de tokens.

## Papel do Domínio

- O **domínio** identifica a Tenacidade externa e é requisito obrigatório.
- Uma Tenacidade **não pode existir sem domínio**.
- Uma vez configurado, o domínio é **imutável**: não deve ser alterado depois da criação.
- O domínio também é utilizado para fluxos de autenticação, roteamento ou identificação do tenant.

## Papéis de Usuário Relacionados à Tenacidade

Existem dois perfis especiais, ambos no domínio administrativo do template (`liga.br`):

- `suporte@liga.br`
- `implantacao@liga.br`

Esses usuários representam os papéis internos responsáveis por:

- Criar novas Tenacidades.
- Alterar configurações permitidas de Tenacidades existentes.
- Desativar Tenacidades quando necessário.

Usuários fora desses dois endereços ou fora do domínio administrativo **não devem ter permissão** para visualizar, criar, alterar ou excluir Tenacidades. Cada produto derivado pode definir um domínio administrativo próprio na linha canônica de `tenacidade_configuracao`.

## Campos obrigatórios e travados na configuração (`tenacidade_configuracao`)

Na criação e na manutenção pelo fluxo de implantação / regras de produto:

- **Domínio** (`dominio_tenacidade`): **obrigatório** na criação; imutável após criado.
- **Data de expiração** (`data_expiracao`): **obrigatória** na criação; pode ser renovada depois pelos perfis autorizados.
- **Quantidade de licenças** (`quantidade_licenca`, usuários simultâneos): **obrigatória** na criação (mínimo 1); pode ser ajustada depois pelos perfis autorizados.
- **Último ano** (`ultimo_ano`): **obrigatório** no cadastro; valor fixo **ano calendário atual** no momento da criação; **não permitida edição** via interface nem alteração pela API de implantação.
- **Último atendimento** (`ultimo_atendimento`): **obrigatório** no cadastro; valor fixo **1** na criação; **não permitida edição** via interface nem alteração pela API de implantação.

Esses dois contadores travados existem para padronizar o arranque da numeração/ano do cliente; evoluções futuras do negócio podem passar a atualizá-los por outros processos (ex.: operação de atendimento), fora do cadastro manual de tenacidade.

## Limites de Usuários Simultâneos

Cada Tenacidade tem um **limite máximo de usuários logados simultaneamente**.

Esse limite:

- É configurado no momento da criação da Tenacidade (pelos usuários autorizados).
- Deve ser respeitado pelos mecanismos de sessão/autenticação do sistema.
- Faz parte de regras de cobrança e de plano comercial.

## Data de Expiração e Renovação

Cada Tenacidade possui uma **data de expiração** associada ao contrato.

- A data de expiração é renovada mediante pagamento em dia.
- Após expirada (sem renovação), a Tenacidade emitirá um aviso de 10 dias para regularizar com financeiro, caso contrário irá ser bloqueado o acesso.
- A renovação deve ser controlada pelo fluxo financeiro/comercial, que atualiza a data de expiração.

## Status e Desativação

- Tenacidades **nunca são excluídas fisicamente**.
- Quando necessário, devem ser **desativadas** (status inativa), preservando histórico e integridade referencial.
- Sistemas de listagem e autenticação devem respeitar esse status, impedindo login e uso normal quando inativa, conforme regra de negócio.

## Chave JWT da Tenacidade

- A `chave_jwt` de uma Tenacidade é **gerada automaticamente** no momento da criação.
- Esta chave é **imutável manualmente**: não pode ser alterada por usuários via interface ou API.
- A `chave_jwt` é utilizada para assinar/validar tokens relacionados à Tenacidade, aumentando a segurança do modelo multi-tenant.

## Fluxos de Alto Nível

### Criação de Tenacidade

- Somente `suporte@liga.br` e `implantacao@liga.br` podem criar Tenacidades.
- É obrigatório informar um domínio válido.
- É obrigatória a data de expiração inicial e a quantidade de licenças (mínimo 1).
- A chave JWT é gerada automaticamente.
- `ultimo_ano` e `ultimo_atendimento` são preenchidos pelo sistema (ano atual e **1**), sem edição pelo usuário.

### Atualização de Tenacidade

- Somente `suporte@liga.br` e `implantacao@liga.br` podem alterar Tenacidades.
- O domínio **não pode ser alterado** após a criação.
- Podem ser ajustados limites de usuários, data de expiração e status (ex.: desativar).

### Desativação de Tenacidade

- Somente `suporte@liga.br` e `implantacao@liga.br` podem desativar.
- Desativar não exclui dados, apenas muda o status.
- Serviços do sistema devem considerar esse status para impedir o uso normal da Tenacidade.
