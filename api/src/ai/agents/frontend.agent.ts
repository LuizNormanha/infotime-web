import { Injectable } from '@nestjs/common';

import { AgenteBase } from './agente-base';

@Injectable()
export class AgenteFrontend extends AgenteBase {
  readonly nome = 'frontend';

  montarInstrucaoEspecifica(): string {
    return [
      '### Agente Frontend (Next.js)',
      '- Separar UI de lógica de negócio; componentes reutilizáveis em `web/src/components`.',
      '- Mensagens de interface via i18n em `web/src/app/(comum)/i18n/mensagens/` quando for o padrão da tela.',
      '- Consumo de API alinhado ao BFF/fetch com credenciais conforme autenticação existente.',
    ].join('\n');
  }
}
