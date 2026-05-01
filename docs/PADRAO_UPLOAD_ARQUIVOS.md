# Padrão de upload de arquivos

## Princípios

- **Não** gravar novos arquivos grandes em `bytea` no PostgreSQL.
- Usar **MinIO** ou **S3-compatible**; credenciais por ambiente.
- Persistir no banco apenas **metadados**: chave do objeto, nome original, MIME, tamanho, `id_tenacidade`, referência à entidade.

## Legado

- Campos `nomearquivo`, `nomereferencia` e similares mapeiam para o registro de arquivo + URL assinada para download.

## Serviço compartilhado

- `storage.service.ts`: upload (stream/buffer), download, delete, URL pré-assinada.
- Validação: extensão permitida, tamanho máximo, MIME esperado.

## Segurança

- Acesso por **tenant** e **permissão**; nunca expor bucket público sem política explícita.

## Migração

- Job assíncrono para copiar bytea legado → objeto storage e atualizar metadados (projeto à parte por entidade).
