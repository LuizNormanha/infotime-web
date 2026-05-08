import {
  Injectable,
  Logger,
  ServiceUnavailableException,
} from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

type OpenAiChatResponse = {
  choices: Array<{ message?: { content?: string | null } }>;
};

/**
 * Integração com a API OpenAI (chat).
 * Temperatura e modelo vêm de env; logs sem conteúdo sensível do usuário (apenas tamanhos).
 */
@Injectable()
export class AiService {
  private readonly logger = new Logger(AiService.name);

  constructor(private readonly config: ConfigService) {}

  private obterChave(): string {
    const k = this.config.get<string>('OPENAI_API_KEY');
    if (!k?.trim()) {
      throw new ServiceUnavailableException(
        'OPENAI_API_KEY não configurada. Defina a variável de ambiente para usar a IA.',
      );
    }
    return k.trim();
  }

  private async postOpenAi<T>(caminho: string, corpo: unknown): Promise<T> {
    const res = await fetch(`https://api.openai.com/v1/${caminho}`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${this.obterChave()}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(corpo),
    });
    if (!res.ok) {
      const texto = await res.text();
      this.logger.error(`OpenAI HTTP ${res.status} em ${caminho}: ${texto.slice(0, 500)}`);
      throw new ServiceUnavailableException(
        'Não foi possível completar a solicitação no provedor de IA.',
      );
    }
    return (await res.json()) as T;
  }

  /**
   * Chat com saída JSON (`response_format`), adequado ao contrato do endpoint `/ai/generate`.
   * Não loga o prompt completo (evita vazamento acidental); apenas tamanhos.
   */
  async completarJson(params: {
    mensagemSistema: string;
    mensagemUsuario: string;
    temperatura?: number;
  }): Promise<string> {
    const modelo = this.config.get<string>('OPENAI_CHAT_MODEL', 'gpt-4o-mini');
    const temperatura =
      params.temperatura ??
      Number(this.config.get<string>('OPENAI_CHAT_TEMPERATURE', '0.2'));

    this.logger.log(
      `OpenAI chat model=${modelo} temp=${temperatura} systemChars=${params.mensagemSistema.length} userChars=${params.mensagemUsuario.length}`,
    );

    const json = await this.postOpenAi<OpenAiChatResponse>('chat/completions', {
      model: modelo,
      temperature: Number.isFinite(temperatura) ? temperatura : 0.2,
      response_format: { type: 'json_object' },
      messages: [
        { role: 'system', content: params.mensagemSistema },
        { role: 'user', content: params.mensagemUsuario },
      ],
    });

    const conteudo = json.choices[0]?.message?.content;
    if (conteudo == null || conteudo === '') {
      throw new ServiceUnavailableException('Resposta vazia do modelo de IA.');
    }
    return conteudo;
  }
}
