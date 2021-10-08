<template>
  <div class="flex flex-row justify-between my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Angkot</h2>

    <button
      @click="modalAngkot('add')"
      class="bg-purple-600 text-white px-4 py-2 rounded-md"
    >
      Tambah Angkot
    </button>
  </div>
  <data-table
    :data="angkots"
    :columns="columns"
    @showing="onShowing"
    @searching="onSearching"
  >
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
        <button @click="modalAngkot('edit', angkot.id)">Edit</button>
      </td>
    </tr>
  </data-table>
  <modal>
    <template v-slot:title>{{ modal.type }}</template>
    <template v-slot:content></template>
  </modal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import Modal from "@/Components/Modal";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import eventBus from "@/eventBus";

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
  setup(props) {
    const modal = reactive({
      type: "",
      isOpen: false,
    });
    const filters = reactive({
      show: 0,
      search: "",
    });
    const columns = ["ID", "Trayek", "No. Kendaraan", "Status"];
    const modalAngkot = (type, id = null) => {
      if (type == "add") {
        modal.type = "Tambah Angkot";
        // Inertia.get(route("admin.angkot.create"));
      } else if (type == "edit") {
        modal.type = "Edit Angkot";
      }

      eventBus.$emit("modal-toggle");
    };

    const onShowing = (val) => {
      filters.show = val;
      Inertia.get(route("admin.angkot.index"), filters, {
        preserveState: true,
      });
    };

    const onSearching = (q) => {
      filters.search = q;
      setTimeout(
        () =>
          Inertia.get(route("admin.angkot.index"), filters, {
            preserveState: true,
          }),
        150
      );
    };

    return { columns, modal, modalAngkot, onShowing, onSearching };
  },
};
</script>
