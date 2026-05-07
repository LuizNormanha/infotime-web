import { zodResolver } from "@hookform/resolvers/zod";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { useEffect, useMemo, useState } from "react";
import { Controller, useForm } from "react-hook-form";
import { useNavigate } from "react-router-dom";
import { z } from "zod";
import { Button } from "primereact/button";
import { Dropdown } from "primereact/dropdown";
import { Message } from "primereact/message";
import { ProgressSpinner } from "primereact/progressspinner";
import { TabPanel, TabView } from "primereact/tabview";
import { ActionsBar } from "../../shared/components/form/ActionsBar.js";
import { TextField } from "../../shared/components/fields/TextField.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";

const schema = z.object({
  tipoPessoa: z.enum(["F", "J"]).nullable().optional(),
  razaoSocial: z.string().max(255),
  nomeFantasia: z.string().max(255),
  cnpj: z.string().max(14),
  email: z.string().max(100),
  telefone: z.string().max(50),
  celular: z.string().max(50),
  cep: z.string().max(8),
  cidade: z.string().max(100),
  estado: z.string().max(2),
});

type FormValues = z.infer<typeof schema>;

const tipoPessoaOpt = [
  { label: "Pessoa física", value: "F" as const },
  { label: "Pessoa jurídica", value: "J" as const },
];

const defaults: FormValues = {
  tipoPessoa: null,
  razaoSocial: "",
  nomeFantasia: "",
  cnpj: "",
  email: "",
  telefone: "",
  celular: "",
  cep: "",
  cidade: "",
  estado: "",
};

type ClienteApi = {
  idCliente: string;
  tipoPessoa?: string | null;
  razaoSocial?: string | null;
  nomeFantasia?: string | null;
  cnpj?: string | null;
  email?: string | null;
  telefone?: string | null;
  celular?: string | null;
  cep?: string | null;
  cidade?: string | null;
  estado?: string | null;
};

function normalizePayload(v: FormValues): Record<string, unknown> {
  const trim = (s: string) => (s.trim() === "" ? null : s.trim());
  const tp = v.tipoPessoa;
  return {
    tipoPessoa: tp ?? null,
    razaoSocial: trim(v.razaoSocial),
    nomeFantasia: trim(v.nomeFantasia),
    cnpj: trim(v.cnpj),
    email: trim(v.email),
    telefone: trim(v.telefone),
    celular: trim(v.celular),
    cep: trim(v.cep),
    cidade: trim(v.cidade),
    estado: v.estado.trim() === "" ? null : v.estado.trim().toUpperCase().slice(0, 2),
  };
}

function apiToForm(c: ClienteApi): FormValues {
  const tp = c.tipoPessoa;
  return {
    tipoPessoa: tp === "F" || tp === "J" ? tp : null,
    razaoSocial: c.razaoSocial ?? "",
    nomeFantasia: c.nomeFantasia ?? "",
    cnpj: c.cnpj ?? "",
    email: c.email ?? "",
    telefone: c.telefone ?? "",
    celular: c.celular ?? "",
    cep: c.cep ?? "",
    cidade: c.cidade ?? "",
    estado: c.estado ?? "",
  };
}

type Props = { mode: "create" } | { mode: "edit"; clienteId: string };

export function ClienteFormPage(props: Props) {
  const navigate = useNavigate();
  const queryClient = useQueryClient();
  const [globalError, setGlobalError] = useState<string | null>(null);

  const clienteId = props.mode === "edit" ? props.clienteId : "";

  const detailQuery = useQuery({
    queryKey: ["clientes", "detail", clienteId],
    enabled: props.mode === "edit",
    queryFn: () => httpJson<ClienteApi>(`${API_V1_PREFIX}/clientes/${clienteId}`),
  });

  const form = useForm<FormValues>({
    resolver: zodResolver(schema),
    defaultValues: defaults,
  });

  useEffect(() => {
    if (props.mode === "edit" && detailQuery.data) {
      form.reset(apiToForm(detailQuery.data));
    }
  }, [props.mode, detailQuery.data, form.reset]);

  const title = useMemo(
    () => (props.mode === "create" ? "Novo cliente" : "Editar cliente"),
    [props.mode],
  );

  const createMut = useMutation({
    mutationFn: (body: Record<string, unknown>) =>
      httpJson<ClienteApi>(`${API_V1_PREFIX}/clientes`, {
        method: "POST",
        body: JSON.stringify(body),
      }),
    onSuccess: () => {
      void queryClient.invalidateQueries({ queryKey: ["clientes"] });
      navigate("/clientes");
    },
    onError: (e: Error) => setGlobalError(e.message),
  });

  const updateMut = useMutation({
    mutationFn: (body: Record<string, unknown>) =>
      httpJson<ClienteApi>(`${API_V1_PREFIX}/clientes/${clienteId}`, {
        method: "PATCH",
        body: JSON.stringify(body),
      }),
    onSuccess: () => {
      void queryClient.invalidateQueries({ queryKey: ["clientes"] });
      navigate("/clientes");
    },
    onError: (e: Error) => setGlobalError(e.message),
  });

  const deleteMut = useMutation({
    mutationFn: () =>
      httpJson<{ ok: boolean }>(`${API_V1_PREFIX}/clientes/${clienteId}`, { method: "DELETE" }),
    onSuccess: () => {
      void queryClient.invalidateQueries({ queryKey: ["clientes"] });
      navigate("/clientes");
    },
    onError: (e: Error) => setGlobalError(e.message),
  });

  const submitForm = form.handleSubmit((values) => {
    setGlobalError(null);
    const body = normalizePayload(values);
    if (props.mode === "create") {
      createMut.mutate(body);
    } else {
      updateMut.mutate(body);
    }
  });

  const onCancel = () => navigate("/clientes");

  const onDelete = () => {
    if (props.mode !== "edit") return;
    if (!window.confirm("Excluir este cliente? Esta ação não pode ser desfeita.")) return;
    setGlobalError(null);
    deleteMut.mutate();
  };

  const saving = createMut.isPending || updateMut.isPending;

  if (props.mode === "edit") {
    if (detailQuery.isLoading) {
      return (
        <section className="liga-formulario" aria-busy="true">
          <div className="liga-metadados-splash" role="status">
            <ProgressSpinner style={{ width: "3rem", height: "3rem" }} strokeWidth="4" />
            <p className="liga-metadados-splash-texto">Carregando cliente…</p>
          </div>
        </section>
      );
    }
    if (detailQuery.error) {
      return (
        <section className="liga-formulario">
          <Message
            severity="error"
            text={(detailQuery.error as Error).message}
            className="liga-formulario-alerta-erro w-full"
          />
          <Button
            type="button"
            label="Voltar à lista"
            icon="pi pi-arrow-left"
            outlined
            className="liga-formulario-acoes-secundaria mt-3"
            onClick={onCancel}
          />
        </section>
      );
    }
  }

  return (
    <section className="liga-formulario">
      <div className="liga-formulario-topo">
        <div className="liga-formulario-topo-textos--barra-listagem">
          <span className="liga-formulario-barra-verde" aria-hidden />
          <div className="liga-formulario-topo-textos-inner">
            <h2 className="liga-formulario-titulo">
              <i className="pi pi-briefcase liga-formulario-titulo-icone" aria-hidden />
              {title}
            </h2>
            <p className="liga-formulario-subtitulo">
              Dados cadastrais e contato — mesmo padrão visual dos formulários Liga (referência
              infolab-web).
            </p>
          </div>
        </div>
        <ActionsBar
          variant="top"
          onCancel={onCancel}
          onSave={() => void submitForm()}
          onDelete={props.mode === "edit" ? onDelete : undefined}
          saving={saving}
          deleting={deleteMut.isPending}
        />
      </div>

      {globalError ? (
        <Message severity="error" text={globalError} className="liga-formulario-alerta-erro w-full" />
      ) : null}

      <div className="liga-formulario-layout liga-formulario-layout--etapas">
        <main className="liga-formulario-main">
          <div className="liga-formulario-cartao">
            <TabView className="w-full">
              <TabPanel header="Geral">
                <div className="grid">
                  <div className="col-12 md:col-6">
                    <Controller
                      control={form.control}
                      name="tipoPessoa"
                      render={({ field, fieldState }) => (
                        <div className="flex flex-column gap-1">
                          <label htmlFor="cliente-tipo-pessoa">Tipo de pessoa</label>
                          <Dropdown
                            inputId="cliente-tipo-pessoa"
                            value={field.value}
                            options={tipoPessoaOpt}
                            optionLabel="label"
                            optionValue="value"
                            placeholder="Selecione"
                            showClear
                            className={`w-full ${fieldState.error ? "p-invalid" : ""}`}
                            onChange={(e) => field.onChange(e.value)}
                          />
                          {fieldState.error ? (
                            <small className="p-error">{fieldState.error.message}</small>
                          ) : null}
                        </div>
                      )}
                    />
                  </div>
                  <div className="col-12 md:col-6" />
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="razaoSocial" label="Razão social / Nome" />
                  </div>
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="nomeFantasia" label="Nome fantasia" />
                  </div>
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="cnpj" label="CNPJ / CPF" />
                  </div>
                </div>
              </TabPanel>
              <TabPanel header="Contato e endereço">
                <div className="grid">
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="email" label="E-mail" />
                  </div>
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="telefone" label="Telefone" />
                  </div>
                  <div className="col-12 md:col-6">
                    <TextField control={form.control} name="celular" label="Celular" />
                  </div>
                  <div className="col-12 md:col-4">
                    <TextField control={form.control} name="cep" label="CEP" />
                  </div>
                  <div className="col-12 md:col-5">
                    <TextField control={form.control} name="cidade" label="Cidade" />
                  </div>
                  <div className="col-12 md:col-3">
                    <TextField control={form.control} name="estado" label="UF" />
                  </div>
                </div>
              </TabPanel>
            </TabView>
          </div>
        </main>
      </div>
    </section>
  );
}
