<template>
  <div class="w-full overflow-x-auto rounded-md shadow-md">
    <table
      class="
        table table-responsive
        mx-auto
        w-full
        whitespace-nowrap
        dark:text-white
      "
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
  </div>
  <pagination
    :from="data.from"
    :to="data.to"
    :total="data.total"
    :links="data.links"
  />
</template>

<script>
import Pagination from "@/Components/Pagination";

export default {
  components: {
    Pagination,
  },
  props: {
    columns: Array,
    data: Object,
  },
};
</script>
