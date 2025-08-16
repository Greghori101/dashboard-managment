<script setup lang="ts">
import { ref, reactive, onMounted, computed } from "vue"
import { useDashboardStore } from "~/stores/dashboard"

const props = defineProps<{
  dashboardId?: number
}>()

const emit = defineEmits<{
  (e: "success"): void
}>()

const dashboardStore = useDashboardStore()

const form = reactive({
  name: "",
  widgets: [] as Array<{ type: string; data: Record<string, any>; sort?: number }>
})

const loading = ref(false)

onMounted(async () => {
  if (props.dashboardId) {
    await dashboardStore.fetchDashboard(props.dashboardId)
    if (dashboardStore.current) {
      form.name = dashboardStore.current.name
      form.widgets = dashboardStore.current.currentVersion?.widgets?.map(w => ({
        type: w.type,
        data: w.data,
        sort: w.sort
      })) || []
    }
  }
})

function addWidget() {
  form.widgets.push({
    type: "text",
    data: { content: "" },
    sort: form.widgets.length + 1
  })
}

function removeWidget(index: number) {
  form.widgets.splice(index, 1)
}

async function handleSubmit() {
  loading.value = true
  let res
  if (props.dashboardId) {
    res = await dashboardStore.updateDashboard(props.dashboardId, {
      widgets: form.widgets
    })
  } else {
    res = await dashboardStore.createDashboard({
      name: form.name,
      widgets: form.widgets
    })
  }
  loading.value = false
  if (res.success) {
    emit("success")
  }
}
</script>

<template>
  <UCard>
    <form @submit.prevent="handleSubmit" class="space-y-6">
      <div>
        <label class="block text-sm font-medium mb-1">Dashboard Name</label>
        <UInput v-model="form.name" placeholder="Enter name" class="w-full" />
      </div>

      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-sm font-medium">Widgets</label>
          <UButton size="xs" @click="addWidget" type="button">Add Widget</UButton>
        </div>
        <div v-if="form.widgets.length" class="space-y-4">
          <div
            v-for="(widget, index) in form.widgets"
            :key="index"
            class="p-3 border rounded-md space-y-3"
          >
            <div class="flex items-center justify-between">
              <h4 class="font-medium">Widget {{ index + 1 }}</h4>
              <UButton size="xs" variant="soft" type="button" @click="removeWidget(index)">
                Remove
              </UButton>
            </div>

            <div>
              <label class="block text-xs font-medium mb-1">Type</label>
              <USelect
                v-model="widget.type"
                :options="[
                  { label: 'Text', value: 'text' },
                  { label: 'Link', value: 'link' }
                ]"
                class="w-32"
              />
            </div>

            <div>
              <label class="block text-xs font-medium mb-1">Data (JSON)</label>
              <UTextarea
                v-model="widget.data.content"
                placeholder="Enter widget content"
                class="w-full"
                v-if="widget.type === 'text'"
              />
              <UInput
                v-model="widget.data.url"
                placeholder="Enter URL"
                v-if="widget.type === 'link'"
                class="w-full"
              />
            </div>

            <div>
              <label class="block text-xs font-medium mb-1">Sort</label>
              <UInput type="number" v-model="widget.sort" class="w-20" />
            </div>
          </div>
        </div>
        <p v-else class="text-sm text-gray-500">No widgets added</p>
      </div>

      <UButton type="submit" :loading="loading" class="w-full">
        {{ props.dashboardId ? "Update Dashboard" : "Create Dashboard" }}
      </UButton>
    </form>
  </UCard>
</template>
