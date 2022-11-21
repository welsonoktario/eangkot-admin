<template>
  <ul
    class="
      absolute
      right-0
      w-48
      py-2
      mt-2
      space-y-2
      text-gray-600
      bg-white
      border border-gray-100
      rounded-md
      shadow-md
      dark:border-gray-700
      dark:text-gray-300
      dark:bg-gray-700
    "
  >
    <li class="mt-2 pb-4 border-b border-gray-300 dark:border-gray-700">
      <p class="text-lg text-center font-semibold">{{ user.nama }}</p>
    </li>
    <li class="flex">
      <button
        @click="logout"
        class="
          inline-flex
          items-center
          w-full
          px-2
          py-1
          text-sm
          font-semibold
          transition-colors
          duration-150
          rounded-md
          hover:bg-gray-100
          hover:text-gray-800
          dark:hover:bg-gray-800
          dark:hover:text-gray-200
        "
      >
        <svg
          class="w-4 h-4 mr-4"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
          ></path>
        </svg>
        <span>Logout</span>
      </button>
    </li>
  </ul>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    user: Object,
  },
  setup(props) {
    const logout = () => {
      Inertia.post(route('logout'), {
        _token: props.csrf_token,
      });
    };

    return { logout };
  },
};
</script>
