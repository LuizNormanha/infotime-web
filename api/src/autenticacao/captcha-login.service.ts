import { Injectable } from '@nestjs/common';

type TentativaIp = {
  falhas: number;
  atualizadoEm: number;
};

type DesafioCaptcha = {
  id: string;
  pergunta: string;
  resposta: string;
  expiraEm: number;
};

export type CaptchaPublico = {
  id: string;
  pergunta: string;
};

@Injectable()
export class ServicoCaptchaLogin {
  private readonly falhasPorIp = new Map<string, TentativaIp>();
  private readonly desafiosPorIp = new Map<string, DesafioCaptcha>();

  /** Em dev o login pode ser frequente; CAPTCHA só depois de várias falhas no mesmo IP. */
  private readonly limiteFalhas = 4;
  private readonly ttlDesafioMs = 10 * 60 * 1000;

  deveExigirCaptcha(ip: string): boolean {
    this.limparExpirados();
    const registro = this.falhasPorIp.get(ip);
    return (registro?.falhas ?? 0) >= this.limiteFalhas;
  }

  registrarFalha(ip: string): void {
    this.limparExpirados();
    const atual = this.falhasPorIp.get(ip);
    this.falhasPorIp.set(ip, {
      falhas: (atual?.falhas ?? 0) + 1,
      atualizadoEm: Date.now(),
    });
  }

  registrarSucesso(ip: string): void {
    this.falhasPorIp.delete(ip);
    this.desafiosPorIp.delete(ip);
  }

  obterOuCriarDesafio(ip: string): CaptchaPublico {
    this.limparExpirados();
    const atual = this.desafiosPorIp.get(ip);
    if (atual && atual.expiraEm > Date.now()) {
      return { id: atual.id, pergunta: atual.pergunta };
    }
    const novo = this.criarDesafio();
    this.desafiosPorIp.set(ip, novo);
    return { id: novo.id, pergunta: novo.pergunta };
  }

  validarDesafio(ip: string, id: string, resposta: string): boolean {
    this.limparExpirados();
    const desafio = this.desafiosPorIp.get(ip);
    if (!desafio) return false;
    if (desafio.id !== id) return false;
    if (desafio.expiraEm <= Date.now()) return false;
    return desafio.resposta === resposta.trim();
  }

  private criarDesafio(): DesafioCaptcha {
    const a = Math.floor(Math.random() * 8) + 1;
    const b = Math.floor(Math.random() * 8) + 1;
    const operador = Math.random() < 0.5 ? '+' : '-';
    const resposta = operador === '+' ? String(a + b) : String(a - b);
    return {
      id: `${Date.now()}-${Math.random().toString(36).slice(2, 10)}`,
      pergunta: `Quanto e ${a} ${operador} ${b}?`,
      resposta,
      expiraEm: Date.now() + this.ttlDesafioMs,
    };
  }

  private limparExpirados(): void {
    const agora = Date.now();
    for (const [ip, desafio] of this.desafiosPorIp.entries()) {
      if (desafio.expiraEm <= agora) {
        this.desafiosPorIp.delete(ip);
      }
    }
    // Limpa registros de falha muito antigos para evitar crescimento infinito.
    const ttlFalhaMs = 24 * 60 * 60 * 1000;
    for (const [ip, tentativa] of this.falhasPorIp.entries()) {
      if (tentativa.atualizadoEm + ttlFalhaMs <= agora) {
        this.falhasPorIp.delete(ip);
      }
    }
  }
}
