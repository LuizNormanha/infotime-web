"use client";

import {
  createContext,
  useCallback,
  useContext,
  useMemo,
  useRef,
} from "react";
import { useTranslations } from "next-intl";
import { Toast } from "primereact/toast";

const VIDA_SUCESSO_MS = 4000;
const VIDA_ERRO_MS = 6000;

export type LigaFeedbackApi = {
  /** Toast de sucesso após persistir alterações (criar/editar). */
  salvo: () => void;
  /** Toast de sucesso com texto livre (ex.: mensagem contextual no coletor). */
  sucessoMensagem: (resumo: string) => void;
  /** Toast de sucesso após excluir um registro. */
  excluido: () => void;
  erroSalvar: () => void;
  erroExcluir: () => void;
  /** Falha ao carregar lista, registro ou recurso (GET). */
  erroCarregar: () => void;
  erroGenerico: () => void;
  erroJsonParse: () => void;
  erroJsonTamanho: () => void;
  /** Aviso com texto livre (já traduzido ou literal controlado pelo chamador). */
  aviso: (resumo: string) => void;
  /** Erro com resumo e detalhe opcional (ex.: mensagem retornada pela API). */
  erroDetalhado: (resumo: string, detalhe?: string) => void;
};

const LigaFeedbackContext = createContext<LigaFeedbackApi | null>(null);

function LigaFeedbackInterno({ children }: { children: React.ReactNode }) {
  const t = useTranslations("home.feedback");
  const toastRef = useRef<Toast>(null);

  const salvo = useCallback(() => {
    toastRef.current?.show({
      severity: "success",
      summary: t("salvoOk"),
      life: VIDA_SUCESSO_MS,
    });
  }, [t]);

  const sucessoMensagem = useCallback((resumo: string) => {
    toastRef.current?.show({
      severity: "success",
      summary: resumo,
      life: VIDA_SUCESSO_MS,
    });
  }, []);

  const excluido = useCallback(() => {
    toastRef.current?.show({
      severity: "success",
      summary: t("excluidoOk"),
      life: VIDA_SUCESSO_MS,
    });
  }, [t]);

  const erroSalvar = useCallback(() => {
    toastRef.current?.show({
      severity: "error",
      summary: t("erroSalvar"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const erroExcluir = useCallback(() => {
    toastRef.current?.show({
      severity: "error",
      summary: t("erroExcluir"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const erroCarregar = useCallback(() => {
    toastRef.current?.show({
      severity: "error",
      summary: t("erroCarregar"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const erroGenerico = useCallback(() => {
    toastRef.current?.show({
      severity: "error",
      summary: t("erroGenerico"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const erroJsonParse = useCallback(() => {
    toastRef.current?.show({
      severity: "error",
      summary: t("erroJsonParse"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const erroJsonTamanho = useCallback(() => {
    toastRef.current?.show({
      severity: "warn",
      summary: t("erroJsonTamanho"),
      life: VIDA_ERRO_MS,
    });
  }, [t]);

  const aviso = useCallback((resumo: string) => {
    toastRef.current?.show({
      severity: "warn",
      summary: resumo,
      life: VIDA_ERRO_MS,
    });
  }, []);

  const erroDetalhado = useCallback((resumo: string, detalhe?: string) => {
    toastRef.current?.show({
      severity: "error",
      summary: resumo,
      detail: detalhe,
      life: VIDA_ERRO_MS,
    });
  }, []);

  const valor = useMemo(
    () => ({
      salvo,
      sucessoMensagem,
      excluido,
      erroSalvar,
      erroExcluir,
      erroCarregar,
      erroGenerico,
      erroJsonParse,
      erroJsonTamanho,
      aviso,
      erroDetalhado,
    }),
    [
      salvo,
      sucessoMensagem,
      excluido,
      erroSalvar,
      erroExcluir,
      erroCarregar,
      erroGenerico,
      erroJsonParse,
      erroJsonTamanho,
      aviso,
      erroDetalhado,
    ],
  );

  return (
    <LigaFeedbackContext.Provider value={valor}>
      <Toast ref={toastRef} position="top-right" />
      {children}
    </LigaFeedbackContext.Provider>
  );
}

/** Provedor único de Toast para feedback operacional (salvar, excluir, erros) em toda a aplicação. */
export function LigaFeedbackProvider({ children }: { children: React.ReactNode }) {
  return <LigaFeedbackInterno>{children}</LigaFeedbackInterno>;
}

export function useLigaFeedback(): LigaFeedbackApi {
  const ctx = useContext(LigaFeedbackContext);
  if (!ctx) {
    throw new Error("useLigaFeedback deve ser usado dentro de LigaFeedbackProvider");
  }
  return ctx;
}
