import { Module } from '@nestjs/common';
import { UsersController } from './users.controller';
import { UsersService } from './users.service';
import { UsersRepository } from './users.repository';

/**
 * UsersModule — template de módulo de negócio.
 *
 * Cada módulo exporta apenas o Service, para que outros módulos
 * possam usá-lo sem expor o Repository diretamente.
 *
 * Replicar esta estrutura para cada um dos 37 módulos:
 *  1. Copiar esta pasta
 *  2. Renomear classes e arquivos
 *  3. Implementar DTOs + Repository + Service + Controller
 */
@Module({
  controllers: [UsersController],
  providers: [UsersService, UsersRepository],
  exports: [UsersService],
})
export class UsersModule {}
