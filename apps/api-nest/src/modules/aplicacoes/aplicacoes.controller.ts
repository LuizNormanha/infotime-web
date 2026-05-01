import {
  Body,
  Controller,
  Delete,
  Get,
  HttpCode,
  HttpStatus,
  Param,
  Patch,
  Post,
  Query,
  UseGuards,
  UseInterceptors,
} from '@nestjs/common';
import { AplicacoesService } from './aplicacoes.service';
import { IdParamSchema, ListQuerySchema, type ListQueryDto } from '../../shared/dto/list-query.dto';
import { ZodValidationPipe } from '../../shared/pipes/zod-validation.pipe';
import {
  AplicacaoCreateSchema,
  AplicacaoUpdateSchema,
  type AplicacaoCreateDto,
  type AplicacaoUpdateDto,
} from './dto/aplicacao.dto';
import { JwtAuthGuard } from '../auth/guards/jwt-auth.guard';
import { TenantGuard } from '../auth/guards/tenant.guard';
import { TenantInterceptor } from '../../shared/interceptors/tenant.interceptor';

@Controller('aplicacoes')
@UseGuards(JwtAuthGuard, TenantGuard)
@UseInterceptors(TenantInterceptor)
export class AplicacoesController {
  constructor(private readonly svc: AplicacoesService) {}

  @Get()
  list(@Query(new ZodValidationPipe(ListQuerySchema)) q: ListQueryDto) {
    return this.svc.findMany(q);
  }

  @Get(':id')
  get(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.findOne(p.id);
  }

  @Post()
  create(@Body(new ZodValidationPipe(AplicacaoCreateSchema)) dto: AplicacaoCreateDto) {
    return this.svc.create(dto);
  }

  @Patch(':id')
  update(
    @Param(new ZodValidationPipe(IdParamSchema)) p: { id: string },
    @Body(new ZodValidationPipe(AplicacaoUpdateSchema)) dto: AplicacaoUpdateDto,
  ) {
    return this.svc.update(p.id, dto);
  }

  @Delete(':id')
  @HttpCode(HttpStatus.OK)
  remove(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.remove(p.id);
  }
}
