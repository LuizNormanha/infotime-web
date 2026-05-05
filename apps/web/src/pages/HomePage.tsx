export function HomePage() {
  return (
    <div className="liga-home-modulo-vazio">
      <header className="liga-home-modulo-cabecalho">
        <div className="liga-home-modulo-titulo-linha">
          <span className="liga-home-modulo-barra-verde" aria-hidden />
          <h1 className="liga-home-modulo-titulo-principal">
            <i className="pi pi-home liga-home-modulo-titulo-icone" aria-hidden />
            Início
          </h1>
        </div>
        <p className="liga-home-modulo-subtitulo">
          Resumo operacional da unidade. Atalhos no menu superior abrem cada módulo numa nova aba.
        </p>
      </header>
      <div className="liga-home-conteudo-area-vazia">
        Layout-base do início preparado para próximos componentes.
      </div>
    </div>
  );
}
