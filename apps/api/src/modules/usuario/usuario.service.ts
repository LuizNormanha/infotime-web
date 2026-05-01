import bcrypt from "bcryptjs";
import type { JwtPayload } from "@infotime/shared-types";
import type { ListQuery } from "@infotime/shared-types";
import { parseTenantId } from "../../shared/tenancy/tenantContext.js";
import { auditAppFields } from "../../shared/audit/auditMiddleware.js";
import { AppError } from "../../shared/errors/AppError.js";
import { usuarioRepository } from "./usuario.repository.js";
import type { FastifyRequest } from "fastify";
import type { Prisma } from "@infotime/database";

export const usuarioService = {
  async list(auth: JwtPayload, q: ListQuery) {
    const tenantId = parseTenantId(auth);
    const { data, total } = await usuarioRepository.findMany(tenantId, q);
    return {
      data,
      total,
      page: q.page,
      pageSize: q.pageSize,
    };
  },

  async getById(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const row = await usuarioRepository.findFirst(tenantId, id);
    if (!row) throw new AppError(404, "NOT_FOUND", "Usuário não encontrado");
    return row;
  },

  async create(
    request: FastifyRequest,
    auth: JwtPayload,
    body: {
      nome: string;
      login: string;
      senha: string;
      email?: string | null;
      ativo: string;
      administrador: string;
    },
  ) {
    const tenantId = parseTenantId(auth);
    const hash = await bcrypt.hash(body.senha, 10);
    const audit = auditAppFields(request);
    const data: Omit<Prisma.UsuarioUncheckedCreateInput, "idTenacidade"> = {
      nome: body.nome,
      login: body.login,
      senha: hash,
      email: body.email ?? undefined,
      ativo: body.ativo,
      administrador: body.administrador,
      ...audit,
    };
    return usuarioRepository.create(tenantId, data, {
      idUsuarioAuditoria: BigInt(auth.idUsuario),
    });
  },

  async update(
    request: FastifyRequest,
    auth: JwtPayload,
    id: bigint,
    body: Partial<{
      nome: string;
      login: string;
      senha: string;
      email: string | null;
      ativo: string;
      administrador: string;
    }>,
  ) {
    const tenantId = parseTenantId(auth);
    const existing = await usuarioRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Usuário não encontrado");

    const audit = auditAppFields(request);
    const data: Prisma.UsuarioUpdateInput = {
      nome: body.nome,
      login: body.login,
      email: body.email,
      ativo: body.ativo,
      administrador: body.administrador,
      ...audit,
      idUsuarioAuditoria: BigInt(auth.idUsuario),
    };
    if (body.senha) {
      data.senha = await bcrypt.hash(body.senha, 10);
    }
    const updated = await usuarioRepository.update(tenantId, id, data, {
      idUsuarioAuditoria: BigInt(auth.idUsuario),
    });
    if (!updated) throw new AppError(404, "NOT_FOUND", "Usuário não encontrado");
    return updated;
  },

  async remove(auth: JwtPayload, id: bigint) {
    const tenantId = parseTenantId(auth);
    const existing = await usuarioRepository.findFirst(tenantId, id);
    if (!existing) throw new AppError(404, "NOT_FOUND", "Usuário não encontrado");
    await usuarioRepository.delete(tenantId, id);
  },
};
