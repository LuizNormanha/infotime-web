# Padrão Auth e RBAC

## Autenticação

- **JWT** de acesso (curta duração) + **refresh token** (httpOnly cookie ou storage seguro conforme decisão de deploy).
- Login valida credenciais contra tabela de usuário por **tenant** (`id_tenacidade` + `login` único onde aplicável).

## Senha

- Novas senhas: **bcrypt** ou **Argon2** (configurável).
- **Legado MD5:** no primeiro login bem-sucedido com senha legada, rehash para algoritmo forte e substituir hash no banco.

## Usuário

- Flag **ativo/inativo** — inativo não autentica.
- **Administrador** (`administrador = 'sim'` no legado): ignora restrições de grupo quando assim definido no legado — replicar como claim ou verificação explícita no service (documentar risco).

## RBAC

- **Grupo de usuário** ligado ao usuário.
- **Permissões por aplicação** (`grupo_usuario_aplicacao`).
- **Campo e bloco** quando existirem (`grupo_usuario_aplicacao_campo`, `grupo_usuario_aplicacao_bloco`): mapear para metadados de UI e validação no backend.

## Backend

- **Middleware** de autenticação (JWT) + **middleware** de autorização por rota/recurso.
- Policies centralizadas ou checks em service por operação.

## Frontend

- Hook **`usePermission(acao, recurso)`** — desabilita/oculta botões e rotas.

## Tokens

- Refresh com rotação opcional; revogação em logout; lista de negação se necessário em produção.
