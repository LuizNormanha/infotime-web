import { IsArray, IsOptional, IsString } from 'class-validator';

/** Placeholder — fluxo em lote a definir com o produto (Colaborador_EnviarEmail_Lst). */
export class EmailsLoteColaboradorDto {
  @IsOptional()
  @IsArray()
  @IsString({ each: true })
  idsColaborador?: string[];
}
