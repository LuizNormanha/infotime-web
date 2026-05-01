import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";
import { Button } from "primereact/button";
import { InputText } from "primereact/inputtext";
import { Password } from "primereact/password";
import { Message } from "primereact/message";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../../shared/auth/AuthProvider.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";

const schema = z.object({
  login: z.string().min(1),
  senha: z.string().min(1),
  idTenacidade: z.string().regex(/^\d+$/),
});

type FormValues = z.infer<typeof schema>;

export function LoginPage() {
  const { login } = useAuth();
  const navigate = useNavigate();
  const form = useForm<FormValues>({
    resolver: zodResolver(schema),
    defaultValues: { login: "admin", senha: "admin123", idTenacidade: "1" },
  });

  const onSubmit = form.handleSubmit(async (values) => {
    try {
      const res = await httpJson<{ accessToken: string }>(`${API_V1_PREFIX}/auth/login`, {
        method: "POST",
        body: JSON.stringify({
          login: values.login,
          senha: values.senha,
          tenantId: Number(values.idTenacidade),
        }),
      });
      login(res.accessToken, values.idTenacidade);
      navigate("/");
    } catch (e) {
      const msg = e instanceof Error ? e.message : "Falha no login";
      form.setError("root", { message: msg });
    }
  });

  return (
    <div className="flex align-items-center justify-content-center min-h-screen surface-ground">
      <form onSubmit={onSubmit} className="surface-card p-4 border-round shadow-2 w-full max-w-25rem flex flex-column gap-3">
        <h1 className="text-center m-0">Infotime</h1>
        {form.formState.errors.root ? (
          <Message severity="error" text={(form.formState.errors.root as { message?: string }).message ?? "Erro"} />
        ) : null}
        <div className="flex flex-column gap-2">
          <label htmlFor="tenant">id_tenacidade</label>
          <InputText id="tenant" {...form.register("idTenacidade")} />
        </div>
        <div className="flex flex-column gap-2">
          <label htmlFor="login">Login</label>
          <InputText id="login" {...form.register("login")} autoComplete="username" />
        </div>
        <div className="flex flex-column gap-2">
          <label htmlFor="senha">Senha</label>
          <Password
            id="senha"
            feedback={false}
            toggleMask
            inputClassName="w-full"
            className="w-full"
            value={form.watch("senha")}
            onChange={(e) => form.setValue("senha", e.target.value)}
          />
        </div>
        <Button type="submit" label="Entrar" loading={form.formState.isSubmitting} />
      </form>
    </div>
  );
}
