import type { JwtPayload } from "@infotime/shared-types";
import type { ListQuery } from "@infotime/shared-types";
import { parseTenantId } from "../../shared/tenancy/tenantContext.js";
import { auditAppFields } from "../../shared/audit/auditMiddleware.js";
import { AppError } from "../../shared/errors/AppError.js";
import type { FastifyRequest } from "fastify";
import type { Prisma } from "@infotime/database";
import { grupoUsuarioRepository } from "./grupo-usuario.repository.js";

export const grupoUsuarioService = {
  async list(auth: JwtPayload, q: ListQuery) {
    const tenantId = parseTenantId(auth);
    const { data, total } = await grupoUsuarioRepository.findMany(tenantId, q);
    return { data, total, page: q.page, pageSize: q.pageSize };
  },

  async getById(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const row = await grupoUsuarioRepository.findFirst(tenantId, id);
    if (!row) throw new AppError(404, "NOT_FOUND", "Grupo não encontrado");
    return row;
  },

  async create(request: FastifyRequest, auth: JwtPayload, body: { descricao: string }) {
    const tenantId = parseTenantId(auth);
    const audit = auditAppFields(request);
    const data: Omit<Prisma.GrupoUsuarioUncheckedCreateInput, "idTenacidade"> = {
      descricao: body.descricao,
      idUsuarioAuditoria: BigInt(auth.idUsuario),
      ...audit,
    };
    return grupoUsuarioRepository.create(tenantId, data);
  },

  async update(
    request: FastifyRequest,
    auth: JwtPayload,
    id: bigint,
    body: Partial<{ descricao: string }>,
  ) {
    void request;
    const tenantId = parseTenantId(auth);
    const existing = await grupoUsuarioRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Grupo não encontrado");
    const data: Prisma.GrupoUsuarioUpdateInput = {
      ...body,
      idUsuarioAuditoria: BigInt(auth.idUsuario),
    };
    return grupoUsuarioRepository.update(tenantId, id, data);
  },

  async remove(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const existing = await grupoUsuarioRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Grupo não encontrado");
    await grupoUsuarioRepository.delete(tenantId, id);
  },
};
