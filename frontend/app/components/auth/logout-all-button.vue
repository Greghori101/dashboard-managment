<script setup lang="ts">
import { useAuthStore } from "~/stores/auth"

const auth = useAuthStore()

async function logoutAll() {
	await auth.handleLogoutAll()
}
</script>

<template>
	<UButton
		variant="outline"
		:loading="auth.loading"
		@click="logoutAll"
	>
		Logout from All Devices
	</UButton>
</template>
