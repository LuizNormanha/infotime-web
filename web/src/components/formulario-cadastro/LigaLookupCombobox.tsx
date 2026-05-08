"use client";

import "./liga-lookup-combobox.css";

import { useLayoutEffect, useMemo, useRef, useState } from "react";
import type { KeyboardEvent, ReactNode } from "react";
import { InputText } from "primereact/inputtext";

import { atributosSemSugestaoBrowser } from "@/lib/input-sem-sugestao-browser";

/** Snapshot atualizado a cada render — o blur usa `setTimeout` e precisa ler o estado mais recente. */
type BlurSnapshot = {
  value: string;
  hasValidSelection: boolean;
  houveEdicaoUsuario: boolean;
  bloqueadoPosSelecao: boolean;
};

type LigaLookupComboboxProps<T> = {
  id: string;
  value: string;
  placeholder?: string;
  disabled?: boolean;
  ariaLabel: string;
  suggestions: T[];
  getSuggestionKey: (item: T, index: number) => string;
  renderSuggestion: (item: T, destacado: boolean) => ReactNode;
  onValueChange: (valor: string) => void;
  onSelectSuggestion: (item: T) => void;
  onOpenAdvanced: () => void;
  onEnterWithoutResults?: () => void;
  onClear?: () => void;
  minSearchLength?: number;
  hasValidSelection?: boolean;
  onBlurWithoutValidSelection?: (valorDigitado: string) => void;
  /** Alinha foco/rolagem em validação (`LigaFormularioCadastroBase` usa `data-campo-chave`). */
  dataCampoChave?: string;
};

export function LigaLookupCombobox<T>({
  id,
  value,
  placeholder,
  disabled = false,
  ariaLabel,
  suggestions,
  getSuggestionKey,
  renderSuggestion,
  onValueChange,
  onSelectSuggestion,
  onOpenAdvanced,
  onEnterWithoutResults,
  onClear,
  minSearchLength = 1,
  hasValidSelection = false,
  onBlurWithoutValidSelection,
  dataCampoChave,
}: LigaLookupComboboxProps<T>) {
  const [abertoSolicitado, setAbertoSolicitado] = useState(false);
  const [destacadoIx, setDestacadoIx] = useState(-1);
  const [houveEdicaoUsuario, setHouveEdicaoUsuario] = useState(false);
  const [bloqueadoPosSelecao, setBloqueadoPosSelecao] = useState(false);
  const blurTimeoutRef = useRef<number | null>(null);
  const blurSnapshotRef = useRef<BlurSnapshot>({
    value: "",
    hasValidSelection: false,
    houveEdicaoUsuario: false,
    bloqueadoPosSelecao: false,
  });
  useLayoutEffect(() => {
    blurSnapshotRef.current = {
      value,
      hasValidSelection,
      houveEdicaoUsuario,
      bloqueadoPosSelecao,
    };
  }, [value, hasValidSelection, houveEdicaoUsuario, bloqueadoPosSelecao]);
  const atingiuMinimo = value.trim().length >= minSearchLength;
  const temSugestoes = suggestions.length > 0;
  const mostrarSugestoes =
    abertoSolicitado &&
    houveEdicaoUsuario &&
    !bloqueadoPosSelecao &&
    atingiuMinimo &&
    temSugestoes;
  const idLista = `${id}-sugestoes`;

  const itemDestacado = useMemo(() => {
    if (destacadoIx < 0) return null;
    return suggestions[destacadoIx] ?? null;
  }, [suggestions, destacadoIx]);

  function fecharSugestoes() {
    setAbertoSolicitado(false);
    setDestacadoIx(-1);
  }

  function limparTimeoutBlur() {
    if (blurTimeoutRef.current != null) {
      window.clearTimeout(blurTimeoutRef.current);
      blurTimeoutRef.current = null;
    }
  }

  function selecionar(item: T) {
    limparTimeoutBlur();
    onSelectSuggestion(item);
    setBloqueadoPosSelecao(true);
    setHouveEdicaoUsuario(false);
    fecharSugestoes();
  }

  function aoTeclado(evento: KeyboardEvent<HTMLInputElement>) {
    if (disabled) return;
    if (evento.key === "ArrowDown") {
      evento.preventDefault();
      if (!atingiuMinimo || !houveEdicaoUsuario || bloqueadoPosSelecao) return;
      if (!temSugestoes) return;
      setAbertoSolicitado(true);
      setDestacadoIx((prev) => {
        if (prev < 0) return 0;
        return Math.min(prev + 1, suggestions.length - 1);
      });
      return;
    }
    if (evento.key === "ArrowUp") {
      evento.preventDefault();
      if (!atingiuMinimo || !houveEdicaoUsuario || bloqueadoPosSelecao) return;
      if (!temSugestoes) return;
      setAbertoSolicitado(true);
      setDestacadoIx((prev) => {
        if (prev <= 0) return 0;
        return prev - 1;
      });
      return;
    }
    if (evento.key === "Escape") {
      if (mostrarSugestoes) {
        evento.preventDefault();
        fecharSugestoes();
      }
      return;
    }
    if (evento.key === "Enter") {
      evento.preventDefault();
      if (!temSugestoes) {
        onEnterWithoutResults?.();
        return;
      }
      const alvo = itemDestacado ?? suggestions[0] ?? null;
      if (!alvo) {
        onEnterWithoutResults?.();
        return;
      }
      selecionar(alvo);
    }
  }

  return (
    <div className="liga-atendimento-lookup">
      <InputText
        id={id}
        value={value}
        placeholder={placeholder}
        disabled={disabled}
        className="p-inputtext-sm"
        aria-label={ariaLabel}
        data-campo-chave={dataCampoChave}
        role="combobox"
        aria-expanded={mostrarSugestoes}
        aria-controls={idLista}
        aria-autocomplete="list"
        {...atributosSemSugestaoBrowser()}
        onChange={(e) => {
          const proximoValor = e.target.value;
          onValueChange(proximoValor);
          if (blurTimeoutRef.current != null) {
            window.clearTimeout(blurTimeoutRef.current);
            blurTimeoutRef.current = null;
          }
          setHouveEdicaoUsuario(true);
          setBloqueadoPosSelecao(false);
          if (proximoValor.trim().length >= minSearchLength) {
            setAbertoSolicitado(true);
          } else {
            setAbertoSolicitado(false);
          }
          setDestacadoIx(-1);
        }}
        onKeyDown={aoTeclado}
        onBlur={() => {
          limparTimeoutBlur();
          blurTimeoutRef.current = window.setTimeout(() => {
            fecharSugestoes();
            const snap = blurSnapshotRef.current;
            const valorAtual = snap.value.trim();
            if (
              valorAtual &&
              !snap.hasValidSelection &&
              snap.houveEdicaoUsuario &&
              !snap.bloqueadoPosSelecao
            ) {
              onBlurWithoutValidSelection?.(snap.value);
            }
            blurTimeoutRef.current = null;
          }, 120);
        }}
      />
      {onClear ? (
        <button
          type="button"
          tabIndex={-1}
          className="liga-atendimento-lookup__clear"
          disabled={disabled}
          onClick={() => {
            limparTimeoutBlur();
            onClear();
            setBloqueadoPosSelecao(false);
            setHouveEdicaoUsuario(false);
            fecharSugestoes();
          }}
          aria-label="Limpar campo"
        >
          <i className="pi pi-times" aria-hidden />
        </button>
      ) : null}
      <button
        type="button"
        tabIndex={-1}
        className="liga-atendimento-lookup__lupa"
        disabled={disabled}
        onMouseDown={(e) => e.preventDefault()}
        onClick={() => {
          limparTimeoutBlur();
          fecharSugestoes();
          onOpenAdvanced();
        }}
        aria-label="Busca avançada"
      >
        <i className="pi pi-search" aria-hidden />
      </button>
      {mostrarSugestoes ? (
        <ul id={idLista} role="listbox" className="liga-atendimento-lookup__sugestoes">
          {suggestions.map((item, ix) => {
            const destacado = ix === destacadoIx;
            return (
              <li
                key={getSuggestionKey(item, ix)}
                role="option"
                aria-selected={destacado}
                className={
                  destacado
                    ? "liga-atendimento-lookup__opcao liga-atendimento-lookup__opcao--ativa"
                    : "liga-atendimento-lookup__opcao"
                }
                onMouseDown={(e) => {
                  e.preventDefault();
                  selecionar(item);
                }}
                onMouseEnter={() => setDestacadoIx(ix)}
              >
                {renderSuggestion(item, destacado)}
              </li>
            );
          })}
        </ul>
      ) : null}
    </div>
  );
}
