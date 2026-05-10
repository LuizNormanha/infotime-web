import { Suspense } from "react";

import { LigaFinanceiroLayoutCliente } from "@/features/financeiro-cockpit/components/LigaFinanceiroLayoutCliente";

export default function FinanceiroLayout({ children }: { children: React.ReactNode }) {
  return (
    <Suspense fallback={null}>
      <LigaFinanceiroLayoutCliente>{children}</LigaFinanceiroLayoutCliente>
    </Suspense>
  );
}
