import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useRef,
  useState,
  type ComponentType,
} from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { InputText } from "primereact/inputtext";
import { useAuth } from "../../auth/AuthProvider.js";
import { InfotimeMarcaLogo } from "./InfotimeMarcaLogo.js";
import { InfotimeAba } from "./InfotimeAba.js";
import { HomePage } from "../../../pages/HomePage.js";
import { UsuarioListPage } from "../../../pages/usuario/UsuarioListPage.js";
import { ClienteAreaPage } from "../../../pages/cliente/ClienteAreaPage.js";
import {
  applyAppThemeToDocument,
  persistAppTheme,
  readStoredAppTheme,
  type AppTheme,
} from "../../theme/appTheme.js";
import "./liga-app-shell.css";

type TabId = "inicio" | "usuarios" | "clientes";

const TAB_DEF: Record<
  TabId,
  {
    label: string;
    icone: string;
    path: string;
    fechavel: boolean;
    Page: ComponentType;
  }
> = {
  inicio: {
    label: "Início",
    icone: "pi-home",
    path: "/",
    fechavel: false,
    Page: HomePage,
  },
  usuarios: {
    label: "Usuários",
    icone: "pi-users",
    path: "/usuarios",
    fechavel: true,
    Page: UsuarioListPage,
  },
  clientes: {
    label: "Clientes",
    icone: "pi-briefcase",
    path: "/clientes",
    fechavel: true,
    Page: ClienteAreaPage,
  },
};

function pathToTabId(pathname: string): TabId {
  const p = pathname.replace(/\/+$/, "") || "/";
  if (p === "/" || p === "") return "inicio";
  if (p === "/usuarios" || p.startsWith("/usuarios/")) return "usuarios";
  if (p === "/clientes" || p.startsWith("/clientes/")) return "clientes";
  return "inicio";
}

const LIMIAR_VIEWPORT_ESTREITO = 960;

function useMediaEstreito() {
  const [estreito, setEstreito] = useState(
    () => typeof window !== "undefined" && window.innerWidth <= LIMIAR_VIEWPORT_ESTREITO,
  );

  useEffect(() => {
    const mq = window.matchMedia(`(max-width: ${LIMIAR_VIEWPORT_ESTREITO}px)`);
    const att = () => setEstreito(mq.matches);
    att();
    mq.addEventListener("change", att);
    return () => mq.removeEventListener("change", att);
  }, []);

  return estreito;
}

export function AppLayout() {
  const { accessToken, userLogin, logout } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();
  const viewportEstreito = useMediaEstreito();
  const [menuMobileAberto, setMenuMobileAberto] = useState(false);
  const [menuContaAberto, setMenuContaAberto] = useState(false);
  const [tema, setTema] = useState<AppTheme>(readStoredAppTheme);
  const refMenuConta = useRef<HTMLDivElement>(null);

  const [openTabs, setOpenTabs] = useState<TabId[]>(() => ["inicio"]);
  const listaScrollRef = useRef<HTMLDivElement>(null);
  const abaRefs = useRef<Partial<Record<TabId, HTMLDivElement | null>>>({});
  const [scrollAbas, setScrollAbas] = useState({
    mostrarNavegacao: false,
    podeEsquerda: false,
    podeDireita: false,
  });

  const abaAtiva = pathToTabId(location.pathname);

  useEffect(() => {
    if (!accessToken) navigate("/login");
  }, [accessToken, navigate]);

  useEffect(() => {
    applyAppThemeToDocument(tema);
  }, [tema]);

  useEffect(() => {
    const id = pathToTabId(location.pathname);
    setOpenTabs((prev) => (prev.includes(id) ? prev : [...prev, id]));
  }, [location.pathname]);

  useEffect(() => {
    setMenuMobileAberto(false);
  }, [location.pathname]);

  useEffect(() => {
    if (!menuContaAberto) return;
    function fecharFora(ev: MouseEvent) {
      const alvo = ev.target as Node;
      if (refMenuConta.current?.contains(alvo)) return;
      setMenuContaAberto(false);
    }
    function fecharEsc(ev: KeyboardEvent) {
      if (ev.key === "Escape") setMenuContaAberto(false);
    }
    document.addEventListener("mousedown", fecharFora);
    document.addEventListener("keydown", fecharEsc);
    return () => {
      document.removeEventListener("mousedown", fecharFora);
      document.removeEventListener("keydown", fecharEsc);
    };
  }, [menuContaAberto]);

  const sincronizarScrollAbas = useCallback(() => {
    const el = listaScrollRef.current;
    if (!el) return;
    const { scrollLeft, scrollWidth, clientWidth } = el;
    const max = scrollWidth - clientWidth;
    const mostrarNavegacao = max > 4;
    setScrollAbas({
      mostrarNavegacao,
      podeEsquerda: mostrarNavegacao && scrollLeft > 4,
      podeDireita: mostrarNavegacao && scrollLeft < max - 4,
    });
  }, []);

  useLayoutEffect(() => {
    sincronizarScrollAbas();
  }, [openTabs, sincronizarScrollAbas, abaAtiva]);

  useEffect(() => {
    const el = listaScrollRef.current;
    if (!el) return;
    const ro = new ResizeObserver(() => sincronizarScrollAbas());
    ro.observe(el);
    el.addEventListener("scroll", sincronizarScrollAbas, { passive: true });
    return () => {
      ro.disconnect();
      el.removeEventListener("scroll", sincronizarScrollAbas);
    };
  }, [sincronizarScrollAbas]);

  const rolarAbas = useCallback((direcao: -1 | 1) => {
    const el = listaScrollRef.current;
    if (!el) return;
    const passo = Math.max(100, Math.round(el.clientWidth * 0.4));
    el.scrollBy({ left: passo * direcao, behavior: "smooth" });
  }, []);

  useEffect(() => {
    const alvo = abaRefs.current[abaAtiva];
    if (!alvo) return;
    alvo.scrollIntoView({ behavior: "smooth", inline: "center", block: "nearest" });
  }, [abaAtiva]);

  const alternarTemaApp = useCallback(() => {
    setTema((atual) => {
      const next: AppTheme = atual === "light" ? "dark" : "light";
      persistAppTheme(next);
      return next;
    });
  }, []);

  const sair = useCallback(() => {
    setMenuContaAberto(false);
    logout();
    navigate("/login");
  }, [logout, navigate]);

  const irParaAba = useCallback(
    (id: TabId) => {
      navigate(TAB_DEF[id].path);
    },
    [navigate],
  );

  const abrirOuFocarMenu = useCallback(
    (id: TabId) => {
      setOpenTabs((prev) => (prev.includes(id) ? prev : [...prev, id]));
      navigate(TAB_DEF[id].path);
      setMenuMobileAberto(false);
    },
    [navigate],
  );

  const fecharAba = useCallback(
    (id: TabId) => {
      if (!TAB_DEF[id].fechavel) return;
      const ativo = pathToTabId(location.pathname);
      setOpenTabs((prev) => {
        const filtrada = prev.filter((x) => x !== id);
        const next = filtrada.length > 0 ? filtrada : (["inicio"] as TabId[]);
        if (ativo === id) {
          const pos = prev.indexOf(id);
          const dest = next[Math.max(0, pos - 1)] ?? "inicio";
          queueMicrotask(() => navigate(TAB_DEF[dest].path));
        }
        return next;
      });
    },
    [location.pathname, navigate],
  );

  if (!accessToken) return null;

  const emailExibicao = userLogin?.trim() ? userLogin : "—";

  function navClass(ativo: boolean) {
    return ["liga-barra-menu-topo-gatilho", ativo ? "ativa" : ""].filter(Boolean).join(" ");
  }

  const idsOrdenados = openTabs;

  const menuLateral = (
    <>
      <div className="liga-app-sidebar-topo">
        <InfotimeMarcaLogo />
      </div>
      <nav className="liga-app-menu-nav" aria-label="Menu principal">
        {(Object.keys(TAB_DEF) as TabId[]).map((id) => (
          <button
            key={id}
            type="button"
            className={["liga-menu-item", abaAtiva === id ? "ativo" : ""].filter(Boolean).join(" ")}
            onClick={() => abrirOuFocarMenu(id)}
          >
            <i className={`pi ${TAB_DEF[id].icone}`} aria-hidden />
            <span>{TAB_DEF[id].label}</span>
          </button>
        ))}
      </nav>
      <div className="liga-menu-rodape">
        <div className="liga-menu-rodape-usuario">
          <span className="liga-menu-rodape-avatar" aria-hidden>
            <i className="pi pi-user" />
          </span>
          <span className="liga-menu-rodape-email" title={emailExibicao}>
            {emailExibicao}
          </span>
        </div>
        <button type="button" className="liga-menu-rodape-sair" onClick={sair}>
          <i className="pi pi-sign-out" aria-hidden />
          <span>Sair</span>
        </button>
      </div>
    </>
  );

  return (
    <main className="liga-app-home">
      <div className="liga-app-home-principal">
        {viewportEstreito ? (
          <aside
            className={[
              "liga-app-sidebar",
              "liga-app-sidebar--drawer",
              menuMobileAberto ? "liga-app-sidebar--aberta" : "",
            ]
              .filter(Boolean)
              .join(" ")}
          >
            <button
              type="button"
              className="liga-app-botao-fechar-drawer"
              onClick={() => setMenuMobileAberto(false)}
              aria-label="Fechar menu"
            >
              <i className="pi pi-times" aria-hidden />
            </button>
            {menuLateral}
          </aside>
        ) : null}

        <section className="liga-app-home-corpo">
          <header className="liga-app-home-topbar">
            <div className="liga-app-home-topbar-esq">
              {viewportEstreito ? (
                <button
                  type="button"
                  className="liga-app-home-botao-menu-mobile"
                  onClick={() => setMenuMobileAberto(true)}
                  aria-label="Abrir menu"
                >
                  <i className="pi pi-bars" aria-hidden />
                </button>
              ) : null}
              <div className="liga-app-home-topbar-marca">
                <InfotimeMarcaLogo />
              </div>
              {!viewportEstreito ? (
                <div className="liga-app-home-barra-menu">
                  {(Object.keys(TAB_DEF) as TabId[]).map((id) => (
                    <button
                      key={id}
                      type="button"
                      className={navClass(abaAtiva === id)}
                      onClick={() => abrirOuFocarMenu(id)}
                    >
                      <i className={`pi ${TAB_DEF[id].icone}`} aria-hidden />
                      {TAB_DEF[id].label}
                    </button>
                  ))}
                </div>
              ) : null}
            </div>

            <div className="liga-app-home-topbar-busca">
              <div className="p-inputgroup w-full">
                <span className="p-inputgroup-addon py-0">
                  <i className="pi pi-search text-color-secondary" aria-hidden />
                </span>
                <InputText placeholder="Buscar…" className="w-full flex-1" disabled aria-label="Buscar (em breve)" />
              </div>
            </div>

            <div className="liga-app-home-topbar-acoes">
              <div className="liga-topbar-conta-wrap" ref={refMenuConta}>
                <button
                  type="button"
                  className="liga-topbar-avatar-gatilho"
                  aria-label="Menu da conta"
                  aria-expanded={menuContaAberto}
                  aria-haspopup="true"
                  onClick={() => setMenuContaAberto((v) => !v)}
                >
                  <i className="pi pi-user" aria-hidden />
                </button>
                {menuContaAberto ? (
                  <div className="liga-topbar-menu-conta" role="menu">
                    <div className="liga-topbar-menu-conta-usuario">
                      <span className="liga-topbar-menu-conta-email" title={emailExibicao}>
                        {emailExibicao}
                      </span>
                    </div>
                    <button type="button" className="liga-topbar-menu-conta-acao" onClick={alternarTemaApp}>
                      <i className={`pi ${tema === "light" ? "pi-moon" : "pi-sun"}`} aria-hidden />
                      <span>{tema === "light" ? "Modo escuro" : "Modo claro"}</span>
                    </button>
                    <button type="button" className="liga-topbar-menu-conta-sair" onClick={sair}>
                      <i className="pi pi-sign-out" aria-hidden />
                      <span>Sair</span>
                    </button>
                  </div>
                ) : null}
              </div>
            </div>
          </header>

          <div className="liga-home-abas-area">
            <div className="liga-home-abas-faixa">
              <div className="liga-home-abas-faixa-linha">
                {scrollAbas.mostrarNavegacao ? (
                  <button
                    type="button"
                    className="liga-home-abas-scroll-btn"
                    disabled={!scrollAbas.podeEsquerda}
                    aria-label="Abas anteriores"
                    onClick={() => rolarAbas(-1)}
                  >
                    <i className="pi pi-chevron-left" aria-hidden />
                  </button>
                ) : null}
                <div
                  ref={listaScrollRef}
                  className="liga-home-abas-lista"
                  role="tablist"
                  aria-label="Abas abertas"
                >
                  {idsOrdenados.map((id) => {
                    const meta = TAB_DEF[id];
                    return (
                      <InfotimeAba
                        key={id}
                        setRef={(el) => {
                          abaRefs.current[id] = el;
                        }}
                        icone={meta.icone}
                        titulo={meta.label}
                        ativa={abaAtiva === id}
                        fechavel={meta.fechavel}
                        ariaFechar={`Fechar ${meta.label}`}
                        aoAtivar={() => irParaAba(id)}
                        aoFechar={() => fecharAba(id)}
                      />
                    );
                  })}
                </div>
                {scrollAbas.mostrarNavegacao ? (
                  <button
                    type="button"
                    className="liga-home-abas-scroll-btn"
                    disabled={!scrollAbas.podeDireita}
                    aria-label="Próximas abas"
                    onClick={() => rolarAbas(1)}
                  >
                    <i className="pi pi-chevron-right" aria-hidden />
                  </button>
                ) : null}
              </div>
            </div>

            <div className="liga-home-conteudo">
              {idsOrdenados.map((id) => {
                const meta = TAB_DEF[id];
                const Page = meta.Page;
                const visivel = abaAtiva === id;
                return (
                  <div
                    key={id}
                    className={
                      visivel
                        ? "liga-home-painel-aba liga-home-painel-aba-visivel"
                        : "liga-home-painel-aba"
                    }
                    aria-hidden={!visivel}
                  >
                    <Page />
                  </div>
                );
              })}
            </div>
          </div>
        </section>
      </div>

      <div
        className={["liga-app-home-overlay", menuMobileAberto && viewportEstreito ? "visivel" : ""]
          .filter(Boolean)
          .join(" ")}
        onClick={() => setMenuMobileAberto(false)}
        aria-hidden
      />
    </main>
  );
}
