/** Consultas ao Nominatim a partir dos campos de endereço do formulário InfoTIME (espelha `infolab-dst-app`). */

export type EnderecoParaGeocode = {
  cep: string;
  tipoLogradouro: string;
  logradouro: string;
  numero: string;
  complemento: string;
  bairro: string;
  cidade: string;
  estado: string;
};

function cepSoDigitos(v: string): string {
  return String(v ?? "")
    .replace(/\D/g, "")
    .slice(0, 8);
}

function cepFormatado(cep8: string): string {
  return cep8.length === 8 ? `${cep8.slice(0, 5)}-${cep8.slice(5)}` : "";
}

export function chaveEnderecoInfotimeParaGeocode(d: EnderecoParaGeocode): string {
  return [
    cepSoDigitos(d.cep),
    d.cidade.trim().toUpperCase(),
    d.estado.trim().toUpperCase(),
    d.logradouro.trim().toUpperCase(),
    d.bairro.trim().toUpperCase(),
    d.numero.trim().toUpperCase(),
    d.complemento.trim().toUpperCase(),
    d.tipoLogradouro.trim().toUpperCase(),
  ].join("|");
}

/** CEP só dígitos (até 8) — primeiro campo de `chaveEnderecoInfotimeParaGeocode`. */
export function cep8DaChaveGeocodeInfotime(chave: string): string {
  const i = chave.indexOf("|");
  return i === -1 ? chave : chave.slice(0, i);
}

/** Do mais específico ao mais genérico (inclui só CEP enquanto ViaCEP ainda não preencheu cidade/UF). */
export function consultasNominatimInfotime(d: EnderecoParaGeocode): string[] {
  const cid = d.cidade.trim();
  const uf = d.estado.trim().toUpperCase();
  const cidadeUfOk = cid.length >= 2 && uf.length === 2;

  const logra = d.logradouro.trim();
  const bai = d.bairro.trim();
  const cep8 = cepSoDigitos(d.cep);
  const cepFmt = cepFormatado(cep8);

  const pushDistinto = (s: string, acc: string[]) => {
    const t = s.trim();
    if (t.length < 8) return;
    if (!acc.includes(t)) acc.push(t);
  };

  const out: string[] = [];

  if (cidadeUfOk && (logra || bai)) {
    const tipo = d.tipoLogradouro.trim();
    const parts = [
      tipo ? `${tipo} ${logra}`.trim() : logra,
      d.numero.trim(),
      bai,
      d.complemento.trim(),
      ...(cep8.length === 8 ? [cepFmt] : []),
      cid,
      uf,
      "Brasil",
    ].filter((p) => p.length > 0);
    pushDistinto(parts.join(", "), out);
  }

  if (cep8.length === 8) {
    if (cidadeUfOk) {
      pushDistinto([cepFmt, cid, uf, "Brasil"].join(", "), out);
    } else {
      pushDistinto([cepFmt, "Brasil"].join(", "), out);
    }
  }

  return out;
}
