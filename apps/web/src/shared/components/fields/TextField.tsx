import { InputText } from "primereact/inputtext";
import type { Control, FieldPath, FieldValues } from "react-hook-form";
import { Controller } from "react-hook-form";

export function TextField<T extends FieldValues>(props: {
  control: Control<T>;
  name: FieldPath<T>;
  label: string;
}) {
  return (
    <Controller
      control={props.control}
      name={props.name}
      render={({ field, fieldState }) => (
        <div className="flex flex-column gap-1">
          <label htmlFor={String(props.name)}>{props.label}</label>
          <InputText id={String(props.name)} {...field} className={fieldState.error ? "p-invalid" : undefined} />
          {fieldState.error ? (
            <small className="p-error">{fieldState.error.message}</small>
          ) : null}
        </div>
      )}
    />
  );
}
