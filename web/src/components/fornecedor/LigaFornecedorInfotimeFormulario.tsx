"use client";

import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import { flushSync } from "react-dom";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";

import "@/components/cliente/liga-cliente-infotime.css";
import { ClienteInfotimeEnderecoMapaOsm } from "@/components/cliente/ClienteInfotimeEnderecoMapaOsm";
import { LigaFormularioBase } from "@/components/formulario-base/LigaFormularioBase";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import {
  cep8DaChaveGeocodeInfotime,
  chaveEnderecoInfotimeParaGeocode,
  consultasNominatimInfotime,
} from "@/domain/cliente-infotime/nominatim-consulta";
import { OPCOES_UF_BRASIL_FORMULARIO } from "@/domain/cliente-infotime/ufs-brasil";
import { separarTipoENomeLogradouroViacep } from "@/domain/cliente-infotime/viacep-logradouro";
import {
  executarComPrecheckSessao,
  solicitarReautenticacaoGlobal,
} from "@/lib/autenticacao/withSessionGuard";
import { traduzirErrosValidacaoParaFormulario } from "@/lib/validacao-api-i18n";
import { valorSnParaSwitch } from "@/lib/valor-sn-para-switch";

import { criarSecoesFormularioFornecedorInfotime } from "./liga-fornecedor-infotime-formulario-secoes";
import "./liga-fornecedor-infotime.css";

type Props = {
  idFornecedor: string | null;
  aoVoltar: () => void;
  aoSalvo: (id: string) => void;
};

export type CamposFornecedor = {
  tipoPessoa: string;
  fabricante: boolean;
  razaoSocial: string;
  nomeFantasia: string;
  idSituacaoFornecedor: string;
  telefone: string;
  celular: string;
  email: string;
  contatos: string;
  homepage: string;
  cnpj: string;
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
  numeroAntigo: string;
};

function camposVazio(): CamposFornecedor {
  return {
    tipoPessoa: "J",
    fabricante: false,
    razaoSocial: "",
    nomeFantasia: "",
    idSituacaoFornecedor: "",
    telefone: "",
    celular: "",
    email: "",
    contatos: "",
    homepage: "",
    cnpj: "",
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
    numeroAntigo: "",
  };
}

function str(v: unknown): string {
  if (v === null || v === undefined) return "";
  return String(v);
}

function parseCoordenadaDigitada(raw: string): number | null {
  const s = raw.trim().replace(",", ".");
  if (s === "") return null;
  const n = Number.parseFloat(s);
  return Number.isFinite(n) ? n : null;
}

function coordenadaParaComparacao(raw: string): string {
  const n = parseCoordenadaDigitada(raw);
  if (n == null) return "";
  return String(Math.round(n * 1e6) / 1e6);
}

function jsonParaCampos(dados: Record<string, unknown>): CamposFornecedor {
  const c = camposVazio();
  c.tipoPessoa = str(dados.tipo_pessoa || dados.tipoPessoa || "J").toUpperCase().slice(0, 1) || "J";
  c.fabricante = valorSnParaSwitch(dados.fabricante);
  c.razaoSocial = str(dados.razao_social ?? dados.razaoSocial);
  c.nomeFantasia = str(dados.nome_fantasia ?? dados.nomeFantasia);
  c.idSituacaoFornecedor = str(dados.id_situacao_fornecedor ?? dados.idSituacaoFornecedor);
  c.telefone = str(dados.telefone);
  c.celular = str(dados.celular);
  c.email = str(dados.email);
  c.contatos = str(dados.contatos);
  c.homepage = str(dados.home_page ?? dados.homepage);
  c.cnpj = str(dados.cnpj);
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
  c.observacoes = str(dados.observacoes);
  c.numeroAntigo = str(dados.numero_antigo ?? dados.numeroAntigo);
  return c;
}

function montarPayload(campos: CamposFornecedor): Record<string, unknown> {
  const opcNum = (s: string) => (s.trim() === "" ? undefined : Number.parseInt(s, 10));
  return {
    tipoPessoa: campos.tipoPessoa,
    fabricante: campos.fabricante,
    razaoSocial: campos.razaoSocial.trim(),
    nomeFantasia: campos.nomeFantasia.trim(),
    cnpj: campos.cnpj.replace(/\D/g, "").trim() || campos.cnpj.trim(),
    idSituacaoFornecedor: opcNum(campos.idSituacaoFornecedor),
    telefone: campos.telefone.trim() || undefined,
    celular: campos.celular.trim() || undefined,
    email: campos.email.trim() || undefined,
    contatos: campos.contatos.trim() || undefined,
    homepage: campos.homepage.trim() || undefined,
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
    observacoes: campos.observacoes.trim() || undefined,
  };
}

function serializarComparacao(c: CamposFornecedor): string {
  return JSON.stringify({
    ...c,
    latitude: coordenadaParaComparacao(c.latitude),
    longitude: coordenadaParaComparacao(c.longitude),
  });
}

function formatarDocumentoTitulo(doc: string): string {
  const d = doc.replace(/\D/g, "");
  if (d.length === 11) return d.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
  if (d.length === 14) return d.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
  return doc.trim();
}

export function LigaFornecedorInfotimeFormulario({
  idFornecedor,
  aoVoltar,
  aoSalvo,
}: Props) {
  const t = useTranslations("home.fornecedorInfotime.formulario");
  const tValidacao = useTranslations("home.validation");
  const tFeedback = useTranslations("home.feedback");
  const feedback = useLigaFeedback();

  const [carregando, setCarregando] = useState(idFornecedor != null);
  const [salvando, setSalvando] = useState(false);
  const [excluindo, setExcluindo] = useState(false);
  const [campos, setCampos] = useState<CamposFornecedor>(() => camposVazio());
  const [situacoes, setSituacoes] = useState<{ id: string; descricao: string | null }[]>([]);
  const [baseline, setBaseline] = useState<string | null>(null);
  const [dialogoPendencia, setDialogoPendencia] = useState(false);
  const [dialogoExcluir, setDialogoExcluir] = useState(false);
  const [mapaEnderecoModalAberto, setMapaEnderecoModalAberto] = useState(false);
  const cepViaCepAplicadoRef = useRef("");
  const geocodeResolvidoParaChaveRef = useRef<string | null>(null);

  const ehPf = campos.tipoPessoa === "F";
  const labelRazao = ehPf ? t("labelNome") : t("labelRazaoSocial");
  const labelFantasia = ehPf ? t("labelApelido") : t("labelNomeFantasia");
  const labelDoc = ehPf ? t("labelCpf") : t("labelCnpj");

  useEffect(() => {
    const ac = new AbortController();
    fetch("/api/fornecedores/situacoes-fornecedor", { signal: ac.signal, cache: "no-store" })
      .then(async (r) => {
        if (!r.ok) throw new Error();
        return r.json() as Promise<{ id: string; descricao: string | null }[]>;
      })
      .then(setSituacoes)
      .catch(() => setSituacoes([]));
    return () => ac.abort();
  }, []);

  const optsSituacao = useMemo(
    () =>
      situacoes.map((x) => ({
        label: x.descricao ?? x.id,
        value: x.id,
      })),
    [situacoes],
  );

  const carregar = useCallback(async () => {
    if (!idFornecedor) {
      const v = camposVazio();
      setCampos(v);
      setBaseline(serializarComparacao(v));
      cepViaCepAplicadoRef.current = "";
      geocodeResolvidoParaChaveRef.current = null;
      setCarregando(false);
      return;
    }
    setCarregando(true);
    setBaseline(null);
    try {
      const res = await fetch(`/api/fornecedores/${encodeURIComponent(idFornecedor)}`, {
        cache: "no-store",
      });
      if (!res.ok) throw new Error();
      const json = (await res.json()) as { dados?: Record<string, unknown> };
      const carregado = jsonParaCampos(json.dados ?? {});
      setCampos(carregado);
      setBaseline(serializarComparacao(carregado));
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
  }, [aoVoltar, feedback, idFornecedor, t]);

  useEffect(() => {
    void carregar();
  }, [carregar]);

  const sujo = useMemo(() => {
    if (carregando || baseline === null) return false;
    return serializarComparacao(campos) !== baseline;
  }, [campos, carregando, baseline]);

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
        .then((r) => r.json())
        .then(
          (data: {
            erro?: boolean;
            logradouro?: string;
            complemento?: string;
            bairro?: string;
            localidade?: string;
            uf?: string;
          }) => {
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
              geocodeResolvidoParaChaveRef.current = null;
              cepViaCepAplicadoRef.current = digitos;
              const rawLogradouro = (data.logradouro ?? "").trim();
              const { tipo: tipoViacep, nome: nomeViacep } =
                separarTipoENomeLogradouroViacep(rawLogradouro);
              const tipoLogradouroViacep =
                tipoViacep && nomeViacep.trim()
                  ? tipoViacep.toUpperCase()
                  : prev.tipoLogradouro;
              const logradouroViacep = rawLogradouro
                ? tipoViacep && nomeViacep.trim()
                  ? nomeViacep.toUpperCase()
                  : rawLogradouro.toUpperCase()
                : prev.logradouro;
              const next: CamposFornecedor = {
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
              queueMicrotask(() => {
                setBaseline(serializarComparacao(next));
              });
              return next;
            });
          },
        )
        .catch((err: unknown) => {
          if (process.env.NODE_ENV === "development") {
            console.warn("[ViaCEP fornecedor]", err);
          }
        });
    }, 450);
    return () => {
      ac.abort();
      window.clearTimeout(atraso);
    };
  }, [campos.cep]);

  useEffect(() => {
    if (consultasNominatim.length === 0) {
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
              const next: CamposFornecedor = {
                ...prev,
                latitude: String(j.lat),
                longitude: String(j.lon),
              };
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
    if (!campos.razaoSocial.trim()) e.razaoSocial = t("obrigatorio");
    if (!campos.nomeFantasia.trim()) e.nomeFantasia = t("obrigatorio");
    const digDoc = campos.cnpj.replace(/\D/g, "");
    const minDig = ehPf ? 11 : 14;
    if (digDoc.length < minDig) e.cnpj = t("obrigatorioCnpj");
    if (!campos.idSituacaoFornecedor.trim()) e.idSituacaoFornecedor = t("obrigatorio");
    return Object.keys(e).length ? e : null;
  }, [campos, ehPf, t]);

  const salvar = useCallback(async () => {
    const errosLocais = validar();
    if (errosLocais) {
      feedback.aviso(tFeedback("toastValidacaoCampos"));
      return;
    }
    setSalvando(true);
    try {
      const corpo = montarPayload(campos);
      const url = idFornecedor
        ? `/api/fornecedores/${encodeURIComponent(idFornecedor)}`
        : "/api/fornecedores";
      const method = idFornecedor ? "PUT" : "POST";
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
      if (idFornecedor) {
        aoSalvo(idFornecedor);
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
    idFornecedor,
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
    if (!idFornecedor) return;
    setExcluindo(true);
    try {
      const res = await fetch(`/api/fornecedores/${encodeURIComponent(idFornecedor)}`, {
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
  }, [aoVoltar, feedback, idFornecedor, t]);

  const abrirMapaEnderecoModal = useCallback(() => {
    setMapaEnderecoModalAberto(true);
  }, []);

  const situacaoSelecionada = useMemo(
    () =>
      optsSituacao.find((x) => x.value === campos.idSituacaoFornecedor)?.label?.trim() ?? "",
    [optsSituacao, campos.idSituacaoFornecedor],
  );

  const docTitulo = formatarDocumentoTitulo(campos.cnpj);

  const secoesFormulario = useMemo(
    () =>
      criarSecoesFormularioFornecedorInfotime({
        t,
        campos,
        setCampos,
        strValor: str,
        ehPf,
        labelRazao,
        labelFantasia,
        labelDoc,
        idFornecedor,
        optsSituacao,
        opcoesUf: OPCOES_UF_BRASIL_FORMULARIO,
        aoSairDoCampoCep,
        abrirMapaEnderecoModal,
      }),
    [
      t,
      campos,
      ehPf,
      labelRazao,
      labelFantasia,
      labelDoc,
      idFornecedor,
      optsSituacao,
      aoSairDoCampoCep,
      abrirMapaEnderecoModal,
    ],
  );

  const sufixoTitulo = (
    <span
      className="liga-cliente-infotime-titulo-resumo liga-cliente-infotime-titulo-resumo--faixa"
      aria-label={t("cabecalhoResumoAria")}
    >
      {idFornecedor ? (
        <span className="liga-cliente-infotime-titulo-item">
          <i className="pi pi-tag liga-cliente-infotime-titulo-item-icone" aria-hidden />
          <span className="liga-cliente-infotime-titulo-chip liga-cliente-infotime-titulo-chip--id">
            {idFornecedor}
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
          <span className="liga-padrao-badge liga-cliente-infotime-situacao-badge liga-cliente-infotime-situacao-badge--outro">
            {situacaoSelecionada}
          </span>
        </span>
      ) : null}
    </span>
  );

  if (carregando) {
    return (
      <div className="liga-home-modulo-vazio" role="status">
        <p>{t("carregando")}</p>
      </div>
    );
  }

  const tituloFormulario = t("tituloCabecalho");
  const subtituloFormulario = idFornecedor
    ? t("subtituloCabecalhoEditar")
    : t("subtituloCabecalhoNovo");

  const latDialog = parseCoordenadaDigitada(campos.latitude);
  const lonDialog = parseCoordenadaDigitada(campos.longitude);

  return (
    <section
      className={`liga-cliente-infotime-form liga-fornecedor-infotime-form${idFornecedor ? "" : " liga-cliente-infotime-form--inclusao"}`}
      style={{ padding: "0.5rem 0 1rem" }}
    >
      <Dialog
        visible={dialogoPendencia}
        onHide={() => !salvando && setDialogoPendencia(false)}
        header={t("pendenciaVoltarTitulo")}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
        closable={!salvando}
        footer={
          <div className="liga-mensagem-pop-up-rodape">
            <Button
              type="button"
              label={t("pendenciaVoltarContinuarEditando")}
              severity="secondary"
              outlined
              rounded
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
        visible={dialogoExcluir}
        onHide={() => !excluindo && setDialogoExcluir(false)}
        header={t("dialogoExcluirTitulo")}
        className="liga-mensagem-pop-up"
        style={{ width: "min(92vw, 32rem)" }}
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
              onClick={() =>
                void executarComPrecheckSessao(
                  () => void excluir(),
                  (acao) => solicitarReautenticacaoGlobal(() => void acao()),
                )
              }
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
        iconeTitulo="pi-truck"
        temLegendaCamposObrigatorios
        secaoInicialId="identificacao"
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
            <span className="liga-cliente-infotime-form-barra-acoes-empurra" aria-hidden />
            <Button
              type="button"
              label={t("salvar")}
              icon="pi pi-save"
              loading={salvando}
              onClick={() =>
                void executarComPrecheckSessao(
                  () => void salvar(),
                  (acao) => solicitarReautenticacaoGlobal(() => void acao()),
                )
              }
            />
            {idFornecedor ? (
              <Button
                type="button"
                label={t("excluir")}
                icon="pi pi-trash"
                severity="danger"
                outlined
                loading={excluindo}
                disabled={salvando}
                onClick={() => setDialogoExcluir(true)}
              />
            ) : null}
          </div>
        }
        secoes={secoesFormulario}
      />
    </section>
  );
}
