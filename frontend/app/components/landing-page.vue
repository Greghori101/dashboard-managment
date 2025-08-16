<template>
	<!-- Hero Section -->
	<section class="relative bg-gradient-to-br from-green-100 via-white to-green-200 py-24">
		<div class="relative max-w-7xl mx-auto px-6 grid gap-12 items-center">
			<div class="text-center">
				<h2 class="text-5xl font-extrabold text-green-700 leading-tight drop-shadow-lg">Build Dynamic Dashboards Effortlessly</h2>
				<p class="mt-6 text-xl text-gray-700 max-w-2xl mx-auto">
					Create, customize, and manage dashboards with multiple dynamic widgets. Visualize your data in real time and adapt to your business needs seamlessly.
				</p>
				<div class="mt-8 flex justify-center space-x-6">
					<NuxtLink
						to="/auth/signup"
						class="bg-gradient-to-r from-green-500 to-green-700 text-white px-8 py-4 rounded-xl shadow-lg hover:scale-105 transition-transform duration-200 font-semibold text-lg"
					>
						Sign Up
					</NuxtLink>
					<NuxtLink
						to="/auth/login"
						class="border-2 border-green-600 text-green-700 px-8 py-4 rounded-xl hover:bg-green-100 font-semibold text-lg"
					>
						Login
					</NuxtLink>
				</div>
			</div>
		</div>
	</section>

	<!-- Features Section -->
	<section
		id="features"
		class="py-24 bg-white"
	>
		<div class="max-w-7xl mx-auto px-6">
			<h3 class="text-4xl font-bold text-center text-green-700 mb-4">Powerful Features</h3>
			<p class="text-center text-gray-600 mb-10 text-lg">Everything you need to manage your dashboards</p>
			<div class="mt-12 grid md:grid-cols-3 gap-10">
				<div class="p-8 bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-200">
					<div class="flex items-center justify-center mb-4">
						<span class="bg-green-600 text-white rounded-full p-3 text-2xl">🧩</span>
					</div>
					<h4 class="text-xl font-bold text-green-600">Custom Widgets</h4>
					<p class="mt-3 text-gray-600">Add, arrange, and configure multiple widgets like charts, tables, and metrics tailored to your data.</p>
				</div>
				<div class="p-8 bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-200">
					<div class="flex items-center justify-center mb-4">
						<span class="bg-green-600 text-white rounded-full p-3 text-2xl">🗂️</span>
					</div>
					<h4 class="text-xl font-bold text-green-600">Version Control</h4>
					<p class="mt-3 text-gray-600">Save different versions of your dashboards and roll back anytime without losing previous setups.</p>
				</div>
				<div class="p-8 bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-200">
					<div class="flex items-center justify-center mb-4">
						<span class="bg-green-600 text-white rounded-full p-3 text-2xl">⚡</span>
					</div>
					<h4 class="text-xl font-bold text-green-600">Real-Time Updates</h4>
					<p class="mt-3 text-gray-600">Connect data sources and monitor performance with live, auto-refreshing widgets.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Demo Section -->
	<section
		id="demo"
		class="p-24 bg-gradient-to-br from-green-100 via-white to-green-200"
	>
		<div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
			<div class="text-center md:text-left">
				<h3 class="text-4xl font-extrabold text-green-700 mb-4 drop-shadow">See It in Action</h3>
				<p class="mt-4 text-xl text-gray-700">Quickly create a dashboard, add widgets like charts, KPIs, and lists, and manage them with drag-and-drop simplicity.</p>
				<ul class="mt-8 space-y-4 text-lg">
					<li class="flex items-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2 text-xl">📊</span>
						<span class="font-medium">Add charts and graphs in seconds</span>
					</li>
					<li class="flex items-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2 text-xl">🖱️</span>
						<span class="font-medium">Organize widgets with drag & drop</span>
					</li>
					<li class="flex items-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2 text-xl">⏪</span>
						<span class="font-medium">Rollback to previous versions anytime</span>
					</li>
				</ul>
			</div>
			<div class="flex justify-center md:justify-end">
				<div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md border border-green-100">
					<div class="flex items-center justify-between mb-6">
						<span class="text-green-600 font-bold text-lg">Your Dashboard</span>
						<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Live</span>
					</div>
					<div class="grid grid-cols-2 gap-4">
						<div class="bg-green-50 rounded-lg p-4 flex flex-col items-center">
							<span class="text-3xl">📈</span>
							<span class="mt-2 text-green-700 font-semibold">Chart Widget</span>
						</div>
						<div class="bg-green-50 rounded-lg p-4 flex flex-col items-center">
							<span class="text-3xl">🔢</span>
							<span class="mt-2 text-green-700 font-semibold">KPI Widget</span>
						</div>
						<div class="bg-green-50 rounded-lg p-4 flex flex-col items-center">
							<span class="text-3xl">📋</span>
							<span class="mt-2 text-green-700 font-semibold">List Widget</span>
						</div>
						<div class="bg-green-50 rounded-lg p-4 flex flex-col items-center">
							<span class="text-3xl">🧩</span>
							<span class="mt-2 text-green-700 font-semibold">Custom Widget</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
