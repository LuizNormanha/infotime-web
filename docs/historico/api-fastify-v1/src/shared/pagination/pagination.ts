import type { ListQuery } from "@infotime/shared-types";

export function toPrismaSkipTake(q: ListQuery): { skip: number; take: number } {
  const page = q.page;
  const pageSize = q.pageSize;
  return { skip: (page - 1) * pageSize, take: pageSize };
}
