import type { ReactNode } from "react";
import { Link } from "react-router-dom";

function PublicShell({
  title,
  children,
}: {
  title: string;
  children: ReactNode;
}) {
  return (
    <div className="min-h-screen surface-ground">
      <div className="p-4 max-w-30rem mx-auto">
        <h1 className="text-2xl font-semibold m-0 mb-3 text-color">{title}</h1>
        <div className="text-color-secondary line-height-3 m-0">{children}</div>
        <p className="mt-4 mb-0">
          <Link to="/login" className="text-primary font-medium">
            Voltar ao login
          </Link>
        </p>
      </div>
    </div>
  );
}

export function RecuperarSenhaPage() {
  return (
    <PublicShell title="Recuperar senha">
      <p>
        Se você esqueceu a senha, solicite uma nova definição ao administrador do seu tenant ou ao suporte da
        operação. Em breve poderemos disponibilizar aqui a recuperação por e-mail.
      </p>
    </PublicShell>
  );
}

export function AjudaPage() {
  return (
    <PublicShell title="Ajuda">
      <p>
        O Infotime Web está em evolução. Para dúvidas sobre acesso, permissões ou dados do seu ambiente,
        contate o administrador interno ou a equipe Liga responsável pelo rollout.
      </p>
    </PublicShell>
  );
}

export function PrivacidadePage() {
  return (
    <PublicShell title="Privacidade">
      <p>
        Tratamos dados pessoais apenas na medida necessária para prestação do serviço, conforme a legislação
        aplicável e as políticas do seu contrato. Solicitações de titular (acesso, correção, exclusão) devem
        ser encaminhadas ao responsável pelo tratamento no seu tenant ou ao canal oficial da Liga.
      </p>
      <p className="mt-3">
        Este texto é informativo; o documento legal definitivo pode ser fornecido pelo seu contratante ou pela
        Liga conforme o acordo vigente.
      </p>
    </PublicShell>
  );
}

export function TermosPage() {
  return (
    <PublicShell title="Termos de uso">
      <p>
        O uso do Infotime Web está sujeito às regras do ambiente ao qual você foi credenciado (tenant) e aos
        termos comerciais entre sua organização e a Liga. É vedado compartilhar credenciais, contornar
        controles de acesso ou extrair dados sem autorização.
      </p>
      <p className="mt-3">
        Para o texto completo aplicável ao seu contrato, consulte seu gestor ou o documento formal de prestação
        de serviços.
      </p>
    </PublicShell>
  );
}
