"use client";

import { Button } from "primereact/button";
import type { ButtonProps } from "primereact/button";
import "./liga-botao.css";

export type LigaBotaoProps = Omit<ButtonProps, "className"> & {
  className?: string;
};

export function LigaBotao({ className = "", ...props }: LigaBotaoProps) {
  return (
    <Button
      {...props}
      className={`liga-botao ${className}`.trim()}
    />
  );
}
