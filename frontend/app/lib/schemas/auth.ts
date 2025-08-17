// ~/schemas/auth.ts
import { z } from "zod"

export const resetPasswordSchema = z
	.object({
		email: z.string().email("Invalid email address"),
		password: z.string().min(8, "Password must be at least 8 characters"),
		password_confirmation: z.string().min(8, "Confirm password must be at least 8 characters"),
		token: z.string().min(1, "Token is required"),
	})
	.refine((data) => data.password === data.password_confirmation, {
		message: "Passwords do not match",
		path: ["password_confirmation"],
	})
export type ResetPasswordInput = z.infer<typeof resetPasswordSchema>

export const changePasswordSchema = z
	.object({
		current_password: z.string().min(1, "Current password is required"),
		new_password: z.string().min(8, "New password must be at least 8 characters"),
		new_password_confirmation: z.string().min(8, "Confirm password must be at least 8 characters"),
	})
	.refine((data) => data.new_password === data.new_password_confirmation, {
		message: "Passwords do not match",
		path: ["new_password_confirmation"],
	})
export type ChangePasswordInput = z.infer<typeof changePasswordSchema>

export const loginSchema = z.object({
	email: z.string().min(1, "Email is required"),
	password: z.string().min(1, "Password is required"),
})
export type LoginInput = z.infer<typeof loginSchema>

export const signupSchema = z
	.object({
		name: z.string().min(1, "Name is required"),
		email: z.string().min(1, "Email is required"),
		password: z.string().min(6, "Password must be at least 6 characters"),
		password_confirmation: z.string().min(6, "Confirm password must be at least 6 characters"),
	})
	.refine((data) => data.password === data.password_confirmation, {
		message: "Passwords must match",
		path: ["password_confirmation"],
	})
export type SignupInput = z.infer<typeof signupSchema>

export const updateProfileSchema = z.object({
	name: z.string().min(1, "Name is required"),
	email: z.string().email("Valid email is required"),
})
export type UpdateProfileInput = z.infer<typeof updateProfileSchema>

export const forgotPasswordSchema = z.object({
	email: z.string().email("Invalid email address"),
})

export type ForgotPasswordInput = z.infer<typeof forgotPasswordSchema>
