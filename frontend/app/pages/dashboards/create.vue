<script setup lang="ts">
import { useRouter } from "vue-router"

const router = useRouter()

function handleSuccess() {
  router.push("/dashboards")
}
</script>

<template>
  <div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Create Dashboard</h1>
    <DashboardForm @success="handleSuccess" />
  </div>
</template>
