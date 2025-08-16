<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"
import { useRouter } from "#app"

const auth = useAuthStore()
const router = useRouter()

const initial = computed(() => {
  return auth.user?.name ? auth.user.name.charAt(0).toUpperCase() : "?"
})

const items = [
  [
    { label: "Dashboard", icon: "i-heroicons-home", to: "/dashboard" },
    { label: "Profile", icon: "i-heroicons-user", to: "/auth/profile" },
    { label: "Settings", icon: "i-heroicons-gear", to: "/auth/update-profile" },
    { label: "Logout", icon: "i-heroicons-arrow-left-on-rectangle", click: async () => {
        await auth.handleLogout()
        router.push("/auth-login")
      } 
    }
  ]
]
</script>

<template>
  <UDropdown :items="items">
    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-500 text-white font-bold cursor-pointer">
      {{ initial }}
    </div>
  </UDropdown>
</template>
