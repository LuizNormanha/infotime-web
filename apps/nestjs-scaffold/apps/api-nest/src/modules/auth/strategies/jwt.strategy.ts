import { Injectable, UnauthorizedException } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { PassportStrategy } from '@nestjs/passport';
import { ExtractJwt, Strategy } from 'passport-jwt';

/**
 * Payload do JWT — tipagem compartilhada com o frontend via shared-types.
 */
export interface JwtPayload {
  sub: number;       // userId
  email: string;
  tenantId: number;  // id do tenant (empresa)
  role: string;      // 'admin' | 'gestor' | 'colaborador' | 'cliente' | 'readonly'
  iat?: number;
  exp?: number;
}

/**
 * JwtStrategy — valida o Bearer token em rotas protegidas.
 * Após validação, req.user = payload do JWT.
 */
@Injectable()
export class JwtStrategy extends PassportStrategy(Strategy, 'jwt') {
  constructor(private readonly config: ConfigService) {
    super({
      jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
      ignoreExpiration: false,
      secretOrKey: config.get<string>('JWT_SECRET')!,
    });
  }

  validate(payload: JwtPayload): JwtPayload {
    if (!payload.sub || !payload.tenantId) {
      throw new UnauthorizedException('Token inválido');
    }
    return payload;
  }
}
