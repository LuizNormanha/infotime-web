import { BadRequestException } from '@nestjs/common';
import type { ValidationError } from 'class-validator';

/** Erro por caminho de propriedade (ex.: `nome`, `endereco.cidade`). */
export type ErroCampoValidacao = {
  code: string;
  message: string;
};

export type CorpoBadRequestValidacao = {
  message: string;
  errors: Record<string, ErroCampoValidacao>;
};

function achatarErrosValidacao(
  errors: ValidationError[],
  caminhoPai = '',
): Array<{ caminho: string; erro: ValidationError }> {
  const saida: Array<{ caminho: string; erro: ValidationError }> = [];
  for (const err of errors) {
    const caminho = caminhoPai ? `${caminhoPai}.${err.property}` : err.property;
    if (err.constraints && Object.keys(err.constraints).length > 0) {
      saida.push({ caminho, erro: err });
    }
    if (err.children?.length) {
      saida.push(...achatarErrosValidacao(err.children, caminho));
    }
  }
  return saida;
}

/**
 * Converte `ValidationError[]` do class-validator em corpo JSON estável para o front:
 * um objeto `errors` com chave = caminho do campo e valor = código do constraint + mensagem bruta.
 */
export function formatarRespostaValidacao(
  errors: ValidationError[],
): CorpoBadRequestValidacao {
  const achatados = achatarErrosValidacao(errors);
  const errorsMap: Record<string, ErroCampoValidacao> = {};
  for (const { caminho, erro } of achatados) {
    if (!erro.constraints) continue;
    const codigos = Object.keys(erro.constraints);
    const primeiro = codigos[0];
    if (!primeiro) continue;
    errorsMap[caminho] = {
      code: primeiro,
      message: erro.constraints[primeiro],
    };
  }
  return {
    message: 'Validation failed',
    errors: errorsMap,
  };
}

export function criarBadRequestValidacao(errors: ValidationError[]) {
  return new BadRequestException(formatarRespostaValidacao(errors));
}
