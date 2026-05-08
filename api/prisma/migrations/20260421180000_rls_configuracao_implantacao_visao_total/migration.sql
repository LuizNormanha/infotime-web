-- Listagem / GET de implantação (`implantacao-tenacidades`) precisa ler `infolab_tenacidade_configuracao`
-- de todos os laboratórios. A política estrita por `app.current_tenant_id` escondia o detalhe nas
-- outras linhas de `infolab_tenacidade` (campos de identidade migrados para a configuração).
-- A API define `app.infolab_implantacao_tenacidade_total = '1'` na mesma transação (somente rotas
-- `GuardImplantacaoJwt`), espelhando a intenção de `20260409140000_rls_tenacidade_implantacao_liga_br`.

DROP POLICY IF EXISTS infolab_tenacidade_configuracao_tenant_rls ON "infolab_tenacidade_configuracao";

CREATE POLICY infolab_tenacidade_configuracao_tenant_rls ON "infolab_tenacidade_configuracao"
FOR ALL
USING (
  NULLIF(current_setting('app.infolab_implantacao_tenacidade_total', true), '') = '1'
  OR (
    NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
    AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
  )
)
WITH CHECK (
  NULLIF(current_setting('app.infolab_implantacao_tenacidade_total', true), '') = '1'
  OR (
    NULLIF(current_setting('app.current_tenant_id', true), '') IS NOT NULL
    AND id_tenacidade = (NULLIF(current_setting('app.current_tenant_id', true), ''))::bigint
  )
);
