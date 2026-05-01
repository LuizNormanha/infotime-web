# Regras de Negócio — patrimonio

## Categoria e Depreciação
- `patrimonio_categoria.percentual_depreciacao_anual`: % de depreciação por ano
- `qtd_anos_vida_util`: vida útil em anos
- Calcular valor atual = valor_compra × (1 - depreciacao_anual)^anos

## Atualizações de Valor
- `tipo = 'D'`: depreciação
- `tipo = 'V'`: valorização (para bens que apreciam)
- Registrar data e valor de cada atualização

## Eventos
- `tipo_patrimonio_bem_evento`: tipos configuráveis (manutenção, empréstimo, garantia)
- `qtd_dias_producao`: dias que o evento impacta a produção
- `valor_unitario` no evento: custo do evento

## Fotos
- Armazenadas em `bytea` no legado
- **Migrar para object storage**
