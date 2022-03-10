<template>
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
        <td class="px-4 py-3 mx-auto">
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
          {{ modal.type == "Detail Driver" ? "Tutup" : "Batal" }}
        </button>
        <button
          v-if="modal.type == 'Edit Driver'"
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
          @click="submitForm"
        >
          Simpan
        </button>
      </template>
    </Dialog>
  </div>
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
    drivers: Object,
  },
  setup(props) {
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

    return {
      modal,
      driver,
      columns,
      modalDriver,
      toggleModal,
      onShowing,
      onSearching,
    };
  },
};
</script>
