import "primereact/datatable";

declare module "primereact/datatable" {
  // Extensão de tipagem: algumas versões/empacotamentos do PrimeReact não expõem
  // as props de edição por célula no `.d.ts`, apesar do suporte em runtime.
  // Mantemos como opcional para não quebrar o restante do projeto.
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  interface DataTableProps<TValue = any> {
    editMode?: "cell" | "row";
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    onCellEditComplete?: (event: any) => void;
  }
}

