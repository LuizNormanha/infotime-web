# Regras de Tenacidade

Este documento define as **regras obrigatórias** para qualquer implementação (API, UI, serviços) que crie, altere ou consulte Tenacidades.

## Regras de Autorização

1. **Criação de Tenacidade**
   - Apenas os usuários:
     - `suporte@liga.br`
     - `implantacao@liga.br`
   - podem criar novas Tenacidades.
   - Qualquer outro usuário, inclusive de outros domínios que não sejam o domínio administrativo do template (`liga.br`), **não pode** criar/alterar/excluir/visualizar Tenacidades.

2. **Alteração de Tenacidade**
   - Apenas `suporte@liga.br` e `implantacao@liga.br` podem alterar Tenacidades existentes.
   - Usuários fora do domínio administrativo ou com e-mails diferentes destes dois **não podem** alterar Tenacidades.

3. **Exclusão de Tenacidade**
   - **Não é permitido** excluir Tenacidades (nem lógica nem fisicamente).
   - Implementações devem impedir operações de exclusão (DELETE) sobre Tenacidades.

## Regras de Operações Permitidas

1. **Criar Tenacidade**
   - Requer:
     - **Domínio** obrigatório.
     - **Data de expiração inicial** obrigatória.
     - **Quantidade de licenças** (usuários simultâneos) obrigatória (mínimo 1).
     - **`ultimo_ano`**: obrigatório no registro; deve ser persistido como o **ano calendário atual** na criação; **proibido** aceitar outro valor do cliente ou permitir edição no cadastro de tenacidade.
     - **`ultimo_atendimento`**: obrigatório no registro; deve ser persistido como **1** na criação; **proibido** aceitar outro valor do cliente ou permitir edição no cadastro de tenacidade.
   - Deve gerar automaticamente uma `chave_jwt` única e inalterável.

2. **Atualizar Tenacidade**
   - Permitido apenas para `suporte@liga.br` e `implantacao@liga.br`.
   - Operações permitidas:
     - Atualizar limite de usuários simultâneos.
     - Atualizar data de expiração (renovação mediante pagamento).
     - Alterar status (ex.: ativar/desativar).
   - Operação explicitamente proibida:
     - Alterar o domínio da Tenacidade.
     - Alterar **`ultimo_ano`** ou **`ultimo_atendimento`** pelo cadastro de tenacidade (implantação): rejeitar ou ignorar no backend; na UI devem permanecer somente leitura.

3. **Desativar Tenacidade**
   - Desativação é a forma correta de "encerrar" o uso de uma Tenacidade.
   - Deve:
     - Manter todos os dados associados.
     - Alterar apenas o status (ex.: `ativa` → `inativa`).
   - Fluxos de autenticação e uso devem negar operações normais para Tenacidades inativas conforme regra de negócio.

## Regras de Domínio

1. **Obrigatoriedade de Domínio**
   - É proibido criar Tenacidade sem um domínio informado.
   - Implementações devem validar a presença do domínio na criação.

2. **Imutabilidade de Domínio**
   - Após criada, a Tenacidade **não permite alteração de domínio**.
   - Qualquer tentativa de atualizar o domínio deve ser rejeitada com erro apropriado.

## Regras de Limite de Usuários

1. **Configuração**
   - Cada Tenacidade deve possuir um limite configurado de usuários logados simultaneamente.
   - Este limite é definido na criação e pode ser ajustado posteriormente pelos usuários autorizados.

2. **Uso**
   - A camada de autenticação/sessão deve respeitar esse limite.
   - Novos logins devem ser bloqueados ou tratados conforme política definida se o limite for atingido.

## Regras de Data de Expiração

1. **Cadastro**
   - Toda Tenacidade deve ter uma data de expiração definida.
   - A expiração inicial é configurada na criação.

2. **Renovação**
   - A data de expiração é renovada somente mediante confirmação de pagamento em dia (regra de `ai/domains/tenacidade-renovacao-licenca`, quando o produto adotar esse domínio).
   - Atualizações de data de expiração também são restritas aos usuários `suporte@liga.br` e `implantacao@liga.br`.

3. **Comportamento após expiração**
   - Implementações devem prever comportamento quando a data de expiração é ultrapassada (ex.: bloqueio de login, modo somente leitura etc.), conforme especificado em regras de negócio complementares.

## Regras da Chave JWT

1. **Geração Automática**
   - `chave_jwt` deve ser gerada automaticamente no ato da criação da Tenacidade (persistida em **`tenacidade_configuracao`**, linha canônica do laboratório).
   - Não deve ser enviada pelo cliente (front-end) como input.

2. **Imutabilidade**
   - `chave_jwt` é **inalterável manualmente**.
   - Nenhum endpoint ou interface deve permitir a edição da `chave_jwt`.

3. **Uso**
   - A `chave_jwt` é usada para assinar/validar tokens da Tenacidade, compondo a segurança do modelo multi-tenant.
   - Implementações devem tratar a `chave_jwt` como dado sensível (não logar em texto puro, não expor em respostas públicas).

4. **Persistência**
   - Domínio, expiração da licença e `chave_jwt` residem na **configuração da tenacidade** (`tenacidade_configuracao`), não na tabela `tenacidade` isolada.

## Diretrizes de Implementação

- Ao implementar APIs ou serviços relacionados a Tenacidades:
  - Sempre validar o usuário autenticado contra as regras de autorização acima.
  - Não expor operações de exclusão.
  - Rejeitar qualquer tentativa de criar Tenacidades sem domínio.
  - Rejeitar criação sem **data de expiração** ou sem **quantidade de licenças** válida (mínimo 1).
  - Rejeitar qualquer tentativa de alteração de domínio.
  - Garantir que `chave_jwt` seja sempre gerada pelo backend e nunca editável.
  - Persistir `ultimo_ano` como **ano calendário atual** e `ultimo_atendimento` como **1** na criação; não permitir edição pelo cadastro de tenacidade.
  - Implementar validações e mensagens de erro claras quando uma regra for violada.

## Listagem de implantação (`impl-tenacidade`)

- A listagem no shell segue os padrões de `ai/domains/padroes-ui/forms/listagem/README.md` (padrão `LigaListagemBase`). Título/subtítulo de página: regras gerais do shell em `padroes-ui` — **sem** subtítulo de topo quando o padrão shell assim definir; o vínculo com configuração do laboratório aparece nas colunas e neste domínio, não como parágrafo sob o título.
- O endpoint de listagem pode aplicar filtro e paginação **em memória** após montar o conjunto de candidatos (aceitável enquanto o volume for baixo); se o volume crescer, evoluir para consulta paginada no banco sem mudar o contrato `{ dados, total }` do cliente.
