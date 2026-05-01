import { Injectable } from '@nestjs/common';
import { PrismaService } from '@shared/prisma/prisma.service';
import { CreateUserDto, UpdateUserDto, UserQueryDto } from './dto/user.dto';
import { PaginatedResult } from '@infotime/shared-types';

/**
 * UsersRepository — única camada que toca o Prisma para o módulo de usuários.
 * O PrismaService já aplica o filtro de tenant via middleware.
 */
@Injectable()
export class UsersRepository {
  constructor(private readonly prisma: PrismaService) {}

  async findMany(query: UserQueryDto): Promise<PaginatedResult<unknown>> {
    const { page, limit, search, role, ativo } = query;
    const skip = (page - 1) * limit;

    const where = {
      ...(search
        ? {
            OR: [
              { nome: { contains: search, mode: 'insensitive' as const } },
              { email: { contains: search, mode: 'insensitive' as const } },
              { login: { contains: search, mode: 'insensitive' as const } },
            ],
          }
        : {}),
      ...(role !== undefined ? { role } : {}),
      ...(ativo !== undefined ? { ativo } : {}),
    };

    const [data, total] = await Promise.all([
      this.prisma.usuario.findMany({
        where,
        skip,
        take: limit,
        orderBy: { nome: 'asc' },
        select: {
          id: true,
          nome: true,
          email: true,
          login: true,
          role: true,
          ativo: true,
          tenantId: true,
          criadoEm: true,
          atualizadoEm: true,
        },
      }),
      this.prisma.usuario.count({ where }),
    ]);

    return {
      data,
      meta: {
        page,
        limit,
        total,
        totalPages: Math.ceil(total / limit),
      },
    };
  }

  async findById(id: number) {
    return this.prisma.usuario.findFirst({
      where: { id },
      select: {
        id: true,
        nome: true,
        email: true,
        login: true,
        role: true,
        ativo: true,
        tenantId: true,
        criadoEm: true,
        atualizadoEm: true,
      },
    });
  }

  async findByLogin(login: string) {
    return this.prisma.usuario.findFirst({
      where: { login },
    });
  }

  async create(data: CreateUserDto & { senha: string; tenantId: number }) {
    return this.prisma.usuario.create({
      data: {
        nome: data.nome,
        email: data.email,
        login: data.login,
        senha: data.senha,
        role: data.role,
        tenantId: data.tenantId,
        ativo: true,
      },
      select: {
        id: true,
        nome: true,
        email: true,
        login: true,
        role: true,
        tenantId: true,
        criadoEm: true,
      },
    });
  }

  async update(id: number, data: UpdateUserDto) {
    return this.prisma.usuario.update({
      where: { id },
      data,
      select: {
        id: true,
        nome: true,
        email: true,
        login: true,
        role: true,
        ativo: true,
        atualizadoEm: true,
      },
    });
  }

  async updateSenha(id: number, senhaHash: string) {
    return this.prisma.usuario.update({
      where: { id },
      data: { senha: senhaHash },
      select: { id: true },
    });
  }

  async softDelete(id: number) {
    return this.prisma.usuario.update({
      where: { id },
      data: { ativo: false },
      select: { id: true },
    });
  }
}
