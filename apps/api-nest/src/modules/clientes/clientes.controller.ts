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
import { ClientesService } from './clientes.service';
import { IdParamSchema, ListQuerySchema, type ListQueryDto } from '../../shared/dto/list-query.dto';
import { ZodValidationPipe } from '../../shared/pipes/zod-validation.pipe';
import { ClienteCreateSchema, ClienteUpdateSchema, type ClienteCreateDto, type ClienteUpdateDto } from './dto/cliente.dto';
import { JwtAuthGuard } from '../auth/guards/jwt-auth.guard';
import { TenantGuard } from '../auth/guards/tenant.guard';
import { TenantInterceptor } from '../../shared/interceptors/tenant.interceptor';

@Controller('clientes')
@UseGuards(JwtAuthGuard, TenantGuard)
@UseInterceptors(TenantInterceptor)
export class ClientesController {
  constructor(private readonly svc: ClientesService) {}

  @Get()
  list(@Query(new ZodValidationPipe(ListQuerySchema)) q: ListQueryDto) {
    return this.svc.findMany(q);
  }

  @Get(':id')
  get(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.findOne(p.id);
  }

  @Post()
  create(@Body(new ZodValidationPipe(ClienteCreateSchema)) dto: ClienteCreateDto) {
    return this.svc.create(dto);
  }

  @Patch(':id')
  update(
    @Param(new ZodValidationPipe(IdParamSchema)) p: { id: string },
    @Body(new ZodValidationPipe(ClienteUpdateSchema)) dto: ClienteUpdateDto,
  ) {
    return this.svc.update(p.id, dto);
  }

  @Delete(':id')
  @HttpCode(HttpStatus.OK)
  remove(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.remove(p.id);
  }
}
