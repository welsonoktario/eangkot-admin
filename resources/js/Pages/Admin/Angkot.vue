<template>
  <Head>
    <title>eAngkot Admin - Angkot</title>
  </Head>

  <div class="my-6 flex flex-row justify-between">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Angkot</h2>

    <button
      @click="modalAngkot('add')"
      class="rounded-lg px-4 py-2 text-indigo-600 transition duration-150 ease-out hover:bg-indigo-500 hover:text-gray-50 hover:shadow-lg dark:text-indigo-500 dark:hover:bg-indigo-500 dark:hover:text-gray-100"
    >
      Tambah Angkot
    </button>
  </div>
  <DataTable
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
          class="rounded-full px-2 py-1 font-semibold leading-tight"
          :class="{
            'bg-indigo-100 text-indigo-700': angkot.aktif,
            'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-100':
              !angkot.aktif,
          }"
          >{{ angkot.aktif ? "Aktif" : "Non-Aktif" }}</span
        >
      </td>
      <td class="mx-auto px-4 py-3">
        <button @click="modalAngkot('edit', angkot.id)" class="mr-2">
          Edit
        </button>
        <button @click="deleteAngkot(angkot.id)" class="ml-2 text-red-500">
          Hapus
        </button>
      </td>
    </tr>
  </DataTable>

  <Dialog class="grid grid-cols-1">
    <template v-slot:title>
      {{ modal.type }}
    </template>

    <template v-slot:content>
      <label for="block">
        <span class="dark:text-white">Trayek</span>
        <Listbox v-model="angkot.trayek">
          <div class="relative mt-1">
            <ListboxButton
              class="relative w-full cursor-default rounded-md bg-gray-100 py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 dark:bg-gray-700 sm:text-sm"
            >
              <span class="block truncate dark:text-white">{{
                angkot.trayek.kode
              }}</span>
              <span
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
              >
                <ChevronUpDownIcon
                  class="h-5 w-5 text-gray-400"
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
                class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-700 sm:text-sm"
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
                        ? 'bg-indigo-100 text-indigo-500 dark:bg-gray-600 dark:text-indigo-400'
                        : 'text-gray-900 dark:text-white',
                      'relative cursor-default select-none py-2 pl-10 pr-4',
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
                      class="absolute inset-y-0 left-0 flex items-center pl-3 dark:text-indigo-400"
                    >
                      <CheckIcon class="h-5 w-5" aria-hidden="true" />
                    </span>
                  </li>
                </ListboxOption>
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">No. Kendaraan</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          name="no_kendaraan"
          id="no_kendaraan"
          v-model="angkot.plat"
        />
      </label>

      <label class="mt-6 flex flex-row justify-between">
        <span class="w-full dark:text-white">Aktif</span>
        <SwitchGroup>
          <Switch
            v-model="angkot.status"
            :class="
              angkot.status
                ? 'bg-indigo-500 dark:bg-indigo-400'
                : 'bg-gray-200 dark:bg-gray-700'
            "
            class="relative inline-flex h-6 w-12 items-center rounded-full transition-colors focus:outline-none"
          >
            <span
              :class="angkot.status ? 'translate-x-6' : 'translate-x-1'"
              class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
            />
          </Switch>
        </SwitchGroup>
      </label>
    </template>

    <template v-slot:footer>
      <button
        type="button"
        class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none"
        @click="toggleModal"
      >
        Batal
      </button>
      <button
        type="button"
        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none"
        @click="submitForm"
      >
        Simpan
      </button>
    </template>
  </Dialog>
</template>

<script setup>
import DataTable from "@components/DataTable.vue"
import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
  Switch,
  SwitchGroup,
} from "@headlessui/vue"
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/24/solid"
import Dialog from "@components/Dialog.vue"
import { reactive } from "vue"
import { Inertia } from "@inertiajs/inertia"
import { Head } from "@inertiajs/inertia-vue3"
import eventBus from "@/eventBus"

const props = defineProps({
  auth: Object,
  errors: Object,
  angkots: Object,
  trayeks: Array,
})

const angkot = reactive({
  id: 0,
  trayek: {
    id: 0,
    kode: "",
  },
  plat: "",
  status: false,
})

const modal = reactive({
  type: "",
  isOpen: false,
})

const filters = reactive({
  show: 0,
  search: "",
})

const columns = ["ID", "Trayek", "No. Kendaraan", "Status"]

const toggleModal = () => eventBus.$emit("modal-toggle")

const modalAngkot = (type, id = null) => {
  angkot.id = 0
  angkot.trayek = {
    id: props.trayeks[0].id,
    kode: props.trayeks[0].kode,
  }
  angkot.plat = ""
  angkot.status = false

  if (type == "add") {
    modal.type = "Tambah Angkot"
  } else if (type == "edit") {
    modal.type = "Edit Angkot"
    const selected = props.angkots.data.find((angkot) => angkot.id == id)

    angkot.id = id
    angkot.trayek = {
      id: selected.trayek.id,
      kode: selected.trayek.kode,
    }
    angkot.plat = selected.no_kendaraan
    angkot.status = selected.aktif ? true : false
  }

  toggleModal()
}

const onShowing = (val) => {
  filters.show = val
  Inertia.get(route("admin.angkot.index"), filters, {
    preserveState: true,
  })
}

const onSearching = (q) => {
  filters.search = q
  setTimeout(
    () =>
      Inertia.get(route("admin.angkot.index"), filters, {
        preserveState: true,
      }),
    150
  )
}

const submitForm = () => {
  if (modal.type == "Tambah Angkot") {
    Inertia.post(route("admin.angkot.store"), angkot, {
      preserveState: true,
      onSuccess: () => toggleModal(),
    })
  } else if (modal.type == "Edit Angkot") {
    Inertia.patch(route("admin.angkot.update", angkot.id), angkot, {
      preserveState: true,
      onSuccess: () => toggleModal(),
    })
  }
}

const deleteAngkot = (id) => {
  Inertia.delete(route("admin.angkot.destroy", id))
}
</script>
