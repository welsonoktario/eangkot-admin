import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";

createInertiaApp({
  resolve: (name) => {
    return import(`./Pages/${name}.vue`).then((page) => {
      page.default.layout = page.default.layout || App;
      return page;
    });
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin, ZiggyVue, Ziggy)
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });
