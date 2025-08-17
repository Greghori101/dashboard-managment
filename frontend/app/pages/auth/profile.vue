<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

definePageMeta({
	layout: "dashboard",
})

const auth = useAuthStore()
const user = computed(() => auth.user)
</script>

<template>
	<UContainer class="max-w-md mx-auto py-10">
		<UCard>
			<template #header>
				<h1 class="text-2xl font-bold text-center mb-2">My Profile</h1>
				<p class="text-sm text-gray-500 text-center">View and manage your account information</p>
			</template>

			<div v-if="user">
				<div class="space-y-6">
					<div class="flex flex-col">
						<label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
						<div class="bg-gray-50 rounded px-3 py-2">
							<span class="font-semibold text-lg">{{ user.name }}</span>
						</div>
					</div>

					<div class="flex flex-col">
						<label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
						<div class="bg-gray-50 rounded px-3 py-2">
							<span class="font-semibold text-lg">{{ user.email }}</span>
						</div>
					</div>
				</div>
			</div>

			<div
				v-else
				class="text-center py-6"
			>
				<p class="text-gray-500">No user data available. Please log in.</p>
			</div>
		</UCard>
	</UContainer>
</template>
