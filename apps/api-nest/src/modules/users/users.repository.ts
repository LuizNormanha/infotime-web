import { Injectable } from '@nestjs/common';
import type { Prisma } from '@infotime/database';
import { PrismaService } from '../../shared/prisma/prisma.service';
import { CreateUserDto, UpdateUserDto, UserQueryDto } from './dto/user.dto';

function administradorFromRole(role: string): string {
  return role === 'admin' || role === 'gestor' ? 'sim' : 'nao';
}

@Injectable()
export class UsersRepository {
  constructor(private readonly prisma: PrismaService) {}

  async findMany(q: UserQueryDto, tenantId: bigint) {
    const { page, pageSize, search, ativo } = q;
    const skip = (page - 1) * pageSize;
    const where: Prisma.UsuarioWhereInput = {
      idTenacidade: tenantId,
      ...(search
        ? {
            OR: [
              { nome: { contains: search, mode: 'insensitive' } },
              { email: { contains: search, mode: 'insensitive' } },
              { login: { contains: search, mode: 'insensitive' } },
            ],
          }
        : {}),
      ...(ativo ? { ativo } : {}),
    };

    const [rows, total] = await Promise.all([
      this.prisma.usuario.findMany({
        where,
        skip,
        take: pageSize,
        orderBy: { nome: 'asc' },
        select: {
          idUsuario: true,
          nome: true,
          email: true,
          login: true,
          administrador: true,
          ativo: true,
          idTenacidade: true,
        },
      }),
      this.prisma.usuario.count({ where }),
    ]);

    const data = rows.map((u) => ({
      idUsuario: u.idUsuario.toString(),
      nome: u.nome,
      email: u.email,
      login: u.login,
      ativo: u.ativo,
    }));

    return {
      data,
      total,
      page,
      pageSize,
    };
  }

  async findById(id: bigint, tenantId: bigint) {
    const u = await this.prisma.usuario.findFirst({
      where: { idUsuario: id, idTenacidade: tenantId },
      select: {
        idUsuario: true,
        nome: true,
        email: true,
        login: true,
        administrador: true,
        ativo: true,
        idTenacidade: true,
      },
    });
    if (!u) return null;
    return {
      idUsuario: u.idUsuario.toString(),
      nome: u.nome,
      email: u.email,
      login: u.login,
      role: u.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador',
      ativo: u.ativo,
      tenantId: u.idTenacidade?.toString() ?? null,
    };
  }

  async findByLogin(login: string, tenantId: bigint) {
    return this.prisma.usuario.findFirst({
      where: { login, idTenacidade: tenantId },
      select: { idUsuario: true },
    });
  }

  async create(data: CreateUserDto & { senha: string; tenantId: bigint }) {
    const u = await this.prisma.usuario.create({
      data: {
        nome: data.nome,
        email: data.email,
        login: data.login,
        senha: data.senha,
        idTenacidade: data.tenantId,
        ativo: 'sim',
        administrador: administradorFromRole(data.role),
      },
      select: {
        idUsuario: true,
        nome: true,
        email: true,
        login: true,
        administrador: true,
        idTenacidade: true,
      },
    });
    return {
      idUsuario: u.idUsuario.toString(),
      nome: u.nome,
      email: u.email,
      login: u.login,
      role: u.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador',
      tenantId: u.idTenacidade?.toString() ?? null,
    };
  }

  async update(id: bigint, data: UpdateUserDto) {
    const updateData: Prisma.UsuarioUpdateInput = {};
    if (data.nome !== undefined) updateData.nome = data.nome;
    if (data.email !== undefined) updateData.email = data.email;
    if (data.login !== undefined) updateData.login = data.login;
    if (data.role !== undefined) updateData.administrador = administradorFromRole(data.role);

    const u = await this.prisma.usuario.update({
      where: { idUsuario: id },
      data: updateData,
      select: {
        idUsuario: true,
        nome: true,
        email: true,
        login: true,
        administrador: true,
        ativo: true,
      },
    });
    return {
      idUsuario: u.idUsuario.toString(),
      nome: u.nome,
      email: u.email,
      login: u.login,
      role: u.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador',
      ativo: u.ativo,
    };
  }

  async softDelete(id: bigint, tenantId: bigint) {
    await this.prisma.usuario.updateMany({
      where: { idUsuario: id, idTenacidade: tenantId },
      data: { ativo: 'nao' },
    });
    return { id: id.toString() };
  }
}
