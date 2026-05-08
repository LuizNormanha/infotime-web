import { Injectable } from '@nestjs/common';
import { PassportStrategy } from '@nestjs/passport';
import { ExtractJwt, Strategy } from 'passport-jwt';
import { ConfigService } from '@nestjs/config';
import { Request } from 'express';

import { PayloadJwt } from './interfaces/payload-jwt.interface';

/**
 * EstrategiaJwtMultiTenant
 *
 * Estratégia Passport para extração padronizada do token JWT.
 * A validação real da assinatura e da sessão é feita pelo GuardAutenticacaoJwtMultiTenant,
 * que usa chaves dinâmicas por tenant. Esta estratégia serve como base de extração.
 */
@Injectable()
export class EstrategiaJwtMultiTenant extends PassportStrategy(
  Strategy,
  'jwt-multi-tenant',
) {
  constructor(private readonly config: ConfigService) {
    const secret = config.get<string>('SUPORTE_SECRET_KEY');
    if (!secret) {
      throw new Error(
        'SUPORTE_SECRET_KEY não configurada — a aplicação não pode iniciar.',
      );
    }
    super({
      // Extrai do header Bearer ou do cookie access_token
      jwtFromRequest: ExtractJwt.fromExtractors([
        ExtractJwt.fromAuthHeaderAsBearerToken(),
        (req: Request) => {
          const cookies = req.cookies as Record<string, string> | undefined;
          return cookies?.access_token ?? null;
        },
      ]),
      // Não valida expiração aqui — o guard faz a validação completa com chave dinâmica por tenant
      ignoreExpiration: true,
      secretOrKey: secret,
      passReqToCallback: false,
    });
  }

  validate(payload: PayloadJwt) {
    return payload;
  }
}
