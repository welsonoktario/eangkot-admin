<template>
  <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow-md">
    <table class="table table-responsive mx-auto w-full dark:text-white">
      <thead>
        <tr>
          <th>ID</th>
          <th>Trayek</th>
          <th>No. Kendaraan</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="angkot in angkots.data" :key="angkot.id">
          <td>{{ angkot.id }}</td>
          <td>{{ angkot.trayek.kode }}</td>
          <td>{{ angkot.no_kendaraan }}</td>
          <td>{{ angkot.aktif ? "Aktif" : "Non-Aktif" }}</td>
        </tr>
      </tbody>
    </table>
    <pagination :links="angkots.links" />
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination.vue";

export default {
  layout: AppLayout,
  components: {
    Pagination,
  },
  props: {
    auth: Object,
    errors: Object,
    angkots: Object,
  },
};
</script>
