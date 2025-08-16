import { ofetch } from "ofetch"
import { useCookie } from "#app"

export default defineNuxtPlugin(() => {
	const config = useRuntimeConfig()
	const baseURL = config.public.apiBase?.toString() || ""

	const api = ofetch.create({
		baseURL: baseURL,
		retry: 0,
		async onRequest({ options }) {
			// Attach Authorization if protected
			const token = useCookie<string | null>("token").value
			const isProtected = (options as any).protected ?? false

			if (isProtected && token) {
				options.headers = {
					...(options.headers as any),
					Authorization: `Bearer ${token}`,
				} as any
			}

			// Default headers
			options.headers = {
				Accept: "application/json",
				...options.headers,
			} as any
		},
		async onResponseError({ response }) {
			// Normalize error structure
			const error: any = {
				status: response.status,
				message: response._data?.message || "Unexpected error occurred",
				data: response._data?.data ?? null,
				success: false,
			}

			switch (response.status) {
				case 400:
					error.message = "Bad Request"
					break
				case 401:
					error.message = "Unauthorized"
					break
				case 403:
					error.message = "Forbidden"
					break
				case 404:
					error.message = "Not Found"
					break
				case 422:
					error.message = "Validation Error"
					error.errors = response._data?.errors || {}
					break
				case 500:
					error.message = "Internal Server Error"
					break
			}

			throw error
		},
	})

	return {
		provide: {
			api,
		},
	}
})
