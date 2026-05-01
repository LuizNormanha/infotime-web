/// <reference types="vite/client" />

interface ImportMetaEnv {
  /** Base da API no browser; vazio = URLs relativas (ex.: `/api/v1/...` com proxy). */
  readonly VITE_API_URL?: string;
  /** Destino do proxy `/api` no Vite (opcional). */
  readonly VITE_PROXY_API?: string;
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}
