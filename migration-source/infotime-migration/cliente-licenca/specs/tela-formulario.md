# Tela: Formulário de Licença
## Origem Scriptcase: `Cliente_Licenca_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Chave de Acesso | `chave_acesso` | text (auto-gerado) |
| Data Expiração | `data_expiracao` | date |
| Qtd Licenças | `qtd_licenca` | integer |
| Emite Boleto | `emite_boleto` | checkbox |

### Ação: Gerar/Renovar Chave
- Gerar nova chave UUID aleatória
- Enviar por e-mail ao cliente
