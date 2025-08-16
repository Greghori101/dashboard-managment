<script setup lang="ts">
</script>

<template>
  <nav class="w-full flex items-center justify-between px-6 py-3 bg-gray-100 border-b">
    <!-- App Name -->
    <NuxtLink to="/" class="text-xl font-semibold text-primary-600">
      MyApp
    </NuxtLink>

    <!-- Profile Dropdown -->
    <ProfileDropdown />
  </nav>
</template>
