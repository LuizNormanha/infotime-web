import { PartialType } from '@nestjs/mapped-types';

import { CriarClienteDto } from './criar-cliente.dto';

/** PATCH conceitual: todos opcionais; validações condicionais no service (CNPJ/situação). */
export class AtualizarClienteDto extends PartialType(CriarClienteDto) {}
