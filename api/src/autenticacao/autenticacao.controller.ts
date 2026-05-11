import {
  Body,
  Controller,
  Get,
  HttpCode,
  HttpStatus,
  Post,
  Query,
  Req,
  Res,
  UnauthorizedException,
} from '@nestjs/common';
import { SkipThrottle, Throttle } from '@nestjs/throttler';
import type { Request, Response } from 'express';

import { Public } from '../comum/decorators/public.decorator';
import { UsuarioAtual } from '../comum/decorators/usuario-atual.decorator';
import { GeradorSenhaDoDia } from './gerador-senha-dia.service';
import { ServicoAutenticacao } from './autenticacao.service';
import { DtoLoginUsuario } from './dto/login-usuario.dto';
import { DtoRegistrarAcesso } from './dto/registrar-acesso.dto';
import { DtoValidarSenhaDia } from './dto/validar-senha-dia.dto';

const COOKIE_OPTS = {
  httpOnly: true,
  sameSite: 'lax' as const,
  secure: process.env.NODE_ENV === 'production',
  path: '/',
};

function parseEnvNumber(
  value: string | undefined,
  fallback: number,
  min = 1,
): number {
  const parsed = Number(value);
  if (!Number.isFinite(parsed) || parsed < min) return fallback;
  return Math.floor(parsed);
}

const THROTTLE_LOGIN = {
  global: {
    limit: parseEnvNumber(
      process.env.THROTTLE_LOGIN_LIMIT,
      process.env.NODE_ENV === 'production' ? 10 : 100,
    ),
    ttl: parseEnvNumber(process.env.THROTTLE_LOGIN_TTL_MS, 15 * 60_000, 1_000),
  },
};

@Controller('auth')
export class ControladorAutenticacao {
  constructor(
    private readonly servico: ServicoAutenticacao,
    private readonly geradorSenhaDoDia: GeradorSenhaDoDia,
  ) {}

  // ─── POST /auth/login ────────────────────────────────────────────────────────
  @Throttle(THROTTLE_LOGIN)
  @Public()
  @Post('login')
  @HttpCode(HttpStatus.OK) // ← FORÇA 200 ao invés de 201
  async login(
    @Body() dto: DtoLoginUsuario,
    @Req() req: Request,
    @Res({ passthrough: true }) res: Response,
  ) {
    const resultado = await this.servico.login(dto, req);

    res.cookie('access_token', resultado.access_token, {
      ...COOKIE_OPTS,
      maxAge: 'redirect' in resultado ? 8 * 60 * 60 * 1000 : 15 * 60 * 1000,
    });

    // Suporte: retorna redirect; normal: retorna refresh_token (sem expor access_token)
    if ('redirect' in resultado) {
      return { redirect: resultado.redirect };
    }

    return {
      refresh_token: resultado.refresh_token,
      ...('aviso_licenca_proxima_expiracao' in resultado &&
      resultado.aviso_licenca_proxima_expiracao
        ? {
            aviso_licenca_proxima_expiracao:
              resultado.aviso_licenca_proxima_expiracao,
          }
        : {}),
    };
  }

  // ─── POST /auth/login-confirm ────────────────────────────────────────────────
  @Throttle(THROTTLE_LOGIN)
  @Public()
  @Post('login-confirm')
  @HttpCode(HttpStatus.OK)
  async loginConfirm(
    @Body() dto: DtoLoginUsuario,
    @Req() req: Request,
    @Res({ passthrough: true }) res: Response,
  ) {
    const resultado = await this.servico.loginConfirm(dto, req);

    res.cookie('access_token', resultado.access_token, {
      ...COOKIE_OPTS,
      maxAge: 15 * 60 * 1000,
    });

    return {
      refresh_token: resultado.refresh_token,
      ...('aviso_licenca_proxima_expiracao' in resultado &&
      resultado.aviso_licenca_proxima_expiracao
        ? {
            aviso_licenca_proxima_expiracao:
              resultado.aviso_licenca_proxima_expiracao,
          }
        : {}),
    };
  }

  // ─── POST /auth/logout ───────────────────────────────────────────────────────
  @Post('logout')
  @HttpCode(HttpStatus.NO_CONTENT)
  async logout(@Req() req: Request, @Res({ passthrough: true }) res: Response) {
    const user = req['user'] as { jti: string; suporte: boolean };
    await this.servico.logout(user.jti, user.suporte);
    res.clearCookie('access_token', { path: '/' });
  }

  // ─── GET /auth/status ────────────────────────────────────────────────────────
  // Isento do tier global: chamado em toda navegação protegida e pelo BFF; throttle aqui gerava 429 e o cliente interpretava como sessão morta.
  @SkipThrottle()
  @Get('status')
  async status(@Req() req: Request) {
    const user = req['user'] as {
      id_usuario: string;
      tenantId: string;
      suporte: boolean;
      email?: string;
    };
    const ctx = await this.servico.obterContextoSessaoParaStatus(user);
    return {
      ativo: true,
      id_usuario: user.id_usuario,
      tenantId: user.tenantId,
      email: user.email ?? null,
      ehImplantacao: this.servico.ehUsuarioTecnicoImplantacaoOuSuporte(user),
      dominioTenacidadeSessao: ctx.dominioTenacidadeSessao,
      mutacaoTenacidadeImplantacaoPermitida:
        ctx.mutacaoTenacidadeImplantacaoPermitida,
    };
  }

  @Get('permissoes')
  async permissoesTela(
    @UsuarioAtual() idUsuario: bigint,
    @Query('tela') tela: string,
    @Req() req: Request,
  ) {
    const ehSuporte = (req['user'] as { suporte?: boolean }).suporte === true;
    return this.servico.obterPermissoesTela(idUsuario, tela, ehSuporte);
  }

  @Get('permissoes-perfil')
  async permissoesPerfil(
    @UsuarioAtual() idUsuario: bigint,
    @Req() req: Request,
  ) {
    const ehSuporte = (req['user'] as { suporte?: boolean }).suporte === true;
    return this.servico.listarPermissoesPerfilUsuario(idUsuario, ehSuporte);
  }

  // ─── POST /auth/suporte/registrar-acesso ─────────────────────────────────────
  @Post('suporte/registrar-acesso')
  @HttpCode(HttpStatus.NO_CONTENT)
  async registrarAcesso(@Body() dto: DtoRegistrarAcesso, @Req() req: Request) {
    const user = req['user'] as { jti: string };
    await this.servico.registrarAcessoSuporte(user.jti, dto);
  }

  /** Valida a senha do dia (mesmo algoritmo do login Suporte/Implantação) sem emitir token. */
  @Post('validar-senha-dia')
  @HttpCode(HttpStatus.OK)
  validarSenhaDia(@Body() dto: DtoValidarSenhaDia) {
    if (!this.geradorSenhaDoDia.validarSenhaDoDia(dto.senha)) {
      throw new UnauthorizedException('Senha do dia incorreta.');
    }
    return { ok: true as const };
  }
}
