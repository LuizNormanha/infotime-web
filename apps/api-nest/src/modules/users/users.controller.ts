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
import { UsersService } from './users.service';
import {
  CreateUserSchema,
  CreateUserDto,
  UpdateUserSchema,
  UpdateUserDto,
  UserQuerySchema,
  UserQueryDto,
} from './dto/user.dto';
import { ZodValidationPipe } from '../../shared/pipes/zod-validation.pipe';
import { JwtAuthGuard } from '../auth/guards/jwt-auth.guard';
import { TenantGuard } from '../auth/guards/tenant.guard';
import { RolesGuard } from '../../shared/guards/roles.guard';
import { TenantInterceptor } from '../../shared/interceptors/tenant.interceptor';
import { CurrentUser } from '../../shared/decorators/current-user.decorator';
import { Roles } from '../../shared/decorators/roles.decorator';
import type { JwtPayload } from '../auth/strategies/jwt.strategy';

@Controller('usuarios')
@UseGuards(JwtAuthGuard, TenantGuard, RolesGuard)
@UseInterceptors(TenantInterceptor)
export class UsersController {
  constructor(private readonly svc: UsersService) {}

  @Get()
  findAll(@Query(new ZodValidationPipe(UserQuerySchema)) q: UserQueryDto) {
    return this.svc.findMany(q);
  }

  @Get('me')
  me(@CurrentUser() user: JwtPayload) {
    return this.svc.findById(user.sub);
  }

  @Get(':id')
  findOne(@Param('id') id: string) {
    return this.svc.findById(id);
  }

  @Post()
  @Roles('admin')
  create(@Body(new ZodValidationPipe(CreateUserSchema)) dto: CreateUserDto) {
    return this.svc.create(dto);
  }

  @Patch(':id')
  @Roles('admin')
  update(
    @Param('id') id: string,
    @Body(new ZodValidationPipe(UpdateUserSchema)) dto: UpdateUserDto,
  ) {
    return this.svc.update(id, dto);
  }

  @Delete(':id')
  @Roles('admin')
  @HttpCode(HttpStatus.OK)
  remove(@Param('id') id: string) {
    return this.svc.remove(id);
  }
}
