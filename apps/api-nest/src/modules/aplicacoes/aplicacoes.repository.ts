import { Injectable } from '@nestjs/common';
import type { Prisma } from '@infotime/database';
import { PrismaService } from '../../shared/prisma/prisma.service';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';

@Injectable()
export class AplicacoesRepository {
  constructor(private readonly prisma: PrismaService) {}

  async findMany(q: ListQueryDto) {
    const skip = (q.page - 1) * q.pageSize;
    const take = q.pageSize;
    const search = q.search?.trim();
    const where: Prisma.AplicacaoWhereInput = search
      ? {
          OR: [
            { nome: { contains: search, mode: 'insensitive' } },
            { descricao: { contains: search, mode: 'insensitive' } },
          ],
        }
      : {};
    const [total, rows] = await Promise.all([
      this.prisma.aplicacao.count({ where }),
      this.prisma.aplicacao.findMany({
        where,
        skip,
        take,
        orderBy: { nome: 'asc' },
      }),
    ]);
    return { total, rows };
  }

  findById(id: bigint) {
    return this.prisma.aplicacao.findFirst({
      where: { idAplicacao: id },
    });
  }

  create(data: Prisma.AplicacaoUncheckedCreateInput) {
    return this.prisma.aplicacao.create({ data });
  }

  async update(id: bigint, data: Prisma.AplicacaoUpdateInput) {
    const existing = await this.prisma.aplicacao.findFirst({ where: { idAplicacao: id } });
    if (!existing) return null;
    return this.prisma.aplicacao.update({
      where: { idAplicacao: existing.idAplicacao },
      data,
    });
  }

  async delete(id: bigint) {
    await this.prisma.aplicacao.deleteMany({ where: { idAplicacao: id } });
  }
}
