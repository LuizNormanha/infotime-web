# Contexto – Domínio de Login e Sessão

## Objetivo

O domínio **login** define como o usuário acessa o sistema Infotime SaaS, levando em conta:

- Validação da Tenacidade (domínio, expiração de licença).
- Autenticação de usuário por Tenacidade.
- Controle de sessões ativas por usuário e por Tenacidade.
- Controle de limite de licenças simultâneas.
- Fluxo especial de login para usuários Suporte e Implantação.
- Reautenticação em operações sensíveis.

Este domínio integra regras de Tenacidade (licença), Usuário (credenciais e permissões) e Sessão (controle de dispositivos e licenças).

## Entidades envolvidas

### Tenacidade / Configuração da Tenacidade

- Tabela física: `tenacidade_configuracao` (Prisma: `infotime_tenacidade_configuracao`), ligada a `tenacidade` por `id_tenacidade`.
- Campo-chave lógico no login: `dominio_tenacidade` (domínio informado no e-mail na tela de login).
- Campos importantes na **configuração canônica** do laboratório:
  - `data_expiracao` – expiração da licença de uso do SaaS.
  - `chave_jwt` – segredo para assinatura/validação do JWT de usuários comuns daquele tenant.
  - Limite de licenças simultâneas (`quantidade_licenca`) e timeout de sessão (`timeout_sessao_minutos`).

### Usuário

- Representado pela tabela física `usuario` (Prisma: `infotime_usuario`).
- Associado a uma Tenacidade.
- Autenticado por:
  - `login` (único por Tenacidade).
  - `senha` (armazenada como hash/salt).
- Relacionado a grupos de usuário e permissões (ver domínio `usuario`).

### Sessão de Usuário

- Representada pela tabela física `sessao_usuario` (Prisma: `infotime_sessao_usuario`).
- Uma sessão corresponde a um login ativo de usuário comum em um dispositivo/contexto.
- Usada para:
  - Identificar se já existe sessão ativa para o usuário.
  - Controlar quantidade de licenças simultâneas da Tenacidade.
  - Determinar se a sessão está expirada.

### Sessão de Suporte/Implantação

- Representada pela tabela física `sessao_suporte` (Prisma: `infotime_sessao_suporte`).
- Registra logins de usuários especiais de Suporte e Implantação.
- Diferente de usuários comuns:
  - Podem ter múltiplas sessões simultâneas.
  - Não são limitados por licença simultânea da Tenacidade.
  - Podem logar no contexto de qualquer Tenacidade.

### Tela de Login

- Tela inicial do SaaS.
- Permite:
  - Login de usuário comum (login + senha + domínio).
  - Login especial de Suporte ou Implantação (usuário especial + domínio + senha do dia).
- Após autenticação, redireciona para a tela de trabalho, respeitando permissões e menus.

### Tela de Registro Coletor

- Tela específica (domínio `registro_coletor`, detalhado em documento próprio em `ai/domains` quando aplicável ao produto).
- Exige **reautenticação** antes de acesso.
- Pode resultar em:
  - Só revalidar a sessão atual.
  - Ou trocar o usuário logado (logout + login com outro usuário).

## Fluxos principais

### 1. Login de usuário comum

1. Usuário informa:
   - Domínio (da Tenacidade).
   - Login.
   - Senha.

2. Sistema resolve a Tenacidade:
   - Localiza a configuração canônica em `tenacidade_configuracao` pelo `dominio_tenacidade`.
   - Verifica `data_expiracao` em relação à data atual.

3. Validação da expiração da Tenacidade:
   - Se `data_expiracao` < hoje:
     - Bloqueia login.
     - Exibe mensagem para contatar financeiro para regularizar.
   - Se `data_expiracao` – hoje ≤ 10 dias:
     - Permite login, mas exibe aviso de proximidade do vencimento.
   - Se `data_expiracao` – hoje > 10 dias:
     - Segue login normalmente.

4. Após Tenacidade válida:
   - Busca usuário em `usuario` pela combinação (`id_tenacidade`/Tenacidade + `login`).
   - Valida senha do usuário.

5. Se senha válida:
   - Verifica sessões ativas em `sessao_usuario` para o usuário.
   - Se houver sessão ativa:
     - Pergunta ao usuário se deseja continuar no dispositivo atual.
     - Se confirmar:
       - Invalida a sessão anterior.
       - Prossegue o login no novo dispositivo.

6. Controle de licença simultânea:
   - Antes de criar a nova sessão:
     - Executa rotina que remove de `sessao_usuario` todas as sessões já expiradas, mas ainda marcadas como ativas.
   - Depois da limpeza:
     - Verifica se, ao criar a nova sessão, o limite de licenças simultâneas da Tenacidade será ultrapassado.
     - Se não ultrapassar:
       - Cria a nova sessão e redireciona para a tela de trabalho.
     - Se ultrapassar:
       - Bloqueia login, informando que o limite de licenças foi atingido.

### 2. Login especial de Suporte e Implantação

1. Usuário informa:
   - Login no formato `suporte@dominio` ou `implantacao@dominio`.
   - Senha do dia.

2. Sistema identifica que é login de Suporte/Implantação:

- Ignora Tenacidade específica no `usuario`.
- Pode resolver a Tenacidade a partir do domínio informado, mas as permissões são especiais.

3. Validação:

- A **única regra** de autenticação é validar a **senha do dia** (gerada/validada pela API).
- Se a senha do dia estiver correta:
  - Login é permitido.
  - É registrado um novo registro em `sessao_suporte`.

4. Particularidades:

- Usuários de Suporte/Implantação podem ter **mais de uma sessão ativa** ao mesmo tempo.
- Ao logar, é exibida uma tela adicional antes da tela de trabalho, exigindo:
  - Informar o número do caso de suporte, ou
  - Informar manualmente o motivo do suporte (campo texto).
  - Ao menos um dos dois campos deve ser preenchido para seguir.

5. Permissões:

- Esses usuários têm menu extra chamado **Implantação**, com acesso à feature de Tenacidade.
- Possuem **permissão total** no sistema (sem restrição por grupo).

6. Proteção contra tentativas repetidas (IP):

   - O sistema acompanha o número de erros de senha consecutivos por **IP**.
   - Ao atingir **4 erros seguidos** para o mesmo IP, a tela de login passa a exigir um **CAPTCHA progressivo** (por exemplo, primeiro nível simples, depois mais difícil, conforme a insistência).
   - O contador de erros por IP é **zerado** quando uma tentativa de login é bem-sucedida (senha correta).

### 3. Permissões de usuários comuns

- Usuários comuns têm o menu filtrado pelo **grupo de usuário**:
  - Grupos com restrição: só veem menus/funcionalidades permitidos.
  - Grupos "sem restrição": podem ver tudo.
- Permissões de CRUD (incluir, excluir, alterar, visualizar) também são controladas por grupo:
  - Se houver restrições configuradas, o usuário é limitado.
  - Se não houver restrição, o usuário pode fazer tudo (dentro da Tenacidade).

Regras complementares de usuário (por exemplo, alteração de senha) são definidas em `ai/domains/usuario`.

### 4. Sessões expiras e reautenticação

- Todas as requisições passam por uma verificação de sessão antes do redirect:
  - Se a sessão estiver expirada (ou inválida), antes de redirecionar para a ação solicitada:
    - Exibe modal de login.
    - Após validar as credenciais, a requisição é reencaminhada para o processo original.

### 5. Reautenticação na tela de Registro Coletor

- A tela de **registro_coletor** exige reautenticação.
- Se, na reautenticação:
  - For informado **o mesmo usuário** já logado:
    - Apenas valida a senha e redireciona para a tela de registro coletor.
    - Não altera a sessão atual.
  - For informado **um usuário diferente**:
    - Primeiro faz logout do usuário atual:
      - Encerra sessão.
      - Atualiza permissões (como se tivesse clicado em "sair").
    - Em seguida, realiza login com o novo usuário.
    - Redireciona para a tela de registro coletor.

As regras detalhadas da tela de registro coletor estarão em `ai/domains/registro-coletor` (quando o produto incluir esse domínio).
