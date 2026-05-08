import { IsString, MinLength } from 'class-validator';

export class DtoValidarSenhaDia {
  @IsString()
  @MinLength(1, { message: 'Informe a senha do dia.' })
  senha: string;
}
