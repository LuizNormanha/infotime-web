# Tela: Formulário de Usuário
## Título real: "Inclusão Usuário"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório | Padrão |
|---|---|---|---|
| Login | text | Sim | |
| E-mail | email | Sim | |
| Senha | password | Sim (inclusão) | |
| Confirme a senha | password | Sim (inclusão) | |
| Ativo | radio (Sim/Não) | Sim | Sim |
| Acesso à auditoria | radio (Sim/Não) | Sim | Não |
| Acesso à autorizações | radio (Sim/Não) | Sim | Não |
| Indicador financeiro | radio (Sim/Não) | Sim | Não |
| Administrador | radio (Sim/Não) | | Não |
| Desconto Máximo Implantação (%) | decimal | Sim | |
| Desconto Máximo Mês (%) | decimal | Sim | |
| Data Ativacao | date (readonly) | — | preenchida ao ativar |

### Aba: Grupos do usuário
_(seleção multi-valor dos grupos de usuário que terá acesso)_

### Aba: Empresa
_(seleção das empresas que o usuário pode acessar)_
