# Regras de Negócio — usuario

## Criação
- Login deve ser único (UNIQUE INDEX)
- Senha inicial enviada por e-mail ou definida pelo admin
- Ao criar, associar a um ou mais grupos de usuário

## Permissões Especiais
- `indicador_financeiro = 'S'`: pode ver dados financeiros sensíveis
- `acesso_auditoria = 'S'`: pode ver trilha de auditoria
- `acesso_autorizacoes = 'S'`: pode gerenciar autorizações
- `administrador = 'sim'`: bypass total de permissões de grupo

## Limites de Desconto
- `desconto_maximo_imp`: limite de desconto na implantação (%)
- `desconto_maximo_mes`: limite de desconto no mensalismo (%)
- Validar na geração de proposta/contrato
