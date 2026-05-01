# Regras de Negócio — banco

## Configuração de Boleto
- Campos no `banco`: agencia_boleto, conta_boleto, convenio_boleto, carteira_boleto
- Esses dados são usados na geração de boletos CNAB

## Bandeiras de Cartão
- `taxa_cartao`: taxa por bandeira, por conta caixa
- `tipo_cartao`: 'CD'=débito, 'CC'=crédito
- `taxa_adiantamento`: taxa para recebimento antecipado

## Configuração de Cobrança
- Define comportamento para cada combinação: conta × espécie × bandeira
- `baixa_automatica`: baixar automaticamente após N dias
- `qtd_dias`: dias para baixa automática ou repasse do cartão
