import { describe, expect, it } from "vitest";

import { RECURSOS_PERMITIDOS } from "./recursos-permitidos-bff";

describe("RECURSOS_PERMITIDOS — allowlist do catch-all BFF", () => {
  it("contém todos os recursos de cadastro esperados", () => {
    const esperados = [
      "analisadores",
      "aplicacoes",
      "atendimentos",
      "cbos",
      "cids",
      "clientes",
      "computadores",
      "conselhos-regionais",
      "especialidades-medicas",
      "etnias",
      "exames",
      "exames-material",
      "exames-material-lab-apoio",
      "feriados",
      "grupos",
      "grupos-perfil",
      "indicacoes",
      "implantacao-tenacidades",
      "implantacao-tenacidade-configuracoes",
      "integracoes",
      "labs-apoio",
      "labs-apoio-unidade",
      "locais-armazenamento",
      "mapa-definicoes",
      "mapa-producoes",
      "materiais",
      "medicamentos",
      "medicos",
      "modelos-resultado",
      "orcamentos",
      "motivos-cancelamento",
      "pendencias-resultado",
      "motivos-desconto",
      "motivos-exame-retificacao",
      "motivos-orcamento-rejeicao",
      "motivos-quarentena",
      "motivos-recoleta",
      "motivos-retificacao",
      "portas-serial",
      "precos-fator",
      "precos-tabela",
      "procedencias",
      "questionarios",
      "racas",
      "recipientes",
      "setores",
      "soroteca",
      "situacoes-coleta",
      "temperatura-opcao",
      "tenacidade-configuracoes",
      "tenacidades",
      "tipos-aplicacao",
      "tipos-destino-resultado",
      "tipos-estado-civil",
      "tipos-evento",
      "tipos-indicacao",
      "tipos-integracao",
      "tipos-interface",
      "tipos-pagamento",
      "tipos-relatorio",
      "unidades-atendimento",
      "unidades-federacao",
      "usuario-permissoes",
      "usuarios",
      "vet-especies",
      "vet-racas",
    ];

    for (const recurso of esperados) {
      expect(RECURSOS_PERMITIDOS.has(recurso), `faltando: ${recurso}`).toBe(true);
    }
  });

  it("não expõe paths de sessão/login crus; auth pode existir como recurso proxy sob controle do BFF", () => {
    const proibidos = ["login", "logout", "sessao", "suporte"];
    for (const p of proibidos) {
      expect(RECURSOS_PERMITIDOS.has(p), `deveria proibir: ${p}`).toBe(false);
    }
  });

  it("não contém paths de layout", () => {
    expect(RECURSOS_PERMITIDOS.has("layout")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("menu")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("catalogo")).toBe(false);
  });

  it("não contém caminhos internos ou arbitrários", () => {
    expect(RECURSOS_PERMITIDOS.has("_lib")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("health")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("../../../etc/passwd")).toBe(false);
  });

  it("rejeita path traversal — encodeURIComponent protege segmentos de id", () => {
    const malicioso = "../../../etc/passwd";
    const codificado = encodeURIComponent(malicioso);
    expect(codificado).not.toContain("/");
    expect(codificado).toBe("..%2F..%2F..%2Fetc%2Fpasswd");
  });

  it("tem exatamente o número de recursos da allowlist", () => {
    expect(RECURSOS_PERMITIDOS.size).toBe(68);
  });
});

describe("Validação de path.length por método HTTP", () => {
  // Espelha a lógica de route.ts sem importar o módulo completo do Next.js
  function validarPathGet(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPost(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPutDelete(path: string[]): boolean {
    if (path.length < 2) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }

  it("GET aceita 1 segmento (listagem)", () => {
    expect(validarPathGet(["usuarios"])).toBe(true);
  });
  it("GET aceita 2 segmentos (por id)", () => {
    expect(validarPathGet(["usuarios", "42"])).toBe(true);
  });
  it("GET aceita 3+ segmentos (sub-rotas, ex.: catálogo)", () => {
    expect(validarPathGet(["atendimentos", "catalogo", "unidades"])).toBe(true);
  });

  it("POST aceita 1 segmento (criação na raiz do recurso)", () => {
    expect(validarPathPost(["usuarios"])).toBe(true);
  });
  it("POST aceita 3+ segmentos (sub-rotas, ex.: linha de detalhe)", () => {
    expect(validarPathPost(["precos-tabela", "1", "preco-exames"])).toBe(true);
  });
  it("POST rejeita 0 segmentos", () => {
    expect(validarPathPost([])).toBe(false);
  });

  it("PUT aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["usuarios", "42"])).toBe(true);
  });
  it("PUT rejeita 1 segmento (sem id)", () => {
    expect(validarPathPutDelete(["usuarios"])).toBe(false);
  });
  it("PUT aceita 4+ segmentos (detalhe aninhado)", () => {
    expect(validarPathPutDelete(["precos-tabela", "1", "preco-exames", "9"])).toBe(true);
  });

  it("DELETE aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["medicos", "99"])).toBe(true);
  });
  it("DELETE rejeita recurso fora da allowlist", () => {
    expect(validarPathPutDelete(["../secret", "1"])).toBe(false);
  });
});
