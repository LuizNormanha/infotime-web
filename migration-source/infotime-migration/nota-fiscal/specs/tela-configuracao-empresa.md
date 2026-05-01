# Tela: Configuração de NFS-e por Empresa
## Origem Scriptcase: `EmpresaNotaFiscal_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Empresa | `id_empresa` | select |
| Ambiente | `ambiente` | select (homologação/produção) |
| CNPJ Emitente | `emitente_cnpj` | text |
| Inscrição Municipal | `emitente_inscricao_municipal` | text |
| Código Município | `emitente_codigo_municipio` | text |
| Certificado Digital | `arquivo_certificado` | upload (PFX) |
| Senha Certificado | `senha_certificado` | password |
| Série | `serie_certificado` | text |
| Tipo NF | `tipo_nota_fiscal` | select |
| Sequencial | `sequencial_nota_fiscal` | bigint |
| Ativo | `ativo` | checkbox |

> ⚠️ Certificado armazenado em `bytea` — migrar para vault seguro (ex: HashiCorp Vault ou AWS Secrets Manager)
