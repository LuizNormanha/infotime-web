import { Controller, Get } from '@nestjs/common';
import { SkipThrottle } from '@nestjs/throttler';

import { Public } from './comum/decorators/public.decorator';

@Controller()
export class AppController {
  /** Endpoint raiz público — info mínima do template para quem acessa `/` direto. */
  @SkipThrottle()
  @Public()
  @Get()
  raiz(): { name: string; status: string; health: string } {
    return {
      name: 'liga-prj-template api',
      status: 'ok',
      health: '/health',
    };
  }

  /** Liveness público para load balancer / monitoramento (sem dados sensíveis). */
  @SkipThrottle()
  @Public()
  @Get('health')
  health(): { status: string } {
    return { status: 'ok' };
  }
}
