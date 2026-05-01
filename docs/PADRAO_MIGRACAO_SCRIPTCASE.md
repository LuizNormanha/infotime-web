# Padrão de extração de regras Scriptcase

## Orientação central

```text
Você é um engenheiro fazendo migração de Scriptcase PHP para Node.js com Prisma.
Não traduza linha por linha.
Extraia a intenção da regra de negócio e reimplemente no padrão do novo backend.
```

## Para cada regra Scriptcase extraída, documentar

1. Nome da regra.
2. Arquivo Scriptcase de origem.
3. Aplicação Scriptcase (código/nome se conhecido).
4. Evento Scriptcase original (`onBeforeInsert`, etc.).
5. Código PHP relevante — **somente o trecho necessário**.
6. Intenção funcional.
7. Nova implementação sugerida em Node.js (service/repository).
8. Local correto no novo projeto (paths).
9. Testes necessários.
10. Dúvidas abertas.

## Prioridade de leitura

1. `scriptcase/events.md` na pasta da entidade.
2. Trechos PHP citados nos specs do corpus.
3. Busca focalizada por SQL ou `sc_exec_sql` quando necessário.

## Saída

- Registro consolidado em `specs/<entidade>/regras-scriptcase.md` do projeto.
