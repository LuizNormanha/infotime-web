import { BadRequestException } from '@nestjs/common';

/** Validação do JSON do menu (persistido por perfil / grupo de usuário). */

function validarNoMenuJson(val: unknown): void {
  if (val === null || val === undefined) {
    throw new BadRequestException('menu inválido');
  }
  if (typeof val === 'string') {
    if (val.trim() === '') {
      throw new BadRequestException('Id de menu vazio');
    }
    return;
  }
  if (typeof val === 'object' && val !== null && !Array.isArray(val)) {
    const o = val as Record<string, unknown>;
    const id = o.id;
    if (typeof id !== 'string' || id.trim() === '') {
      throw new BadRequestException('Item de menu com id inválido');
    }
    if (o.filhos !== undefined) {
      if (!Array.isArray(o.filhos)) {
        throw new BadRequestException('filhos deve ser array');
      }
      for (const f of o.filhos) {
        validarNoMenuJson(f);
      }
    }
    return;
  }
  if (Array.isArray(val)) {
    for (const item of val) {
      validarNoMenuJson(item);
    }
    return;
  }
  throw new BadRequestException('Formato de menu inválido');
}

export function validarMenuJson(menu: unknown): void {
  if (!Array.isArray(menu)) {
    throw new BadRequestException('menu deve ser um array na raiz');
  }
  for (const item of menu) {
    validarNoMenuJson(item);
  }
}
