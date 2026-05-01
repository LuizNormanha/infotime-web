# Regras de Negócio — pop-documento

## Upload de Arquivos
- Padrão: `nome_arquivo` (nome original) + `nome_referencia` (nome no storage)
- Migrar para object storage com URL pré-assinada para download

## Visibilidade
- Colaboradores podem ver POPs pelo app mobile (`MobileColaboradorPop_Lst`)
- `lista_pop_documento` em `colaborador`: filtrar POPs visíveis por colaborador

## Tipos de Documento
- Configuráveis em `tipo_documento`
- Exemplos: POP, ISO, PCMSO, PGR, Contrato
