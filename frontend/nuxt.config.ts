import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	compatibilityDate: "2025-07-15",
	devtools: { enabled: true },
	runtimeConfig: {
		public: {
			apiBase: process.env.NUXT_PUBLIC_API_BASE || "http://localhost:8000/api/v1",
		},
	},
	modules: ["@nuxt/image", "@nuxt/test-utils", "@nuxt/ui", "@nuxt/icon", "@vueuse/nuxt", "@pinia/nuxt"],
	css: ["~/assets/css/main.css"],
	vite: {
    plugins: [
      tailwindcss(),
    ],
  },
})
