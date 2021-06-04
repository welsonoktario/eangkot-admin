<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside class="w-1/6">
      <template v-if="navbarMounted">
        <sidebar />
      </template>
    </aside>

    <div class="flex flex-col flex-1 w-full">
      <!-- Navbar -->
      <header>
        <navbar />
      </header>

      <main class="h-full overflow-y-auto shadow-inner">
        <div class="container p-4 mx-auto">
          <slot></slot>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import event from "@/eventBus";
import Sidebar from "@/Components/Layouts/Sidebar";
import Navbar from "@/Components/Layouts/Navbar";

export default {
  components: {
    Sidebar,
    Navbar,
  },
  setup() {
    const navbarMounted = ref(false);
    event.$once("navbar-mounted", () => (navbarMounted.value = true));

    return { navbarMounted };
  },
};
</script>
