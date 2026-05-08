import { BadRequestException } from '@nestjs/common';
import type { LayoutOverlayDto } from './dto/layout-overlay.dto';

/** Chaves que nunca podem ser alteradas por overlay (auditoria / tenant técnico). */
export const CHAVES_BLOQUEADAS_OVERLAY = new Set([
  'id_tenacidade',
  'data_inclusao_texto',
  'id_usuario_auditoria',
  'id_usuario_auditoria_texto',
  'endereco_ip_auditoria',
  'nome_aplicacao_auditoria',
  'usuario_auditoria',
]);

/**
 * Campos permitidos por tela (chaves do layout padrão do front).
 * Vazio: telas serão cadastradas quando os formulários InfoTIME existirem.
 */
export const CHAVES_PERMITIDAS_POR_TELA: Record<string, Set<string>> = {};

/** Chaves que não podem ser ocultadas (NOT NULL / negócio) por tela. */
export const CHAVES_OBRIGATORIAS_SISTEMA_POR_TELA: Record<
  string,
  Set<string>
> = {};

export function validarOverlayDto(tela: string, dto: LayoutOverlayDto): void {
  const permitidas = CHAVES_PERMITIDAS_POR_TELA[tela];
  const campos = dto.campos ?? {};

  for (const chave of Object.keys(campos)) {
    if (CHAVES_BLOQUEADAS_OVERLAY.has(chave)) {
      throw new BadRequestException(
        `Campo "${chave}" não pode ser configurado (auditoria ou sistema).`,
      );
    }
    if (permitidas && !permitidas.has(chave)) {
      throw new BadRequestException(
        `Campo "${chave}" não é permitido para a tela "${tela}".`,
      );
    }
    if (!permitidas && Object.keys(campos).length > 0) {
      throw new BadRequestException(
        `A tela "${tela}" ainda não possui catálogo de campos para overlay.`,
      );
    }
  }

  const obrig = CHAVES_OBRIGATORIAS_SISTEMA_POR_TELA[tela];
  if (obrig) {
    for (const chave of obrig) {
      const c = campos[chave];
      if (c?.oculto) {
        throw new BadRequestException(
          `Campo "${chave}" é obrigatório no sistema e não pode ser oculto.`,
        );
      }
    }
  }

  const p = dto.permissoes;
  if (p) {
    for (const k of ['ver', 'editar', 'salvar', 'excluir'] as const) {
      if (p[k] !== undefined && typeof p[k] !== 'boolean') {
        throw new BadRequestException(`permissoes.${k} deve ser booleano.`);
      }
    }
  }
}
