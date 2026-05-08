import {
  BadRequestException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';
import type { infolab_serie_nota_fiscal_servico, infolab_usuario } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarSerieNotaFiscalServicoDto } from './dto/atualizar-serie-nota-fiscal-servico.dto';
import { CriarSerieNotaFiscalServicoDto } from './dto/criar-serie-nota-fiscal-servico.dto';
import { RespostaListagemSerieNotaFiscalServicoDto } from './dto/resposta-listagem-serie-nota-fiscal-servico.dto';
import { RespostaSerieNotaFiscalServicoDto } from './dto/resposta-serie-nota-fiscal-servico.dto';

type SerieComUsuario = infolab_serie_nota_fiscal_servico & {
  infolab_usuario: Pick<infolab_usuario, 'nome' | 'login'> | null;
};

@Injectable()
export class SerieNotaFiscalServicoService {
  constructor(private readonly prisma: PrismaService) {}

  private parseNumeracao(v: string): bigint {
    const s = v.trim();
    if (!/^\d+$/.test(s)) {
      throw new BadRequestException('numeracao deve ser um inteiro não negativo.');
    }
    return BigInt(s);
  }

  private async assertUnidadeDoTenant(
    idUnidade: bigint,
    idTenacidade: bigint,
  ): Promise<void> {
    const u = await this.prisma.infolab_unidade.findFirst({
      where: { id_unidade: idUnidade, id_tenacidade: idTenacidade },
      select: { id_unidade: true },
    });
    if (!u) {
      throw new BadRequestException(
        'Unidade não encontrada ou não pertence à tenacidade atual.',
      );
    }
  }

  private static readonly CAMPOS_PESQUISA = new Set([
    'sigla',
    'numeracao',
    'id',
    'id_unidade',
  ]);

  private mapRowSerieListagem(r: {
    id_serie_nota_fiscal_servico: bigint;
    sigla: string | null;
    numeracao: bigint;
    id_unidade: bigint;
    infolab_unidade: {
      nome_fantasia: string | null;
      sigla: string | null;
    } | null;
  }): RespostaListagemSerieNotaFiscalServicoDto {
    const nf = r.infolab_unidade;
    const rotulo = [nf?.nome_fantasia, nf?.sigla ? `(${nf.sigla})` : '']
      .filter(Boolean)
      .join(' ')
      .trim();
    return {
      id: r.id_serie_nota_fiscal_servico.toString(),
      sigla: r.sigla ?? '',
      numeracao: r.numeracao.toString(),
      id_unidade: r.id_unidade.toString(),
      unidade_rotulo: rotulo || null,
    };
  }

  private whereCampoPesquisaSerie(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_serie_nota_fiscal_servicoWhereInput {
    if (campoPesquisa === 'sigla') {
      return {
        sigla: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'numeracao') {
      try {
        return { numeracao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_serie_nota_fiscal_servico: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'id_unidade') {
      try {
        return { id_unidade: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoSerie(
    jsonBruto: string | undefined,
  ): Prisma.infolab_serie_nota_fiscal_servicoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['sigla']);
    const partes: Prisma.infolab_serie_nota_fiscal_servicoWhereInput[] = [];

    for (const [campo, valBruto] of Object.entries(root)) {
      if (!permitidos.has(campo)) continue;
      if (
        valBruto === null ||
        typeof valBruto !== 'object' ||
        Array.isArray(valBruto)
      ) {
        continue;
      }
      const val = valBruto as Record<string, unknown>;
      const tipo = typeof val.tipo === 'string' ? val.tipo : '';

      if (campo === 'sigla' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            sigla: { contains: contem, mode: 'insensitive' },
          });
        }
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemSerieNotaFiscalServicoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_serie_nota_fiscal_servicoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_serie_nota_fiscal_servico: true,
      sigla: true,
      numeracao: true,
      id_unidade: true,
      infolab_unidade: {
        select: { nome_fantasia: true, sigla: true },
      },
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 100,
      delegate: this.prisma.infolab_serie_nota_fiscal_servico,
      baseWhere,
      camposPesquisaWhitelist:
        SerieNotaFiscalServicoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaSerie(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoSerie(j),
      orderBy: { id_serie_nota_fiscal_servico: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_serie_nota_fiscal_servico: bigint;
          sigla: string | null;
          numeracao: bigint;
          id_unidade: bigint;
          infolab_unidade: {
            nome_fantasia: string | null;
            sigla: string | null;
          } | null;
        };
        return this.mapRowSerieListagem(r);
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_serie_nota_fiscal_servico.findMany({
          where: where as Prisma.infolab_serie_nota_fiscal_servicoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaSerieNotaFiscalServicoDto }> {
    const reg = await this.prisma.infolab_serie_nota_fiscal_servico.findUnique({
      where: { id_serie_nota_fiscal_servico: BigInt(id) },
      include: {
        infolab_usuario: { select: { nome: true, login: true } },
      },
    });

    if (!reg || reg.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Série NF serviço ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(reg as SerieComUsuario) };
  }

  private mapearResposta(r: SerieComUsuario): RespostaSerieNotaFiscalServicoDto {
    const nomeLogin = r.infolab_usuario;
    const usuarioAud =
      nomeLogin != null
        ? [nomeLogin.nome, nomeLogin.login ? `(${nomeLogin.login})` : '']
            .filter(Boolean)
            .join(' ')
            .trim()
        : null;

    return {
      id: r.id_serie_nota_fiscal_servico.toString(),
      id_tenacidade: r.id_tenacidade.toString(),
      id_unidade: r.id_unidade.toString(),
      sigla: r.sigla,
      numeracao: r.numeracao.toString(),
      tipo_nota_fiscal: r.tipo_nota_fiscal ?? null,
      ativo: r.ativo ?? null,
      ambiente: r.ambiente ?? null,
      lote: r.lote ?? null,
      frase_secreta: r.frase_secreta ?? null,
      senha_web: r.senha_web ?? null,
      usuario_web: r.usuario_web ?? null,
      cer_senha: r.cer_senha ?? null,
      id_usuario_auditoria: r.id_usuario_auditoria?.toString() ?? null,
      usuario_auditoria: usuarioAud,
      endereco_ip_auditoria: r.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: r.nome_aplicacao_auditoria ?? null,
    };
  }

  async criar(
    dto: CriarSerieNotaFiscalServicoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idUni = BigInt(dto.idUnidade);
    await this.assertUnidadeDoTenant(idUni, tenantContexto.idTenacidade);
    const numeracao = this.parseNumeracao(dto.numeracao);
    const ipAud = ip.slice(0, 20);

    const ativoNorm =
      dto.ativo != null && dto.ativo !== ''
        ? dto.ativo.trim().toUpperCase().slice(0, 1)
        : null;
    if (ativoNorm != null && ativoNorm !== 'S' && ativoNorm !== 'N') {
      throw new BadRequestException('ativo deve ser S ou N.');
    }

    const criado = await this.prisma.infolab_serie_nota_fiscal_servico.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_unidade: idUni,
        sigla: dto.sigla.trim(),
        numeracao,
        tipo_nota_fiscal: dto.tipoNotaFiscal ?? null,
        ativo: ativoNorm,
        ambiente: dto.ambiente ?? null,
        lote: dto.lote?.trim() || null,
        frase_secreta: dto.fraseSecreta?.trim() || null,
        senha_web: dto.senhaWeb?.trim() || null,
        usuario_web: dto.usuarioWeb?.trim() || null,
        cer_senha: dto.cerSenha?.trim() || null,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ipAud,
        nome_aplicacao_auditoria: 'infotime-web',
      },
      select: { id_serie_nota_fiscal_servico: true },
    });

    return { id: criado.id_serie_nota_fiscal_servico.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarSerieNotaFiscalServicoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_serie_nota_fiscal_servico.findUnique({
      where: { id_serie_nota_fiscal_servico: BigInt(id) },
      select: { id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Série NF serviço ${id} não encontrada.`);
    }

    if (dto.idUnidade != null) {
      await this.assertUnidadeDoTenant(
        BigInt(dto.idUnidade),
        tenantContexto.idTenacidade,
      );
    }

    const ipAud = ip.slice(0, 20);
    const data: Prisma.infolab_serie_nota_fiscal_servicoUpdateInput = {
      infolab_usuario: { connect: { id_usuario: tenantContexto.idUsuario } },
      endereco_ip_auditoria: ipAud,
      nome_aplicacao_auditoria: 'infotime-web',
    };

    if (dto.idUnidade !== undefined) {
      data.infolab_unidade = {
        connect: { id_unidade: BigInt(dto.idUnidade) },
      };
    }
    if (dto.sigla !== undefined) data.sigla = dto.sigla.trim();
    if (dto.numeracao !== undefined) {
      data.numeracao = this.parseNumeracao(dto.numeracao);
    }
    if (dto.tipoNotaFiscal !== undefined) {
      data.tipo_nota_fiscal = dto.tipoNotaFiscal;
    }
    if (dto.ativo !== undefined) {
      if (dto.ativo === '' || dto.ativo == null) {
        data.ativo = null;
      } else {
        const a = dto.ativo.trim().toUpperCase().slice(0, 1);
        if (a !== 'S' && a !== 'N') {
          throw new BadRequestException('ativo deve ser S ou N.');
        }
        data.ativo = a;
      }
    }
    if (dto.ambiente !== undefined) data.ambiente = dto.ambiente;
    if (dto.lote !== undefined) data.lote = dto.lote?.trim() || null;
    if (dto.fraseSecreta !== undefined) {
      data.frase_secreta = dto.fraseSecreta?.trim() || null;
    }
    if (dto.senhaWeb !== undefined) data.senha_web = dto.senhaWeb?.trim() || null;
    if (dto.usuarioWeb !== undefined) {
      data.usuario_web = dto.usuarioWeb?.trim() || null;
    }
    if (dto.cerSenha !== undefined) data.cer_senha = dto.cerSenha?.trim() || null;

    await this.prisma.infolab_serie_nota_fiscal_servico.update({
      where: { id_serie_nota_fiscal_servico: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_serie_nota_fiscal_servico.findUnique({
      where: { id_serie_nota_fiscal_servico: BigInt(id) },
      select: { id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Série NF serviço ${id} não encontrada.`);
    }

    await this.prisma.infolab_serie_nota_fiscal_servico.delete({
      where: { id_serie_nota_fiscal_servico: BigInt(id) },
    });

    return { ok: true };
  }
}
