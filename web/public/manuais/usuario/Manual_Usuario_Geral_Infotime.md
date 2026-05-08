# Manual do Usuário — Infotime Web

**Sistema:** Infotime Web
**Público:** Usuários finais — operador, recepcionista, técnico, supervisor, financeiro, qualidade, auditor
**Foco:** "Como faço X na tela?"
**Versão:** 1.0 — Maio/2026

> Este manual é para **quem usa o Infotime Web no dia a dia** — para registrar pacientes, executar exames, armazenar amostras, gerar laudos, faturar. Aqui você não vai encontrar detalhes de banco de dados, código ou configuração de servidor — para isso, consulte os manuais Técnico e do Desenvolvedor. Aqui você encontra **como operar o sistema**.

---

## Sumário

### Parte 1 — Bem-vindo
1. [O que é o Infotime Web](#1-o-que-é-o-infotime-web)
2. [Como entrar no sistema (login)](#2-como-entrar-no-sistema-login)
3. [Conhecendo a tela principal](#3-conhecendo-a-tela-principal)
4. [Sair do sistema com segurança](#4-sair-do-sistema-com-segurança)

### Parte 2 — Navegando
5. [O menu lateral — onde tudo começa](#5-o-menu-lateral--onde-tudo-começa)
6. [Buscando uma tela rapidamente](#6-buscando-uma-tela-rapidamente)
7. [Trabalhando com várias telas ao mesmo tempo](#7-trabalhando-com-várias-telas-ao-mesmo-tempo)

### Parte 3 — Listagens (a tela mais comum)
8. [Como ler uma lista de registros](#8-como-ler-uma-lista-de-registros)
9. [Buscando registros](#9-buscando-registros)
10. [Filtrando por critérios específicos](#10-filtrando-por-critérios-específicos)
11. [Ordenando, mostrando e escondendo colunas](#11-ordenando-mostrando-e-escondendo-colunas)
12. [Navegando entre páginas](#12-navegando-entre-páginas)
13. [Exportando para Excel](#13-exportando-para-excel)
14. [Criar, editar, ações](#14-criar-editar-ações)

### Parte 4 — Formulários (criar e editar)
15. [Anatomia de um formulário](#15-anatomia-de-um-formulário)
16. [Como preencher cada tipo de campo](#16-como-preencher-cada-tipo-de-campo)
17. [Campos obrigatórios — quais não posso pular](#17-campos-obrigatórios--quais-não-posso-pular)
18. [Salvar, cancelar, perder mudanças](#18-salvar-cancelar-perder-mudanças)
19. [O que fazer quando algo dá erro](#19-o-que-fazer-quando-algo-dá-erro)

### Parte 5 — Os módulos disponíveis
20. [Cadastros — antes de começar a operar](#20-cadastros--antes-de-começar-a-operar)
21. [Soroteca — armazenamento de amostras](#21-soroteca--armazenamento-de-amostras)
22. [Outros módulos chegando em breve](#22-outros-módulos-chegando-em-breve)

### Parte 6 — Convivendo com o sistema
23. [Sua sessão e quanto tempo dura](#23-sua-sessão-e-quanto-tempo-dura)
24. [Por que algumas telas estão escondidas para mim](#24-por-que-algumas-telas-estão-escondidas-para-mim)
25. [Privacidade — você só vê dados do seu laboratório](#25-privacidade--você-só-vê-dados-do-seu-laboratório)

### Parte 7 — Dicas e ajuda
26. [Dicas para trabalhar mais rápido](#26-dicas-para-trabalhar-mais-rápido)
27. [Os erros mais comuns e o que fazer](#27-os-erros-mais-comuns-e-o-que-fazer)
28. [Quando e como pedir ajuda](#28-quando-e-como-pedir-ajuda)
29. [Glossário — palavras que você vai ouvir](#29-glossário--palavras-que-você-vai-ouvir)

---

# Parte 1 — Bem-vindo

## 1. O que é o Infotime Web

O **Infotime Web** é o sistema do seu laboratório de análises clínicas. Ele acompanha cada amostra desde a entrada do paciente na recepção até o descarte final, passando por coleta, processamento, liberação de resultado e armazenamento.

**O que você vai conseguir fazer aqui:**

- Cadastrar pacientes, médicos, exames, convênios
- Registrar atendimentos e pedidos de exame
- Programar coletas
- Acompanhar a produção de exames na bancada
- Liberar resultados e gerar laudos
- Armazenar amostras na soroteca com mapa visual
- Faturar, gerenciar contas, gerar relatórios
- Controlar qualidade e indicadores

**Quem usa o Infotime Web?** Todo mundo do laboratório, com cada perfil vendo o que faz sentido para sua função: recepcionista vê recepção, técnico vê bancada, financeiro vê contas, e assim por diante.

---

## 2. Como entrar no sistema (login)

### 2.1 Acessando

Abra seu navegador (Chrome, Firefox ou Edge — recomendados) e acesse o endereço do Infotime Web do seu laboratório. Geralmente é algo como `https://nomedolab.infolabweb.com.br` ou um endereço interno fornecido pelo seu administrador.

### 2.2 Tela de login

Você verá uma tela com:

- Campo **Usuário** (geralmente seu nome ou e-mail)
- Campo **Senha**
- Botão **Entrar**

Digite seus dados e clique em **Entrar**.

### 2.3 Primeira vez no sistema

Se for sua primeira vez, o administrador do laboratório te entrega usuário e senha provisória. Ao entrar pela primeira vez, o sistema pode pedir para **trocar a senha**. Escolha uma senha:

- Com pelo menos 8 caracteres
- Combinando letras, números e símbolos
- Que você consiga lembrar mas que não seja óbvia
- Diferente de senhas que você usa em outros sistemas

### 2.4 Esqueci minha senha

Clique em **"Esqueci a senha"** na tela de login. Siga as instruções (geralmente envia link por e-mail, ou pede para falar com o administrador).

### 2.5 Não consigo entrar

Se aparecer "Usuário ou senha inválidos":

- Confira se o **Caps Lock** não está ligado
- Confira se está digitando o usuário correto (sem espaços extras)
- Tente de novo — depois de várias tentativas erradas o sistema bloqueia por segurança
- Se bloqueado, fale com o administrador do laboratório

---

## 3. Conhecendo a tela principal

Depois do login, você vê a **tela principal**. Ela é dividida em três áreas:

```
┌─────────────────────────────────────────────────────────────────┐
│  [Logo] Infotime Web              Olá, João — Lab Central [Sair]│  ← topo
├──────────┬──────────────────────────────────────────────────────┤
│          │                                                      │
│   MENU   │   ÁREA DE TRABALHO                                   │
│          │   (a tela aberta — listagem, formulário, home...)    │
│          │                                                      │
│  Início  │                                                      │
│ Cadastros│                                                      │
│ Atendim. │                                                      │
│ Produção │                                                      │
│  ...     │                                                      │
│          │                                                      │
└──────────┴──────────────────────────────────────────────────────┘
```

### 3.1 Topo

Mostra o **logotipo**, seu **nome de usuário**, o **nome do seu laboratório**, e o botão **Sair**.

### 3.2 Menu lateral (esquerda)

A lista de módulos e telas que você pode acessar. **Cada usuário vê um menu diferente** — depende do seu perfil de permissão. Se algo não aparece, é porque seu perfil não permite.

### 3.3 Área de trabalho (centro)

É aqui que tudo acontece. Listas, formulários, mapas, tudo abre aqui.

### 3.4 Tela inicial (Home)

Quando você entra, abre a **Home** — uma tela com atalhos para os módulos que você mais usa. Para voltar para ela, clique no **logotipo** ou no item **Início** do menu.

---

## 4. Sair do sistema com segurança

### 4.1 Como sair

Clique no seu nome no canto superior direito e escolha **Sair** (ou clique direto no botão "Sair" no topo).

### 4.2 Por que sair sempre

- Sua senha protege seu acesso e suas ações ficam registradas no seu nome
- Se você sair do computador sem fechar a sessão, **outra pessoa pode usar com seu usuário** — e qualquer ação dela vai aparecer como sua na auditoria
- Em laboratórios de saúde, isso pode ter implicações legais

### 4.3 Bloqueio rápido

Se você só vai se ausentar por alguns minutos:

- **Windows:** pressione **Windows + L** para travar a tela
- **Mac:** pressione **Control + Command + Q**

Não precisa sair do sistema, só travar a tela do computador.

### 4.4 Sessão expirada automaticamente

Se você ficar **30 a 60 minutos sem usar** o sistema, ele vai pedir sua senha de novo automaticamente. É uma proteção contra esquecimento. Não se preocupe — **o que você estava preenchendo é mantido**.

---

# Parte 2 — Navegando

## 5. O menu lateral — onde tudo começa

O menu lateral é organizado em três níveis:

```
🏠 Início                      ← nível 1 (folha — abre direto)
📁 Cadastros                   ← nível 1 (pai — expande)
   └─ 📦 Soroteca              ← nível 2 (pai — expande)
      └─ 📋 Sala               ← nível 3 (folha — abre direto)
      └─ 📋 Equipamento
      └─ 📋 Caixa
   └─ 📋 Clientes              ← nível 2 (folha — abre direto)
🏥 Atendimento
🔬 Módulos
   └─ 📦 Soroteca
      └─ 📋 Grades
```

### 5.1 Como ler

- **Itens com seta ▶** são "pais" — clicar expande para mostrar os filhos
- **Itens sem seta** são "folhas" — clicar abre a tela
- **Ícones** ajudam a identificar visualmente cada item

### 5.2 Clicando para abrir

- Clique uma vez num **item-folha** → a tela abre na área de trabalho
- Clique num **item-pai** → ele se expande mostrando os filhos
- Clique de novo → ele se recolhe

### 5.3 Indicador de tela aberta

A tela que está aberta no momento aparece **destacada** no menu (geralmente em negrito ou com cor diferente).

---

## 6. Buscando uma tela rapidamente

Quando o menu tem muitos itens, encontrar rápido pode ser difícil. Use a **busca**.

### 6.1 Campo de busca

No topo do menu há um campo onde você digita parte do nome. Por exemplo, digitando "paciente":

```
🔍 paciente_____
   📋 Pacientes (em Cadastros)
   📋 Histórico do paciente (em Atendimento)
```

O menu mostra apenas os itens que correspondem. Clique em um deles para abrir.

### 6.2 Dicas de busca

- **Não precisa digitar o nome completo** — "exam" já encontra "Exames"
- **Não diferencia maiúsculas/minúsculas** — "EXAME", "exame", "Exame" funcionam igual
- **Ignora acentos** — "agua" encontra "Água"
- **Pressione Enter** para abrir o primeiro resultado

---

## 7. Trabalhando com várias telas ao mesmo tempo

Esta é uma das melhores funcionalidades do sistema — **você pode ter várias telas abertas em abas, igual ao seu navegador**.

### 7.1 Como funciona

Cada tela que você abre vira uma **aba** no topo da área de trabalho:

```
┌──────────────────────────────────────────────────────────────┐
│ [Pacientes] [Atendimentos] [Caixa BIOQ-001 ✕] [+]           │
├──────────────────────────────────────────────────────────────┤
│   conteúdo da aba ativa                                      │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

### 7.2 O que isso permite

- Estar consultando um paciente em uma aba e o atendimento dele em outra
- Abrir o mapa de uma caixa da soroteca enquanto procura informação em outra tela
- Trocar entre telas **sem perder o que estava preenchendo** — cada aba mantém seu estado
- Voltar para uma tela depois de sair sem precisar buscar de novo

### 7.3 Como usar

| Ação | Resultado |
|---|---|
| Clicar no item do menu | Abre nova aba (ou volta para aba já aberta) |
| Clicar no nome de uma aba | Traz aquela aba para frente |
| Clicar no **✕** da aba | Fecha aquela aba |
| Trocar entre abas | Mantém tudo o que você fez em cada uma |

### 7.4 Cuidado com excesso de abas

- **Mais de 10 abas abertas** começa a deixar tudo lento
- Feche o que você não está usando
- Se acabou de consultar algo, feche e abra de novo quando precisar

### 7.5 Quando você sai e volta

Se você sair do sistema (logout) e entrar de novo, **as abas não são restauradas**. Você começa do zero. Isso é proposital — evita carregar dezenas de telas ao iniciar.

---

# Parte 3 — Listagens (a tela mais comum)

A maioria das telas do Infotime Web são **listagens** — tabelas com vários registros, busca, filtros. Saber operar uma listagem é saber operar o sistema.

## 8. Como ler uma lista de registros

Toda listagem tem o mesmo formato:

```
┌─────────────────────────────────────────────────────────────────┐
│  📦 Pacientes                                          [+ Novo] │  ← título e botão
├─────────────────────────────────────────────────────────────────┤
│  [Pesquisar por: Nome ▼]  [_______ ]  [⚙ Colunas]  [📥 CSV]   │  ← controles
├─────────────────────────────────────────────────────────────────┤
│  Filtros ativos:  Status: Ativo ✕                              │  ← filtros
├─────────────────────────────────────────────────────────────────┤
│  ID │ Nome              │ CPF           │ Status   │ Ações     │
│ ────┼───────────────────┼───────────────┼──────────┼─────────  │
│  101│ João Silva        │ 123.456.789-00│ Ativo    │  [✏]      │
│  102│ Maria Souza       │ 987.654.321-11│ Ativo    │  [✏]      │
│  103│ Pedro Almeida     │ 111.222.333-44│ Inativo  │  [✏]      │
├─────────────────────────────────────────────────────────────────┤
│  Mostrando 1-3 de 247                       ◀ 1 2 3 ... 25 ▶  │  ← paginação
└─────────────────────────────────────────────────────────────────┘
```

### 8.1 Cada parte da listagem

- **Título** (canto superior esquerdo): nome da listagem (Pacientes, Exames, Caixas...)
- **Botão "Novo"** (canto superior direito): cria registro novo
- **Pesquisar por**: escolhe em qual campo fazer a busca rápida
- **Campo de busca**: onde você digita o que procura
- **Botão Colunas (⚙)**: mostra/esconde colunas da tabela
- **Botão Exportar (📥)**: baixa em CSV (Excel)
- **Filtros ativos**: mostra quais filtros estão aplicados
- **Tabela**: os registros propriamente ditos
- **Cabeçalhos clicáveis**: clicar ordena a tabela por aquela coluna
- **Coluna "Ações"** (✏): editar o registro daquela linha
- **Paginação**: mostra quantos registros tem e navega entre páginas

---

## 9. Buscando registros

A busca rápida é a forma mais rápida de encontrar um registro específico.

### 9.1 Como buscar

1. **Escolha em qual campo buscar** no dropdown "Pesquisar por". Exemplos: Nome, CPF, Código.
2. **Digite o termo** no campo ao lado.
3. **Pressione Enter**.

A busca procura no banco de dados (não só na tela), então funciona mesmo em listas com milhares de registros.

### 9.2 O que cada tipo de busca aceita

| Tipo de campo | Exemplo | Como você digita |
|---|---|---|
| **Nome / texto** | João Silva | "joão" ou "JOAO" — encontra qualquer coisa que contém |
| **CPF** | 123.456.789-00 | Pode digitar com ou sem pontos |
| **CNPJ** | 12.345.678/0001-90 | Idem |
| **Data** | 04/05/2026 | Aceita 04/05/2026, 04/05/26, 4/5/2026 |
| **Número / ID** | 101 | Número exato |
| **Telefone** | (11) 98765-4321 | Com ou sem máscara |

### 9.3 Trocando o campo de busca

Se você muda o campo escolhido no dropdown, **o que estava digitado é apagado**. Isso evita confusão (procurar texto num campo de número, por exemplo).

### 9.4 Termo destacado

Os resultados aparecem com **o termo destacado em amarelo** dentro das células — facilita ver onde casou.

### 9.5 Limpando

Para limpar a busca:

- Clique no **✕** dentro do campo
- Ou apague tudo e pressione **Enter**

---

## 10. Filtrando por critérios específicos

Se a busca rápida não basta (você quer combinar vários critérios), use o **filtro refinado**.

### 10.1 Onde fica

Há um botão de filtro (geralmente um **funil**) na barra de controles. Clicando, abre uma **barra lateral** com vários campos de filtro.

### 10.2 Tipos de filtro disponíveis

| Tipo | Como funciona | Exemplo |
|---|---|---|
| **Texto** | Contém | Descrição contém "soro" |
| **Número** | Igual a | ID = 101 |
| **Data** | Dia ou intervalo | Data de cadastro entre 01/01 e 31/12 |
| **Lista (enum)** | Seleção múltipla | Status = Ativo OU Pendente |

### 10.3 Como aplicar

1. **Abra a sidebar** clicando no funil
2. **Preencha os critérios** que quer aplicar
3. **O filtro é aplicado automaticamente** depois de uns 2 segundos
4. **A barra superior** mostra os filtros ativos como "tags"

### 10.4 Removendo filtros

- **Um por um**: clique no **✕** da tag correspondente
- **Todos de uma vez**: botão "Limpar filtros"

### 10.5 Combinando busca + filtros

Você pode usar **busca rápida + filtros refinados ao mesmo tempo**. Eles se combinam: a lista mostra apenas registros que casam com a busca **E** com todos os filtros.

---

## 11. Ordenando, mostrando e escondendo colunas

### 11.1 Ordenando por coluna

Clique no **cabeçalho** da coluna que quer ordenar:

- **1ª clique**: crescente (A→Z, mais antigo primeiro)
- **2ª clique**: decrescente (Z→A, mais novo primeiro)
- **3ª clique**: volta ao padrão

Uma seta (▲ ou ▼) aparece no cabeçalho indicando a direção.

### 11.2 Escondendo colunas

Algumas listagens têm muitas colunas. Para esconder as que você não usa:

1. Clique no botão **Colunas** (⚙)
2. Aparece uma lista de checkboxes — uma para cada coluna
3. **Desmarque** as que quer esconder
4. **Marque** as que quer mostrar de volta

A tabela atualiza imediatamente. **O que você esconde fica memorizado entre sessões** (geralmente).

### 11.3 Colunas que não dá para esconder

Algumas colunas são **obrigatórias** — não dá para esconder. Tipicamente: ID, nome principal, e ações. Aparecem na lista mas com checkbox desabilitado.

---

## 12. Navegando entre páginas

Listas grandes não mostram tudo de uma vez — vêm divididas em páginas.

### 12.1 Os controles

No rodapé da listagem:

```
Mostrando 1-10 de 1.247 registros          ◀ 1 2 3 4 5 ... 125 ▶
```

- **Mostrando X-Y de Z**: faixa atual e total
- **◀ ▶**: página anterior / próxima
- **Números**: ir direto para uma página específica

### 12.2 Quantos registros por página

No canto há um seletor — geralmente com opções **5, 10, 20, 50**.

**Sugestão:** comece com **10** (padrão). Se você está acostumado com listas longas e tem máquina boa, suba para **20 ou 50**. Se está com lentidão, fique em **5 ou 10**.

---

## 13. Exportando para Excel

Para gerar relatórios ou ter os dados num arquivo separado, exporte para CSV.

### 13.1 Como exportar

1. **Aplique os filtros e busca** que quer (a exportação respeita o que está filtrado)
2. **Esconda colunas** que você não quer exportar
3. Clique em **Exportar** (botão 📥)
4. Escolha **CSV**
5. O navegador baixa um arquivo `.csv`

### 13.2 Abrindo o arquivo

- **Excel**: clique duas vezes — abre direto
- **LibreOffice Calc**: idem
- **Google Sheets**: arraste para a aba do Sheets

### 13.3 PDF não está disponível

A opção "Exportar PDF" aparece no menu mas está **desabilitada** ainda — vai chegar em uma próxima versão.

### 13.4 Cuidado com dados sensíveis

> ⚠️ Arquivos CSV exportados podem conter **dados sensíveis** (CPF, prontuário, telefone). Trate como informação confidencial:
>
> - Não compartilhe por WhatsApp, e-mail pessoal, redes sociais
> - Apague do computador depois de usar
> - Se for guardar, criptografe ou guarde em pasta segura
> - **A LGPD se aplica** — você responde se vazar

---

## 14. Criar, editar, ações

### 14.1 Botão "Novo"

No canto superior direito da listagem fica o botão **"Novo"** (ou "+ Novo paciente", "+ Novo exame", varia).

Clicando, abre um **formulário vazio** para criar um registro do zero. Veja a Parte 4 deste manual sobre como preencher formulários.

### 14.2 Botão "Novo" desabilitado (cinza)

Significa que você **não pode criar agora**. Possíveis motivos:

- Você não tem permissão para criar (perfil só de leitura)
- A tela é apenas de consulta (log, auditoria)
- Falta cadastrar algo antes (pré-condição)

Passar o mouse por cima geralmente mostra a explicação.

### 14.3 Editar um registro existente

Cada linha da tabela tem um botão de **editar** (geralmente ✏ ou três pontinhos) na coluna de ações. Clicando:

- O formulário abre **com os dados preenchidos** do registro
- Você muda o que precisa
- Clica em **Salvar**

### 14.4 Mais ações

Em algumas linhas há menu com mais opções:

- **Visualizar**: abrir só leitura, sem editar
- **Duplicar**: criar registro novo já preenchido com os dados deste
- **Inativar**: marcar como inativo (sem apagar)
- **Excluir**: apagar (só funciona quando não há outros registros vinculados)
- **Histórico**: ver alterações no registro

---

# Parte 4 — Formulários (criar e editar)

## 15. Anatomia de um formulário

Quando você clica em "Novo" ou em "Editar", abre um **formulário**:

```
┌─────────────────────────────────────────────────────────────────┐
│  📝 Novo paciente                                               │
│  Cadastre os dados do paciente para atendimento.                │
├──────────────────┬──────────────────────────────────────────────┤
│                  │                                              │
│  Seções          │  Dados pessoais                              │
│                  │  ─────────────                               │
│  • Dados ✓       │  Nome*  [________________]                   │
│  • Contato       │  CPF*   [___________]   Sexo  [▼]            │
│  • Endereço      │  Nasc.  [DD/MM/AAAA 📅]                      │
│                  │                                              │
│                  │  Contato                                     │
│                  │  ─────────────                               │
│                  │  E-mail [________________________]           │
│                  │  Telefone [_______________]                  │
│                  │                                              │
├──────────────────┴──────────────────────────────────────────────┤
│  ⚠ Mensagens de erro                  [Cancelar]  [Salvar]     │
└─────────────────────────────────────────────────────────────────┘
```

### 15.1 As partes

- **Título** ("Novo paciente" ou "Editar paciente"): identifica a operação
- **Subtítulo**: contexto adicional, instruções
- **Sidebar de seções**: lista clicável das seções
- **Conteúdo**: os campos propriamente ditos
- **Marcação ✓** na sidebar: seções já com algo preenchido
- **Mensagens de erro**: aparecem se você tenta salvar com problema
- **Cancelar**: sair sem salvar
- **Salvar**: confirmar a operação

### 15.2 Navegando entre seções

Em formulários grandes (com várias seções), você pode:

- **Clicar na sidebar** — vai direto para a seção
- **Rolar a tela** — todas as seções aparecem em sequência
- **Tab** no teclado — passa para o próximo campo

---

## 16. Como preencher cada tipo de campo

O Infotime Web usa nove tipos diferentes de campo. Reconhecer cada um agiliza o preenchimento.

### 16.1 Campo de texto

```
Nome:  [_________________________]
```

Aceita letras, números, espaços, acentos. Tem um **tamanho máximo** — se você passa, o sistema avisa.

### 16.2 E-mail

```
E-mail:  [_________________________]
```

Igual a texto, mas o sistema valida o formato `nome@dominio.tld`. Se está errado, aparece em vermelho ao tentar salvar.

### 16.3 Senha

```
Senha:  [●●●●●●●●●●]
```

Mascarado durante a digitação. Pode ter ícone de "olho" para revelar temporariamente.

### 16.4 Número

```
Idade:  [_____]
```

Aceita só dígitos. Pode ter botões ▲▼ para incrementar.

### 16.5 Data

```
Nascimento:  [04/05/2026 📅]
```

Aceita digitação direta no formato **DD/MM/AAAA**. O ícone 📅 abre um seletor visual com calendário.

Em alguns casos, também pede a hora: **DD/MM/AAAA HH:MM**.

### 16.6 Texto longo (textarea)

```
Observações:
┌─────────────────────────────────┐
│                                 │
│                                 │
└─────────────────────────────────┘
```

Caixa multilinha. Use para descrições, observações, notas longas. Algumas têm limite de caracteres mostrado no canto.

### 16.7 Lista (select)

```
Estado civil:  [Selecione... ▼]
```

Clique para abrir, escolha uma opção. Algumas listas permitem **múltipla seleção** (você marca várias).

> **Dica:** muitas listas permitem **digitar para filtrar** — se há 100 médicos cadastrados, digitar "silva" mostra só os Silva.

### 16.8 Caixa de seleção (checkbox)

```
☑ Aceito os termos
☐ Receber e-mails promocionais
```

Marcado = sim, desmarcado = não. Vários checkboxes podem aparecer juntos.

### 16.9 Switch "Ativo"

```
Ativo:  [●━━━━]  Sim
```

Um interruptor visual para campos que são "Sim ou Não", "Ativo ou Inativo". Mais visível que checkbox.

### 16.10 Somente leitura

```
ID:  4827
Criado em:  04/05/2026 14:32
```

Campo cinza ou apagado — você vê mas **não pode editar**. Geralmente são IDs gerados pelo sistema, datas automáticas, ou dados que vieram de outro lugar.

---

## 17. Campos obrigatórios — quais não posso pular

### 17.1 Marcação visual

| Marca | Significa |
|---|---|
| **Asterisco vermelho** `*` no rótulo | Obrigatório — não dá para salvar sem |
| Sem marcação | Opcional — pode deixar em branco |
| Cinza/desabilitado | Somente leitura — você não preenche |
| Cadeado 🔒 | Tenant — preenchido automaticamente |

### 17.2 Validação enquanto você digita

Alguns campos avisam **na hora**:

- CPF errado → fica vermelho mesmo antes de salvar
- E-mail sem `@` → fica vermelho
- Texto passou do tamanho → não deixa digitar mais

### 17.3 Validação ao salvar

Outras validações só rodam **ao clicar em Salvar**:

- Campos obrigatórios vazios
- Combinações inválidas (data fim antes da inicial)
- Códigos repetidos (já existe no laboratório)

Se há erro, **o formulário rola até o primeiro problema** e coloca o cursor lá. Corrija e tente salvar de novo.

### 17.4 Campos que mudam outros

Alguns campos **preenchem outros automaticamente**:

- Escolheu o convênio → tabela de preço aparece
- Digitou o CPF → busca paciente existente
- Escolheu o tipo do equipamento → faixa de temperatura aparece

Não estranhe — é comportamento normal e ajuda a evitar erro.

---

## 18. Salvar, cancelar, perder mudanças

### 18.1 Botão Salvar

Clicar em **Salvar**:

1. Sistema valida tudo
2. Se está OK, salva e mostra mensagem verde "Salvo com sucesso"
3. Geralmente volta para a listagem
4. O novo registro aparece na lista

Se não está OK, mostra os erros e você corrige.

### 18.2 Botão Cancelar

Clicar em **Cancelar**:

- Se você **modificou** algo: pede confirmação ("Descartar alterações?")
- Se **não modificou**: fecha imediatamente
- Volta para a listagem **sem salvar**

### 18.3 Saindo sem clicar em nada

Se você fechar a aba ou clicar em outra tela com o formulário sujo:

- Algumas telas avisam "Sair sem salvar?"
- Outras simplesmente perdem o que você digitou

> **Sempre clique em Cancelar explicitamente** quando não quiser salvar. Evita ambiguidade e perda de dados.

### 18.4 Após salvar

- Aparece **toast verde** ("Salvo com sucesso") no canto superior
- Volta para a listagem
- Você pode imediatamente continuar com outro registro

---

## 19. O que fazer quando algo dá erro

### 19.1 Erros aparecem em vermelho

Erros aparecem **abaixo do campo** com problema, em vermelho. Exemplo:

```
CPF*  [123.456.789-00]
      ⚠ CPF inválido — confira os dígitos
```

### 19.2 Tipos de erro

| Erro | O que fazer |
|---|---|
| "Campo obrigatório" | Preencha o campo |
| "CPF inválido" | Confira os dígitos |
| "Código já existe" | Use um código diferente |
| "Data inválida" | Use o formato DD/MM/AAAA |
| "Não é possível excluir — registro em uso" | Inative em vez de excluir |
| "Sessão expirada" | Faça login de novo (no diálogo que aparece) |
| "Erro ao salvar — tente novamente" | Espera e tenta de novo |
| "Reporte ao suporte" | Abra chamado |

### 19.3 Sessão expirou no meio do preenchimento

Não se preocupe — os dados que você digitou **são preservados**. Aparece um diálogo pedindo login, você loga, e pode salvar normalmente.

### 19.4 Erro estranho que não entendi

- **Tire foto da tela**
- **Anote o que estava fazendo**
- **Anote a mensagem completa**
- **Abra chamado** com o suporte

---

# Parte 5 — Os módulos disponíveis

## 20. Cadastros — antes de começar a operar

Antes de começar a registrar atendimentos, é preciso ter os **cadastros básicos** prontos: pacientes, médicos, exames, convênios, etc.

### 20.1 O que cadastrar

| Cadastro | Para que serve |
|---|---|
| **Clientes / Pacientes** | Vincular cada atendimento a uma pessoa |
| **Médicos solicitantes** | Vincular cada pedido ao médico que pediu |
| **Convênios** | Saber quem paga cada exame |
| **Exames** | Catálogo do que o laboratório oferece |
| **Materiais** | Soro, plasma, urina, etc. |
| **Especialidades, CID, CBO** | Códigos padronizados |

### 20.2 Quem cadastra o quê

- **Recepcionista** cadastra pacientes
- **Supervisor / administrador** cadastra exames, convênios, médicos, equipamentos
- **TI** configura usuários, perfis, permissões

### 20.3 Boas práticas

- Padronize **códigos** desde o início (ex.: `PAC-2026-001`, `EX-HEMA-001`)
- Não apague registros — **inative** (preserva histórico)
- Documente os cadastros estruturais para a equipe entender

---

## 21. Soroteca — armazenamento de amostras

A **Soroteca** é o módulo já em produção completa. Cobre tudo que envolve guardar amostras depois do processamento.

### 21.1 Acesso

```
Menu → Módulos → Soroteca → Grades
```

### 21.2 O que dá para fazer

- Criar e visualizar caixas com mapa colorido
- Armazenar e retirar amostras com scanner
- Configurar regras de retenção
- Bloquear amostras (judicial, técnico, qualidade)
- Descartar em lote com manifesto
- Registrar temperatura e tratar excursões
- Auditar tudo com hash de custódia

### 21.3 Manual específico

Para detalhes, há um **manual dedicado da Soroteca** (`Manual_Usuario_Soroteca.md`) com 28 seções cobrindo cada fluxo.

---

## 22. Outros módulos chegando em breve

| Módulo | Status | O que vai cobrir |
|---|---|---|
| **Recepção** | Em desenvolvimento | Atendimento, pedido, etiquetas, autorizações |
| **Coleta** | Em desenvolvimento | Programação, execução, recoleta |
| **Produção** | Em desenvolvimento | Bancada, equipamentos, worklist |
| **Resultados** | Em desenvolvimento | Validação técnica, laudos, liberação |
| **Qualidade** | Parcial | CQ interno, CQ externo, NCs, indicadores |
| **Financeiro** | Em desenvolvimento | Faturamento, contas, glosas, NFS-e |

> **A boa notícia:** todos esses módulos vão funcionar **igual** ao que você já conhece — listagens, formulários, busca, filtros, abas. Só muda o conteúdo (regras de negócio específicas), não a forma.

---

# Parte 6 — Convivendo com o sistema

## 23. Sua sessão e quanto tempo dura

### 23.1 Login = sessão

Quando você faz login, o sistema cria uma **sessão**. Ela é o que mantém você "logado" enquanto usa.

### 23.2 Quando expira

- **Por inatividade**: 30 a 60 minutos sem usar (configurável pelo seu laboratório)
- **Por tempo absoluto**: 8 a 12 horas, mesmo que você esteja usando

Quando expira:

- Diálogo aparece pedindo a senha de novo
- Você redigita
- **Continua de onde parou** — nada perdido

### 23.3 Várias máquinas

Você **pode** estar logado em mais de um computador ao mesmo tempo (ex.: bancada e mesa). Cada sessão é independente.

> **Mas não compartilhe seu acesso.** Tudo o que acontece com seu usuário fica registrado **no seu nome** na auditoria. Se outra pessoa usar e fizer algo errado, aparece como você.

---

## 24. Por que algumas telas estão escondidas para mim

### 24.1 Permissões por perfil

Cada usuário pertence a um **grupo** (ou mais), e cada grupo tem permissões específicas. Se uma tela não aparece no seu menu, é porque seu grupo não tem permissão.

### 24.2 Perfis típicos

| Perfil | O que vê tipicamente |
|---|---|
| **Administrador** | Tudo |
| **Supervisor** | Tudo da operação + configurações |
| **Operador** | Telas operacionais do dia a dia |
| **Recepcionista** | Atendimento, pacientes, agendamento |
| **Técnico** | Bancada, exames, resultados |
| **Auditor** | Apenas leitura, nas telas relevantes |
| **Financeiro** | Faturamento, contas, glosas |

### 24.3 Quero acesso a algo que não tenho

1. Justifique com seu supervisor por que precisa
2. Ele autoriza ou pede ao administrador
3. Administrador ajusta seu grupo

---

## 25. Privacidade — você só vê dados do seu laboratório

### 25.1 Multi-tenant

O Infotime Web é um sistema **multi-tenant**: vários laboratórios usam a mesma plataforma, mas cada um vê **apenas os próprios dados**.

### 25.2 O que isso significa

- **Você nunca vê** dados de outros laboratórios — nem por engano
- **Códigos podem repetir** entre laboratórios (cada um tem o seu `BIOQ-001`)
- **Cadastros são separados** — você cria, edita, exclui só os seus

### 25.3 Catálogos compartilhados

Algumas tabelas são **globais** — iguais para todos os laboratórios. Tipicamente:

- CID (Classificação Internacional de Doenças)
- CBO (Classificação Brasileira de Ocupações)
- Conselhos regionais (CRM, COREN, CRBM)
- Especialidades médicas

Esses cadastros são gerenciados pela equipe central do Infotime Web — você só consulta.

---

# Parte 7 — Dicas e ajuda

## 26. Dicas para trabalhar mais rápido

### 26.1 Atalhos universais de teclado

| Tecla | Ação |
|---|---|
| **Enter** (no campo de busca) | Executa a busca |
| **Esc** | Fecha menu, diálogo, ou cancela |
| **Tab** | Próximo campo do formulário |
| **Shift + Tab** | Campo anterior |
| **F5** | Recarrega a tela atual |

### 26.2 Dicas de produtividade

- **Mantenha menos de 10 abas abertas** — performance e organização
- **Use o filtro refinado** em vez de várias buscas — mais rápido e preciso
- **Configure colunas visíveis** uma vez — fica memorizado
- **Use a busca do menu** em vez de navegar pelo menu — encontra mais rápido
- **Códigos curtos e padronizados** — facilitam encontrar depois

### 26.3 Em laboratórios

- **Leitor de barcode**: mantenha conectado e em foco quando for bipar
- **Etiqueta tem que ser legível** — tubo com etiqueta dobrada/ilegível atrasa tudo
- **Bipe sempre, não digite** — evita erro humano
- **Confira a tela** após cada bip — se não atualizou, algo está errado

### 26.4 Privacidade pessoal

- **Bloqueie a tela** ao se afastar (Windows + L)
- **Saia do sistema** ao final do turno
- **Não compartilhe senha** com ninguém, nunca
- **CSV exportado** tem dados sensíveis — proteja

---

## 27. Os erros mais comuns e o que fazer

### 27.1 No login

| Mensagem | Solução |
|---|---|
| "Usuário ou senha inválidos" | Confira Caps Lock, espaços extras, senha. Se persistir, fale com admin |
| "Usuário bloqueado" | Muitas tentativas erradas. Admin desbloqueia |
| "Sessão expirada" | Faça login de novo |

### 27.2 Em listagens

| Mensagem | Solução |
|---|---|
| "Nenhum registro encontrado" | Limpe filtros, verifique busca |
| "Erro ao carregar dados" | Aguarde, tente F5 |
| "Acesso negado" | Sua permissão não inclui — peça supervisor |

### 27.3 Em formulários

| Mensagem | Solução |
|---|---|
| "Campo obrigatório" | Preencha campo com asterisco |
| "Código já existe" | Use outro código |
| "CPF inválido" | Confira os dígitos |
| "Não é possível excluir — registro em uso" | Inative no lugar de excluir |
| "Erro ao salvar — tente novamente" | Aguarde, tente de novo |

### 27.4 Genéricas

| Mensagem | Significa |
|---|---|
| "Reporte ao suporte" | Erro técnico, abra chamado |
| "Você não tem permissão para essa ação" | Falta perfil — peça supervisor |
| "Recurso somente leitura" | Tela só de consulta |

---

## 28. Quando e como pedir ajuda

### 28.1 Antes de pedir

Verifique:

- ✅ Está na tela certa
- ✅ Sua sessão está ativa (não expirou)
- ✅ Você tem permissão (botão habilitado?)
- ✅ Releu a mensagem de erro
- ✅ Recarregou a página (F5)
- ✅ Consultou este manual

### 28.2 Quando pedir ajuda

- Erros com "Reporte ao suporte"
- Telas em branco ou erro 500
- Comportamento diferente do que está neste manual
- Pedidos de cadastro estrutural (tipo novo, motivo novo)
- Pedidos de relatório customizado
- Sugestões de melhoria

### 28.3 Como pedir

Ao abrir chamado, informe:

- **Seu usuário**
- **Nome do laboratório**
- **Tela exata** (caminho do menu)
- **Mensagem de erro completa** (foto ajuda)
- **O que estava fazendo** quando aconteceu
- **Hora aproximada** do problema
- **Navegador** (Chrome, Firefox, Edge — versão se possível)

### 28.4 Canais

- Chamado interno do laboratório
- E-mail do administrador local
- Telefone do help desk em horário comercial
- (Em emergência) telefone de plantão da TI

---

## 29. Glossário — palavras que você vai ouvir

| Termo | Significa |
|---|---|
| **Aba** | Cada tela aberta no sistema; várias podem coexistir |
| **Atendimento** | Pedido de exames de um paciente — o "ticket" da recepção |
| **Auditoria** | Registro de quem fez o quê, quando, de onde — automático |
| **Bipar** | Ler com leitor de código de barras |
| **Cadastro** | Tela onde você cria/edita registros estruturais |
| **Catálogo** | Tabela com valores predefinidos (tipos, motivos, status) |
| **Coleta** | Etapa de obter a amostra do paciente |
| **Convênio** | Plano de saúde que paga o exame |
| **CSV** | Formato de exportação que abre em Excel |
| **Filtro refinado** | Sidebar de filtros combinados |
| **Formulário** | Tela com campos para criar/editar |
| **Gloss / glosa** | Quando o convênio recusa pagamento de algum exame |
| **Home** | Tela inicial do sistema |
| **Laudo** | Resultado final do exame, em formato impresso ou PDF |
| **LGPD** | Lei Geral de Proteção de Dados — proteção de dados pessoais |
| **Lista / listagem** | Tela com tabela de registros |
| **Login / logoff** | Entrar / sair do sistema |
| **Multi-tenant** | Vários laboratórios na mesma plataforma, isolados |
| **NFS-e** | Nota fiscal eletrônica de serviço |
| **Perfil / permissão** | Define o que você pode acessar |
| **Recoleta** | Coletar amostra de novo (porque a primeira teve problema) |
| **Sessão** | Período em que você está logado |
| **Soroteca** | Local onde se guardam amostras após processamento |
| **TISS** | Padrão de troca de informações com convênios (TISS/TUSS) |
| **Toast** | Notificação que aparece e some sozinha |

---

## Histórico

| Versão | Data | Resumo |
|---|---|---|
| 1.0 | Maio/2026 | Versão inicial. Manual operacional para usuários finais. |

---

> **Próxima revisão:** quando módulos adicionais (Recepção, Produção, Resultados, etc.) entrarem em produção, este manual será atualizado para refletir as novas telas. A mecânica geral (listagens, formulários, menu, abas) permanece igual — só os fluxos específicos mudam.

*Em divergência entre este manual e o sistema, prevalece o sistema. Reporte ao suporte qualquer divergência percebida.*
