<template>
  <div class="flex flex-col md:flex-row justify-between mb-4">
    <div class="dark:text-white mb-4 md:mb-0 mx-auto md:mx-0">
      <label for="showing">Tampilkan</label>
      <select
        class="
          showing-input
          bg-gray-100
          dark:bg-gray-800
          rounded-md
          border-none
          mx-2
        "
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
      class="
        relative
        px-2
        bg-gray-100
        dark:bg-gray-800
        dark:text-white
        rounded-md
      "
    >
      <div
        class="
          absolute
          inset-y-0
          left-0
          pl-3
          flex
          items-center
          pointer-events-none
        "
      >
        <svg
          class="w-5 h-5 text-gray-500"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          ></path>
        </svg>
      </div>
      <input
        class="
          search-input
          border-none
          py-2
          pl-8
          pr-4
          bg-white
          placeholder-gray-500
          text-gray-900
          dark:text-white
          dark:bg-gray-800
          w-full
          block
        "
        v-model="query"
        type="text"
        name="search"
        placeholder="Cari entri"
        autocomplete="off"
      />
    </div>
  </div>
  <div class="overflow-x-auto rounded-md shadow-md mx-auto w-full">
    <table
      class="table table-responsive w-full whitespace-nowrap dark:text-white"
    >
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
          <th v-for="(column, index) in columns" :key="index" class="px-3 py-4">
            {{ column }}
          </th>
          <th></th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        <slot></slot>
      </tbody>
    </table>

    <pagination
      :from="data.from"
      :to="data.to"
      :total="data.total"
      :links="data.links"
    />
  </div>
</template>

<script>
import { ref, watch } from "vue";
import Pagination from "@/Components/Pagination";

export default {
  components: {
    Pagination,
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
