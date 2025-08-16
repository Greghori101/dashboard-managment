<script setup lang="ts">
import { onMounted } from "vue"
import { useDashboardStore } from "~/stores/dashboard"

const store = useDashboardStore()

onMounted(async () => {
  await store.fetchDashboards()
})
</script>

<template>
  <UContainer>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Dashboards</h1>
      <UButton icon="i-heroicons-plus" color="primary">
        New Dashboard
      </UButton>
    </div>

    <div v-if="store.loading" class="flex justify-center py-10">
      <ULoading size="lg" />
    </div>

    <div v-else-if="store.dashboards.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <DashboardCard
        v-for="d in store.dashboards"
        :key="d.id"
        :title="d.name"
        icon="i-heroicons-rectangle-stack"
        :link="`/dashboards/${d.id}`"
      />
    </div>

    <div v-else class="text-gray-500 text-center py-10">
      No dashboards available
    </div>
  </UContainer>
</template>
