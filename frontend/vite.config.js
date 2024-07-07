import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    host: '0.0.0.0', // Faz com que o servidor escute em todas as interfaces de rede
    port: 5173,      // Porta interna do Vite
    watch: {
      usePolling: true, // Habilita o polling para detectar mudanças nos arquivos
    },
  },
})