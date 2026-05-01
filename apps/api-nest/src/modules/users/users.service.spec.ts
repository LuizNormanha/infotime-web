import { ConflictException, ForbiddenException, NotFoundException } from '@nestjs/common';
import { describe, it, expect, vi, beforeEach } from 'vitest';
import type { ClsService } from 'nestjs-cls';
import { UsersService } from './users.service';
import type { UsersRepository } from './users.repository';

describe('UsersService', () => {
  let service: UsersService;

  const repo = {
    findMany: vi.fn(),
    findById: vi.fn(),
    findByLogin: vi.fn(),
    create: vi.fn(),
    update: vi.fn(),
    softDelete: vi.fn(),
  };

  const cls = {
    get: vi.fn(),
  };

  beforeEach(() => {
    vi.clearAllMocks();
    cls.get.mockImplementation((key: string) => {
      if (key === 'tenantId') return '100';
      return undefined;
    });

    service = new UsersService(repo as unknown as UsersRepository, cls as unknown as ClsService);
  });

  it('findMany repassa tenant do CLS ao repositório', async () => {
    repo.findMany.mockResolvedValue({ data: [], total: 0, page: 1, pageSize: 20 });
    await service.findMany({
      page: 1,
      pageSize: 20,
      search: undefined,
      ativo: undefined,
    });
    expect(repo.findMany).toHaveBeenCalledWith(
      expect.any(Object),
      100n,
    );
  });

  it('tenant ausente no CLS gera ForbiddenException', () => {
    cls.get.mockReturnValue(undefined);
    expect(() =>
      service.findMany({ page: 1, pageSize: 20, search: undefined, ativo: undefined }),
    ).toThrow(ForbiddenException);
  });

  it('create lança conflito quando login já existe', async () => {
    repo.findByLogin.mockResolvedValue({ idUsuario: 1n });
    await expect(
      service.create({
        nome: 'Novo',
        email: 'n@n.com',
        login: 'dup',
        senha: 'senha1234',
        role: 'colaborador',
      }),
    ).rejects.toBeInstanceOf(ConflictException);
  });

  it('findById lança NotFound quando não há usuário', async () => {
    repo.findById.mockResolvedValue(null);
    await expect(service.findById('99')).rejects.toBeInstanceOf(NotFoundException);
  });
});
