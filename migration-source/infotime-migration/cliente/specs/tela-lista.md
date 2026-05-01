# Tela: Lista de Clientes
## Origem Scriptcase: `Cliente_Lst`

### Colunas Exibidas
| Coluna | Campo DB |
|---|---|
| Razão Social | `cliente.razao_social` |
| Nome Fantasia | `cliente.nome_fantasia` |
| CNPJ/CPF | `cliente.cnpj` |
| Cidade/Estado | `cliente.cidade`, `cliente.estado` |
| Situação | `situacao_cliente.descricao` |
| Tipo | `tipo_cliente.descricao` |
| Região | `regiao_estadual.descricao` |

### Filtros
- Razão Social, CNPJ, Situação, Tipo, Cidade, Estado, Região, Canal

### Ações
- Incluir, Editar, Gestão (sub-menu), Enviar E-mail, Download Licença
- Versão Mobile disponível (`ClienteMobile_Lst`)
