import { Suspense } from "react";

import { PaginaContasReceberLista } from "./pagina-contas-receber-lista";

export default function PaginaFinanceiroReceber() {
  return (
    <Suspense fallback={null}>
      <PaginaContasReceberLista />
    </Suspense>
  );
}
