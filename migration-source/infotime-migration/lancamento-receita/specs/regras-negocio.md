# Regras de Negócio — lancamento-receita

## Parcelamento
- `parcela`: número da parcela atual (0 = avulso)
- `id_lancamento_receita_pai`: link para o lançamento principal
- Ao parcelar: criar N lançamentos filhos com datas incrementadas

## Recorrência
- `id_lancamento_receita_recorrente`: template recorrente
- Job/cron: gerar lançamentos futuros automaticamente

## Baixa
- Atualizar: `data_realizacao`, `valor_realizacao`, `data_baixa`
- Registrar: `idusuario_baixa`
- Mudar situação para "Baixado"
- Se tiver boleto: baixar o boleto correspondente
- Se tiver nota fiscal: verificar integração

## E-mail de Cobrança
- Enviar para contato com `recebe_cobranca = 'S'`
- Registrar em `email_enviado`
- Marcar `enviou_email_cobranca = 'S'`
- Tracking de leitura: `lido_email_cobranca`

## Rateio
- Um lançamento pode ser rateado entre empresas/planos via `lancamento_receita_rateio`
- Soma dos rateios deve = valor total
- Validar ao salvar

## Fechamento Financeiro
- `fechamento_financeiro = 'S'`: lançamento em período fechado
- Bloquear alteração de lançamentos em períodos fechados
