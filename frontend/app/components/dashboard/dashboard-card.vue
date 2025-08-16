<script setup lang="ts">
interface Props {
  title: string
  description?: string
  icon?: string
  link?: string
}

const props = defineProps<Props>()
</script>

<template>
  <UCard
    class="w-full h-full hover:shadow-lg transition cursor-pointer"
    :to="props.link"
  >
    <div class="flex items-center space-x-3">
      <div v-if="props.icon" class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-100 text-primary-600">
        <UIcon :name="props.icon" class="w-6 h-6" />
      </div>
      <div>
        <h3 class="text-lg font-semibold">{{ props.title }}</h3>
        <p v-if="props.description" class="text-sm text-gray-500">
          {{ props.description }}
        </p>
      </div>
    </div>
  </UCard>
</template>
