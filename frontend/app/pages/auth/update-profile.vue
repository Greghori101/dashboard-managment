<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

definePageMeta({
  layout: 'dashboard'
})

const auth = useAuthStore()

const state = reactive({
  name: auth.user?.name || "",
  email: auth.user?.email || "",
})

async function updateProfile() {
  const res = await auth.handleUpdateProfile({
    name: state.name,
    email: state.email,
  })
  if (res.success) {
    console.log("Profile updated")
  } else {
    console.error(res.message)
  }
}
</script>

<template>
  <UContainer class="max-w-md mx-auto py-10">
    <UCard>
      <template #header>
        <h1 class="text-xl font-bold">Update Profile</h1>
      </template>

      <UForm :state="state" @submit="updateProfile" class="space-y-4">
        <UFormGroup label="Name" name="name">
          <UInput v-model="state.name" placeholder="Enter your name" />
        </UFormGroup>

        <UFormGroup label="Email" name="email">
          <UInput v-model="state.email" type="email" placeholder="Enter your email" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">
          Update Profile
        </UButton>
      </UForm>
    </UCard>
  </UContainer>
</template>
