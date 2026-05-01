# Checklist — migração de tela / módulo

## Identificação

- [ ] Nome da entidade e rotas / aplicação legada
- [ ] Prioridade e dependências

## Evidências

- [ ] Screenshots lidos e anotados
- [ ] TLL/DDL lidos
- [ ] Specs do corpus e do repositório (`specs/<entidade>/`) revisados
- [ ] `events.md` e trechos PHP relevantes

## Lista

- [ ] ListQuery implementada e testada
- [ ] DataTable com paginação, busca, ordenação server-side
- [ ] Filtros avançados
- [ ] Loading / empty / error
- [ ] Permissões na toolbar e ações

## Formulário

- [ ] RHF + Zod
- [ ] Fields reutilizáveis
- [ ] `FormShell` com **footer** (rodapé) quando houver ações
- [ ] `FormFooter` + `ActionsBar` no rodapé (não botões soltos fora do padrão)
- [ ] Erros de API mapeados
- [ ] Abas se aplicável

## Banco / Prisma

- [ ] Models e índices alinhados ao TLL
- [ ] Migrations aplicáveis
- [ ] Sem campos inventados

## Scriptcase / regras

- [ ] Regras críticas no service
- [ ] Documentação em `regras-scriptcase.md` atualizada

## Backend

- [ ] routes → controller → service → repository
- [ ] Zod em rotas
- [ ] Tenant em queries
- [ ] Erro padronizado

## Frontend

- [ ] TanStack Query
- [ ] Padrão visual alinhado a screenshots

## Permissões

- [ ] RBAC verificado
- [ ] `usePermission` aplicado

## Auditoria / Tenancy

- [ ] Mutations com auditoria
- [ ] Sem vazamento de tenant

## Uploads

- [ ] Arquivos via storage externo (se a tela tiver arquivo)

## Testes

- [ ] Testes mínimos das regras críticas

## Revisão visual

- [ ] Comparar com screenshot

## Revisão humana

- [ ] PO/negócio validou fluxo e rótulos
