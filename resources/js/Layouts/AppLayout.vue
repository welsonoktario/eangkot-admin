<template>
  <div
    class="grid grid-cols-12 h-screen"
    :class="{ 'overflow-hidden': sidebarOpen }"
  >
    <!-- Sidebar -->
    <Sidebar />

    <div class="col-span-12 md:col-span-10 w-full h-full">
      <div class="flex flex-col h-full">
        <!-- Navbar -->
        <header class="flex-none z-10 py-4 bg-white dark:bg-gray-800">
          <navbar />
        </header>

        <main class="flex-1 container overflow-y-auto px-6">
          <slot></slot>
        </main>
      </div>
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
    const sidebarOpen = ref(false);

    onMounted(() =>
      event.$on(
        "sidebar-toggle",
        () => (sidebarOpen.value = !sidebarOpen.value)
      )
    );

    return { sidebarOpen };
  },
};
</script>
