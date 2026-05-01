# Regras de Negócio — cliente

## Tipo de Pessoa
- `tipo_pessoa = 'J'`: Pessoa Jurídica → CNPJ 14 dígitos, Razão Social obrigatória
- `tipo_pessoa = 'F'`: Pessoa Física → CPF 11 dígitos, campo `sexo` e `data_nascimento`

## Hierarquia de Clientes
- `id_cliente_pai`: cliente pode ter um "pai" (matriz/filial)
- Exibir hierarquia na listagem e formulário

## Licenciamento de Software
- `chave_acesso`: token de acesso ao portal do cliente
- `data_expiracao`: validade da licença
- `qtd_licenca`: número de licenças ativas
- Geração de chave: UUID ou hash único

## Contatos Especiais
- `assina_proposta = 'S'`: aparece como signatário nas propostas
- `recebe_cobranca = 'S'`: recebe e-mails de cobrança automáticos

## Integração InfoLAB
- `id_cliente_infolab`: ID no sistema InfoLAB (integrações externas)

## Busca de CEP
- Integrar com API ViaCEP: `https://viacep.com.br/ws/{cep}/json/`
- Preencher automaticamente: logradouro, bairro, cidade, estado
