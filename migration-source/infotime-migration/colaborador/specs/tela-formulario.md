# Tela: Formulário de Colaborador
## Origem Scriptcase: `Colaborador_Frm`

### Aba: Dados Pessoais
| Campo | Coluna DB | Tipo |
|---|---|---|
| Nome | `nome` | text |
| Apelido | `apelido` | text |
| Sexo | `sexo` | select (M/F) |
| Data Nascimento | `data_nascimento` | date |
| CPF | `cpf` | masked |
| Carteira Identidade | `carteira_identidade` | text |
| Carteira de Trabalho | `carteira_trabalho` | text |
| Número PIS | `numero_pis` | text |
| Estado Civil | `id_tipo_estado_civil` | select |

### Aba: Dados CLT
| Campo | Coluna DB |
|---|---|
| Tipo Colaborador | `id_tipo_colaborador` |
| Data Admissão | `data_admissao` |
| Data Demissão | `data_demissao` |
| Data Estágio | `data_estagio` |
| Cargo/Nível | `id_cargo_classificacao_nivel` |
| Empresa | `id_empresa` |
| Salário | `salario` |
| Comissão % | `comissao` |
| Insalubridade % | `insalubridade` |
| Vale Alimentação | `vale_alimentacao` |
| Vale Transporte | `vale_transporte` |
| Regime Trabalho | `regime_trabalho` |
| Horários | `hora_trabalho_entrada`, `hora_trabalho_saida`, etc. |

### Aba: Banco
| Campo | Coluna DB |
|---|---|
| Banco | `id_banco` |
| Agência | `id_agencia` |
| Número Conta | `numero_conta` |
| PIX | `pix` |

### Aba: Implantação
| Campo | Coluna DB |
|---|---|
| Implanta | `implanta` |
| Líder Implantação | `lider_implantacao` |
| Consultor Implantação | `consultor_implantacao` |
| Lista POP | `lista_pop_documento` |
