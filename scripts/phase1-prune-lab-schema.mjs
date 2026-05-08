/**
 * Fase 1 — remove modelos do domínio laboratorial (LIS) do schema Prisma
 * e apaga linhas de campo-relação que apontam para modelos removidos.
 *
 * Uso: node scripts/phase1-prune-lab-schema.mjs
 * Requer: api/prisma/schema.prisma
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const schemaPath = path.join(root, "api", "prisma", "schema.prisma");

/** @type {Set<string>} */
const REMOVE = new Set([
  "infolab_analisador",
  "infolab_analisador_exame_material",
  "infolab_analisador_exame_material_campo",
  "infolab_analisador_exame_material_campo_limite",
  "infolab_atendimento",
  "infolab_atendimento_amostra",
  "infolab_atendimento_amostra_impressao",
  "infolab_atendimento_amostra_motivo_prorrogacao",
  "infolab_atendimento_amostra_motivo_rejeicao",
  "infolab_atendimento_amostra_observacoes_coleta",
  "infolab_atendimento_amostra_observacoes_devolucao",
  "infolab_atendimento_convenio",
  "infolab_atendimento_exame_material",
  "infolab_atendimento_exame_material_autorizacao",
  "infolab_atendimento_exame_material_medico",
  "infolab_atendimento_exame_material_resultado_campo",
  "infolab_atendimento_medico",
  "infolab_atendimento_pagamento",
  "infolab_computador",
  "infolab_etiqueta_perfil_impressao",
  "infolab_exame",
  "infolab_exame_analisador",
  "infolab_exame_material",
  "infolab_exame_material_campo",
  "infolab_exame_material_campo_limite",
  "infolab_exame_material_grupo",
  "infolab_exame_material_grupo_exame",
  "infolab_exame_material_lab_apoio",
  "infolab_exame_material_preco",
  "infolab_exame_material_questionario",
  "infolab_exame_material_unidade",
  "infolab_grupo_exame_material",
  "infolab_integracao",
  "infolab_integracao_convenio",
  "infolab_integracao_exame_material",
  "infolab_integracao_procedencia",
  "infolab_interface_pacote",
  "infolab_lab_apoio",
  "infolab_lab_apoio_unidade",
  "infolab_local_armazenamento",
  "infolab_lote_b2b_apoio",
  "infolab_mapa",
  "infolab_mapa_atendimento_exame_material",
  "infolab_mapa_definicao",
  "infolab_material",
  "infolab_modelo_resultado",
  "infolab_motivo_exame_retificacao",
  "infolab_motivo_orcamento_rejeicao",
  "infolab_motivo_quarentena",
  "infolab_motivo_recoleta",
  "infolab_orcamento",
  "infolab_orcamento_exame_material",
  "infolab_pendencia_resultado",
  "infolab_ponto_interface",
  "infolab_ponto_programacao",
  "infolab_porta_serial",
  "infolab_preco_exame",
  "infolab_preco_fator",
  "infolab_preco_tabela",
  "infolab_questionario",
  "infolab_questionario_campo",
  "infolab_questionario_campo_resposta",
  "infolab_questionario_campo_valor",
  "infolab_recipiente",
  "infolab_resultado",
  "infolab_resultado_tabela",
  "infolab_resultado_tabela_valor",
  "infolab_situacao_coleta",
  "infolab_tipo_destino_resultado",
  "infolab_amostra_status",
  "infolab_material_tipo",
  "infolab_recipiente_tipo",
  "infolab_equipamento_tipo",
  "infolab_movimento_tipo",
  "infolab_bloqueio_tipo",
  "infolab_residuo_grupo",
  "infolab_descarte_metodo",
  "infolab_descarte_motivo",
  "infolab_norma",
  "infolab_finalidade",
  "infolab_derivado_tipo",
  "infolab_qualidade_evento_tipo",
  "infolab_soroteca_grade",
  "infolab_soroteca_grade_poco_historico",
  "infolab_soroteca_sala",
  "infolab_soroteca_equipamento",
  "infolab_soroteca_rack",
  "infolab_soroteca_caixa",
  "infolab_soroteca_posicao",
  "infolab_soroteca_retencao_regra",
  "infolab_soroteca_aliquota",
  "infolab_soroteca_derivado",
  "infolab_soroteca_armazenamento",
  "infolab_soroteca_bloqueio",
  "infolab_soroteca_movimento",
  "infolab_descarte_lote",
  "infolab_descarte_item",
  "infolab_qualidade_evento",
  "infolab_temperatura_log",
  "infolab_temperatura_quarentena",
  "infolab_soroteca_auditoria",
  "infolab_temperatura_opcao",
  "infolab_amostra_temperatura",
]);

const raw = fs.readFileSync(schemaPath, "utf8");

function splitSchema(text) {
  const lines = text.split(/\r?\n/);
  const firstModelIdx = lines.findIndex((l) => /^model\s+\S+\s+\{/.test(l));
  if (firstModelIdx === -1) {
    throw new Error("schema.prisma: nenhum model encontrado");
  }
  const preambleLines = lines.slice(0, firstModelIdx);
  const rest = lines.slice(firstModelIdx);
  /** @type {{ pre: string[], lines: string[] }[]} */
  const models = [];
  let i = 0;
  while (i < rest.length) {
    const pre = [];
    while (i < rest.length && !/^model\s+\S+\s+\{/.test(rest[i])) {
      pre.push(rest[i]);
      i++;
    }
    if (i >= rest.length) break;
    const head = /^model\s+(\S+)\s+\{/.exec(rest[i]);
    if (!head) {
      throw new Error(`Esperado model em: ${rest[i]}`);
    }
    const name = head[1];
    const block = [rest[i]];
    i++;
    let depth = 1;
    while (i < rest.length && depth > 0) {
      const L = rest[i];
      block.push(L);
      depth +=
        (L.match(/\{/g) || []).length - (L.match(/\}/g) || []).length;
      i++;
    }
    models.push({ pre, lines: block, name });
  }
  return { preambleLines, models };
}

function fieldLineReferencesRemovedModel(line) {
  const trimmed = line.trim();
  if (!trimmed || trimmed.startsWith("//") || trimmed.startsWith("@@") || trimmed.startsWith("///")) {
    return false;
  }
  const rel = /^\s*(\S+)\s+(infolab_[a-zA-Z0-9_]+)(\[\]|\?)?(\s|$)/.exec(line);
  if (rel && REMOVE.has(rel[2])) return true;
  return false;
}

function stripRemovedRelationFieldsFromBlock(lines) {
  return lines.filter((line) => !fieldLineReferencesRemovedModel(line));
}

const { preambleLines, models } = splitSchema(raw);

const kept = models.filter((b) => !REMOVE.has(b.name));
const cleaned = kept.map((b) => ({
  name: b.name,
  pre: b.pre,
  lines: stripRemovedRelationFieldsFromBlock(b.lines),
}));

const out = [
  ...preambleLines,
  ...cleaned.flatMap((b) => [...b.pre, ...b.lines]),
  "",
].join("\n");

fs.writeFileSync(schemaPath, out, "utf8");
console.log(
  `phase1-prune-lab-schema: removidos ${models.length - kept.length} models; mantidos ${kept.length}.`,
);
