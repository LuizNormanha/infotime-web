import { Message } from "primereact/message";

export function ErrorState(props: { message: string }) {
  return <Message severity="error" text={props.message} />;
}
