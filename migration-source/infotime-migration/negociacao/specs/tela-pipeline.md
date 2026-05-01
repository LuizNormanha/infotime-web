# Tela: Pipeline Kanban
## Origem Scriptcase: `Negociacao_Pipeline_Blk`

### Layout
- Colunas = Fases da proposta (`proposta_fase`)
- Cards = Negociações em cada fase
- Arrastar card = mover para próxima fase
- Card exibe: cliente, valor estimado, responsável, data

### Interações
- Click no card: abre detalhe da negociação
- Drag & Drop entre colunas: atualiza `negociacao_proposta_fase`
- Cor do card: baseada em `situacao_fase` ou urgência

### Filtros
- Por tipo de negócio, por colaborador responsável
