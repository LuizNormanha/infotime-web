# Política de Segurança

## Versões suportadas

| Versão | Suporte de segurança |
|--------|----------------------|
| `main` | Sim |

## Reportar uma vulnerabilidade

**Não abra uma issue pública para reportar vulnerabilidades de segurança.**

Envie um e-mail para o responsável pelo repositório descrevendo:

1. Tipo de vulnerabilidade (ex.: XSS, injeção SQL, SSRF, escalação de privilégio)
2. Caminho afetado (URL, endpoint, arquivo)
3. Impacto estimado
4. Passos para reproduzir (proof-of-concept se possível)
5. Sugestão de correção (opcional)

Você receberá uma resposta em até **5 dias úteis**. Se confirmada, a vulnerabilidade será
corrigida e uma nota de agradecimento (com seu consentimento) adicionada ao CHANGELOG.

## Escopo

Este projeto cobre:

- API NestJS (`api/`)
- BFF Next.js (`web/src/app/api/`)
- Autenticação e autorização (JWT, RLS por tenant)
- Dependências listadas em `package.json` (use `npm audit` para monitorar)

## Processo de correção

1. Triagem e confirmação interna
2. Patch em branch privada
3. Release com nota de segurança
4. Divulgação responsável após 30 dias ou quando o patch estiver em produção
