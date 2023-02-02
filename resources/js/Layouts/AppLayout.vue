<template>
  <div
    class="grid h-screen grid-cols-12"
    :class="{ 'overflow-hidden': sidebarOpen }"
  >
    <!-- Sidebar -->
    <Sidebar />

    <div class="col-span-12 h-full w-full md:col-span-10">
      <div class="flex h-full flex-col">
        <!-- Navbar -->
        <header class="z-10 flex-none bg-white py-4 dark:bg-gray-800">
          <navbar />
        </header>

        <main class="container flex-1 overflow-y-auto px-6">
          <slot></slot>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue"
import event from "@/eventBus"
import Sidebar from "@components/Layouts/Sidebar.vue"
import Navbar from "@components/Layouts/Navbar.vue"

const sidebarOpen = ref(false)

onMounted(() =>
  event.$on("sidebar-toggle", () => (sidebarOpen.value = !sidebarOpen.value))
)
</script>
