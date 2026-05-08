import {
  BadRequestException,
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';
import { PrismaService } from '../prisma/prisma.service';
import { setCurrentTenantLocal } from '../prisma/set-current-tenant-local';
import { executarComRlsJaAplicadoNaTransacao } from '../prisma/tenant-rls.storage';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { CriarClienteDto } from './dto/criar-cliente.dto';
import { AtualizarClienteDto } from './dto/atualizar-cliente.dto';
import { RespostaClienteDto } from './dto/resposta-cliente.dto';
import { RespostaListagemClienteDto } from './dto/resposta-listagem-cliente.dto';
import type { infolab_cliente } from '@prisma/client';

@Injectable()
export class ClienteService {
  constructor(private readonly prisma: PrismaService) {}

  /** FK RESTRICT no Postgres (ex.: código 23001) ou P2003 — Prisma pode expor como erro conhecido ou não. */
  private static eErroExclusaoPorReferencia(e: unknown): boolean {
    if (e instanceof Prisma.PrismaClientKnownRequestError) {
      return e.code === 'P2003' || e.code === 'P2014';
    }
    if (e instanceof Prisma.PrismaClientUnknownRequestError) {
      const msg = e.message;
      return (
        msg.includes('23001') ||
        msg.includes('violates RESTRICT') ||
        msg.includes('foreign key constraint')
      );
    }
    return false;
  }

  /**
   * Campos permitidos em `campoPesquisa` para filtro indexável no Postgres.
   * Manter alinhado a índidos reais (revisão DBA ao incluir campo).
   */
  private static readonly CAMPOS_PESQUISA_CLIENTE = new Set([
    'nome',
    'cpf',
    'documento',
    'email',
    'codigo_externo',
  ]);

  // [NEGÓCIO] Lista clientes da tenacidade do usuário logado.
  // Filtra EXCLUSIVAMENTE por tenantContexto.idTenacidade.
  async listar(
    tenantContexto: TenantContexto,
    todos: boolean,
    query?: {
      cargaInicial?: string;
      q?: string;
      campoPesquisa?: string;
      pagina?: string;
      tamanhoPagina?: string;
      /** JSON: filtros refinados da listagem (campos whitelist). */
      filtroRefinado?: string;
    },
  ): Promise<{ dados: RespostaListagemClienteDto[]; total: number }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        const baseWhere: Prisma.infolab_clienteWhereInput = {
          id_tenacidade: tenantContexto.idTenacidade,
        };

        const novoModo =
          query?.cargaInicial != null ||
          query?.pagina != null ||
          query?.tamanhoPagina != null ||
          query?.campoPesquisa != null ||
          query?.q !== undefined ||
          (query?.filtroRefinado != null && query.filtroRefinado.trim() !== '');

        if (!novoModo) {
          const clientes = await tx.infolab_cliente.findMany({
            where: baseWhere,
            ...(todos ? {} : { take: 50 }),
            orderBy: { id_cliente: 'desc' },
            select: this.selectListagemCliente(),
          });
          const dados = clientes.map((c) =>
            this.mapearParaListagemDto(c as unknown as infolab_cliente),
          );
          return { dados, total: dados.length };
        }

        const cargaInicial = query?.cargaInicial?.trim();
        const qBruto = query?.q ?? '';
        const qTexto = qBruto.trim();
        const campoPesquisa = query?.campoPesquisa?.trim() ?? '';
        const pagina = Math.max(parseInt(query?.pagina ?? '0', 10) || 0, 0);
        const tamanhoPagina = Math.min(
          Math.max(parseInt(query?.tamanhoPagina ?? '10', 10) || 10, 1),
          100,
        );

        if (cargaInicial === 'vazio' && qTexto === '') {
          return { dados: [], total: 0 };
        }

        let whereExtra: Prisma.infolab_clienteWhereInput = {};
        if (qTexto !== '' && campoPesquisa !== '') {
          if (!ClienteService.CAMPOS_PESQUISA_CLIENTE.has(campoPesquisa)) {
            throw new BadRequestException(
              `campoPesquisa inválido: ${campoPesquisa}`,
            );
          }
          whereExtra = this.whereCampoPesquisaCliente(campoPesquisa, qTexto);
        }

        const whereFiltroRef = this.whereFiltroRefinadoCliente(
          query?.filtroRefinado,
        );

        const condicoes: Prisma.infolab_clienteWhereInput[] = [baseWhere];
        if (Object.keys(whereExtra).length > 0) {
          condicoes.push(whereExtra);
        }
        if (Object.keys(whereFiltroRef).length > 0) {
          condicoes.push(whereFiltroRef);
        }
        const where: Prisma.infolab_clienteWhereInput =
          condicoes.length === 1 ? condicoes[0] : { AND: condicoes };

        const total = await tx.infolab_cliente.count({ where });

        if (cargaInicial === 'ultimo' && qTexto === '') {
          const ultimos = await tx.infolab_cliente.findMany({
            where,
            orderBy: { id_cliente: 'desc' },
            take: 1,
            select: this.selectListagemCliente(),
          });
          return {
            dados: ultimos.map((c) =>
              this.mapearParaListagemDto(c as unknown as infolab_cliente),
            ),
            total,
          };
        }

        const skip = pagina * tamanhoPagina;
        const linhas = await tx.infolab_cliente.findMany({
          where,
          orderBy: { id_cliente: 'desc' },
          skip,
          take: tamanhoPagina,
          select: this.selectListagemCliente(),
        });

        return {
          dados: linhas.map((c) =>
            this.mapearParaListagemDto(c as unknown as infolab_cliente),
          ),
          total,
        };
      });
    });
  }

  private selectListagemCliente(): Prisma.infolab_clienteSelect {
    return {
      id_cliente: true,
      nome: true,
      nome_social: true,
      sexo: true,
      data_nascimento: true,
      cpf: true,
      documento: true,
      email: true,
      telefone: true,
      celular: true,
      bloqueado: true,
      bairro: true,
      cidade: true,
      data_inclusao: true,
      codigo_externo: true,
    };
  }

  private parseDataFiltroRefinado(v: unknown): Date | null {
    if (v == null) return null;
    if (v instanceof Date && !Number.isNaN(v.getTime())) return v;
    if (typeof v === 'string' || typeof v === 'number') {
      const d = new Date(v);
      return Number.isNaN(d.getTime()) ? null : d;
    }
    return null;
  }

  /**
   * Filtro refinado da listagem (JSON do front). Apenas campos whitelist;
   * demais chaves são ignoradas.
   */
  private whereFiltroRefinadoCliente(
    jsonBruto: string | undefined,
  ): Prisma.infolab_clienteWhereInput {
    if (jsonBruto == null || jsonBruto.trim() === '') {
      return {};
    }
    let root: unknown;
    try {
      root = JSON.parse(jsonBruto) as unknown;
    } catch {
      throw new BadRequestException('filtroRefinado não é JSON válido.');
    }
    if (root === null || typeof root !== 'object' || Array.isArray(root)) {
      return {};
    }
    const obj = root as Record<string, unknown>;
    const permitidos = new Set(['nome', 'cpf', 'data_nascimento', 'status']);
    const partes: Prisma.infolab_clienteWhereInput[] = [];

    for (const [campo, valBruto] of Object.entries(obj)) {
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

      if (campo === 'nome' && tipo === 'texto') {
        const contemBruto = val['contem'];
        const contem =
          typeof contemBruto === 'string' ? contemBruto.trim() : '';
        if (contem) {
          partes.push({
            nome: { contains: contem, mode: 'insensitive' },
          });
        }
        continue;
      }
      if (campo === 'cpf' && tipo === 'texto') {
        const contemBruto = val['contem'];
        const digits =
          typeof contemBruto === 'string' ? contemBruto.replace(/\D/g, '') : '';
        if (digits) {
          partes.push({ cpf: { contains: digits } });
        }
        continue;
      }
      if (campo === 'data_nascimento' && tipo === 'data') {
        const de = this.parseDataFiltroRefinado(val.de);
        const ate = this.parseDataFiltroRefinado(val.ate);
        const entreDatasFlag = val['entreDatas'] === true;
        /** UI antiga: dois valores sem `entreDatas` → intervalo entre datas. */
        const legadoAmbosSemFlag =
          val['entreDatas'] !== true && de != null && ate != null;

        if (de == null && ate == null) {
          continue;
        }

        if (
          !entreDatasFlag &&
          !legadoAmbosSemFlag &&
          de != null &&
          ate == null
        ) {
          const ini = new Date(de);
          ini.setHours(0, 0, 0, 0);
          const fim = new Date(de);
          fim.setHours(23, 59, 59, 999);
          partes.push({
            data_nascimento: { gte: ini, lte: fim },
          });
          continue;
        }

        if (de && ate) {
          const ini = new Date(de);
          ini.setHours(0, 0, 0, 0);
          const fim = new Date(ate);
          fim.setHours(23, 59, 59, 999);
          partes.push({
            data_nascimento: { gte: ini, lte: fim },
          });
          continue;
        }
        if (de) {
          const ini = new Date(de);
          ini.setHours(0, 0, 0, 0);
          partes.push({ data_nascimento: { gte: ini } });
          continue;
        }
        if (ate) {
          const fim = new Date(ate);
          fim.setHours(23, 59, 59, 999);
          partes.push({ data_nascimento: { lte: fim } });
        }
        continue;
      }
      if (campo === 'status' && tipo === 'enum') {
        const valores = Array.isArray(val.valores)
          ? val.valores.filter((x): x is string => typeof x === 'string')
          : [];
        const querAtivo = valores.includes('Ativo');
        const querInativo = valores.includes('Inativo');
        if (querAtivo && querInativo) {
          /* sem restrição de situação */
        } else if (querAtivo) {
          /* Igual à listagem: status Ativo quando bloqueado !== 'S' (NULL conta como ativo). */
          partes.push({
            OR: [{ bloqueado: null }, { bloqueado: { not: 'S' } }],
          });
        } else if (querInativo) {
          partes.push({ bloqueado: 'S' });
        }
        continue;
      }
    }

    if (partes.length === 0) return {};
    if (partes.length === 1) return partes[0];
    return { AND: partes };
  }

  private whereCampoPesquisaCliente(
    campo: string,
    q: string,
  ): Prisma.infolab_clienteWhereInput {
    switch (campo) {
      case 'nome':
        return { nome: { contains: q, mode: 'insensitive' } };
      case 'cpf': {
        const digits = q.replace(/\D/g, '');
        if (!digits) return {};
        return { cpf: { contains: digits } };
      }
      case 'documento':
        return { documento: { contains: q, mode: 'insensitive' } };
      case 'email':
        return { email: { contains: q, mode: 'insensitive' } };
      case 'codigo_externo':
        return { codigo_externo: { contains: q, mode: 'insensitive' } };
      default:
        return {};
    }
  }

  // [NEGÓCIO] Busca cliente por ID verificando ownership de tenant.
  // Lança NotFoundException se não existir ou pertencer a outro tenant.
  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaClienteDto }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        const cliente = await tx.infolab_cliente.findUnique({
          where: { id_cliente: BigInt(id) },
        });

        // [SEGURANÇA] Verifica que o registro pertence ao tenant do JWT.
        if (!cliente || cliente.id_tenacidade !== tenantContexto.idTenacidade) {
          throw new NotFoundException(`Cliente ${id} não encontrado.`);
        }

        return {
          dados: this.mapearParaRespostaDto(
            cliente as unknown as infolab_cliente,
          ),
        };
      });
    });
  }

  // [NEGÓCIO] Cria cliente.
  // id_tenacidade SEMPRE vem de tenantContexto — qualquer valor no DTO é ignorado.
  async criar(
    dto: CriarClienteDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        const criado = await tx.infolab_cliente.create({
          data: {
            // [SEGURANÇA] id_tenacidade SEMPRE do JWT — nunca do DTO.
            id_tenacidade: tenantContexto.idTenacidade,
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: ip,
            nome_aplicacao_auditoria: 'infotime-web',
            data_inclusao: new Date(),
            nome: dto.nome ?? null,
            nome_social: dto.nome_social ?? null,
            cpf: dto.cpf ?? null,
            documento: dto.documento ?? null,
            codigo_passaporte: dto.codigo_passaporte ?? null,
            prontuario: dto.prontuario ?? null,
            codigo_externo: dto.codigo_externo ?? null,
            sexo: dto.sexo ?? null,
            estado_civil: dto.estado_civil ?? null,
            data_nascimento: dto.data_nascimento
              ? new Date(dto.data_nascimento)
              : null,
            peso: dto.peso != null ? BigInt(dto.peso) : null,
            altura: dto.altura != null ? BigInt(dto.altura) : null,
            diabetico: dto.diabetico ?? null,
            falecido: dto.falecido ?? null,
            receber_mensagem: dto.receber_mensagem ?? null,
            bloqueado: dto.bloqueado ?? null,
            cep: dto.cep ?? null,
            logradouro: dto.logradouro ?? null,
            numero: dto.numero ?? null,
            complemento: dto.complemento ?? null,
            bairro: dto.bairro ?? null,
            cidade: dto.cidade ?? null,
            estado: dto.estado ?? null,
            endereco_referencia: dto.endereco_referencia ?? null,
            telefone: dto.telefone ?? null,
            celular: dto.celular ?? null,
            email: dto.email ?? null,
            senha_internet: dto.senha_internet ?? null,
            observacao_resultado: dto.observacao_resultado ?? null,
          },
          select: { id_cliente: true },
        });

        return { id: criado.id_cliente.toString() };
      });
    });
  }

  // [NEGÓCIO] Atualiza cliente após verificar ownership de tenant.
  async atualizar(
    id: string,
    dto: AtualizarClienteDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        // [SEGURANÇA] Verifica ownership antes de qualquer mutação.
        const existente = await tx.infolab_cliente.findUnique({
          where: { id_cliente: BigInt(id) },
          select: { id_tenacidade: true },
        });

        if (
          !existente ||
          existente.id_tenacidade !== tenantContexto.idTenacidade
        ) {
          throw new NotFoundException(`Cliente ${id} não encontrado.`);
        }

        await tx.infolab_cliente.update({
          where: { id_cliente: BigInt(id) },
          data: {
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: ip,
            nome_aplicacao_auditoria: 'infotime-web',
            ...(dto.nome !== undefined && { nome: dto.nome }),
            ...(dto.nome_social !== undefined && {
              nome_social: dto.nome_social,
            }),
            ...(dto.cpf !== undefined && { cpf: dto.cpf }),
            ...(dto.documento !== undefined && { documento: dto.documento }),
            ...(dto.codigo_passaporte !== undefined && {
              codigo_passaporte: dto.codigo_passaporte,
            }),
            ...(dto.prontuario !== undefined && { prontuario: dto.prontuario }),
            ...(dto.codigo_externo !== undefined && {
              codigo_externo: dto.codigo_externo,
            }),
            ...(dto.sexo !== undefined && { sexo: dto.sexo }),
            ...(dto.estado_civil !== undefined && {
              estado_civil: dto.estado_civil,
            }),
            ...(dto.data_nascimento !== undefined && {
              data_nascimento: dto.data_nascimento
                ? new Date(dto.data_nascimento)
                : null,
            }),
            ...(dto.peso !== undefined && {
              peso: dto.peso != null ? BigInt(dto.peso) : null,
            }),
            ...(dto.altura !== undefined && {
              altura: dto.altura != null ? BigInt(dto.altura) : null,
            }),
            ...(dto.diabetico !== undefined && { diabetico: dto.diabetico }),
            ...(dto.falecido !== undefined && { falecido: dto.falecido }),
            ...(dto.receber_mensagem !== undefined && {
              receber_mensagem: dto.receber_mensagem,
            }),
            ...(dto.bloqueado !== undefined && { bloqueado: dto.bloqueado }),
            ...(dto.cep !== undefined && { cep: dto.cep }),
            ...(dto.logradouro !== undefined && { logradouro: dto.logradouro }),
            ...(dto.numero !== undefined && { numero: dto.numero }),
            ...(dto.complemento !== undefined && {
              complemento: dto.complemento,
            }),
            ...(dto.bairro !== undefined && { bairro: dto.bairro }),
            ...(dto.cidade !== undefined && { cidade: dto.cidade }),
            ...(dto.estado !== undefined && { estado: dto.estado }),
            ...(dto.endereco_referencia !== undefined && {
              endereco_referencia: dto.endereco_referencia,
            }),
            ...(dto.telefone !== undefined && { telefone: dto.telefone }),
            ...(dto.celular !== undefined && { celular: dto.celular }),
            ...(dto.email !== undefined && { email: dto.email }),
            ...(dto.senha_internet !== undefined && {
              senha_internet: dto.senha_internet,
            }),
            ...(dto.observacao_resultado !== undefined && {
              observacao_resultado: dto.observacao_resultado,
            }),
          },
        });

        return { id };
      });
    });
  }

  // [NEGÓCIO] Exclui cliente após verificar ownership de tenant.
  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        // [SEGURANÇA] Verifica ownership antes de qualquer mutação.
        const existente = await tx.infolab_cliente.findUnique({
          where: { id_cliente: BigInt(id) },
          select: { id_tenacidade: true },
        });

        if (
          !existente ||
          existente.id_tenacidade !== tenantContexto.idTenacidade
        ) {
          throw new NotFoundException(`Cliente ${id} não encontrado.`);
        }

        try {
          await tx.infolab_cliente.delete({
            where: { id_cliente: BigInt(id) },
          });
        } catch (e: unknown) {
          if (ClienteService.eErroExclusaoPorReferencia(e)) {
            throw new ConflictException(
              'Não é possível excluir este cliente: existem atendimentos (ou outros registros) vinculados a ele. Ajuste ou remova essas referências antes de excluir.',
            );
          }
          throw e;
        }

        return { ok: true };
      });
    });
  }

  // Formata CPF para exibição: 000.000.000-00
  private formatarCpf(cpf: string | null): string {
    if (!cpf) return '';
    const d = cpf.replace(/\D/g, '');
    if (d.length !== 11) return cpf;
    return `${d.slice(0, 3)}.${d.slice(3, 6)}.${d.slice(6, 9)}-${d.slice(9)}`;
  }

  // Formata telefone para exibição: (00) 00000-0000 ou (00) 0000-0000
  private formatarTelefone(tel: string | null): string {
    if (!tel) return '';
    const d = tel.replace(/\D/g, '');
    if (d.length === 11)
      return `(${d.slice(0, 2)}) ${d.slice(2, 7)}-${d.slice(7)}`;
    if (d.length === 10)
      return `(${d.slice(0, 2)}) ${d.slice(2, 6)}-${d.slice(6)}`;
    return tel;
  }

  // [NEGÓCIO] Mapeia registro do banco para RespostaClienteDto.
  // NUNCA inclui senha_internet no output (Requisito 6.3).
  private mapearParaRespostaDto(cliente: infolab_cliente): RespostaClienteDto {
    return {
      id: cliente.id_cliente.toString(),
      id_tenacidade: cliente.id_tenacidade?.toString() ?? null,
      nome: cliente.nome ?? null,
      nome_social: cliente.nome_social ?? null,
      cpf: this.formatarCpf(cliente.cpf),
      documento: cliente.documento ?? null,
      codigo_passaporte: cliente.codigo_passaporte ?? null,
      prontuario: cliente.prontuario ?? null,
      codigo_externo: cliente.codigo_externo ?? null,
      sexo: cliente.sexo ?? null,
      estado_civil: cliente.estado_civil ?? null,
      data_nascimento: cliente.data_nascimento
        ? cliente.data_nascimento.toISOString().slice(0, 10)
        : null,
      peso: cliente.peso != null ? cliente.peso.toString() : null,
      altura: cliente.altura != null ? cliente.altura.toString() : null,
      diabetico: cliente.diabetico ?? null,
      falecido: cliente.falecido ?? null,
      receber_mensagem: cliente.receber_mensagem ?? null,
      bloqueado: cliente.bloqueado ?? null,
      cep: cliente.cep ?? null,
      logradouro: cliente.logradouro ?? null,
      numero: cliente.numero ?? null,
      complemento: cliente.complemento ?? null,
      bairro: cliente.bairro ?? null,
      cidade: cliente.cidade ?? null,
      estado: cliente.estado ?? null,
      endereco_referencia: cliente.endereco_referencia ?? null,
      telefone: this.formatarTelefone(cliente.telefone),
      celular: this.formatarTelefone(cliente.celular),
      email: cliente.email ?? null,
      // senha_internet OMITIDA intencionalmente — Requisito 6.3
      observacao_resultado: cliente.observacao_resultado ?? null,
      data_inclusao: cliente.data_inclusao
        ? cliente.data_inclusao.toISOString().slice(0, 19).replace('T', ' ')
        : null,
      id_usuario_auditoria: cliente.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: cliente.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: cliente.nome_aplicacao_auditoria ?? null,
    };
  }

  private sexoRotulo(s: string | null | undefined): string | null {
    if (s == null || s === '') return null;
    const x = s.trim().toUpperCase();
    if (x === 'M') return 'Masculino';
    if (x === 'F') return 'Feminino';
    if (x === 'O') return 'Outro';
    if (x === 'N') return 'Não informado';
    return s.trim();
  }

  // [NEGÓCIO] Mapeia registro do banco para RespostaListagemClienteDto (campos resumidos).
  private mapearParaListagemDto(
    cliente: infolab_cliente,
  ): RespostaListagemClienteDto {
    const telefoneBruto = cliente.telefone ?? cliente.celular ?? '';
    return {
      id: cliente.id_cliente.toString(),
      nome: cliente.nome ?? null,
      nome_social: cliente.nome_social ?? null,
      cpf: this.formatarCpf(cliente.cpf),
      documento: cliente.documento ?? null,
      email: cliente.email ?? null,
      telefone: this.formatarTelefone(telefoneBruto),
      sexo: this.sexoRotulo(cliente.sexo),
      data_nascimento:
        cliente.data_nascimento != null
          ? cliente.data_nascimento.toISOString().slice(0, 10)
          : null,
      bairro: cliente.bairro ?? null,
      cidade: cliente.cidade ?? null,
      data_inclusao:
        cliente.data_inclusao != null
          ? cliente.data_inclusao.toISOString()
          : null,
      status: cliente.bloqueado === 'S' ? 'Inativo' : 'Ativo',
    };
  }
}
