# Tela: Geração de Boleto
## Origem Scriptcase: `GerarBoleto_Blk`

### Processo
1. Selecionar lançamentos de receita pendentes
2. Configurar banco/carteira (via `banco`)
3. Gerar código de barras (`codigo_barras`)
4. Calcular `nosso_numero` (sequencial)
5. Gerar arquivo PDF do boleto
6. Vincular boleto ao lançamento de receita

### Parâmetros
| Campo | Origem |
|---|---|
| % Juros/dia | `boleto.percentual_por_dia_juros` |
| % Multa | `boleto.percentual_multa` |
| Valor desconto | `boleto.valor_desconto` |
