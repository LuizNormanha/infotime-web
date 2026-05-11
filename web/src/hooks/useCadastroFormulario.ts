"use client";

// [APRESENTAÇÃO] Hook de ciclo de vida de formulário de cadastro.
// Não contém lógica de negócio — apenas chama endpoints da API BFF e repassa erros.

import { useCallback, useEffect, useLayoutEffect, useRef, useState } from "react";
import { useTranslations } from "next-intl";

import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import {
  confirmarLoginSubstituindoSessaoAtiva,
  reautenticarSessao,
} from "@/lib/autenticacao/reautenticacao";
import {
  deveReautenticarPorResposta,
  validarSessaoJwtAtual,
} from "@/lib/autenticacao/withSessionGuard";
import { traduzirErrosValidacaoParaFormulario } from "@/lib/validacao-api-i18n";
import { recarregarSessaoAtual, useSessaoAtual } from "@/hooks/useSessaoAtual";

type OpcoesCadastroFormulario<T extends Record<string, unknown>> = {
  tela: string;
  endpoint: string; // ex: "/api/clientes"
  estadoVazio: () => T;
  idEdicao: string | null;
  aoFechar: () => void;
  /** Se false, não sobrescreve `id_tenacidade` com o tenant do JWT (implantação / outro tenant). */
  injetarTenacidadeDaSessao?: boolean;
  /** Habilita fluxo de reautenticação em modal ao receber 401 no save. */
  habilitarReautenticacaoEmModal?: boolean;
  /**
   * Ajusta o JSON do POST/PUT após auditoria (ex.: mestre–detalhe — enviar só campos aceitos nas linhas do detalhe).
   * O botão Salvar do formulário continua sendo o único ponto de persistência.
   * Para campos mascarados (CPF, CEP, telefone), normalizar com `@/lib/mascara-para-api` antes do envio (ver MCP `padroes/ui` §10.4).
   */
  prepararCorpoSalvar?: (corpo: Record<string, unknown>) => Record<string, unknown>;
  /** Normaliza o GET antes de popular o estado (ex.: garantir array do detalhe). */
  aposCarregarDados?: (dados: T) => T;
  /**
   * Validação no cliente antes do POST/PUT. Se retornar objeto com chaves, o salvamento
   * é abortado, `erros` recebe o mapa e é exibido toast de validação.
   */
  validarAntesSalvar?: (valores: T) => Record<string, string> | null | undefined;
  /** Executado após POST/PUT com sucesso, antes de `aoFechar`. */
  aposSalvarSucesso?: (dadosSalvos: Record<string, unknown> | null) => void;
  /** Se false, não chama `aoFechar` após salvar (ex.: mestre–detalhe que precisa permanecer na tela). Default: true. */
  fecharAposSalvar?: boolean;
  /**
   * Após PUT com sucesso em edição, busca de novo `GET …/:id` e atualiza o estado
   * (ex.: `versao_ativa` e demais campos persistidos no servidor).
   */
  recarregarAposSalvar?: boolean;
  aposExcluirSucesso?: () => void;
  /**
   * Se true, o retorno do hook inclui `recarregarRegistro` (refaz GET com `idEdicao`).
   * Útil após operações fora do PUT (ex.: PATCH de mudança de status).
   */
  exporRecarregarRegistro?: boolean;
};

type RetornoCadastroFormulario<T extends Record<string, unknown>> = {
  valores: T;
  aoAlterarCampo: (chave: string, valor: unknown) => void;
  carregando: boolean;
  salvando: boolean;
  excluindo: boolean;
  /** Refaz GET `endpoint/:idEdicao` e reaplica `aposCarregarDados` (só em edição). */
  recarregarRegistro?: () => Promise<void>;
  erros: Record<string, string>;
  erroGlobal: string | null;
  reautenticacao: {
    aberta: boolean;
    login: string;
    senha: string;
    carregando: boolean;
    erro: string | null;
    captcha: { id: string; pergunta: string } | null;
    captchaResposta: string;
    aoAlterarLogin: (valor: string) => void;
    aoAlterarSenha: (valor: string) => void;
    aoAlterarCaptchaResposta: (valor: string) => void;
    aoConfirmar: () => Promise<void>;
    aoCancelar: () => void;
    /** Mesmo fluxo da página `/login` quando a API retorna 409 (sessão em outro dispositivo). */
    modalSubstituirSessao: {
      aberto: boolean;
      mensagem: string;
      aoConfirmar: () => Promise<void>;
      aoFechar: () => void;
    };
  };
  aoSalvar: () => Promise<void>;
  aoExcluir: () => Promise<void>;
};

export function useCadastroFormulario<T extends Record<string, unknown>>(
  opcoes: OpcoesCadastroFormulario<T>,
): RetornoCadastroFormulario<T> {
  const {
    endpoint,
    estadoVazio,
    idEdicao,
    aoFechar,
    injetarTenacidadeDaSessao = true,
    habilitarReautenticacaoEmModal = false,
    prepararCorpoSalvar,
    aposCarregarDados,
    validarAntesSalvar,
    aposSalvarSucesso,
    fecharAposSalvar = true,
  recarregarAposSalvar = false,
  aposExcluirSucesso,
  exporRecarregarRegistro = false,
} = opcoes;
  const feedback = useLigaFeedback();
  const tValidacao = useTranslations("home.validation");
  const tFeedback = useTranslations("home.feedback");
  const tLogin = useTranslations("login");

  const sessao = useSessaoAtual();

  /** Evita reexecutar o efeito de carga quando o pai passa `aposCarregarDados` inline (nova referência a cada render). */
  const aposCarregarDadosRef = useRef(aposCarregarDados);
  useLayoutEffect(() => {
    aposCarregarDadosRef.current = aposCarregarDados;
  }, [aposCarregarDados]);

  const [valores, setValores] = useState<T>(estadoVazio);
  // Comeca em loading na edicao para evitar "flash" de formulario vazio
  // antes do efeito de busca preencher os dados.
  const [carregando, setCarregando] = useState(Boolean(idEdicao));
  const [salvando, setSalvando] = useState(false);
  const [excluindo, setExcluindo] = useState(false);
  const [erros, setErros] = useState<Record<string, string>>({});
  const [erroGlobal, setErroGlobal] = useState<string | null>(null);
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
  const [modalSubstituirSessaoAberta, setModalSubstituirSessaoAberta] =
    useState(false);
  const [mensagemModalSubstituirSessao, setMensagemModalSubstituirSessao] =
    useState("");
  const tentativaSalvarPendenteRef = useRef<(() => Promise<void>) | null>(null);

  const recarregarRegistro = useCallback(async () => {
    if (!idEdicao) return;
    setCarregando(true);
    setErroGlobal(null);
    try {
      const res = await fetch(`${endpoint}/${idEdicao}`, {
        cache: "no-store",
      });
      if (!res.ok) throw new Error(`http_${res.status}`);
      const json = (await res.json()) as { dados: T } | T;
      let dados = "dados" in (json as object) ? (json as { dados: T }).dados : (json as T);
      const normalizar = aposCarregarDadosRef.current;
      if (normalizar) dados = normalizar(dados);
      setValores(dados);
    } catch (e: unknown) {
      setErroGlobal(e instanceof Error ? e.message : "Erro ao carregar dados.");
    } finally {
      setCarregando(false);
    }
  }, [endpoint, idEdicao]);

  // Carrega dados quando idEdicao muda (edição).
  // Deve ser declarado ANTES do efeito de auditoria para que, no batching do React 18,
  // a atualização de estadoVazio() seja enfileirada antes da injeção de auditoria.
  useEffect(() => {
    if (!idEdicao) {
      setValores(estadoVazio());
      setCarregando(false);
      return;
    }

    const ac = new AbortController();
    setCarregando(true);
    setErros({});
    setErroGlobal(null);

    fetch(`${endpoint}/${idEdicao}`, {
      signal: ac.signal,
      cache: "no-store",
    })
      .then(async (res) => {
        if (!res.ok) throw new Error(`http_${res.status}`);
        const json = (await res.json()) as { dados: T } | T;
        // Suporta resposta com envelope { dados: ... } ou direta
        let dados = "dados" in (json as object) ? (json as { dados: T }).dados : (json as T);
        const normalizar = aposCarregarDadosRef.current;
        if (normalizar) dados = normalizar(dados);
        setValores(dados);
      })
      .catch((e: unknown) => {
        if (e instanceof DOMException && e.name === "AbortError") return;
        setErroGlobal(e instanceof Error ? e.message : "Erro ao carregar dados.");
      })
      .finally(() => {
        setCarregando(false);
      });

    return () => ac.abort();
    // estadoVazio: função estável por contrato do hook; incluir reexecutaria o GET ao trocar referência.
  // eslint-disable-next-line react-hooks/exhaustive-deps -- estadoVazio omitido de propósito (ver comentário acima)
  }, [idEdicao, endpoint]);

  // Preenche automaticamente os campos de auditoria a partir da sessão.
  // Declarado APÓS o efeito de carregamento para garantir que, no batching do React 18,
  // sua atualização funcional seja aplicada depois de estadoVazio() — nunca antes.
  // Executa apenas em formulários de criação (idEdicao = null) e quando a sessão carrega.
  useEffect(() => {
    if (idEdicao) return;
    setValores((prev) => {
      const auditoria: Record<string, unknown> = {};
      if (
        injetarTenacidadeDaSessao &&
        "id_tenacidade" in prev &&
        sessao.idTenacidade !== null
      )
        auditoria.id_tenacidade = sessao.idTenacidade;
      if ("id_usuario_auditoria" in prev && sessao.idUsuario !== null)
        auditoria.id_usuario_auditoria = sessao.idUsuario;
      if ("nome_aplicacao_auditoria" in prev)
        auditoria.nome_aplicacao_auditoria = "infotime-web";
      if (Object.keys(auditoria).length === 0) return prev;
      return { ...prev, ...auditoria } as T;
    });
  }, [idEdicao, injetarTenacidadeDaSessao, sessao.idTenacidade, sessao.idUsuario]);

  function aoAlterarCampo(chave: string, valor: unknown): void {
    setValores((prev) => ({ ...prev, [chave]: valor }));
    setErros((prev) => {
      if (!(chave in prev)) return prev;
      const next = { ...prev };
      delete next[chave];
      return next;
    });
  }

  async function aoSalvar(): Promise<void> {
    setSalvando(true);
    setErros({});
    setErroGlobal(null);

    const errosAntes = validarAntesSalvar?.(valores);
    if (errosAntes && Object.keys(errosAntes).length > 0) {
      setErros(errosAntes);
      setSalvando(false);
      feedback.aviso(tFeedback("toastValidacaoCampos"));
      return;
    }

    // Injeta campos de auditoria diretamente da sessão no momento do salvamento,
    // garantindo valores corretos mesmo que o estado React ainda não tenha sido atualizado.
    const corpo: Record<string, unknown> = { ...valores };
    if (injetarTenacidadeDaSessao && "id_tenacidade" in valores)
      corpo.id_tenacidade = sessao.idTenacidade;
    if ("id_usuario_auditoria" in valores) corpo.id_usuario_auditoria = sessao.idUsuario;
    if ("nome_aplicacao_auditoria" in valores) corpo.nome_aplicacao_auditoria = "infotime-web";

    const corpoFinal = prepararCorpoSalvar ? prepararCorpoSalvar(corpo) : corpo;

    try {
      const url = idEdicao ? `${endpoint}/${idEdicao}` : endpoint;
      const method = idEdicao ? "PUT" : "POST";

      const tentarSalvarComCorpo = async (permitirReautenticacao = true) => {
        if (habilitarReautenticacaoEmModal && permitirReautenticacao) {
          const sessaoValida = await validarSessaoJwtAtual();
          if (!sessaoValida) {
            tentativaSalvarPendenteRef.current = async () => {
              setSalvando(true);
              try {
                await tentarSalvarComCorpo(false);
              } finally {
                setSalvando(false);
              }
            };
            setReautenticacaoAberta(true);
            setErroReautenticacao(null);
            return;
          }
        }

        const res = await fetch(url, {
          method,
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(corpoFinal),
        });

        if (!res.ok) {
          if (
            habilitarReautenticacaoEmModal &&
            permitirReautenticacao &&
            (await deveReautenticarPorResposta(res))
          ) {
            tentativaSalvarPendenteRef.current = async () => {
              setSalvando(true);
              try {
                await tentarSalvarComCorpo(false);
              } finally {
                setSalvando(false);
              }
            };
            setReautenticacaoAberta(true);
            setErroReautenticacao(null);
            return;
          }
          await tratarErroResposta(res);
          return;
        }

        const corpoSucesso = (await res.json().catch(() => null)) as
          | Record<string, unknown>
          | null;
        const dadosSalvos =
          corpoSucesso &&
          typeof corpoSucesso === "object" &&
          "dados" in corpoSucesso &&
          corpoSucesso.dados &&
          typeof corpoSucesso.dados === "object"
            ? (corpoSucesso.dados as Record<string, unknown>)
            : corpoSucesso;
        aposSalvarSucesso?.(dadosSalvos);
        if (idEdicao && recarregarAposSalvar) {
          try {
            const r = await fetch(`${endpoint}/${idEdicao}`, { cache: "no-store" });
            if (r.ok) {
              const json = (await r.json()) as { dados: T } | T;
              let dados = "dados" in (json as object) ? (json as { dados: T }).dados : (json as T);
              const normalizar = aposCarregarDadosRef.current;
              if (normalizar) dados = normalizar(dados);
              setValores(dados);
            }
          } catch {
            /* mantém estado já salvo */
          }
        }
        feedback.salvo();
        if (fecharAposSalvar) aoFechar();
      };

      await tentarSalvarComCorpo(true);
    } catch (e: unknown) {
      if (!(e instanceof ErroTratado)) {
        setErroGlobal(e instanceof Error ? e.message : "Erro ao salvar.");
      }
    } finally {
      setSalvando(false);
    }
  }

  async function aoExcluir(): Promise<void> {
    if (!idEdicao) return;

    setExcluindo(true);
    setErros({});
    setErroGlobal(null);

    try {
      const res = await fetch(`${endpoint}/${idEdicao}`, { method: "DELETE" });

      if (!res.ok) {
        await tratarErroResposta(res);
        return;
      }

      aposExcluirSucesso?.();
      feedback.excluido();
      aoFechar();
    } catch (e: unknown) {
      if (!(e instanceof ErroTratado)) {
        setErroGlobal(e instanceof Error ? e.message : "Erro ao excluir.");
      }
    } finally {
      setExcluindo(false);
    }
  }

  // Trata resposta de erro da API:
  // - 400 com campo `errors` → popula erros por campo
  // - 400 sem campo `errors` → popula erroGlobal
  async function tratarErroResposta(res: Response): Promise<void> {
    try {
      const corpo = await res.json().catch(() => ({}));
      const { campos, global } = traduzirErrosValidacaoParaFormulario(
        corpo,
        (key, values) => tValidacao(key, values),
      );

      if (Object.keys(campos).length > 0) {
        setErros(campos);
        setErroGlobal(global ?? null);
        feedback.aviso(tFeedback("toastValidacaoCampos"));
        return;
      }

      setErros({});
      let msgGlobal = global ?? extrairMensagemGlobalDeCorpo(corpo, res.status);
      if (msgGlobal === "Validation failed") {
        msgGlobal = tValidacao("respostaInvalida");
      }
      setErroGlobal(msgGlobal);
      feedback.erroDetalhado(tFeedback("toastFalhaOperacao"), msgGlobal);
    } catch {
      const fallback = `Erro ${res.status}`;
      setErroGlobal(fallback);
      feedback.erroDetalhado(
        tFeedback("toastErroRespostaServidor"),
        fallback,
      );
    }
    throw new ErroTratado();
  }

  async function confirmarReautenticacao(): Promise<void> {
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
      setErroReautenticacao(null);
      const pendente = tentativaSalvarPendenteRef.current;
      tentativaSalvarPendenteRef.current = null;
      if (pendente) {
        await pendente();
      } else {
        feedback.aviso("Sessão renovada. Clique em salvar novamente para concluir.");
      }
    } catch {
      setErroReautenticacao("Não foi possível reautenticar agora. Tente novamente.");
    } finally {
      setReautenticando(false);
    }
  }

  async function confirmarSubstituirSessaoDepoisDoModal(): Promise<void> {
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
        feedback.aviso(aviso);
      }
      recarregarSessaoAtual();
      setReautenticacaoAberta(false);
      setSenhaReautenticacao("");
      setErroReautenticacao(null);
      const pendente = tentativaSalvarPendenteRef.current;
      tentativaSalvarPendenteRef.current = null;
      if (pendente) {
        await pendente();
      } else {
        feedback.aviso(
          "Sessão renovada. Clique em salvar novamente para concluir.",
        );
      }
    } catch {
      setErroReautenticacao(
        "Não foi possível confirmar o login. Tente novamente.",
      );
    } finally {
      setReautenticando(false);
    }
  }

  return {
    valores,
    aoAlterarCampo,
    carregando,
    salvando,
    excluindo,
    ...(exporRecarregarRegistro ? { recarregarRegistro } : {}),
    erros,
    erroGlobal,
    reautenticacao: {
      aberta: reautenticacaoAberta,
      login: loginReautenticacao,
      senha: senhaReautenticacao,
      carregando: reautenticando,
      erro: erroReautenticacao,
      captcha: captchaReautenticacao,
      captchaResposta: captchaRespostaReautenticacao,
      aoAlterarLogin: setLoginReautenticacao,
      aoAlterarSenha: setSenhaReautenticacao,
      aoAlterarCaptchaResposta: setCaptchaRespostaReautenticacao,
      aoConfirmar: confirmarReautenticacao,
      aoCancelar: () => {
        if (reautenticando) return;
        setModalSubstituirSessaoAberta(false);
        setReautenticacaoAberta(false);
        setErroReautenticacao(null);
      },
      modalSubstituirSessao: {
        aberto: modalSubstituirSessaoAberta,
        mensagem: mensagemModalSubstituirSessao,
        aoConfirmar: confirmarSubstituirSessaoDepoisDoModal,
        aoFechar: () => {
          if (!reautenticando) setModalSubstituirSessaoAberta(false);
        },
      },
    },
    aoSalvar,
    aoExcluir,
  };
}

function extrairMensagemGlobalDeCorpo(corpo: unknown, status: number): string {
  if (!corpo || typeof corpo !== "object") {
    return `Erro ${status}`;
  }
  const c = corpo as { message?: unknown };
  if (typeof c.message === "string") {
    return c.message;
  }
  if (Array.isArray(c.message) && c.message.length) {
    return c.message.map(String).join(" ");
  }
  return `Erro ${status}`;
}

// Sentinela interna para distinguir erros já tratados de erros inesperados
class ErroTratado extends Error {}
