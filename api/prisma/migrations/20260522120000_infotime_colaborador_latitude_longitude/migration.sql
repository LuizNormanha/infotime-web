-- Coordenadas do endereço (mapa / geocodificação).
ALTER TABLE "infotime_colaborador"
  ADD COLUMN "latitude" DOUBLE PRECISION,
  ADD COLUMN "longitude" DOUBLE PRECISION;
