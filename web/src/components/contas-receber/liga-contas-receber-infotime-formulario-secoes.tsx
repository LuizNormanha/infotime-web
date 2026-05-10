import type { Dispatch, SetStateAction } from "react";

import { Dropdown } from "primereact/dropdown";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";

import type { LigaFormularioSecao } from "@/components/formulario-base/LigaFormularioBase";

import { LigaContasReceberAgenteLookup } from "./liga-contas-receber-agente-lookup";

export type CamposContasReceber = {
  idTipoAgente: string;
  /** Exibição do agente (não persistido na API). */
  agenteRotuloExibicao: string;
  idCliente: string;
  idFornecedor: string;
  idColaborador: string;
  idEmpresa: string;
  valorOriginal: string;
  valorPrevisao: string;
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
  numeroDocumento: string;
  idNotaFiscal: string;
  notaFiscalNumero: string;
  valorAcrescimo: string;
  valorDesconto: string;
  valorMulta: string;
  valorJuros: string;
  dataBaixa: string;
  observacoes: string;
};

export type CtxSecoesContasReceberInfotime = {
  t: (key: string) => string;
  campos: CamposContasReceber;
  setCampos: Dispatch<SetStateAction<CamposContasReceber>>;
  idLancamentoReceita: string | null;
  optsTipoAgente: { label: string; value: string }[];
  optsSituacao: { label: string; value: string }[];
  optsEmpresa: { label: string; value: string }[];
  optsPlanoConta: { label: string; value: string }[];
  optsContaCaixa: { label: string; value: string }[];
  optsTipoEspecie: { label: string; value: string }[];
  situacaoEhPago: boolean;
  tipoAgenteEhCliente: boolean;
  tipoAgenteEhFornecedor: boolean;
  tipoAgenteEhColaborador: boolean;
  arquivosLinhas: { label: string; valor: string }[];
  aoInputRotuloAgente: (texto: string) => void;
  aoSelecionarAgente: (id: string, rotulo: string) => void;
};

export function criarSecoesFormularioContasReceberInfotime(
  p: CtxSecoesContasReceberInfotime,
): LigaFormularioSecao[] {
  const {
    t,
    campos,
    setCampos,
    idLancamentoReceita,
    optsTipoAgente,
    optsSituacao,
    optsEmpresa,
    optsPlanoConta,
    optsContaCaixa,
    optsTipoEspecie,
    situacaoEhPago,
    tipoAgenteEhCliente,
    tipoAgenteEhFornecedor,
    tipoAgenteEhColaborador,
    arquivosLinhas,
    aoInputRotuloAgente,
    aoSelecionarAgente,
  } = p;

  const labelValorReal = situacaoEhPago ? t("valorRealizacaoPago") : t("valorRealizacao");
  const labelDataReal = situacaoEhPago ? t("dataRealizacaoPago") : t("dataRealizacao");
  const labelEspecie = situacaoEhPago ? t("tipoEspeciePago") : t("tipoEspecie");

  const secIdentificacao: LigaFormularioSecao = {
    id: "caracteristicas",
    titulo: t("secCaracteristicas"),
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
              <LigaContasReceberAgenteLookup
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
              <LigaContasReceberAgenteLookup
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
              <LigaContasReceberAgenteLookup
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
                  value={(idLancamentoReceita ?? "").trim()}
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
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-vo">
                {t("valorOriginal")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-cr-vo"
                  className="w-full"
                  value={campos.valorOriginal}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, valorOriginal: e.target.value }))
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

  const secRecebimento: LigaFormularioSecao = {
    id: "recebimento",
    titulo: t("abaRecebimento"),
    icone: "pi-wallet",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <div className="liga-cliente-infotime-form-ident-grid">
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-cx">
              {t("contaCaixa")}
            </label>
            <Dropdown
              inputId="liga-cr-cx"
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
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-vr">
              {labelValorReal}
            </label>
            <InputText
              id="liga-cr-vr"
              className="w-full"
              value={campos.valorRealizacao}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorRealizacao: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-dr">
              {labelDataReal}
            </label>
            <InputText
              id="liga-cr-dr"
              className="w-full"
              type="date"
              value={campos.dataRealizacao}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, dataRealizacao: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-te">
              {labelEspecie}
            </label>
            <Dropdown
              inputId="liga-cr-te"
              className="w-full"
              value={campos.idTipoEspecie || null}
              options={optsTipoEspecie}
              showClear
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  idTipoEspecie: String(e.value ?? ""),
                }))
              }
              placeholder={t("selecione")}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-nd">
              {t("numeroDocumento")}
            </label>
            <InputText
              id="liga-cr-nd"
              className="w-full"
              value={campos.numeroDocumento}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, numeroDocumento: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-va">
              {t("valorAcrescimo")}
            </label>
            <InputText
              id="liga-cr-va"
              className="w-full"
              value={campos.valorAcrescimo}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorAcrescimo: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-vd">
              {t("valorDesconto")}
            </label>
            <InputText
              id="liga-cr-vd"
              className="w-full"
              value={campos.valorDesconto}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorDesconto: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-vm">
              {t("valorMulta")}
            </label>
            <InputText
              id="liga-cr-vm"
              className="w-full"
              value={campos.valorMulta}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorMulta: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-vj">
              {t("valorJuros")}
            </label>
            <InputText
              id="liga-cr-vj"
              className="w-full"
              value={campos.valorJuros}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, valorJuros: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-nf">
              {t("idNotaFiscal")}
            </label>
            <InputText
              id="liga-cr-nf"
              className="w-full"
              inputMode="numeric"
              value={campos.idNotaFiscal}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idNotaFiscal: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-nfn">
              {t("notaFiscalNumero")}
            </label>
            <InputText
              id="liga-cr-nfn"
              className="w-full"
              value={campos.notaFiscalNumero}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, notaFiscalNumero: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-db">
              {t("dataBaixa")}
            </label>
            <InputText
              id="liga-cr-db"
              className="w-full"
              type="date"
              value={campos.dataBaixa}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, dataBaixa: e.target.value }))
              }
            />
          </div>
        </div>
      </div>
    ),
  };

  const secObservacoes: LigaFormularioSecao = {
    id: "observacoes",
    titulo: t("abaObservacoes"),
    icone: "pi-comment",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-cr-obs">
            {t("observacoes")}
          </label>
          <div className="liga-cliente-infotime-primeira-linha-controles">
            <InputTextarea
              id="liga-cr-obs"
              className="w-full"
              rows={6}
              value={campos.observacoes}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, observacoes: e.target.value }))
              }
            />
          </div>
        </div>
      </div>
    ),
  };

  const secArquivos: LigaFormularioSecao = {
    id: "arquivos",
    titulo: t("abaArquivos"),
    icone: "pi-paperclip",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <p className="liga-contas-receber-secao-ajuda">{t("arquivosEmBreve")}</p>
        <dl className="liga-contas-receber-auditoria-dl">
          {arquivosLinhas.map((linha) => (
            <div key={linha.label} className="liga-contas-receber-auditoria-linha">
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
      <p className="liga-contas-receber-secao-ajuda">{t("recorrenciaEmBreve")}</p>
    ),
  };

  return [
    secIdentificacao,
    secRecebimento,
    secObservacoes,
    secArquivos,
    secRecorrente,
  ];
}
