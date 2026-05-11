"use client";

import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
  type CSSProperties,
} from "react";
import { flushSync } from "react-dom";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { InputSwitch } from "primereact/inputswitch";
import { Dialog } from "primereact/dialog";
import { Dropdown } from "primereact/dropdown";
import { InputMask } from "primereact/inputmask";
import { InputNumber } from "primereact/inputnumber";
import { InputText } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
import { Password } from "primereact/password";
import { Message } from "primereact/message";

import "@/components/cliente/liga-cliente-infotime.css";
import "@/components/ui/dialogo/liga-mensagem-pop-up.css";
import "@/components/formulario-base/liga-formulario-base.css";
import { LigaPadraoBadgeGrupoIgualLargura } from "@/components/ui/badge/LigaPadraoBadgeGrupoIgualLargura";
import { ClienteInfotimeEnderecoMapaOsm } from "@/components/cliente/ClienteInfotimeEnderecoMapaOsm";
import {
  LigaFormularioBase,
  type LigaFormularioSecao,
} from "@/components/formulario-base/LigaFormularioBase";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import {
  executarComPrecheckSessao,
  solicitarReautenticacaoGlobal,
} from "@/lib/autenticacao/withSessionGuard";
import {
  cep8DaChaveGeocodeInfotime,
  chaveEnderecoInfotimeParaGeocode,
  consultasNominatimInfotime,
} from "@/domain/cliente-infotime/nominatim-consulta";
import { separarTipoENomeLogradouroViacep } from "@/domain/cliente-infotime/viacep-logradouro";
import { OPCOES_UF_BRASIL_FORMULARIO } from "@/domain/cliente-infotime/ufs-brasil";
import { colaboradorBadgePaletaTipoOuSituacao } from "@/lib/colaborador-lookup-paleta-seis";
import { traduzirErrosValidacaoParaFormulario } from "@/lib/validacao-api-i18n";
import { valorSnParaSwitch } from "@/lib/valor-sn-para-switch";

import "./liga-colaborador-infotime.css";

export type LigaColaboradorLookups = {
  tiposColaborador: { id: string; descricao: string | null }[];
  situacoesColaborador: { id: string; descricao: string | null }[];
  cargosClassificacaoNivel: { id: string; descricao: string | null }[];
  empresas: { id: string; rotulo: string | null }[];
  bancos: { id: string; nome: string | null }[];
  agencias: { id: string; rotulo: string | null; idBanco: string | null }[];
};

type Props = {
  idTenacidade: string | null;
  idColaborador: string | null;
  aoVoltar: () => void;
  aoSalvo: (id: string) => void;
};

export type CamposColaborador = {
  nome: string;
  apelido: string;
  idTipoColaborador: string;
  idSituacaoColaborador: string;
  login: string;
  senha: string;
  sexo: string;
  email: string;
  contatos: string;
  idEmpresa: string;
  implanta: string;
  liderImplantacao: string;
  consultorImplantacao: string;
  cpf: string;
  carteiraIdentidade: string;
  carteiraTrabalho: string;
  numeroPis: string;
  idCargoClassificacaoNivel: string;
  dataAdmissao: Date | null;
  dataDemissao: Date | null;
  dataEstagio: Date | null;
  dataNascimento: Date | null;
  regimeTrabalho: string;
  horaTrabalhoEntrada: string;
  horaTrabalhoSaida: string;
  horaAlmocoInicio: string;
  horaAlmocoFim: string;
  trabalhaSabado: boolean;
  trabalhaDomingo: boolean;
  salario: number | null;
  comissao: number | null;
  insalubridade: number | null;
  valeAlimentacao: number | null;
  valeTransporte: number | null;
  idBanco: string;
  idAgencia: string;
  numeroConta: string;
  cep: string;
  tipoLogradouro: string;
  logradouro: string;
  numero: string;
  complemento: string;
  bairro: string;
  cidade: string;
  estado: string;
  latitude: string;
  longitude: string;
  telefone: string;
  celular: string;
  pix: string;
  observacoes: string;
};

function camposVazio(): CamposColaborador {
  return {
    nome: "",
    apelido: "",
    idTipoColaborador: "",
    idSituacaoColaborador: "",
    login: "",
    senha: "",
    sexo: "",
    email: "",
    contatos: "",
    idEmpresa: "",
    implanta: "",
    liderImplantacao: "",
    consultorImplantacao: "",
    cpf: "",
    carteiraIdentidade: "",
    carteiraTrabalho: "",
    numeroPis: "",
    idCargoClassificacaoNivel: "",
    dataAdmissao: null,
    dataDemissao: null,
    dataEstagio: null,
    dataNascimento: null,
    regimeTrabalho: "",
    horaTrabalhoEntrada: "",
    horaTrabalhoSaida: "",
    horaAlmocoInicio: "",
    horaAlmocoFim: "",
    trabalhaSabado: false,
    trabalhaDomingo: false,
    salario: null,
    comissao: null,
    insalubridade: null,
    valeAlimentacao: null,
    valeTransporte: null,
    idBanco: "",
    idAgencia: "",
    numeroConta: "",
    cep: "",
    tipoLogradouro: "",
    logradouro: "",
    numero: "",
    complemento: "",
    bairro: "",
    cidade: "",
    estado: "",
    latitude: "",
    longitude: "",
    telefone: "",
    celular: "",
    pix: "",
    observacoes: "",
  };
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

/** Normaliza a coordenada para comparação de baseline (arredonda a 6 casas). */
function coordenadaParaComparacao(raw: string): string {
  const n = parseCoordenadaDigitada(raw);
  if (n == null) return "";
  return String(Math.round(n * 1e6) / 1e6);
}

function str(v: unknown): string {
  if (v === null || v === undefined) return "";
  return String(v);
}

/** Apenas dígitos, limitado ao tamanho da máscara (RG comum no BR: até 10 dígitos). */
function digitosMascaraRg(val: string): string {
  return val.replace(/\D/g, "").slice(0, 10);
}

/** Número (7) + série (até 5) da CTPS — até 12 dígitos. */
function digitosMascaraCtps(val: string): string {
  return val.replace(/\D/g, "").slice(0, 12);
}

function digitosMascaraPis(val: string): string {
  return val.replace(/\D/g, "").slice(0, 11);
}

function parseDataApi(v: unknown): Date | null {
  if (v == null || v === "") return null;
  if (v instanceof Date) return v;
  if (typeof v === "string") {
    const d = new Date(v.includes("T") ? v : `${v}T12:00:00.000Z`);
    return Number.isNaN(d.getTime()) ? null : d;
  }
  return null;
}

function isoOuStrParaHhMm(v: unknown): string {
  if (v == null || v === "") return "";
  if (typeof v === "string" && /^\d{1,2}:\d{2}/.test(v.trim())) return v.trim().slice(0, 5);
  const d = typeof v === "string" ? new Date(v) : v instanceof Date ? v : null;
  if (!d || Number.isNaN(d.getTime())) return "";
  const hh = String(d.getUTCHours()).padStart(2, "0");
  const mm = String(d.getUTCMinutes()).padStart(2, "0");
  return `${hh}:${mm}`;
}

function jsonParaCampos(dados: Record<string, unknown>): CamposColaborador {
  const c = camposVazio();
  c.nome = str(dados.nome);
  c.apelido = str(dados.apelido);
  c.idTipoColaborador = str(dados.id_tipo_colaborador ?? dados.idTipoColaborador);
  c.idSituacaoColaborador = str(
    dados.id_situacao_colaborador ?? dados.idSituacaoColaborador,
  );
  c.login = str(dados.login);
  c.sexo = str(dados.sexo).toUpperCase().slice(0, 1);
  c.email = str(dados.email);
  c.contatos = str(dados.contatos);
  c.idEmpresa = str(dados.id_empresa ?? dados.idEmpresa);
  c.implanta = str(dados.implanta).toUpperCase().slice(0, 1);
  c.liderImplantacao = str(dados.lider_implantacao ?? dados.liderImplantacao)
    .toUpperCase()
    .slice(0, 1);
  c.consultorImplantacao = str(
    dados.consultor_implantacao ?? dados.consultorImplantacao,
  )
    .toUpperCase()
    .slice(0, 1);
  c.cpf = str(dados.cpf).replace(/\D/g, "").slice(0, 11);
  c.carteiraIdentidade = digitosMascaraRg(
    str(dados.carteira_identidade ?? dados.carteiraIdentidade),
  );
  c.carteiraTrabalho = digitosMascaraCtps(
    str(dados.carteira_trabalho ?? dados.carteiraTrabalho),
  );
  c.numeroPis = digitosMascaraPis(str(dados.numero_pis ?? dados.numeroPis));
  c.idCargoClassificacaoNivel = str(
    dados.id_cargo_classificacao_nivel ?? dados.idCargoClassificacaoNivel,
  );
  c.dataAdmissao = parseDataApi(dados.data_admissao ?? dados.dataAdmissao);
  c.dataDemissao = parseDataApi(dados.data_demissao ?? dados.dataDemissao);
  c.dataEstagio = parseDataApi(dados.data_estagio ?? dados.dataEstagio);
  c.dataNascimento = parseDataApi(dados.data_nascimento ?? dados.dataNascimento);
  c.regimeTrabalho = str(dados.regime_trabalho ?? dados.regimeTrabalho)
    .toUpperCase()
    .slice(0, 1);
  c.horaTrabalhoEntrada = isoOuStrParaHhMm(
    dados.horaTrabalhoEntrada ?? dados.hora_trabalho_entrada,
  );
  c.horaTrabalhoSaida = isoOuStrParaHhMm(
    dados.horaTrabalhoSaida ?? dados.hora_trabalho_saida,
  );
  c.horaAlmocoInicio = isoOuStrParaHhMm(dados.horaAlmocoInicio ?? dados.hora_almoco_inicio);
  c.horaAlmocoFim = isoOuStrParaHhMm(dados.horaAlmocoFim ?? dados.hora_almoco_fim);
  c.trabalhaSabado = valorSnParaSwitch(dados.trabalha_sabado ?? dados.trabalhaSabado);
  c.trabalhaDomingo = valorSnParaSwitch(dados.trabalha_domingo ?? dados.trabalhaDomingo);
  const num = (x: unknown) =>
    x === null || x === undefined || x === "" ? null : Number(x);
  c.salario = num(dados.salario);
  c.comissao = num(dados.comissao);
  c.insalubridade = num(dados.insalubridade);
  c.valeAlimentacao = num(dados.valeAlimentacao ?? dados.vale_alimentacao);
  c.valeTransporte = num(dados.valeTransporte ?? dados.vale_transporte);
  c.idBanco = str(dados.id_banco ?? dados.idBanco);
  c.idAgencia = str(dados.id_agencia ?? dados.idAgencia);
  c.numeroConta = str(dados.numero_conta ?? dados.numeroConta);
  c.cep = str(dados.cep).replace(/\D/g, "").slice(0, 8);
  c.tipoLogradouro = str(dados.tipo_logradouro ?? dados.tipoLogradouro);
  c.logradouro = str(dados.logradouro);
  c.numero = str(dados.numero);
  c.complemento = str(dados.complemento);
  c.bairro = str(dados.bairro);
  c.cidade = str(dados.cidade);
  c.estado = str(dados.estado).toUpperCase().slice(0, 2);
  const latRaw = dados.latitude;
  const lonRaw = dados.longitude;
  c.latitude =
    latRaw === null || latRaw === undefined
      ? ""
      : typeof latRaw === "number"
        ? String(latRaw)
        : str(latRaw);
  c.longitude =
    lonRaw === null || lonRaw === undefined
      ? ""
      : typeof lonRaw === "number"
        ? String(lonRaw)
        : str(lonRaw);
  c.telefone = str(dados.telefone);
  c.celular = str(dados.celular);
  c.pix = str(dados.pix);
  c.observacoes = str(dados.observacoes);
  return c;
}

function formatarDataApi(d: Date | null): string | undefined {
  if (d == null) return undefined;
  const y = d.getUTCFullYear();
  const m = String(d.getUTCMonth() + 1).padStart(2, "0");
  const day = String(d.getUTCDate()).padStart(2, "0");
  return `${y}-${m}-${day}`;
}

function montarPayload(campos: CamposColaborador, incluirSenha: boolean): Record<string, unknown> {
  const payload: Record<string, unknown> = {
    nome: campos.nome.trim(),
    apelido: campos.apelido.trim() || undefined,
    idTipoColaborador: campos.idTipoColaborador.trim(),
    idSituacaoColaborador: campos.idSituacaoColaborador.trim(),
    login: campos.login.trim() || undefined,
    sexo: campos.sexo.trim() || undefined,
    email: campos.email.trim() || undefined,
    contatos: campos.contatos.trim() || undefined,
    idEmpresa: campos.idEmpresa.trim() || undefined,
    implanta: campos.implanta.trim() || undefined,
    liderImplantacao: campos.liderImplantacao.trim() || undefined,
    consultorImplantacao: campos.consultorImplantacao.trim() || undefined,
    cpf: campos.cpf.replace(/\D/g, "") || undefined,
    carteiraIdentidade: campos.carteiraIdentidade.trim() || undefined,
    carteiraTrabalho: campos.carteiraTrabalho.trim() || undefined,
    numeroPis: campos.numeroPis.trim() || undefined,
    idCargoClassificacaoNivel: campos.idCargoClassificacaoNivel.trim() || undefined,
    dataAdmissao: formatarDataApi(campos.dataAdmissao),
    dataDemissao: formatarDataApi(campos.dataDemissao),
    dataEstagio: formatarDataApi(campos.dataEstagio),
    dataNascimento: formatarDataApi(campos.dataNascimento),
    regimeTrabalho: campos.regimeTrabalho.trim() || undefined,
    horaTrabalhoEntrada: campos.horaTrabalhoEntrada.trim() || undefined,
    horaTrabalhoSaida: campos.horaTrabalhoSaida.trim() || undefined,
    horaAlmocoInicio: campos.horaAlmocoInicio.trim() || undefined,
    horaAlmocoFim: campos.horaAlmocoFim.trim() || undefined,
    trabalhaSabado: campos.trabalhaSabado ? "S" : "N",
    trabalhaDomingo: campos.trabalhaDomingo ? "S" : "N",
    salario: campos.salario,
    comissao: campos.comissao,
    insalubridade: campos.insalubridade,
    valeAlimentacao: campos.valeAlimentacao,
    valeTransporte: campos.valeTransporte,
    idBanco: campos.idBanco.trim() || undefined,
    idAgencia: campos.idAgencia.trim() || undefined,
    numeroConta: campos.numeroConta.trim() || undefined,
    cep: campos.cep.trim() || undefined,
    tipoLogradouro: campos.tipoLogradouro.trim() || undefined,
    logradouro: campos.logradouro.trim() || undefined,
    numero: campos.numero.trim() || undefined,
    complemento: campos.complemento.trim() || undefined,
    bairro: campos.bairro.trim() || undefined,
    cidade: campos.cidade.trim() || undefined,
    estado: campos.estado.trim() || undefined,
    latitude: parseCoordenadaDigitada(campos.latitude),
    longitude: parseCoordenadaDigitada(campos.longitude),
    telefone: campos.telefone.trim() || undefined,
    celular: campos.celular.trim() || undefined,
    pix: campos.pix.trim() || undefined,
    observacoes: campos.observacoes.trim() || undefined,
  };
  if (incluirSenha && campos.senha.trim().length > 1) {
    payload.senha = campos.senha;
  }
  return payload;
}

function serializarComparacao(c: CamposColaborador): string {
  const { senha, ...rest } = c;
  void senha;
  return JSON.stringify({
    ...rest,
    latitude: coordenadaParaComparacao(rest.latitude),
    longitude: coordenadaParaComparacao(rest.longitude),
  });
}

const REGIME_OPCOES = [
  { label: "CLT", value: "C" },
  { label: "PJ", value: "P" },
  { label: "Estágio", value: "E" },
  { label: "Autônomo", value: "A" },
  { label: "Outro", value: "O" },
];

export function LigaColaboradorInfotimeFormulario({
  idTenacidade,
  idColaborador,
  aoVoltar,
  aoSalvo,
}: Props) {
  const t = useTranslations("home.colaboradorInfotime.formulario");
  const tValidacao = useTranslations("home.validation");
  const tFeedback = useTranslations("home.feedback");
  const feedback = useLigaFeedback();

  const tenantEhPrincipal = (idTenacidade ?? "").trim() === "1";
  const mostrarCamposImplantacao = (() => {
    const n = parseInt((idTenacidade ?? "").trim(), 10);
    return Number.isFinite(n) && n > 1;
  })();

  const [lookups, setLookups] = useState<LigaColaboradorLookups | null>(null);
  const [campos, setCampos] = useState<CamposColaborador>(camposVazio);
  const [baseline, setBaseline] = useState<string | null>(null);
  const [carregando, setCarregando] = useState(Boolean(idColaborador));
  const [salvando, setSalvando] = useState(false);
  const [excluindo, setExcluindo] = useState(false);
  const [dialogoExcluir, setDialogoExcluir] = useState(false);
  const [dialogoPendencia, setDialogoPendencia] = useState(false);
  const [temFoto, setTemFoto] = useState(false);
  const [mapaEnderecoModalAberto, setMapaEnderecoModalAberto] = useState(false);

  /**
   * Rastreia o CEP cujo ViaCEP já foi aplicado para evitar re-fetch e, sobretudo,
   * para acompanhar o baseline (não marca o formulário como sujo após o auto-preenchimento
   * no load). Mesmo padrão do `LigaClienteInfotimeFormulario`.
   */
  const cepViaCepAplicadoRef = useRef("");
  /**
   * Chave de endereço para a qual o Nominatim já entregou coordenadas (ou para a qual
   * coordenadas vindas do banco já casam). Evita falso «sujo» e refetch desnecessário.
   */
  const geocodeResolvidoParaChaveRef = useRef<string | null>(null);

  const sujo = useMemo(() => {
    if (carregando || baseline === null) return false;
    return serializarComparacao(campos) !== baseline;
  }, [campos, carregando, baseline]);

  const optsTipo = useMemo(
    () =>
      (lookups?.tiposColaborador ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsSituacao = useMemo(
    () =>
      (lookups?.situacoesColaborador ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsCargo = useMemo(
    () =>
      (lookups?.cargosClassificacaoNivel ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsEmpresa = useMemo(
    () =>
      (lookups?.empresas ?? []).map((x) => ({
        label: x.rotulo?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsBanco = useMemo(
    () =>
      (lookups?.bancos ?? []).map((x) => ({
        label: x.nome?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsAgencia = useMemo(() => {
    const bid = campos.idBanco.trim();
    return (lookups?.agencias ?? [])
      .filter((a) => !bid || (a.idBanco ?? "") === bid)
      .map((x) => ({
        label: x.rotulo?.trim() || x.id,
        value: x.id,
      }));
  }, [lookups, campos.idBanco]);

  const rotuloTipoSelecionado = useMemo(() => {
    const id = campos.idTipoColaborador.trim();
    if (!id) return null;
    return optsTipo.find((o) => o.value === id)?.label?.trim() || null;
  }, [campos.idTipoColaborador, optsTipo]);

  const rotuloSituacaoSelecionada = useMemo(() => {
    const id = campos.idSituacaoColaborador.trim();
    if (!id) return null;
    return optsSituacao.find((o) => o.value === id)?.label?.trim() || null;
  }, [campos.idSituacaoColaborador, optsSituacao]);

  const refMedidorBadgesLookup = useRef<HTMLSpanElement>(null);
  const [lookupBadgeMinWidthPx, setLookupBadgeMinWidthPx] = useState<number | null>(null);

  useLayoutEffect(() => {
    const root = refMedidorBadgesLookup.current;
    if (!root) {
      setLookupBadgeMinWidthPx(null);
      return;
    }
    const medir = () => {
      const badges = root.querySelectorAll<HTMLElement>(".liga-padrao-badge");
      let max = 0;
      badges.forEach((b) => {
        max = Math.max(max, b.getBoundingClientRect().width);
      });
      if (max > 0) {
        setLookupBadgeMinWidthPx((prev) => {
          const proximo = Math.ceil(max);
          return prev === proximo ? prev : proximo;
        });
      }
    };
    requestAnimationFrame(() => requestAnimationFrame(medir));
    const ro = new ResizeObserver(() => {
      requestAnimationFrame(() => requestAnimationFrame(medir));
    });
    ro.observe(root);
    return () => {
      ro.disconnect();
    };
  }, [optsTipo, optsSituacao]);

  const estiloBadgeLookup = useMemo<CSSProperties | undefined>(
    () =>
      lookupBadgeMinWidthPx != null
        ? { minWidth: `${lookupBadgeMinWidthPx}px` }
        : undefined,
    [lookupBadgeMinWidthPx],
  );

  const renderOpcaoTipoLookupComBadge = useCallback(
    (opt: { label: string; value: string } | null | undefined) => {
      if (!opt?.label?.trim()) {
        return null;
      }
      const variante = colaboradorBadgePaletaTipoOuSituacao(opt.value, opt.label, "tipo");
      return (
        <span className="liga-colaborador-infotime-ident-dropdown-badge-opcao">
          <span
            className={`liga-padrao-badge liga-colaborador-infotime-paleta-badge--${variante}`}
            style={estiloBadgeLookup}
          >
            {opt.label}
          </span>
        </span>
      );
    },
    [estiloBadgeLookup],
  );

  const renderOpcaoSituacaoLookupComBadge = useCallback(
    (opt: { label: string; value: string } | null | undefined) => {
      if (!opt?.label?.trim()) {
        return null;
      }
      const variante = colaboradorBadgePaletaTipoOuSituacao(opt.value, opt.label, "situacao");
      return (
        <span className="liga-colaborador-infotime-ident-dropdown-badge-opcao">
          <span
            className={`liga-padrao-badge liga-colaborador-infotime-paleta-badge--${variante}`}
            style={estiloBadgeLookup}
          >
            {opt.label}
          </span>
        </span>
      );
    },
    [estiloBadgeLookup],
  );


  useEffect(() => {
    let ac = false;
    void executarComPrecheckSessao(
      async () => {
        const r = await fetch("/api/colaboradores/lookups", {
          credentials: "include",
          cache: "no-store",
        });
        if (!r.ok) throw new Error("lookups");
        const j = (await r.json()) as LigaColaboradorLookups;
        if (!ac) setLookups(j);
      },
      () => solicitarReautenticacaoGlobal(),
    ).catch(() => {
      if (!ac) feedback.aviso(t("avisoLookups"));
    });
    return () => {
      ac = true;
    };
  }, [feedback, t]);

  useEffect(() => {
    if (!idColaborador) {
      const vazio = camposVazio();
      setCampos(vazio);
      setTemFoto(false);
      setCarregando(false);
      cepViaCepAplicadoRef.current = "";
      geocodeResolvidoParaChaveRef.current = null;
      setBaseline(serializarComparacao(vazio));
      return;
    }
    let ac = false;
    setCarregando(true);
    setBaseline(null);
    void (async () => {
      try {
        const res = await fetch(`/api/colaboradores/${encodeURIComponent(idColaborador)}`, {
          credentials: "include",
          cache: "no-store",
        });
        if (!res.ok) throw new Error("load");
        const body = (await res.json()) as { dados?: Record<string, unknown> };
        const dados = body.dados ?? {};
        if (ac) {
          return;
        }
        const c = jsonParaCampos(dados);
        /** Marca o CEP carregado como já «aplicado» — não dispara ViaCEP no load. */
        cepViaCepAplicadoRef.current = c.cep.replace(/\D/g, "").slice(0, 8);
        /** Se já há coordenadas no banco, marca a chave de geocode como resolvida. */
        const latOk = parseCoordenadaDigitada(c.latitude);
        const lonOk = parseCoordenadaDigitada(c.longitude);
        geocodeResolvidoParaChaveRef.current =
          latOk != null && lonOk != null
            ? chaveEnderecoInfotimeParaGeocode({
                cep: c.cep,
                tipoLogradouro: c.tipoLogradouro,
                logradouro: c.logradouro,
                numero: c.numero,
                complemento: c.complemento,
                bairro: c.bairro,
                cidade: c.cidade,
                estado: c.estado,
              })
            : null;
        setCampos(c);
        setTemFoto(dados.temFoto === true);
        setBaseline(serializarComparacao(c));
      } catch {
        if (!ac) {
          feedback.erroDetalhado(tFeedback("toastFalhaOperacao"), t("erroCarregar"));
          aoVoltar();
        }
      } finally {
        if (!ac) setCarregando(false);
      }
    })();
    return () => {
      ac = true;
    };
  }, [idColaborador, aoVoltar, feedback, t, tFeedback]);

  /**
   * Garante que o valor do CEP seja commitado em `campos.cep` ao sair do `InputMask`,
   * espelhando o fluxo estável do `LigaClienteInfotimeFormulario` (ViaCEP + Nominatim).
   */
  const aoSairDoCampoCep = useCallback((valorMascarado: string) => {
    const digitos = String(valorMascarado ?? "")
      .replace(/\D/g, "")
      .slice(0, 8);
    flushSync(() => {
      setCampos((prev) => (digitos === prev.cep ? prev : { ...prev, cep: digitos }));
    });
  }, []);

  const enderecoParaGeo = useMemo(
    () => ({
      cep: campos.cep,
      tipoLogradouro: campos.tipoLogradouro,
      logradouro: campos.logradouro,
      numero: campos.numero,
      complemento: campos.complemento,
      bairro: campos.bairro,
      cidade: campos.cidade,
      estado: campos.estado,
    }),
    [
      campos.cep,
      campos.tipoLogradouro,
      campos.logradouro,
      campos.numero,
      campos.complemento,
      campos.bairro,
      campos.cidade,
      campos.estado,
    ],
  );

  const consultasNominatim = useMemo(
    () => consultasNominatimInfotime(enderecoParaGeo),
    [enderecoParaGeo],
  );

  const chaveGeocodeEndereco = useMemo(
    () => chaveEnderecoInfotimeParaGeocode(enderecoParaGeo),
    [enderecoParaGeo],
  );

  useEffect(() => {
    const digitos = campos.cep.replace(/\D/g, "").slice(0, 8);
    if (digitos.length !== 8) {
      cepViaCepAplicadoRef.current = "";
      return;
    }
    if (cepViaCepAplicadoRef.current === digitos) return;
    const ac = new AbortController();
    const atraso = window.setTimeout(() => {
      void fetch(`https://viacep.com.br/ws/${digitos}/json/`, {
        signal: ac.signal,
        cache: "no-store",
      })
        .then((r) => r.json() as Promise<Record<string, unknown>>)
        .then((j) => {
          if (!j || String(j.erro ?? "") === "true") {
            setCampos((prev) => {
              const atual = prev.cep.replace(/\D/g, "").slice(0, 8);
              if (atual !== digitos) return prev;
              geocodeResolvidoParaChaveRef.current = null;
              return prev;
            });
            return;
          }
          setCampos((prev) => {
            const atual = prev.cep.replace(/\D/g, "").slice(0, 8);
            if (atual !== digitos) return prev;
            /** Novo CEP → endereço mudou; coords antigas não correspondem mais à chave de geocode. */
            geocodeResolvidoParaChaveRef.current = null;
            cepViaCepAplicadoRef.current = digitos;
            const rawLogradouro = str(j.logradouro).trim();
            const { tipo: tipoViacep, nome: nomeViacep } =
              separarTipoENomeLogradouroViacep(rawLogradouro);
            const tipoLogradouroViacep =
              tipoViacep && nomeViacep.trim() ? tipoViacep : prev.tipoLogradouro;
            const logradouroViacep = rawLogradouro
              ? tipoViacep && nomeViacep.trim()
                ? nomeViacep
                : rawLogradouro
              : prev.logradouro;
            const next: CamposColaborador = {
              ...prev,
              tipoLogradouro: tipoLogradouroViacep,
              logradouro: logradouroViacep,
              bairro: str(j.bairro).trim() || prev.bairro,
              cidade: str(j.localidade).trim() || prev.cidade,
              estado:
                str(j.uf).trim().toUpperCase().slice(0, 2) || prev.estado,
              latitude: "",
              longitude: "",
            };
            /** Baseline acompanha o auto-preenchimento (evita falso «sujo» ao voltar). */
            queueMicrotask(() => {
              setBaseline(serializarComparacao(next));
            });
            return next;
          });
        })
        .catch(() => {});
    }, 500);
    return () => {
      window.clearTimeout(atraso);
      ac.abort();
    };
  }, [campos.cep]);

  /**
   * Geocodificação via Nominatim, mesma regra do `LigaClienteInfotimeFormulario`:
   * — sem consultas, não invalida a ref;
   * — coordenadas presentes sem ref de chave → marca a chave (carregamento inicial);
   * — chave já resolvida → não refaz;
   * — caso contrário, consulta em cadeia e atualiza coords + baseline.
   */
  useEffect(() => {
    if (consultasNominatim.length === 0) return;
    const latOk = parseCoordenadaDigitada(campos.latitude);
    const lonOk = parseCoordenadaDigitada(campos.longitude);
    const temCoord = latOk != null && lonOk != null;

    if (temCoord && geocodeResolvidoParaChaveRef.current === null) {
      geocodeResolvidoParaChaveRef.current = chaveGeocodeEndereco;
      return;
    }
    if (temCoord && geocodeResolvidoParaChaveRef.current === chaveGeocodeEndereco) {
      return;
    }

    const cepAgendadoGeocode = cep8DaChaveGeocodeInfotime(chaveGeocodeEndereco);
    const ac = new AbortController();
    const atraso = window.setTimeout(() => {
      void (async () => {
        for (const q of consultasNominatim) {
          if (ac.signal.aborted) return;
          try {
            const res = await fetch(`/api/geo/nominatim?q=${encodeURIComponent(q)}`, {
              signal: ac.signal,
              credentials: "include",
              cache: "no-store",
            });
            if (!res.ok) continue;
            const j = (await res.json()) as { lat?: number | null; lon?: number | null };
            if (j.lat == null || j.lon == null) continue;
            setCampos((prev) => {
              const cepAtual = prev.cep.replace(/\D/g, "").slice(0, 8);
              if (cepAtual !== cepAgendadoGeocode) return prev;
              const chaveAtual = chaveEnderecoInfotimeParaGeocode({
                cep: prev.cep,
                tipoLogradouro: prev.tipoLogradouro,
                logradouro: prev.logradouro,
                numero: prev.numero,
                complemento: prev.complemento,
                bairro: prev.bairro,
                cidade: prev.cidade,
                estado: prev.estado,
              });
              geocodeResolvidoParaChaveRef.current = chaveAtual;
              const next: CamposColaborador = {
                ...prev,
                latitude: String(j.lat),
                longitude: String(j.lon),
              };
              /** Baseline acompanha geocode (evita falso «sujo» ao voltar sem editar). */
              queueMicrotask(() => {
                setBaseline(serializarComparacao(next));
              });
              return next;
            });
            return;
          } catch {
            /* abort / rede */
          }
        }
      })();
    }, 900);
    return () => {
      window.clearTimeout(atraso);
      ac.abort();
    };
  }, [consultasNominatim, chaveGeocodeEndereco, campos.latitude, campos.longitude]);

  const validar = useCallback((): Record<string, string> | null => {
    const e: Record<string, string> = {};
    if (!campos.nome.trim()) e.nome = t("obrigatorio");
    if (!campos.idTipoColaborador.trim()) e.idTipoColaborador = t("obrigatorio");
    if (!campos.idSituacaoColaborador.trim()) e.idSituacaoColaborador = t("obrigatorio");
    return Object.keys(e).length ? e : null;
  }, [campos, t]);

  const salvar = useCallback(async () => {
    const errosLocais = validar();
    if (errosLocais) {
      feedback.aviso(tFeedback("toastValidacaoCampos"));
      return;
    }
    setSalvando(true);
    try {
      const incluirSenha = !idColaborador;
      const corpo = montarPayload(campos, incluirSenha);
      const url = idColaborador
        ? `/api/colaboradores/${encodeURIComponent(idColaborador)}`
        : "/api/colaboradores";
      const method = idColaborador ? "PUT" : "POST";
      const res = await fetch(url, {
        method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(corpo),
      });
      if (!res.ok) {
        const corpoErro = await res.json().catch(() => ({}));
        const { campos: errosApi, global } = traduzirErrosValidacaoParaFormulario(
          corpoErro,
          (key, values) => tValidacao(key, values),
        );
        if (Object.keys(errosApi).length > 0) {
          feedback.aviso(tFeedback("toastValidacaoCampos"));
        } else {
          feedback.erroDetalhado(
            tFeedback("toastFalhaOperacao"),
            global ?? (typeof corpoErro.message === "string" ? corpoErro.message : ""),
          );
        }
        return;
      }
      feedback.salvo();
      if (idColaborador) {
        aoSalvo(idColaborador);
      } else {
        const criado = (await res.json().catch(() => ({}))) as { id?: string };
        if (criado.id) aoSalvo(criado.id);
        else aoVoltar();
      }
    } catch {
      feedback.erroDetalhado(tFeedback("toastFalhaOperacao"), t("erroSalvar"));
    } finally {
      setSalvando(false);
    }
  }, [
    campos,
    feedback,
    idColaborador,
    aoSalvo,
    aoVoltar,
    t,
    tFeedback,
    tValidacao,
    validar,
  ]);

  const tentarVoltar = useCallback(() => {
    if (sujo) {
      setDialogoPendencia(true);
      return;
    }
    aoVoltar();
  }, [aoVoltar, sujo]);

  const excluir = useCallback(async () => {
    if (!idColaborador) return;
    setExcluindo(true);
    try {
      const res = await fetch(`/api/colaboradores/${encodeURIComponent(idColaborador)}`, {
        method: "DELETE",
      });
      if (!res.ok) {
        feedback.erroDetalhado(t("erroExcluir"));
        return;
      }
      feedback.excluido();
      aoVoltar();
    } catch {
      feedback.erroDetalhado(t("erroExcluir"));
    } finally {
      setExcluindo(false);
      setDialogoExcluir(false);
    }
  }, [aoVoltar, feedback, idColaborador, t]);

  const secFoto: LigaFormularioSecao | null =
    temFoto && idColaborador
      ? {
          id: "foto",
          titulo: t("abaFoto"),
          icone: "pi-image",
          conteudo: (
            <div className="liga-cliente-infotime-form-ident-secao">
              {/* eslint-disable-next-line @next/next/no-img-element -- foto por sessão em /api (fora do fluxo do next/image) */}
              <img
                className="max-w-20rem border-round"
                alt={t("fotoAlt")}
                src={`/api/colaboradores/${encodeURIComponent(idColaborador)}/foto`}
              />
              <p className="text-sm text-color-secondary mt-2">{t("fotoLegenda")}</p>
            </div>
          ),
        }
      : null;

  const secIdentificacao: LigaFormularioSecao = {
    id: "identificacao",
    titulo: t("secIdentificacao"),
    icone: "pi-id-card",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao liga-cliente-infotime-form-ident-grid">
        <span
          ref={refMedidorBadgesLookup}
          aria-hidden
          className="liga-colaborador-infotime-medidor-badges-lookup"
        >
          {optsTipo.map((o) => (
            <span key={`med-t-${o.value}`} className="liga-padrao-badge">
              {o.label}
            </span>
          ))}
          {optsSituacao.map((o) => (
            <span key={`med-s-${o.value}`} className="liga-padrao-badge">
              {o.label}
            </span>
          ))}
        </span>
        <div
          className={
            idColaborador
              ? "liga-colaborador-infotime-ident-linha1 liga-colaborador-infotime-ident-linha1--5col"
              : "liga-colaborador-infotime-ident-linha1 liga-colaborador-infotime-ident-linha1--4col"
          }
        >
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-nome">
              {t("nome")} *
            </label>
            <InputText
              id="liga-colab-nome"
              className="w-full"
              value={campos.nome}
              onChange={(e) => setCampos((p) => ({ ...p, nome: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-tipo">
              {t("tipoColaborador")} *
            </label>
            <Dropdown
              id="liga-colab-tipo"
              className="w-full liga-colaborador-infotime-ident-dropdown-lookup"
              panelClassName="liga-padrao-badge-lookup-panel--largura-igual liga-colaborador-infotime-ident-lookup-panel"
              value={campos.idTipoColaborador || null}
              options={optsTipo}
              optionLabel="label"
              optionValue="value"
              valueTemplate={renderOpcaoTipoLookupComBadge}
              itemTemplate={renderOpcaoTipoLookupComBadge}
              onChange={(e) =>
                setCampos((p) => ({ ...p, idTipoColaborador: String(e.value ?? "") }))
              }
              placeholder={t("selecione")}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-sit">
              {t("situacao")} *
            </label>
            <Dropdown
              id="liga-colab-sit"
              className="w-full liga-colaborador-infotime-ident-dropdown-lookup"
              panelClassName="liga-padrao-badge-lookup-panel--largura-igual liga-colaborador-infotime-ident-lookup-panel"
              value={campos.idSituacaoColaborador || null}
              options={optsSituacao}
              optionLabel="label"
              optionValue="value"
              valueTemplate={renderOpcaoSituacaoLookupComBadge}
              itemTemplate={renderOpcaoSituacaoLookupComBadge}
              onChange={(e) =>
                setCampos((p) => ({ ...p, idSituacaoColaborador: String(e.value ?? "") }))
              }
              placeholder={t("selecione")}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-login">
              {t("login")}
            </label>
            <InputText
              id="liga-colab-login"
              className="w-full"
              value={campos.login}
              onChange={(e) => setCampos((p) => ({ ...p, login: e.target.value }))}
            />
          </div>
          {idColaborador ? (
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-id">
                {t("idColaborador")}
              </label>
              <InputText
                id="liga-colab-id"
                className="w-full"
                readOnly
                value={idColaborador}
              />
            </div>
          ) : null}
        </div>
        <div
          className={
            idColaborador
              ? "liga-colaborador-infotime-ident-linha2 liga-colaborador-infotime-ident-linha2--5col"
              : "liga-colaborador-infotime-ident-linha2 liga-colaborador-infotime-ident-linha2--4col"
          }
        >
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-apelido">
              {t("apelido")}
            </label>
            <InputText
              id="liga-colab-apelido"
              className="w-full"
              value={campos.apelido}
              onChange={(e) => setCampos((p) => ({ ...p, apelido: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-sexo">
              {t("sexo")}
            </label>
            <Dropdown
              id="liga-colab-sexo"
              className="w-full"
              value={campos.sexo || null}
              options={[
                { label: t("sexoM"), value: "M" },
                { label: t("sexoF"), value: "F" },
                { label: t("sexoN"), value: "N" },
              ]}
              onChange={(e) => setCampos((p) => ({ ...p, sexo: String(e.value ?? "") }))}
              placeholder={t("selecione")}
              showClear
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-empresa">
              {t("empresa")}
            </label>
            <Dropdown
              id="liga-colab-empresa"
              className="w-full"
              value={campos.idEmpresa || null}
              options={optsEmpresa}
              onChange={(e) => setCampos((p) => ({ ...p, idEmpresa: String(e.value ?? "") }))}
              placeholder={t("selecione")}
              showClear
            />
          </div>
          {!idColaborador ? (
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-senha">
                {t("senha")}
              </label>
              <Password
                inputId="liga-colab-senha"
                className="w-full"
                inputClassName="w-full"
                toggleMask
                value={campos.senha}
                onChange={(e) => setCampos((p) => ({ ...p, senha: e.target.value }))}
                feedback={false}
              />
            </div>
          ) : null}
          <div
            className={
              idColaborador
                ? "liga-cliente-infotime-campo-primeira-linha liga-colaborador-infotime-ident-linha2-email-login-ate-id liga-colaborador-infotime-ident-linha2-slot-cpf-fim"
                : "liga-cliente-infotime-campo-primeira-linha liga-colaborador-infotime-ident-linha2-email-desde-login liga-colaborador-infotime-ident-linha2-slot-cpf-fim"
            }
          >
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-doc-cpf">
              {t("cpf")}
            </label>
            <InputMask
              id="liga-colab-doc-cpf"
              mask="999.999.999-99"
              unmask
              autoClear={false}
              className="w-full"
              inputMode="numeric"
              value={campos.cpf.replace(/\D/g, "").slice(0, 11)}
              onChange={(e) =>
                setCampos((p) => ({
                  ...p,
                  cpf: String(e.value ?? "").replace(/\D/g, "").slice(0, 11),
                }))
              }
            />
          </div>
        </div>
        <div
          className={
            idColaborador
              ? "liga-colaborador-infotime-ident-linha3 liga-colaborador-infotime-ident-linha3--5col"
              : "liga-colaborador-infotime-ident-linha3 liga-colaborador-infotime-ident-linha3--4col"
          }
        >
          <div className="liga-cliente-infotime-campo-primeira-linha liga-colaborador-infotime-ident-linha3-email-primeiro">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-email">
              {t("email")}
            </label>
            <InputText
              id="liga-colab-email"
              className="w-full"
              value={campos.email}
              onChange={(e) => setCampos((p) => ({ ...p, email: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-doc-rg">
              {t("rg")}
            </label>
            <InputMask
              id="liga-colab-doc-rg"
              mask="99.999.999-99"
              unmask
              autoClear={false}
              className="w-full"
              inputMode="numeric"
              value={campos.carteiraIdentidade.replace(/\D/g, "").slice(0, 10)}
              onChange={(e) =>
                setCampos((p) => ({
                  ...p,
                  carteiraIdentidade: digitosMascaraRg(String(e.value ?? "")),
                }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-doc-ctps">
              {t("ctps")}
            </label>
            <InputMask
              id="liga-colab-doc-ctps"
              mask="9999999/99999"
              unmask
              autoClear={false}
              className="w-full"
              inputMode="numeric"
              value={campos.carteiraTrabalho.replace(/\D/g, "").slice(0, 12)}
              onChange={(e) =>
                setCampos((p) => ({
                  ...p,
                  carteiraTrabalho: digitosMascaraCtps(String(e.value ?? "")),
                }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-doc-pis">
              {t("pis")}
            </label>
            <InputMask
              id="liga-colab-doc-pis"
              mask="999.99999.99-9"
              unmask
              autoClear={false}
              className="w-full"
              inputMode="numeric"
              value={campos.numeroPis.replace(/\D/g, "").slice(0, 11)}
              onChange={(e) =>
                setCampos((p) => ({
                  ...p,
                  numeroPis: digitosMascaraPis(String(e.value ?? "")),
                }))
              }
            />
          </div>
        </div>
        <div
          className={
            idColaborador
              ? "liga-colaborador-infotime-ident-linha-contatos-obs liga-colaborador-infotime-ident-linha-contatos-obs--5col"
              : "liga-colaborador-infotime-ident-linha-contatos-obs liga-colaborador-infotime-ident-linha-contatos-obs--4col"
          }
        >
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-contatos">
              {t("contatos")}
            </label>
            <InputTextarea
              id="liga-colab-contatos"
              className="w-full"
              rows={4}
              value={campos.contatos}
              onChange={(e) => setCampos((p) => ({ ...p, contatos: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-campo-primeira-linha">
            <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-observacoes">
              {t("abaObservacoes")}
            </label>
            <InputTextarea
              id="liga-colab-observacoes"
              className="w-full"
              rows={4}
              value={campos.observacoes}
              onChange={(e) => setCampos((p) => ({ ...p, observacoes: e.target.value }))}
            />
          </div>
        </div>
        {mostrarCamposImplantacao ? (
          <>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label">{t("implanta")}</label>
              <InputText
                className="w-full"
                maxLength={1}
                value={campos.implanta}
                onChange={(e) =>
                  setCampos((p) => ({
                    ...p,
                    implanta: e.target.value.toUpperCase().slice(0, 1),
                  }))
                }
              />
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label">
                {t("liderImplantacao")}
              </label>
              <InputText
                className="w-full"
                maxLength={1}
                value={campos.liderImplantacao}
                onChange={(e) =>
                  setCampos((p) => ({
                    ...p,
                    liderImplantacao: e.target.value.toUpperCase().slice(0, 1),
                  }))
                }
              />
            </div>
            <div className="liga-cliente-infotime-campo-primeira-linha">
              <label className="liga-cliente-infotime-primeira-linha-label">
                {t("consultorImplantacao")}
              </label>
              <InputText
                className="w-full"
                maxLength={1}
                value={campos.consultorImplantacao}
                onChange={(e) =>
                  setCampos((p) => ({
                    ...p,
                    consultorImplantacao: e.target.value.toUpperCase().slice(0, 1),
                  }))
                }
              />
            </div>
          </>
        ) : null}
      </div>
    ),
  };

  const secTrabalho: LigaFormularioSecao = {
    id: "trabalho",
    titulo: t("abaTrabalho"),
    icone: "pi-briefcase",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao liga-cliente-infotime-form-ident-grid">
        <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-span-2">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("cargo")}</label>
          <Dropdown
            className="w-full"
            value={campos.idCargoClassificacaoNivel || null}
            options={optsCargo}
            onChange={(e) =>
              setCampos((p) => ({ ...p, idCargoClassificacaoNivel: String(e.value ?? "") }))
            }
            placeholder={t("selecione")}
            filter
            showClear
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("dataAdmissao")}</label>
          <input
            type="date"
            className="p-inputtext p-component w-full"
            value={
              campos.dataAdmissao
                ? `${campos.dataAdmissao.getUTCFullYear()}-${String(campos.dataAdmissao.getUTCMonth() + 1).padStart(2, "0")}-${String(campos.dataAdmissao.getUTCDate()).padStart(2, "0")}`
                : ""
            }
            onChange={(e) => {
              const v = e.target.value;
              setCampos((p) => ({
                ...p,
                dataAdmissao: v ? parseDataApi(v) : null,
              }));
            }}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("dataDemissao")}</label>
          <input
            type="date"
            className="p-inputtext p-component w-full"
            value={
              campos.dataDemissao
                ? `${campos.dataDemissao.getUTCFullYear()}-${String(campos.dataDemissao.getUTCMonth() + 1).padStart(2, "0")}-${String(campos.dataDemissao.getUTCDate()).padStart(2, "0")}`
                : ""
            }
            onChange={(e) => {
              const v = e.target.value;
              setCampos((p) => ({
                ...p,
                dataDemissao: v ? parseDataApi(v) : null,
              }));
            }}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("dataEstagio")}</label>
          <input
            type="date"
            className="p-inputtext p-component w-full"
            value={
              campos.dataEstagio
                ? `${campos.dataEstagio.getUTCFullYear()}-${String(campos.dataEstagio.getUTCMonth() + 1).padStart(2, "0")}-${String(campos.dataEstagio.getUTCDate()).padStart(2, "0")}`
                : ""
            }
            onChange={(e) => {
              const v = e.target.value;
              setCampos((p) => ({
                ...p,
                dataEstagio: v ? parseDataApi(v) : null,
              }));
            }}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("dataNascimento")}</label>
          <input
            type="date"
            className="p-inputtext p-component w-full"
            value={
              campos.dataNascimento
                ? `${campos.dataNascimento.getUTCFullYear()}-${String(campos.dataNascimento.getUTCMonth() + 1).padStart(2, "0")}-${String(campos.dataNascimento.getUTCDate()).padStart(2, "0")}`
                : ""
            }
            onChange={(e) => {
              const v = e.target.value;
              setCampos((p) => ({
                ...p,
                dataNascimento: v ? parseDataApi(v) : null,
              }));
            }}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-span-2">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("regimeTrabalho")}</label>
          <Dropdown
            className="w-full"
            value={campos.regimeTrabalho || null}
            options={REGIME_OPCOES}
            onChange={(e) => setCampos((p) => ({ ...p, regimeTrabalho: String(e.value ?? "") }))}
            placeholder={t("selecione")}
            showClear
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("horaEntrada")}</label>
          <InputMask
            className="w-full"
            mask="99:99"
            value={campos.horaTrabalhoEntrada}
            onChange={(e) => setCampos((p) => ({ ...p, horaTrabalhoEntrada: e.value ?? "" }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("horaSaida")}</label>
          <InputMask
            className="w-full"
            mask="99:99"
            value={campos.horaTrabalhoSaida}
            onChange={(e) => setCampos((p) => ({ ...p, horaTrabalhoSaida: e.value ?? "" }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("almocoInicio")}</label>
          <InputMask
            className="w-full"
            mask="99:99"
            value={campos.horaAlmocoInicio}
            onChange={(e) => setCampos((p) => ({ ...p, horaAlmocoInicio: e.value ?? "" }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("almocoFim")}</label>
          <InputMask
            className="w-full"
            mask="99:99"
            value={campos.horaAlmocoFim}
            onChange={(e) => setCampos((p) => ({ ...p, horaAlmocoFim: e.value ?? "" }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-sab">
            {t("trabalhaSabado")}
          </label>
          <div className="liga-cliente-infotime-char1-switch">
            <InputSwitch
              inputId="liga-colab-sab"
              checked={campos.trabalhaSabado}
              onChange={(e) =>
                setCampos((p) => ({ ...p, trabalhaSabado: Boolean(e.value) }))
              }
            />
          </div>
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label" htmlFor="liga-colab-dom">
            {t("trabalhaDomingo")}
          </label>
          <div className="liga-cliente-infotime-char1-switch">
            <InputSwitch
              inputId="liga-colab-dom"
              checked={campos.trabalhaDomingo}
              onChange={(e) =>
                setCampos((p) => ({ ...p, trabalhaDomingo: Boolean(e.value) }))
              }
            />
          </div>
        </div>
      </div>
    ),
  };

  const secSalario: LigaFormularioSecao = {
    id: "salario",
    titulo: t("abaSalario"),
    icone: "pi-dollar",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao liga-cliente-infotime-form-ident-grid">
        <Message severity="info" className="col-12" text={t("abaSalarioAviso")} />
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("salario")}</label>
          <InputNumber
            className="w-full"
            mode="currency"
            currency="BRL"
            locale="pt-BR"
            value={campos.salario}
            onValueChange={(e) => setCampos((p) => ({ ...p, salario: e.value ?? null }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("comissao")}</label>
          <InputNumber
            className="w-full"
            mode="currency"
            currency="BRL"
            locale="pt-BR"
            value={campos.comissao}
            onValueChange={(e) => setCampos((p) => ({ ...p, comissao: e.value ?? null }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("insalubridade")}</label>
          <InputNumber
            className="w-full"
            mode="currency"
            currency="BRL"
            locale="pt-BR"
            value={campos.insalubridade}
            onValueChange={(e) => setCampos((p) => ({ ...p, insalubridade: e.value ?? null }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("valeAlimentacao")}</label>
          <InputNumber
            className="w-full"
            mode="currency"
            currency="BRL"
            locale="pt-BR"
            value={campos.valeAlimentacao}
            onValueChange={(e) =>
              setCampos((p) => ({ ...p, valeAlimentacao: e.value ?? null }))
            }
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("valeTransporte")}</label>
          <InputNumber
            className="w-full"
            mode="currency"
            currency="BRL"
            locale="pt-BR"
            value={campos.valeTransporte}
            onValueChange={(e) =>
              setCampos((p) => ({ ...p, valeTransporte: e.value ?? null }))
            }
          />
        </div>
      </div>
    ),
  };

  const secBanco: LigaFormularioSecao = {
    id: "banco",
    titulo: t("abaBanco"),
    icone: "pi-building-columns",
    conteudo: (
      <div className="liga-cliente-infotime-form-ident-secao liga-cliente-infotime-form-ident-grid">
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("banco")}</label>
          <Dropdown
            className="w-full"
            value={campos.idBanco || null}
            options={optsBanco}
            onChange={(e) =>
              setCampos((p) => ({
                ...p,
                idBanco: String(e.value ?? ""),
                idAgencia: "",
              }))
            }
            placeholder={t("selecione")}
            filter
            showClear
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("agencia")}</label>
          <Dropdown
            className="w-full"
            value={campos.idAgencia || null}
            options={optsAgencia}
            onChange={(e) => setCampos((p) => ({ ...p, idAgencia: String(e.value ?? "") }))}
            placeholder={t("selecione")}
            filter
            showClear
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-span-2">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("numeroConta")}</label>
          <InputText
            className="w-full"
            value={campos.numeroConta}
            onChange={(e) => setCampos((p) => ({ ...p, numeroConta: e.target.value }))}
          />
        </div>
        <div className="liga-cliente-infotime-campo-primeira-linha liga-cliente-infotime-form-span-2">
          <label className="liga-cliente-infotime-primeira-linha-label">{t("pix")}</label>
          <InputText
            className="w-full"
            value={campos.pix}
            onChange={(e) => setCampos((p) => ({ ...p, pix: e.target.value }))}
          />
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
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-cep">
              {t("cep")}
            </label>
            <InputMask
              id="liga-colab-end-cep"
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
              htmlFor="liga-colab-end-tipo"
            >
              {t("tipoLogradouro")}
            </label>
            <InputText
              id="liga-colab-end-tipo"
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
              htmlFor="liga-colab-end-log"
            >
              {t("logradouro")}
            </label>
            <InputText
              id="liga-colab-end-log"
              className="w-full"
              value={campos.logradouro}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, logradouro: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c4">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-num">
              {t("numero")}
            </label>
            <InputText
              id="liga-colab-end-num"
              className="w-full"
              value={campos.numero}
              onChange={(e) => setCampos((prev) => ({ ...prev, numero: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r1c5">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-comp">
              {t("complemento")}
            </label>
            <InputText
              id="liga-colab-end-comp"
              className="w-full"
              value={campos.complemento}
              onChange={(e) =>
                setCampos((prev) => ({ ...prev, complemento: e.target.value }))
              }
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c1">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-bairro">
              {t("bairro")}
            </label>
            <InputText
              id="liga-colab-end-bairro"
              className="w-full"
              value={campos.bairro}
              onChange={(e) => setCampos((prev) => ({ ...prev, bairro: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c2">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-cidade">
              {t("cidade")}
            </label>
            <InputText
              id="liga-colab-end-cidade"
              className="w-full"
              value={campos.cidade}
              onChange={(e) => setCampos((prev) => ({ ...prev, cidade: e.target.value }))}
            />
          </div>
          <div className="liga-cliente-infotime-endereco-cel liga-cliente-infotime-endereco-gdl-r2c3">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-lat">
              {t("latitude")}
            </label>
            <InputText
              id="liga-colab-end-lat"
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
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-lon">
              {t("longitude")}
            </label>
            <InputText
              id="liga-colab-end-lon"
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
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-uf">
              {t("estado")}
            </label>
            <Dropdown
              inputId="liga-colab-end-uf"
              value={
                campos.estado.trim() ? campos.estado.trim().toUpperCase().slice(0, 2) : null
              }
              options={OPCOES_UF_BRASIL_FORMULARIO}
              onChange={(e) =>
                setCampos((prev) => ({
                  ...prev,
                  estado: String(e.value ?? "").toUpperCase().slice(0, 2),
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

        <div className="liga-cliente-infotime-endereco-linha liga-colaborador-infotime-endereco-linha--contato">
          <div className="liga-colaborador-infotime-endereco-rc liga-colaborador-infotime-endereco-rc-tel">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-tel">
              {t("telefone")}
            </label>
            <InputMask
              id="liga-colab-end-tel"
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
          <div className="liga-colaborador-infotime-endereco-rc liga-colaborador-infotime-endereco-rc-cel">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-cel">
              {t("celular")}
            </label>
            <InputMask
              id="liga-colab-end-cel"
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
          <div className="liga-colaborador-infotime-endereco-rc liga-colaborador-infotime-endereco-rc-email">
            <label className="liga-cliente-infotime-label" htmlFor="liga-colab-end-email">
              {t("email")}
            </label>
            <InputText
              id="liga-colab-end-email"
              type="email"
              className="w-full"
              value={campos.email}
              onChange={(e) => setCampos((prev) => ({ ...prev, email: e.target.value }))}
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
              onClick={() => setMapaEnderecoModalAberto(true)}
              aria-label={t("mapaExpandirAria")}
            />
          </div>
          <ClienteInfotimeEnderecoMapaOsm
            lat={parseCoordenadaDigitada(campos.latitude)}
            lon={parseCoordenadaDigitada(campos.longitude)}
            mensagemSemCoordenadas={t("mapaSemCoordenadas")}
          />
        </div>
      </div>
    ),
  };

  const secDocsDigitais: LigaFormularioSecao = {
    id: "docsDigitais",
    titulo: t("abaDocsDigitais"),
    icone: "pi-folder-open",
    conteudo: <Message severity="info" text={t("docsDigitaisEmBreve")} />,
  };

  const secAdmin: LigaFormularioSecao | null = tenantEhPrincipal
    ? {
        id: "admin",
        titulo: t("abaAdmin"),
        icone: "pi-cog",
        conteudo: (
          <div className="liga-cliente-infotime-form-ident-secao">
            <p className="m-0 text-sm text-color-secondary">{t("abaAdminLegenda")}</p>
          </div>
        ),
      }
    : null;

  const secoes: LigaFormularioSecao[] = [];
  if (secFoto) secoes.push(secFoto);
  secoes.push(
    secIdentificacao,
    secTrabalho,
    secSalario,
    secBanco,
    secEndereco,
    secDocsDigitais,
  );
  if (secAdmin) secoes.push(secAdmin);

  const barraAcoes = (
    <div className="liga-cliente-infotime-form-barra-acoes">
      <Button
        type="button"
        label={t("voltar")}
        icon="pi pi-arrow-left"
        severity="secondary"
        outlined
        onClick={tentarVoltar}
        disabled={salvando || excluindo}
      />
      <span className="liga-cliente-infotime-form-barra-acoes-empurra" aria-hidden />
      <Button
        type="button"
        label={t("salvar")}
        icon="pi pi-save"
        loading={salvando}
        disabled={excluindo}
        onClick={() => void salvar()}
      />
      {idColaborador ? (
        <Button
          type="button"
          label={t("excluir")}
          icon="pi pi-trash"
          severity="danger"
          outlined
          title={t("excluir")}
          loading={excluindo}
          disabled={salvando}
          onClick={() => setDialogoExcluir(true)}
        />
      ) : null}
    </div>
  );

  const tituloFormulario = t("tituloCabecalho");
  const subtituloFormulario = idColaborador
    ? t("subtituloCabecalhoEditar")
    : t("subtituloCabecalhoNovo");
  const sufixoTitulo = (
    <span
      className="liga-cliente-infotime-titulo-resumo liga-cliente-infotime-titulo-resumo--faixa"
      aria-label={t("cabecalhoResumoAria")}
    >
      {idColaborador ? (
        <span className="liga-cliente-infotime-titulo-item">
          <i className="pi pi-tag liga-cliente-infotime-titulo-item-icone" aria-hidden />
          <span className="liga-cliente-infotime-titulo-chip liga-cliente-infotime-titulo-chip--id">
            {idColaborador}
          </span>
        </span>
      ) : null}
      <span className="liga-cliente-infotime-titulo-item">
        <i className="pi pi-user liga-cliente-infotime-titulo-item-icone" aria-hidden />
        <span className="liga-cliente-infotime-titulo-texto liga-cliente-infotime-titulo-texto--fantasia">
          {campos.nome.trim() || "—"}
          {campos.login.trim() ? (
            <span className="liga-colaborador-infotime-titulo-login-sufixo">
              {" "}
              ({campos.login.trim()})
            </span>
          ) : null}
        </span>
      </span>
      {rotuloTipoSelecionado || rotuloSituacaoSelecionada ? (
        <LigaPadraoBadgeGrupoIgualLargura
          className="liga-colaborador-infotime-titulo-grupo-badges"
          deps={[
            rotuloTipoSelecionado,
            rotuloSituacaoSelecionada,
            campos.idTipoColaborador,
            campos.idSituacaoColaborador,
          ]}
        >
          {rotuloTipoSelecionado ? (
            <span className="liga-cliente-infotime-titulo-item">
              <i className="pi pi-briefcase liga-cliente-infotime-titulo-item-icone" aria-hidden />
              <span
                className={`liga-padrao-badge liga-colaborador-infotime-paleta-badge--${colaboradorBadgePaletaTipoOuSituacao(campos.idTipoColaborador, rotuloTipoSelecionado, "tipo")}`}
              >
                {rotuloTipoSelecionado}
              </span>
            </span>
          ) : null}
          {rotuloSituacaoSelecionada ? (
            <span className="liga-cliente-infotime-titulo-item liga-cliente-infotime-titulo-item--situacao">
              <i className="pi pi-flag liga-cliente-infotime-titulo-item-icone" aria-hidden />
              <span
                className={`liga-padrao-badge liga-colaborador-infotime-paleta-badge--${colaboradorBadgePaletaTipoOuSituacao(campos.idSituacaoColaborador, rotuloSituacaoSelecionada, "situacao")}`}
              >
                {rotuloSituacaoSelecionada}
              </span>
            </span>
          ) : null}
        </LigaPadraoBadgeGrupoIgualLargura>
      ) : null}
    </span>
  );

  if (carregando) {
    return (
      <div className="p-4">
        <p>{t("carregando")}</p>
      </div>
    );
  }

  return (
    <section
      className={`liga-cliente-infotime-form liga-colaborador-infotime-form${idColaborador ? "" : " liga-cliente-infotime-form--inclusao"}`}
      style={{ padding: "0.5rem 0 1rem" }}
    >
      <Dialog
        header={t("dialogoExcluirTitulo")}
        visible={dialogoExcluir}
        onHide={() => !excluindo && setDialogoExcluir(false)}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
        closable={!excluindo}
        dismissableMask={!excluindo}
        draggable={false}
        footer={
          <div className="liga-mensagem-pop-up-rodape">
            <Button
              type="button"
              label={t("dialogoExcluirCancelar")}
              severity="secondary"
              outlined
              rounded
              disabled={excluindo}
              onClick={() => setDialogoExcluir(false)}
            />
            <Button
              type="button"
              label={t("dialogoExcluirConfirmar")}
              icon="pi pi-trash"
              severity="danger"
              rounded
              loading={excluindo}
              disabled={excluindo}
              className="liga-mensagem-pop-up-botao-primario-destrutivo"
              onClick={() => void excluir()}
            />
          </div>
        }
      >
        <p className="liga-mensagem-pop-up-texto">{t("dialogoExcluirMensagem")}</p>
      </Dialog>
      <Dialog
        header={t("pendenciaVoltarTitulo")}
        visible={dialogoPendencia}
        onHide={() => !salvando && setDialogoPendencia(false)}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
        closable={!salvando}
        dismissableMask={!salvando}
        draggable={false}
        footer={
          <div className="liga-mensagem-pop-up-rodape">
            <Button
              type="button"
              label={t("pendenciaVoltarContinuarEditando")}
              severity="secondary"
              outlined
              rounded
              className="liga-mensagem-pop-up-botao-secundario"
              disabled={salvando}
              onClick={() => setDialogoPendencia(false)}
            />
            <Button
              type="button"
              label={t("pendenciaVoltarDescartar")}
              severity="danger"
              outlined
              rounded
              disabled={salvando}
              onClick={() => {
                setDialogoPendencia(false);
                aoVoltar();
              }}
            />
            <Button
              type="button"
              label={t("pendenciaVoltarSalvar")}
              icon="pi pi-save"
              rounded
              loading={salvando}
              disabled={salvando}
              className="liga-mensagem-pop-up-botao-primario"
              onClick={() => {
                setDialogoPendencia(false);
                void salvar();
              }}
            />
          </div>
        }
      >
        <p className="liga-mensagem-pop-up-texto">{t("pendenciaVoltarMensagem")}</p>
      </Dialog>
      <Dialog
        visible={mapaEnderecoModalAberto}
        onHide={() => setMapaEnderecoModalAberto(false)}
        header={t("mapaLocalizacao")}
        style={{ width: "min(92vw, 56rem)" }}
        dismissableMask
        draggable={false}
      >
        <div className="liga-cliente-infotime-mapa-dialog-corpo">
          <ClienteInfotimeEnderecoMapaOsm
            apresentacao="dialog"
            lat={parseCoordenadaDigitada(campos.latitude)}
            lon={parseCoordenadaDigitada(campos.longitude)}
            mensagemSemCoordenadas={t("mapaSemCoordenadas")}
          />
        </div>
      </Dialog>
      <LigaFormularioBase
        titulo={tituloFormulario}
        subtitulo={subtituloFormulario}
        subtituloAgrupadoAoTitulo
        sufixoTitulo={sufixoTitulo}
        tituloComBarraVerde
        iconeTitulo="pi-user"
        secoes={secoes}
        secaoInicialId={secFoto ? "foto" : "identificacao"}
        barraAcoes={barraAcoes}
        temLegendaCamposObrigatorios
      />
    </section>
  );
}
