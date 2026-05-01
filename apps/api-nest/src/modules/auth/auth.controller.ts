import { Body, Controller, Get, HttpCode, HttpStatus, Post, UseGuards, UseInterceptors } from '@nestjs/common';
import { AuthService } from './auth.service';
import { LoginSchema, LoginDto, RefreshTokenSchema, RefreshTokenDto } from './dto/auth.dto';
import { ZodValidationPipe } from '../../shared/pipes/zod-validation.pipe';
import { JwtAuthGuard } from './guards/jwt-auth.guard';
import { TenantInterceptor } from '../../shared/interceptors/tenant.interceptor';
import { CurrentUser } from '../../shared/decorators/current-user.decorator';
import { Public } from './decorators/public.decorator';
import type { JwtPayload } from './strategies/jwt.strategy';

@Controller('auth')
@UseInterceptors(TenantInterceptor)
export class AuthController {
  constructor(private readonly authService: AuthService) {}

  @Public()
  @Post('login')
  @HttpCode(HttpStatus.OK)
  login(@Body(new ZodValidationPipe(LoginSchema)) dto: LoginDto) {
    return this.authService.login(dto);
  }

  @Public()
  @Post('refresh')
  @HttpCode(HttpStatus.OK)
  refresh(@Body(new ZodValidationPipe(RefreshTokenSchema)) dto: RefreshTokenDto) {
    return this.authService.refresh(dto);
  }

  @UseGuards(JwtAuthGuard)
  @Get('me')
  me(@CurrentUser() user: JwtPayload) {
    return this.authService.me(user.sub, user.tenantId);
  }
}
