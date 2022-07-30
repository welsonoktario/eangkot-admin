<template>
  <div class="my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">User</h2>

    <DataTable
      :data="users"
      :columns="columns"
      @showing="onShowing"
      @searching="onSearching"
    >
      <tr
        class="text-gray-700 dark:text-gray-400"
        v-for="user in users.data"
        :key="user.id"
      >
        <td class="px-4 py-3">{{ user.id }}</td>
        <td class="px-4 py-3">{{ user.nama }}</td>
        <td class="px-4 py-3">{{ user.no_hp }}</td>
        <td class="px-4 py-3">{{ user.email }}</td>
        <td class="inline-flex items-center px-4 py-3 mx-auto justify-evenly">
          <button @click="modalUser('detail', user.id)" class="mr-2">
            <EyeIcon class="h-5" />
          </button>
          <button @click="modalUser('edit', user.id)" class="ml-2">
            <PencilIcon class="h-5" />
          </button>
        </td>
      </tr>
    </DataTable>

    <Dialog class="grid grid-cols-1">
      <template v-slot:title>
        {{ modal.type }}
      </template>

      <template v-slot:content>
        {{ selected.id }}
      </template>

      <template v-slot:footer>
        <button
          type="button"
          class="inline-flex justify-center px-4 py-2 mr-2 text-sm font-medium text-white border border-transparent rounded-md hover:bg-gray-700 focus:outline-none"
          @click="toggleModal"
        >
          {{ modal.type == "Detail User" ? "Tutup" : "Batal" }}
        </button>
        <button
          v-if="modal.type == 'Edit User'"
          type="button"
          class="inline-flex justify-center px-4 py-2 ml-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none"
          @click="submitForm"
        >
          Simpan
        </button>
      </template>
    </Dialog>
  </div>
</template>

<script>
export default {
  layout: AppLayout,
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import Dialog from "@/Components/Dialog";
import { reactive, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { EyeIcon, PencilIcon } from "@heroicons/vue/outline";
import eventBus from "@/eventBus";

const props = defineProps({
  auth: Object,
  errors: Object,
  users: Object,
});

const selected = ref({
  id: 0,
  nama: "",
  hp: "",
  email: "",
});

const modal = reactive({
  type: "",
  isOpen: false,
});

const filters = reactive({
  show: 0,
  search: "",
});

const columns = ["ID", "Nama", "No. HP", "Email"];

const toggleModal = () => eventBus.$emit("modal-toggle");

const modalUser = (type, id = null) => {
  selected.value = {
    id: 0,
    nama: "",
    hp: "",
    email: "",
  };
  selected.value = props.users.data.find((user) => user.id == id);

  if (type == "detail") {
    modal.type = "Detail User";
  } else if (type == "edit") {
    modal.type = "Edit User";
  }

  toggleModal();
};

const onShowing = (val) => {
  filters.show = val;
  Inertia.get(route("admin.akun.user.index"), filters, {
    preserveState: true,
  });
};

const onSearching = (q) => {
  filters.search = q;
  setTimeout(
    () =>
      Inertia.get(route("admin.akun.user.index"), filters, {
        preserveState: true,
      }),
    150
  );
};
</script>
