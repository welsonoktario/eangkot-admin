<template>
  <Head>
    <title>eAngkot Admin - User</title>
  </Head>

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
        <td class="mx-auto inline-flex items-center justify-evenly px-4 py-3">
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
          class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none"
          @click="toggleModal"
        >
          {{ modal.type == "Detail User" ? "Tutup" : "Batal" }}
        </button>
        <button
          v-if="modal.type == 'Edit User'"
          type="button"
          class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none"
          @click="submitForm"
        >
          Simpan
        </button>
      </template>
    </Dialog>
  </div>
</template>

<script setup>
import DataTable from "@components/DataTable.vue";
import Dialog from "@components/Dialog.vue";
import { reactive, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { EyeIcon, PencilIcon } from "@heroicons/vue/24/solid";
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
