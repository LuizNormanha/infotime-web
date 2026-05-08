"use client";

import { useEffect } from "react";
import { useRouter } from "next/navigation";

type Props = {
  error: Error & { digest?: string };
  reset: () => void;
};

/**
 * Boundary de erro de rota (Next.js App Router).
 * Captura exceções não tratadas em componentes client dentro da rota.
 */
export default function ErroRota({ error, reset }: Props) {
  const router = useRouter();

  useEffect(() => {
    console.error("[ErroRota]", error);
  }, [error]);

  return (
    <div className="liga-erro-pagina" role="alert" aria-live="assertive">
      <h2>Algo deu errado</h2>
      <p>Ocorreu um erro inesperado. Tente novamente ou volte para a página inicial.</p>
      {error.digest && (
        <p className="liga-erro-digest">Código: {error.digest}</p>
      )}
      <div className="liga-erro-acoes">
        <button type="button" onClick={reset}>
          Tentar novamente
        </button>
        <button type="button" onClick={() => router.push("/home")}>
          Ir para o início
        </button>
      </div>
    </div>
  );
}
