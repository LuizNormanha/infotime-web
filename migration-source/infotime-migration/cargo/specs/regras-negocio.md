# Regras de Negócio — cargo

## Hierarquia
- Cargo → Classificação → Nível (3 níveis obrigatórios)
- Colaborador vinculado ao Nível (`id_cargo_classificacao_nivel`)

## Tabela Salarial
- Histórica: vários registros por nível com datas diferentes
- Apenas o mais recente com `ativo = 'S'` é o salário vigente
- Ao reajustar: criar novo registro com `ativo = 'S'` e desativar o anterior

## Motivos de Reajuste
- Promoção, Mérito, Dissídio, Equiparação etc.
- Configuráveis em `tipo_motivo_reajuste`

## Histórico de Reajustes
- `colaborador_reajuste`: registra cada reajuste individual do colaborador
- Manter histórico completo de evoluções salariais
