# Tela: Alterar Senha
## Origem Scriptcase: `Usuario_SenhaAlterar_Ctr`

### Campos
| Campo | Tipo | Regra |
|---|---|---|
| Senha atual | password | Validar contra hash atual |
| Nova senha | password | Min 8 chars (novo padrão) |
| Confirmar senha | password | Deve ser igual à nova |

### Comportamento
- Validar senha atual antes de permitir alteração
- Forçar relogin após alteração
