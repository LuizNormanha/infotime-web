# Padrão de formulários

## Stack

- **React Hook Form** + **Zod** (`@hookform/resolvers/zod`).
- **FormShell** compartilhado: regiões fixas **cabeçalho** (título / subtítulo / erros globais), **corpo** (campos e abas) e **rodapé** (`footer`).
- **FormFooter** compartilhado: layout do rodapé (área auxiliar + **ActionsBar**), alinhamento e quebra responsiva.
- **Field components** em `shared/components/fields/`.
- **PrimeReact** para inputs visuais.
- **TabView** quando houver grupos naturais de campos (ex.: cadastro geral / endereço / fiscal).

## Estrutura do formulário (obrigatória)

```text
FormShell
  ├─ Cabeçalho: título, subtítulo opcional, mensagens globais (erro/sucesso)
  ├─ Corpo: campos, TabView, grids internos
  └─ Footer (rodapé): FormFooter — à esquerda metadados / dicas / links; à direita ActionsBar
```

- Todo formulário de cadastro/edição usa **`footer`** no `FormShell` quando houver ações primárias (Salvar, Cancelar, Excluir).
- A **ActionsBar** fica **dentro do rodapé**, tipicamente à direita via `FormFooter` (`start` + `end`).
- Não fixar botões soltos fora do rodapé quando o padrão compartilhado já cobre o caso.

## Requisitos

- Máscaras e validações **padronizadas** (CPF/CNPJ, CEP, telefone, e-mail, moeda).
- Lookups assíncronos via API dedicada (AsyncSelect) com debounce.
- Erros do backend mapeados para `setError` por campo quando `fieldErrors` presentes.
- **ActionsBar** no **Footer**, junto com **FormFooter**: Salvar, Cancelar, Excluir (se permitido).
- Não criar formulário monolítico sem reutilizar fields.

## Campos compartilhados mínimos

```text
TextField
TextareaField
NumberField
CurrencyField
DateField
DateTimeField
SelectField
AsyncSelectField
MultiSelectField
SwitchField
CheckboxField
FileField
PasswordField
CpfCnpjField
CepField
PhoneField
EmailField
```

## Exemplo de composição

```tsx
<FormShell
  title="Cliente"
  subtitle="Dados cadastrais"
  footer={
    <FormFooter
      start={<span>Última alteração: …</span>}
      end={<ActionsBar onSave={…} onCancel={…} />}
    />
  }
>
  {/* campos */}
</FormShell>
```

## Cancelamento

- Navegação de volta à lista ou rota anterior; descartar dirty state com confirmação se houver alterações.
