import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";
import AppLayout from "./Layouts/AppLayout";

createInertiaApp({
  resolve: async (name) => {
    const page = await import(`./Pages/${name}.vue`);

    if (name.startsWith("Admin")) {
      page.default.layout = AppLayout;
    }

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin, ZiggyVue, Ziggy)
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });
