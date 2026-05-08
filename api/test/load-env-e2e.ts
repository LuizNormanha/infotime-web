/**
 * Carrega `api/.env` antes do `AppModule` validar variáveis obrigatórias nos e2e.
 */
import path from 'path';
import { config } from 'dotenv';

config({ path: path.join(__dirname, '..', '.env') });
