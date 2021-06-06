<template>
  <data-table :data="angkots" :columns="columns">
    <tr
      class="text-gray-700 dark:text-gray-400"
      v-for="angkot in angkots.data"
      :key="angkot.id"
    >
      <td class="px-4 py-3">{{ angkot.id }}</td>
      <td class="px-4 py-3">{{ angkot.trayek.kode }}</td>
      <td class="px-4 py-3">{{ angkot.no_kendaraan }}</td>
      <td class="px-4 py-3 text-sm">
        <span
          class="px-2 py-1 font-semibold leading-tight rounded-full"
          :class="{
            'text-green-700 bg-green-100': angkot.aktif,
            'text-gray-700 bg-gray-100 dark:text-gray-100 dark:bg-gray-700':
              !angkot.aktif,
          }"
          >{{ angkot.aktif ? "Aktif" : "Non-Aktif" }}</span
        >
      </td>
      <td class="px-4 py-3 mx-auto">
        <button @click="editAngkot(angkot.id)">Edit</button>
      </td>
    </tr>
  </data-table>
  <modal :open="isModalOpen">
    <template v-slot:title>Keren</template>
    <template v-slot:content>Mantap!</template>
  </modal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import Modal from "@/Components/Modal";
import { ref } from "@vue/reactivity";

export default {
  layout: AppLayout,
  components: {
    DataTable,
    Modal,
  },
  props: {
    auth: Object,
    errors: Object,
    angkots: Object,
  },
  setup() {
    const isModalOpen = ref(false);
    const columns = ["ID", "Trayek", "No. Kendaraan", "Status"];
    const editAngkot = (id) => (isModalOpen.value = !isModalOpen.value);

    return { isModalOpen, columns, editAngkot };
  },
};
</script>
