# Regras de Negócio — colaborador

## Tipo de Colaborador
- CLT: `exige_data_clt = 'S'` → campos de carteira obrigatórios
- PJ: não exige carteira de trabalho

## Flags de Implantação
- `implanta`: pode ser atribuído a tarefas de implantação
- `lider_implantacao`: aparece como opção de líder na seleção
- `consultor_implantacao`: perfil de consultor

## Foto
- Campo `foto` armazenado em `bytea` no legado
- **Migrar para object storage** no novo sistema
- Endpoint: `POST /colaboradores/{id}/foto`

## Login no App Mobile
- Campos `login` e `senha` para acesso ao app mobile dos colaboradores
- Separado do login do sistema principal
