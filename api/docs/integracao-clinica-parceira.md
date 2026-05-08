# Integração de clínica parceira com a API Infelab

Documento de referência para **implementação futura**, quando uma clínica (ou sistema terceiro) precisar integrar-se ao nosso backend para criar/atualizar atendimentos e dados relacionados, sem passar pelo navegador.

**Relacionado:** contrato técnico do payload em [atendimento-salvar-documento.md](./atendimento-salvar-documento.md).

---

## 1. Visão geral

| Aspecto | Descrição |
|--------|-----------|
| **Formato** | REST, corpo **JSON** (`Content-Type: application/json`). |
| **Isolamento** | Cada **tenant** (`id_tenacidade`) vê apenas os seus dados. O tenant **não** é escolhido no body; vem da **autenticação** (hoje: JWT). |
| **Operação principal** | `POST /atendimentos` — documento mestre + detalhes numa única transação (ver documento linkado acima). |
| **Leitura** | `GET /atendimentos` (listagem resumida), `GET /atendimentos/:id` (documento completo), catálogos `GET /atendimentos/catalogo/unidades`, `GET /atendimentos/catalogo/exames-material`. |

---

## 2. Situação atual (baseline)

- A API Nest exige **`Authorization: Bearer <access_token>`** com JWT válido (sessão de usuário ou fluxo de suporte).
- O **tenant** e o **usuário** são obtidos do token; requisitos de segurança estão documentados no código (`GuardAutenticacaoJwtMultiTenant` — o `id_tenacidade` **nunca** deve ser confiado a partir do body).

**Implicação para uma clínica integradora:** hoje a integração “direta” pressupõe obter token como um utilizador daquela tenacidade (login). Para integração **serviço-a-serviço** (sem UI), será necessário **evoluir** o produto (ver secção 6).

---

## 3. Modelo de integração desejável (futuro)

Duas abordagens comuns; a escolha define trabalho de backend e contrato com a clínica.

### A) Utilizador técnico / “robot” (mais simples a curto prazo)

- Criar na tenacidade da clínica um **utilizador de integração** com permissões mínimas.
- A clínica obtém token via **fluxo de login já existente** (ou endpoint dedicado, se existir) e renova conforme expiração.
- **Prós:** reutiliza JWT e RLS atuais.  
- **Contras:** gestão de palavra-passe/2FA, rotação manual; menos ideal para alto volume.

### B) Credencial de máquina (recomendado para produção estável)

- **Client credentials** ou **API key** por clínica, amarrada a uma tenacidade e a um “utilizador técnico” interno.
- Token de curta duração ou assinatura HMAC por pedido — **a definir na implementação**.
- **Prós:** rotação, revogação, auditoria e limites por cliente.  
- **Contras:** desenvolvimento e manutenção no Infelab.

---

## 4. Requisitos não funcionais sugeridos

| Tema | Recomendação |
|------|----------------|
| **Transporte** | Apenas **HTTPS** em produção. |
| **Rede** | Opcional: **lista de IPs** (allowlist) por clínica para reduzir superfície de ataque. |
| **Limites** | Rate limiting por tenant/cliente (o Nest já usa throttling global; pode precisar de camadas por integração). |
| **Idempotência** | Para `POST /atendimentos`, avaliar **chave de idempotência** no header em versão futura (evitar duplicar atendimentos em retries). |
| **Versão** | Prefixo de API (`/v1/atendimentos`) ou header `Accept-Version` em evoluções que quebrem contrato. |
| **Logs** | Correlacionar `id_tenacidade`, identificador do cliente integrador e, se existir, `id_atendimento` / código de erro. |

---

## 5. Contrato de dados (o que a clínica envia/recebe)

- O **corpo JSON** do `POST /atendimentos` segue a estrutura descrita em [atendimento-salvar-documento.md](./atendimento-salvar-documento.md): `infolab_atendimento`, arrays de detalhes, `remocoes` opcional, regra `_sinc` nos filhos.
- A clínica deve tratar **IDs como strings** (bigint serializado em JSON).
- Campos de negócio (paciente, unidade, convênio, exames) devem ser **IDs já existentes** no cadastro da mesma tenacidade (FKs), salvo regras específicas futuras de importação.

---

## 6. Itens a implementar no Infelab (quando a integração for aprovada)

Checklist técnico para a equipa:

1. [ ] Definir modelo de autenticação (A ou B acima) e documentar fluxo de obtenção de token.
2. [ ] Expor URL base estável da API (e ambiente de **homologação** separado).
3. [ ] Acordar **SLA** e janela de manutenção; política de versionamento do contrato JSON.
4. [ ] Opcional: endpoint ou processo de **validação** (dry-run) antes do POST definitivo.
5. [ ] Opcional: **webhooks** de retorno (atendimento criado/atualizado) — não existe no documento atual; seria nova funcionalidade.
6. [ ] Registar contacto técnico na clínica e canal de suporte (e-mail/ticket).

---

## 7. Onboarding da clínica (passos sugeridos)

1. Formalizar contrato / DPA se aplicável (dados de saúde).
2. Criar ou identificar **tenacidade** e utilizadores/credenciais de integração.
3. Partilhar **URL base**, documentação de endpoints e exemplo de payload (referência cruzada com [atendimento-salvar-documento.md](./atendimento-salvar-documento.md)).
4. Testes em **homologação**: listagem, GET por id, POST com caso mínimo, depois cenários completos.
5. Go-live com monitorização e limites acordados.

---

## 8. Resumo

- **Hoje:** integração possível via **JWT** (utilizador da tenacidade) e o mesmo contrato JSON documentado.
- **Amanhã (parceiro sério):** convém **credencial dedicada**, rede/limite claros e eventual evolução de API versionada / idempotência.
- Este ficheiro serve de **guia de alto nível**; o detalhe de campos continua em [atendimento-salvar-documento.md](./atendimento-salvar-documento.md).

---

*Documento gerado para planeamento de integração futura — ajustar conforme decisões de produto e jurídico.*
