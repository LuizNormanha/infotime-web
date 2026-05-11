import { BadRequestException } from '@nestjs/common';

import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
} from './query-listagem-crud';

describe('query-listagem-crud', () => {
  describe('modoListagemCrudNovo', () => {
    it('retorna false quando query indefinida', () => {
      expect(modoListagemCrudNovo(undefined)).toBe(false);
    });

    it('retorna true quando há pagina', () => {
      expect(modoListagemCrudNovo({ pagina: '0' })).toBe(true);
    });

    it('retorna true quando filtroRefinado não vazio', () => {
      expect(modoListagemCrudNovo({ filtroRefinado: '{}' })).toBe(true);
    });

    it('retorna false quando filtroRefinado só espaços', () => {
      expect(modoListagemCrudNovo({ filtroRefinado: '   ' })).toBe(false);
    });
  });

  describe('parsePaginaETamanhoPagina', () => {
    it('usa defaults e limita tamanho máximo a 100', () => {
      expect(parsePaginaETamanhoPagina({})).toEqual({
        pagina: 0,
        tamanhoPagina: 10,
      });
      expect(
        parsePaginaETamanhoPagina({ pagina: '2', tamanhoPagina: '999' }),
      ).toEqual({
        pagina: 2,
        tamanhoPagina: 100,
      });
    });
  });

  describe('parseJsonFiltroRefinado', () => {
    it('retorna objeto vazio quando ausente', () => {
      expect(parseJsonFiltroRefinado(undefined)).toEqual({});
    });

    it('parseia JSON objeto', () => {
      expect(parseJsonFiltroRefinado('{"a":{"tipo":"texto"}}')).toEqual({
        a: { tipo: 'texto' },
      });
    });

    it('lança BadRequest quando JSON inválido', () => {
      expect(() => parseJsonFiltroRefinado('{')).toThrow(BadRequestException);
    });
  });
});
