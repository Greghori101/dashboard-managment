<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

const form = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: ""
})

async function submit() {
  const res = await auth.handleSignup(form)
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
        <h1 class="text-xl font-bold">Create Account</h1>
      </template>

      <UForm @submit="submit" :state="form">
        <UFormGroup label="Name" name="name">
          <UInput v-model="form.name" placeholder="Your name" />
        </UFormGroup>

        <UFormGroup label="Email" name="email">
          <UInput v-model="form.email" type="email" placeholder="Your email" />
        </UFormGroup>

        <UFormGroup label="Password" name="password">
          <UInput v-model="form.password" type="password" placeholder="Password" />
        </UFormGroup>

        <UFormGroup label="Confirm Password" name="password_confirmation">
          <UInput v-model="form.password_confirmation" type="password" placeholder="Confirm password" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">Sign Up</UButton>
      </UForm>
    </UCard>
  </UContainer>
</template>
