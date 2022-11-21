<template>
  <Head>
    <title>eAngkot Admin - Trayek</title>
  </Head>

  <div class="my-6 flex flex-row justify-between">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Trayek</h2>

    <button
      @click="modalTrayek('add')"
      class="rounded-lg bg-opacity-10 px-4 py-2 text-indigo-500 transition duration-150 ease-out hover:bg-indigo-500 hover:text-gray-50 hover:shadow-lg dark:text-indigo-400 dark:hover:bg-indigo-400 dark:hover:text-gray-100"
    >
      Tambah Trayek
    </button>
  </div>

  <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 md:grid-cols-5">
    <div
      v-for="trayek in trayeks.data"
      :key="trayek.id"
      class="cursor-pointer rounded-xl bg-gray-50 p-4 shadow-lg dark:bg-gray-800"
      @click="modalTrayek('edit', trayek.id)"
    >
      <div
        class="h-28 w-full rounded-xl border border-black bg-cover bg-top bg-no-repeat dark:border-0 dark:border-transparent md:h-24"
        :style="{
          backgroundImage: `url(${trayek.gambar})`,
        }"
      ></div>
      <p class="mt-4 text-center text-xl font-bold dark:text-gray-50">
        Trayek {{ trayek.kode }}
      </p>
    </div>
  </div>

  <Pagination
    class="mx-auto mt-16 mb-8 grid text-xs font-semibold tracking-wide text-gray-500 dark:border-gray-700 dark:text-gray-50 sm:grid-cols-9"
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
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          name="kode"
          id="kode"
          v-model="trayek.kode"
        />
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Rute</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          name="rute"
          id="rute"
          v-model="trayek.rute"
        />
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Rute Berangkat</span>
        <textarea
          class="form-textarea mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          rows="3"
          name="berangkat"
          id="berangkat"
          v-model="trayek.berangkat"
        ></textarea>
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Rute Pulang</span>
        <textarea
          class="form-textarea mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          rows="3"
          name="pulang"
          id="pulang"
          v-model="trayek.pulang"
        ></textarea>
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Gambar</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="url"
          name="gambar"
          id="gambar"
          v-model.lazy="trayek.gambar"
        />
        <div
          v-if="trayek.gambar"
          class="mt-2 h-36 w-full rounded-lg border border-black bg-cover bg-top bg-no-repeat"
          :style="{ backgroundImage: `url(${trayek.gambar})` }"
        />
      </label>
    </template>

    <template v-slot:footer>
      <button
        type="button"
        class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none dark:text-gray-50 dark:hover:bg-gray-700"
        @click="toggleModal"
      >
        Batal
      </button>
      <button
        type="button"
        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none"
      >
        Simpan
      </button>
    </template>
  </Dialog>
</template>

<script setup>
import Dialog from "@components/Dialog.vue"
import { reactive } from "vue"
import { Inertia } from "@inertiajs/inertia"
import { Head } from "@inertiajs/inertia-vue3"
import eventBus from "@/eventBus"
import Pagination from "@components/Pagination.vue"

const props = defineProps({
  auth: Object,
  errors: Object,
  trayeks: Object,
})

const trayek = reactive({
  id: 0,
  kode: "",
  rute: "",
  berangkat: "",
  pulang: "",
  gambar: "",
})

const modal = reactive({
  type: "",
  isOpen: false,
})

const filters = reactive({
  show: 0,
  search: "",
})

const toggleModal = () => eventBus.$emit("modal-toggle")

const modalTrayek = (type, id = null) => {
  trayek.id = 0
  trayek.kode = ""
  trayek.rute = ""
  trayek.berangkat = ""
  trayek.pulang = ""
  trayek.gambar = ""

  if (type == "add") {
    modal.type = "Tambah Trayek"
  } else if (type == "edit") {
    modal.type = "Edit Trayek"
    const selected = props.trayeks.data.find((trayek) => trayek.id == id)
    console.log(selected)

    trayek.id = selected.id
    trayek.kode = selected.kode
    trayek.rute = selected.rute
    trayek.berangkat = selected.berangkat
    trayek.pulang = selected.pulang
    trayek.gambar = selected.gambar
  }

  toggleModal()
}

const onShowing = (val) => {
  filters.show = val
  Inertia.get(route("admin.trayek.index"), filters, {
    preserveState: true,
  })
}

const onSearching = (q) => {
  filters.search = q
  setTimeout(
    () =>
      Inertia.get(route("admin.trayek.index"), filters, {
        preserveState: true,
      }),
    150
  )
}
</script>
