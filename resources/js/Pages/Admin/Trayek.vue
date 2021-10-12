<template>
  <div class="flex flex-row justify-between my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Trayek</h2>

    <button
      @click="modalTrayek('add')"
      class="bg-purple-600 text-white px-4 py-2 rounded-md"
    >
      Tambah Trayek
    </button>
  </div>

  <DataTable
    :data="trayeks"
    :columns="columns"
    @showing="onShowing"
    @searching="onSearching"
  >
    <tr
      class="text-gray-700 dark:text-gray-400"
      v-for="trayek in trayeks.data"
      :key="trayek.id"
    >
      <td class="px-4 py-3">{{ trayek.id }}</td>
      <td class="px-4 py-3">{{ trayek.kode }}</td>
      <td class="px-4 py-3">{{ trayek.rute }}</td>
      <td class="px-4 py-3">
        <img
          v-if="trayek.gambar"
          :src="trayek.gambar"
          :alt="trayek.kode"
          width="25%"
        />
        <p v-else>-</p>
      </td>
      <td class="px-4 py-3 mx-auto">
        <button @click="modalTrayek('edit', trayek.id)" class="mr-2">
          Edit
        </button>
        <button class="text-red-500 ml-2">Hapus</button>
      </td>
    </tr>
  </DataTable>

  <Dialog class="grid grid-cols-1">
    <template v-slot:content>
      <label class="block">
        <span class="dark:text-white">Kode</span>
        <input
          class="
            form-input
            border-none
            dark:text-white
            bg-gray-100
            dark:bg-gray-700
            block
            mt-2
            w-full
            rounded-md
            shadow-md
          "
          type="text"
          name="kode"
          id="kode"
          v-model="trayek.kode"
        />
      </label>

      <label class="block mt-4">
        <span class="dark:text-white">Rute</span>
        <input
          class="
            form-input
            border-none
            dark:text-white
            bg-gray-100
            dark:bg-gray-700
            block
            mt-2
            w-full
            rounded-md
            shadow-md
          "
          type="text"
          name="rute"
          id="rute"
          v-model="trayek.rute"
        />
      </label>

      <label class="block mt-4">
        <span class="dark:text-white">Rute Berangkat</span>
        <textarea
          class="
            form-textarea
            border-none
            dark:text-white
            bg-gray-100
            dark:bg-gray-700
            block
            mt-2
            w-full
            rounded-md
            shadow-md
          "
          rows="3"
          name="berangkat"
          id="berangkat"
          v-model="trayek.berangkat"
        ></textarea>
      </label>

      <label class="block mt-4">
        <span class="dark:text-white">Rute Pulang</span>
        <textarea
          class="
            form-textarea
            border-none
            dark:text-white
            bg-gray-100
            dark:bg-gray-700
            block
            mt-2
            w-full
            rounded-md
            shadow-md
          "
          rows="3"
          name="pulang"
          id="pulang"
          v-model="trayek.pulang"
        ></textarea>
      </label>

      <label class="block mt-4">
        <span class="dark:text-white">Gambar</span>
        <input
          class="
            form-input
            border-none
            dark:text-white
            bg-gray-100
            dark:bg-gray-700
            block
            mt-2
            w-full
            rounded-md
            shadow-md
          "
          type="text"
          name="gambar"
          id="gambar"
          v-model="trayek.gambar"
        />
      </label>
    </template>

    <template v-slot:footer>
      <button
        type="button"
        class="
          inline-flex
          justify-center
          mr-2
          px-4
          py-2
          text-sm
          font-medium
          text-white
          border border-transparent
          rounded-md
          hover:bg-gray-700
          focus:outline-none
        "
        @click="toggleModal"
      >
        Batal
      </button>
      <button
        type="button"
        class="
          inline-flex
          justify-center
          ml-2
          px-4
          py-2
          text-sm
          font-medium
          text-white
          bg-purple-600
          border border-transparent
          rounded-md
          hover:bg-purple-400
          focus:outline-none
        "
      >
        Simpan
      </button>
    </template>
  </Dialog>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import Dialog from "@/Components/Dialog";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import eventBus from "@/eventBus";

export default {
  layout: AppLayout,
  components: {
    DataTable,
    Dialog,
  },
  props: {
    auth: Object,
    errors: Object,
    trayeks: Object,
  },
  setup(props) {
    const trayek = reactive({
      id: 0,
      kode: "",
      rute: "",
      berangkat: "",
      pulang: "",
      gambar: "",
    });

    const modal = reactive({
      type: "",
      isOpen: false,
    });

    const filters = reactive({
      show: 0,
      search: "",
    });

    const columns = ["ID", "Kode Trayek", "Rute", "Gambar"];

    const toggleModal = () => eventBus.$emit("modal-toggle");

    const modalTrayek = (type, id = null) => {
      trayek.id = 0;
      trayek.kode = "";
      trayek.rute = "";
      trayek.berangkat = "";
      trayek.pulang = "";
      trayek.gambar = "";

      if (type == "add") {
        modal.type = "Tambah Trayek";
      } else if (type == "edit") {
        modal.type = "Edit Trayek";
        const selected = props.trayeks.data.find((trayek) => trayek.id == id);
        console.log(selected);

        trayek.id = selected.id;
        trayek.kode = selected.kode;
        trayek.rute = selected.rute;
        trayek.berangkat = selected.berangkat;
        trayek.pulang = selected.pulang;
        trayek.gambar = selected.gambar;
      }

      toggleModal();
    };

    const onShowing = (val) => {
      filters.show = val;
      Inertia.get(route("admin.trayek.index"), filters, {
        preserveState: true,
      });
    };

    const onSearching = (q) => {
      filters.search = q;
      setTimeout(
        () =>
          Inertia.get(route("admin.trayek.index"), filters, {
            preserveState: true,
          }),
        150
      );
    };

    return {
      trayek,
      columns,
      modalTrayek,
      toggleModal,
      onShowing,
      onSearching,
    };
  },
};
</script>
