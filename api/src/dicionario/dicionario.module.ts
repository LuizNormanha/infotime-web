import { Module } from '@nestjs/common';
import { DicionarioController } from './dicionario.controller';
import { DicionarioService } from './dicionario.service';
import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';

@Module({
  imports: [ModuloAutenticacao],
  controllers: [DicionarioController],
  providers: [DicionarioService],
  exports: [DicionarioService],
})
export class DicionarioModule {}
