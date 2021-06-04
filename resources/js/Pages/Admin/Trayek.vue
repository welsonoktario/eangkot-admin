<template>
  <h1>Ini trayek</h1>
</template>

<script>
import { onMounted } from 'vue';
import event from '@/eventBus';

export default {
  setup() {
    onMounted(() => event.$emit("page-navigation", "Trayek"));
  },
}
</script>
