import type { ApiErrorResponse } from "@infotime/shared-types";

export class AppError extends Error {
  readonly statusCode: number;
  readonly code: string;
  readonly fieldErrors?: ApiErrorResponse["fieldErrors"];

  constructor(
    statusCode: number,
    code: string,
    message: string,
    fieldErrors?: ApiErrorResponse["fieldErrors"],
  ) {
    super(message);
    this.statusCode = statusCode;
    this.code = code;
    this.fieldErrors = fieldErrors;
  }

  toJSON(): ApiErrorResponse {
    return {
      code: this.code,
      message: this.message,
      fieldErrors: this.fieldErrors,
    };
  }
}
