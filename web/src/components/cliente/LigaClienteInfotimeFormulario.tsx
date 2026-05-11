"use client";

import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import { flushSync } from "react-dom";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import {
  LigaFormularioBase,
} from "@/components/formulario-base/LigaFormularioBase";
import "@/components/formulario-base/liga-formulario-base.css";
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

import "@/components/ui/dialogo/liga-mensagem-pop-up.css";
import { ClienteInfotimeEnderecoMapaOsm } from "./ClienteInfotimeEnderecoMapaOsm";
import { criarSecoesFormularioClienteInfotime } from "./liga-cliente-infotime-formulario-secoes";

export type LigaClienteLookups = {
  situacoesCliente: { id: string; descricao: string | null }[];
  tiposCliente: { id: string; descricao: string | null }[];
  contasCaixa: { id: string; rotulo: string | null }[];
  canais: { id: string; descricao: string | null }[];
  concorrentes: { id: string; rotulo: string | null }[];
  municipios: { id: string; rotulo: string | null }[];
  regioesEstaduais: { id: string; rotulo: string | null }[];
};

type Props = {
  idTenacidade: string | null;
  idCliente: string | null;
  aoVoltar: () => void;
  aoSalvo: (id: string) => void;
};

export type Campos = {
  tipoPessoa: string;
  razaoSocial: string;
  nomeFantasia: string;
  sexo: string;
  dataNascimento: Date | null;
  telefone: string;
  celular: string;
  email: string;
  contatos: string;
  idSituacaoCliente: string;
  idContaCaixa: string;
  idMunicipio: string;
  idClienteCanal: string;
  idTipoCliente: string;
  idConcorrente: string;
  idRegiaoEstadual: string;
  chaveAcesso: string;
  dataExpiracao: Date | null;
  qtdLicenca: string;
  clientePublico: string;
  homepage: string;
  emiteBoleto: string;
  cnpj: string;
  inscricaoEstadual: string;
  inscricaoMunicipal: string;
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
  observacoes: string;
  certificadoRegistro: string;
  dataEmissaoCr: Date | null;
  dataValidadeCr: Date | null;
  numeroAntigo: string;
  idClienteInfolab: string;
};

type ResultadoPersistirCliente =
  | { ok: true; msgKey: "salvo" | "criado"; idParaSalvo: string | null }
  | { ok: false };

function camposVazio(): Campos {
  return {
    tipoPessoa: "J",
    razaoSocial: "",
    nomeFantasia: "",
    sexo: "",
    dataNascimento: null,
    telefone: "",
    celular: "",
    email: "",
    contatos: "",
    idSituacaoCliente: "",
    idContaCaixa: "",
    idMunicipio: "",
    idClienteCanal: "",
    idTipoCliente: "",
    idConcorrente: "",
    idRegiaoEstadual: "",
    chaveAcesso: "",
    dataExpiracao: null,
    qtdLicenca: "",
    clientePublico: "",
    homepage: "",
    emiteBoleto: "",
    cnpj: "",
    inscricaoEstadual: "",
    inscricaoMunicipal: "",
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
    observacoes: "",
    certificadoRegistro: "",
    dataEmissaoCr: null,
    dataValidadeCr: null,
    numeroAntigo: "",
    idClienteInfolab: "",
  };
}

function str(v: unknown): string {
  if (v === null || v === undefined) return "";
  return String(v);
}

function jsonParaCampos(dados: Record<string, unknown>): Campos {
  const c = camposVazio();
  c.tipoPessoa = str(dados.tipo_pessoa || dados.tipoPessoa || "J").toUpperCase().slice(0, 1) || "J";
  c.razaoSocial = str(dados.razao_social ?? dados.razaoSocial);
  c.nomeFantasia = str(dados.nome_fantasia ?? dados.nomeFantasia);
  c.sexo = str(dados.sexo).toUpperCase().slice(0, 1);
  if (dados.data_nascimento || dados.dataNascimento) {
    const raw = dados.data_nascimento ?? dados.dataNascimento;
    const dt =
      typeof raw === "string"
        ? new Date(raw)
        : raw instanceof Date
          ? raw
          : null;
    c.dataNascimento = dt && !Number.isNaN(dt.getTime()) ? dt : null;
  }
  c.telefone = str(dados.telefone);
  c.celular = str(dados.celular);
  c.email = str(dados.email);
  c.contatos = str(dados.contatos);
  c.idSituacaoCliente = str(dados.id_situacao_cliente ?? dados.idSituacaoCliente);
  c.idContaCaixa = str(dados.id_conta_caixa ?? dados.idContaCaixa);
  c.idMunicipio = str(dados.id_municipio ?? dados.idMunicipio);
  c.idClienteCanal = str(dados.id_cliente_canal ?? dados.idClienteCanal);
  c.idTipoCliente = str(dados.id_tipo_cliente ?? dados.idTipoCliente);
  c.idConcorrente = str(dados.id_concorrente ?? dados.idConcorrente);
  c.idRegiaoEstadual = str(dados.id_regiao_estadual ?? dados.idRegiaoEstadual);
  c.chaveAcesso = str(dados.chave_acesso ?? dados.chaveAcesso);
  const dex = dados.data_expiracao ?? dados.dataExpiracao;
  if (dex) {
    const dt = typeof dex === "string" ? new Date(dex) : dex instanceof Date ? dex : null;
    c.dataExpiracao = dt && !Number.isNaN(dt.getTime()) ? dt : null;
  }
  c.qtdLicenca = str(dados.qtd_licenca ?? dados.qtdLicenca);
  c.clientePublico = str(dados.cliente_publico ?? dados.clientePublico).toUpperCase().slice(0, 1);
  c.homepage = str(dados.home_page ?? dados.homepage);
  c.emiteBoleto = str(dados.emite_boleto ?? dados.emiteBoleto).toUpperCase().slice(0, 1);
  c.cnpj = str(dados.cnpj);
  c.inscricaoEstadual = str(dados.inscricao_estadual ?? dados.inscricaoEstadual);
  c.inscricaoMunicipal = str(dados.inscricao_municipal ?? dados.inscricaoMunicipal);
  c.cep = str(dados.cep);
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
  c.observacoes = str(dados.observacoes);
  c.certificadoRegistro = str(dados.certificado_registro ?? dados.certificadoRegistro);
  const dem = dados.data_emissao_cr ?? dados.dataEmissaoCr;
  if (dem) {
    const dt = typeof dem === "string" ? new Date(dem) : dem instanceof Date ? dem : null;
    c.dataEmissaoCr = dt && !Number.isNaN(dt.getTime()) ? dt : null;
  }
  const dvm = dados.data_validade_cr ?? dados.dataValidadeCr;
  if (dvm) {
    const dt = typeof dvm === "string" ? new Date(dvm) : dvm instanceof Date ? dvm : null;
    c.dataValidadeCr = dt && !Number.isNaN(dt.getTime()) ? dt : null;
  }
  c.numeroAntigo = str(dados.numero_antigo ?? dados.numeroAntigo);
  c.idClienteInfolab = str(dados.id_cliente_infolab ?? dados.idClienteInfolab);
  return c;
}

const TAM_MAX_DETALHE_ERRO_API = 480;

function truncarDetalheErroApi(s: string): string {
  if (s.length <= TAM_MAX_DETALHE_ERRO_API) return s;
  return `${s.slice(0, TAM_MAX_DETALHE_ERRO_API)}…`;
}

/** Corpo JSON típico do Nest (`message` string ou array de validação). */
function extrairMensagemErroApiJson(texto: string): string | undefined {
  try {
    const body = JSON.parse(texto) as { message?: unknown };
    const m = body.message;
    if (typeof m === "string" && m.trim()) {
      return truncarDetalheErroApi(m.trim());
    }
    if (Array.isArray(m)) {
      const s = m
        .filter((x): x is string => typeof x === "string")
        .join(" ")
        .trim();
      return s ? truncarDetalheErroApi(s) : undefined;
    }
  } catch {
    return undefined;
  }
  return undefined;
}

function montarPayload(campos: Campos): Record<string, unknown> {
  const opcNum = (s: string) => (s.trim() === "" ? undefined : Number.parseInt(s, 10));
  const opcStrData = (d: Date | null | undefined) =>
    d ? d.toISOString().slice(0, 10) : undefined;
  return {
    tipoPessoa: campos.tipoPessoa,
    razaoSocial: campos.razaoSocial.trim(),
    nomeFantasia: campos.nomeFantasia.trim(),
    sexo: campos.sexo.trim() === "" ? undefined : campos.sexo.trim(),
    dataNascimento:
      campos.tipoPessoa === "F" && campos.dataNascimento
        ? campos.dataNascimento.toISOString()
        : undefined,
    telefone: campos.telefone.trim() || undefined,
    celular: campos.celular.trim() || undefined,
    email: campos.email.trim() || undefined,
    contatos: campos.contatos.trim() || undefined,
    idSituacaoCliente: opcNum(campos.idSituacaoCliente),
    idContaCaixa: opcNum(campos.idContaCaixa),
    idMunicipio:
      campos.idMunicipio.trim() === "" ? undefined : opcNum(campos.idMunicipio),
    idClienteCanal:
      campos.idClienteCanal.trim() === "" ? null : campos.idClienteCanal.trim(),
    idTipoCliente:
      campos.idTipoCliente.trim() === "" ? null : campos.idTipoCliente.trim(),
    idConcorrente:
      campos.idConcorrente.trim() === "" ? null : campos.idConcorrente.trim(),
    idRegiaoEstadual:
      campos.idRegiaoEstadual.trim() === "" ? null : campos.idRegiaoEstadual.trim(),
    cnpj: campos.cnpj.trim() || undefined,
    inscricaoEstadual: campos.inscricaoEstadual.trim() || undefined,
    inscricaoMunicipal: campos.inscricaoMunicipal.trim() || undefined,
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
    homepage: campos.homepage.trim() || undefined,
    emiteBoleto: campos.emiteBoleto.trim() === "" ? undefined : campos.emiteBoleto,
    observacoes: campos.observacoes.trim() || undefined,
    certificadoRegistro:
      campos.certificadoRegistro.trim() || undefined,
    dataEmissaoCr: opcStrData(campos.dataEmissaoCr),
    dataValidadeCr: opcStrData(campos.dataValidadeCr),
    dataExpiracao: opcStrData(campos.dataExpiracao),
    qtdLicenca:
      campos.qtdLicenca.trim() === ""
        ? undefined
        : Number.parseInt(campos.qtdLicenca, 10),
    clientePublico:
      campos.clientePublico.trim() === "" ? undefined : campos.clientePublico,
  };
}

function parseCoordenadaDigitada(raw: string): number | null {
  const s = raw.trim().replace(",", ".");
  if (s === "") return null;
  const n = Number.parseFloat(s);
  return Number.isFinite(n) ? n : null;
}

/** Coordenadas só para comparação (evita falso «sujo» por diferença de precisão float). */
function coordenadaParaComparacao(raw: string): string {
  const n = parseCoordenadaDigitada(raw);
  if (n == null) return "";
  return String(Math.round(n * 1e6) / 1e6);
}

/** Data «só dia» em UTC (alinha a strings `YYYY-MM-DD` vindas da API). */
function dataSomenteDiaUtcParaComparacao(d: Date | null): string | null {
  if (!d || Number.isNaN(d.getTime())) return null;
  const y = d.getUTCFullYear();
  const m = String(d.getUTCMonth() + 1).padStart(2, "0");
  const day = String(d.getUTCDate()).padStart(2, "0");
  return `${y}-${m}-${day}`;
}

/** Snapshot estável para detectar alterações não salvas. */
function serializarCamposParaComparacao(c: Campos): string {
  return JSON.stringify({
    ...c,
    latitude: coordenadaParaComparacao(c.latitude),
    longitude: coordenadaParaComparacao(c.longitude),
    dataNascimento: dataSomenteDiaUtcParaComparacao(c.dataNascimento),
    dataExpiracao: dataSomenteDiaUtcParaComparacao(c.dataExpiracao),
    dataEmissaoCr: dataSomenteDiaUtcParaComparacao(c.dataEmissaoCr),
    dataValidadeCr: dataSomenteDiaUtcParaComparacao(c.dataValidadeCr),
  });
}

function formatarDocumentoTitulo(doc: string): string {
  const d = doc.replace(/\D/g, "");
  if (d.length === 11) return d.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
  if (d.length === 14) return d.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
  return doc.trim();
}

function normalizarSituacaoTag(s: string): "ativo" | "inativo" | "lead" | "prospect" | "outro" {
  const t = s.trim().toLocaleLowerCase("pt-BR");
  if (t === "ativo") return "ativo";
  if (t === "inativo") return "inativo";
  if (t === "lead") return "lead";
  if (t === "prospect") return "prospect";
  return "outro";
}

export function LigaClienteInfotimeFormulario({
  idTenacidade,
  idCliente,
  aoVoltar,
  aoSalvo,
}: Props) {
  const t = useTranslations("home.clienteInfotime.formulario");
  const tFeedback = useTranslations("home.feedback");
  const feedback = useLigaFeedback();
  const [carregando, setCarregando] = useState(idCliente != null);
  const [salvando, setSalvando] = useState(false);
  const [excluindo, setExcluindo] = useState(false);
  const [campos, setCampos] = useState<Campos>(() => camposVazio());
  const [lookups, setLookups] = useState<LigaClienteLookups | null>(null);
  const [mapaEnderecoModalAberto, setMapaEnderecoModalAberto] = useState(false);
  const [baselineComparacao, setBaselineComparacao] = useState<string | null>(null);
  const [dialogoAlteracoesNaoSalvasAberto, setDialogoAlteracoesNaoSalvasAberto] =
    useState(false);
  const [dialogoConfirmarExclusaoAberto, setDialogoConfirmarExclusaoAberto] =
    useState(false);
  const cepViaCepAplicadoRef = useRef("");
  const geocodeResolvidoParaChaveRef = useRef<string | null>(null);
  const ehPf = campos.tipoPessoa === "F";
  const tenantPrincipal = idTenacidade === "1";

  useEffect(() => {
    const ac = new AbortController();
    fetch("/api/clientes/lookups", {
      credentials: "include",
      signal: ac.signal,
    })
      .then(async (r) => {
        if (!r.ok) throw new Error(`http_${r.status}`);
        return r.json() as Promise<LigaClienteLookups>;
      })
      .then((data) => setLookups(data))
      .catch((e: unknown) => {
        if (e instanceof DOMException && e.name === "AbortError") return;
        setLookups(null);
        feedback.aviso(t("avisoLookups"));
      });
    return () => ac.abort();
  }, [feedback, t]);

  const carregar = useCallback(async () => {
    if (!idCliente) {
      const vazio = camposVazio();
      setCampos(vazio);
      cepViaCepAplicadoRef.current = "";
      geocodeResolvidoParaChaveRef.current = null;
      setBaselineComparacao(serializarCamposParaComparacao(vazio));
      setCarregando(false);
      return;
    }
    setCarregando(true);
    setBaselineComparacao(null);
    try {
      const res = await fetch(`/api/clientes/${encodeURIComponent(idCliente)}`, {
        credentials: "include",
      });
      if (!res.ok) throw new Error();
      const json = (await res.json()) as { dados?: Record<string, unknown> };
      const carregado = jsonParaCampos(json.dados ?? {});
      setCampos(carregado);
      const serialBase = serializarCamposParaComparacao(carregado);
      setBaselineComparacao(serialBase);
      const cep8 = carregado.cep.replace(/\D/g, "").slice(0, 8);
      cepViaCepAplicadoRef.current = cep8.length === 8 ? cep8 : "";
      const latOk = parseCoordenadaDigitada(carregado.latitude);
      const lonOk = parseCoordenadaDigitada(carregado.longitude);
      geocodeResolvidoParaChaveRef.current =
        latOk != null && lonOk != null
          ? chaveEnderecoInfotimeParaGeocode({
              cep: carregado.cep,
              tipoLogradouro: carregado.tipoLogradouro,
              logradouro: carregado.logradouro,
              numero: carregado.numero,
              complemento: carregado.complemento,
              bairro: carregado.bairro,
              cidade: carregado.cidade,
              estado: carregado.estado,
            })
          : null;
    } catch {
      feedback.erroDetalhado(t("erroCarregar"));
      aoVoltar();
    } finally {
      setCarregando(false);
    }
  }, [aoVoltar, feedback, idCliente, t]);

  useEffect(() => {
    void carregar();
  }, [carregar]);

  const formularioEstaSujo = useMemo(() => {
    if (carregando || baselineComparacao === null) return false;
    return serializarCamposParaComparacao(campos) !== baselineComparacao;
  }, [campos, carregando, baselineComparacao]);

  const dropdownOpts = useMemo(() => {
    const mapOp = (items: { id: string; descricao?: string | null; rotulo?: string | null }[]) =>
      items.map((x) => ({
        label: x.descricao ?? x.rotulo ?? x.id,
        value: x.id,
      }));
    if (!lookups) {
      return {
        situacoes: [] as { label: string; value: string }[],
        tipos: [] as { label: string; value: string }[],
        contas: [] as { label: string; value: string }[],
        canais: [] as { label: string; value: string }[],
        concorrentes: [] as { label: string; value: string }[],
        municipios: [] as { label: string; value: string }[],
        regioes: [] as { label: string; value: string }[],
      };
    }
    return {
      situacoes: mapOp(lookups.situacoesCliente),
      tipos: mapOp(lookups.tiposCliente),
      contas: mapOp(lookups.contasCaixa),
      canais: mapOp(lookups.canais),
      concorrentes: mapOp(lookups.concorrentes),
      municipios: mapOp(lookups.municipios),
      regioes: mapOp(lookups.regioesEstaduais),
    };
  }, [lookups]);

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

  /**
   * PrimeReact InputMask por vezes só consolida o valor no DOM ao sair do campo.
   * `flushSync` garante que `campos.cep` e os efeitos (ViaCEP + Nominatim) vejam o CEP imediatamente,
   * espelhando o fluxo estável do `ClienteFormulario` em infolab-dst-app.
   */
  const aoSairDoCampoCep = useCallback((valorMascarado: string) => {
    const digitos = String(valorMascarado ?? "")
      .replace(/\D/g, "")
      .slice(0, 8);
    flushSync(() => {
      setCampos((prev) => (digitos === prev.cep ? prev : { ...prev, cep: digitos }));
    });
  }, []);

  /** ViaCEP ao digitar 8 dígitos (mesmo fluxo do infolab-dst-app). */
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
        .then((r) => r.json())
        .then((data: { erro?: boolean; logradouro?: string; complemento?: string; bairro?: string; localidade?: string; uf?: string }) => {
          if (!data || data.erro === true) {
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
            if (atual !== digitos) {
              return prev;
            }
            /** Novo CEP → endereço mudou; coords antigas não correspondem mais à chave de geocode. */
            geocodeResolvidoParaChaveRef.current = null;
            cepViaCepAplicadoRef.current = digitos;
            const rawLogradouro = (data.logradouro ?? "").trim();
            const { tipo: tipoViacep, nome: nomeViacep } =
              separarTipoENomeLogradouroViacep(rawLogradouro);
            const tipoLogradouroViacep =
              tipoViacep && nomeViacep.trim()
                ? tipoViacep.toUpperCase()
                : prev.tipoLogradouro;
            const logradouroViacep =
              rawLogradouro
                ? tipoViacep && nomeViacep.trim()
                  ? nomeViacep.toUpperCase()
                  : rawLogradouro.toUpperCase()
                : prev.logradouro;
            const next = {
              ...prev,
              tipoLogradouro: tipoLogradouroViacep,
              logradouro: logradouroViacep,
              bairro: (data.bairro ?? "").trim()
                ? (data.bairro ?? "").trim().toUpperCase()
                : prev.bairro,
              cidade: (data.localidade ?? "").trim()
                ? (data.localidade ?? "").trim().toUpperCase()
                : prev.cidade,
              estado: (data.uf ?? prev.estado).trim().toUpperCase().slice(0, 2),
              complemento:
                data.complemento?.trim() && !prev.complemento.trim()
                  ? data.complemento.trim()
                  : prev.complemento,
              latitude: "",
              longitude: "",
            };
            /** Baseline acompanha preenchimento automático ViaCEP (evita falso «sujo» ao voltar). */
            queueMicrotask(() => {
              setBaselineComparacao(serializarCamposParaComparacao(next));
            });
            return next;
          });
        })
        .catch((err: unknown) => {
          if (process.env.NODE_ENV === "development") {
            console.warn("[ViaCEP cliente]", err);
          }
        });
    }, 450);
    return () => {
      window.clearTimeout(atraso);
      ac.abort();
    };
  }, [campos.cep]);

  /**
   * Geocodificação via Nominatim — mesma regra de `ClienteFormulario` (infolab-dst-apps):
   * sem consultas espera o endereço ficar completo (não invalida a ref de geocode);
   * coordenadas já exibidas sem ref → marca chave para não disparar falso positivo;
   * chave já resolvida com coordenadas → não refaz; senão consulta em cadeia.
   */
  useEffect(() => {
    if (consultasNominatim.length === 0) {
      /** Não zerar `geocodeResolvidoParaChaveRef` aqui: com CEP incompleto as consultas somem,
       *  mas coords antigas + ref null faziam o seed marcar a chave nova sem chamar o Nominatim. */
      return;
    }
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
            const res = await fetch(
              `/api/geo/nominatim?q=${encodeURIComponent(q)}`,
              { signal: ac.signal, credentials: "include", cache: "no-store" },
            );
            if (!res.ok) continue;
            const j = (await res.json()) as { lat?: number | null; lon?: number | null };
            if (j.lat == null || j.lon == null) continue;
            setCampos((prev) => {
              const cepAtual = prev.cep.replace(/\D/g, "").slice(0, 8);
              if (cepAtual !== cepAgendadoGeocode) {
                return prev;
              }
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
              const next = {
                ...prev,
                latitude: String(j.lat),
                longitude: String(j.lon),
              };
              /** Baseline acompanha geocode Nominatim (evita falso «sujo» ao voltar sem editar). */
              queueMicrotask(() => {
                setBaselineComparacao(serializarCamposParaComparacao(next));
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

  const persistirCliente = useCallback(async (): Promise<ResultadoPersistirCliente> => {
    if (!campos.razaoSocial.trim() || !campos.nomeFantasia.trim()) {
      feedback.aviso(t("validacaoCabecalho"));
      return { ok: false };
    }
    if (!campos.idSituacaoCliente.trim() || !campos.idContaCaixa.trim()) {
      feedback.aviso(t("validacaoAbasObrigatorias"));
      return { ok: false };
    }
    const situacaoNumVal = Number(campos.idSituacaoCliente);
    const docObrigatorioVal = situacaoNumVal !== 3 && Number.isFinite(situacaoNumVal);
    if (docObrigatorioVal && campos.cnpj.replace(/\D/g, "").length === 0) {
      feedback.aviso(t("validacaoDocumento"));
      return { ok: false };
    }

    const payload = montarPayload(campos);
    setSalvando(true);
    try {
      if (idCliente) {
        const res = await fetch(`/api/clientes/${encodeURIComponent(idCliente)}`, {
          method: "PUT",
          credentials: "include",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload),
        });
        const corpo = await res.text();
        if (!res.ok) {
          const det = extrairMensagemErroApiJson(corpo);
          if (det) {
            feedback.erroDetalhado(tFeedback("erroSalvar"), det);
          } else {
            feedback.erroSalvar();
          }
          return { ok: false };
        }
        return { ok: true, msgKey: "salvo", idParaSalvo: idCliente };
      }

      const res = await fetch("/api/clientes", {
        method: "POST",
        credentials: "include",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const corpo = await res.text();
      if (!res.ok) {
        const det = extrairMensagemErroApiJson(corpo);
        if (det) {
          feedback.erroDetalhado(tFeedback("erroSalvar"), det);
        } else {
          feedback.erroSalvar();
        }
        return { ok: false };
      }
      let json: { id?: string };
      try {
        json = JSON.parse(corpo) as { id?: string };
      } catch {
        feedback.erroJsonParse();
        return { ok: false };
      }
      const idNovo = json.id?.trim() ? json.id.trim() : null;
      return { ok: true, msgKey: "criado", idParaSalvo: idNovo };
    } catch {
      feedback.erroSalvar();
      return { ok: false };
    } finally {
      setSalvando(false);
    }
  }, [campos, idCliente, feedback, t, tFeedback]);

  const aplicarSucessoPersistencia = useCallback(
    (r: Extract<ResultadoPersistirCliente, { ok: true }>, antesDeNavegar?: () => void) => {
      feedback.sucessoMensagem(t(r.msgKey));
      antesDeNavegar?.();
      if (r.idParaSalvo) aoSalvo(r.idParaSalvo);
      else aoVoltar();
    },
    [aoSalvo, aoVoltar, feedback, t],
  );

  const aoSalvar = useCallback(
    () =>
      executarComPrecheckSessao(
        async () => {
          const r = await persistirCliente();
          if (r.ok) aplicarSucessoPersistencia(r);
        },
        (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
      ),
    [aplicarSucessoPersistencia, persistirCliente],
  );

  const salvarEVoltarDoDialogo = useCallback(
    () =>
      executarComPrecheckSessao(
        async () => {
          const r = await persistirCliente();
          if (r.ok) {
            aplicarSucessoPersistencia(r, () =>
              setDialogoAlteracoesNaoSalvasAberto(false),
            );
          }
        },
        (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
      ),
    [aplicarSucessoPersistencia, persistirCliente],
  );

  const tentarVoltar = useCallback(() => {
    if (!formularioEstaSujo) {
      aoVoltar();
      return;
    }
    setDialogoAlteracoesNaoSalvasAberto(true);
  }, [formularioEstaSujo, aoVoltar]);

  const aoEsconderDialogoPendencia = useCallback(() => {
    if (salvando) return;
    setDialogoAlteracoesNaoSalvasAberto(false);
  }, [salvando]);

  const aoGerarChave = () =>
    executarComPrecheckSessao(async () => {
      if (!idCliente || !tenantPrincipal) return;
      try {
        const res = await fetch(
          `/api/clientes/${encodeURIComponent(idCliente)}/gerar-chave`,
          { method: "POST", credentials: "include" },
        );
        if (!res.ok) throw new Error();
        const j = (await res.json()) as { chaveAcesso?: string };
        setCampos((p) => ({ ...p, chaveAcesso: j.chaveAcesso ?? p.chaveAcesso }));
        feedback.sucessoMensagem(t("chaveGerada"));
      } catch {
        feedback.erroDetalhado(t("erroGerarChave"));
      }
    }, (acaoPendente) =>
      solicitarReautenticacaoGlobal(() => void acaoPendente()),
    );

  const executarExclusaoCliente = useCallback(async () => {
    if (!idCliente) return;
    setExcluindo(true);
    try {
      const res = await fetch(`/api/clientes/${encodeURIComponent(idCliente)}`, {
        method: "DELETE",
        credentials: "include",
      });
      if (!res.ok) {
        feedback.erroDetalhado(t("erroExcluir"));
        return;
      }
      setDialogoConfirmarExclusaoAberto(false);
      feedback.sucessoMensagem(t("excluido"));
      aoVoltar();
    } catch {
      feedback.erroDetalhado(t("erroExcluir"));
    } finally {
      setExcluindo(false);
    }
  }, [idCliente, aoVoltar, feedback, t]);

  const confirmarExclusaoNoDialogo = useCallback(
    () =>
      executarComPrecheckSessao(
        () => void executarExclusaoCliente(),
        (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
      ),
    [executarExclusaoCliente],
  );

  const aoClicarBotaoExcluir = useCallback(() => {
    if (!idCliente) return;
    setDialogoConfirmarExclusaoAberto(true);
  }, [idCliente]);

  const aoEsconderDialogoExclusao = useCallback(() => {
    if (excluindo) return;
    setDialogoConfirmarExclusaoAberto(false);
  }, [excluindo]);

  const labelRazao = ehPf ? t("labelNome") : t("labelRazaoSocial");
  const labelFantasia = ehPf ? t("labelNomeSocial") : t("labelNomeFantasia");
  const labelIe = ehPf ? t("labelRg") : t("labelIe");
  const labelIm = ehPf ? t("labelMatricula") : t("labelIm");
  const labelDoc = ehPf ? t("labelCpf") : t("labelCnpj");

  const situacaoNum = Number(campos.idSituacaoCliente);
  const docObrigatorioUi = situacaoNum !== 3 && Number.isFinite(situacaoNum);
  const situacaoSelecionada = useMemo(
    () =>
      dropdownOpts.situacoes.find((x) => x.value === campos.idSituacaoCliente)?.label?.trim() ??
      "",
    [dropdownOpts.situacoes, campos.idSituacaoCliente],
  );
  const docTitulo = formatarDocumentoTitulo(campos.cnpj);

  const secoesFormulario = useMemo(
    () =>
      criarSecoesFormularioClienteInfotime({
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
        labelRazao,
        opcoesUf: OPCOES_UF_BRASIL_FORMULARIO,
        abrirMapaEnderecoModal: () => setMapaEnderecoModalAberto(true),
        aoSairDoCampoCep,
      }),
    [
      t,
      campos,
      ehPf,
      dropdownOpts,
      labelFantasia,
      labelDoc,
      labelIe,
      labelIm,
      labelRazao,
      tenantPrincipal,
      idCliente,
      docObrigatorioUi,
      aoSairDoCampoCep,
    ],
  );

  if (carregando) {
    return (
      <div className="liga-home-modulo-vazio" role="status">
        <p>{t("carregando")}</p>
      </div>
    );
  }

  const tituloFormulario = t("tituloCabecalho");
  const subtituloFormulario = idCliente
    ? t("subtituloCabecalhoEditar")
    : t("subtituloCabecalhoNovo");
  const sufixoTitulo = (
    <span
      className="liga-cliente-infotime-titulo-resumo liga-cliente-infotime-titulo-resumo--faixa"
      aria-label={t("cabecalhoResumoAria")}
    >
      {idCliente ? (
        <span className="liga-cliente-infotime-titulo-item">
          <i className="pi pi-tag liga-cliente-infotime-titulo-item-icone" aria-hidden />
          <span className="liga-cliente-infotime-titulo-chip liga-cliente-infotime-titulo-chip--id">
            {idCliente}
          </span>
        </span>
      ) : null}
      <span className="liga-cliente-infotime-titulo-item">
        <i className="pi pi-briefcase liga-cliente-infotime-titulo-item-icone" aria-hidden />
        <span className="liga-cliente-infotime-titulo-texto liga-cliente-infotime-titulo-texto--fantasia">
          {campos.nomeFantasia.trim() || "—"}
        </span>
      </span>
      {docTitulo ? (
        <span className="liga-cliente-infotime-titulo-item">
          <i className="pi pi-id-card liga-cliente-infotime-titulo-item-icone" aria-hidden />
          <span className="liga-cliente-infotime-titulo-chip">{docTitulo}</span>
        </span>
      ) : null}
      {situacaoSelecionada ? (
        <span className="liga-cliente-infotime-titulo-item liga-cliente-infotime-titulo-item--situacao">
          <span
            className={`liga-padrao-badge liga-cliente-infotime-situacao-badge liga-cliente-infotime-situacao-badge--${normalizarSituacaoTag(situacaoSelecionada)}`}
          >
            {situacaoSelecionada}
          </span>
        </span>
      ) : null}
    </span>
  );

  const latDialog = parseCoordenadaDigitada(campos.latitude);
  const lonDialog = parseCoordenadaDigitada(campos.longitude);

  return (
    <section
      className={`liga-cliente-infotime-form${idCliente ? "" : " liga-cliente-infotime-form--inclusao"}`}
      style={{ padding: "0.5rem 0 1rem" }}
    >
      <Dialog
        visible={dialogoAlteracoesNaoSalvasAberto}
        onHide={aoEsconderDialogoPendencia}
        header={t("pendenciaVoltarTitulo")}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
        closable={!salvando}
        dismissableMask={!salvando}
        draggable={false}
        footer={
          <div className="liga-mensagem-pop-up-rodape liga-cliente-infotime-dialogo-pendencia-rodape">
            <Button
              type="button"
              label={t("pendenciaVoltarContinuarEditando")}
              severity="secondary"
              outlined
              rounded
              className="liga-mensagem-pop-up-botao-secundario"
              disabled={salvando}
              onClick={aoEsconderDialogoPendencia}
            />
            <Button
              type="button"
              label={t("pendenciaVoltarDescartar")}
              severity="danger"
              outlined
              rounded
              disabled={salvando}
              onClick={() => {
                setDialogoAlteracoesNaoSalvasAberto(false);
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
              onClick={() => void salvarEVoltarDoDialogo()}
            />
          </div>
        }
      >
        <p className="liga-mensagem-pop-up-texto">{t("pendenciaVoltarMensagem")}</p>
      </Dialog>
      <Dialog
        visible={dialogoConfirmarExclusaoAberto}
        onHide={aoEsconderDialogoExclusao}
        header={t("dialogoExcluirTitulo")}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
        closable={!excluindo}
        dismissableMask={!excluindo}
        draggable={false}
        footer={
          <div className="liga-mensagem-pop-up-rodape liga-cliente-infotime-dialogo-exclusao-rodape">
            <Button
              type="button"
              label={t("dialogoExcluirCancelar")}
              severity="secondary"
              outlined
              rounded
              className="liga-mensagem-pop-up-botao-secundario"
              disabled={excluindo}
              onClick={aoEsconderDialogoExclusao}
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
              onClick={() => void confirmarExclusaoNoDialogo()}
            />
          </div>
        }
      >
        <p className="liga-mensagem-pop-up-texto">{t("dialogoExcluirMensagem")}</p>
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
            lat={latDialog}
            lon={lonDialog}
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
        barraAcoes={
          <div className="liga-cliente-infotime-form-barra-acoes">
            <Button
              type="button"
              label={t("voltar")}
              icon="pi pi-arrow-left"
              severity="secondary"
              outlined
              onClick={tentarVoltar}
            />
            {tenantPrincipal ? (
              <>
                <Button
                  type="button"
                  label={t("gerarChave")}
                  icon="pi pi-key"
                  outlined
                  disabled={
                    !idCliente ||
                    situacaoNum !== 1 ||
                    (campos.chaveAcesso ?? "").trim().length >= 5
                  }
                  onClick={() => void aoGerarChave()}
                />
                <Button
                  type="button"
                  label={t("licencaToolbar")}
                  icon="pi pi-file"
                  outlined
                  severity="secondary"
                  disabled={!idCliente || (campos.chaveAcesso ?? "").trim().length <= 5}
                  onClick={() => feedback.aviso(t("downloadLicencaIndisponivel"))}
                />
              </>
            ) : null}
            <span className="liga-cliente-infotime-form-barra-acoes-empurra" aria-hidden />
            <Button
              type="button"
              label={t("salvar")}
              icon="pi pi-save"
              loading={salvando}
              onClick={() => void aoSalvar()}
            />
            {idCliente ? (
              <Button
                type="button"
                label={t("excluir")}
                icon="pi pi-trash"
                severity="danger"
                outlined
                title={t("excluir")}
                loading={excluindo}
                disabled={salvando}
                onClick={aoClicarBotaoExcluir}
              />
            ) : null}
          </div>
        }
        temLegendaCamposObrigatorios
        secoes={secoesFormulario}
        secaoInicialId="identificacao"
      />
    </section>
  );
}
