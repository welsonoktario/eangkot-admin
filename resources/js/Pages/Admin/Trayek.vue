<template>
  <div class="flex flex-row justify-between my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Trayek</h2>

    <button
      @click="modalTrayek('add')"
      class="
        transition
        duration-150
        ease-out
        text-indigo-500
        dark:text-indigo-400
        hover:bg-indigo-500
        hover:text-gray-50
        dark:hover:bg-indigo-400
        dark:hover:text-gray-100
        hover:shadow-lg
        rounded-lg
        bg-opacity-10
        px-4
        py-2
      "
    >
      Tambah Trayek
    </button>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-8">
    <div
      v-for="trayek in trayeks.data"
      :key="trayek.id"
      class="
        rounded-xl
        shadow-lg
        bg-gray-50
        dark:bg-gray-800
        p-4
        cursor-pointer
      "
      @click="modalTrayek('edit', trayek.id)"
    >
      <div
        class="
          w-full
          rounded-xl
          border border-black
          dark:border-0 dark:border-transparent
          h-28
          md:h-24
          bg-top bg-no-repeat bg-cover
        "
        :style="{
          backgroundImage: `url(${trayek.gambar})`,
        }"
      ></div>
      <p class="text-xl font-bold text-center mt-4 dark:text-gray-50">Trayek {{ trayek.kode }}</p>
    </div>
  </div>

  <Pagination
    class="
      grid
      mt-16
      mb-8
      mx-auto
      text-xs
      font-semibold
      tracking-wide
      text-gray-500
      dark:border-gray-700
      sm:grid-cols-9
      dark:text-gray-50
    "
    :showLabel="false"
    :from="trayeks.from"
    :to="trayeks.to"
    :total="trayeks.total"
    :links="trayeks.links"
  />

  <Dialog class="grid grid-cols-1">
    <template v-slot:title>
      {{ modal.type }}
    </template>

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
          "
          type="url"
          name="gambar"
          id="gambar"
          v-model.lazy="trayek.gambar"
        />
        <div
          v-if="trayek.gambar"
          class="
            mt-2
            h-36
            w-full
            rounded-lg
            bg-top bg-no-repeat bg-cover
            border border-black
          "
          :style="{ backgroundImage: `url(${trayek.gambar})` }"
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
          text-gray-900
          dark:text-gray-50
          border border-transparent
          rounded-md
          hover:bg-gray-200
          dark:hover:bg-gray-700
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
          bg-indigo-600
          border border-transparent
          rounded-md
          hover:bg-indigo-400
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
import Dialog from "@/Components/Dialog";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import eventBus from "@/eventBus";
import Pagination from "@/Components/Pagination.vue";

export default {
  layout: AppLayout,
  components: {
    Dialog,
    Pagination,
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
      modal,
      trayek,
      modalTrayek,
      toggleModal,
      onShowing,
      onSearching,
    };
  },
};
</script>
