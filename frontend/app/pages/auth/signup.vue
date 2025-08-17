<script setup lang="ts">
import { signupSchema, type SignupInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

const form = reactive<SignupInput>({
	name: "",
	email: "",
	password: "",
	password_confirmation: "",
})

async function submit() {
	const data = signupSchema.parse(form)

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
				<h1 class="text-2xl font-bold text-center mb-2">Create Your Account</h1>
				<p class="text-sm text-gray-500 text-center">Sign up to get started</p>
			</template>

			<UForm
				@submit="submit"
				:state="form"
				class="space-y-6"
			>
				<UFormGroup
					label="Full Name"
					name="name"
				>
					<label
						for="name"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Full Name</label
					>
					<UInput
						id="name"
						v-model="form.name"
						placeholder="Enter your name"
						class="w-full"
					/>
				</UFormGroup>

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
						placeholder="Enter password"
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
					>Sign Up</UButton
				>
			</UForm>
		</UCard>
	</UContainer>
</template>
