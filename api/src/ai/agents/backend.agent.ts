import { Injectable } from '@nestjs/common';

import { AgenteBase } from './agente-base';

@Injectable()
export class AgenteBackend extends AgenteBase {
  readonly nome = 'backend';

  montarInstrucaoEspecifica(): string {
    return [
      '### Agente Backend (NestJS)',
      '- Módulos: Controller fino → Service com regras; Prisma apenas no service (nunca no controller).',
      '- DTOs com class-validator; tenant via @TenantAtual() / contexto JWT, nunca aceitar id_tenacidade do body público.',
      '- Nomes de domínio em português (Cliente, Tenacidade) alinhados aos modelos Prisma do projeto InfoTIME Web (delegates TS; tabelas mapeadas via @@map no schema).',
      '- Respeitar RLS: usar PrismaService estendido do projeto em requisições autenticadas.',
    ].join('\n');
  }
}
