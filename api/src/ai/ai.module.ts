import { Module } from '@nestjs/common';

import { AiController } from './ai.controller';
import { GeracaoIaService } from './geracao-ia.service';
import { AgenteBackend } from './agents/backend.agent';
import { AgenteFrontend } from './agents/frontend.agent';
import { AiService } from './services/ai.service';
import { CaminhoDominiosService } from './services/caminho-dominios.service';
import { LeitorMarkdownDominioService } from './services/leitor-markdown-dominio.service';
import { PromptBuilderService } from './services/prompt-builder.service';

@Module({
  controllers: [AiController],
  providers: [
    AgenteBackend,
    AgenteFrontend,
    AiService,
    CaminhoDominiosService,
    GeracaoIaService,
    LeitorMarkdownDominioService,
    PromptBuilderService,
  ],
  exports: [AiService, GeracaoIaService],
})
export class AiModule {}
