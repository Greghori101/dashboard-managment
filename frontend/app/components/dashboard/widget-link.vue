<script setup lang="ts">
const props = defineProps<{
  data: { url: string; label: string }
}>()
</script>

<template>
  <a
    :href="props.data.url"
    target="_blank"
    rel="noopener noreferrer"
    class="text-blue-600 underline hover:text-blue-800"
  >
    {{ props.data.label }}
  </a>
</template>
