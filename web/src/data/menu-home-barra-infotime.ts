import {
  normalizarMenu,
  type LigaNoMenu,
} from "@/components/navegacao/menu/liga-menu-arvore";
import type { LigaMenuEntrada, LigaMenuEstruturaIds } from "@/components/navegacao/menu/liga-menu-tipos";

function noPorId(nos: LigaNoMenu[], id: string): LigaNoMenu | null {
  for (const n of nos) {
    if (n.id === id) return n;
    const d = noPorId(n.filhos, id);
    if (d) return d;
  }
  return null;
}

function filhoDireto(pai: LigaNoMenu, id: string): LigaNoMenu | null {
  return pai.filhos.find((c) => c.id === id) ?? null;
}

function cloneNo(no: LigaNoMenu): LigaMenuEntrada {
  if (no.filhos.length === 0) return no.id;
  return { id: no.id, filhos: no.filhos.map(cloneNo) };
}

function coletarIdsMenuPermitido(estrutura: LigaMenuEstruturaIds): Set<string> {
  const s = new Set<string>();
  const walk = (e: LigaMenuEntrada) => {
    if (typeof e === "string") s.add(e);
    else {
      s.add(e.id);
      for (const f of e.filhos ?? []) walk(f);
    }
  };
  for (const item of estrutura) walk(item);
  return s;
}

function filtrarEntrada(
  e: LigaMenuEntrada,
  permitidos: Set<string>,
): LigaMenuEntrada | null {
  if (typeof e === "string") {
    if (e.startsWith("infotime-")) return e;
    return permitidos.has(e) ? e : null;
  }
  const filhos = (e.filhos ?? [])
    .map((f) => filtrarEntrada(f, permitidos))
    .filter((x): x is LigaMenuEntrada => x !== null);
  if (filhos.length === 0) return null;
  return { id: e.id, filhos };
}

function filtrarPorPermissao(
  estrutura: LigaMenuEstruturaIds,
  permitidos: Set<string>,
): LigaMenuEstruturaIds {
  const out: LigaMenuEstruturaIds = [];
  for (const item of estrutura) {
    const e = filtrarEntrada(item, permitidos);
    if (e !== null) out.push(e);
  }
  return out;
}

/**
 * Barra e cascatas InfoTIME (referência nas telas enviadas) + complemento do restante do DST.
 */
export function tryMontarMenuHomeBarraInfotime(
  estrutura: LigaMenuEstruturaIds,
): LigaMenuEstruturaIds {
  const permitidos = coletarIdsMenuPermitido(estrutura);
  const raiz = normalizarMenu(estrutura);
  const modulos = noPorId(raiz, "modulos");
  const cadastros = noPorId(raiz, "cadastros");
  const dashboard = noPorId(raiz, "dashboard");
  const relatorios = noPorId(raiz, "relatorios");
  if (!modulos || !cadastros || !dashboard) {
    return estrutura;
  }

  const modRecepcao = filhoDireto(modulos, "mod-recepção");
  const modFaturamento = filhoDireto(modulos, "mod-faturamento");
  const modFinanceiro = filhoDireto(modulos, "mod-financeiro");
  const modEstoque = filhoDireto(modulos, "mod-estoque");

  const idsModExtraidos = new Set([
    "mod-recepção",
    "mod-faturamento",
    "mod-financeiro",
    "mod-estoque",
  ]);
  const modulosRestantes = modulos.filhos.filter((n) => !idsModExtraidos.has(n.id));

  const cadGrupoClientes = filhoDireto(cadastros, "cad-grupo-clientes");
  const cadEstoque = filhoDireto(cadastros, "cad-estoque");
  const cadFinanceiro = filhoDireto(cadastros, "cad-financeiro");
  const cadAcesso = filhoDireto(cadastros, "cad-acesso");
  const cadIntegracoes = filhoDireto(cadastros, "cad-integrações");
  const cadEmpresas = filhoDireto(cadastros, "cad-empresas");
  const cadAcessoPessoal = cadAcesso ? filhoDireto(cadAcesso, "cad-acesso-pessoal") : null;

  const noFornecedoresFab = cadEstoque
    ? noPorId(cadEstoque.filhos, "cad-estoque-fornecedores-fabricantes")
    : null;

  const rhFilhosRef: LigaMenuEntrada[] = [
    "cad-acesso-usuário",
    "cad-acesso-pessoal-cargos",
    "infotime-rh-classificacao-cargo",
    "infotime-rh-motivos-reajuste",
    "infotime-rh-niveis-classificacao-cargos",
    "infotime-rh-pop-documentos",
    "infotime-rh-tarefas-colaborador",
  ];

  if (cadAcesso) {
    const priorRh = new Set(
      rhFilhosRef.map((x) => (typeof x === "string" ? x : x.id)),
    );
    for (const f of cadAcesso.filhos) {
      if (f.id === "cad-acesso-usuário") continue;
      if (f.id === "cad-acesso-pessoal") {
        for (const pf of f.filhos) {
          if (pf.id !== "cad-acesso-pessoal-cargos") {
            rhFilhosRef.push(cloneNo(pf));
          }
        }
        continue;
      }
      if (!priorRh.has(f.id)) rhFilhosRef.push(cloneNo(f));
    }
  }

  const rh: LigaMenuEntrada = {
    id: "infotime-rh",
    filhos: rhFilhosRef,
  };

  const comercialFilhosRef: LigaMenuEntrada[] = [
    {
      id: "infotime-comercial-clientes-congresso",
      filhos: ["cadastros-clientes"],
    },
    {
      id: "infotime-comercial-implantacoes",
      filhos: [
        "infotime-comercial-impl-em-andamento",
        "infotime-comercial-impl-pausadas",
        "infotime-comercial-impl-realizadas",
        "infotime-comercial-impl-tarefas",
        "infotime-comercial-impl-tarefas-por-solucao",
      ],
    },
    "mod-recepção-orçamento",
    "infotime-comercial-negociacoes",
    "infotime-comercial-pipeline",
    "infotime-comercial-propostas",
    "infotime-comercial-negociacoes-tarefa",
    "mod-faturamento-indicadores-faturamento",
    "infotime-comercial-pesquisas-satisfacao",
  ];

  if (modRecepcao) {
    const skip = new Set(["mod-recepção-orçamento"]);
    const restantes = modRecepcao.filhos.filter((c) => !skip.has(c.id));
    if (restantes.length > 0) {
      comercialFilhosRef.push({
        id: "infotime-comercial-demais-recepcao",
        filhos: restantes.map(cloneNo),
      });
    }
  }
  if (modFaturamento) {
    const skip = new Set([
      "mod-faturamento-indicadores-faturamento",
      "mod-faturamento-nota-fiscal",
    ]);
    const restantes = modFaturamento.filhos.filter((c) => !skip.has(c.id));
    if (restantes.length > 0) {
      comercialFilhosRef.push({
        id: "infotime-comercial-demais-faturamento",
        filhos: restantes.map(cloneNo),
      });
    }
  }

  const comercial: LigaMenuEntrada = {
    id: "infotime-comercial",
    filhos: comercialFilhosRef,
  };

  const financeiroFilhosRef: LigaMenuEntrada[] = [
    "infotime-fin-contas-pagar",
    "infotime-fin-contas-receber",
    {
      id: "infotime-fin-grupo-faturamento",
      filhos: [
        "infotime-fin-fat-aniversarios-contrato",
        "infotime-fin-fat-boletos",
        "infotime-fin-fat-licencas",
        "mod-faturamento-nota-fiscal",
      ],
    },
    "infotime-fin-fechamento",
    "mod-financeiro-infotime",
    "cad-financeiro-tabelas-de-preços",
    "mod-faturamento-devedores",
    "mod-financeiro-movimento-de-caixa-geral",
  ];

  if (modFinanceiro && modFinanceiro.filhos.length > 0) {
    const jaFin = new Set([
      "mod-financeiro-infotime",
      "mod-financeiro-movimento-de-caixa-geral",
    ]);
    const demais = modFinanceiro.filhos.filter((c) => !jaFin.has(c.id));
    if (demais.length > 0) {
      financeiroFilhosRef.push({
        id: "infotime-fin-demais-modulo",
        filhos: demais.map(cloneNo),
      });
    }
  }
  if (cadFinanceiro && cadFinanceiro.filhos.length > 0) {
    const jaCadFin = new Set(["cad-financeiro-tabelas-de-preços"]);
    const demais = cadFinanceiro.filhos.filter((c) => !jaCadFin.has(c.id));
    if (demais.length > 0) {
      financeiroFilhosRef.push({
        id: "infotime-fin-demais-cadastro",
        filhos: demais.map(cloneNo),
      });
    }
  }

  const financeiro: LigaMenuEntrada = {
    id: "infotime-financeiro",
    filhos: financeiroFilhosRef,
  };

  const refsEstoque4 = new Set([
    "mod-estoque-indicador-estoque",
    "mod-estoque-entrada-de-produtos",
    "mod-estoque-controle-requisição",
    "mod-estoque-baixa-de-produtos",
  ]);
  const estoqueFilhosRef: LigaMenuEntrada[] = [
    "mod-estoque-indicador-estoque",
    "mod-estoque-entrada-de-produtos",
    "mod-estoque-controle-requisição",
    "mod-estoque-baixa-de-produtos",
  ];
  if (modEstoque) {
    const demais = modEstoque.filhos.filter((c) => !refsEstoque4.has(c.id));
    if (demais.length > 0) {
      estoqueFilhosRef.push({
        id: "infotime-estoque-demais",
        filhos: demais.map(cloneNo),
      });
    }
  }
  if (cadEstoque) estoqueFilhosRef.push(cloneNo(cadEstoque));

  const estoque: LigaMenuEntrada = {
    id: "infotime-estoque",
    filhos: estoqueFilhosRef,
  };

  const cadastrosFilhosRef: LigaMenuEntrada[] = [
    {
      id: "infotime-cad-acessos",
      filhos: ["cad-acesso-usuário", "cad-acesso-perfil"],
    },
    {
      id: "infotime-cad-comercial",
      filhos: [
        "infotime-cad-com-canais-cliente",
        "infotime-cad-com-categorias-produto",
        "infotime-cad-com-concorrentes",
        "infotime-cad-com-dimensoes",
        "infotime-cad-com-fases",
        "infotime-cad-com-mensagens",
        "infotime-cad-com-motivos-perda",
        "infotime-cad-com-produtos-servicos",
        "infotime-cad-com-tipos-contrato",
        "infotime-cad-com-tipos-negocio",
      ],
    },
    {
      id: "infotime-cad-config-gerais",
      filhos: [
        "preferencias-formularios",
        "preferencias-layout-formulario",
        "cad-auditoria",
      ],
    },
    ...(cadEmpresas ? [cloneNo(cadEmpresas)] : []),
    ...(cadEstoque ? [cloneNo(cadEstoque)] : []),
    {
      id: "infotime-cad-financeiro",
      filhos: [
        "infotime-cad-fin-agencias",
        "infotime-cad-fin-bancos",
        "infotime-cad-fin-centro-custo",
        "infotime-cad-fin-contas-caixa",
        "cad-financeiro-fatores",
        "infotime-cad-fin-regioes-estaduais",
        "infotime-cad-fin-tipos-cliente",
        "infotime-cad-fin-tipos-documento",
      ],
    },
    (() => {
      const filhosIntegracao: LigaMenuEntrada[] = [
        "infotime-cad-int-codigo-externo",
        "infotime-cad-int-config-cobranca",
        "infotime-cad-int-tipos-especie",
      ];
      if (cadIntegracoes && cadIntegracoes.filhos.length > 0) {
        filhosIntegracao.push({
          id: "infotime-cad-int-demais-lab",
          filhos: cadIntegracoes.filhos.map(cloneNo),
        });
      }
      return { id: "infotime-cad-integracao", filhos: filhosIntegracao };
    })(),
    (() => {
      const filhosPessoal: LigaMenuEntrada[] = [
        "infotime-cad-pess-situacoes-colaborador",
        "infotime-cad-pess-tipos-colaborador",
        "infotime-cad-pess-tipos-despesa-viagem",
        "infotime-cad-pess-tipos-finalidade-viagem",
        "infotime-cad-pess-tipos-meio-transporte",
      ];
      if (cadAcessoPessoal && cadAcessoPessoal.filhos.length > 0) {
        filhosPessoal.push({
          id: "infotime-cad-pessoal-demais-dst",
          filhos: cadAcessoPessoal.filhos.map(cloneNo),
        });
      }
      return { id: "infotime-cad-pessoal", filhos: filhosPessoal };
    })(),
    {
      id: "infotime-cad-site-portal",
      filhos: [
        "infotime-cad-site-noticias-infotime",
        "infotime-cad-site-treinamentos",
      ],
    },
    {
      id: "infotime-cad-suporte",
      filhos: ["infotime-cad-sup-triggers-auditoria"],
    },
  ];

  const complementoCadastros: LigaMenuEntrada[] = [];

  if (modulosRestantes.length > 0) {
    complementoCadastros.push({
      id: "infotime-modulos-operacionais",
      filhos: modulosRestantes.map(cloneNo),
    });
  }
  if (relatorios) complementoCadastros.push(cloneNo(relatorios));

  if (cadGrupoClientes) {
    const filhosSemListaPrincipal = cadGrupoClientes.filhos.filter(
      (f) => f.id !== "cadastros-clientes",
    );
    if (filhosSemListaPrincipal.length > 0) {
      complementoCadastros.push({
        id: cadGrupoClientes.id,
        filhos: filhosSemListaPrincipal.map(cloneNo),
      });
    }
  }

  const idsCadBarra = new Set(["cad-estoque", "cad-financeiro", "cad-acesso"]);
  const outrosCadastros = cadastros.filhos.filter((n) => !idsCadBarra.has(n.id));

  for (const n of outrosCadastros) {
    if (n.id === "cad-grupo-clientes") continue;
    if (n.id === "cad-empresas") continue;
    if (n.id === "cad-integrações") continue;
    complementoCadastros.push(cloneNo(n));
  }

  if (complementoCadastros.length > 0) {
    cadastrosFilhosRef.push({
      id: "infotime-complemento-sistema",
      filhos: complementoCadastros,
    });
  }

  const cadastrosAgrupado: LigaMenuEntrada = {
    id: "cadastros",
    filhos: cadastrosFilhosRef,
  };

  const fornecedoresFolha: LigaMenuEntrada = noFornecedoresFab
    ? cloneNo(noFornecedoresFab)
    : "cad-estoque-fornecedores-fabricantes";

  const saidaBruta: LigaMenuEstruturaIds = [
    "dashboard",
    "cadastros-clientes",
    fornecedoresFolha,
    rh,
    comercial,
    financeiro,
    estoque,
    cadastrosAgrupado,
  ];

  return filtrarPorPermissao(saidaBruta, permitidos);
}
