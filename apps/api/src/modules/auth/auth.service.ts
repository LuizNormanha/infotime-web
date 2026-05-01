import { createHash } from "node:crypto";
import bcrypt from "bcryptjs";
import { prisma } from "@infotime/database";
import { AppError } from "../../shared/errors/AppError.js";
import { buildPayload } from "../../shared/auth/jwt.js";

function md5(s: string): string {
  return createHash("md5").update(s).digest("hex");
}

async function verifyAndMaybeUpgradePassword(
  plain: string,
  stored: string | null | undefined,
  idUsuario: bigint,
): Promise<void> {
  if (!stored) {
    throw new AppError(401, "INVALID_CREDENTIALS", "Credenciais inválidas");
  }

  const looksMd5 = /^[a-f0-9]{32}$/i.test(stored);
  if (looksMd5) {
    if (md5(plain) !== stored.toLowerCase()) {
      throw new AppError(401, "INVALID_CREDENTIALS", "Credenciais inválidas");
    }
    const newHash = await bcrypt.hash(plain, 10);
    await prisma.usuario.update({
      where: { idUsuario },
      data: { senha: newHash },
    });
    return;
  }

  const ok = await bcrypt.compare(plain, stored);
  if (!ok) {
    throw new AppError(401, "INVALID_CREDENTIALS", "Credenciais inválidas");
  }
}

export const authService = {
  async login(input: { login: string; senha: string; idTenacidade: bigint }) {
    const user = await prisma.usuario.findFirst({
      where: {
        login: input.login,
        idTenacidade: input.idTenacidade,
      },
    });

    if (!user) {
      throw new AppError(401, "INVALID_CREDENTIALS", "Credenciais inválidas");
    }

    if (user.ativo && user.ativo.toLowerCase() !== "sim") {
      throw new AppError(403, "USER_INACTIVE", "Usuário inativo");
    }

    await verifyAndMaybeUpgradePassword(input.senha, user.senha, user.idUsuario);

    const administrador = (user.administrador ?? "").toLowerCase() === "sim";

    return {
      tokenPayload: buildPayload({
        idUsuario: user.idUsuario,
        idTenacidade: user.idTenacidade ?? input.idTenacidade,
        administrador,
      }),
      usuario: user,
    };
  },
};
