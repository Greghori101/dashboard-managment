<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()
const route = useRoute()
const token = route.params.token as string

const form = reactive({
  email: "",
  password: "",
  password_confirmation: ""
})

const success = ref(false)

async function submit() {
  const res = await auth.resetPassword({ ...form, token })
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
        <h1 class="text-xl font-bold">Reset Password</h1>
      </template>

      <UForm @submit="submit" :state="form" v-if="!success">
        <UFormGroup label="Email" name="email">
          <UInput v-model="form.email" type="email" placeholder="Your email" />
        </UFormGroup>

        <UFormGroup label="New Password" name="password">
          <UInput v-model="form.password" type="password" placeholder="New password" />
        </UFormGroup>

        <UFormGroup label="Confirm Password" name="password_confirmation">
          <UInput v-model="form.password_confirmation" type="password" placeholder="Confirm password" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">Reset Password</UButton>
      </UForm>

      <div v-else class="text-center py-4">
        <p class="text-green-600">Password reset successfully.</p>
        <NuxtLink to="/login" class="text-primary-500">Go to login</NuxtLink>
      </div>
    </UCard>
  </UContainer>
</template>
