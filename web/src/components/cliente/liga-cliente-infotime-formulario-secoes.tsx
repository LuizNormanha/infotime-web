import type { Dispatch, SetStateAction } from "react";

import { Button } from "primereact/button";
import { Calendar } from "primereact/calendar";
import { Dropdown } from "primereact/dropdown";
import { InputMask } from "primereact/inputmask";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
import { RadioButton } from "primereact/radiobutton";

import type { LigaFormularioSecao } from "@/components/formulario-base/LigaFormularioBase";

import { ClienteInfotimeEnderecoMapaOsm } from "./ClienteInfotimeEnderecoMapaOsm";
import type { Campos } from "./LigaClienteInfotimeFormulario";

export type DropdownOptsCliente = {
  situacoes: { label: string; value: string }[];
  tipos: { label: string; value: string }[];
  contas: { label: string; value: string }[];
  canais: { label: string; value: string }[];
  concorrentes: { label: string; value: string }[];
  municipios: { label: string; value: string }[];
  regioes: { label: string; value: string }[];
};

export type CtxSecoesClienteInfotime = {
  t: (key: string) => string;
  campos: Campos;
  setCampos: Dispatch<SetStateAction<Campos>>;
  str: (v: unknown) => string;
  ehPf: boolean;
  dropdownOpts: DropdownOptsCliente;
  labelFantasia: string;
  labelDoc: string;
  labelIe: string;
  labelIm: string;
  tenantPrincipal: boolean;
  idCliente: string | null;
  docObrigatorioUi: boolean;
  snOpts: { label: string; value: string }[];
  labelRazao: string;
  opcoesUf: { label: string; value: string }[];
  abrirMapaEnderecoModal: () => void;
};

export function criarSecoesFormularioClienteInfotime(
  p: CtxSecoesClienteInfotime,
): LigaFormularioSecao[] {
  const {
    t,
    campos,
    setCampos,
    str,
    ehPf,
    dropdownOpts,
    labelFantasia,
    labelDoc,
    labelIe,
    labelIm,
    tenantPrincipal,
    idCliente,
    docObrigatorioUi,
    snOpts,
    labelRazao,
    opcoesUf,
    abrirMapaEnderecoModal,
  } = p;

  const rotuloCodigo = (idCliente ?? "").trim();

  function parseCoordenadaDigitada(raw: string): number | null {
    const s = raw.trim().replace(",", ".");
    if (s === "") return null;
    const n = Number.parseFloat(s);
    return Number.isFinite(n) ? n : null;
  }

  function coordenadaParaTexto(n: number | null): string {
    return n == null ? "" : String(n);
  }

  const latMapa = parseCoordenadaDigitada(campos.latitude);
  const lonMapa = parseCoordenadaDigitada(campos.longitude);

  const secIdentificacao: LigaFormularioSecao = {
    id: "identificacao",
    titulo: t("secIdentificacao"),
    icone: "pi-id-card",
    conteudo: (
      <>
        <div className="liga-cliente-infotime-form-primeira-linha">
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="razao">
              {labelRazao} *
            </label>
            <div className="liga-cliente-infotime-primeira-linha-controles">
              <InputText
                id="razao"
                className="w-full"
                value={campos.razaoSocial}
                onChange={(e) =>
                  setCampos((prev) => ({ ...prev, razaoSocial: e.target.value }))
                }
              />
            </div>
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="tp-j">
              {t("tipoPessoa")}
            </label>
            <div className="liga-cliente-infotime-primeira-linha-controles">
              <div
                className="liga-cliente-infotime-radio-linha"
                role="radiogroup"
                aria-label={t("tipoPessoa")}
              >
                <RadioButton
                  inputId="tp-j"
                  checked={campos.tipoPessoa === "J"}
                  onChange={() => setCampos((prev) => ({ ...prev, tipoPessoa: "J" }))}
                />
                <label htmlFor="tp-j">{t("pessoaJuridica")}</label>
                <RadioButton
                  inputId="tp-f"
                  checked={campos.tipoPessoa === "F"}
                  onChange={() => setCampos((prev) => ({ ...prev, tipoPessoa: "F" }))}
                />
                <label htmlFor="tp-f">{t("pessoaFisica")}</label>
              </div>
            </div>
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label
              className="liga-cliente-infotime-primeira-linha-label"
              htmlFor="liga-cli-situacao-linha1"
            >
              {t("situacao")} *
            </label>
            <div className="liga-cliente-infotime-primeira-linha-controles">
              <Dropdown
                inputId="liga-cli-situacao-linha1"
                className="w-full"
                value={campos.idSituacaoCliente || null}
                options={dropdownOpts.situacoes}
                onChange={(e) =>
                  setCampos((prev) => ({ ...prev, idSituacaoCliente: str(e.value) }))
                }
                placeholder={t("selecione")}
              />
            </div>
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="codigo">
              {t("codigo")}
            </label>
            <div className="liga-cliente-infotime-primeira-linha-controles">
              <InputText id="codigo" className="w-full" value={rotuloCodigo} disabled />
            </div>
          </div>
        </div>
        <div className="liga-cliente-infotime-form-linha-fantasia-so">
          <label className="liga-cliente-infotime-label" htmlFor="nf">
            {labelFantasia} *
          </label>
          <InputText
            id="nf"
            className="w-full"
            value={campos.nomeFantasia}
            onChange={(e) => setCampos((prev) => ({ ...prev, nomeFantasia: e.target.value }))}
          />
        </div>
        {ehPf ? (
          <div className="liga-cliente-infotime-form-grid2">
            <div>
              <label className="liga-cliente-infotime-label">{t("sexo")}</label>
              <Dropdown
                value={campos.sexo || null}
                options={[
                  { label: t("sexoM"), value: "M" },
                  { label: t("sexoF"), value: "F" },
                  { label: t("sexoI"), value: "I" },
                ]}
                onChange={(e) => setCampos((prev) => ({ ...prev, sexo: str(e.value) }))}
                placeholder={t("selecione")}
                showClear
              />
            </div>
            <div>
              <label className="liga-cliente-infotime-label">{t("dataNascimento")}</label>
              <Calendar
                value={campos.dataNascimento}
                onChange={(e) =>
                  setCampos((prev) => ({
                    ...prev,
                    dataNascimento: e.value instanceof Date ? e.value : null,
                  }))
                }
                dateFormat="dd/mm/yy"
                showIcon
              />
            </div>
          </div>
        ) : null}
        <div className="liga-cliente-infotime-form-ident-conta-municipio">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-conta">
              {t("contaCaixa")} *
            </label>
            <Dropdown
              inputId="liga-cli-conta"
              className="w-full"
              value={campos.idContaCaixa || null}
              options={dropdownOpts.contas}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idContaCaixa: str(e.value) }))
              }
              placeholder={t("selecione")}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-municipio">
              {t("municipio")}
            </label>
            <Dropdown
              inputId="liga-cli-municipio"
              className="w-full"
              value={campos.idMunicipio || null}
              options={dropdownOpts.municipios}
              filter
              onChange={(e) => setCampos((prev) => ({ ...prev, idMunicipio: str(e.value) }))}
              placeholder={t("selecione")}
              showClear
            />
          </div>
        </div>
        <div>
          <label className="liga-cliente-infotime-label" htmlFor="liga-cli-contatos-ta">
            {t("contatos")}
          </label>
          <InputTextarea
            id="liga-cli-contatos-ta"
            rows={6}
            className="w-full"
            value={campos.contatos}
            onChange={(e) => setCampos((prev) => ({ ...prev, contatos: e.target.value }))}
          />
        </div>
      </>
    ),
  };

  const secDadosAdicionais: LigaFormularioSecao = {
    id: "dadosAdicionais",
    titulo: t("abaDadosAdicionais"),
    icone: "pi-info-circle",
    conteudo: (
      <>
        <div className="liga-cliente-infotime-form-dados-add-linha1">
          <div className="liga-cliente-infotime-form-da1-col-chave">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-chave-acesso">
              {t("chaveAcesso")}
            </label>
            <InputText
              id="liga-cli-chave-acesso"
              className="w-full"
              value={campos.chaveAcesso}
              disabled
            />
          </div>
          <div className="liga-cliente-infotime-form-da1-col-data">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-data-exp">
              {t("dataExpiracao")}
            </label>
            <Calendar
              inputId="liga-cli-data-exp"
              className="w-full"
              value={campos.dataExpiracao}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  dataExpiracao: e.value instanceof Date ? e.value : null,
                }))
              }
              dateFormat="dd/mm/yy"
              showIcon
            />
          </div>
          <div className="liga-cliente-infotime-form-da1-col-qtd">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-qtd-lic">
              {t("qtdLicenca")}
            </label>
            <InputText
              id="liga-cli-qtd-lic"
              className="w-full"
              inputMode="numeric"
              value={campos.qtdLicenca}
              onChange={(e) => setCampos((prev) => ({ ...prev, qtdLicenca: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-form-da1-col-canal">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-canal-da">
              {t("canal")}
            </label>
            <Dropdown
              inputId="liga-cli-canal-da"
              className="w-full"
              value={campos.idClienteCanal || null}
              options={dropdownOpts.canais}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idClienteCanal: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
          <div className="liga-cliente-infotime-form-da1-col-cli-pub">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-cli-pub">
              {t("clientePublico")}
            </label>
            <Dropdown
              inputId="liga-cli-cli-pub"
              className="w-full"
              value={campos.clientePublico || null}
              options={snOpts}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, clientePublico: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
        </div>
        <div className="liga-cliente-infotime-form-dados-add-linha2">
          <div className="liga-cliente-infotime-form-da2-col-homepage">
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-homepage">
              {t("homepage")}
            </label>
            <InputText
              id="liga-cli-homepage"
              className="w-full"
              value={campos.homepage}
              onChange={(e) => setCampos((prev) => ({ ...prev, homepage: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-tipo-cli">
              {t("tipoCliente")}
            </label>
            <Dropdown
              inputId="liga-cli-tipo-cli"
              className="w-full"
              value={campos.idTipoCliente || null}
              options={dropdownOpts.tipos}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idTipoCliente: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-concorrente">
              {t("concorrente")}
            </label>
            <Dropdown
              inputId="liga-cli-concorrente"
              className="w-full"
              value={campos.idConcorrente || null}
              options={dropdownOpts.concorrentes}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idConcorrente: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-emite-bol">
              {t("emiteBoleto")}
            </label>
            <Dropdown
              inputId="liga-cli-emite-bol"
              className="w-full"
              value={campos.emiteBoleto || null}
              options={snOpts}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, emiteBoleto: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
        </div>
      </>
    ),
  };

  const secDocumentos: LigaFormularioSecao = {
    id: "documentos",
    titulo: t("abaDocumentos"),
    icone: "pi-file",
    conteudo: (
      <div className="liga-cliente-infotime-form-documentos-grid">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-cnpj">
              {labelDoc}
              {docObrigatorioUi ? " *" : ""}
            </label>
            <InputText
              id="liga-cli-doc-cnpj"
              className="w-full"
              value={campos.cnpj}
              onChange={(e) => setCampos((prev) => ({ ...prev, cnpj: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-ie">
              {labelIe}
            </label>
            <InputText
              id="liga-cli-doc-ie"
              className="w-full"
              value={campos.inscricaoEstadual}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, inscricaoEstadual: e.target.value }))
              }
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-im">
              {labelIm}
            </label>
            <InputText
              id="liga-cli-doc-im"
              className="w-full"
              value={campos.inscricaoMunicipal}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, inscricaoMunicipal: e.target.value }))
              }
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-cr">
              {t("certificadoRegistro")}
            </label>
            <InputText
              id="liga-cli-doc-cr"
              className="w-full"
              value={campos.certificadoRegistro}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, certificadoRegistro: e.target.value }))
              }
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-dem">
              {t("dataEmissaoCr")}
            </label>
            <Calendar
              inputId="liga-cli-doc-dem"
              className="w-full"
              value={campos.dataEmissaoCr}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  dataEmissaoCr: e.value instanceof Date ? e.value : null,
                }))
              }
              dateFormat="dd/mm/yy"
              showIcon
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-dvm">
              {t("dataValidadeCr")}
            </label>
            <Calendar
              inputId="liga-cli-doc-dvm"
              className="w-full"
              value={campos.dataValidadeCr}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  dataValidadeCr: e.value instanceof Date ? e.value : null,
                }))
              }
              dateFormat="dd/mm/yy"
              showIcon
            />
          </div>
          {idCliente && campos.numeroAntigo ? (
            <div>
              <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-na">
                {t("numeroAntigo")}
              </label>
              <InputText id="liga-cli-doc-na" className="w-full" value={campos.numeroAntigo} disabled />
            </div>
          ) : null}
          {idCliente && campos.idClienteInfolab ? (
            <div>
              <label className="liga-cliente-infotime-label" htmlFor="liga-cli-doc-infolab">
                {t("idClienteInfolab")}
              </label>
              <InputText
                id="liga-cli-doc-infolab"
                className="w-full"
                value={campos.idClienteInfolab}
                disabled
              />
            </div>
          ) : null}
      </div>
    ),
  };

  const secEndereco: LigaFormularioSecao = {
    id: "endereco",
    titulo: t("abaEndereco"),
    icone: "pi-map-marker",
    conteudo: (
      <div className="liga-cliente-infotime-endereco-bloco">
        <div className="liga-cliente-infotime-endereco-linha liga-cliente-infotime-endereco-linha--cep-logra">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-cep">
              {t("cep")}
            </label>
            <InputMask
              id="liga-cli-end-cep"
              mask="99999-999"
              unmask
              autoClear={false}
              value={campos.cep.replace(/\D/g, "").slice(0, 8)}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  cep: String(e.value ?? "").replace(/\D/g, "").slice(0, 8),
                }))
              }
              className="w-full"
            />
          </div>
          <div>
            <label
              className="liga-cliente-infotime-label liga-cliente-infotime-endereco-label-nowrap"
              htmlFor="liga-cli-end-logr"
            >
              {t("logradouro")}
            </label>
            <InputText
              id="liga-cli-end-logr"
              className="w-full"
              value={campos.logradouro}
              onChange={(e) => setCampos((prev) => ({ ...prev, logradouro: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-num">
              {t("numero")}
            </label>
            <InputText
              id="liga-cli-end-num"
              className="w-full"
              value={campos.numero}
              onChange={(e) => setCampos((prev) => ({ ...prev, numero: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-comp">
              {t("complemento")}
            </label>
            <InputText
              id="liga-cli-end-comp"
              className="w-full"
              value={campos.complemento}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, complemento: e.target.value }))
              }
            />
          </div>
        </div>

        <div className="liga-cliente-infotime-endereco-linha liga-cliente-infotime-endereco-linha--local">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-bairro">
              {t("bairro")}
            </label>
            <InputText
              id="liga-cli-end-bairro"
              className="w-full"
              value={campos.bairro}
              onChange={(e) => setCampos((prev) => ({ ...prev, bairro: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-cidade">
              {t("cidade")}
            </label>
            <InputText
              id="liga-cli-end-cidade"
              className="w-full"
              value={campos.cidade}
              onChange={(e) => setCampos((prev) => ({ ...prev, cidade: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-lat">
              {t("latitude")}
            </label>
            <InputText
              id="liga-cli-end-lat"
              className="w-full"
              inputMode="decimal"
              value={campos.latitude}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, latitude: e.target.value }))
              }
              onBlur={(e) => {
                const n = parseCoordenadaDigitada(e.target.value);
                setCampos((prev) => ({
                  ...prev,
                  latitude: coordenadaParaTexto(n),
                }));
              }}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-lon">
              {t("longitude")}
            </label>
            <InputText
              id="liga-cli-end-lon"
              className="w-full"
              inputMode="decimal"
              value={campos.longitude}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, longitude: e.target.value }))
              }
              onBlur={(e) => {
                const n = parseCoordenadaDigitada(e.target.value);
                setCampos((prev) => ({
                  ...prev,
                  longitude: coordenadaParaTexto(n),
                }));
              }}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-uf-dd">
              {t("estado")}
            </label>
            <Dropdown
              inputId="liga-cli-end-uf-dd"
              value={campos.estado.trim() ? campos.estado.trim().toUpperCase().slice(0, 2) : null}
              options={opcoesUf}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  estado: str(e.value).toUpperCase().slice(0, 2),
                }))
              }
              placeholder={t("selecione")}
              filter
              filterBy="label"
              panelClassName="liga-cliente-infotime-endereco-uf-panel"
              showClear
              className="w-full"
            />
          </div>
        </div>

        <div className="liga-cliente-infotime-endereco-linha liga-cliente-infotime-endereco-linha--regiao">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-regiao">
              {t("regiaoEstadual")}
            </label>
            <Dropdown
              inputId="liga-cli-end-regiao"
              className="w-full"
              value={campos.idRegiaoEstadual || null}
              options={dropdownOpts.regioes}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, idRegiaoEstadual: str(e.value) }))
              }
              placeholder={t("selecione")}
              showClear
            />
          </div>
          <div>
            <label
              className="liga-cliente-infotime-label liga-cliente-infotime-endereco-label-nowrap"
              htmlFor="liga-cli-end-tipo-log"
            >
              {t("tipoLogradouro")}
            </label>
            <InputText
              id="liga-cli-end-tipo-log"
              className="w-full"
              value={campos.tipoLogradouro}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, tipoLogradouro: e.target.value }))
              }
            />
          </div>
        </div>

        <div className="liga-cliente-infotime-endereco-linha liga-cliente-infotime-endereco-linha--contato">
          <div className="liga-cliente-infotime-endereco-celula-telefones">
            <div>
              <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-tel">
                {t("telefone")}
              </label>
              <InputMask
                id="liga-cli-end-tel"
                mask="(99) 9999-9999"
                unmask
                autoClear={false}
                value={campos.telefone.replace(/\D/g, "").slice(0, 10)}
                onChange={(e) =>
                  setCampos((prev) => ({
                    ...prev,
                    telefone: String(e.value ?? "").replace(/\D/g, "").slice(0, 10),
                  }))
                }
              />
            </div>
            <div>
              <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-cel">
                {t("celular")}
              </label>
              <InputMask
                id="liga-cli-end-cel"
                mask="(99) 99999-9999"
                unmask
                autoClear={false}
                value={campos.celular.replace(/\D/g, "").slice(0, 11)}
                onChange={(e) =>
                  setCampos((prev) => ({
                    ...prev,
                    celular: String(e.value ?? "").replace(/\D/g, "").slice(0, 11),
                  }))
                }
              />
            </div>
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-email">
              {t("email")}
            </label>
            <InputText
              id="liga-cli-end-email"
              type="email"
              className="w-full"
              value={campos.email}
              onChange={(e) => setCampos((prev) => ({ ...prev, email: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-cli-end-info-ad">
              {t("infoAdicionaisEndereco")}
            </label>
            <InputText
              id="liga-cli-end-info-ad"
              className="w-full"
              value={campos.observacoes}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, observacoes: e.target.value }))
              }
            />
          </div>
        </div>

        <div className="liga-cliente-infotime-endereco-mapa-wrap">
          <div className="liga-cliente-infotime-endereco-mapa-label-linha">
            <span className="liga-cliente-infotime-label">{t("mapaLocalizacao")}</span>
            <Button
              type="button"
              icon="pi pi-map"
              rounded
              outlined
              severity="secondary"
              className="liga-cliente-infotime-endereco-mapa-botao-circulo"
              onClick={abrirMapaEnderecoModal}
              aria-label={t("mapaExpandirAria")}
              tooltip={t("mapaExpandir")}
              tooltipOptions={{ position: "bottom" }}
            />
          </div>
          <ClienteInfotimeEnderecoMapaOsm
            lat={latMapa}
            lon={lonMapa}
            mensagemSemCoordenadas={t("mapaSemCoordenadas")}
          />
        </div>
      </div>
    ),
  };

  const secoes: LigaFormularioSecao[] = [secIdentificacao];
  if (tenantPrincipal) {
    secoes.push(secDadosAdicionais);
  }
  secoes.push(secDocumentos, secEndereco);
  return secoes;
}
