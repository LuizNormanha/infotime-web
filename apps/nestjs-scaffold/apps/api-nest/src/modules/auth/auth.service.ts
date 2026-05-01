import {
  Injectable,
  NotFoundException,
  UnauthorizedException,
  Logger,
} from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { JwtService } from '@nestjs/jwt';
import * as argon2 from 'argon2';
import { PrismaService } from '@shared/prisma/prisma.service';
import {
  AuthResponseDto,
  LoginDto,
  RefreshTokenDto,
} from './dto/auth.dto';
import { JwtPayload } from './strategies/jwt.strategy';

@Injectable()
export class AuthService {
  private readonly logger = new Logger(AuthService.name);

  constructor(
    private readonly prisma: PrismaService,
    private readonly jwt: JwtService,
    private readonly config: ConfigService,
  ) {}

  async login(dto: LoginDto): Promise<AuthResponseDto> {
    // 1. Busca o usuário pelo login dentro do tenant
    const usuario = await this.prisma.usuario.findFirst({
      where: {
        login: dto.login,
        tenantId: dto.tenantId,
        ativo: true,
      },
      select: {
        id: true,
        nome: true,
        email: true,
        senha: true,
        role: true,
        tenantId: true,
      },
    });

    if (!usuario) {
      throw new UnauthorizedException('Login ou senha incorretos');
    }

    // 2. Verifica a senha com argon2
    const senhaValida = await argon2.verify(usuario.senha, dto.senha);
    if (!senhaValida) {
      throw new UnauthorizedException('Login ou senha incorretos');
    }

    // 3. Gera os tokens
    const payload: Omit<JwtPayload, 'iat' | 'exp'> = {
      sub: usuario.id,
      email: usuario.email ?? '',
      tenantId: usuario.tenantId,
      role: usuario.role,
    };

    const [accessToken, refreshToken] = await Promise.all([
      this.jwt.signAsync(payload, {
        secret: this.config.get<string>('JWT_SECRET'),
        expiresIn: this.config.get<string>('JWT_EXPIRES_IN', '15m'),
      }),
      this.jwt.signAsync(
        { sub: usuario.id, tenantId: usuario.tenantId },
        {
          secret: this.config.get<string>('JWT_REFRESH_SECRET'),
          expiresIn: this.config.get<string>('JWT_REFRESH_EXPIRES_IN', '7d'),
        },
      ),
    ]);

    this.logger.log(
      `Login: user=${usuario.id} tenant=${usuario.tenantId} role=${usuario.role}`,
    );

    return {
      accessToken,
      refreshToken,
      expiresIn: 15 * 60, // 15 minutos em segundos
      user: {
        id: usuario.id,
        nome: usuario.nome,
        email: usuario.email ?? '',
        role: usuario.role,
        tenantId: usuario.tenantId,
      },
    };
  }

  async refresh(dto: RefreshTokenDto): Promise<Pick<AuthResponseDto, 'accessToken' | 'expiresIn'>> {
    let payload: { sub: number; tenantId: number };

    try {
      payload = await this.jwt.verifyAsync(dto.refreshToken, {
        secret: this.config.get<string>('JWT_REFRESH_SECRET'),
      });
    } catch {
      throw new UnauthorizedException('Refresh token inválido ou expirado');
    }

    const usuario = await this.prisma.usuario.findFirst({
      where: { id: payload.sub, tenantId: payload.tenantId, ativo: true },
      select: { id: true, email: true, role: true, tenantId: true },
    });

    if (!usuario) {
      throw new UnauthorizedException('Usuário não encontrado');
    }

    const accessToken = await this.jwt.signAsync(
      {
        sub: usuario.id,
        email: usuario.email ?? '',
        tenantId: usuario.tenantId,
        role: usuario.role,
      },
      {
        secret: this.config.get<string>('JWT_SECRET'),
        expiresIn: this.config.get<string>('JWT_EXPIRES_IN', '15m'),
      },
    );

    return { accessToken, expiresIn: 15 * 60 };
  }

  async me(userId: number, tenantId: number) {
    const usuario = await this.prisma.usuario.findFirst({
      where: { id: userId, tenantId },
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

    if (!usuario) throw new NotFoundException('Usuário não encontrado');
    return usuario;
  }
}
