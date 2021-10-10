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

  <Dialog class="grid grid-cols-1">
    <template v-slot:content>
      <label for="block">
        <span class="dark:text-white">Trayek</span>
        <Listbox v-model="angkot.trayek">
          <div class="relative mt-1">
            <ListboxButton
              class="
                relative
                w-full
                py-2
                pl-3
                pr-10
                text-left
                bg-white
                dark:bg-gray-700
                rounded-md
                shadow-md
                cursor-default
                focus:outline-none
                focus-visible:ring-2
                focus-visible:ring-opacity-75
                focus-visible:ring-white
                focus-visible:ring-offset-orange-300
                focus-visible:ring-offset-2
                focus-visible:border-indigo-500
                sm:text-sm
              "
            >
              <span class="block truncate dark:text-white">{{
                angkot.trayek.kode
              }}</span>
              <span
                class="
                  absolute
                  inset-y-0
                  right-0
                  flex
                  items-center
                  pr-2
                  pointer-events-none
                "
              >
                <SelectorIcon
                  class="w-5 h-5 text-gray-400"
                  aria-hidden="true"
                />
              </span>
            </ListboxButton>

            <transition
              leave-active-class="transition duration-100 ease-in"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <ListboxOptions
                class="
                  absolute
                  w-full
                  py-1
                  mt-1
                  overflow-auto
                  text-base
                  bg-white
                  dark:bg-gray-700
                  rounded-md
                  shadow-lg
                  max-h-60
                  ring-1 ring-black ring-opacity-5
                  focus:outline-none
                  sm:text-sm
                "
              >
                <ListboxOption
                  v-slot="{ active, selected }"
                  v-for="trayek in trayeks"
                  :key="trayek.id"
                  :value="trayek"
                  as="template"
                >
                  <li
                    :class="[
                      active
                        ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-gray-600'
                        : 'text-gray-900 dark:text-white',
                      'cursor-default select-none relative py-2 pl-10 pr-4',
                    ]"
                  >
                    <span
                      :class="[
                        selected ? 'font-medium' : 'font-normal',
                        'block truncate',
                      ]"
                      class="dark:text-white"
                      >{{ trayek.kode }}</span
                    >
                    <span
                      v-if="selected"
                      class="
                        absolute
                        inset-y-0
                        left-0
                        flex
                        items-center
                        pl-3
                        dark:text-indigo-400
                      "
                    >
                      <CheckIcon class="w-5 h-5" aria-hidden="true" />
                    </span>
                  </li>
                </ListboxOption>
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
      </label>

      <label class="block mt-4">
        <span class="dark:text-white">No. Kendaraan</span>
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
          name="no_kendaraan"
          id="no_kendaraan"
          v-model="angkot.plat"
        />
      </label>

      <label class="mt-6 flex flex-row justify-between">
        <span class="dark:text-white w-full">Aktif?</span>
        <SwitchGroup>
          <p>
            <Switch
              v-model="angkot.status"
              :class="angkot.status ? 'bg-indigo-600' : 'bg-gray-700'"
              class="
                relative
                inline-flex
                items-center
                h-6
                transition-colors
                rounded-full
                w-11
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
              "
            >
              <span
                :class="angkot.status ? 'translate-x-6' : 'translate-x-1'"
                class="
                  inline-block
                  w-4
                  h-4
                  transition-transform
                  transform
                  bg-white
                  rounded-full
                "
              />
            </Switch>
          </p>
        </SwitchGroup>
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
        @click="submitForm"
      >
        Simpan
      </button>
    </template>
  </Dialog>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
  Switch,
  SwitchGroup,
  SwitchLabel,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";
import Dialog from "@/Components/Dialog";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import eventBus from "@/eventBus";

export default {
  layout: AppLayout,
  components: {
    CheckIcon,
    DataTable,
    Dialog,
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    SelectorIcon,
    Switch,
    SwitchGroup,
    SwitchLabel,
  },
  props: {
    auth: Object,
    errors: Object,
    angkots: Object,
    trayeks: Array,
  },
  setup(props) {
    const angkot = reactive({
      id: 0,
      trayek: {
        id: 0,
        kode: "",
      },
      plat: "",
      status: false,
    });

    const modal = reactive({
      type: "",
      isOpen: false,
    });

    const filters = reactive({
      show: 0,
      search: "",
    });

    const columns = ["ID", "Trayek", "No. Kendaraan", "Status"];

    const toggleModal = () => eventBus.$emit("modal-toggle");

    const modalAngkot = (type, id = null) => {
      angkot.id = 0;
      angkot.trayek = {
        id: 0,
        kode: "",
      };
      angkot.plat = "";
      angkot.status = false;

      if (type == "add") {
        modal.type = "Tambah Angkot";
      } else if (type == "edit") {
        modal.type = "Edit Angkot";
        const selected = props.angkots.data.find((angkot) => angkot.id == id);

        angkot.id = id;
        angkot.trayek = {
          id: selected.trayek.id,
          kode: selected.trayek.kode,
        };
        angkot.plat = selected.no_kendaraan;
        angkot.status = selected.aktif ? true : false;
      }

      toggleModal();
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

    const submitForm = () => {
      if (modal.type == "Tambah Angkot") {
        Inertia.post(route("admin.angkot.store"), angkot, {
          onSuccess: () => toggleModal(),
        });
      } else if (modal.type == "Edit Angkot") {
        Inertia.patch(route("admin.angkot.update", angkot.id), angkot, {
          onSuccess: () => toggleModal(),
        });
      }
    };

    return {
      angkot,
      columns,
      modalAngkot,
      toggleModal,
      onShowing,
      onSearching,
      submitForm,
    };
  },
};
</script>
