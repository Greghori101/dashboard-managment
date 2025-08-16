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

interface PaginatedResponse<T> {
	items: T[]
	meta: PaginationMeta
	links: PaginationLinks
}

interface ApiResponse<T> {
	success: boolean
	message: string
	data: T
}

export const useDashboard = () => {
	const { $api } = useNuxtApp()
    
	// GET /dashboards (with filters, pagination, sorting)
	async function index(filters: Record<string, any> = {}) {
		const res = await $api<ApiResponse<PaginatedResponse<Dashboard>>>("/dashboards", {
			method: "GET",
			query: filters,
			protected: true,
		})

		return res
	}

	// GET /dashboards/:id
	async function show(id: number) {
		const res = await $api<ApiResponse<Dashboard>>(`/dashboards/${id}`, {
			method: "GET",
			protected: true,
		})
		return res
	}

	// GET /dashboards/:id/versions
	async function versions(id: number) {
		return await $api<ApiResponse<Version[]>>(`/dashboards/${id}/versions`, {
			method: "GET",
			protected: true,
		})
	}

	// POST /dashboards
	async function store(payload: { name: string; widgets: Array<{ type: string; data: Record<string, any>; sort?: number }> }) {
		const res = await $api<ApiResponse<Dashboard>>("/dashboards", {
			method: "POST",
			body: payload,
			protected: true,
		})
		return res
	}

	// PUT /dashboards/:id
	async function update(id: number, payload: { widgets: Array<{ type: string; data: Record<string, any>; sort?: number }> }) {
		const res = await $api<ApiResponse<Dashboard>>(`/dashboards/${id}`, {
			method: "PUT",
			body: payload,
			protected: true,
		})
		return res
	}

	// POST /dashboards/:id/rollback/:versionId
	async function rollback(id: number, versionId: number) {
		const res = await $api<ApiResponse<Dashboard>>(`/dashboards/${id}/rollback/${versionId}`, {
			method: "POST",
			protected: true,
		})
		return res
	}

	return {
		index,
		show,
		versions,
		store,
		update,
		rollback,
	}
}
