import {
  ConflictException,
  ForbiddenException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import * as argon2 from 'argon2';
import { ClsService } from 'nestjs-cls';
import { UsersRepository } from './users.repository';
import { CreateUserDto, UpdateUserDto, UserQueryDto } from './dto/user.dto';

@Injectable()
export class UsersService {
  constructor(
    private readonly repo: UsersRepository,
    private readonly cls: ClsService,
  ) {}

  private tenantId(): bigint {
    const raw = this.cls.get<string | undefined>('tenantId');
    if (!raw) throw new ForbiddenException('Tenant não definido no contexto');
    return BigInt(raw);
  }

  findMany(q: UserQueryDto) {
    return this.repo.findMany(q, this.tenantId());
  }

  async findById(id: string) {
    const u = await this.repo.findById(BigInt(id), this.tenantId());
    if (!u) throw new NotFoundException(`Usuário ${id} não encontrado`);
    return u;
  }

  async create(dto: CreateUserDto) {
    const tenantId = this.tenantId();
    const exists = await this.repo.findByLogin(dto.login, tenantId);
    if (exists) throw new ConflictException(`Login '${dto.login}' já existe`);
    const senha = await argon2.hash(dto.senha);
    return this.repo.create({ ...dto, senha, tenantId });
  }

  async update(id: string, dto: UpdateUserDto) {
    await this.findById(id);
    return this.repo.update(BigInt(id), dto);
  }

  async remove(id: string) {
    await this.findById(id);
    await this.repo.softDelete(BigInt(id), this.tenantId());
    return { message: `Usuário ${id} desativado` };
  }
}
