import type { Prisma } from "@infotime/database";
import { prisma } from "@infotime/database";
import { toPrismaSkipTake } from "../../shared/pagination/pagination.js";
import type { ListQuery } from "@infotime/shared-types";

export const clienteRepository = {
  async findMany(tenantId: bigint, q: ListQuery) {
    const { skip, take } = toPrismaSkipTake(q);
    const search = q.search?.trim();
    const where: Prisma.ClienteWhereInput = {
      idTenacidade: tenantId,
      ...(search
        ? {
            OR: [
              { razaoSocial: { contains: search, mode: "insensitive" } },
              { nomeFantasia: { contains: search, mode: "insensitive" } },
              { cnpj: { contains: search } },
              { email: { contains: search, mode: "insensitive" } },
            ],
          }
        : {}),
    };
    const [total, data] = await prisma.$transaction([
      prisma.cliente.count({ where }),
      prisma.cliente.findMany({
        where,
        skip,
        take,
        orderBy: { razaoSocial: "asc" },
      }),
    ]);
    return { data, total };
  },

  async findFirst(tenantId: bigint, id: bigint) {
    return prisma.cliente.findFirst({
      where: { idCliente: id, idTenacidade: tenantId },
    });
  },

  async create(tenantId: bigint, data: Omit<Prisma.ClienteUncheckedCreateInput, "idTenacidade">) {
    return prisma.cliente.create({
      data: { ...data, idTenacidade: tenantId },
    });
  },

  async update(tenantId: bigint, id: bigint, data: Prisma.ClienteUpdateInput) {
    const existing = await prisma.cliente.findFirst({
      where: { idCliente: id, idTenacidade: tenantId },
    });
    if (!existing) return null;
    return prisma.cliente.update({
      where: { idCliente: existing.idCliente },
      data,
    });
  },

  async delete(tenantId: bigint, id: bigint) {
    await prisma.cliente.deleteMany({
      where: { idCliente: id, idTenacidade: tenantId },
    });
  },
};
