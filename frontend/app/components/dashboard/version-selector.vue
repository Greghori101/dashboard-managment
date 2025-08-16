<script setup lang="ts">
const props = defineProps<{
  versions: string[]
  modelValue: string
}>()

const emit = defineEmits<{
  (e: "update:modelValue", value: string): void
}>()

const selected = computed({
  get: () => props.modelValue,
  set: (val) => emit("update:modelValue", val)
})
</script>

<template>
  <USelect
    v-model="selected"
    :options="props.versions"
    size="sm"
    class="w-32"
  />
</template>
