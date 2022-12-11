<template>
  <Head>
    <title>eAngkot Admin - Driver</title>
  </Head>

  <div class="my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Driver</h2>
  </div>

  <DataTable
    :data="drivers"
    :columns="columns"
    @showing="onShowing"
    @searching="onSearching"
  >
    <tr
      class="text-gray-700 dark:text-gray-400"
      v-for="(driver, index) in drivers.data"
      :key="driver.id"
    >
      <td class="px-4 py-3">{{ index + 1 }}</td>
      <td class="px-4 py-3">{{ driver.user.nama }}</td>
      <td class="px-4 py-3">{{ driver.user.no_hp }}</td>
      <td class="px-4 py-3">{{ driver.user.email ?? "-" }}</td>
      <td class="px-4 py-3">
        {{ driver.angkot?.no_kendaraan ?? "Belum memiliki angkot" }}
      </td>
      <td class="px-12 py-3 text-right">
        <button @click="modalDriver('Detail Driver', driver)" class="mr-2">
          Detail
        </button>
      </td>
    </tr>
  </DataTable>

  <Dialog class="grid grid-cols-1">
    <template v-slot:title>
      {{ modal.type }}
    </template>

    <template v-slot:content>
      <label class="block">
        <span class="dark:text-white">Nama</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.user.nama"
          readonly
        />
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">No. HP</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.user.no_hp"
          readonly
        />
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Email</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.user.email ?? '-'"
          readonly
        />
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Trayek</span>
        <select
          v-model="selectedTrayek"
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
        >
          <option value="0" selected disabled>Pilih trayek...</option>
          <option
            v-for="trayek in trayeks"
            :key="trayek.kode"
            :value="trayek.id"
          >
            {{ trayek.kode }}
          </option>
        </select>
      </label>

      <label class="mt-4 block">
        <span class="dark:text-white">Angkot</span>
        <div
          v-if="selected.angkot"
          class="form-input mt-2 flex w-full justify-between rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
        >
          <span>{{ selected.angkot.no_kendaraan }}</span>
          <span @click="ubahAngkot()" class="cursor-pointer text-indigo-400"
            >Ubah</span
          >
        </div>
        <select
          v-else
          v-model="angkotId"
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
        >
          <option value="0" selected disabled>Pilih angkot...</option>
          <option
            v-for="angkot in angkots[selectedTrayek]"
            :key="angkot.no_kendaraan"
            :value="angkot"
          >
            {{ angkot.no_kendaraan }}
          </option>
        </select>
      </label>
    </template>

    <label class="mt-4 block">
      <span class="dark:text-white">Alamat</span>
      <textarea
        class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
        rows="2"
        readonly
        >{{ selected.alamat }}</textarea
      >
    </label>

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
        @click="updateDriver"
      >
        Simpan
      </button>
    </template>
  </Dialog>
</template>

<script setup>
import DataTable from "@components/DataTable.vue"
import Dialog from "@components/Dialog.vue"
import { Inertia } from "@inertiajs/inertia"
import { Head } from "@inertiajs/inertia-vue3"
import eventBus from "@/eventBus"

const props = defineProps({
  auth: Object,
  errors: Object,
  drivers: Object,
  trayeks: Array,
})

const angkots = ref({})
const selected = ref({})
const selectedTrayek = ref()
const selectedAngkot = ref()
const modal = ref({
  type: "",
  isOpen: false,
})
const filters = ref({
  show: 5,
  search: "",
})

const columns = ["No. ", "Nama", "No. HP", "Email", "Angkot"]

const toggleModal = () => eventBus.$emit("modal-toggle")

const angkotId = computed({
  get() {
    return selected.value.angkot ? selected.value.angkot.id : 0
  },
  set(angkot) {
    selected.value.angkot = angkot
  },
})

watch(selectedTrayek, async (newTrayek) => {
  await loadAngkots(newTrayek)
})

const modalDriver = (type, driver = null) => {
  if (selectedTrayek.value != driver.trayek.id) {
    angkots.value = []
    selectedTrayek.value = driver.trayek.id
  }
  selectedAngkot.value = driver.angkot ? driver.angkot.id : 0
  modal.value.type = type
  selected.value = Object.assign({}, driver)

  toggleModal()
}

const onShowing = (val) => {
  filters.value.show = val
  Inertia.get(route("admin.akun.driver.index"), filters.value, {
    preserveState: true,
    preserveScroll: true,
  })
}

const onSearching = (q) => {
  filters.value.search = q
  setTimeout(
    () =>
      Inertia.get(route("admin.akun.driver.index"), filters.value, {
        preserveState: true,
        preserveScroll: true,
      }),
    250
  )
}

const ubahAngkot = () => {
  if (
    !angkots.value[selected.value.trayek.id].some(
      (angkot) => angkot.no_kendaraan == selected.value.angkot.no_kendaraan
    )
  ) {
    angkots.value[selected.value.trayek.id].push(selected.value.angkot)
  }

  selected.value.angkot = null
}

const loadAngkots = async (trayek) => {
  try {
    const res = await fetch(route("admin.akun.driver.loadAngkot", trayek), {
      headers: {
        Accept: "application/json",
      },
    })
    const data = await res.json()

    if (data.angkots) {
      angkots.value[trayek] = data.angkots
    }
  } catch (e) {
    console.error(e)
  }
}

const updateDriver = () => {
  Inertia.patch(
    route("admin.akun.driver.update", selected.value.id),
    {
      angkot: selected.value.angkot,
      trayek: selectedTrayek.value,
    },
    {
      preserveScroll: true,
    }
  )

  toggleModal()
}
</script>
