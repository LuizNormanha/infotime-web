# Tela: Gestão de Férias
## Origem Scriptcase: `ColaboradorFerias_Frm`, `ColaboradorFeriasGozadas_Frm`

### Período Aquisitivo (`colaborador_ferias`)
| Campo | Coluna DB | Tipo |
|---|---|---|
| Colaborador | `id_colaborador` | |
| Data Aquisição | `data_aquisicao` | date |
| Data Limite | `data_limite` | date |
| Férias Concedidas | `ferias_concedidas` | checkbox |

### Férias Gozadas (`colaborador_ferias_gozadas`)
| Campo | Coluna DB | Tipo |
|---|---|---|
| Período Aquisitivo | `id_colaborador_ferias` | select |
| Data Início | `data_ferias_inicio` | datetime |
| Data Fim | `data_ferias_fim` | datetime |
| Dias Vendidos | `qtd_dias_vendidos` | smallint |
| Dias Descontados | `qtd_dias_descontados` | smallint |
| Situação | `situacao` | select |
| Pagamento Dobro | `pagamento_dobro` | checkbox |
