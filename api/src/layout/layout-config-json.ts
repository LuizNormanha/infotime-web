import type { LayoutFormularioCadastroDto } from './dto/layout-formulario-cadastro.dto';

/** Envelope gravado em `configuracao_json` para telas de cadastro. */
export type EnvelopeLayoutCadastro = {
  v?: number;
  layout?: LayoutFormularioCadastroDto;
};

/** Envelope para `codigo === 'menu'`. */
export type EnvelopeMenu = {
  v?: number;
  menu?: unknown;
};

export function serializarConfiguracaoLayout(
  layout: LayoutFormularioCadastroDto,
): string {
  return JSON.stringify({ v: 1, layout } satisfies EnvelopeLayoutCadastro);
}

export function serializarConfiguracaoMenu(menu: unknown): string {
  return JSON.stringify({ v: 1, menu } satisfies EnvelopeMenu);
}

export function parsearLayoutDeConfiguracao(
  configuracaoJson: string,
): LayoutFormularioCadastroDto {
  try {
    const o = JSON.parse(configuracaoJson) as unknown;
    if (!o || typeof o !== 'object') return { secoes: [] };
    const obj = o as Record<string, unknown>;
    if (obj.layout && typeof obj.layout === 'object') {
      const l = obj.layout as LayoutFormularioCadastroDto;
      return Array.isArray(l.secoes) ? l : { secoes: [] };
    }
    if (Array.isArray(obj.secoes)) {
      return o as LayoutFormularioCadastroDto;
    }
  } catch {
    /* vazio */
  }
  return { secoes: [] };
}

export function parsearMenuDeConfiguracao(configuracaoJson: string): unknown {
  try {
    const o = JSON.parse(configuracaoJson) as unknown;
    if (!o || typeof o !== 'object') return null;
    const obj = o as Record<string, unknown>;
    if ('menu' in obj) return obj.menu;
    if (Array.isArray(o)) return o;
  } catch {
    /* nulo */
  }
  return null;
}
