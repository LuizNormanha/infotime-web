import type { Dispatch, SetStateAction } from "react";

import { Button } from "primereact/button";
import { Dropdown } from "primereact/dropdown";
import { InputMask } from "primereact/inputmask";
import { InputSwitch } from "primereact/inputswitch";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
import { RadioButton } from "primereact/radiobutton";

import { ClienteInfotimeEnderecoMapaOsm } from "@/components/cliente/ClienteInfotimeEnderecoMapaOsm";
import type { LigaFormularioSecao } from "@/components/formulario-base/LigaFormularioBase";
import type { CamposFornecedor } from "./LigaFornecedorInfotimeFormulario";

export type CtxSecoesFornecedorInfotime = {
  t: (key: string) => string;
  campos: CamposFornecedor;
  setCampos: Dispatch<SetStateAction<CamposFornecedor>>;
  strValor: (v: unknown) => string;
  ehPf: boolean;
  labelRazao: string;
  labelFantasia: string;
  labelDoc: string;
  idFornecedor: string | null;
  optsSituacao: { label: string; value: string }[];
  opcoesUf: { label: string; value: string }[];
  aoSairDoCampoCep: (valorMascarado: string) => void;
  abrirMapaEnderecoModal: () => void;
};

function strLocal(v: unknown): string {
  if (v === null || v === undefined) return "";
  return String(v);
}

function parseCoordenadaDigitada(raw: string): number | null {
  const s = raw.trim().replace(",", ".");
  if (s === "") return null;
  const n = Number.parseFloat(s);
  return Number.isFinite(n) ? n : null;
}

function coordenadaParaTexto(n: number | null): string {
  return n == null ? "" : String(n);
}

export function criarSecoesFormularioFornecedorInfotime(
  p: CtxSecoesFornecedorInfotime,
): LigaFormularioSecao[] {
  const {
    t,
    campos,
    setCampos,
    strValor,
    ehPf,
    labelRazao,
    labelFantasia,
    labelDoc,
    idFornecedor,
    optsSituacao,
    opcoesUf,
    aoSairDoCampoCep,
    abrirMapaEnderecoModal,
  } = p;

  const rotuloCodigo = (idFornecedor ?? "").trim();
  const digitosDoc = campos.cnpj.replace(/\D/g, "").slice(0, ehPf ? 11 : 14);
  const latMapa = parseCoordenadaDigitada(campos.latitude);
  const lonMapa = parseCoordenadaDigitada(campos.longitude);

  const secIdentificacao: LigaFormularioSecao = {
    id: "identificacao",
    titulo: t("abaIdentificacao"),
    icone: "pi-id-card",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao">
        <div className="liga-cliente-infotime-form-ident">
          <div className="liga-cliente-infotime-form-ident-grid">
            <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-ident-cel-fantasia">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-nf">
                {labelFantasia} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-forn-nf"
                  className="w-full"
                  value={campos.nomeFantasia}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, nomeFantasia: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-ident-cel-situacao">
              <label
                className="liga-cliente-infotime-primeira-linha-label"
                htmlFor="liga-forn-situacao"
              >
                {t("situacao")} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <Dropdown
                  inputId="liga-forn-situacao"
                  className="w-full"
                  value={campos.idSituacaoFornecedor || null}
                  options={optsSituacao}
                  onChange={(e) =>
                    setCampos((prev) => ({
                      ...prev,
                      idSituacaoFornecedor: strLocal(e.value),
                    }))
                  }
                  placeholder={t("selecione")}
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-ident-cel-tipo">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-tp-j">
                {t("tipoPessoa")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <div
                  className="liga-cliente-infotime-radio-linha"
                  role="radiogroup"
                  aria-label={t("tipoPessoa")}
                >
                  <RadioButton
                    inputId="liga-forn-tp-j"
                    checked={campos.tipoPessoa === "J"}
                    onChange={() => setCampos((prev) => ({ ...prev, tipoPessoa: "J" }))}
                  />
                  <label htmlFor="liga-forn-tp-j">{t("pessoaJuridica")}</label>
                  <RadioButton
                    inputId="liga-forn-tp-f"
                    checked={campos.tipoPessoa === "F"}
                    onChange={() => setCampos((prev) => ({ ...prev, tipoPessoa: "F" }))}
                  />
                  <label htmlFor="liga-forn-tp-f">{t("pessoaFisica")}</label>
                </div>
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-ident-cel-id">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-cod">
                {t("codigo")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-forn-cod"
                  className="w-full"
                  value={rotuloCodigo}
                  disabled
                  readOnly
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-ident-cel-razao">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-razao">
                {labelRazao} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-forn-razao"
                  className="w-full"
                  value={campos.razaoSocial}
                  onChange={(e) =>
                    setCampos((prev) => ({ ...prev, razaoSocial: e.target.value }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-fornecedor-infotime-ident-l2-doc">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-doc">
                {labelDoc} *
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputMask
                  key={ehPf ? "liga-forn-mascara-cpf" : "liga-forn-mascara-cnpj"}
                  id="liga-forn-doc"
                  mask={ehPf ? "999.999.999-99" : "99.999.999/9999-99"}
                  unmask
                  autoClear={false}
                  className="w-full"
                  value={digitosDoc}
                  onChange={(e) =>
                    setCampos((prev) => ({
                      ...prev,
                      cnpj: String(e.value ?? "").replace(/\D/g, "").slice(0, ehPf ? 11 : 14),
                    }))
                  }
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-fornecedor-infotime-ident-l2-legado">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-forn-num-ant">
                {t("numeroAntigo")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <InputText
                  id="liga-forn-num-ant"
                  className="w-full"
                  value={idFornecedor ? campos.numeroAntigo : ""}
                  disabled
                  readOnly
                  placeholder={idFornecedor ? undefined : "—"}
                />
              </div>
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha liga-fornecedor-infotime-ident-l2-fab">
              <label
                className="liga-cliente-infotime-primeira-linha-label"
                htmlFor="liga-forn-fabricante-sw"
              >
                {t("fabricante")}
              </label>
              <div className="liga-cliente-infotime-primeira-linha-controles">
                <div className="liga-cliente-infotime-char1-switch">
                  <InputSwitch
                    inputId="liga-forn-fabricante-sw"
                    checked={campos.fabricante}
                    onChange={(e) =>
                      setCampos((prev) => ({ ...prev, fabricante: Boolean(e.value) }))
                    }
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="liga-cliente-infotime-form-linha-quatro-contatos">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-tel">
              {t("telefone")}
            </label>
            <InputMask
              id="liga-forn-tel"
              mask="(99) 9999-9999"
              unmask
              autoClear={false}
              className="w-full"
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
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-cel">
              {t("celular")}
            </label>
            <InputMask
              id="liga-forn-cel"
              mask="(99) 99999-9999"
              unmask
              autoClear={false}
              className="w-full"
              value={campos.celular.replace(/\D/g, "").slice(0, 11)}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  celular: String(e.value ?? "").replace(/\D/g, "").slice(0, 11),
                }))
              }
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-em">
              {t("email")}
            </label>
            <InputText
              id="liga-forn-em"
              type="email"
              className="w-full"
              value={campos.email}
              onChange={(e) => setCampos((prev) => ({ ...prev, email: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-hp">
              {t("homepage")}
            </label>
            <InputText
              id="liga-forn-hp"
              className="w-full"
              value={campos.homepage}
              onChange={(e) => setCampos((prev) => ({ ...prev, homepage: e.target.value }))}
            />
          </div>
        </div>

        <div className="liga-cliente-infotime-form-linha-contatos-observacoes liga-cliente-infotime-form-ident-contatos-linha">
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-contatos">
              {t("contatos")}
            </label>
            <InputTextarea
              id="liga-forn-contatos"
              rows={10}
              className="w-full"
              value={campos.contatos}
              onChange={(e) => setCampos((prev) => ({ ...prev, contatos: e.target.value }))}
            />
          </div>
          <div>
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-obs-ident">
              {t("observacoes")}
            </label>
            <InputTextarea
              id="liga-forn-obs-ident"
              rows={10}
              className="w-full"
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

  const secEndereco: LigaFormularioSecao = {
    id: "endereco",
    titulo: t("abaEndereco"),
    icone: "pi-map-marker",
    conteudo: (
      <div className="liga-cliente-infotime-endereco-bloco">
        <div className="liga-cliente-infotime-endereco-grid-duas-linhas">
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c1">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-cep">
              {t("cep")}
            </label>
            <InputMask
              id="liga-forn-end-cep"
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
              onBlur={(e) =>
                aoSairDoCampoCep(String((e.target as HTMLInputElement).value ?? ""))
              }
              className="w-full"
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c2">
            <label
              className="liga-cliente-infotime-label liga-cliente-infotime-endereco-label-nowrap"
              htmlFor="liga-forn-end-tipo"
            >
              {t("tipoLogradouro")}
            </label>
            <InputText
              id="liga-forn-end-tipo"
              className="w-full"
              value={campos.tipoLogradouro}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, tipoLogradouro: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c3">
            <label
              className="liga-cliente-infotime-label liga-cliente-infotime-endereco-label-nowrap"
              htmlFor="liga-forn-end-log"
            >
              {t("logradouro")}
            </label>
            <InputText
              id="liga-forn-end-log"
              className="w-full"
              value={campos.logradouro}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, logradouro: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c4">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-num">
              {t("numero")}
            </label>
            <InputText
              id="liga-forn-end-num"
              className="w-full"
              value={campos.numero}
              onChange={(e) => setCampos((prev) => ({ ...prev, numero: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c5">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-comp">
              {t("complemento")}
            </label>
            <InputText
              id="liga-forn-end-comp"
              className="w-full"
              value={campos.complemento}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, complemento: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c1">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-bairro">
              {t("bairro")}
            </label>
            <InputText
              id="liga-forn-end-bairro"
              className="w-full"
              value={campos.bairro}
              onChange={(e) => setCampos((prev) => ({ ...prev, bairro: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c2">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-cidade">
              {t("cidade")}
            </label>
            <InputText
              id="liga-forn-end-cidade"
              className="w-full"
              value={campos.cidade}
              onChange={(e) => setCampos((prev) => ({ ...prev, cidade: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c3">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-lat">
              {t("latitude")}
            </label>
            <InputText
              id="liga-forn-end-lat"
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
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c4">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-lon">
              {t("longitude")}
            </label>
            <InputText
              id="liga-forn-end-lon"
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
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c5">
            <label className="liga-cliente-infotime-label" htmlFor="liga-forn-end-uf">
              {t("estado")}
            </label>
            <Dropdown
              inputId="liga-forn-end-uf"
              value={campos.estado.trim() ? campos.estado.trim().toUpperCase().slice(0, 2) : null}
              options={opcoesUf}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  estado: strValor(e.value).toUpperCase().slice(0, 2),
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

        <div className="liga-cliente-infotime-endereco-mapa-wrap">
          <div className="liga-cliente-infotime-endereco-mapa-label-linha">
            <span className="liga-cliente-infotime-label">{t("mapaLocalizacao")}</span>
            <Button
              type="button"
              label={t("mapaExpandirBotao")}
              icon="pi pi-map"
              outlined
              severity="secondary"
              className="liga-cliente-infotime-endereco-mapa-botao-expandir"
              onClick={abrirMapaEnderecoModal}
              aria-label={t("mapaExpandirAria")}
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

  return [secIdentificacao, secEndereco];
}
