import { Injectable, Logger } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import type { Dirent } from 'node:fs';
import { existsSync } from 'node:fs';
import { readdir } from 'node:fs/promises';
import { join } from 'node:path';

/**
 * Resolve o diretório raiz dos arquivos de domínio (`Context.md`, `Rules.md`, …).
 * Por padrão: `<repo>/ai/domains` assumindo `process.cwd()` = pasta `api/` ao subir a Nest.
 */
@Injectable()
export class CaminhoDominiosService {
  private readonly logger = new Logger(CaminhoDominiosService.name);

  constructor(private readonly config: ConfigService) {}

  obterRaizDominios(): string {
    const configurado = this.config.get<string>('AI_DOMAINS_ROOT');
    if (configurado && configurado.length > 0) {
      return configurado;
    }
    const candidatos = [
      join(process.cwd(), '..', 'ai', 'domains'),
      join(process.cwd(), 'ai', 'domains'),
    ];
    for (const p of candidatos) {
      if (existsSync(p)) {
        return p;
      }
    }
    this.logger.warn(
      `Nenhum diretório de domínios encontrado em ${candidatos.join(', ')}. Defina AI_DOMAINS_ROOT.`,
    );
    return candidatos[0];
  }

  /** Pastas em `ai/domains/<nome>/` (nomes de domínio disponíveis para `/ai/generate`). */
  async listarNomesDominiosDisponiveis(): Promise<string[]> {
    const raiz = this.obterRaizDominios();
    const entradas: Dirent[] = await readdir(raiz, {
      withFileTypes: true,
    }).catch(() => []);
    return entradas.filter((e) => e.isDirectory()).map((e) => e.name);
  }
}
