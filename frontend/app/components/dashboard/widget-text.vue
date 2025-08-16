<script setup lang="ts">
import { ref } from "vue"

const props = defineProps<{
	data: { text: string; editable?: boolean }
}>()

const content = ref(props.data.text)
</script>

<template>
	<div>
		<textarea
			v-if="props.data.editable"
			v-model="content"
			class="w-full border rounded p-2"
		/>
		<p
			v-else
			class="text-gray-700"
		>
			{{ content }}
		</p>
	</div>
</template>
