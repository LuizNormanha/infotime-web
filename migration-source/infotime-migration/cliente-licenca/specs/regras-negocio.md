# Regras de Negócio — cliente-licenca

## Chave de Acesso
- UUID ou hash único por cliente
- Usada para autenticação no portal do cliente e no InfoLAB
- Ao renovar: gerar nova chave e invalidar a anterior

## Validade
- `data_expiracao < hoje`: licença expirada → bloquear acesso ao portal
- Enviar alertas de vencimento próximo (30, 15, 7, 1 dia antes)

## Download de Licença
- `Cliente_Download_Licenca_Ctr`: gera arquivo de licença para o InfoLAB
- Arquivo contém: CNPJ, chave_acesso, data_expiracao, qtd_licenca
