import type { Metadata } from "next";
import { NextIntlClientProvider } from "next-intl";
import { getMessages, setRequestLocale } from "next-intl/server";

import { LigaProvedorApp } from "@/components/navegacao/home/LigaProvedorApp";

import "primereact/resources/primereact.min.css";
import "primereact/resources/themes/lara-light-green/theme.css";
import "primeicons/primeicons.css";
import "@/components/ui/tema/liga-tema.css";
import "@/components/ui/badge/liga-padrao-badge.css";
import "./globals.css";

export const metadata: Metadata = {
  title: "Infotime",
  description: "Aplicacao web InfoTIME",
  icons: {
    icon: [{ url: "/icon.png?v=20260508" }],
    shortcut: ["/icon.png?v=20260508"],
    apple: [{ url: "/icon.png?v=20260508" }],
  },
};

export default async function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  setRequestLocale("pt-BR");
  const mensagens = await getMessages();

  return (
    <html lang="pt-BR" data-theme="light" suppressHydrationWarning>
      <body className="liga-corpo">
        <NextIntlClientProvider locale="pt-BR" messages={mensagens}>
          <LigaProvedorApp>{children}</LigaProvedorApp>
        </NextIntlClientProvider>
      </body>
    </html>
  );
}
