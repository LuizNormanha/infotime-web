# Modelo de especificação para um produto derivado

Use este esqueleto ao abrir um projeto novo (Wiki, Med, Prontuário, etc.) para manter o **mesmo fluxo de trabalho**: UI e padrões fixos; conteúdo variável abaixo.

Copie o bloco para um documento (`ESPEC.md`, ticket ou briefing) e preencha.

---

## 1. Identidade do produto

- **Nome do produto:**
- **Nome do repositório / pacote npm (raiz):**
- **Descrição em uma frase:**

## 2. Ambiente e banco

- **SGBD:** PostgreSQL (padrão) / outro: ___
- **`DATABASE_URL` (ambiente dev):** (não colar segredos em repositório público; referência ao vault ou ao `.env` local)
- **Estratégia Prisma:** introspect a partir do BD existente / migrations greenfield / híbrido
- **Nome lógico do schema ou database:**

## 3. Menu (IDs estáveis)

Os ids devem alinhar-se a `LigaMenuId` / estrutura em `web/src/data/menu-home-template-*.ts` e a permissões, se houver.

| ID do item de menu | Rótulo na UI | Rota (path Next) | Observação |
|--------------------|--------------|------------------|------------|
| | | | |

## 4. Entidades (domínio)

| Entidade | Tabela(s) | API prefix (ex. `/clientes`) | Notas |
|----------|-----------|------------------------------|--------|
| | | | |

## 5. Telas

Para cada tela:

- **Id menu (ligação):**
- **Tipo:** listagem / formulário (criar-editar) / ambos
- **Endpoint listagem:** método + path + query params principais
- **Endpoint detalhe/criar/atualizar/excluir:**
- **Campos principais do formulário (agrupados por seção):**
  - Seção A: …
  - Seção B: …
- **Validações e regras de negócio:** (bullets)
- **Integrações externas:** (se houver)

## 6. Regras transversais

- **Multi-tenant:** sim / não; como identificar tenant
- **Auditoria:** campos obrigatórios (usuário, IP, aplicação)
- **Permissões por tela:** perfis ou claims necessários

## 7. i18n

- **Locale padrão:** pt-BR
- **Chaves ou textos específicos do produto:** (lista ou “usar apenas chaves genéricas”)

---

Após o preenchimento, a implementação segue o [KIT-CRUD](../templates/monorepo-base/docs/KIT-CRUD.md) e o checklist em [TEMPLATE-DERIVACAO.md](TEMPLATE-DERIVACAO.md).
