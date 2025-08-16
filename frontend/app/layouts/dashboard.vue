<script setup lang="ts">
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <NavBar />

    <main class="flex-1 p-6">
      <slot />
    </main>

    <footer class="w-full px-6 py-4 bg-gray-100 border-t text-center text-sm text-gray-600">
      © {{ new Date().getFullYear() }} MyApp. All rights reserved.
    </footer>
  </div>
</template>
