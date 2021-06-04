<template>
  <div
    class="flex h-screen bg-gray-100 dark:bg-gray-900"
    :class="{ 'overflow-hidden': sidebarOpen }"
  >
    <!-- Sidebar -->
    <sidebar />

    <div class="flex flex-col flex-1 w-full">
      <!-- Navbar -->
      <header>
        <navbar />
      </header>

      <main class="h-full overflow-y-auto shadow-inner">
        <div class="container mx-auto py-4 md:px-4">
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
