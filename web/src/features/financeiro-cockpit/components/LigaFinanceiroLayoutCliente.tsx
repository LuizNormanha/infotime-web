"use client";

import Link from "next/link";
import { usePathname, useRouter } from "next/navigation";
import { useTranslations } from "next-intl";
import { useEffect } from "react";

import { useSessaoAtual } from "@/hooks/useSessaoAtual";

import "../liga-financeiro-shell.css";

export function LigaFinanceiroLayoutCliente({ children }: { children: React.ReactNode }) {
  const t = useTranslations("home.financeiroGestaoIntegrada");
  const pathname = usePathname();
  const router = useRouter();
  const sessao = useSessaoAtual();

  useEffect(() => {
    if (!sessao.sessaoCarregada) return;
    if (!sessao.idUsuario) {
      router.replace("/login");
    }
  }, [sessao.idUsuario, sessao.sessaoCarregada, router]);

  if (!sessao.sessaoCarregada) {
    return (
      <div className="liga-financeiro-shell">
        <div className="liga-financeiro-shell-corpo" aria-busy="true" />
      </div>
    );
  }

  if (!sessao.idUsuario) {
    return null;
  }

  const ativoGestao = pathname === "/financeiro";
  const ativoPagar =
    pathname === "/financeiro/pagar" || pathname.startsWith("/financeiro/pagar/");
  const ativoReceber =
    pathname === "/financeiro/receber" || pathname.startsWith("/financeiro/receber/");

  return (
    <div className="liga-financeiro-shell">
      <header className="liga-financeiro-shell-topo">
        <Link href="/home" className="liga-financeiro-shell-nav">
          <span style={{ fontWeight: 700, color: "var(--liga-texto-principal)" }}>
            ← {t("navInicio")}
          </span>
        </Link>
        <nav className="liga-financeiro-shell-nav" aria-label="Financeiro">
          <Link href="/financeiro" className={ativoGestao ? "liga-financeiro-shell-nav-ativo" : ""}>
            {t("navGestao")}
          </Link>
          <Link href="/financeiro/pagar" className={ativoPagar ? "liga-financeiro-shell-nav-ativo" : ""}>
            {t("navPagar")}
          </Link>
          <Link
            href="/financeiro/receber"
            className={ativoReceber ? "liga-financeiro-shell-nav-ativo" : ""}
          >
            {t("navReceber")}
          </Link>
        </nav>
      </header>
      <div className="liga-financeiro-shell-corpo">{children}</div>
    </div>
  );
}
