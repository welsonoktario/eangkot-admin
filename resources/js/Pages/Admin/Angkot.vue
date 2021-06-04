<template>
  <h1>Ini angkot</h1>
</template>

<script>
import { onMounted } from 'vue';
import event from '@/eventBus';
import AppLayout from '@/Layouts/AppLayout';

export default {
  layout: AppLayout,
  setup() {
    onMounted(() => event.$emit("page-navigation", "Angkot"));
  },
}
</script>
