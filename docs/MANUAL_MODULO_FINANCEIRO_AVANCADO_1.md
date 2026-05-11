# Manual do Módulo Financeiro Avançado
## Infotime Web — Guia completo para gestores e operadores

> **Versão:** 1.0 — maio de 2026  
> **Público-alvo:** Gestores financeiros, coordenadores administrativos e operadores do sistema  
> **Pré-requisito:** Acesso ao módulo Financeiro com as permissões correspondentes a cada funcionalidade

---

## Como usar este manual

Este manual apresenta cada nova funcionalidade do módulo financeiro de forma prática: o que é, para que serve, como acessar, como usar passo a passo e o que você vai ganhar com isso. Não é necessário conhecimento técnico — se você sabe usar o sistema atual, consegue usar tudo que está aqui.

---

## Índice

1. [Gestão integrada — o painel central](#1-gestão-integrada--o-painel-central)
2. [Aging de recebíveis — envelhecimento da carteira](#2-aging-de-recebíveis--envelhecimento-da-carteira)
3. [DRE — resultado do mês em tempo real](#3-dre--resultado-do-mês-em-tempo-real)
4. [Régua de cobrança automática](#4-régua-de-cobrança-automática)
5. [Margem por convênio e custo por exame](#5-margem-por-convênio-e-custo-por-exame)
6. [Score de inadimplência](#6-score-de-inadimplência)
7. [Conciliação bancária](#7-conciliação-bancária)
8. [PIX integrado](#8-pix-integrado)
9. [Portal do convênio](#9-portal-do-convênio)
10. [Balanço patrimonial](#10-balanço-patrimonial)
11. [DFC — Demonstrativo de Fluxo de Caixa](#11-dfc--demonstrativo-de-fluxo-de-caixa)
12. [Visão consolidada multi-unidade](#12-visão-consolidada-multi-unidade)
13. [Previsão de caixa com inteligência artificial](#13-previsão-de-caixa-com-inteligência-artificial)
14. [Detecção de anomalias](#14-detecção-de-anomalias)
15. [Assistente financeiro IA](#15-assistente-financeiro-ia)
16. [Perguntas frequentes](#16-perguntas-frequentes)

---

## 1. Gestão integrada — o painel central

### O que é

A **Gestão integrada** é a tela de entrada do módulo financeiro. Em vez de ir direto para uma lista de lançamentos, você chega primeiro num painel visual que mostra a situação financeira do laboratório num relance — sem precisar abrir relatório nenhum.

### Para que serve

- Ver de imediato o que vence hoje e o que está em atraso
- Entender o fluxo de caixa dos próximos 14 dias
- Identificar qual convênio ou fornecedor merece atenção urgente
- Navegar rapidamente para a lista certa com os filtros já aplicados

### Como acessar

No menu lateral esquerdo: **Financeiro → Gestão integrada**

### O que você vê na tela

```
┌─────────────────────────────────────────────────────────────────┐
│  A receber hoje   Receber em atraso   A pagar hoje   Em atraso  │
│  R$ 53.156        R$ 4.985.008        R$ 103.542     R$ 1.537k  │
│  24 lançamentos   1.930 lançamentos   15 lançamentos 794 lanç.  │
└─────────────────────────────────────────────────────────────────┘
│  Fluxo previsto — próximos 14 dias  │  Distribuição por situação│
│  [gráfico de barras verde/vermelho]  │  [contadores por status]  │
├─────────────────────────────────────┴──────────────────────────┤
│  Receber hoje (lista)  │  Receber em atraso (lista)            │
│  Pagar hoje (lista)    │  Pagar em atraso (lista)              │
└────────────────────────────────────────────────────────────────┘
```

**Os 5 cards de KPI no topo:**

| Card | O que mostra |
|---|---|
| **A receber hoje** | Soma e quantidade dos lançamentos com vencimento hoje ainda não recebidos |
| **Receber em atraso** | Soma e quantidade de tudo vencido e ainda pendente |
| **A pagar hoje** | Soma e quantidade das despesas que vencem hoje |
| **Pagar em atraso** | Despesas vencidas e não pagas |
| **Saldo previsto 30d** | Estimativa: o que vai entrar nos próximos 30 dias menos o que vai sair |

**O gráfico de fluxo:**  
Barras lado a lado para cada dia dos próximos 14 dias. Verde = entradas previstas. Vermelho = saídas previstas. Permite ver de imediato em quais dias o caixa fica apertado.

**As mini-listas:**  
Cada quadrante mostra os 5 lançamentos mais urgentes. Clicar numa linha abre o formulário daquele lançamento. O botão "Ver todos" abre a lista completa já filtrada.

### Dica de uso

> Se você começar o dia pela Gestão integrada, vai saber em 30 segundos o que precisa de atenção — sem abrir nenhum relatório.

---

## 2. Aging de recebíveis — envelhecimento da carteira

### O que é

O **aging** (termo do inglês que significa "envelhecimento") mostra há quanto tempo os seus recebíveis estão em aberto. Em vez de ver só o total de atraso, você vê a distribuição em faixas de tempo.

### Para que serve

Imagine que você tem R$ 500.000 em atraso. Isso pode significar coisas muito diferentes:
- Situação controlável: quase tudo venceu há menos de 30 dias e clientes normalmente pagam
- Situação crítica: metade venceu há mais de 90 dias e provavelmente virou perda

O aging te mostra exatamente em qual situação você está.

### Como acessar

**Financeiro → Gestão integrada → aba "Aging"**

### Como interpretar

```
Faixa          Valor em aberto   Qtd.   % da carteira
─────────────────────────────────────────────────────
Corrente       R$ 120.000        89     24%
1 – 30 dias    R$  85.000        47     17%
31 – 60 dias   R$  62.000        38     12%
61 – 90 dias   R$  40.000        21      8%
Acima de 90d   R$ 193.000        31     39%  ⚠️
─────────────────────────────────────────────────────
TOTAL          R$ 500.000       226    100%
```

O gráfico de barras colorido permite ver a proporção instantaneamente:
- **Verde** = corrente (ainda não venceu)
- **Amarelo** = 1–30 dias
- **Laranja** = 31–60 dias
- **Vermelho** = 61–90 dias
- **Vermelho escuro** = acima de 90 dias

### O que fazer com essa informação

1. **Clique em qualquer barra** → abre a lista dos lançamentos daquela faixa já filtrada
2. **Selecione os lançamentos** → use as ações em lote para enviar cobrança, gerar PIX ou dar baixa
3. **Monitore semanalmente** → o painel mostra a evolução mensal dos últimos 6 meses, para você ver se a carteira está melhorando ou piorando

### Sinal de alerta

> Se a faixa "Acima de 90 dias" ultrapassar 30% da sua carteira, é hora de revisar a política de crédito dos convênios e acionar cobrança especializada.

---

## 3. DRE — resultado do mês em tempo real

### O que é

A **DRE (Demonstrativo de Resultado do Exercício)** é um resumo financeiro que mostra se o laboratório está lucrando ou tendo prejuízo. Diferente de um relatório estático que o contador envia mensalmente, esta DRE é atualizada automaticamente a cada lançamento cadastrado no sistema.

### Para que serve

- Saber o resultado do mês sem esperar o fechamento contábil
- Entender de onde vem o lucro (ou o prejuízo)
- Comparar o desempenho com o mês anterior

### Como acessar

**Financeiro → Gestão integrada → aba "DRE"**  
ou  
**Financeiro → Demonstrativos → DRE completa**

### Como ler a DRE

```
DEMONSTRATIVO DE RESULTADO — MAIO/2026
════════════════════════════════════════════════════════
(+) Receita bruta                          R$ 420.000
(-) Deduções (descontos concedidos)        R$  18.000
                                          ────────────
(=) Receita líquida                        R$ 402.000
                                           (100%)

(-) Custos variáveis (reagentes, materiais)R$ 180.900
                                          ────────────
(=) Margem de contribuição                 R$ 221.100
                                           (55%)   ←── ideal: acima de 40%

(-) Custos fixos (pessoal, aluguel, etc.)  R$ 150.000
                                          ────────────
(=) Resultado operacional (EBITDA)         R$  71.100
                                           (17,7%)

(-) Despesas financeiras                   R$   8.400
                                          ────────────
(=) Resultado líquido do período           R$  62.700
                                           (15,6%)
════════════════════════════════════════════════════════
```

### Configuração inicial necessária

Para a DRE funcionar, o contador ou gestor precisa classificar os planos de conta:  
**Financeiro → Configurações → Plano de contas → coluna "Natureza DRE"**

Exemplos de classificação:

| Plano de conta | Natureza DRE |
|---|---|
| Receita de exames laboratoriais | Receita bruta |
| Descontos concedidos | Dedução |
| Reagentes e materiais | Custo variável |
| Salários e encargos | Custo fixo |
| Aluguel | Custo fixo |
| Juros bancários | Despesa financeira |

> Esse ajuste é feito uma vez e vale para sempre (ou até mudança no plano de contas).

### Dica de uso

Clique em qualquer linha da DRE para ver quais lançamentos compõem aquele valor — é o **drill-down**. Se o custo variável subiu, você consegue identificar exatamente qual fornecedor ou qual categoria está puxando.

---

## 4. Régua de cobrança automática

### O que é

A **régua de cobrança** é uma sequência de lembretes automáticos enviados ao cliente por e-mail, WhatsApp ou SMS conforme o atraso avança. Você define uma vez — o sistema cuida do resto.

### Para que serve

Eliminar o trabalho manual de ligar ou enviar mensagem para cada cliente em atraso. O sistema faz isso automaticamente, respeitando a cadência que você configurou.

> **Resultado esperado:** redução de 60% nas ligações manuais de cobrança e 25–40% menos dias de atraso médio na carteira.

### Como acessar

**Financeiro → Cobrança → Régua de cobrança**

### Como configurar uma régua

**Passo 1 — Criar a régua**

Clique em "Nova régua". Dê um nome (ex: "Cobrança padrão convênios") e salve.

**Passo 2 — Adicionar etapas**

Cada etapa é um disparo. Clique em "Adicionar etapa" e configure:

| Campo | O que preencher | Exemplo |
|---|---|---|
| Dias após vencimento | Quantos dias de atraso para disparar | 1 |
| Canal | Como enviar | WhatsApp |
| Assunto | Apenas para e-mail | — |
| Mensagem | O texto da mensagem | Ver abaixo |

**Exemplo de cadência de 4 etapas:**

```
Etapa 1 — Dia 1 de atraso — WhatsApp
  "Olá, {{nome_cliente}}! Identificamos que o pagamento de R$ {{valor}} 
   com vencimento em {{data_vencimento}} ainda não foi recebido. 
   Clique aqui para pagar via PIX: {{link_pix}}"

Etapa 2 — Dia 7 de atraso — E-mail
  Assunto: "Lembrete: fatura em aberto — {{nome_laboratorio}}"
  "Prezado(a) {{nome_cliente}}, sua fatura no valor de R$ {{valor}}
   está em aberto há 7 dias..."

Etapa 3 — Dia 15 de atraso — WhatsApp
  Tom mais firme, mencionar possível suspensão de serviços

Etapa 4 — Dia 30 de atraso — E-mail
  Tom formal, informar que o caso será encaminhado para cobrança especializada
```

**Variáveis disponíveis nas mensagens:**

| Variável | O que é substituído |
|---|---|
| `{{nome_cliente}}` | Nome do convênio ou cliente |
| `{{valor}}` | Valor em aberto formatado (R$ 1.234,56) |
| `{{data_vencimento}}` | Data de vencimento (15/04/2026) |
| `{{link_pix}}` | Link para geração do QR Code PIX |
| `{{nome_laboratorio}}` | Nome do seu laboratório |
| `{{dias_atraso}}` | Quantos dias de atraso |

**Passo 3 — Definir as regras de aplicação**

Você pode ter réguas diferentes para situações diferentes:

- "Régua padrão" → aplica para todos os clientes
- "Régua premium" → aplica apenas para o convênio Unimed, com tom mais suave
- "Régua agressiva" → aplica para clientes com mais de R$5.000 em atraso

**Passo 4 — Ativar**

Marque a régua como ativa. O sistema passará a disparar as etapas automaticamente todo dia às 08h.

### Acompanhar os envios

**Financeiro → Cobrança → Histórico de envios**

Aqui você vê cada mensagem enviada, o status (enviada, lida, respondida, falha) e o cliente.

### Importante

> O sistema só envia um disparo por etapa por lançamento. Se o cliente pagar antes do próximo disparo, a régua para automaticamente para aquele lançamento.

---

## 5. Margem por convênio e custo por exame

### O que é

Esta funcionalidade cruza dois dados: quanto cada convênio **paga** pelos exames e quanto esses exames **custam** ao laboratório. O resultado é a **margem real** de cada convênio.

### Para que serve

Muitos laboratórios sabem quanto faturaram por convênio, mas não sabem se estão **lucrando** com aquele convênio. Um convênio que paga pouco por exames caros pode estar te dando prejuízo sem que você perceba.

### Como acessar

**Financeiro → Análises → Margem por convênio**  
**Financeiro → Análises → Custo por exame**

### Configuração: cadastro de custos por exame

Antes de ver as margens, você precisa informar o custo de cada exame:

**Financeiro → Análises → Custo por exame → Novo**

| Campo | O que preencher | Exemplo |
|---|---|---|
| Código do exame | Código interno | HEM001 |
| Descrição | Nome do exame | Hemograma completo |
| Custo de reagente | Custo do reagente consumido | R$ 2,50 |
| Custo de material | Tubos, agulhas, etc. | R$ 0,80 |
| Custo de mão de obra | Estimativa proporcional | R$ 3,20 |
| Vigência início | A partir de quando este custo vale | 01/01/2026 |

O sistema calcula automaticamente: **Custo total = R$ 6,50**

> Você cadastra o custo uma vez e atualiza quando os preços dos fornecedores mudam. Mantendo o histórico por competência.

### Como ler a tabela de margem por convênio

```
Convênio               Exames  Receita    Custo      Margem     %      Tendência
─────────────────────────────────────────────────────────────────────────────────
Unimed BH              1.240   R$ 62.000  R$ 32.240  R$ 29.760  48%    ↑ subindo
Bradesco Saúde           890   R$ 31.150  R$ 18.690  R$ 12.460  40%    → estável
Amil                     560   R$ 16.800  R$ 14.000  R$  2.800  17%    ↓ caindo ⚠️
SUS (particular)         320   R$  6.400  R$  9.600 -R$  3.200 -50%   ↓ prejuízo ⚠️
─────────────────────────────────────────────────────────────────────────────────
```

### O que fazer com essa informação

- Convênio com **margem abaixo de 20%**: avaliar renegociação de tabela ou redução de escopo
- Convênio com **margem negativa**: está dando prejuízo, decisão gerencial necessária
- Tendência **↓ caindo**: custo subindo ou volume caindo — investigar

### Ponto de equilíbrio

Para cada convênio, o sistema calcula também o **ponto de equilíbrio**: quantos exames o laboratório precisa realizar para aquele convênio pelo menos pagar os custos fixos alocados. Abaixo desse número, o convênio é inviável.

---

## 6. Score de inadimplência

### O que é

O **score** é uma nota de 0 a 100 calculada automaticamente para cada cliente/convênio com base no histórico real de pagamentos. Indica o risco de aquele cliente atrasar os próximos pagamentos.

### Para que serve

- Priorizar esforços de cobrança nos clientes de maior risco
- Decidir se vai oferecer prazo maior para um novo convênio ou não
- Ter uma visão rápida da qualidade da carteira

### Como funciona o cálculo

O score é calculado todo domingo de madrugada, analisando os últimos 12 meses de pagamentos de cada cliente. Quanto maior o score, melhor o pagador.

| Score | Classificação | Significado |
|---|---|---|
| 80 a 100 | 🟢 **Verde** | Bom pagador — histórico excelente |
| 50 a 79 | 🟡 **Amarelo** | Atenção — atrasos ocasionais |
| 0 a 49 | 🔴 **Vermelho** | Alto risco — atrasos frequentes ou longos |

**O que afeta negativamente o score:**
- Média de dias de atraso elevada
- Alta porcentagem de lançamentos que atrasaram
- Atrasos muito longos (mais de 60 dias)
- Inadimplência definitiva no histórico

**O que afeta positivamente:**
- Pagar antes do vencimento
- Nunca ter atrasado nos últimos 3 meses
- Relacionamento longo sem inadimplência

### Onde aparece o score

**1. Na listagem de clientes** — um badge colorido ao lado do nome:  
`GRUPAMENTO DE APOIO DE LAGOA SANTA  🔴 23`

**2. No cockpit da gestão integrada** — mini-ranking dos 5 clientes com maior risco e maior valor em aberto, para ação imediata.

**3. No formulário do cliente** — no cabeçalho, mostrando a nota e o histórico resumido.

### Como usar na prática

Você recebe uma solicitação de um convênio novo pedindo 60 dias de prazo. Antes de aceitar, consulte o score se aquele CNPJ já é cliente. Score vermelho com histórico de atrasos longos? Negocie prazo menor ou solicite garantias.

---

## 7. Conciliação bancária

### O que é

A **conciliação bancária** é o processo de comparar o extrato da sua conta no banco com os lançamentos registrados no sistema. O objetivo é garantir que tudo que saiu ou entrou no banco está lançado no sistema — e vice-versa.

### Para que serve

- Detectar pagamentos recebidos que não foram baixados no sistema
- Identificar débitos no banco que ninguém lançou como despesa
- Encontrar tarifas e encargos bancários não contabilizados
- Ter a certeza de que o saldo do sistema bate com o saldo real do banco

### Como acessar

**Financeiro → Conciliação bancária**

### Como usar passo a passo

**Passo 1 — Exportar o extrato do banco**

No site do seu banco, exporte o extrato do período em formato **.OFX** (a maioria dos bancos oferece essa opção no internet banking, geralmente em "Extrato" → "Exportar" → "OFX").

**Passo 2 — Importar no sistema**

Na tela de Conciliação bancária, clique em **"Importar extrato"**:
- Selecione a conta caixa correspondente
- Selecione o período (ex: 01/05/2026 a 31/05/2026)
- Faça o upload do arquivo OFX

O sistema processa automaticamente e tenta casar cada linha do extrato com um lançamento do sistema.

**Passo 3 — Revisar as sugestões automáticas**

O sistema usa três critérios para sugerir o casamento:
1. **Valor** — mesma quantia (tolerância de centavos)
2. **Data** — mesma data ou até 3 dias de diferença
3. **CNPJ** — se o banco identificou o CNPJ da contraparte

A confiança de cada sugestão aparece em porcentagem:
```
✅ 95% — Valor exato + data exata + CNPJ → aceitar automaticamente
✅ 85% — Valor exato + data próxima → sugerido para confirmação
⚠️ 70% — Valor exato + data ±3 dias → revisar manualmente
❓ 50% — Valor aproximado → revisar com cuidado
```

Movimentos com confiança acima de 85% são conciliados automaticamente. Os demais aparecem na fila de conciliação manual.

**Passo 4 — Conciliação manual**

Para os movimentos não conciliados automaticamente, o sistema mostra a linha do extrato ao lado de sugestões de lançamentos no sistema. Você clica na sugestão correta e confirma.

Para movimentos sem correspondência (ex: tarifa bancária que não foi lançada), você pode:
- **Criar um lançamento** de despesa diretamente da tela
- **Ignorar** o movimento (ex: transferência interna entre contas)

**Passo 5 — Verificar o relatório de divergências**

Ao final, o relatório mostra:
- Total de movimentos do extrato
- Total conciliado (automático + manual)
- Total pendente (requer ação)
- Diferença entre saldo do sistema e saldo do banco

> **Meta:** chegar a 80%+ de conciliação automática após os primeiros 2 meses de uso.

---

## 8. PIX integrado

### O que é

O sistema gera um **QR Code PIX** para cada conta a receber. O cliente paga escaneando o QR Code e, em segundos, o sistema detecta o pagamento e dá a baixa automaticamente — sem que ninguém precise fazer nada.

### Para que serve

- Eliminar o processo manual de verificar pagamento no banco e dar baixa no sistema
- Oferecer uma forma moderna e prática de pagamento para os convênios
- Reduzir o tempo entre cobrar e receber

### Configuração inicial (feita uma vez pelo gestor)

**Financeiro → Configurações → PIX**

Você vai precisar das credenciais da API PIX do seu banco. Os bancos que oferecem API PIX são: Banco Inter, Sicoob, Itaú, Banco do Brasil, Bradesco, entre outros. As credenciais são obtidas no portal de desenvolvedores do banco.

| Dado | Onde encontrar |
|---|---|
| Client ID | Portal do desenvolvedor do banco |
| Client Secret | Portal do desenvolvedor do banco |
| Chave PIX | A chave PIX da sua conta (CNPJ, e-mail ou chave aleatória) |
| Banco | Selecionar na lista |
| Ambiente | Sandbox para testes, Produção para uso real |

### Como usar no dia a dia

**1. Abrindo um lançamento de contas a receber, você verá o botão "Gerar PIX".**

**2. Clique em "Gerar PIX"** → abre um modal com:
```
┌─────────────────────────────────────────┐
│  QR Code PIX                            │
│                                         │
│  [■■■ QR CODE ■■■]                      │
│                                         │
│  Laboratório: InfoTime Saúde            │
│  Cliente: Unimed BH                     │
│  Valor: R$ 7.953,22                     │
│  Vencimento: 10/05/2026                 │
│                                         │
│  [Copiar código]  [Enviar por WhatsApp] │
└─────────────────────────────────────────┘
```

**3. Envie para o cliente** usando o botão "Enviar por WhatsApp" ou copie o código e envie por e-mail.

**4. O cliente paga** usando o aplicativo do banco dele.

**5. O sistema detecta automaticamente** o pagamento (em geral em menos de 5 segundos) e:
- Marca o lançamento como pago
- Preenche a data e o valor realizado
- Registra o CNPJ e nome do pagador
- Exibe uma notificação na tela

### Integração com a régua de cobrança

Quando a régua de cobrança envia uma mensagem de cobrança via WhatsApp, ela inclui automaticamente o link do PIX. O cliente clica no link, vê o QR Code e paga — tudo sem precisar ligar para o laboratório.

---

## 9. Portal do convênio

### O que é

O **portal do convênio** é uma área exclusiva na internet onde cada convênio acessa as próprias faturas, histórico de pagamentos e notas fiscais — e pode pagar diretamente via PIX, sem precisar entrar em contato com o laboratório.

### Para que serve

- Reduzir o volume de ligações e e-mails do tipo "me manda a fatura"
- Dar transparência para os convênios sobre o que estão devendo
- Permitir pagamento imediato a qualquer hora do dia

### Como o convênio acessa

O laboratório cadastra um usuário e senha para cada convênio:

**Financeiro → Configurações → Portal do convênio → Novo usuário**

O sistema envia um e-mail de boas-vindas com o link e as instruções de acesso.

### O que o convênio vê no portal

**Tela inicial — faturas em aberto:**
```
┌────────────────────────────────────────────────────────────────┐
│  GRUPAMENTO DE APOIO DE LAGOA SANTA — GAP-LS                   │
│  Bem-vindo(a), João Silva                                       │
├────────────────────────────────────────────────────────────────┤
│  FATURAS EM ABERTO                                              │
│                                                                 │
│  Vencimento    Valor        Situação    Ação                    │
│  10/05/2026    R$ 7.953,22  Em aberto   [Pagar via PIX]        │
│  10/06/2026    R$ 7.682,75  A vencer    [Pagar via PIX]        │
│                                                                 │
│  Total em aberto: R$ 15.635,97                                  │
├────────────────────────────────────────────────────────────────┤
│  [Ver histórico de pagamentos]  [Baixar notas fiscais]          │
└────────────────────────────────────────────────────────────────┘
```

**Ao clicar em "Pagar via PIX"**, o convênio vê o QR Code e paga imediatamente.

### Segurança

- Cada convênio só vê os próprios dados — nenhum convênio acessa dados de outro
- O acesso é protegido por senha e bloqueado após 5 tentativas erradas
- Todas as ações ficam registradas num log de auditoria

---

## 10. Balanço patrimonial

### O que é

O **balanço patrimonial** é um demonstrativo contábil que mostra, numa data de referência, o que o laboratório **tem** (ativos), o que **deve** (passivos) e o que é **patrimônio líquido** dos sócios.

### Para que serve

- Apresentar para bancos ao solicitar crédito
- Visualizar a saúde financeira de longo prazo
- Subsidiar decisões de investimento (comprar equipamento? ampliar a unidade?)
- Cumprir obrigação legal (empresas de médio porte são obrigadas por lei)

### Como acessar

**Financeiro → Demonstrativos → Balanço patrimonial**

Selecione a data de referência (geralmente 31 de dezembro ou fim de cada trimestre).

### Como ler o balanço

```
BALANÇO PATRIMONIAL — 31/12/2025
═══════════════════════════════════════════════════════════════
ATIVO                              PASSIVO
──────────────────────────────     ──────────────────────────────
Ativo Circulante                   Passivo Circulante
  Caixa e bancos    R$ 145.000       Contas a pagar    R$  82.000
  Contas a receber  R$ 312.000       Empréstimos CP    R$  50.000
  Estoques          R$  28.000     ──────────────────────────────
  Total             R$ 485.000     Total               R$ 132.000

Ativo Não Circulante               Passivo Não Circulante
  Equipamentos      R$ 280.000       Financiamentos    R$ 120.000
  (-) Depreciação   -R$  64.000
  Intangível        R$  15.000     PATRIMÔNIO LÍQUIDO
  Total             R$ 231.000       Capital social    R$ 200.000
                                     Reservas          R$  84.000
                                     Lucros acumulados R$ 200.000
                                   Total PL             R$ 484.000
──────────────────────────────     ──────────────────────────────
TOTAL ATIVO        R$ 716.000     TOTAL PASSIVO + PL  R$ 716.000
═══════════════════════════════════════════════════════════════
⚠️ Equação verificada: ATIVO = PASSIVO + PL ✓
```

### Configuração necessária

Para o balanço funcionar, além da classificação da DRE (item 3), é necessário classificar os planos de conta com o **grupo contábil**:

**Financeiro → Configurações → Plano de contas → coluna "Grupo contábil"**

Exemplos:
| Conta | Grupo contábil |
|---|---|
| Banco Itaú | Ativo circulante |
| Contas a receber | Ativo circulante |
| Equipamentos de laboratório | Ativo imobilizado |
| Fornecedores | Passivo circulante |
| Empréstimo bancário | Passivo não circulante |

> Essa configuração é feita uma vez com o apoio do contador.

### Sinal de alerta

O sistema exibe um alerta se Ativo ≠ Passivo + Patrimônio Líquido. Isso indica que algum lançamento contábil está faltando e precisa de ajuste.

---

## 11. DFC — Demonstrativo de Fluxo de Caixa

### O que é

O **DFC (Demonstrativo de Fluxo de Caixa)** mostra de onde veio e para onde foi o dinheiro num período. Diferente do balanço (que é uma foto de um momento), o DFC é um filme de todo o período.

### Para que serve

- Entender por que o caixa diminuiu mesmo que o laboratório lucrou
- Identificar se o negócio gera caixa operacional suficiente
- Apresentar para bancos e investidores
- Detectar períodos de aperto de caixa antes que aconteçam

### Como acessar

**Financeiro → Demonstrativos → DFC — Fluxo de caixa**

Selecione o período de competência.

### Como ler o DFC

```
DEMONSTRATIVO DE FLUXO DE CAIXA — JAN-MAI/2026
════════════════════════════════════════════════════════════════
ATIVIDADES OPERACIONAIS
  Recebimentos de clientes/convênios          R$ 1.820.000
  Pagamentos a fornecedores                  -R$   580.000
  Pagamentos de pessoal                      -R$   720.000
  Impostos pagos                             -R$   180.000
  Outras saídas operacionais                 -R$    62.000
                                             ───────────────
  Fluxo líquido das atividades operacionais   R$   278.000 ✅

ATIVIDADES DE INVESTIMENTO
  Compra de equipamentos                     -R$   150.000
  Venda de imobilizado                        R$    12.000
                                             ───────────────
  Fluxo líquido das atividades de investim.  -R$   138.000

ATIVIDADES DE FINANCIAMENTO
  Captação de empréstimo bancário             R$   100.000
  Pagamento de parcelas de financiamento     -R$    48.000
                                             ───────────────
  Fluxo líquido das atividades de financ.     R$    52.000
════════════════════════════════════════════════════════════════
VARIAÇÃO LÍQUIDA DE CAIXA NO PERÍODO          R$   192.000

Saldo de caixa em 01/01/2026                  R$   145.000
Saldo de caixa em 31/05/2026                  R$   337.000
════════════════════════════════════════════════════════════════
```

### Como interpretar

**Atividades operacionais positivas** ✅  
O laboratório está gerando caixa com sua atividade principal. Isso é o que se espera de um negócio saudável.

**Atividades de investimento negativas** (normal em crescimento)  
Você está comprando equipamentos — investindo no futuro. Negativo aqui não é necessariamente ruim.

**Atividades de financiamento**  
Mostra como você está financiando o crescimento: empréstimos, amortizações, dividendos.

> **Regra de ouro:** se o fluxo das atividades operacionais for negativo por mais de 3 meses seguidos, o modelo de negócio precisa de revisão urgente.

---

## 12. Visão consolidada multi-unidade

### O que é

Para laboratórios com **mais de uma unidade** (filiais, franquias, unidades regionais), esta funcionalidade reúne o desempenho financeiro de todas as unidades numa única tela, com a possibilidade de ver o detalhe de cada uma.

### Como acessar

**Financeiro → Gestão integrada → aba "Multi-unidade"**

Disponível apenas para tenants com mais de uma unidade cadastrada.

### O que você vê

```
VISÃO CONSOLIDADA — MAIO/2026

Unidade              A receber   A pagar    Saldo 30d
────────────────────────────────────────────────────
TOTAL CONSOLIDADO    R$ 420.000  R$ 180.000  R$ 240.000
  Unidade BH Centro  R$ 180.000  R$  82.000  R$  98.000  [Ver]
  Unidade BH Leste   R$ 140.000  R$  60.000  R$  80.000  [Ver]
  Unidade Contagem   R$  60.000  R$  28.000  R$  32.000  [Ver]
  Unidade Betim      R$  40.000  R$  10.000  R$  30.000  [Ver]
```

Clicar em "Ver" ao lado de qualquer unidade filtra todo o cockpit para mostrar apenas os dados daquela unidade.

---

## 13. Previsão de caixa com inteligência artificial

### O que é

A funcionalidade de previsão de caixa usa **inteligência artificial** (Claude, da Anthropic) para gerar uma projeção de quanto o laboratório vai receber nos próximos 30, 60 ou 90 dias. A diferença em relação à projeção simples é que a IA leva em conta o **comportamento real de pagamento** de cada convênio — não apenas a data de vencimento.

### Para que serve

Se um convênio tem prazo de 30 dias, mas historicamente paga em 42 dias, a previsão simples vai contar aquele dinheiro em 30 dias. A IA vai contar em 42 dias — muito mais preciso.

### Como acessar

**Financeiro → Gestão integrada → aba "Previsão IA"**

Disponível somente após 6 meses de operação no sistema (para ter histórico suficiente).

### O que você vê

```
PREVISÃO DE CAIXA — PRÓXIMOS 30 DIAS
────────────────────────────────────────────────────────────────
Estimativa central:    R$ 318.000
Cenário otimista:      R$ 362.000  (pagamentos no prazo ou antes)
Cenário pessimista:    R$ 274.000  (atrasos conforme histórico)
Confiança da previsão: 87%
────────────────────────────────────────────────────────────────
ANÁLISE DA IA:

"Com base no comportamento dos últimos 6 meses, a carteira de 
recebíveis apresenta padrão relativamente estável. Os principais 
fatores que podem impactar a previsão são:

O Convênio Amil representa 18% da carteira e historicamente 
atrasa em média 14 dias além do vencimento, o que empurra cerca 
de R$ 42.000 para fora da janela de 30 dias.

O Convênio Unimed BH, por outro lado, é o melhor pagador da 
carteira — costuma pagar 2-3 dias antes do vencimento, 
antecipando R$ 68.000 que foram incluídos na estimativa central."

ALERTAS:
  ⚠️ Convênio Bradesco: atraso médio de 22 dias — ajuste de
     R$ 31.000 aplicado na estimativa
  ⚠️ 3 convênios com vencimento em 19/05 somam R$ 48.000 —
     concentração de recebimento nesta data
────────────────────────────────────────────────────────────────
```

### Como usar na prática

- Utilize a estimativa pessimista para planejar pagamentos de fornecedores em datas críticas
- Os alertas da IA indicam quais convênios merecem atenção especial antes do vencimento
- Compare a previsão com o realizado mês a mês para calibrar sua tomada de decisão

---

## 14. Detecção de anomalias

### O que é

O sistema monitora automaticamente todos os lançamentos e gera um **alerta** quando identifica algo fora do padrão que pode indicar erro, duplicidade ou fraude.

### Para que serve

- Detectar pagamentos duplicados antes de efetuar o segundo pagamento
- Identificar fornecedores com valores muito acima do histórico
- Alertar sobre lançamentos feitos em horários suspeitos
- Proteger o laboratório de erros humanos e situações de risco

### Como acessar

**Financeiro → Gestão integrada → aba "Alertas"**

Um badge numérico no menu lateral mostra quantos alertas estão em aberto.

### Tipos de alertas

| Tipo | O que dispara | Severidade |
|---|---|---|
| **Valor anômalo** | Fornecedor com valor 2x acima da média histórica | Média a Alta |
| **Pagamento duplicado** | Mesmo fornecedor, mesmo valor, mesma data (±3 dias) | Alta |
| **Fornecedor novo** | Primeiro lançamento de um fornecedor com valor alto | Média |
| **Valor recebido divergente** | Recebimento mais de 10% acima ou abaixo do previsto | Baixa a Média |
| **Horário suspeito** | Lançamento de madrugada com valor acima do ticket médio | Média |

### Como tratar um alerta

Para cada alerta, você tem três opções:

1. **Iniciar investigação** → marca como "Investigando" e atribui a um responsável
2. **Marcar como falso positivo** → o sistema aprende e fica menos sensível a esse padrão
3. **Confirmar como problema** → tomar a ação corretiva e registrar como resolvido

### Exemplo prático

```
🔴 ALERTA ALTO — Pagamento duplicado suspeito

Fornecedor: REAGENTES ABC LTDA
CNPJ: 12.345.678/0001-99
Valor: R$ 8.400,00
Datas: 08/05/2026 e 09/05/2026

O sistema identificou dois lançamentos do mesmo fornecedor com 
o mesmo valor em datas consecutivas. Verifique se há dois 
documentos fiscais distintos ou se houve duplicação de lançamento.

[Investigar]  [Falso positivo — há dois documentos]  [Confirmar e cancelar]
```

---

## 15. Assistente financeiro IA

### O que é

Um **chat integrado ao módulo financeiro** onde você pode fazer perguntas em português e receber respostas baseadas nos dados reais do seu laboratório. É como ter um analista financeiro disponível a qualquer momento.

### Como acessar

Botão **"Assistente IA"** no canto da tela de Gestão integrada (ícone de chat)

### O que você pode perguntar

O assistente consegue responder a qualquer pergunta que possa ser respondida com os dados do sistema. Alguns exemplos:

**Sobre recebíveis:**
> "Quais são os 5 convênios com maior valor em aberto hoje?"

> "Qual convênio tem o pior histórico de atraso nos últimos 6 meses?"

> "Quanto vou receber esta semana, descontando o atraso histórico?"

**Sobre custos:**
> "Quais fornecedores tiveram aumento de custo acima de 15% nos últimos 3 meses?"

> "Qual exame tem a menor margem de contribuição?"

**Sobre resultado:**
> "Como está minha margem de contribuição comparada ao mês passado?"

> "Qual mês do ano passado teve o melhor resultado?"

**Sobre clientes em risco:**
> "Quais clientes têm score vermelho e mais de R$10.000 em aberto?"

> "Quais convênios vão vencer nos próximos 7 dias e têm histórico de atraso?"

### Limitações importantes

- O assistente responde com base nos dados cadastrados no sistema. Se um lançamento não foi inserido, ele não aparece nas análises.
- Não é um substituto para o contador — ele não dá conselhos jurídicos ou tributários.
- Disponível somente após 3 meses de operação com dados no sistema.

---

## 16. Perguntas frequentes

**P: Preciso de treinamento especial para usar esses módulos?**  
R: Não. Todos os módulos foram desenhados para serem intuitivos. Este manual cobre tudo que você precisa. Para a conciliação bancária e o balanço, pode ser útil ter o apoio do contador na configuração inicial.

**P: Os módulos de IA funcionam desde o primeiro dia?**  
R: Não — a IA precisa de histórico para aprender. A previsão de caixa e a detecção de anomalias ficam mais precisas com o tempo. O ideal é ter ao menos 6 meses de dados no sistema.

**P: O score de inadimplência é atualizado em tempo real?**  
R: Não. O score é recalculado toda semana (domingo de madrugada). Mudanças no comportamento de pagamento de um cliente aparecem no score da semana seguinte.

**P: Posso configurar mais de uma régua de cobrança?**  
R: Sim. Você pode ter quantas réguas quiser e definir regras para cada uma: convênios de saúde usam a régua suave, particulares usam a régua padrão, clientes inadimplentes usam a régua intensiva.

**P: O PIX funciona com qualquer banco?**  
R: O sistema suporta os principais bancos que oferecem API PIX: Banco Inter, Sicoob, Itaú, Banco do Brasil e Bradesco. Se o seu banco não estiver na lista, entre em contato com o suporte.

**P: O portal do convênio tem custo adicional?**  
R: Consulte seu contrato. O portal é um módulo adicional que pode ter condições específicas.

**P: E se a conciliação automática errar um casamento?**  
R: O sistema nunca apaga ou altera lançamentos automaticamente. Ele apenas sugere. Você confirma ou rejeita cada sugestão. Se um casamento automático estiver errado, basta desfazê-lo e fazer manualmente.

**P: Posso exportar todos esses relatórios?**  
R: Sim. Todos os demonstrativos (DRE, DFC, Balanço, Aging, Margem por convênio) possuem botão de exportação para PDF e Excel.

**P: Os dados do portal do convênio ficam seguros?**  
R: Sim. Cada convênio só acessa os próprios dados. A autenticação é separada do sistema interno e todas as ações ficam registradas em log de auditoria.

---

## Glossário

| Termo | Significado |
|---|---|
| **Aging** | Análise de envelhecimento da carteira de recebíveis por faixas de atraso |
| **DRE** | Demonstrativo de Resultado do Exercício — mostra lucro ou prejuízo do período |
| **DFC** | Demonstrativo de Fluxo de Caixa — mostra movimentação de dinheiro no período |
| **EBITDA** | Resultado operacional antes de juros, impostos, depreciação e amortização |
| **DSO** | Days Sales Outstanding — média de dias que a empresa demora para receber |
| **Dunning** | Processo automatizado de cobrança de clientes inadimplentes |
| **Margem de contribuição** | Receita líquida menos custos variáveis — quanto cada venda contribui para pagar os fixos |
| **Ponto de equilíbrio** | Volume mínimo de receita ou vendas para cobrir todos os custos |
| **PIX** | Sistema de pagamentos instantâneos do Banco Central do Brasil |
| **OFX** | Formato de arquivo para exportação de extratos bancários |
| **Score** | Pontuação de 0 a 100 que indica o risco de inadimplência de um cliente |
| **Webhook** | Notificação automática enviada pelo banco quando um pagamento PIX é recebido |
| **Conciliação** | Processo de comparar e casar registros do sistema com registros do banco |
| **Drill-down** | Funcionalidade de clicar num número e ver o detalhe dos lançamentos que o compõem |

---

*Manual do Módulo Financeiro Avançado — Infotime Web*  
*Versão 1.0 — Maio de 2026*  
*Para suporte técnico ou dúvidas sobre configuração, acesse o chat de suporte no sistema.*
