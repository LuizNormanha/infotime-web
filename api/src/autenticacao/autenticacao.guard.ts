import {
  CanActivate,
  ExecutionContext,
  Injectable,
  UnauthorizedException,
} from '@nestjs/common';
import { Reflector } from '@nestjs/core';
import { ConfigService } from '@nestjs/config';
import { JwtService } from '@nestjs/jwt';
import * as jwt from 'jsonwebtoken';
import type { Request } from 'express';

import { IS_PUBLIC_KEY } from '../comum/decorators/public.decorator';
import { PrismaService } from '../prisma/prisma.service';
import { PayloadJwt } from './interfaces/payload-jwt.interface';

@Injectable()
export class GuardAutenticacaoJwtMultiTenant implements CanActivate {
  // ─── REGRA DE OURO DE SEGURANÇA ─────────────────────────────────────────────
  // [SEGURANÇA] O id_tenacidade NUNCA vem do body da requisição.
  // Ele é extraído exclusivamente do JWT assinado pelo servidor no momento do login.
  // Qualquer tentativa de passar id_tenacidade no body é silenciosamente ignorada pelos services.
  // Isso garante isolamento total de dados entre tenants (preparação para RLS no PostgreSQL).
  // ────────────────────────────────────────────────────────────────────────────

  constructor(
    private readonly reflector: Reflector,
    private readonly prisma: PrismaService,
    private readonly jwtService: JwtService,
    private readonly config: ConfigService,
  ) {}

  async canActivate(context: ExecutionContext): Promise<boolean> {
    const isPublic = this.reflector.getAllAndOverride<boolean>(IS_PUBLIC_KEY, [
      context.getHandler(),
      context.getClass(),
    ]);
    if (isPublic) return true;

    const req = context.switchToHttp().getRequest<Request>();
    const token = this.extrairToken(req);

    if (!token) throw new UnauthorizedException();

    const decoded = jwt.decode(token) as PayloadJwt | null;
    if (!decoded?.sub || !decoded?.jti) throw new UnauthorizedException();

    const isSuporte = 'suporte' in decoded && decoded.suporte === true;

    try {
      if (isSuporte) {
        await this.validarESlideSuporte(token, decoded.jti, decoded.tenantId);
      } else {
        await this.validarESlideNormal(token, decoded.tenantId, decoded.jti);
      }
    } catch {
      throw new UnauthorizedException();
    }

    const emailJwt =
      decoded && typeof (decoded as { email?: unknown }).email === 'string'
        ? (decoded as { email: string }).email
        : undefined;

    req['user'] = {
      id_usuario: decoded.sub,
      tenantId: decoded.tenantId,
      suporte: isSuporte,
      jti: decoded.jti,
      email: emailJwt,
    };

    return true;
  }

  // ─── Sessão normal — valida e renova expiração (sliding) ────────────────────

  private async validarESlideNormal(
    token: string,
    tenantId: string,
    jti: string,
  ): Promise<void> {
    const cfgs = await this.prisma.infolab_tenacidade_configuracao.findMany({
      where: { id_tenacidade: BigInt(tenantId) },
      orderBy: { id_tenacidade_configuracao: 'asc' },
      select: {
        chave_jwt: true,
        timeout_sessao_minutos: true,
        dominio_tenacidade: true,
      },
    });
    const cfg =
      cfgs.find((c) => (c.dominio_tenacidade ?? '').trim()) ?? cfgs[0];

    if (!cfg?.chave_jwt) throw new UnauthorizedException();

    this.jwtService.verify(token, { secret: cfg.chave_jwt });

    const sessao = await this.prisma.infolab_sessao_usuario.findFirst({
      where: { token_id: jti, ativo: 'S', data_expiracao: { gt: new Date() } },
      select: { id_sessao: true, id_usuario: true },
    });

    if (!sessao) throw new UnauthorizedException();

    const timeoutMin = cfg.timeout_sessao_minutos ?? 15;

    const novaExpiracao = new Date(Date.now() + timeoutMin * 60 * 1000);
    await this.prisma.infolab_sessao_usuario.update({
      where: { id_sessao: sessao.id_sessao },
      data: { data_expiracao: novaExpiracao },
    });
  }

  // ─── Sessão suporte — valida e renova expiração (sliding) ───────────────────

  private async validarESlideSuporte(
    token: string,
    jti: string,
    tenantId: string,
  ): Promise<void> {
    const secretKey = this.config.get<string>('SUPORTE_SECRET_KEY');
    if (!secretKey) throw new UnauthorizedException();

    this.jwtService.verify(token, { secret: secretKey });

    const sessao = await this.prisma.infolab_sessao_suporte.findFirst({
      where: {
        token_id: jti,
        id_tenacidade: BigInt(tenantId),
        ativo: 'S',
        data_expiracao: { gt: new Date() },
      },
      select: { id_sessao_suporte: true, id_usuario: true },
    });

    if (!sessao) throw new UnauthorizedException();

    const timeoutMin = 15;

    const novaExpiracao = new Date(Date.now() + timeoutMin * 60 * 1000);
    await this.prisma.infolab_sessao_suporte.update({
      where: { id_sessao_suporte: sessao.id_sessao_suporte },
      data: { data_expiracao: novaExpiracao },
    });
  }

  private extrairToken(req: Request): string | null {
    const authHeader = req.headers['authorization'];
    if (authHeader?.startsWith('Bearer ')) {
      return authHeader.slice(7);
    }
    const cookies = req.cookies as Record<string, string> | undefined;
    return cookies?.access_token ?? null;
  }
}
