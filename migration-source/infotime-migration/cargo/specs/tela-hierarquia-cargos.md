# Tela: Hierarquia de Cargos
## Origem Scriptcase: `Cargo_Gde`, `CargoClassificacao_Gde`, `CargoClassificacaoNivel_Gde`

### Estrutura em Árvore
```
Cargo (ex: "Analista de Sistemas")
  └── Classificação (ex: "Pleno")
        └── Nível (ex: "Nível II")
              └── Salário por período (histórico)
```

### Campos por Nível
**Cargo**: `descricao`
**Classificação**: `descricao` (Júnior/Pleno/Sênior)
**Nível**: `descricao` (Nível I/II/III)
**Salário**:
| Campo | Coluna DB |
|---|---|
| Data Reajuste | `data_reajuste` |
| Percentual | `percentual_reajuste` |
| Valor Salário | `valor_salario` |
| Ativo | `ativo` |
