-- RAG: documentos com embeddings.
-- Armazenamento em JSONB (vetor de floats) para funcionar sem extensão pgvector no PostgreSQL local.
-- Em ambientes com pgvector, pode-se migrar a coluna para tipo `vector` e busca por índice.

CREATE TABLE "ai_documents" (
    "id" UUID NOT NULL DEFAULT gen_random_uuid(),
    "domain" VARCHAR(255) NOT NULL,
    "content" TEXT NOT NULL,
    "embedding" JSONB,
    "metadata" JSONB NOT NULL DEFAULT '{}'::jsonb,
    "created_at" TIMESTAMPTZ(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT "ai_documents_pkey" PRIMARY KEY ("id")
);

CREATE INDEX "idx_ai_documents_domain" ON "ai_documents" ("domain");
