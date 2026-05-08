import { PartialType } from '@nestjs/mapped-types';
import { CriarClienteDto } from './criar-cliente.dto';

/**
 * DTO para atualização de cliente.
 * Todos os campos são opcionais (extends PartialType(CriarClienteDto)).
 * Requisito 6.2: AtualizarClienteDto SHALL estender PartialType(CriarClienteDto).
 */
export class AtualizarClienteDto extends PartialType(CriarClienteDto) {}
