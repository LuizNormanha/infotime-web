import { SetMetadata } from '@nestjs/common';

export const IS_PUBLIC_KEY = 'isPublic';

/**
 * @Public() — marca uma rota como pública, dispensando o JwtAuthGuard.
 *
 * Uso:
 *   @Public()
 *   @Post('auth/login')
 *   login(@Body() dto: LoginDto) { ... }
 */
export const Public = () => SetMetadata(IS_PUBLIC_KEY, true);
