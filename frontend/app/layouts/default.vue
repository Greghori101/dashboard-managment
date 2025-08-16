<script setup lang="ts">

</script>

<template>
  <div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="w-full flex items-center justify-between px-6 py-3 bg-gray-100 border-b">
      <NuxtLink to="/" class="text-xl font-semibold text-primary-600">
        MyApp
      </NuxtLink>
      <div class="flex items-center gap-4">
        <ProfileDropdown />
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="w-full px-6 py-4 bg-gray-100 border-t text-center text-sm text-gray-600">
      © {{ new Date().getFullYear() }} MyApp. All rights reserved.
    </footer>
  </div>
</template>
