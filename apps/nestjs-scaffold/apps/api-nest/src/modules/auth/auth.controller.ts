import {
  Body,
  Controller,
  Get,
  HttpCode,
  HttpStatus,
  Post,
  UseGuards,
  UseInterceptors,
} from '@nestjs/common';
import { AuthService } from './auth.service';
import { LoginSchema, LoginDto, RefreshTokenSchema, RefreshTokenDto } from './dto/auth.dto';
import { ZodValidationPipe } from '@shared/pipes/zod-validation.pipe';
import { JwtAuthGuard } from './guards/jwt-auth.guard';
import { TenantInterceptor } from '@shared/interceptors/tenant.interceptor';
import { CurrentUser } from '@shared/decorators/current-user.decorator';
import { Public } from './decorators/public.decorator';
import { JwtPayload } from './strategies/jwt.strategy';

@Controller('auth')
@UseInterceptors(TenantInterceptor)
export class AuthController {
  constructor(private readonly authService: AuthService) {}

  /**
   * POST /api/v1/auth/login
   * Rota pública — não requer autenticação.
   */
  @Public()
  @Post('login')
  @HttpCode(HttpStatus.OK)
  login(@Body(new ZodValidationPipe(LoginSchema)) dto: LoginDto) {
    return this.authService.login(dto);
  }

  /**
   * POST /api/v1/auth/refresh
   * Rota pública — usa o refresh token para obter novo access token.
   */
  @Public()
  @Post('refresh')
  @HttpCode(HttpStatus.OK)
  refresh(@Body(new ZodValidationPipe(RefreshTokenSchema)) dto: RefreshTokenDto) {
    return this.authService.refresh(dto);
  }

  /**
   * GET /api/v1/auth/me
   * Rota protegida — retorna dados do usuário autenticado.
   */
  @UseGuards(JwtAuthGuard)
  @Get('me')
  me(@CurrentUser() user: JwtPayload) {
    return this.authService.me(user.sub, user.tenantId);
  }
}
