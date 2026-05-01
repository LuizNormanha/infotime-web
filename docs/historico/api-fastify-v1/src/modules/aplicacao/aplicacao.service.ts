import type { JwtPayload } from "@infotime/shared-types";
import type { ListQuery } from "@infotime/shared-types";
import { parseTenantId } from "../../shared/tenancy/tenantContext.js";
import { auditAppFields } from "../../shared/audit/auditMiddleware.js";
import { AppError } from "../../shared/errors/AppError.js";
import type { FastifyRequest } from "fastify";
import type { Prisma } from "@infotime/database";
import { aplicacaoRepository } from "./aplicacao.repository.js";

export const aplicacaoService = {
  async list(auth: JwtPayload, q: ListQuery) {
    const tenantId = parseTenantId(auth);
    const { data, total } = await aplicacaoRepository.findMany(tenantId, q);
    return { data, total, page: q.page, pageSize: q.pageSize };
  },

  async getById(auth: JwtPayload, id: bigint) {
    void auth;
    const row = await aplicacaoRepository.findById(id);
    if (!row) throw new AppError(404, "NOT_FOUND", "Aplicação não encontrada");
    return row;
  },

  async create(request: FastifyRequest, auth: JwtPayload, body: zInput) {
    void auth;
    const audit = auditAppFields(request);
    const data: Prisma.AplicacaoCreateInput = {
      nome: body.nome,
      tipo: body.tipo ?? undefined,
      descricao: body.descricao ?? undefined,
      ...audit,
    };
    return aplicacaoRepository.create(data);
  },

  async update(request: FastifyRequest, auth: JwtPayload, id: bigint, body: Partial<zInput>) {
    void request;
    void auth;
    const existing = await aplicacaoRepository.findById(id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Aplicação não encontrada");
    const data: Prisma.AplicacaoUpdateInput = { ...body };
    return aplicacaoRepository.update(id, data);
  },

  async remove(_auth: JwtPayload, id: bigint) {
    const existing = await aplicacaoRepository.findById(id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Aplicação não encontrada");
    await aplicacaoRepository.delete(id);
  },
};

type zInput = {
  nome: string;
  tipo?: string | null;
  descricao?: string | null;
};
