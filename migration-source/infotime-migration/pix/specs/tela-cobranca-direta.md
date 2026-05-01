# Tela: Cobrança PIX Direta
## Origem Scriptcase: `cobranca_pix_direto`

### Processo
1. Informar valor e dados do pagador
2. Chamar API Itaú — endpoint `/cob`
3. Gerar QR Code (payload PIX)
4. Exibir QR Code + código copia-e-cola
5. Aguardar webhook de confirmação
