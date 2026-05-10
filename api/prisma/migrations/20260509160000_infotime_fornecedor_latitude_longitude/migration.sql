-- Coordenadas do endereço (geocodificação após CEP / Nominatim).
ALTER TABLE "infotime_fornecedor"
  ADD COLUMN "latitude" DOUBLE PRECISION,
  ADD COLUMN "longitude" DOUBLE PRECISION;
