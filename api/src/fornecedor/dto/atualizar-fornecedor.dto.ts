import { PartialType } from '@nestjs/mapped-types';

import { CriarFornecedorDto } from './criar-fornecedor.dto';

export class AtualizarFornecedorDto extends PartialType(CriarFornecedorDto) {}
