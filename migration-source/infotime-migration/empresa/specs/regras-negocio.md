# Regras de Negócio — empresa

## Multi-Empresa
- Um `tenacidade` pode ter N empresas
- Usuário acessa apenas as empresas em `lista_empresa`
- Relatórios podem ser consolidados ou por empresa

## Unidade Origem
- Código de 2 chars identificando a unidade nos lançamentos financeiros
- Usado em `lancamento_receita.unidade_origem` e outros

## Imagem
- `imagem_foto` em bytea no legado
- **Migrar para object storage**
