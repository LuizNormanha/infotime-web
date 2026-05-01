# Tela: Cobrança PIX com Vencimento
## Origem Scriptcase: `cobranca_pix_vencimento`

### Processo
1. Informar valor, vencimento, dados do pagador, chave PIX
2. Chamar API Itaú — endpoint `/cobv`
3. Gerar `txid` único (35 chars)
4. Gerar QR Code com vencimento
5. Webhook: `retorno_api_pix` registra pagamento recebido
