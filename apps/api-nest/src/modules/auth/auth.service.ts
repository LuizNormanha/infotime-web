import { createHash } from 'node:crypto';
import { Injectable, NotFoundException, UnauthorizedException, Logger } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { JwtService } from '@nestjs/jwt';
import * as argon2 from 'argon2';
import * as bcrypt from 'bcryptjs';
import { PrismaService } from '../../shared/prisma/prisma.service';
import { AuthResponseDto, LoginDto, RefreshTokenDto } from './dto/auth.dto';

async function verifyPassword(plain: string, stored: string): Promise<boolean> {
  if (stored.startsWith('$argon')) return argon2.verify(stored, plain);
  if (stored.startsWith('$2')) return bcrypt.compare(plain, stored);
  const md5 = createHash('md5').update(plain).digest('hex');
  return md5.toLowerCase() === stored.toLowerCase();
}

@Injectable()
export class AuthService {
  private readonly logger = new Logger(AuthService.name);

  constructor(
    private readonly prisma: PrismaService,
    private readonly jwt: JwtService,
    private readonly config: ConfigService,
  ) {}

  async login(dto: LoginDto): Promise<AuthResponseDto> {
    const usuario = await this.prisma.usuario.findFirst({
      where: {
        login: dto.login,
        idTenacidade: BigInt(dto.tenantId),
      },
      select: {
        idUsuario: true,
        nome: true,
        email: true,
        senha: true,
        administrador: true,
        idTenacidade: true,
        ativo: true,
      },
    });

    if (!usuario?.senha) throw new UnauthorizedException('Login ou senha incorretos');
    if (usuario.ativo && usuario.ativo.toLowerCase() !== 'sim') {
      throw new UnauthorizedException('Usuário inativo');
    }

    const valid = await verifyPassword(dto.senha, usuario.senha);
    if (!valid) throw new UnauthorizedException('Login ou senha incorretos');

    if (!usuario.senha.startsWith('$argon')) {
      const upgraded = await argon2.hash(dto.senha);
      await this.prisma.usuario.update({
        where: { idUsuario: usuario.idUsuario },
        data: { senha: upgraded },
      });
    }

    const role = usuario.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador';
    const tenantIdStr = usuario.idTenacidade!.toString();
    const payload = {
      sub: usuario.idUsuario.toString(),
      email: usuario.email ?? '',
      tenantId: tenantIdStr,
      role,
    };

    const expAccess = (this.config.get<string>('JWT_EXPIRES_IN') ?? '15m') as NonNullable<
      import('jsonwebtoken').SignOptions['expiresIn']
    >;
    const expRefresh = (this.config.get<string>('JWT_REFRESH_EXPIRES_IN') ?? '7d') as NonNullable<
      import('jsonwebtoken').SignOptions['expiresIn']
    >;

    const [accessToken, refreshToken] = await Promise.all([
      this.jwt.signAsync(payload, {
        secret: this.config.get<string>('JWT_SECRET'),
        expiresIn: expAccess,
      }),
      this.jwt.signAsync(
        { sub: payload.sub, tenantId: tenantIdStr },
        {
          secret: this.config.get<string>('JWT_REFRESH_SECRET'),
          expiresIn: expRefresh,
        },
      ),
    ]);

    this.logger.log(`Login: user=${usuario.idUsuario} tenant=${tenantIdStr}`);
    return {
      accessToken,
      refreshToken,
      expiresIn: 900,
      user: {
        id: usuario.idUsuario.toString(),
        nome: usuario.nome ?? '',
        email: usuario.email ?? '',
        role,
        tenantId: tenantIdStr,
      },
    };
  }

  async refresh(dto: RefreshTokenDto) {
    let payload: { sub: string; tenantId: string };
    try {
      payload = await this.jwt.verifyAsync<{ sub: string; tenantId: string }>(dto.refreshToken, {
        secret: this.config.get<string>('JWT_REFRESH_SECRET'),
      });
    } catch {
      throw new UnauthorizedException('Refresh token inválido');
    }

    const u = await this.prisma.usuario.findFirst({
      where: {
        idUsuario: BigInt(payload.sub),
        idTenacidade: BigInt(payload.tenantId),
      },
      select: {
        idUsuario: true,
        email: true,
        administrador: true,
        idTenacidade: true,
        ativo: true,
      },
    });
    if (!u || (u.ativo && u.ativo.toLowerCase() !== 'sim')) {
      throw new UnauthorizedException('Usuário não encontrado');
    }

    const role = u.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador';
    const expAccess = (this.config.get<string>('JWT_EXPIRES_IN') ?? '15m') as NonNullable<
      import('jsonwebtoken').SignOptions['expiresIn']
    >;
    const accessToken = await this.jwt.signAsync(
      {
        sub: u.idUsuario.toString(),
        email: u.email ?? '',
        tenantId: u.idTenacidade!.toString(),
        role,
      },
      {
        secret: this.config.get<string>('JWT_SECRET'),
        expiresIn: expAccess,
      },
    );
    return { accessToken, expiresIn: 900 };
  }

  async me(userId: string, tenantId: string) {
    const u = await this.prisma.usuario.findFirst({
      where: {
        idUsuario: BigInt(userId),
        idTenacidade: BigInt(tenantId),
      },
      select: {
        idUsuario: true,
        nome: true,
        email: true,
        login: true,
        administrador: true,
        idTenacidade: true,
        ativo: true,
      },
    });
    if (!u) throw new NotFoundException('Usuário não encontrado');
    return {
      ...u,
      idUsuario: u.idUsuario.toString(),
      idTenacidade: u.idTenacidade?.toString() ?? null,
      role: u.administrador?.toLowerCase() === 'sim' ? 'admin' : 'colaborador',
    };
  }
}
