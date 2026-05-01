# Tela: Formulário de Bem Patrimonial
## Origem Scriptcase: `PatrimonioBem_Frm`

### Campos Principais
| Campo | Coluna DB | Tipo |
|---|---|---|
| Código/Placa | `codigo` | text |
| Descrição | `descricao` | text |
| Categoria | `id_patrimonio_categoria` | select |
| Estado | `id_patrimonio_estado` | select |
| Localização | `id_patrimonio_localizacao` | select |
| Fornecedor | `id_fornecedor` | select |
| Fabricante | `id_fabricante` | select |
| Responsável | `id_usuario_responsavel` | select |
| Nota Fiscal | `nota_fiscal` | text |
| Número Série | `numero_serie` | text |
| Data Compra | `data_compra` | date |
| Valor Compra | `valor_compra` | decimal |
| Marca | `marca` | text |
| Modelo | `modelo` | text |
| Situação | `situacao` | select (A=Ativo/B=Baixado/D=Disponível) |

### Sub-módulos
- Fotos (`patrimonio_bem_foto`): upload de imagens
- Histórico de Valor (`patrimonio_bem_atualizacao`): valorizações/depreciações
- Eventos (`patrimonio_bem_evento`): manutenções, empréstimos, etc.
