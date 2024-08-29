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
  tiptap: {
    prefix: 'Tiptap', //prefix for Tiptap imports, composables not included
  },
  build: {
    transpile: ['vuetify'],
  },

  vite: {
    define: {
      'process.env.DEBUG': false,
    },
  },
  nitro: {
    storage: {
      redis: {
        driver: 'redis',
        /* redis connector options */
      },
      db: {
        driver: 'fs',
        base: './.data/db'
      }
    }
  },
  fileStorage: {
    // enter the absolute path to the location of your storage
    mount: '/home/$USR/development/nuxt-file-storage/server/files',

    // {OR} use environment variables (recommended)
    // mount: process.env.mount
    // you need to set the mount in your .env file at the root of your project
  },
  modules: ['nuxt-tiptap-editor', 'nuxt-file-storage'],

  
})