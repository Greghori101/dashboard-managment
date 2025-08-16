<script setup lang="ts">
import { computed } from "vue"

const props = defineProps<{
  widget: {
    id: number
    version_id: number
    type: string
    data: Record<string, any>
    sort: number
  }
}>()

const type = computed(() => props.widget.type)
</script>

<template>
  <div class="p-2">
    <component
      :is="type === 'link' ? 'WidgetLink' : type === 'text' ? 'WidgetText' : 'div'"
      :data="props.widget.data"
    />
  </div>
</template>
