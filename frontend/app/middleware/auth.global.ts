import { navigateTo } from "#app"
import { useAuth } from "~/composables/use-auth"

export default defineNuxtRouteMiddleware(async (to) => {
	const publicRoutes = ["/auth/login", "/auth/signup", "/"]
	if (publicRoutes.includes(to.path)) return

	const token = useCookie<string | null>("token")

	// If no token, redirect immediately
	if (!token.value) {
		return navigateTo("/auth/login")
	}

	// Allow navigation
	return true
})
