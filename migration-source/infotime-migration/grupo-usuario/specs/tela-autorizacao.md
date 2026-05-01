# Tela: Matriz de Autorizações
## Origem Scriptcase: `GrupoUsuario_AutorizacaoAcesso_Frm` + `GrupoUsuario_Autorizacao_Aba`

### Estrutura
Para cada aplicação cadastrada, o grupo pode ter:

| Permissão | Campo DB | Valores |
|---|---|---|
| Consulta | `consulta` | sim/não |
| Inclusão | `inclusao` | sim/não |
| Exclusão | `exclusao` | sim/não |
| Alteração | `alteracao` | sim/não |
| Exportação | `exportacao` | sim/não |
| Impressão | `impressao` | sim/não |

### Controles Adicionais
- **Blocos**: seções/abas de uma aplicação que podem ser ocultadas por grupo (`grupo_usuario_aplicacao_bloco`)
- **Campos**: campos individuais com visibilidade controlável (`grupo_usuario_aplicacao_campo`)
  - `tipo_visao = 'O'`: oculto
  - `tipo_visao = 'L'`: somente leitura
  - `tipo_visao = 'E'`: editável (padrão)

### Implementação no Novo
- Middleware de autorização: verificar grupo do usuário × permissão da rota
- Guardar no JWT ou cache Redis as permissões do usuário
- Frontend: ocultar botões/campos com base nas permissões
