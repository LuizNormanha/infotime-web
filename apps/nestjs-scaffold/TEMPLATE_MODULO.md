# Template de módulo de negócio — NestJS + FastifyAdapter

Copie a pasta `users/` como ponto de partida para qualquer um dos 37 módulos.

## Estrutura padrão

```
modules/<nome>/
  dto/
    <nome>.dto.ts         ← Schemas Zod + tipos inferidos
  <nome>.repository.ts    ← Única camada que toca o Prisma
  <nome>.service.ts       ← Lógica de negócio, sem Prisma direto
  <nome>.controller.ts    ← HTTP: guards, pipes, decorators
  <nome>.module.ts        ← @Module, providers, exports
```

## Checklist para cada módulo novo

- [ ] Criar DTO com schemas Zod (Create, Update, Query)
- [ ] Criar Repository com `findMany`, `findById`, `create`, `update`, `remove`
- [ ] Criar Service que injeta o Repository e o ClsService
- [ ] Criar Controller com `@UseGuards(JwtAuthGuard, TenantGuard, RolesGuard)`
- [ ] Criar Module e registrar em `AppModule`
- [ ] Adicionar os modelos do Prisma ao `tenantModels` no `PrismaService`

## Guards e decorators disponíveis

| Decorator/Guard       | O que faz                                       |
|-----------------------|-------------------------------------------------|
| `@Public()`           | Marca rota como pública (sem JWT)               |
| `@CurrentUser()`      | Extrai o usuário do JWT no parâmetro            |
| `@Roles(...)`         | Define os papéis permitidos                     |
| `JwtAuthGuard`        | Valida o Bearer token                           |
| `TenantGuard`         | Valida que o tenantId da rota = tenantId do JWT |
| `RolesGuard`          | Verifica papel do usuário vs @Roles()           |
| `TenantInterceptor`   | Injeta userId/tenantId no ClsService            |
| `AuditInterceptor`    | Loga mutações automaticamente                   |
| `ZodValidationPipe`   | Valida body/query com schema Zod                |
| `HttpExceptionFilter` | Padroniza respostas de erro                     |

## Exemplo de controller completo

```typescript
@Controller('financeiro/lancamentos')
@UseGuards(JwtAuthGuard, TenantGuard, RolesGuard)
@UseInterceptors(TenantInterceptor)
export class LancamentosController {
  constructor(private readonly service: LancamentosService) {}

  @Get()
  findAll(@Query(new ZodValidationPipe(LancamentoQuerySchema)) q: LancamentoQueryDto) {
    return this.service.findMany(q);
  }

  @Post()
  @Roles('admin', 'gestor')
  create(@Body(new ZodValidationPipe(CreateLancamentoSchema)) dto: CreateLancamentoDto) {
    return this.service.create(dto);
  }
}
```
