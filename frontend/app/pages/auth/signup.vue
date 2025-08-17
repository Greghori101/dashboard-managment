<script setup lang="ts">
import { signupSchema, type SignupInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"
import { reactive, ref } from "vue"
import { z } from "zod"

const auth = useAuthStore()

const form = reactive<SignupInput>({
	name: "",
	email: "",
	password: "",
	password_confirmation: "",
})

const errors = reactive<{ name?: string; email?: string; password?: string; password_confirmation?: string }>({})

async function submit() {
	Object.keys(errors).forEach((key) => (errors[key as keyof typeof errors] = ""))

	try {
		const data = z
			.object({
				name: z.string().min(1, "Name is required"),
				email: z.string().email("Invalid email address"),
				password: z.string().min(6, "Password must be at least 6 characters"),
				password_confirmation: z.string().min(6, "Passwords must match"),
			})
			.refine((data) => data.password === data.password_confirmation, {
				message: "Passwords do not match",
				path: ["password_confirmation"],
			})
			.parse(form)

		const res = await auth.handleSignup(data)
		if (res.success) {
			navigateTo("/dashboard")
		} else {
			console.error(res.message)
		}
	} catch (err: any) {
		if (err.name === "ZodError") {
			err.errors.forEach((e: any) => {
				const key = e.path[0] as keyof typeof errors
				errors[key] = e.message
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
					<p
						v-if="errors.name"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.name }}
					</p>
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
						placeholder="Enter password"
						class="w-full"
					/>
					<p
						v-if="errors.password"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.password }}
					</p>
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
					<p
						v-if="errors.password_confirmation"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.password_confirmation }}
					</p>
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
