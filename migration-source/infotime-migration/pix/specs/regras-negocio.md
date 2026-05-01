# Regras de Negócio — pix

## Tipos de Cobrança
- `cob`: cobrança imediata (sem vencimento)
- `cobv`: cobrança com vencimento
- `pix_direto`: PIX direto sem cobrança prévia

## TXID
- 26 a 35 caracteres alfanuméricos
- Único por cobrança
- Usado para rastrear pagamento

## Webhook (retorno_api_pix)
- `e2e_id`: identificador fim-a-fim do pagamento (único)
- `txid`: referência da cobrança
- `valor`: valor recebido
- `horario`: momento do pagamento
- Ao receber: baixar `lancamento_receita` correspondente

## Segurança
- Validar certificado SSL do webhook
- Verificar assinatura do payload
- Idempotência: não baixar o mesmo e2eid duas vezes

## API Itaú
- OAuth 2.0 para autenticação
- Certificado mTLS obrigatório
- Ambiente sandbox × produção via `configuracao`
