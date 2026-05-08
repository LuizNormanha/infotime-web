import {
  BadRequestException,
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarUnidadeAtendimentoDto } from './dto/atualizar-unidade-atendimento.dto';
import { CriarUnidadeAtendimentoDto } from './dto/criar-unidade-atendimento.dto';
import { RespostaListagemUnidadeAtendimentoDto } from './dto/resposta-listagem-unidade-atendimento.dto';
import { RespostaUnidadeAtendimentoDto } from './dto/resposta-unidade-atendimento.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

function truncarIp(ip: string): string {
  return ip.length <= IP_MAX ? ip : ip.slice(0, IP_MAX);
}

function optBig(
  v: string | null | undefined,
): bigint | null | undefined {
  if (v === undefined) return undefined;
  if (v === null || v === '') return null;
  try {
    return BigInt(v);
  } catch {
    throw new BadRequestException(`Valor inteiro inválido: ${String(v)}`);
  }
}

@Injectable()
export class UnidadeAtendimentoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'nomeFantasia',
    'sigla',
    'cidade',
    'cnpj',
    'id',
    'ativo',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_unidadeWhereInput {
    const q = qTexto.trim();
    if (campoPesquisa === 'nomeFantasia') {
      return { nome_fantasia: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'sigla') {
      return { sigla: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'cidade') {
      return { cidade: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'cnpj') {
      const digitos = q.replace(/\D/g, '');
      if (!digitos) return {};
      return { cnpj: { contains: digitos, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_unidade: BigInt(q) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'ativo') {
      const letra = q.slice(0, 1).toUpperCase();
      if (letra === 'S' || letra === 'N') {
        return { ativo: letra };
      }
      return {};
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_unidadeWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'nomeFantasia',
      'sigla',
      'cidade',
      'cnpj',
      'ativo',
    ]);
    const partes: Prisma.infolab_unidadeWhereInput[] = [];

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

      if (campo === 'nomeFantasia' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            nome_fantasia: { contains: contem, mode: 'insensitive' },
          });
        }
        continue;
      }
      if (campo === 'sigla' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({ sigla: { contains: contem, mode: 'insensitive' } });
        }
        continue;
      }
      if (campo === 'cidade' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({ cidade: { contains: contem, mode: 'insensitive' } });
        }
        continue;
      }
      if (campo === 'cnpj' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        const digitos = contem.replace(/\D/g, '');
        if (digitos) {
          partes.push({
            cnpj: { contains: digitos, mode: 'insensitive' },
          });
        }
        continue;
      }

      if (campo === 'ativo' && tipo === 'enum') {
        const vals = val['valores'];
        if (!Array.isArray(vals) || vals.length === 0) continue;
        const letras = vals.filter(
          (x): x is string => typeof x === 'string' && (x === 'S' || x === 'N'),
        );
        if (letras.length > 0) {
          partes.push({ ativo: { in: letras } });
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
  ): Promise<{ dados: RespostaListagemUnidadeAtendimentoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_unidadeWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_unidade: true,
      nome_fantasia: true,
      sigla: true,
      cidade: true,
      cnpj: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_unidade,
      baseWhere,
      camposPesquisaWhitelist: UnidadeAtendimentoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_unidade: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_unidade: bigint;
          nome_fantasia: string | null;
          sigla: string | null;
          cidade: string | null;
          cnpj: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_unidade.toString(),
          nomeFantasia: r.nome_fantasia ?? null,
          sigla: r.sigla ?? null,
          cidade: r.cidade ?? null,
          cnpj: r.cnpj ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_unidade.findMany({
          where: where as Prisma.infolab_unidadeWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaUnidadeAtendimentoDto }> {
    const registro = await this.prisma.infolab_unidade.findUnique({
      where: { id_unidade: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Unidade de atendimento ${id} não encontrada.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarUnidadeAtendimentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_unidade.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip),
        nome_aplicacao_auditoria: APP,
        nome_fantasia: dto.nomeFantasia,
        razao_social: dto.razaoSocial ?? null,
        cnpj: dto.cnpj ?? null,
        inscricao_municipal: dto.inscricaoMunicipal ?? null,
        natureza_operacao: dto.naturezaOperacao ?? null,
        regime_tributacao: dto.regimeTributacao ?? null,
        serie_nota_fiscal: optBig(dto.serieNotaFiscal) ?? null,
        id_almoxarifado_padrao: optBig(dto.idAlmoxarifadoPadrao) ?? null,
        id_municipio_nota_fiscal: optBig(dto.idMunicipioNotaFiscal) ?? null,
        cnes: dto.cnes ?? null,
        sigla: dto.sigla ?? null,
        tipo_unidade: dto.tipoUnidade ?? null,
        cep: dto.cep ?? null,
        tipo_logradouro: dto.tipoLogradouro ?? null,
        logradouro: dto.logradouro ?? null,
        bairro: dto.bairro ?? null,
        numero: dto.numero ?? null,
        complemento: dto.complemento ?? null,
        cidade: dto.cidade ?? null,
        estado: dto.estado ?? null,
        latitude: dto.latitude ?? null,
        longitude: dto.longitude ?? null,
        telefone: dto.telefone ?? null,
        celular: dto.celular ?? null,
        amostra_externa_inicio: optBig(dto.amostraExternaInicio) ?? null,
        amostra_externa_fim: optBig(dto.amostraExternaFim) ?? null,
        amostra_externa_atual: optBig(dto.amostraExternaAtual) ?? null,
        senha_internet: dto.senhaInternet ?? null,
        regra_agrupamento_amostra: dto.regraAgrupamentoAmostra ?? null,
        nome_arquivo_logotipo: dto.nomeArquivoLogotipo ?? null,
        nome_referencia_logotipo: dto.nomeReferenciaLogotipo ?? null,
        enviar_amostra: dto.enviarAmostra ?? null,
        enviar_sms: dto.enviarSms ?? null,
        procedencia_atendimento_obrigatorio:
          dto.procedenciaAtendimentoObrigatorio ?? null,
        descricao_servico_nota_fiscal: dto.descricaoServicoNotaFiscal ?? null,
        pertencer_simples_nacional: dto.pertencerSimplesNacional ?? null,
        qtd_dias_validade_orcamento: dto.qtdDiasValidadeOrcamento ?? null,
        alterar_laboratorio_apoio: dto.alterarLaboratorioApoio ?? null,
        lista_procedencia_permitida: dto.listaProcedenciaPermitida ?? undefined,
        lista_convenio_permitido: dto.listaConvenioPermitido ?? undefined,
        indicacao_orcamento: dto.indicacaoOrcamento ?? null,
        ativo: dto.ativo ?? null,
        codigo_externo: dto.codigoExterno ?? null,
      },
      select: { id_unidade: true },
    });
    return { id: criado.id_unidade.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarUnidadeAtendimentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_unidade.findUnique({
      where: { id_unidade: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Unidade de atendimento ${id} não encontrada.`);
    }

    const data: Prisma.infolab_unidadeUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: truncarIp(ip),
      nome_aplicacao_auditoria: APP,
      ...(dto.nomeFantasia !== undefined && { nome_fantasia: dto.nomeFantasia }),
      ...(dto.razaoSocial !== undefined && { razao_social: dto.razaoSocial }),
      ...(dto.cnpj !== undefined && { cnpj: dto.cnpj }),
      ...(dto.inscricaoMunicipal !== undefined && {
        inscricao_municipal: dto.inscricaoMunicipal,
      }),
      ...(dto.naturezaOperacao !== undefined && {
        natureza_operacao: dto.naturezaOperacao,
      }),
      ...(dto.regimeTributacao !== undefined && {
        regime_tributacao: dto.regimeTributacao,
      }),
      ...(dto.serieNotaFiscal !== undefined && {
        serie_nota_fiscal: optBig(dto.serieNotaFiscal),
      }),
      ...(dto.idAlmoxarifadoPadrao !== undefined && {
        id_almoxarifado_padrao: optBig(dto.idAlmoxarifadoPadrao),
      }),
      ...(dto.idMunicipioNotaFiscal !== undefined && {
        id_municipio_nota_fiscal: optBig(dto.idMunicipioNotaFiscal),
      }),
      ...(dto.cnes !== undefined && { cnes: dto.cnes }),
      ...(dto.sigla !== undefined && { sigla: dto.sigla }),
      ...(dto.tipoUnidade !== undefined && { tipo_unidade: dto.tipoUnidade }),
      ...(dto.cep !== undefined && { cep: dto.cep }),
      ...(dto.tipoLogradouro !== undefined && {
        tipo_logradouro: dto.tipoLogradouro,
      }),
      ...(dto.logradouro !== undefined && { logradouro: dto.logradouro }),
      ...(dto.bairro !== undefined && { bairro: dto.bairro }),
      ...(dto.numero !== undefined && { numero: dto.numero }),
      ...(dto.complemento !== undefined && { complemento: dto.complemento }),
      ...(dto.cidade !== undefined && { cidade: dto.cidade }),
      ...(dto.estado !== undefined && { estado: dto.estado }),
      ...(dto.latitude !== undefined && { latitude: dto.latitude }),
      ...(dto.longitude !== undefined && { longitude: dto.longitude }),
      ...(dto.telefone !== undefined && { telefone: dto.telefone }),
      ...(dto.celular !== undefined && { celular: dto.celular }),
      ...(dto.amostraExternaInicio !== undefined && {
        amostra_externa_inicio: optBig(dto.amostraExternaInicio),
      }),
      ...(dto.amostraExternaFim !== undefined && {
        amostra_externa_fim: optBig(dto.amostraExternaFim),
      }),
      ...(dto.amostraExternaAtual !== undefined && {
        amostra_externa_atual: optBig(dto.amostraExternaAtual),
      }),
      ...(dto.senhaInternet !== undefined && {
        senha_internet: dto.senhaInternet,
      }),
      ...(dto.regraAgrupamentoAmostra !== undefined && {
        regra_agrupamento_amostra: dto.regraAgrupamentoAmostra,
      }),
      ...(dto.nomeArquivoLogotipo !== undefined && {
        nome_arquivo_logotipo: dto.nomeArquivoLogotipo,
      }),
      ...(dto.nomeReferenciaLogotipo !== undefined && {
        nome_referencia_logotipo: dto.nomeReferenciaLogotipo,
      }),
      ...(dto.enviarAmostra !== undefined && { enviar_amostra: dto.enviarAmostra }),
      ...(dto.enviarSms !== undefined && { enviar_sms: dto.enviarSms }),
      ...(dto.procedenciaAtendimentoObrigatorio !== undefined && {
        procedencia_atendimento_obrigatorio: dto.procedenciaAtendimentoObrigatorio,
      }),
      ...(dto.descricaoServicoNotaFiscal !== undefined && {
        descricao_servico_nota_fiscal: dto.descricaoServicoNotaFiscal,
      }),
      ...(dto.pertencerSimplesNacional !== undefined && {
        pertencer_simples_nacional: dto.pertencerSimplesNacional,
      }),
      ...(dto.qtdDiasValidadeOrcamento !== undefined && {
        qtd_dias_validade_orcamento: dto.qtdDiasValidadeOrcamento,
      }),
      ...(dto.alterarLaboratorioApoio !== undefined && {
        alterar_laboratorio_apoio: dto.alterarLaboratorioApoio,
      }),
      ...(dto.listaProcedenciaPermitida !== undefined && {
        lista_procedencia_permitida: dto.listaProcedenciaPermitida,
      }),
      ...(dto.listaConvenioPermitido !== undefined && {
        lista_convenio_permitido: dto.listaConvenioPermitido,
      }),
      ...(dto.indicacaoOrcamento !== undefined && {
        indicacao_orcamento: dto.indicacaoOrcamento,
      }),
      ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      ...(dto.codigoExterno !== undefined && {
        codigo_externo: dto.codigoExterno,
      }),
    };

    await this.prisma.infolab_unidade.update({
      where: { id_unidade: BigInt(id) },
      data,
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_unidade.findUnique({
      where: { id_unidade: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Unidade de atendimento ${id} não encontrada.`);
    }
    try {
      await this.prisma.infolab_unidade.delete({
        where: { id_unidade: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta unidade.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_unidade: bigint;
    id_tenacidade: bigint;
    id_almoxarifado_padrao: bigint | null;
    id_municipio_nota_fiscal: bigint | null;
    razao_social: string | null;
    nome_fantasia: string | null;
    cnpj: string | null;
    inscricao_municipal: string | null;
    natureza_operacao: number | null;
    regime_tributacao: number | null;
    serie_nota_fiscal: bigint | null;
    cnes: string | null;
    sigla: string | null;
    tipo_unidade: string | null;
    cep: string | null;
    tipo_logradouro: string | null;
    logradouro: string | null;
    bairro: string | null;
    numero: string | null;
    complemento: string | null;
    cidade: string | null;
    estado: string | null;
    latitude: number | null;
    longitude: number | null;
    telefone: string | null;
    celular: string | null;
    amostra_externa_inicio: bigint | null;
    amostra_externa_fim: bigint | null;
    amostra_externa_atual: bigint | null;
    senha_internet: string | null;
    regra_agrupamento_amostra: number | null;
    nome_arquivo_logotipo: string | null;
    nome_referencia_logotipo: string | null;
    enviar_amostra: string | null;
    enviar_sms: string | null;
    procedencia_atendimento_obrigatorio: string | null;
    descricao_servico_nota_fiscal: string | null;
    pertencer_simples_nacional: string | null;
    qtd_dias_validade_orcamento: number | null;
    alterar_laboratorio_apoio: string | null;
    lista_procedencia_permitida: string | null;
    lista_convenio_permitido: string | null;
    indicacao_orcamento: string | null;
    ativo: string | null;
    codigo_externo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaUnidadeAtendimentoDto {
    return {
      id: registro.id_unidade.toString(),
      id_tenacidade: registro.id_tenacidade.toString(),
      idAlmoxarifadoPadrao: registro.id_almoxarifado_padrao?.toString() ?? null,
      idMunicipioNotaFiscal: registro.id_municipio_nota_fiscal?.toString() ?? null,
      razaoSocial: registro.razao_social ?? null,
      nomeFantasia: registro.nome_fantasia ?? null,
      cnpj: registro.cnpj ?? null,
      inscricaoMunicipal: registro.inscricao_municipal ?? null,
      naturezaOperacao: registro.natureza_operacao ?? null,
      regimeTributacao: registro.regime_tributacao ?? null,
      serieNotaFiscal: registro.serie_nota_fiscal?.toString() ?? null,
      cnes: registro.cnes ?? null,
      sigla: registro.sigla ?? null,
      tipoUnidade: registro.tipo_unidade ?? null,
      cep: registro.cep ?? null,
      tipoLogradouro: registro.tipo_logradouro ?? null,
      logradouro: registro.logradouro ?? null,
      bairro: registro.bairro ?? null,
      numero: registro.numero ?? null,
      complemento: registro.complemento ?? null,
      cidade: registro.cidade ?? null,
      estado: registro.estado ?? null,
      latitude: registro.latitude ?? null,
      longitude: registro.longitude ?? null,
      telefone: registro.telefone ?? null,
      celular: registro.celular ?? null,
      amostraExternaInicio: registro.amostra_externa_inicio?.toString() ?? null,
      amostraExternaFim: registro.amostra_externa_fim?.toString() ?? null,
      amostraExternaAtual: registro.amostra_externa_atual?.toString() ?? null,
      senhaInternet: registro.senha_internet ?? null,
      regraAgrupamentoAmostra: registro.regra_agrupamento_amostra ?? null,
      nomeArquivoLogotipo: registro.nome_arquivo_logotipo ?? null,
      nomeReferenciaLogotipo: registro.nome_referencia_logotipo ?? null,
      enviarAmostra: registro.enviar_amostra ?? null,
      enviarSms: registro.enviar_sms ?? null,
      procedenciaAtendimentoObrigatorio:
        registro.procedencia_atendimento_obrigatorio ?? null,
      descricaoServicoNotaFiscal: registro.descricao_servico_nota_fiscal ?? null,
      pertencerSimplesNacional: registro.pertencer_simples_nacional ?? null,
      qtdDiasValidadeOrcamento: registro.qtd_dias_validade_orcamento ?? null,
      alterarLaboratorioApoio: registro.alterar_laboratorio_apoio ?? null,
      listaProcedenciaPermitida: registro.lista_procedencia_permitida ?? null,
      listaConvenioPermitido: registro.lista_convenio_permitido ?? null,
      indicacaoOrcamento: registro.indicacao_orcamento ?? null,
      ativo: registro.ativo ?? null,
      codigoExterno: registro.codigo_externo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
