import type {
  LigaColunaListagem,
  LigaMascaraBuscaServidor,
} from "./liga-listagem.types";
import { somenteDigitos } from "@/lib/mascara-para-api";

export function resolverMascaraBuscaServidor(
  col: LigaColunaListagem | undefined,
): LigaMascaraBuscaServidor | null {
  if (!col) return null;
  if (col.mascaraBuscaServidor != null) return col.mascaraBuscaServidor;

  const alvo = (col.campoConsulta ?? col.campo).toLowerCase();

  if (alvo === "cpf") return "cpf";
  if (alvo === "cnpj" || alvo.includes("cnpj")) return "cnpj";
  if (alvo === "cep") return "cep";
  if (
    alvo.includes("telefone") ||
    alvo.includes("celular") ||
    alvo === "fone"
  ) {
    return "telefone";
  }

  if (
    col.formatoDataListagem === "data" ||
    col.formatoDataListagem === "dataHora" ||
    alvo.includes("data_") ||
    alvo.startsWith("data") ||
    /_data$|_em$/.test(alvo)
  ) {
    return "data";
  }

  return null;
}

/** Padrões PrimeReact InputMask (`9` = dígito). */
export function mascaraPrimePorTipo(tipo: LigaMascaraBuscaServidor): string {
  switch (tipo) {
    case "cpf":
      return "999.999.999-99";
    case "cnpj":
      return "99.999.999/9999-99";
    case "data":
      return "99/99/9999";
    case "cep":
      return "99999-999";
    case "telefone":
      return "(99) 99999-9999";
    default:
      return "";
  }
}

/** Valor enviado à API / estado aplicado: dígitos onde o backend espera só números; data dd/mm/aaaa → aaaa-mm-dd. */
export function normalizarTermoBuscaServidor(
  col: LigaColunaListagem | undefined,
  termo: string,
): string {
  const tipo = resolverMascaraBuscaServidor(col);
  const trimmed = termo.trim();
  if (!tipo) return trimmed;

  switch (tipo) {
    case "cpf":
    case "cnpj":
    case "cep":
    case "telefone":
      return somenteDigitos(trimmed);
    case "data": {
      const m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(trimmed);
      if (m) return `${m[3]}-${m[2]}-${m[1]}`;
      return trimmed;
    }
    default:
      return trimmed;
  }
}

/** Chaves em `home` (next-intl), ex.: `listagem.comum.buscaValidacaoCpfInvalido`. */
export type ValidacaoBuscaServidor =
  | { ok: true }
  | { ok: false; chaveI18n: string };

export function cpfDigitosVerificadoresValidos(d11: string): boolean {
  if (d11.length !== 11) return false;
  if (/^(\d)\1{10}$/.test(d11)) return false;
  let soma = 0;
  for (let i = 0; i < 9; i++) soma += parseInt(d11[i]!, 10) * (10 - i);
  let resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(d11[9]!, 10)) return false;
  soma = 0;
  for (let i = 0; i < 10; i++) soma += parseInt(d11[i]!, 10) * (11 - i);
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  return resto === parseInt(d11[10]!, 10);
}

export function cnpjDigitosVerificadoresValidos(d14: string): boolean {
  if (d14.length !== 14) return false;
  if (/^(\d)\1{13}$/.test(d14)) return false;
  const pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
  let soma = 0;
  for (let i = 0; i < 12; i++) soma += parseInt(d14[i]!, 10) * pesos1[i]!;
  let resto = soma % 11;
  const d1 = resto < 2 ? 0 : 11 - resto;
  if (d1 !== parseInt(d14[12]!, 10)) return false;
  const pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
  soma = 0;
  for (let i = 0; i < 13; i++) soma += parseInt(d14[i]!, 10) * pesos2[i]!;
  resto = soma % 11;
  const d2 = resto < 2 ? 0 : 11 - resto;
  return d2 === parseInt(d14[13]!, 10);
}

export function dataDdMmYyyyCalendarValida(texto: string): boolean {
  const m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(texto.trim());
  if (!m) return false;
  const dia = parseInt(m[1]!, 10);
  const mes = parseInt(m[2]!, 10) - 1;
  const ano = parseInt(m[3]!, 10);
  const dt = new Date(ano, mes, dia);
  return (
    dt.getFullYear() === ano &&
    dt.getMonth() === mes &&
    dt.getDate() === dia
  );
}

/**
 * Valida o texto digitado antes de enviar à API (formato / tamanho).
 * CPF/CNPJ: não valida dígitos verificadores na busca — o banco pode ter valores legados
 * ou dígitos incorretos que ainda precisam ser encontrados pelo filtro.
 */
export function validarTermoBuscaMascara(
  col: LigaColunaListagem | undefined,
  termoBruto: string,
): ValidacaoBuscaServidor {
  const trimmed = termoBruto.trim();
  if (trimmed === "") return { ok: true };

  const tipo = resolverMascaraBuscaServidor(col);
  if (!tipo) return { ok: true };

  switch (tipo) {
    case "cpf": {
      const d = somenteDigitos(trimmed);
      if (d.length > 11) {
        return {
          ok: false,
          chaveI18n: "listagem.comum.buscaValidacaoCpfInvalido",
        };
      }
      return { ok: true };
    }
    case "cnpj": {
      const d = somenteDigitos(trimmed);
      if (d.length > 14) {
        return {
          ok: false,
          chaveI18n: "listagem.comum.buscaValidacaoCnpjInvalido",
        };
      }
      return { ok: true };
    }
    case "data": {
      if (!/^(\d{2})\/(\d{2})\/(\d{4})$/.test(trimmed)) {
        return {
          ok: false,
          chaveI18n: "listagem.comum.buscaValidacaoDataIncompleta",
        };
      }
      if (!dataDdMmYyyyCalendarValida(trimmed)) {
        return {
          ok: false,
          chaveI18n: "listagem.comum.buscaValidacaoDataInvalida",
        };
      }
      return { ok: true };
    }
    case "cep": {
      const d = somenteDigitos(trimmed);
      if (d.length > 8) {
        return { ok: false, chaveI18n: "listagem.comum.buscaValidacaoCepInvalido" };
      }
      return { ok: true };
    }
    case "telefone": {
      const d = somenteDigitos(trimmed);
      if (d.length > 11) {
        return {
          ok: false,
          chaveI18n: "listagem.comum.buscaValidacaoTelefoneInvalido",
        };
      }
      return { ok: true };
    }
    default:
      return { ok: true };
  }
}
