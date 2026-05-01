# Regras de Negócio — proposta

## Limites de Desconto
- `valor_desconto_unico` ≤ `usuario.desconto_maximo_imp` %
- `valor_desconto_mensal` ≤ `usuario.desconto_maximo_mes` %
- Se ultrapassar: exigir autorização de superior

## Conversão em Contrato
- Proposta `situacao_proposta = 'P'` → aceita → `situacao_proposta = 'F'`
- Cria automaticamente um `contrato` com os mesmos dados
- Cria `contrato_item` para cada `proposta_item`
- `proposta.id_contrato` recebe o ID do contrato gerado

## Validade da Proposta
- `dias_validade`: dias até expiração
- Proposta expirada: alertar na listagem, bloquear conversão

## Relatório PDF
- Template configurável em `tipo_contrato.nome_arquivo`
- Gerar PDF com dados da proposta, itens, totais, assinatura
