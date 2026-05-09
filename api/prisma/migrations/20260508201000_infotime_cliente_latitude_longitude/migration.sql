-- Coordenadas do endereço (mapa / geocodificação).
ALTER TABLE "infotime_cliente"
  ADD COLUMN "latitude" DOUBLE PRECISION,
  ADD COLUMN "longitude" DOUBLE PRECISION;
