import { useCookie } from "#app"

interface User {
	id: number
	name: string
	email: string
}

interface ApiResponse<T> {
	success: boolean
	message: string
	data: T
}

export const useAuth = () => {
	const { $api } = useNuxtApp()
	const token = useCookie<string | null>("token")

	// Signup
	async function signup(payload: { name: string; email: string; password: string; password_confirmation: string }) {
		const res = await $api<ApiResponse<{ token: string; user: User }>>("/auth/signup", {
			method: "POST",
			body: payload,
			protected: false,
		})
		token.value = res.data.token
		return res
	}

	// Login
	async function login(payload: { email: string; password: string }) {
		const res = await $api<ApiResponse<{ token: string; user: User }>>("/auth/login", {
			method: "POST",
			body: payload,
			protected: false,
		})
		token.value = res.data.token
		return res
	}

	// Logout current session
	async function logout() {
		const res = await $api<ApiResponse<null>>("/auth/logout", {
			method: "POST",
			protected: true,
		})
		token.value = null
		return res
	}

	// Logout all sessions
	async function logoutAll() {
		const res = await $api<ApiResponse<null>>("/auth/logout-all", {
			method: "POST",
			protected: true,
		})
		token.value = null
		return res
	}

	// Forgot password
	async function forgotPassword(email: string) {
		return await $api<ApiResponse<null>>("/auth/forgot-password", {
			method: "POST",
			body: { email },
			protected: false,
		})
	}

	// Reset password
	async function resetPassword(payload: { email: string; token: string; password: string; password_confirmation: string }) {
		return await $api<ApiResponse<null>>("/auth/reset-password", {
			method: "POST",
			body: payload,
			protected: false,
		})
	}

	// Change password
	async function changePassword(payload: { current_password: string; new_password: string }) {
		return await $api<ApiResponse<null>>("/auth/change-password", {
			method: "POST",
			body: payload,
			protected: true,
		})
	}

	// Get current user
	async function me() {
		const res = await $api<ApiResponse<User>>("/auth/me", { protected: true })
		return res
	}

	// Update profile
	async function updateProfile(payload: Partial<User>) {
		const res = await $api<ApiResponse<User>>("/auth/me", {
			method: "PUT",
			body: payload,
			protected: true,
		})
		return res
	}

	return {
		token,
		signup,
		login,
		logout,
		logoutAll,
		forgotPassword,
		resetPassword,
		changePassword,
		me,
		updateProfile,
	}
}
