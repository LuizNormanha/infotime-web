# Regras de Negócio — auditoria

## Quando Registrar
- Habilitado via `configuracao.gravar_auditoria = 'S'`
- Operações: I=Insert, U=Update, D=Delete

## O que Registrar
- Em `auditoria`: quem, quando, onde, qual operação, qual registro
- Em `auditoria_campo`: quais campos foram alterados (antes × depois)

## Implementação no Novo
- Usar interceptors/middleware na camada de serviço
- Considerar mensageria (Kafka/RabbitMQ) para logs assíncronos
- Separar banco de dados de auditoria (recomendado)

## Retenção
- Definir política de retenção (ex: 12 meses)
- Particionamento da tabela por data
