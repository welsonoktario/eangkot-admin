import { createApp, h } from "vue";
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import Layout from "./Layouts/AppLayout";

const el = document.getElementById("app");

createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) => {
        const page = route().current().includes("admin")
          ? require(`./Pages/Admin/${name}`).default
          : require(`./Pages/Web/${name}`).default;
        page.layout = page.layout || Layout;
        return page;
      },
    }),
})
  .mixin({ methods: { route } })
  .use(InertiaPlugin)
  .mount(el);

InertiaProgress.init({ color: "#4B5563" });
