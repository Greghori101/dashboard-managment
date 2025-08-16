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
				<a
					href="#features"
					class="text-green-700 hover:underline font-medium"
					>Features</a
				>
				<a
					href="#demo"
					class="text-green-700 hover:underline font-medium"
					>Demo</a
				>
			</nav>
		</header>
		<main class="flex-1">
			<slot />
		</main>
		<footer class="w-full py-6 px-8 bg-white shadow-inner text-center text-gray-500 text-sm mt-auto">&copy; 2025 DiData. All rights reserved.</footer>
	</div>
</template>
