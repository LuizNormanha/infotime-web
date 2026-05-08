'use client';

import { useState } from 'react';
import { useRouter } from 'next/navigation';

export default function TelaAcessoSuporte() {
  const router = useRouter();

  const [numeroChamado, setNumeroChamado] = useState('');
  const [motivoAcesso, setMotivoAcesso] = useState('');
  const [erro, setErro] = useState<string | null>(null);
  const [carregando, setCarregando] = useState(false);

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    setErro(null);

    if (!numeroChamado.trim() && !motivoAcesso.trim()) {
      setErro('Informe o número do chamado ou o motivo do acesso.');
      return;
    }

    setCarregando(true);
    try {
      const res = await fetch('/api/auth/suporte/registrar-acesso', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          numero_chamado: numeroChamado.trim() || undefined,
          motivo_acesso: motivoAcesso.trim() || undefined,
        }),
      });

      if (!res.ok) {
        setErro('Não foi possível registrar o acesso. Tente novamente.');
        return;
      }

      router.push('/home');
    } catch {
      setErro('Não foi possível registrar o acesso. Tente novamente.');
    } finally {
      setCarregando(false);
    }
  }

  return (
    <div className="tela-suporte-acesso">
      <main className="container-formulario">
        <h1>Registro de acesso — Suporte</h1>
        <p>Informe o número do chamado ou descreva o motivo do acesso antes de continuar.</p>

        <form onSubmit={(e) => void handleSubmit(e)} className="form-suporte">
          <label htmlFor="numero-chamado">
            Número do chamado (opcional)
            <input
              id="numero-chamado"
              type="text"
              value={numeroChamado}
              onChange={(e) => setNumeroChamado(e.target.value)}
              placeholder="Ex: CHM-12345"
            />
          </label>

          <label htmlFor="motivo-acesso">
            Motivo do acesso
            <textarea
              id="motivo-acesso"
              value={motivoAcesso}
              onChange={(e) => setMotivoAcesso(e.target.value)}
              placeholder="Descreva brevemente o motivo do acesso..."
              rows={4}
            />
          </label>

          {erro && (
            <p role="alert" className="texto-erro">
              {erro}
            </p>
          )}

          <button type="submit" disabled={carregando} className="botao-primario">
            {carregando ? 'Registrando...' : 'Continuar'}
          </button>
        </form>
      </main>
    </div>
  );
}
