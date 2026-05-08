import { Injectable } from '@nestjs/common';

import { AgenteBackend } from '../agents/backend.agent';
import { AgenteFrontend } from '../agents/frontend.agent';

export type ModoGeracaoIa = 'completo' | 'backend' | 'frontend';

export type ParametrosPromptIa = {
  solicitacaoUsuario: string;
  textoRegrasDominio: string;
  modo: ModoGeracaoIa;
};

/**
 * Monta mensagens system/user sem incluir identificadores de tenant.
 * Combina: pedido do usuário + Rules.md do domínio (lido do disco) + instruções dos agentes.
 */
@Injectable()
export class PromptBuilderService {
  constructor(
    private readonly agenteBackend: AgenteBackend,
    private readonly agenteFrontend: AgenteFrontend,
  ) {}

  montar(param: ParametrosPromptIa): { mensagemSistema: string; mensagemUsuario: string } {
    const instrucoesAgentes: string[] = [];
    if (param.modo === 'completo' || param.modo === 'backend') {
      instrucoesAgentes.push(this.agenteBackend.montarInstrucaoEspecifica());
    }
    if (param.modo === 'completo' || param.modo === 'frontend') {
      instrucoesAgentes.push(this.agenteFrontend.montarInstrucaoEspecifica());
    }

    const mensagemSistema = [
      'Você é um assistente de arquitetura de software para o produto Infotime (laboratório, multi-tenant PostgreSQL com RLS).',
      'Segurança: não inclua IDs de tenant, nomes reais de pacientes, CPF ou credenciais nas sugestões.',
      'Use apenas o contexto abaixo e as regras explícitas; se faltar informação, declare lacunas em "notas".',
      'Responda **somente** com um objeto JSON válido contendo as chaves:',
      '  "sugestaoBackend" (string, markdown ou texto estruturado),',
      '  "sugestaoFrontend" (string),',
      '  "notas" (string, opcional de detalhes).',
      'Para modo só backend, preencha sugestaoFrontend com string vazia; para só frontend, o inverso.',
      '',
      '## Instruções por agente (stack do repositório)',
      ...instrucoesAgentes,
    ].join('\n');

    const mensagemUsuario = [
      '## Regras explícitas do domínio (Rules.md)',
      param.textoRegrasDominio || '(arquivo Rules.md não encontrado.)',
      '',
      '## Solicitação do desenvolvedor',
      param.solicitacaoUsuario,
    ].join('\n');

    return { mensagemSistema, mensagemUsuario };
  }
}
