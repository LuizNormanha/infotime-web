"use client";

import { Accordion, AccordionTab } from "primereact/accordion";
import { Calendar } from "primereact/calendar";
import { Checkbox } from "primereact/checkbox";
import { InputMask } from "primereact/inputmask";
import { InputText } from "primereact/inputtext";
import { MultiSelect } from "primereact/multiselect";
import { useTranslations } from "next-intl";

import type {
  LigaColunaListagem,
  LigaFiltroRefinadoDef,
  LigaFiltroRefinadoValor,
} from "./liga-listagem.types";
import {
  mascaraPrimePorTipo,
  resolverMascaraBuscaServidor,
  validarTermoBuscaMascara,
} from "./liga-listagem-mascara-busca";
import { atributosSemSugestaoBrowser } from "@/lib/input-sem-sugestao-browser";
import { LIGA_CALENDARIO_PANEL_CLASS } from "@/lib/calendario-datas-formulario";

type TradutorHome = ReturnType<typeof useTranslations<"home">>;

type Props = {
  colunas: LigaColunaListagem[];
  filtros: Record<string, LigaFiltroRefinadoValor | undefined>;
  onChange: (campo: string, valor: LigaFiltroRefinadoValor | undefined) => void;
  /** Modo servidor: consulta na hora após Enter (ignora debounce), escolha em enum ou máscara válida. */
  pesquisarRefinadoServidorImediato?: (
    filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
  ) => void;
  feedbackAvisoRefinado?: (chaveI18n: string) => void;
};

function EditorCampo({
  col,
  fr,
  fv,
  filtrosCompletos,
  onChange,
  pesquisarRefinadoServidorImediato,
  feedbackAvisoRefinado,
  t,
}: {
  col: LigaColunaListagem;
  fr: LigaFiltroRefinadoDef;
  fv: LigaFiltroRefinadoValor | undefined;
  filtrosCompletos: Record<string, LigaFiltroRefinadoValor | undefined>;
  onChange: (campo: string, valor: LigaFiltroRefinadoValor | undefined) => void;
  pesquisarRefinadoServidorImediato?: (
    filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
  ) => void;
  feedbackAvisoRefinado?: (chaveI18n: string) => void;
  t: TradutorHome;
}) {
  const limpar = () => onChange(col.campo, undefined);

  switch (fr.tipo) {
    case "texto": {
      const tipoMascara = resolverMascaraBuscaServidor(col);
      const primeMask = tipoMascara ? mascaraPrimePorTipo(tipoMascara) : "";
      const valorTexto = fv?.tipo === "texto" ? fv.contem : "";
      if (primeMask) {
        return (
          <InputMask
            key={`liga-refinado-mask-${col.campo}-${primeMask}`}
            mask={primeMask}
            {...atributosSemSugestaoBrowser()}
            className="w-full"
            value={valorTexto}
            onChange={(e) => {
              const v = e.target?.value ?? "";
              if (!v.trim()) {
                limpar();
                return;
              }
              onChange(col.campo, { tipo: "texto", contem: v });
            }}
            onKeyDown={(e) => {
              if (e.key !== "Enter" && e.key !== "NumpadEnter") return;
              if (!pesquisarRefinadoServidorImediato) return;
              e.preventDefault();
              const bruto = (e.target as HTMLInputElement)?.value ?? "";
              const val = validarTermoBuscaMascara(col, bruto);
              if (!val.ok) {
                feedbackAvisoRefinado?.(val.chaveI18n);
                return;
              }
              if (!bruto.trim()) return;
              pesquisarRefinadoServidorImediato({
                ...filtrosCompletos,
                [col.campo]: { tipo: "texto", contem: bruto },
              });
            }}
            placeholder="Contém…"
          />
        );
      }
      return (
        <InputText
          {...atributosSemSugestaoBrowser()}
          className="w-full"
          value={valorTexto}
          onChange={(e) => {
            const v = e.target.value;
            if (!v.trim()) {
              limpar();
              return;
            }
            onChange(col.campo, { tipo: "texto", contem: v });
          }}
          onKeyDown={(e) => {
            if (e.key !== "Enter" && e.key !== "NumpadEnter") return;
            if (!pesquisarRefinadoServidorImediato) return;
            e.preventDefault();
            const bruto = (e.target as HTMLInputElement).value ?? "";
            if (!bruto.trim()) return;
            pesquisarRefinadoServidorImediato({
              ...filtrosCompletos,
              [col.campo]: { tipo: "texto", contem: bruto },
            });
          }}
          placeholder="Contém…"
        />
      );
    }
    case "inteiro":
      return (
        <InputText
          {...atributosSemSugestaoBrowser()}
          className="w-full"
          inputMode="numeric"
          value={fv?.tipo === "inteiro" ? fv.igual : ""}
          onChange={(e) => {
            const v = e.target.value.replace(/\D/g, "");
            if (!v) {
              limpar();
              return;
            }
            onChange(col.campo, { tipo: "inteiro", igual: v });
          }}
          onKeyDown={(e) => {
            if (e.key !== "Enter" && e.key !== "NumpadEnter") return;
            if (!pesquisarRefinadoServidorImediato) return;
            e.preventDefault();
            const v = (e.target as HTMLInputElement).value.replace(/\D/g, "");
            if (!v) return;
            const novoValor: LigaFiltroRefinadoValor = {
              tipo: "inteiro",
              igual: v,
            };
            pesquisarRefinadoServidorImediato({
              ...filtrosCompletos,
              [col.campo]: novoValor,
            });
          }}
          placeholder="Valor exato"
        />
      );
    case "decimal":
      return (
        <InputText
          {...atributosSemSugestaoBrowser()}
          className="w-full"
          value={fv?.tipo === "decimal" ? fv.igual : ""}
          onChange={(e) => {
            const v = e.target.value;
            if (!v.trim()) {
              limpar();
              return;
            }
            onChange(col.campo, { tipo: "decimal", igual: v });
          }}
          onKeyDown={(e) => {
            if (e.key !== "Enter" && e.key !== "NumpadEnter") return;
            if (!pesquisarRefinadoServidorImediato) return;
            e.preventDefault();
            const v = (e.target as HTMLInputElement).value.trim();
            if (!v) return;
            const novoValor: LigaFiltroRefinadoValor = {
              tipo: "decimal",
              igual: v,
            };
            pesquisarRefinadoServidorImediato({
              ...filtrosCompletos,
              [col.campo]: novoValor,
            });
          }}
          placeholder="Valor"
        />
      );
    case "data":
    case "dataIntervaloInclusao": {
      const tipoFiltroData =
        fr.tipo === "dataIntervaloInclusao"
          ? ("dataIntervaloInclusao" as const)
          : ("data" as const);
      const valorTipoOk = fv?.tipo === fr.tipo ? fv : undefined;
      const de = valorTipoOk?.de ?? null;
      const ate = valorTipoOk?.ate ?? null;

      /** Modo dois campos: explícito ou legado (ambas as datas sem flag). */
      const entreDatasUi =
        valorTipoOk?.entreDatas === true ||
        (valorTipoOk != null &&
          valorTipoOk.de != null &&
          valorTipoOk.ate != null &&
          valorTipoOk.entreDatas !== false);

      const emitirDiaUnico = (nextDe: Date | null) => {
        if (!nextDe) {
          limpar();
          return;
        }
        onChange(col.campo, {
          tipo: tipoFiltroData,
          entreDatas: false,
          de: nextDe,
          ate: null,
        });
      };

      const emitirIntervalo = (nextDe: Date | null, nextAte: Date | null) => {
        if (!nextDe && !nextAte) {
          limpar();
          return;
        }
        onChange(col.campo, {
          tipo: tipoFiltroData,
          entreDatas: true,
          de: nextDe,
          ate: nextAte,
        });
      };

      const propsCalendarioData = {
        dateFormat: "dd/mm/yy" as const,
        showIcon: true,
        showButtonBar: true,
        mask: "99/99/9999",
        panelClassName: LIGA_CALENDARIO_PANEL_CLASS,
        className: "p-inputtext-sm w-full liga-campo-com-botao-interno",
        placeholder: t("listagem.comum.filtroRefinadoDataPlaceholder"),
      };

      const idEntre = `liga-refinado-entre-${col.campo}`;

      return (
        <div className="liga-listagem-refinado-datas-editor">
          <div className="liga-listagem-refinado-entre-datas-toggle">
            <Checkbox
              inputId={idEntre}
              checked={entreDatasUi}
              onChange={(e) => {
                const checked = Boolean(e.checked ?? false);
                if (!checked) {
                  onChange(col.campo, {
                    tipo: tipoFiltroData,
                    entreDatas: false,
                    de,
                    ate: null,
                  });
                } else {
                  onChange(col.campo, {
                    tipo: tipoFiltroData,
                    entreDatas: true,
                    de,
                    ate,
                  });
                }
              }}
            />
            <label className="liga-listagem-refinado-entre-datas-label" htmlFor={idEntre}>
              {t("listagem.comum.filtroRefinadoEntreDatas")}
            </label>
          </div>

          {!entreDatasUi ? (
            <div className="liga-listagem-refinado-datas liga-listagem-refinado-datas--unica">
              <div className="liga-listagem-refinado-data-campo">
                <label
                  className="liga-listagem-refinado-data-label"
                  htmlFor={`liga-refinado-unica-${col.campo}`}
                >
                  {t("listagem.comum.filtroRefinadoDataUnica")}
                </label>
                <Calendar
                  {...propsCalendarioData}
                  inputId={`liga-refinado-unica-${col.campo}`}
                  value={de}
                  onChange={(e) =>
                    emitirDiaUnico((e.value as Date | null) ?? null)
                  }
                />
              </div>
            </div>
          ) : (
            <div className="liga-listagem-refinado-datas liga-listagem-refinado-datas--intervalo">
              <div className="liga-listagem-refinado-data-campo">
                <label
                  className="liga-listagem-refinado-data-label"
                  htmlFor={`liga-refinado-de-${col.campo}`}
                >
                  {t("listagem.comum.filtroRefinadoDataInicio")}
                </label>
                <Calendar
                  {...propsCalendarioData}
                  inputId={`liga-refinado-de-${col.campo}`}
                  value={de}
                  onChange={(e) =>
                    emitirIntervalo(
                      (e.value as Date | null) ?? null,
                      ate,
                    )
                  }
                />
              </div>
              <div className="liga-listagem-refinado-data-campo">
                <label
                  className="liga-listagem-refinado-data-label"
                  htmlFor={`liga-refinado-ate-${col.campo}`}
                >
                  {t("listagem.comum.filtroRefinadoDataFim")}
                </label>
                <Calendar
                  {...propsCalendarioData}
                  inputId={`liga-refinado-ate-${col.campo}`}
                  value={ate}
                  onChange={(e) =>
                    emitirIntervalo(de, (e.value as Date | null) ?? null)
                  }
                />
              </div>
            </div>
          )}
        </div>
      );
    }
    case "enum":
      if (!fr.opcoes?.length) return null;
      return (
        <MultiSelect
          display="chip"
          value={fv?.tipo === "enum" ? fv.valores : []}
          options={fr.opcoes.map((o) => ({
            label: o.rotulo,
            value: o.valor,
          }))}
          onChange={(e) => {
            const vals = (e.value as string[]) ?? [];
            if (vals.length === 0) {
              limpar();
              return;
            }
            const novoValor: LigaFiltroRefinadoValor = {
              tipo: "enum",
              valores: vals,
            };
            onChange(col.campo, novoValor);
            pesquisarRefinadoServidorImediato?.({
              ...filtrosCompletos,
              [col.campo]: novoValor,
            });
          }}
          placeholder="Escolha…"
          className="w-full"
          filter={false}
        />
      );
    default:
      return null;
  }
}

export function LigaListagemFiltroRefinadoSidebarForm({
  colunas,
  filtros,
  onChange,
  pesquisarRefinadoServidorImediato,
  feedbackAvisoRefinado,
}: Props) {
  const t = useTranslations("home");
  const comFiltro = colunas.filter((c) => c.filtroRefinado != null);

  return (
    <Accordion multiple className="liga-listagem-refinado-accordion">
      {comFiltro.map((col) => {
        const fr = col.filtroRefinado!;
        const fv = filtros[col.campo];
        return (
          <AccordionTab key={col.campo} header={col.cabecalho}>
            <div className="liga-listagem-refinado-tab-conteudo">
              <EditorCampo
                col={col}
                fr={fr}
                fv={fv}
                filtrosCompletos={filtros}
                onChange={onChange}
                pesquisarRefinadoServidorImediato={
                  pesquisarRefinadoServidorImediato
                }
                feedbackAvisoRefinado={feedbackAvisoRefinado}
                t={t}
              />
              <button
                type="button"
                className="liga-listagem-refinado-limpar-campo"
                onClick={() => onChange(col.campo, undefined)}
              >
                {t("listagem.comum.filtroRefinadoLimparCampo")}
              </button>
            </div>
          </AccordionTab>
        );
      })}
    </Accordion>
  );
}
