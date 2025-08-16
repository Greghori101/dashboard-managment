// stores/auth.ts
import { defineStore } from "pinia"
import { useAuth } from "~/composables/use-auth"

interface User {
  id: number
  name: string
  email: string
}

export const useAuthStore = defineStore("auth", () => {
  const user = useState<User | null>("auth_user", () => null)
  const loading = useState<boolean>("auth_loading", () => false)

  const { 
    token,
    signup,
    login,
    logout,
    logoutAll,
    forgotPassword,
    resetPassword,
    changePassword,
    me,
    updateProfile 
  } = useAuth()

  async function handleSignup(payload: { name: string; email: string; password: string; password_confirmation: string }) {
    loading.value = true
    const res = await signup(payload)
    if (res.success) {
      user.value = res.data.user
    }
    loading.value = false
    return res
  }

  async function handleLogin(payload: { email: string; password: string }) {
    loading.value = true
    const res = await login(payload)
    if (res.success) {
      user.value = res.data.user
    }
    loading.value = false
    return res
  }

  async function handleLogout() {
    loading.value = true
    const res = await logout()
    if (res.success) {
      user.value = null
      token.value = null
    }
    loading.value = false
    return res
  }

  async function handleLogoutAll() {
    loading.value = true
    const res = await logoutAll()
    if (res.success) {
      user.value = null
      token.value = null
    }
    loading.value = false
    return res
  }

  async function fetchUser() {
    if (!token.value) return null
    loading.value = true
    const res = await me()
    if (res.success) user.value = res.data
    loading.value = false
    return res
  }

  async function handleUpdateProfile(payload: Partial<User>) {
    loading.value = true
    const res = await updateProfile(payload)
    if (res.success) user.value = res.data
    loading.value = false
    return res
  }

  return {
    user,
    token,
    loading,
    handleSignup,
    handleLogin,
    handleLogout,
    handleLogoutAll,
    fetchUser,
    handleUpdateProfile,
    forgotPassword,
    resetPassword,
    changePassword,
  }
})
