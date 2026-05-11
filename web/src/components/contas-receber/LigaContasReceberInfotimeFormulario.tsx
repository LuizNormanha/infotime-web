"use client";

import { useCallback, useEffect, useMemo, useState } from "react";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";

import "@/components/cliente/liga-cliente-infotime.css";
import { LigaFormularioBase } from "@/components/formulario-base/LigaFormularioBase";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import {
  executarComPrecheckSessao,
  solicitarReautenticacaoGlobal,
} from "@/lib/autenticacao/withSessionGuard";
import { traduzirErrosValidacaoParaFormulario } from "@/lib/validacao-api-i18n";

import { resolverRotuloAgenteExibicao } from "./contas-receber-agente-resolver";
import {
  type CamposContasReceber,
  criarSecoesFormularioContasReceberInfotime,
} from "./liga-contas-receber-infotime-formulario-secoes";
import "./liga-contas-receber-infotime.css";

const ID_SITUACAO_PAGO = "4";
const ID_SITUACAO_PAGO_PARCIAL = "24";

type Props = {
  idLancamentoReceita: string | null;
  aoVoltar: () => void;
  aoSalvo: (id: string) => void;
};

type LookupsJson = {
  situacoesDocumento?: { id: string; descricao: string | null }[];
  tiposAgente?: { id: string; descricao: string | null }[];
  empresasAtivas?: { id: string; rotulo: string }[];
  contasCaixa?: { id: string; descricao: string | null }[];
  tiposEspecie?: { id: string; descricao: string | null }[];
  planosConta?: { id: string; rotulo: string }[];
};

function str(v: unknown): string {
  if (v == null || v === undefined) return "";
  return String(v);
}

function isoDateOnly(v: unknown): string {
  if (v == null || v === undefined) return "";
  const d = new Date(typeof v === "string" || typeof v === "number" ? v : String(v));
  if (Number.isNaN(d.getTime())) return "";
  return d.toISOString().slice(0, 10);
}

function camposVazio(): CamposContasReceber {
  return {
    idTipoAgente: "2",
    agenteRotuloExibicao: "",
    idCliente: "",
    idFornecedor: "",
    idColaborador: "",
    idEmpresa: "",
    valorOriginal: "",
    valorPrevisao: "",
    dataPrevisao: "",
    idSituacaoDocumento: "",
    dataCompetencia: "",
    contaContabil: "",
    historico: "",
    idPlanoConta: "",
    idContaCaixa: "",
    valorRealizacao: "",
    dataRealizacao: "",
    idTipoEspecie: "",
    numeroDocumento: "",
    idNotaFiscal: "",
    notaFiscalNumero: "",
    valorAcrescimo: "",
    valorDesconto: "",
    valorMulta: "",
    valorJuros: "",
    dataBaixa: "",
    observacoes: "",
  };
}

function montarPayload(c: CamposContasReceber): Record<string, unknown> {
  const o: Record<string, unknown> = {
    idTipoAgente: c.idTipoAgente.trim(),
    valorPrevisao: c.valorPrevisao.trim(),
    dataPrevisao: c.dataPrevisao.trim(),
    idSituacaoDocumento: c.idSituacaoDocumento.trim(),
    idPlanoConta: c.idPlanoConta.trim(),
  };
  const te = c.idTipoEspecie.trim();
  if (c.idEmpresa.trim()) o.idEmpresa = c.idEmpresa.trim();
  if (c.valorOriginal.trim()) o.valorOriginal = c.valorOriginal.trim();
  if (c.dataCompetencia.trim()) o.dataCompetencia = c.dataCompetencia.trim();
  if (c.contaContabil.trim()) o.contaContabil = c.contaContabil.trim();
  if (c.historico.trim()) o.historico = c.historico.trim();
  if (c.idContaCaixa.trim()) o.idContaCaixa = c.idContaCaixa.trim();
  if (c.valorRealizacao.trim()) o.valorRealizacao = c.valorRealizacao.trim();
  if (c.dataRealizacao.trim()) o.dataRealizacao = c.dataRealizacao.trim();
  if (te) o.idTipoEspecie = te;
  if (c.numeroDocumento.trim()) o.numeroDocumento = c.numeroDocumento.trim();
  if (c.valorAcrescimo.trim()) o.valorAcrescimo = c.valorAcrescimo.trim();
  if (c.valorDesconto.trim()) o.valorDesconto = c.valorDesconto.trim();
  if (c.valorMulta.trim()) o.valorMulta = c.valorMulta.trim();
  if (c.valorJuros.trim()) o.valorJuros = c.valorJuros.trim();
  if (c.dataBaixa.trim()) o.dataBaixa = c.dataBaixa.trim();
  if (c.observacoes.trim()) o.observacoes = c.observacoes.trim();
  if (c.idNotaFiscal.trim()) o.idNotaFiscal = c.idNotaFiscal.trim();
  if (c.notaFiscalNumero.trim()) o.notaFiscal = c.notaFiscalNumero.trim();

  const ta = c.idTipoAgente.trim();
  if (ta === "1" && c.idCliente.trim()) o.idCliente = c.idCliente.trim();
  if (ta === "2" && c.idFornecedor.trim()) o.idFornecedor = c.idFornecedor.trim();
  if (ta === "3" && c.idColaborador.trim()) o.idColaborador = c.idColaborador.trim();
  return o;
}

function camposDeApi(d: Record<string, unknown>): CamposContasReceber {
  return {
    idTipoAgente: str(d.id_tipo_agente),
    agenteRotuloExibicao: "",
    idCliente: str(d.id_cliente),
    idFornecedor: str(d.id_fornecedor),
    idColaborador: str(d.id_colaborador),
    idEmpresa: str(d.id_empresa),
    valorOriginal: str(d.valor_original),
    valorPrevisao: str(d.valor_previsao),
    dataPrevisao: isoDateOnly(d.data_previsao),
    idSituacaoDocumento: str(d.id_situacao_documento),
    dataCompetencia: isoDateOnly(d.data_competencia),
    contaContabil: str(d.conta_contabil),
    historico: str(d.historico),
    idPlanoConta: str(d.id_plano_conta),
    idContaCaixa: str(d.id_conta_caixa),
    valorRealizacao: str(d.valor_realizacao),
    dataRealizacao: isoDateOnly(d.data_realizacao),
    idTipoEspecie: str(d.id_tipo_especie),
    numeroDocumento: str(d.numero_documento),
    idNotaFiscal: str(d.id_nota_fiscal),
    notaFiscalNumero: str(d.nota_fiscal),
    valorAcrescimo: str(d.valor_acrescimo),
    valorDesconto: str(d.valor_desconto),
    valorMulta: str(d.valor_multa),
    valorJuros: str(d.valor_juros),
    dataBaixa: isoDateOnly(d.data_baixa),
    observacoes: str(d.observacoes),
  };
}

export function LigaContasReceberInfotimeFormulario({
  idLancamentoReceita,
  aoVoltar,
  aoSalvo,
}: Props) {
  const t = useTranslations("home.contasReceberInfotime.formulario");
  const tFeedback = useTranslations("feedback");
  const tValidacao = useTranslations("validacaoApi");
  const feedback = useLigaFeedback();

  const [carregando, setCarregando] = useState(true);
  const [salvando, setSalvando] = useState(false);
  const [excluindo, setExcluindo] = useState(false);
  const [baseline, setBaseline] = useState<string | null>(null);
  const [dialogoExcluir, setDialogoExcluir] = useState(false);
  const [dialogoPendencia, setDialogoPendencia] = useState(false);
  const [lookups, setLookups] = useState<LookupsJson | null>(null);
  const [campos, setCampos] = useState<CamposContasReceber>(camposVazio);
  const [arquivosLinhas, setArquivosLinhas] = useState<{ label: string; valor: string }[]>([]);
  /** Mensagens de validação rejeitadas pela API (exibidas no topo do formulário). */
  const [mensagemErroRespostaApi, setMensagemErroRespostaApi] = useState<string | null>(null);

  useEffect(() => {
    const ac = new AbortController();
    void (async () => {
      try {
        const res = await fetch("/api/contas-receber/lookups", {
          signal: ac.signal,
          cache: "no-store",
        });
        if (res.ok) {
          const j = (await res.json()) as LookupsJson;
          setLookups(j);
        }
      } catch {
        /* ignore */
      }
    })();
    return () => ac.abort();
  }, []);

  useEffect(() => {
    const ac = new AbortController();
    if (!idLancamentoReceita) {
      const z = camposVazio();
      setCampos(z);
      setBaseline(JSON.stringify(z));
      setArquivosLinhas([]);
      setCarregando(false);
      return;
    }
    setCarregando(true);
    void (async () => {
      try {
        const res = await fetch(
          `/api/contas-receber/${encodeURIComponent(idLancamentoReceita)}`,
          { signal: ac.signal, cache: "no-store" },
        );
        if (!res.ok) {
          feedback.erroDetalhado(t("erroCarregar"));
          aoVoltar();
          return;
        }
        const json = (await res.json()) as { dados?: Record<string, unknown> };
        const d = json.dados;
        if (!d) {
          feedback.erroDetalhado(t("erroCarregar"));
          aoVoltar();
          return;
        }
        const carregado = camposDeApi(d);
        try {
          carregado.agenteRotuloExibicao = await resolverRotuloAgenteExibicao(
            carregado,
            ac.signal,
          );
        } catch {
          carregado.agenteRotuloExibicao = "";
        }
        setCampos(carregado);
        setBaseline(JSON.stringify(carregado));
        setArquivosLinhas([
          { label: t("arquivo1"), valor: str(d.nome_arquivo1) || str(d.nome_referencia1) },
          { label: t("arquivo2"), valor: str(d.nome_arquivo2) || str(d.nome_referencia2) },
        ]);
      } catch {
        if (!ac.signal.aborted) feedback.erroDetalhado(t("erroCarregar"));
      } finally {
        if (!ac.signal.aborted) setCarregando(false);
      }
    })();
    return () => ac.abort();
  }, [idLancamentoReceita, aoVoltar, feedback, t]);

  const sujo = useMemo(() => {
    if (carregando || baseline === null) return false;
    return JSON.stringify(campos) !== baseline;
  }, [campos, carregando, baseline]);

  const optsTipoAgente = useMemo(
    () =>
      (lookups?.tiposAgente ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsSituacao = useMemo(
    () =>
      (lookups?.situacoesDocumento ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsEmpresa = useMemo(
    () =>
      (lookups?.empresasAtivas ?? []).map((x) => ({
        label: x.rotulo.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsPlanoConta = useMemo(
    () =>
      (lookups?.planosConta ?? []).map((x) => ({
        label: x.rotulo.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsContaCaixa = useMemo(
    () =>
      (lookups?.contasCaixa ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );
  const optsTipoEspecie = useMemo(
    () =>
      (lookups?.tiposEspecie ?? []).map((x) => ({
        label: x.descricao?.trim() || x.id,
        value: x.id,
      })),
    [lookups],
  );

  const situacaoEhPago =
    campos.idSituacaoDocumento === ID_SITUACAO_PAGO ||
    campos.idSituacaoDocumento === ID_SITUACAO_PAGO_PARCIAL;
  const tipoAgenteEhCliente = campos.idTipoAgente === "1";
  const tipoAgenteEhFornecedor = campos.idTipoAgente === "2";
  const tipoAgenteEhColaborador = campos.idTipoAgente === "3";

  const aoInputRotuloAgente = useCallback((texto: string) => {
    setCampos((p) => ({
      ...p,
      agenteRotuloExibicao: texto,
      idCliente: p.idTipoAgente === "1" ? "" : p.idCliente,
      idFornecedor: p.idTipoAgente === "2" ? "" : p.idFornecedor,
      idColaborador: p.idTipoAgente === "3" ? "" : p.idColaborador,
    }));
  }, []);

  const aoSelecionarAgente = useCallback((id: string, rotulo: string) => {
    setCampos((p) => {
      const ta = p.idTipoAgente;
      return {
        ...p,
        agenteRotuloExibicao: rotulo,
        idCliente: ta === "1" ? id : p.idCliente,
        idFornecedor: ta === "2" ? id : p.idFornecedor,
        idColaborador: ta === "3" ? id : p.idColaborador,
      };
    });
  }, []);

  const validar = useCallback((): Record<string, string> | null => {
    const e: Record<string, string> = {};
    if (!campos.idTipoAgente.trim()) e.idTipoAgente = t("obrigatorio");
    if (campos.idTipoAgente === "1" && !campos.idCliente.trim()) {
      e.idCliente = t("obrigatorio");
    }
    if (campos.idTipoAgente === "2" && !campos.idFornecedor.trim()) {
      e.idFornecedor = t("obrigatorio");
    }
    if (campos.idTipoAgente === "3" && !campos.idColaborador.trim()) {
      e.idColaborador = t("obrigatorio");
    }
    if (!campos.valorPrevisao.trim()) e.valorPrevisao = t("obrigatorio");
    if (!campos.dataPrevisao.trim()) e.dataPrevisao = t("obrigatorio");
    if (!campos.idSituacaoDocumento.trim()) e.idSituacaoDocumento = t("obrigatorio");
    if (!campos.idPlanoConta.trim()) e.idPlanoConta = t("obrigatorio");
    if (situacaoEhPago) {
      if (!campos.valorRealizacao.trim()) e.valorRealizacao = t("obrigatorio");
      if (!campos.dataRealizacao.trim()) e.dataRealizacao = t("obrigatorio");
      if (!campos.idTipoEspecie.trim()) e.idTipoEspecie = t("obrigatorio");
      if (!campos.dataBaixa.trim()) e.dataBaixa = t("obrigatorio");
    }
    return Object.keys(e).length ? e : null;
  }, [campos, situacaoEhPago, t]);

  const salvar = useCallback(async () => {
    const errosLocais = validar();
    if (errosLocais) {
      feedback.aviso(tFeedback("toastValidacaoCampos"));
      return;
    }
    setSalvando(true);
    setMensagemErroRespostaApi(null);
    try {
      const corpo = montarPayload(campos);
      const url = idLancamentoReceita
        ? `/api/contas-receber/${encodeURIComponent(idLancamentoReceita)}`
        : "/api/contas-receber";
      const method = idLancamentoReceita ? "PUT" : "POST";
      const res = await fetch(url, {
        method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(corpo),
      });
      if (!res.ok) {
        const corpoErro = (await res.json().catch(() => ({}))) as Record<string, unknown>;
        const { campos: errosApi, global } = traduzirErrosValidacaoParaFormulario(
          corpoErro,
          (key, values) => tValidacao(key, values),
        );
        const detalhePorCampo = Object.values(errosApi).filter(Boolean).join("\n");
        if (detalhePorCampo) {
          setMensagemErroRespostaApi(detalhePorCampo);
          feedback.erroDetalhado(tFeedback("toastValidacaoCampos"), detalhePorCampo);
          return;
        }
        const fallback =
          global ?? (typeof corpoErro.message === "string" ? corpoErro.message : "");
        setMensagemErroRespostaApi(fallback.trim() ? fallback : null);
        feedback.erroDetalhado(tFeedback("toastFalhaOperacao"), fallback);
        return;
      }
      setMensagemErroRespostaApi(null);
      feedback.salvo();
      if (idLancamentoReceita) {
        aoSalvo(idLancamentoReceita);
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
    idLancamentoReceita,
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
    if (!idLancamentoReceita) return;
    setExcluindo(true);
    try {
      const res = await fetch(
        `/api/contas-receber/${encodeURIComponent(idLancamentoReceita)}`,
        { method: "DELETE" },
      );
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
  }, [aoVoltar, feedback, idLancamentoReceita, t]);

  const secoes = useMemo(
    () =>
      criarSecoesFormularioContasReceberInfotime({
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
      }),
    [
      t,
      campos,
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
  const subtituloFormulario = idLancamentoReceita
    ? t("subtituloCabecalhoEditar")
    : t("subtituloCabecalhoNovo");

  return (
    <section
      className={`liga-cliente-infotime-form liga-contas-receber-infotime-form${idLancamentoReceita ? "" : " liga-cliente-infotime-form--inclusao"}`}
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
      <LigaFormularioBase
        titulo={tituloFormulario}
        subtitulo={subtituloFormulario}
        subtituloAgrupadoAoTitulo
        tituloComBarraVerde
        iconeTitulo="pi-minus-circle"
        temLegendaCamposObrigatorios
        mensagemErroGlobal={mensagemErroRespostaApi}
        secaoInicialId="identificacao"
        barraAcoes={
          <div className="liga-cliente-infotime-form-barra-acoes">
            <Button
              type="button"
              label={t("voltar")}
              icon="pi pi-arrow-left"
              severity="secondary"
              outlined
              disabled={salvando || excluindo}
              onClick={tentarVoltar}
            />
            <span className="liga-cliente-infotime-form-barra-acoes-empurra" aria-hidden />
            <Button
              type="button"
              label={t("salvar")}
              icon="pi pi-save"
              loading={salvando}
              disabled={excluindo}
              onClick={() =>
                void executarComPrecheckSessao(
                  () => void salvar(),
                  (acao) => solicitarReautenticacaoGlobal(() => void acao()),
                )
              }
            />
            {idLancamentoReceita ? (
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
        secoes={secoes}
      />
    </section>
  );
}
