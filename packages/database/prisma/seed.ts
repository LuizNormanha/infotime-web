/**
 * Dados mínimos de demonstração (tenant 1, admin, grupo, aplicação, clientes).
 * Requer schema/tabelas criados (`pnpm db:push` ou migrações) e DATABASE_URL válida.
 *
 * Executar na raiz: `pnpm db:seed`
 */
import { PrismaClient } from "../src/generated/prisma/index.js";
import { createHash } from "node:crypto";

const prisma = new PrismaClient();

const TENANT_ID = BigInt(1);
const USER_ADMIN_ID = BigInt(1);
const GRUPO_ID = BigInt(1);
const APP_ID = BigInt(1);
const UG_ID = BigInt(1);
const GA_ID = BigInt(1);
const CLIENTE_1 = BigInt(1);
const CLIENTE_2 = BigInt(2);

function md5(s: string): string {
  return createHash("md5").update(s).digest("hex");
}

async function main() {
  await prisma.$transaction(async (tx) => {
    const tenant = await tx.tenacidade.upsert({
      where: { idTenacidade: TENANT_ID },
      update: {
        razaoSocial: "Tenacidade Demo",
        nomeFantasia: "Infotime Demo",
        ativo: "S",
      },
      create: {
        idTenacidade: TENANT_ID,
        razaoSocial: "Tenacidade Demo",
        nomeFantasia: "Infotime Demo",
        ativo: "S",
      },
    });

    const senhaDemo = md5("admin123");

    await tx.usuario.upsert({
      where: { idUsuario: USER_ADMIN_ID },
      update: {
        idTenacidade: tenant.idTenacidade,
        senha: senhaDemo,
        ativo: "sim",
        administrador: "sim",
        login: "admin",
      },
      create: {
        idUsuario: USER_ADMIN_ID,
        idTenacidade: tenant.idTenacidade,
        nome: "Administrador",
        login: "admin",
        senha: senhaDemo,
        email: "admin@example.com",
        ativo: "sim",
        administrador: "sim",
      },
    });

    const grupo = await tx.grupoUsuario.upsert({
      where: { idGrupoUsuario: GRUPO_ID },
      update: {
        idTenacidade: tenant.idTenacidade,
        descricao: "Administradores",
      },
      create: {
        idGrupoUsuario: GRUPO_ID,
        idTenacidade: tenant.idTenacidade,
        descricao: "Administradores",
      },
    });

    await tx.usuarioGrupoUsuario.upsert({
      where: { idUsuarioGrupoUsuario: UG_ID },
      update: {
        idTenacidade: tenant.idTenacidade,
        idUsuario: USER_ADMIN_ID,
        idGrupoUsuario: grupo.idGrupoUsuario,
      },
      create: {
        idUsuarioGrupoUsuario: UG_ID,
        idTenacidade: tenant.idTenacidade,
        idUsuario: USER_ADMIN_ID,
        idGrupoUsuario: grupo.idGrupoUsuario,
      },
    });

    const app = await tx.aplicacao.upsert({
      where: { idAplicacao: APP_ID },
      update: {
        nome: "Usuários",
        tipo: "menu",
        descricao: "Cadastro de usuários",
      },
      create: {
        idAplicacao: APP_ID,
        nome: "Usuários",
        tipo: "menu",
        descricao: "Cadastro de usuários",
      },
    });

    await tx.grupoUsuarioAplicacao.upsert({
      where: { idGrupoUsuarioAplicacao: GA_ID },
      update: {
        idTenacidade: tenant.idTenacidade,
        idGrupoUsuario: grupo.idGrupoUsuario,
        idAplicacao: app.idAplicacao,
        consulta: "sim",
        inclusao: "sim",
        exclusao: "sim",
        alteracao: "sim",
        exportacao: "sim",
        impressao: "sim",
      },
      create: {
        idGrupoUsuarioAplicacao: GA_ID,
        idTenacidade: tenant.idTenacidade,
        idGrupoUsuario: grupo.idGrupoUsuario,
        idAplicacao: app.idAplicacao,
        consulta: "sim",
        inclusao: "sim",
        exclusao: "sim",
        alteracao: "sim",
        exportacao: "sim",
        impressao: "sim",
      },
    });

    await tx.cliente.upsert({
      where: { idCliente: CLIENTE_1 },
      update: {
        idTenacidade: tenant.idTenacidade,
        razaoSocial: "Cliente Alpha LTDA",
        nomeFantasia: "Alpha",
        cnpj: "11222333000181",
        email: "alpha@example.com",
      },
      create: {
        idCliente: CLIENTE_1,
        idTenacidade: tenant.idTenacidade,
        idUsuarioAuditoria: USER_ADMIN_ID,
        tipoPessoa: "J",
        razaoSocial: "Cliente Alpha LTDA",
        nomeFantasia: "Alpha",
        cnpj: "11222333000181",
        email: "alpha@example.com",
        cidade: "São Paulo",
        estado: "SP",
      },
    });

    await tx.cliente.upsert({
      where: { idCliente: CLIENTE_2 },
      update: {
        idTenacidade: tenant.idTenacidade,
        razaoSocial: "Cliente Beta ME",
        nomeFantasia: "Beta",
        cnpj: "99888777000162",
        email: "beta@example.com",
      },
      create: {
        idCliente: CLIENTE_2,
        idTenacidade: tenant.idTenacidade,
        idUsuarioAuditoria: USER_ADMIN_ID,
        tipoPessoa: "J",
        razaoSocial: "Cliente Beta ME",
        nomeFantasia: "Beta",
        cnpj: "99888777000162",
        email: "beta@example.com",
        cidade: "Curitiba",
        estado: "PR",
      },
    });
  });

  console.log("");
  console.log("Seed concluído (base liga_infotime, schema public):");
  console.log("  • id_tenacidade = 1  |  Tenacidade Demo");
  console.log("  • Login: admin  |  Senha: admin123  (MD5 legado, compatível com a API)");
  console.log("  • id_usuario = 1  |  administrador = sim");
  console.log("  • 2 clientes de exemplo (ids 1 e 2)");
  console.log("");
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
