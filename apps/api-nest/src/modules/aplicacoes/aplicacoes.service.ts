import { ForbiddenException, Injectable, NotFoundException } from '@nestjs/common';
import { ClsService } from 'nestjs-cls';
import type { Prisma } from '@infotime/database';
import { AplicacoesRepository } from './aplicacoes.repository';
import type { ListQueryDto } from '../../shared/dto/list-query.dto';
import type { AplicacaoCreateDto, AplicacaoUpdateDto } from './dto/aplicacao.dto';

@Injectable()
export class AplicacoesService {
  constructor(
    private readonly repo: AplicacoesRepository,
    private readonly cls: ClsService,
  ) {}

  private userId(): bigint {
    const raw = this.cls.get<string | undefined>('userId');
    if (!raw) throw new ForbiddenException('Usuário não definido no contexto');
    return BigInt(raw);
  }

  async findMany(q: ListQueryDto) {
    const { total, rows } = await this.repo.findMany(q);
    const data = rows.map((r) =>
      JSON.parse(JSON.stringify(r, (_k, v) => (typeof v === 'bigint' ? v.toString() : v))),
    );
    return { data, total, page: q.page, pageSize: q.pageSize };
  }

  async findOne(id: string) {
    const row = await this.repo.findById(BigInt(id));
    if (!row) throw new NotFoundException('Aplicação não encontrada');
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async create(dto: AplicacaoCreateDto) {
    const data: Prisma.AplicacaoUncheckedCreateInput = {
      nome: dto.nome,
      tipo: dto.tipo ?? undefined,
      descricao: dto.descricao ?? undefined,
      idUsuarioAuditoria: this.userId(),
    };
    const row = await this.repo.create(data);
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async update(id: string, dto: AplicacaoUpdateDto) {
    const existing = await this.repo.findById(BigInt(id));
    if (!existing) throw new NotFoundException('Aplicação não encontrada');
    const data: Prisma.AplicacaoUpdateInput = { ...dto };
    const row = await this.repo.update(BigInt(id), data);
    if (!row) throw new NotFoundException('Aplicação não encontrada');
    return JSON.parse(JSON.stringify(row, (_k, v) => (typeof v === 'bigint' ? v.toString() : v)));
  }

  async remove(id: string) {
    const existing = await this.repo.findById(BigInt(id));
    if (!existing) throw new NotFoundException('Aplicação não encontrada');
    await this.repo.delete(BigInt(id));
    return { ok: true as const };
  }
}
