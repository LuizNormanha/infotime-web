import {
  ArgumentsHost,
  Catch,
  ConflictException,
  ExceptionFilter,
  InternalServerErrorException,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

@Catch(Prisma.PrismaClientKnownRequestError)
export class PrismaExceptionFilter implements ExceptionFilter<Prisma.PrismaClientKnownRequestError> {
  catch(exception: Prisma.PrismaClientKnownRequestError, host: ArgumentsHost) {
    void host;
    switch (exception.code) {
      case 'P2002':
        throw new ConflictException(
          'Já existe um registro com os mesmos dados.',
        );
      case 'P2003':
        throw new ConflictException(
          'Não é possível concluir esta operação porque o registro está vinculado a outros dados.',
        );
      case 'P2025':
        throw new NotFoundException('Registro não encontrado.');
      default:
        throw new InternalServerErrorException(
          'Não foi possível concluir a operação no momento.',
        );
    }
  }
}
