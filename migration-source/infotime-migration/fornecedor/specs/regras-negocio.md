# Regras de Negócio — fornecedor

## Flag Fabricante
- `fabricante = 'S'`: aparece como opção de fabricante em cadastros de produto/patrimônio

## Plano de Contas
- `fornecedor_plano_conta`: pré-associar planos de conta ao fornecedor
- Ao criar despesa para este fornecedor: sugerir o plano associado
- `fornecedor_plano_conta` para almoxarifado: plano específico para compras

## Situação
- Situação bloqueada: impedir criação de novas despesas
