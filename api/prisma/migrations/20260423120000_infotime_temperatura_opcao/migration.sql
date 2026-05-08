-- Catálogo global de opções de temperatura (sem id_tenacidade, sem RLS).
-- Ver mcp/temperatura-amostra/context.md §`infolab_temperatura_opcao`.

CREATE TABLE "infolab_temperatura_opcao" (
  "id_temperatura_opcao" BIGSERIAL NOT NULL,
  "texto_exibicao"       VARCHAR(100) NOT NULL,
  "eh_temperatura"       CHAR(1) NOT NULL,
  "valor_temperatura"    DECIMAL(5, 2),
  "unidade_temperatura"  CHAR(1),
  "ordem_exibicao"       SMALLINT NOT NULL,
  "ativo"                CHAR(1),

  CONSTRAINT "infolab_temperatura_opcao_pkey" PRIMARY KEY ("id_temperatura_opcao")
);

CREATE UNIQUE INDEX "uq_temperatura_opcao_ordem_exibicao"
  ON "infolab_temperatura_opcao" ("ordem_exibicao");
