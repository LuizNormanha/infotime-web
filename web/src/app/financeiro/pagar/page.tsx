import { Suspense } from "react";

import { PaginaContasPagarLista } from "./pagina-contas-pagar-lista";

export default function PaginaFinanceiroPagar() {
  return (
    <Suspense fallback={null}>
      <PaginaContasPagarLista />
    </Suspense>
  );
}
