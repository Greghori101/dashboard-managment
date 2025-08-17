<script setup lang="ts">
import { forgotPasswordSchema, type ForgotPasswordInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"
import { reactive, ref } from "vue"

const auth = useAuthStore()

const form = reactive<ForgotPasswordInput>({
	email: "",
})

const errors = reactive<{ email?: string }>({})
const success = ref(false)

async function submit() {
	errors.email = ""

	try {
		const data = forgotPasswordSchema.parse(form)
		const res = await auth.forgotPassword(data.email)
		if (res.success) {
			success.value = true
			form.email = ""
		} else {
			console.error(res.message)
		}
	} catch (err: any) {
		if (err.name === "ZodError") {
			err.errors.forEach((e: any) => {
				if (e.path && e.path[0] === "email") {
					errors.email = e.message
				}
			})
		} else {
			console.error(err)
		}
	}
}
</script>

<template>
	<UContainer class="max-w-md mx-auto py-10">
		<UCard>
			<template #header>
				<h1 class="text-2xl font-bold text-center mb-2">Forgot Your Password?</h1>
				<p class="text-sm text-gray-500 text-center">Enter your email to receive a reset link</p>
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
					<p
						v-if="errors.email"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.email }}
					</p>
				</UFormGroup>

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
				>
					Send Reset Link
				</UButton>
			</UForm>

			<div
				v-else
				class="text-center py-4"
			>
				<p class="text-green-600 text-lg font-semibold">Check your email for the reset link.</p>
				<NuxtLink
					to="/login"
					class="text-primary-500 font-semibold"
					>Back to login</NuxtLink
				>
			</div>
		</UCard>
	</UContainer>
</template>
