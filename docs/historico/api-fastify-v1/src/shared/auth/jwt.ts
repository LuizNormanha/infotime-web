import type { JwtPayload } from "@infotime/shared-types";

export function buildPayload(input: {
  idUsuario: bigint;
  idTenacidade: bigint;
  administrador: boolean;
}): JwtPayload {
  return {
    sub: String(input.idUsuario),
    idUsuario: String(input.idUsuario),
    idTenacidade: String(input.idTenacidade),
    administrador: input.administrador,
  };
}
