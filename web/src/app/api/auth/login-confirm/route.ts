import { NextResponse } from "next/server";
import { proxyAuthLogin } from "../proxy-login-nest";

export async function POST(request: Request) {
  let body: unknown;
  try {
    body = await request.json();
  } catch {
    return NextResponse.json(
      { message: "Corpo da requisição inválido." },
      { status: 400 },
    );
  }
  return proxyAuthLogin("login-confirm", body);
}
