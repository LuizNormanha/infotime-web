import { ForbiddenException, Injectable, NotFoundException } from '@nestjs/common';
import { ClsService } from 'nestjs-cls';
import type { Prisma } from '@infotime/database';
import { ClientesRepository } from './clientes.repository';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';
import type { ClienteCreateDto, ClienteUpdateDto } from './dto/cliente.dto';

@Injectable()
export class ClientesService {
  constructor(
    private readonly repo: ClientesRepository,
    private readonly cls: ClsService,
  ) {}

  private tenantId(): bigint {
    const raw = this.cls.get<string | undefined>('tenantId');
    if (!raw) throw new ForbiddenException('Tenant não definido no contexto');
    return BigInt(raw);
  }

  private userId(): bigint {
    const raw = this.cls.get<string | undefined>('userId');
    if (!raw) throw new ForbiddenException('Usuário não definido no contexto');
    return BigInt(raw);
  }

  async findMany(q: ListQueryDto) {
    const tenantId = this.tenantId();
    const { total, rows } = await this.repo.findMany(tenantId, q);
    const data = rows.map((c) => ({
      idCliente: c.idCliente.toString(),
      razaoSocial: c.razaoSocial,
      nomeFantasia: c.nomeFantasia,
      cnpj: c.cnpj,
      email: c.email,
      cidade: c.cidade,
      estado: c.estado,
    }));
    return { data, total, page: q.page, pageSize: q.pageSize };
  }

  async findOne(id: string) {
    const row = await this.repo.findFirst(this.tenantId(), BigInt(id));
    if (!row) throw new NotFoundException('Cliente não encontrado');
    return this.serializeCliente(row);
  }

  async create(dto: ClienteCreateDto) {
    const tenantId = this.tenantId();
    const data: Omit<Prisma.ClienteUncheckedCreateInput, 'idTenacidade'> = {
      tipoPessoa: dto.tipoPessoa ?? undefined,
      razaoSocial: dto.razaoSocial ?? undefined,
      nomeFantasia: dto.nomeFantasia ?? undefined,
      cnpj: dto.cnpj ?? undefined,
      email: dto.email ?? undefined,
      telefone: dto.telefone ?? undefined,
      celular: dto.celular ?? undefined,
      cep: dto.cep ?? undefined,
      cidade: dto.cidade ?? undefined,
      estado: dto.estado ?? undefined,
      idUsuarioAuditoria: this.userId(),
    };
    const row = await this.repo.create(tenantId, data);
    return this.serializeCliente(row);
  }

  async update(id: string, dto: ClienteUpdateDto) {
    const tenantId = this.tenantId();
    const existing = await this.repo.findFirst(tenantId, BigInt(id));
    if (!existing) throw new NotFoundException('Cliente não encontrado');
    const data: Prisma.ClienteUpdateInput = {
      ...(dto as Prisma.ClienteUpdateInput),
      idUsuarioAuditoria: this.userId(),
    };
    const row = await this.repo.update(tenantId, BigInt(id), data);
    if (!row) throw new NotFoundException('Cliente não encontrado');
    return this.serializeCliente(row);
  }

  async remove(id: string) {
    const tenantId = this.tenantId();
    const existing = await this.repo.findFirst(tenantId, BigInt(id));
    if (!existing) throw new NotFoundException('Cliente não encontrado');
    await this.repo.delete(tenantId, BigInt(id));
    return { ok: true as const };
  }

  private serializeCliente(row: unknown) {
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }
}
