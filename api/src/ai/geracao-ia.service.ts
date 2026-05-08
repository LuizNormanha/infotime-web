import { BadRequestException, Injectable, Logger } from '@nestjs/common';

import { GerarIaDto } from './dto/gerar-ia.dto';
import { AiService } from './services/ai.service';
import { CaminhoDominiosService } from './services/caminho-dominios.service';
import { LeitorMarkdownDominioService } from './services/leitor-markdown-dominio.service';
import type { ModoGeracaoIa } from './services/prompt-builder.service';
import { PromptBuilderService } from './services/prompt-builder.service';

/** Mantido na resposta da API por compatibilidade; o fluxo atual não usa recuperação vetorial. */
export type TrechoRespostaApi = {
  dominio: string;
  conteudo: string;
  distancia: number;
};

export type RespostaGeracaoIa = {
  dominio: string;
  modo: ModoGeracaoIa;
  sugestaoBackend: string;
  sugestaoFrontend: string;
  notas: string;
  trechosRecuperados: TrechoRespostaApi[];
};

/**
 * Orquestra leitura de `Rules.md` do domínio (disco) + chamada ao modelo de chat.
 * Não propaga dados de tenant para o prompt.
 */
@Injectable()
export class GeracaoIaService {
  private readonly logger = new Logger(GeracaoIaService.name);

  constructor(
    private readonly montadorPrompt: PromptBuilderService,
    private readonly ia: AiService,
    private readonly leitorMarkdown: LeitorMarkdownDominioService,
    private readonly caminhosDominios: CaminhoDominiosService,
  ) {}

  private async resolverDominio(dto: GerarIaDto): Promise<string> {
    if (dto.dominio?.trim()) {
      return dto.dominio.trim();
    }
    if (
      /\b(listagens?|grid|datatable|padr(ã|a)o(s)?\s+de\s+ui|padroes-ui|liga\s*listagem|formul[aá]rio\s+base)\b/i.test(
        dto.solicitacao,
      )
    ) {
      return 'padroes-ui';
    }
    if (/\b(login|autentica(c|ç)(a|ã)o|sess[aã]o|senha|logout)\b/i.test(dto.solicitacao)) {
      return 'login';
    }
    if (/\b(usu[aá]rio|usuarios|users?)\b/i.test(dto.solicitacao)) {
      return 'usuario';
    }
    if (/\b(tenacidade|tenacidades|tenant|licen(c|ç)a)\b/i.test(dto.solicitacao)) {
      return 'tenacidade';
    }
    const dirs = await this.caminhosDominios.listarNomesDominiosDisponiveis();
    if (dirs.length === 0) {
      throw new BadRequestException(
        'Nenhum domínio encontrado em ai/domains. Configure AI_DOMAINS_ROOT ou adicione pastas em ai/domains/.',
      );
    }
    return [...dirs].sort()[0];
  }

  async gerar(dto: GerarIaDto): Promise<RespostaGeracaoIa> {
    const dominio = await this.resolverDominio(dto);
    const modo: ModoGeracaoIa = dto.modo ?? 'completo';

    const regras = await this.leitorMarkdown.lerArquivo(dominio, 'Rules.md');

    const { mensagemSistema, mensagemUsuario } = this.montadorPrompt.montar({
      solicitacaoUsuario: dto.solicitacao,
      textoRegrasDominio: regras ?? '',
      modo,
    });

    const textoJson = await this.ia.completarJson({
      mensagemSistema,
      mensagemUsuario,
    });

    let sugestaoBackend = '';
    let sugestaoFrontend = '';
    let notas = '';
    try {
      const obj = JSON.parse(textoJson) as Record<string, unknown>;
      sugestaoBackend = String(obj.sugestaoBackend ?? '');
      sugestaoFrontend = String(obj.sugestaoFrontend ?? '');
      notas = String(obj.notas ?? '');
    } catch {
      this.logger.warn('Resposta do modelo não era JSON válido; devolvendo texto bruto em sugestaoBackend.');
      notas =
        'O modelo não retornou JSON válido; o conteúdo bruto foi colocado em sugestaoBackend.';
      sugestaoBackend = textoJson;
    }

    return {
      dominio,
      modo,
      sugestaoBackend,
      sugestaoFrontend,
      notas,
      trechosRecuperados: [],
    };
  }
}
