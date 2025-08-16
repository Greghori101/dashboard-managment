<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

definePageMeta({
  layout: 'dashboard'
})


const auth = useAuthStore()
const user = computed(() => auth.user)
</script>

<template>
  <UContainer class="max-w-md mx-auto py-10">
    <UCard>
      <template #header>
        <h1 class="text-xl font-bold">My Profile</h1>
      </template>

      <div v-if="user">
        <div class="space-y-4">
          <div>
            <p class="text-gray-500">Name</p>
            <p class="font-medium">{{ user.name }}</p>
          </div>

          <div>
            <p class="text-gray-500">Email</p>
            <p class="font-medium">{{ user.email }}</p>
          </div>
        </div>
      </div>

      <div v-else class="text-center py-6">
        <p class="text-gray-500">No user data available. Please log in.</p>
      </div>
    </UCard>
  </UContainer>
</template>
