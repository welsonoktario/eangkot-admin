<template>
  <Head>
    <title>eAngkot Admin - Home</title>
  </Head>
  <h1 class="dark:text-gray-50">Ini Home</h1>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
  auth: Object,
  errors: Object,
});
</script>
