<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

const form = reactive({
  email: "",
  password: ""
})

async function submit() {
  const res = await auth.handleLogin(form)
  if (res.success) {
    navigateTo("/dashboard")
  } else {
    console.error(res.message)
  }
}
</script>

<template>
  <UContainer class="max-w-md mx-auto py-10">
    <UCard>
      <template #header>
        <h1 class="text-xl font-bold">Login</h1>
      </template>

      <UForm @submit="submit" :state="form">
        <UFormGroup label="Email" name="email">
          <UInput v-model="form.email" type="email" placeholder="Your email" />
        </UFormGroup>

        <UFormGroup label="Password" name="password">
          <UInput v-model="form.password" type="password" placeholder="Password" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">Login</UButton>
      </UForm>

      <template #footer>
        <p class="text-sm text-center">
          Don’t have an account?
          <NuxtLink to="/auth/signup" class="text-primary-500">Sign up</NuxtLink>
        </p>
      </template>
    </UCard>
  </UContainer>
</template>
