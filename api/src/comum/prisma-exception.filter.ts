import {
  ArgumentsHost,
  Catch,
  ConflictException,
  ExceptionFilter,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

@Catch(Prisma.PrismaClientKnownRequestError)
export class PrismaExceptionFilter
  implements ExceptionFilter<Prisma.PrismaClientKnownRequestError>
{
  catch(exception: Prisma.PrismaClientKnownRequestError, host: ArgumentsHost) {
    void host;
    if (exception.code === 'P2003') {
      throw new ConflictException(
        'Não é possível concluir esta operação porque o registro está vinculado a outros dados.',
      );
    }
    throw exception;
  }
}
