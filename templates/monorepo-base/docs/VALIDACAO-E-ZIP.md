# Validação funcional e geração do ZIP

## Regenerar o pacote ZIP

Na raiz do repositório onde existe `scripts/gerar-template-zip.mjs`:

```bash
npm run template:zip
```

- **Entrada**: monorepo atual (exclusões de artefatos locais — ver `manifest.json`).
- **Saída**: `templates/monorepo-base/output/liga-prj-template-<timestamp>.zip` (prefixo em `manifest.json` → `nomePacoteZip`).
- O README da raiz do pacote é substituído pelo conteúdo de `templates/monorepo-base/README-template.md`; o README original é preservado como `README.template.orig.md`.

## Checklist de aceite (após descompactar em pasta limpa)

1. **Instalação**

   ```bash
   npm ci
   ```

2. **Ambiente**

   - Copiar `api/.env.example` → `api/.env` e `web/.env.example` → `web/.env`.
   - Preencher `DATABASE_URL`, `SUPORTE_SECRET_KEY`, `WEB_URL`, `API_URL`.

3. **Banco**

   ```bash
   cd api && npx prisma migrate deploy && npx prisma generate && cd ..
   ```

4. **Desenvolvimento**

   ```bash
   npm run dev
   ```

5. **Login**

   - Acessar `/login`, autenticar com usuário válido do ambiente.
   - Confirmar cookie `access_token` e redirecionamento para home.

6. **Menu e abas**

   - Home carrega; menu abre entradas esperadas; abas abrem sem erro de import.

7. **Permissões**

   - Tela ativa dispara carregamento de permissões sem erro 500 recorrente.

8. **Build (opcional CI local)**

   ```bash
   npm run build
   ```

## Problemas comuns

| Sintoma | Verificação |
|---------|-------------|
| Login OK na API mas sessão não “pega” no Next | `API_URL` no web; proxy em `proxy-login-nest.ts`; CORS `WEB_URL` na API |
| 401 em todas as rotas | Guard + sessão no banco + `jti` |
| BFF 404 em recurso | `recursos-permitidos-bff.ts` e path correto |
