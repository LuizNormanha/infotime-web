"use client";

import Link from "next/link";
import "./liga-link.css";

export type LigaLinkProps = {
  texto: string;
  href: string;
  className?: string;
};

export function LigaLink({ texto, href, className = "" }: LigaLinkProps) {
  return (
    <Link className={`liga-link-recuperar ${className}`.trim()} href={href}>
      {texto}
    </Link>
  );
}
