<script setup lang="ts">
import { onMounted, computed } from "vue"
import { useRoute } from "vue-router"
import { useDashboardStore } from "~/stores/dashboard"

const route = useRoute()
const dashboardStore = useDashboardStore()

const dashboardId = computed(() => Number(route.params.id))

onMounted(async () => {
	if (dashboardId.value) {
		await dashboardStore.fetchDashboard(dashboardId.value)
	}
})

const dashboard = computed(() => dashboardStore.current)
const widgets = computed(() => dashboardStore.current?.currentVersion?.widgets ?? [])
</script>

<template>
	<UContainer>
		<div class="flex items-center justify-between mb-6">
			<h1 class="text-2xl font-bold">
				{{ dashboard?.name || "Dashboard" }}
			</h1>
			<VersionSelector :dashboard-id="dashboardId" />
		</div>

		<div
			v-if="dashboardStore.loading"
			class="flex justify-center py-10"
		>
			<ULoading size="lg" />
		</div>

		<div
			v-else-if="widgets.length"
			class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
		>
			<Widget
				v-for="w in widgets"
				:key="w.id"
				:widget="w"
			/>
		</div>

		<div
			v-else
			class="text-gray-500 text-center py-10"
		>
			No widgets available for this version
		</div>
	</UContainer>
</template>
