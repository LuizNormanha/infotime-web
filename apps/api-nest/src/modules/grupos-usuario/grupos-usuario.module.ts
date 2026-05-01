import { Module } from '@nestjs/common';
import { GruposUsuarioController } from './grupos-usuario.controller';
import { GruposUsuarioService } from './grupos-usuario.service';
import { GruposUsuarioRepository } from './grupos-usuario.repository';
import { AuthModule } from '../auth/auth.module';

@Module({
  imports: [AuthModule],
  controllers: [GruposUsuarioController],
  providers: [GruposUsuarioService, GruposUsuarioRepository],
})
export class GruposUsuarioModule {}
