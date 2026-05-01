import { Module } from '@nestjs/common';
import { ClientesController } from './clientes.controller';
import { ClientesService } from './clientes.service';
import { ClientesRepository } from './clientes.repository';
import { AuthModule } from '../auth/auth.module';

@Module({
  imports: [AuthModule],
  controllers: [ClientesController],
  providers: [ClientesService, ClientesRepository],
})
export class ClientesModule {}
