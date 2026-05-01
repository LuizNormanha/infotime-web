import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { PrimeReactProvider } from "primereact/api";
import { QueryClientProvider } from "@tanstack/react-query";
import { RouterProvider } from "react-router-dom";
import { AuthProvider } from "./shared/auth/AuthProvider.js";
import { queryClient } from "./app/queryClient.js";
import { router } from "./app/router.js";
import "./app/primeReact.js";

const rootEl = document.getElementById("root");
if (!rootEl) throw new Error("root");

createRoot(rootEl).render(
  <StrictMode>
    <PrimeReactProvider>
      <QueryClientProvider client={queryClient}>
        <AuthProvider>
          <RouterProvider router={router} />
        </AuthProvider>
      </QueryClientProvider>
    </PrimeReactProvider>
  </StrictMode>,
);
