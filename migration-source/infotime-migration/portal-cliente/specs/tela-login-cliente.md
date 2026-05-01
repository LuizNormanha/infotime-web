# Tela: Login do Portal do Cliente
## Origem Scriptcase: `areacliente/`

### Campos
| Campo | Origem |
|---|---|
| CNPJ | `cliente.cnpj` |
| Chave de Acesso | `cliente.chave_acesso` |

### Validações
- Verificar `data_expiracao` da licença
- Verificar `qtd_licenca` disponível
- `cliente_publico = 'S'`: acesso público sem senha
