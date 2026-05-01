# Regras de Negócio — portal-cliente

## Autenticação
- Credenciais: CNPJ + chave_acesso (não usa o sistema de usuários interno)
- Verificar validade: `data_expiracao > hoje`
- Sessão separada do sistema interno

## Acesso
- JWT específico do portal com `id_cliente` e `id_tenacidade`
- Sem acesso a APIs internas (diferentes endpoints)

## Funcionalidades
- GET /portal/boletos: boletos do cliente
- GET /portal/contratos: contratos ativos
- POST /portal/avaliacao: enviar avaliação
- PATCH /portal/senha: alterar senha de acesso

## Tenacidade
- `tenacidade`: controla o tenant do portal
- URL do portal pode ser por subdomínio do cliente
