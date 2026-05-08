export class CampoDicionarioDto {
  chave: string;
  tipo_banco: string;
  nullable: boolean;
  max_length?: number;
  obrigatorio_sistema: boolean;
  eh_chave_primaria: boolean;
  eh_auditoria: boolean;
  eh_tenant: boolean;
}
