
// nuxt.config.ts
// import { defineNuxtConfig } from 'nuxt'
import { defineNuxtConfig } from "nuxt/config"
import { createResolver } from '@nuxt/kit'

const { resolve } = createResolver(import.meta.url)

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  css: ['vuetify/lib/styles/main.sass', '@mdi/font/css/materialdesignicons.min.css',],
  build: {
    transpile: ['vuetify'],
  },
  vite: {
    define: {
      'process.env.DEBUG': false,
    },
  },
})