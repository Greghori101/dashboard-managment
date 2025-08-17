<script setup lang="ts">
import { updateProfileSchema, type UpdateProfileInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"
import { reactive } from "vue"
import { z } from "zod"

definePageMeta({
	layout: "dashboard",
})

const auth = useAuthStore()

const form = reactive<UpdateProfileInput>({
	name: auth.user?.name || "",
	email: auth.user?.email || "",
})

const errors = reactive<{ name?: string; email?: string }>({})

async function updateProfile() {
	Object.keys(errors).forEach((key) => (errors[key as keyof typeof errors] = ""))

	try {
		const data = updateProfileSchema.parse(form)
		const res = await auth.handleUpdateProfile(data)
		if (res.success) {
			console.log("Profile updated")
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
				<h1 class="text-2xl font-bold text-center mb-2">Update Profile</h1>
				<p class="text-sm text-gray-500 text-center">Edit your account information below</p>
			</template>

			<UForm
				:state="form"
				@submit="updateProfile"
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

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
					>Update Profile</UButton
				>
			</UForm>
		</UCard>
	</UContainer>
</template>
