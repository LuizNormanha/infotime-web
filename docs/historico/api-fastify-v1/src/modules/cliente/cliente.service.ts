import type { JwtPayload } from "@infotime/shared-types";
import type { ListQuery } from "@infotime/shared-types";
import { parseTenantId } from "../../shared/tenancy/tenantContext.js";
import { auditAppFields } from "../../shared/audit/auditMiddleware.js";
import { AppError } from "../../shared/errors/AppError.js";
import type { FastifyRequest } from "fastify";
import type { Prisma } from "@infotime/database";
import { clienteRepository } from "./cliente.repository.js";

export const clienteService = {
  async list(auth: JwtPayload, q: ListQuery) {
    const tenantId = parseTenantId(auth);
    const { data, total } = await clienteRepository.findMany(tenantId, q);
    return { data, total, page: q.page, pageSize: q.pageSize };
  },

  async getById(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const row = await clienteRepository.findFirst(tenantId, id);
    if (!row) throw new AppError(404, "NOT_FOUND", "Cliente não encontrado");
    return row;
  },

  async create(request: FastifyRequest, auth: JwtPayload, body: Record<string, unknown>) {
    const tenantId = parseTenantId(auth);
    const audit = auditAppFields(request);
    const data: Omit<Prisma.ClienteUncheckedCreateInput, "idTenacidade"> = {
      ...(body as Omit<Prisma.ClienteUncheckedCreateInput, "idTenacidade" | "idUsuarioAuditoria">),
      idUsuarioAuditoria: BigInt(auth.idUsuario),
      ...audit,
    };
    return clienteRepository.create(tenantId, data);
  },

  async update(
    request: FastifyRequest,
    auth: JwtPayload,
    id: bigint,
    body: Record<string, unknown>,
  ) {
    void request;
    const tenantId = parseTenantId(auth);
    const existing = await clienteRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Cliente não encontrado");
    const data: Prisma.ClienteUpdateInput = {
      ...(body as Prisma.ClienteUpdateInput),
      idUsuarioAuditoria: BigInt(auth.idUsuario),
    };
    return clienteRepository.update(tenantId, id, data);
  },

  async remove(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const existing = await clienteRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Cliente não encontrado");
    await clienteRepository.delete(tenantId, id);
  },
};
