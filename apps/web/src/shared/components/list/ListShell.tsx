import type { ReactNode } from "react";

export function ListShell(props: { title: string; toolbar?: ReactNode; children: ReactNode }) {
  return (
    <section>
      <div className="flex justify-content-between align-items-center mb-3">
        <h1 className="m-0 text-2xl">{props.title}</h1>
        {props.toolbar}
      </div>
      {props.children}
    </section>
  );
}
