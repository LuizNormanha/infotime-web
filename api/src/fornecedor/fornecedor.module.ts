import { Module } from '@nestjs/common';

import { PrismaModule } from '../prisma/prisma.module';
import { FornecedorController } from './fornecedor.controller';
import { FornecedorService } from './fornecedor.service';

@Module({
  imports: [PrismaModule],
  controllers: [FornecedorController],
  providers: [FornecedorService],
})
export class FornecedorModule {}
