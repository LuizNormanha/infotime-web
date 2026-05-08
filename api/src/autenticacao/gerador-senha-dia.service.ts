import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { createHmac } from 'crypto';

/** YYYY-MM-DD no fuso informado (ex.: calendário local BR vs UTC puro). */
export function dataReferenciaSenhaDoDia(data: Date, timeZone: string): string {
  return new Intl.DateTimeFormat('en-CA', {
    timeZone,
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
  }).format(data);
}

@Injectable()
export class GeradorSenhaDoDia {
  constructor(private readonly config: ConfigService) {
    if (!config.get<string>('SUPORTE_SECRET_KEY')) {
      throw new Error('SUPORTE_SECRET_KEY não configurada');
    }
  }

  private dataYyyyMmDd(data: Date): string {
    const tz =
      this.config.get<string>('SENHA_DO_DIA_TIMEZONE') ?? 'America/Sao_Paulo';
    return dataReferenciaSenhaDoDia(data, tz);
  }

  gerarSenhaDoDia(data: Date): string {
    const chave = this.config.get<string>('SUPORTE_SECRET_KEY')!;
    const dataStr = this.dataYyyyMmDd(data);
    return createHmac('sha256', chave)
      .update(dataStr)
      .digest('hex')
      .slice(0, 8);
  }

  validarSenhaDoDia(senha: string): boolean {
    const normalizada = senha.trim().toLowerCase();
    if (!normalizada) return false;
    return normalizada === this.gerarSenhaDoDia(new Date());
  }
}
