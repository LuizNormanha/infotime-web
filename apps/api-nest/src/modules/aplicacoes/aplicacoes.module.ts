import { Module } from '@nestjs/common';
import { AplicacoesController } from './aplicacoes.controller';
import { AplicacoesService } from './aplicacoes.service';
import { AplicacoesRepository } from './aplicacoes.repository';
import { AuthModule } from '../auth/auth.module';

@Module({
  imports: [AuthModule],
  controllers: [AplicacoesController],
  providers: [AplicacoesService, AplicacoesRepository],
})
export class AplicacoesModule {}
