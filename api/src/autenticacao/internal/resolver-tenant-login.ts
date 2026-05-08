import {
  BadRequestException,
  HttpException,
  HttpStatus,
  InternalServerErrorException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { PrismaService } from '../../prisma/prisma.service';

type LinhaTenant = {
  id_tenacidade: bigint;
  chave_jwt: string | null;
  timeout_sessao_minutos: number | null;
  quantidade_licenca: number | null;
  data_expiracao: Date | null;
};

export type TenantLoginAtivo = {
  id_tenacidade: bigint;
  chave_jwt: string | null;
  data_expiracao: Date | null;
  infolab_tenacidade_configuracao: {
    timeout_sessao_minutos: number | null;
    quantidade_licenca: number | null;
  }[];
};

function tratarErroPermissaoLoginTenant(e: unknown): void {
  if (e instanceof Prisma.PrismaClientKnownRequestError && e.code === 'P2010') {
    const meta = e.meta as { code?: string; message?: string } | undefined;
    if (meta?.code === '42501') {
      throw new InternalServerErrorException(
        'Não foi possível validar o domínio de login no momento. Tente novamente em instantes.',
      );
    }
  }
}

function eAusenciaFuncaoTenantDominio(e: unknown): boolean {
  if (e instanceof Prisma.PrismaClientKnownRequestError && e.code === 'P2010') {
    const meta = e.meta as { code?: string; message?: string } | undefined;
    if (meta?.code === '42883') return true;
    const msg = meta?.message ?? '';
    return (
      msg.includes('42883') &&
      (msg.includes('infotime_tenant_ativo_por_dominio') ||
        msg.includes('infolab_tenant_ativo_por_dominio'))
    );
  }
  if (e instanceof Prisma.PrismaClientUnknownRequestError) {
    return (
      e.message.includes('42883') &&
      (e.message.includes('infotime_tenant_ativo_por_dominio') ||
        e.message.includes('infolab_tenant_ativo_por_dominio'))
    );
  }
  return false;
}

async function buscarTenantAtivoPorDominioInfoTIME(
  prisma: PrismaService,
  dominio: string,
): Promise<LinhaTenant[]> {
  return prisma.$queryRaw<LinhaTenant[]>(Prisma.sql`
    SELECT
      t.id_tenacidade,
      t.chave_acesso::text AS chave_jwt,
      480::int AS timeout_sessao_minutos,
      NULL::int AS quantidade_licenca,
      t.data_expiracao
    FROM tenacidade t
    WHERE t.ativo = 'S'
      AND (
        EXISTS (
          SELECT 1
          FROM usuario u
          WHERE u.id_tenacidade = t.id_tenacidade
            AND COALESCE(u.ativo, 'S') = 'S'
            AND u.email IS NOT NULL
            AND length(trim(u.email)) > 0
            AND lower(trim(split_part(trim(u.email), '@', 2))) = lower(trim(${dominio}))
        )
        OR (
          (SELECT count(*)::bigint FROM tenacidade t2 WHERE t2.ativo = 'S') = 1
        )
      )
    ORDER BY t.id_tenacidade
    LIMIT 1`);
}

/**
 * Resolve a tenacidade pelo domínio do e-mail antes de validar senha.
 * Se a função SQL de tenant por domínio não existir, usa fallback InfoTIME ERP.
 */
export async function resolverTenantAtivoPorDominio(
  prisma: PrismaService,
  dominio: string | undefined,
): Promise<TenantLoginAtivo> {
  if (!dominio?.trim()) {
    throw new BadRequestException(
      'Informe um e-mail com domínio válido (ex.: usuario@empresa.com.br).',
    );
  }

  const d = dominio.trim().toLowerCase();
  let rows: LinhaTenant[];

  try {
    rows = await prisma.$queryRaw<LinhaTenant[]>(
      Prisma.sql`SELECT * FROM public.infotime_tenant_ativo_por_dominio(${d})`,
    );
  } catch (e) {
    if (eAusenciaFuncaoTenantDominio(e)) {
      try {
        rows = await buscarTenantAtivoPorDominioInfoTIME(prisma, d);
      } catch (fallbackError) {
        tratarErroPermissaoLoginTenant(fallbackError);
        throw fallbackError;
      }
    } else {
      tratarErroPermissaoLoginTenant(e);
      throw e;
    }
  }

  const row = rows[0];
  if (!row) {
    throw new HttpException(
      {
        mensagem:
          'Domínio não cadastrado ou tenant inativo. Verifique o e-mail ou contate o suporte.',
      },
      HttpStatus.NOT_FOUND,
    );
  }

  return {
    id_tenacidade: row.id_tenacidade,
    chave_jwt: row.chave_jwt,
    data_expiracao: row.data_expiracao,
    infolab_tenacidade_configuracao: [
      {
        timeout_sessao_minutos: row.timeout_sessao_minutos,
        quantidade_licenca: row.quantidade_licenca,
      },
    ],
  };
}
