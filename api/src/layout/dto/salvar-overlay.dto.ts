import { LayoutOverlayDto } from './layout-overlay.dto';

export class SalvarOverlayDto {
  overlay: LayoutOverlayDto;
  /** Se informado, grava layout para outro usuário (apenas uso administrativo futuro). */
  idUsuario?: string;
}
