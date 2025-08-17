<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

definePageMeta({
	layout: "dashboard",
})

const auth = useAuthStore()

const state = reactive({
	name: auth.user?.name || "",
	email: auth.user?.email || "",
})

async function updateProfile() {
	const res = await auth.handleUpdateProfile({
		name: state.name,
		email: state.email,
	})
	if (res.success) {
		console.log("Profile updated")
	} else {
		console.error(res.message)
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
				:state="state"
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
						v-model="state.name"
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
						v-model="state.email"
						type="email"
						placeholder="Enter your email"
						class="w-full"
					/>
				</UFormGroup>

				<UButton
					type="submit"
					block
					:loading="auth.loading"
					class="mt-2"
				>
					Update Profile
				</UButton>
			</UForm>
		</UCard>
	</UContainer>
</template>
