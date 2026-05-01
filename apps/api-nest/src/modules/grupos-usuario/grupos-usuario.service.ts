import { ForbiddenException, Injectable, NotFoundException } from '@nestjs/common';
import { ClsService } from 'nestjs-cls';
import type { Prisma } from '@infotime/database';
import { GruposUsuarioRepository } from './grupos-usuario.repository';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';
import type { GrupoCreateDto, GrupoUpdateDto } from './dto/grupo-usuario.dto';

@Injectable()
export class GruposUsuarioService {
  constructor(
    private readonly repo: GruposUsuarioRepository,
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
    const data = rows.map((r) =>
      JSON.parse(JSON.stringify(r, (_k, v) => (typeof v === 'bigint' ? v.toString() : v))),
    );
    return { data, total, page: q.page, pageSize: q.pageSize };
  }

  async findOne(id: string) {
    const row = await this.repo.findFirst(this.tenantId(), BigInt(id));
    if (!row) throw new NotFoundException('Grupo não encontrado');
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async create(dto: GrupoCreateDto) {
    const tenantId = this.tenantId();
    const data: Omit<Prisma.GrupoUsuarioUncheckedCreateInput, 'idTenacidade'> = {
      descricao: dto.descricao,
      idUsuarioAuditoria: this.userId(),
    };
    const row = await this.repo.create(tenantId, data);
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async update(id: string, dto: GrupoUpdateDto) {
    const tenantId = this.tenantId();
    const existing = await this.repo.findFirst(tenantId, BigInt(id));
    if (!existing) throw new NotFoundException('Grupo não encontrado');
    const data: Prisma.GrupoUsuarioUpdateInput = {
      ...dto,
      idUsuarioAuditoria: this.userId(),
    };
    const row = await this.repo.update(tenantId, BigInt(id), data);
    if (!row) throw new NotFoundException('Grupo não encontrado');
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async remove(id: string) {
    const tenantId = this.tenantId();
    const existing = await this.repo.findFirst(tenantId, BigInt(id));
    if (!existing) throw new NotFoundException('Grupo não encontrado');
    await this.repo.delete(tenantId, BigInt(id));
    return { ok: true as const };
  }
}
