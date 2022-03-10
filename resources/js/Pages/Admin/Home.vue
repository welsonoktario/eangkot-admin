<template>
  <h1 class="dark:text-gray-50">Ini Home</h1>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  layout: AppLayout,
  props: {
    auth: Object,
    errors: Object,
  }
};
</script>
