import 'dotenv/config';
import * as bcrypt from 'bcrypt';
import { Prisma, PrismaClient } from '@prisma/client';

import { FORMULARIOS } from '../src/catalogo/infotime-formulario-catalog';
import { setCurrentTenantLocal } from '../src/prisma/set-current-tenant-local';

const prisma = new PrismaClient();
type DbClient = PrismaClient | Prisma.TransactionClient;

/** Login suporte/implantação valida só a senha do dia; o campo `senha` no BD não é usado nesse fluxo. */
async function garantirUsuarioTecnicoGlobal(
  db: DbClient,
  login: string,
  nome: string,
  hashPlaceholder: string,
) {
  const existente = await db.infolab_usuario.findFirst({
    where: { login, id_tenacidade: null },
  });
  if (existente) {
    await db.infolab_usuario.update({
      where: { id_usuario: existente.id_usuario },
      data: {
        nome,
        ativo: 'S',
        id_grupo_usuario: null,
      },
    });
    return;
  }
  await db.infolab_usuario.create({
    data: {
      login,
      nome,
      id_tenacidade: null,
      ativo: 'S',
      senha: hashPlaceholder,
      id_grupo_usuario: null,
    },
  });
}

async function garantirGrupoPerfil(
  db: DbClient,
  idTenacidade: bigint,
  descricao: string,
  idUsuarioAuditoria?: bigint,
) {
  const existente = await db.infolab_grupo_usuario.findFirst({
    where: { id_tenacidade: idTenacidade, descricao },
    select: { id_grupo_usuario: true },
  });
  if (existente) return existente.id_grupo_usuario;
  const criado = await db.infolab_grupo_usuario.create({
    data: {
      id_tenacidade: idTenacidade,
      descricao,
      acessa_auditoria: 'N',
      ...(idUsuarioAuditoria ? { id_usuario_auditoria: idUsuarioAuditoria } : {}),
      nome_aplicacao_auditoria: 'infotime-web',
    },
    select: { id_grupo_usuario: true },
  });
  return criado.id_grupo_usuario;
}

async function main() {
  const tenacidade = await prisma.$transaction(async (tx) => {
    const RAZAO_SOCIAL = 'InfoTIME Sistemas';
    const NOME_FANTASIA = 'InfoTIME';
    const CHAVE_JWT = 'chave-jwt-local-liga-br';

    const existente = await tx.infolab_tenacidade_configuracao.findFirst({
      where: { dominio_tenacidade: 'liga.br' },
      select: { id_tenacidade: true },
    });

    if (existente) {
      await tx.infolab_tenacidade.update({
        where: { id_tenacidade: existente.id_tenacidade },
        data: { ativo: 'S' },
      });
      await tx.infolab_tenacidade_configuracao.update({
        where: { dominio_tenacidade: 'liga.br' },
        data: {
          razao_social: RAZAO_SOCIAL,
          nome_fantasia: NOME_FANTASIA,
          chave_jwt: CHAVE_JWT,
        },
      });
      return { id_tenacidade: existente.id_tenacidade };
    }

    const nova = await tx.infolab_tenacidade.create({
      data: { ativo: 'S' },
      select: { id_tenacidade: true },
    });
    await tx.infolab_tenacidade_configuracao.create({
      data: {
        id_tenacidade: nova.id_tenacidade,
        razao_social: RAZAO_SOCIAL,
        nome_fantasia: NOME_FANTASIA,
        dominio_tenacidade: 'liga.br',
        chave_jwt: CHAVE_JWT,
        timeout_sessao_minutos: 15,
        quantidade_licenca: null,
      },
    });
    return nova;
  });

  console.log(
    `Tenacidade criada: id=${tenacidade.id_tenacidade} dominio=liga.br`,
  );

  for (const f of FORMULARIOS) {
    await prisma.infolab_formulario.upsert({
      where: { codigo: f.codigo },
      update: { descricao: f.descricao, ordem: f.ordem, ativo: true },
      create: {
        id_formulario: f.id,
        codigo: f.codigo,
        descricao: f.descricao,
        ordem: f.ordem,
        ativo: true,
      },
    });
  }
  await prisma.$executeRaw`
    SELECT setval(
      pg_get_serial_sequence('infolab_formulario', 'id_formulario'),
      COALESCE((SELECT MAX(id_formulario) FROM infolab_formulario), 1)
    )
  `;
  console.log(
    `infolab_formulario: ${FORMULARIOS.length} entradas (upsert, ids fixos no create).`,
  );

  await prisma.$transaction(async (tx) => {
    await setCurrentTenantLocal(tx, tenacidade.id_tenacidade);

    const grupoAdminExistente = await tx.infolab_grupo_usuario.findFirst({
      where: {
        id_tenacidade: tenacidade.id_tenacidade,
        descricao: 'Perfil técnico administrativo',
      },
      select: { id_grupo_usuario: true },
    });
    const grupoAdminTecnico = grupoAdminExistente
      ? await tx.infolab_grupo_usuario.update({
          where: { id_grupo_usuario: grupoAdminExistente.id_grupo_usuario },
          data: {
            acessa_auditoria: 'S',
            nome_aplicacao_auditoria: 'infotime-web',
          },
          select: { id_grupo_usuario: true },
        })
      : await tx.infolab_grupo_usuario.create({
          data: {
            id_tenacidade: tenacidade.id_tenacidade,
            descricao: 'Perfil técnico administrativo',
            acessa_auditoria: 'S',
            nome_aplicacao_auditoria: 'infotime-web',
          },
          select: { id_grupo_usuario: true },
        });

    const grupoModeloAdmin = await garantirGrupoPerfil(
      tx,
      tenacidade.id_tenacidade,
      'Modelo LIGA - Administrador',
    );
    const grupoModeloAtendente = await garantirGrupoPerfil(
      tx,
      tenacidade.id_tenacidade,
      'Modelo LIGA - Atendente',
    );
    const grupoModeloColetor = await garantirGrupoPerfil(
      tx,
      tenacidade.id_tenacidade,
      'Modelo LIGA - Coletor',
    );
    const formularioMenu = await tx.infolab_formulario.findUnique({
      where: { codigo: 'menu' },
      select: { id_formulario: true },
    });
    if (formularioMenu) {
      await tx.infolab_usuario_permissoes.upsert({
        where: {
          id_grupo_usuario_id_formulario: {
            id_grupo_usuario: grupoAdminTecnico.id_grupo_usuario,
            id_formulario: formularioMenu.id_formulario,
          },
        },
        update: {
          administrador: 'S',
          incluir: 'S',
          editar: 'S',
          excluir: 'S',
          nome_aplicacao_auditoria: 'infotime-web',
        },
        create: {
          id_grupo_usuario: grupoAdminTecnico.id_grupo_usuario,
          id_formulario: formularioMenu.id_formulario,
          id_tenacidade: tenacidade.id_tenacidade,
          administrador: 'S',
          incluir: 'S',
          editar: 'S',
          excluir: 'S',
          nome_aplicacao_auditoria: 'infotime-web',
        },
      });

      const menuAdmin = [
        'dashboard',
        'cadastros',
        'cad-acesso',
        'solucoes',
        'ajuda',
        'preferencias',
        'implantacao',
      ];
      const menuAtendente = ['dashboard', 'solucoes', 'cadastros-clientes', 'ajuda'];
      const menuColetor = ['dashboard', 'solucoes', 'ajuda'];
      const upsertMenu = async (idGrupo: bigint, menu: unknown) => {
        await tx.infolab_layout_formulario.upsert({
          where: {
            id_grupo_usuario_id_formulario: {
              id_grupo_usuario: idGrupo,
              id_formulario: formularioMenu.id_formulario,
            },
          },
          update: { configuracao_json: JSON.stringify(menu) },
          create: {
            id_grupo_usuario: idGrupo,
            id_formulario: formularioMenu.id_formulario,
            configuracao_json: JSON.stringify(menu),
          },
        });
      };
      await upsertMenu(grupoModeloAdmin, menuAdmin);
      await upsertMenu(grupoModeloAtendente, menuAtendente);
      await upsertMenu(grupoModeloColetor, menuColetor);
    }

    const senhaPlaceholder = await bcrypt.hash(
      '__seed_usuario_global_nao_usada__',
      10,
    );
    await garantirUsuarioTecnicoGlobal(
      tx,
      'suporte',
      'Suporte (acesso técnico global)',
      senhaPlaceholder,
    );
    await garantirUsuarioTecnicoGlobal(
      tx,
      'implantacao',
      'Implantação (acesso técnico global)',
      senhaPlaceholder,
    );
    console.log(
      'Usuários globais suporte / implantacao garantidos (id_tenacidade NULL).',
    );
  });
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(() => prisma.$disconnect());
