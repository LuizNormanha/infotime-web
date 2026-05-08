import { Controller, Get, NotFoundException, Param } from '@nestjs/common';
import { DicionarioService } from './dicionario.service';
import { CampoDicionarioDto } from './dto/campo-dicionario.dto';

@Controller('dicionario')
export class DicionarioController {
  constructor(private readonly service: DicionarioService) {}

  @Get(':tabela')
  camposDaTabela(@Param('tabela') tabela: string): CampoDicionarioDto[] {
    const campos = this.service.camposDaTabela(tabela);
    if (campos.length === 0) {
      throw new NotFoundException(
        `Tabela '${tabela}' não encontrada no dicionário.`,
      );
    }
    return campos;
  }
}
