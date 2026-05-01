import { Controller, Get } from '@nestjs/common';

@Controller()
export class AppController {
  @Get()
  root() {
    return {
      name: '@infotime/api',
      stack: 'NestJS 11 + FastifyAdapter',
    };
  }
}
