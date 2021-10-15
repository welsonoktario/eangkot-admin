<template>
  <div v-if="links.length > 1">
    <template v-if="showLabel"
      ><span
        v-if="showLabel"
        class="
          flex
          items-center
          col-span-4
          w-full
          justify-center
          md:justify-start
        "
      >
        Menampilkan {{ from }}-{{ to }} dari {{ total }} item
      </span>
      <span class="col-span-1"></span
    ></template>

    <span
      class="flex w-full justify-center mt-4 md:mt-0"
      :class="{
        'col-span-4 md:justify-end': showLabel,
        'col-span-9': !showLabel,
      }"
    >
      <nav>
        <ul class="inline-flex items-center">
          <template v-for="(link, key) in links">
            <li v-if="!link.url" :key="key">
              <button
                v-if="link.label.includes('Previous')"
                class="
                  px-3
                  py-1
                  rounded-md rounded-l-lg
                  focus:outline-none
                  focus:shadow-outline-indigoÍ
                "
                disabled
              >
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  ></path>
                </svg>
              </button>
              <button
                v-else
                class="
                  px-3
                  py-1
                  rounded-md rounded-l-lg
                  focus:outline-none
                  focus:shadow-outline-indigoÍ
                "
                disabled
              >
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </button>
            </li>
            <li v-else :key="key + 1">
              <Link v-if="link.label.includes('Previous')" :href="link.url">
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  ></path>
                </svg>
              </Link>
              <Link v-else-if="link.label.includes('Next')" :href="link.url">
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </Link>
              <Link
                v-else
                class="
                  px-3
                  py-1
                  rounded-md
                  focus:outline-none
                  focus:shadow-outline-indigo
                "
                :class="{
                  'bg-indigo-500 dark:bg-indigo-400 text-gray-50 dark:text-gray-100':
                    link.active,
                }"
                :href="link.url"
                v-html="link.label"
              />
            </li>
          </template>
        </ul>
      </nav>
    </span>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    from: Number,
    to: Number,
    total: Number,
    links: Array,
    showLabel: Boolean,
  },
};
</script>
