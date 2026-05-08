import { Injectable } from '@nestjs/common';

import { PrismaService } from '../prisma/prisma.service';

/** Linha para lookup da tabela `tenacidade` (model Prisma `infolab_tenacidade`, FK `id_tenacidade`). */
export type LinhaInfotimeTenacidadeLookup = {
  id: string;
  nome: string;
  detalhe?: string;
};

/**
 * Serviço para o model Prisma `infolab_tenacidade` (tabela física `tenacidade`).
 */
@Injectable()
export class TenacidadeService {
  constructor(private readonly prisma: PrismaService) {}

  /**
   * Laboratório do tenant atual (JWT), para lookup de FK `id_tenacidade`.
   * Filtra opcionalmente por texto em nome fantasia, razão social, domínio ou id.
   */
  async catalogoLookup(
    idTenacidade: bigint,
    q?: string,
  ): Promise<{ dados: LinhaInfotimeTenacidadeLookup[] }> {
    const row = await this.prisma.infolab_tenacidade.findUnique({
      where: { id_tenacidade: idTenacidade },
      select: { id_tenacidade: true },
    });
    if (!row) {
      return { dados: [] };
    }
    const configs = await this.prisma.infolab_tenacidade_configuracao.findMany({
      where: { id_tenacidade: idTenacidade },
      orderBy: { id_tenacidade_configuracao: 'asc' },
      select: {
        nome_fantasia: true,
        razao_social: true,
        dominio_tenacidade: true,
      },
    });
    const cfg =
      configs.find((c) => (c.dominio_tenacidade ?? '').trim()) ?? configs[0];
    if (!cfg) {
      return {
        dados: [
          {
            id: row.id_tenacidade.toString(),
            nome: String(row.id_tenacidade),
          },
        ],
      };
    }
    const nome =
      cfg.nome_fantasia?.trim() ||
      cfg.razao_social?.trim() ||
      cfg.dominio_tenacidade?.trim() ||
      String(row.id_tenacidade);
    const partesDetalhe = [cfg.dominio_tenacidade, cfg.razao_social].filter(
      (v): v is string => Boolean(v?.trim()),
    );
    const detalhe =
      partesDetalhe.length > 0 ? partesDetalhe.join(' · ') : undefined;
    const idStr = row.id_tenacidade.toString();
    const blob = `${nome} ${detalhe ?? ''} ${idStr}`.toLowerCase();
    if (q?.trim()) {
      const t = q.trim().toLowerCase();
      if (!blob.includes(t)) {
        return { dados: [] };
      }
    }
    return {
      dados: [{ id: idStr, nome, detalhe }],
    };
  }
}
