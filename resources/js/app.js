import "../css/app.css"

import { createApp, h } from "vue"
import { createInertiaApp } from "@inertiajs/inertia-vue3"
import { InertiaProgress } from "@inertiajs/progress"
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m"
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers"
import AppLayout from "./Layouts/AppLayout.vue"

const appName =
  window.document.getElementsByTagName("title")[0]?.innerText || "Laravel"

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: async (name) => {
    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    )

    if (name.startsWith("Admin")) {
      page.default.layout = AppLayout
    }

    return page
  },
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin, ZiggyVue, Ziggy)
      // @ts-ignore
      .mixin({ methods: { route } })
      .mount(el)
  },
})

InertiaProgress.init({ color: "#4B5563" })
