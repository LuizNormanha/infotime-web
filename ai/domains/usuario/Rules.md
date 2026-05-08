# Regras – Domínio de Usuário (Cadastro e Senha)

Este documento define as regras obrigatórias para cadastro e manutenção de usuários do sistema Infotime, com foco em unidade, grupo, login, senha e permissões de troca de senha.

## 1. Regras de cadastro de usuário

1.1. É proibido cadastrar usuário **sem unidade**:

- `id_unidade` é obrigatório no cadastro de usuário.
- O sistema deve exigir a seleção de uma unidade válida.

1.2. É proibido cadastrar usuário **sem grupo de usuário**:

- `id_grupo_usuario` é obrigatório.
- O usuário deve pertencer a pelo menos um grupo que defina suas permissões (ex.: Administrador, Atendimento etc.).

1.3. É proibido cadastrar usuário **sem login**:

- Campo `login` é obrigatório.
- O login deve ser único por Tenacidade (não podem existir dois usuários com o mesmo login na mesma Tenacidade).

1.4. É proibido cadastrar usuário **sem senha inicial**:

- No momento do cadastro, uma senha válida deve ser definida.
- A senha deve ser validada pela API conforme os requisitos mínimos de política de senha.

1.5. Qualquer tentativa de salvar um usuário violando as regras 1.1–1.4 deve ser rejeitada, com mensagens de erro claras para o usuário.

## 2. Política de senha (integração com API)

2.1. A definição de requisitos mínimos de senha (comprimento, complexidade, blacklist de senhas fracas, etc.) é responsabilidade da API/política de senha central.

2.2. Sempre que uma senha for criada ou alterada (cadastro, troca, reset), a aplicação deve:

- Enviar a senha proposta para validação na API/política de senha.
- Rejeitar a senha se a API indicar que não atende aos requisitos mínimos.

2.3. Mensagens de erro devem:

- Indicar que a senha não atende à política mínima.
- Sempre que possível, explicar o motivo ou a regra violada (por exemplo, “Senha muito curta” ou “Senha muito fraca”).

## 3. Troca de senha pelo próprio usuário

3.1. Um usuário pode alterar **apenas a própria senha**, não a de outros usuários (exceto em fluxos específicos de administrador/suporte definidos nas seções 4 e 5).

3.2. Para trocar a própria senha, é obrigatório:

- Informar a **senha atual** corretamente.
- Informar a nova senha.
- Confirmar a nova senha (quando a UI exigir confirmação).

3.3. O fluxo de troca de senha do próprio usuário deve:

- Validar a senha atual (comparando com o hash armazenado).
- Se a senha atual estiver incorreta, rejeitar a operação com mensagem adequada.
- Validar a nova senha usando a política da API de senha.
- Somente se ambas as etapas forem bem-sucedidas, atualizar a senha do usuário.

3.4. Quando a senha for alterada com sucesso:

- Deve ser registrado em auditoria que o próprio usuário alterou sua senha, com data/hora.

## 4. Troca de senha por usuário do grupo Administrador

4.1. Apenas usuários pertencentes ao **grupo Administrador** podem alterar a senha de outros usuários via fluxo de administração.

4.2. Ao alterar a senha de outro usuário, o administrador deve:

- Informar a nova senha a ser aplicada (que será validada pela política de senha).
- Confirmar a operação informando a **própria senha atual de administrador** (autenticação forte da ação).

4.3. A operação **não deve** exigir a senha antiga do usuário alvo da alteração.

4.4. A operação de troca de senha por administrador deve ser registrada em auditoria, incluindo:

- Qual administrador executou a operação.
- Qual usuário teve a senha alterada.
- Data/hora da alteração.

4.5. Se existirem regras adicionais (ex.: exigir que o usuário altere a senha no próximo login após reset de admin), elas devem ser integradas a este fluxo.

## 5. Troca de senha por usuários de Suporte/Implantação (senha do dia)

5.1. Usuários com perfil de **Suporte** ou **Implantação** possuem poderes equivalentes aos de administrador para alterar a senha de outros usuários, porém com mecanismo próprio de confirmação.

5.2. Para alterar a senha de outro usuário, Suporte/Implantação devem:

- Informar a nova senha do usuário alvo (validada pela política de senha).
- Confirmar a operação informando a **senha do dia**.

5.3. A **senha do dia** deve:

- Ser definida e gerida exclusivamente pela API/servidor (por exemplo, baseada em segredo interno + data).
- Nunca ser hardcoded no front-end ou em clientes.
- Ter validade limitada (normalmente um dia) e, de preferência, ser rotacionada automaticamente.
- Ser validada de forma segura (comparação em servidor).

5.4. Se a senha do dia informada for inválida, a operação deve ser rejeitada.

5.5. Toda alteração de senha realizada por Suporte/Implantação deve ser registrada em auditoria, incluindo:

- Usuário de suporte/implantação que realizou a operação.
- Usuário alvo.
- Data/hora.
- Indicação de que a autenticação foi feita via senha do dia.

## 6. Restrições gerais e segurança

6.1. Senhas nunca devem ser armazenadas em texto claro:

- O sistema deve armazenar apenas hash de senha, usando algoritmo seguro (por exemplo, bcrypt, Argon2 ou similar) com salt adequado.[web:137][web:139][web:149][web:151]

6.2. Senhas e senha do dia não devem ser exibidas em logs, dumps de erro ou telas.

6.3. Em qualquer fluxo de troca de senha:

- Mensagens de erro não devem indicar detalhes que facilitem ataque (ex.: não informar explicitamente se o login é inexistente).
- No caso de senha atual ou senha do dia incorreta, a mensagem deve ser genérica e orientativa.

6.4. Tentativas repetidas de troca de senha com credenciais incorretas (senha atual ou senha do dia) podem seguir a mesma política de bloqueio/limitação usada para tentativas de login, conforme definido pela API de autenticação.

## 7. Multi-tenant

7.1. O campo `tenant_id` (ou equivalente) deve ser considerado em todas as operações de usuário:

- Login deve ser único por Tenacidade.
- As operações de administração de usuário (incluindo troca de senha) devem ser sempre restritas à Tenacidade do operador.

7.2. Um administrador ou usuário de Suporte/Implantação de uma Tenacidade **não pode** gerenciar usuários de outra Tenacidade, salvo se existir um conceito explícito de superadmin global, com regras dedicadas.

7.3. Regras de RLS no banco e filtros nas APIs devem garantir o isolamento de dados entre Tenacidades.

## 8. Auditoria

8.1. Operações relevantes sobre usuários que devem ser auditadas incluem:

- Cadastro de novo usuário.
- Alteração de dados sensíveis (unidade, grupo, login, status).
- Troca de senha pelo próprio usuário.
- Troca de senha por administrador.
- Troca de senha por Suporte/Implantação (senha do dia).
- Ativação/inativação de usuário.

8.2. Registros de auditoria devem incluir:

- Quem realizou a operação.
- Qual usuário foi afetado.
- Data/hora.
- Tipo de operação.
- No caso de troca de senha, se foi fluxo próprio usuário, administrador ou suporte/implantação (senha do dia).

8.3. Os dados de auditoria não devem incluir os valores das senhas (nem atuais, nem antigas) nem o valor da senha do dia.
