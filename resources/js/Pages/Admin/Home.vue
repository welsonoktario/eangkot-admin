<template>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
  <h2 class="font-semibold text-7xl text-gray-800 leading-tight">Dashboard</h2>
</template>

<script>
import { onMounted } from "vue";
import event from "@/eventBus";
import AppLayout from '@/Layouts/AppLayout';

export default {
  layout: AppLayout,
  props: {
    auth: Object,
    errors: Object,
  },
  setup() {
    onMounted(() => event.$emit("page-navigation", "Home"));
  },
};
</script>
