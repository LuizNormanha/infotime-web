-- Remove tabela `infolab_aplicacao_campo_tenacidade` (override de campo por tenacidade)
-- não utilizada pela aplicação: não há service/controller/DTO/seed referenciando-a.
-- Overrides de metadados de campo continuam sendo tratados via `infolab_aplicacao_campo`
-- (linha base com `id_tenacidade = 0`) e, quando necessário, por outras estruturas.

-- A política de RLS foi criada em `20260413120000_rls_tenant_id_tenacidade_all_tables`.
-- Removemos antes de dropar a tabela para manter o histórico explícito.
DROP POLICY IF EXISTS infolab_aplicacao_campo_tenacidade_tenant_rls
    ON "infolab_aplicacao_campo_tenacidade";

-- `DROP TABLE` remove automaticamente FKs (`fk_infolab_aplicacao_campo_tenacidade_*`),
-- índices (`idx_*_01/02`, `uq_*_01`) e a PK (`infolab_aplicacao_campo_tenacidade_pkey`).
DROP TABLE IF EXISTS "infolab_aplicacao_campo_tenacidade";
