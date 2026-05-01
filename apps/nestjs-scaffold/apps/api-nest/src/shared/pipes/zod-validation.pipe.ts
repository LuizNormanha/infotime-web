import {
  ArgumentMetadata,
  BadRequestException,
  Injectable,
  PipeTransform,
} from '@nestjs/common';
import { ZodSchema } from 'zod';

/**
 * ZodValidationPipe — valida o body/query/param usando schemas Zod.
 *
 * Uso em um controller:
 *   @Body(new ZodValidationPipe(CreateUserSchema)) dto: CreateUserDto
 *
 * Ou globalmente no main.ts:
 *   app.useGlobalPipes(new ZodValidationPipe())
 *
 * Quando usado globalmente, valida apenas se o metatype for um ZodSchema.
 * Para uso por endpoint, passe o schema como argumento.
 */
@Injectable()
export class ZodValidationPipe implements PipeTransform {
  constructor(private readonly schema?: ZodSchema) {}

  transform(value: unknown, metadata: ArgumentMetadata) {
    // Se um schema foi passado explicitamente, usa ele
    if (this.schema) {
      return this.validate(value, this.schema);
    }

    // Uso global: verifica se o metatype é um ZodSchema
    const schema = metadata.metatype as unknown as ZodSchema | undefined;
    if (schema && typeof schema.safeParse === 'function') {
      return this.validate(value, schema);
    }

    return value;
  }

  private validate(value: unknown, schema: ZodSchema) {
    const result = schema.safeParse(value);

    if (!result.success) {
      const errors = result.error.issues.map((issue) => ({
        field: issue.path.join('.'),
        message: issue.message,
        code: issue.code,
      }));

      throw new BadRequestException({
        statusCode: 400,
        error: 'Validation Error',
        message: 'Dados inválidos',
        details: errors,
      });
    }

    return result.data;
  }
}
