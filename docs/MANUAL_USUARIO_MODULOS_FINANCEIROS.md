# Manual do utilizador — módulos financeiros (Infotime-web)

Este manual descreve **o que pode fazer no ecrã**, passo a passo, nos módulos financeiros recentes do Infotime-web: **Gestão integrada** (cockpit), **Contas a pagar** e **Contas a receber** quando acede a partir da área **Financeiro**.

> **Quem deve ler:** utilizadores finais (financeiro, administrativo, gestão).  
> **Pré-requisitos:** sessão iniciada no sistema e permissões de perfil adequadas (ver secção 6).

Para uma lista técnica de tabelas novas no banco de dados e rotas de API, veja também: `docs/FINANCEIRO_AVANCADO_GUIA_IMPLEMENTACAO.md`.

---

## 1. Como chegar ao Financeiro

1. Inicie sessão no Infotime-web (se a sessão expirar, será pedido o login de novo).
2. Na **área inicial (Home)**, abra o menu ou o atalho correspondente à **Gestão integrada** / módulo financeiro (conforme o menu que o seu administrador configurou).
3. Outra forma é aceder diretamente às rotas do navegador, por exemplo:
   - `/financeiro` — visão geral (Gestão integrada)
   - `/financeiro/pagar` — contas a pagar
   - `/financeiro/receber` — contas a receber

No topo das páginas sob `/financeiro` aparece uma **barra de navegação** com:

- **Início** — volta à Home.
- **Gestão integrada** — cockpit financeiro.
- **Contas a pagar** — despesas e fornecedores.
- **Contas a receber** — receitas e clientes.

O item ativo fica destacado.

---

## 2. Gestão integrada (cockpit)

É a página **“Visão geral financeira”**: resume o que está a **receber**, a **pagar** e o **fluxo** nos próximos dias, para apoiar decisões do dia a dia.

### 2.1 Cabeçalho e ações rápidas

- **Título:** “Gestão integrada”, com o mês e ano correntes indicados no subtítulo.
- **Período:** existe um campo **Período** (ex.: “Este mês”, “Últimos 30 dias”, “Este trimestre”). A interface está preparada para filtros; **os valores mostrados seguem as regras de cálculo atuais do servidor** até que filtros dinâmicos estejam totalmente ligados ao cockpit.
- **+ Nova receita** — só aparece se tiver permissão para **incluir** em Contas a receber. Abre o formulário de nova receita (no mesmo separador ou noutra rota, conforme o modo de navegação).
- **+ Nova despesa** — só aparece se tiver permissão para **incluir** em Contas a pagar. Abre o formulário de nova despesa.

Se os dados não carregarem, aparece uma mensagem de erro e o botão **Tentar novamente**.

### 2.2 Cartões de indicadores (KPI)

Quatro cartões principais mostram **valor total** e **quantidade** de lançamentos:

| Cartão | Significado | O que acontece ao clicar |
|--------|-------------|---------------------------|
| **A receber hoje** | Receitas com vencimento previsto para hoje (ainda não quitadas como previsto). | Abre a lista de **Contas a receber** filtrada a “vence hoje”. |
| **Receber em atraso** | Receitas em atraso. | Abre a lista de receber filtrada a “atrasado”. |
| **A pagar hoje** | Despesas com vencimento previsto para hoje (ainda não pagas como previsto). | Abre a lista de **Contas a pagar** filtrada a “vence hoje”. |
| **Pagar em atraso** | Despesas em atraso. | Abre a lista de pagar filtrada a “atrasado”. |

Há ainda o cartão **Saldo previsto 30d** (receber menos pagar, num horizonte de 30 dias). É informativo; não abre listagem ao clicar.

### 2.3 Gráfico “Fluxo previsto — próximos 14 dias”

Mostra, dia a dia, **entradas** e **saídas** previstas (com base nos lançamentos do sistema). Serve para antecipar picos ou falhas de caixa na próxima duas semanas.

### 2.4 “Distribuição por situação”

Resumo em quatro áreas:

- Pendentes a receber  
- Pendentes a pagar  
- Pagos / recebidos no mês corrente  
- Total em atraso (quantidade agregada)

Ajuda a ver de relance **onde está o peso** dos valores (pendente versus já liquidado no mês).

### 2.5 Listas compactas (“mini listas”)

Quatro blocos com os principais lançamentos:

- Receber — vence hoje  
- Receber — em atraso  
- Pagar — vence hoje  
- Pagar — em atraso  

Em cada bloco:

- **Ver todos** — abre a lista completa com o mesmo filtro (hoje ou atraso).
- **Clicar num lançamento** — abre o **detalhe / edição** desse lançamento (receita ou despesa).
- Se não houver itens, o sistema mostra uma mensagem do tipo “Nenhum lançamento para hoje” ou “Nenhum lançamento em atraso”.

Nas listas, valores em atraso podem mostrar **quantos dias** de atraso (por exemplo “3 dias”).

---

## 3. Contas a pagar (dentro do Financeiro)

1. Use o menu superior **Contas a pagar** ou aceda a `/financeiro/pagar`.
2. Utiliza o mesmo painel de listagem e formulários Liga que o resto do sistema, mas com **caminho base** `/financeiro/pagar` (URLs de edição e novo lançamento alinham-se com esta área).

### Filtros vindos do cockpit

Quando abre a lista a partir dos cartões do cockpit, o endereço pode incluir parâmetros:

- `?venceHoje=true` — mostra o foco em títulos que **vencem hoje**.
- `?atrasado=true` — mostra o foco em títulos **em atraso**.

Estes filtros ajudam a **trabalhar a lista** sem ter de configurar tudo manualmente.

---

## 4. Contas a receber (dentro do Financeiro)

1. Use **Contas a receber** ou aceda a `/financeiro/receber`.
2. Comportamento análogo ao das contas a pagar: painel Liga com base `/financeiro/receber`.

### Filtros vindos do cockpit

- `?venceHoje=true`  
- `?atrasado=true`  

Mesma ideia: lista já orientada para o que precisa de atenção **hoje** ou **em atraso**.

### Novo lançamento

- A partir do cockpit: **+ Nova receita** (se permitido).
- Ou navegue para `/financeiro/receber/novo` (conforme permissões e menu).

---

## 5. Gestão integrada na Home (modo abas)

Se o seu ambiente abrir a **Gestão integrada** dentro da Home (como **aba** ao lado de outras áreas), o comportamento é o mesmo em termos de **números e gráficos**, mas os botões “Nova receita”, “Nova despesa”, “Ver todos” e os cliques nas listas podem **abrir as listagens ou formulários noutra aba do painel** em vez de mudar só a URL `/financeiro/...`. O objetivo é não perder o contexto da Home.

---

## 6. Permissões (o que pode não ver)

- Sem sessão válida, ao tentar aceder ao Financeiro será redirecionado para o **login**.
- **+ Nova receita** só aparece com permissão de **incluir** em Contas a **receber**.
- **+ Nova despesa** só aparece com permissão de **incluir** em Contas a **pagar**.
- Consultas, edições e exclusões nas listas seguem o **perfil** configurado pelo administrador (Liga / Infotime).

Se precisar de um botão que não aparece, peça ao administrador que confira o seu **perfil de permissões**.

---

## 7. O que ainda não está neste manual de ecrã

Funcionalidades em preparação no **servidor** ou na **base de dados** (régua de cobrança, extrato, PIX, portal, contabilidade auxiliar, alertas, etc.) **podem ainda não ter ecrã próprio** nesta versão. Quando forem disponibilizadas no menu, acrescente-se um capítulo a este manual.

---

## 8. Resolução de problemas rápida

| Situação | O que fazer |
|----------|-------------|
| Ecrã em branco a carregar | Aguarde; se persistir, atualize a página ou confirme a rede. |
| “Não foi possível carregar os dados do cockpit” | Clique em **Tentar novamente**; se repetir, contacte o suporte (pode ser indisponibilidade da API ou da sessão). |
| Não consigo criar receita/despesa | Verifique permissões (secção 6). |
| Números não batem com o esperado | Confirme situação dos lançamentos (pago, parcial, vencimento) nos formulários; o cockpit usa as regras definidas no sistema. |

---

*Documento orientado ao estado atual das telas em `web/` (Gestão integrada, layout Financeiro, Contas a pagar/receber). Atualize quando novos menus ou assistentes forem entregues.*
