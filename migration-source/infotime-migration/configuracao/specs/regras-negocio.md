# Regras de Negócio — configuracao

## Uma Configuração por Tenacidade
- Tabela tem `id_tenacidade` único
- Criar configuração padrão ao registrar novo cliente

## Módulos Habilitados
- `relacao_modulos`: lista de módulos ativos (ex: `FIN,ALM,RH`)
- Usar para controlar visibilidade de menus e funcionalidades

## Padrões Financeiros
- IDs de contas/planos/espécies usados como default em operações automáticas
- Exemplo: ao gerar NF automaticamente, usar `id_conta_caixa_lancamento_receita_nota_fiscal`

## Auditoria
- `gravar_auditoria = 'S'`: ativa o log em `auditoria` e `auditoria_campo`
- Performance: considerar logs assíncronos no novo sistema
