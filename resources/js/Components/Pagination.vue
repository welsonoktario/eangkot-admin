<template>
  <div v-if="links.length > 3">
    <div
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
      "
    >
      <span class="flex items-center col-span-3">
        Menampilkan {{ from }}-{{ to }} dari {{ total }} item
      </span>
      <span class="col-span-2"></span>
      <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end xs:mx-auto">
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
                    focus:shadow-outline-purpleÍ
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
                    focus:shadow-outline-purpleÍ
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
                <inertia-link
                  v-if="link.label.includes('Previous')"
                  :href="link.url"
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
                </inertia-link>
                <inertia-link
                  v-else-if="link.label.includes('Next')"
                  :href="link.url"
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
                </inertia-link>
                <inertia-link
                  v-else
                  class="
                    px-3
                    py-1
                    rounded-md
                    focus:outline-none
                    focus:shadow-outline-purple
                  "
                  :class="{ 'bg-purple-600 text-white': link.active }"
                  :href="link.url"
                  v-html="link.label"
                />
              </li>
            </template>
          </ul>
        </nav>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    from: Number,
    to: Number,
    total: Number,
    links: Array,
  },
};
</script>
