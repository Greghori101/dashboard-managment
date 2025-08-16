<template>
	<!-- Hero Section -->
	<section class="relative bg-gradient-to-br from-green-100 via-white to-green-200 py-24">
		<div class="absolute inset-0 pointer-events-none">
			<svg
				class="w-full h-full"
				viewBox="0 0 1440 320"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					fill="#22c55e"
					fill-opacity="0.08"
					d="M0,160L48,165.3C96,171,192,181,288,165.3C384,149,480,107,576,117.3C672,128,768,192,864,218.7C960,245,1056,235,1152,218.7C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
				></path>
			</svg>
		</div>
		<div class="relative max-w-7xl mx-auto px-6 grid gap-12 items-center">
			<div class="text-center">
				<h2 class="text-5xl font-extrabold text-green-700 leading-tight drop-shadow-lg">Build Dynamic Dashboards Effortlessly</h2>
				<p class="mt-6 text-xl text-gray-700 max-w-2xl mx-auto">
					Create, customize, and manage dashboards with multiple dynamic widgets. Visualize your data in real time and adapt to your business needs seamlessly.
				</p>
				<div class="mt-8 flex justify-center space-x-6">
					<button class="bg-gradient-to-r from-green-500 to-green-700 text-white px-8 py-4 rounded-xl shadow-lg hover:scale-105 transition-transform duration-200 font-semibold text-lg">
						Start Free
					</button>
					<button class="border-2 border-green-600 text-green-700 px-8 py-4 rounded-xl hover:bg-green-100 font-semibold text-lg">Live Demo</button>
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
		class="py-24 bg-gradient-to-br from-green-100 via-white to-green-200"
	>
		<div class="max-w-7xl mx-auto px-6 grid gap-12 items-center">
			<div class="text-center">
				<h3 class="text-4xl font-bold text-green-700 mb-4">See It in Action</h3>
				<p class="mt-4 text-xl text-gray-700">Quickly create a dashboard, add widgets like charts, KPIs, and lists, and manage them with drag-and-drop simplicity.</p>
				<ul class="mt-8 space-y-4 text-lg">
					<li class="flex items-center justify-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2">✔</span>
						<span>Add charts and graphs in seconds</span>
					</li>
					<li class="flex items-center justify-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2">✔</span>
						<span>Organize widgets with drag & drop</span>
					</li>
					<li class="flex items-center justify-center space-x-3">
						<span class="bg-green-600 text-white rounded-full p-2">✔</span>
						<span>Rollback to previous versions anytime</span>
					</li>
				</ul>
			</div>
		</div>
	</section>
</template>
