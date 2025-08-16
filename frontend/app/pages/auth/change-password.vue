<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

definePageMeta({
  layout: 'dashboard'
})

const auth = useAuthStore()

const form = reactive({
  current_password: "",
  new_password: "",
  new_password_confirmation: ""
})

const success = ref(false)

async function submit() {
  const res = await auth.changePassword(form)
  if (res.success) {
    success.value = true
    form.current_password = ""
    form.new_password = ""
    form.new_password_confirmation = ""
  } else {
    console.error(res.message)
  }
}
</script>

<template>
  <UContainer class="max-w-md mx-auto py-10">
    <UCard>
      <template #header>
        <h1 class="text-xl font-bold">Change Password</h1>
      </template>

      <UForm @submit="submit" :state="form" v-if="!success">
        <UFormGroup label="Current Password" name="current_password">
          <UInput v-model="form.current_password" type="password" placeholder="Enter current password" />
        </UFormGroup>

        <UFormGroup label="New Password" name="new_password">
          <UInput v-model="form.new_password" type="password" placeholder="Enter new password" />
        </UFormGroup>

        <UFormGroup label="Confirm New Password" name="new_password_confirmation">
          <UInput v-model="form.new_password_confirmation" type="password" placeholder="Confirm new password" />
        </UFormGroup>

        <UButton type="submit" block :loading="auth.loading">Change Password</UButton>
      </UForm>

      <div v-else class="text-center py-4">
        <p class="text-green-600">Password changed successfully ✅</p>
      </div>
    </UCard>
  </UContainer>
</template>
