# Regras de Negócio — retorno-cnab

## Formatos Suportados
- CNAB 240 (padrão Febraban para grandes bancos)
- CNAB 400 (padrão mais antigo)

## Processamento
1. Ler arquivo linha por linha
2. Identificar ocorrências de pagamento (código de ocorrência)
3. Cruzar `nosso_numero` com `lancamento_receita.nosso_numero`
4. Baixar automaticamente: atualizar situação, data baixa, valor
5. Registrar histórico em `retorno.historico_pagamento`

## Erros
- Título não encontrado: registrar em `historico_registro`
- Valor divergente: alertar para revisão manual
