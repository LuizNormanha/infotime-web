import {
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
import { setCurrentTenantLocal } from '../prisma/set-current-tenant-local';
import { executarComRlsJaAplicadoNaTransacao } from '../prisma/tenant-rls.storage';
import { AtualizarMedicoDto } from './dto/atualizar-medico.dto';
import { CriarMedicoDto } from './dto/criar-medico.dto';

function bi(id: string | undefined): bigint | null {
  const t = id?.trim();
  if (!t) return null;
  return BigInt(t);
}

function ativoChar(v: boolean | undefined): string {
  if (v === undefined) return 'S';
  return v ? 'S' : 'N';
}

@Injectable()
export class MedicoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'nome',
    'cpf',
    'email',
    'telefone',
    'id',
    'ativo',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaMedico(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_medicoWhereInput {
    const q = qTexto.trim();
    if (campoPesquisa === 'nome') {
      return { nome: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'email') {
      return { email: { contains: q, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'telefone') {
      const digitos = q.replace(/\D/g, '');
      if (!digitos) return {};
      return { telefone: { contains: digitos, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'cpf') {
      const digitos = q.replace(/\D/g, '');
      if (!digitos) return {};
      return { cpf: { contains: digitos, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_medico: BigInt(q) };
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

  private whereFiltroRefinadoMedico(
    jsonBruto: string | undefined,
  ): Prisma.infolab_medicoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome', 'ativo']);
    const partes: Prisma.infolab_medicoWhereInput[] = [];

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

      if (campo === 'nome' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({ nome: { contains: contem, mode: 'insensitive' } });
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
  ): Promise<{ dados: Record<string, unknown>[]; total: number }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
        const baseWhere: Prisma.infolab_medicoWhereInput = {
          id_tenacidade: tenantContexto.idTenacidade,
        };

        const select = {
          id_medico: true,
          nome: true,
          cpf: true,
          email: true,
          telefone: true,
          ativo: true,
        };

        return executarListagemCrudCatalogo({
          query,
          todos,
          takeLegadoSemTodos: 50,
          delegate: tx.infolab_medico,
          baseWhere,
          camposPesquisaWhitelist: MedicoService.CAMPOS_PESQUISA,
          montarWhereCampoPesquisa: (campo, q) =>
            this.whereCampoPesquisaMedico(campo, q),
          montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoMedico(j),
          orderBy: { id_medico: 'desc' },
          skipTakeSelect: { skip: 0, take: 10, select },
          mapRow: (row: unknown) => {
            const r = row as {
              id_medico: bigint;
              nome: string | null;
              cpf: string | null;
              email: string | null;
              telefone: string | null;
              ativo: string | null;
            };
            return {
              id: r.id_medico.toString(),
              nome: r.nome ?? '',
              cpf: r.cpf ?? '',
              email: r.email ?? '',
              telefone: r.telefone ?? '',
              ativo: r.ativo ?? '',
            };
          },
          findManyLegado: ({ where, orderBy, select: sel, take }) =>
            tx.infolab_medico.findMany({
              where: where as Prisma.infolab_medicoWhereInput,
              orderBy,
              select: sel as typeof select,
              ...(take != null ? { take } : {}),
            }),
        });
      });
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: Record<string, unknown> }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
      const registro = await tx.infolab_medico.findUnique({
        where: { id_medico: BigInt(id) },
      });

      if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
        throw new NotFoundException(`Médico ${id} não encontrado.`);
      }

      return { dados: this.mapearParaFormulario(registro) };
      });
    });
  }

  async criar(
    dto: CriarMedicoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
      const criado = await tx.infolab_medico.create({
        data: {
          id_tenacidade: tenantContexto.idTenacidade,
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: ip.slice(0, 20),
          nome_aplicacao_auditoria: 'infotime-web',
          nome: dto.nome,
          cpf: dto.cpf ?? null,
          sexo: dto.sexo ?? null,
          codigo_externo: dto.codigo_externo ?? null,
          id_especialidade_medica: bi(dto.id_especialidade_medica),
          id_conselho_regional: bi(dto.id_conselho_regional),
          id_medico_credencial_convenio: bi(dto.id_medico_credencial_convenio),
          estado_conselho: dto.estado_conselho ?? null,
          numero_conselho: dto.numero_conselho ?? null,
          numero_cns: dto.numero_cns ?? null,
          registro_unimed: dto.registro_unimed ?? null,
          telefone: dto.telefone ?? null,
          celular: dto.celular ?? null,
          email: dto.email ?? null,
          senha_internet: dto.senha_internet ?? null,
          lista_convenio_suspenso: dto.lista_convenio_suspenso ?? null,
          ativo: ativoChar(dto.ativo),
        },
        select: { id_medico: true },
      });

      return { id: criado.id_medico.toString() };
      });
    });
  }

  async atualizar(
    id: string,
    dto: AtualizarMedicoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
      const existente = await tx.infolab_medico.findUnique({
        where: { id_medico: BigInt(id) },
      });

      if (
        !existente ||
        existente.id_tenacidade !== tenantContexto.idTenacidade
      ) {
        throw new NotFoundException(`Médico ${id} não encontrado.`);
      }

      const data: Prisma.infolab_medicoUncheckedUpdateInput = {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
      };

      if (dto.nome !== undefined) data.nome = dto.nome;
      if (dto.cpf !== undefined) data.cpf = dto.cpf ?? null;
      if (dto.sexo !== undefined) data.sexo = dto.sexo ?? null;
      if (dto.codigo_externo !== undefined)
        data.codigo_externo = dto.codigo_externo ?? null;
      if (dto.id_especialidade_medica !== undefined) {
        data.id_especialidade_medica = dto.id_especialidade_medica
          ? bi(dto.id_especialidade_medica)
          : null;
      }
      if (dto.id_conselho_regional !== undefined) {
        data.id_conselho_regional = dto.id_conselho_regional
          ? bi(dto.id_conselho_regional)
          : null;
      }
      if (dto.id_medico_credencial_convenio !== undefined) {
        data.id_medico_credencial_convenio = dto.id_medico_credencial_convenio
          ? bi(dto.id_medico_credencial_convenio)
          : null;
      }
      if (dto.estado_conselho !== undefined)
        data.estado_conselho = dto.estado_conselho ?? null;
      if (dto.numero_conselho !== undefined)
        data.numero_conselho = dto.numero_conselho ?? null;
      if (dto.numero_cns !== undefined)
        data.numero_cns = dto.numero_cns ?? null;
      if (dto.registro_unimed !== undefined)
        data.registro_unimed = dto.registro_unimed ?? null;
      if (dto.telefone !== undefined) data.telefone = dto.telefone ?? null;
      if (dto.celular !== undefined) data.celular = dto.celular ?? null;
      if (dto.email !== undefined) data.email = dto.email ?? null;
      if (dto.senha_internet !== undefined)
        data.senha_internet = dto.senha_internet ?? null;
      if (dto.lista_convenio_suspenso !== undefined)
        data.lista_convenio_suspenso = dto.lista_convenio_suspenso ?? null;
      if (dto.ativo !== undefined) data.ativo = ativoChar(dto.ativo);

      await tx.infolab_medico.update({
        where: { id_medico: BigInt(id) },
        data,
      });

      return { id };
      });
    });
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    return this.prisma.$transaction(async (tx) => {
      await setCurrentTenantLocal(tx, tenantContexto.idTenacidade);
      return executarComRlsJaAplicadoNaTransacao(async () => {
      const existente = await tx.infolab_medico.findUnique({
        where: { id_medico: BigInt(id) },
      });

      if (
        !existente ||
        existente.id_tenacidade !== tenantContexto.idTenacidade
      ) {
        throw new NotFoundException(`Médico ${id} não encontrado.`);
      }

      try {
        await tx.infolab_medico.delete({
          where: { id_medico: BigInt(id) },
        });
      } catch (e: unknown) {
        if (
          e instanceof Prisma.PrismaClientKnownRequestError &&
          e.code === 'P2003'
        ) {
          throw new ConflictException(
            'Não é possível excluir: existem registros vinculados a este médico.',
          );
        }
        throw e;
      }

      return { ok: true };
      });
    });
  }

  private mapearParaFormulario(registro: {
    id_medico: bigint;
    id_tenacidade: bigint;
    id_especialidade_medica: bigint | null;
    id_conselho_regional: bigint | null;
    id_medico_credencial_convenio: bigint | null;
    id_usuario_auditoria: bigint | null;
    nome: string | null;
    cpf: string | null;
    estado_conselho: string | null;
    numero_conselho: number | null;
    numero_cns: string | null;
    registro_unimed: string | null;
    sexo: string | null;
    telefone: string | null;
    celular: string | null;
    email: string | null;
    senha_internet: string | null;
    lista_convenio_suspenso: string | null;
    ativo: string | null;
    codigo_externo: string | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): Record<string, unknown> {
    return {
      id: registro.id_medico.toString(),
      nome: registro.nome ?? '',
      cpf: registro.cpf ?? '',
      sexo: registro.sexo ?? '',
      codigo_externo: registro.codigo_externo ?? '',
      id_especialidade_medica:
        registro.id_especialidade_medica?.toString() ?? '',
      id_conselho_regional: registro.id_conselho_regional?.toString() ?? '',
      id_medico_credencial_convenio:
        registro.id_medico_credencial_convenio?.toString() ?? '',
      estado_conselho: registro.estado_conselho ?? '',
      numero_conselho:
        registro.numero_conselho != null
          ? String(registro.numero_conselho)
          : '',
      numero_cns: registro.numero_cns ?? '',
      registro_unimed: registro.registro_unimed ?? '',
      telefone: registro.telefone ?? '',
      celular: registro.celular ?? '',
      email: registro.email ?? '',
      senha_internet: registro.senha_internet ?? '',
      lista_convenio_suspenso: registro.lista_convenio_suspenso ?? '',
      ativo: registro.ativo === 'S',
      id_tenacidade: registro.id_tenacidade.toString(),
      id_usuario_auditoria_texto:
        registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
