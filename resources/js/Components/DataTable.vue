<template>
  <div class="flex flex-col md:flex-row justify-between mb-4">
    <div class="dark:text-white mb-4 md:mb-0 mx-auto md:mx-0">
      <label for="showing">Tampilkan</label>
      <select
        class="bg-white dark:bg-gray-800 rounded-lg border-none mx-2 px-2 py-1"
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
      class="relative text-gray-400 dark:text-gray-500 focus-within:text-white"
    >
      <span class="absolute inset-y-0 left-0 pl-2 flex">
        <SearchIcon class="h-5 my-auto"
      /></span>
      <input
        class="
          search-input
          pl-8
          border-none
          w-full
          rounded-lg
          px-2
          py-1
          block
          bg-white
          dark:bg-gray-800
          placeholder-gray-500
        "
        v-model="query"
        type="text"
        name="search"
        placeholder="Cari entri"
        autocomplete="off"
      />
    </div>
  </div>
  <div class="mx-auto w-full rounded-lg shadow-lg">
    <div class="rounded-t-lg overflow-x-auto">
      <table class="table-auto w-full whitespace-nowrap dark:text-white">
        <thead>
          <tr
            class="
              text-xs
              font-semibold
              tracking-wide
              text-left text-gray-500
              uppercase
              border-b
              dark:border-gray-700
              bg-gray-50
              dark:text-gray-400
              dark:bg-gray-800
            "
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

        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <slot></slot>
        </tbody>
      </table>
    </div>

    <div>
      <Pagination
        class="
          grid
          px-4
          py-3
          text-xs
          font-semibold
          tracking-wide
          text-gray-500
          uppercase
          border-t
          dark:border-gray-700
          bg-gray-50
          sm:grid-cols-9
          dark:text-gray-400
          dark:bg-gray-800
          rounded-b-lg
        "
        :showLabel="true"
        :from="data.from"
        :to="data.to"
        :total="data.total"
        :links="data.links"
      />
    </div>
  </div>
</template>

<script>
import { ArrowDownIcon, SearchIcon } from "@heroicons/vue/solid";
import { ref, watch } from "vue";
import Pagination from "@components/Pagination.vue";

export default {
  components: {
    ArrowDownIcon,
    Pagination,
    SearchIcon,
  },
  props: {
    columns: Array,
    data: Object,
  },
  emits: ["showing", "searching"],
  setup(props, { emit }) {
    const showing = ref(5);
    const query = ref("");

    watch(showing, (newVal) => emit("showing", newVal));
    watch(query, (newVal) => emit("searching", newVal));

    return { showing, query };
  },
};
</script>

<style scoped>
.search-input:focus {
  border-width: 0px;
  outline: 0; /* I have also tried outline:none */
  -webkit-appearance: none;
  box-shadow: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
}

.showing-input:focus {
  border-width: 0px;
  outline: 0; /* I have also tried outline:none */
  -webkit-appearance: none;
  box-shadow: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
}
</style>
