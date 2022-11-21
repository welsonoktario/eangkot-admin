<template>
  <Head>
    <title>eAngkot Admin - Driver</title>
  </Head>

  <div class="my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Driver</h2>

    <DataTable
      :data="drivers"
      :columns="columns"
      @showing="onShowing"
      @searching="onSearching"
    >
      <tr
        class="text-gray-700 dark:text-gray-400"
        v-for="driver in drivers.data"
        :key="driver.id"
      >
        <td class="px-4 py-3">{{ driver.id }}</td>
        <td class="px-4 py-3">{{ driver.user.nama }}</td>
        <td class="px-4 py-3">{{ driver.user.no_hp }}</td>
        <td class="px-4 py-3">{{ driver.user.email }}</td>
        <td class="px-4 py-3">{{ driver.alamat }}</td>
        <td class="mx-auto px-4 py-3">
          <button @click="modalDriver('detail', driver.id)" class="mr-2">
            Detail
          </button>
          <button @click="modalDriver('edit', driver.id)" class="ml-2">
            Edit
          </button>
        </td>
      </tr>
    </DataTable>

    <Dialog class="grid grid-cols-1">
      <template v-slot:title>
        {{ modal.type }}
      </template>

      <template v-slot:content>
        {{ driver.id }}
      </template>

      <template v-slot:footer>
        <button
          type="button"
          class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none"
          @click="toggleModal"
        >
          {{ modal.type == "Detail Driver" ? "Tutup" : "Batal" }}
        </button>
        <button
          v-if="modal.type == 'Edit Driver'"
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
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import eventBus from "@/eventBus";

defineProps({
  auth: Object,
  errors: Object,
  drivers: Object,
});

const driver = reactive({
  id: 0,
  user: {
    id: 0,
    nama: "",
    hp: "",
    email: "",
  },
  angkot: {
    id: 0,
    plat: "",
    aktif: "",
    trayek: {
      id: 0,
      kode: "",
    },
  },
  alamat: "",
});

const modal = reactive({
  type: "",
  isOpen: false,
});

const filters = reactive({
  show: 0,
  search: "",
});

const columns = ["ID", "Nama", "No. HP", "Email", "Alamat"];

const toggleModal = () => eventBus.$emit("modal-toggle");

const modalDriver = (type, id = null) => {
  driver.id = 0;
  driver.user = {
    id: 0,
    nama: "",
    hp: "",
    email: "",
  };
  driver.angkot = {
    id: 0,
    plat: "",
    aktif: "",
    trayek: {
      id: 0,
      kode: "",
    },
  };
  driver.alamat = "";

  if (type == "detail") {
    modal.type = "Detail Driver";

    const selected = props.drivers.data.find((driver) => driver.id == id);
    driver.id = selected.id;
    driver.user = {
      id: selected.user.id,
      nama: selected.user.nama,
      hp: selected.user.no_hp,
      email: selected.user.email,
    };
    driver.angkot = {
      id: selected.angkot.id,
      plat: selected.angkot.no_kendaraan,
      aktif: selected.angkot.aktif ? true : false,
      trayek: {
        id: selected.angkot.trayek.id,
        kode: selected.angkot.trayek.kode,
      },
    };
    driver.alamat = selected.alamat;
  } else if (type == "edit") {
    modal.type = "Edit Driver";
    const selected = props.drivers.data.find((driver) => driver.id == id);

    driver.id = selected.id;
    driver.user = {
      id: selected.user.id,
      nama: selected.user.nama,
      hp: selected.user.no_hp,
      email: selected.user.email,
    };
    driver.angkot = {
      id: selected.angkot.id,
      plat: selected.angkot.no_kendaraan,
      aktif: selected.angkot.aktif ? true : false,
      trayek: {
        id: selected.angkot.trayek.id,
        kode: selected.angkot.trayek.kode,
      },
    };
    driver.alamat = selected.alamat;
  }

  toggleModal();
};

const onShowing = (val) => {
  filters.show = val;
  Inertia.get(route("admin.akun.driver.index"), filters, {
    preserveState: true,
  });
};

const onSearching = (q) => {
  filters.search = q;
  setTimeout(
    () =>
      Inertia.get(route("admin.akun.driver.index"), filters, {
        preserveState: true,
      }),
    150
  );
};
</script>
