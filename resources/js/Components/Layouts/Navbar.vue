<template>
  <div class="w-full bg-white dark:bg-gray-800 dark:text-white">
    <div class="container p-4 mx-auto">
      <div class="flex items-center justify-between">
        <h1 v-if="title" class="text-2xl">{{ title }}</h1>
        <h1 v-else class="text-2xl">Title</h1>
        <h1>Henlo</h1>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import event from "@/eventBus";

export default {
  setup() {
    const title = ref("");

    event.$once("current-route", (label) => (title.value = label));

    onMounted(() => {
      event.$emit("navbar-mounted");
      event.$on("page-navigation", (label) => (title.value = label));
    });

    return { title };
  },
};
</script>
