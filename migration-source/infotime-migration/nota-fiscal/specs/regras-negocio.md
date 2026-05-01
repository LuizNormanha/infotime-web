# Regras de Negócio — nota-fiscal

## Numeração
- Sequencial por empresa: `empresa_nota_fiscal.sequencial_nota_fiscal`
- Incrementar atomicamente ao emitir (usar transação/lock)

## Emissão NFSe Nacional
- Integrar com plataforma nacional de NFS-e
- Enviar XML assinado com certificado digital
- Receber: `numero_lote`, `protocolo`, `numero_nota_fiscal_completo`

## Cancelamento
- Registrar: `id_usuario_cancelamento` + data
- Comunicar à prefeitura (cancelamento da NFS-e)

## Vinculação
- Uma NF pode ter um ou mais boletos via `boleto_nota_fiscal`
- Uma NF sempre vinculada a um `lancamento_receita`
