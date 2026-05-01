# Tela: Wizard de Implantação
## Origem Scriptcase: `Implantacao_Ctr`

### Fluxo
1. Selecionar Contrato
2. Listar tarefas por módulo (1=Iniciais, 2=Implantação, 3=Finais)
3. Para cada tarefa: atribuir colaborador, definir datas previstas
4. Registrar atividades de execução

### Campos de Tarefa (`contrato_tarefa`)
| Campo | Coluna DB | Tipo |
|---|---|---|
| Módulo | `modulo` | select (1/2/3) |
| Tipo | `tipo` | select (S/A) |
| Nível | `nivel_tarefa` | select |
| Prazo (horas) | `prazo_horas` | integer |
| Colaborador | `id_colaborador` | select |
| Situação | `id_situacao_tarefa_implantacao` | select |
| Data Início Previsto | `data_hora_inicio_previsto` | datetime |
| Data Fim Previsto | `data_hora_fim_previsto` | datetime |
| Exige Arquivo | `exige_arquivo` | checkbox |
