<script setup lang="ts">
import { changePasswordSchema, type ChangePasswordInput } from "~/lib/schemas/auth"
import { useAuthStore } from "~/stores/auth"
import { ref, reactive } from "vue"

definePageMeta({
	layout: "dashboard",
})

const auth = useAuthStore()

const form = reactive<ChangePasswordInput>({
	current_password: "",
	new_password: "",
	new_password_confirmation: "",
})

const errors = reactive<{ [key: string]: string }>({})
const success = ref(false)

async function submit() {
	errors.current_password = ""
	errors.new_password = ""
	errors.new_password_confirmation = ""

	try {
		const data = changePasswordSchema.parse(form)
		const res = await auth.changePassword(data)
		if (res.success) {
			success.value = true
			form.current_password = ""
			form.new_password = ""
			form.new_password_confirmation = ""
		} else {
			console.error(res.message)
		}
	} catch (err: any) {
		if (err.name === "ZodError") {
			err.errors.forEach((e: any) => {
				if (e.path && e.path.length > 0) {
					errors[e.path[0]] = e.message
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
				<h1 class="text-2xl font-bold text-center mb-2">Change Your Password</h1>
				<p class="text-sm text-gray-500 text-center">Update your password for better security</p>
			</template>

			<UForm
				@submit="submit"
				:state="form"
				v-if="!success"
				class="space-y-6"
			>
				<UFormGroup
					label="Current Password"
					name="current_password"
				>
					<label
						for="current_password"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Current Password</label
					>
					<UInput
						id="current_password"
						v-model="form.current_password"
						type="password"
						placeholder="Enter current password"
						class="w-full"
					/>
					<p
						v-if="errors.current_password"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.current_password }}
					</p>
				</UFormGroup>

				<UFormGroup
					label="New Password"
					name="new_password"
				>
					<label
						for="new_password"
						class="block text-sm font-medium text-gray-700 mb-1"
						>New Password</label
					>
					<UInput
						id="new_password"
						v-model="form.new_password"
						type="password"
						placeholder="Enter new password"
						class="w-full"
					/>
					<p
						v-if="errors.new_password"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.new_password }}
					</p>
				</UFormGroup>

				<UFormGroup
					label="Confirm New Password"
					name="new_password_confirmation"
				>
					<label
						for="new_password_confirmation"
						class="block text-sm font-medium text-gray-700 mb-1"
						>Confirm New Password</label
					>
					<UInput
						id="new_password_confirmation"
						v-model="form.new_password_confirmation"
						type="password"
						placeholder="Confirm new password"
						class="w-full"
					/>
					<p
						v-if="errors.new_password_confirmation"
						class="text-red-500 text-sm mt-1"
					>
						{{ errors.new_password_confirmation }}
					</p>
				</UFormGroup>

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
				>
					Change Password
				</UButton>
			</UForm>

			<div
				v-else
				class="text-center py-4"
			>
				<p class="text-green-600 text-lg font-semibold">Password changed successfully ✅</p>
			</div>
		</UCard>
	</UContainer>
</template>
