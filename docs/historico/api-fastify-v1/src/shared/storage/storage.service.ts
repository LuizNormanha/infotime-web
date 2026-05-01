/** Stub MinIO/S3 — implementar upload/download conforme docs/PADRAO_UPLOAD_ARQUIVOS.md */
export const storageService = {
  async putObject(_key: string, _body: Buffer): Promise<void> {
    throw new Error("storage não configurado");
  },
};
