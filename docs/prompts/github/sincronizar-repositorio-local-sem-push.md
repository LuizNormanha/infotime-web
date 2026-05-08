# Sincronizar repositório local com GitHub (sem push)

Prompt padronizado para desenvolvedores alinharem a branch local com `origin`, **sem publicar** commits. Use no Cursor (chat ou Agent) colando o bloco **Prompt para colar** abaixo.

**Documento vs mensagem no chat:** a seção 3 deste arquivo mantém o placeholder `[colocar_caminho_do_windows]` de propósito (modelo). A validação da seção 2 vale para o texto que você **cola no chat** já com o caminho real substituído — não para o simples fato de abrir ou citar este `.md`.

---

## 1. O que você precisa preencher

Substitua **`[colocar_caminho_do_windows]`** pelo caminho **absoluto** da pasta do repositório na sua máquina (onde existe a pasta `.git`).

**Exemplos válidos:**

- `C:\prj\trunk\infotime-web`
- `D:\projetos\infotime-web`

Quem usa **WSL ou Git Bash** pode usar caminho estilo `/mnt/c/...`; alinhe com o time se precisar de outro formato.

**Inválido (não substituído):**

- `[colocar_caminho_do_windows]`
- Texto genérico tipo "meu projeto" ou "pasta do repo"

---

## 2. Validação obrigatória (agente / IA)

Antes de executar **qualquer** comando de terminal (`git`, `cd`, etc.), o agente deve:

1. **Ler a mensagem do usuário no chat** (não o arquivo de documentação em si) e verificar se o caminho do repositório foi informado de forma concreta após a substituição do placeholder.
2. **Não executar nada** se ainda aparecer qualquer um dos marcadores abaixo (lista não exclusiva — use julgamento se o texto for claramente placeholder):

   - `[colocar_caminho_do_windows]`
   - `colocar_caminho_do_windows`
   - `[CAMINHO]` ou `[PATH]` sem substituir
   - Caminho vazio ou só espaços após "repo local em"

3. Se a validação falhar, responder **somente** com algo neste sentido (ajuste o tom se necessário):

   > Não executei comandos: o caminho absoluto do repositório no Windows não foi preenchido (substitua `[colocar_caminho_do_windows]` pelo caminho real, por exemplo `C:\...\infotime-web`) e cole o prompt de novo.

4. Se a validação passar: usar **`cd`** para o caminho informado e seguir as tarefas na ordem indicada no prompt.

**Critério mínimo de "preenchido":** presença de um caminho absoluto típico do Windows começando com letra de drive (`C:\`, `D:\`, …), caminho WSL/Git Bash aceito pelo time, **ou** outro equivalente explícito combinado no projeto — **e** ausência dos placeholders acima na **mensagem enviada ao agente**.

---

## 3. Prompt para colar

Copie **somente o texto** entre os delimitadores do bloco abaixo (não copie as linhas com crases). **Substitua** `[colocar_caminho_do_windows]` pelo seu caminho **antes** de colar no Cursor.

**Sobre o passo 3 do prompt:** use o nome da branch atual visto em `git branch -vv` no lugar de `<branch-atual>`. Se já existir upstream configurado (ex.: `main` rastreando `origin/main`), `git pull` sem argumentos costuma bastar; caso contrário, `git pull origin <branch-atual>`.

````text
Contexto: repo local em [colocar_caminho_do_windows] .

Objetivo: sincronizar com o GitHub trazendo commits remotos para minha branch atual, SEM enviar nada ao remoto.

Tarefas (nesta ordem):

1. `git status` e `git branch -vv` para ver branch atual, commits locais não publicados e se há alterações não commitadas.

2. Se houver alterações não commitadas que possam atrapalhar o pull: mostrar um resumo do diff (`git diff --stat` e, se útil, trechos relevantes) antes de qualquer stash ou commit. Avise e proponha: stash (com mensagem) OU commit WIP em branch local — espere minha confirmação se a política do repo exigir; senão use stash para prosseguir com segurança.

3. `git fetch origin` e integrar com o remoto usando apenas merge na branch atual: `git pull origin <branch-atual>` (substitua `<branch-atual>` pelo nome da branch atual; se já houver upstream, pode usar só `git pull`). Não usar rebase (`git pull --rebase` / rebase interativo) salvo se eu pedir explicitamente depois.

4. PROIBIDO: `git push`, `git push --force`, `--force-with-lease` para o remoto, ou qualquer comando que publique commits.

5. Se houver conflitos de merge: não escolher automaticamente "theirs" em tudo. Abrir os arquivos em conflito, priorizar manter minhas alterações locais quando forem equivalentes ou quando a intenção for preservar meu trabalho; incorporar mudanças remotas onde fizer sentido para não quebrar o projeto. Listar arquivos em conflito e resumir decisões.

6. Após resolver: `git status` sem conflitos pendentes; se aplicou stash, `git stash pop` e resolver novos conflitos se aparecerem.

7. Não rodar testes, build (`npm test`, `npm run build`, etc.) nem dev server a menos que eu peça explicitamente nesta conversa.

8. Relatório final: branch, commits que vieram do remoto, se houve stash/pop, se restam alterações locais, e comandos sugeridos para eu revisar (`git log` recente, `git diff` se aplicável).

Se algo falhar (rede, auth, divergência grave), pare e explique o próximo passo seguro sem push.
````

---

## 4. Checklist rápido (desenvolvedor)

- [ ] Substituí `[colocar_caminho_do_windows]` pelo caminho absoluto **na cópia que vou colar no chat**.
- [ ] O clone é a pasta que contém `.git`.
- [ ] Se usar agente: a mensagem não pode ainda conter o placeholder.

---

## 5. Manutenção

Alterações de fluxo (ex.: permitir rebase em caso específico) devem ser refletidas no bloco da seção 3 e comunicadas ao time (PR ou canal interno).
