# Regras de Negócio — boleto

## Geração
- `nosso_numero`: sequencial único por banco/carteira
- `codigo_barras`: calculado conforme padrão CNAB do banco
- Gerar PDF via biblioteca de boletos (ex: BoletoPHP, Laravel Boleto)

## Vínculo
- `boleto_nota_fiscal`: um boleto pode estar vinculado a uma NF
- Um lançamento de receita pode ter um boleto associado

## Baixa via CNAB
- Arquivo de retorno do banco marca boleto como pago
- Atualizar: `data_pagamento`, `valor_pagamento`, situação

## Cálculos
- Juros: `percentual_por_dia_juros` × dias em atraso × valor
- Multa: `percentual_multa` × valor original (cobrada uma vez)
- Desconto: `valor_outras_deducoes`
