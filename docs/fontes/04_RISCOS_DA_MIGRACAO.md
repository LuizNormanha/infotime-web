# 04 — Riscos críticos da migração

| Risco | Descrição | Mitigação (direção) |
|-------|-----------|------------------------|
| **Multi-tenancy** | Quase todas as tabelas usam `id_tenacidade`; vazamento de tenant expõe dados de outro cliente. | `id_tenacidade` derivado do JWT; repositórios sempre filtram; nunca confiar no body/query para tenant em CRUD padrão. |
| **Auth e senha legada** | Senhas possivelmente MD5 no legado. | bcrypt/Argon2 para novas; **rehash no primeiro login** após validar legado, conforme [`../PADRAO_AUTH_RBAC.md`](../PADRAO_AUTH_RBAC.md). |
| **RBAC granular** | `grupo_usuario`, aplicação, campo e bloco. | Middleware + entidades de permissão; `usePermission` no frontend; testes por perfil. |
| **Auditoria** | Eventos Scriptcase preenchem usuário, IP, aplicação. | Middleware Prisma/serviço; respeitar flag de configuração se existir no legado. |
| **Financeiro fechado** | Período fechado pode bloquear alteração de receita/despesa. | Regra no **service**; transações; mensagens de negócio padronizadas. |
| **Boletos / CNAB** | Arquivos, remessas, retornos, convenções bancárias. | Módulos dedicados; testes com arquivos de exemplo; ambiente de homologação. |
| **PIX** | Integração Itaú (corpus); certificados e idempotência. | Configuração por tenant; secrets fora do repositório; fila/retry documentados. |
| **NFS-e** | Município, certificado, rejeições. | Camada de integração + rastreio de status; não duplicar emissão. |
| **Arquivos e bytea** | Legado com `bytea` / rename Scriptcase. | **MinIO/S3**; metadados no PostgreSQL; migração de binários antigos como projeto à parte. |
| **Timezone** | Datas locais vs UTC em relatórios e fim de dia. | Política explícita (UTC no banco, TZ na borda); testes em borda de dia. |
| **Dados de seed** | Perfil demo vs produção. | `seed.ts` idempotente; sem dados reais; documentar no README. |
| **Regras em eventos Scriptcase** | Lógica espalhada em PHP. | Extrair intenção para `regras-scriptcase.md` e reimplementar em service; checklist de tela. |

## Itens transversais do corpus

- **"Pacientes" = `cliente`:** nomenclatura única no código e documentação.
- **Integrações:** ViaCEP, SMTP, SMS, Google Calendar/OAuth — cada uma com risco de indisponibilidade; timeouts e fallbacks.
