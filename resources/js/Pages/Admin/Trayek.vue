<template>
  <h1>Ini trayek</h1>
</template>

<script>
import { onMounted } from 'vue';
import event from '@/eventBus';
import AppLayout from '@/Layouts/AppLayout';

export default {
  layout: AppLayout,
  setup() {
    onMounted(() => event.$emit("page-navigation", "Trayek"));
  },
}
</script>
