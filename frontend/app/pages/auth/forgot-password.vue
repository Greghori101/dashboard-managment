<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

const form = reactive({
  email: ""
})

const success = ref(false)

async function submit() {
  const res = await auth.forgotPassword(form.email)
  if (res.success) {
    success.value = true
  } else {
    console.error(res.message)
  }
}
</script>

<template>
  <UContainer class="max-w-md mx-auto py-10">
    <UCard>
      <template #header>
        <h1 class="text-xl font-bold">Forgot Password</h1>
      </template>

      <UForm @submit="submit" :state="form" v-if="!success">
        <UFormGroup label="Email" name="email">
          <UInput v-model="form.email" type="email" placeholder="Your email" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">Send Reset Link</UButton>
      </UForm>

      <div v-else class="text-center py-4">
        <p class="text-green-600">Check your email for the reset link.</p>
        <NuxtLink to="/login" class="text-primary-500">Back to login</NuxtLink>
      </div>
    </UCard>
  </UContainer>
</template>
