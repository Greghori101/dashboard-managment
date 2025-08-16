import { navigateTo } from '#app'

export default defineNuxtRouteMiddleware((to) => {
  const token = useCookie<string | null>('token')

  // Define guest-only routes
  const guestRoutes = ['/auth/login', '/auth/signup', '/auth/forgot-password', '/auth/reset-password']

  if (guestRoutes.includes(to.path) && token.value) {
    return navigateTo('/dashboards')
  }
})
