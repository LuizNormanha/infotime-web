import { Injectable } from '@nestjs/common';
import type { Prisma } from '@infotime/database';
import { PrismaService } from '../../shared/prisma/prisma.service';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';

@Injectable()
export class ClientesRepository {
  constructor(private readonly prisma: PrismaService) {}

  async findMany(tenantId: bigint, q: ListQueryDto) {
    const skip = (q.page - 1) * q.pageSize;
    const take = q.pageSize;
    const search = q.search?.trim();
    const dir = q.sortOrder === 'desc' ? 'desc' : 'asc';
    const allowed = new Set([
      'razaoSocial',
      'nomeFantasia',
      'cnpj',
      'email',
      'cidade',
      'estado',
    ]);
    const sortField =
      q.sortField && allowed.has(q.sortField) ? q.sortField : 'razaoSocial';
    const orderBy = { [sortField]: dir } as Prisma.ClienteOrderByWithRelationInput;

    const where: Prisma.ClienteWhereInput = {
      idTenacidade: tenantId,
      ...(search
        ? {
            OR: [
              { razaoSocial: { contains: search, mode: 'insensitive' } },
              { nomeFantasia: { contains: search, mode: 'insensitive' } },
              { cnpj: { contains: search } },
              { email: { contains: search, mode: 'insensitive' } },
            ],
          }
        : {}),
    };
    const [total, rows] = await Promise.all([
      this.prisma.cliente.count({ where }),
      this.prisma.cliente.findMany({
        where,
        skip,
        take,
        orderBy,
        select: {
          idCliente: true,
          razaoSocial: true,
          nomeFantasia: true,
          cnpj: true,
          email: true,
          cidade: true,
          estado: true,
        },
      }),
    ]);
    return { total, rows };
  }

  findFirst(tenantId: bigint, id: bigint) {
    return this.prisma.cliente.findFirst({
      where: { idCliente: id, idTenacidade: tenantId },
    });
  }

  create(tenantId: bigint, data: Omit<Prisma.ClienteUncheckedCreateInput, 'idTenacidade'>) {
    return this.prisma.cliente.create({
      data: { ...data, idTenacidade: tenantId },
    });
  }

  async update(tenantId: bigint, id: bigint, data: Prisma.ClienteUpdateInput) {
    const existing = await this.prisma.cliente.findFirst({
      where: { idCliente: id, idTenacidade: tenantId },
    });
    if (!existing) return null;
    return this.prisma.cliente.update({
      where: { idCliente: existing.idCliente },
      data,
    });
  }

  async delete(tenantId: bigint, id: bigint) {
    await this.prisma.cliente.deleteMany({
      where: { idCliente: id, idTenacidade: tenantId },
    });
  }
}
