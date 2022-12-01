import { createApp, h } from 'vue'
import { Quasar } from 'quasar'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import '@quasar/extras/material-icons/material-icons.css'
import 'quasar/src/css/index.sass'
import Layout from './Layout.vue'

createInertiaApp({
  resolve: async (name) => {
    const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
    page.default.layout = page.layout || Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Quasar)
      .mount(el)
  },
})
