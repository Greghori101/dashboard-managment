<script setup lang="ts">
import { loginSchema, type LoginInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"
import { reactive, ref } from "vue"

const auth = useAuthStore()

const form = reactive<LoginInput>({
	email: "",
	password: "",
})

const errors = reactive<{ email?: string; password?: string }>({})

async function submit() {
	errors.email = ""
	errors.password = ""

	try {
		const data = loginSchema.parse(form)
		const res = await auth.handleLogin(data)
		if (res.success) {
			navigateTo("/dashboard")
		} else {
			console.error(res.message)
		}
	} catch (err: any) {
		if (err.name === "ZodError") {
			err.errors.forEach((e: any) => {
				if (e.path[0] === "email") errors.email = e.message
				if (e.path[0] === "password") errors.password = e.message
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
				<h1 class="text-2xl font-bold text-center mb-2">Welcome Back!</h1>
				<p class="text-sm text-gray-500 text-center">Please login to your account</p>
			</template>

			<UForm
				@submit="submit"
				:state="form"
				class="space-y-6"
			>
				<UFormGroup
					label="Email Address"
					name="email"
				>
					<UInput
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

				<UFormGroup
					label="Password"
					name="password"
				>
					<label
						for="password"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Password</label
					>
					<UInput
						id="password"
						v-model="form.password"
						type="password"
						placeholder="Enter your password"
						class="w-full"
					/>
					<p
						v-if="errors.password"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.password }}
					</p>
				</UFormGroup>

				<div class="flex items-center justify-between mb-4">
					<NuxtLink
						to="/auth/forgot"
						class="text-xs text-primary-500 hover:underline"
						>Forgot password?</NuxtLink
					>
				</div>

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
					>Login</UButton
				>
			</UForm>

			<template #footer>
				<p class="text-sm text-center mt-4">
					Don’t have an account?
					<NuxtLink
						to="/auth/signup"
						class="text-primary-500 font-semibold ml-1"
						>Sign up</NuxtLink
					>
				</p>
			</template>
		</UCard>
	</UContainer>
</template>
