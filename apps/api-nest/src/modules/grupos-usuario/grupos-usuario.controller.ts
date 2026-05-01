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
import { GruposUsuarioService } from './grupos-usuario.service';
import { IdParamSchema, ListQuerySchema, type ListQueryDto } from '../../shared/dto/list-query.dto';
import { ZodValidationPipe } from '../../shared/pipes/zod-validation.pipe';
import { GrupoCreateSchema, GrupoUpdateSchema, type GrupoCreateDto, type GrupoUpdateDto } from './dto/grupo-usuario.dto';
import { JwtAuthGuard } from '../auth/guards/jwt-auth.guard';
import { TenantGuard } from '../auth/guards/tenant.guard';
import { TenantInterceptor } from '../../shared/interceptors/tenant.interceptor';

@Controller('grupos-usuario')
@UseGuards(JwtAuthGuard, TenantGuard)
@UseInterceptors(TenantInterceptor)
export class GruposUsuarioController {
  constructor(private readonly svc: GruposUsuarioService) {}

  @Get()
  list(@Query(new ZodValidationPipe(ListQuerySchema)) q: ListQueryDto) {
    return this.svc.findMany(q);
  }

  @Get(':id')
  get(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.findOne(p.id);
  }

  @Post()
  create(@Body(new ZodValidationPipe(GrupoCreateSchema)) dto: GrupoCreateDto) {
    return this.svc.create(dto);
  }

  @Patch(':id')
  update(
    @Param(new ZodValidationPipe(IdParamSchema)) p: { id: string },
    @Body(new ZodValidationPipe(GrupoUpdateSchema)) dto: GrupoUpdateDto,
  ) {
    return this.svc.update(p.id, dto);
  }

  @Delete(':id')
  @HttpCode(HttpStatus.OK)
  remove(@Param(new ZodValidationPipe(IdParamSchema)) p: { id: string }) {
    return this.svc.remove(p.id);
  }
}
