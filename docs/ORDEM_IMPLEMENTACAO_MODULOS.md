# Ordem recomendada de implementação (dependências)

Implementar em **pequenos incrementos**; não as 40 entidades de uma vez.

1. **tenacidade** / **configuracao** (base de tenant e parâmetros)
2. **auth**
3. **usuario**
4. **grupo-usuario**
5. **aplicacao**
6. **empresa**
7. **banco**
8. **conta-caixa**
9. **plano-conta**
10. **cliente**
11. **negociacao**
12. **proposta**
13. **contrato**
14. **implantacao**
15. **colaborador**
16. **cargo**
17. **colaborador-rh**
18. **colaborador-tarefa**
19. **fornecedor**
20. **produto**
21. **lancamento-receita**
22. **lancamento-despesa**
23. **nota-fiscal**
24. **boleto**
25. **pix**
26. **retorno-cnab**
27. **almoxarifado**
28. **almoxarifado-entrada**
29. **almoxarifado-requisicao**
30. **almoxarifado-baixa**
31. **patrimonio**
32. **pop-documento**
33. **agenda**
34. **avaliacao-infolab**
35. **cliente-licenca**
36. **treinamento**
37. **portal-cliente**
38. **concorrente**
39. **auditoria**
40. Módulos complementares restantes (ex.: **colaborador-viagem** e ajustes transversais)

**Nota:** `tenacidade` pode não ter pasta dedicada no corpus; tratar na modelagem a partir dos TLLs (ex. `portal-cliente`, `configuracao`).
