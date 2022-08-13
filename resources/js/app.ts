import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
// @ts-ignore
import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";
import AppLayout from "./Layouts/AppLayout.vue";

createInertiaApp({
  resolve: async (name) => {
    const page = await import(`./Pages/${name}.vue`);

    if (name.startsWith("Admin")) {
      page.default.layout = AppLayout;
    }

    return page;
  },
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin, ZiggyVue, Ziggy)
      // @ts-ignore
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });
