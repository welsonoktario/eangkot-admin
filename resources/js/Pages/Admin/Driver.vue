<template>
  <h1>Ini angkot</h1>
</template>

<script>
import { onMounted } from 'vue';
import event from '@/eventBus';

export default {
  setup() {
    onMounted(() => event.$emit("page-navigation", "Driver"));
  },
}
</script>
