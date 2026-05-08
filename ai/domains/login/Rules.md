# Regras – Domínio de Login e Sessão

Este documento define as regras obrigatórias para o processo de login, controle de sessão e uso de licenças simultâneas no Infotime SaaS, inclusive o fluxo especial para Suporte/Implantação.

## 1. Resolução de Tenacidade no login de usuário comum

1.1. Para login de usuário comum, o sistema deve receber um **domínio** informado na tela de login.

1.2. A Tenacidade deve ser identificada consultando `infolab_tenacidade_configuracao` pelo campo `dominio_tenacidade`.

1.3. Se nenhuma Tenacidade for encontrada para o domínio informado:

- O login deve ser rejeitado com mensagem clara (ex.: “Domínio não encontrado”).

1.4. Uma vez identificada a Tenacidade, todas as regras a seguir (expiração, limite de licenças, busca de usuário) devem ser aplicadas dentro deste contexto.

## 2. Validação de expiração da Tenacidade

2.1. O campo `data_expiracao` da Tenacidade deve ser comparado com a data atual.

2.2. Se `data_expiracao` < data atual:

- O login deve ser **bloqueado**.
- A mensagem ao usuário deve informar que a licença está expirada e que é necessário entrar em contato com o financeiro para regularização.

2.3. Se `data_expiracao` estiver a **10 dias** ou menos da data atual:

- O login deve ser permitido.
- Deve ser exibido um **aviso** ao usuário (ou ao menos aos administradores) sobre a proximidade do vencimento.

2.4. Se `data_expiracao` estiver a mais de 10 dias da data atual:

- O login segue normalmente, sem aviso.

## 3. Autenticação de usuário comum por Tenacidade

3.1. Após Tenacidade válida, o sistema deve:

- Buscar o usuário em `infolab_usuario` pela combinação (`tenant_id` da Tenacidade + `login` informado).

3.2. Se o usuário não for encontrado:

- O login deve ser rejeitado com mensagem genérica (ex.: “Usuário ou senha inválidos”).
- Deve ser contabilizada uma tentativa de erro de login para o **IP** de origem.

3.3. Se o usuário for encontrado:

- A senha informada deve ser validada comparando o valor informado com o hash armazenado (`senha_hash`), utilizando algoritmo seguro.[web:137][web:139][web:151]

3.4. Se a senha estiver incorreta:

- O login deve ser rejeitado com mensagem genérica (sem indicar especificamente que foi a senha).
- Deve ser incrementado o contador de **erros consecutivos** associado ao IP de origem.

3.5. Se a senha estiver correta:

- O contador de erros de login para aquele IP deve ser **zerado**.
- Prosseguir para as verificações de sessão e licença simultânea.

Proteção contra múltiplos erros seguidos por IP (CAPTCHA)

3.5.1. O sistema deve manter, em memória ou em tabela apropriada, um contador de **erros consecutivos de login por IP**.

3.5.2. Ao atingir **4 erros consecutivos** para o mesmo IP:

- O próximo passo de login desse IP deve exigir a resolução de um **CAPTCHA progressivo** (ex.: reCAPTCHA ou componente equivalente).
- Enquanto o CAPTCHA não for resolvido corretamente, nenhuma tentativa de validação de senha deve ser executada para aquele IP.

3.5.3. Após um login bem-sucedido (senha correta, seja de usuário comum ou de Suporte/Implantação):

- O contador de erros para aquele IP deve ser **zerado**.
- Em consequência, o CAPTCHA deixa de ser exigido até que o IP acumule novamente 4 erros seguidos.

3.5.4. A lógica de incremento e reset do contador deve considerar:

- Erros de senha de usuários comuns.
- Erros de validação da “senha do dia” em logins de Suporte/Implantação.

3.5.5. A implementação de CAPTCHA deve seguir boas práticas de UX e acessibilidade, evitando tornar o login inviável para usuários legítimos, mas protegendo contra ataques de força bruta.[web:143][web:151]

## 4. Verificação de sessão ativa para usuário comum

4.1. Antes de criar nova sessão para o usuário, o sistema deve consultar `infolab_sessao_usuario` para verificar se existe sessão ativa para aquele usuário (naquele tenant).

4.2. Se não houver sessão ativa:

- Prosseguir diretamente para as rotinas de limpeza de sessões expiradas e verificação de licenças (seção 5).

4.3. Se houver sessão ativa:

- O sistema deve perguntar ao usuário se deseja continuar no dispositivo atual (migrar sessão).
- Se o usuário recusar:
  - O login deve ser cancelado (sem criar nova sessão).
- Se o usuário aceitar:
  - A sessão anterior deve ser invalidada (marcada como encerrada/expirada).
  - Prosseguir para a rotina de licença e criação de nova sessão.

## 5. Limpeza de sessões expiradas e controle de licenças simultâneas

5.1. Antes de verificar o limite de licenças simultâneas, o sistema deve executar uma rotina que:

- Localize em `infolab_sessao_usuario` todas as sessões marcadas como ativas, mas cuja validade (tempo de expiração) já tenha sido ultrapassada.
- Marque essas sessões como inativas/encerradas.

5.2. Após a limpeza:

- O sistema deve contar quantas sessões ativas existem para a Tenacidade em `infolab_sessao_usuario`.

5.3. Se, ao incluir a nova sessão, o **limite de licenças simultâneas** configurado para a Tenacidade for ultrapassado:

- O login deve ser rejeitado.
- A mensagem deve informar que o limite de licenças simultâneas foi atingido.

5.4. Se o limite **não** for ultrapassado:

- O sistema deve criar uma nova entrada em `infolab_sessao_usuario` para o usuário logado.
- O login deve ser considerado concluído, redirecionando para a tela principal de trabalho.

## 6. Login especial de Suporte/Implantação

6.1. Para logins especiais de Suporte/Implantação, o usuário informa:

- Login no formato `suporte@dominio` ou `implantacao@dominio`.
- Senha do dia.

6.2. Ao identificar esse padrão de login:

- O sistema deve tratar como login de Suporte/Implantação, independente de existir ou não registro correspondente em `infolab_usuario`.

6.3. Autenticação:

- A **única regra de autenticação** é validar a **senha do dia**, calculada/validada pela API do servidor.
- Se a senha do dia estiver incorreta:
  - O login deve ser rejeitado.

6.4. Se a senha do dia estiver correta:

- Deve ser criado registro em `infolab_sessao_suporte`, registrando:
  - Usuário de suporte/implantação (suporte ou implantação).
  - Tenacidade/domínio em que está prestando suporte.
  - Data/hora de login.
  - Dados adicionais (caso de suporte, motivo etc.).

6.5. Usuários de Suporte/Implantação **podem ter múltiplas sessões simultâneas**; não se aplicam a eles as limitações de `infolab_sessao_usuario` e limite de licenças.

## 7. Tela de caso/motivo para Suporte/Implantação

7.1. Após login bem-sucedido de Suporte/Implantação, antes da tela de trabalho:

- O sistema deve exibir uma tela para captura de contexto de suporte.

7.2. Nessa tela, o usuário deve informar **pelo menos um** dos campos:

- Número do caso de suporte (quando existir).
- Motivo textual descritivo (quando não houver caso formal).

7.3. O login especial só deve prosseguir se uma dessas informações for preenchida.

7.4. As informações fornecidas devem ser associadas ao registro de sessão em `infolab_sessao_suporte`.

## 8. Permissões pós-login

8.1. Usuários de **Suporte/Implantação**:

- Possuem acesso total a todas as funcionalidades do sistema (sem restrição por grupo).
- Devem ter um menu extra chamado **Implantação**, com acesso à feature de Tenacidade e demais ferramentas de implantação/suporte.

8.2. Usuários comuns:

- Têm o menu e as funcionalidades filtradas por grupo de usuário:
  - Grupos com restrição: visualizam apenas o que for permitido.
  - Grupos sem restrição: visualizam todas as funcionalidades.

8.3. Permissões de incluir, alterar, excluir e visualizar são controladas por grupo de usuário:

- Se houver regras de restrição, elas devem ser aplicadas.
- Caso não haja nenhuma restrição configurada, o usuário pode realizar todas as operações.

8.4. Usuários com a flag **Administrador**:

- Podem alterar senha de outros usuários mediante confirmação da própria senha (detalhes no domínio `usuario`).

## 9. Sessão expirada e reautenticação

9.1. Todas as requisições protegidas devem passar por verificação de sessão antes do redirecionamento:

- Se a sessão do usuário estiver expirada ou inválida:
  - Antes de completar o redirect, o sistema deve exibir um modal de login (reautenticação).

9.2. Após validação bem-sucedida no modal:

- A requisição original deve ser processada normalmente (como se o usuário tivesse sessão ativa).

9.3. Se a reautenticação falhar:

- A operação deve ser interrompida.
- O usuário pode ser redirecionado para a tela de login principal.

## 10. Reautenticação em telas sensíveis (por módulo)

10.1. Fluxos que exijam reautenticação explícita (mesmo com sessão ativa) devem seguir o mesmo espírito da §9: validar credenciais, opcionalmente trocar de usuário com logout da sessão anterior, e só então prosseguir.

10.2. Regras específicas por tela ou módulo serão documentadas em `ai/domains/<modulo>/` quando forem adicionadas ao produto InfoTIME.

## 11. Auditoria

11.1. Eventos que devem ser registrados em auditoria incluem:

- Tentativas de login (sucesso e falha) de usuários comuns.
- Logins de Suporte/Implantação (incluindo domínio, caso/motivo informado).
- Encerramento de sessões por expiração ou logout.
- Trocas de usuário em reautenticação em fluxos sensíveis.

11.2. Registros de auditoria não devem conter senhas nem valores da senha do dia.
