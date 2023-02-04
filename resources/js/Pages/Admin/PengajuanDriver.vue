<template>
  <Head>
    <title>eAngkot Admin - Pengajuan Driver</title>
  </Head>

  <div class="my-6">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
      Pengajuan Driver
    </h2>
  </div>

  <DataTable
    v-if="pengajuans.data.length"
    :data="pengajuans"
    :columns="columns"
    @showing="onShowing"
    @searching="onSearching"
  >
    <tr
      v-for="(pengajuan, index) in pengajuans.data"
      :key="pengajuan.id"
      class="text-gray-700 dark:text-gray-400"
    >
      <td class="px-4 py-3">{{ index + 1 }}</td>
      <td class="px-4 py-3">{{ formattedTanggal(pengajuan.tanggal) }}</td>
      <td class="px-4 py-3">{{ pengajuan.user.nama }}</td>
      <td class="px-4 py-3">{{ pengajuan.trayek.kode }}</td>
      <td class="px-4 py-3" :class="statusColor(pengajuan.status)">
        {{ pengajuan.status }}
      </td>
      <td class="px-12 py-3 text-right">
        <button @click="modalPengajuan(pengajuan.id)" class="mr-2">
          Detail
        </button>
      </td>
    </tr>
  </DataTable>
  <p v-else class="my-6 w-full text-center">Belum ada data</p>

  <Dialog v-if="pengajuans.data.length" class="grid grid-cols-1">
    <template #title> Detail Pengajuan </template>

    <template #content>
      <label class="block">
        <span class="dark:text-white">Tanggal Pengajuan</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.tanggal"
          readonly
        />
      </label>

      <label class="block">
        <span class="dark:text-white">Nama</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.user.nama"
          readonly
        />
      </label>

      <label class="block">
        <span class="dark:text-white">Kode Trayek</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.trayek.kode"
          readonly
        />
      </label>

      <label v-if="selected.status === 'Ditolak'" class="block">
        <span class="dark:text-white">Alasan Penolakan</span>
        <input
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          type="text"
          :value="selected.alasan"
          readonly
        />
      </label>

      <label class="block">
        <span class="dark:text-white">Foto KTP</span>
        <img
          class="mt-2 w-full rounded-lg bg-gray-100 bg-cover bg-top bg-no-repeat dark:bg-zinc-700"
          :src="`/storage/${selected.ktp}`"
        />
      </label>

      <label class="block">
        <span class="dark:text-white">Foto SIM</span>
        <img
          class="mt-2 w-full rounded-lg bg-gray-100 bg-cover bg-top bg-no-repeat dark:bg-zinc-700"
          :src="`/storage/${selected.sim}`"
        />
      </label>
    </template>

    <template #footer>
      <button
        v-if="selected.status == 'Pending'"
        type="button"
        class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-rose-500 transition-all duration-150 hover:bg-rose-700 hover:bg-opacity-30 hover:text-rose-900 hover:text-rose-200 focus:outline-none"
        @click="toggleModal('modal-toggle-alasan')"
      >
        Tolak
      </button>
      <div class="flex-1"></div>
      <button
        type="button"
        class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-zinc-900 transition-all duration-150 hover:bg-gray-700 hover:text-white focus:outline-none dark:text-white"
        @click="toggleModal()"
      >
        Batal
      </button>
      <button
        v-if="selected.status != 'Diterima'"
        type="button"
        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none"
        @click="handlePengajuan(selected.id, 'Diterima')"
      >
        Terima
      </button>
    </template>
  </Dialog>

  <DialogAlasan v-if="pengajuans.data.length" class="grid grid-cols-1">
    <template #title> Alasan Penolakan Pengajuan </template>

    <template #content>
      <label class="block">
        <span class="dark:text-white">Alasan</span>
        <textarea
          v-model="alasan"
          class="form-input mt-2 block w-full rounded-md border-none bg-gray-100 dark:bg-gray-700 dark:text-white"
          placeholder="Alasan penolakan"
        ></textarea>
      </label>
    </template>

    <template #footer>
      <div class="flex-1"></div>
      <button
        type="button"
        class="mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-zinc-900 transition-all duration-150 hover:bg-gray-700 hover:text-white focus:outline-none dark:text-white"
        @click="toggleModal('modal-toggle-alasan')"
      >
        Batal
      </button>
      <button
        v-if="selected.status != 'Diterima'"
        type="button"
        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none"
        @click="handlePengajuan(selected.id, 'Ditolak')"
      >
        Kirim
      </button>
    </template>
  </DialogAlasan>
</template>

<script setup>
import DataTable from "@components/DataTable.vue"
import { Head } from "@inertiajs/inertia-vue3"
import Dialog from "@/Components/Dialog.vue"
import DialogAlasan from "@/Components/DialogAlasan.vue"
import { Inertia } from "@inertiajs/inertia"
import eventBus from "@/eventBus"

const columns = ["No", "Tanggal", "Nama", "Kode Trayek", "Status"]
const props = defineProps({
  pengajuans: Object,
  errors: Object,
  auth: Object,
})

const filters = ref({
  show: 5,
  search: "",
})
const selected = ref()
const alasan = ref()

const formattedTanggal = (tanggal) => {
  const date = new Date(Date.parse(tanggal))

  return date.toLocaleString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  })
}

const onShowing = (val) => {
  filters.value.show = val
  Inertia.get(route("admin.pengajuan-driver.index"), filters.value, {
    preserveState: true,
  })
}

const onSearching = (q) => {
  filters.value.search = q
  setTimeout(
    () =>
      Inertia.get(route("admin.pengajuan-driver.index"), filters.value, {
        preserveState: true,
      }),
    150
  )
}

const statusColor = (status) => {
  const colors = {
    Pending: "text-orange-400",
    Diterima: "text-indigo-400 font-semibold",
    Ditolak: "text-rose-400",
  }

  return colors[status]
}

const toggleModal = (type = "modal-toggle") => {
  if (type == "modal-toggle-alasan") {
    eventBus.$emit("modal-toggle")
    eventBus.$emit(type)
  } else {
    eventBus.$emit(type)
  }
}

const modalPengajuan = (id) => {
  selected.value = props.pengajuans.data.find((p) => p.id === id)

  toggleModal()
}

const handlePengajuan = (id, aksi) => {
  Inertia.patch(
    route("admin.pengajuan-driver.update", id),
    { status: aksi, alasan: alasan.value },
    {
      preserveState: true,
      onSuccess: () => {
        if (aksi === "Diterima") {
          toggleModal()
        } else {
          alasan.value = null
          eventBus.$emit("modal-toggle-alasan")
        }
      },
    }
  )
}
</script>
