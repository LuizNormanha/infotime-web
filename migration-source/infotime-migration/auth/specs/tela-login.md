# Tela: Login
## Origem Scriptcase: `Login_Ctr`

### Campos
| Campo | Tipo | Obrigatório | Regra |
|---|---|---|---|
| Login | text | Sim | Único — ver `usuario.login` |
| Senha | password | Sim | MD5 no legado → bcrypt no novo |

### Comportamento
- Sessão PHP no legado → JWT (access + refresh token) no novo
- Expiração de sessão: verificar `data_ativacao` e `ativo`
- Usuário inativo (`ativo != 'sim'`) → bloquear acesso
- Administrador (`administrador = 'sim'`) → acesso irrestrito
- Redirecionamento pós-login: verificar `lista_empresa` do usuário

### Integrações
- Nenhuma externa — autenticação própria

### Migrações Críticas
- Converter senhas MD5 → bcrypt na primeira autenticação
- JWT claims: `id_usuario`, `id_tenacidade`, `lista_empresa`, `administrador`, `grupos[]`
