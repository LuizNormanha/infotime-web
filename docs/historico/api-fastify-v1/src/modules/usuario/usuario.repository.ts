import type { Prisma } from "@infotime/database";
import { prisma } from "@infotime/database";
import { toPrismaSkipTake } from "../../shared/pagination/pagination.js";
import type { ListQuery } from "@infotime/shared-types";

export const usuarioRepository = {
  async findMany(tenantId: bigint, q: ListQuery) {
    const { skip, take } = toPrismaSkipTake(q);
    const search = q.search?.trim();

    const where: Prisma.UsuarioWhereInput = {
      idTenacidade: tenantId,
      ...(search
        ? {
            OR: [
              { nome: { contains: search, mode: "insensitive" } },
              { login: { contains: search, mode: "insensitive" } },
              { email: { contains: search, mode: "insensitive" } },
            ],
          }
        : {}),
    };

    const orderBy: Prisma.UsuarioOrderByWithRelationInput = q.sortField
      ? { [q.sortField]: q.sortOrder ?? "asc" }
      : { nome: "asc" };

    const [total, rows] = await prisma.$transaction([
      prisma.usuario.count({ where }),
      prisma.usuario.findMany({
        where,
        skip,
        take,
        orderBy,
      }),
    ]);

    return { data: rows, total };
  },

  async findFirst(tenantId: bigint, idUsuario: bigint) {
    return prisma.usuario.findFirst({
      where: { idUsuario, idTenacidade: tenantId },
    });
  },

  async create(
    tenantId: bigint,
    data: Omit<Prisma.UsuarioUncheckedCreateInput, "idTenacidade">,
    audit: { idUsuarioAuditoria?: bigint },
  ) {
    return prisma.usuario.create({
      data: {
        ...data,
        idTenacidade: tenantId,
        idUsuarioAuditoria: audit.idUsuarioAuditoria,
      },
    });
  },

  async update(
    tenantId: bigint,
    idUsuario: bigint,
    data: Prisma.UsuarioUpdateInput,
    audit: { idUsuarioAuditoria?: bigint },
  ) {
    const existing = await prisma.usuario.findFirst({
      where: { idUsuario, idTenacidade: tenantId },
    });
    if (!existing) return null;
    return prisma.usuario.update({
      where: { idUsuario: existing.idUsuario },
      data: {
        ...data,
        idUsuarioAuditoria: audit.idUsuarioAuditoria,
      },
    });
  },

  async delete(tenantId: bigint, idUsuario: bigint) {
    await prisma.usuario.deleteMany({
      where: { idUsuario, idTenacidade: tenantId },
    });
  },
};
