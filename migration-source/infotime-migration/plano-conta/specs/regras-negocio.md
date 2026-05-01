# Regras de Negócio — plano-conta

## Hierarquia
- Contas Sintéticas (S) agrupam contas Analíticas (A)
- Apenas contas Analíticas recebem lançamentos
- Ordenação pelo `classificador`

## DRE (Demonstração do Resultado)
- `codigo_conta_dre`: código na estrutura do DRE
- `calculo_dre`: fórmula para cálculo (ex: `+1001 -2001`)
- `fluxo_caixa`: projeção mensal (janeiro...dezembro) + total + média

## Centro de Custo
- `utiliza_centro_custo` em `configuracao` habilita o módulo
- `centro_custo_vigencia`: valor teto por período
