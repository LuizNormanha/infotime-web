# Tela: Importação de Arquivo de Retorno
## Origem Scriptcase: `Retorno_CNAB_Ctr`

### Processo
1. Upload do arquivo CNAB (240 ou 400 posições)
2. Parser identifica os títulos pagos
3. Preview dos títulos a serem baixados
4. Confirmação → baixa automática dos `lancamento_receita`
5. Gera relatório de processamento em `historico_pagamento`
