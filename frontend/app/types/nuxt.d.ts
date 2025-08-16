import type { FetchOptions } from 'ofetch'

declare module '#app' {
  interface NuxtApp {
    $api<T = any>(
      url: string,
      options?: FetchOptions & { protected?: boolean }
    ): Promise<T>
  }
}

export {}
