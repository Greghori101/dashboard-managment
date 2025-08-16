// stores/dashboard.ts
import { defineStore } from "pinia"
import { useDashboard } from "~/composables/use-dahsboard"

interface Widget {
	id: number
	version_id: number
	type: string
	data: Record<string, any>
	sort: number
}

interface Version {
	id: number
	number: number
	widgets?: Widget[]
}

interface Dashboard {
	id: number
	name: string
	user_id: number
	current_version_id: number
	currentVersion?: Version
	versions?: Version[]
}

interface PaginationMeta {
	current_page: number
	per_page: number
	total: number
	last_page: number
}

interface PaginationLinks {
	first: string | null
	last: string | null
	prev: string | null
	next: string | null
}

export const useDashboardStore = defineStore("dashboard", () => {
	const dashboards = useState<Dashboard[]>("dashboards", () => [])
	const current = useState<Dashboard | null>("current_dashboard", () => null)
	const versions = useState<Version[]>("dashboard_versions", () => [])
	const meta = useState<PaginationMeta | null>("dashboards_meta", () => null)
	const links = useState<PaginationLinks | null>("dashboards_links", () => null)
	const loading = useState<boolean>("dashboards_loading", () => false)

	const { index, show, versions: getVersions, store, update, rollback } = useDashboard()

	async function fetchDashboards(filters: Record<string, any> = {}) {
		loading.value = true
		const res = await index(filters)
		if (res.success) {
			dashboards.value = res.data.items
			meta.value = res.data.meta
			links.value = res.data.links
		}
		loading.value = false
		return res
	}

	async function fetchDashboard(id: number) {
		loading.value = true
		const res = await show(id)
		if (res.success) current.value = res.data
		loading.value = false
		return res
	}

	async function fetchVersions(id: number) {
		loading.value = true
		const res = await getVersions(id)
		if (res.success) versions.value = res.data
		loading.value = false
		return res
	}

	async function createDashboard(payload: { name: string; widgets: Array<{ type: string; data: Record<string, any>; sort?: number }> }) {
		loading.value = true
		const res = await store(payload)
		if (res.success) dashboards.value.unshift(res.data)
		loading.value = false
		return res
	}

	async function updateDashboard(id: number, payload: { widgets: Array<{ type: string; data: Record<string, any>; sort?: number }> }) {
		loading.value = true
		const res = await update(id, payload)
		if (res.success) {
			current.value = res.data
			dashboards.value = dashboards.value.map((d) => (d.id === id ? res.data : d))
		}
		loading.value = false
		return res
	}

	async function rollbackDashboard(id: number, versionId: number) {
		loading.value = true
		const res = await rollback(id, versionId)
		if (res.success) current.value = res.data
		loading.value = false
		return res
	}

	async function switchVersion(dashboardId: number, versionId: number) {
		loading.value = true
		const res = await rollback(dashboardId, versionId)
		if (res.success) {
			current.value = res.data
			// update dashboards list with the new current_version
			dashboards.value = dashboards.value.map((d) => (d.id === dashboardId ? res.data : d))
		}
		loading.value = false
		return res
	}

	return {
		dashboards,
		current,
		versions,
		meta,
		links,
		loading,
		fetchDashboards,
		fetchDashboard,
		fetchVersions,
		createDashboard,
		updateDashboard,
		rollbackDashboard,
		switchVersion,
	}
})
