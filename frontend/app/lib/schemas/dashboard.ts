// ~/schemas/dashboard.ts
import { z } from "zod"

// Widget schema
export const widgetSchema = z.object({
	type: z.enum(["text", "link"]),
	data: z.any(),
	sort: z.number().optional(),
})

// Dashboard create schema
export const createDashboardSchema = z.object({
	name: z.string().min(1, "Dashboard name is required"),
	widgets: z.array(widgetSchema),
})

// Dashboard update schema
export const updateDashboardSchema = z.object({
	widgets: z.array(widgetSchema),
})

// Types
export type CreateDashboardInput = z.infer<typeof createDashboardSchema>
export type UpdateDashboardInput = z.infer<typeof updateDashboardSchema>
