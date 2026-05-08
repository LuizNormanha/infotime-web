import { Injectable } from '@nestjs/common';
import { readFile } from 'node:fs/promises';
import { join } from 'node:path';

import { CaminhoDominiosService } from './caminho-dominios.service';

/**
 * Lê arquivos estáticos de domínio do disco (ex.: `Rules.md`).
 * Não acessa PostgreSQL nem dados de tenant.
 */
@Injectable()
export class LeitorMarkdownDominioService {
  constructor(private readonly caminhos: CaminhoDominiosService) {}

  async lerArquivo(dominio: string, nomeArquivo: string): Promise<string | null> {
    const caminho = join(
      this.caminhos.obterRaizDominios(),
      dominio,
      nomeArquivo,
    );
    try {
      return await readFile(caminho, 'utf-8');
    } catch {
      return null;
    }
  }
}
