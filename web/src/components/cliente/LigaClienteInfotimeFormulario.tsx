"use client";

import { useCallback, useEffect, useMemo, useRef, useState } from "react";
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
  chaveEnderecoInfotimeParaGeocode,
  consultasNominatimInfotime,
} from "@/domain/cliente-infotime/nominatim-consulta";
import { OPCOES_UF_BRASIL_FORMULARIO } from "@/domain/cliente-infotime/ufs-brasil";

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

const SN_OPTS = [
  { label: "Sim", value: "S" },
  { label: "Não", value: "N" },
];

function parseCoordenadaDigitada(raw: string): number | null {
  const s = raw.trim().replace(",", ".");
  if (s === "") return null;
  const n = Number.parseFloat(s);
  return Number.isFinite(n) ? n : null;
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
  const [campos, setCampos] = useState<Campos>(() => camposVazio());
  const [lookups, setLookups] = useState<LigaClienteLookups | null>(null);
  const [mapaEnderecoModalAberto, setMapaEnderecoModalAberto] = useState(false);
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
      setCampos(camposVazio());
      cepViaCepAplicadoRef.current = "";
      geocodeResolvidoParaChaveRef.current = null;
      setCarregando(false);
      return;
    }
    setCarregando(true);
    try {
      const res = await fetch(`/api/clientes/${encodeURIComponent(idCliente)}`, {
        credentials: "include",
      });
      if (!res.ok) throw new Error();
      const json = (await res.json()) as { dados?: Record<string, unknown> };
      const carregado = jsonParaCampos(json.dados ?? {});
      setCampos(carregado);
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
          if (!data || data.erro === true) return;
          cepViaCepAplicadoRef.current = digitos;
          geocodeResolvidoParaChaveRef.current = null;
          setCampos((prev) => ({
            ...prev,
            logradouro: (data.logradouro ?? "").trim()
              ? (data.logradouro ?? "").trim().toUpperCase()
              : prev.logradouro,
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
          }));
        })
        .catch(() => {});
    }, 450);
    return () => {
      window.clearTimeout(atraso);
      ac.abort();
    };
  }, [campos.cep]);

  /** Geocodificação via Nominatim (proxy `/api/geo/nominatim`), espelhando infolab-dst-app. */
  useEffect(() => {
    if (consultasNominatim.length === 0) {
      return;
    }
    const latOk = parseCoordenadaDigitada(campos.latitude);
    const lonOk = parseCoordenadaDigitada(campos.longitude);
    const temCoord = latOk != null && lonOk != null;
    if (temCoord && geocodeResolvidoParaChaveRef.current === chaveGeocodeEndereco) {
      return;
    }

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
            geocodeResolvidoParaChaveRef.current = chaveGeocodeEndereco;
            setCampos((prev) => ({
              ...prev,
              latitude: String(j.lat),
              longitude: String(j.lon),
            }));
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

  const aoSalvar = () =>
    executarComPrecheckSessao(async () => {
      if (!campos.razaoSocial.trim() || !campos.nomeFantasia.trim()) {
        feedback.aviso(t("validacaoCabecalho"));
        return;
      }
      if (!campos.idSituacaoCliente.trim() || !campos.idContaCaixa.trim()) {
        feedback.aviso(t("validacaoAbasObrigatorias"));
        return;
      }
      const situacaoNum = Number(campos.idSituacaoCliente);
      const docObrigatorio = situacaoNum !== 3 && Number.isFinite(situacaoNum);
      if (docObrigatorio && campos.cnpj.replace(/\D/g, "").length === 0) {
        feedback.aviso(t("validacaoDocumento"));
        return;
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
            return;
          }
          feedback.sucessoMensagem(t("salvo"));
          aoSalvo(idCliente);
        } else {
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
            return;
          }
          let json: { id?: string };
          try {
            json = JSON.parse(corpo) as { id?: string };
          } catch {
            feedback.erroJsonParse();
            return;
          }
          feedback.sucessoMensagem(t("criado"));
          if (json.id) aoSalvo(json.id);
          else aoVoltar();
        }
      } catch {
        feedback.erroSalvar();
      } finally {
        setSalvando(false);
      }
    }, (acaoPendente) =>
      solicitarReautenticacaoGlobal(() => void acaoPendente()),
    );

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

  const labelRazao = ehPf ? t("labelNome") : t("labelRazaoSocial");
  const labelFantasia = ehPf ? t("labelNomeSocial") : t("labelNomeFantasia");
  const labelIe = ehPf ? t("labelRg") : t("labelIe");
  const labelIm = ehPf ? t("labelMatricula") : t("labelIm");
  const labelDoc = ehPf ? t("labelCpf") : t("labelCnpj");

  const situacaoNum = Number(campos.idSituacaoCliente);
  const docObrigatorioUi = situacaoNum !== 3 && Number.isFinite(situacaoNum);

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
        snOpts: SN_OPTS,
        labelRazao,
        opcoesUf: OPCOES_UF_BRASIL_FORMULARIO,
        abrirMapaEnderecoModal: () => setMapaEnderecoModalAberto(true),
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
    ],
  );

  if (carregando) {
    return (
      <div className="liga-home-modulo-vazio" role="status">
        <p>{t("carregando")}</p>
      </div>
    );
  }

  const tituloFormulario = idCliente ? t("tituloEditar") : t("tituloNovo");
  const latDialog = parseCoordenadaDigitada(campos.latitude);
  const lonDialog = parseCoordenadaDigitada(campos.longitude);

  return (
    <section className="liga-cliente-infotime-form" style={{ padding: "0.5rem 0 1rem" }}>
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
            lat={latDialog}
            lon={lonDialog}
            mensagemSemCoordenadas={t("mapaSemCoordenadas")}
          />
        </div>
      </Dialog>
      <LigaFormularioBase
        titulo={tituloFormulario}
        iconeTitulo="pi-users"
        tituloComBarraVerde
        barraAcoes={
          <div className="liga-cliente-infotime-form-barra-acoes">
            <Button
              type="button"
              label={t("voltar")}
              severity="secondary"
              outlined
              onClick={aoVoltar}
            />
            {tenantPrincipal ? (
              <>
                <Button
                  type="button"
                  label={t("gerarChave")}
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
                  label={t("downloadCurto")}
                  outlined
                  severity="secondary"
                  disabled={!idCliente || (campos.chaveAcesso ?? "").trim().length <= 5}
                  onClick={() => feedback.aviso(t("downloadLicencaIndisponivel"))}
                />
                <Button
                  type="button"
                  label={t("licencaToolbar")}
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
              loading={salvando}
              onClick={() => void aoSalvar()}
            />
          </div>
        }
        temLegendaCamposObrigatorios
        secoes={secoesFormulario}
        secaoInicialId="identificacao"
      />
    </section>
  );
}
