<script setup lang="ts"></script>

<template>
	<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-100 flex flex-col">
		<header class="w-full py-6 px-8 bg-white shadow-md flex items-center justify-between">
			<div class="flex items-center space-x-3">
				<img
					src="/favicon.ico"
					alt="Logo"
					class="h-8 w-8 rounded-full shadow"
				/>
				<span class="text-2xl font-bold text-green-700 tracking-tight">DiData Dashboard</span>
			</div>
			<nav class="flex space-x-6">
				<NuxtLink
					to="/auth/login"
					class="bg-green-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-green-800 transition"
					>Login</NuxtLink
				>
				<NuxtLink
					to="/auth/signup"
					class="bg-white text-green-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-green-100 transition"
					>Sign Up</NuxtLink
				>
			</nav>
		</header>
		<main class="flex-1">
			<slot />
		</main>
		<footer class="w-full py-6 px-8 bg-white shadow-inner text-center text-gray-500 text-sm mt-auto">&copy; 2025 DiData. All rights reserved.</footer>
	</div>
</template>
