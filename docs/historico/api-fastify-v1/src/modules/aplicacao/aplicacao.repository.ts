import type { Prisma } from "@infotime/database";
import { prisma } from "@infotime/database";
import { toPrismaSkipTake } from "../../shared/pagination/pagination.js";
import type { ListQuery } from "@infotime/shared-types";

export const aplicacaoRepository = {
  async findMany(_tenantId: bigint, q: ListQuery) {
    const { skip, take } = toPrismaSkipTake(q);
    const search = q.search?.trim();
    const where: Prisma.AplicacaoWhereInput = search
      ? {
          OR: [
            { nome: { contains: search, mode: "insensitive" } },
            { descricao: { contains: search, mode: "insensitive" } },
          ],
        }
      : {};
    const [total, data] = await prisma.$transaction([
      prisma.aplicacao.count({ where }),
      prisma.aplicacao.findMany({
        where,
        skip,
        take,
        orderBy: { nome: "asc" },
      }),
    ]);
    return { data, total };
  },

  async findById(id: bigint) {
    return prisma.aplicacao.findFirst({
      where: { idAplicacao: id },
    });
  },

  async create(data: Prisma.AplicacaoCreateInput) {
    return prisma.aplicacao.create({ data });
  },

  async update(id: bigint, data: Prisma.AplicacaoUpdateInput) {
    const existing = await prisma.aplicacao.findFirst({ where: { idAplicacao: id } });
    if (!existing) return null;
    return prisma.aplicacao.update({
      where: { idAplicacao: existing.idAplicacao },
      data,
    });
  },

  async delete(id: bigint) {
    await prisma.aplicacao.deleteMany({ where: { idAplicacao: id } });
  },
};
