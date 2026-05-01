import { Injectable } from '@nestjs/common';
import type { Prisma } from '@infotime/database';
import { PrismaService } from '../../shared/prisma/prisma.service';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';

@Injectable()
export class GruposUsuarioRepository {
  constructor(private readonly prisma: PrismaService) {}

  async findMany(tenantId: bigint, q: ListQueryDto) {
    const skip = (q.page - 1) * q.pageSize;
    const take = q.pageSize;
    const search = q.search?.trim();
    const where: Prisma.GrupoUsuarioWhereInput = {
      idTenacidade: tenantId,
      ...(search ? { descricao: { contains: search, mode: 'insensitive' } } : {}),
    };
    const [total, rows] = await Promise.all([
      this.prisma.grupoUsuario.count({ where }),
      this.prisma.grupoUsuario.findMany({
        where,
        skip,
        take,
        orderBy: { descricao: 'asc' },
      }),
    ]);
    return { total, rows };
  }

  findFirst(tenantId: bigint, id: bigint) {
    return this.prisma.grupoUsuario.findFirst({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
  }

  create(tenantId: bigint, data: Omit<Prisma.GrupoUsuarioUncheckedCreateInput, 'idTenacidade'>) {
    return this.prisma.grupoUsuario.create({
      data: { ...data, idTenacidade: tenantId },
    });
  }

  async update(tenantId: bigint, id: bigint, data: Prisma.GrupoUsuarioUpdateInput) {
    const existing = await this.prisma.grupoUsuario.findFirst({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
    if (!existing) return null;
    return this.prisma.grupoUsuario.update({
      where: { idGrupoUsuario: existing.idGrupoUsuario },
      data,
    });
  }

  async delete(tenantId: bigint, id: bigint) {
    await this.prisma.grupoUsuario.deleteMany({
      where: { idGrupoUsuario: id, idTenacidade: tenantId },
    });
  }
}
