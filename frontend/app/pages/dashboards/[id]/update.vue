<script setup lang="ts">
import { useRoute, useRouter } from "vue-router"

const route = useRoute()
const router = useRouter()
const dashboardId = Number(route.params.id)

function handleSuccess() {
  router.push(`/dashboards/${dashboardId}`)
}
</script>

<template>
  <div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Dashboard</h1>
    <DashboardForm :dashboard-id="dashboardId" @success="handleSuccess" />
  </div>
</template>
