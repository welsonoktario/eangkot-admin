<template>
  <div class="mb-4 flex flex-col justify-between md:flex-row">
    <div class="mx-auto mb-4 dark:text-white md:mx-0 md:mb-0">
      <label for="showing">Tampilkan</label>
      <select
        class="mx-2 rounded-lg border-none bg-white px-2 py-1 dark:bg-gray-800"
        name="showing"
        v-model="showing"
      >
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="25">25</option>
      </select>
      <span>item</span>
    </div>
    <div
      class="relative text-gray-400 focus-within:text-white dark:text-gray-500"
    >
      <span class="absolute inset-y-0 left-0 flex pl-2">
        <magnifying-glass-icon class="my-auto h-5"
      /></span>
      <input
        class="search-input block w-full rounded-lg border-none bg-white px-2 py-1 pl-8 placeholder-gray-500 dark:bg-gray-800"
        v-model="query"
        type="text"
        name="search"
        placeholder="Cari entri"
        autocomplete="off"
      />
    </div>
  </div>
  <div class="mx-auto w-full rounded-lg shadow-lg">
    <div class="overflow-x-auto rounded-t-lg">
      <table class="w-full table-auto whitespace-nowrap dark:text-white">
        <thead>
          <tr
            class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
          >
            <th
              v-for="(column, index) in columns"
              :key="index"
              class="px-3 py-4"
            >
              {{ column }}
            </th>
            <th></th>
          </tr>
        </thead>

        <tbody class="divide-y bg-white dark:divide-gray-700 dark:bg-gray-800">
          <slot></slot>
        </tbody>
      </table>
    </div>

    <div>
      <Pagination
        class="grid rounded-b-lg border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 sm:grid-cols-9"
        :showLabel="true"
        :from="data.from"
        :to="data.to"
        :total="data.total"
        :links="data.links"
      />
    </div>
  </div>
</template>

<script setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid"
import { ref, watch } from "vue"
import Pagination from "@components/Pagination.vue"

const props = defineProps({
  columns: Array,
  data: Object,
})
const emits = defineEmits(["showing", "searching"])

const showing = ref(5)
const query = ref("")

watch(showing, (newVal) => emits("showing", newVal))
watch(query, (newVal) => emits("searching", newVal))
</script>

<style scoped>
.search-input:focus {
  border-width: 0px;
  outline: 0; /* I have also tried outline:none */
  -webkit-appearance: none;
  appearance: none;
  box-shadow: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
}

.showing-input:focus {
  border-width: 0px;
  outline: 0; /* I have also tried outline:none */
  -webkit-appearance: none;
  appearance: none;
  box-shadow: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
}
</style>
