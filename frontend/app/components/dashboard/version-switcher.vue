<script setup lang="ts">
import { useDashboardStore } from "~/stores/dashboard"

const dashboardStore = useDashboardStore()

const props = defineProps<{
	dashboardId: number
}>()

const selected = computed({
	get: () => dashboardStore.current?.currentVersion?.id,
	set: async (versionId: number) => {
		if (versionId && props.dashboardId) {
			await dashboardStore.switchVersion(props.dashboardId, versionId)
		}
	},
})

const options = computed(() =>
	dashboardStore.versions.map((v) => ({
		label: `v${v.number}`,
		value: v.id,
	}))
)
</script>

<template>
	<USelect
		v-model="selected"
		:options="options"
		size="sm"
		placeholder="Select version"
		class="w-40"
	/>
</template>
