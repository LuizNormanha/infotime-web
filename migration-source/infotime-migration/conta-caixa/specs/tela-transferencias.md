# Tela: Formulário de Transferência entre Contas
## Título real: "Inclusão Transferência entre Contas"
## Screenshot: `transferencias-formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa origem | select | Sim |
| Origem (Conta Caixa) | select | Sim |
| Empresa destino | select | |
| Destino (Conta Caixa) | select | Sim |

### Seção: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Data | date | Sim — default: hoje |
| Valor | decimal | Sim |
| Histórico | text | Sim |
| Incluído em | datetime (readonly) | Auto-preenchido |
| Incluído por | text (readonly) | Auto-preenchido |
