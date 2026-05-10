import type { Dispatch, SetStateAction } from "react";

import { Dropdown } from "primereact/dropdown";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";

import type { LigaFormularioSecao } from "@/components/formulario-base/LigaFormularioBase";

import { LigaContasPagarAgenteLookup } from "./liga-contas-pagar-agente-lookup";

export type CamposContasPagar = {
  idTipoAgente: string;
  /** Exibição do agente (não persistido na API). */
  agenteRotuloExibicao: string;
  idCliente: string;
  idFornecedor: string;
  idColaborador: string;
  idEmpresa: string;
  valorPrevisao: string;
  valorPrevisaoLiquido: string;
  dataPrevisao: string;
  idSituacaoDocumento: string;
  dataCompetencia: string;
  contaContabil: string;
  historico: string;
  idPlanoConta: string;
  idContaCaixa: string;
  valorRealizacao: string;
  dataRealizacao: string;
  idTipoEspecie: string;
  idCheque: string;
  numeroDocumento: string;
  dataAgendamento: string;
  valorAcrescimo: string;
  valorDesconto: string;
  valorMulta: string;
  valorJuros: string;
  dataBaixa: string;
  observacoes: string;
};

export type CtxSecoesContasPagarInfotime = {
  t: (key: string) => string;
  campos: CamposContasPagar;
  setCampos: Dispatch<SetStateAction<CamposContasPagar>>;
  idLancamentoDespesa: string | null;
  optsTipoAgente: { label: string; value: string }[];
  optsSituacao: { label: string; value: string }[];
  optsEmpresa: { label: string; value: string }[];
  optsPlanoConta: { label: string; value: string }[];
  optsContaCaixa: { label: string; value: string }[];
  optsTipoEspecie: { label: string; value: string }[];
  situacaoEhPago: boolean;
  especieEhCheque: boolean;
  tipoAgenteEhCliente: boolean;
  tipoAgenteEhFornecedor: boolean;
  tipoAgenteEhColaborador: boolean;
  auditoriaLinhas: { label: string; valor: string }[];
  arquivosLinhas: { label: string; valor: string }[];
  aoInputRotuloAgente: (texto: string) => void;
  aoSelecionarAgente: (id: string, rotulo: string) => void;
};

export function criarSecoesFormularioContasPagarInfotime(
  p: CtxSecoesContasPagarInfotime,
): LigaFormularioSecao[] {
  const {
    t,
    campos,
    setCampos,
    idLancamentoDespesa,
    optsTipoAgente,
    optsSituacao,
    optsEmpresa,
    optsPlanoConta,
    optsContaCaixa,
    optsTipoEspecie,
    situacaoEhPago,
    especieEhCheque,
    tipoAgenteEhCliente,
    tipoAgenteEhFornecedor,
    tipoAgenteEhColaborador,
    auditoriaLinhas,
    arquivosLinhas,
    aoInputRotuloAgente,
    aoSelecionarAgente,
  } = p;

  const labelValorReal = situacaoEhPago ? t("valorRealizacaoPago") : t("valorRealizacao");
  const labelDataReal = situacaoEhPago ? t("dataRealizacaoPago") : t("dataRealizacao");
  const labelEspecie = situacaoEhPago ? t("tipoEspeciePago") : t("tipoEspecie");

  const secIdentificacao: LigaFormularioSecao = {
    id: "identificacao",
    titulo: t("secIdentificacao"),
    icone: "pi-id-card",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <div className="liga-cliente-infotime-form-ident">
          <div className="liga-cliente-infotime-form-ident-grid">
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-tipo-agente">
                {t("tipoAgente")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <Dropdown
                  inputId="liga-cp-tipo-agente"
                  className="w-full"
                  value={campos.idTipoAgente || null}
                  options={optsTipoAgente}
                  onChange={(e) =>
                    setCampos((prev) => ({
                      ...prev,
                      idTipoAgente: String(e.value ?? ""),
                      idCliente: "",
                      idFornecedor: "",
                      idColaborador: "",
                      agenteRotuloExibicao: "",
                    }))
                  }
                  placeholder={t("selecione")}
                />
              </div>
            </div>
            {tipoAgenteEhCliente ? (
              <LigaContasPagarAgenteLookup
                tipoAgente="1"
                rotuloExibicao={campos.agenteRotuloExibicao}
                onInputRotulo={aoInputRotuloAgente}
                onSelecionar={aoSelecionarAgente}
                inputId="liga-cp-cli"
                label={t("cliente")}
                placeholder={t("placeholderBuscaAgente")}
                ariaLabel={t("ariaBuscaAgenteCliente")}
              />
            ) : null}
            {tipoAgenteEhFornecedor ? (
              <LigaContasPagarAgenteLookup
                tipoAgente="2"
                rotuloExibicao={campos.agenteRotuloExibicao}
                onInputRotulo={aoInputRotuloAgente}
                onSelecionar={aoSelecionarAgente}
                inputId="liga-cp-forn"
                label={t("fornecedor")}
                placeholder={t("placeholderBuscaAgente")}
                ariaLabel={t("ariaBuscaAgenteFornecedor")}
              />
            ) : null}
            {tipoAgenteEhColaborador ? (
              <LigaContasPagarAgenteLookup
                tipoAgente="3"
                rotuloExibicao={campos.agenteRotuloExibicao}
                onInputRotulo={aoInputRotuloAgente}
                onSelecionar={aoSelecionarAgente}
                inputId="liga-cp-col"
                label={t("colaborador")}
                placeholder={t("placeholderBuscaAgente")}
                ariaLabel={t("ariaBuscaAgenteColaborador")}
              />
            ) : null}
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-cod">
                {t("codigo")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-cod"
                  className="w-full"
                  readOnly
                  value={(idLancamentoDespesa ?? "").trim()}
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-emp">
                {t("empresa")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <Dropdown
                  inputId="liga-cp-emp"
                  className="w-full"
                  value={campos.idEmpresa || null}
                  options={optsEmpresa}
                  showClear
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, idEmpresa: String(e.value ?? "") }))
                  }
                  placeholder={t("selecione")}
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vp">
                {t("valorPrevisao")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-vp"
                  className="w-full"
                  value={campos.valorPrevisao}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, valorPrevisao: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vpl">
                {t("valorPrevisaoLiquido")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-vpl"
                  className="w-full"
                  value={campos.valorPrevisaoLiquido}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, valorPrevisaoLiquido: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-dp">
                {t("dataPrevisao")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-dp"
                  className="w-full"
                  type="date"
                  value={campos.dataPrevisao}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, dataPrevisao: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-sit">
                {t("situacao")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <Dropdown
                  inputId="liga-cp-sit"
                  className="w-full"
                  value={campos.idSituacaoDocumento || null}
                  options={optsSituacao}
                  onChange={(e) =>
                    setCampos((prev) => ({
                      ...prev,
                      idSituacaoDocumento: String(e.value ?? ""),
                    }))
                  }
                  placeholder={t("selecione")}
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-dc">
                {t("dataCompetencia")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-dc"
                  className="w-full"
                  type="date"
                  value={campos.dataCompetencia}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, dataCompetencia: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-cc">
                {t("contaContabil")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cp-cc"
                  className="w-full"
                  value={campos.contaContabil}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, contaContabil: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-hist">
                {t("historico")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputTextarea
                  id="liga-cp-hist"
                  className="w-full"
                  rows={3}
                  value={campos.historico}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, historico: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-pc">
                {t("planoContas")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <Dropdown
                  inputId="liga-cp-pc"
                  className="w-full"
                  value={campos.idPlanoConta || null}
                  options={optsPlanoConta}
                  filter
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, idPlanoConta: String(e.value ?? "") }))
                  }
                  placeholder={t("selecione")}
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    ),
  };

  const secPagamento: LigaFormularioSecao = {
    id: "pagamento",
    titulo: t("abaPagamento"),
    icone: "pi-wallet",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <div className="liga-cliente-infotime-form-ident-grid">
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-cx">
              {t("contaCaixa")}
            </label>
            <Dropdown
              inputId="liga-cp-cx"
              className="w-full"
              value={campos.idContaCaixa || null}
              options={optsContaCaixa}
              showClear
              filter
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idContaCaixa: String(e.value ?? "") }))
              }
              placeholder={t("selecione")}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vr">
              {labelValorReal}
            </label>
            <InputText
              id="liga-cp-vr"
              className="w-full"
              value={campos.valorRealizacao}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorRealizacao: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-dr">
              {labelDataReal}
            </label>
            <InputText
              id="liga-cp-dr"
              className="w-full"
              type="date"
              value={campos.dataRealizacao}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, dataRealizacao: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-te">
              {labelEspecie}
            </label>
            <Dropdown
              inputId="liga-cp-te"
              className="w-full"
              value={campos.idTipoEspecie || null}
              options={optsTipoEspecie}
              showClear
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  idTipoEspecie: String(e.value ?? ""),
                  idCheque: "",
                  numeroDocumento:
                    String(e.value ?? "") === "1" ? "" : prev.numeroDocumento,
                }))
              }
              placeholder={t("selecione")}
            />
          </div>
          {especieEhCheque ? (
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-ch">
                {t("cheque")} *
              </label>
              <InputText
                id="liga-cp-ch"
                className="w-full"
                inputMode="numeric"
                value={campos.idCheque}
                onChange={(e) =>
                  setCampos((prev) => ({ ...prev, idCheque: e.target.value }))
                }
                placeholder={t("placeholderIdCheque")}
              />
            </div>
          ) : (
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-nd">
                {t("numeroDocumento")}
              </label>
              <InputText
                id="liga-cp-nd"
                className="w-full"
                value={campos.numeroDocumento}
                onChange={(e) =>
                  setCampos((prev) => ({ ...prev, numeroDocumento: e.target.value }))
                }
              />
            </div>
          )}
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-da">
              {t("dataAgendamento")}
            </label>
            <InputText
              id="liga-cp-da"
              className="w-full"
              type="date"
              value={campos.dataAgendamento}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, dataAgendamento: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-db">
              {t("dataBaixa")}
            </label>
            <InputText
              id="liga-cp-db"
              className="w-full"
              type="date"
              value={campos.dataBaixa}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, dataBaixa: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-va">
              {t("valorAcrescimo")}
            </label>
            <InputText
              id="liga-cp-va"
              className="w-full"
              value={campos.valorAcrescimo}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorAcrescimo: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vd">
              {t("valorDesconto")}
            </label>
            <InputText
              id="liga-cp-vd"
              className="w-full"
              value={campos.valorDesconto}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorDesconto: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vm">
              {t("valorMulta")}
            </label>
            <InputText
              id="liga-cp-vm"
              className="w-full"
              value={campos.valorMulta}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorMulta: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cp-vj">
              {t("valorJuros")}
            </label>
            <InputText
              id="liga-cp-vj"
              className="w-full"
              value={campos.valorJuros}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorJuros: e.target.value }))
              }
            />
          </div>
        </div>
      </div>
    ),
  };

  const secAuditoria: LigaFormularioSecao = {
    id: "auditoria",
    titulo: t("abaAuditoria"),
    icone: "pi-info-circle",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <dl className="liga-contas-pagar-auditoria-dl">
          {auditoriaLinhas.map((linha) => (
            <div key={linha.label} className="liga-contas-pagar-auditoria-linha">
              <dt>{linha.label}</dt>
              <dd>{linha.valor || "—"}</dd>
            </div>
          ))}
        </dl>
      </div>
    ),
  };

  const secArquivos: LigaFormularioSecao = {
    id: "arquivos",
    titulo: t("abaArquivos"),
    icone: "pi-paperclip",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <p className="liga-contas-pagar-secao-ajuda">{t("arquivosEmBreve")}</p>
        <dl className="liga-contas-pagar-auditoria-dl">
          {arquivosLinhas.map((linha) => (
            <div key={linha.label} className="liga-contas-pagar-auditoria-linha">
              <dt>{linha.label}</dt>
              <dd>{linha.valor || "—"}</dd>
            </div>
          ))}
        </dl>
      </div>
    ),
  };

  const secRecorrente: LigaFormularioSecao = {
    id: "recorrencia",
    titulo: t("abaRecorrencia"),
    icone: "pi-refresh",
    conteudo: (
      <p className="liga-contas-pagar-secao-ajuda">{t("recorrenciaEmBreve")}</p>
    ),
  };

  const secParcelamento: LigaFormularioSecao = {
    id: "parcelamento",
    titulo: t("abaParcelamento"),
    icone: "pi-table",
    conteudo: (
      <p className="liga-contas-pagar-secao-ajuda">{t("parcelamentoEmBreve")}</p>
    ),
  };

  const secRateio: LigaFormularioSecao = {
    id: "rateio",
    titulo: t("abaRateio"),
    icone: "pi-percentage",
    conteudo: (
      <p className="liga-contas-pagar-secao-ajuda">{t("rateioEmBreve")}</p>
    ),
  };

  return [
    secIdentificacao,
    secPagamento,
    secAuditoria,
    secArquivos,
    secRecorrente,
    secParcelamento,
    secRateio,
  ];
}
