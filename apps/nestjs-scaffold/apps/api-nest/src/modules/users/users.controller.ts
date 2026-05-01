import {
  Body,
  Controller,
  Delete,
  Get,
  HttpCode,
  HttpStatus,
  Param,
  ParseIntPipe,
  Patch,
  Post,
  Query,
  UseGuards,
  UseInterceptors,
} from '@nestjs/common';
import { UsersService } from './users.service';
import {
  ChangePasswordSchema,
  ChangePasswordDto,
  CreateUserSchema,
  CreateUserDto,
  UpdateUserSchema,
  UpdateUserDto,
  UserQuerySchema,
  UserQueryDto,
} from './dto/user.dto';
import { ZodValidationPipe } from '@shared/pipes/zod-validation.pipe';
import { JwtAuthGuard } from '@modules/auth/guards/jwt-auth.guard';
import { TenantGuard } from '@modules/auth/guards/tenant.guard';
import { RolesGuard } from '@shared/guards/roles.guard';
import { TenantInterceptor } from '@shared/interceptors/tenant.interceptor';
import { CurrentUser } from '@shared/decorators/current-user.decorator';
import { Roles } from '@shared/decorators/roles.decorator';
import { JwtPayload } from '@modules/auth/strategies/jwt.strategy';

/**
 * UsersController — serve de template para todos os módulos de negócio.
 *
 * Padrão:
 * - @UseGuards(JwtAuthGuard, TenantGuard, RolesGuard) no controller
 * - @UseInterceptors(TenantInterceptor) para injetar contexto no CLS
 * - @Roles() nas rotas sensíveis
 * - ZodValidationPipe em cada body
 */
@Controller('users')
@UseGuards(JwtAuthGuard, TenantGuard, RolesGuard)
@UseInterceptors(TenantInterceptor)
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  /** GET /api/v1/users?page=1&limit=20&search=joao */
  @Get()
  findAll(@Query(new ZodValidationPipe(UserQuerySchema)) query: UserQueryDto) {
    return this.usersService.findMany(query);
  }

  /** GET /api/v1/users/me */
  @Get('me')
  getMe(@CurrentUser() user: JwtPayload) {
    return this.usersService.findById(user.sub);
  }

  /** GET /api/v1/users/:id */
  @Get(':id')
  findOne(@Param('id', ParseIntPipe) id: number) {
    return this.usersService.findById(id);
  }

  /** POST /api/v1/users — apenas admin ou gestor */
  @Post()
  @Roles('admin', 'gestor')
  create(@Body(new ZodValidationPipe(CreateUserSchema)) dto: CreateUserDto) {
    return this.usersService.create(dto);
  }

  /** PATCH /api/v1/users/:id */
  @Patch(':id')
  @Roles('admin', 'gestor')
  update(
    @Param('id', ParseIntPipe) id: number,
    @Body(new ZodValidationPipe(UpdateUserSchema)) dto: UpdateUserDto,
  ) {
    return this.usersService.update(id, dto);
  }

  /** PATCH /api/v1/users/:id/password */
  @Patch(':id/password')
  @HttpCode(HttpStatus.OK)
  changePassword(
    @Param('id', ParseIntPipe) id: number,
    @Body(new ZodValidationPipe(ChangePasswordSchema)) dto: ChangePasswordDto,
  ) {
    return this.usersService.changePassword(id, dto);
  }

  /** DELETE /api/v1/users/:id — apenas admin */
  @Delete(':id')
  @Roles('admin')
  @HttpCode(HttpStatus.OK)
  remove(@Param('id', ParseIntPipe) id: number) {
    return this.usersService.remove(id);
  }
}
