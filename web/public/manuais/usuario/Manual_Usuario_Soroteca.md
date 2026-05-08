# Manual do Usuário — Soroteca

**Sistema:** Infotime Web
**Módulo:** Soroteca
**Público:** Operador de bancada · Supervisor · Auditor · Administrador
**Versão:** 1.0 — Maio/2026

> Este manual cobre todas as telas e fluxos de Soroteca disponíveis no Infotime Web. É escrito do ponto de vista de quem vai usar o sistema no dia a dia, não de quem vai implementá-lo.

---

## Sumário

### Parte 1 — Primeiros passos
1. [O que é a Soroteca](#1-o-que-é-a-soroteca)
2. [Acessando a Soroteca pelo menu](#2-acessando-a-soroteca-pelo-menu)
3. [Antes de começar — o que precisa estar configurado](#3-antes-de-começar--o-que-precisa-estar-configurado)
4. [Conceitos essenciais em 5 minutos](#4-conceitos-essenciais-em-5-minutos)

### Parte 2 — Operação diária (Módulos → Soroteca)
5. [Tela "Grades" — a tela do dia a dia](#5-tela-grades--a-tela-do-dia-a-dia)
6. [Criando uma nova caixa](#6-criando-uma-nova-caixa)
7. [Lendo o mapa visual](#7-lendo-o-mapa-visual)
8. [Armazenando uma amostra](#8-armazenando-uma-amostra)
9. [Retirando uma amostra](#9-retirando-uma-amostra)
10. [Editando os dados de uma caixa](#10-editando-os-dados-de-uma-caixa)
11. [Soroteca Express](#11-soroteca-express)

### Parte 3 — Cadastros estruturais (Cadastros → Soroteca)
12. [Visão geral dos cadastros](#12-visão-geral-dos-cadastros)
13. [Hierarquia física: Sala → Equipamento → Rack → Caixa → Posição](#13-hierarquia-física-sala--equipamento--rack--caixa--posição)
14. [Catálogos de comportamento](#14-catálogos-de-comportamento)
15. [Regras de retenção](#15-regras-de-retenção)
16. [Alíquotas e derivados](#16-alíquotas-e-derivados)
17. [Bloqueios](#17-bloqueios)
18. [Lotes de descarte](#18-lotes-de-descarte)
19. [Registro de temperatura e quarentena](#19-registro-de-temperatura-e-quarentena)
20. [Eventos de qualidade](#20-eventos-de-qualidade)

### Parte 4 — Cadastros de tipos (Cadastros → Tabelas)
21. [Tipos e motivos — quando mexer](#21-tipos-e-motivos--quando-mexer)

### Parte 5 — Auditoria e consulta
22. [Histórico de movimentações](#22-histórico-de-movimentações)
23. [Auditoria da soroteca](#23-auditoria-da-soroteca)

### Parte 6 — Referências
24. [Estados de amostra no mapa](#24-estados-de-amostra-no-mapa)
25. [Mensagens de erro frequentes](#25-mensagens-de-erro-frequentes)
26. [Atalhos e dicas de produtividade](#26-atalhos-e-dicas-de-produtividade)
27. [Glossário](#27-glossário)
28. [Suporte e canais de ajuda](#28-suporte-e-canais-de-ajuda)

---

# Parte 1 — Primeiros passos

## 1. O que é a Soroteca

A **Soroteca** é o módulo do Infotime Web que cuida do que acontece com a amostra biológica **depois** que ela é processada no laboratório: onde fica guardada, por quanto tempo, quando pode ser retirada para repetição, e quando é descartada de forma controlada.

Ela responde a três perguntas críticas do dia a dia:

- **"Onde está a amostra X que preciso para repetir o exame?"** A Soroteca diz, em segundos, em qual freezer, rack, caixa e poço a amostra está fisicamente.
- **"Esta amostra ainda pode ser usada?"** A Soroteca acompanha vencimento, qualidade, volume residual e bloqueios.
- **"Como provamos para o auditor que descartamos corretamente?"** A Soroteca mantém trilha auditável de cada movimentação, com hash de custódia.

> **Em resumo:** se a amostra entra no laboratório, é processada e precisa ser guardada para uso posterior, ela passa pela Soroteca.

---

## 2. Acessando a Soroteca pelo menu

A Soroteca aparece em **três lugares** do menu do Infotime Web. Saber qual usar economiza tempo.

### 2.1 Para operação diária — armazenar e retirar amostras

```
Menu → Módulos → Soroteca → Grades
```

É aqui que você vem todo dia. Mostra a lista de caixas, abre o mapa visual, permite armazenar e retirar amostras.

### 2.2 Para configurar o ambiente físico — uma vez por mês ou raramente

```
Menu → Cadastros → Soroteca → ...
```

São 22 entradas. Aqui você cadastra salas, equipamentos, racks, regras de retenção, normas, motivos de descarte. **Você não precisa mexer todo dia** — geralmente quem mexe é o supervisor ou o pessoal de TI/qualidade.

### 2.3 Para configurar tipos e motivos — geralmente vêm prontos

```
Menu → Cadastros → Tabelas → ...
```

São 8 entradas relacionadas a Soroteca: Tipo de material, Tipo de recipiente, Tipo de equipamento, Tipo de movimento, Tipo de bloqueio, Tipo de derivado, Tipo de evento de qualidade, Motivo de descarte. Geralmente já estão configurados na implantação do sistema.

> **Dica:** se você é operador de bancada, **80% do seu tempo será na tela "Grades"** (item 2.1). Os outros dois ramos do menu são para configuração eventual.

---

## 3. Antes de começar — o que precisa estar configurado

Para a Soroteca funcionar, alguns cadastros precisam existir. **Boa notícia:** o sistema cuida disso automaticamente na primeira vez que você abre a tela "Grades".

Quando você acessa **Módulos → Soroteca → Grades** pela primeira vez, o sistema cria automaticamente:

- Uma sala chamada **"Sala soroteca (padrão)"** (código: `SORO-PAD`)
- Um equipamento chamado **"Equipamento soroteca (padrão)"** (código: `EQ-SORO-PAD`)
- Um rack chamado **"Rack padrão"** (código: `RACK-SORO-PAD`)
- Uma caixa 9×9 chamada **"Caixa padrão"** (código: `CAIXA-SORO-PAD`)

Isso permite que você comece a armazenar amostras imediatamente, sem precisar configurar nada antes.

> **Quando configurar manualmente:** se o seu laboratório tem múltiplas salas, vários freezers de modelos diferentes, ou racks com layouts específicos, peça ao supervisor para cadastrar a estrutura real (Parte 3 deste manual).

---

## 4. Conceitos essenciais em 5 minutos

Antes de operar, é importante entender 6 conceitos. Cada um é uma "coisa" que aparece em algum momento na tela.

### 4.1 A hierarquia física

A Soroteca representa o seu laboratório em 5 níveis encaixados:

```
Sala (ex: "Laboratório Bioquímica")
  └── Equipamento (ex: "Freezer FRZ-01, -20°C")
       └── Rack (ex: "Gaveta A")
            └── Caixa (ex: "Caixa 1, 9 linhas × 9 colunas")
                 └── Posição (ex: célula A1)
                      └── Amostra
```

Cada amostra fica em **uma posição específica de uma caixa específica**, e essa posição tem um endereço como "A1", "B12", igual a uma planilha.

### 4.2 Os três tipos de "coisa armazenável"

A Soroteca não armazena só "amostras". Ela armazena três tipos de material, cada um com características próprias:

- **Amostra primária** (`infolab_atendimento_amostra`): o tubo original, como veio da coleta. Ex: tubo EDTA com sangue total.
- **Alíquota**: uma fração da amostra primária separada para uso posterior. Tem volume próprio, freeze-thaw count (quantas vezes congelou e descongelou), e pode ser usada independentemente.
- **Derivado**: material extraído da alíquota para análise molecular. Ex: DNA extraído com concentração, pureza 260/280, pureza 260/230.

> Para a operação diária básica (armazenar tubo após processamento, retirar para repetição), você só precisa pensar em **amostra primária**. Alíquotas e derivados aparecem em laboratórios que fazem biologia molecular ou guardam material para pesquisa.

### 4.3 Estado da amostra

Toda amostra na Soroteca tem um estado, calculado automaticamente:

| Estado | O que significa |
|---|---|
| **OCUPADA** | Tudo certo — amostra dentro do prazo |
| **VENCENDO** | Faltam 7 dias ou menos para vencer |
| **VENCIDA** | Passou da data de validade |
| **EM USO** | Foi retirada para repetição e ainda não voltou |
| **REJEITADA** | Foi marcada como rejeitada na recepção |
| **DESCARTADA** | Foi descartada (não aparece mais ativa no mapa) |
| **CONFLITO** | Mais de uma amostra na mesma posição (raro — sinaliza erro de operação) |

### 4.4 Movimentações

Toda vez que algo acontece com uma amostra (entra, sai, é transferida, é descartada), o sistema registra um **movimento** numa tabela imutável (não dá para apagar nem editar). Essa é a base da cadeia de custódia exigida por PALC e ISO 15189.

### 4.5 Regras de retenção

São as regras que dizem "quanto tempo guardar" cada amostra. Configuradas pelo supervisor, podem ser por exame, por material, por finalidade, por norma. Quando a amostra entra na Soroteca, o sistema calcula a data de validade automaticamente baseado na regra que se aplica.

### 4.6 Bloqueios

Uma amostra pode estar **bloqueada** mesmo dentro do prazo — geralmente por motivo judicial, técnico ou de qualidade. Bloqueio impede:

- O **descarte** (o sistema não deixa incluir a amostra em lote de descarte)
- O **uso** (o sistema não deixa retirar para repetição)

O bloqueio é liberado por quem tem permissão, com data de fim e observações registradas.

---

# Parte 2 — Operação diária (Módulos → Soroteca)

## 5. Tela "Grades" — a tela do dia a dia

Essa é **a** tela principal da Soroteca. É aqui que você vai trabalhar 95% do tempo.

### 5.1 Como abrir

```
Menu → Módulos → Soroteca → Grades
```

### 5.2 O que você vê

Ao abrir, você vê uma **lista de caixas** com 4 colunas:

| Coluna | Descrição |
|---|---|
| **ID** | Identificador único da caixa no sistema (numérico) |
| **Nome** | Nome legível da caixa (ex.: "Bioquímica - Caixa 1") |
| **Dimensões** | Quantas linhas × quantas colunas a caixa tem (ex.: "9 × 9 poços") |
| **Situação** | "Ativa" (recebe amostras) ou "Inativa" (em manutenção) |

No topo, há um botão **[Nova grade]** para criar uma caixa nova, e um campo de busca para filtrar por nome.

### 5.3 As ações possíveis nessa tela

A partir daqui, você pode:

- **Clicar no botão "Abrir mapa"** ao lado de uma caixa → abre o mapa visual daquela caixa
- **Clicar em "Editar"** → abre o formulário de cadastro da caixa
- **Clicar em "Nova grade"** (canto superior direito) → cria uma caixa nova
- **Buscar por nome** → digite no campo de busca e pressione Enter

> **Observação sobre o nome "Grades":** o rótulo no menu ainda usa "Grades" por compatibilidade histórica, mas internamente o sistema chama de "caixa". Ambos os termos significam a mesma coisa: a estrutura física que comporta os tubos.

---

## 6. Criando uma nova caixa

Antes de armazenar amostras, é preciso ter caixas cadastradas. Você pode criar quantas precisar.

### 6.1 Passo a passo

1. Em **Módulos → Soroteca → Grades**, clique em **[Nova grade]** no canto superior direito.
2. Vai abrir um diálogo (caixa de pop-up) pedindo três informações:
   - **Código:** identificador curto e único, máximo 40 caracteres. Exemplos: `BIOQ-001`, `HEMA-A1`, `URI-2026-01`. Não use espaços ou acentos.
   - **Linhas:** quantas linhas a caixa tem (1 a 99). Mais comum: 9.
   - **Colunas:** quantas colunas a caixa tem (1 a 99). Mais comum: 9.
3. Clique em **[Confirmar]**.
4. O sistema cria a caixa e **automaticamente todas as posições** dentro dela. Numa caixa 9×9, isso cria 81 posições prontas para receber amostras.
5. A caixa nova aparece no topo da lista.

### 6.2 Capacidades comuns

Caixas reais típicas:

- **9 × 9 = 81 poços** (caixa criotube padrão)
- **10 × 10 = 100 poços** (caixa Eppendorf padrão)
- **12 × 12 = 144 poços** (caixa de tubo Falcon)

### 6.3 Observação importante sobre dimensões

> ⚠️ **Atenção:** depois que a caixa é criada com determinadas dimensões, **você não pode mudar mais o número de linhas ou colunas**. Se precisar de outras dimensões, exclua a caixa (somente se estiver vazia) e crie uma nova. Essa restrição existe para preservar a integridade das posições já cadastradas.

### 6.4 Mensagens que podem aparecer

| Mensagem | O que significa | O que fazer |
|---|---|---|
| "Informe o código da caixa." | Você deixou o campo Código vazio | Preencha um código curto |
| "Já existe uma caixa com o código X" | Esse código já está em uso no seu laboratório | Use outro código |
| "Catálogo incompleto: tipo de equipamento GELADEIRA não encontrado" | A configuração inicial não rodou | Chame o suporte ou peça ao admin |

---

## 7. Lendo o mapa visual

O mapa visual é o **coração** da Soroteca. Ele mostra a caixa exatamente como ela aparece no freezer, com cada posição colorida pelo seu estado.

### 7.1 Como abrir

Na lista de caixas (item 5), clique em **"Abrir mapa"** ao lado da caixa desejada.

### 7.2 O que você vê

Vai aparecer:

- O **nome e código da caixa** no topo
- Uma **legenda colorida** no canto, explicando o que cada cor significa
- A **grade visual** propriamente dita — uma matriz de quadrados coloridos
- Letras (A, B, C…) na lateral esquerda — são as **linhas**
- Números (1, 2, 3…) no topo — são as **colunas**
- Cada quadrado é um **poço** com endereço único: A1, A2, ..., B1, B2, etc.

### 7.3 As cores e o que significam

| Cor | Estado | O que significa |
|---|---|---|
| 🟢 Verde claro | **Livre** | Sem amostra. Pode receber amostra |
| ⬜ Cinza | **Inativo** | Poço desabilitado pelo supervisor (defeito, reservado) |
| 🔵 Azul | **Ocupada** | Amostra dentro do prazo |
| 🟡 Amarelo | **Vencendo** | Amostra com 7 dias ou menos para vencer |
| 🔴 Vermelho | **Vencida** | Amostra passou da validade — candidata a descarte |
| 🟣 Roxo | **Em uso** | Amostra foi retirada e ainda não voltou |
| ⚫ Cinza escuro | **Rejeitada** | Amostra rejeitada (não use) |
| 🟤 Marrom | **Descartada** | Amostra descartada (raramente aparece) |
| ⚠️ Laranja | **Conflito** | ERRO — mais de uma amostra ativa na mesma posição |

### 7.4 Passando o mouse sobre um poço

Quando você passa o mouse sobre um poço ocupado, aparece uma "dica" (tooltip) com:

- O endereço do poço (ex.: "A1")
- O estado da amostra (ex.: "Vencendo")
- O código da amostra
- O número do atendimento
- A data de validade

> **Importante sobre privacidade:** o mapa visual é **somente leitura no que diz respeito a paciente**. Ele **não mostra nome do paciente** ou outros dados identificáveis — só código de amostra e número de atendimento. Se você precisa do nome do paciente para algum motivo, busque pelo número de atendimento na tela de atendimentos.

### 7.5 Quando há avisos

Se a caixa tiver algo fora do padrão, aparece uma seção **"Avisos"** acima do mapa, com mensagens como:

- *"Algumas células não possuem registro de posição no banco; recrie a caixa ou gere posições em manutenção."* — caixa pode ter sido criada com dimensões erradas. Chame o suporte.
- *"Caixa sem dimensões válidas; exibindo grade mínima 1×1 até o cadastro ser ajustado."* — defeito de cadastro. Edite a caixa e corrija as dimensões.

### 7.6 "Amostras sem posição"

Se o sistema encontrar amostras vinculadas à caixa mas sem posição clara, lista elas separadamente abaixo do mapa em **"Amostras sem posição interpretável nesta grade"**. Geralmente significa que o código de poço está em formato incomum. Reporte ao suporte se aparecer.

---

## 8. Armazenando uma amostra

Esse é o fluxo mais comum: você acabou de processar uma amostra e quer guardá-la na Soroteca.

### 8.1 Pré-condições

Para poder armazenar, a amostra precisa:

- ✅ **Existir** no sistema (já ter sido recebida, conferida e processada)
- ✅ **Não estar rejeitada**
- ✅ **Não estar descartada**
- ✅ **Não estar em outra posição ativa** da soroteca

E a posição que você quer usar precisa:

- ✅ Estar dentro dos limites da caixa
- ✅ Não ser um poço **inativo**
- ✅ Estar **livre** (sem outra amostra ativa)
- ✅ A caixa em si precisa estar **ativa**

Se qualquer uma dessas condições falhar, o sistema mostra mensagem clara e não armazena.

### 8.2 Passo a passo

1. **Abra o mapa** da caixa onde quer armazenar (item 7).
2. **Identifique uma posição livre** (verde) onde quer colocar a amostra.
3. **Clique nessa posição**. Vai abrir um campo perguntando o código da amostra.
4. **Bipe ou digite o código da amostra**.
5. Confirme.
6. **O sistema valida tudo automaticamente** e, se estiver tudo certo:
   - A posição muda de cor (verde → azul, ou amarelo se estiver perto de vencer)
   - O sistema registra a entrada no histórico de movimentações
   - A amostra recebe a data de armazenamento e a data de validade calculada
7. Pronto. A amostra está armazenada.

### 8.3 O que o sistema faz "por baixo dos panos"

Numa única operação atômica (transação), o sistema:

1. Cria um registro de **armazenamento ativo** ligando a amostra à posição
2. Registra um **movimento do tipo ENTRADA**, com data, hora, IP da máquina, usuário
3. Atualiza a **amostra** com data de armazenamento e usuário responsável
4. Calcula a **data de validade** baseada na regra de retenção aplicável

Se qualquer passo falhar, **nada é salvo** — você fica sabendo o erro e pode corrigir.

### 8.4 Modo lote (várias amostras em sequência)

Se você tem 50 tubos para guardar, repita o ciclo: clicar na posição → bipar código → confirmar. O sistema é otimizado para essa repetição. **Boa prática:** mantenha o leitor de barcode em foco.

### 8.5 Mensagens de erro frequentes

| Mensagem | Causa | Solução |
|---|---|---|
| "Caixa inativa; não é possível armazenar amostras." | A caixa foi marcada como inativa | Use outra caixa ou peça ao supervisor para reativar |
| "Posição fora dos limites da caixa." | Erro técnico — não deveria acontecer pela UI | Reporte ao suporte |
| "Posição inativa; escolha outra." | O poço foi desabilitado pelo supervisor | Escolha outro poço |
| "Amostra rejeitada ou descartada não pode ser armazenada." | A amostra está com status incompatível | Verifique no atendimento se houve rejeição/descarte |
| "Amostra já está armazenada em outra posição; remova antes de realocar." | A amostra já está em outra caixa/posição ativa | Use a tela da outra caixa para remover, depois armazene aqui |
| "Já existe amostra ativa nesta posição." | Outro operador armazenou aqui antes de você | Atualize o mapa (F5) e escolha outra posição livre |
| "Amostra não encontrada neste laboratório." | Código não existe ou não pertence ao seu tenant | Confira o código bipado |

---

## 9. Retirando uma amostra

Quando você precisa retirar uma amostra para repetir um exame, fazer apoio externo, ou outro motivo.

### 9.1 Passo a passo

1. **Localize a amostra**. Você pode:
   - Abrir o mapa da caixa onde sabe que ela está
   - Ou usar a busca da listagem de caixas
2. **Clique na posição ocupada** (azul, amarela, ou vermelha).
3. Vai abrir uma confirmação. Confirme a retirada.
4. **A posição muda de cor** (volta para verde, livre).
5. O sistema registra um movimento do tipo TRANSFERENCIA (saída da soroteca).

### 9.2 O que acontece com a amostra retirada

A amostra fica com status "fora da soroteca". Ela continua existindo no atendimento, mas:

- Não tem mais posição ocupada
- Os campos `data_hora_armazenamento` e `id_local_armazenamento` são limpos
- Fica registrado **quem retirou e quando** no histórico

### 9.3 Devolvendo uma amostra (re-armazenando)

Se a amostra **voltar** depois (ex.: você só precisava dela por uma hora), basta repetir o fluxo de armazenamento (item 8). Pode ser na mesma posição ou em outra. O sistema cria um novo movimento de ENTRADA.

> **Boa prática:** sempre devolva a amostra ao final do uso. Amostra "fora da caixa" por muito tempo perde estabilidade térmica.

---

## 10. Editando os dados de uma caixa

Se você precisa mudar o código, descrição, lista de poços inativos, ou inativar a caixa.

### 10.1 Como abrir

1. Em **Módulos → Soroteca → Grades**, clique no botão de editar ao lado da caixa.
2. Vai abrir o formulário com **mapa embutido**.

### 10.2 Campos editáveis

| Campo | Descrição |
|---|---|
| **Código** | Identificador único. Pode ser alterado, mas o novo código não pode existir em outra caixa. |
| **Nome** (descrição) | Texto livre, até 120 caracteres |
| **Local de armazenamento** | Vínculo opcional com cadastro de local físico |
| **Lista de poços inativos** | Lista de poços desabilitados, separados por vírgula. Ex: `A1, A2, B12, C-3` |
| **Ativa** | S/N — se "N", a caixa não recebe novas amostras |

### 10.3 Campos NÃO editáveis

| Campo | Motivo |
|---|---|
| **Linhas** e **Colunas** (dimensões) | Para preservar integridade das posições já criadas |
| **ID da caixa** | É gerado automaticamente |
| **Auditoria** (data, IP, usuário) | É preenchida automaticamente |

### 10.4 Editando poços inativos pelo mapa

Em vez de digitar a lista, você pode marcar poços diretamente no mapa visual embutido no formulário:

1. Clique em um poço **livre** que quer desativar.
2. Ele muda para "inativo" (cinza).
3. O campo "Lista de poços inativos" é atualizado automaticamente.
4. Clique em **[Salvar]**.

> **Atenção:** você não pode inativar um poço que tenha amostra ativa. Se tentar, o sistema avisa.

### 10.5 Inativando a caixa inteira

Se uma caixa quebrou ou está em manutenção, marque "Ativa = N":

- O sistema **não impede** você de fazer isso, mesmo que tenha amostras dentro.
- Mas **bloqueia novos armazenamentos** na caixa inativa.
- As amostras que já estão lá continuam aparecendo no mapa, mas não podem receber companhia.

---

## 11. Soroteca Express

> ⚠️ **Status atual:** o item de menu **"Módulos → Soroteca → Soroteca Express"** está visível, mas a funcionalidade **ainda não foi implementada** no Infotime Web nesta versão. Clicar nele não tem efeito útil.

A Soroteca Express, quando implementada, será um atalho para armazenar amostras rapidamente sem precisar abrir o mapa. A previsão é que funcione assim:

1. Operador bipa código da amostra
2. Sistema localiza automaticamente a primeira posição livre da caixa apropriada (baseado em regras de retenção)
3. Sistema arma a etiqueta com a posição calculada
4. Operador apenas confirma

Por enquanto, **use a tela "Grades"** (item 5) para todas as operações de armazenamento.

---

# Parte 3 — Cadastros estruturais (Cadastros → Soroteca)

## 12. Visão geral dos cadastros

O ramo **Cadastros → Soroteca** tem 22 entradas. **A maioria das pessoas nunca vai precisar mexer aqui** — é território de supervisor ou TI.

Os cadastros se dividem em 6 grupos por finalidade:

| Grupo | Itens | Quem mexe |
|---|---|---|
| **Hierarquia física** | Sala, Equipamento, Rack, Caixa, Posição | Supervisor, TI (raramente) |
| **Comportamento** | Status de amostra, Grupo de resíduo, Método de descarte, Norma, Finalidade | TI, Qualidade |
| **Regras** | Regra de retenção | Qualidade, Supervisor |
| **Estoque biológico** | Alíquota, Derivado, Armazenamento | Operador (visualizar), Supervisor |
| **Operação avançada** | Bloqueio, Movimento, Lote/item de descarte, Evento de qualidade, Log/quarentena de temperatura | Supervisor, Auditoria |
| **Auditoria** | Auditoria soroteca | Apenas leitura, para auditoria |

### 12.1 Como funciona qualquer tela de cadastro

Todas as 22 telas seguem o mesmo padrão:

1. **Listagem** com colunas, busca e botão "Novo" no topo.
2. **Formulário** que abre ao clicar em "Novo" ou em um item da lista para editar.
3. **Botões "Salvar", "Cancelar"** no rodapé do formulário.
4. **Botão "Excluir"** apenas em alguns casos, quando faz sentido.

### 12.2 Telas somente leitura

Duas telas são **apenas consulta** — não dá para editar nem criar:

- **Movimento** (`soroteca-movimento`): mostra todas as movimentações da soroteca. É um log imutável.
- **Auditoria soroteca** (`soroteca-auditoria`): mostra todas as alterações em todas as tabelas, com hash de integridade.

Nessas duas telas, o botão "Novo" não aparece. Você só consulta.

---

## 13. Hierarquia física: Sala → Equipamento → Rack → Caixa → Posição

### 13.1 Sala (`soroteca-sala`)

Representa um ambiente físico do laboratório.

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Código | Sim | Curto, único por laboratório (ex.: `SALA-A`) |
| Nome | Sim | Nome legível (ex.: "Laboratório de Bioquímica") |
| Ativo | — | S/N |

**Quando criar:** se o laboratório tem múltiplos ambientes com controle térmico próprio.

### 13.2 Equipamento (`soroteca-equipamento`)

Cada freezer, geladeira, ultrafreezer, criotanque ou armário do laboratório.

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Código | Sim | Identificador único (ex.: `FRZ-01`, `ULT-A1`) |
| Nome | Sim | Nome legível (ex.: "Freezer Bioquímica - 20°C") |
| Sala | Sim | Em qual sala está |
| Tipo de equipamento | Sim | Geladeira / Freezer / Ultrafreezer / Criotanque / etc. (cadastro em Tabelas) |
| Fabricante, Modelo, Número de série | Não | Informações do equipamento |
| Temperatura mín./máx./alvo (°C) | Não | Faixa de operação |
| Capacidade total | Não | Quantos tubos cabem (informativo) |

**Boa prática:** cadastre todos os equipamentos críticos com fabricante, modelo, número de série. Isso ajuda na manutenção e em auditorias.

### 13.3 Rack (`soroteca-rack`)

Compartimento, gaveta ou prateleira dentro do equipamento.

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Código | Sim | Único (ex.: `A`, `GAV-1`) |
| Equipamento | Sim | Em qual equipamento está |
| Descrição | Não | Texto livre |
| Posição no equipamento | Não | Ex.: "Gaveta superior", "Bandeja 3" |

### 13.4 Caixa (`soroteca-caixa`)

A caixa física que comporta os tubos. **Esta listagem é só consulta** aqui em Cadastros — para criar/editar caixas com mapa, use a tela "Grades" (item 5).

A listagem mostra:

- ID, Código, Nome
- Tamanho (linhas × colunas)
- Local de armazenamento
- Ativo

Aviso da própria tela: *"Para criar ou editar caixas com mapa de poços, use Módulos → Soroteca → Grades."*

### 13.5 Posição (`soroteca-posicao`)

As células individuais das caixas. **Não se cadastra manualmente** — são geradas automaticamente quando a caixa é criada.

A listagem permite filtrar por **ID da caixa** para ver as posições de uma caixa específica.

Mostra: ID, ID da caixa, Linha, Coluna, Rótulo (ex.: "A1"), Ativo.

> **Quando consultar:** raramente. Útil para diagnosticar problemas de "amostras sem posição" ou contar capacidade total.

---

## 14. Catálogos de comportamento

São tabelas pequenas que governam o comportamento do sistema.

### 14.1 Status de amostra (`amostra-status`)

Estados possíveis de uma amostra. Tipicamente: COLETADA, EM_USO, ARMAZENADA, REJEITADA, DESCARTADA.

**Campos:**
- Código, Descrição, Fase
- Permite uso (S/N): se amostras nesse status podem ser usadas
- Terminal (S/N): se é estado final (não permite mais transição)
- Ativo

### 14.2 Grupo de resíduo (`residuo-grupo`)

Classificação RDC 222/2018 de Resíduos de Serviços de Saúde. Tipicamente: A1, A2, B, E.

**Campos:**
- Código (até 10 caracteres)
- Descrição (até 200 caracteres)
- Norma (default "RDC 222/2018")
- Ativo

### 14.3 Método de descarte (`descarte-metodo`)

Métodos físicos de descarte. Tipicamente: AUTOCLAVE, INCINERACAO, COLETA_EXTERNA.

**Campos:** Código, Descrição, Fase, Ativo.

### 14.4 Norma (`norma`)

Normas regulatórias aplicáveis. Tipicamente: RDC 222/2018, RDC 786/2023, ISO 15189, RDC 978/2025.

**Campos:**
- Código, Descrição (até 200 caracteres)
- Fase
- Órgão (ex.: "ANVISA", "ABNT", "SBPC/ML")
- Ativo

### 14.5 Finalidade (`finalidade`)

Finalidade de uso da amostra. Tipicamente: CLINICA, REPETICAO, PESQUISA, ENSINO, CONTROLE_QUALIDADE.

**Campos:**
- Código, Descrição, Fase
- Requer TCLE (S/N): se finalidade exige consentimento
- Ativo

> **Atenção:** finalidade com **Requer TCLE = S** sinaliza que amostras usadas para ela exigem termo de consentimento. Hoje isso é apenas marcador — a gestão ativa de TCLE entrará em versões futuras.

---

## 15. Regras de retenção

Determinam quanto tempo cada amostra deve ficar guardada.

### 15.1 Tela: `soroteca-retencao-regra`

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Prazo (dias) | Sim | Quantos dias a amostra deve ficar guardada |
| Prazo mínimo (dias) | Não | Default 0 — proíbe descarte antes desse tempo, mesmo que regulamento permita |
| Prioridade | Sim | Default 10 — em caso de conflito de regras, a de maior prioridade vence |
| Tipo de material | Não | A regra vale apenas para esse material? |
| Finalidade | Não | A regra vale apenas para essa finalidade? |
| Norma | Não | A regra é exigida por essa norma? |
| Código do exame | Não | A regra vale apenas para esse exame? |
| Permite prorrogação (S/N) | — | Se a regra permite estender o prazo |
| Fase | Não | 1=clínico, 2=biorrepositório, 3=pesquisa |
| Descrição | Não | Texto explicativo |

### 15.2 Como funciona o matching

Quando uma amostra entra na Soroteca, o sistema procura a regra que melhor se aplica:

- Se você cadastrar uma regra com **só material** preenchido, ela vale para qualquer finalidade/norma daquele material.
- Se cadastrar uma com **material + finalidade**, ela é mais específica e tem prioridade quando os dois combinam.
- Em empate, vence a regra com **maior prioridade** numérica.

### 15.3 Exemplo de configuração

Cenário: laboratório com 3 regras

| Material | Finalidade | Prazo | Prioridade | Quando vale |
|---|---|---|---|---|
| Soro | — | 7 dias | 10 | Qualquer soro, qualquer uso |
| Soro | Pesquisa | 1825 dias (5 anos) | 100 | Soro especificamente para pesquisa |
| — | Judicial | 9999 dias | 1000 | Qualquer material com finalidade judicial |

Quando uma amostra de soro entra com finalidade de pesquisa, a **segunda regra** vence (combina em material e finalidade). Se a finalidade for judicial, a **terceira** vence (prioridade maior).

### 15.4 Boa prática

Comece com poucas regras simples e amplie conforme a operação for amadurecendo. Regras demais ficam difíceis de auditar.

---

## 16. Alíquotas e derivados

Para laboratórios que fazem subdivisão de amostras (alíquotas) ou extração de material (derivados).

### 16.1 Alíquota (`soroteca-aliquota`)

Uma fração da amostra primária com identidade própria.

**Campos principais:**

| Campo | Descrição |
|---|---|
| Amostra primária | Vínculo com `infolab_atendimento_amostra` |
| Status | Estado da alíquota |
| Tipo de material | Soro, plasma, etc. |
| Tipo de recipiente | Criotubo, Eppendorf, etc. |
| Finalidade | Para que vai ser usada |
| Regra de retenção | Aplicada automaticamente baseada na regra |
| Número da alíquota | 1, 2, 3... (default 1) |
| Freeze-thaw count | Quantas vezes congelou e descongelou |
| Volume nominal (mL) | Volume original |
| Volume residual (mL) | Volume disponível agora |
| Data de aliquotagem | Quando foi gerada |
| Data de validade | Calculada pela regra de retenção |
| Barcode | Código de barras 1D |
| Barcode 2D | Código 2D opcional (para criotubos pequenos) |

**Quando usar:** laboratórios de pesquisa, biobancos, e alguns laboratórios clínicos que separam material para reanálise.

### 16.2 Derivado (`soroteca-derivado`)

Material extraído de uma alíquota — geralmente DNA, RNA, proteína.

**Campos principais:**

| Campo | Descrição |
|---|---|
| Alíquota pai | Vínculo com a alíquota da qual foi extraído |
| Tipo de derivado | DNA, RNA, PROTEINA_TOTAL, BIBLIOTECA_NGS |
| Status | Estado do derivado |
| Regra de retenção | Pode ser diferente da alíquota |
| Freeze-thaw count | Próprio (separado da alíquota) |
| Concentração (ng/μL) | Concentração medida |
| Pureza 260/280 | Indicador de pureza protéica |
| Pureza 260/230 | Indicador de contaminação química |
| Data de preparação | Quando foi extraído |

**Quando usar:** laboratórios de biologia molecular, NGS, painéis genéticos, biobancos.

---

## 17. Bloqueios

Mecanismo para impedir uso ou descarte de uma amostra mesmo dentro do prazo.

### 17.1 Quando criar um bloqueio

- **Bloqueio judicial:** chegou ofício do Ministério Público ou da Justiça pedindo preservação.
- **Bloqueio técnico:** suspeita de contaminação, defeito do equipamento, investigação interna.
- **Bloqueio de qualidade:** investigação de não-conformidade.
- **Bloqueio de consentimento:** paciente solicitou exclusão (LGPD) — manter até definição.

### 17.2 Tela: `soroteca-bloqueio`

**Campos principais:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Tipo de bloqueio | Sim | Vem do cadastro de "Tipo de bloqueio" |
| Motivo | Sim | Descrição do oficio/justificativa |
| Número do processo | Não | Para bloqueios judiciais |
| Data/hora de início | Sim | Quando começou |
| Data/hora de fim | Não | Preencher só ao liberar |
| Vinculado a | Sim | Amostra OU alíquota OU derivado (escolher um) |
| Observações de liberação | Não | Texto livre — preencher ao liberar |
| Ativo | — | S enquanto vigente, N após liberação |

### 17.3 O que o bloqueio faz

Depende do **tipo de bloqueio** (cadastrado em "Tipo de bloqueio" — ver item 21):

- Tipo com **Impede descarte = S** → não permite incluir a amostra em lote de descarte.
- Tipo com **Impede uso = S** → não permite retirar para repetição.
- Tipo com **Requer autenticação para liberação = S** → exige login adicional ao liberar.

### 17.4 Liberando um bloqueio

Quando o motivo do bloqueio cessa:

1. Edite o registro do bloqueio.
2. Marque **Ativo = N**.
3. Preencha **Data/hora de fim**.
4. Preencha **Observações de liberação** com a justificativa.
5. Salve.

> **Importante:** bloqueios liberados ficam no histórico. Não são apagados.

### 17.5 Múltiplos bloqueios simultâneos

Uma mesma amostra pode estar bloqueada por mais de um motivo ao mesmo tempo (ex.: judicial + técnico). Cada bloqueio é um registro separado, e a amostra continua bloqueada enquanto **qualquer um** estiver ativo.

---

## 18. Lotes de descarte

Forma controlada de descartar amostras vencidas ou inadequadas, com aprovação e relatório.

### 18.1 Visão geral do fluxo

```
1. Identificar amostras candidatas a descarte (vencidas, sem bloqueio)
2. Criar um Lote de descarte com cabeçalho (responsável, empresa coletora, etc.)
3. Adicionar Itens ao lote, um por amostra/alíquota/derivado
4. Sistema bloqueia automaticamente amostras com bloqueio ativo
5. Aprovar e executar o lote
6. Gerar relatório (manifesto)
```

### 18.2 Lote de descarte (`descarte-lote`)

Cabeçalho do lote.

**Campos principais:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Número do lote | Sim | Identificador único (ex.: "2026-00001") |
| Data/hora do descarte | Sim | Quando foi/será descartado |
| Empresa coletora | Não | Nome da empresa de RSS |
| CNPJ da empresa | Não | CNPJ da coletora |
| Número do manifesto | Não | Número do MTR (manifesto de transporte de resíduo) |
| Observações | Não | Texto livre |
| Assinatura do responsável | Não | Identificação de quem aprovou |

### 18.3 Item de descarte (`descarte-item`)

Cada amostra/alíquota/derivado descartado dentro do lote.

**Campos principais:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Lote | Sim | A qual lote pertence |
| Motivo de descarte | Sim | VENCIMENTO, EXCURSAO_TERMICA, REVOGACAO_TCLE, INADEQUACAO |
| Método de descarte | Sim | AUTOCLAVE, INCINERACAO, COLETA_EXTERNA |
| Grupo de resíduo | Sim | A1, A2, B, E (RDC 222/2018) |
| Vinculado a | Sim | Amostra OU alíquota OU derivado |
| Volume descartado (mL) | Não | Quantidade |
| Observações | Não | Texto livre |

### 18.4 Boas práticas

- Crie **um lote por dia ou por turno** de descarte, com um responsável claro.
- **Sempre vincule** o item ao motivo, método e grupo de resíduo correto — facilita auditoria PALC.
- Para **descarte por excursão térmica**, vincule também ao registro de quarentena (item 19).

---

## 19. Registro de temperatura e quarentena

Controle térmico dos equipamentos.

### 19.1 Log de temperatura (`temperatura-log`)

Cada leitura de temperatura, manual ou automática.

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Equipamento | Sim | Qual equipamento foi medido |
| Temperatura (°C) | Sim | Valor lido |
| Data/hora da leitura | Sim | Quando |
| Leitura automática | — | S = veio de sensor IoT, N = manual |
| Em excursão | — | S = está fora da faixa do equipamento |
| Observações | Não | Texto livre |

> **Boa prática:** se seu laboratório ainda não tem sensores automáticos, faça leitura manual **a cada turno** (3× ao dia para freezers críticos, 1× ao dia para geladeiras estáveis).

### 19.2 Quando entra "em excursão"

Quando a temperatura lida está **fora da faixa** definida no cadastro do equipamento (Tipo de equipamento → temperatura mín./máx.). O sistema marca o log com `Em excursão = S`.

### 19.3 Quarentena de temperatura (`temperatura-quarentena`)

Quando há excursão, é criado um registro de quarentena para análise.

**Campos:**

| Campo | Descrição |
|---|---|
| Equipamento | Qual equipamento |
| Log de temperatura | Vínculo com a leitura que originou |
| Data/hora de início | Quando começou |
| Data/hora de fim | Quando foi resolvido |
| Temperatura registrada (°C) | Valor da excursão |
| Status | ABERTA, EM_ANALISE, DECIDIDA |
| Decisão | LIBERAR, BLOQUEAR, DESCARTAR |
| Justificativa | Texto explicativo |

### 19.4 Fluxo de decisão

1. Leitura registra excursão (manual ou automática).
2. Sistema cria quarentena com status ABERTA.
3. Supervisor analisa, muda status para EM_ANALISE, investiga (duração, criticidade, amostras afetadas).
4. Toma decisão:
   - **LIBERAR:** equipamento voltou ao normal, amostras estão íntegras. Status → DECIDIDA, Decisão = LIBERAR.
   - **BLOQUEAR:** amostras podem estar comprometidas. Cria bloqueios em todas as amostras do equipamento naquele intervalo. Status → DECIDIDA, Decisão = BLOQUEAR.
   - **DESCARTAR:** amostras não são mais utilizáveis. Cria lote de descarte com motivo EXCURSAO_TERMICA. Status → DECIDIDA, Decisão = DESCARTAR.

5. Justificativa documentada serve para auditoria futura.

---

## 20. Eventos de qualidade

Registro de não-conformidades relacionadas à Soroteca.

### 20.1 Tela: `qualidade-evento`

**Campos:**

| Campo | Obrigatório | Descrição |
|---|---|---|
| Tipo de evento | Sim | DESVIO_TEMPERATURA, CONTAMINACAO, EXTRAVIO, ETIQUETA_DANIFICADA, etc. |
| Vinculado a | Não | Amostra, alíquota, derivado ou equipamento |
| Data/hora do evento | Sim | Quando ocorreu |
| Descrição | Sim | Texto descritivo |
| Ação tomada | Não | Texto da ação corretiva |
| Status de resolução | — | ABERTO (default), EM_ANALISE, RESOLVIDO |
| Data/hora da resolução | Não | Preencher ao resolver |

### 20.2 Quando registrar

- Toda vez que algo "fora do padrão" acontece e precisa virar evidência para auditoria.
- Não é punitivo — é evidência de que o laboratório monitora e corrige problemas.

### 20.3 Conexão com tipo de evento

O **tipo de evento de qualidade** (cadastro em Tabelas — item 21) define a **gravidade**: BAIXA, MEDIA, ALTA, CRITICA. Ajuda a priorizar.

---

# Parte 4 — Cadastros de tipos (Cadastros → Tabelas)

## 21. Tipos e motivos — quando mexer

O ramo **Cadastros → Tabelas** tem 8 entradas relacionadas à Soroteca. **Geralmente já vêm preenchidas na implantação** — você só mexe se precisar criar tipos novos específicos do seu laboratório.

| Item de menu | Tabela | Quando criar |
|---|---|---|
| **Tipo de material** | Tipos como Soro, Plasma, Sangue total, Urina | Se seu laboratório usa material não padrão |
| **Tipo de recipiente** | Tubo EDTA, Criotubo, Eppendorf, Falcon | Se você usa recipiente especial |
| **Tipo de equipamento** | Geladeira 2-8°C, Freezer -20°C, Ultrafreezer -80°C, Criotanque | Quando comprar equipamento de classe nova |
| **Tipo de movimento** | ENTRADA, RETIRADA, TRANSFERENCIA, ENVIO_APOIO, RETORNO_APOIO, DESCARTE | Raramente — vêm padronizados |
| **Tipo de bloqueio** | JUDICIAL, TECNICO, QUALIDADE, CONSENTIMENTO | Se precisar de categoria nova |
| **Tipo de derivado** | DNA, RNA, PROTEINA_TOTAL, BIBLIOTECA_NGS | Quando começar a fazer extração nova |
| **Tipo de evento de qualidade** | DESVIO_TEMPERATURA, CONTAMINACAO, EXTRAVIO | Se precisar nova categoria |
| **Motivo de descarte** | VENCIMENTO, EXCURSAO_TERMICA, REVOGACAO_TCLE, INADEQUACAO | Raramente |

### 21.1 Estrutura comum dos cadastros de tipo

Todos os cadastros de "tipo" seguem padrão semelhante:

| Campo | Descrição |
|---|---|
| Código | Identificador único (ex.: `FREEZER_20`) |
| Descrição | Nome legível (ex.: "Freezer -20°C") |
| Fase | 1=clínico, 2=biorrepositório, 3=pesquisa |
| Ativo | S/N |

E alguns têm campos próprios:

- **Tipo de equipamento**: Temperatura mín./máx. (°C)
- **Tipo de recipiente**: Volume nominal (mL), Aditivo, Cor da tampa
- **Tipo de movimento**: Requer autenticação (S/N)
- **Tipo de bloqueio**: Impede descarte (S/N), Impede uso (S/N), Requer autenticação para liberação (S/N)
- **Tipo de evento de qualidade**: Gravidade (BAIXA/MEDIA/ALTA/CRITICA)

### 21.2 Atenção ao alterar tipos existentes

> ⚠️ **Não desative tipos** que já estão sendo usados em registros. Se você desativar "Tipo de equipamento = Freezer -20°C" e houver freezers cadastrados desse tipo, eles continuam funcionando — mas você não consegue cadastrar mais freezers dessa categoria. Para isso, prefira criar tipo novo e migrar manualmente.

---

# Parte 5 — Auditoria e consulta

## 22. Histórico de movimentações

Toda movimentação na Soroteca fica registrada permanentemente em `soroteca-movimento`.

### 22.1 Tela: `soroteca-movimento` (somente leitura)

```
Menu → Cadastros → Soroteca → Movimento
```

**O que mostra:**

| Coluna | Descrição |
|---|---|
| ID | Identificador único do movimento |
| Tipo de movimento | ENTRADA, RETIRADA, TRANSFERENCIA, etc. |
| Data/hora | Quando ocorreu |

Abrindo o detalhe (clicando em um item):

- Vínculo com amostra/alíquota/derivado
- Posição de origem e destino
- Volume usado (em casos aplicáveis)
- Motivo
- Hash de custódia (para verificação criptográfica)
- Número de manifesto (para envios externos)
- Laboratório de apoio (em envios)
- IP e aplicação que originou

> **Importante:** essa tela é **só consulta**. Não é possível criar, editar ou apagar movimentos manualmente — o que garante a integridade da cadeia de custódia exigida por PALC e ISO 15189.

### 22.2 Para que serve

- Reconstituir o **histórico completo** de uma amostra: filtre por amostra para ver tudo que aconteceu com ela.
- **Auditoria PALC:** evidenciar cadeia de custódia.
- **Investigação:** rastrear movimentações suspeitas.

### 22.3 Hash de custódia

Cada movimento tem um campo **hash_custodia** — um código de 64 caracteres que pode ser usado para verificar se o registro foi alterado. Isso é a base técnica da inviolabilidade da trilha.

---

## 23. Auditoria da soroteca

Trilha completa de **toda** alteração em **toda** tabela da Soroteca.

### 23.1 Tela: `soroteca-auditoria` (somente leitura)

```
Menu → Cadastros → Soroteca → Auditoria soroteca
```

**O que mostra:**

| Coluna | Descrição |
|---|---|
| ID | Identificador único do registro de auditoria |
| Operação | I (insert), U (update), D (delete) |
| Tabela | Qual tabela foi afetada |
| Registro | ID do registro afetado |
| Data/hora do evento | Quando |

Abrindo o detalhe:

- **Hash anterior:** hash do registro antes da operação
- **Hash atual:** hash do registro depois da operação
- **Dados antes:** snapshot JSON do registro antes
- **Dados depois:** snapshot JSON do registro depois
- **Login do usuário:** quem fez
- **Aplicação:** de onde veio (web, API, etc.)
- **Session ID:** sessão de login
- **IP:** de onde veio

### 23.2 Para que serve

- **Auditoria forense:** "quem mudou o status dessa amostra ontem às 14h32?"
- **Investigação de não-conformidade:** "essa caixa foi marcada como inativa por quem e por quê?"
- **Conformidade ISO 15189 / PALC:** evidência de integridade do sistema.

### 23.3 Cadeia de hashes

Cada operação grava `hash_anterior` (que aponta para o último hash daquele registro) e `hash_atual`. Isso forma uma cadeia: se alguém manipular o banco diretamente, a cadeia quebra e fica detectável.

---

# Parte 6 — Referências

## 24. Estados de amostra no mapa

Reprodução completa, para consulta rápida.

| Cor | Estado | Significado | O que fazer |
|---|---|---|---|
| 🟢 | **Livre** | Sem amostra | Pode armazenar |
| ⬜ | **Inativo** | Poço desabilitado pelo supervisor | Use outro poço |
| 🔵 | **Ocupada** | Amostra dentro do prazo | Tudo certo |
| 🟡 | **Vencendo** | ≤ 7 dias para vencer | Verifique se precisa repetir alguma análise antes do descarte |
| 🔴 | **Vencida** | Passou da validade | Candidata a lote de descarte |
| 🟣 | **Em uso** | Amostra retirada e ainda não devolvida | Verifique com quem retirou |
| ⚫ | **Rejeitada** | Marcada como rejeitada | Não use; vai para descarte |
| 🟤 | **Descartada** | Já foi descartada | Histórico apenas |
| ⚠️ | **Conflito** | Mais de uma amostra ativa no mesmo poço | Reporte ao suporte — erro de operação |

---

## 25. Mensagens de erro frequentes

### 25.1 No armazenamento

| Mensagem | Causa | Solução |
|---|---|---|
| "Caixa inativa; não é possível armazenar amostras." | Caixa marcada inativa | Use outra ou peça reativação |
| "Posição fora dos limites da caixa." | Erro técnico raro | Reporte ao suporte |
| "Posição inativa; escolha outra." | Poço desabilitado | Outro poço |
| "Amostra rejeitada ou descartada não pode ser armazenada." | Status incompatível | Verifique status no atendimento |
| "Amostra já está armazenada em outra posição; remova antes de realocar." | Já está em outra caixa ativa | Remova primeiro |
| "Já existe amostra ativa nesta posição." | Conflito de operadores | Atualize o mapa (F5) |
| "Amostra não encontrada neste laboratório." | Código errado | Confira o barcode |
| "Tipo de movimento ENTRADA não encontrado no catálogo." | Configuração incompleta | Chame o admin |

### 25.2 No cadastro de caixa

| Mensagem | Causa | Solução |
|---|---|---|
| "Informe o código da caixa." | Campo vazio | Preencha |
| "Já existe uma caixa com o código X" | Código duplicado | Use outro |
| "Rack não encontrado neste laboratório." | Rack inválido | Verifique cadastro |
| "Dimensões da caixa inválidas." | Linhas ou colunas zero/negativas | Use valores ≥ 1 |

### 25.3 Na retirada

| Mensagem | Causa | Solução |
|---|---|---|
| "Amostra não está armazenada nesta caixa." | Você está na caixa errada | Localize a caixa correta |
| "Tipo de movimento TRANSFERENCIA não encontrado no catálogo." | Configuração incompleta | Chame o admin |

### 25.4 Em cadastros (geral)

| Mensagem | Causa | Solução |
|---|---|---|
| "Recurso é somente leitura (log/auditoria)." | Você tentou criar/editar em tabela imutável | Apenas consulte |
| "Recurso de cadastro soroteca inválido: X" | URL malformada | Use o menu, não digite URL |
| "Este tipo de cadastro ainda não possui formulário habilitado na API nesta versão." | Funcionalidade pendente | Aguarde nova versão |

---

## 26. Atalhos e dicas de produtividade

### 26.1 Velocidade no armazenamento

- **Mantenha o leitor de barcode plugado e em foco** na hora de bipar — evita digitação manual.
- **Use modo lote:** ao armazenar 50 amostras na mesma caixa, mantenha o mapa aberto e bipe sequencialmente.
- **Defina um padrão de codificação de caixas** (ex.: `[SETOR]-[ANO]-[NUM]`: `BIOQ-2026-001`). Facilita encontrar.

### 26.2 Encontrando amostras rapidamente

- **Pelo número de atendimento:** vá ao módulo de Atendimentos e veja onde a amostra está armazenada (campos `id_local_armazenamento`, `id_soroteca_grade`, `codigo_poco`).
- **Pelo nome do paciente:** busque o atendimento dele primeiro, depois siga o link para a amostra.
- **Pela posição na caixa:** abra o mapa, passe o mouse para ver o conteúdo de cada poço.

### 26.3 Manutenção preventiva

- **Toda semana:** verifique caixas com muitas amostras vencendo (cor amarela) para preparar lote de descarte.
- **Todo mês:** revise caixas inativas — elas estão realmente fora ou esqueceram de reativar?
- **Todo trimestre:** valide com o supervisor se as regras de retenção continuam refletindo a política do laboratório.

### 26.4 Para auditoria

- Antes de auditoria PALC ou ISO 15189, peça relatório do:
  - **Histórico de movimentações** do trimestre (tela Movimento)
  - **Lotes de descarte** do período
  - **Eventos de qualidade** abertos e fechados
  - **Quarentenas de temperatura** e suas decisões

---

## 27. Glossário

| Termo | Definição |
|---|---|
| **Alíquota** | Fração de uma amostra primária com identidade própria (volume, validade, código). Pode ser usada independentemente. |
| **Amostra primária** | Tubo original tal como veio da coleta (ex.: tubo EDTA com sangue total). |
| **BIMS** | *Biobank Information Management System* — sistemas focados em biobancos e biorrepositórios para pesquisa. |
| **Bloqueio** | Impedimento ativo de uso ou descarte de uma amostra. Tipos: judicial, técnico, qualidade, consentimento. |
| **Cadeia de custódia** | Trilha auditável de quem tocou na amostra, quando, onde estava, para onde foi e por quê. Exigida por PALC e ISO 15189. |
| **Caixa** | Estrutura física com grade que comporta os tubos. Capacidade típica: 9×9, 10×10, 12×12. |
| **Derivado** | Material extraído de uma alíquota — DNA, RNA, proteína, biblioteca NGS. |
| **Equipamento** | Freezer, geladeira, ultrafreezer, criotanque ou armário. |
| **Excursão térmica** | Leitura de temperatura fora da faixa especificada do equipamento. |
| **Freeze-thaw count** | Contador de ciclos congela-descongela. Cada ciclo degrada amostras biológicas; é importante rastrear. |
| **Hash de custódia** | Código criptográfico que identifica unicamente um movimento, permitindo verificar inviolabilidade. |
| **LIS** | *Laboratory Information System* — sistemas focados em análises clínicas. |
| **LIMS** | *Laboratory Information Management System* — sistemas focados em laboratórios industriais e de pesquisa, com ênfase em cadeia de custódia. |
| **Manifesto** | Documento que acompanha o transporte de resíduos de serviços de saúde. MTR. |
| **PALC** | Programa de Acreditação de Laboratórios Clínicos da SBPC/ML. |
| **Poço / Posição** | Célula da caixa identificada por (linha, coluna, rótulo). Ex.: A1, B12. |
| **Quarentena** | Estado intermediário entre detecção de excursão e decisão final (liberar/bloquear/descartar). |
| **Rack** | Compartimento, gaveta ou prateleira dentro do equipamento. |
| **RDC 222/2018** | Regulamento da ANVISA sobre Resíduos de Serviços de Saúde (RSS). |
| **RDC 978/2025** | Regulamento da ANVISA sobre serviços que executam Análises Clínicas. |
| **Regra de retenção** | Política parametrizável que determina por quanto tempo cada amostra deve ser guardada. |
| **Sala** | Ambiente físico onde os equipamentos ficam. |
| **Soroteca** | Coleção de amostras armazenadas após o processamento, para uso clínico (repetição, complementação) ou auditoria. |
| **TCLE** | Termo de Consentimento Livre e Esclarecido. Obrigatório para uso de amostra em pesquisa. |
| **Tenant / tenacidade** | Cliente/laboratório isolado no sistema multi-tenant. |
| **Tipo de equipamento** | Categoria do equipamento — geladeira, freezer, ultrafreezer, etc. — com faixa de temperatura padrão. |

---

## 28. Suporte e canais de ajuda

### 28.1 Antes de chamar o suporte

Verifique se:

- ✅ Você está na tela certa (use o menu, não URLs digitadas)
- ✅ Você tem permissão (alguns recursos exigem perfil de supervisor)
- ✅ Você releu a mensagem de erro com atenção (ela costuma dizer exatamente o que está errado)
- ✅ A configuração inicial foi rodada (cadastros básicos existem)
- ✅ Você tentou atualizar a página (F5)

### 28.2 Quando chamar o suporte

Para:

- Mensagens com "Reporte ao suporte" explícito
- Telas em branco ou erro de servidor (HTTP 500)
- Caixas com aviso de "células sem registro de posição"
- Conflitos persistentes ("já existe amostra ativa nesta posição" mesmo após F5)
- Necessidade de adicionar **tipos novos** (de equipamento, bloqueio, etc.) que não existem ainda
- Solicitações de extração de relatórios ou consultas customizadas

### 28.3 Informações para ter em mãos

Ao abrir chamado, informe:

- **Nome do seu laboratório (tenant)**
- **Seu nome de usuário no sistema**
- **Tela exata** onde o problema aparece (caminho do menu)
- **Mensagem de erro** completa (copie e cole)
- **O que você estava tentando fazer** quando o erro apareceu
- **Captura de tela** se possível
- **Hora aproximada** do problema (útil para localizar no log)

### 28.4 Documentação técnica complementar

Para administradores e desenvolvedores:

- `ai/domains/soroteca/Context.md` — visão geral do domínio
- `ai/domains/soroteca/Schema.md` — modelo de dados completo
- `ai/domains/soroteca/Rules.md` — regras de negócio implementadas
- `ai/domains/soroteca/Examples.md` — exemplos de uso
- `ai/domains/soroteca/Menu-e-Telas.md` — mapa de telas e rotas

---

## Histórico do manual

| Versão | Data | Resumo |
|---|---|---|
| 1.0 | Maio/2026 | Versão inicial. Cobre operação diária, cadastros, auditoria. |

---

*Em caso de divergência entre este manual e o sistema, prevalece o sistema. Atualize este documento a cada release que mude a UI da Soroteca.*

> **Próxima revisão prevista:** quando a tela de Soroteca Express for implementada, ou quando o fluxo de TCLE/projetos de pesquisa entrar em produção.
