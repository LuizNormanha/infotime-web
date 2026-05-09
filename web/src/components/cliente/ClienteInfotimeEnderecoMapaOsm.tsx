"use client";

type Props = {
  lat: number | null;
  lon: number | null;
  mensagemSemCoordenadas: string;
  /** `embutido`: pré-visualização baixa no formulário; `dialog`: área ampla no modal. */
  apresentacao?: "embutido" | "dialog";
};

/**
 * Mapa embutido (OpenStreetMap) a partir de latitude/longitude.
 * Mesmo padrão do `infolab-dst-app` (`ClienteEnderecoMapaOsm`): iframe de exportação OSM.
 */
export function ClienteInfotimeEnderecoMapaOsm({
  lat,
  lon,
  mensagemSemCoordenadas,
  apresentacao = "embutido",
}: Props) {
  const classeCascaIframe =
    apresentacao === "dialog"
      ? "liga-cliente-infotime-endereco-mapa-iframe-casca liga-cliente-infotime-endereco-mapa-iframe-casca--dialog"
      : "liga-cliente-infotime-endereco-mapa-iframe-casca";

  const classeVazio =
    apresentacao === "dialog"
      ? "liga-cliente-infotime-endereco-mapa-vazio liga-cliente-infotime-endereco-mapa-vazio--dialog"
      : "liga-cliente-infotime-endereco-mapa-vazio";

  if (
    lat == null ||
    lon == null ||
    Number.isNaN(lat) ||
    Number.isNaN(lon) ||
    lat < -90 ||
    lat > 90 ||
    lon < -180 ||
    lon > 180
  ) {
    return <div className={classeVazio}>{mensagemSemCoordenadas}</div>;
  }

  const delta = 0.008;
  const bbox = `${lon - delta},${lat - delta},${lon + delta},${lat + delta}`;
  const src = `https://www.openstreetmap.org/export/embed.html?bbox=${encodeURIComponent(bbox)}&layer=mapnik&marker=${encodeURIComponent(`${lat},${lon}`)}`;

  return (
    <div className={classeCascaIframe}>
      <iframe
        key={`${lat},${lon}`}
        title="Mapa do endereço"
        className="liga-cliente-infotime-endereco-mapa-iframe"
        src={src}
        loading="lazy"
        referrerPolicy="no-referrer-when-downgrade"
        scrolling="no"
      />
    </div>
  );
}
