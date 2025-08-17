<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()
const route = useRoute()
const token = route.params.token as string

const form = reactive({
	email: "",
	password: "",
	password_confirmation: "",
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
				<h1 class="text-2xl font-bold text-center mb-2">Reset Your Password</h1>
				<p class="text-sm text-gray-500 text-center">Enter your new password below</p>
			</template>

			<UForm
				@submit="submit"
				:state="form"
				v-if="!success"
				class="space-y-6"
			>
				<UFormGroup
					label="Email Address"
					name="email"
				>
					<label
						for="email"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Email Address</label
					>
					<UInput
						id="email"
						v-model="form.email"
						type="email"
						placeholder="Enter your email"
						class="w-full"
					/>
				</UFormGroup>

				<UFormGroup
					label="New Password"
					name="password"
				>
					<label
						for="password"
						class="block text-sm font-medium text-gray-700 mb-1"
						>New Password</label
					>
					<UInput
						id="password"
						v-model="form.password"
						type="password"
						placeholder="Enter new password"
						class="w-full"
					/>
				</UFormGroup>

				<UFormGroup
					label="Confirm Password"
					name="password_confirmation"
				>
					<label
						for="password_confirmation"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Confirm Password</label
					>
					<UInput
						id="password_confirmation"
						v-model="form.password_confirmation"
						type="password"
						placeholder="Confirm password"
						class="w-full"
					/>
				</UFormGroup>

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
					>Reset Password</UButton
				>
			</UForm>

			<div
				v-else
				class="text-center py-4"
			>
				<p class="text-green-600 text-lg font-semibold">Password reset successfully.</p>
				<NuxtLink
					to="/login"
					class="text-primary-500 font-semibold"
					>Go to login</NuxtLink
				>
			</div>
		</UCard>
	</UContainer>
</template>
