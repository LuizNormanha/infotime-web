"use client";

import { useContext, useEffect, useRef, useState } from "react";

import { TelaAtivaContext } from "@/contexts/TelaAtivaContext";

import { useSessaoAtual } from "./useSessaoAtual";

// ─── Evento global de invalidação ──────────────────────────────────────────

const EVENTO_INVALIDAR = "liga:permissoes-invalidadas";

/**
 * Dispara revalidação das permissões em todos os hooks montados.
 * Chamar após salvar grupo-perfil, usuario-permissoes ou alterar grupo do usuário.
 */
export function invalidarPermissoesPerfilCliente(): void {
  window.dispatchEvent(new Event(EVENTO_INVALIDAR));
}

// ─── Tipos internos ────────────────────────────────────────────────────────

type EventoTelaAtiva = { tela?: string };

type PermissoesTela = {
  tela: string | null;
  incluir: boolean;
  editar: boolean;
  excluir: boolean;
};

/** Sem slug da tela — incluir/editar permissivos; exclusão bloqueada até haver slug. */
const PERMISSOES_SEM_TELA: PermissoesTela = {
  tela: null,
  incluir: true,
  editar: true,
  excluir: false,
};

/** Enquanto a sessão ou o GET de permissões não concluiu — exclusão conservadora. */
const PERMISSOES_AGUARDANDO: PermissoesTela = {
  tela: null,
  incluir: true,
  editar: true,
  excluir: false,
};

function permissoesNegadas(tela: string | null): PermissoesTela {
  return {
    tela,
    incluir: false,
    editar: false,
    excluir: false,
  };
}

function permissivoTotal(tela: string): PermissoesTela {
  return {
    tela,
    incluir: true,
    editar: true,
    excluir: true,
  };
}

/** Resposta GET /api/auth/permissoes (Nest devolve boolean; tolera legado). */
function flagPermitida(v: unknown): boolean {
  return v === true || v === "S" || v === "s";
}

type RespostaPermissoesApi = {
  possuiRegra?: boolean;
  incluir?: unknown;
  editar?: unknown;
  excluir?: unknown;
};

function permissoesAPartirDoJson(slug: string, json: RespostaPermissoesApi): PermissoesTela {
  // Regra de negócio: sem linha em infolab_usuario_permissoes → sem restrição.
  // `possuiRegra` ausente ou false = permissivo total (sem restringir).
  if (json.possuiRegra !== true) {
    return permissivoTotal(slug);
  }
  return {
    tela: slug,
    incluir: flagPermitida(json.incluir),
    editar: flagPermitida(json.editar),
    excluir: flagPermitida(json.excluir),
  };
}

// Debounce de visibilitychange para não martelar a API em trocas rápidas de aba.
const DEBOUNCE_FOCO_MS = 400;

/**
 * Permissões do perfil para a tela ativa (`codigo` em `infolab_formulario`).
 * Revalida automaticamente ao recuperar foco na janela e após evento
 * `liga:permissoes-invalidadas` (disparado por `invalidarPermissoesPerfilCliente`).
 *
 * @param slugFixo — quando preenchido, usa esse slug para buscar permissões
 *   em vez do contexto global `TelaAtivaContext`, evitando cruzamento entre
 *   abas montadas em paralelo.
 */
export function usePermissaoPerfilTelaAtiva(slugFixo?: string | null) {
  const slugTelaDoContexto = useContext(TelaAtivaContext);
  const [telaPorEvento, setTelaPorEvento] = useState<string | null>(null);
  const sessao = useSessaoAtual();
  const [permissoes, setPermissoes] = useState<PermissoesTela>(PERMISSOES_AGUARDANDO);
  const [permissoesCarregadas, setPermissoesCarregadas] = useState(false);

  // Contador que força refetch quando incrementado (visibilitychange / evento de invalidação).
  const [versaoInvalidacao, setVersaoInvalidacao] = useState(0);
  const timerFocoRef = useRef<ReturnType<typeof setTimeout> | null>(null);

  const possuiSlugFixo = typeof slugFixo === "string" && slugFixo.trim().length > 0;

  const tela = possuiSlugFixo
    ? slugFixo!.trim()
    : slugTelaDoContexto !== undefined
      ? slugTelaDoContexto
      : telaPorEvento;

  // Listener de tela ativa — dispensável quando slug fixo é fornecido.
  useEffect(() => {
    if (possuiSlugFixo) return;

    const onTelaAtiva = (ev: Event) => {
      const detalhe = (ev as CustomEvent<EventoTelaAtiva>).detail;
      const novaTela = detalhe?.tela?.trim() || null;
      setTelaPorEvento(novaTela);
    };
    window.addEventListener("liga:tela-ativa", onTelaAtiva as EventListener);
    return () => {
      window.removeEventListener("liga:tela-ativa", onTelaAtiva as EventListener);
    };
  }, [possuiSlugFixo]);

  // Revalidação ao recuperar foco + evento explícito de invalidação.
  useEffect(() => {
    const incrementar = () => setVersaoInvalidacao((v) => v + 1);

    const onVisibilidade = () => {
      if (document.visibilityState !== "visible") return;
      if (timerFocoRef.current) clearTimeout(timerFocoRef.current);
      timerFocoRef.current = setTimeout(incrementar, DEBOUNCE_FOCO_MS);
    };

    document.addEventListener("visibilitychange", onVisibilidade);
    window.addEventListener(EVENTO_INVALIDAR, incrementar);

    return () => {
      document.removeEventListener("visibilitychange", onVisibilidade);
      window.removeEventListener(EVENTO_INVALIDAR, incrementar);
      if (timerFocoRef.current) clearTimeout(timerFocoRef.current);
    };
  }, []);

  // Fetch de permissões — depende de `versaoInvalidacao`.
  useEffect(() => {
    if (!sessao.sessaoCarregada) {
      setPermissoesCarregadas(false);
      return;
    }
    if (!tela?.trim()) {
      setPermissoes(PERMISSOES_SEM_TELA);
      setPermissoesCarregadas(true);
      return;
    }
    if (!sessao.idUsuario) {
      setPermissoes(permissoesNegadas(tela));
      setPermissoesCarregadas(true);
      return;
    }

    // Suporte/implantação: permissivo total sem fetch (espelha a API).
    if (sessao.ehSuporte) {
      setPermissoes(permissivoTotal(tela.trim()));
      setPermissoesCarregadas(true);
      return;
    }

    const ac = new AbortController();
    const revalidacaoEmSegundoPlano = versaoInvalidacao > 0 && permissoesCarregadas;
    if (!revalidacaoEmSegundoPlano) {
      setPermissoesCarregadas(false);
    }
    const slug = tela.trim();

    fetch(
      `/api/auth/permissoes?tela=${encodeURIComponent(slug)}`,
      { cache: "no-store", signal: ac.signal },
    )
      .then(async (res) => {
        if (!res.ok) throw new Error(`http_${res.status}`);
        const json = (await res.json()) as RespostaPermissoesApi;
        setPermissoes(permissoesAPartirDoJson(slug, json));
      })
      .catch((e: unknown) => {
        if (e instanceof DOMException && e.name === "AbortError") return;
        const ehRevalidacao = versaoInvalidacao > 0;
        if (!ehRevalidacao) {
          setPermissoes(permissoesNegadas(slug));
        }
      })
      .finally(() => {
        if (!ac.signal.aborted) setPermissoesCarregadas(true);
      });

    return () => ac.abort();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [sessao.sessaoCarregada, sessao.idUsuario, sessao.ehSuporte, tela, versaoInvalidacao]);

  return { tela, permissoes, permissoesCarregadas };
}
