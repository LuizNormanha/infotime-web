
# Prisma Schema — Entidade `cliente` (e entidades relacionadas a pacientes)

> **IMPORTANTE:** O Infotime não possui tabela `pacientes`.
> Este schema cobre as 3 entidades do sistema que contêm dados pessoais de indivíduos:
> 1. `cliente` — laboratórios/clínicas (clientes da Liga Sistemas)
> 2. `coleta_domiciliar` — **dados de pacientes** (nome, CPF, nascimento, exames)
> 3. `cliente_aluno` — alunos/pacientes em contexto escolar

---

## 2. Explicação das Relações

### Diagrama de Relacionamentos

```
tenacidade (1) ──────────────────── (*) cliente (*)
                                         │
                    ┌────────────────────┤
                    │                   │
              (N:1) │             (1:N) │
            SituacaoCliente      ClienteContato
            TipoCliente          ClienteComunicacao
            ClienteCanal         ClienteDocumento
            RegiaoEstadual       ClienteSenha
            Municipio            ClienteTelefone
                                 ClientePlanoConta
                                         │
                              (self N:1) │
                             clientePai → clientesFilhos
```

### Relações Confirmadas (FK no DDL)
| Modelo | Campo | Aponta para | Cardinalidade |
|---|---|---|---|
| `Cliente` | `situacaoClienteId` | `SituacaoCliente` | N:1 |
| `Cliente` | `tipoClienteId` | `TipoCliente` | N:1 |
| `Cliente` | `clienteCanalId` | `ClienteCanal` | N:1 |
| `Cliente` | `regiaoEstadualId` | `RegiaoEstadual` | N:1 |
| `Cliente` | `municipioId` | `Municipio` | N:1 |
| `Cliente` | `clientePaiId` | `Cliente` | N:1 (self) |
| `ClienteContato` | `clienteId` | `Cliente` | N:1 |
| `ClienteComunicacao` | `clienteId` | `Cliente` | N:1 |
| `ClienteDocumento` | `clienteId` | `Cliente` | N:1 |
| `ClienteSenha` | `clienteId` | `Cliente` | N:1 |
| `ClienteTelefone` | `clienteId` | `Cliente` | N:1 |
| `ClientePlanoConta` | `clienteId` | `Cliente` | N:1 |

### Relações Prováveis (FK existe no DB, modelo de destino não incluído aqui)
| Modelo | Campo | Aponta para | Status |
|---|---|---|---|
| `Cliente` | `contaCaixaId` | `ContaCaixa` | **Relação provável** — confirmar uso |
| `Cliente` | `concorrenteId` | `Concorrente` | **Relação provável** — confirmar uso |
| `ClienteDocumento` | `tipoDocumentoId` | `TipoDocumento` | **Relação provável** |
| `ClientePlanoConta` | `planoContaId` | `PlanoConta` | **Relação provável** |
| `ClienteAluno` | `clienteResponsavelId` | `Cliente` | **Relação provável** |
| `ClienteAluno` | `situacaoAlunoId` | Tabela desconhecida | **Confirmar no Scriptcase** |

### Multi-tenant
Todas as tabelas possuem `id_tenacidade` — implementar Row Level Security (RLS) ou
filtro global no Prisma via `middleware` para isolar dados por tenant:

```typescript
// Exemplo de middleware Prisma para multi-tenant
prisma.$use(async (params, next) => {
  if (params.model === 'Cliente') {
    params.args.where = {
      ...params.args.where,
      tenacidadeId: ctx.tenacidadeId,
    };
  }
  return next(params);
});
```

---

## 3. Campos que Precisam de Validação no Backend

### 3.1 Campos Críticos por Modelo

#### `Cliente`
```typescript
// Validação com Zod (recomendado)
const ClienteSchema = z.object({

  // ── Tipo de pessoa ─────────────────────────────────────────────────────────
  tipoPessoa: z.enum(['J', 'F']),
  // Se J: cnpj obrigatório (14 dígitos), razao_social obrigatório
  // Se F: cpf validado (11 dígitos + dígito verificador)

  // ── CNPJ / CPF ────────────────────────────────────────────────────────────
  cnpj: z.string()
    .optional()
    .refine(val => !val || validarCNPJ(val) || validarCPF(val), {
      message: 'CNPJ ou CPF inválido'
    }),

  // ── E-mail ────────────────────────────────────────────────────────────────
  email: z.string().email().optional(),

  // ── CEP ───────────────────────────────────────────────────────────────────
  cep: z.string().length(8).regex(/^\d{8}$/).optional(),
  // ⚠️  DB armazena sem máscara (8 dígitos) — remover formatação no backend

  // ── Estado ────────────────────────────────────────────────────────────────
  estado: z.enum(['AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG',
    'MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC',
    'SE','SP','TO']).optional(),

  // ── Flags legado (char(1) → Boolean) ────────────────────────────────────
  emiteBoleto: z.enum(['S', 'N']).optional(),
  // No novo sistema: migrar para Boolean
  clientePublico: z.enum(['S', 'N']).optional(),

  // ── Sexo (apenas para PF) ────────────────────────────────────────────────
  sexo: z.enum(['M', 'F', 'N']).optional(),

  // ── Licença InfoLAB ───────────────────────────────────────────────────────
  chaveAcesso: z.string().max(50).optional(),
  dataExpiracao: z.date().optional(),
  qtdLicenca: z.number().int().min(0).max(32767).optional(),

  // ── Certificado de Registro ───────────────────────────────────────────────
  dataEmissaoCr: z.date().optional(),
  dataValidadeCr: z.date()
    .refine(val => !val || val > new Date(), {
      message: 'Data de validade do CR não pode estar no passado'
    })
    .optional(),
});
```

#### `ClienteContato`
```typescript
const ClienteContatoSchema = z.object({
  assinaProposta: z.enum(['S', 'N']),
  recebeCobranca: z.enum(['S', 'N']),
  email: z.string().email().optional(),
  celular: z.string().regex(/^\d{10,11}$/).optional(),
  titulo: z.enum(['Sr.', 'Sra.', 'Dr.', 'Dra.', 'Prof.', 'Profa.']).optional(),
});
```

#### `ColetaDomiciliar`
```typescript
const ColetaDomiciliarSchema = z.object({
  cpf: z.string()
    .length(11)
    .refine(validarCPF, { message: 'CPF inválido' }),
  email: z.string().email().optional(),
  dataNascimento: z.date()
    .refine(val => val < new Date(), { message: 'Data futura inválida' }),
  situacaoColeta: z.enum(['A', 'C', 'R', 'X']),
  horaAgendamento1: z.string().regex(/^\d{2}:\d{2}$/).optional(),
  horaAgendamento2: z.string().regex(/^\d{2}:\d{2}$/).optional(),
  cep: z.string().length(8).regex(/^\d{8}$/).optional(),
  estado: z.string().length(2).optional(),
});
```

#### `ClienteAluno`
```typescript
const ClienteAlunoSchema = z.object({
  cpf: z.string().refine(validarCPF).optional(),
  sexo: z.enum(['M', 'F', 'N']).optional(),
  dataNascimento: z.date().optional(),
  anoLetivo: z.number().int().min(2000).max(2100).optional(),
  serie: z.number().int().min(1).max(12).optional(),
  turno: z.enum(['Manhã', 'Tarde', 'Noite', 'Integral']).optional(),
  // situacao: padronizar — atualmente texto livre no DB
});
```

### 3.2 Lógica de Negócio para Validar no Backend

| # | Validação | Onde aplicar |
|---|---|---|
| 1 | CNPJ: 14 dígitos com dígito verificador | `POST /clientes`, `PUT /clientes/:id` |
| 2 | CPF: 11 dígitos com dígito verificador | Idem, quando `tipo_pessoa = 'F'` |
| 3 | Unicidade de CNPJ por tenacidade | Banco: `@@unique([cnpj, tenacidadeId])` — **verificar se existe** |
| 4 | Hierarquia pai/filho: não criar loop | Cliente não pode ser filho de si mesmo |
| 5 | `data_expiracao` no futuro para nova licença | `POST /clientes/:id/licenca` |
| 6 | `chave_acesso` único por tenacidade | Índice UNIQUE no banco |
| 7 | CEP: buscar ViaCEP e validar município | Service de endereço |
| 8 | `data_validade_cr` deve ser futura | Alerta se CR próximo do vencimento |
| 9 | `recebe_cobranca`: pelo menos 1 contato | Ao emitir boleto |
| 10 | CPF da coleta: único por agendamento ativo | Evitar duplicidade de coleta |

---

## 4. Pontos que Precisam ser Conferidos no Código Scriptcase

### 4.1 `cliente.tipo_pessoa` — Lógica de alternância PF/PJ
```
CONFIRMAR NO SC:
- [ ] Ao selecionar FÍSICA: quais campos ficam visíveis/ocultos/obrigatórios?
- [ ] O campo `cnpj` armazena CPF quando PF? (varchar(14) comporta 14, mas CPF tem 11)
- [ ] Existe validação de CNPJ/CPF antes de salvar?
- [ ] O label do campo muda dinamicamente (CNPJ/CPF)?
```

### 4.2 `cliente.emite_boleto` e `cliente.cliente_publico` — Flags char(1)
```
CONFIRMAR NO SC:
- [ ] Valores possíveis: apenas 'S'/'N' ou também null?
- [ ] null tratado como 'N' ou como "não definido"?
- [ ] `cliente_publico`: controla acesso ao portal sem senha?
```

### 4.3 `cliente.chave_acesso` — Token do portal
```
CONFIRMAR NO SC:
- [ ] Geração: manual (digitado) ou automática (UUID/hash)?
- [ ] Tela: `Cliente_Download_Licenca_Ctr` — o que exatamente ela gera?
- [ ] A chave expira junto com `data_expiracao`?
- [ ] Existe envio automático por e-mail ao gerar/renovar?
```

### 4.4 `cliente_comunicacao.tipo_contato` — Char(1) sem enum
```
CONFIRMAR NO SC:
- [ ] Abrir `ClienteComunicacao_Frm.php` e verificar:
      sc_lookup("tipo_contato") ou select hard-coded?
- [ ] Quais valores são usados: T, E, V, W, O?
- [ ] Valor padrão ao criar nova comunicação?
```

### 4.5 `cliente_senha.senha` — Plain text
```
⚠️  CRÍTICO:
- [ ] Confirmar se senhas são armazenadas em plain text (provável)
- [ ] Definir estratégia: AES-256 server-side ou recomendação ao usuário
- [ ] Esta tabela armazena SENHAS DE SISTEMAS EXTERNOS do cliente
      (portais de prefeitura, sistemas de convênio, etc.)
- [ ] Avaliar uso de vault (HashiCorp Vault, AWS Secrets Manager)
```

### 4.6 `cliente_documento.nome_referencia` — Arquivo no storage
```
CONFIRMAR NO SC:
- [ ] `nome_arquivo`: nome original do upload
- [ ] `nome_referencia`: como é gerado? (UUID, timestamp, hash?)
- [ ] Arquivos estão no filesystem do servidor ou em S3/MinIO?
- [ ] Verificar `ClienteDocumento_Frm.php` → evento de upload
- [ ] Verificar se há compressão ou thumbnail de imagens
```

### 4.7 `coleta_domiciliar.data_hotra_inclusao` — Typo no banco
```
⚠️  TYPO DETECTADO:
- [ ] Campo `data_hotra_inclusao` (falta o 'a' em 'hora')
- [ ] Confirmar se é o nome real da coluna (não alterar sem migration!)
- [ ] No Prisma: mapear como `dataHoraInclusao @map("data_hotra_inclusao")`
```

### 4.8 `coleta_domiciliar.relacao_exames` — Texto livre
```
CONFIRMAR NO SC:
- [ ] Este campo é texto livre (lista de exames separados por vírgula)?
- [ ] Ou é JSON serializado?
- [ ] Para o novo sistema: normalizar em tabela `coleta_exame`
- [ ] Há integração com sistema LIS (Laboratory Information System)?
```

### 4.9 `cliente_aluno.situacao` — Texto livre (varchar(50))
```
⚠️  PROBLEMA:
- [ ] Campo `situacao` em `cliente_aluno` é varchar(50) texto livre
- [ ] Verificar quais valores existem no banco de produção:
      SELECT DISTINCT situacao FROM cliente_aluno;
- [ ] Padronizar como enum no novo sistema
- [ ] Valores esperados: Ativo, Inativo, Transferido, Formado, Evadido
```

### 4.10 `cliente_aluno.situacao_aluno_id` — FK sem tabela mapeada
```
CONFIRMAR NO SC:
- [ ] `id_situacao_aluno` aponta para qual tabela?
- [ ] Não encontrada no DDL analisado — pode ser tabela de outro módulo
- [ ] Verificar se existe tabela `situacao_aluno` no banco de produção:
      SELECT * FROM information_schema.tables
      WHERE table_name LIKE '%situacao%aluno%';
```

### 4.11 Multi-tenant — `id_tenacidade` em todas as tabelas
```
CONFIRMAR NO SC:
- [ ] O filtro por tenacidade é aplicado automaticamente nas queries SC?
- [ ] Verificar se há global_where na configuração do projeto SC
- [ ] No novo sistema: implementar via Prisma middleware ou RLS no PostgreSQL
- [ ] NUNCA expor dados de um tenant para outro — testar com 2 tenants diferentes
```

### 4.12 Campos de auditoria Scriptcase (padrão em TODAS as tabelas)
```
Campos presentes em TODAS as tabelas:
  - id_usuario_auditoria      → ID do usuário que fez a última alteração
  - endereco_ip_auditoria     → IP do usuário
  - nome_aplicacao_auditoria  → Nome da tela SC que fez a operação

CONFIRMAR NO SC:
- [ ] Estes campos são preenchidos automaticamente pelo SC (global event)?
- [ ] Verificar em: Configuração do Projeto → Eventos → onApplicationInit
- [ ] Ou verificar em: cada Form → evento onBeforeInsert/onBeforeUpdate
- [ ] No novo sistema: implementar via middleware Prisma + request context
```

---

## 5. Estratégia de Migração dos Dados

### 5.1 Conversão de flags char(1) → Boolean
```sql
-- Executar APÓS criar as colunas booleanas
UPDATE cliente SET emite_boleto_bool = (emite_boleto = 'S');
UPDATE cliente SET cliente_publico_bool = (cliente_publico = 'S');
UPDATE cliente_contato SET assina_proposta_bool = (assina_proposta = 'S');
UPDATE cliente_contato SET recebe_cobranca_bool = (recebe_cobranca = 'S');
```

### 5.2 Senhas em `cliente_senha` — Criptografia
```typescript
// Ao migrar: criptografar todas as senhas existentes
// Usar AES-256-GCM com chave no vault
const encrypted = encrypt(row.senha, process.env.ENCRYPTION_KEY);
await prisma.clienteSenha.update({
  where: { id: row.id },
  data: { senha: encrypted }
});
```

### 5.3 Typo `data_hotra_inclusao` → sem alterar o banco
```typescript
// No Prisma, mapear o typo sem alterar o banco:
dataHoraInclusao DateTime? @map("data_hotra_inclusao")
```

### 5.4 Arquivos em `nome_referencia` → Object Storage
```
Migração de arquivos:
1. Listar todos os registros com nome_referencia IS NOT NULL
2. Ler arquivo do filesystem legado
3. Upload para MinIO/S3 com key = nome_referencia
4. Atualizar URL no campo (ou manter nome e configurar base_url)
```
