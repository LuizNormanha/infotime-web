"use client";

import { useTranslations } from "next-intl";

import {
  formatarSomenteDataCliente,
  idadeAnosDeDataNascimento,
  montarEnderecoCliente,
  strClienteCadastroExibicao,
} from "@/lib/cliente-cadastro-exibicao";

import "./cliente-resumo-cadastro-painel.css";

const str = strClienteCadastroExibicao;

export type ClienteResumoCadastroPainelProps = {
  detalhe: Record<string, unknown> | null;
  /**
   * Nome exibido no cabeçalho se `detalhe.nome` estiver vazio
   * (ex.: nome no protocolo do atendimento / nome no orçamento).
   */
  nomeFallback?: string | null;
};

/**
 * Resumo em somente leitura do cadastro (CPF, documentos, contato, endereço),
 * mesmo padrão visual da seção Cliente do formulário de atendimento.
 */
export function ClienteResumoCadastroPainel({
  detalhe,
  nomeFallback,
}: ClienteResumoCadastroPainelProps) {
  const t = useTranslations("home.listagem.atendimentos.formulario");

  if (!detalhe) return null;

  const titulo =
    str(detalhe.nome) ||
    (nomeFallback != null && String(nomeFallback).trim() ? String(nomeFallback).trim() : "") ||
    t("clienteTituloPainelFallback");

  const sexoExibicao = (() => {
    const s = str(detalhe.sexo).trim();
    if (!s) return "—";
    const u = s.toUpperCase();
    if (u === "M") return t("resumoCliente.sexoMasculino");
    if (u === "F") return t("resumoCliente.sexoFeminino");
    if (u === "I") return t("resumoCliente.sexoIndeterminado");
    return s;
  })();

  return (
    <div className="liga-cliente-resumo-cadastro-painel">
      <div className="liga-cliente-resumo-cadastro-painel-topo">
        <h3 className="liga-cliente-resumo-cadastro-painel-titulo">{titulo}</h3>
        <span className="liga-cliente-resumo-cadastro-painel-id">
          {t("resumoCliente.idPrefixo", { id: str(detalhe.id) || "—" })}
        </span>
      </div>
      <div className="liga-cliente-resumo-cadastro-painel-corpo">
        <div className="liga-cliente-resumo-cadastro-kv-grid">
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">{t("resumoCliente.cpf")}</span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.cpf) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.documento")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.documento) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">{t("resumoCliente.sexo")}</span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">{sexoExibicao}</span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.nascimento")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {formatarSomenteDataCliente(str(detalhe.data_nascimento)) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">{t("resumoCliente.idade")}</span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {idadeAnosDeDataNascimento(str(detalhe.data_nascimento)) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.nomeSocialCadastro")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.nome_social) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.celular")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.celular) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.telefone")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.telefone) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv">
            <span className="liga-cliente-resumo-cadastro-kv-label">{t("resumoCliente.email")}</span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {str(detalhe.email) || "—"}
            </span>
          </div>
          <div className="liga-cliente-resumo-cadastro-kv liga-cliente-resumo-cadastro-kv--wide">
            <span className="liga-cliente-resumo-cadastro-kv-label">
              {t("resumoCliente.endereco")}
            </span>
            <span className="liga-cliente-resumo-cadastro-kv-valor">
              {montarEnderecoCliente(detalhe) || "—"}
            </span>
          </div>
        </div>
      </div>
    </div>
  );
}
