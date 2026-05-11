"use client";

import {
  useCallback,
  useEffect,
  useId,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
} from "react";
import { useTranslations } from "next-intl";
import ReactMarkdown from "react-markdown";
import rehypeSlug from "rehype-slug";
import remarkGfm from "remark-gfm";
import type { Components } from "react-markdown";

import "./liga-painel-ajuda-ligia.css";

const URL_MANIFEST = "/ajuda-ligia/manifest.json";
const BASE_AJUDA = "/ajuda-ligia";

/** Caminho absoluto desde a raiz do site (`/manuais/...`) ou relativo a `BASE_AJUDA`. */
function urlMarkdownAjuda(arquivo: string): string {
  if (arquivo.startsWith("/")) return arquivo;
  return `${BASE_AJUDA}/${arquivo}`;
}

export type PerfilAjudaLigia = "comum" | "tecnico" | "desenvolvedor";

type EntradaManifestAjuda = {
  id: string;
  tituloKey: string;
  arquivo: string;
  palavrasChave?: string[];
};

type ManifestAjudaLigia = {
  itens: Record<PerfilAjudaLigia, EntradaManifestAjuda[]>;
};

export type LigaPainelAjudaLigiaProps = {
  aberto: boolean;
  aoFechar: () => void;
  /** Abre com o tópico Soroteca selecionado quando o utilizador está no módulo Soroteca. */
  contextoSoroteca: boolean;
};

function normalizarTexto(s: string): string {
  return s
    .normalize("NFD")
    .replace(/\p{M}/gu, "")
    .toLowerCase();
}

/**
 * Correspondência no texto: igualdade por substring normalizada; se o termo tiver ≥5
 * caracteres e não houver match, tenta prefixos progressivos (ex.: «pesquisar» → «pesquisa»).
 */
function textoIncluiConsultaFlex(haystack: string, consulta: string): boolean {
  const h = normalizarTexto(haystack);
  const q = normalizarTexto(consulta.trim());
  if (!q) return true;
  if (q.length < 2) return h.includes(q);
  if (h.includes(q)) return true;
  if (q.length < 5) return false;
  for (let t = q.slice(0, -1); t.length >= 4; t = t.slice(0, -1)) {
    if (h.includes(t)) return true;
  }
  return false;
}

function entradaCombinaPesquisaSync(
  e: EntradaManifestAjuda,
  consulta: string,
  rotuloTitulo: string,
): boolean {
  const q = consulta.trim();
  if (!q) return true;
  if (textoIncluiConsultaFlex(rotuloTitulo, q)) return true;
  if (textoIncluiConsultaFlex(e.id, q)) return true;
  return (e.palavrasChave ?? []).some((p) => textoIncluiConsultaFlex(p, q));
}

function limparMarcasPesquisaNoArtigo(root: HTMLElement): void {
  const bloco = root.querySelector(".liga-ajuda-ligia-markdown") ?? root;
  bloco.querySelectorAll("mark.liga-ajuda-ligia-marca-pesquisa").forEach((mark) => {
    const parent = mark.parentNode;
    if (!parent) return;
    while (mark.firstChild) parent.insertBefore(mark.firstChild, mark);
    parent.removeChild(mark);
    parent.normalize();
  });
}

/** Índices [início, fim) no texto bruto do primeiro segmento cuja correspondência segue a mesma lógica da pesquisa (incl. flex). */
function encontrarPrimeiroSpanParaConsulta(
  texto: string,
  consulta: string,
): [number, number] | null {
  const q = consulta.trim();
  if (!q || q.length < 2) return null;
  const maxSpan = Math.min(texto.length, 512);
  for (let i = 0; i < texto.length; i++) {
    const jMax = Math.min(texto.length, i + maxSpan);
    for (let j = i + 1; j <= jMax; j++) {
      const slice = texto.slice(i, j);
      if (!textoIncluiConsultaFlex(slice, q)) continue;
      let end = j;
      while (end > i + 1 && textoIncluiConsultaFlex(texto.slice(i, end - 1), q)) {
        end -= 1;
      }
      return [i, end];
    }
  }
  return null;
}

function deveIgnorarNoParaMarcacao(el: HTMLElement | null): boolean {
  let p: HTMLElement | null = el;
  while (p) {
    if (p.classList?.contains("liga-ajuda-ligia-marca-pesquisa")) return true;
    const tag = p.tagName;
    if (tag === "CODE" || tag === "PRE" || tag === "SCRIPT" || tag === "STYLE") {
      return true;
    }
    p = p.parentElement;
  }
  return false;
}

/**
 * Realça ocorrências da consulta no artigo e devolve o primeiro `<mark>` para scroll.
 * Ignora blocos `pre`/`code` para evitar ruído em snippet técnico.
 */
function aplicarMarcasPesquisaNoArtigo(
  root: HTMLElement,
  consulta: string,
): HTMLElement | null {
  limparMarcasPesquisaNoArtigo(root);
  const q = consulta.trim();
  if (q.length < 2) return null;

  const bloco = root.querySelector(".liga-ajuda-ligia-markdown") ?? root;
  let primeiroMark: HTMLElement | null = null;
  let restantes = 48;

  while (restantes-- > 0) {
    const walker = document.createTreeWalker(bloco, NodeFilter.SHOW_TEXT, {
      acceptNode(node) {
        const parent = (node as Text).parentElement;
        if (!parent || deveIgnorarNoParaMarcacao(parent)) {
          return NodeFilter.FILTER_REJECT;
        }
        return NodeFilter.FILTER_ACCEPT;
      },
    });

    let substituiu = false;
    let textNode: Node | null;
    while ((textNode = walker.nextNode())) {
      const tn = textNode as Text;
      const texto = tn.textContent ?? "";
      if (!textoIncluiConsultaFlex(texto, q)) continue;

      const span = encontrarPrimeiroSpanParaConsulta(texto, q);
      if (!span) continue;

      const [a, b] = span;
      const mark = document.createElement("mark");
      mark.className = "liga-ajuda-ligia-marca-pesquisa";
      const antes = texto.slice(0, a);
      const meio = texto.slice(a, b);
      const depois = texto.slice(b);
      const frag = document.createDocumentFragment();
      if (antes) frag.appendChild(document.createTextNode(antes));
      mark.appendChild(document.createTextNode(meio));
      frag.appendChild(mark);
      if (depois) frag.appendChild(document.createTextNode(depois));
      tn.parentNode?.replaceChild(frag, tn);
      if (!primeiroMark) primeiroMark = mark;
      substituiu = true;
      break;
    }

    if (!substituiu) break;
  }

  return primeiroMark;
}

export function LigaPainelAjudaLigia({
  aberto,
  aoFechar,
  contextoSoroteca,
}: LigaPainelAjudaLigiaProps) {
  const t = useTranslations("home.ligiaAjuda");
  const idBase = useId();

  const [manifest, setManifest] = useState<ManifestAjudaLigia | null>(null);
  const [erroManifest, setErroManifest] = useState(false);
  const [perfil, setPerfil] = useState<PerfilAjudaLigia>("comum");
  const [idSelecionado, setIdSelecionado] = useState<string>("geral");
  const [pesquisaMenu, setPesquisaMenu] = useState("");
  const [markdown, setMarkdown] = useState<string>("");
  const [carregandoMd, setCarregandoMd] = useState(false);
  const [erroMd, setErroMd] = useState(false);
  const [textoPergunta, setTextoPergunta] = useState("");
  const [mensagemLigia, setMensagemLigia] = useState<string | null>(null);
  const [idsMatchCorpoExtra, setIdsMatchCorpoExtra] = useState<string[]>([]);
  /** Quando coincide com `pesquisaMenu.trim()`, a varredura do corpo (ou atalho «só título») já terminou para essa consulta. */
  const [ultimaConsultaCorpoIndexada, setUltimaConsultaCorpoIndexada] = useState<
    string | null
  >(null);
  /** Incrementado só ao iniciar cada execução debounced; async antigo ignora setState se obsoleto. */
  const pesquisaCorpoSeqRef = useRef(0);
  const pesquisaMenuRef = useRef(pesquisaMenu);
  const tRef = useRef(t);
  useLayoutEffect(() => {
    pesquisaMenuRef.current = pesquisaMenu;
    tRef.current = t;
  }, [pesquisaMenu, t]);

  const cacheMd = useRef<Map<string, string>>(new Map());
  const refArtigo = useRef<HTMLElement>(null);
  /** Pilha de `scrollTop` antes de cada salto por âncora interna (permite vários «Voltar» até ao início). */
  const historicoScrollRef = useRef<number[]>([]);
  const [podeVoltarLeitura, setPodeVoltarLeitura] = useState(false);

  const limparHistoricoLeitura = useCallback(() => {
    historicoScrollRef.current = [];
    setPodeVoltarLeitura(false);
  }, []);

  const empilharScrollAtual = useCallback(() => {
    const el = refArtigo.current;
    if (!el) return;
    historicoScrollRef.current.push(el.scrollTop);
    setPodeVoltarLeitura(true);
  }, []);

  const voltarPontoLeitura = useCallback(() => {
    const el = refArtigo.current;
    const pilha = historicoScrollRef.current;
    if (!el || pilha.length === 0) return;
    const top = pilha.pop()!;
    el.scrollTo({ top, behavior: "smooth" });
    setPodeVoltarLeitura(pilha.length > 0);
  }, []);

  const componentesMarkdown = useMemo<Components>(
    () => ({
      a: ({ href, children, ...rest }) => {
        if (href?.startsWith("#") && href.length > 1) {
          return (
            <a
              {...rest}
              href={href}
              onClick={(e) => {
                e.preventDefault();
                empilharScrollAtual();
                const id = decodeURIComponent(href.slice(1));
                const alvo = document.getElementById(id);
                if (alvo) {
                  alvo.scrollIntoView({ behavior: "smooth", block: "start" });
                }
              }}
            >
              {children}
            </a>
          );
        }
        return (
          <a href={href} {...rest}>
            {children}
          </a>
        );
      },
    }),
    [empilharScrollAtual],
  );

  useEffect(() => {
    if (!aberto) return;
    setIdSelecionado(contextoSoroteca ? "soroteca" : "geral");
  }, [aberto, contextoSoroteca]);

  useEffect(() => {
    if (!aberto) {
      limparHistoricoLeitura();
    }
  }, [aberto, limparHistoricoLeitura]);

  useEffect(() => {
    limparHistoricoLeitura();
  }, [idSelecionado, perfil, limparHistoricoLeitura]);

  useEffect(() => {
    if (!aberto) return;
    let cancelado = false;
    setErroManifest(false);

    void fetch(URL_MANIFEST)
      .then((r) => {
        if (!r.ok) throw new Error("manifest");
        return r.json() as Promise<ManifestAjudaLigia>;
      })
      .then((data) => {
        if (cancelado) return;
        setManifest(data);
      })
      .catch(() => {
        if (cancelado) return;
        setErroManifest(true);
        setManifest(null);
      });

    return () => {
      cancelado = true;
    };
  }, [aberto]);

  const itensPerfil = useMemo(() => {
    if (!manifest?.itens?.[perfil]) return [];
    return manifest.itens[perfil];
  }, [manifest, perfil]);

  const itensMenuFiltrados = useMemo(() => {
    const q = pesquisaMenu.trim();
    if (!q) return itensPerfil;
    const corpo = new Set(idsMatchCorpoExtra);
    const filtrados = itensPerfil.filter((e) => {
      const rotulo = t(e.tituloKey as Parameters<typeof t>[0]);
      return entradaCombinaPesquisaSync(e, q, rotulo) || corpo.has(e.id);
    });
    return [...filtrados].sort((a, b) => {
      const ra = t(a.tituloKey as Parameters<typeof t>[0]);
      const rb = t(b.tituloKey as Parameters<typeof t>[0]);
      const ma = entradaCombinaPesquisaSync(a, q, ra) ? 0 : 1;
      const mb = entradaCombinaPesquisaSync(b, q, rb) ? 0 : 1;
      if (ma !== mb) return ma - mb;
      return 0;
    });
  }, [itensPerfil, pesquisaMenu, t, idsMatchCorpoExtra]);

  const algumTopicoPodeBaterNoCorpo = useMemo(() => {
    const q = pesquisaMenu.trim();
    if (!q) return false;
    return itensPerfil.some((e) => {
      const rotulo = t(e.tituloKey as Parameters<typeof t>[0]);
      return !entradaCombinaPesquisaSync(e, q, rotulo);
    });
  }, [itensPerfil, pesquisaMenu, t]);

  const obterMarkdownParaPesquisa = useCallback(
    async (p: PerfilAjudaLigia, entrada: EntradaManifestAjuda): Promise<string> => {
      const chaveCache = `${p}:${entrada.id}`;
      const emCache = cacheMd.current.get(chaveCache);
      if (emCache !== undefined) return emCache;
      const url = urlMarkdownAjuda(entrada.arquivo);
      const res = await fetch(url, { cache: "force-cache" });
      if (!res.ok) return "";
      const texto = await res.text();
      cacheMd.current.set(chaveCache, texto);
      return texto;
    },
    [],
  );

  useEffect(() => {
    const q = pesquisaMenu.trim();
    if (!q) {
      setIdsMatchCorpoExtra([]);
      setUltimaConsultaCorpoIndexada(null);
      return;
    }

    const debounceId = window.setTimeout(() => {
      const seq = (pesquisaCorpoSeqRef.current += 1);
      setIdsMatchCorpoExtra([]);
      setUltimaConsultaCorpoIndexada(null);

      const tt = tRef.current;
      const precisaVarreduraCorpo = itensPerfil.some((e) => {
        const rotulo = tt(e.tituloKey as Parameters<typeof tt>[0]);
        return !entradaCombinaPesquisaSync(e, q, rotulo);
      });

      if (!precisaVarreduraCorpo) {
        setUltimaConsultaCorpoIndexada(q);
        return;
      }

      void (async () => {
        const extras: string[] = [];
        try {
          for (const e of itensPerfil) {
            if (pesquisaCorpoSeqRef.current !== seq) return;
            const rotulo = tt(e.tituloKey as Parameters<typeof tt>[0]);
            if (entradaCombinaPesquisaSync(e, q, rotulo)) continue;
            const texto = await obterMarkdownParaPesquisa(perfil, e);
            if (pesquisaCorpoSeqRef.current !== seq) return;
            if (textoIncluiConsultaFlex(texto, q)) {
              extras.push(e.id);
            }
          }
          if (pesquisaCorpoSeqRef.current !== seq) return;
          if (pesquisaMenuRef.current.trim() !== q) return;
          setIdsMatchCorpoExtra(extras);
        } finally {
          if (
            pesquisaCorpoSeqRef.current === seq &&
            pesquisaMenuRef.current.trim() === q
          ) {
            setUltimaConsultaCorpoIndexada(q);
          }
        }
      })();
    }, 200);

    return () => {
      clearTimeout(debounceId);
    };
  }, [pesquisaMenu, perfil, itensPerfil, obterMarkdownParaPesquisa]);

  const ultimaPesquisaMenuTrimRef = useRef<string | null>(null);

  /**
   * Novo termo na pesquisa → primeiro tópico da lista (melhor match).
   * Mesmo termo e lista que cresce (corpo) → mantém o tópico se ainda aparecer; senão o primeiro.
   */
  useEffect(() => {
    const q = pesquisaMenu.trim();
    if (!q) {
      ultimaPesquisaMenuTrimRef.current = null;
      return;
    }
    if (itensMenuFiltrados.length === 0) return;
    const primeiro = itensMenuFiltrados[0];
    const termoMudou = ultimaPesquisaMenuTrimRef.current !== q;
    ultimaPesquisaMenuTrimRef.current = q;
    if (termoMudou) {
      setIdSelecionado(primeiro.id);
      return;
    }
    setIdSelecionado((atual) =>
      itensMenuFiltrados.some((e) => e.id === atual) ? atual : primeiro.id,
    );
  }, [pesquisaMenu, itensMenuFiltrados]);

  /** Realça ocorrências da pesquisa no artigo e rola até à primeira marca. */
  useEffect(() => {
    const el = refArtigo.current;
    if (!el) return;
    const q = pesquisaMenu.trim();

    const run = () => {
      if (!q || carregandoMd || !markdown) {
        limparMarcasPesquisaNoArtigo(el);
        return;
      }
      const primeiro = aplicarMarcasPesquisaNoArtigo(el, q);
      if (primeiro) {
        primeiro.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    };

    let id2 = 0;
    const id1 = requestAnimationFrame(() => {
      id2 = requestAnimationFrame(run);
    });

    return () => {
      cancelAnimationFrame(id1);
      cancelAnimationFrame(id2);
      limparMarcasPesquisaNoArtigo(el);
    };
  }, [markdown, pesquisaMenu, carregandoMd, idSelecionado]);

  const carregarMarkdown = useCallback(
    async (p: PerfilAjudaLigia, entrada: EntradaManifestAjuda) => {
      const chaveCache = `${p}:${entrada.id}`;
      const emCache = cacheMd.current.get(chaveCache);
      if (emCache !== undefined) {
        setMarkdown(emCache);
        setErroMd(false);
        setCarregandoMd(false);
        return;
      }
      setCarregandoMd(true);
      setErroMd(false);
      try {
        const url = urlMarkdownAjuda(entrada.arquivo);
        const res = await fetch(url);
        if (!res.ok) throw new Error("md");
        const texto = await res.text();
        cacheMd.current.set(chaveCache, texto);
        setMarkdown(texto);
      } catch {
        setErroMd(true);
        setMarkdown("");
      } finally {
        setCarregandoMd(false);
      }
    },
    [],
  );

  useEffect(() => {
    if (!aberto || !manifest) return;
    const lista = manifest.itens[perfil];
    const entrada = lista?.find((e) => e.id === idSelecionado);
    if (!entrada) return;
    void carregarMarkdown(perfil, entrada);
  }, [aberto, manifest, perfil, idSelecionado, carregarMarkdown]);

  useEffect(() => {
    if (!aberto) return;
    const onKey = (e: KeyboardEvent) => {
      if (e.key === "Escape") aoFechar();
    };
    document.addEventListener("keydown", onKey);
    return () => document.removeEventListener("keydown", onKey);
  }, [aberto, aoFechar]);

  const enviarPerguntaLigia = () => {
    const texto = textoPergunta.trim();
    if (!texto) return;
    setMensagemLigia(t("perguntaLigiaEmBreve"));
    setTextoPergunta("");
  };

  if (!aberto) return null;

  const idPainel = `${idBase}-painel`;
  const idNav = `${idBase}-nav`;

  return (
    <>
      <div
        className="liga-ajuda-ligia-overlay"
        role="presentation"
        onClick={aoFechar}
        aria-hidden
      />
      <aside
        className="liga-ajuda-ligia-painel"
        role="dialog"
        aria-modal="true"
        aria-labelledby={`${idPainel}-titulo`}
        id={idPainel}
      >
        <header className="liga-ajuda-ligia-cabecalho">
          <h2 id={`${idPainel}-titulo`}>{t("titulo")}</h2>
          <button
            type="button"
            className="liga-ajuda-ligia-fechar"
            onClick={aoFechar}
            aria-label={t("fechar")}
          >
            ×
          </button>
        </header>

        {contextoSoroteca ? (
          <p className="liga-ajuda-ligia-contexto" role="status">
            {t("contextoSoroteca")}
          </p>
        ) : null}

        <div className="liga-ajuda-ligia-corpo">
          <div className="liga-ajuda-ligia-coluna-indice">
            <p className="liga-ajuda-ligia-indice-titulo">{t("rotuloMenuTopicos")}</p>
            <div
              className="liga-ajuda-ligia-perfis"
              role="group"
              aria-label={t("rotuloPerfisManual")}
            >
              {(
                [
                  ["comum", "perfilComum"],
                  ["tecnico", "perfilTecnico"],
                  ["desenvolvedor", "perfilDesenvolvedor"],
                ] as const
              ).map(([valor, chave]) => (
                <button
                  key={valor}
                  type="button"
                  className={
                    perfil === valor
                      ? "liga-ajuda-ligia-perfil liga-ajuda-ligia-perfil-ativo"
                      : "liga-ajuda-ligia-perfil"
                  }
                  aria-pressed={perfil === valor}
                  onClick={() => setPerfil(valor)}
                >
                  {t(chave)}
                </button>
              ))}
            </div>
            <label className="liga-ajuda-ligia-pesquisa-wrap">
              <span className="liga-ajuda-ligia-pesquisa-label">
                {t("pesquisaMenuLabel")}
              </span>
              <input
                type="search"
                className="liga-ajuda-ligia-pesquisa-input"
                value={pesquisaMenu}
                onChange={(e) => setPesquisaMenu(e.target.value)}
                placeholder={t("pesquisaMenuPlaceholder")}
                autoComplete="off"
                aria-label={t("pesquisaMenuPlaceholder")}
              />
            </label>
            <nav
              id={idNav}
              className="liga-ajuda-ligia-nav"
              aria-label={t("rotuloNavegacaoAjuda")}
            >
              {erroManifest ? (
                <p className="liga-ajuda-ligia-estado liga-ajuda-ligia-erro" role="alert">
                  {t("erroCarregarManifest")}
                </p>
              ) : !manifest ? (
                <p className="liga-ajuda-ligia-estado" role="status">
                  {t("carregando")}
                </p>
              ) : itensMenuFiltrados.length === 0 ? (
                pesquisaMenu.trim() &&
                algumTopicoPodeBaterNoCorpo &&
                ultimaConsultaCorpoIndexada !== pesquisaMenu.trim() ? (
                  <p className="liga-ajuda-ligia-estado" role="status">
                    {t("pesquisaMenuCorpo")}
                  </p>
                ) : (
                  <p className="liga-ajuda-ligia-estado">{t("pesquisaSemResultados")}</p>
                )
              ) : (
                <ul className="liga-ajuda-ligia-nav-lista">
                  {itensMenuFiltrados.map((e) => (
                    <li key={e.id}>
                      <button
                        type="button"
                        className={
                          idSelecionado === e.id
                            ? pesquisaMenu.trim()
                              ? "liga-ajuda-ligia-nav-item liga-ajuda-ligia-nav-item-ativo liga-ajuda-ligia-nav-item-ativo-com-pesquisa"
                              : "liga-ajuda-ligia-nav-item liga-ajuda-ligia-nav-item-ativo"
                            : "liga-ajuda-ligia-nav-item"
                        }
                        aria-current={
                          idSelecionado === e.id ? "page" : undefined
                        }
                        onClick={() => setIdSelecionado(e.id)}
                      >
                        {t(e.tituloKey as "menuGeral" | "menuSoroteca")}
                      </button>
                    </li>
                  ))}
                </ul>
              )}
            </nav>
          </div>

          <div className="liga-ajuda-ligia-artigo-wrap">
            {!carregandoMd && !erroMd && markdown ? (
              <div className="liga-ajuda-ligia-artigo-barra">
                <button
                  type="button"
                  className="liga-ajuda-ligia-voltar-leitura"
                  disabled={!podeVoltarLeitura}
                  onClick={voltarPontoLeitura}
                  aria-label={t("voltarLeituraAria")}
                >
                  <i className="pi pi-arrow-left" aria-hidden />
                  <span>{t("voltarLeitura")}</span>
                </button>
              </div>
            ) : null}
            <article
              ref={refArtigo}
              className="liga-ajuda-ligia-artigo"
              aria-labelledby={`${idPainel}-titulo`}
            >
              {carregandoMd ? (
                <p className="liga-ajuda-ligia-estado" role="status">
                  {t("carregando")}
                </p>
              ) : erroMd ? (
                <p className="liga-ajuda-ligia-estado liga-ajuda-ligia-erro" role="alert">
                  {t("erroCarregarMd")}
                </p>
              ) : (
                <div className="liga-ajuda-ligia-prose liga-ajuda-ligia-markdown">
                  <ReactMarkdown
                    remarkPlugins={[remarkGfm]}
                    rehypePlugins={[rehypeSlug]}
                    components={componentesMarkdown}
                  >
                    {markdown}
                  </ReactMarkdown>
                </div>
              )}
            </article>
          </div>
        </div>

        <footer className="liga-ajuda-ligia-pergunta">
          <h3 className="liga-ajuda-ligia-pergunta-titulo">{t("perguntaLigiaTitulo")}</h3>
          <p className="liga-ajuda-ligia-pergunta-ajuda">{t("perguntaLigiaDescricao")}</p>
          <textarea
            className="liga-ajuda-ligia-pergunta-textarea"
            value={textoPergunta}
            onChange={(e) => setTextoPergunta(e.target.value)}
            placeholder={t("perguntaLigiaPlaceholder")}
            rows={3}
            aria-label={t("perguntaLigiaPlaceholder")}
          />
          <div className="liga-ajuda-ligia-pergunta-acoes">
            <button
              type="button"
              className="liga-ajuda-ligia-pergunta-enviar"
              onClick={enviarPerguntaLigia}
              disabled={!textoPergunta.trim()}
            >
              {t("perguntaLigiaEnviar")}
            </button>
          </div>
          {mensagemLigia ? (
            <p className="liga-ajuda-ligia-pergunta-feedback" role="status">
              {mensagemLigia}
            </p>
          ) : null}
        </footer>
      </aside>
    </>
  );
}
