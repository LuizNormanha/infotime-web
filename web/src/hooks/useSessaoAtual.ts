"use client";

import { useSyncExternalStore } from "react";

export type SessaoAtual = {
  idUsuario: string | null;
  idTenacidade: string | null;
  /** E-mail do JWT (minúsculas), quando presente. */
  email: string | null;
  /**
   * Usuário técnico global (login suporte ou implantação) — ex.: aba Auditoria nos formulários.
   */
  podeVerSecaoAuditoriaFormulario: boolean;
  /** JWT com `suporte: true` — ignora restrições de permissão no client. */
  ehSuporte: boolean;
  /** Domínio da tenacidade da sessão (quando a API informou). */
  dominioTenacidadeSessao: string | null;
  /**
   * Se `false`, usuário implantacao/suporte não deve persistir em `implantacao-tenacidades`
   * (sessão fora do tenant `liga.br`).
   */
  mutacaoTenacidadeImplantacaoPermitida: boolean;
  /** `false` até o primeiro GET `/api/auth/sessao` concluir. */
  sessaoCarregada: boolean;
};

const vazio: SessaoAtual = {
  idUsuario: null,
  idTenacidade: null,
  email: null,
  podeVerSecaoAuditoriaFormulario: false,
  ehSuporte: false,
  dominioTenacidadeSessao: null,
  mutacaoTenacidadeImplantacaoPermitida: true,
  sessaoCarregada: false,
};

let shared: SessaoAtual = vazio;
let carregamentoIniciado = false;
const listeners = new Set<() => void>();

function notificar() {
  for (const l of listeners) l();
}

function iniciarCarregamento() {
  if (carregamentoIniciado) return;
  carregamentoIniciado = true;

  fetch("/api/auth/sessao", { cache: "no-store" })
    .then((r) => r.json())
    .then(
      (data: {
        idUsuario?: string | null;
        idTenacidade?: string | null;
        email?: string | null;
        podeVerSecaoAuditoriaFormulario?: boolean;
        ehSuporte?: boolean;
        dominioTenacidadeSessao?: string | null;
        mutacaoTenacidadeImplantacaoPermitida?: boolean;
      }) => {
        shared = {
          idUsuario: data.idUsuario ?? null,
          idTenacidade: data.idTenacidade ?? null,
          email: typeof data.email === "string" ? data.email : null,
          podeVerSecaoAuditoriaFormulario:
            data.podeVerSecaoAuditoriaFormulario === true,
          ehSuporte: data.ehSuporte === true,
          dominioTenacidadeSessao:
            typeof data.dominioTenacidadeSessao === "string"
              ? data.dominioTenacidadeSessao
              : null,
          mutacaoTenacidadeImplantacaoPermitida:
            data.mutacaoTenacidadeImplantacaoPermitida !== false,
          sessaoCarregada: true,
        };
        notificar();
      },
    )
    .catch((e: unknown) => {
      console.warn("[useSessaoAtual] falha ao carregar sessão", e);
      shared = { ...vazio, sessaoCarregada: true };
      notificar();
    });
}

function subscribe(listener: () => void) {
  listeners.add(listener);
  iniciarCarregamento();
  return () => {
    listeners.delete(listener);
  };
}

function getSnapshot() {
  return shared;
}

function getServerSnapshot() {
  return vazio;
}

/**
 * Limpa o cache em memória e dispara novo GET `/api/auth/sessao`.
 * Necessário após login ou logout em SPA (Next sem reload completo).
 */
export function recarregarSessaoAtual(): void {
  shared = { ...vazio, sessaoCarregada: false };
  carregamentoIniciado = false;
  notificar();
  iniciarCarregamento();
}

/**
 * Claims da sessão (sem mapa de permissões — essas vêm em `usePermissaoPerfilTelaAtiva`).
 */
export function useSessaoAtual(): SessaoAtual {
  return useSyncExternalStore(subscribe, getSnapshot, getServerSnapshot);
}
