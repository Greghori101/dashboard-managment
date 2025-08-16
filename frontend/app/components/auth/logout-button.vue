<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

async function logout() {
  await auth.handleLogout()
}
</script>

<template>
  <UButton variant="solid" :loading="auth.loading" @click="logout">
    Logout
  </UButton>
</template>
