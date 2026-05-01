import { ProgressSpinner } from "primereact/progressspinner";

export function LoadingState() {
  return (
    <div className="flex justify-content-center p-5">
      <ProgressSpinner />
    </div>
  );
}
