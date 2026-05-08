# Contexto – Domínio de Usuário (Cadastro e Senha)

## Objetivo

O domínio **usuario** define as regras de cadastro e manutenção de usuários do sistema Infotime, com foco em:

- Garantir que todo usuário esteja associado a uma unidade e a um grupo de usuários.
- Garantir que todo usuário possua login e senha válidos.
- Controlar quem pode alterar a senha de outro usuário.
- Definir como o próprio usuário pode alterar sua senha com segurança.

Este domínio fornece a base de regras para APIs e UIs que manipulam usuários (cadastro, edição, troca de senha).

## Entidades envolvidas

### Usuário

Representa uma conta de acesso ao sistema. Tabela física: `usuario` (Prisma: `infotime_usuario`).

Campos relevantes (nomes podem variar na implementação):

- `id_usuario`
- `login` – identificador de acesso (único por Tenacidade).
- `senha_hash` – senha armazenada de forma segura (hash/salt).
- `id_unidade` – unidade à qual o usuário está vinculado.
- `id_grupo_usuario` – grupo de permissão ao qual o usuário pertence (ex.: Administrador, Atendimento, Faturamento).
- Dados pessoais (nome, email, etc.).
- Flags de status (ativo/inativo, bloqueado, etc.).

### Unidade

Representa uma unidade física/organizacional (ex.: unidade de atendimento) à qual o usuário está associado.

### Grupo de Usuário

Representa um agrupamento de permissões (role) para controle de acesso:

- Exemplo: Administrador, Suporte, Implantação, Atendente, Faturamento etc.
- Em especial, o **grupo Administrador** possui privilégios ampliados, inclusive para gerenciar senhas de outros usuários (dentro das regras definidas).

## Fluxos principais relacionados a senha

### Cadastro de novo usuário

- Exige:
  - Unidade associada.
  - Grupo de usuário associado.
  - Login.
  - Senha inicial válida (que atenda aos requisitos mínimos definidos pela API/política de senha).

### Alteração de senha pelo próprio usuário

- O usuário só pode alterar sua própria senha se:
  - Informar corretamente a **senha atual**.
  - Informar uma nova senha que atenda aos requisitos mínimos estabelecidos pela API (comprimento, complexidade etc.).

### Alteração de senha por administrador / suporte

Existem dois fluxos distintos para alteração de senha de outros usuários:

- **Administrador** (grupo Administrador):
  - Pode alterar a senha de outros usuários, de forma controlada.
  - A alteração deve pedir a **senha do próprio administrador** como confirmação.

- **Suporte e Implantação**:
  - Possuem poderes equivalentes ao administrador para alteração de senha de outros usuários.
  - A alteração deve ser confirmada com uma **"senha do dia"**, gerada/validada pela API, e não com a senha pessoal do usuário de suporte/implantação.

Essas operações são usadas, por exemplo, em casos de reset de senha ou suporte.

As regras detalhadas de quem pode alterar o quê e quais validações devem ser feitas estão descritas em `Rules.md`.

## Cadastro na web (formulário padrão)

- A tela `web/src/app/usuario/formulario-cadastro/page.tsx` usa `LigaFormularioCadastroBase` + `useCadastroFormulario`, como os demais cadastros.
- Validação no cliente (unidade, grupo, login, senha na inclusão etc.) deve seguir as regras deste domínio (`ai/domains/usuario`); **foco e rolagem** até o primeiro campo inválido seguem o padrão global em `ai/domains/padroes-ui` (regra geral de ordem do layout, `data-campo-chave` em lookups customizados, troca de seção na sidebar).

## Papel da API de senha

A API que implementa este domínio pode definir:

- Requisitos mínimos de senha (tamanho mínimo, complexidade, histórico de senhas etc.).
- Política de bloqueio após tentativas incorretas.
- Regras de expiração de senha, se existirem.

O domínio **usuario** não dita esses detalhes finos (como "mínimo 8 caracteres, uma maiúscula"), mas garante que:

- Nenhuma senha seja aceita se a API indicar que não atende ao requisito mínimo.
- Para troca de senha pelo próprio usuário, a senha antiga seja validada antes de aceitar a nova.
