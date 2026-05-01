import {
  ConflictException,
  Injectable,
  NotFoundException,
  UnauthorizedException,
} from '@nestjs/common';
import * as argon2 from 'argon2';
import { UsersRepository } from './users.repository';
import {
  ChangePasswordDto,
  CreateUserDto,
  UpdateUserDto,
  UserQueryDto,
} from './dto/user.dto';
import { JwtPayload } from '@modules/auth/strategies/jwt.strategy';
import { ClsService } from 'nestjs-cls';

@Injectable()
export class UsersService {
  constructor(
    private readonly repo: UsersRepository,
    private readonly cls: ClsService,
  ) {}

  async findMany(query: UserQueryDto) {
    return this.repo.findMany(query);
  }

  async findById(id: number) {
    const usuario = await this.repo.findById(id);
    if (!usuario) throw new NotFoundException(`Usuário ${id} não encontrado`);
    return usuario;
  }

  async create(dto: CreateUserDto) {
    const tenantId = this.cls.get<number>('tenantId');

    // Verifica duplicidade de login dentro do tenant
    const existing = await this.repo.findByLogin(dto.login);
    if (existing) {
      throw new ConflictException(`Login '${dto.login}' já está em uso`);
    }

    const senhaHash = await argon2.hash(dto.senha);
    return this.repo.create({ ...dto, senha: senhaHash, tenantId });
  }

  async update(id: number, dto: UpdateUserDto) {
    await this.findById(id); // garante que existe
    return this.repo.update(id, dto);
  }

  async changePassword(id: number, dto: ChangePasswordDto) {
    const usuario = await this.repo.findById(id);
    if (!usuario) throw new NotFoundException('Usuário não encontrado');

    // Busca com senha para verificação
    const comSenha = await this.repo.findByLogin((usuario as { login: string }).login);
    if (!comSenha) throw new NotFoundException('Usuário não encontrado');

    const senhaValida = await argon2.verify(comSenha.senha, dto.senhaAtual);
    if (!senhaValida) {
      throw new UnauthorizedException('Senha atual incorreta');
    }

    const novaHash = await argon2.hash(dto.novaSenha);
    await this.repo.updateSenha(id, novaHash);

    return { message: 'Senha alterada com sucesso' };
  }

  async remove(id: number) {
    await this.findById(id);
    await this.repo.softDelete(id);
    return { message: `Usuário ${id} desativado` };
  }
}
