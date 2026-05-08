"use client";

import { useEffect } from "react";

type Props = {
  error: Error & { digest?: string };
  reset: () => void;
};

/**
 * Boundary de erro global (Next.js App Router).
 * Captura exceções no RootLayout — substitui completamente o HTML.
 * Deve incluir <html> e <body> próprios.
 */
export default function ErroGlobal({ error, reset }: Props) {
  useEffect(() => {
    console.error("[ErroGlobal]", error);
  }, [error]);

  return (
    <html lang="pt-BR">
      <body style={{ fontFamily: "sans-serif", padding: "2rem", textAlign: "center" }}>
        <h1>Erro crítico</h1>
        <p>A aplicação encontrou um erro crítico e não pôde continuar.</p>
        {error.digest && <p style={{ color: "#666" }}>Código: {error.digest}</p>}
        <button type="button" onClick={reset} style={{ marginTop: "1rem", padding: "0.5rem 1.5rem" }}>
          Tentar recarregar
        </button>
      </body>
    </html>
  );
}
