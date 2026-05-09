"use client";

import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
} from "react";
import { useRouter } from "next/navigation";
import { useTranslations } from "next-intl";

import "./liga-home-navegacao.css";

import { LigaPainelAjudaLigia } from "@/components/ajuda/LigaPainelAjudaLigia";
import { abaAtivaEmContextoSoroteca } from "@/lib/navegacao/ligia-ajuda-contexto";
import { LigaBotaoFlutuante } from "../../ui/botoes/LigaBotaoFlutuante";
import {
  ICONE_MENU_ITEM,
  LigaMenuDrawer,
  type LigaMenuEntrada,
  type LigaMenuEstruturaIds,
} from "../menu/LigaMenuDrawer";
import { iconeMenuItem } from "../menu/liga-menu-icones";
import {
  MENU_ID_ABA_CANONICO,
  MENU_ROTULOS_DST,
} from "@/data/menu-estrutura-dst-gerado";
import { ROTULOS_MENU_INFOTIME_WEB } from "@/data/rotulos-menu-infotime-web";
import {
  filtrarMenuRemovendoIds,
  MENU_IDS_REMOVIDOS_LATERAL,
} from "../menu/filtrar-menu-remover-ids";
import { tryMontarMenuHomeBarraInfotime } from "@/data/menu-home-barra-infotime";
import { LigaSistemaAbas, type LigaAbaHome } from "../../abas/LigaSistemaAbas";
import { LigaTopbarHome } from "../topbar/LigaTopbarHome";
import { LigaDialogoSessao } from "@/components/ui/dialogo/LigaDialogoSessao";
import { LigaReautenticacaoDialogo } from "@/components/ui/dialogo/LigaReautenticacaoDialogo";
import { recarregarSessaoAtual, useSessaoAtual } from "@/hooks/useSessaoAtual";
import {
  confirmarLoginSubstituindoSessaoAtiva,
  reautenticarSessao,
} from "@/lib/autenticacao/reautenticacao";
import { executarComPrecheckSessao } from "@/lib/autenticacao/withSessionGuard";
import { STORAGE_ESTADO_ABAS_HOME } from "@/lib/navegacao/home-estado-abas";

export type LigaHomeNavegacaoProps = {
  menuIds: LigaMenuEstruturaIds;
};

const ABA_DASHBOARD: LigaAbaHome = {
  id: "dashboard",
  tituloKey: "dashboard",
  icone: ICONE_MENU_ITEM.dashboard,
  fechavel: false,
  conteudoKey: "dashboard",
};

const STORAGE_AVISO_LICENCA_POS_LOGIN = "liga.licenca.avisoPosLogin.v1";

const MAPA_ABAS_POR_ID_MENU: Record<string, LigaAbaHome> = {
  dashboard: ABA_DASHBOARD,
  "cadastros-clientes": {
    id: "cadastros-clientes",
    tituloKey: "cadastroClienteInfotime",
    icone: iconeMenuItem("cadastros-clientes"),
    fechavel: true,
    conteudoKey: "cadastroClienteInfotime",
  },
  "ajuda-documentacao": {
    id: "ajuda-documentacao",
    tituloKey: "ajudaDocumentacao",
    icone: ICONE_MENU_ITEM["ajuda-documentacao"],
    fechavel: true,
    conteudoKey: "ajudaDocumentacao",
  },
  "aj-suporte-online": {
    id: "aj-suporte-online",
    tituloKey: "ajudaSuporte",
    icone: ICONE_MENU_ITEM["aj-suporte-online"],
    fechavel: true,
    conteudoKey: "ajudaSuporte",
  },
};

export function LigaHomeNavegacao({ menuIds }: LigaHomeNavegacaoProps) {
  const t = useTranslations("home");
  const tLogin = useTranslations("login");
  const router = useRouter();
  const [menuMobileAberto, setMenuMobileAberto] = useState(false);
  const [painelAjudaLigiaAberto, setPainelAjudaLigiaAberto] = useState(false);
  const [larguraViewport, setLarguraViewport] = useState(0);
  const [menuHorizontalTransbordou, setMenuHorizontalTransbordou] = useState(true);

  const viewportEstreito = larguraViewport > 0 && larguraViewport <= 960;
  const usarDrawer = viewportEstreito || menuHorizontalTransbordou;
  const exibirBarraNoTopo = !usarDrawer;

  useEffect(() => {
    const atualizar = () => setLarguraViewport(window.innerWidth);
    atualizar();
    window.addEventListener("resize", atualizar);
    return () => window.removeEventListener("resize", atualizar);
  }, []);

  useEffect(() => {
    if (!usarDrawer) setMenuMobileAberto(false);
  }, [usarDrawer]);

  useEffect(() => {
    if (typeof window === "undefined") return;
    const msg = sessionStorage.getItem(STORAGE_AVISO_LICENCA_POS_LOGIN);
    if (msg?.trim()) {
      sessionStorage.removeItem(STORAGE_AVISO_LICENCA_POS_LOGIN);
      setAvisoLicencaPosLogin(msg.trim());
    }
  }, []);

  const construirAbaPorId = useCallback((menuId: string): LigaAbaHome => {
    const idAba = MENU_ID_ABA_CANONICO[menuId] ?? menuId;
    const modelo = MAPA_ABAS_POR_ID_MENU[idAba] ?? MAPA_ABAS_POR_ID_MENU[menuId];
    if (modelo) return { ...modelo, id: idAba };
    return {
      id: menuId,
      tituloKey: "emBreve",
      tituloExplicito:
        ROTULOS_MENU_INFOTIME_WEB[menuId] ??
        MENU_ROTULOS_DST[menuId] ??
        menuId,
      icone: iconeMenuItem(menuId),
      fechavel: true,
      conteudoKey: "emBreve",
    };
  }, []);
  const [abasAbertas, setAbasAbertas] = useState<LigaAbaHome[]>([ABA_DASHBOARD]);
  const [abaAtivaId, setAbaAtivaId] = useState(ABA_DASHBOARD.id);
  const [estadoAbasInicializado, setEstadoAbasInicializado] = useState(false);
  const [emailUsuario, setEmailUsuario] = useState<string | null>(null);
  const sessao = useSessaoAtual();
  const ehUsuarioTecnico = sessao.ehSuporte === true;
  const [menuPorGrupo, setMenuPorGrupo] = useState<LigaMenuEstruturaIds | null>(
    null,
  );
  const [reautenticacaoAberta, setReautenticacaoAberta] = useState(false);
  const [loginReautenticacao, setLoginReautenticacao] = useState("");
  const [senhaReautenticacao, setSenhaReautenticacao] = useState("");
  const [erroReautenticacao, setErroReautenticacao] = useState<string | null>(null);
  const [reautenticando, setReautenticando] = useState(false);
  const [captchaReautenticacao, setCaptchaReautenticacao] = useState<{
    id: string;
    pergunta: string;
  } | null>(null);
  const [captchaRespostaReautenticacao, setCaptchaRespostaReautenticacao] = useState("");
  const [avisoLicencaPosLogin, setAvisoLicencaPosLogin] = useState<string | null>(null);
  const [modalSubstituirSessaoAberta, setModalSubstituirSessaoAberta] =
    useState(false);
  const [mensagemModalSubstituirSessao, setMensagemModalSubstituirSessao] =
    useState("");

  const acaoPendenteReautenticacaoRef = useRef<(() => void) | null>(null);
  const logoutEmAndamentoRef = useRef(false);

  const abrirModalReautenticacao = useCallback(
    (acaoPendente?: () => void) => {
      if (acaoPendente) {
        acaoPendenteReautenticacaoRef.current = acaoPendente;
      }
      setErroReautenticacao(null);
      setReautenticacaoAberta(true);
    },
    [],
  );

  const limparEstadoPersistidoAplicacao = useCallback(() => {
    if (typeof window !== "undefined") {
      window.sessionStorage.removeItem(STORAGE_ESTADO_ABAS_HOME);
    }
    setAbasAbertas([ABA_DASHBOARD]);
    setAbaAtivaId(ABA_DASHBOARD.id);
  }, []);

  const menuBaseEfetivo = useMemo(() => {
    const base =
      ehUsuarioTecnico
        ? menuIds
        : menuPorGrupo && menuPorGrupo.length > 0
          ? menuPorGrupo
          : menuIds;
    return tryMontarMenuHomeBarraInfotime(
      filtrarMenuRemovendoIds(base, MENU_IDS_REMOVIDOS_LATERAL),
    );
  }, [menuIds, menuPorGrupo, ehUsuarioTecnico]);
  const menuIdsEfetivo = menuBaseEfetivo;

  /** Layout: aplica o estado persistido antes do paint, evitando frame em que Início parece ativo junto com outra aba. */
  useLayoutEffect(() => {
    if (typeof window === "undefined") return;
    try {
      const raw = window.sessionStorage.getItem(STORAGE_ESTADO_ABAS_HOME);
      if (!raw) {
        setEstadoAbasInicializado(true);
        return;
      }
      const data = JSON.parse(raw) as {
        abasIds?: string[];
        abaAtivaId?: string;
      };
      const ids = Array.isArray(data.abasIds)
        ? data.abasIds.filter((v) => typeof v === "string")
        : [];
      const unicos = Array.from(new Set([ABA_DASHBOARD.id, ...ids]));
      const abasRestauradas = unicos.map((id) =>
        id === ABA_DASHBOARD.id ? ABA_DASHBOARD : construirAbaPorId(id),
      );
      const listaAbas =
        abasRestauradas.length > 0 ? abasRestauradas : [ABA_DASHBOARD];
      setAbasAbertas(listaAbas);
      const ativaBruta =
        typeof data.abaAtivaId === "string" && data.abaAtivaId.trim()
          ? data.abaAtivaId.trim()
          : ABA_DASHBOARD.id;
      const ativaOk = listaAbas.some((a) => a.id === ativaBruta)
        ? ativaBruta
        : ABA_DASHBOARD.id;
      setAbaAtivaId(ativaOk);
    } catch {
      setAbasAbertas([ABA_DASHBOARD]);
      setAbaAtivaId(ABA_DASHBOARD.id);
    } finally {
      setEstadoAbasInicializado(true);
    }
  }, [construirAbaPorId]);

  useEffect(() => {
    void fetch("/api/auth/me")
      .then(async (res) => {
        if (!res.ok) return null;
        return res.json() as Promise<{
          email: string | null;
        }>;
      })
      .then((data) => {
        if (!data) return;
        setEmailUsuario(data.email ?? null);
      })
      .catch(() => null);
  }, []);

  useEffect(() => {
    if (ehUsuarioTecnico) {
      setMenuPorGrupo(null);
      return;
    }
    void fetch("/api/layout/menu", { cache: "no-store" })
      .then(async (res) => {
        if (!res.ok) return null;
        return (await res.json()) as unknown;
      })
      .then((data) => {
        if (Array.isArray(data)) {
          setMenuPorGrupo(data as LigaMenuEstruturaIds);
        } else {
          setMenuPorGrupo(null);
        }
      })
      .catch(() => setMenuPorGrupo(null));
  }, [ehUsuarioTecnico]);

  const handleSair = async () => {
    logoutEmAndamentoRef.current = true;
    try {
      await fetch("/api/auth/logout", { method: "POST" });
    } finally {
      setReautenticacaoAberta(false);
      setModalSubstituirSessaoAberta(false);
      setMensagemModalSubstituirSessao("");
      setErroReautenticacao(null);
      setSenhaReautenticacao("");
      setCaptchaReautenticacao(null);
      setCaptchaRespostaReautenticacao("");
      acaoPendenteReautenticacaoRef.current = null;
      limparEstadoPersistidoAplicacao();
      recarregarSessaoAtual();
      if (typeof window !== "undefined") {
        window.location.replace("/login");
      } else {
        router.replace("/login");
      }
    }
  };

  const abrirAbaInterna = useCallback((menuId: string) => {
    const aba = construirAbaPorId(menuId);

    setAbasAbertas((prev) => {
      if (prev.some((a) => a.id === aba.id)) return prev;
      return [...prev, aba];
    });
    setAbaAtivaId(aba.id);
    setMenuMobileAberto(false);
  }, [construirAbaPorId]);

  const abrirAbaPorMenuId = useCallback(
    async (menuId: string) => {
      await executarComPrecheckSessao(
        () => abrirAbaInterna(menuId),
        (acaoPendente) => abrirModalReautenticacao(() => void acaoPendente()),
      );
    },
    [abrirAbaInterna, abrirModalReautenticacao],
  );

  const fecharTodasAbas = useCallback(() => {
    setAbasAbertas([ABA_DASHBOARD]);
    setAbaAtivaId(ABA_DASHBOARD.id);
  }, []);

  const fecharAba = useCallback((abaId: string) => {
    setAbasAbertas((prev) => prev.filter((a) => a.id !== abaId));
    setAbaAtivaId((current) =>
      current === abaId ? ABA_DASHBOARD.id : current,
    );
  }, []);

  /** Evita `abaAtivaId` órfão (id não existe mais em `abasAbertas`) — antes podia divergir de `abaAtivaFinal` em handlers que leem o estado cru. */
  useEffect(() => {
    if (!estadoAbasInicializado) return;
    if (abasAbertas.some((a) => a.id === abaAtivaId)) return;
    setAbaAtivaId(ABA_DASHBOARD.id);
  }, [estadoAbasInicializado, abasAbertas, abaAtivaId]);

  const abaAtivaExiste = useMemo(
    () => abasAbertas.some((a) => a.id === abaAtivaId),
    [abasAbertas, abaAtivaId],
  );
  const abaAtivaFinal = abaAtivaExiste ? abaAtivaId : ABA_DASHBOARD.id;

  const abaAtivaObjeto = useMemo(
    () => abasAbertas.find((a) => a.id === abaAtivaFinal),
    [abasAbertas, abaAtivaFinal],
  );
  const contextoSorotecaParaAjuda = abaAtivaEmContextoSoroteca(abaAtivaObjeto);

  useEffect(() => {
    if (typeof window === "undefined") return;
    if (!estadoAbasInicializado) return;
    const payload = {
      abasIds: abasAbertas.map((a) => a.id),
      abaAtivaId: abaAtivaFinal,
    };
    window.sessionStorage.setItem(STORAGE_ESTADO_ABAS_HOME, JSON.stringify(payload));
  }, [abasAbertas, abaAtivaFinal, estadoAbasInicializado]);

  useEffect(() => {
    if (typeof window === "undefined") return;
    const onSolicitarReauth = (evento: Event) => {
      const custom = evento as CustomEvent<{ acaoPendente?: () => void }>;
      abrirModalReautenticacao(custom.detail?.acaoPendente);
    };
    window.addEventListener(
      "liga:reautenticacao-solicitada",
      onSolicitarReauth as EventListener,
    );
    return () => {
      window.removeEventListener(
        "liga:reautenticacao-solicitada",
        onSolicitarReauth as EventListener,
      );
    };
  }, [abrirModalReautenticacao]);

  useEffect(() => {
    if (typeof window === "undefined") return;
    const onTrocaUsuario = () => {
      fecharTodasAbas();
    };
    window.addEventListener("liga:fechar-abas-por-troca-usuario", onTrocaUsuario);
    return () => {
      window.removeEventListener(
        "liga:fechar-abas-por-troca-usuario",
        onTrocaUsuario,
      );
    };
  }, [fecharTodasAbas]);

  useEffect(() => {
    if (typeof window === "undefined") return;
    const fetchOriginal = window.fetch.bind(window);
    const deveInterromper = (input: RequestInfo | URL) => {
      const bruto = typeof input === "string" ? input : input instanceof URL ? input.toString() : input.url;
      const url = bruto.startsWith("http")
        ? new URL(bruto)
        : new URL(bruto, window.location.origin);
      const pathname = url.pathname;
      return (
        pathname.startsWith("/api/auth/login") ||
        pathname.startsWith("/api/auth/login-confirm") ||
        pathname.startsWith("/api/auth/logout") ||
        pathname.startsWith("/api/auth/status")
      );
    };
    window.fetch = (async (input: RequestInfo | URL, init?: RequestInit) => {
      const resposta = await fetchOriginal(input, init);
      if (
        resposta.status === 401 &&
        !logoutEmAndamentoRef.current &&
        !deveInterromper(input)
      ) {
        abrirModalReautenticacao();
      }
      return resposta;
    }) as typeof window.fetch;
    return () => {
      window.fetch = fetchOriginal;
    };
  }, [abrirModalReautenticacao]);

  const confirmarReautenticacao = useCallback(async () => {
    const login = loginReautenticacao.trim();
    const senha = senhaReautenticacao.trim();
    if (!login || !senha) {
      setErroReautenticacao("Informe login e senha para continuar.");
      return;
    }
    setReautenticando(true);
    setErroReautenticacao(null);
    try {
      const resultado = await reautenticarSessao(
        login,
        senha,
        captchaReautenticacao
          ? {
              id: captchaReautenticacao.id,
              resposta: captchaRespostaReautenticacao,
            }
          : undefined,
      );
      if (resultado.conflitoSessaoAtiva) {
        setMensagemModalSubstituirSessao(
          resultado.mensagemConflitoSessao?.trim() ||
            tLogin("sessaoAtivaDetectada"),
        );
        setModalSubstituirSessaoAberta(true);
        return;
      }
      if (!resultado.ok) {
        if (resultado.captchaObrigatorio && resultado.captcha) {
          setCaptchaReautenticacao(resultado.captcha);
          setCaptchaRespostaReautenticacao("");
        }
        setErroReautenticacao(
          resultado.mensagemErro ?? "Falha ao reautenticar.",
        );
        return;
      }
      recarregarSessaoAtual();
      setReautenticacaoAberta(false);
      setSenhaReautenticacao("");
      setCaptchaReautenticacao(null);
      setCaptchaRespostaReautenticacao("");
      const acao = acaoPendenteReautenticacaoRef.current;
      acaoPendenteReautenticacaoRef.current = null;
      if (acao) {
        acao();
      } else {
        router.refresh();
      }
    } catch {
      setErroReautenticacao("Não foi possível reautenticar agora. Tente novamente.");
    } finally {
      setReautenticando(false);
    }
  }, [
    loginReautenticacao,
    senhaReautenticacao,
    captchaReautenticacao,
    captchaRespostaReautenticacao,
    router,
    tLogin,
  ]);

  const confirmarSubstituirSessaoReautenticacao = useCallback(async () => {
    setModalSubstituirSessaoAberta(false);
    const login = loginReautenticacao.trim();
    const senha = senhaReautenticacao.trim();
    setReautenticando(true);
    setErroReautenticacao(null);
    try {
      const resultado = await confirmarLoginSubstituindoSessaoAtiva(
        login,
        senha,
        captchaReautenticacao
          ? {
              id: captchaReautenticacao.id,
              resposta: captchaRespostaReautenticacao,
            }
          : undefined,
      );
      if (!resultado.ok) {
        if (resultado.captchaObrigatorio && resultado.captcha) {
          setCaptchaReautenticacao(resultado.captcha);
          setCaptchaRespostaReautenticacao("");
        }
        setErroReautenticacao(
          resultado.mensagemErro ?? tLogin("erroConfirmarSessao"),
        );
        return;
      }
      setCaptchaReautenticacao(null);
      setCaptchaRespostaReautenticacao("");
      const aviso = resultado.avisoLicencaProximaExpiracao?.trim();
      if (aviso) {
        if (typeof window !== "undefined") {
          window.sessionStorage.setItem(STORAGE_AVISO_LICENCA_POS_LOGIN, aviso);
        }
        setAvisoLicencaPosLogin(aviso);
      }
      recarregarSessaoAtual();
      setReautenticacaoAberta(false);
      setSenhaReautenticacao("");
      const acao = acaoPendenteReautenticacaoRef.current;
      acaoPendenteReautenticacaoRef.current = null;
      if (acao) {
        acao();
      } else {
        router.refresh();
      }
    } catch {
      setErroReautenticacao(
        "Não foi possível confirmar o login. Tente novamente.",
      );
    } finally {
      setReautenticando(false);
    }
  }, [
    loginReautenticacao,
    senhaReautenticacao,
    captchaReautenticacao,
    captchaRespostaReautenticacao,
    router,
    tLogin,
  ]);

  return (
    <main className="liga-home">
      {avisoLicencaPosLogin ? (
        <div className="liga-home-aviso-licenca" role="status">
          <p className="liga-home-aviso-licenca-texto">{avisoLicencaPosLogin}</p>
          <button
            type="button"
            className="liga-home-aviso-licenca-fechar"
            onClick={() => setAvisoLicencaPosLogin(null)}
          >
            {t("avisoLicenca.fechar")}
          </button>
        </div>
      ) : null}
      <div className="liga-home-linha-principal">
        <LigaMenuDrawer
          menuIds={menuIdsEfetivo}
          modoDrawer={usarDrawer}
          mobileAberto={menuMobileAberto}
          emailUsuario={emailUsuario}
          aoFecharMobile={() => setMenuMobileAberto(false)}
          aoSelecionarItem={abrirAbaPorMenuId}
          aoSair={handleSair}
        />

        <section className="liga-home-corpo">
          <LigaTopbarHome
            menuIds={menuIdsEfetivo}
            itemAtivoId={abaAtivaFinal}
            aoSelecionarItem={abrirAbaPorMenuId}
            aoSair={handleSair}
            aoAbrirMenuMobile={() => setMenuMobileAberto(true)}
            emailUsuario={emailUsuario}
            viewportEstreito={viewportEstreito}
            usarDrawer={usarDrawer}
            exibirBarraNoTopo={exibirBarraNoTopo}
            onMenuHorizontalTransbordou={setMenuHorizontalTransbordou}
          />
          <LigaSistemaAbas
            abas={abasAbertas}
            abaAtivaId={abaAtivaFinal}
            aoAtivarAba={setAbaAtivaId}
            aoFecharAba={fecharAba}
            aoFecharTodasAbas={fecharTodasAbas}
          />
        </section>
      </div>

      <div
        className={`liga-home-overlay ${menuMobileAberto && usarDrawer ? "visivel" : ""}`}
        onClick={() => setMenuMobileAberto(false)}
        aria-hidden="true"
      />

      <LigaPainelAjudaLigia
        aberto={painelAjudaLigiaAberto}
        aoFechar={() => setPainelAjudaLigiaAberto(false)}
        contextoSoroteca={contextoSorotecaParaAjuda}
      />

      <LigaBotaoFlutuante
        rotuloAcessibilidade={t("botaoFlutuante.aria")}
        aoClicar={() => setPainelAjudaLigiaAberto(true)}
      />

      <LigaReautenticacaoDialogo
        aberta={reautenticacaoAberta}
        login={loginReautenticacao}
        senha={senhaReautenticacao}
        carregando={reautenticando}
        erro={erroReautenticacao}
        captcha={captchaReautenticacao}
        captchaResposta={captchaRespostaReautenticacao}
        aoAlterarLogin={setLoginReautenticacao}
        aoAlterarSenha={setSenhaReautenticacao}
        aoAlterarCaptchaResposta={setCaptchaRespostaReautenticacao}
        aoConfirmar={confirmarReautenticacao}
        aoCancelar={() => {
          if (!reautenticando) {
            setModalSubstituirSessaoAberta(false);
            setReautenticacaoAberta(false);
          }
        }}
        titulo="Sessão expirada"
        mensagem="A sessão expirou. Faça login para continuar sem perder o contexto atual."
        textoBotaoCancelar="Cancelar"
        textoBotaoConfirmar="Continuar"
        textoBotaoConfirmando="Reautenticando..."
      />

      <LigaDialogoSessao
        aberto={modalSubstituirSessaoAberta}
        titulo={tLogin("modal.titulo")}
        mensagem={mensagemModalSubstituirSessao}
        rotuloCancelar={tLogin("modal.cancelar")}
        rotuloConfirmar={tLogin("modal.continuar")}
        aoFechar={() => {
          if (!reautenticando) setModalSubstituirSessaoAberta(false);
        }}
        aoConfirmar={() => void confirmarSubstituirSessaoReautenticacao()}
      />
    </main>
  );
}
