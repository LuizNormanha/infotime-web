# Regras de Negócio — conta-caixa

## Saldo Calculado
- Saldo = `saldo_inicio_caixa` + Σreceitas - Σdespesas
- Calcular em tempo real ou via view materializada

## Fechamento de Caixa
- Ao fechar (`situacao = 'F'`): bloquear novos lançamentos nessa data
- `fechamento_financeiro`: período inteiro bloqueado

## Transferências
- Geram dois lançamentos: saída na origem + entrada no destino
- Usar transação atômica para garantir consistência

## Acesso por Usuário
- `conta_caixa_usuario`: lista de usuários que podem operar cada conta
- Usuários sem acesso não veem a conta na listagem
