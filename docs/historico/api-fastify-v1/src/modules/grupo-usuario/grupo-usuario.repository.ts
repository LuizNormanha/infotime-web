import type { Prisma } from "@infotime/database";
import { prisma } from "@infotime/database";
import { toPrismaSkipTake } from "../../shared/pagination/pagination.js";
import type { ListQuery } from "@infotime/shared-types";

export const grupoUsuarioRepository = {
  async findMany(tenantId: bigint, q: ListQuery) {
    const { skip, take } = toPrismaSkipTake(q);
    const search = q.search?.trim();
    const where: Prisma.GrupoUsuarioWhereInput = {
      idTenacidade: tenantId,
      ...(search ? { descricao: { contains: search, mode: "insensitive" } } : {}),
    };
    const [total, data] = await prisma.$transaction([
      prisma.grupoUsuario.count({ where }),
      prisma.grupoUsuario.findMany({
        where,
        skip,
        take,
        orderBy: { descricao: "asc" },
      }),
    ]);
    return { data, total };
  },

  async findFirst(tenantId: bigint, id: bigint) {
    return prisma.grupoUsuario.findFirst({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
  },

  async create(tenantId: bigint, data: Omit<Prisma.GrupoUsuarioUncheckedCreateInput, "idTenacidade">) {
    return prisma.grupoUsuario.create({
      data: { ...data, idTenacidade: tenantId },
    });
  },

  async update(tenantId: bigint, id: bigint, data: Prisma.GrupoUsuarioUpdateInput) {
    const existing = await prisma.grupoUsuario.findFirst({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
    if (!existing) return null;
    return prisma.grupoUsuario.update({
      where: { idGrupoUsuario: existing.idGrupoUsuario },
      data,
    });
  },

  async delete(tenantId: bigint, id: bigint) {
    await prisma.grupoUsuario.deleteMany({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
  },
};
