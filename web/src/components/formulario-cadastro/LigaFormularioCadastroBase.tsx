"use client";

import {
  Fragment,
  isValidElement,
  useCallback,
  useId,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
  type MutableRefObject,
  type ReactNode,
} from "react";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Message } from "primereact/message";
import { Calendar } from "primereact/calendar";
import { Checkbox } from "primereact/checkbox";
import { Dropdown } from "primereact/dropdown";
import { InputNumber } from "primereact/inputnumber";
import { InputSwitch } from "primereact/inputswitch";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
import { RadioButton } from "primereact/radiobutton";
import "./liga-formulario-cadastro-base.css";
import {
  LIGA_FORM_CLASS_INPUT_AUDITORIA,
  LIGA_FORM_CLASS_INPUT_CHAVE_AUTOMATICA,
} from "./ligaFormularioCampos";

import {
  LigaFormularioBase,
  type LigaFormularioEtapasControle,
  type NavegacaoSecoes,
} from "../formulario-base/LigaFormularioBase";
import type {
  CampoFormularioCadastro,
  LayoutFormularioCadastro,
  OpcaoCampo,
  SecaoFormularioCadastro,
} from "@/types/formulario-cadastro.types";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import { usePermissaoPerfilTelaAtiva } from "@/hooks/usePermissaoPerfilTelaAtiva";
import { LigaMensagemPopUp } from "@/components/ui/dialogo/LigaMensagemPopUp";
import {
  formatarDateCalendarioSomenteDia,
  LIGA_CALENDARIO_PANEL_CLASS,
  parseIsoParaDateComHora,
  parseValorCalendarioSomenteDia,
} from "@/lib/calendario-datas-formulario";
import { atributosSemSugestaoBrowser } from "@/lib/input-sem-sugestao-browser";

function camposTodosDaSecao(secao: SecaoFormularioCadastro): CampoFormularioCadastro[] {
  if (secao.grupos?.length) {
    return secao.grupos.flatMap((g) => g.campos);
  }
  return secao.campos;
}

function campoVisivel(
  campo: CampoFormularioCadastro,
  idEdicao: string | null,
): boolean {
  if (campo.ocultarNaInclusao && !idEdicao) return false;
  if (campo.ocultarNaEdicao && idEdicao) return false;
  return true;
}

/**
 * Primeira chave presente em `erros` na ordem visual do layout (seções + grupos).
 * Garante o §8 de `mcp/padroes/ui` mesmo quando o mapa de erros vem fora de ordem (ex.: API).
 * Ignora campos não montados (`ocultarNaInclusao` / `ocultarNaEdicao`) para não focar âncora inexistente.
 */
function primeiraChaveErroNaOrdemVisual(
  erros: Record<string, string>,
  secoes: SecaoFormularioCadastro[],
  idEdicao: string | null,
): string | undefined {
  if (!erros || Object.keys(erros).length === 0) return undefined;
  for (const secao of secoes) {
    for (const campo of camposTodosDaSecao(secao)) {
      if (!campoVisivel(campo, idEdicao)) continue;
      const msg = erros[campo.chave];
      if (msg != null && String(msg).trim() !== "") return campo.chave;
    }
  }
  return Object.keys(erros)[0];
}

/**
 * Scroll até o ancorador `[data-campo-chave]` e foco no primeiro controle editável dentro dele
 * (inputs nativos, Prime Dropdown/Multiselect/Autocomplete, InputSwitch, etc.).
 */
function focarCampoComChaveNoDocumento(chave: string): void {
  const host = document.querySelector(
    `[data-campo-chave="${CSS.escape(chave)}"]`,
  ) as HTMLElement | null;
  if (!host) return;

  host.scrollIntoView?.({ block: "center", behavior: "smooth" });

  const seletor =
    "input:not([disabled]):not([type='hidden']):not([type='button']):not([type='submit']), " +
    "select:not([disabled]), textarea:not([disabled]), button:not([disabled]), " +
    "[href], [tabindex]:not([tabindex='-1']):not([tabindex=''])";

  const candidatos: HTMLElement[] = [];
  try {
    if (host.matches(seletor)) candidatos.push(host);
  } catch {
    /* seletor inválido para matches em algum host — ignora */
  }
  candidatos.push(...Array.from(host.querySelectorAll<HTMLElement>(seletor)));

  for (const el of candidatos) {
    const r = el.getBoundingClientRect();
    if (r.width === 0 && r.height === 0) continue;
    try {
      el.focus({ preventScroll: true });
      if (document.activeElement === el || host.contains(document.activeElement)) {
        return;
      }
    } catch {
      /* ignorar */
    }
  }

  const dropdown = host.matches(".p-dropdown")
    ? host
    : host.querySelector<HTMLElement>(".p-dropdown:not(.p-disabled)");
  if (dropdown) {
    try {
      dropdown.focus({ preventScroll: true });
      if (document.activeElement === dropdown || host.contains(document.activeElement)) return;
    } catch {
      /* ignorar */
    }
  }

  if (!host.hasAttribute("tabindex")) {
    host.setAttribute("tabindex", "-1");
  }
  try {
    host.focus({ preventScroll: true });
  } catch {
    /* ignorar */
  }
}

/**
 * Após trocar a seção ativa na sidebar, o conteúdo monta no próximo frame; re-tenta até achar
 * `[data-campo-chave]` (MCP `padroes/ui` §8 — alinhado à tab order do layout).
 */
function focarCampoComChaveQuandoMontado(chave: string): void {
  const maxTentativas = 20;
  let n = 0;
  const tentar = () => {
    const host = document.querySelector(
      `[data-campo-chave="${CSS.escape(chave)}"]`,
    ) as HTMLElement | null;
    if (host) {
      focarCampoComChaveNoDocumento(chave);
      return;
    }
    n += 1;
    if (n >= maxTentativas) return;
    window.requestAnimationFrame(tentar);
  };
  window.requestAnimationFrame(tentar);
}

function LigaFormularioCadastroCarregandoSplash({
  titulo,
  subtitulo,
}: {
  titulo: string;
  subtitulo: string;
}) {
  return (
    <div
      className="liga-formulario-cadastro-carregando-splash"
      role="status"
      aria-live="polite"
      aria-busy="true"
    >
      <div className="liga-formulario-cadastro-carregando-visual" aria-hidden>
        <span className="liga-formulario-cadastro-carregando-anel" />
        <span className="liga-formulario-cadastro-carregando-nucleo" />
      </div>
      <p className="liga-formulario-cadastro-carregando-texto-principal">{titulo}</p>
      <p className="liga-formulario-cadastro-carregando-texto-dica">{subtitulo}</p>
      <div className="liga-formulario-cadastro-carregando-pontos" aria-hidden>
        <span />
        <span />
        <span />
      </div>
    </div>
  );
}

// ---------------------------------------------------------------------------
// Helpers internos de renderização
// ---------------------------------------------------------------------------

/** Primeiro input/select/textarea editável visível no painel principal do formulário. */
function focarPrimeiroCampoEditavelNoPainel(root: HTMLElement): void {
  const painel = root.querySelector(".liga-formulario-secao-conteudo");
  if (!painel) return;
  const seletor =
    "input:not([disabled]):not([type='hidden']):not([type='submit']):not([type='button']), select:not([disabled]), textarea:not([disabled])";
  const candidatos = painel.querySelectorAll<HTMLElement>(seletor);
  for (const el of candidatos) {
    if (el.closest(".liga-formulario-sidebar")) continue;
    if ("readOnly" in el && el.readOnly) continue;
    const r = el.getBoundingClientRect();
    if (r.width === 0 && r.height === 0) continue;
    el.focus({ preventScroll: true });
    return;
  }
}

function textoLimpo(v: unknown): string {
  return v == null ? "" : String(v).trim();
}

function valorAtivoParaSwitch(v: unknown): boolean {
  return v === true || v === "S" || v === "s";
}

/** Valor S/N (ou legado true/false) coerente para rádio ativo. */
function valorAtivoSelecionado(v: unknown): "S" | "N" {
  if (v === "N" || v === "n") return "N";
  if (v === "S" || v === "s") return "S";
  if (v === true) return "S";
  if (v === false) return "N";
  return "S";
}

function numeroCampoParaInput(v: unknown): number | null {
  if (v == null || v === "") return null;
  const n = Number(v);
  return Number.isFinite(n) ? n : null;
}

/**
 * Estado visual do `Checkbox` (PrimeReact): desmarcado para `null`, `undefined`, `''`,
 * `'N'`/`'n'`, `false`, `0` e strings não-SN; marcado para `true`, `'S'`, `1`, etc.
 * Não usar `Boolean(valor)` com valor `'N'` (seria `true` em JavaScript).
 */
function valorCheckboxMarcadoNaUi(valor: unknown): boolean {
  if (valor == null || valor === "") return false;
  if (typeof valor === "boolean") return valor;
  if (typeof valor === "number") return valor !== 0;
  if (typeof valor === "string") {
    const t = valor.trim().toUpperCase();
    if (t === "N" || t === "FALSE" || t === "0" || t === "F") return false;
    if (t === "S" || t === "TRUE" || t === "1" || t === "Y") return true;
    return false;
  }
  return false;
}

/** Último campo não-checkbox visível quando a quantidade é ímpar → ocupa as duas colunas. */
function chavesLinhaTodaAutomaticas(
  campos: CampoFormularioCadastro[],
  idEdicao: string | null,
): Set<string> {
  const visiveis = campos.filter(
    (c) => campoVisivel(c, idEdicao) && c.tipo !== "checkbox",
  );
  const n = visiveis.length;
  if (n === 0 || n % 2 === 0) return new Set();
  const ultimo = visiveis[n - 1];
  /** Com `colunas` definido, a largura já está explícita (ex.: um único campo em 1/3 da grade). */
  if (ultimo.colunas != null) return new Set();
  return new Set([ultimo.chave]);
}

function ocupaLinhaTodaCampo(
  campo: CampoFormularioCadastro,
  chavesAuto: Set<string>,
): boolean {
  if (campo.tipo === "checkbox") return false;
  if (campo.colunas === 1) return true;
  if (campo.colunas === 2 || campo.colunas === 3 || campo.colunas === 4) return false;
  return chavesAuto.has(campo.chave);
}

/** Classes da célula na grade 12 colunas (ver `liga-formulario-cadastro-base.css`). */
function classeCampoContainer(campo: CampoFormularioCadastro, linhaToda: boolean): string {
  const parts = ["liga-formulario-campo"];
  if (linhaToda) parts.push("liga-formulario-campo-linha-toda");
  else if (campo.colunas === 3) parts.push("liga-formulario-campo--span-4");
  else if (campo.colunas === 4) parts.push("liga-formulario-campo--span-8");
  return parts.join(" ");
}

/** Fundo cinza (view-only) — ver `liga-formulario-cadastro-base.css` e MCP padroes/ui §4.7. */
function classeInputSomenteLeitura(campo: CampoFormularioCadastro): string {
  if (campo.obrigatorio_sistema) return LIGA_FORM_CLASS_INPUT_CHAVE_AUTOMATICA;
  const { chave } = campo;
  if (
    chave === "endereco_ip_auditoria" ||
    chave === "nome_aplicacao_auditoria" ||
    chave === "id_usuario_auditoria"
  ) {
    return LIGA_FORM_CLASS_INPUT_AUDITORIA;
  }
  return "liga-formulario-input liga-formulario-input--readonly";
}

type InputSenhaCadastroSemSugestaoProps = {
  chave: string;
  /** Rótulo do campo — usado em `aria-label` (não é `type="password"`). */
  labelAcessibilidade: string;
  valor: string;
  aoAlterar: (valor: string) => void;
  desabilitado: boolean;
  maxLength?: number;
  placeholder?: string;
  invalid: boolean;
  /** Ação extra à direita do olho (mesmo `liga-formulario-input-com-acoes__direita`). */
  acaoDireita?: ReactNode;
};

/**
 * Senha em **cadastro** (não-login): **não** usar `type="password"` — o Chrome associa ao cofre
 * de credenciais e mostra a lista de sugestões. Usa-se `type="text"` + mascaramento CSS
 * (`liga-formulario-input-senha-cadastro-mascarada`, MCP `padroes/ui` §10).
 */
/** Exportado para diálogos de “nova senha” fora do layout tipado (mesmo padrão MCP cadastro). */
export function InputSenhaCadastroSemSugestao({
  chave,
  labelAcessibilidade,
  valor,
  aoAlterar,
  desabilitado,
  maxLength,
  placeholder,
  invalid,
  acaoDireita,
}: InputSenhaCadastroSemSugestaoProps) {
  const t = useTranslations("home.formulario");
  const uid = useId().replace(/:/g, "");
  const nomeCampo = `liga_form_senha_${chave}_${uid}`;
  const [mostrarSenha, setMostrarSenha] = useState(false);

  return (
    <>
      <InputText
        type="text"
        value={valor}
        onChange={(e) => aoAlterar(e.target.value)}
        disabled={desabilitado}
        className={
          mostrarSenha
            ? "p-inputtext-sm w-full liga-formulario-input-senha-cadastro-mascarada liga-formulario-input-senha-cadastro-mascarada--visivel"
            : "p-inputtext-sm w-full liga-formulario-input-senha-cadastro-mascarada"
        }
        maxLength={maxLength}
        placeholder={placeholder}
        invalid={invalid}
        data-campo-chave={chave}
        name={nomeCampo}
        id={nomeCampo}
        autoComplete="off"
        inputMode="text"
        spellCheck={false}
        autoCorrect="off"
        autoCapitalize="off"
        aria-label={labelAcessibilidade}
        data-lpignore="true"
        data-1p-ignore="true"
        data-bwignore="true"
        data-form-type="other"
      />
      <div className="liga-formulario-input-com-acoes__direita">
        <Button
          type="button"
          outlined
          text
          severity="secondary"
          icon={mostrarSenha ? "pi pi-eye-slash" : "pi pi-eye"}
          aria-label={mostrarSenha ? t("senhaCadastroOcultar") : t("senhaCadastroMostrar")}
          aria-pressed={mostrarSenha}
          disabled={desabilitado}
          onClick={() => setMostrarSenha((m) => !m)}
        />
        {acaoDireita}
      </div>
    </>
  );
}

function CampoWrapper({
  label,
  obrigatorio,
  erro,
  children,
  className,
}: {
  label: string;
  obrigatorio?: boolean;
  erro?: string;
  children: ReactNode;
  className: string;
}) {
  return (
    <div className={className}>
      <label className="liga-formulario-campo-label">
        {label}
        {obrigatorio && (
          <span className="liga-formulario-campo-obrigatorio" aria-hidden>
            *
          </span>
        )}
      </label>
      {children}
      {erro && (
        <span className="liga-formulario-campo-erro" role="alert">
          {erro}
        </span>
      )}
    </div>
  );
}

export type SubstituirRenderCampoContext = {
  campo: CampoFormularioCadastro;
  valores: Record<string, unknown>;
  aoAlterarCampo: (chave: string, valor: unknown) => void;
  desabilitado: boolean;
  erros: Record<string, string>;
  idEdicao: string | null;
  chavesLinhaToda: Set<string>;
  acoesCampoDireita: Record<string, ReactNode>;
};

function renderCampo(
  campo: CampoFormularioCadastro,
  valores: Record<string, unknown>,
  onChange: (chave: string, valor: unknown) => void,
  desabilitado: boolean,
  erros: Record<string, string>,
  idEdicao: string | null,
  chavesLinhaToda: Set<string>,
  acoesCampoDireita: Record<string, ReactNode>,
  substituirRenderCampo?: (ctx: SubstituirRenderCampoContext) => ReactNode | null | undefined,
): ReactNode {
  const { chave, label, tipo, obrigatorio, maxLength, placeholder, opcoes, linhas, dataComHorario } =
    campo;

  if (campo.ocultarNaInclusao && !idEdicao) return null;
  if (campo.ocultarNaEdicao && idEdicao) return null;

  if (substituirRenderCampo) {
    const sub = substituirRenderCampo({
      campo,
      valores,
      aoAlterarCampo: onChange,
      desabilitado,
      erros,
      idEdicao,
      chavesLinhaToda,
      acoesCampoDireita,
    });
    if (sub != null) return sub;
  }

  const valor = valores[chave];
  const erro = erros[chave];
  const linhaToda = ocupaLinhaTodaCampo(campo, chavesLinhaToda);
  const cnCampo = classeCampoContainer(campo, linhaToda);
  const acaoDireita = acoesCampoDireita[chave];

  if (tipo === "ativo") {
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <div style={{ paddingTop: "0.4rem" }}>
          <InputSwitch
            checked={valorAtivoParaSwitch(valor)}
            onChange={(e) => onChange(chave, Boolean(e.value))}
            disabled={desabilitado}
            data-campo-chave={chave}
          />
        </div>
      </CampoWrapper>
    );
  }

  if (tipo === "ativoRadio") {
    const opcoesRadio: OpcaoCampo[] =
      opcoes && opcoes.length >= 2
        ? opcoes
        : [
            { value: "S", label: "Sim" },
            { value: "N", label: "Não" },
          ];
    const selecionado = valorAtivoSelecionado(valor);
    const nameGrupo = `liga-ativo-radio-${chave}`;
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <div
          className="liga-formulario-ativo-radio-grupo"
          role="radiogroup"
          aria-label={label}
        >
          {opcoesRadio.map((op, i) => {
            const id = `liga-ar-${chave}-${op.value}`;
            return (
              <div key={op.value} className="liga-formulario-ativo-radio-opcao">
                <RadioButton
                  inputId={id}
                  name={nameGrupo}
                  value={op.value}
                  checked={selecionado === op.value}
                  onChange={() => onChange(chave, op.value)}
                  disabled={desabilitado}
                  data-campo-chave={i === 0 ? chave : undefined}
                />
                <label htmlFor={id} className="m-0 cursor-pointer liga-formulario-ativo-radio-label">
                  {op.label}
                </label>
              </div>
            );
          })}
        </div>
      </CampoWrapper>
    );
  }

  if (tipo === "checkbox") {
    return (
      <div key={chave} className={cnCampo} data-campo-chave={chave}>
        <label className="liga-formulario-checkbox-label">
          <Checkbox
            checked={valorCheckboxMarcadoNaUi(valor)}
            onChange={(e) => onChange(chave, e.checked ?? false)}
            disabled={desabilitado}
            inputId={`liga_cb_${chave}`}
          />
          <span>{label}</span>
        </label>
      </div>
    );
  }

  if (tipo === "select") {
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <div className="liga-formulario-input-com-acoes">
          <Dropdown
            value={valor === "" || valor == null ? null : String(valor)}
            options={opcoes ?? []}
            onChange={(e) => onChange(chave, (e.value as string | null) ?? "")}
            disabled={desabilitado}
            className="p-inputtext-sm w-full"
            invalid={Boolean(erro)}
            data-campo-chave={chave}
            placeholder={placeholder}
            showClear
          />
          {acaoDireita ? <div className="liga-formulario-input-com-acoes__direita">{acaoDireita}</div> : null}
        </div>
      </CampoWrapper>
    );
  }

  if (tipo === "textarea") {
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <InputTextarea
          value={String(valor ?? "")}
          onChange={(e) => onChange(chave, e.target.value)}
          disabled={desabilitado}
          className="p-inputtext-sm w-full"
          rows={linhas ?? 3}
          invalid={Boolean(erro)}
          data-campo-chave={chave}
          {...atributosSemSugestaoBrowser()}
        />
      </CampoWrapper>
    );
  }

  if (tipo === "somenteLeitura") {
    const textoSomenteLeitura = String(valor ?? "");
    const cls = `${classeInputSomenteLeitura(campo)} p-inputtext-sm w-full`;
    const variasLinhas = (linhas ?? 1) > 1;
    if (variasLinhas) {
      return (
        <CampoWrapper key={chave} label={label} className={cnCampo}>
          <InputTextarea
            value={textoSomenteLeitura}
            disabled
            rows={linhas ?? 3}
            className={cls}
            data-campo-chave={chave}
          />
        </CampoWrapper>
      );
    }
    return (
      <CampoWrapper key={chave} label={label} className={cnCampo}>
        <InputText
          value={textoSomenteLeitura}
          disabled
          className={cls}
          data-campo-chave={chave}
        />
      </CampoWrapper>
    );
  }

  if (tipo === "data") {
    const comHora = dataComHorario === true;
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <Calendar
          value={comHora ? parseIsoParaDateComHora(valor) : parseValorCalendarioSomenteDia(valor)}
          onChange={(e) => {
            const d = (e.value as Date | null) ?? null;
            if (comHora) {
              onChange(chave, d ? d.toISOString() : null);
            } else {
              onChange(chave, formatarDateCalendarioSomenteDia(d));
            }
          }}
          disabled={desabilitado}
          className="p-inputtext-sm w-full liga-campo-com-botao-interno"
          invalid={Boolean(erro)}
          data-campo-chave={chave}
          dateFormat="dd/mm/yy"
          showIcon
          showButtonBar
          showTime={comHora}
          hourFormat="24"
          stepMinute={1}
          showSeconds={false}
          mask={comHora ? undefined : "99/99/9999"}
          placeholder={comHora ? "dd/mm/aaaa --:--" : placeholder}
          panelClassName={LIGA_CALENDARIO_PANEL_CLASS}
        />
      </CampoWrapper>
    );
  }

  if (tipo === "numero") {
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <div className="liga-formulario-input-com-acoes">
          <InputNumber
            value={numeroCampoParaInput(valor)}
            onValueChange={(e) =>
              onChange(
                chave,
                e.value == null || Number.isNaN(e.value) ? null : String(e.value),
              )
            }
            disabled={desabilitado}
            className="p-inputtext-sm w-full"
            inputClassName="w-full"
            invalid={Boolean(erro)}
            data-campo-chave={chave}
            useGrouping={false}
            maxFractionDigits={0}
            placeholder={placeholder}
          />
          {acaoDireita ? <div className="liga-formulario-input-com-acoes__direita">{acaoDireita}</div> : null}
        </div>
      </CampoWrapper>
    );
  }

  if (tipo === "senha") {
    return (
      <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
        <div
          className={
            acaoDireita
              ? "liga-formulario-input-com-acoes liga-formulario-input-com-acoes--senha-com-acao-extra"
              : "liga-formulario-input-com-acoes"
          }
        >
          <InputSenhaCadastroSemSugestao
            chave={chave}
            labelAcessibilidade={label}
            valor={String(valor ?? "")}
            aoAlterar={(v) => onChange(chave, v)}
            desabilitado={desabilitado}
            maxLength={maxLength}
            placeholder={placeholder}
            invalid={Boolean(erro)}
            acaoDireita={acaoDireita}
          />
        </div>
      </CampoWrapper>
    );
  }

  const ehEmailCadastro = tipo === "email";
  /** Evita heurística de login/autocomplete em telas de cadastro (MCP padroes/ui §10). */
  const nameCadastroNaoLogin = ehEmailCadastro ? `liga_form_${chave}_cadastro` : undefined;

  return (
    <CampoWrapper key={chave} label={label} obrigatorio={obrigatorio} erro={erro} className={cnCampo}>
      <div className="liga-formulario-input-com-acoes">
        <InputText
          value={String(valor ?? "")}
          onChange={(e) => onChange(chave, e.target.value)}
          disabled={desabilitado}
          className="p-inputtext-sm w-full"
          maxLength={maxLength}
          placeholder={placeholder}
          type={ehEmailCadastro ? "email" : "text"}
          invalid={Boolean(erro)}
          data-campo-chave={chave}
          name={nameCadastroNaoLogin}
          {...atributosSemSugestaoBrowser()}
        />
        {acaoDireita ? <div className="liga-formulario-input-com-acoes__direita">{acaoDireita}</div> : null}
      </div>
    </CampoWrapper>
  );
}

function renderBlocoCampos(
  campos: CampoFormularioCadastro[],
  tituloGrupoCheckbox: string | undefined,
  valores: Record<string, unknown>,
  onChange: (chave: string, valor: unknown) => void,
  desabilitado: boolean,
  erros: Record<string, string>,
  idEdicao: string | null,
  acoesCampoDireita: Record<string, ReactNode>,
  chavePrefixo: string,
  substituirRenderCampo?: (ctx: SubstituirRenderCampoContext) => ReactNode | null | undefined,
  idGradeVariante?: string,
) {
  const chavesLinhaToda = chavesLinhaTodaAutomaticas(campos, idEdicao);
  const nos: ReactNode[] = [];
  let i = 0;
  while (i < campos.length) {
    const campo = campos[i];
    if (!campoVisivel(campo, idEdicao)) {
      i += 1;
      continue;
    }

    if (campo.tipo === "checkbox") {
      const grupo: CampoFormularioCadastro[] = [];
      while (i < campos.length) {
        const c = campos[i];
        if (!campoVisivel(c, idEdicao)) {
          i += 1;
          continue;
        }
        if (c.tipo !== "checkbox") break;
        grupo.push(c);
        i += 1;
      }
      if (grupo.length > 0) {
        nos.push(
          <div
            key={`${chavePrefixo}-grupo-checkbox-${grupo[0].chave}`}
            className="liga-formulario-checkbox-grupo"
          >
            {tituloGrupoCheckbox ? (
              <p className="liga-formulario-checkbox-grupo-titulo">
                {tituloGrupoCheckbox}
              </p>
            ) : null}
            <div className="liga-formulario-checkbox-grupo-interior">
              {grupo.map((c) => (
                <Fragment key={c.chave}>
                  {renderCampo(
                    c,
                    valores,
                    onChange,
                    desabilitado,
                    erros,
                    idEdicao,
                    chavesLinhaToda,
                    acoesCampoDireita,
                    substituirRenderCampo,
                  )}
                </Fragment>
              ))}
            </div>
          </div>,
        );
      }
    } else {
      nos.push(
        <Fragment key={campo.chave}>
          {renderCampo(
            campo,
            valores,
            onChange,
            desabilitado,
            erros,
            idEdicao,
            chavesLinhaToda,
            acoesCampoDireita,
            substituirRenderCampo,
          )}
        </Fragment>,
      );
      i += 1;
    }
  }

  const gridClass =
    idGradeVariante === "mapaDefIdent"
      ? `liga-formulario-grid liga-formulario-grid--mapa-def-ident-${
          idEdicao ? "edicao" : "novo"
        }`
      : "liga-formulario-grid";
  return <div className={gridClass}>{nos}</div>;
}

function renderSecao(
  secao: SecaoFormularioCadastro,
  valores: Record<string, unknown>,
  onChange: (chave: string, valor: unknown) => void,
  desabilitado: boolean,
  erros: Record<string, string>,
  idEdicao: string | null,
  acoesCampoDireita: Record<string, ReactNode>,
  substituirRenderCampo?: (ctx: SubstituirRenderCampoContext) => ReactNode | null | undefined,
) {
  if (secao.grupos?.length) {
    return (
      <div className="liga-formulario-secao-grupos">
        {secao.grupos.map((grupo) => (
          <div key={grupo.id} className="liga-formulario-grupo">
            {grupo.titulo ? (
              <h4 className="liga-formulario-grupo-titulo">{grupo.titulo}</h4>
            ) : null}
            {grupo.descricao ? (
              <p className="liga-formulario-grupo-descricao">{grupo.descricao}</p>
            ) : null}
            {renderBlocoCampos(
              grupo.campos,
              grupo.tituloGrupoCheckbox ?? secao.tituloGrupoCheckbox,
              valores,
              onChange,
              desabilitado,
              erros,
              idEdicao,
              acoesCampoDireita,
              `${secao.id}-${grupo.id}`,
              substituirRenderCampo,
              secao.idGradeVariante,
            )}
          </div>
        ))}
      </div>
    );
  }

  return renderBlocoCampos(
    secao.campos,
    secao.tituloGrupoCheckbox,
    valores,
    onChange,
    desabilitado,
    erros,
    idEdicao,
    acoesCampoDireita,
    secao.id,
    substituirRenderCampo,
    secao.idGradeVariante,
  );
}

// ---------------------------------------------------------------------------
// Props do componente base
// ---------------------------------------------------------------------------

export type LigaFormularioCadastroBaseProps = {
  layout: LayoutFormularioCadastro;
  layoutPadrao: LayoutFormularioCadastro;
  valores: Record<string, unknown>;
  aoAlterarCampo: (chave: string, valor: unknown) => void;
  idEdicao: string | null;
  erros?: Record<string, string>;
  secoesCustom?: Record<string, ReactNode>;
  /**
   * Conteúdo extra no **mesmo** cartão da seção, abaixo da grade padrão (`renderSecao`).
   * Não se aplica se `secoesCustom[id]` substituir o conteúdo inteiro.
   */
  secoesConteudoApos?: Record<string, ReactNode>;
  /** Ações renderizadas dentro do campo, alinhadas à direita, por chave do campo. */
  acoesCampoDireita?: Record<string, ReactNode>;
  /**
   * Substitui a renderização padrão de um campo (ex.: lookup de FK).
   * Retorne `null`/`undefined` para manter o renderizador padrão.
   */
  substituirRenderCampo?: (ctx: SubstituirRenderCampoContext) => ReactNode | null | undefined;
  /** Ações à direita do título da seção (cartão), por id da seção do layout. */
  cabecalhoAcoesPorSecao?: Record<string, ReactNode>;
  erroGlobal?: string | null;
  salvando?: boolean;
  excluindo?: boolean;
  carregando?: boolean;
  aoSalvar: () => void;
  aoExcluir?: () => void;
  aoFechar: () => void;
  /** Labels dos botões — opcionais, têm valores padrão em pt-BR */
  labelCancelar?: string;
  labelSalvar?: string;
  labelSalvando?: string;
  labelExcluir?: string;
  labelExcluindo?: string;
  /** Contexto dinâmico para o título em modo edição (ex.: "Nº 123 - Paciente X"). */
  tituloEdicaoComplemento?: string | null;
  /**
   * Conteúdo no título principal, após o texto (ex.: badge de status do orçamento).
   * Repassado a `LigaFormularioBase`.
   */
  sufixoTitulo?: ReactNode;
  /** Conteúdo abaixo do título do formulário (ex.: abas de versão), antes do layout principal. */
  abaixoDoTopo?: ReactNode;
  /** Barra vertical verde à esquerda do título (padrão listagem). Repassado a `LigaFormularioBase`. */
  tituloComBarraVerde?: boolean;
  /**
   * Slug do formulário no catálogo `infolab_formulario` — passado ao hook de
   * permissões para que cada formulário consulte suas próprias permissões.
   */
  codigoTela?: string;
  salvarDesabilitadoPorRegra?: boolean;
  mensagemRegraSalvar?: string | null;
  /**
   * `sidebar` (padrão) ou `etapasHorizontais` (wizard com gating). O valor `abasTopo`
   * compartilha o tipo com `LigaFormularioBase` para painéis de detalhe em mestre–detalhe;
   * não é o padrão de cadastro CRUD — ver MCP `padroes/ui` §5.4.
   */
  navegacaoSecoes?: NavegacaoSecoes;
  /**
   * Validador síncrono para avançar de etapa. Retorne `null` para liberar,
   * uma string para exibir feedback no topo sem avançar. Só tem efeito
   * quando `navegacaoSecoes === "etapasHorizontais"`.
   */
  validarEtapaAntesDeAvancar?: (secaoId: string) => string | null;
  /**
   * Em `etapasHorizontais`, repassado a `LigaFormularioBase` — ver MCP `padroes/ui` §12.5
   * (avanço automático na fronteira do wizard).
   */
  secaoIdsAvancoAutomaticoEtapas?: readonly string[];
  /**
   * Somente consulta: oculta Salvar e Excluir; mantém o botão de fechar/voltar (`labelCancelar`).
   * Telas de visualização (ex.: mapa de produção instanciado pelo atendimento).
   */
  ocultarPersistencia?: boolean;
  /**
   * Se existir e for id de seção do `layout` atual, a navegação inicia/renasce aí
   * (útil após GET sem perder a última seção; repasse de `LigaFormularioBase/secaoInicialId`).
   */
  secaoInicialId?: string | null;
  /** Sempre que a seção ativa mudar (sidebar, wizard ou abas), para o pai guardar. */
  onSecaoAtivaChange?: (secaoId: string) => void;
  /** Só em `etapasHorizontais`: repasse a `LigaFormularioBase`. */
  onAposAvancarEtapas?: (secaoAnteriorId: string, secaoNovaId: string) => void;
  /** Só em `etapasHorizontais`: API imperativa do wizard (`LigaFormularioBase`). */
  controleEtapasExternoRef?: MutableRefObject<LigaFormularioEtapasControle | null>;
  /**
   * Ações exibidas à esquerda do botão Cancelar (mesma faixa de `barraAcoes`).
   */
  acoesAntesCancelar?: ReactNode;
};

export function LigaFormularioCadastroBase({
  layout,
  layoutPadrao,
  valores,
  aoAlterarCampo,
  idEdicao,
  erros = {},
  secoesCustom = {},
  secoesConteudoApos = {},
  acoesCampoDireita = {},
  substituirRenderCampo,
  cabecalhoAcoesPorSecao = {},
  erroGlobal,
  salvando = false,
  excluindo = false,
  carregando = false,
  aoSalvar,
  aoExcluir,
  aoFechar,
  labelCancelar = "Cancelar",
  labelSalvar = "Salvar",
  labelSalvando = "Salvando…",
  labelExcluir = "Excluir",
  labelExcluindo = "Excluindo…",
  tituloEdicaoComplemento,
  sufixoTitulo,
  abaixoDoTopo,
  tituloComBarraVerde = false,
  codigoTela,
  salvarDesabilitadoPorRegra = false,
  mensagemRegraSalvar = null,
  navegacaoSecoes = "sidebar",
  validarEtapaAntesDeAvancar,
  secaoIdsAvancoAutomaticoEtapas,
  ocultarPersistencia = false,
  secaoInicialId = null,
  onSecaoAtivaChange,
  onAposAvancarEtapas,
  controleEtapasExternoRef,
  acoesAntesCancelar,
}: LigaFormularioCadastroBaseProps) {
  const t = useTranslations("home");
  const tFormulario = useTranslations("home.formulario");
  const feedback = useLigaFeedback();
  const { tela, permissoes, permissoesCarregadas } = usePermissaoPerfilTelaAtiva(codigoTela);
  const [dialogoConfirmarExclusaoAberto, setDialogoConfirmarExclusaoAberto] = useState(false);
  const [indiceEtapaAtiva, setIndiceEtapaAtiva] = useState(0);
  const [totalEtapas, setTotalEtapas] = useState(0);

  const sessao = useSessaoAtual();
  const raizFormularioRef = useRef<HTMLElement | null>(null);
  const focoInicialEstadoRef = useRef<{
    idEdicao: string | null;
    aplicado: boolean;
  }>({ idEdicao: null, aplicado: false });

  // Usa personalização se vier com seções, senão usa padrão
  const layoutBase = layout.secoes.length > 0 ? layout : layoutPadrao;
  /** Aba "Auditoria" (id fixo) só para login técnico global suporte / implantação (JWT). */
  const layoutEfetivo = sessao.podeVerSecaoAuditoriaFormulario
    ? layoutBase
    : {
        ...layoutBase,
        secoes: layoutBase.secoes.filter((s) => s.id !== "auditoria"),
      };

  const desabilitado = carregando || salvando || excluindo || ocultarPersistencia;
  const podeSalvar = idEdicao ? permissoes.editar : permissoes.incluir;
  /** Só permite excluir após o GET de permissões e com flag explícita na regra do perfil. */
  const podeExcluir = permissoesCarregadas && permissoes.excluir;

  // Auditoria é injetada automaticamente pelo useCadastroFormulario (sem stale closure).
  // Este componente apenas dispara o salvamento.

  /** Em etapas horizontais, a seção `auditoria` não entra no wizard (MCP `padroes/ui` §12.5). */
  const secoesLayoutNavegacao = useMemo(() => {
    if (navegacaoSecoes !== "etapasHorizontais") return layoutEfetivo.secoes;
    return layoutEfetivo.secoes.filter((s) => s.id !== "auditoria");
  }, [navegacaoSecoes, layoutEfetivo.secoes]);

  const secoes = secoesLayoutNavegacao.map((secao) => ({
    id: secao.id,
    titulo: secao.titulo,
    descricao: secao.descricao,
    icone: secao.icone,
    conteudo:
      secoesCustom[secao.id] ?? (
        <Fragment>
          {renderSecao(
            secao,
            valores,
            aoAlterarCampo,
            desabilitado,
            erros,
            idEdicao,
            acoesCampoDireita,
            substituirRenderCampo,
          )}
          {secoesConteudoApos[secao.id] ?? null}
        </Fragment>
      ),
    acoesCabecalho: cabecalhoAcoesPorSecao[secao.id],
  }));

  const temObrigatorio =
    !ocultarPersistencia &&
    layoutEfetivo.secoes.flatMap((s) => camposTodosDaSecao(s)).some((c) => c.obrigatorio);

  const primeiraChaveComErro = useMemo(
    () => primeiraChaveErroNaOrdemVisual(erros, layoutEfetivo.secoes, idEdicao),
    [erros, layoutEfetivo.secoes, idEdicao],
  );
  const secaoComPrimeiroErro = useMemo(() => {
    if (!primeiraChaveComErro) return null;
    for (const secao of layoutEfetivo.secoes) {
      if (camposTodosDaSecao(secao).some((c) => c.chave === primeiraChaveComErro)) {
        return secao.id;
      }
    }
    return null;
  }, [primeiraChaveComErro, layoutEfetivo.secoes]);

  useLayoutEffect(() => {
    if (!primeiraChaveComErro) return;
    focarCampoComChaveQuandoMontado(primeiraChaveComErro);
  }, [erros, primeiraChaveComErro, secaoComPrimeiroErro]);

  useLayoutEffect(() => {
    const st = focoInicialEstadoRef.current;
    if (carregando) {
      st.aplicado = false;
      return;
    }
    if (primeiraChaveComErro) return;
    if (st.idEdicao !== idEdicao) {
      st.idEdicao = idEdicao;
      st.aplicado = false;
    }
    if (st.aplicado) return;
    const id = window.requestAnimationFrame(() => {
      const root = raizFormularioRef.current;
      if (!root) return;
      focarPrimeiroCampoEditavelNoPainel(root);
      st.aplicado = true;
    });
    return () => window.cancelAnimationFrame(id);
  }, [carregando, idEdicao, primeiraChaveComErro]);

  useLayoutEffect(() => {
    window.dispatchEvent(
      new CustomEvent("liga:debug-painel-ativo", {
        detail: { tipo: "formulario" },
      }),
    );
  }, [idEdicao]);

  const ehModoEtapas = navegacaoSecoes === "etapasHorizontais";
  /** Em modo etapas (inclusão), o salvar só fica livre na última etapa concluída. */
  const travarSalvarPorEtapa =
    ehModoEtapas && totalEtapas > 0 && indiceEtapaAtiva < totalEtapas - 1;
  const salvarTravado = salvarDesabilitadoPorRegra || travarSalvarPorEtapa;
  const mensagemTravaSalvar = travarSalvarPorEtapa
    ? tFormulario("etapas.concluaEtapasAnteriores")
    : (mensagemRegraSalvar ?? null);

  const tentarSalvarFormulario = useCallback(() => {
    if (salvarTravado) {
      if (mensagemTravaSalvar) feedback.aviso(mensagemTravaSalvar);
      return;
    }
    if (!podeSalvar) {
      feedback.aviso(
        `Perfil sem permissao para ${
          idEdicao ? "editar" : "incluir"
        } nesta tela (${tela ?? "nao identificada"}). Permissoes: incluir=${permissoes.incluir ? "S" : "N"}, editar=${permissoes.editar ? "S" : "N"}, excluir=${permissoes.excluir ? "S" : "N"}.`,
      );
      return;
    }
    aoSalvar();
  }, [
    salvarTravado,
    mensagemTravaSalvar,
    feedback,
    podeSalvar,
    idEdicao,
    tela,
    permissoes.incluir,
    permissoes.editar,
    permissoes.excluir,
    aoSalvar,
  ]);

  const barraAcoes = ocultarPersistencia ? (
    <>
      {acoesAntesCancelar}
      <Button
        type="button"
        label={labelCancelar}
        icon="pi pi-arrow-left"
        className="liga-formulario-acoes-secundaria"
        outlined
        onClick={aoFechar}
        disabled={salvando || excluindo}
      />
    </>
  ) : (
    <>
      {acoesAntesCancelar}
      <Button
        type="button"
        label={labelCancelar}
        icon="pi pi-times"
        className="liga-formulario-acoes-secundaria"
        outlined
        onClick={aoFechar}
        disabled={salvando || excluindo}
      />
      <Button
        type="button"
        label={salvando ? labelSalvando : labelSalvar}
        icon="pi pi-check"
        className="liga-formulario-cadastro-botao-salvar"
        onClick={tentarSalvarFormulario}
        disabled={
          desabilitado || !permissoesCarregadas || salvarTravado
        }
        loading={salvando}
      />
      {idEdicao && aoExcluir && (
        <Button
          type="button"
          label={excluindo ? labelExcluindo : labelExcluir}
          icon="pi pi-trash"
          severity="danger"
          outlined
          className={
            podeExcluir
              ? "liga-formulario-acoes-excluir"
              : "liga-formulario-acoes-excluir liga-formulario-acoes-excluir--sem-permissao"
          }
          onClick={() => {
            if (!permissoes.excluir) {
              feedback.aviso(
                `Perfil sem permissao para excluir nesta tela (${tela ?? "nao identificada"}). Permissoes: incluir=${permissoes.incluir ? "S" : "N"}, editar=${permissoes.editar ? "S" : "N"}, excluir=${permissoes.excluir ? "S" : "N"}.`,
              );
              return;
            }
            setDialogoConfirmarExclusaoAberto(true);
          }}
          disabled={desabilitado || !permissoesCarregadas}
          loading={excluindo}
        />
      )}
    </>
  );

  const aguardandoDefinicoes =
    !sessao.sessaoCarregada || (!!tela && !permissoesCarregadas);
  const tituloBase = idEdicao
    ? (layoutEfetivo.tituloEditar ?? "Editar")
    : (layoutEfetivo.tituloNovo ?? "Novo");
  const tituloComContexto =
    idEdicao && textoLimpo(tituloEdicaoComplemento)
      ? `${tituloBase} - ${textoLimpo(tituloEdicaoComplemento)}`
      : tituloBase;

  if (carregando || aguardandoDefinicoes) {
    return (
      <section
        className="liga-formulario-cadastro-base"
        style={{ padding: "0.5rem 0 1rem" }}
      >
        <div className="liga-formulario-cadastro-splash-centro">
          <LigaFormularioCadastroCarregandoSplash
            titulo={t("listagem.comum.carregando")}
            subtitulo={t("listagem.comum.carregandoDica")}
          />
        </div>
      </section>
    );
  }

  return (
    <section
      ref={raizFormularioRef}
      className="liga-formulario-cadastro-base"
      style={{ padding: "0.5rem 0 1rem" }}
    >
      <LigaMensagemPopUp
        aberto={dialogoConfirmarExclusaoAberto}
        titulo={t("formulario.tituloConfirmarExclusaoCadastro")}
        mensagem={t("formulario.confirmarExclusaoCadastro")}
        rotuloCancelar={t("abas.cancelar")}
        rotuloConfirmar={t("formulario.botaoConfirmarExclusaoCadastro")}
        aoFechar={() => setDialogoConfirmarExclusaoAberto(false)}
        aoConfirmar={() => {
          setDialogoConfirmarExclusaoAberto(false);
          aoExcluir?.();
        }}
      />
      {salvarDesabilitadoPorRegra && mensagemRegraSalvar ? (
        <Message
          severity="warn"
          text={mensagemRegraSalvar}
          className="w-full liga-formulario-alerta-contexto"
        />
      ) : null}
      <LigaFormularioBase
        titulo={tituloComContexto}
        sufixoTitulo={sufixoTitulo}
        subtitulo={
          idEdicao ? layoutEfetivo.subtituloEditar : layoutEfetivo.subtituloNovo
        }
        iconeTitulo={layoutEfetivo.iconeTitulo}
        barraAcoes={barraAcoes}
        abaixoDoTopo={abaixoDoTopo}
        tituloComBarraVerde={tituloComBarraVerde}
        secoes={secoes}
        temLegendaCamposObrigatorios={temObrigatorio}
        mensagemErroGlobal={erroGlobal}
        secaoParaAtivar={secaoComPrimeiroErro}
        secaoInicialId={secaoInicialId}
        onSecaoAtivaChange={onSecaoAtivaChange}
        onAposAvancarEtapas={onAposAvancarEtapas}
        controleEtapasExternoRef={controleEtapasExternoRef}
        navegacaoSecoes={navegacaoSecoes}
        validarEtapaAntesDeAvancar={validarEtapaAntesDeAvancar}
        aoMudarIndiceEtapa={(indice, total) => {
          setIndiceEtapaAtiva(indice);
          setTotalEtapas(total);
        }}
        onConcluirEtapas={ehModoEtapas ? tentarSalvarFormulario : undefined}
        concluirEtapasDesabilitado={desabilitado || !permissoesCarregadas}
        concluirEtapasCarregando={salvando}
        secaoIdsAvancoAutomaticoEtapas={secaoIdsAvancoAutomaticoEtapas}
      />
    </section>
  );
}
