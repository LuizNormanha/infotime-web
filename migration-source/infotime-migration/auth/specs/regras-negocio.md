# Regras de Negócio — auth

## Autenticação
- Login único por tenacidade (UNIQUE INDEX em `usuario.login`)
- Senha armazenada em MD5 no legado — **migrar para bcrypt**
- Campo `ativo` controla acesso: apenas `'sim'` permite login
- Campo `administrador = 'sim'` concede acesso total, ignorando permissões de grupo

## Ativação de Cadastro
- Novos usuários recebem `codigo_ativacao` por e-mail
- Devem acessar link de ativação antes do primeiro login
- Após ativação: `data_ativacao` preenchida, `codigo_ativacao` zerado

## Recuperação de Senha
- Envio de e-mail com link temporário (via SMTP configurado em `configuracao`)
- Token de recuperação deve expirar em 24h (implementar no novo)

## Controle Multi-Empresa
- `lista_empresa`: lista de IDs de empresas que o usuário pode acessar
- Vazio = acesso a todas as empresas da tenacidade
